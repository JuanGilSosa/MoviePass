<?php 
    require_once('nav.php');
?>
<main class="py-2">
    <div class="row container mx-auto" >
    <div class="col" style="width:50%">
        <form action="<?php echo FRONT_ROOT . 'Members/AddMember' ?>" class="form-registro mx-auto" style="padding:0;" method="POST">
            <?php
                if(isset($message))
                {
                    echo "<small>" . $message . "</small>";
                }
            ?>
            <h2 id="h2-registro"><strong>Ingresa tus datos</strong></h2>
            <div class="form-group"> 
                <label class="p-registro text-white">Nombre</label><input class="input-registro text-white" name="firstName" type="text" placeholder="Mi nombre" required></input>
            </div>
            <div class="form-group"> 
                <label class="p-registro">Apellido</label><input class="input-registro text-white" name="lastName" type="text" placeholder="Mi apellido" required ></input> 
            </div>
            <div class="form-group"> 
                <label class="p-registro" >DNI</label><input class="input-registro text-white" name="dni" type="number" placeholder="ejemplo.: 77777777" required ></input>
            </div>
            <div class="form-group"> 
                <label class="p-registro">Email:</label><input class="input-registro text-white" name="email" type="email" placeholder="ejemplo: finema@fenter.com" required ></input>
            </div>
            <div class="form-group"> 
                <label class="p-registro">Contraseña</label><input class="input-registro text-white" name="password" type="password" placeholder="Mi Contraseña" required ></input>
            </div>
            <div class="form-group"> 
                <label class="p-registro">Repite constraseña</label><input class="input-registro text-white" name="checkPassword" type="password" placeholder="Repetir contraseña" required ></input>
            </div>
            <div class="form-group" style="display:flex; justify-content: center;"> 
                <button class="btn btn-secondary w-50 loginBoton">Registrarse</button>
            </div>
        </form>
    </div>
    <div class="col p-5 mx-auto" style="width:50%;">
        <div class="container">
            <img src="<?php echo IMG_PATH . 'bannerRegistro.jpg'; ?>" style="height: 90vh;">

        </div>
    </div>
    </div>

</main>