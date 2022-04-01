<?php





require_once "../class/Usuario.php";
require_once "../class/ProductoTalle.php";

session_start();

if (isset($_SESSION['usuarioCliente'])) {
    $usuarioCliente = $_SESSION['usuarioCliente'];
} else {
    header("location: registroLogin.php?error=" . MENSAJE_CODE);
    exit;
}


?>