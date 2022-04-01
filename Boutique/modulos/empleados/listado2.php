<?php

require_once "../../class/Empleado.php";

$lista = Empleado::obtenerTodos();

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
						<th>ID Empleado</th>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Fecha Nacimiento</th>
						<th>Cargo</th>	
						<th>Fecha de Alta</th>
						<th>Usuario</th>
						<th>Contactos</th>	
						<th>Domicilios</th>
						<th>Modificar</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach  ($lista as $empleado): ?>

						<tr  class="active-row">
							
							<td><?php echo $empleado->getIdEmpleado(); ?></td>
							
							<td><?php echo $empleado->getNombre(); ?></td>
							<td><?php echo $empleado->getApellido(); ?></td>
							<td><?php echo $empleado->getFechaNacimiento(); ?></td>
							<td><?php echo $empleado->getCargo(); ?></td>
							<td><?php echo $empleado->getFechaAlta(); ?></td>
							
							<td><a href="../usuarios/listadoPorId.php?id_persona=<?php echo $empleado->getIdPersona(); ?>"><i class="botonGeneral fas fa-user"></i></a></td>
							<td>
								<a href="../domicilios/domicilios.php?id_persona=<?php echo $empleado->getIdPersona(); ?>&modulo=empleados "  > <i class="botonGeneral fas fa-house-user"></i> </a>
							</td>
							<td>
								<a  href="../contactos/contactos.php?id_persona=<?php echo $empleado->getIdPersona(); ?>"><i class="botonGeneral fas fa-phone-alt"></i></a>
							</td>
							<td><a href="modificar.php?id_empleado=<?php echo $empleado->getIdEmpleado(); ?>" ><i class="botonActualizar fas fa-edit"></i></a></td>
							
							<td><a href="eliminar.php?id_empleado=<?php echo $empleado->getIdEmpleado(); ?>" ><i class="botonEliminar fas fa-trash"></i></a></td>

						</tr>

					<?php endforeach ?>
				</tbody>

			</table>

		</div>
	</section>
</body>
</html>
