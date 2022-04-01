<?php

require_once "../../class/Categoria.php";

$nombreCategoria = trim($_POST["nombreNuevo"]);

        // Queremos que el nombre de usuario sólo tenga letras
if (!preg_match("/^[a-zA-Z]+/", $nombreCategoria)) {
    header("location: listado.php?error=nombreCategoria");
	exit;
        }
elseif (strlen($nombreCategoria) < 3){
	header("location: listado.php?error=nombreCategoria");
	exit;
}

	
//if (trim($nombreCategoria) == ""){
//	echo "error nombre de la categoria vacio";
//	exit;
//}


$categoria = new categoria();

$categoria->setNombre ($nombreCategoria);



$categoria->guardar();

header("location: listado.php?validacion=true");


?>