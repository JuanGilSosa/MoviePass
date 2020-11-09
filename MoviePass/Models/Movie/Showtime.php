<?php 

    namespace Models\Movie;
   

    class Showtime
    {

        private $id;
        private $movie;
        private $startTime;
        private $endTime;
        private $releaseDate;
        private $cinema;
        private $active;

        public function __construct($id = "",$movie="", $startTime = "", $endTime ="", $releaseDate = "", $cinema = ""){
            $this->id = $id;
            $this->movie = $movie;
            $this->startTime = $startTime;
            $this->endTime = $endTime;
            $this->releaseDate = $releaseDate;
            $this->cinema = $cinema;
            $this->active = true;
        }

        public function GetId(){return $this->id;}
        public function GetMovie(){return $this->movie;}
        public function GetStartTime(){return $this->startTime;}
        public function GetEndTime(){return $this->endTime;}
        public function GetReleaseDate(){return $this->releaseDate;}
        public function GetCinema(){return $this->cinema;}
        public function isActive(){return $this->active;}
        public function SetActive($active){$this->active = $active;}
        public function SetCinema($cinema){$this->cinema = $cinema;}
        public function SetMovie($movie){$this->movie = $movie;}

        
        public function PushCinema($cinema){
            array_push($this->cinema, $cinema);
        }
        
    }

    

?>