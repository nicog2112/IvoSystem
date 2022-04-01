<?php

require_once "../../class/TipoPago.php";

$idTipoPago = $_GET['id'];

$tipoPago = TipoPago::obtenerPorId($idTipoPago);
$tipoPago->eliminar();

header("location: listado.php");

?>