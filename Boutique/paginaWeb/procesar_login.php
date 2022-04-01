<?php

require_once "../configs.php";
require_once "../class/Usuario.php";


$username = $_POST['txtUsername'];
$password = $_POST['txtPassword'];


$usuarioCliente = Usuario::loginCliente($username, $password);

if ($usuarioCliente->estaLogueado()) {
	
	session_start();
	$_SESSION['usuarioCliente'] = $usuarioCliente;
	header("location: /programacion_3/boutique/paginaWeb/inicio.php");

} else {
	//echo "login incorrecto";
	header("location: registroLogin.php?error=" . ERROR_LOGIN_CODE);
}


?>