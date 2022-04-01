
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

require_once "../class/Producto.php";

require_once "../class/Sexo.php";
$listadoSexo = Sexo::obtenerTodos();
require_once "../class/Categoria.php";
require_once "../class/Temporada.php";
require_once "../class/Contacto.php";
require_once "../class/ProductoTalle.php";

if (isset($_GET["cboFiltroEstado"])) {
	$filtroEstado = $_GET["cboFiltroEstado"];
} else {
    $filtroEstado = 1; // ACTIVOS
}

$listadoTemporada = Temporada::obtenerTodos();
$listadoCategoria = ProductoTalle::obtenerTodosMenu();


$listaProductosA = Producto::obtenerTodosMasVentasTRES();
$listaProductosB= Producto::obtenerTodosMasVentasTRESdos();

$listaProductosNuevos = Producto::obtenerTodosNuevosIngresos();
$listaProductosNuevosDos = Producto::obtenerTodosNuevosIngresosDos();

$idPersona = $usuarioCliente->getIdPersona();
$listadoDomicilios = PersonaDomicilio::obtenerPorIdPersona($idPersona,$filtroEstado);
$listadoContactos = Contacto::obtenerPorIdPersonaWeb($idPersona);
require_once "../class/TipoContacto.php";
$listadoTipoContactos = TipoContacto::obtenerTodosActivos();


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
		<link rel="shortcut icon" href="/programacion_3/boutique/img/logo.ico">
		
		<!-- global styles -->
		<link href="themes/css/flexslider.css" rel="stylesheet"/>
		<link href="themes/css/main.css" rel="stylesheet"/>
		<script src="/programacion_3/boutique/jquery/jquery-3.3.1.min.js"></script>

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
		<link rel="stylesheet" href="/programacion_3/boutique/css/formularioDinamico.css">
		<link rel="stylesheet" href="/programacion_3/boutique/css/modalNUEVO.css"> 
		<script src="/programacion_3/boutique/js/ventanaModal.js" ></script>

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
			<div class="container">
				<section class="form_wrap">

					<section class="cantact_info">
						<section class="info_title" style="text-align: center;">
							<img src="/programacion_3/boutique/modulos/miPerfil/<?php echo $usuarioCliente->getImagen();  ?>" class="avatar img-circle img-thumbnail" alt="avatar" style="width: 200px; height: 200px;">
							<h2>INFORMACION<br>DEL USUARIO</h2>
						</section>

					</section>

					<form  class="form_contact" method="POST" action="procesar_modificacion.php"  enctype="multipart/form-data"  name="formulario" id="formularioMiPerfil">
						<h2>Datos Personales</h2>
						<div class="">
							<div style="width: 40%; float:left">
								<input type="hidden" name="idUsuario" value="<?php echo $usuarioCliente->getIdUsuario();?>">
								<label for="names">Nombres *</label>
								<input type="text" id="nombreUsuario" name="nombreUsuario" value="<?php echo $usuarioCliente->getNombre(); ?>">

								<label for="phone">DNI *</label>
								<input type="text" id="dniUsuario" name="dniUsuario" value="<?php echo $usuarioCliente->getDni(); ?>">

								<label for="email">Sexo</label>
								<select name="sexoUsuario" id="sexoUsuario" class="formulario__input">
									<option value="NULL">---Seleccionar---</option>

									<?php foreach ($listadoSexo as $sexo): ?>

										<?php

										$selected = "";

										if ($sexo->getIdSexo() == $usuarioCliente->getIdSexo()) {
											$selected = "SELECTED";}

											?>

											<option <?php echo $selected; ?> value="<?php echo $sexo->getIdSexo(); ?>">
												<?php echo $sexo->getDescripcion(); ?>
											</option>

										<?php endforeach ?>


									</select>


									<label for="email">Usuario *</label>
									<input type="text" id="usernameUsuario" name="usernameUsuario"value="<?php echo $usuarioCliente->getUsername();   ?>">


								</div>

								<div style="width: 40%; float:right">
									<label for="names">Apellidos *</label>
									<input type="text" id="apellidoUsuario" name="apellidoUsuario"  value="<?php echo $usuarioCliente->getApellido(); ?>">

									<label for="phone">Nacionalidad</label>
									<input type="text" id="nacionalidadUsuario" name="nacionalidadUsuario" value="<?php echo $usuarioCliente->getNacionalidad(); ?>"> 

									<label for="email">Fecha de Nacimiento</label>
									<input type="text" id="fechaNacimientoUsuario" name="fechaNacimientoUsuario" value="<?php echo $usuarioCliente->getFechaNacimiento(); ?>">

									<label for="mensaje">Contraseña *</label>
									<input type="password" id="passwordUsuario" name="passwordUsuario" value="<?php echo $usuarioCliente->getPassword();   ?>">
								</div>
								<input type="file" class="formulario__input" id="files" name="ImagenPerfil" accept="image/*">


								<input type="submit" value="Actualizar" id="btnSend" style="display: inline-block;
								border-radius: 4px;

								border: none;
								color: #FFFFFF;
								text-align: center;
								font-size: 15px;
								padding: 5px;
								width: 100px;
								transition: all 0.5s;
								cursor: pointer;
								margin: 5px;">


							</div>
						</form>

					</section>


				</div>



				<div class="container" style="overflow: hidden;" >
					<section class="form_wrap" style="overflow:hidden;min-height: 500px; min-width: 1000px;">

						<section class="cantact_info" style="overflow:hidden;">
							<section class="info_title" style="text-align: center;">
								<span class="fas fa-house-user"></span>
								<h2>DOMICILIO</h2>

								<a href="nuevoDomicilio.php" class="btn btn-success">Añadir Nuevo Domicilio</a>
							</section>


						</section>




						<table class="table table-striped">

							<thead>
								<tr>
									<th>Calle</th>
									<th>Altura</th>
									<th>Manzana</th>
									<th>Número Casa</th>
									<th>Torre</th>
									<th>Piso</th>
									<th>Barrio</th>
									<th>Localidad</th>
									<th>Provincia</th>
									<th>Pais</th>

									<th>Eliminar</th>
								</tr>
							</thead>

							<tbody>
								<?php foreach  ($listadoDomicilios as $domicilio): ?>
									<tr class="active-row">

										<td><?php echo $domicilio->getCalle(); ?></td>
										<td><?php echo $domicilio->getAltura(); ?></td>
										<td><?php echo $domicilio->getManzana(); ?></td>
										<td><?php echo $domicilio->getNumeroCasa(); ?></td>
										<td><?php echo $domicilio->getTorre(); ?></td>
										<td><?php echo $domicilio->getPiso(); ?></td>
										<td><?php echo $domicilio->barrio->getDescripcion(); ?></td>
										<td><?php echo $domicilio->barrio->localidad->getDescripcion(); ?></td>
										<td><?php echo $domicilio->barrio->localidad->provincia->getDescripcion(); ?></td>
										<td><?php echo $domicilio->barrio->localidad->provincia->pais->getDescripcion(); ?></td>

										<td><a class="btn btn-danger" href="eliminarDomicilio.php?id_persona_domicilio=<?php echo $domicilio->getIdPersonaDomicilio(); ?>" ><i class="botonEliminar fas fa-trash"></i></td>

									</tr>

								<?php endforeach ?>
							</tbody>

						</table>


					</section>


				</div>




				<div class="container" >
					<section class="form_wrap" style="min-height: 500px; min-width: 1000px;">

						<section class="cantact_info">
							<section class="info_title" style="text-align: center;">
								<span class="fas fa-phone-square"></span>
								<h2>CONTACTOS</h2>
							</section>

							<form method="POST" action="procesar_altaContacto.php" class="form__reg" name="formulario" id="formularioAñadir" style="z-index: 100;" >
								<input type="hidden" name="idPersona" value="<?php echo $usuarioCliente->getIdPersona(); ?>" >


								<div class="formulario__grupo" id="grupo__cboTipoContactoNuevo" >
									<label for="cboTipoContactoNuevo" class="formulario__label" style="color:#ffffff">Tipo de Contacto</label>
									<div class="formulario__grupo-input">

										<select name="cboTipoContacto" id="cboTipoContacto" class="formulario__input" required>
											<option value="">-- Seleccionar --</option>

											<?php foreach ($listadoTipoContactos as $tipoContacto): ?>

												<option value="<?php echo $tipoContacto->getIdTipoContacto(); ?>">
													<?php echo $tipoContacto->getDescripcion(); ?>
												</option>

											<?php endforeach ?>

										</select>
										<i class="formulario__validacion-estado fas fa-times-circle"></i>
									</div>	
									<p class="formulario__input-error">Debe seleccionar un tipo de contacto.</p>
								</div>
								<br>

								<div class="formulario__grupo" id="grupo__valorNuevo" >
									<label for="valorNuevo" class="formulario__label" style="color:#ffffff">Valor</label>
									<div class="formulario__grupo-input">
										<input type="text" name="valorNuevo" id="valorNuevo" class="formulario__input" required>
										<i class="formulario__validacion-estado fas fa-times-circle"></i>
									</div>
									<p class="formulario__input-error">El valor no puede estar vacio</p>

								</div>
								<br>

								<div class="formulario__mensaje" id="formulario__mensaje">
									<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
								</div>
								<br>
								<div class="formulario__grupo formulario__grupo-btn-enviar">

									<p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
									<br>
								</div>
								<button type="cancel" name="Cancelar" class="btn btn-danger"  onclick="window.location='/programacion_3/boutique/paginaWeb/miPerfil.php';return false;">Cancelar</button>

								<input type="submit" name="Guardar" value="Guardar"  class="btn btn-success">
								<br><br>
							</form>
						</section>

						<table id="example" class="table" style="" >
							<thead>
								<tr>
									<th>Descripcion</th>
									<th>Valor</th>
									<th>Estado</th>

									<th>Eliminar</th>
								</tr>
							</thead>

							<tbody>
								<?php foreach  ($listadoContactos as $contacto): ?>
									<tr class="active-row">

										<td><?php echo $contacto->getDescripcion(); ?></td>
										<td><?php echo $contacto->getValor(); ?></td>
										<?php
										$estado = $contacto->getEstado();;
										$clase="";
										if ($estado == 1){
											$estado = "Activo";
											$clase= "estadoActivo";
										} else {
											$estado = "Inactivo";
											$clase= "estadoInactivo";
										}
										?>
										<td class="<?php echo $clase; ?>"><?php echo $estado; ?></td>





										<td><a href="eliminarContacto.php?id_persona_contacto=<?php echo $contacto->getIdPersonaContacto(); ?>" class="btn btn-danger"><i class="botonEliminar fas fa-trash"></a></td>

										</tr>

									<?php endforeach ?>
								</tbody>

							</table>

						</section>


					</div>





					<script type="text/javascript">
						$(document).ready(function () {
							var readURL = function (input) {
								if (input.files && input.files[0]) {
									var reader = new FileReader();

									reader.onload = function (e) {
										$('.avatar').attr('src', e.target.result);
									}

									reader.readAsDataURL(input.files[0]);
								}
							}

							$(".file-upload").on('change', function () {
								readURL(this);
							});
						});
					</script>



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