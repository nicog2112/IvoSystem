<?php

require_once "../../class/Empleado.php";

$persona = $_POST['personaAñadir'];
$numeroLegajo= $_POST['legajoNuevo'];

date_default_timezone_set('america/argentina/buenos_aires');
$fecha_actual = date("Y-m-d");


if($persona == "NULL") {
       header("location: listado.php?error=select");
       exit;

       
     } ;

if (!preg_match("/^\d{0,11}$/", $numeroLegajo)) {
	header("location: listado.php?error=legajoNuevo");
	exit;
};

$Empleado = new Empleado();


$Empleado->setIdPersona($persona);
$Empleado->setNumeroLegajo($numeroLegajo);

$Empleado->setFechaAlta($fecha_actual);


$Empleado->guardar();

header("location: listado.php");


?>