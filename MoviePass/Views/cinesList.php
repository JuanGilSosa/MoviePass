<?php
    require_once('nav.php');
?>                
<main id="page-top" class="no-nav py-5 height-100">
     <section id="listado" class="mb-5">
          <table id="dt-vertical-scroll" class="table  table-striped bg-dark text-white" cellspacing="0" width="100%" style="margin:0px; padding:0px;">
               <thead>
                    <tr>
                         <th class="th-sm">Nombre
                         </th>
                         <th class="th-sm">Direccion
                         </th>
                         <th class="th-sm">Ciudad
                         </th>
                         <th class="th-sm">Modificar
                         </th>
                         <th class="th-sm">Eliminar
                         </th>
                    </tr>
               </thead>
                    <tbody>
                         <?php
                              foreach ($cines as $cine){ 
                                   $name = $cine->getNombre();
                                   $direccion = $direccionDAO->GetById($cine->getIdDireccion());
                                   $ciudad = $ciudadDAO->GetByCodigoPostal($direccion->getCodigoPostal());
                                   $provincia = $provinciaDAO->GetById($ciudad->getIdProvincia());
                                   $pais = $paisDAO->GetById($ciudad->getIdPais());
                                   ?>
                                   <tr>
                                        <td><?php echo $name ?> </td>
                                        <td><?php echo $direccion->getCalle() . ", " . $direccion->getNumero() . 
                                             ", " . $direccion->getPiso() . ", " . $direccion->getDepartamento() ?> </td>
                                        <td><?php echo $ciudad->getNameCiudad() .", " .$provincia->getNameProvincia() .", ". $pais->getNamePais() ?> </td>
                                        <!-- Estos dos botones mejor los voy a poner en un formulario porque ta dificil obtener value con este framework --> 
                                        <form action="<?php echo FRONT_ROOT.'Cine/ShowModifyCine' ?>" method="post">
                                             <td><button type="submit" value="<?php echo $cine->getId() ?>" class="btn btn-secondary btn-info w-20" name="modificar">Modificar</button></td>
                                             <td><button type="submit" value="<?php echo $cine->getId() ?>" class="btn btn-secondary btn-danger w-20" name="eliminar">Eliminar</button></td>
                                        </form>
                                        <
                                   </tr>             
                        <?php }?>  
                    </tbody>
          </table>
     </section>

<script src="<?php echo JS_PATH . "tables.js" ?>"></script>
<main>
