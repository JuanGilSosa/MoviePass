<?php namespace Models\Movie;
    
    class Billboard{

        private $showtimes;

        public function __construct(){
            $this->showtimes = array();
        }
        
        public function SetShowtime($showtime){$this->showtimes = $showtime;}
        public function GetShowtime(){return $this->showtimes;}
        public function PushShowtime($showtime){array_push($this->showtimes, $showtime);}

    }
?>