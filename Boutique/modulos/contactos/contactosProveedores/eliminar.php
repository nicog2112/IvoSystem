<?php

require_once "../../class/Contacto.php";


$idPersona = $_GET["id_persona"];
$idPersonaContacto = $_GET["idPersonaContacto"];


$contacto = Contacto::obtenerPorId($idPersonaContacto);
$contacto->eliminar();


header("location: contactos.php?id_persona=" . $idPersona);


?>