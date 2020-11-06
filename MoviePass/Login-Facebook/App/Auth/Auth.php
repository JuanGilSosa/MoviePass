<?php

	use Database\Connection as Connection;

	class Auth{

		protected static $miServicio = "Facebook"; #servicio que se va a utilizar
		
		protected static function issetRequest(){
			$isRequest = false;
			if(isset($_GET['login'])){
				#compruebo que la request sea facebook
				if(strcasecmp($_GET['login'],self::$miServicio)==0){
					$isRequest = true;
				}
			}
			return $isRequest;
		}
		#una vez que el usuario de permiso a la aplicacion para acceder, vamos a obtener los datos del usuario
		public static function getUserAuth(){
			if(self::issetRequest()){
				$service = $_GET['login'];
				$hybridAuth = new Hybrid_Auth(__DIR__ . '\config.php');#recibe la config de facebook especificada en config.php, el constructor
				$adapter = $hybridAuth->authenticate($service);/*
				->authenticate() permite autenticar en el servicio en el que el usuario esta procesando
					la peticion
				*/
				try{
					$userProfile = $adapter->getUserProfile();
					self::insertUser($userProfile);
					return $userProfile;
				}catch(Exception $e){
					echo "Hay un error en : " . $e->getMessage();
     				echo " Error code: " . $e->getCode();
				}
				//redirect user
				#self::login($userProfile);
				#header('Location: index.php');
				
				die();
			}
		}
		public static function login($user){
			$_SESSION['fb_user'] = $user;
		}
		public static function isLogin(){
			$ret = (bool) isset($_SESSION['fb_user']);
			return $ret;
		}
		public static function logout(){
			if(self::isLogin()){
				unset($_SESSION['fb_user']);
			}
		}
		
		private static function insertUser($user){
			try{
				$con = Connection::getInstance();
				$query = 'INSERT INTO members(email,firstName,lastName) VALUES(:email,:firstName, :lastName)';
				$params['email'] = $user->email;
				$params['firstName'] = $user->firstName;
				$params['lastName'] = $user->lastName;
				$con->executeNonQuery($query, $params);
			}catch(PDOException $e){
				echo $e->getMessage();
			}		
		}

		private static function existsUser($obj){
			try {
				$con = Connection::getInstance();
				$query = 'SELECT email FROM member WHERE email = :email';
				$params['email'] = $obj->email;
				$con->execute($query, $params);
				
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		}
	}
 ?>
