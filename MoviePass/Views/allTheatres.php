<?php
require_once('nav.php');
?>
<main class="mx-auto">
    <section id="listado" class="mb-5">
        <div class="container">
            <table id="dt-vertical-scroll" class="table  table-striped bg-dark text-white" cellspacing="0">

                <?php
                if (isset($message) && !empty($message)) {
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

                <thead>
                    <tr>
                        <th class="th-sm">Nombre
                        </th>
                        <th class="th-sm">Direccion
                        </th>
                        <th class="th-sm">Ciudad
                        </th>
                        <th class="th-sm">Accion
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($theatres)) {
                        foreach ($theatres as $theatre) {
                            $name = $theatre->GetName();
                            $adress = $theatre->GetAdress();
                            $city = $adress->GetCity();
                            $province = $city->GetProvince();
                            $country = $province->GetCountry();
                    ?>
                            <tr>
                                <td><?php echo $name ?> </td>
                                <td><?php
                                    echo $adress->GetStreet() . ", " .
                                        $adress->GetNumber();
                                    if ($adress->GetFloor() != "") {
                                        echo ", " . $adress->GetFloor();
                                    } ?>
                                </td>


                                <td><?php echo $city->GetName() . ", " . $province->GetName() . ", " . $country->GetName() ?> </td>

                                <?php if (!$theatre->GetActive()) { ?>
                                    <form action="<?php echo FRONT_ROOT . 'Theatre/Activate' ?>" method="POST">
                                        <td><button type="submit" value="<?php echo $theatre->GetId() ?>" class="btn btn-info w-20" name="idCine">Activar</button></td>
                                    </form>
                                <?php } else if ($theatre->GetActive()) { ?>
                                    <form action="<?php echo FRONT_ROOT . 'Theatre/Delete' ?>" method="post">
                                        <td><button type="submit" value="<?php echo $theatre->GetId() ?>" class="btn btn-danger w-20" name="eliminar">Eliminar</button></td>
                                    </form>
                                <?php } ?>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td><?php echo "No hay cines para mostrar" ?> </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </section>

    <main>