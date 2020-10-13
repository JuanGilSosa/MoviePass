<?php
    require_once('nav.php');

    use DAO\CineDAO as CineDAO;
    use Models\Cine\Cine as Cine;
    use DAO\DireccionDAO as DireccionDAO;
    use Models\Ubicacion\Direccion as Direccion;
    use DAO\CiudadDAO as CiudadDAO;
    use Models\Ubicacion\Ciudad as Ciudad;
    use DAO\ProvinciaDAO as ProvinciaDAO;
    use Models\Ubicacion\Provincia as Provincia;
    use DAO\PaisDAO as PaisDAO;
    use Models\Ubicacion\Pais as Pais;
  
    $cineDAO = new CineDAO();
    $cines = $cineDAO->GetAll();

    $direccionDAO = new DireccionDAO();
    $direcciones = $direccionDAO->GetAll();
    
    $ciudadDAO = new CiudadDAO();
    $ciudades = $ciudadDAO->GetAll();

    $provinciaDAO = new ProvinciaDAO();
    $provincias = $provinciaDAO->GetAll();

    $paisDAO = new PaisDAO();
    $paises = $paisDAO->GetAll();

?>
<main class="py-5 height-100">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Cines</h2>
               <table class="table bg-light-alpha text-white">
                    <thead>
                         <th>Nombre</th>
                         <th>Direccion</th>
                         <th>Ciudad</th>
                         <th class="text-right">Acciones</th>
                         <th></th>
                    </thead>
                    <tbody>
                         <?php
                              foreach ($cines as $cine)
                              { 
                                   $name = $cine->getNombre();
                                   $idDireccion = $cine->getIdDireccion();
                                   $direccion = $direccionDAO->GetById($idDireccion);
                                   $ciudad = $ciudadDAO->GetByCodigoPostal($direccion->getCodigoPostal());
                                   $provincia = $provinciaDAO->GetById($ciudad->getIdProvincia());
                                   $pais = $paisDAO->GetById($provincia->getIdPais());     
                         ?>
                                   <tr>
                                        <td><?php echo $name ?> </td>
                                        <td><?php echo $direccion->getCalle() . ", " . $direccion->getNumero() . 
                                             ", " . $direccion->getPiso() . ", " . $direccion->getDepartamento() ?> </td>
                                        <td><?php echo $ciudad->getNameCiudad() .", " .$provincia->getNameProvincia() .", ". $pais->getNamePais() ?> </td>
                                        <td><button class="btn btn-secondary btn-info w-20" type="submit" name="modificar">Modificar</button></td>
                                        <td><button class="btn btn-secondary btn-danger w-20" type="submit" name="eliminar">Eliminar</button></td>
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