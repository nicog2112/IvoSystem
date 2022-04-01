<?php
require_once "../../class/Venta.php";
require_once "../../class/DetalleVenta.php";
require_once "../../class/Factura.php";
require_once "../../class/DetalleFactura.php";
require_once "../../class/ProductoTalle.php";
require_once "../../class/TiposImpositivos.php";
require_once "../../class/FacturaImpuestos.php";

if(!isset($_POST["total"])) exit;


session_start();
date_default_timezone_set("America/Argentina/Jujuy");

//Atributos clase venta
$total = $_POST["total"];
$cliente = $_POST["cliente"];
$empleado = $_POST["Empleado"];
$estado = $_POST["estado"];
$promocion =$_POST["promocion"];;

$ahora = date("Y-m-d H:i:s");

//Atributos clase Factura
$numeracion=$_POST["numeracion"];
$fechaEmision=date("Y-m-d H:i:s");
$idEstadoPago=$_POST["estadosPagos"];;
$idTipoFactura=$_POST["tipoFactura"];;

//Atributos clase Detalle Factura
$idFacturaDetalle="";
$idDetallePedido="";
$idFactura="";

//Clase venta: Insertar
$venta = new Venta();

$venta->setIdCliente($cliente);
$venta->setIdEmpleado($empleado);
$venta->setIdEstadoPedido($estado);
$venta->setFechaHora($ahora);
$venta->setTotal($total);



$venta->guardar();

//Clase Factura: Insertar
$factura= new Factura();

$factura->setIdEstadosPagos($idEstadoPago);
$factura->setIdTipoFactura($idTipoFactura);
$factura->setNumeracion($numeracion);
$factura->setFechaEmision($fechaEmision);



$factura->guardar();


$resultado = Venta::obtenerId();
$resultadoFactura = Factura::obtenerId();



$idVenta = $resultado === false ? 1 : $resultado->getIdVenta();
$idFactura = $resultadoFactura === false ? 1 : $resultadoFactura->getIdFactura();


//$base_de_datos->beginTransaction();
//$sentencia = $base_de_datos->prepare("INSERT INTO detallepedido(id_producto_talle, id_pedido_cliente, cantidad, id_producto_promocion) VALUES (?, ?, ?, ?);");
//$sentenciaExistencia = $base_de_datos->prepare("UPDATE productotalle SET cantidad_disponible = cantidad_disponible - ? WHERE id_producto_talle = ?;");
foreach ($_SESSION["carrito"] as $producto) {
	$total += $producto->subtotal;
	//Clase Detalle Venta: INSERT
	$DetalleVenta = new DetalleVenta();
	$DetalleVenta->setIdProductoTalle($producto->getIdProductoTalle());
	$DetalleVenta->setIdPedidoCliente($idVenta);
	$DetalleVenta->setCantidad($producto->cantidad);
	$DetalleVenta->setPrecio($producto->producto->getPrecioVenta());
	$DetalleVenta->setIdProductoPromocion($promocion);
	$DetalleVenta->guardar();

	// Clase detalle factura
	$resultadoDetalleVenta = DetalleVenta::obtenerId();
	$idDetalleVenta = $resultadoDetalleVenta === false ? 1 : $resultadoDetalleVenta->getIdDetalleVenta();
	$detalleFactura = new DetalleFactura();
	$detalleFactura->setIdDetallePedido($idDetalleVenta);
	$detalleFactura->setIdFactura($idFactura);
	
	$detalleFactura->guardar();


	//Actualizacion de stock en Clase ProductoTalle
	$idProductoTalle= $producto->getIdProductoTalle();
	$cantidadDisponible= $producto->getCantidadDisponible();
	$cantidad= $producto->cantidad;

	$productoTalle = ProductoTalle::obtenerPorId($idProductoTalle);
	
	
	$productoTalle->setCantidadDisponible ($cantidadDisponible);

	


	$productoTalle->actualizarCantidadDisponible($cantidad);

	
	//$sentenciaExistencia->execute([$producto->cantidad, $producto->id_producto_talle]);
}

// Clase  factura Impuestos
	$listadoTiposImpositivos = TiposImpositivos::obtenerPorEstado();
    foreach ($listadoTiposImpositivos as $tiposImpositivos):
       	$idImpuesto= $tiposImpositivos->getIdTiposImpositivos();
       	$valorPorcentajeImpuesto= $tiposImpositivos->getValorPorcentaje();
       					
		$facturaImpuestos = new FacturaImpuestos();
		$facturaImpuestos->setValorPorcentaje($valorPorcentajeImpuesto);
		$facturaImpuestos->setIdTiposImpositivos($idImpuesto);
		$facturaImpuestos->setIdFactura($idFactura);
	
		$facturaImpuestos->guardar();
	endforeach;

//$base_de_datos->commit();
unset($_SESSION["carrito"]);
$_SESSION["carrito"] = [];
header("Location: ./vender.php?status=1");
?>