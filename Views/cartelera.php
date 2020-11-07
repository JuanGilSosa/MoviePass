<?php 
    require_once("nav.php");
?>
<main id="page-top" class="no-nav py-5">
    <div class="row">
        <?php 
            foreach($cines as $cine){
        ?>
        <div class="col-sm-3">
            <div class="card border-warning mb-3 card text-white bg-transparent" style="max-width: 20rem;">
                <div class="card-header bg-transparent border-warning"></div>
                    <div class="card-body text-white">
                        <h4 class="card-title"><?php echo $cine->getNombre() ?></h4>
                            
                        <h6><?php echo 'Avenida Siempre Viva, 843'?></h6>
                    </div>
                    <div class="text-center card-footer bg-transparent border-warning">
                        <a href="#" class="btn btn-secondary">Comprar Entradas</a>
                    </div>
                </div>
        </div>
        <?php }?>
    </div>
</main>
