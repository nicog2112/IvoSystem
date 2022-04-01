<?php

require_once "../../class/Contacto.php";

$idPersonaContacto= $_POST["txtIdPersonaContacto"];
$idPersona = $_POST["txtId"];
$id= $_POST["idMenu"];
$moduloMenu= $_POST["moduloMenu"];
$idTipoContacto = $_POST["cboTipoContactoModificar"];
$valor = $_POST["valorModificar"];

if (empty($idTipoContacto)){
	
	header("location: listado.php?id_persona=" . $idPersona . "&modulo=". $moduloMenu . "&id=". $id ."&error=tipoContactoModificar");
	exit;
	// code...
}
if (empty($valor)) {
    header("location: listado.php?id_persona=" . $idPersona . "&modulo=". $moduloMenu . "&id=". $id ."&error=valorModificar");
	exit;
        }

$contacto = Contacto::obtenerPorId($idPersonaContacto);

$contacto->setIdTipoContacto($idTipoContacto);
$contacto->setValor($valor);

$contacto->actualizar();



header("location: listado.php?id_persona=" . $idPersona . "&modulo=". $moduloMenu . "&id=". $id );



?>