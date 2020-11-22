<?php
require_once("nav.php");
?>
<main class="mx-auto h-75">
    <section id="listado" class="mb-5">
        <?php
        if (isset($message) && !empty($message)) {
        ?>
            <div class="container">
                <div class="alert alert-info alert-dismissible fade show" role="alert">
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
            <h2 class="mb-4">Estadisticas Por Película</h2>
            <form action="<?php echo FRONT_ROOT . 'Theatre/StatsMovies' ?>" method="POST" class="bg-light-alpha p-5">
                <div class="row justify-content-start">

                    <div class="col-lg-6">
                        <label for="">Elegi una Película</label>
                        <div class="form-group">


                            <select name="theatreId" class="form-control" onchange="this.form.submit()" required>
                                <option value="" selected disabled>Seleccione Película</option>
                                <?php
                                if (is_array($movies)) {
                                    foreach ($movies as $movie) {
                                ?>
                                        <option value="<?php echo $movie->GetId() ?>" required> <?php echo $movie->GetTitle() . " - " . $movie->GetId() ?></option>
                                    <?php }
                                } else {
                                    ?>
                                    <option value="<?php echo $movies->GetId() ?>" selected required><?php echo $movies->GetTitle() ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6"></div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Total Vendido (en pesos): </label><br>
                            <input disabled type="text" placeholder="0" value="<?php if (isset($total)) {
                                                                                    echo '$' . $total;
                                                                                } ?>">
                        </div>
                    </div>
                    <div class="col-lg-4">

                        <div class="form-group">
                            <label for="">Tickets Vendidos: </label><br>
                            <input disabled type="text" placeholder="0" value="<?php if (isset($countOfTickets)) {
                                                                                    echo $countOfTickets;
                                                                                } ?>">
                        </div>
                    </div>
                    <div class="col-lg-4">

                        <div class="form-group">
                            <label for="">Remanente Entradas: </label><br>
                            <input disabled type="text" placeholder="0" value="<?php if (isset($remainder)) {
                                                                                    echo $remainder;
                                                                                } ?>">
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </section>
</main>