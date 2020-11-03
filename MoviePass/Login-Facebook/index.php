<?php
	require_once('vendor/autoload.php');
	require_once('App/Auth/Auth.php');
?>

<main>
    <body>
        <div class="container">
            <div class="row">
            <?php Auth::getUserAuth(); ?>
                <div class="col-md-4">
                    <br> 
                    <!-- 
                    Donde la variable login que se usa el los script de php sea igual a Facebook si presiona el boton
                    -->
                    <a href="?login=Facebook" type="button" class="btn blue-gradient btn-block fab fa-facebook-f">&nbsp;&nbsp;Ingresa con Facebook</a>
                </div>
            </div>
        </div>
    </body>
</main>