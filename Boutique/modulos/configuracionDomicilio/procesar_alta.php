<?php

require_once "../../class/Pais.php";

$nombrePais = trim($_POST["nombreNuevo"]);



        // Queremos que el nombre de usuario sólo tenga letras
if (!preg_match("/^([a-zA-ZÀ-ÿ]{3,40})+( [a-zA-ZÀ-ÿ]+)*$/", $nombrePais)) {
    header("location: listado.php?error=nombrePaisAñadir");
	exit;
        }
elseif (strlen($nombrePais) < 3){
	header("location: listado.php?error=nombrePaisAñadir");
	exit;
}




	
//if (trim($nombreCategoria) == ""){
//	echo "error nombre de la categoria vacio";
//	exit;
//}


$pais = new Pais();

$pais->setDescripcion ($nombrePais);



$pais->guardar();

header("location: listado.php?validacion=true");


?>