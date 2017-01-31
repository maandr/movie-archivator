<?php
class RatingRepository extends Repository {

  /* constructor */
  function __construct() {
    parent::__construct('ratings');
  }

  public function rate($movieId, $userId, $category, $rating) {

    $matchCount = $this->Database->rowCount("SELECT id FROM $this->tableName WHERE userId = $userId AND movieId = $movieId");

    if($matchCount < 1) {
      $this->create(["userId" => $userId, "movieId" => $movieId, $category => $rating]);
    } else {
      $this->Database->query("UPDATE $this->tableName SET $category = $rating WHERE userId = $userId AND movieId = $movieId");
    }
  }
}
?>
