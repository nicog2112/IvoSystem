<?php

require_once "../configs.php";
require_once "configuracionSesionUsuario.php";


$mensaje = "";

if (isset($_GET['error'])) {
	$error = $_GET['error'];

	if ($error == ERROR_LOGIN_CODE) {

		$mensaje = ERROR_LOGIN_MENSAJE;

	} else if ($error == MENSAJE_CODE) {

		$mensaje = MENSAJE_NECESITA_LOGIN;
		
	}

}

?>

<?php
require_once "../class/Venta.php";
require_once "../class/DetalleVenta.php";

require_once "../class/ProductoTalle.php";
require_once "../class/TiposImpositivos.php";
require_once "../class/FacturaImpuestos.php";
require_once "../class/PedidoImpuestos.php";
require_once "../class/Cliente.php";


$idPersonaCliente= $usuarioCliente->getIdPersona();
$cliente= Cliente::obtenerPorIdPersona($idPersonaCliente);
$granTotal =$_POST["total"];



session_start();
date_default_timezone_set("America/Argentina/Jujuy");

//Atributos clase venta
 
$total =$granTotal;
$idCliente = $cliente->getIdCliente();
$empleado = "";
$estado = 3;
$promocion = 1;
$ahora = date("Y-m-d H:i:s");



//Clase venta: Insertar
$venta = new Venta();

$venta->setIdCliente($idCliente);
$venta->setIdEmpleado($empleado);
$venta->setIdEstadoPedido($estado);
$venta->setFechaHora($ahora);
$venta->setTotal($total);



$venta->guardarCliente();



$resultado = Venta::obtenerId();



$idVenta = $resultado === false ? 1 : $resultado->getIdVenta();



//$base_de_datos->beginTransaction();
//$sentencia = $base_de_datos->prepare("INSERT INTO detallepedido(id_producto_talle, id_pedido_cliente, cantidad, id_producto_promocion) VALUES (?, ?, ?, ?);");
//$sentenciaExistencia = $base_de_datos->prepare("UPDATE productotalle SET cantidad_disponible = cantidad_disponible - ? WHERE id_producto_talle = ?;");
foreach ($_SESSION["carritoCliente"] as $producto) {
	$total += $producto->subtotal;
	//Clase Detalle Venta: INSERT
	$DetalleVenta = new DetalleVenta();
	$DetalleVenta->setIdProductoTalle($producto->getIdProductoTalle());
	$DetalleVenta->setIdPedidoCliente($idVenta);
	$DetalleVenta->setCantidad($producto->cantidad);
	$DetalleVenta->setPrecio($producto->producto->getPrecioVenta());
	$DetalleVenta->setIdProductoPromocion($promocion);
	$DetalleVenta->guardar();



	//Actualizacion de stock en Clase ProductoTalle
	$idProductoTalle= $producto->getIdProductoTalle();
	$cantidadDisponible= $producto->getCantidadDisponible();
	$cantidad= $producto->cantidad;

	$productoTalle = ProductoTalle::obtenerPorId($idProductoTalle);
	
	
	$productoTalle->setCantidadDisponible ($cantidadDisponible);

	


	$productoTalle->actualizarCantidadDisponible($cantidad);

	
	//$sentenciaExistencia->execute([$producto->cantidad, $producto->id_producto_talle]);
}

// Clase  Pedido Impuestos
	$listadoTiposImpositivos = TiposImpositivos::obtenerPorEstado();
    foreach ($listadoTiposImpositivos as $tiposImpositivos):
       	$idImpuesto= $tiposImpositivos->getIdTiposImpositivos();
       	$valorPorcentajeImpuesto= $tiposImpositivos->getValorPorcentaje();
       					
		$pedidoImpuestos = new PedidoImpuestos();
		$pedidoImpuestos->setValorPorcentaje($valorPorcentajeImpuesto);
		$pedidoImpuestos->setIdTiposImpositivos($idImpuesto);
		$pedidoImpuestos->setIdVenta($idVenta);
	
		$pedidoImpuestos->guardar();
	endforeach;


//$base_de_datos->commit();
unset($_SESSION["carritoCliente"]);
$_SESSION["carritoCliente"] = [];
header("Location: ./carrito.php?status=1");
?>