<?php

require_once "../../class/Promocion.php";

$nombrePromocion = trim($_POST['nombre']);
$fechaInicio = $_POST['fechaInicio'];
$fechaFin = $_POST['fechaFin'];


$fecha_actual = date("Y-m-d");



        // Queremos que el nombre de usuario sólo tenga letras
if (!preg_match("/^[a-zA-Z]+/", $nombrePromocion)) {
    header("location: nuevo.php?error=nombrePromocion");
	exit;
        }
elseif (strlen($nombrePromocion) < 3){
	header("location: nuevo.php?error=nombrePromocion");
	exit;
}
elseif ($fechaInicio < $fecha_actual) {
    header("location: nuevo.php?error=fechaInicio");
	exit;
}
elseif ($fechaFin <  $fechaInicio) {
    header("location: nuevo.php?error=fechaFin");
	exit;
}

else{

	header("location: nuevo.php?error=false");

	} 

$promocion = new Promocion();

$promocion->setNombre($nombrePromocion);
$promocion->setFechaInicio($fechaInicio);
$promocion->setFechaFin($fechaFin);



$promocion->guardar();

header("location: listado.php?validacion=true");


?>