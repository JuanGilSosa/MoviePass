<?php
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
				$userProfile = $adapter->getUserProfile();

				//redirect user
				self::login($userProfile);

				#return $userProfile;
			}
		}
		public static function login($user){
			$_SESSION['user_fb'] = $user;
		}
		public static function isLogin(){
			$ret = (bool) isset($_SESSION['user_fb']);
			return $ret;
		}
		public static function logout(){
			if(self::isLogin()){
				unset($_SESSION['user_fb']);
			}
		}
	}
 ?>
