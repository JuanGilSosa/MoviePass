<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Cines</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Nombre</th>
                         <th>Direccion</th>
                         <th>Localidad</th>
                    </thead>
                    <tbody>
                         <?php
                              $contador = 0;
                              while($contador < count($cines))
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $cines[$contador]->getNombre() ?></td>
                                             <td><?php echo $direccion[$contador]->getCalle()  ?></td>
                                             <td><?php echo $localidad->getLocalidad() ?></td>
                                        </tr>
                                   <?php
                              }
                         ?>
                         
                         </tr>
                    </tbody>
               </table>
          </div>
     </section>
</main>