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

    $total = $this->Database->select("SELECT (SUM(plot + dialog + cinematography + tention + sound + editing
      + meaning + acting + fun + rewatch + score + look + characters) / 13) as total
      FROM $this->tableName WHERE userId = :userId AND movieId = :movieId", [
      'userId' => $userId,
      'movieId' => $movieId
    ]);
    $this->Database->query("UPDATE $this->tableName SET total = ".$total[0]->total." WHERE userId = $userId AND movieId = $movieId");
  }

  public function getUserRatingsOfMovie($userId, $movieId) {
    $ratings = $this->Database->select("SELECT plot, dialog, cinematography, tention, sound, editing, meaning, acting, fun, rewatch, score, look, characters, total FROM $this->tableName WHERE userId = :userId AND movieId = :movieId", [
      'userId' => $userId,
      'movieId' => $movieId
    ]);

    if(count($ratings) == 0) {
      $rating = new UserRating();
      return $rating;
    }

    return $ratings[0];
  }

  public function getTotalRating($movieId, $userId = null) {

    if(!isset($userId)) {
      $userId = (isset($_GET['userId'])) ? $_GET['userId'] : null;
    }
    $total = 0;

    if($userId == null) {
      $sql = "SELECT * FROM $this->tableName WHERE movieId = :movieId";
      $result = $this->Database->select($sql, [
        'movieId' => $movieId
      ]);
      if(count($result) > 0) {
        $total = $result[0]->total;
      }
    } else {
      $sql = "SELECT * FROM $this->tableName WHERE movieId = :movieId AND userId = :userId";
      $result = $this->Database->select($sql, [
        'movieId' => $movieId,
        'userId' => $userId
      ]);
      if(count($result) > 0) {
        $total = $result[0]->total;
      }
    }

    return $total;
  }

  public function getAllRatingsOfUser($userId) {
    return $this->Database->select("SELECT * FROM $this->tableName WHERE userId = :userId", [
      'userId' => $userId
    ]);
  }

  public function getMoviesRatedByUser($userId) {
    return $this->Database->select("SELECT * FROM movies, ratings WHERE ratings.userId = :userId AND ratings.movieId = movies.id", [
      'userId' => $userId
    ]);
  }
}
?>
