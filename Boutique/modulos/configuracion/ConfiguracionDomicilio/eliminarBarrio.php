<?php

require_once "../../../class/Barrio.php";

$idLocalidad = $_GET['id_localidad'];
$idBarrio = $_GET['id_barrio'];

$barrio = Barrio::obtenerPorIdBarrio($idBarrio);
$barrio->eliminar();

header("location: listadoBarrio.php?id_localidad=".$idLocalidad."&id_barrio=".$idBarrio."&validacion=eliminado");



?>