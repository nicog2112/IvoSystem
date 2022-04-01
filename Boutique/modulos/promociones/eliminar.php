<?php

require_once "../../class/Promocion.php";

$idPromocion = $_GET['id_promocion'];

$promocion = Promocion::obtenerPorId($idPromocion);
$promocion->eliminar();

header("location: listado.php");

?>