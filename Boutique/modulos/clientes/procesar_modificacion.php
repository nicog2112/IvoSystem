<?php

require_once "../../class/Cliente.php";

$id_cliente = $_POST["txtIdEmpleado"];
$nombre = $_POST['nombrePersonaModificar'];
$apellido = $_POST['apellidoPersonaModificar'];
$dni = $_POST['dniPersonaModificar'];
$fechaNacimiento = $_POST['fechaNacimientoPersonaModificar'];
$sexo = $_POST['sexoPersonaModificar'];
$nacionalidad = $_POST['nacionalidadPersonaModificar'];


$cliente = Cliente::obtenerPorId($id_cliente);

$cliente->setNombre($nombre);
$cliente->setApellido($apellido);
$cliente->setDni($dni);
$cliente->setFechaNacimiento($fechaNacimiento);
$cliente->setIdSexo($sexo);
$cliente->setNacionalidad($nacionalidad);


$cliente->actualizar();

header("location: listado.php");


?>