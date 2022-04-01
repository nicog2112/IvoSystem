
<?php

require_once "../configs.php";


$mensaje = "";
$mensaje2 = "";

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


require_once "../class/Producto.php";
require_once "../class/Categoria.php";
require_once "../class/Temporada.php";
require_once "../class/ProductoTalle.php";

require_once "../class/Sexo.php";

$listadoSexo = Sexo::obtenerTodos();

$listadoTemporada = Temporada::obtenerTodos();

$listadoCategoria = ProductoTalle::obtenerTodosMenu();

$listaProductosMujeres = Producto::obtenerTodosMasVentas();
$listaProductosMasVendidosDos= Producto::obtenerTodosMasVentasDos();

$listaProductosNuevos = Producto::obtenerTodosNuevosIngresos();
$listaProductosNuevosDos = Producto::obtenerTodosNuevosIngresosDos();

if (isset($_GET["errorRegistro"])) {
    // code...
    switch ($_GET["errorRegistro"]) {

    case 'dniExistente':
        $mensaje2 = "<div class='error'>"."El DNI que intenta registrar ya existe en el sistema. En estos casos debe utilizar el formulario de contacto de la pagina de inicio o mandar un correo electronico a ivosystem@gmail.com solicitando que le asignen un usuario"."</div>";
        break;

    case 'usuarioExistente':
        $mensaje2 = "<div class='error'>"."El usuario que intenta registrar ya existe en el sistema. Por favor ingrese otro usuario"."</div>";
        break;
    case 'nombrePersonaNuevo':
        $mensaje2 = "<div class='error'>"."El nombre del Usuario solo puede contener letras, se debe escribir minimo 3 caracteres, los espacios estan permitidos unicamente en el medio y no puede estar vacio."."</div>";
        break;

    case 'apellidoPersonaNuevo':
        $mensaje2 = "<div class='error'>"."El apellido del Usuario solo puede contener letras, se debe escribir minimo 3 caracteres, los espacios estan permitidos unicamente en el medio y no puede estar vacio."."</div>";
        break;
    case 'dniPersonaNuevo':
        $mensaje2 = "<div class='error'>"."El DNI del usuario tiene que ser de 8 a 11 dígitos y solo puede contener numeros."."</div>";
        break;
    case 'nacionalidadPersonaNuevo':
        $mensaje2 = "<div class='error'>"."La nacionalidad del usuario solo puede contener letras, se debe escribir minimo 3 caracteres, los espacios estan permitidos unicamente en el medio y no puede estar vacio."."</div>";
        break;
     case 'username':
        $mensaje2 = "<div class='error'>"."El usuario es obligatorio"."</div>";
        break;
     case 'password':
        $mensaje2 = "<div class='error'>"."La contraseña es obligatoria"."</div>";
        break;
    case 'imagenUsuarioModificar':
        $mensaje2 = "<div class='error'>"."La imagen debe ser jpg o png"."</div>";
        break;

}
}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>IVO System</title>
	<!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
		<!-- bootstrap -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">      
		<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		
		<link href="themes/css/bootstrappage.css" rel="stylesheet"/>
		
		<!-- global styles -->
		<link href="themes/css/flexslider.css" rel="stylesheet"/>
		<link href="themes/css/main.css" rel="stylesheet"/>
		<link rel="shortcut icon" href="/programacion_3/boutique/img/logo.ico">

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

				
					<section class="main-content">				
						<div class="row">
							<div class="span5" style="">
								<?php if (isset($error)){ ?>	
								<h5 class="alert alert-danger" style="width:60%"><?php echo $mensaje; ?></h3>
								<?php } ?>				
								<h4 class="" style="margin-left: 100px;"><span class="text"><strong>Iniciar</strong> Sesion</span></h4>
								<form action="procesar_login.php" method="post" style="margin-bottom: 300px;">
									<input type="hidden" name="next" value="/">
									<fieldset>
										<div class="control-group">
											<label class="control-label">Usuario</label>
											<div class="controls">
												<input type="text" placeholder="Ingrese su USUARIO" id="username" name="txtUsername" class="input-xlarge" style="width: 150%;">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Contraseña</label>
											<div class="controls">
												<input type="password" placeholder="Ingrese su CONTRASEÑA" id="password" name="txtPassword" class="input-xlarge" style="width: 150%;">
											</div>
										</div>
										<div class="control-group">
											<input tabindex="3" class="btn btn-success large" type="submit" value="Iniciar Sesion"  style="margin-left: 105px;">
											
										</fieldset>
									</form>				
								</div>
								<div class="span7">		
								<?php
									
								 if (isset($_GET['errorRegistro'])){ 
								 	$errorRegistro = $_GET['errorRegistro'];?>	
								<h5 class="alert alert-danger" style="width:90%"><?php echo $mensaje2; ?></h3>
								<?php } ?>			
						<h4 class="title"><span class="text"><strong>Formulario de </strong>Registro</span></h4>
						<form action="procesar_altaPersonaUsuario.php" method="post" class="form-stacked" style="column-count: 2;
column-gap: 1px;
column-rule: 1px solid #fff ;"  enctype="multipart/form-data">
							<fieldset>
								<div class="control-group">
									<label class="control-label">Nombre: *</label>
									<div class="controls">
										<input type="text" placeholder="Ingrese su Nombre" name="nombrePersona" id="nombrePersona" class="input-xlarge" required>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Apellido: *</label>
									<div class="controls">
										<input type="text" placeholder="Ingrese su Apellido" name="apellidoPersona" id="apellidoPersona" class="input-xlarge" required>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">DNI: *</label>
									<div class="controls">
										<input type="number" placeholder="Ingrese su Dni" name="dniPersona" id="dniPersona" class="input-xlarge" required>
									</div>
								</div>	
								<div class="control-group">
									<label class="control-label">Fecha de Nacimiento:</label>
									<div class="controls">
										<input type="date" placeholder="" class="input-xlarge" name="fechaNacimientoPersona" id="fechaNacimientoPersona">
									</div>
								</div>
								<br><br><br>
								<div class="control-group">
									<label class="control-label">Sexo:</label>
									<div class="controls">
										<select name="sexoPersona" id="sexoPersona" class="input-xlarge">
												<option value="NULL">---Seleccionar---</option>

												<?php foreach ($listadoSexo as $sexo): ?>


												<option value="<?php echo $sexo->getIdSexo(); ?>">
												<?php echo $sexo->getDescripcion(); ?>
												</option>
												<?php endforeach ?>

										</select>
									</div>
								</div>	
								<div class="control-group">
									<label class="control-label">Usuario: *</label>
									<div class="controls">
										<input type="text" name="username" id="username" placeholder="Ingrese su Usuario" class="input-xlarge" required>
									</div>
								</div>	
								<div class="control-group">
									<label class="control-label">Contraseña: *</label>
									<div class="controls">
										<input type="password" placeholder="Ingrese contraseña" class="input-xlarge"  name="password" id="password" required>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Imagen de Perfil:</label>
									<div class="controls">
										<input type="file" placeholder="Enter your password" class="input-xlarge" id="files" name="Imagen" accept="image/*">
									</div>
								</div>							                            
							
								<hr>
								<div class="actions"><input tabindex="9" class="btn btn-success" type="submit" value="Registrar"></div>
							</fieldset>
						</form>					
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