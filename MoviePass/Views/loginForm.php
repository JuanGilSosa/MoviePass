<?php
    require_once('nav.php');
?>
<main class="py-5 height-100">
    <div class="container text-center table  w-100" style="padding:0px;">
      
      <form action="<?php echo FRONT_ROOT . 'Users/LogIn' ?>" method="POST" class="login-form bg-dark-alpha p-5 mx-auto text-white">

        <div class="form-group" text-align="center">
          <div class="col userIconCol">
            <span id="userIcon"><i class="far fa-user"></i></span>
          </div>
        </div>
        
        <div class="form-group">
          <input type="text" name="username" class="form-control form-control-lg logInInputs" placeholder="Ingrese su email">
          
        </div>
        
                    
        <div class="form-group">
          <input type="password" name="password" class="form-control form-control-lg logInInputs" placeholder="Ingrese constraseña">
          
        </div>

        <?php 
           if (isset($message))
              echo $message;
           
       ?>

        <br>
        <button class="btn btn-secondary w-50 loginBoton" type="submit">Iniciar Sesión</button>
        <br>

        
        
      </form>
      <form action="<?php echo FRONT_ROOT . 'Users\ShowRegisterForm' ?>" method="POST">
        <label class="text-white" style="margin-right: 10px;">¿Aun no estas registrado?</label><button class="btn btn-secondary btn-danger w-20">Registrate</button>
      </form>
    </div>
    <?php include('Login-Facebook\index.php');?>
</main>
