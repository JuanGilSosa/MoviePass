<?php namespace Helpers;

    class SessionHelper{

        public static function isSession($key = ""){
            if(!isset($_SESSION[$key])){
                return false;        
            }else{
                return true;
            }
        }

        public static function SetSession($key,$value){
            $_SESSION[$key] = $value;
        }

    }
?>