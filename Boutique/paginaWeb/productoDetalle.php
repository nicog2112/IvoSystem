
<?php 


require_once "../class/Talle.php";
require_once "../class/Cliente.php";
require_once "../class/Empleado.php";
require_once "agregarAlCarrito.php";
require_once "../class/ProductoTalle.php";
require_once "../class/Producto.php";
require_once "../class/TipoFactura.php";
require_once "../class/EstadosPago.php";
require_once "../class/TipoPago.php";
require_once "../class/TiposImpositivos.php";

$listadoTiposImpositivos = TiposImpositivos::obtenerPorEstado();


$listadoClientes = Cliente::obtenerTodos();
$listadoEmpleados = Empleado::obtenerTodos();
$listadoTipoFactura = TipoFactura::obtenerTodos();
$listadoEstadosPagos = EstadosPagos::obtenerTodos();
$listadoTipoPago = TipoPago::obtenerTodos();
$listadoCategoria = ProductoTalle::obtenerTodosMenu();

$id_producto = $_GET["id_producto"];
$listadoTalle = ProductoTalle::obtenerTodosTallesActivos($id_producto);
$producto = Producto::obtenerPorId($id_producto);

$listaProductosA = Producto::obtenerTodosMasVentasPrimero();
$listaProductosB= Producto::obtenerTodosMasVentasDos();


?>
<?php 
session_start();
        if(!isset($_SESSION["carritoCliente"])) $_SESSION["carritoCliente"] = [];
        $granTotal = 0;

        ?>
<?php
if(isset($_GET["status"])){
	if($_GET["status"] === "1"){
		?>
		<div class="alert alert-success">
			<strong>¡Correcto!</strong> Venta realizada correctamente
		</div>
		<?php
	}else if($_GET["status"] === "2"){
		?>
		<div class="alert alert-info">
			<strong>Venta cancelada</strong>
		</div>
		<?php
	}else if($_GET["status"] === "3"){
		?>
		<div class="alert alert-info">
			<strong>Ok</strong> Producto quitado de la lista
		</div>
		<?php
	}else if($_GET["status"] === "4"){
		?>
		<div class="alert alert-warning">
			<strong>Error:</strong> El producto que buscas no existe
		</div>
		<?php
	}else if($_GET["status"] === "5"){
		?>
		<div class="alert alert-danger">
			<strong>Error: </strong>El producto está agotado
		</div>
		<?php
	}else{
		?>
		<div class="alert alert-danger">
			<strong>Error:</strong> Algo salió mal mientras se realizaba la venta
		</div>
		<?php
	}
}
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
	<link href="themes/css/main.css" rel="stylesheet"/>
	<link href="themes/css/jquery.fancybox.css" rel="stylesheet"/>

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

	<!--[if lt IE 9]>			
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script src="js/respond.min.js"></script>
	<![endif]-->
		<script type="text/javascript">
				function selectAnidadosProducto(){
	
	

		$("#cboTalle").change(function(){
			
			$.ajax({
			type:"POST",
			url:"datos3.php",
			data:"talle=" + $('#cboTalle').val()+"&producto="+$('#idProducto').val(),
			success:function(r){
				$('#cantidadDisponibleTalle').html(r);}

			});
		});

		


		
	};

		</script>
</head>
<body onload="selectAnidadosProducto();">		
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
			<img class="pageBanner" src="themes/images/boutique-shop-landing-page-web-banner-background-vector.jpg" alt="New products" style="height:250px;">
			<h4><span>Detalle del Producto</span></h4>
		</section>
		<section class="main-content">				
			<div class="row">						
				<div class="span9">
					<div class="row">
						<div class="span4">
							<a href="/programacion_3/boutique/modulos/productos/<?php echo $producto->getImagen(); ?>"  class="thumbnail" data-fancybox-group="group1" title="<?php echo $producto->getNombreProducto();?>" ><img alt="" src="/programacion_3/boutique/modulos/productos/<?php echo $producto->getImagen(); ?>" style="width: 342px; height: 342px;"></a>												

						</div>
						<div class="span5">
							<address>

								<strong>Codigo del Producto:</strong> <span><?php echo $producto->getIdProducto();?></span><br>
								<strong>Marca:</strong> <span><?php echo $producto->getMarca();?></span><br>
								<strong>Nombre:</strong> <span><?php echo $producto->getNombreProducto();?></span><br>
								<strong>Descripcion:</strong> <span><?php echo $producto->getDescripcion();?></span>								
							</address>									
							<h4><strong>Precio: $<?php echo $producto->getPrecioVenta();?></strong></h4>


						</div>
						<div class="span5">
							<form method="post" action="agregarAlCarrito.php" >

								<input type="hidden" name="promocion" value="0">
								<input type="hidden" name="estado" value="1">

								<div class="formulario__grupo" id="grupo__codigo" >
									<label for="idProducto" class="formulario__label">Código del producto:</label>
									<div class="formulario__grupo-input">
										<input readonly type="text" class="formulario__input" name="idProducto" id="idProducto" value="<?php echo $id_producto; ?>">
										<i class="formulario__validacion-estado fas fa-times-circle"></i>
									</div>	

									<p class="formulario__input-error">Error</p>
								</div>



								<div class="formulario__grupo" id="grupo__cantidad" >
									<label for="cantidad" class="formulario__label">Cantidad:</label>
									<div class="formulario__grupo-input">
										<input required type="number" class="formulario__input" name="cantidad" id="cantidad" placeholder="Escribe la cantidad">
										<i class="formulario__validacion-estado fas fa-times-circle"></i>
									</div>	

									<p class="formulario__input-error">Error</p>
								</div>

								<div class="formulario__grupo" id="grupo__talle" >
									<label for="cboTalle" class="formulario__label">Talle:</label>
									<div class="formulario__grupo-input">
										<select required class="formulario__input" name="cboTalle" id="cboTalle">
											<option value="NULL">---Seleccionar---</option>

											<?php foreach ($listadoTalle as $productoTalle): ?>

												<option value="<?php echo $productoTalle->getIdTalle(); ?>">
													<?php echo $productoTalle->talle->getDescripcion(); ?>
												</option>

											<?php endforeach ?>



											<i class="formulario__validacion-estado fas fa-times-circle"></i>
										</select>
									</div>	

									<p class="formulario__input-error">Error</p>
								</div>

								<div class="formulario__grupo" id="grupo__codigo" >
									<label for="idProducto" class="formulario__label">Cantidad Disponible:</label>
									<div class="formulario__grupo-input">
										<p name="cantidadDisponibleTalle" id="cantidadDisponibleTalle" style=" " >0</p>  
									</div>	

									<p class="formulario__input-error">Error</p>
								</div>
								<input type="submit" name="Cargar" value="Agregar al carrito" class="btn btn-success">

							</form>
						</div>							
					</div>

					<div class="row">

						<div class="span12">	
							<br>
							<h4 class="title">
								<span class="pull-left"><span class="text"><strong>Mas</strong> Vendidos</span></span>
								<span class="pull-right">
									<a class="left button" href="#myCarousel-1" data-slide="prev"></a><a class="right button" href="#myCarousel-1" data-slide="next"></a>
								</span>
							</h4>
							<div id="myCarousel-2" class="myCarousel carousel slide">
								<div class="carousel-inner">
									<div class="active item">
										<ul class="thumbnails">
											<?php foreach  ($listaProductosA as $ProductoA): ?>		
												
												<li class="span3">
													<div class="product-box">
														<span class="sale_tag"></span>
														<p><a href="productoDetalle.php?id_producto=<?php echo $ProductoA->getIdProducto(); ?>"><img src="/programacion_3/boutique/modulos/productos/<?php echo $ProductoA->getImagen(); ?>" style="width: 160px; height: 220px;" alt="" /></a></p>
														<a href="productoDetalle.php" class="title"><?php echo $ProductoA->getNombreProducto(); ?></a><br/>
														<a href="productoDetalle.php" class="category"><?php echo $ProductoA->categoria->getNombre(); ?></a>
														<p class="price">$<?php echo $ProductoA->getPrecioVenta(); ?></p>
													</div>
												</li>
												
											<?php endforeach ?>										
										</ul>
									</div>
									<div class="item">
										<ul class="thumbnails listing-products">

											<?php foreach  ($listaProductosB as $ProductoB): ?>		
												
												<li class="span3">
													<div class="product-box">
														<span class="sale_tag"></span>
														<p><a href="productoDetalle.php?id_producto=<?php echo $ProductoB->getIdProducto(); ?>"><img src="/programacion_3/boutique/modulos/productos/<?php echo $ProductoB->getImagen(); ?>" style="width: 160px; height: 220px;" alt="" /></a></p>
														<a href="productoDetalle.php" class="title"><?php echo $ProductoB->getNombreProducto(); ?></a><br/>
														<a href="productoDetalle.php" class="category"><?php echo $ProductoB->categoria->getNombre(); ?></a>
														<p class="price">$<?php echo $ProductoB->getPrecioVenta(); ?></p>
													</div>
												</li>
												
											<?php endforeach ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
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
	<script src="themes/js/common.js"></script>
	<script>
		$(function () {
			$('#myTab a:first').tab('show');
			$('#myTab a').click(function (e) {
				e.preventDefault();
				$(this).tab('show');
			})
		})
		$(document).ready(function() {
			$('.thumbnail').fancybox({
				openEffect  : 'none',
				closeEffect : 'none'
			});

			$('#myCarousel-2').carousel({
				interval: 2500
			});								
		});
	</script>
</body>

	</html>