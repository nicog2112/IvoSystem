<?php

require_once "../../../class/Localidad.php";
$id_provincia = $_POST["txtIdProvincia"];
$id_localidad = $_POST["txtIdLocalidad"];
$nombreLocalidad = trim($_POST["nombre"]);

if (!preg_match("/^[a-zA-Z]+/", $nombreLocalidad)) {
    header("location: modificarLocalidad.php?id_provincia=".$id_provincia."&id_localidad=".$id_localidad."&error=nombreLocalidad");
	exit;
        }
elseif (strlen($nombreLocalidad) < 3){
	header("location: modificarLocalidad.php?id_provincia=".$id_provincia."&id_localidad=".$id_localidad."&error=nombreLocalidad");
	exit;
	}





$localidad = Localidad::obtenerPorIdLocalidad($id_localidad);

$localidad->setDescripcion($nombreLocalidad);

$localidad->actualizar();

header("location: listadoLocalidad.php?id_provincia=".$id_provincia."&id_localidad=".$id_localidad."&validacion=true");


?>