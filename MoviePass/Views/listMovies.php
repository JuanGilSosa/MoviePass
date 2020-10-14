<?php 
    require_once('nav.php');
?>

<main class="py-5 mx-auto">
     <section id="listado" class="mb-5 ">
          <div class="container" >
               <h2 class="mb-4">Listado de Peliculas</h2>
               <div class="container">
                    <form action="<?php echo FRONT_ROOT.'Pelicula/ShowMovies'?>" method="POST">
                         <div>
                              <label><h6>Generos Disponibles</h6></label>
                              <select name="generos" id="idGenres" class="selectpicker show-tick" required>
                              <!-- 
                                   onchange="this.form.submit()"  y asi es mas dinamico sin necesidad de presionar el boton Filtrar
                                   Funciona para el select pero cuando tiene que 
                                   mostrar todas las peliculas no lo hace
                              -->
                                   <option value="0">Todos</option>
                                   <?php foreach($generos as $g){ ?>
                                             <option value="<?php echo $g['id'] ?>" required><?php echo $g['name']; ?></option>
                                   <?php }?>
                              </select>
                              <input type="submit" value="Filtrar">
                         </div>
                    </form>
               </div>
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

<!--<script src="js\select-onchange.js"></script>
<script>
     function selectOnChange(idGenero){
          let a = "<#? echo FRONT_ROOT.'ShowMoviesByGenre(idGenero)'?>"
          document.write(a);
          //window.location = "ShowMoviesByGenre(idGenero)";
          //window.location.reload();
     }
</script>
-->