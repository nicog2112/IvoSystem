<?php

require_once "../../class/localidad.php";

$id_provincia = $_POST["txtIdProvincia"];

$nombreLocalidad = trim($_POST["nombreNuevo"]);


        // Queremos que el nombre de usuario sólo tenga letras
if (!preg_match("/^([a-zA-ZÀ-ÿ]{3,40})+( [a-zA-ZÀ-ÿ]+)*$/", $nombreLocalidad)) {
    header("location: listadoLocalidad.php?id_provincia=".$id_provincia."&error=nombreLocalidadAñadir");
	exit;
        }
elseif (strlen($nombreLocalidad) < 3){
	header("location: listadoLocalidad.php?id_provincia=".$id_provincia."&error=nombreLocalidadAñadir");
	exit;
}
	
//if (trim($nombreCategoria) == ""){
//	echo "error nombre de la categoria vacio";
//	exit;
//}


$localidad = new Localidad();

$localidad->setDescripcion ($nombreLocalidad);
$localidad->setIdProvincia ($id_provincia);




$localidad->guardar();

header("location: listadoLocalidad.php?id_provincia=".$id_provincia."&validacion=true");

?>