<?php

require_once "../../class/Barrio.php";
$id_localidad = $_POST["txtIdLocalidad"];
$id_barrio = $_POST["txtIdBarrio"];
$nombreBarrio = trim($_POST["nombre"]);

if (!preg_match("/^([a-zA-ZÀ-ÿ]{3,40})+( [a-zA-ZÀ-ÿ]+)*$/", $nombreBarrio)) {
    header("location: listadoBarrio.php?id_localidad=".$id_localidad."&error=nombreBarrioModificar");
	exit;
        }
elseif (strlen($nombreBarrio) < 3){
	header("location: listadoBarrio.php?id_localidad=".$id_localidad."&error=nombreBarrioModificar");
	exit;
}




$barrio = Barrio::obtenerPorIdBarrio($id_barrio);

$barrio->setDescripcion($nombreBarrio);

$barrio->actualizar();

header("location: listadoBarrio.php?id_localidad=".$id_localidad."&validacion=true");


?>