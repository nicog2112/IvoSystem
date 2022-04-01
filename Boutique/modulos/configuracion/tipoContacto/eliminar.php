<?php

require_once "../../../class/TipoContacto.php";

$idTipoContacto = $_GET['id_tipo_contacto'];

$contacto = TipoContacto::obtenerPorId($idTipoContacto);
$contacto->eliminar();

header("location: contactos.php");

?>