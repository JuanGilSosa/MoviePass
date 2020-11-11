<?php require_once('nav.php'); ?>

<main>
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
    </div>
    <div class="grid-container text-center" style="justify-content:center; height:100%">

        <?php

  
                foreach ($billboards as $showtime) {
                    if (!empty($showtime) && !empty($showtime->GetMovie())) {
                        $cinema = $showtime->GetCinema();
                        $theatre = $theatreDAO->GetTheatreByCinemaId_cinemasXtheatres($cinema->GetId());
                        #$movie = $showtime->GetMovie();
                        #$genres = $genreDAO->GetGenresNamesById($movie->GetGenres());
        ?>
                        <div class="grid-container">
                            <div class="cell " style="background-color: #000000; padding-top:2vh;">
                                <div class="container ">

                                    <a href="<?php echo FRONT_ROOT . 'Movie/ShowMovieDescription?idPelicula=' . $showtime->GetMovie()->GetId() ?>">
                                        <img class="" src="<?php $link = $showtime->GetMovie()->getPosterPath();
                                                            echo REQUEST_IMG . '/w300/' . $link; ?>" alt="Portada" style="width: 188px; height: 282px;">
                                    </a>

                                </div>

                                <div class="card-body card-body-cascade" style="min-height:30vh;">

                                    <h5 class="card-title" style="min-height:10vh;"><?php
                                                                                    $title = $showtime->GetMovie()->GetTitle();
                                                                                    echo $title;
                                                                                    ?>
                                    </h5>

                                    <h5 class="red-text"></i><?php if (is_object($theatre)) {
                                                                    echo $theatre->GetName();
                                                                } ?></h5>

                                    <h5 class="red-text"><i class="fas fa-film"></i> <?php $cinemaName = $showtime->GetCinema()->GetName();
                                                                                        echo $cinemaName; ?></h5>

                                    <p style="color:#C1C1C1;" class="card-text">Fecha: <?php echo $showtime->GetReleaseDate(); ?></p>
                                    <p style="color:#C1C1C1;" class="card-text">Comienza: <?php echo $showtime->GetStartTime(); ?> hs</p>
                                    <!--<p class="card-text small">Generos: <#?php foreach($genres as $g){echo $g;}?></p>-->
                                </div>
                                <div class="card-body card-body-cascade">

                                    <a href="<?php echo FRONT_ROOT . 'Cart/AddShowtime?idShowTime=' . $showtime->GetId(); ?>" type="button" class="btn btn-unique">Reservar
                                    </a>
                                    <a href="<?php echo FRONT_ROOT . 'Movie/ShowMovieDescription?idPelicula=' . $showtime->GetMovie()->GetId(); ?>" type="button" class="btn btn-unique">Ver Info
                                    </a>
                                </div>

                            </div>
                        </div>
                <?php
                    }
                }
            
        ?>


    </div>
</main>