<?php

require_once "../../class/TipoContacto.php";

$id_tipo_contacto = $_POST["txtIdTipoContacto"];
$descripcion = $_POST['nombre'];


if (!preg_match("/^([a-zA-ZÀ-ÿ]{3,40})+( [a-zA-ZÀ-ÿ]+)*$/", $descripcion)) {
    header("location: listado.php?error=descripcionModificar");
	exit;
        }
elseif (strlen($descripcion) < 3){
	header("location: listado.php?error=descripcionModificar");
	exit;
}



$contacto = TipoContacto::obtenerPorId($id_tipo_contacto);

$contacto->setDescripcion($descripcion);

$contacto->actualizar();

header("location: listado.php");


?>