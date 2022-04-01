<?php

session_start();

unset($_SESSION["carritoProveedor"]);
$_SESSION["carritoProveedor"] = [];

header("Location: ./comprar.php?status=2");
?>