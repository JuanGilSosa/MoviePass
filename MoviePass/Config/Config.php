<?php namespace Config;

define("ROOT", dirname(__DIR__) . "/");
//Path to your project's root folder
define("FRONT_ROOT", "/MoviePass/MoviePass/");
define("VIEWS_PATH", "Views/");
define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css/");
define("IMG_PATH", FRONT_ROOT.VIEWS_PATH . "img/");
define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");
define("FONTAWESOME_PATH", FRONT_ROOT.VIEWS_PATH . "fontawesome/css/all.css");
define("MDB_PATH", FRONT_ROOT.VIEWS_PATH . "BootstrapMaterialDesign/css/mdb.min.css");
define("LITY_PATH", FRONT_ROOT.VIEWS_PATH . "lity/");
//
define("API_URL", "https://api.themoviedb.org/3/movie/");
define("API_KEY1", "a67565019e2b3ed72b43911ab7692772");
define("API_KEY2", "48621040dbb9c7f28355bff08c002197");
define("REQUEST_IMG","https://image.tmdb.org/t/p/");
//
define("DB_HOST" , "localhost");
define("DB_NAME" , "moviepass");
define("DB_USER" , "root");
define("DB_PASS" , "");

define("PW_ADMIN" , "holamundo");

define("MOVIES_TO_DISPLAY", 4);
define("TIME_BETWEEN_MOVIES", 15); #in minutes

?>




