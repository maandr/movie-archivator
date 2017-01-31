<?php
class Ratings extends Controller {
  protected $Repository;

  function __construct() {
    parent::__construct();
    $this->Repository = new RatingRepository();
  }

  public function rate() {
    $this->Repository->rate($_POST['userId'], $_POST['movieId'], $_POST['category'], $_POST['rating']);
  }
}
?>
