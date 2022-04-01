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

require_once "../../../class/barrio.php";
$id_localidad = $_GET["id_localidad"];

$lista = barrio::obtenerPorIdLocalidad($id_localidad);

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title></title>

	<link rel="stylesheet" href="../../../css/tabla.css">

	<link rel="stylesheet" href="../../../css/botonAñadir.css">
	<link rel="stylesheet" href="../../../css/botonModificar.css">
	<link rel="stylesheet" href="../../../css/botonEliminar.css">
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

	<?php require_once "../../../menu.php"; ?>
	<br>
		<h2  style="color:#FFFFFF">Tabla de Barrios</h2>
	<br>
	<td><a href="nuevoBarrio.php?id_localidad=<?php echo $id_localidad ?>" class="btn-bootstrap">Añadir Barrio</a></td>
	<div id="main-container">
		<br>
	<table border="1">
	<thead>
	<tr>
		<th>ID Barrio</th>
		<th>NOMBRE</th>
		<th>Modificar</th>
		<th>Eliminar</th>
	</tr>
	</thead>
	<?php foreach  ($lista as $barrio): ?>

		<tr>
			
			<td><?php echo $barrio->getIdBarrio(); ?></td>
			<td><?php echo $barrio->getDescripcion(); ?></td>
			<td><a href="modificarBarrio.php?id_localidad=<?php echo $id_localidad ?>&id_barrio=<?php echo $barrio->getIdBarrio(); ?>" class="btn-bootstrap1">Modificar</a></td>
			<td><a href="eliminarBarrio.php?id_localidad=<?php echo $id_localidad ?>&id_barrio=<?php echo $barrio->getIdBarrio(); ?>"  class="btn-bootstrap2">Eliminar</a></td>

		</tr>

	<?php endforeach ?>

	</table>
	</div>
</body>
</html>
