<?php
require_once("nav.php");
?>
<main class="mx-auto h-100">
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
            <h2 class="">Estadisticas Por Cine</h2>
            <form action="<?php echo FRONT_ROOT . 'Theatre/Stats' ?>" method="POST" class="bg-light-alpha p-5">
                <div class="row justify-content-start">

                    <div class="col-lg-6">
                        <label for="">Elegi el Cine</label>
                        <div class="form-group">


                            <select name="theatreId" class="form-control" onchange="this.form.submit()" required>
                                <option value="" selected disabled>Seleccione Cine</option>
                                <?php
                                if (is_array($theatres)) {
                                    foreach ($theatres as $theatre) {
                                ?>
                                        <option value="<?php echo $theatre->GetId() ?>" required> <?php echo $theatre->GetName() ?></option>
                                    <?php }
                                } else {
                                    ?>
                                    <option value="<?php echo $theatres->GetId() ?>" selected required><?php echo $theatres->GetName() ?></option>
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

        <div class="container  mb-4">
            <h2 class="mt-4">Ganancias</h2>
            <form action="<?php echo FRONT_ROOT . 'Theatre/StatsProfits' ?>" method="POST" class="bg-light-alpha p-5">
                <div class="row justify-content-start">

                    <div class="col-lg-6">
                        <label>Elegi el Cine</label>
                        <div class="form-group">


                            <select name="theatreId" class="form-control" required>
                                <option value="" selected disabled>Seleccione Cine</option>
                                <?php
                                if (is_array($theatres)) {
                                    foreach ($theatres as $theatre) {
                                ?>
                                        <option value="<?php echo $theatre->GetId() ?>" required> <?php echo $theatre->GetName() ?></option>
                                    <?php }
                                } else {
                                    ?>
                                    <option value="<?php echo $theatres->GetId() ?>" selected required><?php echo $theatres->GetName() ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <label>Desde:</label>
                        <div class="form-group">
                            <input type="date" name="startDate" value="" required>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <label>Hasta:</label>
                        <div class="form-group">
                            <input type="date" name="endDate" value="" onchange="this.form.submit()" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Total Vendido (en pesos): </label><br>
                            <input disabled type="text" placeholder="0" value="<?php if (isset($theatreProfits)) {
                                                                                    echo '$' . $theatreProfits;
                                                                                } ?>">
                        </div>
                    </div>
                    <div class="col-lg-4">

                    </div>
                    <div class="col-lg-4">

                    </div>
                </div>

            </form>
        </div>


    </section>
</main>