<?php

require_once "../../class/ContactoProveedor.php";

$idProveedorContacto= $_POST["txtIdProveedorContacto"];
$idProveedor = $_POST["txtIdProveedor"];
$idTipoContacto = $_POST["cboTipoContactoModificar"];
$valor = $_POST["valorModificar"];

if (empty($idTipoContacto)) {
	header("location: listado.php?id_proveedor=".$idProveedor."&error=tipoContactoModificar");
	exit;
	// code...
}
if (empty($valor)) {
    header("location: listado.php?id_proveedor=".$idProveedor."&error=valorModificar");
	exit;
        }

$contacto = ContactoProveedor::obtenerPorId($idProveedorContacto);

$contacto->setIdTipoContacto($idTipoContacto);
$contacto->setValor($valor);

$contacto->actualizar();



header("location: listado.php?id_proveedor=" . $idProveedor );




?>