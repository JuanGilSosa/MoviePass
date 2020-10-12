<?php 
    #ignore : $img = file_get_contents('https://api.themoviedb.org/3/configuration?api_key=<<your_key>>');
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
                                   $movie = $this->peliculasDAO->GetMovieById($pelicula->getId());
                                   //print_r($movie);
                                ?>
                                    <tr>
                                        <td><?php echo $movie->getTitle() ?></td>
                                        <td><?php echo $movie->getOverview() ?></td>
                                        <td><?php
                                             $count = 0;
                                             while($count < count($movie->getGenres()))
                                             {
                                                  $generos = $movie->getGenres();
                                                  echo $generos[$count]["name"] . "<br>";
                                                  $count++;
                                             }
                                        ?></td>
                                        <td><?php echo $movie->getReleaseDate() ?></td>
                                        <td><?php echo $movie->getVoteAverage() ?></td>
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
