<?php

require_once "../../class/ContactoProveedor.php";


$idProveedor = $_POST["txtIdProveedor"];
$idTipoContacto = $_POST["cboTipoContacto"];
$valor = $_POST["valorNuevo"];


if (empty($idTipoContacto)) {
	header("location: listado.php?id_proveedor=".$idProveedor."&error=tipoContactoNuevo");
	exit;
	// code...
}
if (empty($valor)) {
    header("location: listado.php?id_proveedor=".$idProveedor."&error=valorNuevo");
	exit;
        }


$contacto = new ContactoProveedor();

$contacto->setIdProveedor($idProveedor);
$contacto->setIdTipoContacto($idTipoContacto);
$contacto->setValor($valor);

$contacto->guardar();


header("location: listado.php?id_proveedor=" . $idProveedor);




?>