<?php

require_once "../../../class/Barrio.php";

$id_localidad = $_POST["txtIdLocalidad"];

$nombreBarrio= trim($_POST["nombre"]);


        // Queremos que el nombre de usuario sólo tenga letras
if (!preg_match("/^[a-zA-Z]+/", $nombreBarrio)) {
    header("location: nuevoBarrio.php?error=nombreBarrio");
	exit;
        }
elseif (strlen($nombreBarrio) < 3){
	header("location: nuevoBarrio.php?error=nombreBarrio");
	exit;
}
 
	
//if (trim($nombreCategoria) == ""){
//	echo "error nombre de la categoria vacio";
//	exit;
//}


$barrio = new Barrio();

$barrio->setDescripcion ($nombreBarrio);
$barrio->setIdLocalidad($id_localidad);




$barrio->guardar();

header("location: listadoBarrio.php?id_localidad=".$id_localidad."&validacion=true");

?>