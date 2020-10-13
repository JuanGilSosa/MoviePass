<?php 
    require_once('nav.php');
?>
<main class="py-5 mx-auto">
     <section id="listado" class="mb-5 ">
          <div class="container" >
               <h2>Listado de Cines</h2>
               <table class="moviesTable table-striped bg-dark text-white">
                    <thead class="text-center">
                         <th>Titulo</th>
                         <th>Desripcion</th>
                         <th class="moviesHeader">Generos</th>
                         <th class="moviesHeader">Release Date</th>
                         <th class="moviesHeader">Promedio</th>

                    </thead>
                    <tbody>
                         <?php
                              foreach ($peliculas as $pelicula){
                                   #$movie = $this->peliculasDAO->GetMovieById($pelicula->getId());
                                ?>
                                    <tr>
                                        <td><?php echo $pelicula->getTitle() ?></td>
                                        <td><?php echo $pelicula->getOverview() ?></td>
                                        <td><?php $this->peliculasDAO->ShowGenres($this->peliculasDAO->getGenresNamesById($pelicula->getGenres()));?></td>
                                        <!--$this->peliculasDAO->getGenresNamesById($pelicula->getGenres());-->
                                        <td><?php echo $pelicula->getReleaseDate() ?></td>
                                        <td><?php echo $pelicula->getVoteAverage() ?></td>
                                    </tr>
                                <?php
                            }
                         ?>
                         
                         </tr>
                    </tbody>
               </table>
          </div>
     </section>
</main>
