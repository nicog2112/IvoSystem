<?php

require_once "../../class/Localidad.php";
$id_provincia = $_POST["txtIdProvincia"];
$id_localidad = $_POST["txtIdLocalidad"];
$nombreLocalidad = trim($_POST["nombre"]);

if (!preg_match("/^([a-zA-ZÀ-ÿ]{3,40})+( [a-zA-ZÀ-ÿ]+)*$/", $nombreLocalidad)) {
    header("location: listadoLocalidad.php?id_provincia=".$id_provincia."&error=nombreLocalidadModificar");
	exit;
        }
elseif (strlen($nombreLocalidad) < 3){
	header("location: listadoLocalidad.php?id_provincia=".$id_provincia."&error=nombreLocalidadModificar");
	exit;
}




$localidad = Localidad::obtenerPorIdLocalidad($id_localidad);

$localidad->setDescripcion($nombreLocalidad);

$localidad->actualizar();

header("location: listadoLocalidad.php?id_provincia=".$id_provincia."&validacion=true");


?>