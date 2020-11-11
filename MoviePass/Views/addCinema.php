<?php
require_once("nav.php");
?>
<main class="mx-auto h-75">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Agregar Sala</h2>
               <form action="<?php echo FRONT_ROOT . 'Cinema/AddCinema' ?>" method="POST" class="bg-light-alpha p-5">
                    <div class="row justify-content-start">

                    <?php
                         if(isset($message) && !empty($message))
                         {
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
                    
                         <div class="col-lg-12">
                              <div class="form-group">
                                   <label for="">Cine</label>
                                   <br>
                                   <input type="text" placeholder="<?php echo $theatre->GetName() ?>"  disabled required></input>
                                   
                              </div>
                              
                         </div>

                         <div class="col-lg-12 " hidden>
                              <div class="form-group ">
                                   <label for="">Cine ID</label>
                                   <input type="text" name="theatreId" value="<?php echo $theatre->GetId() ?>"  required></input>
                              </div>
                         </div>
                         
                         <div class="col-lg-6">
                              <div class="form-group">
                                   <label for="">Nombre</label>
                                   <input type="text" name="nombre-sala" value="" class="form-control" placeholder="Ingrese Nombre de Sala" required>
                              </div>
                         </div>
                         <div class="col-lg-6">
                              <label for="">Tipo de Sala</label>
                              <div class="form-group">
                                   <select name="tipo" class="form-control">
                                        <option selected="true" disabled="disabled">Seleccione Tipo</option>
                                        <option value="2D" required>2D</option>
                                        <option value="3D" required>3D</option>
                                        <option value="4D" required>ATMOS</option>
                                   </select>
                              </div>
                         </div>
                    </div>
                    <div class="row justify-content-start">
                         <div class="col-lg-6">
                              <div class="form-group">
                                   <label for="">Precio</label>
                                   <input type="number" name="precio-sala" value="" min="1" class="form-control" placeholder="$" required>
                              </div>
                         </div>
                         <div class="col-lg-6">
                              <div class="form-group">
                                   <label for="">Capacidad</label>
                                   <input type="number" name="capacidad-sala" value="" min="1" class="form-control" placeholder="#####" required>
                              </div>
                         </div>
                    </div>
                    
                    <button type="submit" name="button" class="btn btn-light ml-auto d-block">Cargar Sala</button>
               </form>
          </div>
     </section>
</main>