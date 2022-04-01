<?php

require_once "../../../class/Modulo.php";

$nombreModulo =trim($_POST['nombre']);
$directorio = trim($_POST['directorio']);


        // Queremos que el nombre de usuario sólo tenga letras
if (!preg_match("/^[a-zA-Z]+/", $nombreModulo)) {
    header("location: nuevo.php?error=nombreModulo");
	exit;
        }
elseif (strlen($nombreModulo) < 3){
	header("location: nuevo.php?error=nombreModulo");
	exit;
}
elseif (!preg_match("/^[a-zA-Z]+/", $directorio)) {
    header("location: nuevo.php?error=directorio");
	exit;
        }
elseif (strlen($directorio) < 3){
	header("location: nuevo.php?error=directorio");
	exit;
}
else{

	header("location: nuevo.php?error=false");

	} 


$modulo = new Modulo();

$modulo->setDescripcion ($nombreModulo);
$modulo->setDirectorio ($directorio);



$modulo->guardar();

header("location: listado.php?validacion=true");

?>