<?php

require_once "../../../class/Modulo.php";

$idModulo = $_GET['id_modulo'];

$modulo = Modulo::obtenerPorId($idModulo);
$modulo->eliminar();

header("location: listado.php");

?>