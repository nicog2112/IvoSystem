<?php

require_once "../../class/ContactoProveedor.php";


$idProveedor = $_GET["id_proveedor"];
$idProveedorContacto = $_GET["id"];


$contacto = ContactoProveedor::obtenerPorId($idProveedorContacto);
$contacto->eliminar();


header("location: listado.php?id_proveedor=" . $idProveedor);


?>