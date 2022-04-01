<?php

require_once "../../class/Temporada.php";

$idTemporada = $_GET['id'];

$temporada = Temporada::obtenerPorId($idTemporada);
$temporada->eliminar();

header("location: listado.php");

?>