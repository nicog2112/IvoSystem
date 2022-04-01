<?php

require_once "../../class/Usuario.php";

$idUsuario = $_GET['id'];
$idPerfilUsuario = $_GET['id_perfil_usuario'];

$usuario = Usuario::obtenerPorId($idUsuario);
$usuario->eliminar();

header("location: listado.php?id_perfil=".$idPerfilUsuario);

?>