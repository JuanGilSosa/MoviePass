<?php

    namespace Models\Pelicula;

    class Genero 
    {
        private $id;
        private $genero;
    

        public function __construct($id, $genero)
        {
            $this->id = $id;
            $this->genero = $genero;
        }

        public function getId()
        {
            return $this->id;
        }

        public function getGenero()
        {
            return $this->genero;
        }

        public function setId($id)
        {
            $this->id = $id;
        }

        public function setGenero($genero)
        {
            $this->genero = $genero;
        }
    }

?>