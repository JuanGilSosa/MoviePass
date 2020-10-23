<?php namespace Controllers;
    class SessionController{

        public static function HayUsuario($key = ""){
            if(!isset($_SESSION[$key])){
                return false;        
            }else{
                return true;
            }
        }

        public static function setOnSession($key,$value){
            $_SESSION[$key] = $value;
        }

    }
?>