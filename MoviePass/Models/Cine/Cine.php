<?php

    namespace Models\Cine;

    use Models\Ubicacion\Direccion as Direccion;
    use Models\Ubicacion\Localidad as Localidad;
    use Models\Pelicula\Billboard as Billboard;
    class Cine 
    {
        private $id;
        private $nombre;
        private $email;
        private $numeroDeContacto;
        private $direccion; 
        /** @var array || null */
        private $salas;
        private $billboard;
        private $active;

        public function __construct($id = "", $nombre = "", $email = "", $numeroDeContacto = "", $direccion="")
        {
            
            $this->id = strval($id);
            $this->nombre = $nombre;
            $this->email = $email;
            $this->numeroDeContacto = $numeroDeContacto;
            $this->direccion = $direccion;
            $this->salas = array();
            $this->active = true;
            $this->billboard = new Billboard();
        }

        public function getId(){
            return $this->id;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getEmail(){
            return $this->email;
        }

        public function getNumeroDeContacto(){
            return $this->numeroDeContacto;
        }

        public function getDireccion(){
            return $this->direccion;
        }

        public function getSalas(){
            return $this->salas;
        }

        public function getActive(){
            return $this->active;
        }

        public function getBillboard(){
            return $this->billboard;
        }
        
        public function setId($id){
            $this->id = $id;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

        public function setEmail($email){
            $this->email = $email;
        }

        public function setNumeroDeContacto($numeroDeContacto){
            $this->numeroDeContacto = $numeroDeContacto;
        }

        public function setDireccion($direccion){
            $this->direccion = $direccion;
        }
        public function setSalas($salas){
            $this->salas = $salas;
        }
        public function setActive($active)
        {
            $this->active = $active;
        }
        public function setBillboard($billboard){
            $this->billboard = $billboard;
        }


    }


?>
