<?php
    require_once('nav.php');
?>
<main id="page-top" class="no-nav py-5 height-100">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Agregar Cine</h2>
               <form action="<?php echo FRONT_ROOT ?>Cine/Add" method="POST" class="bg-light-alpha p-5">
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
                                   <input type="text" name="localidad" value="" placeholder="Ingrese Localidad" class="form-control" required>
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
                                   <label for="">Provincia</label>
                                   <input type="text" name="provincia" value="" class="form-control" placeholder="Ingrese Provincia" required>
                              </div>
                         </div>
                         <div class="col-lg-6">
                              <div class="form-group">
                                   <label for="">Pais</label>
                                   <select class="form-control" name="paises" id="">
                                        <option value="0">Argentina</option>
                                        <option value="1">Venezuela</option>
                                        <option value="2">Chile</option>
                                        <option value="3">Uruguay</option>
                                        <option value="4">Paraguay</option>
                                        <option value="5">Peru</option>
                                        <option value="6">Bolivia</option>
                                        <option value="7">Ecuador</option>
                                        <option value="8">Colombia</option>
                                   </select>
                                   <!--<input type="text" name="pais" value="" class="form-control" placeholder="Ingrese Pais" required>-->
                              </div>
                         </div>
                    </div>
                    
                    <button type="submit" name="button" class="btn btn-light ml-auto d-block">Agregar</button>
               </form>
          </div>
     </section>
</main>