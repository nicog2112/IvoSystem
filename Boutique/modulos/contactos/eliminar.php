<?php

require_once "../../class/Contacto.php";


$idPersona = $_GET["id_persona"];
$idPersonaContacto = $_GET["id"];
$idMenu = $_GET["idMenu"];

$modulo=$_GET["modulo"]; 


$contacto = Contacto::obtenerPorId($idPersonaContacto);
$contacto->eliminar();


header("location: listado.php?id_persona=" . $idPersona."&modulo=".$modulo."&id=$idMenu");


?>