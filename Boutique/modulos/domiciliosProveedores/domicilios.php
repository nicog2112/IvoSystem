<?php


require_once "../../class/DomicilioProveedor.php";
require_once "../../class/Domicilio.php";
require_once "../../class/Proveedor.php";
require_once "../../class/Barrio.php";
require_once "../../class/Localidad.php";
require_once "../../class/Provincia.php";
require_once "../../class/Pais.php";

$listadoProvincia = Provincia::obtenerTodos();
$listadoLocalidad = Localidad::obtenerTodos();
$listadoBarrio = Barrio::obtenerTodos();
$listadoPais = Pais::obtenerTodos();

$idProveedor= $_GET['id_proveedor'];


$modulo = $_GET['modulo'];


switch ($modulo) {

	case 'proveedor':
		$persona = Proveedor::obtenerPorId($idProveedor);
		break;

	case 'empleados':
		$persona = Empleado::obtenerPorIdPersona($idProveedor);
		break;

	case 'clientes':
		 $persona = Cliente::obtenerPorIdPersona($idProveedor); 
	    echo "viene de clientes";
	    exit;
		break;
	
	default:
		echo "Modulo no valido";
		exit;

}


$listadoDomicilios = DomicilioProveedor::obtenerPorIdProveedor($idProveedor);


//highlight_string(var_export($listadoDomicilios, true));


?>

<!DOCTYPE html>
<html>
<head>
	<title>Domicilios</title>
	<meta charset="UTF-8">
	<title></title>
	<script
	src="https://code.jquery.com/jquery-3.3.1.min.js"
	integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
	crossorigin="anonymous"></script>
	<script src="jquery.js"></script>
	<link rel="stylesheet" href="../../css/tabla.css">

	<link rel="stylesheet" href="../../css/botonAñadir.css">
	<link rel="stylesheet" href="../../css/botonModificar.css">
	<link rel="stylesheet" href="../../css/botonEliminar.css">
</head>
<body>

<?php require_once "../../menu.php"; ?>


<br>
<br>
	<form method="POST" action="procesar_alta.php" class="form__reg">
		<input type="hidden" name="txtIdProveedor" value="<?php echo $idProveedor; ?>">


		<div class="form__top">
			<h2 style="color:#FFFFFF">Formulario Añadir <span>Domicilio</span></h2>
		</div>	
		<div class="row col-xs-12">
			<div class="form-group">
			<label style="color:#FFFFFF">Pais</label>
			<select id="lista1" name="lista1">
				<option value='0'>-- SELECCIONE --</option>

					<?php foreach ($listadoPais as $pais): ?>

				<option value="<?php echo $pais->getIdPais(); ?>">
					<?php echo $pais->getDescripcion(); ?>
				</option>
			
					<?php endforeach ?>
			</select>
			</div>
			<br>
			<div class="form-group">
    		<label for="name1" style="color:#FFFFFF">Provincia</label>
    		<select id="select2lista" class="form-control" name="select2lista" required>
      			<option value="">-- SELECCIONE --</option>
   			</select>
  			</div>
  			<br>
			<div class="form-group">
    		<label for="name1" style="color:#FFFFFF">Localidad</label>
    		<select id="select3lista" class="form-control" name="select3lista" required>
      			<option value="">-- SELECCIONE --</option>
   			</select>
  			</div>
			<br>
			<div class="form-group">
    		<label for="name1" style="color:#FFFFFF">Barrio</label>
    		<select id="select4lista" class="form-control" name="select4lista" required>
      			<option value="">-- SELECCIONE --</option>
   			</select>
  			</div>
  			<br>
  			<div>
			<input type="text" name="txtCalle" required  placeholder="Calle" class="col-xs-6">
			<input type="text" name="txtAltura" required  placeholder="Altura" class="col-xs-6">
		</div>
		<br>
		<div>
			<input type="text" name="txtManzana" required  placeholder="Manzana" class="col-xs-6">
			<input type="text" name="txtCasa" required  placeholder="Casa" class="col-xs-6">
			<input type="text" name="txtTorre" required  placeholder="Torre" class="col-xs-6">
			<input type="text" name="txtPiso" required  placeholder="Piso" class="col-xs-6">
			<input type="text" name="txtObservaciones" required  placeholder="Observaciones" class="col-xs-6">
	
		</div>
		<br><br>
		<input type="submit" name="Guardar" class="btn__submit" >
		<input type="hidden" name="Cancelar" class="btn__submit" >
		
		
	</form>

<br>
<br>

<table border="1">
	<tr>
		<th>Calle</th>
		<th>Altura</th>
		<th>Manzana</th>
		<th>Número Casa</th>
		<th>Torre</th>
		<th>Piso</th>
		<!-- <th>Barrio</th>
		<th>Localidad</th>
		<th>Provincia</th>
		<th>Pais</th> -->

		<th>Modificar</th>
		<th>Eliminar</th>
	</tr>

	<?php foreach  ($listadoDomicilios as $domicilio): ?>

		<tr>
			<td><?php echo $domicilio->getCalle(); ?></td>
			<td><?php echo $domicilio->getAltura(); ?></td>
			<td><?php echo $domicilio->getManzana(); ?></td>
			<td><?php echo $domicilio->getNumeroCasa(); ?></td>
			<td><?php echo $domicilio->getTorre(); ?></td>
			<td><?php echo $domicilio->getPiso(); ?></td>
			<!-- <td><?php echo $domicilio->barrio->getDescripcion(); ?></td>
			<td><?php echo $domicilio->barrio->localidad->getDescripcion(); ?></td>
			<td><?php echo $domicilio->barrio->localidad->provincia->getDescripcion(); ?></td>
			<td><?php echo $domicilio->barrio->localidad->provincia->pais->getDescripcion(); ?></td> -->
			<td>
				<a href="modificar.php?id_proveedor_domicilio=<?php echo $domicilio->getIdProveedorDomicilio(); ?>&id_proveedor=<?php echo $domicilio->getIdProveedor(); ?>  "  class="btn-bootstrap1">
					Modificar
				</a>
			</td>
			<td>
				<a href="eliminar.php?id_proveedor_domicilio=<?php echo $domicilio->getIdProveedorDomicilio(); ?>&id_proveedor=<?php echo $domicilio->getIdProveedor(); ?>  "  class="btn-bootstrap2">
					Eliminar
				</a>
			</td>
		</tr>

	<?php endforeach ?>

</table>



</body>
</html>


<script type="text/javascript">
	$(document).ready(function(){
		$("#lista1").change(function(){
			$.ajax({
			type:"POST",
			url:"datos.php",
			data:"pais=" + $('#lista1').val(),
			success:function(r){
				$('#select2lista').html(r);}

			});
		});

		$("#select2lista").change(function(){
			$.ajax({
			type:"POST",
			url:"datos2.php",
			data:"provincia=" + $('#select2lista').val(),
			success:function(r){
				$('#select3lista').html(r);
			}
			});
		});

		$("#select3lista").change(function(){
			$.ajax({
			type:"POST",
			url:"datos3.php",
			data:"localidad=" + $('#select3lista').val(),
			success:function(r){
				$('#select4lista').html(r);
			}
			});
		});
	});
</script>