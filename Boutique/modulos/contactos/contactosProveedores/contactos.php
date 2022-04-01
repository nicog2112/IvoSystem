<?php

require_once "../../class/Contacto.php";
require_once "../../class/TipoContacto.php";


$idPersona = $_GET["id_persona"];

$listadoContactos = Contacto::obtenerPorIdPersona($idPersona);

$listadoTipoContactos = TipoContacto::obtenerTodos();

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

<a href=/programacion_3/boutique/modulos/contactos/tipoContacto/contactos.php "  class="btn-bootstrap">
					Listado Tipo de Contactos
</a>


<br>
<br>

<form method="POST" action="procesar_alta.php">

	<input type="hidden" name="txtIdPersona" value="<?php echo $idPersona; ?>">

	<label style="color:#FFFFFF">Tipo Contacto</label>
	<select name="cboTipoContacto" class="input">
		<option value=0>-- Seleccionar --</option>

		<?php foreach ($listadoTipoContactos as $tipoContacto): ?>

			<option value="<?php echo $tipoContacto->getIdTipoContacto(); ?>">
				<?php echo $tipoContacto->getDescripcion(); ?>
			</option>
			
		<?php endforeach ?>

	</select>
	
	&nbsp;&nbsp;&nbsp;&nbsp;

	<label style="color:#FFFFFF">Valor</label>
	<input type="text" name="txtValor" class="input">
	
	&nbsp;&nbsp;&nbsp;

	<input type="submit" value="Agregar" class="btn-bootstrap" >


</form>



<br>
<br>
<div id="main-container">

<table border="1">
	<thead>
	<tr>
		<th>Descripcion</th>
		<th>Valor</th>
		<th>Eliminar</th>
	</tr>
</thead>

	<?php foreach  ($listadoContactos as $contacto): ?>

		<tr>
			<td><?php echo $contacto->getDescripcion(); ?></td>
			<td><?php echo $contacto->getValor(); ?></td>
			<td>
				<a href="eliminar.php?idPersonaContacto=<?php echo $contacto->getIdPersonaContacto(); ?>&id_persona=<?php echo $contacto->getIdPersona(); ?>  "  class="btn-bootstrap2">
					Eliminar
				</a>
			</td>
		</tr>

	<?php endforeach ?>

</table>
</div>

</body>
</html>
