<?php

require_once "../../../class/TipoContacto.php";

$listadoTipoContactos = TipoContacto::obtenerTodos();

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
	
</head>
<body>

<?php require_once "../../../menu.php"; ?>

<br>
<br>

<form method="POST" action="procesar_alta.php">

	<label style="color:#FFFFFF">Descripcion del Tipo de Contacto:</label>
	 <input type="text" name="txtDescripcion" class="input">
		<br><br>

	<input type="submit" value="Agregar" class="btn-bootstrap" >


</form>



<br>
<br>
<div id="main-container">

<table border="1">
	<thead>
	<tr>
		<th>ID</th>
		<th>Descripcion</th>
		<th>Modificar</th>
		<th>Eliminar</th>
	</tr>
</thead>

	<?php foreach  ($listadoTipoContactos as $contacto): ?>

		<tr>
			<td><?php echo $contacto->getIdTipoContacto(); ?></td>
			<td><?php echo $contacto->getDescripcion(); ?></td>
			<td>
				<a href="modificar.php?id_tipo_contacto=<?php echo $contacto->getIdTipoContacto(); ?>" class="btn-bootstrap1">
					Modificar
				</a>
			</td>
			<td>
				<a href="eliminar.php?id_tipo_contacto=<?php echo $contacto->getIdTipoContacto(); ?>" class="btn-bootstrap2">Eliminar</a>
			</td>
		</tr>

	<?php endforeach ?>

</table>
</div>

</body>
</html>
