<?php

require_once "../../../class/TipoContacto.php";

$id_tipo_contacto = $_POST["txtIdTipoContacto"];
$descripcion = $_POST['txtDescripcion'];

$contacto = TipoContacto::obtenerPorId($id_tipo_contacto);

$contacto->setDescripcion($descripcion);

$contacto->actualizar();

header("location: contactos.php");


?>