<?php

require_once "../../class/Contacto.php";

$idPersona = $_POST["idPersona"];
$id= $_POST["id"];
$moduloMenu= $_POST["moduloMenu"];
$idTipoContacto = $_POST["cboTipoContacto"];
$valor = $_POST["valorNuevo"];

if (empty($idTipoContacto)) {
	header("location: listado.php?id_persona=" . $idPersona . "&modulo=". $moduloMenu . "&id=". $id ."&error=tipoContactoNuevo");
	exit;
	// code...
}
if (empty($valor)) {
    header("location: listado.php?id_persona=" . $idPersona . "&modulo=". $moduloMenu . "&id=". $id ."&error=valorNuevo");
	exit;
        }
$contacto = new Contacto();

$contacto->setIdPersona($idPersona);
$contacto->setIdTipoContacto($idTipoContacto);
$contacto->setValor($valor);

$contacto->guardar();

header("location: listado.php?id_persona=" . $idPersona . "&modulo=". $moduloMenu . "&id=". $id );




?>