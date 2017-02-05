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

    $userId = (isset($_GET['userId'])) ? $_GET['userId'] : null;

    $UserRating = $this->Repository->getUserRating($userId, $movieId);
    $AverageRating = $this->Repository->getAverageRating($movieId);

    $this->assign('UserRating', $UserRating);
    $this->assign('AverageRating', $AverageRating);
    return $this->render('ratings/total-rating.tpl');
  }
}
?>
