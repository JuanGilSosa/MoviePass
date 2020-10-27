<?php
require_once('nav.php');
?>
<main id="page-top" class="no-nav py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <table id="dt-vertical-scroll" class="table  table-striped bg-dark text-white" cellspacing="0">

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
                         if (isset($cines)) {
                              foreach ($cines as $cine) {
                                   //var_dump($cine);
                                   $name = $cine->getNombre();
                                   $direccion = $cine->getDireccion();
                                   $ciudad = $direccion->getCiudad();
                                   $provincia = $ciudad->getProvincia();
                                   $pais = $provincia->getPais();
                         ?>
                                   <tr>
                                        <td><?php echo $name ?> </td>
                                        <td><?php
                                             echo $direccion->getCalle() . ", " .
                                                  $direccion->getNumero();
                                             if ($direccion->getPiso() != "") {
                                                  echo ", " . $direccion->getPiso();
                                             }?>
                                        </td>


                                        <td><?php echo $ciudad->getNameCiudad() . ", " . $provincia->getNameProvincia() . ", " . $pais->getNamePais() ?> </td>


                                        <form action="<?php echo FRONT_ROOT . 'Cine/ShowModify' ?>" method="POST">
                                             <td><button type="submit" value="<?php echo $cine->getId() ?>" class="btn btn-secondary btn-info w-20" name="idCine">Modificar</button></td>
                                        </form>
                                        <form action="<?php echo FRONT_ROOT . 'Cine/Delete' ?>" method="post">
                                             <td><button type="submit" value="<?php echo $cine->getId() ?>" class="btn btn-secondary btn-danger w-20" name="eliminar">Eliminar</button></td>
                                        </form>

                                   </tr>
                              <?php
                              }
                         } else {
                              ?>
                              <tr>
                                   <td><?php echo "No hay cines para mostrar" ?> </td>
                              </tr>
                         <?php } ?>

                    </tbody>
               </table>
          </div>
     </section>

     <main>