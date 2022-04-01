<?php

require_once "../../class/PersonaDomicilio.php";


$idPersona = $_GET["id_persona"];
$idPersonaDomicilio = $_GET["id"];

$modulo=$_GET["modulo"]; 
$id=$_GET["idMenu"]; 


$domicilio = PersonaDomicilio::obtenerPorIdPD($idPersonaDomicilio);
$domicilio->eliminar();


header("location: listado.php?id_persona=" . $idPersona . "&modulo=".$modulo."&id=".$id);

?>