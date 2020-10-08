<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">
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
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger text-white" href="#about">Entradas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger text-white" href="<?php  echo FRONT_ROOT . "Cine/ShowListView"   ?>">Cines</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger text-white" href="<?php  echo FRONT_ROOT . "Cine/ShowAddView "   ?>">Agregar Cine</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger text-white" href="#contact">Contacto</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger text-white" href="<?php  echo FRONT_ROOT . "Users/LogOut"   ?>">Cerrar Sesion</a>
            </li>
            
          </ul>
        </div>
      </div>
    </nav>