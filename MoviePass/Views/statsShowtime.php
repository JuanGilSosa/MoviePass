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
            <h2 class="mb-4">Estadisticas Por Función</h2>
            <form action="<?php echo FRONT_ROOT . 'Theatre/StatsShowtime' ?>" method="POST" class="bg-light-alpha p-5">
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
                        <label for="">Elegi la Función</label>
                        <div class="form-group">


                            <select name="showtimeId" class="form-control" onchange="this.form.submit()" required>
                                <option value="" selected disabled>Seleccione una Función</option>
                                <?php
                                if (is_array($showtimes)) {
                                    foreach ($showtimes as $showtime) {
                                        $movieId = $showtime->GetMovie();
                                        $movie = $movieDAO->GetMovieByIdFromDatabase($movieId);

                                        $cinemaId = $showtimesDAO->GetCinemaIdxShowtimeId($showtime->GetId());
                                        $cinema = $cinemaDAO->GetCinemaById($cinemaId);
                                ?>
                                        <option value="<?php echo $showtime->GetId() ?>" required> <?php echo $movie->GetTitle() . " - " . $cinema->GetName() . " - " . $showtime->GetReleaseDate() ?></option>
                                    <?php }
                                } else {
                                    $movieId = $showtimes->GetMovie();
                                    $movie = $movieDAO->GetMovieByIdFromDatabase($movieId);
                                    $cinemaId = $showtimesDAO->GetCinemaIdxShowtimeId($showtimes->GetId());
                                    $cinema = $cinemaDAO->GetCinemaById($cinemaId);
                                    ?>
                                    <option value="<?php echo $showtimes->GetId() ?>" selected required> <?php echo $movie->GetTitle() . " - " . $cinema->GetName() . " - " . $showtimes->GetReleaseDate() ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>


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