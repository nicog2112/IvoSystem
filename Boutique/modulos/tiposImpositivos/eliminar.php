<?php

require_once "../../class/TiposImpositivos.php";

$idTiposImpositivos = $_GET['id'];

$TipoImpositivo = TiposImpositivos::obtenerPorId($idTiposImpositivos);
$TipoImpositivo->eliminar();

header("location: listado.php");

?>