<?php

require_once "../../class/Modulo.php";

$idModulo = $_GET['id'];

$modulo = Modulo::obtenerPorId($idModulo);
$modulo->eliminar();

header("location: listado.php");

?>