<?php
class MovieRepository extends Repository {

  /* constructor */
  function __construct() {
    parent::__construct('movies');
  }

  public function existsMovie($imdbId) {
    $count = $this->Database
      ->rowCount("SELECT id FROM $this->tableName WHERE imdbId = '".$imdbId."'");
    return $count > 0;
  }

  public function getMovieByImdbId($imdbId) {
    return $this->Database
      ->select("SELECT * FROM $this->tableName WHERE imdbId = :imdbId", ['imdbId' => $imdbId])[0];
  }

  public function createMovieFromImdb($response) {
    $this->create([
      'imdbId' => $response->imdbID,
      'title' => $response->Title,
      'year' => $response->Year,
      'runtime' => $response->Runtime,
      'genre' => $response->Genre,
      'director' => $response->Director,
      'writer' => $response->Writer,
      'cast' => $response->Actors,
      'plot' => $response->Plot,
      'country' => $response->Country,
      'awards' => $response->Awards
    ]);
  }
}
?>
