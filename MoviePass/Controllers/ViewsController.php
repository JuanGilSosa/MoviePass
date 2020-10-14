<?php

    namespace Controllers;

    class ViewsController
    {

        
        public function ShowIndex()
        {
            require_once(FRONT_ROOT."index.php");            
        }

        public function ShowLogIn()
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

        public function ShowCinesList()
        {
            require_once(VIEWS_PATH."cinesList.php");
        }

        public function ShowMoviesListView()
        {
            require_once(VIEWS_PATH."moviesList.php");
        }

    }

?>