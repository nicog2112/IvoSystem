
<?php


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
			<h2>Formulario Actualizacion de <span>Precios de Venta</span></h2>
		</div>	

	<br><br>

	<form method="POST" action="procesar_alta.php" enctype="multipart/form-data" class="form__reg">

		
		Seleccione que Metodo desea usar para actualizar los precios:
		<select name="cboTemporada" class="input">
		    <option value="NULL">---Seleccionar---</option>

		    	<option value="1">Actualizar por Categorias</option>
		    	<option value="2">Actualizar por Temporada</option>
		    	<option value="3">Actualizar por Marca </option>

		 </select>
		 <br><br>

		<input type="submit" name="Guardar" class="btn__submit" >
		
		
	</form>

</body>
</html>