<?php

require_once "../../../class/Barrio.php";
$id_localidad = $_POST["txtIdLocalidad"];
$id_barrio = $_POST["txtIdBarrio"];
$nombreBarrio = trim($_POST["nombre"]);

if (!preg_match("/^[a-zA-Z]+/", $nombreBarrio)) {
    header("location: modificarProvincia.php?id_localidad=".$id_localidad."&id_barrio=".$id_barrio."&error=nombreBarrio");
	exit;
        }
elseif (strlen($nombreBarrio) < 3){
	header("location: modificarProvincia.php?id_localidad=".$id_localidad."&id_barrio=".$id_barrio."&error=nombreBarrio");
	exit;
	}





$barrio = Barrio::obtenerPorIdBarrio($id_barrio);

$barrio->setDescripcion($nombreBarrio);

$barrio->actualizar();

header("location: listadoBarrio.php?id_localidad=".$id_localidad."&id_barrio=".$id_barrio."&validacion=true");


?>