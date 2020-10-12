<?php  namespace Controllers;
    use Models\Pelicula\Pelicula as Pelicula;
    use DAO\PeliculaDAO as PeliculaDAO;
    class PeliculaController{

        private $peliDAO;

        public function __construct(){
            $this->peliDAO = new PeliculaDAO();
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

        public function ShowListMovies(){
            $lista_pelis = $this->peliDAO->GetAll();
            require_once(VIEWS_PATH."listMovies.php");
        }
    }
?>