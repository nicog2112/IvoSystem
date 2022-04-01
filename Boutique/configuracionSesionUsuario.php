<?php



require_once "configs.php";

require_once "../../class/Usuario.php";
require_once "../../class/ProductoTalle.php";

session_start();

if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
} else {
    header("location: /programacion_3/boutique/form_login.php?error=" . MENSAJE_CODE);
    exit;
}


$listadoModulos = $usuario->perfil->getModulos();
?>