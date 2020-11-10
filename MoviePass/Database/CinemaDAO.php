<?php 

    namespace Database; 

    use Database\Connection as Connection;
    use Models\Theatre\Cinema as Cinema;
    use PDOException as PDOException;

    class CinemaDAO implements ICinemaDAO{
/*
        public function __construct(){
            try{
                $con = Connection::getInstance();
                $query = 'CREATE TABLE IF NOT EXISTS 
                            cinemas(
                                cinemaId INT NOT NULL AUTO_INCREMENT, 
                                name VARCHAR(30), 
                                price VARCHAR(5), 
                                capacity VARCHAR(3), 
                                type VARCHAR(5),
                                CONSTRAINT pk_idSala PRIMARY KEY(cinemaId),
                            );';
                $con->executeNonQuery($query);
            }catch(PDOException $e){
                echo "<script>console.log('".$e->getMessage()."');</script>";
            }
        }
*/
        public function Add($cinema){
            try{
                $con = Connection::getInstance();

                $query = 'INSERT INTO cinemas(name,price,capacity,type, active) VALUES
                            (:name,:price,:capacity,:type, :active)';

                $params['name'] = $cinema->GetName();
                $params['price'] = $cinema->GetPrice();
                $params['capacity'] = $cinema->GetCapacity();
                $params['type'] = $cinema->GetType();
                $params['active'] = $cinema->GetActive();

                return $con->executeNonQuery($query, $params);
            }catch(PDOException $e){
                throw $e;
            }
        }

        public function GetAll(){
            try{
                $con = Connection::getInstance();
                $query = 'SELECT * FROM cinemas';
                $array = $con->execute($query);
                return (!empty($array)) ? $this->mapping($array) : false;
            }catch(PDOException $e){
                throw $e;
            }
        }

        public function GetAllActive(){
            try{
                $con = Connection::getInstance();
                $query = 'SELECT * FROM cinemas WHERE active = :active';
                $params['active'] = 1;
                $allActive = $con->execute($query,$params); 
                return (!empty($allActive)) ? $this->mapping($allActive) : array();
            }catch(PDOException $e){
                throw $e;
            }
        }

        public function GetCinemaById($cinemaId){
            try{
                $con = Connection::getInstance();
                $query = 'SELECT * FROM cinemas WHERE cinemaId='.$cinemaId . ";";
                $array = $con->execute($query);
                return (!empty($array)) ? $this->mapping($array) : false;
            }catch(PDOException $e){
                throw $e;
            }
        }
        
        
        public function mapping($value){
            $value = is_array($value) ? $value : [];
            $resp = array_map(function($a){
                $cinema = new Cinema(
                    $a['cinemaId'],$a['name'],$a['price'],$a['capacity'],$a['type']
                );
                return $cinema;
            },$value);
            return count($resp)>1 ? $resp : $resp[0];
        }

        public function Delete($cinemaId){
            try{
                $query = 'UPDATE cinemas SET active = 0 WHERE cinemaId = :cinemaId;';
                $con = Connection::getInstance();
                $params['cinemaId'] = $cinemaId;
                $con->executeNonQuery($query, $params);
            }catch(PDOException $e){
                echo 'Exception en Update='.$e->getMessage();
            }
        }
        
        public function Update($cinema){
            try{
                $query = 'UPDATE cinemas SET name = :name, price = :price, capacity = :capacity, type= :type WHERE cinemaId = :cinemaId;';
                $con = Connection::getInstance();
                $params['name'] = $cinema->GetName();
                $params['price'] = $cinema->GetPrice();
                $params['capacity'] = $cinema->GetCapacity();
                $params['type'] = $cinema->GetType();
                $params['cinemaId'] = $cinema->GetId();
                $con->executeNonQuery($query, $params);
            }catch(PDOException $e){
                echo 'Exception en Update='.$e->getMessage();
            }
        }
        /* 
            Se usa este metodo para insertar en la tabla salaXcine ya que como agrego en la tabla salaxcine
            luego de insertar la cinema$cinema en la base de datos este ultimo id seria el id de la cinema$cinema que quiero usar
        */
        public function GetLastId(){
            try {
                $query = 'SELECT max(cinemaId) as maximo FROM cinemas;';
                $con = Connection::getInstance();
                $cinemaId = $con->execute($query);
                //var_dump($cinemaId);
                return (!empty($cinemaId)) ? (int)$cinemaId[0]['maximo'] : -1;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function ConvertToArray($cinemasInTheatres){
            $cinemas = array();
            if(is_object($cinemasInTheatres)):
                array_push($cinemas, $cinemasInTheatres);
            else:
                return $cinemasInTheatres;
            endif;
            return $cinemas;
        }

        ////TRATAR PARA SALAXCINE////
        public function GetCinemasByTheatreId($theatreId){
            try{
                $con = Connection::getInstance();
                $query = 'SELECT s.* FROM cinemas as s JOIN cinemasXtheatres as sxc ON sxc.cinemaId = s.cinemaId AND sxc.theatreId = :theatreId AND s.active = 1';
                $params['theatreId'] = $theatreId;
                $cine = $con->execute($query, $params);
                return (!empty($cine)) ? $this->mapping($cine) : array();
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function GetActiveCinemasByTheatreId($theatreId){
            try{
                $con = Connection::getInstance();
                $query = 'SELECT s.* FROM cinemas as s JOIN cinemasXtheatres as sxc 
                                     ON sxc.cinemaId = s.cinemaId AND sxc.theatreId = :theatreId AND s.active = 1';
                $params['theatreId'] = $theatreId;
                $cine = $con->execute($query, $params);
                return (!empty($cine)) ? $this->mapping($cine) : array();
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function Add_cinemasXtheatre($cinemaId, $theatreId){
            try{
                $con = Connection::getInstance();

                $query = 'INSERT INTO cinemasXtheatres(cinemaId, theatreId) VALUES(:cinemaId, :theatreId)';

                $params['cinemaId'] = $cinemaId;
                $params['theatreId'] = $theatreId;

                return $con->executeNonQuery($query, $params); 
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        /*
            Esto retornaria solo un arreglo con los id de cinema$cinema y id de cine 
            Si es necesario que retorne un Objeto que tenga como atrib cine & cinema$cinema, hay que hacer el mapeo y hacer consultas
        */
        public function GetAll_cinemasXtheatres(){
            try {
                $con = Connection::getInstance();
                $query = 'SELECT * FROM cinemasXtheatres';
                $res = $con->execute($query);
                return (!empty($res)) ? $res : array();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function GetTheaterXCinema($cinemaId){
            try {
                $con = Connection::getInstance();
                $query = 'SELECT theatreId FROM cinemasXtheatres WHERE cinemaId= :cinemaId';
                $params['cinemaId'] = $cinemaId;
                $res = $con->execute($query,$params);
                if(is_array($res))
                {
                    $rta = array_shift($res);
                    return intval($rta);
                }else{
                    echo 'ACA MURIO CINEMADAO 211';
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        


        public function GetCinema_showtimesXcinema($showtimeId){
            try {
                $con = Connection::getInstance();
                $query = 'SELECT s.* 
                            FROM showtimesxcinemas as sxf 
                            INNER JOIN cinemas as s 
                                ON sxf.cinemaId = s.cinemaId 
                                    AND s.cinemaId = :showtimeId;';
                $params['showtimeId'] = $showtimeId;
                $cinema = $con->execute($query, $params);
                return (!empty($cinema)) ? $this->mapping($cinema) : array();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>