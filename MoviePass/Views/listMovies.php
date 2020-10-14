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
                              <select name="generos" id="idGenres" class="selectpicker show-tick" onchange="this.form.submit()" required>
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
              
               <section id="listado" class="mb-5">
               <table id="dt-vertical-scroll" class="table  table-striped bg-dark text-white" cellspacing="0" width="100%" style="margin:0px; padding:0px;">
               <thead>
                    <tr>
                         <th class="th-sm">Titulo
                         </th>
                         <th class="th-sm">Descripcion
                         </th>
                         <th class="th-sm">Generos
                         </th>
                         <th class="th-sm">Lanzamiento
                         </th>
                         <th class="th-sm">Rating
                         </th>
                    </tr>
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
                    </tbody>
          </table>
     </section>



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