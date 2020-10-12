<?php

    namespace Models\Pelicula;

    class Pelicula
    {
        private $popularity;
        private $vote_count;
        private $video;
        private $poster_path;
        private $id;
        private $adult;
        private $backdrop_path;
        private $original_language;
        private $original_title;
        private $genre_ids; #arreglo de generos
        private $title;
        private $vote_average;
        private $overview;
        private $release_date;

        public function __construct (
            $popularity, $vote_count, $video, $poster_path,
            $id, $adult, $backdrop_path, $original_language,
            $original_title, $genre_ids, $title, $vote_average,
            $overview, $release_date
        )
        {
            $this->popularity = $popularity;
            $this->vote_count = $vote_count;
            $this->video = $video;
            $this->poster_path = $poster_path;
            $this->id = $id;
            $this->adult = $adult;
            $this->backdrop_path = $backdrop_path;
            $this->original_language = $original_language;
            $this->original_title = $original_title;
            $this->genre_ids = $genre_ids;
            $this->title = $title;
            $this->vote_average = $vote_average;
            $this->overview = $overview;
            $this->release_date = $release_date;
        }

        public function getPopularity(){return $this->popularity;}

        public function getVoteCount(){return $this->vote_count;}
        
        public function isVideo(){return $this->video;}
        
        public function getPosterPath(){return $this->poster_path;}
        
        public function getId(){return $this->id;}
        
        public function isAdult(){return $this->adult;}
        
        public function getBackdropPath(){return $this->backdrop_path;}
        
        public function getOriginalLanguage(){return $this->original_language;}
        
        public function getOriginalTitle(){return $this->original_title;}
        
        public function getGenreIds(){return $this->genre_ids;}
        
        public function getTitle(){return $this->title;}
        
        public function getVoteAverage(){return $this->vote_average;}
        
        public function getOverview(){return $this->overview;}
        
        public function getReleaseDate(){return $this->release_date;}
    }
    


?>