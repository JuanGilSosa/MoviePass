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

use Models\Ubicacion\Direccion as Direccion;
use Models\Ubicacion\Ciudad as Ciudad;
use Models\Ubicacion\Provincia as Provincia;
use Models\Ubicacion\Pais as Pais;
use Models\Cine\Sala as Sala;

class SalaController
{
    private $cineDAO;
    private $salaDAO;
    private $direccionDAO;
    private $ciudadDAO;
    private $provinciaDAO;
    private $paisDAO;

    public function __construct()
    {
        $this->cineDAO = new CineDAO();
        $this->salaDAO = new SalaDAO();
        $this->direccionDAO = new DireccionDAO();
        $this->ciudadDAO = new CiudadDAO();
        $this->provinciaDAO = new ProvinciaDAO();
        $this->paisDAO = new PaisDAO();
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

                    $cineController = new CineController();
                    $cineController->ListViewCine();
                } else {
                    #Es porque la sala existe 
                }
            }
        }catch (PDOException $ex){
            
        }
    }

    public function get_salaXcine()
    {
        try {
            $con = Connection::getInstance();

            $query = 'SELECT * FROM salaXcine';
            $salasXcines = $con->execute($query);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return $salasXcines;
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
