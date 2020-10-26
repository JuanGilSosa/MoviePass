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
            ViewsController::ShowMoviesListView();
        }

        #@param valueOfSelect tiene el id del genero
        
        public function ShowMovies($valueOfSelect=""){
            if(SessionController::HayUsuario('userLogged') || SessionController::HayUsuario('adminLogged')){
                if($valueOfSelect != 0){
                    ViewsController::ShowMoviesListView($valueOfSelect);
                }else{
                    ViewsController::ShowMoviesNowPlaying();
                }
            }else{
                ViewsController::ShowLogIn();
            }
        }

        public function ShowMovieDescription(){
            if(isset($_GET['idPelicula'])){
                $idPelicula = $_GET["idPelicula"];
                $pelicula = $this->peliculasDAO->getMovieById($idPelicula);

                $trailerKey = $this->peliculasDAO->getTrailerKey($idPelicula);
             
                ViewsController::ShowMovieDescription($pelicula, $trailerKey);
            }
        }
    }
?>