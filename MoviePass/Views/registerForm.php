<?php 
    require_once('nav.php');
?>
<main class="py-5 height-100">
    <div class="text-center">
        <form action="<?php echo FRONT_ROOT . 'Members/AddMember' ?>" class="form-registro p-5 mx-auto" method="POST">
            <?php
                if(isset($message))
                {
                    echo "<small>" . $message . "</small>";
                }
            ?>
            <h2 id="h2-registro">Ingresa tus datos</h2>
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
            <div class="form-group"> 
                <button class="btn btn-secondary w-50 loginBoton">Registrarse</button>
            </div>
        </form>
    </div>
</main>