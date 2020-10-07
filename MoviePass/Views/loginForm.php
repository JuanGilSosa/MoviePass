<?php
    require_once('nav.php');
?>
<main class="py-5">
<div class="container text-center table  w-100" style="padding:0px;">
      
      <form action="<?php echo FRONT_ROOT . 'Users/LogIn' ?>" method="POST" class="login-form bg-dark-alpha p-5 mx-auto text-white">

        <div class="form-group" text-align="center">
          <div class="col userIconCol">
            <span id="userIcon"><i class="far fa-user"></i></span>
          </div>
        </div>
        
        <div class="form-group">
          <input type="text" name="username" class="form-control form-control-lg logInInputs" placeholder="Ingrese Nº de Documento">
          <?php
              if(isset($loggedUser) && $loggedUser->getEmail() == 'false')
              {
                  echo "<div style='color:#97251bdc'>Nº de Documento incorrecto </div>";
              }
          ?>
        </div>
        
        
        <div class="form-group">
          <input type="password" name="password" class="form-control form-control-lg logInInputs" placeholder="Ingrese constraseña">
          <?php
              if(isset($loggedUser) && $loggedUser->getPassword() == 'false')
              {
                  echo "<div style='color:#97251bdc'>Contraseña incorrecto </div>";
              }
          ?>
        </div>
        <br>
        <button class="btn btn-secondary w-50 loginBoton" type="submit">Iniciar Sesión</button>
      </form>
    </div>
    
</main>