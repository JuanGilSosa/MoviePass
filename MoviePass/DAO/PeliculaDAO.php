<?php 
    namespace DAO;
    use Models\Pelicula\Pelicula as Pelicula;
    use PeliculasDAOAdapter as PeliculasDAOAdapter;

    class PeliculaDAO implements IDAO{

        protected $lista_peliculas;

        public function __construct(){
            $this->lista_peliculas = array();
        }

        public function GetAll(){
            $this->RetrieveData();
            return $this->lista_peliculas;
        }
        public function Add($objeto){
            $this->RetrieveData();
            array_push($this->lista_peliculas, $objeto);
            #$this->SaveData();
        }
        public function Delete($idObjeto){

        }
        public function Update($objeto){

        }

        private function RetrieveData(){
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
            $list_peliculas = file_get_contents(
                'https://api.themoviedb.org/3/movie/now_playing?api_key=48621040dbb9c7f28355bff08c002197&language=es-ES&page=1'
            );
            
            $decode = json_decode($list_peliculas, true);
            /*
                recorro el decode que tiene el arreglo asociativo con los datos de las peliculas accediendo al arreglo 'results' y recoriiendolo
                siendo 'results' el arreglo con todas las peliculas devueltas por la API
            */
            foreach($decode['results'] as $allresults){
                $movie = new Pelicula(
                    $allresults['popularity'],
                    $allresults['vote_count'],
                    $allresults['video'],
                    $allresults['poster_path'],
                    $allresults['id'],
                    $allresults['adult'],
                    $allresults['backdrop_path'],
                    $allresults['original_language'],
                    $allresults['original_title'],
                    $allresults['genre_ids'],
                    $allresults['title'],
                    $allresults['vote_average'],
                    $allresults['overview'],
                    $allresults['release_date'],
                );
                array_push($this->lista_peliculas, $movie);
            }
        }
        
        private function SaveData(){
            $file = 'Data\moviesBackup.json';
            $array = array();
            foreach($this->lista_peliculas as $m){
                $valuesArray['popularity'] = $m->getPopularity();
                $valuesArray['vote_count'] = $m->getVoteCount();
                $valuesArray['video'] = $m->isVideo();
                $valuesArray['poster_path'] = $m->getPosterPath();
                $valuesArray['id'] = $m->getId();
                $valuesArray['adult'] = $m->isAdult();
                $valuesArray['backdrop_path'] = $m->getBackdropPath();
                $valuesArray['original_language'] = $m->getOriginalLenguage();
                $valuesArray['original_title'] = $m->getOriginalTitle();
                $valuesArray['genre_ids'] = $m->getGenreIds();
                $valuesArray['title'] = $m->getTitle();
                $valuesArray['vote_average'] = $m->getVoteAverge();
                $valuesArray['overview'] = $m->getOverview();
                $valuesArray['release_date'] = $m->getReleaseDate();
                array_push($array, $valuesArray);
            }
            $dataContent = json_encode($array, JSON_PRETTY_PRINT);
            file_put_contents($file, $array);
        }
    }

?>

<!-- Example of json
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