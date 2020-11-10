<?php 
    require_once('nav.php');
?>
<section id="listado" class="mb-5 py-3">

    <div class="container" >
        <div class="row container" style="margin:0px; padding:0px;background-color: rgba(158, 140, 219, 1);">
            <div class="col container mx-auto">
                <section class="container" style="width: 100%; height:5vh;">
                    <h4><?php echo "<strong>" . $movie->GetTitle() ."</strong>" ?></h4>
                </section>
            </div>
        </div>

        <div class="row container" style="margin-top:2vh;align-items:stretch;background-color: rgba(158, 140, 219, 0.4);">
                <div class="col-md-4 col-lg-4" style="margin:2vh 0vh;">
                    <img src="https://image.tmdb.org/t/p/original<?php echo $movie->GetPosterPath()?>" style=width:100%></img>
                </div>
                <div class="col-md-8 col-lg-8" style="height:100%;margin:2vh 0vh;">
                    <section class="container" style="width: 100%; height: 100%; margin:2vh 0vh;">
                        <h5><em>Descripcion</em></h5>
                        <p><?php echo $movie->GetOverview();    ?></p>
                    </section>
                    <section class="container" style="width: 100%; height: 100%; margin:2vh 0vh;">
                        <h5><em>Reparto</em></h5>
                        <p><?php $moviesDAO->ShowCastDetails($moviesDAO->GetCast($movie->GetId())); ?></p>   
                    </section>
                    <section class="row">
                        <section class="col container d-block" style="width: 100%; height: 100%; margin:2vh 0vh;">
                            <h5><em>Generos</em></h5>
                            <p><?php $genresDAO->ShowGenres($genresDAO->GetGenresNamesById($movie->GetGenres())); ?></p>
                        </section>
                        <section class="col container d-block" style="width: 100%; height: 100%; margin:2vh 0vh;">
                            <h5><em>Estreno</em></h5>
                            <p><?php echo $movie->GetReleaseDate() ?></p>
                        </section>
                        <section class="col container d-block" style="width: 100%; height: 100%; margin:2vh 0vh;">
                            <h5><em>Clasificacion</em></h5>
                            <p><?php echo $movie->GetVoteAverage();    ?></p>
                        </section>
                    </section>
                    <section class="row">
                        <section class="col container d-block" style="width: 100%; height: 100%; margin:2vh 0vh;">
                            <a class="btn btn-outline-primary" style="width: 100%;" href="https://www.youtube.com/embed/<?php echo $trailerKey;?>" data-lity>Ver Trailer</a>
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


