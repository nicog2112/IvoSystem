<?php

require_once "../../../class/TipoContacto.php";


$id_tipo_contacto = $_GET["id_tipo_contacto"];

$tipoContacto = TipoContacto::obtenerPorId($id_tipo_contacto);


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../../css/reset.css">
	<link href="https://fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet">
	<link rel="stylesheet" href="../../../css/main2.css">
	<title>Formulario</title>
</head>
<body>
	<br>

	<?php require_once "../../../menu.php"; ?>
	<div class="container">
		<div class="form__top">
			<h2>Formulario Modificar <span>Tipo de Contacto</span></h2>
		</div>


	<br><br>

	<form method="POST" action="procesar_modificacion.php"  class="form__reg">

		<input type="hidden" name="txtIdTipoContacto" value="<?php echo $id_tipo_contacto; ?>">

		Descripcion del Tipo de Contacto: <input type="text" name="txtDescripcion" value="<?php echo $tipoContacto->getDescripcion(); ?>" class="input">
		<br><br>

		<input type="submit" name="Guardar" value="Actualizar"  class="btn__submit">
		
	</form>

</body>
</html>