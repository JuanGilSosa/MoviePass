<!--<main class="" style="height:80%;">
    <div class="container">
        <div class="card form-registro mx-auto">
            <div class="">
                <h2>Bienvenido, <strong>Admin</strong>!</h2>
                <h5>Ingrese su contraseña para ingresar</h5>
            </div>

            <div class="card-body ">
                <form action="<#?php echo FRONT_ROOT . 'Admin/LoginAdmin' ?>" method="POST" class="md-form" style="color: #757575;">
                    <input name="pw" type="password" id="materialLoginFormPassword" class="form-control" placeholder="Contraseña">

                    <#?php
                    if (isset($message) && !empty($message)) {
                        #echo "<small>" . $message . "</small>";
                    ?>
                        <div class="container">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <#?php echo $message ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    <#?php
                    }
                    ?>
                    <button type="submit" class="btn btn-outline-info waves-effect btn-block">Ingresar</button>
            </div>



        </div>
    </div>
</main>-->
