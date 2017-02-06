<?php
class Movies extends Controller {

  protected $MovieRepository;
  protected $RatingRepository;
  protected $omdbService;

  function __construct() {
    parent::__construct();
    $this->MovieRepository = new MovieRepository();
    $this->RatingRepository = new RatingRepository();
    $this->omdbService = new OmdbService();
    $this->form = new Form();
    $this->form->createField(FieldType::String, 'title');
    $this->form->createField(FieldType::Integer, 'year');
    $this->form->createField(FieldType::String, 'genre');
    $this->form->createField(FieldType::String, 'runtime');
    $this->form->createField(FieldType::String, 'director');
    $this->form->createField(FieldType::String, 'country');
    $this->form->createField(FieldType::String, 'awards');
    $this->form->createField(FieldType::String, 'writer');
    $this->form->createField(FieldType::String, 'actors');
    $this->form->createField(FieldType::String, 'plot');
  }

  public function index() {
    $this->assign('username', '');
    $this->render('admin/login.tpl');
  }

  public function load($imdbId) {
    $this->restrictedTo([USER, ADMIN]);
    $movie = null;

    if(!$this->MovieRepository->existsMovie($imdbId)) {
      $response = $this->omdbService->load($imdbId);
      $this->MovieRepository->create([
        'imdbId' => $response->imdbID,
        'title' => $response->Title,
        'year' => $response->Year,
        'runtime' => $response->Runtime,
        'genre' => $response->Genre,
        'director' => $response->Director,
        'writer' => $response->Writer,
        'cast' => $response->Actors,
        'plot' => $response->Plot,
        'country' => $response->Country,
        'awards' => $response->Awards
      ]);
      $movie = $this->MovieRepository->getMovieByImdbId($imdbId);

      /* download the image */
      $img = POSTERS_DIR.$movie->id.'.jpg';
      file_put_contents($img, file_get_contents(str_replace('300', '600', $response->Poster)));
    } else {
      $movie = $this->MovieRepository->getMovieByImdbId($imdbId);
    }

    return $this->get($movie->id);
  }

  public function search($search = null) {
    $this->restrictedTo([USER, ADMIN]);

    if(!isset($search) || empty($search)) {
      $this->assign('Results', []);
      return $this->render('movies/search-results.tpl');
    }

    $results = [];
    $results = $this->omdbService->search($search);

    if(count($results) == 0) {
      $this->assign('Search', $search);
      return $this->render('movies/search-no-results.tpl');
    }

    $this->assign('Results', $results);
    return $this->render('movies/search-results.tpl');
  }

  public function search_succestion($search = null) {
    if(!isset($search) || empty($search)) {
      $this->assign('Results', []);
      return $this->render('movies/search-suggestion.tpl');
    }

    $results = [];
    $results = $this->MovieRepository->search($search);
    $this->assign('PosterPath', POSTER_PATH);
    $this->assign('Results', $results);
    return $this->render('movies/search-suggestion.tpl');
  }

  public function get($id = null) {
    $this->restrictedTo([USER, ADMIN]);

    if($id == null) {
      $movies = $this->MovieRepository->getAll();
      $this->assign('Movies', $movies);
      return $this->render('movies/list.tpl');
    } else {
      $movie = $this->MovieRepository->get($id);
      $UserRating = $this->RatingRepository->getUserRating($_SESSION['userId'], $id);
      $AverageRating = $this->RatingRepository->getAverageRating($id);

      $this->assign('Movie', $movie);
      $this->assign('UserRating', $UserRating);
      $this->assign('AverageRating', $AverageRating);
      return $this->render('movies/details.tpl');
    }
  }

  public function edit($id) {
    $this->restrictedTo([ADMIN]);

    if(!isset($_POST['submit'])) {
      $movie = $this->MovieRepository->get($id);

      $this->assign('Movie', $movie);
      return $this->render('movies/edit.tpl');
    }

    $form = new Form();
    $form->createField(FieldType::String, 'title');
    $form->createField(FieldType::Integer, 'year');
    $form->createField(FieldType::String, 'director');
    $form->createField(FieldType::String, 'writer');
    $form->createField(FieldType::String, 'cast');
    $form->createField(FieldType::String, 'awards');
    $form->createField(FieldType::String, 'runtime');
    $form->createField(FieldType::String, 'country');
    $form->createField(FieldType::String, 'genre');
    $form->createField(FieldType::Optional, 'plot');
    $form->setFieldMessage('title', 'Please provide an title.');
    $form->setFieldMessage('year', 'Please provide a year.');
    $form->setFieldMessage('director', 'Please provide an director.');
    $form->setFieldMessage('writer', 'Please provide an writer.');
    $form->setFieldMessage('cast', 'Please provide an cast.');
    $form->setFieldMessage('awards', 'Please provide an awards.');
    $form->setFieldMessage('runtime', 'Please provide an runtime.');
    $form->setFieldMessage('country', 'Please provide an country.');
    $form->setFieldMessage('genre', 'Please provide an genre.');

    $form->parse($_POST);
    $data = $form->toArray();

    if(!$form->isValid()) {
      $this->handleFormErrors($form);
      $this->assign($data);
      return $this->render('movies/edit.tpl');
    }

    $this->MovieRepository->update($id, $data);
    return $this->get($id);
  }

  public function year($year) {
    $this->restrictedTo([USER, ADMIN]);

    $movies = $this->MovieRepository->getMoviesOfYear($year);
    $this->assign('Movies', $movies);
    return $this->render('movies/list.tpl');
  }

  public function director($director) {
    $this->restrictedTo([USER, ADMIN]);

    $movies = $this->MovieRepository->getMoviesOfDirector($director);
    $this->assign('Movies', $movies);
    return $this->render('movies/list.tpl');
  }

  public function writer($writer) {
    $this->restrictedTo([USER, ADMIN]);

    $movies = $this->MovieRepository->getMoviesOfWriter($writer);
    $this->assign('Movies', $movies);
    return $this->render('movies/list.tpl');
  }

  public function actor($actor) {
    $this->restrictedTo([USER, ADMIN]);

    $movies = $this->MovieRepository->getMoviesOfActor($actor);
    $this->assign('Movies', $movies);
    return $this->render('movies/list.tpl');
  }

  public function genre($genre) {
    $this->restrictedTo([USER, ADMIN]);

    $movies = $this->MovieRepository->getMoviesOfGenre($genre);
    $this->assign('Movies', $movies);
    return $this->render('movies/list.tpl');
  }

  public function country($country) {
    $this->restrictedTo([USER, ADMIN]);

    $movies = $this->MovieRepository->getMoviesOfCountry($country);
    $this->assign('Movies', $movies);
    return $this->render('movies/list.tpl');
  }

  public function rated_by_user($userId) {
    $this->restrictedTo([USER, ADMIN]);

    $movies = $this->RatingRepository->getMoviesRatedByUser($userId);
    $this->assign('Movies', $movies);
    return $this->render('movies/list.tpl');
  }

  public function post($data) {
    $this->MovieRepository->create($data);
  }

  public function delete($id) {
    $this->MovieRepository->delete($id);
  }
}
?>
