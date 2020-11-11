<?php
require_once("nav.php");
?>
<main class="mx-auto h-75">
    <section id="listado" class="mb-5">
        <div class="container">
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
            <h2 class="mb-4">Agregar Funcion</h2>
            <form action="<?php echo FRONT_ROOT . 'Showtime/AddShowtime' ?>" method="POST" class="bg-light-alpha p-5">
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
                    <div class="col-lg-6">
                        <label for="">Elegi la Sala</label>
                        <div class="form-group">
                            <select name="select-movies" class="form-control" onchange="" required>
                                <option value="" selected disabled>Seleccione Sala</option>
                                <?php
                                    if (is_array($cinemas)) {
                                        foreach ($cinemas as $cinema) {
                                    ?>
                                        <option name="cinemaId" value="<?php echo $cinema->GetId() ?>" required><?php echo $cinema->GetName() ?></option>
                                        <?php }
                                    } else {
                                        ?>
                                        <option name="cinemaId" value="<?php echo $cinemas->GetId() ?>" required><?php echo $cinemas->GetName() ?></option>
                                    <?php } ?>
                                
                            
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Pelicula</label>
                            <input type="text" name="movieId" placeholder="<?php echo $movie->GetTitle() ?>" value="<?php echo $movie->GetId() ?>" class="form-control" required hidden>
                            <input type="text" name="" placeholder="<?php echo $movie->GetTitle() ?>" value="" class="form-control" readonly>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Fecha de funcion:</label>
                            <input type="date" name="releaseDate" class="w-100" class="form-control" required />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Horario de funcion</label>
                            <input type="time" name="startTime" value="" min="17:00" max="23:00" class="w-100" class="form-control" required />
                        </div>
                    </div>
                    
                </div>
                <button type="submit" name="button" class="btn btn-light ml-auto d-block">Cargar Función</button>
            </form>
        </div>
    </section>
</main>