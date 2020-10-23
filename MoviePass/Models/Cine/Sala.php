<?php namespace Models\Cine;
    
    class Sala{
        
        private $id;
        private $nombre;
        private $precio;
        private $capacidad;

        public function __construct($id, $nombre, $precio, $capacidad){
            $this->id = $id;
            $this->nombre = $nombre;
            $this->precio = $precio;
            $this->capacidad = $capacidad;
        }
        
        public function getId(){return $this->id;}

        public function setNombre($nombre){$this->nombre = $nombre;}

        public function setPrecio($precio){$this->precio = $precio;}
        
        public function setCapacidad($capacidad){$this->capacidad = $capacidad;}
        
        public function getNombre(){return $this->nombre;}
        
        public function getPrecio(){$this->precio;}
        
        public function getCapacidad(){return $this->capacidad;}

    }

?>