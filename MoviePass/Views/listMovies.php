<?php
require_once('nav.php');
?>
<main class="mx-auto">
	<div class="container py-5">
		<h2 class="mb-4">Listado de Peliculas</h2>

		<div class="row container">
			<div class="col">
				<form action="<?php echo FRONT_ROOT . 'Pelicula/ShowMovies' ?>" method="POST">

					<div class="form-group form-group-lg inputContainer" style="width:50%">

						<select name="generos" id="idGenres" class="form-control form-control-lg logInInputs" onchange="this.form.submit()" required>
							<!-- 
									onchange="this.form.submit()"  y asi es mas dinamico sin necesidad de presionar el boton Filtrar
									Funciona para el select pero cuando tiene que 
									mostrar todas las peliculas no lo hace
								-->
							<option selected="true" disabled="disabled" style="background-color: #000000;">Filtrar por Generos</option>
							<option value="0" style="background-color: #000000;">Todos</option>
							<?php foreach ($generos as $g) { ?>
								<option style="background-color: #000000;" value="<?php echo $g['id'] ?>" required><?php echo $g['name']; ?></option>
							<?php } ?>
						</select>
					</div>
					<!--<input type="submit" value="Filtrar">-->
				</form>
			</div>
		</div>


		<div class="grid-container text-center" style="justify-content:center">

			<?php
			foreach ($peliculas as $pelicula) {
			?>
				<div class="cell">
					<div class="container">
						<a href="<?php echo FRONT_ROOT . 'Pelicula/ShowMovieDescription?idPelicula=' . $pelicula->getId() ?>">
							<img style="width: 188px; height: 282px;" src="https://image.tmdb.org/t/p/original<?php echo $pelicula->getPosterPath() ?>" alt="Imagen">
						</a>
					</div>
					<div class="container" style="margin:5px;">
						<section>
							<p class="title" style="font-size:12px;	"><?php echo $pelicula->getTitle() ?></p>
						</section>
					</div>
					<div class="container">
						<a href="<?php echo FRONT_ROOT . 'Funcion/AddFuncion' ?>" class="btn btn-outline-primary w-100" type="submit">+Funcion</button>
					</div>

				</div>
			<?php
			} ?>

		</div>
	</div>

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