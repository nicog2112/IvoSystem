<?php

require_once "../class/PersonaDomicilio.php";
require_once "../class/Empleado.php";


$idPersona = $_POST["idPersona"];

//$idDomicilio = $_POST["txtIdDomicilio"];
/*$pais = $_POST["lista1"];
$provincia = $_POST["select2lista"];
$localidad = $_POST["select3lista"];*/
$barrio = $_POST["select4lista"];
$calle = $_POST["calleNuevo"];
$altura = $_POST["alturaNuevo"];
$manzana = $_POST["manzanaNuevo"];
$casa = $_POST["casaNuevo"];
$torre = $_POST["torreNuevo"];
$piso = $_POST["pisoNuevo"];


$domicilio = new PersonaDomicilio();

$domicilio->setIdPersona($idPersona);
//$domicilio->setIdDomicilio($idDomicilio);
//$domicilio->barrio->localidad->provincia->pais->setDescripcion($pais);
//$domicilio->barrio->localidad->provincia->setDescripcion($provincia);
//$domicilio->barrio->localidad->setDescripcion($localidad);
$domicilio->setIdBarrio($barrio);
$domicilio->setCalle($calle);
$domicilio->setAltura($altura);
$domicilio->setManzana($manzana);
$domicilio->setNumeroCasa($casa);
$domicilio->setTorre($torre);
$domicilio->setPiso($piso);


$domicilio->guardar();


header("location: miPerfil.php" );




?>