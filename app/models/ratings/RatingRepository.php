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

  public function getUserRating($userId, $movieId) {
    $ratings = $this->Database->select("SELECT * FROM $this->tableName WHERE userId = :userId AND movieId = :movieId", [
        'userId' => $userId,
        'movieId' => $movieId
    ]);

    if(count($ratings) == 0) {
      return new UserRating();
    }

    return $ratings[0];
  }

  public function getAverageRating($movieId) {
    $results = $this->Database
      ->select("SELECT SUM(total)/COUNT(total) as total,
                       SUM(plot)/COUNT(plot) as plot,
                       SUM(dialog)/COUNT(dialog) as dialog,
                       SUM(cinematography)/COUNT(cinematography) as cinematography,
                       SUM(tention)/COUNT(tention) as tention,
                       SUM(sound)/COUNT(sound) as sound,
                       SUM(editing)/COUNT(editing) as editing,
                       SUM(meaning)/COUNT(meaning) as meaning,
                       SUM(acting)/COUNT(acting) as acting,
                       SUM(fun)/COUNT(fun) as fun,
                       SUM(rewatch)/COUNT(rewatch) as rewatch,
                       SUM(score)/COUNT(score) as score,
                       SUM(look)/COUNT(look) as look,
                       SUM(characters)/COUNT(characters) as characters,
                       COUNT(total) as ratings
        FROM $this->tableName WHERE movieId = :movieId", [
          'movieId' => $movieId
    ]);

    if(count($results) == 0) {
      return new UserRating();
    }

    return $results[0];
  }

  public function getAllRatingsOfUser($userId) {
    return $this->Database->select("SELECT * FROM $this->tableName WHERE userId = :userId", [
      'userId' => $userId
    ]);
  }

  public function getMoviesRatedByUser($userId) {
    return $this->Database
      ->select("SELECT * FROM movies, ratings WHERE ratings.userId = :userId AND ratings.movieId = movies.id", [
        'userId' => $userId
    ]);
  }
}
?>
