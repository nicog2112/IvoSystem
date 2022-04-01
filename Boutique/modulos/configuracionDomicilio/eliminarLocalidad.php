<?php

require_once "../../class/Localidad.php";

$idLocalidad = $_GET['id'];
$idProvincia = $_GET['id_provincia'];

$localidad = Localidad::obtenerPorIdLocalidad($idLocalidad);
$localidad->eliminar();

header("location: listadoLocalidad.php?id_provincia=".$idProvincia."&validacion=eliminado");



?>