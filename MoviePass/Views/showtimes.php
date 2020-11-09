<?php require_once('nav.php'); ?>
<div class="row">

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
            
    <?php 
    foreach($billboards as $billboard):
        foreach($billboard->GetShowtime() as $showtime):
            if(!empty($showtime) && !empty($showtime->GetMovie())):
                #$movie = $showtime->GetMovie();
                #$genres = $genreDAO->GetGenresNamesById($movie->GetGenres());
    ?>
                <div class="row container col-lg-2 col-md-6" style="margin-left:2vh;margin-top:2vh;align-items:stretch;background-color: rgba(158, 140, 219, 0.4);">
                    <div class="card card-cascade narrower">
                        <div class="view view-cascade overlay">
                            <img class="" src="<?php $link = $showtime->GetMovie()->getPosterPath(); echo REQUEST_IMG.'/w300/'.$link; ?>" alt="Portada">
                        </div>
                        <a>
                            <div class="mask rgba-white-slight waves-effect waves-light"></div>
                        </a>
                        
                    </div>
                    <div class="card-body card-body-cascade">
                        <h5 class="red-text"><i class="fas fa-film"></i> SALA -  <?php $cinemaName = $showtime->GetCinema()->GetName(); echo $cinemaName;?></h5>
                        <h4 class="card-title"><?php 
                                                    $title = $showtime->GetMovie()->GetTitle();
                                                    echo $title; 
                                                    ?>
                        </h4>
                        <p style="color:#C1C1C1;" class="card-text">Comienzo: <?php echo $showtime->GetStartTime();?></p>
                        <!--<p class="card-text small">Generos: <#?php foreach($genres as $g){echo $g;}?></p>-->
                    
                        <a value="<?php echo $showtime->GetMovie()->GetId(); ?>" href="<?php echo FRONT_ROOT.'Cart/ShowCart' ?>" type="button" class="btn btn-unique">Reservar</a>
                        <a href="<?php echo FRONT_ROOT . 'Movie/ShowMovieDescription?idPelicula='.$showtime->GetMovie()->GetId(); ?>" type="button" class="btn btn-unique">Ver Info</a>        
                    </div>
                </div>
    <?php 
            endif;
        endforeach;
    endforeach; 
    ?>
    </div> 