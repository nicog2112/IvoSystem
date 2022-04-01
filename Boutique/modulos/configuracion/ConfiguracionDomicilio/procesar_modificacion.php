<?php

require_once "../../../class/Pais.php";

$id_pais = $_POST["txtIdPais"];


$nombrePais = trim($_POST["nombre"]);

if (!preg_match("/^[a-zA-Z]+/", $nombrePais)) {
    header("location: modificar.php?id_pais=".$id_pais."&error=nombrePais");
	exit;
        }
elseif (strlen($nombrePais) < 3){
	header("location: modificar.php?id_pais=".$id_pais."&error=nombrePais");
	exit;
	}

else{

	header("location: modificar.php?id_pais=".$id_pais."error=false");

	} 



$pais = Pais::obtenerPorIdPais($id_pais);

$pais->setDescripcion($nombrePais);

$pais->actualizar();

header("location: listado.php?validacion=true");


?>