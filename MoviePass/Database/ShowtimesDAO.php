<?php namespace Database;

    use Models\Movie\Showtime as Showtime;
    use PDOException as PDOException;

    class ShowtimesDAO implements IDAO{
         
        
        /*
        public function __costruct(){
            try{
                $con = Connection::getInstance();
                $query = 'CREATE TABLE IF NOT EXISTS showtimes(
                                showtimeId INT NOT NULL AUTO_INCREMENT,
                                startTime VARCHAR(30),
                                endTime VARCHAR(30),
                                movieId INT,
                                CONSTRAINT pk_idFuncion PRIMARY KEY(showtimeId),
                                CONSTRAINT fk_idPelicula FOREIGN KEY(movieId) REFERENCES peliculas(movieId)                    
                            )';
                $con->executeNonQuery($query);
            }catch(PDOException $e){
                echo "<script>console.log('".$e->getMessage()."');</script>";
            }
        }*/

        public function GetAll(){
            try {
                $con = Connection::getInstance();
                $query = 'SELECT * FROM showtimes';
                $showtimes = $con->execute($query); 
                return (!empty($showtimes)) ? $this->mapping($showtimes) : array();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function GetAllActive(){
            try {
                $con = Connection::getInstance();
                $query = 'SELECT * FROM showtimes WHERE active = :active';
                $params['active'] = 1;
                $showtimes = $con->execute($query, $params); 
                return (!empty($showtimes)) ? $this->mapping($showtimes) : array();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function Add($funcion){
            try {
                $con = Connection::getInstance();
                $query = 'INSERT INTO showtimes(startTime, endTime, movieId, active) VALUES(:startTime, :endTime, :movieId, :active)';
                $params['startTime'] = $funcion->GetStartTime();
                $params['endTime'] = $funcion->GetEndTime();
                $params['movieId'] = $funcion->GetMovie()->GetId();
                $params['active'] = 1;
                return $con->executeNonQuery($query, $params);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function Delete($showtimeId){

        }

        public function Update($showtime){

        }

        public function GetLastId(){
            try {
                $query = 'SELECT max(showtimeId) as maximo FROM showtimes;';
                $con = Connection::getInstance();
                $showtimeId = $con->execute($query);
                //var_dump($cinemaId);
                return (!empty($showtimeId)) ? (int)$showtimeId[0]['maximo'] : -1;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function Add_showtimesXcinemas($cinemaId, $showtimeId){
            try{
                $con = Connection::getInstance();

                $query = 'INSERT INTO showtimesXcinemas(cinemaId, showtimeId) VALUES(:cinemaId, :showtimeId)';

                $params['cinemaId'] = $cinemaId;
                $params['showtimeId'] = $showtimeId;

                return $con->executeNonQuery($query, $params); 
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }


        public function mapping($value){
            $value = is_array($value) ? $value : [];
            $ans = array_map(function($p){
                return new Showtime($p['showtimeId'], $p['startTime'], $p['endTime'], null, $p['movieId'], $p['active']);
            }, $value);
            return (count($ans)>1) ? $ans : $ans[0];
        }

        public function GetShowtime_showtimesxcinema($cinemaId){
            try {
                $con = Connection::getInstance();
                $query = 'SELECT f.* 
                            FROM showtimesxcinema as sxf 
                            INNER JOIN showtimes as f 
                                ON sxf.showtimeId = f.showtimeId 
                                    AND sxf.cinemaId = :cinemaId 
                            ';
                $params['cinemaId'] = $cinemaId;
                $showtimes = $con->execute($query, $params);
                return (!empty($showtimes)) ? $this->mapping($showtimes) : array();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        
    }
?>