<?php


$mensaje = "";

if (isset($_GET["error"])) {
	// code...
	switch ($_GET["error"]) {

	case 'nombreProvincia':
		$mensaje = "<div class='error'>"."El nombre no debe estar vacio y debe tener minimo 3 caracteres"."</div>";
		break;


	case 'false':
		$mensaje = "<div class='correcto'>"."Datos correctos"."</div>";
		sleep(10);
		break;




}


}
require_once "../../../class/Provincia.php";


$id_pais = $_GET["id_pais"];

?>

<!DOCTYPE html>
<html >
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Alta de Provincia</title>

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
	<script>
		function enviar_formulario(){
   		document.formulario.submit()
		}
	</script>
</head>
<body>
	<br>
	<?php require_once "../../../menu.php"; ?>

	<main>

		<div class="container">
			<div class="form__top">
				<h2>Formulario Añadir <span>Pais</span></h2>
			</div>	

			<form method="POST" action="procesar_altaProvincia.php" class="form__reg" name="formulario" id="formulario">
				<?php
	
				echo $mensaje;

				?>
			<input type="hidden" name="txtIdPais" value="<?php echo $id_pais; ?>">

			<!-- Grupo: Nombre -->
			<div class="formulario__grupo" id="grupo__nombre">
				<label for="nombre" class="formulario__label">Nombre de la Provincia</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Argentina">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<br>
				<p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>
			</div>

			
			<br>
			<div class="formulario__mensaje" id="formulario__mensaje">
				<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
			</div>

			<div class="formulario__grupo formulario__grupo-btn-enviar">
				<button type="submit" class="formulario__btn" >Enviar</button>
				<p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
				<br>
			</div>
		</form>
	</div>
	</main>

<script src="../../../js/formularioCategorias.js"></script>
	<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
</body>
</html>

