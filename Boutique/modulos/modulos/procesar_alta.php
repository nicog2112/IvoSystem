<?php

require_once "../../class/Modulo.php";

$nombreModulo =trim($_POST['nombreNuevo']);
$directorio = trim($_POST['directorioNuevo']);


        // Queremos que el nombre de usuario sólo tenga letras
if (!preg_match("/^([a-zA-ZÀ-ÿ]{3,40})*$/", $nombreModulo)) {
    header("location: listado.php?error=nombreModuloAñadir");
	exit;
        }
elseif (strlen($nombreModulo) < 3){
	header("location: listado.php?error=nombreModuloAñadir");
	exit;
}
elseif (!preg_match("/^([a-zA-ZÀ-ÿ]{3,40})*$/", $directorio)) {
    header("location: listado.php?error=directorioAñadir");
	exit;
        }
elseif (strlen($directorio) < 3){
	header("location: listado.php?error=directorioAñadir");
	exit;
	}



$modulo = new Modulo();

$modulo->setDescripcion ($nombreModulo);
$modulo->setDirectorio ($directorio);



$modulo->guardar();

header("location: listado.php");

?>