<?php

require_once "../../class/Empleado.php";

$idEmpleado = $_GET['id'];

$empleado = Empleado::obtenerPorId($idEmpleado);
$empleado->eliminar();

header("location: listado.php");

?>