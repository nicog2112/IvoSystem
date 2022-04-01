<?php

require_once "../../class/Contacto.php";
require_once "../../class/TipoContacto.php";

$listadoTipoContactos = TipoContacto::obtenerTodos();

$idPersona = $_GET["id_persona"];

$listadoContactos = Contacto::obtenerPorIdPersona($idPersona);


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../css/reset.css">
	<link href="https://fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet">
	<link rel="stylesheet" href="../../css/main2.css">
	<title>Formulario</title>
</head>
<body>
	<br>

	<?php require_once "../../menu.php"; ?>
	<div class="container">
		<div class="form__top">
			<h2>Formulario Modificar <span>Contacto</span></h2>
		</div>


	<br><br>


		<form method="POST" action="procesar_modificacion.php">

	<input type="hidden" name="txtIdPersona" value="<?php echo $idPersona; ?>">

	<label style="color:#FFFFFF">Tipo Contacto</label>
	<select name="cboTipoContacto" class="input">
		    <option value="NULL">---Seleccionar---</option>

		    <?php foreach ($listadoTipoContactos as $tipoContacto): ?>

		    	<?php

		    	$selected = "";

		    	if ($tipoContacto->getIdTipoContacto() == $contacto->getIdTipoContacto()) {
		    		$selected = "SELECTED";
		    	}

		    	?>

		    	<option <?php echo $selected; ?> value="<?php echo $tipoContacto->getIdTipoContacto(); ?>">
		    		<?php echo $tipoContacto->getDescripcion(); ?>
		    	</option>

		    <?php endforeach ?>

		</select>
		<br><br>

	<label style="color:#FFFFFF">Valor</label>
	<input type="text" name="txtValor" value="<?php echo $contacto->getValor(); ?> "class="input">
	
	<br><br>

	<input type="submit" value="Actualizar" class="btn-bootstrap2" >


</form>

</body>
</html>