<?php
require_once "../../class/Venta.php";
require_once "../../class/DetalleVenta.php";
require_once "../../class/Factura.php";
require_once "../../class/DetalleFactura.php";
require_once "../../class/ProductoTalle.php";
require_once "../../class/TiposImpositivos.php";
require_once "../../class/FacturaImpuestos.php";



//Atributos clase venta
$idVenta= $_POST["idVenta"];
$total = $_POST["total"];
$cliente = $_POST["cliente"];
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



//Clase Factura: Insertar
$factura= new Factura();

$factura->setIdEstadosPagos($idEstadoPago);
$factura->setIdTipoFactura($idTipoFactura);
$factura->setNumeracion($numeracion);
$factura->setFechaEmision($fechaEmision);



$factura->guardar();



$resultadoFactura = Factura::obtenerId();
$idFactura = $resultadoFactura === false ? 1 : $resultadoFactura->getIdFactura();

$listadoDetalleVenta=DetalleVenta::obtenerPorIdVenta($idVenta);
//$base_de_datos->beginTransaction();
//$sentencia = $base_de_datos->prepare("INSERT INTO detallepedido(id_producto_talle, id_pedido_cliente, cantidad, id_producto_promocion) VALUES (?, ?, ?, ?);");
//$sentenciaExistencia = $base_de_datos->prepare("UPDATE productotalle SET cantidad_disponible = cantidad_disponible - ? WHERE id_producto_talle = ?;");

foreach ($listadoDetalleVenta as $detalleVenta) {


	// Clase detalle factura
	$detalleFactura = new DetalleFactura();
	$detalleFactura->setIdDetallePedido($detalleVenta->getIdDetalleVenta());
	$detalleFactura->setIdFactura($idFactura);
	
	$detalleFactura->guardar();


	
}

// Clase  factura Impuestos

$venta = Venta::obtenerPorId($idVenta);


$venta->setIdEstadoPedido($estado);

$venta->actualizarEstado();

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


header("Location: ./listado.php?status=1");
?>