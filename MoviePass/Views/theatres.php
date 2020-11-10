<?php
require_once('nav.php');
?>
<main class="mx-auto">
     <section id="listado" class="mb-5">
          
          <div class="container py-3">
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
                              <th class="th-sm">Salas
                              </th>
                              <th class="th-sm">
                              </th>
                              <th class="th-sm">Modificar
                              </th>
                              <th class="th-sm">Eliminar
                              </th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php
                         if (isset($theatres)) {
                              foreach ($theatres as $theatre) {
                                   $name = $theatre->GetName();
                                   $adress = $theatre->GetAdress();
                                   $city = $adress->GetCity();
                                   $province = $city->GetProvince();
                                   $country = $province->GetCountry();
                         ?>
                                   <tr>
                                        <td><?php echo $name ?> </td>
                                        <td><?php
                                             echo $adress->GetStreet() . ", " .
                                                  $adress->GetNumber() ;
                                             if ($adress->GetFloor() != "") {
                                                  echo ", " . $adress->GetFloor();
                                             } ?>
                                        </td>


                                        <td><?php echo $city->GetName() . ", " . $province->GetName() . ", " . $country->GetName() ?> </td>

                                        <form action="<?php echo FRONT_ROOT . 'Cinema/ViewAddCinema' ?>" method="POST">
                                             <td><button type="submit" value="<?php echo $theatre->GetId() ?>" class="btn btn-secondary btn-info w-20" name="idCine">+Sala</button></td>
                                        </form>
                                        <form action="<?php echo FRONT_ROOT . 'Cinema/ShowCinemasByTheatre' ?>" method="POST">
                                             <td><button type="submit" value="<?php echo $theatre->GetId() ?>" class="btn btn-secondary btn-info w-20" name="idCine">Lista</button></td>
                                        </form>
                                        <form action="<?php echo FRONT_ROOT . 'Theatre/ShowModify' ?>" method="POST">
                                             <td><button type="submit" value="<?php echo $theatre->GetId() ?>" class="btn btn-info w-20" name="idCine">Modificar</button></td>
                                        </form>
                                        <form action="<?php echo FRONT_ROOT . 'Theatre/Delete' ?>" method="post">
                                             <td><button type="submit" value="<?php echo $theatre->GetId() ?>" class="btn btn-danger w-20" name="eliminar">Eliminar</button></td>
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
          <div class="container" style="display:flex; justify-content:flex-end">
               <a type="button" class="btn btn-light" href="<?php echo FRONT_ROOT . 'Theatre/ShowAllTheatres' ?>">Listado de Cines</a>
          </div>
     </section>

     <main>