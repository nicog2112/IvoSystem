<?php

require_once "../../../class/Provincia.php";

$idPais = $_GET['id_pais'];
$idProvincia = $_GET['id_provincia'];

$provincia = Provincia::obtenerPorIdProvincia($idProvincia);
$provincia->eliminar();

header("location: listadoProvincia.php?id_pais=".$idPais."&id_provincia=".$idProvincia."&validacion=eliminado");



?>