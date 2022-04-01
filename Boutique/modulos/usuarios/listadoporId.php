<?php

require_once "../../class/Usuario.php";

$idPersona = $_GET["id_persona"];

$lista = Usuario::obtenerPorIdPersona($idPersona);

?>

<!DOCTYPE html>
<html>
<head>
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
<a href="nuevo.php" class="btn-bootstrap">NUEVO USUARIO</a>

<br><br>
<div id="main-container">
<table border="1">
<thead>
	<tr>
		<th>ID Usuario</th>
		<th>Usuario</th>
		<th>Perfil</th>
		<th align="center">Modificar</th>
		<th align="center">Eliminar</th>

	</tr>
</thead>
	<?php foreach  ($lista as $usuario): ?>
		

		<tr>
			
			<td><?php echo $usuario->getIdUsuario(); ?></td>
			<td><?php echo $usuario->getUsername(); ?></td>
			
			<td><?php echo $usuario->perfil->getDescripcion(); ?></td>
			<td><a href="modificar.php?id_usuario=<?php echo $usuario->getIdUsuario(); ?>" class="btn-bootstrap1">Modificar</a></td>
			<td><a href="eliminar.php?id_usuario=<?php echo $usuario->getIdUsuario(); ?>" class="btn-bootstrap2">Eliminar</a></td>

		</tr>

	<?php endforeach ?>

</table>
</div>
</body>
</html>