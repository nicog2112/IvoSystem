<?php

require_once "../../class/Persona.php";

$id_persona= $_POST["txtIdPersona"];
$nombre = $_POST['nombrePersonaModificar'];
$apellido = $_POST['apellidoPersonaModificar'];
$dni = $_POST['dniPersonaModificar'];
$fechaNacimiento = $_POST['fechaNacimientoPersonaModificar'];
$sexo = $_POST['sexoPersonaModificar'];
$nacionalidad = $_POST['nacionalidadPersonaModificar'];



        // Queremos que el nombre de usuario sólo tenga letras
if (!preg_match("/^([a-zA-ZÀ-ÿ]{3,20})+( [a-zA-ZÀ-ÿ]+)*$/", $nombre)) {
    header("location: listado.php?error=nombrePersonaModificar");
	exit;
}elseif (!preg_match("/^([a-zA-ZÀ-ÿ]{3,20})+( [a-zA-ZÀ-ÿ]+)*$/", $apellido)) {
	header("location: listado.php?error=apellidoPersonaModificar");
	exit;
}elseif (!preg_match("/^\d{8,11}$/", $dni)) {
	header("location: listado.php?error=dniPersonaModificar");
	exit;
}elseif (!preg_match("/^([a-zA-ZÀ-ÿ]{0,20})+( [a-zA-ZÀ-ÿ]+)*$/", $nacionalidad)) {
	header("location: listado.php?error=nacionalidadPersonaModificar");
	exit;
}

$persona = Persona::obtenerPorId($id_persona);

$persona->setNombre($nombre);
$persona->setApellido($apellido);
$persona->setDni($dni);
$persona->setFechaNacimiento($fechaNacimiento);
$persona->setIdSexo($sexo);
$persona->setNacionalidad($nacionalidad);


$persona->actualizar();

header("location: listado.php");


?>