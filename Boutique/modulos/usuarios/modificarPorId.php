<?php

require_once "../../class/Usuario.php";
require_once "../../class/Sexo.php";
require_once "../../class/Perfil.php";

$listadoPerfil = Perfil::obtenerTodos();
$listadoSexo = Sexo::obtenerTodos();

$id_usuario = $_GET["id_usuario"];

$user = Usuario::obtenerPorId($id_usuario);


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
			<h2>Formulario Modificar <span>Usuarios</span></h2>
		</div>


	<br><br>

	<form method="POST" action="procesar_modificacion.php" class="form__reg">

		<input type="hidden" name="txtIdUsuario" value="<?php echo $id_usuario; ?>">

		Nombre: <input type="text" name="txtNombre" value="<?php echo $user->getNombre(); ?>" class="input">
		<br><br>

		Apellido: <input type="text" name="txtApellido" value="<?php echo $user->getApellido(); ?>" class="input">
		<br><br>

		DNI: <input type="text" name="txtDni" value="<?php echo $user->getDni(); ?>" class="input">
		<br><br>

		Fecha Nacimiento: <input type="date" name="txtFechaNacimiento" value="<?php echo $user->getFechaNacimiento(); ?>" class="input">
		<br><br>

		Sexo:
		<select name="cboSexo" class="input">
		    <option value="NULL">---Seleccionar---</option>

		    <?php foreach ($listadoSexo as $sexo): ?>

		    	<?php

		    	$selected = "";

		    	if ($sexo->getIdSexo() == $user->getIdSexo()) {
		    		$selected = "SELECTED";
		    	}

		    	?>

		    	<option <?php echo $selected; ?> value="<?php echo $sexo->getIdSexo(); ?>">
		    		<?php echo $sexo->getDescripcion(); ?>
		    	</option>

		    <?php endforeach ?>

		</select>
		<br><br>

		Nacionalidad: <input type="text" name="txtNacionalidad" value="<?php echo $user->getNacionalidad(); ?>" class="input">
		<br><br>

		Estado: <input type="text" name="txtEstado" value="<?php echo $user->getEstado(); ?>" class="input">
		<br><br>


		Perfil:
		<select name="cboPerfil" class="input">
		    <option value="NULL">---Seleccionar---</option>

		    <?php foreach ($listadoPerfil as $perfil): ?>

		    	<?php

		    	$selected = "";

		    	if ($perfil->getIdPerfil() == $user->getIdPerfil()) {
		    		$selected = "SELECTED";
		    	}

		    	?>

		    	<option <?php echo $selected; ?> value="<?php echo $perfil->getIdPerfil(); ?>">
		    		<?php echo $perfil->getDescripcion(); ?>
		    	</option>

		    <?php endforeach ?>

		</select>
		<br><br>


		Username: <input type="text" name="txtUsername" value="<?php echo $user->getUsername(); ?>" class="input">
		<br><br>

		Password: <input type="text" name="txtPassword" value="<?php echo $user->getPassword(); ?>" class="input">
		<br><br>

		<input type="submit" name="Guardar" value="Actualizar" class="btn__submit">
		
	</form>

</body>
</html>