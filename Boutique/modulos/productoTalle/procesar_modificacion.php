<?php

require_once "../../class/ProductoTalle.php";


$idProductoTalle = $_POST["txtIdProductoTalle"];
$idProducto = $_POST["txtIdProducto"];
$cantidadMaxima = $_POST['cantidadMaximaModificar'];
$cantidadMinima = $_POST['cantidadMinimaModificar'];
$cantidadDisponible = $_POST['cantidadDisponibleModificar'];
$talle = $_POST['talleModificar'];

$productoTalle = ProductoTalle::obtenerPorId($idProductoTalle);

$productoTalle->setIdProducto($idProducto);
$productoTalle->setCantidadMaxima ($cantidadMaxima);
$productoTalle->setCantidadMinima ($cantidadMinima);
$productoTalle->setCantidadDisponible ($cantidadDisponible);
$productoTalle->setIdTalle ($talle);

$productoTalle->actualizar();


header("location: listado.php?id_producto=" . $idProducto);


?>