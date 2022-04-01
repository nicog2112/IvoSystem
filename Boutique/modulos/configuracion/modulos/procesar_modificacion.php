<?php

require_once "../../../class/Modulo.php";

$id_modulo = $_POST["txtIdModulo"];
$nombreModulo = trim($_POST['nombre']);
$directorio = trim($_POST['directorio']);

if (!preg_match("/^[a-zA-Z]+/", $nombreModulo)) {
    header("location: modificar.php?id_modulo=".$id_modulo."&error=nombreModulo");
	exit;
        }
elseif (strlen($nombreModulo) < 3){
	header("location: modificar.php?id_modulo=".$id_modulo."&error=nombreModulo");
	exit;
	}

elseif (!preg_match("/^[a-zA-Z]+/", $directorio)) {
    header("location: modificar.php?id_modulo=".$id_modulo."&error=directorio");
	exit;
        }
elseif (strlen($directorio) < 3){
	header("location: modificar.php?id_modulo=".$id_modulo."&error=directorio");
	exit;
	}


else{

	header("location: modificar.php?id_modulo=".$id_modulo."error=false");

	} 

$modulo = Modulo::obtenerPorId($id_modulo);

$modulo->setDescripcion($nombreModulo);
$modulo->setDirectorio($directorio);

$modulo->actualizar();

header("location: listado.php?validacion=true");


?>