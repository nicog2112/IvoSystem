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

require_once "../../class/Proveedor.php";

$lista = Proveedor::obtenerTodos();

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Listado Proveedores</title>
<link rel="stylesheet" href="../../css/modalNUEVO.css">	
<link rel="stylesheet" href="../../css/tablaNUEVO.css">
<link rel="stylesheet" href="../../css/all.min.css">
<link rel="stylesheet" href="../../css/botonesNUEVO.css">
<link rel="shortcut icon" href="/programacion_3/boutique/logo.ico">
<style>
	.error{
		background-color: #FF9185;
		font-size: 12px;
		padding: 10px;
	}
	.correcto{
		background-color: #A0DEA7;
		font-size: 12px;
		padding: 10px;
	}
</style>
<script src="../../js/ventanaModal.js" ></script>

</head>
<body>
<?php require_once "../../menu.php"; ?>
<section class="home-section">
<br>
<br>
<div id="containerNuevo">
<a href="#" class="botonAñadir" id="abrir" onclick="abrirModal(this.id);" ><i class="fas fa-plus"></i> Añadir </a>
</div>
<br>

<div id="container">


<table class="styled-table">
<thead>
<tr>
	<th>ID </th>
	<th>EMPRESA</th>
	<th>CUIT</th>
	<th>FECHA ALTA</th>
	<th>Preventista</th>
	<th>Domicilios</th>
	<th>Contactos</th>
	<th>Modificar</th>
	<th>Eliminar</th>
</tr>
</thead>

<tbody>
	<?php foreach  ($lista as $Proveedor): ?>
	<tr  class="active-row">
		
		
		<td><?php echo $Proveedor->getIdProveedor(); ?></td>
		<td><?php echo $Proveedor->getNombreProveedor(); ?></td>
		<td><?php echo $Proveedor->getCuit(); ?></td>
		<td><?php echo $Proveedor->getFechaAlta(); ?></td>
		<td><a href="/programacion_3/boutique/modulos/Preventistas/listado.php?id_proveedor=<?php echo $Proveedor->getIdProveedor(); ?>"><i class="botonGeneral fas fa-user"></i></a></td>
		<td>
			<a href="../domiciliosProveedores/domicilios.php?id_proveedor=<?php echo $Proveedor->getIdProveedor(); ?>&modulo=proveedor" > <i class="botonGeneral fas fa-house-user"></i> </a>
		</td>
		<td>
			<a href="../contactosProveedores/contactos.php?id_proveedor=<?php echo $Proveedor->getIdProveedor(); ?>"><i class="botonGeneral fas fa-phone-alt"></i></a>
		</td>
		<td><a href="modificar.php?id_proveedor=<?php echo $Proveedor->getIdProveedor(); ?>" ><i class="botonActualizar fas fa-edit"></i></a></td>
		
		<td><a href="eliminar.php?id_proveedor=<?php echo $Proveedor->getIdProveedor(); ?>" ><i class="botonEliminar fas fa-trash"></i></a></td>
		</tbody>
	</tr>

<?php endforeach ?>
</tbody>

</table>
</div>
<a href="#" id="abrir2" onclick="abrirModal(this.id);">MODIFICAR</a>

	<div id="miModal" class="modal">
		<div class="flex" id="flex">
			<div class="contenido-modal">
				<div class="modal-header flex">
					<h2>Añadir Nuevo Proveedor</h2>
					<span class="close" id="close">&times;</span>
				</div>
				<div class="modal-body">
					<?php require_once "../../modulos/proveedores/nuevo.php";?>

				</div>

			</div>
		</div>
	</div>

		<div id="miModal2" class="modal">
		<div class="flex" id="flex2">
			<div class="contenido-modal">
				<div class="modal-header flex">
					<h2>MODIFICAR Proveedor</h2>
					<span class="close" id="close2">&times;</span>
				</div>
				<div class="modal-body">
					<?php require_once "../../modulos/proveedores/nuevo.php";?>

				</div>

			</div>
		</div>
	</div>

</section>
</body>

</html>


