<?php

require_once "../../class/Proveedor.php";

$idProveedor = $_GET['id'];
$estado = 2;

$proveedor = Proveedor::obtenerPorId($idProveedor);


$proveedor->setEstado($estado);

$proveedor->eliminar();

header("location: listado.php");

?>