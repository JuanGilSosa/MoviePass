<?php namespace Controllers; 
    
    use Database\CinemaBillboardDAO as CinemaBillboardDAO;
    use Database\FunctionsDAO as FunctionsDAO;
    use Database\SalaDAO as SalaDAO;

    class CinemaBillboardController{
        
        private $cinemaListingsDAO;
        private $functionsDAO;
        private $roomDAO;

        public function __construct(){
            $this->cinemaListingsDAO = new CinemaListingsDAO();
            $this->functionsDAO = new FunctionsDAO(); 
            $this->roomDAO = new SalaDAO();
        }

        public function CreateCinemaBillboard($billboard){
            $functions = $this->functionsDAO->GetFunction_CARTELERAXFUNCION($billboard->getId());
            $rooms = $this->roomDAO->GetRoom_SALAXFUNCION($functions->getId()); #mando asi porque se que carteleraxfuncion va a retornar solo un objeto
            $functions->setRoom($rooms);
            $billboard->setFunctions($functions);
        }

    }

?>