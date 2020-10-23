<?php  namespace Controllers;
    
    use Models\Pelicula\Pelicula as Pelicula;
    use Models\Pelicula\Genero as Genero;
    use DAO\PeliculaDAO as PeliculaDAO;
    use DAO\GeneroDAO as GeneroDAO;

    class PeliculaController{

        private $peliculasDAO;
        private $generosDAO;

        public function __construct(){
            $this->peliculasDAO = new PeliculaDAO();
            $this->generosDAO = new GeneroDAO();
        }
        
        public function ShowMoviesNowPlaying(){
            $peliculas = $this->peliculasDAO->GetAll();
            $genero = new Genero();
            $generos = $this->generosDAO->GetAll();
            ViewsController::ShowMoviesListView();
        }

        #@param valueOfSelect tiene el id del genero
        
        public function ShowMovies($valueOfSelect=""){
            if(!SessionController::HayUsuario('userLogged')){
                if($valueOfSelect != 0){
                    $peliculas = $this->peliculasDAO->GetMoviesByGenre($valueOfSelect);
                    $generos = $this->generosDAO->GetAll();
                    ViewsController::ShowMoviesListView();
                }else{
                    $this->ShowMoviesNowPlaying();
                }
            }else{
                ViewsController::ShowLogIn();
            }
        }

        public function ShowMovieDescription($idMovie){
            $pelicula = $this->peliculasDAO->getMovieById($idMovie);
            $trailerKey = $this->peliculasDAO->getTrailerKey($idMovie);
            ViewsController::ShowMovieDescription();
        }
    }
?>