<?php  namespace Controllers;
    use Models\Pelicula\Pelicula as Pelicula;
    use Models\Pelicula\Genero as Genero;
    use DAO\PeliculaDAO as PeliculaDAO;
    class PeliculaController{

        private $peliculasDAO;

        public function __construct(){
            $this->peliculasDAO = new PeliculaDAO();
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
            $generos = $this->peliculasDAO->GetAllGenres();
            require_once(VIEWS_PATH."listMovies.php");
        }

        #@param valueOfSelect tiene el id del genero
        
        public function ShowMovies($valueOfSelect=""){
            if(!$this->HayUsuario()){
                if($valueOfSelect != 0){
                    $peliculas = $this->peliculasDAO->GetMoviesByGenre($valueOfSelect);
                    $generos = $this->peliculasDAO->GetAllGenres();
                    require_once(VIEWS_PATH.'listMovies.php');
                }else{
                    $this->ShowMoviesNowPlaying();
                }
            }else{
                $this->ShowLogin();
            }
        }

        #TENEMOS QUE HACER UNA INTERFAZ PARA CONTROLLER
        private function HayUsuario(){
            return (!isset($_SESSION["loggedUser"]));
        }
    }
?>