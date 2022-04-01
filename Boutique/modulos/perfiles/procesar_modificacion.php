<?php

require_once "../../class/Perfil.php";

$id_perfil = $_POST["txtIdPerfil"];
$nombrePerfil =  trim($_POST['nombre']);


        // Queremos que el nombre de usuario sólo tenga letras
if (!preg_match("/^([a-zA-ZÀ-ÿ]{3,40})*$/", $nombrePerfil)) {
    header("location: listado.php?error=nombrePerfilModificar");
	exit;
        }
elseif (strlen($nombrePerfil) < 3){
	header("location: listado.php?error=nombrePerfilModificar");
	exit;
}




$perfil = Perfil::obtenerPorId($id_perfil);

$perfil->setDescripcion($nombrePerfil);

$perfil->actualizar();

header("location: listado.php?validacion=true");


?>