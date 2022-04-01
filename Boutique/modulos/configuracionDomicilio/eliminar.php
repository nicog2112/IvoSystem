<?php

require_once "../../class/Pais.php";

$idPais = $_GET['id'];

$pais = Pais::obtenerPorIdPais($idPais);
$pais->eliminar();

header("location: listado.php?validacion=eliminado");

?>