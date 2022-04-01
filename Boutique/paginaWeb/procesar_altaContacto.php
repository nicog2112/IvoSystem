<?php

require_once "../class/Contacto.php";

$idPersona = $_POST["idPersona"];
;
$idTipoContacto = $_POST["cboTipoContacto"];
$valor = $_POST["valorNuevo"];


$contacto = new Contacto();

$contacto->setIdPersona($idPersona);
$contacto->setIdTipoContacto($idTipoContacto);
$contacto->setValor($valor);

$contacto->guardar();

header("location: miPerfil.php");




?>