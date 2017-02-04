<?php
class Ratings extends Controller {
  protected $Repository;

  function __construct() {
    parent::__construct();
    $this->Repository = new RatingRepository();
  }

  public function rate() {
    $this->Repository->rate($_POST['movieId'], $_POST['userId'], $_POST['category'], $_POST['rating']);
  }

  public function total($movieId, $userId = null) {
    $rating = $this->Repository->getTotalRating($movieId, $userId);
    $this->assign('Total', $rating);
    return $this->render('ratings/total-rating.tpl');
  }
}
?>
