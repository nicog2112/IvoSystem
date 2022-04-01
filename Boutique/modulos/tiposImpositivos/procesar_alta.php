<?php

require_once "../../class/TiposImpositivos.php";

$estado= 1;
$nombreTipoPago = trim($_POST["nombreNuevo"]);
$valorPorcentaje = trim($_POST["valorPorcentajeNuevo"]);

        // Queremos que el nombre de usuario sólo tenga letras
if (!preg_match("/^([a-zA-ZÀ-ÿ]{3,40})+( [a-zA-ZÀ-ÿ]+)*$/", $nombreTipoPago)) {
    header("location: listado.php?error=descripcionAñadir");
	exit;
        }
elseif (strlen($nombreTipoPago) < 3){
	header("location: listado.php?error=descripcionAñadir");
	exit;
}

elseif (!preg_match("/^\d{1,4}$/", $valorPorcentaje)) {
	header("location: listado.php?error=valorAñadir");
	exit;
}
	
//if (trim($nombreCategoria) == ""){
//	echo "error nombre de la categoria vacio";
//	exit;
//}


$TipoImpositivo = new TiposImpositivos();

$TipoImpositivo->setDescripcion($nombreTipoPago);
$TipoImpositivo->setValorPorcentaje($valorPorcentaje);
$TipoImpositivo->setEstado($estado);



$TipoImpositivo->guardar();

header("location: listado.php?validacion=true");


?>