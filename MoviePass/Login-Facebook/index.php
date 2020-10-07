<?php
	require_once('vendor/autoload.php');
	require_once('App/Auth/Auth.php');
?>

<main>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/font-awesome.css">
        <link rel="stylesheet" href="assets/css/bootstrap-social.css">
        <script src="assets/js/jquery.js" charset="utf-8"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
            <?php Auth::getUserAuth(); ?>
                <div class="col-md-4">
                    <br> 
                    <!-- 
                    Donde la variable login que se usa el los script de php sea igual a Facebook si presiona el boton
                    -->
                    <a href="?login=Facebook" class="btn btn-block btn-social btn-facebook" style="background-color:orange;"><!--<span class="fa fa-facebook"></span>-->Iniciar sesion con Facebok</a>
                </div>
            </div>
        </div>
    </body>
</main>