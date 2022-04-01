<?php





$mensaje = "";
$mensaje1 = "";
$mensaje2 = "";

if (isset($_GET["error"])) {
	// code...
	switch ($_GET["error"]) {

	case 'nombreModulo':
		$mensaje1 = "<div class='error'>"."El nombre no debe estar vacio y debe tener minimo 3 caracteres"."</div>";
		break;

	case 'directorio':
		$mensaje2 = "<div class='error'>"."El directorio no debe estar vacio y debe tener minimo 3 caracteres"."</div>";
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


	<link rel="stylesheet" href="../../css/formularios.css">
	
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
	

	<form method="POST" action="procesar_modificacion.php"  class="form__reg" name="formulario" id="formulario">

		<input type="text" name="txtIdModulo" id="id">


		<?php

		echo $mensaje;

	     ?>

	     <!-- Grupo: Nombre -->
			<div class="formulario__grupo" id="grupo__nombre">
				<label for="nombre" class="formulario__label">Nombre del modulo</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="nombre" id="nombre"  >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<br>
				<p class="formulario__input-error">El nombre tiene que ser de 4 a 16 caracteres y solo puede contener letras</p>
			</div>


	     <!-- Grupo: Directorio -->
			<div class="formulario__grupo" id="grupo__directorio">
				<label for="directorio" class="formulario__label">Directorio</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="directorio" id="directorio">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<br>
				<p class="formulario__input-error">El directorio tiene que ser de 4 a 16 caracteres y solo puede contener letras</p>
			</div>

			
			<br>

			<div class="formulario__mensaje" id="formulario__mensaje">
				<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
			</div>

			<div class="formulario__grupo formulario__grupo-btn-enviar">
				<br>
				<button type="submit" class="formulario__btn" >Enviar</button>
				<p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
				<br>
			</div>
	
		
	</form>

		<script src="../../js/formularioModulos.js"></script>
	<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
</body>
</html>