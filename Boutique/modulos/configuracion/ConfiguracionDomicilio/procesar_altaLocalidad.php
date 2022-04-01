<?php

require_once "../../../class/localidad.php";

$id_provincia = $_POST["txtIdProvincia"];

$nombreLocalidad = trim($_POST["nombre"]);


        // Queremos que el nombre de usuario sólo tenga letras
if (!preg_match("/^[a-zA-Z]+/", $nombreLocalidad)) {
    header("location: nuevoProvincia.php?error=nombreLocalidad");
	exit;
        }
elseif (strlen($nombreLocalidad) < 3){
	header("location: nuevoProvincia.php?error=nombreLocalidad");
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