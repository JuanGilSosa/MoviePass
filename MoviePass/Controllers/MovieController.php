<?php  namespace Controllers;
    
    use Helpers\SessionHelper as SessionHelper;
    use Models\Movie\Movie as Movie;
    use Models\Movie\Genre as Genre;
    use Database\MoviesDAO as MoviesDAO;
    use DAO\GeneroDAO as GeneroDAO;

    class MovieController{

        private $moviesDAO;
        private $genresDAO;

        public function __construct(){
            $this->moviesDAO = new MoviesDAO();
            $this->genresDAO = new GeneroDAO();
        }
        
        public function ShowMoviesNowPlaying(){
            $movies = $this->moviesDAO->GetAll();
            $genres = $this->genresDAO->GetAll();
            ViewsController::ShowMoviesListView("",$movies,$genres);
        }

        #@param valueOfSelect tiene el id del genero
        
        public function ShowMovies($valueOfSelect=""){
            #ACA TENEMOS QUE VER SI LA LISTA DE PELICULAS SE PUEDEN VER SIN ESTAR LOGEADO O SOLAMENTE LOS ADMIN
            if(SessionHelper::isSession('userLogged') || SessionHelper::isSession('adminLogged')){
                if($valueOfSelect != 0){
                    $movies = $this->moviesDAO->GetMoviesByGenre($valueOfSelect);
                    $genres = $this->genresDAO->GetAll();
                    ViewsController::ShowMoviesListView("",$movies,$genres);
                }else{
                    ViewsController::ShowMoviesNowPlaying();
                }
            }else{
                ViewsController::ShowLogIn();
            }
        }

        public function ShowMovieDescription($movieId){
            if(isset($movieId)){
                $movie = $this->moviesDAO->GetMovieById($movieId);
                $trailerKey = $this->moviesDAO->GetTrailerKey($movieId);
             
                ViewsController::ShowMovieDescription($movie, $trailerKey);
            }else{
                ViewsController::ShowMoviesNowPlaying(); 
            }
        }
      
    }
?>