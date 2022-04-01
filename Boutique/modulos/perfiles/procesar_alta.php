<?php

require_once "../../class/Perfil.php";

$nombrePerfil =  trim($_POST['nombreNuevo']);


        // Queremos que el nombre de usuario sólo tenga letras
if (!preg_match("/^([a-zA-ZÀ-ÿ]{3,40})*$/", $nombrePerfil)) {
    header("location: listado.php?error=nombrePerfilAñadir");
	exit;
        }
elseif (strlen($nombrePerfil) < 3){
	header("location: listado.php?error=nombrePerfilAñadir");
	exit;
}



$perfil = new Perfil();

$perfil->setDescripcion($nombrePerfil);



$perfil->guardar();

header("location: listado.php?validacion=true");


?>