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

			
			<div class="container">
				<div class="container row">
					<form action="<?php echo FRONT_ROOT.'Pelicula/ShowMovieDescription'?>" method="POST">
						
							<?php
								foreach ($peliculas as $pelicula){	
							?>
								<div class="container col-xs-12 col-sm-6 col-md-3 col-lg-3 text-center" >
								
									<a type="submit" href="<?php echo FRONT_ROOT.'Pelicula/ShowMovieDescription?idPelicula='.$pelicula->getId()?>">
										<img style="width: 100%;" src="https://image.tmdb.org/t/p/original<?php echo $pelicula->getPosterPath()?>" alt="Imagen">
									</a>
								
									<h6 class="title"><?php echo $pelicula->getTitle()?></h6>
								
								</div>
							<?php
							}?>
						
					</form>
					
				</div>
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