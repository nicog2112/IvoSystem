<?php

require_once "../class/PersonaDomicilio.php";


$idPersonaDomicilio = $_GET["id_persona_domicilio"];



$domicilio = PersonaDomicilio::obtenerPorIdPD($idPersonaDomicilio);
$domicilio->eliminar();


header("location: miPerfil.php");

?>