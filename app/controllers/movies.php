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
      $UserRating = $this->RatingRepository->getUserRatingsOfMovie($_SESSION['userId'], $id);
      $this->assign('Movie', $movie);
      $this->assign('UserRating', $UserRating);
      return $this->render('movies/details.tpl');
    }
  }

  public function rated_by_user($userId) {
    $movies = $this->RatingRepository->getMoviesRatedByUser($userId);
    $this->assign('Movies', $movies);
    return $this->render('movies/list.tpl');
  }

  public function post($data) {
    $this->MovieRepository->create($data);
  }

  public function update($id, $data) {
    $this->MovieRepository->update($id, $data);
  }

  public function delete($id) {
    $this->MovieRepository->delete($id);
  }
}
?>
