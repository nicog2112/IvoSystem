<?php
require_once "../../class/Compra.php";
require_once "../../class/DetalleCompra.php";
require_once "../../class/Factura.php";
require_once "../../class/DetalleFactura.php";
require_once "../../class/ProductoTalle.php";
require_once "../../class/Producto.php";
require_once "../../class/TiposImpositivos.php";
require_once "../../class/FacturaImpuestos.php";

if(!isset($_POST["total"])) exit;


session_start();
date_default_timezone_set("America/Argentina/Jujuy");

//Atributos clase Compra
$total = $_POST["total"];
$proveedor = $_POST["proveedor"];
$empleado = $_POST["Empleado"];
$estado = $_POST["estado"];

$ahora = date("Y-m-d H:i:s");


//Clase compra: Insertar
$compra = new Compra();

$compra->setIdProveedor($proveedor);
$compra->setIdEmpleado($empleado);
$compra->setIdEstadoPedido($estado);
$compra->setFechaHora($ahora);
$compra->setTotal($total);



$compra->guardar();



$resultado = Compra::obtenerId();



$idCompra = $resultado === false ? 1 : $resultado->getIdCompra();




//$base_de_datos->beginTransaction();
//$sentencia = $base_de_datos->prepare("INSERT INTO detallepedido(id_producto_talle, id_pedido_cliente, cantidad, id_producto_promocion) VALUES (?, ?, ?, ?);");
//$sentenciaExistencia = $base_de_datos->prepare("UPDATE productotalle SET cantidad_disponible = cantidad_disponible - ? WHERE id_producto_talle = ?;");
foreach ($_SESSION["carritoProveedor"] as $producto) {
	$total += $producto->subtotal;
	//Clase Detalle Venta: INSERT
	$DetalleCompra = new DetalleCompra();
	$DetalleCompra->setIdProductoTalle($producto->getIdProductoTalle());
	$DetalleCompra->setIdPedidoProveedor($idCompra);
	$DetalleCompra->setCantidad($producto->cantidad);
	$DetalleCompra->setPrecio($producto->producto->getPrecioCompra());
	$DetalleCompra->guardar();

	


	//Actualizacion de stock en Clase ProductoTalle
	$idProductoTalle= $producto->getIdProductoTalle();
	$cantidadDisponible= $producto->getCantidadDisponible();
	$cantidad= $producto->cantidad;
	$precioCompra= $producto->precioDeCompra;

	$productoTalle = ProductoTalle::obtenerPorId($idProductoTalle);
	
	$id_producto= $productoTalle->getIdProducto();

	$productoTabla= Producto::obtenerPorId($id_producto);

	$productoTabla->actualizarPrecioCompra($precioCompra);
	$productoTalle->setCantidadDisponible ($cantidadDisponible);

	


	$productoTalle->actualizarSumarCantidadDisponible($cantidad);

	
	//$sentenciaExistencia->execute([$producto->cantidad, $producto->id_producto_talle]);
}



//$base_de_datos->commit();
unset($_SESSION["carritoProveedor"]);
$_SESSION["carritoProveedor"] = [];
header("Location: ./comprar.php?status=1");
?>