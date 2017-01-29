<?php
class Movies extends Controller {

  protected $repository;
  protected $omdbService;

  function __construct() {
    parent::__construct();
    $this->repository = new MovieRepository();
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

    if(!$this->repository->existsMovie($imdbId)) {

      $response = $this->omdbService->load($imdbId);
      $this->repository->createMovieFromImdb($response);
      $movie = $this->repository->getMovieByImdbId($imdbId);

      /* download the image */
      $img = POSTERS_DIR.$movie->id.'.jpg';
      file_put_contents($img, file_get_contents(str_replace('300', '600', $response->Poster)));
    } else {
      $movie = $this->repository->getMovieByImdbId($imdbId);
    }

    return $this->get($movie->id);
  }

  public function search() {
    $this->restrictedTo([USER, ADMIN]);

    $search = (isset($_GET['search'])) ? $_GET['search'] : '';
    $movies = [];
    $movies = $this->omdbService->search($search);

    $this->assign('search', $search);
    $this->assign('Movies', $movies);
    return $this->render('movies/search.tpl');
  }

  public function get($id = null) {
    $this->restrictedTo([USER, ADMIN]);

    if($id == null) {
      $movies = $this->repository->getAll();
      $this->assign('Movies', $movies);
      return $this->render('movies/list.tpl');
    } else {
      $movie = $this->repository->get($id);
      $this->assign('Movie', $movie);
      return $this->render('movies/details.tpl');
    }
  }

  public function post($data) {
    $this->repository->create($data);
  }

  public function update($id, $data) {
    $this->repository->update($id, $data);
  }

  public function delete($id) {
    $this->repository->delete($id);
  }
}
?>
