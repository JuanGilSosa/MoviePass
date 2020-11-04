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
            $generos = $this->generosDAO->GetAll();
            ViewsController::ShowMoviesListView($peliculas,$generos);
        }

        #@param valueOfSelect tiene el id del genero
        
        public function ShowMovies($valueOfSelect=""){
            #ACA TENEMOS QUE VER SI LA LISTA DE PELICULAS SE PUEDEN VER SIN ESTAR LOGEADO O SOLAMENTE LOS ADMIN
            if(SessionController::HayUsuario('userLogged') || SessionController::HayUsuario('adminLogged')){
                if($valueOfSelect != 0){
                    $peliculas = $this->peliculasDAO->GetMoviesByGenre($valueOfSelect);
                    $generos = $this->generosDAO->GetAll();
                    ViewsController::ShowMoviesListView($peliculas,$generos);
                }else{
                    ViewsController::ShowMoviesNowPlaying();
                }
            }else{
                ViewsController::ShowLogIn();
            }
        }

        public function ShowMovieDescription($idPelicula){
            if(isset($idPelicula)){
                $pelicula = $this->peliculasDAO->getMovieById($idPelicula);
                $trailerKey = $this->peliculasDAO->getTrailerKey($idPelicula);
             
                ViewsController::ShowMovieDescription($pelicula, $trailerKey);
            }else{
                ViewsController::ShowMoviesNowPlaying(); 
            }
        }
        
        public function getPeliculaDAO(){
            return $this->peliculasDAO;
        }
        public function getGeneroDAO(){
            return $this->generosDAO;
        }
    }
?>