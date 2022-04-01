<?php

require_once "../../class/Provincia.php";

$id_pais = $_POST["txtIdPais"];

$nombreProvincia = trim($_POST["nombreNuevo"]);


        // Queremos que el nombre de usuario sólo tenga letras
if (!preg_match("/^([a-zA-ZÀ-ÿ]{3,40})+( [a-zA-ZÀ-ÿ]+)*$/", $nombreProvincia)) {
    header("location: listadoProvincia.php?id_pais=".$id_pais."&error=nombreProvinciaAñadir");
	exit;
        }
elseif (strlen($nombreProvincia) < 3){
	header("location: listadoProvincia.php?id_pais=".$id_pais."&error=nombreProvinciaAñadir");
	exit;
}
 
	
//if (trim($nombreCategoria) == ""){
//	echo "error nombre de la categoria vacio";
//	exit;
//}


$provincia = new Provincia();

$provincia->setDescripcion ($nombreProvincia);
$provincia->setIdPais ($id_pais);




$provincia->guardar();

header("location: listadoProvincia.php?id_pais=".$id_pais."&validacion=true");

?>