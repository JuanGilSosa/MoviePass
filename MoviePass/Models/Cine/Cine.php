<?php

    namespace Cine;

    use Ubicacion as Ubicacion;

    class Cine 
    {
        private $id;
        private $nombre;
        private $ubicacion;

        public function __construct($nombre = "")
        {
            $this->nombre=$nombre;
            $this->ubicacion = new Ubicacion();
        }

    }


?>