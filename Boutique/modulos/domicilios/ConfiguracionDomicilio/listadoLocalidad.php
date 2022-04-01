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

require_once "../../../class/localidad.php";
$id_provincia = $_GET["id_provincia"];

$lista = Localidad::obtenerPorIdProvincia($id_provincia);

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
		<h2  style="color:#FFFFFF">Tabla de Localidades</h2>
	<br>
	<a href="nuevoLocalidad.php?id_provincia=<?php echo $id_provincia ?>" class="btn-bootstrap">Añadir Localidad</a>
	<div id="main-container">
		<br>
	<table border="1">
	<thead>
	<tr>
		<th>ID Localidad</th>
		<th>NOMBRE</th>
		<th>Barrios</th>
		<th>Modificar</th>
		<th>Eliminar</th>
	</tr>
	</thead>
	<?php foreach  ($lista as $localidad): ?>

		<tr>
			
			<td><?php echo $localidad->getIdLocalidad(); ?></td>
			<td><?php echo $localidad->getDescripcion(); ?></td>
			<td><a href="listadoBarrio.php?id_localidad=<?php echo $localidad->getIdLocalidad(); ?>" class="btn-bootstrap1">Barrios</a></td>
			<td><a href="modificarLocalidad.php?id_provincia=<?php echo $id_provincia ?>&id_localidad=<?php echo $localidad->getIdLocalidad(); ?>" class="btn-bootstrap1">Modificar</a></td>
			<td><a href="eliminarLocalidad.php?id_provincia=<?php echo $id_provincia ?>&id_localidad=<?php echo $localidad->getIdLocalidad(); ?>" class="btn-bootstrap2">Eliminar</a></td>

		</tr>

	<?php endforeach ?>

	</table>
	</div>
</body>
</html>
