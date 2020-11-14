<?php
require_once('nav.php');

use Helpers\SessionHelper;

?>
<main class="mx-auto py-5">
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
                        <th class="th-sm">Funcion
                        </th>
                        <th class="th-sm">Cine
                        </th>
                        <th class="th-sm">Sala
                        </th>
                        <th class="th-sm">Fecha
                        </th>
                        <th class="th-sm">Hora
                        </th>
                        <th class="th-sm">Cantidad
                        </th>
                        <th class="th-sm">Sub-Total
                        </th>
                        <th class="th-sm">Eliminar
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cart = SessionHelper::GetValue('CART');
                    $total = 0;
                    foreach ($cart as $index => $ticket) {
                        $showtime = $ticket->GetShowtime();
                        //var_dump($cart);
                        $cinema = $showtime->GetCinema();
                        $movie = $showtime->GetMovie();
                        $titleMovie = $movie->GetTitle();
                        $theatre = $theatreDAO->GetTheatreByCinemaId_cinemasXtheatres($cinema->GetId());



                    ?>
                        <tr>
                            <td><?php echo $movie->GetTitle(); ?></td>
                            <td><?php echo $theatre->GetName(); ?> </td>
                            <td><?php echo $cinema->GetName(); ?> </td>
                            <td><?php echo $showtime->GetReleaseDate(); ?></td>
                            <td><?php echo $showtime->GetStartTime(); ?></td>

                            <td>
                                <!--<button class=""><i class="far fa-minus-square"></i></button>-->
                                <?php echo $ticket->GetNumberOfTickets(); ?>
                                <!--<button class=""><i class="far fa-plus-square"></i></button>-->
                            </td>
                            <td><?php echo '$' . number_format($cinema->GetPrice() * $ticket->GetNumberOfTickets(), 2); ?></td>
                            <th class="th-sm">
                                <a href="<?php echo FRONT_ROOT . 'Cart/RemoveTicket?numberOfTicket=' . $ticket->GetNumberTicket(); ?>" type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i>&nbsp;Quitar
                                </a>
                            </th>
                        </tr>

                    <?php $total = $total + ($cinema->GetPrice() * $ticket->GetNumberOfTickets());
                    } ?>
                    <tr style="background:#8C3FC1;">
                        <td colspan="7" align="right">
                            <h4>Total</h4>
                        </td>
                        <td align="center">
                            <h4><?php echo '$' . number_format($total, 2); ?></h4>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="btn-group ">
                <form action="<?php echo FRONT_ROOT . 'Cart/EmtpyCart'; ?>" method="POST">
                    <button type="submit" value="" class="btn btn-secondary btn-info w-30 h-100" name="empty">VACIAR CARRITO</button>
                </form>
                <form action="<?php echo FRONT_ROOT . 'Cart/ProcessOrder'; ?>" method="POST">
                    <button type="submit" value="" class="btn btn-light-green h-100" name="start-buy">INICIAR COMPRA</button>
                </form>
            </div>
        </div>
    </section>

<main>