<?php
    require_once('nav.php');
?>
<main class="py-5 height-100">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Cines</h2>
               <table class="table bg-light-alpha text-white">
                    <thead>
                         <th>Pelicula</th>
                         <th>Duracion</th>
                         <th>Categoria</th>
                         <th>Genero</th>
                    </thead>
                    <tbody>
                         <?php

                            foreach ($movies as $movie){
                                ?>
                                    <tr>
                                        <td><?php echo $movie->getNombre() ?></td>
                                        <td><?php echo $movie->getDuracion() ?></td>
                                        <td><?php echo $movie->getCategoria() ?></td>
                                        <td><?php echo $movie->getGenero() ?></td>
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