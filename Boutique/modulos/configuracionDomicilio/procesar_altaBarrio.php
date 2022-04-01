<?php

require_once "../../class/Barrio.php";

$id_localidad = $_POST["txtIdLocalidad"];

$nombreBarrio= trim($_POST["nombreNuevo"]);


        // Queremos que el nombre de usuario sólo tenga letras
if (!preg_match("/^([a-zA-ZÀ-ÿ]{3,40})+( [a-zA-ZÀ-ÿ]+)*$/", $nombreBarrio)) {
    header("location: listadoBarrio.php?id_localidad=".$id_localidad."&error=nombreBarrioAñadir");
	exit;
        }
elseif (strlen($nombreBarrio) < 3){
	header("location: listadoBarrio.php?id_localidad=".$id_localidad."&error=nombreBarrioAñadir");
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