<?php

require_once "../../class/Categoria.php";

$id_categoria = $_POST["txtIdCategoria"];


$nombreCategoria = trim($_POST['txtNombreCategoria']);


if (strlen($nombreCategoria) < 3){
	header("location: modificar.php?id_categoria=<?php echo $Categoria->getIdCategoria();?>&error=nombreCategoria");
	exit;
	}



$categoria = Categoria::obtenerPorId($id_categoria);

$categoria->setNombre($nombreCategoria);

$categoria->actualizar();

header("location: listado.php");


?>