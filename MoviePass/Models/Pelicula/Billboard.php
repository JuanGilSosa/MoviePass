<?php namespace Models\Pelicula;
    
    class Billboard{

        private $functions;

        public function __construct(){
            $this->functions = array();
        }
        
        public function setFunctions($functions){$this->functions = $functions;}
        public function getFunctions(){return $this->functions;}
        public function PushFunction($function){array_push($this->functions, $function);}

    }
?>