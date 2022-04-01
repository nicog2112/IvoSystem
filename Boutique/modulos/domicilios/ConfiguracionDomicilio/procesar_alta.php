<?php

require_once "../../../class/Pais.php";

$nombrePais = trim($_POST["nombre"]);

        // Queremos que el nombre de usuario sólo tenga letras
if (!preg_match("/^[a-zA-Z]+/", $nombrePais)) {
    header("location: nuevo.php?error=nombrePais");
	exit;
        }
elseif (strlen($nombrePais) < 3){
	header("location: nuevo.php?error=nombrePais");
	exit;
}
else{

	header("location: nuevo.php?error=false");

	} 
	
//if (trim($nombreCategoria) == ""){
//	echo "error nombre de la categoria vacio";
//	exit;
//}


$pais = new Pais();

$pais->setDescripcion ($nombrePais);



$pais->guardar();

header("location: listado.php?validacion=true");


?>