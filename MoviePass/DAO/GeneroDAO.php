<?php namespace DAO; 
    use Models\Pelicula\Genero as Genero;
    class GeneroDAO implements IDAO{
        
        private $generos;

        public function __construct(){
            $this->generos = array();
        }

        public function Add($genero){

        }
        public function Update($idGenero){

        }
        public function Delete($idGenero){

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

        public function GetAll(){
            $this->RetrieveGeneros();
            return $this->generos;
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
    }
?>