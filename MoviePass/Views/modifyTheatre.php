<main id="page-top" class="no-nav py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Modificar Cine</h2>
               <form action="<?php echo FRONT_ROOT .'Theatre/Update'?>" method="POST" class="bg-light-alpha p-5">
                    <?php
                         if(isset($message) && !empty($message))
                         {
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
                    <div class="row justify-content-start" >      
                         <div class="col-lg-2" hidden>
                              <div class="form-group">
                                   <label for="">I.D. Cine</label>
                                   <input type="text" name="id" value="<?php echo $theatre->GetId() ?>" class="form-control" placeholder="<?php $idCine; ?>" required>
                              </div>
                         </div>                   

                         <div class="col-lg-6 ">
                              <div class="form-group">
                                   <label for="">Nombre</label>
                                   <input type="text" name="nombre" class="form-control" value="<?php echo $theatre->GetName() ?>" required>
                              </div>
                         </div>
                    </div>
                    <div class="row justify-content-start">                         
                         <div class="col-lg-6">
                              <div class="form-group">
                                   <label for="">Email</label>
                                   <input type="email" name="email" class="form-control" value="<?php echo $theatre->GetEmail() ?>" required>
                              </div>
                         </div>
                         <div class="col-lg-6">
                              <div class="form-group">
                                   <label for="">Telefono/Celular</label>
                                   <input type="text" name="numeroDeContacto"  class="form-control" value="<?php echo $theatre->GetPhoneNumber() ?>" required>
                              </div>
                         </div>
                    </div>
                    
                    <div class="row justify-content-start" type="hidden">                         
                         <input type="hidden" name="idDireccion" value="<?php echo $theatre->GetAdress()?>" class="form-control">   
                    </div>

                    <div class="row">    
                         <div class="col">
                              <div class="form-group">
                                   <button type="submit" name="button" class="btn btn-success">Modificar</button>
                              </div>
                         </div>
                    </div>
                    
                    
               </form>
          </div>
     </section>
</main>