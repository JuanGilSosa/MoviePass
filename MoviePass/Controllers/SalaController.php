<?php

namespace Controllers;

use Models\Cine\Cine as Cine;
/*
    use DAO\CineDAO as CineDAO;
    use DAO\DireccionDAO as DireccionDAO;
    use DAO\CiudadDAO as CiudadDAO;
    use DAO\ProvinciaDAO as ProvinciaDAO;
    use DAO\PaisDAO as PaisDAO;
    use DAO\SalaDAO as SalaDAO;
*/
use Database\Connection as Connection;
use Database\CineDAO as CineDAO;
use Database\DireccionDAO as DireccionDAO;
use Database\CiudadDAO as CiudadDAO;
use Database\ProvinciaDAO as ProvinciaDAO;
use Database\PaisDAO as PaisDAO;
use Database\SalaDAO as SalaDAO;
//use Database\salaXcineDAO as salaXcineDAO;

use Models\Ubicacion\Direccion as Direccion;
use Models\Ubicacion\Ciudad as Ciudad;
use Models\Ubicacion\Provincia as Provincia;
use Models\Ubicacion\Pais as Pais;
use Models\Cine\Sala as Sala;
use PDOException as PDOException;

class SalaController
{
    private $cineDAO;
    private $salaDAO;
    private $direccionDAO;
    private $ciudadDAO;
    private $provinciaDAO;
    private $paisDAO;
   // private $salaxcineDAO;
    public function __construct()
    {
        $this->cineDAO = new CineDAO();
        $this->salaDAO = new SalaDAO();
        $this->direccionDAO = new DireccionDAO();
        $this->ciudadDAO = new CiudadDAO();
        $this->provinciaDAO = new ProvinciaDAO();
        $this->paisDAO = new PaisDAO();
       // $this->salaxcineDAO = new salaXcineDAO();
    }

    public function AddViewSala($idCine)
    {
        ViewsController::ShowAddSala($idCine);
    }

    public function ShowSalasPorCine($idCine)
    {
        
        ViewsController::ShowSalasPorCine($idCine);
    }

    public function AddSala($idCine = "", $nombre = "", $tipo = "", $precio = "", $capacidad = "")
    {
        try{
            $cine = $this->cineDAO->getCineById($idCine);
            if (!is_null($cine)) {
                if ($this->FindSalaByNombre($cine, $nombre) == 0) {
                    $sala = new Sala(0, $nombre, $precio, $capacidad, $tipo);
                    $salas = $cine->getSalas();
                    array_push($salas, $sala);
                    $cine->setSalas($salas);
                    #deber de modificar donde esta el cine {hacer update}
                    $this->salaDAO->Add($sala);
                    
                    $lastIdSala = $this->salaDAO->GetLastId(); #uso esto porque como el objeto tiene 0 - no sirve
                    $idCine = $cine->getId();

                    $this->salaDAO->Add_SALAXCINE($lastIdSala, $idCine);

                    $cineController = new CineController();
                    $cineController->ListViewCine();
                } else {
                    #Es porque la sala existe 
                }
            }
        }catch (PDOException $ex){
            
        }
    }

    public function FindSalaByNombre($cine, $nombreSala)
    {
        $existe = 0;
        $salas = $cine->getSalas();
        if (is_array($salas)) {
            foreach ($salas as $sala) {
                if (strcasecmp($sala->getNombre, $nombreSala)) {
                    $existe = 1;
                    break;
                }
            }
        }
        return $existe;
    }
}
