<?php 

    namespace Models\Pelicula\Pelicula;
    namespace Models\Cine\Sala;

    class Funcion{

        private $id;
        /** @var Pelicula || null */
        private $pelicula;
        private $horaInicio;
        private $horaFin;
        /** @var Sala || null */
        private $sala;

        public function __construct($id = "",$pelicula="", $horaInicio = "", $horaFin ="", $sala = ""){
            $this->id = $id;
            $this->pelicula = $pelicula;
            $this->horaInicio = $horaInicio;
            $this->horaFin = $horaFin;
            $this->sala = $sala;
        }

        /**
            * ! LA LISTA DE PELICULAS TIENE QUE MOSTRAR +FUNCION, NO +CARTELERA 
            * ? se muestra vista 'agregarfuncion.php' mostrando los datos de la pelicula seleccionada
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

        public function getId(){return $this->id;}
        public function getPelicula(){return $this->pelicula;}
        public function getHoraInicio(){return $this->horaInicio;}
        public function getHoraFin(){return $this->horaFin;}
        public function getSala(){return $this->sala;}
        
    }

    

?>