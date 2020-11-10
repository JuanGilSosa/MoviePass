<?php 
    namespace Database;

    use Models\Movie\Movie as Movie;
    use Models\Movie\Genre as Genre;
    use PDOException as PDOException;
    
    class MoviesDAO implements IMovieDAO{

        protected $movies;

        public function __construct(){
            $this->movies = array();
        }

        public function GetAll(){
            $this->GetMoviesNowPlaying();
            return $this->movies;
        }

        public function Add($movie){
            $this->GetMoviesNowPlaying();
            array_push($this->movies, $movie);
            #$this->SaveData();
        }

        public function GetAllFromDatabase(){
          try{
              $con = Connection::getInstance();
              $query = 'SELECT * FROM movies';
              $array = $con->execute($query);
              return (!empty($array)) ? $this->mapping($array) : false;
          }catch(PDOException $e){
              echo $e->getMessage();
          }
      }

      public function GetMovieByIdFromDatabase($movieId){
        try{
            $con = Connection::getInstance();
            $query = 'SELECT * FROM movies where movieId=' . $movieId .';';
            $array = $con->execute($query);
            return (!empty($array)) ? $this->mapping($array) : false;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
      
      public function AddToDatabase($movie){
          try{
              $con = Connection::getInstance();

              $query = 'INSERT INTO movies(movieId, poster_path, backdrop_path, adult, original_language, title, vote_average, overview, release_date, active) VALUES
                          (:movieId,:poster_path,:backdrop_path,:adult,:original_language,:title, :vote_average, :overview, :release_date, :active)';

              $params['movieId'] = $movie->GetId();
              $params['poster_path'] = $movie->GetPosterPath();
              $params['backdrop_path'] = $movie->GetBackDropPath();
              $params['adult'] = $movie->isAdult();
              $params['original_language'] = $movie->GetOriginalLanguage();
              $params['title'] = $movie->GetTitle();
              $params['vote_average'] = $movie->GetVoteAverage();
              $params['overview'] = $movie->GetOverview();
              $params['release_date'] = $movie->GetReleaseDate();
              $params['active'] = $movie->isActive();

              return $con->executeNonQuery($query, $params);
          }catch(PDOException $e){
              throw $e;
          }
      }

      public function Delete($movieId){
        try{
            $query = 'UPDATE movies SET active = 0 WHERE movieId = :movieId;';
            $con = Connection::getInstance();
            $params['movieId'] = $movieId;
            $con->executeNonQuery($query, $params);
        }catch(PDOException $e){
           // echo 'Exception en Delete='.$e->getMessage();
        }
    }
    
    public function Update($cinema){
        ##no creemos necesario un metodo update para las peliculas
    }

      public function mapping($value){
          $value = is_array($value) ? $value : [];
          $resp = array_map(function($a){
              $movie = new Movie(
                $a['poster_path'],
                $a['backdrop_path'],
                $a['movieId'],
                $a['adult'],
                $a['original_language'],
                $a['title'],
                array(),
                $a['vote_average'],
                $a['release_date'],
                $a['active']
              );                
              return $movie;
          },$value);
          return count($resp)>1 ? $resp : $resp[0];
      }

        /*
                example of how to get a json :: https://developers.themoviedb.org/3/movies/get-now-playing  section Try It out
                --example of json--see footer of this file
            */    
            /*    
                Asi descargo cosas. Por ejemplo, si es $var = file_get_contents("https://google.com"); descarga la estructura de 
                google y la muestro con un echo $var;
                En este caso si se lee la documentacion("example of how to get a json::")en la seccion Try It out(al lado de Definition),
                y ponemos nuestra key en api_key, presionamos SEND REQUEST muestra un json, siendo que el LINK que aparece al lado del button que envia 
                el request es el que utilizaremos para obtener la lista de movies

                Todo este proceso es similar para obtener los generos
            */

        private function GetMoviesNowPlaying(){
            
            $movies = file_get_contents(
                API_URL.'now_playing?api_key='.API_KEY1.'&language=es-ES&page=1'
            );
			
            $decode = json_decode($movies, true);
            /*
                recorro el decode que tiene el arreglo asociativo con los datos de las movies accediendo al arreglo 'results' y recoriiendolo
                siendo 'results' el arreglo con todas las movies devueltas por la API
            */
            foreach($decode['results'] as $allresults){
                $movie = new Movie(
                    $allresults['poster_path'],
                    $allresults['backdrop_path'],
                    $allresults['id'],
                    $allresults['adult'],
                    $allresults['original_language'],
                    $allresults['original_title'],
                    $allresults['genre_ids'],
                    $allresults['vote_average'],
                    $allresults['overview'],
                    $allresults['release_date'],
                );
                array_push($this->movies, $movie);
            }
		}
		
        private function SaveMovieAndGenre(){
            $moviesFile = 'Data\moviesBackup.json';
            $genresFile = 'Data\genresBackup.json';
            
            $movies = array();
            
            foreach($this->movies as $m){
                $valuesArray['poster_path'] = $m->getPosterPath();
                $valuesArray['backdrop_path'] = $m->getBackdropPath();
                $valuesArray['id'] = $m->getId();
                $valuesArray['adult'] = $m->isAdult();
                $valuesArray['original_language'] = $m->getOriginalLenguage();
                $valuesArray['original_title'] = $m->getOriginalTitle();
                $valuesArray['genres'] = $m->getGenres();
                $valuesArray['vote_average'] = $m->getVoteAverge();
                $valuesArray['overview'] = $m->getOverview();
                $valuesArray['release_date'] = $m->getReleaseDate();
                array_push($array, $valuesArray);
            }

            $dataContent = json_encode($array, JSON_PRETTY_PRINT);
            file_put_contents($moviesFile, $dataContent);
        }
    /*
      Retorna un arreglo de movies seleccionadas por genero
    */
    public function GetMoviesByGenre($idGenre){
      $this->GetMoviesNowPlaying();
      $moviesByGenre = array();
      foreach($this->movies as $movie){
        $generosPelicula = $movie->getGenres();
        foreach($generosPelicula as $idGenero){
          if($idGenero == $idGenre){ #@param idGenre
            array_push($moviesByGenre, $movie);
          }
        }
      }
      return $moviesByGenre;
    }

    /*
      Si no existe la movie retorna null - no creo que pase eso ya que la logica del programa evita este tipo
      de retorno
    */
    public function getMovieById($idMovie){
      $this->GetMoviesNowPlaying();

      $i = 0;
      $flag = false;
      $return = null;

      while(($flag==false) && ($i<count($this->movies))){
        $aux = $this->movies[$i];
        if(strval($aux->getId()) == $idMovie){
          $return = $aux;
          $flag = true;
        }
        $i++;
      }
      return $return;
    }

    public function getTrailerKey($movieId){
      $trailerJson = file_get_contents(
        API_URL."{$movieId}/videos?api_key=".API_KEY1."&language=en-US"
      );
      $trailerArray = ($trailerJson) ? json_decode($trailerJson, true) : array();
      return $trailerArray['results'][0]['key'];
    }

    public function GetUpcomingMovies(){
      $movies = file_get_contents(
        API_URL.'upcoming?api_key='.API_KEY1.'&language=es-ES&page=1'
      );

      $upcomingMovies = array();

      $decode = json_decode($movies, true);
      /*
          recorro el decode que tiene el arreglo asociativo con los datos de las movies accediendo al arreglo 'results' y recoriiendolo
          siendo 'results' el arreglo con todas las movies devueltas por la API
      */
      foreach($decode['results'] as $allresults){
          $movie = new Movie(
              $allresults['poster_path'],
              $allresults['backdrop_path'],
              $allresults['id'],
              $allresults['adult'],
              $allresults['original_language'],
              $allresults['original_title'],
              $allresults['genre_ids'],
              $allresults['vote_average'],
              $allresults['overview'],
              $allresults['release_date'],
          );
          array_push($upcomingMovies, $movie);
      }

      $randomUpcomingMovies = $this->RandomMovies($upcomingMovies, MOVIES_TO_DISPLAY);

      return $randomUpcomingMovies;
    }

    public function GetPopular(){
      $movies = file_get_contents(
        API_URL.'popular?api_key='.API_KEY1.'&language=es-ES&page=1'
      );

      $popularMovies = array();

      $decode = json_decode($movies, true);
      /*
          recorro el decode que tiene el arreglo asociativo con los datos de las movies accediendo al arreglo 'results' y recoriiendolo
          siendo 'results' el arreglo con todas las movies devueltas por la API
      */
      foreach($decode['results'] as $allresults){
          $movie = new Movie(
              $allresults['poster_path'],
              $allresults['backdrop_path'],
              $allresults['id'],
              $allresults['adult'],
              $allresults['original_language'],
              $allresults['original_title'],
              $allresults['genre_ids'],
              $allresults['vote_average'],
              $allresults['overview'],
              $allresults['release_date'],
          );
          array_push($popularMovies, $movie);
      }

      $randomPopularMovies = $this->RandomMovies($popularMovies, MOVIES_TO_DISPLAY);

      return $randomPopularMovies;
    }

    public function RandomMovies($array, $randomAmount){
      $randomMovies = array();
      for($i = 0; $i < $randomAmount; $i++){
        array_push($randomMovies, $this->RandomElementOfArray($array));
      }
      return $randomMovies;
    }

    public function RandomElementOfArray($array){

      $elementPosition = rand(0, count($array)-1);
      return $array[$elementPosition];
    }

    public function GetCast($movieId){
      $castJson = file_get_contents(
        API_URL."{$movieId}/credits?api_key=".API_KEY1."&language=es-ES"
      );
      $cast = array();
      $castArray = ($castJson) ? json_decode($castJson, true) : array();
      array_push($cast, $castArray['cast'][0]);
      array_push($cast, $castArray['cast'][1]);
      array_push($cast, $castArray['cast'][2]);

      return $cast;

    }

    public function ShowCastDetails($cast){
      foreach($cast as $actor){
        echo $actor['name'] . " as '" . $actor['character'] . "'<br>";
      }
    }

    public function GetRuntime($movieId){
      $movieJson = file_get_contents(
        API_URL ."{$movieId}?api_key=".API_KEY1
      );

      $movie = array();
      $movieArray = ($movieJson) ? json_decode($movieJson, true) : array();
      return $movieArray["runtime"];
    }


  }
?>

<!-- Example of MOVIES NOW PLAYING json
{
  "results": [
        {
            "popularity": 232.89,
            "vote_count": 38,
            "video": false,
            "poster_path": "/gizz5FphOtfSnLaGpRALOZgILd5.jpg",
            "id": 530723,
            "adult": false,
            "backdrop_path": "/kriOlxu4KVEjd0ZaY3dW7YYyP4z.jpg",
            "original_language": "en",
            "original_title": "Bad Education",
            "genre_ids": [
                35,
                18,
                10770
            ],
            "title": "Bad Education",
            "vote_average": 6.9,
            "overview": "A superintendent of a school district works for the betterment of the student’s education when an embezzlement scheme is discovered, threatening to destroy everything.",
            "release_date": "2020-09-23"
        },
        {
            "popularity": 204.82,
            "vote_count": 982,
            "video": false,
            "poster_path": "/7G2VvG1lU8q758uOqU6z2Ds0qpA.jpg",
            "id": 499932,
            "adult": false,
            "backdrop_path": "/rUeqBuNDR9zN6vZV9kpEFMtQm0E.jpg",
            "original_language": "en",
            "original_title": "The Devil All the Time",
            "genre_ids": [
                80,
                18,
                53
            ],
            "title": "The Devil All the Time",
            "vote_average": 7.4,
            "overview": "In Knockemstiff, Ohio and its neighboring backwoods, sinister characters converge around young Arvin Russell as he fights the evil forces that threaten him and his family.",
            "release_date": "2020-09-11"
        }
   ],
    "page": 1,
    "total_results": 1330,
    "dates": {
        "maximum": "2020-10-10",
        "minimum": "2020-08-23"
    },
    "total_pages": 67
}
-->