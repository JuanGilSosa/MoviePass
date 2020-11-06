<?php
	  require_once('Login-Facebook/vendor/autoload.php');
	  require_once('Login-Facebook/App/Auth/Auth.php');
    require_once('nav.php');
?>
<main class="">
    <div class="container text-center table loginTable  w-100" style="padding:0px;">
      
      <form action="<?php echo FRONT_ROOT . 'LogIn\LogIn' ?>" method="POST" class="login-form bg-dark-alpha p-5 mx-auto text-white">

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
                         if(isset($message) && !empty($message))
                         {
                              #echo "<small>" . $message . "</small>";
                              ?>
                              <div class="container">
                                   <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?php echo $message ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                        </button>
                                   </div>
                              </div>
                              <?php
                         } 
                    ?>
        <button class="btn btn-secondary w-50 loginBoton" type="submit">Iniciar Sesión</button>
        <br>
      </form>
      <form action="<?php echo FRONT_ROOT . 'Members\Registrando' ?>" method="POST">
        <label class="text-white" style="margin-right: 10px;">¿Aun no estas registrado?</label><button class="btn btn-secondary btn btn-success w-20">Registrate</button>
      </form>
      
        <a href="<?php echo FRONT_ROOT.'Views/ShowRegisterAdmin'?>" class="text-warning" style="font-size:12px;">Ingresa como Administrador</a>
      
    </div>

    <form action="<?php echo FRONT_ROOT.'LogIn/LogInFB';?>" method="POST" style="margin-bottom:20px;">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <br> 
             <!-- 
              Donde la variable login que se usa el los script de php sea igual a Facebook si presiona el boton
              -->
            <a 
              value="<?php echo Auth::getUserAuth(); ?>"
              href="?login=Facebook" 
              type="submit" 
              class="btn blue-gradient btn-block fab fa-facebook-f"
            >
              &nbsp;&nbsp;Ingresa con Facebook
            </a>
          </div>
        </div>
      </div>
      <!--<#?php include('Login-Facebook\index.php');?>-->
    </form>
</main>
