<?php

require_once "../../class/Temporada.php";


$nombreTemporada = trim($_POST["nombreNuevo"]);
$anio = trim($_POST["valorPorcentajeNuevo"]);

        // Queremos que el nombre de usuario sólo tenga letras
if (!preg_match("/^[a-zA-Z]+/", $nombreTemporada)) {
    header("location: listado.php?error=nombreTemporada");
	exit;
        }
elseif (strlen($nombreTemporada) < 3){
	header("location: listado.php?error=nombreTemporada");
	exit;
}
elseif (strlen($anio) < 4  ){
	header("location: listado.php?error=anio");
	exit;
}
elseif (strlen($anio) > 4  ){
	header("location: listado.php?error=anio");
	exit;
}


$temporada = new Temporada();

$temporada->setNombre($nombreTemporada);
$temporada->setAño($anio);


$temporada->guardar();


header("location: listado.php?validacion=true");


?>