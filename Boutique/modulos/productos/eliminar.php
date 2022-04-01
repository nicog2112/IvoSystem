<?php

require_once "../../class/Producto.php";

$idProducto = $_GET['id_producto'];

$producto = Producto::obtenerPorId($idProducto);
$producto->eliminar();

header("location: listado.php");

?>