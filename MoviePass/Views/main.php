<?php
require_once("nav.php");
?>
<main class="">

    <div class="card card-image" style="background-image: url(<?php echo IMG_PATH . 'space.jpg' ?>);">
        <div class="text-white text-center rgba-stylish-strong py-5 px-4">
            <div class="py-5">

                <!-- Content -->
                <h2 class="card-title h2 my-4 py-2">MoviePass</h2>
                <p class="mb-4 pb-2 px-md-5 mx-md-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur obcaecati vero aliquid libero doloribus ad, unde tempora maiores, ullam, modi qui quidem minima debitis perferendis vitae cumque et quo impedit.</p>
                <a class="btn purple-gradient" href="<?php echo FRONT_ROOT . 'Views/ShowRegisterForm' ?>"><i class="fas fa-users"></i></i> Registrate y Reserva!</a>

            </div>
        </div>
    </div>
<div class="container">
    <div class="container" style="margin-top:4vh;">
        <div class="container">
            <h5>Popular Movies</h5>
            <hr>
        </div>
        <div class="grid-container text-center" style="justify-content:center">

            <?php
            foreach ($topRatedMovies as $pelicula) {
            ?>
                <div class="cell" style="height:300px;">
                    <div class="container">
                        <img style="width: 188px; height: 282px;" src="https://image.tmdb.org/t/p/original<?php echo $pelicula->getPosterPath() ?>" alt="Imagen">

                    </div>
                    <div class="container" style="margin:5px;">
                        <section>
                            <p class="title" style="font-size:12px;	"><?php echo $pelicula->getTitle() ?></p>
                        </section>
                    </div>

                </div>
            <?php
            } ?>


        </div>
    </div>

    <div class="container">
        <div class="container">
            <h5>Upcoming Movies</h5>
            <hr>
        </div>
        <div class="grid-container text-center" style="justify-content:center">

            <?php
            foreach ($upcomingMovies as $pelicula) {
            ?>
                <div class="cell">
                    <div class="container">
                        <img style="width: 188px; height: 282px;" src="https://image.tmdb.org/t/p/original<?php echo $pelicula->getPosterPath() ?>" alt="Imagen">

                    </div>
                    <div class="container" style="margin:5px;">
                        <section>
                            <p class="title" style="font-size:12px;	"><?php echo $pelicula->getTitle() ?></p>
                        </section>
                    </div>

                </div>
            <?php
            } ?>


        </div>
    </div>
    </div>

</main>