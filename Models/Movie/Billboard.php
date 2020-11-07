<?php namespace Models\Movie;
    
    class Billboard{

        private $id;
        private $showtime;
        private $date;
        private $active;

        public function __construct($id ="", $date = ""){
            $this->id = $id;
            $this->showtime = array();
            $this->date = $date;
            $this->active = 1;
        }

        public function SetId($id){$this->id = $id;}
        public function SetShowtime($showtimes){$this->showtime = $showtimes;}
        public function SetDate($date){$this->date = $date;}
        public function GetId(){return $this->id;}
        public function GetShowtime(){return $this->showtime;}
        public function GetDate(){return $this->date;}
        public function isActive(){return $this->active;}

    }
?>