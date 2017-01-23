<?php
class Movies extends Controller {

  protected $repository;

  function __construct() {
    parent::__construct();
    $this->repository = new MovieRepository();
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

  public function get($id = null) {
    return ($id == null) ?
      $this->repository->getAll() :
      $this->repository->get($id);
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
