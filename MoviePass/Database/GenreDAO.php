<?php

namespace Database;

use Models\Movie\Genre as Genre;
use PDOException as PDOException;

class GenreDAO implements IGenreDAO
{

    private $genres;

    public function __construct()
    {
        $this->genres = array();
    }

    public function Add($genres)
    {
    }
    public function Update($genreId)
    {
    }
    public function Delete($genreId)
    {
    }

    public function mapping($value)
    {
    }

    /*
                Nota: getGenresNamesById - ShowGenres - getGenreNameById se usan en la linea 53 de la vista 
                listMovies.php para mostrar los genres de la pelicula
        */
    /*	
			Este metodo retorna un string con los genres ordenados respectivamente al arreglo de ids pasados por parametro
			@param genreId es el arreglo con los id de los genres
        */
    public function GetGenresNamesById($genreId)
    {
        $genres = file_get_contents(
            'https://api.themoviedb.org/3/genre/movie/list?api_key=48621040dbb9c7f28355bff08c002197&language=es-ES'
        );
        $genresJson = ($genres) ? json_decode($genres, true) : array();
        $genresStringArray = array();
        /*
				Esta fue  la forma mas optima de buscar y extraer el string de genres a un arreglo
				Siendo que lo primero que hacemos es obtener el primer elemento del @param $genreId y 
				hasta no encontrarlo en la lista de genres traido de la API no avanza. 
				Preferi hacerlo asi para que sea mas optima la busqueda, ya que si recorremos el array $genreId
				y dejamos fijo la lista de genres traida de la API puede dar la posibilidadque nos encontremos con
				mas iteraciones en el caso que las id de $genreId esten al final de la lista traida de la API.

				Simplemente para que consuma menos memoria. Puede pasar lo contrario pero son menos posibilidades
			*/
        $i = 0;
        while ($i < count($genreId)) {
            array_push($genresStringArray, $this->GetGenreNameById($genresJson, $genreId[$i]));
            $i++;
        }
        return $genresStringArray;
    }

    public function ShowGenres($stringGenres)
    {
        for ($i = 0; $i < count($stringGenres); $i++) {
            echo $stringGenres[$i] . '<br>';
        }
    }

    public function GetGenreNameById($jsonGenres, $idGenre): ?string
    {
        $stringOfGenre = "";
        foreach ($jsonGenres['genres'] as $g) { #$g tendria, por ej.: id": 28,"name": "Action"
            if ($g['id'] == $idGenre) {
                $stringOfGenre = $g['name'];
            }
        }
        return $stringOfGenre;
    }

    private function RetrieveGenres()
    {
        $genres = file_get_contents(
            'https://api.themoviedb.org/3/genre/movie/list?api_key=48621040dbb9c7f28355bff08c002197&language=es-ES'
        );

        $jsonGenres = ($genres) ? json_decode($genres, true) : array();
        foreach ($jsonGenres['genres'] as $g) {
            $genre = new Genre();
            $genre->SetGenre($g['name']);
            $genre->SetId($g['id']);
            array_push($this->genres, $g);
        }
    }

    public function GetAll()
    {
        $this->RetrieveGenres();
        return $this->genres;
    }

    public function SaveGenero($genres)
    {
        $count = 0;
        while ($count < count($genres)) {
            $genre = new Genre($genres[$count]["id"], $genres[$count]["name"]);
            array_push($this->genres, $genre);
            $count++;
        }
    }

    public function GetGenresFromMoviesNowPlaying($movies)
    {
        $this->RetrieveGenres();
        $activeGenres = array();
        $genresIds = array();

        foreach ($movies as $movie) {
            $movieGenres = $movie->GetGenres();
            foreach ($movieGenres as $genre) {
                array_push($genresIds, $genre);
            }
        }

        $result = array_unique($genresIds);
        $activeGenres = $this->FilterGenres($result);
        //var_dump($activeGenres);
        return $activeGenres;
    }

    public function FilterGenres($genresIds)
    {
        $genres = array();

        foreach ($this->genres as $genre) {
            foreach ($genresIds as $genreId) {
                //var_dump($genre);
                if ($genre['id'] == $genreId) {
                    array_push($genres, $genre);
                    break;
                }
            }
        }
        return $genres;
    }

    public function Add_genresXmovies($genreId, $movieId)
    {
        try {
            $con = Connection::getInstance();

            $query = 'INSERT INTO genrexmovies(genreId, movieId) VALUES
                            (:genreId,:movieId)';

            $params['genreId'] = $genreId;
            $params['movieId'] = $movieId;

            return $con->executeNonQuery($query, $params);
        } catch (PDOException $e) {
            throw $e;
        }
    }
}
