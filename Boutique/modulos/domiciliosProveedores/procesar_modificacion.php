
<?php

require_once "../../class/DomicilioProveedor.php";

$idProveedor = $_POST["idProveedor"];
$idProveedorDomicilio = $_POST["idProveedorDomicilio"];
//$pais = $_POST["lista1"];
//$provincia = $_POST["select2lista"];
//$localidad = $_POST["select3lista"];
$barrio = $_POST["barrioModificar"];
$calle = $_POST["calleModificar"];
$altura = $_POST["alturaModificar"];
$manzana = $_POST["manzanaModificar"];
$casa = $_POST["casaModificar"];
$torre = $_POST["torreModificar"];
$piso = $_POST["pisoModificar"];


$domicilio = DomicilioProveedor::obtenerPorIdProveedorDomicilio($idProveedorDomicilio);

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




$domicilio->actualizar();



header("location: listado.php?id_proveedor=" . $idProveedor . "&modulo=proveedor");




?>