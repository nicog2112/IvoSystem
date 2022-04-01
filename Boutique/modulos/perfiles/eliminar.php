<?php

require_once "../../class/Perfil.php";

$idPerfil = $_GET['id'];


$perfil = Perfil::obtenerPorId($idPerfil);



$perfil->eliminar();

header("location: listado.php");

?>

