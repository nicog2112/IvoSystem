<?php

require_once "../../class/TiposImpositivos.php";

$id_tipo_impositivo = $_POST["txtIdTipoImpuesto"];

$nombreTipoImpuesto = trim($_POST["nombre"]);
$valorPorcentaje = trim($_POST["valorPorcentaje"]);

        // Queremos que el nombre de usuario sólo tenga letras
if (!preg_match("/^([a-zA-ZÀ-ÿ]{3,40})+( [a-zA-ZÀ-ÿ]+)*$/", $nombreTipoImpuesto)) {
    header("location: listado.php?error=descripcionModificar");
	exit;
        }
elseif (strlen($nombreTipoImpuesto) < 3){
	header("location: listado.php?error=descripcionModificar");
	exit;
}

elseif (!preg_match("/^\d{1,4}$/", $valorPorcentaje)) {
	header("location: listado.php?error=valorModificar");
	exit;
	}


$TipoImpositivo = TiposImpositivos::obtenerPorId($id_tipo_impositivo);


$TipoImpositivo->setDescripcion($nombreTipoImpuesto);
$TipoImpositivo->setValorPorcentaje($valorPorcentaje);

$TipoImpositivo->actualizar();

header("location: listado.php?validacion=true");


?>