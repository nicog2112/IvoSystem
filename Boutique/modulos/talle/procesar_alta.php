<?php

require_once "../../class/Talle.php";

$nombreTalle = trim($_POST["nombreNuevo"]);

        // Queremos que el nombre de usuario sólo tenga letras
if (!preg_match("/^[a-zA-Z0-9\_\-]{1,10}$/", $nombreTalle)) {
    header("location: listado.php?error=nombreTalle");
	exit;
        }


	
//if (trim($nombreCategoria) == ""){
//	echo "error nombre de la categoria vacio";
//	exit;
//}


$talle = new Talle();

$talle->setDescripcion($nombreTalle);



$talle->guardar();

header("location: listado.php?validacion=true");


?>