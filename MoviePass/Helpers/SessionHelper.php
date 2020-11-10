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

        public static function SetOnIndex($key, $index, $value){
            $_SESSION[$key][$index] = $value;
        }

        public static function LengthOfKey($key){
            return count($_SESSION[$key]);
        }

        public static function GetValue($key){
            return (isset($_SESSION[$key])) ? $_SESSION[$key] : array();
        }

        public static function DestroySession($key){
            unset($_SESSION[$key]);
        }

        public static function UnsetValue($key, $index){
            unset($_SESSION[$key][$index]);
        }

    }
?>