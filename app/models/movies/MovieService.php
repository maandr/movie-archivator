<?php
class MovieService extends Service
{
	const OMDB_RESOURCE = 'http://www.omdbapi.com';
	
	private $userId;

	public function __construct($userId)
	{
		parent::__construct(MovieFactory::getInstance(), new MovieDbTable());
		$this->userId = $userId;
	}
	
	public function rate($id, $rating)
	{
		$modelData = $this->database->get($id);
		$modelData['rating'] = $rating;
		$modelData['rateDate'] = date('Y-m-d H:i:s');

		$this->update($id, $modelData);
		
		Location::redirectTo('filme/details/'.$id);
	}
	
	public function loadById($imdbID)
	{
		$request = sprintf('%s?i=%s&plot=full&r=json', self::OMDB_RESOURCE, urlencode($imdbID));
		$response = HTTP::get($request);
		
		$data = $this->factory->createArrayFromImdbJson($response);
		$data['userId'] = $_SESSION['userId'];
		
		$img = ROOT_DIR.'assets/poster/'.$data['imdbId'].'.jpg';
		file_put_contents($img, file_get_contents($data['poster']));
		$data['poster'] = $img;
		
		return $data;
	}
		
	public function searchFor($search)
	{
		$request = sprintf('%s?s=%s&plot=full&type=movie&r=json', self::OMDB_RESOURCE, urlencode($search));
		$response = HTTP::get($request);

		$results = array();
		
		foreach($response->Search as $result)
		{
			array_push($results, $result);
		}

		return $results;
	}
	
	public function getTags()
	{
		$movies = $this->getMovies();
		$tags = array();
		
		foreach($movies as $movie)
		{
			$movieTags = explode(', ', $movie->tags);
		
			foreach($movieTags as $tag)
			{
				if(!in_array($tag, $tags) && strlen($tag) > 0)
				{
					array_push($tags, $tag);
				}
			}
		}
		
		return $tags;
	}
	
	public function getGenres()
	{
		$movies = $this->getMovies();
		$genres = array();
		
		foreach($movies as $movie)
		{
			$movieGenres = explode(', ', $movie->genres);
				
			foreach($movieGenres as $genre)
			{
				if(!in_array($genre, $genres))
				{
					array_push($genres, $genre);
				}
			}
		}
		
		return $genres;
	}
	
	public function getActors()
	{
		$movies = $this->getMovies();
		$actors = array();
		
		foreach($movies as $movie)
		{
			$movieActors = explode(', ', $movie->actors);
			
			foreach($movieActors as $actor)
			{
				if(!in_array($actor, $actors))
				{
					array_push($actors, $actor);
				}
			}
		}
		
		return $actors;
	}
	
	private function getEntityStatsistics($entity)
	{
		$movies = $this->getMovies();
		$entityStats = array();
		
		foreach($movies as $movie)
		{
			$movieEntities = explode(', ', $movie->$entity);
			
			foreach($movieEntities as $entityName)
			{
				if(!isset($entityStats[$entityName]))
				{
					$entityStats[$entityName]['name'] = $entityName;
					$entityStats[$entityName]['movieCount'] = 1;
					$entityStats[$entityName]['totalRating'] = $movie->rating;
				}
				else
				{
					$entityStats[$entityName]['movieCount'] ++;
					$entityStats[$entityName]['totalRating'] += $movie->rating;
				}
			}
		}
		
		return $entityStats;
	}
	
	private function createSortableArray($unsortedSortableArray, $sortIndex, $n = 2)
	{
		$sortableStats = array();
	
		foreach($unsortedSortableArray as $entity => $entityStats)
		{
			if($entityStats['totalRating'] <= 0 || $entityStats['movieCount'] < $n)
				continue;
	
			$entityStats['averageRating'] = $entityStats['totalRating'] / $entityStats['movieCount'];
			$sortableIndex = $entityStats[$sortIndex].'-'.$entity;
	
			$sortableStats[$sortableIndex] = new PersonListViewModel();
			$sortableStats[$sortableIndex]->name = $entity;
			$sortableStats[$sortableIndex]->ratedAmount = $entityStats['movieCount'];
			$sortableStats[$sortableIndex]->averageRating = $entityStats['averageRating'];
		}
	
		return $sortableStats;
	}
	
	public function getStatistics($entity, $index, $minCount = 2)
	{
		$stats = $this->getEntityStatsistics($entity);
		$sortableStats = $this->createSortableArray($stats, $index, $minCount);
		
		return $sortableStats;
	}
	
	public function getDirectors()
	{
		$models = $this->getMovies();
		$directors = array();
	
		foreach($models as $model)
		{
			$movieDirectors = explode(', ', $model->director);
				
			foreach($movieDirectors as $director)
			{
				if(!in_array($director, $directors))
				{
					array_push($directors, $director);
				}
			}
		}
	
		return $directors;
	}
	
	public function getWatchList()
	{
		return $this->getModelsFiltered("WHERE userId = '".$this->userId."' AND type = 'movie' AND rating = '0.0' ORDER BY year DESC");
	}
	
	public function getMoviesFromCountry($county)
	{
		return $this->getModelsFiltered("WHERE userId = '".$this->userId."' AND country LIKE '%".$county."%' AND type = 'movie' AND rating != '0.0' ORDER BY rating DESC");
	}
	
	public function getMoviesByTitle($title)
	{
		return $this->getModelsFiltered("WHERE userId = '".$this->userId."' AND type = 'movie' AND title = '".mysql_real_escape_string($title)."' ORDER BY id DESC");
	}
	
	public function getMoviesByRating()
	{
		return $this->getModelsFiltered("WHERE userId = '".$this->userId."' AND type = 'movie' AND rating != '0.0' ORDER BY rating DESC");
	}
	
	public function getMovies()
	{
		return $this->getModelsFiltered("WHERE userId = '".$this->userId."' AND type = 'movie' AND rating != '0.0' ORDER BY id DESC");
	}
	
	public function getOscarNominatedMovies($year = null)
	{
		return ($year == null) ?
			$this->getModelsFiltered("WHERE userId = '".$this->userId."' AND type = 'movie' AND awards LIKE '%Oscar%' ORDER BY rating DESC") :
			$this->getModelsFiltered("WHERE userId = '".$this->userId."' AND type = 'movie' AND awards LIKE '%Oscar%' AND year = '".$year."' ORDER BY rating DESC");
	}
	
	public function getOscarWinningMovies($year = null)
	{
		return ($year == null) ?
		$this->getModelsFiltered("WHERE userId = '".$this->userId."' AND type = 'movie' AND awards LIKE '%Won%Oscar%' ORDER BY rating DESC") :
		$this->getModelsFiltered("WHERE userId = '".$this->userId."' AND type = 'movie' AND awards LIKE '%Won%Oscar%' AND year = '".$year."' ORDER BY rating DESC");
	}
	
	public function getMoviesContaining($search)
	{
		return $this->getModelsFiltered("WHERE userId = '".$this->userId."' AND type = 'movie' AND title LIKE '%".$search."%' OR plot LIKE '%".$search."%' OR director LIKE '%".$search."%' OR actors LIKE '%".$search."%' AND rating != '0.0' ORDER BY title ASC");
	}
	
	public function getMoviesByYear($year)
	{
		return $this->getModelsFiltered("WHERE userId = '".$this->userId."' AND type = 'movie' AND year = '".$year."' AND rating != '0.0' ORDER BY rating DESC");
	}
	
	public function getMoviesTaggedWith($tag)
	{
		return $this->getModelsFiltered("WHERE userId = '".$this->userId."' AND type = 'movie' AND tags LIKE '%".urldecode($tag)."%' AND rating != '0.0' ORDER BY rating DESC");
	}
	
	public function getMoviesByGenre($genre)
	{
		return $this->getModelsFiltered("WHERE userId = '".$this->userId."' AND type = 'movie' AND genre LIKE '%".urldecode($genre)."%' AND rating != '0.0' ORDER BY rating DESC");
	}
	
	public function getMoviesOfDirector($director)
	{
		return $this->getModelsFiltered("WHERE userId = '".$this->userId."' AND type = 'movie' AND director LIKE '%".urldecode($director)."%' AND rating != '0.0' ORDER BY rating DESC");
	}
	
	public function getMoviesWithActor($actor)
	{
		return $this->getModelsFiltered("WHERE userId = '".$this->userId."' AND type = 'movie' AND actors LIKE '%".urldecode($actor)."%' AND rating != '0.0' ORDER BY rating DESC");
	}
	
	public function getMoviesWithRating($rating)
	{
		return $this->getModelsFiltered("WHERE userId = '".$this->userId."' AND type = 'movie' AND rating LIKE '".$rating.".%'");
	}
	
	public function getBestRatedMovies($n)
	{
		return $this->getModelsFiltered("WHERE userId = '".$this->userId."' AND type = 'movie' AND rating != '0.0' ORDER BY rating DESC LIMIT 0, $n");
	}
	
	public function getBestRatedMoviesOfGenre($n, $genre)
	{
		return $this->getModelsFiltered("WHERE userId = '".$this->userId."' AND type = 'movie' AND rating != '0.0' AND genre LIKE '%$genre%' ORDER BY rating DESC LIMIT 0, $n");
	}

	public function getWorstRatedMovies($n)
	{
		return $this->getModelsFiltered("WHERE userId = '".$this->userId."' AND type = 'movie' AND rating != '0.0' ORDER BY rating ASC LIMIT 0, $n");
	}
	
	public function getWorstRatedMoviesOfGenre($n, $genre)
	{
		return $this->getModelsFiltered("WHERE userId = '".$this->userId."' AND type = 'movie' AND rating != '0.0' AND genre LIKE '%$genre%' ORDER BY rating ASC LIMIT 0, $n");
	}
}
?>