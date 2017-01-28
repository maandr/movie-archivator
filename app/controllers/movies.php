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
    echo "<pre>";
    var_dump($this->omdbService->load($imdbId));
    echo "</pre>";
  }

  public function search($search) {
    $this->restrictedTo([USER, ADMIN]);
    echo "<pre>";
    var_dump($this->omdbService->search($search));
    echo "</pre>";
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
