<?php
    require_once('nav.php');
?>
<main class="mx-auto">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Agregar Cine</h2>
               <form action="<?php echo FRONT_ROOT.'Theatre/Add'?>" method="POST" class="bg-light-alpha p-5">
                    
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
                    
                    
                    
                    <div class="row justify-content-start">                         
                         <div class="col-lg-8 ">
                              <div class="form-group">
                                   <label for="">Nombre</label>
                                   <input type="text" name="nombre" value="" class="form-control" placeholder="Ingrese Nombre del Cine" required>
                              </div>
                         </div>
                    </div>
                    <div class="row justify-content-start">                         
                         <div class="col-lg-6">
                              <div class="form-group">
                                   <label for="">Email</label>
                                   <input type="email" name="email" value="" class="form-control" placeholder="Ingrese Email de Contacto" required>
                              </div>
                         </div>
                         <div class="col-lg-6">
                              <div class="form-group">
                                   <label for="">Telefono/Celular</label>
                                   <input type="text" name="numeroDeContacto" value="" class="form-control" placeholder="Ingrese Nº de Contacto" required>
                              </div>
                         </div>
                    </div>

                    <div class="row">                         
                         <div class="col-lg-6">
                              <div class="form-group">
                                   <label for="">Calle</label>
                                   <input type="text" name="calle" value="" placeholder="Ingrese Calle" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Numero</label>
                                   <input type="text" name="numero" value="" class="form-control" placeholder="Ingrese Altura" required>
                              </div>
                         </div>
                         <div class="col-lg-2">
                              <div class="form-group">
                                   <label for="">Piso</label>
                                   <input type="text" name="piso" value="" class="form-control" placeholder="Piso" >
                              </div>
                         </div>
                    </div>


               
                    
                   
                   

                    <div class="row">                         
                         <div class="col-lg-8">
                              <div class="form-group">
                                   <label for="">Ciudad</label>
                                   <select name="ciudad" class="form-control" placeholder="Seleccione su Ciudad" " required>
                                   <?php
                                             foreach ($cities as $city)
                                             {
                                                  $cityName = $city->GetName();
                                                  $cityId = $city->GetZipCode();
                                                  ?>
                                                  <option value="<?php echo $cityId?>"><?php echo $cityName?></option>
                                                  
                                             <?php 
                                             }
                                             ?>
                                   </select>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Cod. Postal</label>
                                   <input type="text" name="codigoPostal" value="" class="form-control" placeholder="e.g. 7600" required>
                              </div>
                         </div>
                    </div>

                    <div class="row">    
                         
                         <div class="col-lg-6">
                              <div class="form-group">
                                   <label for="">Pais</label>
                                   <select name="pais" class="form-control" placeholder="Seleccione su Pais" required>
                                        <?php
                                             foreach ($countries as $country)
                                             {
                                                  $countryName = $country->GetName();
                                                  $countryId = $country->GetId();
                                                  ?>
                                                  <option value="<?php echo $countryId;?>"><?php echo $countryName;?></option>
                                                  
                                             <?php 
                                             }
                                        ?>
                                   </select>
                              </div>
                         </div>

                         <div class="col-lg-6">
                              <div class="form-group">
                                   <label for="">Provincia</label>
                                   <select name="provincia" class="form-control" placeholder="Seleccione su Provincia" required>
                                   <?php

                                             foreach ($provinces as $province)
                                             {
                                                  ?>
                                                  <option value="<?php echo $province->GetId();?>"><?php echo $province->GetName();?></option>
                                             <?php 
                                             }
                                             ?>
                                   </select>
                              </div>
                         </div>
                    </div>
                    
                    <button type="submit" name="button" class="btn btn-light ml-auto d-block">Agregar</button>
               </form>
          </div>
     </section>
</main>