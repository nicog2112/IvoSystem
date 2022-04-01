<?php

require_once "../../../class/Localidad.php";

$idLocalidad = $_GET['id_localidad'];
$idProvincia = $_GET['id_provincia'];

$localidad = Localidad::obtenerPorIdLocalidad($idLocalidad);
$localidad->eliminar();

header("location: listadoLocalidad.php?id_localidad=".$idLocalidad."&id_provincia=".$idProvincia."&validacion=eliminado");



?>