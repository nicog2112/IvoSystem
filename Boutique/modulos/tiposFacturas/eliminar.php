<?php

require_once "../../class/TipoFactura.php";

$idTipoFactura = $_GET['id'];

$tipoFactura= TipoFactura::obtenerPorId($idTipoFactura);
$tipoFactura->eliminar();

header("location: listado.php");

?>