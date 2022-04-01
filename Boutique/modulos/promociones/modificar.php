<?php

require_once "../../class/Promocion.php";


$id_promocion = $_GET["id_promocion"];

$promocion = Promocion::obtenerPorId($id_promocion);


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
			<h2>Formulario Modificar <span>Promocion</span></h2>
		</div>


	<br><br>

	<form method="POST" action="procesar_modificacion.php"  class="form__reg">

		<input type="hidden" name="txtIdPromocion" value="<?php echo $id_promocion; ?>">

		Nombre de la Promocion: <input type="text" name="txtNombrePromocion" value="<?php echo $promocion->getNombre(); ?>" class="input">
		<br><br>
		Fecha de Inicio: <input type="date" name="txtFechaInicio" value="<?php echo $promocion->getFechaInicio(); ?>" class="input">
		<br><br>
		Fecha de Finalizacion: <input type="date" name="txtFechaFin" value="<?php echo $promocion->getFechaFin(); ?>" class="input">
		<br><br>

		<input type="submit" name="Guardar" value="Actualizar"  class="btn__submit">
		
	</form>

</body>
</html>