<?php
require_once('nav.php');
?>

<main class="mx-auto">
	<section id="listado" class="">
		<div class="container">
			<?php
			if (isset($message) && !empty($message)) {
				#echo "<small>" . $message . "</small>";
			?>
				<div class="container">
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<?php echo $message ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				</div>
			<?php
			}
			?>
			<h2 class="">Listado de Peliculas</h2>

			<div class="row container">
				<div class="col">
					<form action="<?php echo FRONT_ROOT . 'Movie/ShowMovies' ?>" method="POST">

						<div class="form-group form-group-lg inputContainer" style="width:50%">

							<select name="generos" id="idGenres" class="form-control form-control-lg logInInputs" onchange="this.form.submit()" required>
								<!-- 
									onchange="this.form.submit()"  y asi es mas dinamico sin necesidad de presionar el boton Filtrar
									Funciona para el select pero cuando tiene que 
									mostrar todas las movies no lo hace
								-->
								<option selected="true" disabled="disabled" style="background-color: #000000;">Filtrar por Generos</option>
								<option value="0" style="background-color: #000000;">Todos</option>
								<?php foreach ($genres as $g) { ?>
									<option style="background-color: #000000;" value="<?php echo $g['id'] ?>" required><?php echo $g['name']; ?></option>
								<?php } ?>
							</select>
						</div>
						<!--<input type="submit" value="Filtrar">-->
					</form>
				</div>
			</div>


			<div class="grid-container text-center" style="justify-content:center; height: 100%">

				<?php
				foreach ($movies as $movie) {
				?>
					<div class="cell">
						<div class="container">
							<a href="<?php echo FRONT_ROOT . 'Movie/ShowMovieDescription?idPelicula=' . $movie->GetId() ?>">
								<img style="width: 188px; height: 282px;" src="https://image.tmdb.org/t/p/original<?php echo $movie->getPosterPath() ?>" alt="Imagen">
							</a>
						</div>
						<div class="container" style="margin:5px;">
							<section>
								<p class="title" style="font-size:12px;	"><?php echo $movie->GetTitle() ?></p>
							</section>
						</div>
						<form action="<?php echo FRONT_ROOT . 'Showtime/ShowAddShowtime' ?>" method="POST">
							<button class="btn btn-outline-primary w-100" name="peliculaId" value="<?php echo $movie->GetId(); ?>" type="submit">+Funcion</button>
						</form>

					</div>
				<?php
				} ?>

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