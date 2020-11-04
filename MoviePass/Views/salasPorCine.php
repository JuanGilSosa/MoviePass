<?php
require_once('nav.php');
?>
<main class="mx-auto">
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
                              <th class="th-sm">Cine
                              </th>
                              <th class="th-sm">Nombre Sala
                              </th>
                              <th class="th-sm">Tipo de Sala
                              </th>
                              <th class="th-sm">Precio
                              </th>
                              <th class="th-sm">Capacidad
                              </th>
                              <th class="th-sm">Modificar
                              </th>
                              <th class="th-sm">Eliminar
                              </th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php
                         if (isset($salas)) {
                              
                              foreach ($salas as $sala) {
                                   $cineName = $cine->getNombre();
                                   $salaName = $sala->getNombre();
                                   $tipoDeSala = $sala->getTipo();
                                   $precio = $sala->getPrecio();
                                   $capacidad= $sala->getCapacidad();
                         ?>
                                   <tr>
                                        <td><?php echo $cineName ?> </td>
                                        <td><?php echo $salaName ?> </td>
                                        <td><?php echo $tipoDeSala ?> </td>
                                        <td><?php echo '$'.$precio ?> </td>
                                        <td><?php echo $capacidad ?> </td>
                                       
                                        <form action="<?php echo FRONT_ROOT . 'Sala/ShowModify' ?>" method="POST">
                                             <td><button type="submit" value="<?php echo $cine->getId() ?>" class="btn  btn-info w-20" name="idCine">Modificar</button></td>
                                        </form>
                                        <form action="<?php echo FRONT_ROOT . 'Sala/Delete' ?>" method="post">
                                             <td><button type="submit" value="<?php echo $cine->getId() ?>" class="btn btn-danger w-20" name="eliminar">Eliminar</button></td>
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