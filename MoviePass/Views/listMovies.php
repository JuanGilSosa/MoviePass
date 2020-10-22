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
                                <option selected="true" disabled="disabled">Generos</option>
                                <option value="0">Todos</option>
                                <?php foreach($generos as $g){ ?>
                                        <option value="<?php echo $g['id'] ?>" required><?php echo $g['name']; ?></option>
                                <?php }?>
                           	</select>
                              <!--<input type="submit" value="Filtrar">-->
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
                                        <td><?php $this->generosDAO->ShowGenres($this->generosDAO->getGenresNamesById($pelicula->getGenres()));?></td>
                                        <td><?php echo $pelicula->getReleaseDate() ?></td>
                                        <td><?php echo $pelicula->getVoteAverage() ?></td>
                                    </tr>
                                <?php
                            }
                         ?>
                    </tbody>
          	</table>
          	</section>
          	<!--
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="flex-viewport" style="overflow: hidden; position: relative;"><ul class="slides" style="width: 2400%; transition-duration: 0s; transform: translate3d(0px, 0px, 0px);">
							<li class="item slider-item" style="width: 146px; margin-right: 10px; float: left; display: block;">
								<figure class="thumb" style="height: 215px;">
									<a href="https://cartelera.elperiodico.com/pelicula/vitalina-varela-35353.html"><img src="https://image.tmdb.org/t/p/original/yPeG1RQm5Am0eslu0IwUEJ4VXND.jpg" style="width:100%; height: 215px; object-fit: cover;" alt="Vitalina Varela" draggable="true"></a>
								</figure>
								
								<div class="txt">
									<h6 class="title"><a href="https://cartelera.elperiodico.com/pelicula/vitalina-varela-35353.html" title="Vitalina Varela">Vitalina Varela</a></h6>
								</div>
							</li>
						</div>
					</div>
				</div>
			</div>-->
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