<?php
class MovieRepository extends Repository {

  /* constructor */
  function __construct() {
    parent::__construct('movies');
  }

  /*
   * Determines wether or not a movie with the passed
   * imdbId already exists or not.
   *
   * @param imdbId ImdbId of the movie to check.
   * @return true in case a movie with the specified
   *   imdbId already exists - false otherwise.
   */
  public function existsMovie($imdbId) {
    $count = $this->Database->rowCount("SELECT id FROM $this->tableName WHERE imdbId = '".$imdbId."'");
    return $count > 0;
  }

  /*
   * Gets a movie by the passed imdbId.
   *
   * @param imdbId ImdbId of the movie to get.
   * @return Movie with the specified imdbId.
   */
  public function getMovieByImdbId($imdbId) {
    return $this->Database->select(
      "SELECT * FROM $this->tableName WHERE imdbId = :imdbId",
        ['imdbId' => $imdbId])[0];
  }

  /*
   * Searches for movies that contain the specified
   * term in the movie title.
   *
   * @param search Term to search for.
   * @return Array of all movies whos title contains the passed term.
   */
  public function search($search) {

    return $this->Database->select(
      "SELECT * FROM $this->tableName WHERE title LIKE '%" . mysql_real_escape_string($search) . "%'");
  }

  /*
   * Gets all movies of the passed year.
   *
   * @param year Year to get movies for.
   * @return Array containing all movies of the specified year.
   */
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

  /*
   * Gets all movies created by the passed director.
   *
   * @param director Director whos movies to get.
   * @return Array containing all movies of the specified director.
   */
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

  /*
   * Gets all movies written by the passed writer.
   *
   * @param writer Writer whos movies to get.
   * @return Array containing all movies written by the specified writer.
   */
  public function getMoviesOfWriter($writer) {
    return $this->Database->select(
      "SELECT $this->tableName.id as movieId,
              $this->tableName.title as title,
              $this->tableName.year as year,
              $this->tableName.director as director,
              (SELECT SUM(total)/COUNT(total) FROM ratings WHERE ratings.movieId = $this->tableName.id) as total
      FROM movies
      WHERE movies.writer LIKE '%$writer%'");
  }

  /*
   * Gets all movies starring the passed actor.
   *
   * @param actor Actor whos movies to get.
   * @return Array containing all movies starring the specified actor.
   */
  public function getMoviesOfActor($actor) {
    return $this->Database->select(
      "SELECT $this->tableName.id as movieId,
              $this->tableName.title as title,
              $this->tableName.year as year,
              $this->tableName.director as director,
              (SELECT SUM(total)/COUNT(total) FROM ratings WHERE ratings.movieId = $this->tableName.id) as total
      FROM movies
      WHERE movies.cast LIKE '%$actor%'");
  }

  /*
   * Gets all movies of a specific genre.
   *
   * @param genre Genre to get movies for.
   * @return Array containing all movies of the specified genre.
   */
  public function getMoviesOfGenre($genre) {
    return $this->Database->select(
      "SELECT $this->tableName.id as movieId,
              $this->tableName.title as title,
              $this->tableName.year as year,
              $this->tableName.director as director,
              (SELECT SUM(total)/COUNT(total) FROM ratings WHERE ratings.movieId = $this->tableName.id) as total
      FROM movies
      WHERE movies.genre LIKE '%$genre%'");
  }

  /*
   * Gets all movies produced in a specific country.
   *
   * @param country Country to get movies for.
   * @return Array containing all movies produced in the specified country.
   */
  public function getMoviesOfCountry($country) {
    return $this->Database->select(
      "SELECT $this->tableName.id as movieId,
              $this->tableName.title as title,
              $this->tableName.year as year,
              $this->tableName.director as director,
              (SELECT SUM(total)/COUNT(total) FROM ratings WHERE ratings.movieId = $this->tableName.id) as total
      FROM movies
      WHERE movies.country LIKE '%$country%'");
  }
}
?>
