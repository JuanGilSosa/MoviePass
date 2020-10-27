<?php 
    require_once('nav.php');
?>
<section id="listado" class="mb-5">

    <div class="container" style="margin-top:10vh;">
        <div class="row container" style="margin:0px; padding:0px;background-color: rgba(158, 140, 219, 1);">
            <div class="col container mx-auto">
                <section class="container" style="width: 100%; height:5vh;">
                    <h4><?php echo "<strong>" . $pelicula->getTitle() ."</strong>" ?></h4>
                </section>
            </div>
        </div>

        <div class="row container" style="margin-top:2vh;align-items:stretch;background-color: rgba(158, 140, 219, 0.4);">
                <div class="col-md-4 col-lg-4" style="margin:2vh 0vh;">
                    <img src="https://image.tmdb.org/t/p/original<?php echo $pelicula->getPosterPath()?>" style=width:100%></img>
                </div>
                <div class="col-md-8 col-lg-8" style="height:100%;margin:2vh 0vh;">
                    <section class="container" style="width: 100%; height: 100%; margin:2vh 0vh;">
                        <h5><em>Descripcion</em></h5>
                        <p><?php echo $pelicula->GetOverview();    ?></p>
                    </section>
                    <section class="container" style="width: 100%; height: 100%; margin:2vh 0vh;">
                        <h5><em>Reparto</em></h5>
                        <p><?php $peliculasDAO->ShowCastDetails($peliculasDAO->GetCast($pelicula->getId())); ?></p>   
                    </section>
                    <section class="row">
                        <section class="col container d-block" style="width: 100%; height: 100%; margin:2vh 0vh;">
                            <h5><em>Generos</em></h5>
                            <p><?php $generosDAO->ShowGenres($generosDAO->getGenresNamesById($pelicula->getGenres())); ?></p>
                        </section>
                        <section class="col container d-block" style="width: 100%; height: 100%; margin:2vh 0vh;">
                            <h5><em>Estreno</em></h5>
                            <p><?php echo $pelicula->getReleaseDate() ?></p>
                        </section>
                        <section class="col container d-block" style="width: 100%; height: 100%; margin:2vh 0vh;">
                            <h5><em>Clasificacion</em></h5>
                            <p><?php echo $pelicula->GetVoteAverage();    ?></p>
                        </section>
                    </section>
                    <section class="row">
                        <section class="col container d-block" style="width: 100%; height: 100%; margin:2vh 0vh;">
                            <a class="btn btn-outline-primary" style="width: 100%;" href="https://www.youtube.com/embed/<?php echo $trailerKey;?>" data-lity>Ver Trailer</a>
                        </section>
                        <section class="col container d-block" style="width: 100%; height: 100%; margin:2vh 0vh;">
                            <button type="" class="btn btn-primary" style="width: 100%;">Reserva</button>
                        </section>

                    </section>
                </div>
                
        </div>
        <div class="row container" style="margin-top:2vh; padding:0px;background-color: rgba(158, 140, 219, 1);">
            <div class="col container mx-auto">
                <section class="container" style="width: 100%; height:5vh;">
                </section>
            </div>
        </div>
    </div>
</section>


