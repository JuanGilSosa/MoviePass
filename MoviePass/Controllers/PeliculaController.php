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
        public function ShowIndex()
        {
            require_once(FRONT_ROOT."index.php");            
        }

        public function ShowLogIn($message = "")
        {
            require_once(VIEWS_PATH."loginForm.php");            
        }

        public function ShowRegisterForm()
        {
            require_once(VIEWS_PATH."registerForm.php");
        }

        public function ShowAddCineView()
        {
            require_once(VIEWS_PATH."addCine.php");
        }

        public function ShowMoviesNowPlaying(){
            $peliculas = $this->peliculasDAO->GetAll();
            $genero = new Genero();
            $generos = $this->generosDAO->GetAll();
            require_once(VIEWS_PATH."listMovies.php");
        }

        #@param valueOfSelect tiene el id del genero
        
        public function ShowMovies($valueOfSelect=""){
            if(!$this->HayUsuario()){
                if($valueOfSelect != 0){
                    $peliculas = $this->peliculasDAO->GetMoviesByGenre($valueOfSelect);
                    $generos = $this->generosDAO->GetAll();
                    require_once(VIEWS_PATH.'listMovies.php');
                }else{
                    $this->ShowMoviesNowPlaying();
                }
            }else{
                $this->ShowLogin();
            }
        }

        public function ShowMovieDescription($idMovie){
            $pelicula = $this->peliculasDAO->getMovieById($idMovie);
            $trailerKey = $this->peliculasDAO->getTrailerKey($idMovie);
            require_once(VIEWS_PATH.'descriptionMovies.php');
        }

        #TENEMOS QUE HACER UNA INTERFAZ PARA CONTROLLER
        private function HayUsuario(){
            return (!isset($_SESSION["loggedUser"]));
        }
    }
?>