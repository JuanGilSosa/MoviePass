<?php require_once('nav.php'); ?>
<div class="row">
    <?php 
    foreach($billboards as $billboard):
        foreach($billboard->GetShowtime() as $showtime):
            if(!empty($showtime) && !empty($showtime->GetMovie())):
    ?>
                <div class="col-lg-2 col-md-6">
                    <div class="card card-cascade narrower">
                        <div class="view view-cascade overlay">
                            <img class="" src="<?php $link = $showtime->GetMovie()->getPosterPath(); echo REQUEST_IMG.'/w300/'.$link; ?>" alt="Portada">
                        </div>
                        <a>
                            <div class="mask rgba-white-slight waves-effect waves-light"></div>
                        </a>
                        
                    </div>
                    <div class="card-body card-body-cascade">
                        <h5 class="red-text"><i class="fas fa-film"></i> <?php $cinemaName = $showtime->GetCinema()->GetName(); echo $cinemaName;?></h5>
                        <h4 class="card-title text-dark"><?php 
                                                    $title = $showtime->GetMovie()->GetTitle();
                                                    echo $title; 
                                                    ?>
                        </h4>
                        <p class="card-text">Comienzo: <?php echo $showtime->GetStartTime();?></p>
                        <p class="card-text">Generos: <?php echo '{los generos}';?></p>
                    
                        <a value="<?php echo ''; ?>" href="<?php echo FRONT_ROOT . 'Movie/ShowMovieDescription?idPelicula=' ?>" type="button" class="btn btn-unique">Reservar</a>
                        <a href="<?php echo FRONT_ROOT . 'Movie/ShowMovieDescription?idPelicula='.$showtime->GetMovie()->GetId(); ?>" type="button" class="btn btn-unique">Ver Info</a>        
                    </div>
                </div>
    <?php 
            endif;
        endforeach;
    endforeach; 
    ?>
    </div> 