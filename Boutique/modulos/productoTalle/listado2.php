<?php

require_once "../../class/ProductoTalle.php";



require_once "../../class/Talle.php";




$idProducto = $_GET["id_producto"];

$listadoProductos = ProductoTalle::obtenerPorIdProducto($idProducto);

$listadoTalle = Talle::obtenerTodos();



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
<label style="color:#FFFFFF">Añadir Nuevo Stock</label>

<form method="POST" action="procesar_alta.php" class="form__reg">


		<input type="hidden" name="txtIdProducto" value="<?php echo $idProducto; ?>">
		<br><br>

		<label style="color:#FFFFFF">Cantidad Maxima: <input type="text" name="txtCantidadMaxima" class="input">
		<br><br>
		<label style="color:#FFFFFF">Cantidad Minima: <input type="text" name="txtCantidadMinima" class="input">
		<br><br>
		<label style="color:#FFFFFF">Cantidad Disponible: <input type="text" name="txtCantidadDisponible" class="input">
		<br><br>

		<label style="color:#FFFFFF">Talle:
		<select name="cboTalle" class="input">
		    <option value="NULL">---Seleccionar---</option>

		    <?php foreach ($listadoTalle as $talle): ?>

		    	<option value="<?php echo $talle->getIdTalle(); ?>">
		    		<?php echo $talle->getDescripcion(); ?>
		    	</option>

		    <?php endforeach ?>

		</select>
		<br><br>


		<input type="submit" name="Guardar" class="btn-bootstrap" >
		
	</form>

<br>
<br>
<div id="main-container">
<table border="1">
	<thead>
	<tr>
		<th>ID PRODUCTO TALLE</th>
		<th>CANTIDAD MAXIMA</th>
		<th>CANTIDAD MINIMA</th>
		<th>CANTIDAD DISPONIBLE</th>
		<th>TALLE</th>
		<th>Modificar</th>
		<th>Eliminar</th>
	</tr>
</thead>
	<?php foreach  ($listadoProductos as $productoTalle): ?>

		<tr>
			
			<td><?php echo $productoTalle->getIdProductoTalle(); ?></td>
			<td><?php echo $productoTalle->getCantidadMaxima(); ?></td>
			<td><?php echo $productoTalle->getCantidadMinima(); ?></td>
			<td><?php echo $productoTalle->getCantidadDisponible(); ?></td>
			<td><?php echo $productoTalle->talle->getDescripcion(); ?></td>
			<td><a href="modificar.php?id_producto_talle=<?php echo $productoTalle->getIdProductoTalle(); ?>&id_producto=<?php echo $productoTalle->getIdProducto(); ?>  "  class="btn-bootstrap1">Modificar</a></td>
			<td><a href="eliminar.php?id_producto_talle=<?php echo $productoTalle->getIdProductoTalle(); ?>&id_producto=<?php echo $productoTalle->getIdProducto(); ?>  "  class="btn-bootstrap2">
					Eliminar
				</a></td>

		</tr>

	<?php endforeach ?>

</table>
</div>
</body>
</html>
