<?php
if(!isset($_GET["indice"])) return;
$indice = $_GET["indice"];

session_start();
array_splice($_SESSION["carritoProveedor"], $indice, 1);
header("Location: ./comprar.php?status=3");
?>