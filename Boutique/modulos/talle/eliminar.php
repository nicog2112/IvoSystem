<?php

require_once "../../class/Talle.php";

$idTalle = $_GET['id'];

$talle = Talle::obtenerPorId($idTalle);
$talle->eliminar();

header("location: listado.php");

?>