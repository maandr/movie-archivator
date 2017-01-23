<?php
class Index extends Controller
{
  function __construct() {
    parent::__construct();
  }

  public function index() {
    $this->home();
  }

  public function home() {
    $this->render('home.tpl');
  }

  public function register() {
    $this->render('register.tpl');
  }
}
?>
