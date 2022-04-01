<?php

require_once "../../class/TipoPago.php";

$id_tipo_pago = $_POST["txtIdTipoPago"];

$nombreTipoPago = trim($_POST["nombre"]);
$valorPorcentaje = trim($_POST["valorPorcentaje"]);

if (!preg_match("/^([a-zA-ZÀ-ÿ]{3,40})+( [a-zA-ZÀ-ÿ]+)*$/", $nombreTipoPago)) {
    header("location: listado.php?error=descripcionModificar");
	exit;
        }
elseif (strlen($nombreTipoPago) < 3){
	header("location: listado.php?error=descripcionModificar");
	exit;
}

elseif (!preg_match("/^\d{1,4}$/", $valorPorcentaje)) {
	header("location: listado.php?error=valorModificar");
	exit;
	}

$tipoPago = TipoPago::obtenerPorId($id_tipo_pago);


$tipoPago->setDescripcion($nombreTipoPago);
$tipoPago->setValorPorcentaje($valorPorcentaje);

$tipoPago->actualizar();

header("location: listado.php?validacion=true");


?>