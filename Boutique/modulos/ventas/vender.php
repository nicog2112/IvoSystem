
<?php 
include_once "../../menu.php" ;
require_once "../../class/Talle.php";
require_once "../../class/Cliente.php";
require_once "../../class/Empleado.php";
$listadoTalle = Talle::obtenerTodos();
$listadoClientes = Cliente::obtenerTodos();
$listadoEmpleados = Empleado::obtenerTodos();
?>
<?php 
if(!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
$granTotal = 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Ventas</title>
	
	<link rel="stylesheet" href="../../css/tabla.css">

	<link rel="stylesheet" href="../../css/botonAñadir.css">
	<link rel="stylesheet" href="../../css/botonModificar.css">
	<link rel="stylesheet" href="../../css/botonEliminar.css">

	<link rel="stylesheet" href="./css/2.css">
	
</head>
<body>
<?php require_once "../../menu.php"; ?>
<h1 style="color:#FFFFFF;">Vender</h1>
			
		
		<?php
			if(isset($_GET["status"])){
				if($_GET["status"] === "1"){
					?>
						<div class="alert alert-success">
							<strong>¡Correcto!</strong> Venta realizada correctamente
						</div>
					<?php
				}else if($_GET["status"] === "2"){
					?>
					<div class="alert alert-info">
							<strong>Venta cancelada</strong>
						</div>
					<?php
				}else if($_GET["status"] === "3"){
					?>
					<div class="alert alert-info">
							<strong>Ok</strong> Producto quitado de la lista
						</div>
					<?php
				}else if($_GET["status"] === "4"){
					?>
					<div class="alert alert-warning">
							<strong>Error:</strong> El producto que buscas no existe
						</div>
					<?php
				}else if($_GET["status"] === "5"){
					?>
					<div class="alert alert-danger">
							<strong>Error: </strong>El producto está agotado
						</div>
					<?php
				}else{
					?>
					<div class="alert alert-danger">
							<strong>Error:</strong> Algo salió mal mientras se realizaba la venta
						</div>
					<?php
				}
			}
		?>
		<br>
		<form method="post" action="agregarAlCarrito.php">
			<div class="formulario__grupo" id="grupo__Empleado">
			<input type="hidden" name="promocion" value="10">
			<input type="hidden" name="estado" value="1">
			<label for="codigo" style="color:#FFFFFF;">Código del producto:</label>
			<input autocomplete="off"  class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código">
			<label for="cantidad" style="color:#FFFFFF;">Cantidad:</label>
			<input autocomplete="off"  class="form-control" name="cantidad" required type="text" id="cantidad" placeholder="Escribe la cantidad">
			<label for="cantidad" style="color:#FFFFFF;">Talle:</label>
			<select class="form-control" name="cboTalle" class="input">
		    <option value="NULL">---Seleccionar---</option>

		    <?php foreach ($listadoTalle as $talle): ?>

		    	<option value="<?php echo $talle->getIdTalle(); ?>">
		    		<?php echo $talle->getDescripcion(); ?>
		    	</option>

		    <?php endforeach ?>

		</select>
			<br>
			<input type="submit" name="Cargar" class="btn__submit">
		</form>
		<br><br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>Código</th>
					<th>Imagen</th>
					<th>Descripción</th>
					<th>Talle</th>
					<th>Precio de venta</th>
					<th>Descuento x Promocion</th>
					<th>Cantidad</th>
					<th>Total</th>
					<th>Quitar</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($_SESSION["carrito"] as $indice => $producto){ 
						$granTotal += $producto->total;
					?>
				<tr>
					<td><?php echo $producto->id_producto_talle ?></td>
					<td><?php echo $producto->id_producto ?></td>
					<td><img src='../../modulos/productos/<?php echo $producto->imagen ?>'style="max-width:100px;width:70px;height:100px;"></td>
					<td><?php echo $producto->descripcion ?></td>
					<td>
						<?php 
						$id_talle=$producto->id_talle;
						foreach ($listadoTalle as $talle): 

						if ($talle->getIdTalle() == $id_talle) {
		    			echo $talle->getDescripcion();;
		    			}
		    			endforeach
						?>
					
					</td>
					<td><?php echo $producto->precio_venta ?></td>
					<td><?php echo $descuentoPromocion ?></td>
					<td><?php echo $producto->cantidad ?></td>
					<td><?php echo $producto->total ?></td>
					<td><a class="btn btn-danger" href="<?php echo "quitarDelCarrito.php?indice=" . $indice?>"><i class="fa fa-trash">Eliminar</i></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>

		<h3 style="color:#FFFFFF;">Total: <?php echo $granTotal; ?></h3>
		<form action="./terminarVenta.php" method="POST">
			<br><br>
			<input name="total" type="hidden" value="<?php echo $granTotal;?>">
			<input name="estado" type="hidden" value="1">
			<div class="formulario__grupo" id="grupo__cliente">
				<label for="cliente" class="formulario__label" style="color:#FFFFFF;" >Cliente</label>
				<div class="formulario__grupo-input">
					<select name="cliente" id="cliente" class="form-control">
		   				<option value="NULL">---Seleccionar---</option>

		   				<?php foreach ($listadoClientes as $cliente): ?>

		    			 
		    			<option value="<?php echo $cliente->getIdCliente(); ?>">
		    				<?php echo $cliente->getNombre();
		    				echo " ";
		    				echo $cliente->getApellido(); ?>

		    			</option>
		    		<?php endforeach ?>

					</select>
					<BR>
				<label for="Empleado" class="formulario__label" style="color:#FFFFFF;" >Empleado</label>
				<div class="formulario__grupo-input">
					<select name="Empleado" id="Empleado" class="form-control">
		   				<option value="NULL">---Seleccionar---</option>

		   				<?php foreach ($listadoEmpleados as $empleado): ?>

		    			 
		    			<option value="<?php echo $empleado->getIdEmpleado(); ?>">
		    				<?php echo $empleado->getNombre();
		    				echo " ";
		    				echo $empleado->getApellido(); ?>

		    			</option>
		    		<?php endforeach ?>

					</select>

			<input type="hidden" name="promocion" value="1">
			<br><br>
			<button type="submit" class="btn btn-success">Terminar venta</button>
			<a href="./cancelarVenta.php" class="btn btn-danger">Cancelar venta</a>
			<br><br>
		</form>
	</div>
