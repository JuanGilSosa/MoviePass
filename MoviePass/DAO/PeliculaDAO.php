<?php 
    namespace DAO;
    use Models\Pelicula\Pelicula as Pelicula;
    use Models\Pelicula\Genero as Genero;
	use Models\Pelicula\DescripcionPelicula as DescripcionPelicula;
	
    class PeliculaDAO implements IDAO{

        protected $peliculas;
        protected $generos;

        public function __construct(){
            $this->peliculas = array();
            $this->generos = array();
        }

        public function GetAll(){
            $this->GetMoviesNowPlaying();
            return $this->peliculas;
        }

        public function Add($pelicula){
            $this->GetMoviesNowPlaying();
            array_push($this->peliculas, $pelicula);
            #$this->SaveData();
        }

        public function Delete($idPelicula){
        
        }
        public function Update($pelicula){

        }

        

        public function GetMovieById($idMovie)
        {
            /*$result = file_get_contents('https://api.themoviedb.org/3/movie/' . $idMovie .'?api_key=48621040dbb9c7f28355bff08c002197&language=es-ES');

            //https://image.tmdb.org/t/p/w500/aKx1ARwG55zZ0GpRvU2WrGrCG9o.jpginicio de url para recuperar fotos

            $decode = ($result) ? json_decode($result, true):array();
            if(!empty($decode)){
              $pelicula = new Pelicula(
                $decode['poster_path'],
                $decode['id'],
                $decode['adult'],
                $decode['original_language'],
                $decode['original_title'],
                $decode['genres'],
                $decode['vote_average'],
                $decode['overview'],
                $decode['release_date'],
              );
              $this->SaveGenero($pelicula->getGenres());
            }
            

            return $pelicula;
            */
        }

        

        private function GetMoviesNowPlaying(){
            /*
                example of how to get a json :: https://developers.themoviedb.org/3/movies/get-now-playing  section Try It out
                --example of json--see footer of this file
            */    
            /*    
                Asi descargo cosas. Por ejemplo, si es $var = file_get_contents("https://google.com"); descarga la estructura de google y la muestro
                con un echo $var;
                En este caso si se lee la documentacion("example of how to get a json::")en la seccion Try It out(al lado de Definition),
                y ponemos nuestra key en api_key, presionamos SEND REQUEST muestra un json, siendo que el LINK que aparece al lado del button que envia 
                el request es el que utilizaremos para obtener la lista de peliculas

                Todo este proceso es similar para obtener los generos
            */
            $peliculas = file_get_contents(
                'https://api.themoviedb.org/3/movie/now_playing?api_key=48621040dbb9c7f28355bff08c002197&language=es-ES&page=1'
            );
			
            $decode = json_decode($peliculas, true);
            /*
                recorro el decode que tiene el arreglo asociativo con los datos de las peliculas accediendo al arreglo 'results' y recoriiendolo
                siendo 'results' el arreglo con todas las peliculas devueltas por la API
            */
            foreach($decode['results'] as $allresults){
                $movie = new Pelicula(
                    $allresults['poster_path'],
                    $allresults['id'],
                    $allresults['adult'],
                    $allresults['original_language'],
                    $allresults['original_title'],
                    $allresults['genre_ids'],
                    $allresults['vote_average'],
                    $allresults['overview'],
                    $allresults['release_date'],
                );
                array_push($this->peliculas, $movie);
            }
		}
		
        private function SaveMovieAndGenre(){
            $moviesFile = 'Data\moviesBackup.json';
            $genresFile = 'Data\genresBackup.json';
            
            $movies = array();
            
            foreach($this->peliculas as $m){
                $valuesArray['poster_path'] = $m->getPosterPath();
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


        public function SaveGenero($generos){

            $count = 0;
            while($count < count($generos))
            {
                $genero = new Genero($generos[$count]["id"], $generos[$count]["name"]);
                array_push($this->generos, $genero);
                $count++;
            }
        }
		

    /*
        Nota: getGenresNamesById - ShowGenres - getGenreNameById se usan en la linea 53 de la vista 
                listMovies.php para mostrar los generos de la pelicula
    */
    /*	
			Este metodo retorna un string con los generos ordenados respectivamente al arreglo de ids pasados por parametro
			@param idGenres es el arreglo con los id de los generos
    */
		public function getGenresNamesById($idGenres){
			$generos = file_get_contents(
				'https://api.themoviedb.org/3/genre/movie/list?api_key=48621040dbb9c7f28355bff08c002197&language=es-ES'	
			);
			$jsonGeneros = ($generos) ? json_decode($generos, true) : array();
			$arrayStringGeneros = array();
			/*
				Esta fue  la forma mas optima de buscar y extraer el string de generos a un arreglo
				Siendo que lo primero que hacemos es obtener el primer elemento del @param $idGenres y 
				hasta no encontrarlo en la lista de generos traido de la API no avanza. 
				Preferi hacerlo asi para que sea mas optima la busqueda, ya que si recorremos el array $idGenres
				y dejamos fijo la lista de generos traida de la API puede dar la posibilidadque nos encontremos con
				mas iteraciones en el caso que las id de $idGenres esten al final de la lista traida de la API.

				Simplemente para que consuma menos memoria. Puede pasar lo contrario pero son menos posibilidades
			*/
			$i = 0;
			while($i < count($idGenres)){
				array_push($arrayStringGeneros, $this->getGenreNameById($jsonGeneros,$idGenres[$i]));
				$i++;
			}
			return $arrayStringGeneros;
    }
    
		public function ShowGenres($stringGenres){
			for($i = 0;$i<count($stringGenres);$i++){
				echo '<br>'.$stringGenres[$i];
			}	
		}
    
		public function getGenreNameById($jsonGenres, $idGenre):?string{
			$stringOfGenre = "";
			foreach($jsonGenres['genres'] as $g){#$g tendria, por ej.: id": 28,"name": "Action"
				if($g['id'] == $idGenre){
					$stringOfGenre = $g['name'];
				}
			}
			return $stringOfGenre;
		}

    /*
      Retorna un arreglo de peliculas seleccionadas por genero
    */
    public function GetMoviesByGenre($idGenre){
      $this->GetMoviesNowPlaying();
      $moviesByGenre = array();
      foreach($this->peliculas as $pelicula){
        $generosPelicula = $pelicula->getGenres();
        foreach($generosPelicula as $idGenero){
          if($idGenero == $idGenre){ #@param idGenre
            array_push($moviesByGenre, $pelicula);
          }
        }
      }
      return $moviesByGenre;
    }
    /*
      Hacer DAO de generos
    */
    private function RetrieveGeneros(){
      $generos = file_get_contents(
				'https://api.themoviedb.org/3/genre/movie/list?api_key=48621040dbb9c7f28355bff08c002197&language=es-ES'	
      );
      
      $jsonGenres = ($generos) ? json_decode($generos, true) : array();
      foreach($jsonGenres['genres'] as $g){
        $genre = new Genero();
        $genre->setGenero($g['name']);
        $genre->setId($g['id']);
        array_push($this->generos, $g);
      }
    }
    public function GetAllGenres(){
      $this->RetrieveGeneros();
      return $this->generos;
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

/**********example of MOVIE DESCRIPTION json************* */


{
  "adult": false,
  "backdrop_path": "/kriOlxu4KVEjd0ZaY3dW7YYyP4z.jpg",
  "belongs_to_collection": null,
  "budget": 0,
  "genres": [
    {
      "id": 35,
      "name": "Comedia"
    },
    {
      "id": 18,
      "name": "Drama"
    },
    {
      "id": 10770,
      "name": "Película de TV"
    }
  ],
  "homepage": "https://www.hbo.com/movies/bad-education",
  "id": 530723,
  "imdb_id": "tt8206668",
  "original_language": "en",
  "original_title": "Bad Education",
  "overview": "Frank Tassone, uno de los superintendentes más destacados del distrito escolar de Roslyn en Nueva York se desvive a diario para que la educación de sus alumnos sea la mejor. Pero de forma paralela, este se lucra con dinero público para llevar una vida llena de lujos. Así, Tassone y su personal, amigos y familiares, se convierten en los principales sospechosos del mayor escándalo de malversación de fondos ocurrido en una escuela pública de toda la historia de los Estados Unidos.",
  "popularity": 232.89,
  "poster_path": "/57H8KjN5qHYJjaq5SaUPsuVypPh.jpg",
  "production_companies": [
    {
      "id": 99963,
      "logo_path": "/wi5JP4jpVBeb9qK97nhICkMurNZ.png",
      "name": "Sight Unseen Pictures",
      "origin_country": "US"
    },
    {
      "id": 7625,
      "logo_path": "/kzq4ibnNeZrp00zpBWv3st1QCOh.png",
      "name": "Automatik Entertainment",
      "origin_country": "US"
    },
    {
      "id": 7429,
      "logo_path": "/6in9uMqxXEHx5XgYgkeRBpZ4rPw.png",
      "name": "HBO Films",
      "origin_country": "US"
    },
    {
      "id": 132844,
      "logo_path": null,
      "name": "Slater Hall Pictures",
      "origin_country": ""
    }
  ],
  "production_countries": [
    {
      "iso_3166_1": "US",
      "name": "United States of America"
    }
  ],
  "release_date": "2020-09-23",
  "revenue": 0,
  "runtime": 108,
  "spoken_languages": [
    {
      "iso_639_1": "en",
      "name": "English"
    }
  ],
  "status": "Released",
  "tagline": "Algunas personas aprenden de manera difícil.",
  "title": "La estafa (Bad Education)",
  "video": false,
  "vote_average": 6.9,
  "vote_count": 38
}

-->

<!--
        /!**** ESTAS FUNCIONES HACEN LO MISMO QUE EL CODIGO DEL DAO *****!/


        function GetMoviesPlaying(){
            
            $get_data = $this->callAPI('GET', 'https://api.themoviedb.org/3/movie/now_playing?api_key=a67565019e2b3ed72b43911ab7692772&language=es-AR', false);
            $response = json_decode($get_data, true);
            //$errors = $response['response']['errors'];
            $data = $response['results'];

            return $data;
            
        }

        function GetMovieById($idMovie){

            $get_data = $this->callAPI('GET', 'https://api.themoviedb.org/3/movie/' . $idMovie .'?api_key=a67565019e2b3ed72b43911ab7692772&language=es-AR', false);
            $response = json_decode($get_data, true);
            //$errors = $response['response']['errors'];
            $data = $response;

            return $data;
        }

        function callAPI($method, $url, $data){
            $curl = curl_init();
            switch ($method){
               case "POST":
                  curl_setopt($curl, CURLOPT_POST, 1);
                  if ($data)
                     curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                  break;
               case "PUT":
                  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                  if ($data)
                     curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
                  break;
               default:
                  if ($data)
                     $url = sprintf("%s?%s", $url, http_build_query($data));
            }
            // OPTIONS:
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
               'APIKEY: a67565019e2b3ed72b43911ab7692772',
               'Content-Type: application/json',
            ));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            // EXECUTE:
            $result = curl_exec($curl);
            if(!$result){die("Connection Failure");}
            curl_close($curl);
            return $result;
         }

-->