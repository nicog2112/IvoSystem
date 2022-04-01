<?php

require_once "../../class/proveedor.php";

$id_proveedor = $_POST["txtIdProveedor"];
$nombreProveedor = trim($_POST['nombre']);
$cuit = trim($_POST['cuit']);


        // Queremos que el nombre de usuario sólo tenga letras
if (!preg_match("/^([a-zA-ZÀ-ÿ]{3,40})+( [a-zA-ZÀ-ÿ]+)*$/", $nombreProveedor)) {
    header("location: listado.php?error=nombreProveedorModificar");
	exit;
        }

elseif (!preg_match("/^\d{8,11}$/", $cuit)) {
	header("location: listado.php?error=cuitModificar");
	exit;
}



$proveedor = Proveedor::obtenerPorId($id_proveedor);

$proveedor->setNombreProveedor($nombreProveedor);
$proveedor->setCuit($cuit);


$proveedor->actualizar();

header("location: listado.php");


?>