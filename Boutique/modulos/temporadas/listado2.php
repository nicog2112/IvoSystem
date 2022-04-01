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

require_once "../../class/Temporada.php";

$lista = Temporada::obtenerTodos();

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

<a href="nuevo.php" class="btn-bootstrap">NUEVA TEMPORADA</a>

<br>
<br>
<div id="main-container">
<table border="1">
	<thead>
	<tr>
		<th>ID TEMPORADA</th>
		<th>NOMBRE</th>
		<th>AÑO</th>
		<th>Modificar</th>
		<th>Eliminar</th>
	</tr>
</thead>
	<?php foreach  ($lista as $temporada): ?>

		<tr>
			
			<td><?php echo $temporada->getIdTemporada(); ?></td>
			<td><?php echo $temporada->getNombre(); ?></td>
			<td><?php echo $temporada->getAño(); ?></td>
			<td><a href="modificar.php?id_temporada=<?php echo $temporada->getIdTemporada(); ?>" class="btn-bootstrap1">Modificar</a></td>
			<td><a href="eliminar.php?id_temporada=<?php echo $temporada->getIdTemporada(); ?>" class="btn-bootstrap2">Eliminar</a></td>

		</tr>

	<?php endforeach ?>

</table>
</div>
</body>
</html>
