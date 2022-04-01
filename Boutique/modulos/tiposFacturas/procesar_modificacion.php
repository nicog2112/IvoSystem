<?php

require_once "../../class/TipoFactura.php";

$id_tipo_factura = $_POST["txtIdTipoFactura"];

$nombreTipoFactura = trim($_POST["nombre"]);


if (!preg_match("/^([a-zA-ZÀ-ÿ]{1,10})+( [a-zA-ZÀ-ÿ]+)*$/", $nombreTipoFactura)) {
    header("location: listado.php?error=descripcionModificar");
	exit;
        }
elseif (strlen($nombreTipoFactura) < 1){
	header("location: listado.php?error=descripcionModificar");
	exit;
}
$tipoFactura = TipoFactura::obtenerPorId($id_tipo_factura);


$tipoFactura->setDescripcion($nombreTipoFactura);

$tipoFactura->actualizar();

header("location: listado.php?validacion=true");


?>