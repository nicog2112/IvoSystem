<?php

require_once "../../class/TipoContacto.php";

$descripcion = $_POST['nombreNuevo'];


if (!preg_match("/^([a-zA-ZÀ-ÿ]{3,40})+( [a-zA-ZÀ-ÿ]+)*$/", $descripcion)) {
    header("location: listado.php?error=descripcionAñadir");
	exit;
        }
elseif (strlen($descripcion) < 3){
	header("location: listado.php?error=descripcionAñadir");
	exit;
}


$contacto = new TipoContacto();

$contacto->setDescripcion($descripcion);



$contacto->guardar();

header("location: listado.php");


?>

