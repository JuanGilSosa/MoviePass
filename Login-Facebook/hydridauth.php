<?php
	require_once('vendor/autoload.php');
	/*
    	@param hauht_start  
    	@param hauht_done     
    	    -estas variables las manda la api
        Siendo que start determina si hay un request en proceso o si la request finalizo
    */
	if (isset($_REQUEST['hauth_start']) || isset($_REQUEST['hauth_done'])){
		/*
			Es una clase static de hybridouth Hybrid_endpoint llamando al metodo process();
			procesando asi la peticion si empezo o termino 
		*/
		Hybrid_Endpoint::process();
	}
 ?>
