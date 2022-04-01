<?php

require_once "../../class/Perfil.php";

$id_perfil = $_POST["txtIdPerfil"];
$nombrePerfil = trim($_POST['nombre']);

if (!preg_match("/^[a-zA-Z]+/", $nombrePerfil)) {
    header("location: modificar.php?id_perfil=".$id_perfil."&error=nombrePerfil");
	exit;
        }
elseif (strlen($nombrePerfil) < 3){
	header("location: modificar.php?id_perfil=".$id_perfil."&error=nombrePerfil");
	exit;
	}

else{

	header("location: modificar.php?id_perfil=".$id_perfil."error=false");

	} 



$perfil = Perfil::obtenerPorId($id_perfil);

$perfil->setDescripcion($nombrePerfil);

$perfil->actualizar();

header("location: listado.php?validacion=true");


?>