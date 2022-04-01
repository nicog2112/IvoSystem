<?php


$mensaje = "";

if (isset($_GET["error"])) {
	// code...
	switch ($_GET["error"]) {

	case 'nombrePais':
		$mensaje = "El nombre no debe estar vacio y debe tener minimo 3 caracteres";
		break;



}


}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="../../js/funciones.js"></script>
	<link rel="stylesheet" href="../../css/reset.css">
	<link href="https://fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet">
	<link rel="stylesheet" href="../../css/main2.css">
	<title>Formulario</title>
</head>
<body>
	<br>
	<?php require_once "../../menu.php"; ?>
	

	<div class="container">
		<div class="form__top">
			<h2>Formulario Añadir <span>Pais</span></h2>
		</div>	

	<br>

	<form method="POST" action="procesar_alta.php" class="form__reg">
		<div id="divMensaje"></div>
		<br><br>

	<?php

		echo $mensaje;

	?>
	<br><br>
		Nombre del Pais: <input type="text" id="txtNombrePais" name="txtNombrePais" class="input">
		<br><br>


		<input onclick="validar();" type="submit" name="Guardar" class="btn__submit" >
   

	</form>

</body>
</html>