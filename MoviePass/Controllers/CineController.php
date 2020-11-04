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

class CineController
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

    public function AddViewCine($message = "")
    {
        if (SessionController::HayUsuario('adminLogged')) {
            ViewsController::ShowAddCineView();
        } else {
            ViewsController::ShowLogIn();
        }
    }

    public function ListViewCine($message = "")
    {
        if (SessionController::HayUsuario('adminLogged')) {
            $cines = $this->cineDAO->GetAllActive();
            $cinesConObjetos = array();
            if ((is_array($cines))  and
                (count($cines) > 1) and
                ($cines != null)
            ) {
                foreach ($cines as $cine) {
                    $cineConObjeto = $this->CreateCine($cine);
                    array_push($cinesConObjetos, $cineConObjeto);
                }
                ViewsController::ShowCinesList($cinesConObjetos, $message);
            } else {
                if ($cines != null) {
                    $objCine = $this->CreateCine($cines);
                    array_push($cinesConObjetos, $objCine);
                }
                ViewsController::ShowCinesList($cinesConObjetos, $message);
            }
        } else {
            ViewsController::ShowLogIn();
        }
    }

    public function ShowModify($cineId, $message = "")
    {
        if (SessionController::HayUsuario('adminLogged')) {
            ViewsController::ShowModifyCine(strval($cineId), $message);
        } else {
            ViewsController::ShowLogIn();
        }
    }

    public function AddViewSala($idCine)
    {
        ViewsController::ShowAddSala($idCine);
    }

    public function ShowCartelera()
    {
        $cines = $this->cineDAO->GetAll();
        ViewsController::ShowCartelera();
    }

    public function Add(
        $nombre,
        $email,
        $numeroDeContacto,
        $calle,
        $numero,
        $piso,
        $ciudad,
        $codigoPostal,
        $idProvincia,
        $idPais
    ) {
        $message = "";
        $existeCine = $this->cineDAO->FindCineByName($nombre);

        if (!$existeCine) {
            $existeEmail = $this->cineDAO->FindCineByEmail($email);
            if (!$existeEmail) {
                $existeTelefono = $this->cineDAO->FindCineByTelefono($numeroDeContacto);

                if (!$existeTelefono) {

                    $direccion = $this->direccionDAO->CreateDireccion($calle, (int)$numero, (int)$piso, $ciudad, (int)$codigoPostal, (int)$idPais, (int)$idProvincia);

                    if (!is_string($direccion)) {

                        $existeDireccion = $this->direccionDAO->FindDireccion($direccion);

                        if (!$existeDireccion) {
                            $this->direccionDAO->Add($direccion);
                            $dirWithId = $this->direccionDAO->ChangeObjectById($direccion); #$this->direccionDAO->FindDireccion($direccion);
                            $cine = new Cine(0, $nombre, $email, (int)$numeroDeContacto, $dirWithId);
                            $this->cineDAO->Add($cine);

                            //ACA SE GUARDARIA EN TABLA CINESxLOCALIDADxDIRECCION? 

                            $message = "Cine agregado con éxito.";
                            $this->ListViewCine($message);
                        } else {                          // Direccion repetida
                            $message = "La dirección ingresada ya se encuentra registrada.";
                            ViewsController::ShowAddCineView($message);
                        }
                    } else {
                        $message = $direccion;
                        ViewsController::ShowAddCineView($message);
                    }
                } else {                              // Telefono repetido
                    $message = "El teléfono ingresado ya se encuentra registrado.";
                    ViewsController::ShowAddCineView($message);
                }
            } else {                                  // Email repetido
                $message = "El email ingresado ya se encuentra registrado.";
                ViewsController::ShowAddCineView($message);
            }
        } else {                                      // Nombre repetido
            $message = "El nombre ingresado ya se encuentra registrado.";
            ViewsController::ShowAddCineView($message);
        }
    }

    public function Update($id, $nombre, $email, $numeroDeContacto)
    {


        $cineViejo = $this->cineDAO->GetCineById(strval($id));
        $existeNombre = $this->cineDAO->FindCineByName($nombre);

        if (
            !empty($cineViejo) &&
            //strcmp($cineViejo->getNombre(), $nombre) != 0 && 
            //strcmp($cineViejo->getEmail(), $email) != 0 && 
            $cineViejo->getNombre() != $nombre ||
            $cineViejo->getEmail() != $email ||
            $cineViejo->getNumeroDeContacto() != $numeroDeContacto
        ) {
            if (!$existeNombre || $cineViejo->getNombre() == $nombre) {

                $existeEmail = $this->cineDAO->FindCineByEmail($email);

                if (!$existeEmail || $cineViejo->getEmail() == $email) {
                    $existeTelefono = $this->cineDAO->FindCineByTelefono($numeroDeContacto);
                    #echo "<script>console.log('$numeroDeContacto'); </script>";

                    if (!$existeTelefono || $cineViejo->getNumeroDeContacto() == $numeroDeContacto) {
                        $cine = new Cine($cineViejo->getId(), $nombre, $email, $numeroDeContacto, $cineViejo->getDireccion());
                        #$cine->setId($id);
                        $this->cineDAO->Update($cine);
                        $message = "Cine modificado con éxito";
                        $this->ListViewCine($message);
                    } else {
                        $message = "El teléfono ingresado ya se encuentra registrado";
                        ViewsController::ShowModifyCine($id, $message);
                    }
                } else {
                    $message = "El email ingresado ya se encuentra registrado";
                    ViewsController::ShowModifyCine($id, $message);
                }
            } else {
                $message = "El nombre ingresado ya se encuentra registrado";
                ViewsController::ShowModifyCine($id, $message);
            }
        } else {
            $this->ListViewCine();
        }
    }

    public function Delete($idCine)
    {
        $this->cineDAO->Delete($idCine);
        $message = "Cine eliminado con éxito";
        $this->ListViewCine($message);
    }

    public function CreateCine($cineMapeado)
    {
        // Busco objetoDireccion y lo seteo
        $objDireccion = $this->direccionDAO->GetDireccionById($cineMapeado->getDireccion());
        $cineMapeado->setDireccion($objDireccion);
        // Busco la ciudad y la seteo en la direccion del cine mapeado
        $objCiudad = $this->ciudadDAO->GetByCodigoPostal($objDireccion->getCiudad());
        $cineMapeado->getDireccion()->setCiudad($objCiudad);
        // Busco la provincia y la seteo en la ciudad del cine seteado
        $objProvincia = $this->provinciaDAO->GetById($objCiudad->getProvincia());
        $cineMapeado->getDireccion()->getCiudad()->setProvincia($objProvincia);
        // Busco el pais y lo seteo en la provincia del cine seteado
        $objPais = $this->paisDAO->GetById($objProvincia->getPais());
        $cineMapeado->getDireccion()->getCiudad()->getProvincia()->setPais($objPais);

        return $cineMapeado;
    }
}
