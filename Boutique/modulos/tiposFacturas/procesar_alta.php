<?php

require_once "../../class/TipoFactura.php";

$nombreTipoFactura = trim($_POST["nombreNuevo"]);


        // Queremos que el nombre de usuario sólo tenga letras
if (!preg_match("/^([a-zA-ZÀ-ÿ]{1,10})+( [a-zA-ZÀ-ÿ]+)*$/", $nombreTipoFactura)) {
    header("location: listado.php?error=descripcionAñadir");
	exit;
        }
elseif (strlen($nombreTipoFactura) < 1){
	header("location: listado.php?error=descripcionAñadir");
	exit;
}

	
//if (trim($nombreCategoria) == ""){
//	echo "error nombre de la categoria vacio";
//	exit;
//}


$tipoFactura = new TipoFactura();

$tipoFactura->setDescripcion($nombreTipoFactura);




$tipoFactura->guardar();

header("location: listado.php?validacion=true");


?>