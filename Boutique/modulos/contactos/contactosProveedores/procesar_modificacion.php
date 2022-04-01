<?php

require_once "../../class/ProductoTalle.php";


$idProductoTalle = $_POST["txtIdProductoTalle"];
$idProducto = $_POST["txtIdProducto"];
$cantidadMaxima = $_POST['txtCantidadMaxima'];
$cantidadMinima = $_POST['txtCantidadMinima'];
$cantidadDisponible = $_POST['txtCantidadDisponible'];
$talle = $_POST['cboTalle'];

$productoTalle = ProductoTalle::obtenerPorId($idProductoTalle);

$productoTalle->setIdProducto($idProducto);
$productoTalle->setCantidadMaxima ($cantidadMaxima);
$productoTalle->setCantidadMinima ($cantidadMinima);
$productoTalle->setCantidadDisponible ($cantidadDisponible);
$productoTalle->setIdTalle ($talle);

$productoTalle->actualizar();


header("location: listado.php?id_producto=" . $idProducto);


?>