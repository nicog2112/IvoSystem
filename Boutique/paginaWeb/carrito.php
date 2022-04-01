
<?php 

require_once "../class/Talle.php";
require_once "../class/Cliente.php";
require_once "../class/Empleado.php";
require_once "agregarAlCarrito.php";
require_once "../class/ProductoTalle.php";
require_once "../class/TipoFactura.php";
require_once "../class/EstadosPago.php";
require_once "../class/TipoPago.php";
require_once "../class/TiposImpositivos.php";
require_once "../configs.php";

$listadoTiposImpositivos = TiposImpositivos::obtenerPorEstado();
$listadoCategoria = ProductoTalle::obtenerTodosMenu();


$listadoTalle = Talle::obtenerTodos();
$listadoClientes = Cliente::obtenerTodos();
$listadoEmpleados = Empleado::obtenerTodos();
$listadoTipoFactura = TipoFactura::obtenerTodos();
$listadoEstadosPagos = EstadosPagos::obtenerTodos();
$listadoTipoPago = TipoPago::obtenerTodosActivos();
require_once "../class/Usuario.php";
require_once "../class/ProductoTalle.php";

session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>IVO System</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
		<link rel="shortcut icon" href="/programacion_3/boutique/img/logo.ico">

		<!-- mercado pago-->		
		<script src="https://sdk.mercadopago.com/js/v2"></script></head>
		<!-- bootstrap -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">      
		<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">		
		<link href="themes/css/bootstrappage.css" rel="stylesheet"/>
		
		<!-- global styles -->
		<link href="themes/css/flexslider.css" rel="stylesheet"/>
		<link href="themes/css/main.css" rel="stylesheet"/>

		<!-- scripts -->
		<script src="themes/js/jquery-1.7.2.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>				
		<script src="themes/js/superfish.js"></script>	
		<script src="themes/js/jquery.scrolltotop.js"></script>
		<link rel="stylesheet" href="css/estilos.css">
		<link rel="stylesheet" href="css/font-awesome.css">
		<link rel="stylesheet" href="/programacion_3/boutique/css/all.min.css">
		<script src="js/jquery-3.2.1.js"></script>
		<script src="js/script.js"></script>
		<link rel="stylesheet" href="/programacion_3/boutique/css/formularioNUEVO.css">

		<link rel="stylesheet" href="/programacion_3/boutique/css/botonesNUEVO.css">
		<link rel="stylesheet" href="/programacion_3/boutique/css/all.min.css">
		
		
		<!--[if lt IE 9]>			
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="themes/js/respond.min.js"></script>
		<![endif]-->

		</head>
		<body>

			<?php 
			if(!isset($_SESSION["carritoCliente"])) $_SESSION["carritoCliente"] = [];
			$granTotal = 0;

			?>	
			<div id="top-bar" class="container" style="background-image: linear-gradient(to right top, #9d157a, #9d0092, #9200ae, #7700d0, #251bf4);">
				<div class="row">
					<div class="span4">
						<form method="POST" class="search_form">
							<input type="text" class="input-block-level search-query" Placeholder="Buscar">
						</form>
					</div>
					<div class="span8">
						<div class="account pull-right" >
							<ul class="user-menu">				
								<li><a href="miPerfil.php" style="color:#ffffff;" >Mi perfil</a></li>
								<li><a href="misPedidos.php" style="color:#ffffff;" >Mis pedidos</a></li>
								<li><a href="carrito.php" style="color:#ffffff;">Carrito</a></li>		
								<?php 

								if (isset($_SESSION['usuarioCliente'])) {?>		
									<li><a href="cerrar_sesion.php" style="color:#ffffff;">Cerrar Sesion</a></li>	
								<?php } else { ?>
									<li><a href="registroLogin.php" style="color:#ffffff;">Iniciar Sesion</a></li>
								<?php } ?>	
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div id="wrapper" class="container">
				<section class="navbar main-menu">
					<div class="navbar-inner main-menu">				
						<a href="inicio.php" class="logo pull-left"><img src="/programacion_3/boutique/img/logo2.png" style="width:40px; height: 40px;" class="site_logo" alt=""></a>
						<p style="display: block;margin: auto;margin:  10px 0px 0px 50px;color: #7E1EC3;text-shadow: 0 4px 0 #CCCCCC, 0 2px 0 #c9c9c9;
						color: #7E1EC3; position: absolute; font-size:20px;">IVO SYSTEM</p>
						<nav id="menu" class="pull-right">
							<ul>
								<li><a href="inicio.php">Inicio</a></li>
								<?php foreach  ($listadoCategoria as $productoTalle): ?>
									<li><a href="productos.php?id_categoria=<?php echo $productoTalle->producto->getIdCategoria(); ?>"><?php echo $productoTalle->producto->categoria->getNombre(); ?></a>					

									</li>															
								<?php endforeach ?>
							</ul>
						</nav>
					</div>
				</section>			
				<section class="header_text sub">
					
					<h4><span>Carrito de Compras</span></h4>
				</section>
				<section class="main-content">				
					<div class="row">
						<div class="span12">					
							<h4 class="title"><span class="text"><strong>Mi</strong> Carrito</span></h4>
							<table class="table table-striped">

								<thead>
									<tr>
										<th>ID</th>
										<th>Código</th>
										<th>Imagen</th>
										<th>Descripción</th>
										<th>Talle</th>
										<th>Precio de venta</th>
										<th>Descuento x Promocion</th>
										<th>Cantidad</th>
										<th>Total</th>
										<th>Quitar</th>
									</tr>
								</thead>

								<tbody>
									<?php foreach($_SESSION["carritoCliente"] as $indice => $producto){ 
										$granTotal += $producto->subtotal;
										?>
										<tr class="active-row">
											<td><?php echo $producto->getIdProductoTalle() ?></td>
											<td><?php echo $producto->getIdProducto() ?></td>
											<td><img src='/programacion_3/boutique/modulos/productos/<?php echo $producto->producto->getImagen() ?>'style="max-width:100px;width:70px;height:100px;"></td>
											<td><?php echo $producto->producto->getDescripcion() ?></td>
											<td>
												<?php 
												$id_talle=$producto->getIdTalle();
												foreach ($listadoTalle as $talle): 

													if ($talle->getIdTalle() == $id_talle) {
														echo $talle->getDescripcion();;
													}
												endforeach
												?>

											</td>
											<td>$<?php echo $producto->producto->getPrecioVenta() ?></td>
											<td><?php echo 0 ?></td>
											<td><?php echo $producto->cantidad ?></td>
											<td>$<?php echo $producto->subtotal ?></td>
											<td><a  href="<?php echo "quitarDelCarrito.php?indice=" . $indice?>"><i class="botonEliminar fas fa-trash"></i></a></td>
										</tr>
									<?php } ?>
									<tr>
										<td><td colspan="7"><h3 style="text-align: right;" >SubTotal: </h3></td></td>
										<td>$<?php echo $granTotal; ?></td>
									</tr>
					<?php $totalSumaImpuestos = 0; //obtener valor impuestos

					foreach ($listadoTiposImpositivos as $tiposImpositivos):
						$nombreImpuesto= $tiposImpositivos->getDescripcion();
						$valorPorcentajeImpuesto= $tiposImpositivos->getValorPorcentaje();
						$totalImpuesto= $granTotal * $valorPorcentajeImpuesto / 100;
						$totalSumaImpuestos= $totalSumaImpuestos + $totalImpuesto; ?>



						<tr>
							<td><td colspan="7"><h5 style="text-align: right;" ><?php echo $nombreImpuesto; echo " ";echo $valorPorcentajeImpuesto;  ?>% </h5></td></td>
							<td style="text-align: center;">$<?php echo $totalImpuesto; ?></td>
						</tr>
					<?php endforeach; ?>
					<tr>
						<td colspan="8"><h3 style="text-align: right;" >Total </h3></td></td>
						<td >$<?php $totalFinal= $totalSumaImpuestos + $granTotal;
						echo $totalFinal; ?></td>
					</tr>
				</tbody>

			</table>
			
			
<?php
// SDK de Mercado Pago
require 'vendor/autoload.php';
// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-7217696217221853-120814-9b6a61b8bbbc0572b17d44ee25dda6c7-346893243');

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

if(!isset($_SESSION["carritoCliente"])) $_SESSION["carritoCliente"] = [];
		
		
// Crea un ítem en la preferencia
$datos = array();
foreach($_SESSION["carritoCliente"] as $indice => $productoMP){ 

		$id= $productoMP->getIdProductoTalle();
		$precio= $productoMP->producto->getPrecioVenta(); 
		$nombre= $productoMP->producto->getNombreProducto();
		$cantidad= $productoMP->cantidad;


$item = new MercadoPago\Item();
$item->id = $id;
$item->title = $nombre;
$item->quantity = $cantidad;
$item->unit_price = $precio;
$datos[] = $item;
};
$preference->items = $datos;

$preference->back_urls = array(
	"success" => "http://localhost/programacion_3/boutique/paginaWeb/terminarVentaMP.php?total=".$totalFinal,
	"failure" => "http://localhost/programacion_3/boutique/paginaWeb/carrito.php?error= FalloPago",
	"pending" => "http://localhost/programacion_3/boutique/paginaWeb/terminarVentaMP.php?total=".$totalFinal
);
$preference->auto_return = "approved";


$preference->save();







?>
  <?php
    if (empty($_SESSION["carritoCliente"])){
        
    } else {
  
  ?>
<p class="buttons center">				
	<a href="./cancelarVenta.php" class="btn btn-danger" style="width:110px;">Cancelar Pedido</a>
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"  style="margin-left: 0px;">
  Realizar Pedido
</button>
	<div class="cho-container" style="margin-left: 500px;"></div>

  <?php      }
    ?>
</p>					
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#632BAF;">
        <h5 class="modal-title" id="exampleModalLabel" style="color:#ffffff;">Confirmar Pedido</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -30px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="terminarVenta.php" class="form__reg" name="formularioNuevo" id="formularioNuevo">
        	<input type="hidden" name="total" value="<?php echo $totalFinal; ?>">
        	<label for="tipoPago" class="formulario__label">Tipo de Pago</label>
        	 <select name="tipoPago" id="tipoPago" class="formulario__input" onclick="validarCliente();">
              <option value="NULL">---Seleccionar---</option>

              <?php foreach ($listadoTipoPago as $tipoPago): ?>

                  
                  <option value="<?php echo $tipoPago->getIdTipoPago(); ?>">
                      <?php echo $tipoPago->getDescripcion();?>
                  </option>
              <?php endforeach ?>

          </select>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Confirmar</button>
      </div>
      </form>
    </div>
  </div>
</div>
</section>			
<section id="footer-bar">
	<div class="row">
		<div class="span3">
			<p class="logo"><img src="../img/logo2.png" class="site_logo" alt="" style="width:50px; height:50px;"></p>
			<p style="display: block;margin: auto;margin:  -45px 0px 0px 60px;color: #7E1EC3;text-shadow: 0 4px 0 #CCCCCC, 0 2px 0 #c9c9c9;
			color: #7E1EC3; position: absolute; font-size:20px;">IVO SYSTEM</p>
		</div>
		<div class="span4">

		</div>
		<div class="span5">

			<div class="redes-container" style="margin:20px 0px 0px 250px;">

				<ul>
					<li><a href="#" class="facebook"><i  class="fab fa-facebook-square" style="color: #1F2CC8;"></i></a></li>
					<li><a href="#" class="instagram"><i class="fab fa-instagram-square" style="color:#E4405F;"></i></a></li>
					<li><a href="#" class="gmail"><i  class="fab fa-google-plus-square"  style="color:#FA1F09;"></i></a></li>
					<li><a href="#" class="whatsapp"><i  class="fab fa-whatsapp-square" style="color:#27B009;"></i></a></li>

				</ul>

			</div>
		</div>					
	</div>	
</section>
<section id="copyright">
	<span>Copyright © 2021 ISPRMM</span>
	<span style="margin: -20px 0px 0px 1050px; display:block; position: absolute;">Gauna Pablo Nicolas</span>
</section>
</div>

</body>
</html>
		<script>
				
  // Agrega credenciales de SDK
  const mp = new MercadoPago("TEST-2acf2d59-c56f-420c-8ef7-064dcc15c294", {
  	locale: "es-AR",
  });

  // Inicializa el checkout
  mp.checkout({
  	preference: {
  		id: "<?php echo $preference->id;  ?>",
  	},
  	render: {
      container: ".cho-container", // Indica el nombre de la clase donde se mostrará el botón de pago
      label: "Pagar con Mercado Pago", // Cambia el texto del botón de pago (opcional)
  },
});
  
</script>