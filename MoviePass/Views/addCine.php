<?php
    require_once('nav.php');

    use DAO\PaisDAO as PaisDAO;
    use Models\Ubicacion\Pais as Pais;
    use DAO\ProvinciaDAO as ProvinciaDAO;
    use Models\Ubicacion\Provincia as Provincia;
    use DAO\CiudadDAO as CiudadDAO;
    use Models\Ubicacion\Ciudad as Ciudad;

    $paisDAO = new PaisDAO(); 
    $paises = $paisDAO->GetAll();

    $provinciaDAO = new ProvinciaDAO();
    $provincias = $provinciaDAO->GetAll();

    $ciudadDAO = new CiudadDAO();
    $ciudades = $ciudadDAO->GetAll();

?>
<main id="page-top" class="no-nav py-5 height-100">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Agregar Cine</h2>
               <form action="<?php echo FRONT_ROOT.'Cine/Add'?>" method="POST" class="bg-light-alpha p-5">
                    
                    <div class="row justify-content-start">
                         <div class="col-lg-8 ">
                              <?php if(isset($message))
                                   {
                                        echo "<small>". $message . "</small>";
                                   } 
                              ?>
                         </div>
                    </div>
                    
                    
                    
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
                         <div class="col-lg-1 d-none">
                              <div class="form-group">
                                   <label for="">Piso</label>
                                   <input type="text" name="departamento" value="" class="form-control " placeholder="Dpto">
                              </div>
                         </div>
                    </div>
                    
                    
                    <div class="row">                         
                         <div class="col-lg-8">
                              <div class="form-group">
                                   <label for="">Ciudad</label>
                                   <select name="pais" class="form-control" placeholder="Seleccione su Ciudad" required>
                                   <?php
                                             foreach ($ciudades as $ciudad)
                                             {
                                                  $name = $ciudad->getNameCiudad();
                                                  $idCiudad = $ciudad->getCodigoPostal();
                                                  ?>
                                                  <option value="<?php echo $idCiudad?>"><?php echo $name?></option>
                                                  
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
                                             foreach ($paises as $pais)
                                             {
                                                  $name = $pais->getNamePais();
                                                  $idPais = $pais->getId();
                                                  ?>
                                                  <option value="<?php echo $idPais?>"><?php echo $name?></option>
                                                  
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

                                             foreach ($provincias as $provincia)
                                             {
                                                  $name = $provincia->getNameProvincia();
                                                  $idProvincia = $provincia->getId();
                                                  
                                                  ?>
                                                  <option value="<?php echo $idProvincia?>"><?php echo $name?></option>
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