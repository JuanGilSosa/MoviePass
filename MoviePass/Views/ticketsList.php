<?php

use Helpers\SessionHelper;

require_once('nav.php');
?>

<main class="mx-auto py-2">
    <section id="listado" class="mb-5">
        <div class="container">

            <?php
            if (isset($message) && !empty($message)) {
                #echo "<small>" . $message . "</small>";
            ?>
                <div class="container">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $message ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            <?php
            }
            ?>
            <div class="container">
                <h1>Entradas</h1>
            </div>
            <?php foreach ($tickets as $index => $ticket) {
                $numOfTickets = $ticket->GetNumberOfTickets();
                if ($ticket->GetNumberOfTickets() >= 1) {
                    for($i = 0;$i<$numOfTickets;$i+=1){
                        $showtime = $ticket->GetShowtime();
                        $cinema = $showtime->GetCinema();
                        $theatre = $theatreDAO->GetTheatreByCinemaId_cinemasXtheatres($cinema->GetId());
                        $movie = $showtime->GetMovie();
                        $adressId = $theatre->GetAdress();
                        $adress = $adressDAO->GetAdressById($adressId);
                        $cityId = $adress->GetCity();
                        $city = $cityDAO->GetByZipCode($cityId);
            ?>
                    <div class="row container text-center" style="color:white;background-color:black; margin-bottom:2vh; padding:10px;">
                        <div class="col-2">
                            <img src="https://image.tmdb.org/t/p/original<?php echo $movie->GetPosterPath() ?>" style="width:10vw; margin-bottom:3px;"></img>
                        </div>
                        <div class="col-10">
                            <div class="row">
                                <div class="col-4">
                                    <?php echo "Cine " ?> 
                                    <hr style="background-color:white;">
                                    <?php echo $theatre->GetName() . "<br>" . "<br>" ?>
                                    <?php echo $cinema->GetName() . "<br>" . "<br>" ?>
                                    <?php echo $adress->GetStreet() . " " . $adress->GetNumber() . "<br>" ?>
                                    <?php echo $city->GetName() ?>
                                </div>
                                <div class="col-4">
                                    <?php echo "Funcion " ?>
                                    <hr style="background-color:white;">
                                    <?php echo "Pelicula: " . $movie->GetTitle() . "<br>" . "<br>" ?>
                                    <?php echo "Fecha: " . $showtime->GetReleaseDate() . "<br>" . "<br>" ?>
                                    <?php echo "Comienzo: " .$showtime->GetStartTime() . " hs" . "<br>"?>
                                    <?php echo "Fin: " . $showtime->GetEndTime() . " hs"?>                                    
                                </div>
                                <div class="col-4">
                                    <img src="<?php echo IMG_PATH . "qr.png" ?>" style="width:80%; margin-bottom:3px;"></img>

                                </div>
                            </div>
                        </div>

                    </div>

            <?php  }
                } 
            }?>

            <?php SessionHelper::DestroySession('CART'); ?>

        </div>
        <div class="form-group mx-auto w-25  col col-sm-12 col-xs-12 col-md-4">
            <button type="button" onClick="window.print()" class="btn btn-light">Imprimir</button>
        </div>
    </section>
    <main>