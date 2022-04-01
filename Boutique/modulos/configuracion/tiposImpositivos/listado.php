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

require_once "../../class/TipoPago.php";

$lista = TipoPago::obtenerTodos();

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


</head>
<body>
	<?php

	echo $mensaje;

	?>

	<?php require_once "../../menu.php"; ?>
	<section class="home-section">
		<br>
		<br>
		<div id="containerNuevo">
			<a href="nuevo.php" class="botonAñadir" id="abrir"><i class="fas fa-plus"></i> Añadir </a>
		</div>
		<br>

		<div id="container">


			<table class="styled-table">
				<thead>
					<tr>
						<th>ID Tipo Pago</th>
						<th>Descripcion</th>
						<th>Valor</th>
						<th>Modificar</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach  ($lista as $TipoPago): ?>
						

						<tr  class="active-row">


							<td><?php echo $TipoPago->getIdTipoPago(); ?></td>
							<td><?php echo $TipoPago->getDescripcion(); ?></td>
							<td><?php echo $TipoPago->getValorPorcentaje(); ?>%</td>
							
							<td><a href="modificar.php?id_tipo_pago=<?php echo $TipoPago->getIdTipoPago(); ?>" ><i class="botonActualizar fas fa-edit"></i></a></td>
							
							<td><a  href="eliminar.php?id_tipo_pago=<?php echo $TipoPago->getIdTipoPago(); ?>" ><i class="botonEliminar fas fa-trash"></i></a></td>

						</tr>

					<?php endforeach ?>
				</tbody>

			</table>
		</div>
	</body>
	</html>
