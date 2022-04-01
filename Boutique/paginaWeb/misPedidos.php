
<?php

require_once "../configs.php";
require_once "configuracionSesionUsuario.php";
require_once "../class/PersonaDomicilio.php";
require_once "../class/Domicilio.php";


$mensaje = "";

if (isset($_GET['error'])) {
	$error = $_GET['error'];

	if ($error == ERROR_LOGIN_CODE) {

		$mensaje = ERROR_LOGIN_MENSAJE;

	} else if ($error == MENSAJE_CODE) {

		$mensaje = MENSAJE_NECESITA_LOGIN;
		
	}

}

?>
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
$listadoTipoPago = TipoPago::obtenerTodos();
require_once "../class/Usuario.php";
require_once "../class/ProductoTalle.php";
require_once "../class/Venta.php";
require_once "../class/DetalleVenta.php";

$idPersona= $usuarioCliente->getIdPersona();
$cliente= Cliente::obtenerPorIdPersona($idPersona);
$idCliente= $cliente->getIdCliente();
$lista = Venta::obtenerTodosVentasPorCliente($idCliente);




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
			<img class="pageBanner" src="themes/images/Banner-Carrito-de-compras-1024x296.jpg" alt="New products" >
				<h4><span>Mis Compras</span></h4>
			</section>
			<section class="main-content">				
				<div class="row"  >
					<div class="span9"  style="width:95%;">					
						<h4 class="title"><span class="text"><strong>Mis</strong> Compras</span></h4>
						<table class="table table-striped" >
							
			<thead>
				<tr>
					    <th>ID</th>
                            <th>Fecha</th>
                            <th>Empleado</th>
                            <th>Cliente</th>
                            <th>Estado</th>
                            <th>Total</th>
                            <th>Detalle</th>
                            <th>Factura</th>
                            <th>Cancelar</th>
				</tr>
			</thead>

			<tbody>
				 <?php foreach($lista as $venta){ ?>
                            <tr class="active-row">
                                <td><?php echo $venta->getIdVenta(); ?></td>
                                <td><?php echo $venta->getFechaHora() ?></td>
                                <td><?php echo $venta->empleado->getNombre();
                                echo " ";
                                echo $venta->empleado->getApellido();?></td>
                                <td><?php echo $venta->cliente->getNombre();
                                echo " ";
                                echo $venta->cliente->getApellido();?></td>
                                <td><?php echo $venta->estado->getDescripcion(); ?></td>
                               
                                
                                <td>$<?php echo $venta->getTotal() ?></td>
                               <td>
                                    <a href="listadoDetalleVenta.php?id=<?php echo $venta->getIdVenta(); ?>"> <i class="botonGeneral fas fa-search-plus"></i> </a>
                                </td>
                                <td>
                                	<?php if($venta->getIdEstadoPedido() == 1){ ?>
                                	<a href="../modulos/facturas/crearPDF.php?id_pedido_cliente=<?php echo $venta->getIdVenta(); ?>"><i class="botonGeneral fas fa-file-alt"></i>
                                	</a>
                                <?php } ?>
                                </td>
                                <td>
                                	<?php if($venta->getIdEstadoPedido() == 3){ ?>
                                	<a href="eliminarVenta.php?id_pedido_cliente= <?php echo $venta->getIdVenta(); ?>"><i class="botonEliminar fas fa-window-close"></i></a>
                                		<?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
			</tbody>
			
		</table>
						
										
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
		<script src="themes/js/common.js"></script>
		<script>
			$(document).ready(function() {
				$('#checkout').click(function (e) {
					document.location.href = "checkout.html";
				})
			});
		</script>		
    </body>
</html>