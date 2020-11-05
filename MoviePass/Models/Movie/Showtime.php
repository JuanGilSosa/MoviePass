<?php 

    namespace Models\Movie;
   

    class Showtime
    {

        private $id;
        private $movie;
        private $startTime;
        private $endTime;
        private $auditorium;
        private $active;

        public function __construct($id = "",$movie="", $startTime = "", $endTime ="", $auditorium = ""){
            $this->id = $id;
            $this->movie = $movie;
            $this->startTime = $startTime;
            $this->endTime = $endTime;
            $this->auditorium = $auditorium;
            $this->active = true;
        }

        /**
            * ! LA LISTA DE PELICULAS TIENE QUE MOSTRAR +FUNCION, NO +CARTELERA 
            * ? se muestra vista 'agregarfuncion.php' mostrando los datos de la movie seleccionada
                // *  nombrePelicula, elegir cine, elegir dia y hora
            * ? esto lleva a 'moviepass.com/Funcion/AgregarFuncion'
            * * esta funcion ademas de crear la funcion agrega 
        */

         // TODO :  class FuncionController -> cuando se rea una funcion haria que se cree la cartelera (cartelera es de jueves a miercoles, las peliculas cambian los jueves)
                    // * entonces el admin nunca crea carteleras, solo agrega fuciones (que se oueda elegir entre las 15 y 01
                    // * al elegir el dia de la funcion sabemos la semana que se va a mostrar, por lo tanto sabemos que cartelera sera
                    // ! al crear la funcion hay que verificar si existe la cartelera, si no al crearla buscar el jueves y el miercoles pertenecientes a la cartelera
                    // ! (si la funcion es un lunes 17, deberemos averiguar que numero de dia es el miercoles (19) y del anterior jueves para indicar las fechas de la cartelera)
                    // ? TODO : USAR DATE O TIMESTAMP
         // TODO :  class CarteleraController -> en la vista de la Cartelera hacer un filtro BuscarCarteleraPorFecha($hoy){ $cartelera = BuscarCarteleraPorFecha($hoy); } 
                    // * mostrar un select con los dias de inicio y fin de  las carteleras existentes en la vista
         // TODO :  en ViewsController agregar ShowCartelera($hoy){ $cartelera = $this->carteleraDAO->BuscarCarteleraPorFecha($hoy); } 

        public function GetId(){return $this->id;}
        public function GetMovie(){return $this->movie;}
        public function GetStartTime(){return $this->startTime;}
        public function GetEndTime(){return $this->endTime;}
        public function GetAuditorium(){return $this->auditorium;}
        public function isActive(){return $this->active;}
        public function SetActive($active){$this->active = $active;}
        public function SetAuditorium($auditorium){$this->auditorium = $auditorium;}
        
    }

    

?>