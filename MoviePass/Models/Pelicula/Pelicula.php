<?php

    namespace Models\Pelicula;

    class Pelicula
    {
        private $id;
        private $pelicula;
        private $categoria;
        private $duracion;
        private $idGenero;


        public function __construct ($pelicula, $categoria, $duracion, $genero)
        {
            $this->pelicula = $pelicula;
            $this->categoria = $categoria;
            $this->duracion = $duracion;
            $this->genero = $genero;
        }

        public function getId()
        {
            return $this->id;
        }

        public function getPelicula()
        {
            return $this->pelicula;
        }

        public function getCategoria()
        {
            return $this->categoria;
        }

        public function getDuracion()
        {
            return $this->duracion;
        }

        public function getIdGenero()
        {
            return $this->idGenero;
        }

        public function setId($id)
        {
            $this->id = $id;
        }

        public function setPelicula($pelicula)
        {
            $this->pelicula = $pelicula;
        }

        public function setCategoria($categoria)
        {
            $this->categoria = $categoria;
        }

        public function setDuracion($duracion)
        {
            $this->duracion = $duracion;
        }

        public function setIdCategoria($idGenero)
        {
            $this->idGenero = $idGenero;
        }


    }


?>