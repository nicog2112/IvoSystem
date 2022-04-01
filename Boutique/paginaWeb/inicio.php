
<?php


require_once "../class/Producto.php";
require_once "../class/ProductoTalle.php";
require_once "../class/Categoria.php";
require_once "../class/Temporada.php";


$listadoTemporada = Temporada::obtenerTodos();

$listadoCategoria = ProductoTalle::obtenerTodosMenu();

$listaProductosMujeres = Producto::obtenerTodosMasVentasPrimero();
$listaProductosMasVendidosDos= Producto::obtenerTodosMasVentasDos();

$listaProductosNuevos = Producto::obtenerTodosNuevosIngresos();
$listaProductosNuevosDos = Producto::obtenerTodosNuevosIngresosDos();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>IVO System</title>
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
		<!--[if lt IE 9]>			
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->

		
</head>
<body>		
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
						<?php session_start();

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
		<section  class="homepage-slider" id="home-slider">
			<div class="flexslider">
				<ul class="slides">
					<li>
						<img src="themes/images/carousel/promocion_ventas.jpg" alt="" style="height:550px;" />
					</li>
					<li>
						<img src="themes/images/carousel/187.jpg" alt="" style="height:550px;"/>
						<div class="intro">
							<h1>Venta de mitad de temporada</h1>
							<p><span>Hasta el 50% de descuento</span></p>
							<p><span>En artículos seleccionados en línea y en tiendas</span></p>
						</div>
					</li>
				</ul>
			</div>			
		</section>
		
		<section class="main-content">
			<div class="row">
				<div class="span12">													
					<div class="row">
						<div class="span12">
							<h4 class="title">
								<span class="pull-left"><span class="text"><span class="line">Productos mas <strong>Vendidos</strong></span></span></span>
								<span class="pull-right">
									<a class="left button" href="#myCarousel" data-slide="prev"></a><a class="right button" href="#myCarousel" data-slide="next"></a>
								</span>
							</h4>
							<div id="myCarousel" class="myCarousel carousel slide">
								<div class="carousel-inner">
									<div class="active item">
										<ul class="thumbnails">									
											<?php foreach  ($listaProductosMujeres as $ProductoMujeres): ?>		
												
												<li class="span3">
													<div class="product-box">
														<span class="sale_tag"></span>
														<p><a href="productoDetalle.php?id_producto=<?php echo $ProductoMujeres->getIdProducto(); ?>"><img src="/programacion_3/boutique/modulos/productos/<?php echo $ProductoMujeres->getImagen(); ?>" style="width: 160px; height: 220px;" alt="" /></a></p>
														<a href="productoDetalle.php" class="title"><?php echo $ProductoMujeres->getNombreProducto(); ?></a><br/>
														<a href="productoDetalle.php" class="category"><?php echo $ProductoMujeres->categoria->getNombre(); ?></a>
														<p class="price">$<?php echo $ProductoMujeres->getPrecioVenta(); ?></p>
													</div>
												</li>
												
											<?php endforeach ?>
										</ul>
									</div>
									<div class="item">
										<ul class="thumbnails">
											<?php foreach  ($listaProductosMasVendidosDos as $ProductoMasVendidos): ?>	
												<li class="span3">
													<div class="product-box">
														<p><a href="productoDetalle.php?id_producto=<?php echo $ProductoMasVendidos->getIdProducto(); ?>"><img src="/programacion_3/boutique/modulos/productos/<?php echo $ProductoMasVendidos->getImagen(); ?>" style="width: 160px; height: 220px;" alt="" /></a></p>
														<a href="productoDetalle.php ?id_producto=<?php echo $ProductoMasVendidos->getIdProducto(); ?>" class="title"><?php echo $ProductoMasVendidos->getNombreProducto(); ?></a><br/>
														<a href="productoDetalle.php?id_producto=<?php echo $ProductoMasVendidos->getIdProducto(); ?>" class="category"><?php echo $ProductoMasVendidos->categoria->getNombre(); ?></a>
														<p class="price">$<?php echo $ProductoMasVendidos->getPrecioVenta(); ?></p>
													</div>
												</li>
												
											<?php endforeach ?>																																
										</ul>
									</div>
								</div>							
							</div>
						</div>						
					</div>
					<br/>
					<div class="row">
						<div class="span12">
							<h4 class="title">
								<span class="pull-left"><span class="text"><span class="line">Productos resien <strong>Ingresados</strong></span></span></span>
								<span class="pull-right">
									<a class="left button" href="#myCarousel-2" data-slide="prev"></a><a class="right button" href="#myCarousel-2" data-slide="next"></a>
								</span>
							</h4>
							<div id="myCarousel-2" class="myCarousel carousel slide">
								<div class="carousel-inner">
									<div class="active item">
										<ul class="thumbnails">											
											<?php foreach  ($listaProductosNuevos as $ProductoNuevo): ?>	
												<li class="span3">
													<div class="product-box">
														<span class="sale_tag"></span>
														<p><a href="productoDetalle.php?id_producto=<?php echo $ProductoNuevo->getIdProducto(); ?>"><img src="/programacion_3/boutique/modulos/productos/<?php echo $ProductoNuevo->getImagen(); ?>" style="width: 160px; height: 220px;" alt="" /></a></p>
														<a href="product_detail.html" class="title"><?php echo $ProductoNuevo->getNombreProducto(); ?></a><br/>
														<a href="products.html" class="category"><?php echo $ProductoNuevo->categoria->getNombre(); ?></a>
														<p class="price">$<?php echo $ProductoNuevo->getPrecioVenta(); ?></p>
													</div>
												</li>
												
											<?php endforeach ?>		
										</ul>
									</div>
									<div class="item">
										<ul class="thumbnails">
											<?php foreach  ($listaProductosNuevosDos as $ProductoNuevoDos): ?>	
												<li class="span3">
													<div class="product-box">
														<span class="sale_tag"></span>
														<p><a href="productoDetalle.php?id_producto=<?php echo $ProductoNuevoDos->getIdProducto(); ?>"><img src="/programacion_3/boutique/modulos/productos/<?php echo $ProductoNuevoDos->getImagen(); ?>" style="width: 160px; height: 220px;" alt="" /></a></p>
														<a href="product_detail.html" class="title"><?php echo $ProductoNuevoDos->getNombreProducto(); ?></a><br/>
														<a href="products.html" class="category"><?php echo $ProductoNuevoDos->categoria->getNombre(); ?></a>
														<p class="price">$<?php echo $ProductoNuevoDos->getPrecioVenta(); ?></p>
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
			<section class="form_wrap">

				<section class="cantact_info">
					<section class="info_title">
						<span class="fa fa-user-circle"></span>
						<h2>INFORMACION<br>DE CONTACTO</h2>
					</section>
					<section class="info_items">
						<p><span class="fa fa-envelope"></span> info.contact@gmail.com</p>
						<p><span class="fa fa-mobile"></span> +54(370) 400-0000</p>
					</section>
				</section>

				<form action="enviarCorreo.php" method="post" class="form_contact">
					<h2>Envia un mensaje</h2>
					<div class="user_info">
						<label for="names">Nombres *</label>
						<input type="text" id="names" name="nombre">

						<label for="phone">Telefono / Celular</label>
						<input type="text" id="phone">

						<label for="email">Correo electronico *</label>
						<input type="text" id="email" name="mail">

						<label for="mensaje">Mensaje *</label>
						<textarea id="mensaje" name="mensaje"></textarea>

						<input type="submit" value="Enviar Mensaje" id="btn btn-success" style="background-color: green; color: #ffffff;">
					</div>
				</form>

			</section>
			<p align="center"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3580.399111933427!2d-58.17539868531429!3d-26.183692169498!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x945ca5e438e2cddb%3A0xd4db042c41c11310!2sINSTITUTO%20S%20P%20R%20MACEDO%20MARTINEZ!5e0!3m2!1ses-419!2sar!4v1639191328690!5m2!1ses-419!2sar" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" align="center" ></iframe></p>
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
	<script src="themes/js/jquery.flexslider-min.js"></script>
	<script type="text/javascript">
		$(function() {
			$(document).ready(function() {
				$('.flexslider').flexslider({
					animation: "fade",
					slideshowSpeed: 4000,
					animationSpeed: 600,
					controlNav: false,
					directionNav: true,
						controlsContainer: ".flex-container" // the container that holds the flexslider
					});
			});
		});
	</script>
</body>
</html>