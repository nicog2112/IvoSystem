<?php
if(!isset($_GET["indice"])) return;
$indice = $_GET["indice"];

session_start();
array_splice($_SESSION["carritoCliente"], $indice, 1);
header("Location: ./carrito.php?status=3");
?>