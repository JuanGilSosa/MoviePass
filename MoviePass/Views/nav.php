<?php use Helpers\SessionHelper; ?>

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
  
      
      <li class="nav-item">
        <a class="nav-link" href="<?php echo FRONT_ROOT. "Showtime/ShowShowtimes"?>">Cartelera</a>
      </li>

      <!-- Dropdown -->
      <?php #isset($_SESSION['userLogged']) 
            if (SessionHelper::isSession('adminLogged')){ ?>
                
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">Admins</a>
          <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="<?php echo FRONT_ROOT . "Admin/ShowAddView"   ?>">Agregar Cine</a>
            <a class="dropdown-item" href="<?php echo FRONT_ROOT . "Theatre/ShowTheatres"?>">Listar Cines</a>
            <a class="dropdown-item" href="<?php echo FRONT_ROOT . "Movie/ShowMovies"     ?>">Lista Peliculas</a>
            <a class="dropdown-item" href="<?php echo FRONT_ROOT . "Theatre/ShowStatsTheatre"?>">Ventas</a>
          </div>
        </li>
      <?php } ?>
      <?php if(!SessionHelper::isSession('adminLogged')){?>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo FRONT_ROOT.'Cart/ShowCart'?>">
            Carrito 
              <?php 
                echo '(';
                echo (!SessionHelper::isSession('CART')) ? 0 : (SessionHelper::LengthOfKey('CART'));
                echo ')';                                                              
              ?>
            
        </a>
      </li>
      <?php }?>
      <?php if (SessionHelper::isSession('userLogged')){ ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo FRONT_ROOT.'Ticket/ShowTicketsOfMember?idMember='.SessionHelper::GetValue('userLogged')->GetId(); ?>">Mis Entradas</a>
            </li>
            <?php } ?>
      <?php if (SessionHelper::isSession('userLogged') || SessionHelper::isSession('adminLogged')){ ?>
              <li class="nav-item active">
                <a class="nav-link js-scroll-trigger text-white" href="<?php echo FRONT_ROOT."Login/LogOut"?>">Cerrar Sesion</a>
              </li>
            <?php }else{ ?>
              <li class="nav-item active">
                <a class="nav-link js-scroll-trigger text-white" href="<?php echo FRONT_ROOT."Views/ShowLogIn"?>">Iniciar Sesion</a>
              </li>
            <?php } ?>


    </ul>
    <!-- Links -->

  </div>
  <!-- Collapsible content -->
</div>
</nav>