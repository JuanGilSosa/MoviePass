<?php
require_once("nav.php");
?>
<main>
    <div class="card card-image" style="background-image: url(<?php echo IMG_PATH . 'space.jpg' ?>); width:100%;">
        <div class="text-white text-center rgba-stylish-strong py-5 ">
            <div class="py-5">

                <!-- Content -->
                <h1 class="card-title h1 my-4 py-2">MoviePass</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et deleniti perferendis minus ipsam earum asperiores, ratione consectetur ad reprehenderit voluptates omnis, placeat ullam suscipit. Provident eius laboriosam aliquid ex dolore.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Et deleniti perferendis minus ipsam earum asperiores, ratione consectetur ad reprehenderit voluptates omnis, placeat ullam suscipit. Provident eius laboriosam aliquid ex dolore.</p>
                <a class="btn purple-gradient" href="<?php echo FRONT_ROOT . 'Views/ShowRegisterForm' ?>"><i class="fas fa-users"></i></i> Registrate y Reserva!</a>

            </div>
        </div>
    </div>
    <div class="container">
        <div class="container py-5">
            <div class="container">
                <h5><em><strong>Popular Movies</strong><em></h5>
                <hr style="background-color:white">
            </div>
            <div class="row container text-center" style="justify-content:center">

                <?php
                foreach ($topRatedMovies as $movie) {
                ?>
                    <div class="col container" style="height:300px; margin:1vh 0vh;">
                        <div class="container">
                            <a href="<?php echo FRONT_ROOT . 'Movie/ShowMovieDescription?idPelicula=' . $movie->GetId() ?>">
                                <img style="width: 188px; height: 282px;" src="https://image.tmdb.org/t/p/original<?php echo $movie->getPosterPath() ?>" alt="Imagen">
                            </a>
                            <section style="height:10px;">
                                <p class="title" style="font-size:12px;	"><?php echo $movie->GetTitle() ?></p>
                            </section>
                        </div>

                    </div>
                <?php
                } ?>


            </div>
        </div>

        <div class="container py-5">
            <div class="container">
                <h5><em><strong>Upcoming Movies</strong></em></h5>
                <hr style="background-color:white">
            </div>
            <div class="row container text-center" style="justify-content:center">

                <?php
                foreach ($upcomingMovies as $movie) {
                ?>
                    <div class="col container" style="height:300px; margin:1vh 0vh;">
                        <div class="container">
                            <a href="<?php echo FRONT_ROOT . 'Movie/ShowMovieDescription?idPelicula=' . $movie->GetId() ?>">
                                <img style="width: 188px; height: 282px;" src="https://image.tmdb.org/t/p/original<?php echo $movie->getPosterPath() ?>" alt="Imagen">
                            </a>
                            <section style="height:10px;">
                                <p class="title" style="font-size:12px;	"><?php echo $movie->GetTitle() ?></p>
                            </section>
                        </div>

                    </div>
                <?php
                } ?>


            </div>
        </div>
    </div>

</main>