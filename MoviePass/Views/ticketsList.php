<?php
require_once('nav.php');
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
                        <th class="th-sm">N° de Ticket
                        </th>
                        <th class="th-sm">Pelicula
                        </th>
                        <th class="th-sm">Fecha
                        </th>    
                    </tr>
                </thead>
                <tbody>
                <?php foreach($tickets as $index=>$ticket){
                            if($ticket->GetNumberOfTickets() == 1){
                                $showtime = $ticket->GetShowtime();
                                $movie = $showtime->GetMovie();
                ?>
                    <tr>
                        <td><?php echo $ticket->GetNumberTicket();    ?></td>
                        <td><?php echo $movie->GetTitle();             ?></td>
                        <td><?php echo $showtime->GetReleaseDate();?></td>
                    </tr>
                    <?php }elseif($ticket->GetNumberOfTickets() > 1){
                                for($i = 0 ; $i<$ticket->GetNumberOfTickets();$i+=1){
                                    $showtime = $ticket->GetShowtime();
                                    $movie = $showtime->GetMovie();
                                ?>
                                    <tr>
                                        <td><?php echo $ticket->GetNumberTicket();    ?></td>
                                        <td><?php echo $movie->GetTitle();             ?></td>
                                        <td><?php echo $showtime->GetReleaseDate();?></td>
                                    </tr> 
                            <?php }}}?>
                </tbody>
            </table>
        </div>
    </section>
<main>