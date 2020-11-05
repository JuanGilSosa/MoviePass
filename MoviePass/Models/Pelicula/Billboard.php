<?php namespace Models\Pelicula;
    
    class Billboard{

        private $functions;
        private $date;

        public function __construct($functions ="", $date){
            $this->funciones = array();
            $this->date = $date;
        }
        
        public function setFunctions($functions){$this->functions = $functions;}
        public function setDate($date){$this->date = $date;}
        public function getFunctions(){return $this->funciones;}
        public function getDate(){return $this->date;}

    }
?>