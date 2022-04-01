<?php
require_once "../../class/ProductoTalle.php";


if (!isset($_POST["idProducto"])) {
    return;
}

$idProducto = $_POST["idProducto"];
$cantidad = $_POST["cantidad"];
$talle = $_POST["cboTalle"];
$promocion = $_POST["promocion"];

$producto = ProductoTalle::obtenerPorIdProductoYtalle($idProducto,$talle);
$cantidad_disponible=$producto->getCantidadDisponible();

# Si SELECT ES NULO
if ($idProducto == "NULL" || $talle == "NULL") {
    header("Location: ./vender.php?status=7");
    exit;
}
# Si cantidad es igual a 0
if ($cantidad < 1 || $cantidad == "") {
    header("Location: ./vender.php?status=6");
    exit;
}
# Si no existe, salimos y lo indicamos
if (!$producto) {
    header("Location: ./vender.php?status=4");
    exit;
}

# Si no hay existencia...
if ($cantidad_disponible < $cantidad) {
    header("Location: ./vender.php?status=5");
    exit;
}
session_start();

# Buscar producto dentro del carrito
$indice = false;
for ($i = 0; $i < count($_SESSION["carrito"]); $i++) {
    if (($_SESSION["carrito"][$i]->producto->getIdProducto() == $idProducto) and ($_SESSION["carrito"][$i]->getIdTalle() == $talle)) {
        $indice = $i;


        break;
    }
}


# Si no existe, lo agregamos como nuevo
if ($indice === false) {
    $producto->cantidad = $cantidad;
    $descuentoPromocion = ($producto->producto->getPrecioVenta() * $cantidad) * ($promocion / 100);
    $producto->subtotal = ($producto->producto->getPrecioVenta() * $cantidad) - $descuentoPromocion;

    array_push($_SESSION["carrito"], $producto);


} else {
# Si ya existe, se agrega la cantidad
# Pero espera, tal vez ya no haya
    $cantidadExistente = $_SESSION["carrito"][$indice]->cantidad;
# si al sumarle uno supera lo que existe, no se agrega
    if ($cantidadExistente + $cantidad > $producto->getCantidadDisponible()) {

        header("Location: ./vender.php?status=5");
        exit;
    }

    $_SESSION["carrito"][$indice]->cantidad = $cantidadExistente + $cantidad ;
    $descuentoPromocion = ($producto->getPrecioVenta() * $_SESSION["carrito"][$indice]->cantidad) * ($promocion / 100);
    $_SESSION["carrito"][$indice]->subtotal = $_SESSION["carrito"][$indice]->cantidad * $_SESSION["carrito"][$indice]->producto->getPrecioVenta() - $descuentoPromocion;


}

header("Location: ./vender.php");
