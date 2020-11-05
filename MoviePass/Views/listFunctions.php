<?php 
require_once('nav.php');
foreach($billboard->getFunctions() as $function):
?>
<div class="border box-large col-lg-3 col-md-4 col-sm-6 col-xs-12 no-p">
    <article class="data-sheet new">
        <a href="/espectaculos/cine/la-parte-oscura_9733.html">
            <figure>
                <div class="premiere"><p>Algun Texto</p></div>
                <img class="lazyload" alt="La parte oscura" data-src="/espectaculos/cine/image/la-parte-oscura_9733.jpg" src="/espectaculos/cine/image/la-parte-oscura_9733.jpg" pinger-seen="true">
            </figure>
        </a>
        <div class="mt form-group">
            <a href="/espectaculos/cine/la-parte-oscura_9733.html">
            <h4><?php echo $function->getPelicula()->getTitle();?></h4>
            </a>
            <p>Genero: <span>OBTENER DE PHP</span></p>
            <p class="clase">Votos: <?php echo $function->getPelicula()->getVoteAverage();?></p>
            <p> Inicia: <?php echo $function->getHoraInicio(); ?> </p>
        </div>
    </article>
</div>
<?php endforeach; ?>