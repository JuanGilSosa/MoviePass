<?php
require_once("nav.php");
?>
<main class="mx-auto h-75">
    <section id="listado" class="mb-5">
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
            <h2 class="mb-4">Agregar Funcion</h2>
            <form action="<?php echo FRONT_ROOT . 'Funcion/AddFuncion' ?>" method="POST" class="bg-light-alpha p-5">
                <div class="row justify-content-start">
                   
                    <div class="col-lg-6">
                        <label for="">Elegi el Cine</label>
                        <div class="form-group">
                            <select name="select-movies" class="form-control" onchange="">
                                <option selected="true" disabled="disabled">Seleccione Cine</option>
                                <?php foreach ($cines as $cine) {?>
                                    <option value="<?php echo $cine->getId() ?>" required><?php echo $cine->getNombre() ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label for="">Elegi la Sala</label>
                        <div class="form-group">
                            <select name="select-movies" class="form-control" onchange="">
                                <option selected="true" disabled="disabled">Seleccione Sala</option>
                                <?php foreach ($salas as $sala) { ?>
                                    <option value="<?php echo $sala->getId() ?>" required><?php echo $sala->getNombre() ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Pelicula</label>
                            <input type="text" name="peliculaId" placeholder="<?php echo $pelicula->getTitle() ?>" value="<?php echo $pelicula->getId() ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label for="">Horario de funcion</label>
                        <div class="form-group">
                            <input type="time" name="horaInicio" min="17:00" max="23:00" class="w-100" class="form-control" required />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">En cartelera desde:</label>
                            <input type="date" name="fechaInicio" class="w-100"  class="form-control" required />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label for="">En cartelera hasta:</label>
                        <div class="form-group">
                            <input type="date" name="fechaFin" class="w-100" class="form-control" required />
                        </div>
                    </div>
                </div>
                <button type="submit" name="button" class="btn btn-light ml-auto d-block">Cargar Sala</button>
            </form>
        </div>
    </section>
</main>