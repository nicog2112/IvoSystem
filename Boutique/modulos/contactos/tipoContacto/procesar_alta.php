<?php

require_once "../../../class/TipoContacto.php";

$descripcion = $_POST['txtDescripcion'];




$contacto = new TipoContacto();

$contacto->setDescripcion($descripcion);



$contacto->guardar();

header("location: contactos.php");


?>