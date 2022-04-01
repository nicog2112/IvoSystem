<?php

require_once "../../class/proveedor.php";

$nombreProveedor = trim($_POST['nombreAñadir']);
$cuit = trim($_POST['cuitAñadir']);
$fechaAlta = $_POST['txtFechaAlta'];
$estado = 1;

        // Queremos que el nombre de usuario sólo tenga letras
if (!preg_match("/^([a-zA-ZÀ-ÿ]{3,40})+( [a-zA-ZÀ-ÿ]+)*$/", $nombreProveedor)) {
    header("location: listado.php?error=nombreProveedorAñadir");
	exit;
        }

elseif (!preg_match("/^\d{8,11}$/", $cuit)) {
	header("location: listado.php?error=cuitAñadir");
	exit;
}




$proveedor = new proveedor();

$proveedor->setNombreProveedor($nombreProveedor);
$proveedor->setCuit($cuit);
$proveedor->setFechaAlta($fechaAlta);
$proveedor->setEstado($estado);


$proveedor->guardar();

header("location: listado.php");


?>