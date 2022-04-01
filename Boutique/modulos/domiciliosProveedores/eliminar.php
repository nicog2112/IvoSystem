<?php

require_once "../../class/ProveedorDomicilio.php";


$idProveedor = $_GET["id_proveedor"];
$idProveedorDomicilio = $_GET["id"];




$domicilio = ProveedorDomicilio::obtenerPorId($idProveedorDomicilio);
$domicilio->eliminar();


header("location: listado.php?id_proveedor=" . $idProveedor ."&modulo=proveedor");


?>