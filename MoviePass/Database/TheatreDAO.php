<?php 

    namespace Database;

    use Models\Theatre\Theatre as Theatre;
    use PDOException as PDOException;

    class TheatreDAO implements IDAO{
/*
        public function __construct(){
            try{
                $con = Connection::getInstance();
                $query = 'CREATE TABLE IF NOT EXISTS 
                            theatres(
                                theatreId INT NOT NULL AUTO_INCREMENT, 
                                name VARCHAR(30), 
                                email VARCHAR(30), 
                                phoneNumber VARCHAR(15), 
                                adressId INT NOT NULL, 
                                active BOOLEAN, 
                                CONSTRAINT pk_idCine PRIMARY KEY(theatreId),
                                CONSTRAINT fk_idDirecionn FOREIGN KEY(adressId) REFERENCES direccion(adressId)
                            );';

                $con->executeNonQuery($query);
            }catch(PDOException $e){
                echo "<script>console.log('".$e->getMessage()."');</script>";
            }
        }
*/
        public function GetAll(){
            try{
                $con = Connection::getInstance();
                $query = 'SELECT * FROM theatres';
                $array = $con->execute($query);
                return (!empty($array)) ? $this->mapping($array) : false;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        
        public function Add($theatre){
            try{
                $con = Connection::getInstance();

                $query = 'INSERT INTO theatres(name,email,phoneNumber,adressId,active) VALUES
                            (:name,:email,:phoneNumber,:adressId,:active)';

                $params['name'] = $theatre->GetName();
                $params['email'] = $theatre->GetEmail();
                $params['phoneNumber'] = $theatre->GetPhoneNumber();
                $params['adressId'] = $theatre->GetAdress()->GetId();
                #$params['cinemas'] = $theatre->GetSalas();
                $params['active'] = $theatre->GetActive();

                return $con->executeNonQuery($query, $params);
            }catch(PDOException $e){
                throw $e;
            }
        }

        public function mapping($value){
            $value = is_array($value) ? $value : [];
            $resp = array_map(function($a){
                $theatre = new Theatre(
                    $a['theatreID'],
                    $a['name'],
                    $a['email'],
                    $a['phoneNumber'],
                    $a['adressId'],
                    $a['active']
                );                
                return $theatre;
            },$value);
            return count($resp)>1 ? $resp : $resp[0];
        }

        public function GetAllActive(){
            try {
                $query = 'SELECT * FROM theatres WHERE active = :active';
                $con = Connection::getInstance();
                $params['active'] = 1;
                $allActive = $con->execute($query,$params); 
                return (!empty($allActive)) ? $this->mapping($allActive) : array();
            } catch (PDOException $e) {
                echo "<script>console.log('".$e->getMessage()."');</script>";
            }       
        }

        public function GetTheatreById ($theatreId){
            try {
                $query = 'SELECT * FROM theatres WHERE theatreID = :theatreID';
                $con = Connection::getInstance();
                $params['theatreID'] = $theatreId;
                
                $theatres = $con->execute($query,$params);
                return (!empty($theatres)) ? $this->mapping($theatres) : array();
            } catch (PDOException $e) {
                echo "<script>console.log('".$e->getMessage()."');</script>";
            }       
        }

        public function FindTheatreByName ($name){
            try{
                $query = 'SELECT * FROM theatres WHERE name = :name';
                $params['name'] = $name;
                $con = Connection::getInstance();
                $theatres = $con->execute($query,$params);
                return (!empty($theatres)) ? $this->mapping($theatres) : false;
            }catch(PDOException $e){    
                echo 'Excepcion en : '.$e->getMessage();
            }
        }

        public function FindTheatreByEmail ($email){
            try{
                $query = 'SELECT * FROM theatres WHERE email = :email';
                $params['email'] = $email;
                $con = Connection::getInstance();
                $theatres = $con->execute($query,$params);
                return (!empty($theatres)) ? $this->mapping($theatres) : false;
            }catch(PDOException $e){    
                echo 'Excepcion en : '.$e->getMessage();
            }
        }

        public function FindTheatreByPhoneNumber ($phoneNumber){
            try{
                $query = 'SELECT * FROM theatres WHERE phoneNumber = :phoneNumber';
                $params['phoneNumber'] = $phoneNumber;
                $con = Connection::getInstance();
                $theatres = $con->execute($query,$params);
                return (!empty($theatres)) ? $this->mapping($theatres) : false;
            }catch(PDOException $e){    
                echo 'Excepcion en : '.$e->getMessage();
            }
        }

        public function Delete($theatreId){
            try{
                $con = Connection::getInstance();
                $query = 'UPDATE theatres as c SET c.active = 0 WHERE theatreID = :theatreID';
                $params['theatreID'] = $theatreId;
                $con->executeNonQuery($query, $params);
            
            }catch(PDOException $e){
                echo 'Excepcion en : '.$e->getMessage();
            }
        }
        public function Update($theatre){
            try{
                $query = 'UPDATE theatres SET name = :name, email = :email, phoneNumber = :phoneNumber, active = :active WHERE theatreID = :theatreID;';
                $con = Connection::getInstance();
                $params['theatreID'] = $theatre->GetId();
                $params['name'] = $theatre->GetName();
                $params['email'] = $theatre->GetEmail();
                $params['phoneNumber'] = $theatre->GetPhoneNumber();
                $params['active'] = 1;
                $con->executeNonQuery($query, $params);
            }catch(PDOException $e){
                echo 'Exception en Update='.$e->getMessage();
            }
        }

        public function SetActive($theatreId){
            try{
                $query = 'UPDATE theatres SET active = 1 WHERE theatreID = ' . $theatreId .';';
                $con = Connection::getInstance();
                
                $con->execute($query);
            }catch(PDOException $ex){
                //echo 'Exception en SetActive='.$ex->getMessage(); #ESTE PRINT me tira un GENERAL ERROR pero el cine se activa igual
            }
        }
        
        public function GetTheatreById_cinemasXtheatres($theatreId){
            try{
                $con = Connection::getInstance();
                $query = 'SELECT c.* FROM theatres as c JOIN cinemasXtheatres as sxc ON sxc.theatreID = c.theatreID AND c.theatreID = :theatreId';
                $params['theatreID'] = $theatreId;
                $theatre = $con->execute($query,$params);
                return (!empty($theatre)) ? $this->mapping($theatre) : array();
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function GetTheatreByCinemaId_cinemasXtheatres($cinemaId){
            try{
                $con = Connection::getInstance();
                $query = 'SELECT c.* FROM theatres as c JOIN cinemasXtheatres as sxc ON sxc.theatreID = c.theatreID AND sxc.cinemaId = :cinemaId';
                $params['cinemaId'] = $cinemaId;
                $theatre = $con->execute($query,$params);
                return (!empty($theatre)) ? $this->mapping($theatre) : array();
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
 
        


    }
?>