<?php

$mensaje = "";

if (isset($_GET["validacion"])) {
	// code...
	switch ($_GET["validacion"]) {

	case 'true':
		$mensaje = "<div class='correcto' align='center'>"."Datos Cargados Correctamente"."</div>";
		break; 

	case 'eliminado':
		$mensaje = "<div class='correcto' align='center'>"."Datos Eliminados Correctamente"."</div>";
		break; 	
	}
}


?>


<?php

require_once "../../../class/provincia.php";
$id_pais = $_GET["id_pais"];

$lista = provincia::obtenerPorIdPais($id_pais);

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
		<h2  style="color:#FFFFFF">Tabla de Provincias</h2>
	<br>
	<a href="nuevoProvincia.php?id_pais=<?php echo $id_pais ?>" class="btn-bootstrap">Añadir Provincia</a>
	<div id="main-container">
		<br>
	<table border="1">
	<thead>
	<tr>
		<th>ID Provincia</th>
		<th>NOMBRE</th>
		<th>Localidades</th>
		<th>Modificar</th>
		<th>Eliminar</th>
	</tr>
	</thead>
	<?php foreach  ($lista as $provincia): ?>

		<tr>
			
			<td><?php echo $provincia->getIdProvincia(); ?></td>
			<td><?php echo $provincia->getDescripcion(); ?></td>
			<td><a href="listadoLocalidad.php?id_provincia=<?php echo $provincia->getIdProvincia(); ?>" class="btn-bootstrap1">Localidades</a></td>
			<td><a href="modificarProvincia.php?id_pais=<?php echo $id_pais ?>&id_provincia=<?php echo $provincia->getIdProvincia(); ?>" class="btn-bootstrap1">Modificar</a></td>
			<td><a href="eliminarProvincia.php?id_pais=<?php echo $id_pais ?>&id_provincia=<?php echo $provincia->getIdProvincia(); ?>" class="btn-bootstrap2">Eliminar</a></td>

		</tr>

	<?php endforeach ?>

	</table>
	</div>
</body>
</html>
