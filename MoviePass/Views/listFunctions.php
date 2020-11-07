<?php require_once('nav.php'); ?>
<div class="row">
    <?php 
    foreach($billboards as $billboard):
        foreach($billboard->getFunctions() as $function):
            if(!empty($function) && !empty($function->getMovie())):
    ?>
                <div class="col-lg-2 col-md-6">
                    <div class="card card-cascade narrower">
                        <div class="view view-cascade overlay">
                            <img class="" src="<?php $link = $function->getMovie()->getPosterPath(); echo REQUEST_IMG.'/w300/'.$link; ?>" alt="Portada">
                        </div>
                        <a>
                            <div class="mask rgba-white-slight waves-effect waves-light"></div>
                        </a>
                        
                    </div>
                    <div class="card-body card-body-cascade">
                        <h5 class="red-text"><i class="fas fa-film"></i> <?php $nameSala = $function->getSala()->getNombre(); echo $nameSala;?></h5>
                        <h4 class="card-title text-dark"><?php 
                                                    $title = $function->getMovie()->getTitle();
                                                    echo $title; 
                                                    ?>
                        </h4>
                        <p class="card-text">Comienzo: <?php echo $function->getHoraInicio();?></p>
                        <p class="card-text">Generos: <?php echo '{los generos}';?></p>
                    
                        <a value="<?php echo ''; ?>" href="<?php echo FRONT_ROOT . 'Pelicula/ShowMovieDescription?idPelicula=' ?>" type="button" class="btn btn-unique">Reservar</a>
                        <a href="<?php echo FRONT_ROOT . 'Pelicula/ShowMovieDescription?idPelicula='.$function->getMovie()->getId(); ?>" type="button" class="btn btn-unique">Ver Info</a>        
                    </div>
                </div>
    <?php 
            endif;
        endforeach;
    endforeach; 
    ?>
    </div> 