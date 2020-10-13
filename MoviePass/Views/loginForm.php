<?php
    require_once('nav.php');
?>
<main class="height-100">
    <div class="container text-center table  w-100" style="padding:0px;">
      
      <form action="<?php echo FRONT_ROOT . 'Members\LogIn' ?>" method="POST" class="login-form bg-dark-alpha p-5 mx-auto text-white">

        <div class="form-group" text-align="center">
          <div class="col userIconCol">
            <span id="userIcon"><i class="far fa-user"></i></span>
          </div>
        </div>
        
        <div class="form-group inputContainer">
          <input type="text" name="username" class="form-control form-control-lg logInInputs" placeholder="Ingrese su email">
          
        </div>
        
        
        <div class="form-group inputContainer">
          <input type="password" name="password" class="form-control form-control-lg logInInputs" placeholder="Ingrese constraseña">
        
        </div>
        <?php
              if(isset($message))
              {
                  echo "<small style='color:#97251bdc'> $message </small><br>"; 
              }
          ?>
        <button class="btn btn-secondary w-50 loginBoton" type="submit">Iniciar Sesión</button>
        <br>
      </form>
      <form action="<?php echo FRONT_ROOT . 'Members\ShowRegisterForm' ?>" method="POST">
        <label class="text-white" style="margin-right: 10px;">¿Aun no estas registrado?</label><button class="btn btn-secondary btn btn-success w-20">Registrate</button>
      </form>
    </div>
    <?php include('Login-Facebook\index.php');?>
</main>
