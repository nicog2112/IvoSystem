
<?php /*
include_once "base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT pedidoclente.total,pedidoclente.id_empleado,pedidoclente.id_cliente, pedidoclente.id_estado_pedido, pedidoclente.fecha_hora, pedidoclente.id_pedido_cliente, GROUP_CONCAT(	producto.id_producto, '..',  producto.nombre, '..',  producto.precio_venta, '..', detallepedido.cantidad SEPARATOR '__') AS producto FROM pedidoclente INNER JOIN detallepedido ON detallepedido.id_pedido_cliente = pedidoclente.id_pedido_cliente INNER JOIN productotalle ON productotalle.id_producto_talle = detallepedido.id_producto_talle
	JOIN producto ON producto.id_producto = productotalle.id_producto GROUP BY pedidoclente.id_pedido_cliente ORDER BY pedidoclente.id_pedido_cliente;");

$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);*/

?>
<?php

require_once "../../class/Compra.php";
require_once "../../class/DetalleVenta.php";

$lista = Compra::obtenerTodos();


?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Listado de Compras</title>
	
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
	 <!-- Bootstrap CSS -->
    
	<script src="../../jquery/jquery-3.3.1.min.js"></script>
	<script src="../../js/pagination-tda-plugin.js"></script>

	<script>
    $(document).ready(function(){
        $("#tableUserList").paginationTdA({
            elemPerPage: 10
        });
    });
</script>

	
</head>
<body>
<?php require_once "../../menu.php"; ?>
 <section class="home-section">
<br>
<br>
<div id="containerNuevo">
			
				<a href="./vender.php" class="botonAñadir" id="abrir"><i class="fas fa-plus"></i> Añadir </a>
			</div>
			<br>

			<div id="container">

				<table id="tableUserList" class="styled-table">
					<thead>
						<tr>
							<th rowspan="2">ID</th>
							<th rowspan="2">Fecha</th>
							<th rowspan="2">Empleado</th>
							<th rowspan="2">Proveedor</th>
							<th rowspan="2">Estado</th>
							<th colspan="4">Productos Comprados</th>
							<th rowspan="2">Total</th>
					
							<th rowspan="2">Eliminar</th>
							
						</tr>
						<tr>
							<th>Código</th>
							<th>Descripción</th>
							<th>Precio</th>
							<th>Cantidad</th>
							
						</tr>
					</thead>
					<tbody>
						<?php foreach($lista as $compra){ ?>
							<tr class="active-row">
								<td><?php echo $compra->getIdCompra(); ?></td>
								<td><?php echo $compra->getFechaHora() ?></td>
								<td><?php echo $compra->empleado->getNombre();
								echo " ";
								echo $compra->empleado->getApellido();?></td>
								<td><?php 
								echo $compra->proveedor->getNombreProveedor();?></td>
								<td><?php echo $compra->estado->getDescripcion(); ?></td>
								<td colspan="4">
									<!-- Aquí puedes escribir tu comentario 
									<table style="border-collapse: collapse;">
										
										<thead>
											<?php
											$id_venta= $venta->getIdVenta();
											$listaDetalles = DetalleVenta::obtenerPorIdVenta($id_venta);
											foreach($listaDetalles as $detalleVenta){ ?>
												<tr>
													
													<td><?php echo $detalleVenta->getIdDetalleVenta();  ?></td>
													<td><?php echo $detalleVenta->productoTalle->producto->getDescripcion(); ?></td>
													<td><?php echo $detalleVenta->getPrecio(); ?></td>
													<td><?php echo $detalleVenta->getCantidad();  ?></td>

												</tr>
											<?php } ?>
										</thead>
									</table>-->
								</td>
								
								<td><?php echo $compra->getTotal() ?></td>
						
								<td><a href="eliminarVenta.php?id_pedido_cliente= <?php echo $venta->getIdVenta(); ?>"><i class="botonEliminar fas fa-trash"></i></a></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>


