<?php

require_once "../../class/Categoria.php";

$lista = Categoria::obtenerTodos();

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
<a href="nuevo.php" class="btn-bootstrap">NUEVA CATEGORIA</a>

<br>
<br>
<div id="main-container">
<table border="1">
	<thead>
	<tr>
		<th>ID CATEGORIA</th>
		<th>NOMBRE</th>
		<th>Modificar</th>
		<th>Eliminar</th>
	</tr>
</thead>
	<?php foreach  ($lista as $Categoria): ?>

		<tr>
			
			<td><?php echo $Categoria->getIdCategoria(); ?></td>
			<td><?php echo $Categoria->getNombre(); ?></td>
			<td><a href="modificar.php?id_categoria=<?php echo $Categoria->getIdCategoria(); ?>" class="btn-bootstrap1">Modificar</a></td>
			<td><a href="eliminar.php?id_categoria=<?php echo $Categoria->getIdCategoria(); ?>" class="btn-bootstrap2">Eliminar</a></td>

		</tr>

	<?php endforeach ?>

</table>
</div>
</body>
</html>
