<?php 
    #ignore : $img = file_get_contents('https://api.themoviedb.org/3/configuration?api_key=<<your_key>>');
    require_once('nav.php');
?>
<main class="py-5 height-100">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Cines</h2>
               <table class="table bg-light-alpha text-white">
                    <thead>
                         <th>Titulo</th>
                         <th>Lenguaje</th>
                         <th>ReleaseDate</th>
                         <th>Popularidad</th>
                    </thead>
                    <tbody>
                         <?php

                            foreach ($lista_pelis as $m){
                                ?>
                                    <tr>
                                        <td><?php echo $m->getTitle() ?></td>
                                        <td><?php echo $m->getOriginalLanguage() ?></td>
                                        <td><?php echo $m->getReleaseDate() ?></td>
                                        <td><?php echo $m->getPopularity() ?></td>
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
