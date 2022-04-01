<?php

require_once "../../class/Cliente.php";
$persona = $_POST['personaAñadir'];

date_default_timezone_set('america/argentina/buenos_aires');
$fecha_actual = date("Y-m-d");


if($persona == "NULL") {
       header("location: listado.php?error=select");
       exit;

       
     } ;



$cliente = new Cliente();


$cliente->setIdPersona($persona);
$cliente->setFechaAlta($fecha_actual);


$cliente->guardar();

header("location: listado.php");


?>