<?php

require_once "../../class/ProductoTalle.php";


$idProducto = $_POST["txtIdProducto"];
$cantidadMaxima = $_POST['cantidadMaximaNuevo'];
$cantidadMinima = $_POST['cantidadMinimaNuevo'];
$cantidadDisponible = $_POST['cantidadDisponibleNuevo'];
$talle = $_POST['talleNuevo'];





$productoTalle = new ProductoTalle();


$productoTalle->setIdProducto($idProducto);
$productoTalle->setCantidadMaxima ($cantidadMaxima);
$productoTalle->setCantidadMinima ($cantidadMinima);
$productoTalle->setCantidadDisponible ($cantidadDisponible);
$productoTalle->setIdTalle ($talle);



$productoTalle->guardar();

header("location: listado.php?id_producto=" . $idProducto);


?>