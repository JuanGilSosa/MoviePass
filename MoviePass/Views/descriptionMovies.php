<?php 
    require_once('nav.php');
?>
<!--<section id="listado" class="mb-5">
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-3 ">
	
	    <div class="onbcn-pelicula">
		    <figure class="thumb">
			    <img src="https://image.tmdb.org/t/p/w500<#?php echo $pelicula->getPosterPath()?>" alt="Imagen" style="width:100%">
		    </figure>
		</div>

	</div>

	<div class="col-xs-12 col-sm-12 col-md-9">

		<div class="onbcn-cinema-detail-body">

			<p><strong>DURACIÓN:</strong> </p><p></p>
            <p><strong>TITULO:</strong><#?php echo $pelicula->getTitle()?></p><p></p>
            <p><strong>GÉNERO:</strong><#?php $this->generosDAO->ShowGenres($this->generosDAO->getGenresNamesById($pelicula->getGenres()));?></p><p></p>
            <p><strong>ESTRENO:</strong><#?php echo $pelicula->getReleaseDate() ?></p><p></p>
            <p><strong>RATING:</strong><#?php echo $pelicula->getVoteAverage() ?></p><p>
									
			<br>
				</p><p><strong>DESCRIPCION:</strong></p>
				<p><#?php echo $pelicula->getOverview() ?></p>
			<br>
									
        </div>

        <div class="onbcn-embed">
            <div class="top"><p class="title">Trailer</p></div>
            <div class="middle">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/K-trfyj0bSE?enablejsapi=1&amp;origin=https%3A%2F%2Fcartelera.elperiodico.com" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" data-gtm-yt-inspected-2613943_753="true" id="956560764" data-gtm-yt-inspected-2613943_757="true" data-gtm-yt-inspected-2613943_758="true" data-gtm-yt-inspected-2613943_759="true" data-gtm-yt-inspected-2613943_760="true" data-gtm-yt-inspected-2613943_761="true"></iframe>                                        </div>
        </div>
</section>-->
<section id="listado" class="mb-5">
    <div class="movie-container pt-5">
        <div class="background-movie" style="background: url('https://image.tmdb.org/t/p/original<?php echo $pelicula->getBackdropPath()?>') 0% -30px / cover rgb(17, 17, 17);">
            <div class="background-shadow">
                <div class="movie-poster">
                    <div class="poster">
                        <img style="" src="https://image.tmdb.org/t/p/w300<?php echo $pelicula->getPosterPath()?>">
                    </div>
                </div>
                <div class="movie-content">
                    <div class="info">
                        <div class="text-center">
                            <h1 style="text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.35);"><?php echo $pelicula->getTitle() ?></h1>
                        </div>
                        <div class="text-center">
                            <?php echo $pelicula->getOverview()?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9">

            <div class="onbcn-cinema-detail-body">

                <p><strong>DURACIÓN:</strong> </p><p></p>
                <p><strong>TITULO:</strong><?php echo $pelicula->getTitle()?></p><p></p>
                <p><strong>GÉNERO:</strong><?php $this->generosDAO->ShowGenres($this->generosDAO->getGenresNamesById($pelicula->getGenres()));?></p><p></p>
                <p><strong>ESTRENO:</strong><?php echo $pelicula->getReleaseDate() ?></p><p></p>
                <p><strong>RATING:</strong><?php echo $pelicula->getVoteAverage() ?></p><p>
                                    
                                        
            </div>

            <div class="onbcn-embed">
		
                <div class="top"><p class="title">Trailer</p></div>
                <div class="middle">
                    <iframe 
                        width="560" 
                        height="315" 
                        src="https://www.youtube.com/embed/<?php echo $trailerKey;?>" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen="" 
                        data-gtm-yt-inspected-2613943_753="true" 
                        id="956560764" 
                        data-gtm-yt-inspected-2613943_757="true" 
                        data-gtm-yt-inspected-2613943_758="true" 
                        data-gtm-yt-inspected-2613943_759="true" 
                        data-gtm-yt-inspected-2613943_760="true" 
                        data-gtm-yt-inspected-2613943_761="true">
                    </iframe>                                        
                </div>
            </div>
        </div>
    </div>
</section>
