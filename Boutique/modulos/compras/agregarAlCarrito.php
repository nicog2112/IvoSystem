<?php
require_once "../../class/ProductoTalle.php";


if (!isset($_POST["idProducto"])) {
    return;
}

$idProducto = $_POST["idProducto"];
$cantidad = $_POST["cantidad"];
$talle = $_POST["cboTalle"];
$precioCompra = $_POST["precioCompra"];

# Si SELECT ES NULO
if ($idProducto == "NULL" || $talle == "NULL") {
    header("Location: ./comprar.php?status=7");
    exit;
}
# Si cantidad es igual a 0
if ($cantidad < 1 || $cantidad == "") {
    header("Location: ./comprar.php?status=6");
    exit;
}

# Si cantidad es igual a 0
if ($precioCompra < 1 || $precioCompra == "") {
    header("Location: ./comprar.php?status=8");
    exit;
}

$producto = ProductoTalle::obtenerPorIdProductoYtalle($idProducto,$talle);
$cantidad_disponible=$producto->getCantidadDisponible();
$cantidad_maxima= $producto->getCantidadMaxima();

# Si no existe, salimos y lo indicamos
if (!$producto) {
    header("Location: ./comprar.php?status=4");
    exit;
}


$suma= $cantidad_disponible + $cantidad;
if ($suma > $cantidad_maxima ) {
    header("Location: ./comprar.php?status=5");
    exit;
}
session_start();

# Buscar producto dentro del carrito
$indice = false;
for ($i = 0; $i < count($_SESSION["carritoProveedor"]); $i++) {
    if (($_SESSION["carritoProveedor"][$i]->producto->getIdProducto() == $idProducto) and ($_SESSION["carritoProveedor"][$i]->getIdTalle() == $talle)) {
        $indice = $i;


        break;
    }
}


# Si no existe, lo agregamos como nuevo
if ($indice === false) {
    $producto->precioDeCompra = $precioCompra;
    $producto->cantidad = $cantidad;
   
    $producto->subtotal = ($precioCompra * $cantidad);


    array_push($_SESSION["carritoProveedor"], $producto);


} else {
# Si ya existe, se agrega la cantidad
# Pero espera, tal vez ya no haya
    $cantidadExistente = $_SESSION["carritoProveedor"][$indice]->cantidad;
# si al sumarle uno supera lo que existe, no se agrega
    if ($cantidadExistente + $cantidad+$cantidad_disponible  > $producto->getCantidadMaxima()) {

        header("Location: ./comprar.php?status=5");
        exit;
    }
    $_SESSION["carritoProveedor"][$indice]->precioDeCompra = $precioCompra ;
   
    $_SESSION["carritoProveedor"][$indice]->cantidad = $cantidadExistente + $cantidad ;
   
    $_SESSION["carritoProveedor"][$indice]->subtotal = $_SESSION["carritoProveedor"][$indice]->cantidad * $_SESSION["carritoProveedor"][$indice]->precioDeCompra;


}

header("Location: ./comprar.php");
