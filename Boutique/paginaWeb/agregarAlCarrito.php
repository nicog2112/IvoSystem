<?php
require_once "../class/ProductoTalle.php";


if (!isset($_POST["idProducto"])) {
    return;
}

$idProducto = $_POST["idProducto"];
$cantidad = $_POST["cantidad"];
$talle = $_POST["cboTalle"];
$promocion = $_POST["promocion"];

$producto = ProductoTalle::obtenerPorIdProductoYtalle($idProducto,$talle);
$cantidad_disponible=$producto->getCantidadDisponible();

# Si no existe, salimos y lo indicamos
if (!$producto) {
    header("Location: ./vender.php?status=4&id_producto=".$idProducto);
    exit;
}

# Si no hay existencia...
if ($cantidad_disponible < $cantidad) {
    header("Location: ./productoDetalle.php?status=5&id_producto=".$idProducto);
    exit;
}
session_start();

# Buscar producto dentro del carrito
$indice = false;
for ($i = 0; $i < count($_SESSION["carritoCliente"]); $i++) {
    if (($_SESSION["carritoCliente"][$i]->producto->getIdProducto() == $idProducto) and ($_SESSION["carritoCliente"][$i]->getIdTalle() == $talle)) {
        $indice = $i;


        break;
    }
}


# Si no existe, lo agregamos como nuevo
if ($indice === false) {
    $producto->cantidad = $cantidad;
    $descuentoPromocion = ($producto->producto->getPrecioVenta() * $cantidad) * ($promocion / 100);
    $producto->subtotal = ($producto->producto->getPrecioVenta() * $cantidad) - $descuentoPromocion;

    array_push($_SESSION["carritoCliente"], $producto);


} else {
# Si ya existe, se agrega la cantidad
# Pero espera, tal vez ya no haya
    $cantidadExistente = $_SESSION["carritoCliente"][$indice]->cantidad;
# si al sumarle uno supera lo que existe, no se agrega
    if ($cantidadExistente + $cantidad > $producto->getCantidadDisponible()) {

        header("Location: ./productoDetalle.php?status=5&id_producto=".$idProducto);
        exit;
    }

    $_SESSION["carritoCliente"][$indice]->cantidad = $cantidadExistente + $cantidad ;
    $descuentoPromocion = ($producto->getPrecioVenta() * $_SESSION["carritoCliente"][$indice]->cantidad) * ($promocion / 100);
    $_SESSION["carritoCliente"][$indice]->subtotal = $_SESSION["carritoCliente"][$indice]->cantidad * $_SESSION["carritoCliente"][$indice]->producto->getPrecioVenta() - $descuentoPromocion;


}

header("Location: ./productoDetalle.php?id_producto=".$idProducto);
