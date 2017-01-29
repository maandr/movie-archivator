<?php
class OmdbService {

  const WEBSERVICE_BASE_URL = 'http://www.omdbapi.com';

  /* constructor */
  function __construct() {}

  /*
   * Queries Omdb API for movies that matche the passed pattern.
   *
   * @param pattern Value to search for.
   * @return Collection of results matching the pattern.
   */
  public function search($pattern) {

  	$requestUri = sprintf('%s?s=%s&plot=full&type=movie&r=json', self::WEBSERVICE_BASE_URL, urlencode($pattern));
  	$response = HTTP::get($requestUri);

  	$results = array();

    if(isset($response->Search) && is_array($response->Search)) {
      foreach($response->Search as $result) {
    		array_push($results, $result);
    	}
    }

  	return $results;
  }

  /*
   * Queries Omdb API for a specific movie.
   *
   * @param imdbId ImdbId of the movie to load.
   * @return Movie with the passed ImdbId.
   */
  public function load($imdbId) {
    $requestUri = sprintf('%s?i=%s&plot=full&r=json', self::WEBSERVICE_BASE_URL, urlencode($imdbId));
    $response = HTTP::get($requestUri);

    return $response;
	}
}
?>
