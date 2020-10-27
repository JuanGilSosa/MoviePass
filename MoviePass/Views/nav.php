  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="<?php  echo FRONT_ROOT . "Home/Index"   ?>">
          <i class="fas fa-film"></i><span class="nameHeader text-white">MoviePass</span>
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarResponsive"
          aria-controls="navbarResponsive"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarResponsive">
          <ul class="navbar-nav ml-auto ">

            <?php if(array_key_exists('adminLogged', $_SESSION)){ 
                      if($_SESSION['adminLogged'] == true){ ?>
            
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger text-white" href="<?php  echo FRONT_ROOT . "Admin/ShowAddView "   ?>">Agregar Cine</a>
              </li>

              <li class="nav-item">
                <a class="nav-link js-scroll-trigger text-white" href="<?php  echo FRONT_ROOT . "Cine/AddViewSala "   ?>">Agregar Sala</a>
              </li>

              <li class="nav-item">
                <a class="nav-link js-scroll-trigger text-white" href="<?php  echo FRONT_ROOT . "Cine/ListViewCine"   ?>">Listar Cines</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger text-white" href="<?php echo FRONT_ROOT. "Pelicula/ShowMovies"?>">Lista Peliculas</a>
              </li>

            <?php }}?>

            <li class="nav-item">
              <a class="nav-link js-scroll-trigger text-white" href="#entradas">Entradas</a>
            </li>

            <li class="nav-item">
                <a class="nav-link js-scroll-trigger text-white" href="<?php echo FRONT_ROOT. "Pelicula/ShowMovies"?>">Lista Peliculas</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger text-white" href="<?php echo FRONT_ROOT. "Pelicula/ShowMovieDescription"?>">Funciones</a>
            </li>
            <?php if (isset($_SESSION['userLogged']) || isset($_SESSION['adminLogged'])){ ?>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger text-white" href="<?php echo FRONT_ROOT."Login/LogOut"?>">Cerrar Sesion</a>
              </li>
            <?php }else{ ?>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger text-white" href="<?php echo FRONT_ROOT."Views/ShowLogIn"?>">Iniciar Sesion</a>
              </li>
            <?php } ?>

          </ul>
        </div>
      </div>
    </nav>