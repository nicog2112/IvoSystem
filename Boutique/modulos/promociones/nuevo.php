<?php
 $fcha = date("Y-m-d");

$mensaje = "";
$mensaje1 = "";
$mensaje2 = "";
$mensaje3 = "";

if (isset($_GET["error"])) {
	// code...
	switch ($_GET["error"]) {

	case 'nombrePromocion':
		$mensaje1 = "<div class='error'>"."El nombre no debe estar vacio y debe tener minimo 3 caracteres"."</div>";
			break;
	

	case 'fechaInicio':
		$mensaje2 = "<div class='error'>"."La fecha de inicio tiene que ser mayor a la fecha actual"."</div>";
		break;

	case 'fechaFin':
		$mensaje3 = "<div class='error'>"."La fecha de finalizacion tiene que ser mayor a la fecha de inicio"."</div>";
		break;

	case 'false':
		$mensaje = "<div class='correcto'>"."Datos correctos"."</div>";
		sleep(10);
		break;




}


}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../css/reset.css">
	<link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"> 
	<link rel="stylesheet" href="../../css/formularios.css">
	<link rel="stylesheet" href="../../css/main2.css">
	<style>
		.error{
			background-color: #FF9185;
			font-size: 12px;
			padding: 10px;
		}
		.correcto{
			background-color: #A0DEA7;
			font-size: 12px;
			padding: 10px;
		}
	</style>
	<title>Formulario</title>
</head>
<body>
	<br>
	<?php require_once "../../menu.php"; ?>
	<main>
	<div class="container">
		<div class="form__top">
			<h2>Formulario Añadir <span>Promociones</span></h2>
		</div>	

	<br><br>

	<form method="POST" action="procesar_alta.php" class="form__reg" name="formulario" id="formulario">
		<?php
	
				echo $mensaje1;

				?>
		<!-- Grupo: Nombre -->
			<div class="formulario__grupo" id="grupo__nombre">
				<label for="nombre" class="formulario__label">Nombre de la Promocion</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Hot Sale">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<br>
				<p class="formulario__input-error">El nombre de la Temporada tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>
			</div>

		<br>
		<?php
	
				echo $mensaje2;

				?>
		<br>
			<!-- Grupo: Fecha de Inicio-->
			<div class="formulario__grupo" id="grupo__fechaInicio">
				<label for="fechaInicio" class="formulario__label">Fecha de Inicio</label>
				<div class="formulario__grupo-input">
					<input type="date" class="formulario__input" name="fechaInicio" id="fechaInicio" value="<?php echo $fcha;?>">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<br>
				<p class="formulario__input-error">La fecha es incorrecta</p>
			</div>
		<br>
		<?php
	
				echo $mensaje3;

				?>
				<br>
			<!-- Grupo: Fecha de Fin-->
			<div class="formulario__grupo" id="grupo__fechaFin">
				<label for="fechaFin" class="formulario__label">Fecha de Finalizacion</label>
				<div class="formulario__grupo-input">
					<input type="date" class="formulario__input" name="fechaFin" id="fechaFin">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<br>
				<p class="formulario__input-error">La fecha es incorrecta</p>
			</div>
		
		<br><br>
					<div class="formulario__mensaje" id="formulario__mensaje">
				<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
			</div>
			<br>
			<div class="formulario__grupo formulario__grupo-btn-enviar">
				<button type="submit" class="formulario__btn" >Enviar</button>
				<p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
				<br>
			</div>
		</form>
	</div>
	</main>

	<script src="../../js/formularioPromociones.js"></script>
	<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>

</body>
</html>