<?php

require_once "../../class/Preventista.php";
$idProveedor = $_GET['id_proveedor'];
$idPreventista = $_GET['id'];

$preventista = Preventista::obtenerPorId($idPreventista);
$preventista->setEstado($estado);

$preventista->eliminar();

header("location: listado.php?id_proveedor=" . $idProveedor);

?>
