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

require_once "../../../class/pais.php";

$lista = pais::obtenerTodos();

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
		<h2  style="color:#FFFFFF">Tabla de Paises</h2>
	<br>
	<a href="nuevo.php" class="btn-bootstrap">Añadir Pais</a>
	<br>
	
	<div id="main-container">
		<br>
	<table border="1">
	<thead>
	<tr>
		<th>ID Pais</th>
		<th>NOMBRE</th>
		<th>Provincias</th>
		<th>Modificar</th>
		<th>Eliminar</th>
	</tr>
	</thead>
	<?php foreach  ($lista as $pais): ?>

		<tr>
			
			<td><?php echo $pais->getIdPais(); ?></td>
			<td><?php echo $pais->getDescripcion(); ?></td>
			<td><a href="listadoProvincia.php?id_pais=<?php echo $pais->getIdPais(); ?>" class="btn-bootstrap1">Provincias</a></td>
			<td><a href="modificar.php?id_pais=<?php echo $pais->getIdPais(); ?>" class="btn-bootstrap1">Modificar</a></td>
			<td><a href="eliminar.php?id_pais=<?php echo $pais->getIdPais(); ?>" class="btn-bootstrap2">Eliminar</a></td>

		</tr>

	<?php endforeach ?>

	</table>
	</div>
</body>
</html>
