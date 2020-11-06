<?php namespace Database;

    use Models\Pelicula\Billboard as Billboard;

    class BillboardDAO implements IDAO{
        
        private $billboards;

        public function __construct(){
            $this->billboards = array();
        }

        public function Add($billboard){
            try {
                $con = Connection::getInstance();
                $query = 'INSERT INTO cartelera(fecha, active) VALUES(:fecha, :active)';
                $params['fecha'] = $billboard->getDate();
                $params['active'] = $billboard->isActive();
                return $con->executeNonQuery($query, $params);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    
        public function RetrieveData(){
            try {
                $con = Connection::getInstance();
                $query = 'SELECT * FROM cartelera;';
                $array = $con->execute($query);
                return (!emtpy($array)) ? $this->mapping($array) : array();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function GetAll(){
            $b = $this->RetrieveData();
            if(is_array($b)):$this->billboards = $b;
            else: array_push($this->billboards, $b);
            endif;
            return $this->billboards;
        }

        public function mapping($value){
            $value = is_array($value) ? $value : [];
            $ans = array_map(function($p){
                return new Billboard($p['idCartelera'], $p['fecha'], $p['active']);
            },$value);
        }

    }

?>