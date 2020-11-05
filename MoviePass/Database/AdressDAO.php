<?php

namespace Database;

use Models\Location\Adress as Adress;
use PDOException as PDOException;

class DireccionDAO implements IDAO
{
    /*
        public function __construct(){
            try{
                $con = Connection::getInstance();
                $query = 'CREATE TABLE IF NOT EXISTS adresses(
                                id INT NOT NULL AUTO_INCREMENT,
                                street VARCHAR(30),
                                number VARCHAR(5),
                                floor VARCHAR(3),
                                zipCode INT,
                                CONSTRAINT pk_idDireccion PRIMARY KEY(id),
                                CONSTRAINT fk_codigoPostal FOREIGN KEY(idCiudad) REFERENCES ciudades(idCiudad)
                            )';
                $con->executeNonQuery($query);
            }catch(PDOException $e){
                echo "<script>console.log('".$e->getMessage()."');</script>";
            }
        }
*/
    function GetAll()
    {
        try {
            $con = Connection::getInstance();
            $query = 'SELECT * FROM adresses';
            $adresses = $con->execute($query);
            return $adresses;
        } catch (PDOException $e) {
            throw $e;
        }
    }
    function Add($adress)
    {
        try {
            $con = Connection::getInstance();

            $query = 'INSERT INTO adresses(street,number,floor,zipCode) VALUES
                    (:street,:number,:floor,:zipCode)';

            $params['street'] = $adress->GetStreet();
            $params['number'] = $adress->GetNumber();
            $params['floor'] = $adress->GetFloor();
            $params['zipCode'] = $adress->GetCity()->GetZipCode();
            return $con->executeNonQuery($query, $params);
        } catch (PDOException $e) {
            throw $e;
        }
    }
    function Delete($adressId)
    {
    }
    function Update($adress)
    {
    }

    function mapping($value)
    {
        $value = is_array($value) ? $value : [];
        $resp = array_map(function ($p) {
            $dir = new Adress(
                $p['id'],
                $p['street'],
                $p['number'],
                $p['floor'],
                $p['zipCode']
            );
            return $dir;
        }, $value);
        return count($resp) > 1 ? $resp : reset($resp);
    }

    public function CreateDireccion($street, $number, $floor, $idCiudad, $zipCode, $countryId, $provinceId)
    {

        $countryDAO = new CountryDAO();
        $country = $countryDAO->GetById($countryId);
        if ($country != false) {
            $provinceDAO = new ProvinceDAO();
            $province = $provinceDAO->GetById($provinceId);
            if ($province != false) {
                $province->SetCountry($country); #haciendo esto, estamos sacando el id que tiene y le asignamos un objeto
                $cityDAO = new CityDAO();
                $city = $cityDAO->GetByZipCode($zipCode);
                if ($city != false) {
                    $city->SetProvince($province); #mesmo - cambio el id por el objeto
                    $adress = new Adress($this->GetLastId(), $street, $number, $floor, $city);
                    return $adress;
                } else {
                    return ("Codigo Postal equivocado, intente nuevamente.");
                }
            } else {
                return ("No encontramos la province en nuestra base de datos");
            }
        } else {
            return ("No encontramos el country en nuestra base de datos");
        }
    }


    public function FindAdress($adressParam)
    {

        $city = $adressParam->GetCity();
        $cityDAO = new CityDAO();

        if ($cityDAO->GetByZipCode($city->GetZipCode())) {
            $provinceDAO = new ProvinceDAO();
            $province = $city->GetProvince();

            if ($provinceDAO->GetByName($province->getNameProvincia())) {

                $country = $province->GetCountry();
                $countryDAO = new CountryDAO();

                if ($countryDAO->GetByName($country->getNamePais())) {

                    $adressesByZipCode = $this->GetAllByZipCode($city->GetZipCode());

                    if ($adressesByZipCode != false) {
                        foreach ($adressesByZipCode as $adress) {
                            if (
                                ($adress->GetStreet() == $adressParam->GetStreet()) &&  //adress = adress?
                                ($adress->GetNumber() == $adressParam->GetNumber()) &&
                                ($adress->GetFloor() == $adressParam->GetFloor())
                            ) {
                                $zipCodeSTR = $adress->GetCity()->GetZipCode();
                                $adress->GetCity()->SetZipCode((int)$zipCodeSTR);
                                return $adress;
                            }
                        }
                    }
                }
            }
        }
        return false;
    }

    public function ChangeObjectById($adress)
    {
        $cityDAO = new CityDAO();
        $city = $cityDAO->GetByZipCode($adress->GetCity()->GetZipCode());

        if ($city != false) {
            $adress->SetCity($city);
            return $adress;
        }
    }

    public function GetAllByZipCode($zipCode)
    {
        try {
            $query = 'SELECT * FROM adresses WHERE zipCode = :zipCode';
            $params['zipCode'] = (int)$zipCode;
            $con = Connection::getInstance();
            $adresses = $con->execute($query, $params);
            return (!empty($adresses)) ? $this->mapping($adresses) : false;
        } catch (PDOException $e) {
            echo "<script>console.log('" . $e->getMessage() . "');</script>";
        }
    }

    private function GetLastId(): ?int
    {
        try {
            $con = Connection::getInstance();
            #$query = 'SELECT @@identity AS id';
            $query = 'SELECT MAX(d.id) as lastID FROM adresses as d;';
            $id = $con->execute($query);

            $ID = ($id[0]['lastID'] == null) ? 1 : (int)$id[0]['lastID'];

            return ($con->rowsOfTable('adresses') > 0) ? $ID + 1 : 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function GetAdressById($id)
    {
        try {
            $query = 'SELECT * FROM adresses WHERE id = :id';
            $params['id'] = $id;
            $con = Connection::getInstance();
            $adress = $con->execute($query, $params);
            return (!empty($adress)) ? $this->mapping($adress) : array();
        } catch (PDOException $e) {
            echo "<script>console.log('" . $e->getMessage() . "');</script>";
        }
    }
    
}
