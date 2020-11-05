<?php 

    namespace Database;

    use Models\Theatre\Theatre as Theatre;
    use Models\Location\Adress as Adress;
    use Database\AdressDAO as AdressDAO;
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
                    $a['theatreId'],
                    $a['name'],
                    $a['email'],
                    $a['phoneNumber'],
                    $a['adressId'],
                    array(),
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
                $query = 'SELECT * FROM theatres WHERE theatreId = :theatreId';
                $con = Connection::getInstance();
                $params['theatreId'] = $theatreId;
                
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

        public function FindTheatreByTelefono ($phoneNumber){
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
                $query = 'UPDATE theatres as c SET c.active = 0 WHERE theatreId = :theatreId';
                $params['theatreId'] = $theatreId;
                $con->executeNonQuery($query, $params);
            
            }catch(PDOException $e){
                echo 'Excepcion en : '.$e->getMessage();
            }
        }
        public function Update($theatre){
            try{
                $query = 'UPDATE theatres SET name = :name, email = :email, phoneNumber = :phoneNumber WHERE theatreId = :theatreId;';
                $con = Connection::getInstance();
                $params['theatreId'] = $theatre->GetId();
                $params['name'] = $theatre->GetName();
                $params['email'] = $theatre->GetEmail();
                $params['phoneNumber'] = $theatre->GetPhoneNumber();
                $con->executeNonQuery($query, $params);
            }catch(PDOException $e){
                echo 'Exception en Update='.$e->getMessage();
            }
        }
        
        public function GetTheatreById_SALAXCINE($theatreId){
            try{
                $con = Connection::getInstance();
                $query = 'SELECT c.* FROM theatres as c JOIN salaxcine as sxc ON sxc.theatreId = c.theatreId AND c.theatreId = :theatreId';
                $params['theatreId'] = $theatreId;
                $theatre = $con->execute($query,$params);
                return (!empty($theatre)) ? $this->mapping($theatre) : array();
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
 
        


    }
?>