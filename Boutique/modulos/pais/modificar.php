<?php

require_once "../../class/Categoria.php";


$id_categoria = $_GET["id_categoria"];

$categoria = Categoria::obtenerPorId($id_categoria);


$mensaje = "";

if (isset($_GET["error"])) {
	// code...
	switch ($_GET["error"]) {

	case 'nombreCategoria':
		$mensaje = "El nombre no debe estar vacio y debe tener minimo 3 caracteres";
		break;



}


}


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
			<h2>Formulario Modificar <span>Categorias</span></h2>
		</div>


	<br><br>

	<form method="POST" action="procesar_modificacion.php"  class="form__reg">

		<input type="hidden" name="txtIdCategoria" value="<?php echo $id_categoria; ?>">

		<?php

		echo $mensaje;

	     ?>

		Nombre de la categoria: <input type="text" name="txtNombreCategoria" value="<?php echo $categoria->getNombre(); ?>" class="input">
		<br><br>

		<input type="submit" name="Guardar" value="Actualizar"  class="btn__submit">
		
	</form>

</body>
</html>