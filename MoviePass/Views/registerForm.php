<?php 
    require_once('nav.php');
?>
<main class="py-5 height-100">
    <div class="text-center">
        <form action="<?php echo FRONT_ROOT . 'Members/AddMember' ?>" class="form-registro p-5 mx-auto" method="POST">
            <h2 id="h2-registro">Ingresa tus datos</h2>
            <div class="form-group"> 
                <label class="p-registro text-white" type="Nombre:"></label><input class="input-registro text-white" name="firstName" type="text" placeholder="Mi nombre"></input>
            </div>
            <div class="form-group"> 
                <label class="p-registro" type="Apellido:"></label><input class="input-registro text-white" name="lastName" type="text" placeholder="Mi apellido"></input> 
            </div>
            <div class="form-group"> 
                <label class="p-registro" type="D.N.I:"></label><input class="input-registro text-white" name="dni" type="number" placeholder="ejemplo.: 77777777"></input>
            </div>
            <div class="form-group"> 
                <label class="p-registro" type="Email:"></label><input class="input-registro text-white" name="email" type="email" placeholder="ejemplo: finema@fenter.com"></input>
            </div>
            <div class="form-group"> 
                <label class="p-registro" type="Contraseña:"></label><input class="input-registro text-white" name="password" type="password" placeholder="Mi Contraseña"></input>
            </div>
            <div class="form-group"> 
                <label class="p-registro" type="Ingrese su contraseña nuevamente:"></label><input class="input-registro text-white" name="checkPassword" type="password" placeholder="Repetir contraseña"></input>
            </div>
            <div class="form-group"> 
                <button class="btn btn-secondary w-50 loginBoton">Registrarse</button>
            </div>
        </form>
    </div>
</main>