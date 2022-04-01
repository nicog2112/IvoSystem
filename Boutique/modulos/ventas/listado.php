<?php include_once "../../menu.php" ?>
<?php
include_once "base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT pedidoclente.total,pedidoclente.id_empleado,pedidoclente.id_cliente, pedidoclente.id_estado_pedido, pedidoclente.fecha_hora, pedidoclente.id_pedido_cliente, GROUP_CONCAT(	producto.id_producto, '..',  producto.nombre, '..',  producto.precio_venta, '..', detallepedido.cantidad SEPARATOR '__') AS producto FROM pedidoclente INNER JOIN detallepedido ON detallepedido.id_pedido_cliente = pedidoclente.id_pedido_cliente INNER JOIN productotalle ON productotalle.id_producto_talle = detallepedido.id_producto_talle
	JOIN producto ON producto.id_producto = productotalle.id_producto GROUP BY pedidoclente.id_pedido_cliente ORDER BY pedidoclente.id_pedido_cliente;");

$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);
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
		<link rel="stylesheet" href="./css/fontawesome-all.min.css">
	<link rel="stylesheet" href="./css/2.css">
	<href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript">
		<script>
  $(document).ready(function(){
  $('#tabla-datos').DataTable( {
    "columnDefs": [
      {
        "visible": false,
        "searchable": true
      }
    ],
    "language": {
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    }
  });
});
</script>
	</script>

	
</head>
<body>

		<h1>Ventas</h1>
		<div>
			<a class="btn btn-success" href="./vender.php">Nueva Venta<i class="fa fa-plus"></i></a>
		</div>
		<br>
		<table class="table table-bordered" id="tabla-datos">
			<thead>
				<tr>
					<th>Número</th>
					<th>Fecha</th>
					<th>Empleado</th>
					<th>Cliente</th>
					<th>Estado</th>
					<th>Productos vendidos</th>
					<th>Total</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($ventas as $venta){ ?>
				<tr>
					<td><?php echo $venta->id_pedido_cliente ?></td>
					<td><?php echo $venta->fecha_hora ?></td>
					<td><?php echo $venta->id_empleado ?></td>
					<td><?php echo $venta->id_cliente ?></td>
					<td><?php echo $venta->id_estado_pedido ?></td>
					<td>
						<table>
							<thead>
								<tr>
									<th>Código</th>
									<th>Descripción</th>
									<th>Precio</th>
									<th>Cantidad</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach(explode("__", $venta->producto) as $productosConcatenados){ 
								$producto = explode("..", $productosConcatenados)
								?>
								<tr>
									<td><?php echo $producto[0] ?></td>
									<td><?php echo $producto[1] ?></td>
									<td><?php echo $producto[2] ?></td>
									<td><?php echo $producto[3] ?></td>

								</tr>
								<?php } ?>
							</tbody>
						</table>
					</td>
					<td><?php echo $venta->total ?></td>
					<td><a class="btn btn-danger" href="<?php echo "eliminarVenta.php?id=" . $venta->id_pedido_cliente?>"><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
<?php include_once "pie.php" ?>