<?php

require_once "../../class/Empleado.php";

date_default_timezone_set('america/argentina/buenos_aires');


$id_empleado = $_POST["txtIdEmpleado"];
$nombre = $_POST['nombrePersonaModificar'];
$apellido = $_POST['apellidoPersonaModificar'];
$dni = $_POST['dniPersonaModificar'];
$fechaNacimiento = $_POST['fechaNacimientoPersonaModificar'];
$sexo = $_POST['sexoPersonaModificar'];
$nacionalidad = $_POST['nacionalidadPersonaModificar'];
$legajo = $_POST['legajoModificar'];

$fecha_actual = date("Y-m-d");
$fecha_nacimiento = strtotime($fechaNacimiento);

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
}elseif (!preg_match("/^([a-zA-ZÀ-ÿ]{3,20})+( [a-zA-ZÀ-ÿ]+)*$/", $nacionalidad)) {
	header("location: listado.php?error=nacionalidadPersonaModificar");
	exit;
}elseif ($fechaNacimiento > $fecha_actual) {
    header("location: listado.php?error=fechaNacimientoModificar");
	exit;
}elseif (!preg_match("/^\d{0,11}$/", $legajo)) {
	header("location: listado.php?error=legajoModificar");
	exit;
};


$empleado = Empleado::obtenerPorId($id_empleado);

$empleado->setNombre($nombre);
$empleado->setApellido($apellido);
$empleado->setDni($dni);
$empleado->setFechaNacimiento($fechaNacimiento);
$empleado->setIdSexo($sexo);
$empleado->setNacionalidad($nacionalidad);
$empleado->setNumeroLegajo($legajo);



$empleado->actualizar();

header("location: listado.php");


?>