<?php

require_once "../../class/Preventista.php";



$id_proveedor = $_GET["id_proveedor"];
$lista = Preventista::obtenerTodos($id_proveedor);



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
</head>
<body>


<?php require_once "../../menu.php"; ?>
<br>
<br>
<a href="nuevo.php" class="btn-bootstrap">NUEVO PREVENTISTA</a>

<br>
<br>
<div id="main-container">
<table border="1">
	<thead>
	<tr>
		<th>ID Preventista</th>
		<th>Nombre</th>
		<th>Apellido</th>
		<th>DNI</th>
		<th>Sexo</th>
		<th>Nacionalidad</th>
		<th>Fecha Nacimiento</th>
		<th>Empresa-Proveedor</th>
		<th>Modificar</th>
		<th>Eliminar</th>
	</tr>
</thead>
	<?php foreach  ($lista as $preventista): ?>

		<tr>
			
			<td><?php echo $preventista->getIdPreventista(); ?></td>
			<td><?php echo $preventista->getNombre(); ?></td>
			<td><?php echo $preventista->getApellido(); ?></td>
			<td><?php echo $preventista->getDni(); ?></td>
			<td><?php echo $preventista->getIdSexo(); ?></td>
			<td><?php echo $preventista->getNacionalidad(); ?></td>
			<td><?php echo $preventista->getFechaNacimiento(); ?></td>
			<td><?php echo $preventista->proveedor->getNombreProveedor(); ?></td>
			<td><a href="modificar.php?id_preventista=<?php echo $preventista->getIdPreventista(); ?>" class="btn-bootstrap1">Modificar</a></td>
			<td><a href="eliminar.php?id_preventista=<?php echo $preventista->getIdPreventista(); ?>" class="btn-bootstrap2">Eliminar</a></td>

		</tr>

	<?php endforeach ?>

</table>
</div>
</body>
</html>
