<?php

require_once "../../class/ProveedorDomicilio.php";


$idProveedor = $_POST["idProveedor"];
//$idDomicilio = $_POST["txtIdDomicilio"];
//$pais = $_POST["lista1"];
//$provincia = $_POST["select2lista"];
//$localidad = $_POST["select3lista"];
$barrio = $_POST["select4lista"];
$calle = $_POST["calleNuevo"];
$altura = $_POST["alturaNuevo"];
$manzana = $_POST["manzanaNuevo"];
$casa = $_POST["casaNuevo"];
$torre = $_POST["torreNuevo"];
$piso = $_POST["pisoNuevo"];

$domicilioProveedor = new ProveedorDomicilio();

$domicilioProveedor->setIdProveedor($idProveedor);
//$domicilio->setIdDomicilio($idDomicilio);
//$domicilio->barrio->localidad->provincia->pais->setDescripcion($pais);
//$domicilio->barrio->localidad->provincia->setDescripcion($provincia);
//$domicilio->barrio->localidad->setDescripcion($localidad);
$domicilioProveedor->setIdBarrio($barrio);
$domicilioProveedor->setCalle($calle);
$domicilioProveedor->setAltura($altura);
$domicilioProveedor->setManzana($manzana);
$domicilioProveedor->setNumeroCasa($casa);
$domicilioProveedor->setTorre($torre);
$domicilioProveedor->setPiso($piso);
$domicilioProveedor->setObservaciones($piso);

$domicilioProveedor->guardar();




header("location: listado.php?id_proveedor=" . $idProveedor . "&modulo=proveedores");




?>