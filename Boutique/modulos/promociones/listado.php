<?php

$mensaje = "";

if (isset($_GET["validacion"])) {
	// code...
	switch ($_GET["validacion"]) {

	case 'true':
		$mensaje = "<div class='correcto' align='center'>"."Datos Cargados Correctamente"."</div>";
		break; 
	}
}


?>

<?php

require_once "../../class/Promocion.php";

$lista = Promocion::obtenerTodos();

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title></title>

	<link rel="stylesheet" href="../../css/tabla.css">

	<link rel="stylesheet" href="../../css/botonAñadir.css">
	<link rel="stylesheet" href="../../css/botonModificar.css">
	<link rel="stylesheet" href="../../css/botonEliminar.css">
	<style>

		.correcto{
			background-color: #A0DEA7;
			font-size: 12px;
			padding: 10px;
		}
	</style>
</head>
<body>
<?php

		echo $mensaje;

	?>

<?php require_once "../../menu.php"; ?>
<br>
<br>
<a href="nuevo.php" class="btn-bootstrap">NUEVA PROMOCION</a>

<br>
<br>
<div id="main-container">
<table border="1">
	<thead>
	<tr>
		<th>ID PROMOCION</th>
		<th>Nombre</th>
		<th>Fecha de Inicio</th>
		<th>Fecha de Finalizacion</th>
		<th>Modificar</th>
		<th>Eliminar</th>
	</tr>
</thead>
	<?php foreach  ($lista as $promocion): ?>

		<tr>
			
			<td><?php echo $promocion->getIdPromocion(); ?></td>
			<td><?php echo $promocion->getNombre(); ?></td>
			<td><?php echo $promocion->getFechaInicio(); ?></td>
			<td><?php echo $promocion->getFechaFin(); ?></td>
			<td><a href="modificar.php?id_promocion=<?php echo $promocion->getIdPromocion(); ?>" class="btn-bootstrap1">Modificar</a></td>
			<td><a href="eliminar.php?id_promocion=<?php echo $promocion->getIdPromocion(); ?>" class="btn-bootstrap2">Eliminar</a></td>

		</tr>

	<?php endforeach ?>

</table>
</div>
</body>
</html>
