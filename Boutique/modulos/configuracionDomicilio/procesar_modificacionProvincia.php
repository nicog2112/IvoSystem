<?php

require_once "../../class/Provincia.php";
$id_pais = $_POST["txtIdPais"];
$id_provincia = $_POST["txtIdProvincia"];
$nombreProvincia = trim($_POST["nombre"]);


        // Queremos que el nombre de usuario sólo tenga letras
if (!preg_match("/^([a-zA-ZÀ-ÿ]{3,40})+( [a-zA-ZÀ-ÿ]+)*$/", $nombreProvincia)) {
    header("location: listadoProvincia.php?id_pais=".$id_pais."&error=nombreProvinciaModificar");
	exit;
        }
elseif (strlen($nombreProvincia) < 3){
	header("location: listadoProvincia.php?id_pais=".$id_pais."&error=nombreProvinciaModificar");
	exit;
}
 




$provincia = Provincia::obtenerPorIdProvincia($id_provincia);

$provincia->setDescripcion($nombreProvincia);

$provincia->actualizar();

header("location: listadoProvincia.php?id_pais=".$id_pais."&validacion=true");


?>