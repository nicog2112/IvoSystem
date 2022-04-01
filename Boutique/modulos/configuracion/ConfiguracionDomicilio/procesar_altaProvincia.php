<?php

require_once "../../../class/Provincia.php";

$id_pais = $_POST["txtIdPais"];

$nombreProvincia = trim($_POST["nombre"]);


        // Queremos que el nombre de usuario sólo tenga letras
if (!preg_match("/^[a-zA-Z]+/", $nombreProvincia)) {
    header("location: nuevoProvincia.php?error=nombreProvincia");
	exit;
        }
elseif (strlen($nombreProvincia) < 3){
	header("location: nuevoProvincia.php?error=nombreProvincia");
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