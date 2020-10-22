<?php require_once('nav.php');

     use DAO\PaisDAO as PaisDAO;
     use DAO\ProvinciaDAO as ProvinciaDAO;
     use DAO\CiudadDAO as CiudadDAO;
     use DAO\DireccionDAO as DireccionDAO;

     use Models\Ubicacion\Provincia as Provincia;
     use Models\Ubicacion\Pais as Pais;
     use Models\Ubicacion\Ciudad as Ciudad;

     $paisDAO = new PaisDAO(); 
     $paises = $paisDAO->GetAll();

     $provinciaDAO = new ProvinciaDAO();
     $provincias = $provinciaDAO->GetAll();

     $ciudadDAO = new CiudadDAO();
     $ciudades = $ciudadDAO->GetAll();

     $direccionDAO = new DireccionDAO();
     $direccion = $direccionDAO->GetById($miCine->getIdDireccion());

?>
<main id="page-top" class="no-nav py-5 height-100">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Modificar Cine</h2>
               <form action="<?php echo FRONT_ROOT .'Cine/Update'?>" method="POST" class="bg-light-alpha p-5">
                    <div class="row justify-content-start">      

                         <div class="col-lg-2 ">
                              <div class="form-group">
                                   <label for="">I.D. Cine</label>
                                   <input type="text" name="id" value="<?php if(isset($_POST['idCine'])){ $idCine = $_POST['idCine']; echo $idCine;} ?>" class="form-control" placeholder="<?php $idCine; ?>" required>
                              </div>
                         </div>                   

                         <div class="col-lg-10 ">
                              <div class="form-group">
                                   <label for="">Nombre</label>
                                   <input type="text" name="nombre" class="form-control" value="<?php echo $miCine->getNombre() ?>" required>
                              </div>
                         </div>
                    </div>
                    <div class="row justify-content-start">                         
                         <div class="col-lg-6">
                              <div class="form-group">
                                   <label for="">Email</label>
                                   <input type="email" name="email" class="form-control" value="<?php echo $miCine->getEmail() ?>" required>
                              </div>
                         </div>
                         <div class="col-lg-6">
                              <div class="form-group">
                                   <label for="">Telefono/Celular</label>
                                   <input type="text" name="numeroDeContacto"  class="form-control" value="<?php echo $miCine->getNumeroDeContacto() ?>" required>
                              </div>
                         </div>
                    </div>
                    <div class="row justify-content-start" type="hidden">                         
                         <input type="hidden" name="idDireccion" value="<?php echo $miCine->getIdDireccion()?>" class="form-control">
                    </div>

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