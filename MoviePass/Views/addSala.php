<?php 
    require_once("nav.php");
?>
<main id="page-top" class="no-nav py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Agregar Sala</h2>
               <form action="<?php echo FRONT_ROOT.'Cine/AddSala'?>" method="POST" class="bg-light-alpha p-5">
                    <div class="row justify-content-start">                         
                         <div class="col-lg-6">
                              <div class="form-group">
                                   <label for="">Nombre</label>
                                   <input type="text" name="nombre-sala" value="" class="form-control" placeholder="Ingrese Nombre de Sala" required>
                              </div>
                         </div>
                         <div class="col-lg-6">
                            <label for="">Cines</label>
                              <div class="form-group">   
                                    <select name="select-movies" class="form-control">
                                    <option selected="true" disabled="disabled">Seleccione Cine</option>
                                    <?php foreach($cines as $cine){?>
                                        <option value="<?php echo $cine->getId() ?>" required><?php echo $cine->getNombre() ?></option>
                                    <?php }?>
                                   </select>
                              </div>
                         </div>
                    </div>
                    <div class="row justify-content-start">                         
                         <div class="col-lg-6">
                              <div class="form-group">
                                   <label for="">Precio</label>
                                   <input type="number" name="precio-sala" value="" class="form-control" placeholder="$" required>
                              </div>
                         </div>
                         <div class="col-lg-6">
                              <div class="form-group">
                                   <label for="">Capacidad</label>
                                   <input type="number" name="capacidad-sala" value="" class="form-control" placeholder="#####" required>
                              </div>
                         </div>
                    </div>
                    <button type="submit" name="button" class="btn btn-light ml-auto d-block">Cargar Sala</button>
               </form>
          </div>
     </section>
</main>