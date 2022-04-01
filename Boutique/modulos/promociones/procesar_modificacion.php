<?php

require_once "../../class/Promocion.php";

$id_promocion = $_POST["txtIdPromocion"];
$nombrePromocion = $_POST['txtNombrePromocion'];
$fechaInicio = $_POST['txtFechaInicio'];
$fechaFin = $_POST['txtFechaFin'];

$promocion = Promocion::obtenerPorId($id_promocion);

$promocion->setNombre($nombrePromocion);
$promocion->setFechaInicio($fechaInicio);
$promocion->setFechaFin($fechaFin);

$promocion->actualizar();

header("location: listado.php");


?>