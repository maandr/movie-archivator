<?php
class Error extends Controller {

  function __construct() {
    parent::__construct();
  }

  public function index() {
    $this->render('404.tpl');
  }
}
?>
