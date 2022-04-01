<?php

require_once "../../class/Producto.php";
require_once "../../class/Categoria.php";
require_once "../../class/Temporada.php";


$listadoTemporada = Temporada::obtenerTodos();

$listadoCategoria = Categoria::obtenerTodos();

$lista = Producto::obtenerTodos();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Listado Productos</title>
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


</head>
<body>
	<?php require_once "../../menu.php"; ?>
	<section class="home-section">
		<br>
		<br>
		<div id="containerNuevo">
			<a href="nuevo.php" class="botonAñadir"><i class="fas fa-plus"></i>NUEVO PRODUCTO</a>
			<a href="actualizarPrecios.php" class="botonAñadir" id="abrir"><i class="fas fa-plus"></i> Actualizar Precios </a>
			
		</div>
		<br>

		<div id="container">


			<table class="styled-table">
				<thead>
					<tr>
						<th>ID </th>
						<th>IMAGEN</th>
						<th>NOMBRE</th>
						<th>MARCA</th>
						<th>PRECIO COMPRA</th>
						<th>PRECIO VENTA</th>
						<th>CATEGORIA</th>
						<th>TEMPORADA</th>
						<th>FECHA ULTIMA MODIFICACION</th>
						<th>Ver Talles </th>
						<th>Modificar</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach  ($lista as $Producto): ?>

						<tr  class="active-row">

							<td><?php echo $Producto->getIdProducto(); ?></td>
							<td><img src='<?php echo $Producto->getImagen(); ?>'style="max-width:100px;width:70px;height:100px;"></td>
							<td><?php echo $Producto->getNombreProducto(); ?></td>
							<td><?php echo $Producto->getMarca(); ?></td>
							<td><?php echo $Producto->getPrecioCompra(); ?></td>
							<td><?php echo $Producto->getPrecioVenta(); ?></td>
							<td><?php echo $Producto->categoria->getNombre(); ?></td>
							<td><?php echo $Producto->temporada->getNombre(); ?></td>
							<td><?php echo $Producto->getFecha(); ?></td>

							<td><a href="/programacion_3/boutique/modulos/productoTalle/listado.php?id_producto=<?php echo $Producto->getIdProducto(); ?>" class="btn-bootstrap">VerTalles</a></td>



							<td><a href="modificar.php?id_producto=<?php echo $Producto->getIdProducto(); ?>" ><i class="botonActualizar fas fa-edit"></i></a></td>

							<td><a href="eliminar.php?id_producto=<?php echo $Producto->getIdProducto(); ?>" ><i class="botonEliminar fas fa-trash"></i></a></td>

						</tr>

					<?php endforeach ?>
				</tbody>

			</table>
		</div>
	</section>
	
</body>
</html>
