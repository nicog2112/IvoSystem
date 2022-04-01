<?php
require_once "../../class/Perfil.php";
require_once "../../class/PerfilModulo.php";
require_once "../../class/Modulo.php";

$listadoModulos = Modulo::obtenerTodos();
$id_perfil = $_GET["id_perfil"];
$perfil = Perfil::obtenerPorId($id_perfil);

$mensaje = "";

if (isset($_GET["error"])) {
	// code...
	switch ($_GET["error"]) {

	case 'nombrePerfil':
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
	<link rel="stylesheet" href="../../css/formularios.css">
	<link rel="stylesheet" href="../../css/styles.css">
	<link rel="stylesheet" href="../../css/main2.css">
	<script
  src="http://code.jquery.com/jquery-3.2.1.slim.min.js"
  integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g="
  crossorigin="anonymous"></script>
  	<!-- Cargamos nuesto archivo Java Script-->
	<script type="text/javascript" src="../../js/functions.js"></script>
	<!-- Cargamos la fuente de Google Raleway : visitar Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<!-- Cargamos nuestra hoja de estilos -->
	

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
				<h2>Formulario Añadir <span>Modulos</span></h2>
			</div>	

			<form method="POST" action="procesar_altaModulos.php" class="form__reg" name="formulario" id="formulario">
					
					<input type="hidden" name="txtIdPerfil" value="<?php echo $id_perfil; ?>">

					<?php foreach ($listadoModulos as $modulo): 
						?>

					<?php

					$checked = '';

					foreach ($perfil->getModulos() as $perfilModulo) {
						if ($modulo->getIdModulo() == $perfilModulo->getIdModulo()) {
							$checked = "checked";
						}
					}

					?>
					
						<label class="content-input">
							<input <?php echo $checked; ?> type="checkbox" name="chkl[ ]"value="<?php echo $modulo->getIdModulo(); ?>">
							<i></i>
							<?php echo $modulo->getDescripcion(); ?> 
						</label>
					<?php endforeach ?>
					
					<br>
					<div class="formulario__grupo formulario__grupo-btn-enviar">
				<button type="submit" class="formulario__btn" >Enviar</button>
				
				<br>
			</div>
			</form>
		</div>
	</main>
</body>
</html>
