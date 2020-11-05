<?php

    namespace Controllers;

    use Database\FunctionsDAO as FunctionsDAO;
    #use Database\CarteleraDAO as CarteleraDAO;
    use DAO\PeliculaDAO as PeliculaDAO;
    use Database\CineDAO as CineDAO;
    use Controllers\ViewsController as ViewsController;
    use Database\SalaDAO as SalaDAO;
    use Models\movie\Funcion as Funcion;

    class FuncionController{

        private $functionDAO;
        private $billboardDAO;
        private $cineDAO;
        private $movieDAO;
        private $roomDAO;

        private $cineController;

        public function __construct(){
            $this->functionDAO = new FunctionsDAO();
            //$this->carteleraDAO = new CarteleraDAO();
            $this->cineDAO = new CineDAO();
            $this->movieDAO = new PeliculaDAO();
            $this->roomDAO = new SalaDAO();
            $this->cineController = new CineController();
        }

        public function AddFuncion($idCine, $idRoom, $idMovie="", $horaInicio="", $startCartelera="", $endCartelera=""){
            if(!empty($idCine) && !empty($idRoom) && empty($idMovie) && empty($horaInicio) && empty($startCartelera) && empty($endCartelera)){
                $idMovie = $idRoom;
                $movie = $this->movieDAO->getMovieById($idMovie);
                $cine = $this->cineDAO->GetCineById($idCine);
                $rooms=$this->salaDAO->GetSalasByCineId($idCine);
                

                ViewsController::ShowAddFuncionView("", $movie->getId(), $cine, $rooms);
            }else{
                $movie = $this->movieDAO->getMovieById($idMovie);
                $duracion = $this->movieDAO->GetDuracion($idMovie);

                $segundosHoraInicio = strtotime($horaInicio);
                $segundosDuracion = $duracion*60;
                $horaFin=date("H:i",$segundosHoraInicio+$segundosDuracion);


                $cine = $this->cineDAO->GetCineById($idCine);
                $room=$this->roomDAO->GetSalaById($idRoom);

                $funcion = new Funcion(0, $movie, $horaInicio, $horaFin, $room);
                //var_dump($funcion); HASTA ACA OK

                $this->funcionDAO->Add($funcion);

                
                $lastIdFuncion = $this->funcionDAO->GetLastId(); #uso esto porque como el objeto tiene 0 - no sirve
                $idRoom = $sala->getId();

                $this->funcionDAO->Add_FUNCIONESXSALA($idRoom, $lastIdFuncion);

                ViewsController::ShowMoviesNowPlaying();

                array_push($cine->getCartelera(), $movie);
                var_dump($cine);
            }
        }

        public function ShowAddFuncion($movieId){
            $movie = $this->movieDAO->getMovieById($movieId);
            if(!is_null($movie)){
                $cines = $this->cineDAO->GetAll();
                $rooms = $this->roomDAO->GetAll();
                ViewsController::ShowAddFuncionView("", $movieId, $cines, $rooms);
            }
        }

        public function AddFunctionToBillboard($cine ,$function){
            $billboard = $cine->getBillboard();
            $billboard->PushFunction($function);
            $cine->setBillboard($billboard);
            return $cine;
        }

        

        public function ShowFunctions(){
            $cines = $this->cineDAO->GetAllActive();
            $cinemaAux = array();
            if(is_array($cines) && !empty($cines)){
                foreach ($cines as $cine) {
                    $cine = $this->cineController->CreateCine($cine);
                    $roomAux = $this->roomDAO->GetSalasByCineId($cine->getId()); #no verifico nada porque sea lo que sea, se va a setear en las salas del cine
                    $cine->setSalas($roomAux);
                    $objBillboard = $cine->getBillboard();
                    foreach($roomAux as $room){
                        $func = $this->functionDAO->GetFunction_SALAXFUNCION($room->getId());
                        var_dump($func);
                        $func->setRoom($room);
                        
                        $objBillboard->setFunctions($func);
                    }
                    $cine->setBillboard($objBillboard);
                    array_push($cinemaAux, $cine);
                }
            }else{
                if(is_object($cines)){
                    $cinemaAux = $this->cineController->CreateCine($cines);
                    $roomAux = $this->roomDAO->GetSalasByCineId($cines->getId());
                    $cinemaAux->setSalas($roomAux);
                    $objBillboard = $cinemaAux->getBillboard();
                    $arrFunctions = array();
                    foreach($roomAux as $room){
                        $func = $this->functionDAO->GetFunction_SALAXFUNCION($room->getId());
                        $func->setRoom($room);
                        $objBillboard->setFunctions($func);
                    }
                    $cinemaAux->setBillboard($objBillboard);

                }
            }

            ViewsController::ShowListFunctionsView($cinemaAux->getBillboards());   
        }

    }
        
            






    












?>