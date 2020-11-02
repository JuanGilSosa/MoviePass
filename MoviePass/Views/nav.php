

<nav class="navbar navbar-expand-lg navbar-dark secondary-color">
<div class="container">
  <!-- Navbar brand -->
  <a class="navbar-brand js-scroll-trigger" href="<?php  echo FRONT_ROOT . "Home/Index"   ?>">
    <i class="fas fa-film"></i><span class="nameHeader text-white">MoviePass</span>
  </a>

  <!-- Collapse button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
    aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Collapsible content -->
  <div class="collapse navbar-collapse" id="basicExampleNav">

    <!-- Links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home
          <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Entradas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo FRONT_ROOT. "Pelicula/ShowMovies"?>">Lista Peliculas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo FRONT_ROOT. "Pelicula/ShowMovieDescription"?>">Funciones</a>
      </li>

      <!-- Dropdown -->
      <?php #isset($_SESSION['userLogged']) 
            if (isset($_SESSION['adminLogged'])){ ?>
                
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">Admins</a>
          <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="<?php  echo FRONT_ROOT . "Admin/ShowAddView "   ?>">Agregar Cine</a>
            <a class="dropdown-item" href="<?php  echo FRONT_ROOT . "Cine/AddViewSala "   ?>">Agregar Sala</a>
            <a class="dropdown-item" href="<?php  echo FRONT_ROOT . "Cine/ListViewCine"   ?>">Listar Cines</a>
            <a class="dropdown-item" href="<?php echo FRONT_ROOT. "Pelicula/ShowMovies"?>">Lista Peliculas</a>
          </div>
        </li>
      <?php } ?>

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
    <!-- Links -->

  </div>
  <!-- Collapsible content -->
</div>
</nav>