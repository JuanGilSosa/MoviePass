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
                $query = 'INSERT INTO showtimes(startTime, endTime, movieId, releaseDate ,active) 
                VALUES(:startTime, :endTime, :movieId, :releaseDate, :active)';

                $params['startTime'] = $funcion->GetStartTime();
                $params['endTime'] = $funcion->GetEndTime();
                $params['movieId'] = $funcion->GetMovie()->GetId();
                $params['releaseDate'] = $funcion->GetReleaseDate();
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
                return new Showtime($p['showtimeId'], $p['movieId'], $p['startTime'], $p['endTime'], $p['releaseDate'],0);
            }, $value);
            return (count($ans)>1) ? $ans : $ans[0];
        }

        public function GetShowtime_showtimesxcinema($cinemaId){
            try {
                $con = Connection::getInstance();
                $query = 'SELECT f.* 
                            FROM showtimesxcinemas as sxf 
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

        public function GetShowtimeOfTheatre($theatreID){
            try {
                $con = Connection::getInstance();

                $query = 'SELECT f.* 
                            FROM showtimesxcinemas as sxf 
                            INNER JOIN cinemasxtheatres as cxt
                            ON sxf.cinemaId = cxt.cinemaId  
                            AND cxt.theatreID = :theatreID 
                            INNER JOIN showtimes as f 
                                ON sxf.showtimeId = f.showtimeId 
                            ';
                $params['theatreID'] = $theatreID;

                $showtimes = $con->execute($query, $params);
                return (!empty($showtimes)) ? $this->mapping($showtimes) : array();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function GetShowtimeById($idShowtime){
            try {
                $con = Connection::getInstance();
                $query = 'SELECT * FROM showtimes WHERE showtimeId = :showtimeId AND active = 1';
                $params['showtimeId'] = $idShowtime;
                $showtimes = $con->execute($query, $params);
                return (!empty($showtimes)) ? $this->mapping($showtimes) : array();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function GetShowtimeXMovie($movieId){
            try {
                /// Este método devuelve las funciones que tienen la película.
                $idint = intval($movieId);
                $con = Connection::getInstance();
                $query = 'SELECT * FROM showtimes WHERE active = 1 AND movieId = :movieId' ;
                //$params['active'] = 1;
                $params['movieId'] = $idint;
                //$params['releaseDate'] = $releaseDate;
                $showtimes = $con->execute($query, $params); 
                return (!empty($showtimes)) ? $this->mapping($showtimes) : array();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }


        public function GetCinemaIdxShowtimeId($showtimeId){
            try {
                $con = Connection::getInstance();
                $query = 'SELECT sxf.cinemaId 
                            FROM showtimesxcinemas as sxf 
                            WHERE showtimeId = :showtimeId'
                            ;
                $params['showtimeId'] = $showtimeId;
                $cinemaId = $con->execute($query, $params);
                
                
                return (!empty($cinemaId)) ? $cinemaId[0][0] : array();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

    }
?>