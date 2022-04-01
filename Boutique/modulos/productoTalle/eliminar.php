<?php

require_once "../../class/ProductoTalle.php";


$idProducto = $_GET["id_producto"];
$idProductoTalle = $_GET["id"];


$productoTalle = ProductoTalle::obtenerPorId($idProductoTalle);
$productoTalle->eliminar();


header("location: listado.php?id_producto=" . $idProducto);


?>