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

require_once "../../class/Perfil.php";

$lista = Perfil::obtenerTodos();

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
<a href="nuevo.php" class="btn-bootstrap">NUEVO PERFIL</a>

<br>
<br>
<div id="main-container">
<table border="1">
	<thead>
	<tr>
		<th>ID PERFIL</th>
		<th>Descripcion</th>
		<th>Listado Modulos</th>
		<th>Modificar</th>
		<th>Eliminar</th>
	</tr>
</thead>
	<?php foreach  ($lista as $Perfil): ?>

		<tr>
			
			<td><?php echo $Perfil->getIdPerfil(); ?></td>
			<td><?php echo $Perfil->getDescripcion(); ?></td>
			<td><a href="listadoModulos.php?id_perfil=<?php echo $Perfil->getIdPerfil(); ?>" class="btn-bootstrap1">Modulos</a></td>
			<td><a href="modificar.php?id_perfil=<?php echo $Perfil->getIdPerfil(); ?>" class="btn-bootstrap1">Modificar</a></td>
			<td><a href="eliminar.php?id_perfil=<?php echo $Perfil->getIdPerfil(); ?>" class="btn-bootstrap2">Eliminar</a></td>

		</tr>

	<?php endforeach ?>

</table>
</div>
</body>
</html>
