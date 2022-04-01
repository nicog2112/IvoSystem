<?php

require_once "../../../class/Provincia.php";
$id_pais = $_POST["txtIdPais"];
$id_provincia = $_POST["txtIdProvincia"];
$nombreProvincia = trim($_POST["nombre"]);

if (!preg_match("/^[a-zA-Z]+/", $nombreProvincia)) {
    header("location: modificarProvincia.php?id_pais=".$id_pais."&id_provincia=".$id_provincia."&error=nombreProvincia");
	exit;
        }
elseif (strlen($nombreProvincia) < 3){
	header("location: modificarProvincia.php?id_pais=".$id_pais."&id_provincia=".$id_provincia."&error=nombreProvincia");
	exit;
	}





$provincia = Provincia::obtenerPorIdProvincia($id_provincia);

$provincia->setDescripcion($nombreProvincia);

$provincia->actualizar();

header("location: listadoProvincia.php?id_pais=".$id_pais."&id_provincia=".$id_provincia."&validacion=true");


?>