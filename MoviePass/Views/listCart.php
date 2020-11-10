
<!--
<#?php 
    use Helpers\SessionHelper;
    require_once('nav.php');
    #$tickets = $myCart->GetTickets();
    #foreach($tickets as $ticket):
    #    $showtime = $ticket->GetShowtime();
    #    $movie = $showtime->GetMovie();
    #    $titleMovie = $movie->GetTitle();
    if(SessionHelper::isSession('CART')){
        $values = SessionHelper::GetValue('CART');
        if(!empty($values)){
?>
<div class="container">
    <div class="row">

        <main id="items" class="col-sm-8 row"></main>

        <aside class="col-sm-4">
            <h2>Carrito</h2>  
            <ul id="carrito" class="list-group">
            <#?php foreach($values as $value){?>
                <li> <#?php var_dump($value);?></li>
            <#?php }?>
            </ul>
            <hr>

            <p class="text-right">Total: <span id="total"></span>&euro;</p>
            <button id="boton-vaciar" class="btn btn-danger">Vaciar</button>
        </aside>
    </div>
</div>
    <#?php }}?> -->
    <!--<#?php endforeach; ?>-->
<!--
<script>
        window.onload = function () {
            // Variables
            let baseDeDatos = [
                {
                    id: 1,
                    nombre: 'Patata',
                    precio: 1,
                    imagen: 'https://source.unsplash.com/random/500x500/?potato&sig=1'
                },
                {
                    id: 2,
                    nombre: 'Cebolla',
                    precio: 1.2,
                    imagen: 'https://source.unsplash.com/random/500x500/?onion&sig=2'
                },
                {
                    id: 3,
                    nombre: 'Calabacin',
                    precio: 2.1,
                    imagen: 'https://source.unsplash.com/random/500x500/?zucchini&sig=3'
                },
                {
                    id: 4,
                    nombre: 'Fresas',
                    precio: 0.6,
                    imagen: 'https://source.unsplash.com/random/500x500/?burrs&sig=4'
                }

            ]
            let $items = document.querySelector('#items');
            let carrito = [];
            let total = 0;
            let $carrito = document.querySelector('#carrito');
            let $total = document.querySelector('#total');
            let $botonVaciar = document.querySelector('#boton-vaciar');

            // Funciones
            function renderItems() {
                for (let info of baseDeDatos) {
                    // Estructura
                    let miNodo = document.createElement('div');
                    miNodo.classList.add('card', 'col-sm-4');
                    // Body
                    let miNodoCardBody = document.createElement('div');
                    miNodoCardBody.classList.add('card-body');
                    // Titulo
                    let miNodoTitle = document.createElement('h5');
                    miNodoTitle.classList.add('card-title');
                    miNodoTitle.textContent = info['nombre'];
                    // Imagen
                    let miNodoImagen = document.createElement('img');
                    miNodoImagen.classList.add('img-fluid');
                    miNodoImagen.setAttribute('src', info['imagen']);
                    // Precio
                    let miNodoPrecio = document.createElement('p');
                    miNodoPrecio.classList.add('card-text');
                    miNodoPrecio.textContent = info['precio'] + '€';
                    // Boton 
                    let miNodoBoton = document.createElement('button');
                    miNodoBoton.classList.add('btn', 'btn-primary');
                    miNodoBoton.textContent = '+';
                    miNodoBoton.setAttribute('marcador', info['id']);
                    miNodoBoton.addEventListener('click', anyadirCarrito);
                    // Insertamos
                    miNodoCardBody.appendChild(miNodoImagen);
                    miNodoCardBody.appendChild(miNodoTitle);
                    miNodoCardBody.appendChild(miNodoPrecio);
                    miNodoCardBody.appendChild(miNodoBoton);
                    miNodo.appendChild(miNodoCardBody);
                    $items.appendChild(miNodo);
                }
            }

            function anyadirCarrito () {
                // Anyadimos el Nodo a nuestro carrito
                carrito.push(this.getAttribute('marcador'))
                // Calculo el total
                calcularTotal();
                // Renderizamos el carrito 
                renderizarCarrito();
            }

            function renderizarCarrito() {
                // Vaciamos todo el html
                $carrito.textContent = '';
                // Quitamos los duplicados
                let carritoSinDuplicados = [...new Set(carrito)];
                // Generamos los Nodos a partir de carrito
                carritoSinDuplicados.forEach(function (item, indice) {
                    // Obtenemos el item que necesitamos de la variable base de datos
                    let miItem = baseDeDatos.filter(function(itemBaseDatos) {
                        return itemBaseDatos['id'] == item;
                    });
                    // Cuenta el número de veces que se repite el producto
                    let numeroUnidadesItem = carrito.reduce(function (total, itemId) {
                        return itemId === item ? total += 1 : total;
                    }, 0);
                    // Creamos el nodo del item del carrito
                    let miNodo = document.createElement('li');
                    miNodo.classList.add('list-group-item', 'text-right', 'mx-2');
                    miNodo.textContent = `${numeroUnidadesItem} x ${miItem[0]['nombre']} - ${miItem[0]['precio']}€`;
                    // Boton de borrar
                    let miBoton = document.createElement('button');
                    miBoton.classList.add('btn', 'btn-danger', 'mx-5');
                    miBoton.textContent = 'X';
                    miBoton.style.marginLeft = '1rem';
                    miBoton.setAttribute('item', item);
                    miBoton.addEventListener('click', borrarItemCarrito);
                    // Mezclamos nodos
                    miNodo.appendChild(miBoton);
                    $carrito.appendChild(miNodo);
                })
            }

            function borrarItemCarrito() {
                console.log()
                // Obtenemos el producto ID que hay en el boton pulsado
                let id = this.getAttribute('item');
                // Borramos todos los productos
                carrito = carrito.filter(function (carritoId) {
                    return carritoId !== id;
                });
                // volvemos a renderizar
                renderizarCarrito();
                // Calculamos de nuevo el precio
                calcularTotal();
            }

            function calcularTotal() {
                // Limpiamos precio anterior
                total = 0;
                // Recorremos el array del carrito
                for (let item of carrito) {
                    // De cada elemento obtenemos su precio
                    let miItem = baseDeDatos.filter(function(itemBaseDatos) {
                        return itemBaseDatos['id'] == item;
                    });
                    total = total + miItem[0]['precio'];
                }
                // Formateamos el total para que solo tenga dos decimales
                let totalDosDecimales = total.toFixed(2);
                // Renderizamos el precio en el HTML
                $total.textContent = totalDosDecimales;
            }

            function vaciarCarrito() {
                // Limpiamos los productos guardados
                carrito = [];
                // Renderizamos los cambios
                renderizarCarrito();
                calcularTotal();
            }

            // Eventos
            $botonVaciar.addEventListener('click', vaciarCarrito);

            // Inicio
            renderItems();
        } 
    </script>-->

<!--
    <header class="header">
		<div class="container">
            <div class="btn-menu">
                <label for="btn-menu">☰</label>
            </div>
		</div>
	</header>
	<div class="capa"></div>
<input type="checkbox" id="btn-menu">
<div class="container-menu">
	<div class="cont-menu">
		<nav>
			<a href="#">Portafolio</a>
			<a href="#">Servicios</a>
			<a href="#">Suscribirse</a>
			<a href="#">Facebook</a>
			<a href="#">Youtube</a>
			<a href="#">Instagram</a>
		</nav>
		<label for="btn-menu">✖️</label>
	</div>
</div>

<style>
	.capa{
		position: fixed;
		width: 100%;
		height: 100vh;
		background: rgba(0,0,0,0.6);
		z-index: -1;
		top: 0;left: 0;
	}
	/*Estilos para el encabezado*/
	.header{
		width: 100%;
		height: 100px;
		position: fixed;
		top: 0;left: 0;
	}
	.container{
		width: 90%;
		max-width: 1200px;
		margin: auto;
	}
	.container .btn-menu, .logo{
		float: ;
		line-height:100px;
	}
	.container .btn-menu label{
		color: #fff;
		font-size: 25px;
		cursor: pointer;
	}

	.container .menu{
		float: right;
		line-height: 100px;
	}
	.container .menu a{
		display: inline-block;
		padding: 15px;
		line-height: normal;
		text-decoration: none;
		color: #fff;
		transition: all 0.3s ease;
		border-bottom: 2px solid transparent;
		font-size: 15px;
		margin-right: 5px;
	}
	.container .menu a:hover{
		border-bottom: 2px solid #c7c7c7;
		padding-bottom: 5px;
	}
	/*Fin de Estilos para el encabezado*/

	/*Menù lateral*/
	#btn-menu{
		display: none;
	}
	.container-menu{
		position: absolute;
		background: rgba(0,0,0,0.5);
		width: 100%;
		height: 100vh;
		top: 0;left: 0;
		transition: all 500ms ease;
		opacity: 0;
		visibility: hidden;
	}
	#btn-menu:checked ~ .container-menu{
		opacity: 1;
		visibility: visible;
	}
	.cont-menu{
		width: 100%;
		max-width: 250px;
		background: #1c1c1c;
		height: 100vh;
		position: relative;
		transition: all 500ms ease;
		transform: translateX(-100%);
	}
	#btn-menu:checked ~ .container-menu .cont-menu{
		transform: translateX(0%);
	}
	.cont-menu nav{
		transform: translateY(15%);
	}
	.cont-menu nav a{
		display: block;
		text-decoration: none;
		padding: 20px;
		color: #c7c7c7;
		border-left: 5px solid transparent;
		transition: all 400ms ease;
	}
	.cont-menu nav a:hover{
		border-left: 5px solid #c7c7c7;
		background: #1f1f1f;
	}
	.cont-menu label{
		position: absolute;
		right: 5px;
		top: 10px;
		color: #fff;
		cursor: pointer;
		font-size: 18px;
	}
	/*Fin de Menù lateral*/
</style>-->

<?php
    require_once('nav.php');
    use Helpers\SessionHelper;

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
                              <th class="th-sm">Funcion(peli)
                              </th>
                              <th class="th-sm">Fecha Y Hora
                              </th>
                              <th class="th-sm">Sala & Cine
                              </th>
                              <th class="th-sm">Cantidad
                              </th>
                              <th class="th-sm">Total
                              </th>
                         </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $cart = SessionHelper::GetValue('CART');
                    $total = 0;
                    foreach($cart as $index=>$ticket){
                        $showtime = $ticket->GetShowtime();
                        $cinema = $showtime->GetCinema();
                        $movie = $showtime->GetMovie();$titleMovie = $movie->GetTitle();
                        
                        ?>
                        <tr>
                            <td><?php echo $movie->GetTitle(); ?></td>
                            <td><?php echo $showtime->GetReleaseDate().'--'.$showtime->GetStartTime(); ?></td>
                            <td><?php echo $cinema->GetName().'|'; ?></td>
                            <td><?php echo $ticket->GetNumberOfTickets();?></td>
                            <td><?php echo '$'.number_format($cinema->GetPrice()*$ticket->GetNumberOfTickets(),2);?></td>  
                            <th class="th-sm">
                                <a href="<?php echo FRONT_ROOT.'Cart/RemoveTicket?numberOfTicket='.$ticket->GetNumberTicket();?>" 
                                    type="button" class="btn btn-danger">Sacar
                                </a>
                            </th>
                        </tr> 
                        
                    <?php $total = $total+($cinema->GetPrice()*$ticket->GetNumberOfTickets());
                        }?>
                    <tr style="background:#8C3FC1;">
                        <td colspan="5" align="right"><h4>Total</h4></td>
                        <td align="center"><h4><?php echo '$'.number_format($total,2);?></h4></td>
                    </tr>
                    </tbody>
               </table>
               
               <form action="<?php echo FRONT_ROOT.'Cart/EmtpyCart'; ?>" method="POST">
                    <button type="submit" value="" class="btn btn-secondary btn-info w-20" name="empty">VACIAR CARRITO</button>
                </form>
          </div>
     </section>

     <main>