<?php

require_once "../class/Contacto.php";



$idPersonaContacto = $_GET["id_persona_contacto"];


$contacto = Contacto::obtenerPorId($idPersonaContacto);
$contacto->eliminar();


header("location: miPerfil.php");


?>