<?php

require_once "../../class/TipoContacto.php";

$idTipoContacto = $_GET['id'];

$contacto = TipoContacto::obtenerPorId($idTipoContacto);
$contacto->eliminar();

header("location: listado.php");

?>