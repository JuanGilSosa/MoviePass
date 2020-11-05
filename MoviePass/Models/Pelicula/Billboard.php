<?php namespace Models\Pelicula;
    
    class Billboard{

        private $id;
        private $functions;
        private $date;
        private $active;

        public function __construct($id ="", $functions ="", $date){
            $this->id = $id;
            $this->funciones = array();
            $this->date = $date;
            $this->active = 1;
        }

        public function setId($id){$this->id = $id;}
        public function setFunctions($functions){$this->functions = $functions;}
        public function setDate($date){$this->date = $date;}
        public function getId(){return $this->id;}
        public function getFunctions(){return $this->funciones;}
        public function getDate(){return $this->date;}
        public function isActive(){return $this->active;}

    }
?>