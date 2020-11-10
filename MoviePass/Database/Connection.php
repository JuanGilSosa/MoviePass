<?php namespace Database;

use PDOException as PDOException;
	class Connection{

		private $pdo = null;
		private $pdoStatement = null;
		private static $instancia  = null;
		
		public function __construct(){
			try{	
				$this->pdo = new \PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PASS);
				$this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			}catch(Exception $e){
				throw $e;
			}
		}
		public static function getInstance(){
			return ((self::$instancia == null) ? self::$instancia = new Connection() : self::$instancia);
		}
		/*
			Se usa para insertar datos
			INSERT, UPDATE, DELETE & CREATE
		*/
		public function executeNonQuery($query, $param = array()){
			
			try{
				$this->pdoStatement = $this->pdo->prepare($query);
				
				foreach($param as $paramName => $value){
					$this->pdoStatement->bindParam(":$paramName", $param[$paramName]);
				}
				$this->pdoStatement->execute();
				
				return $this->pdoStatement->rowCount(); #esto nos devuelve la cantidad de registros afectados
			}catch(PDOException $e){
				throw $e;
			}
		}
		//Execute retorna los datos en un arreglo asociativo usa SELECT
		public function execute($query, $param = array()){
			try{
				$this->pdoStatement = $this->pdo->prepare($query);

				foreach($param as $paramName => $value){
					$this->pdoStatement->bindParam(":".$paramName, $value);
				}
				$this->pdoStatement->execute();
				#retornamos en formato de array asocitativo todos los registros que tenemos de la query
				return $this->pdoStatement->fetchAll();
			}catch(PDOException $e){
				throw $e;
			}
		}

		public function rowsOfTable($tableName){
			$query = "SELECT COUNT(*) total FROM ".$tableName;
			$result = $this->pdo->query($query);
			$total = $result->fetchColumn(); #supongo que retorna la cantidad de columnas
			return $total;
		}
	}
?>