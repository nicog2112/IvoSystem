<?php

require_once "../../class/Modulo.php";

$id_modulo = $_POST["txtIdModulo"];

$nombreModulo =trim($_POST['nombre']);
$directorio = trim($_POST['directorio']);


        // Queremos que el nombre de usuario sólo tenga letras
if (!preg_match("/^([a-zA-ZÀ-ÿ]{3,40})*$/", $nombreModulo)) {
    header("location: listado.php?error=nombreModuloModificar");
	exit;
        }
elseif (strlen($nombreModulo) < 3){
	header("location: listado.php?error=nombreModuloModificar");
	exit;
}
elseif (!preg_match("/^([a-zA-ZÀ-ÿ]{3,40})*$/", $directorio)) {
    header("location: listado.php?error=directorioModificar");
	exit;
        }
elseif (strlen($directorio) < 3){
	header("location: listado.php?error=directorioModificar");
	exit;
	}


$modulo = Modulo::obtenerPorId($id_modulo);

$modulo->setDescripcion($nombreModulo);
$modulo->setDirectorio($directorio);

$modulo->actualizar();

header("location: listado.php?validacion=true");


?>