<?php

require_once "../../class/Provincia.php";

$idPais = $_GET['id_pais'];
$idProvincia = $_GET['id'];

$provincia = Provincia::obtenerPorIdProvincia($idProvincia);
$provincia->eliminar();

header("location: listadoProvincia.php?id_pais=".$idPais."&validacion=eliminado");



?>