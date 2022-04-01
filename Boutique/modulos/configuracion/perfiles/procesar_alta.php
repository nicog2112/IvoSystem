<?php

require_once "../../class/Perfil.php";

$nombrePerfil =  trim($_POST['nombre']);


        // Queremos que el nombre de usuario sólo tenga letras
if (!preg_match("/^[a-zA-Z]+/", $nombrePerfil)) {
    header("location: nuevo.php?error=nombrePerfil");
	exit;
        }
elseif (strlen($nombrePerfil) < 3){
	header("location: nuevo.php?error=nombrePerfil");
	exit;
}
else{

	header("location: nuevo.php?error=false");

	} 


$perfil = new Perfil();

$perfil->setDescripcion($nombrePerfil);



$perfil->guardar();

header("location: listado.php?validacion=true");


?>