<?php

    namespace Models\Movie;

    class Genre 
    {
        private $id;
        private $genre;
    

        public function __construct($id = "", $genre = "")
        {
            $this->id = $id;
            $this->genre = $genre;
        }

        public function GetId()
        {
            return $this->id;
        }

        public function GetGenre()
        {
            return $this->genre;
        }

        public function SetId($id)
        {
            $this->id = $id;
        }

        public function SetGenre($genre)
        {
            $this->genre = $genre;
        }
    }

?>