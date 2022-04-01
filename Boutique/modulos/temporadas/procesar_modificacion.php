<?php

require_once "../../class/temporada.php";

$id_temporada = $_POST["txtIdTemporada"];
$nombreTemporada = trim($_POST["nombre"]);
$anio = trim($_POST["valorPorcentaje"]);

        // Queremos que el nombre de usuario sólo tenga letras
if (!preg_match("/^[a-zA-Z]+/", $nombreTemporada)) {
    header("location: listado.php?id_temporada=".$id_temporada."&error=nombreTemporada");
	exit;
        }
elseif (strlen($nombreTemporada) < 3){
	header("location: listado.php?id_temporada=".$id_temporada."&error=nombreTemporada");
	exit;
}
elseif (strlen($anio) < 4  ){
	header("location: listado.php?id_temporada=".$id_temporada."&error=anio");
	exit;
}
elseif (strlen($anio) > 4  ){
	header("location: listado.php?id_temporada=".$id_temporada."&error=anio");
	exit;
}
else{

	header("location: nuevo.php?id_temporada=".$id_temporada."&error=false");

	} 


$temporada = Temporada::obtenerPorId($id_temporada);

$temporada->setNombre($nombreTemporada);
$temporada->setAño($anio);

$temporada->actualizar();

header("location: listado.php?validacion=true");


?>