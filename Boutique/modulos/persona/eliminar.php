<?php

require_once "../../class/Persona.php";
require_once "../../class/Cliente.php";
require_once "../../class/Empleado.php";
require_once "../../class/Preventista.php";

$idPersona = $_GET['id'];

$preventista = Preventista::obtenerPorIdPersona($idPersona);
$empleado = Empleado::obtenerPorIdPersona($idPersona);
$cliente = Cliente::obtenerPorIdPersona($idPersona);
$persona = Persona::obtenerPorId($idPersona);

if ($preventista) {
	$preventista->eliminar();
}
if ($preventista) {
	$cliente->eliminar();
}
if ($preventista) {
	$empleado->eliminar();
}

$persona->eliminar();

header("location: listado.php");

?>
