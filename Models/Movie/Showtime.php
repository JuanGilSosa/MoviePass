<?php 

    namespace Models\Movie;
   

    class Showtime
    {

        private $id;
        private $movie;
        private $startTime;
        private $endTime;
        private $releaseDate;
        private $endDate;
        private $auditorium;
        private $active;

        public function __construct($id = "",$movie="", $startTime = "", $endTime ="", $releaseDate = "", $endDate = "", $auditorium = ""){
            $this->id = $id;
            $this->movie = $movie;
            $this->startTime = $startTime;
            $this->endTime = $endTime;
            $this->releaseDate = $releaseDate;
            $this->endDate = $endDate;
            $this->auditorium = $auditorium;
            $this->active = true;
        }

        public function GetId(){return $this->id;}
        public function GetMovie(){return $this->movie;}
        public function GetStartTime(){return $this->startTime;}
        public function GetEndTime(){return $this->endTime;}
        public function GetReleaseDate(){return $this->releaseDate;}
        public function GetEndDate(){return $this->endDate;}
        public function GetAuditorium(){return $this->auditorium;}
        public function isActive(){return $this->active;}
        public function SetActive($active){$this->active = $active;}
        public function SetAuditorium($auditorium){$this->auditorium = $auditorium;}
        
    }

    

?>