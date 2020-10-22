<?php

    namespace Models\Pelicula;

    class Pelicula
    {
        private $id;
        private $poster_path;
        private $backdrop_path;
        private $adult;
        private $original_language;
        private $title;
        private $genres; #arreglo de id de generos
        private $vote_average;
        private $overview;
        private $release_date;


        public function __construct (
            $poster_path, $backdrop_path,
            $id, $adult, $original_language,
            $title, $genres, $vote_average,
            $overview, $release_date
        )
        {
            $this->poster_path = $poster_path;
            $this->backdrop_path = $backdrop_path;
            $this->id = $id;
            $this->adult = $adult;
            $this->original_language = $original_language;
            $this->title = $title;
            $this->genres = $genres;
            $this->vote_average = $vote_average;
            $this->overview = $overview;
            $this->release_date = $release_date;
        }

        public function getPosterPath(){return $this->poster_path;}
        
        public function getBackdropPath(){return $this->backdrop_path;}

        public function getId(){return $this->id;}
        
        public function isAdult(){return $this->adult;}
        
        public function getOriginalLanguage(){return $this->original_language;}
        
        public function getTitle(){return $this->title;}
        
        public function getGenres(){return $this->genres;}
        
        public function getVoteAverage(){return $this->vote_average;}
        
        public function getOverview(){return $this->overview;}
        
        public function getReleaseDate(){return $this->release_date;}
    }
    


?>