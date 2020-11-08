<?php
require_once("nav.php");
?>
<main class="mx-auto h-75">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Modificar Sala</h2>
               <form action="<?php echo FRONT_ROOT . 'Cinema/Update' ?>" method="POST" class="bg-light-alpha p-5">
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
                    
                         <div class="col-lg-12" hidden >
                              <div class="form-group">
                                   <label for="">Cine</label>
                                   <br>
                                   <input type="text" placeholder="Nombre"  disabled required></input>
                                   
                              </div>
                              
                         </div>

                         <div class="col-lg-12 " hidden>
                              <div class="form-group ">
                                   <label for="">Cine ID</label>
                                   <input type="text" name="theatreId" value="<?php echo $cinema->GetId(); ?>"  required></input>
                              </div>
                         </div>
                         
                         <div class="col-lg-6">
                              <div class="form-group">
                                   <label for="">Nombre</label>
                                   <input type="text" name="nombre-sala" value= "<?php echo $cinema->GetName(); ?>" class="form-control" placeholder="Ingrese Nombre de Sala" required>
                              </div>
                         </div>
                         <div class="col-lg-6">
                              <label for="">Tipo de Sala</label>
                              <div class="form-group">
                                   <select name="tipo" class="form-control">
                                   <?php if($cinema->GetType()=="4D") 
                                        $description = "ATMOS";
                                   else 
                                        $description = $cinema->GetType()?>
                                        <option selected="required" value="<?php echo $cinema->GetType() ?>"><?php echo $description?></option>
                                        <option value="2D">2D</option>
                                        <option value="3D">3D</option>
                                        <option value="4D">ATMOS</option>
                                   </select>
                              </div>
                         </div>
                    </div>
                    <div class="row justify-content-start">
                         <div class="col-lg-6">
                              <div class="form-group">
                                   <label for="">Precio</label>
                                   <input type="number" name="precio-sala" value="<?php echo $cinema->GetPrice()?>" min="1" class="form-control" placeholder="$" required>
                              </div>
                         </div>
                         <div class="col-lg-6">
                              <div class="form-group">
                                   <label for="">Capacidad</label>
                                   <input type="number" name="capacidad-sala" value="<?php echo $cinema->GetCapacity()?>" min="1" class="form-control" placeholder="#####" required>
                              </div>
                         </div>
                    </div>

                    <button type="submit" name="button" class="btn btn-light ml-auto d-block">Modificar Sala</button>
               </form>
          </div>
     </section>
</main>