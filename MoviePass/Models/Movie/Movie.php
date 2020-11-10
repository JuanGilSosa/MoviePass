<?php

    namespace Models\Movie;

    class Movie
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
        private $active;


        public function __construct (
            $poster_path, $backdrop_path,
            $id, $adult, $original_language,
            $title, $genres, $vote_average,
            $overview, $release_date, $active = true
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
            $this->active = $active;
        }

        public function GetPosterPath(){return $this->poster_path;}
        
        public function GetBackdropPath(){return $this->backdrop_path;}

        public function GetId(){return $this->id;}
        
        public function isAdult(){return $this->adult;}
        
        public function GetOriginalLanguage(){return $this->original_language;}
        
        public function GetTitle(){return $this->title;}
        
        public function GetGenres(){return $this->genres;}
        
        public function GetVoteAverage(){return $this->vote_average;}
        
        public function GetOverview(){return $this->overview;}
        
        public function GetReleaseDate(){return $this->release_date;}
    
        public function isActive(){return $this->active;}
    }
    


?>