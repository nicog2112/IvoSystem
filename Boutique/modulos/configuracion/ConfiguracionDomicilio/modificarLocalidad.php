<?php

require_once "../../../class/Localidad.php";


$id_provincia = $_GET["id_provincia"];
$id_localidad = $_GET["id_localidad"];

$localidad = Localidad::obtenerPorIdLocalidad($id_localidad);


$mensaje = "";

if (isset($_GET["error"])) {
	// code...
	switch ($_GET["error"]) {

	case 'nombreaLocalidad':
		$mensaje = "<div class='error'>"."El nombre no debe estar vacio y debe tener minimo 3 caracteres"."</div>";
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
		<link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"> 
	<link rel="stylesheet" href="../../../css/formularios.css">
	<link rel="stylesheet" href="../../../css/main2.css">
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

	<?php require_once "../../../menu.php"; ?>
	<main>
	<div class="container">
		<div class="form__top">
			<h2>Formulario Modificar <span>Localidad</span></h2>
		</div>


	

	<form method="POST" action="procesar_modificacionLocalidad.php"  class="form__reg" name="formulario" id="formulario">

		<input type="hidden" name="txtIdLocalidad" value="<?php echo $id_localidad; ?>">

		<?php

		echo $mensaje;

	     ?>
	     <input type="hidden" name="txtIdProvincia" value="<?php echo $id_provincia; ?>">

	     <!-- Grupo: Nombre -->
			<div class="formulario__grupo" id="grupo__nombre">
				<label for="nombre" class="formulario__label">Nombre de la Localidad</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="nombre" id="nombre" value="<?php echo $localidad->getDescripcion(); ?>" >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<br>
				<p class="formulario__input-error">El nombre tiene que ser de 4 a 16 caracteres y solo puede contener letras</p>
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
		
	</form>
</div>
</main>
		<script src="../../../js/formularioCategorias.js"></script>
	<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
</body>
</html>