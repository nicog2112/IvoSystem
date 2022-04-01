<?php
if (!isset($_POST["codigo"])) {
    return;
}

$codigo = $_POST["codigo"];
$cantidad = $_POST["cantidad"];
$talle = $_POST["cboTalle"];
$promocion = $_POST["promocion"];

include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM productotalle join producto on producto.id_producto=productotalle.id_producto WHERE productotalle.id_talle =".$talle." and productotalle.id_producto =".$codigo." LIMIT 1;");

$sentencia->execute();

$producto = $sentencia->fetch(PDO::FETCH_OBJ);
# Si no existe, salimos y lo indicamos
if (!$producto) {
    header("Location: ./vender.php?status=4");
    exit;
}
# Si no hay existencia...
if ($producto->cantidad_disponible < $cantidad) {
    header("Location: ./vender.php?status=5");
    exit;
}
session_start();
# Buscar producto dentro del cartito
$indice = false;
for ($i = 0; $i < count($_SESSION["carrito"]); $i++) {
    if (($_SESSION["carrito"][$i]->id_producto == $codigo) and ($_SESSION["carrito"][$i]->id_talle == $talle)) {
        $indice = $i;
        break;
    }
}
# Si no existe, lo agregamos como nuevo
if ($indice === false) {
    $producto->cantidad = $cantidad;
    $descuentoPromocion = ($producto->precio_venta * $cantidad) * ($promocion / 100);
    $producto->total = ($producto->precio_venta * $cantidad) - $descuentoPromocion;
    array_push($_SESSION["carrito"], $producto);
} else {
    # Si ya existe, se agrega la cantidad
    # Pero espera, tal vez ya no haya
    $cantidadExistente = $_SESSION["carrito"][$indice]->cantidad;
    # si al sumarle uno supera lo que existe, no se agrega
    if ($cantidadExistente + $cantidad > $producto->cantidad_disponible) {
        header("Location: ./vender.php?status=5");
        exit;
    }
    $_SESSION["carrito"][$indice]->cantidad = $cantidadExistente + $cantidad ;
    $descuentoPromocion = ($producto->precio_venta * $_SESSION["carrito"][$indice]->cantidad) * ($promocion / 100);
    $_SESSION["carrito"][$indice]->total = $_SESSION["carrito"][$indice]->cantidad * $_SESSION["carrito"][$indice]->precio_venta - $descuentoPromocion;
}
header("Location: ./vender.php");
