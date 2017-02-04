<?php
class MovieRepository extends Repository {

  /* constructor */
  function __construct() {
    parent::__construct('movies');
  }

  public function existsMovie($imdbId) {
    $count = $this->Database->rowCount(
      "SELECT id FROM $this->tableName WHERE imdbId = '".$imdbId."'");
    return $count > 0;
  }

  public function getMovieByImdbId($imdbId) {
    return $this->Database->select(
      "SELECT * FROM $this->tableName WHERE imdbId = :imdbId",
        ['imdbId' => $imdbId])[0];
  }

  public function search($search) {
    return $this->Database->select(
      "SELECT * FROM $this->tableName WHERE title LIKE '%$search%'");
  }
}
?>
