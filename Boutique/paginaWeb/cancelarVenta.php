<?php

session_start();

unset($_SESSION["carritoCliente"]);
$_SESSION["carritoCliente"] = [];

header("Location: ./carrito.php?status=2");
?>