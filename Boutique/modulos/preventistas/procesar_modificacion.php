<?php

require_once "../../class/Preventista.php";

$id_preventista= $_POST["txtIdPreventista"];
$nombre = $_POST['nombrePersonaModificar'];
$apellido = $_POST['apellidoPersonaModificar'];
$dni = $_POST['dniPersonaModificar'];
$fechaNacimiento = $_POST['fechaNacimientoPersonaModificar'];
$sexo = $_POST['sexoPersonaModificar'];
$nacionalidad = $_POST['nacionalidadPersonaModificar'];
$proveedor = $_POST['txtIdProveedor'];


        // Queremos que el nombre de usuario sólo tenga letras
if (!preg_match("/^([a-zA-ZÀ-ÿ]{3,20})+( [a-zA-ZÀ-ÿ]+)*$/", $nombre)) {
    header("location: listado.php?id_proveedor=".$proveedor."&error=nombrePersonaModificar");
	exit;
}elseif (!preg_match("/^([a-zA-ZÀ-ÿ]{3,20})+( [a-zA-ZÀ-ÿ]+)*$/", $apellido)) {
	header("location: listado.php?id_proveedor=".$proveedor."&error=apellidoPersonaModificar");
	exit;
}elseif (!preg_match("/^\d{8,11}$/", $dni)) {
	header("location: listado.php?id_proveedor=".$proveedor."&error=dniPersonaModificar");
	exit;
}elseif (!preg_match("/^([a-zA-ZÀ-ÿ]{3,20})+( [a-zA-ZÀ-ÿ]+)*$/", $nacionalidad)) {
	header("location: listado.php?id_proveedor=".$proveedor."&error=nacionalidadPersonaModificar");
	exit;
}

$preventista = Preventista::obtenerPorId($id_preventista);

$preventista->setNombre($nombre);
$preventista->setApellido($apellido);
$preventista->setDni($dni);
$preventista->setFechaNacimiento($fechaNacimiento);
$preventista->setIdSexo($sexo);
$preventista->setNacionalidad($nacionalidad);
$preventista->setIdProveedor($proveedor);

$preventista->actualizar();

header("location: listado.php?id_proveedor=" . $proveedor);


?>