<?php

require_once "../../class/Categoria.php";

$id_categoria = $_POST["txtIdCategoria"];


$nombreCategoria = trim($_POST["nombre"]);

if (!preg_match("/^[a-zA-Z]+/", $nombreCategoria)) {
    header("location: modificar.php?id_categoria=".$id_categoria."&error=nombreCategoria");
	exit;
        }
elseif (strlen($nombreCategoria) < 3){
	header("location: modificar.php?id_categoria=".$id_categoria."&error=nombreCategoria");
	exit;
	}

else{

	header("location: modificar.php?id_categoria=".$id_categoria."error=false");

	} 



$categoria = Categoria::obtenerPorId($id_categoria);

$categoria->setNombre($nombreCategoria);

$categoria->actualizar();

header("location: listado.php?validacion=true");


?>