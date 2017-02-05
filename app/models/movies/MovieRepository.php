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

  public function getMoviesOfYear($year) {
    return $this->Database->select(
      "SELECT $this->tableName.id as movieId,
              $this->tableName.title as title,
              $this->tableName.year as year,
              $this->tableName.director as director,
              (SELECT SUM(total)/COUNT(total) FROM ratings WHERE ratings.movieId = $this->tableName.id) as total
      FROM movies
      WHERE movies.year = :year",
        ['year' => $year]);
  }

  public function getMoviesOfDirector($director) {
    return $this->Database->select(
      "SELECT $this->tableName.id as movieId,
              $this->tableName.title as title,
              $this->tableName.year as year,
              $this->tableName.director as director,
              (SELECT SUM(total)/COUNT(total) FROM ratings WHERE ratings.movieId = $this->tableName.id) as total
      FROM movies
      WHERE movies.director LIKE '%$director%'");
  }
}
?>
