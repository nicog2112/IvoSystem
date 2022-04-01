<?php

require_once "../../class/Talle.php";

$id_talle = $_POST["txtIdCategoria"];


$nombreTalle = trim($_POST["nombre"]);

if (!preg_match("/^[a-zA-Z]+/", $nombreTalle)) {
    header("location: listado.php?error=nombreTalle");
	exit;
        }
elseif (strlen($nombreTalle) < 3){
	header("location: listado.php?error=nombreTalle");
	exit;
	}




$talle = Talle::obtenerPorId($id_talle);

$talle->setDescripcion($nombreTalle);

$talle->actualizar();

header("location: listado.php?validacion=true");


?>