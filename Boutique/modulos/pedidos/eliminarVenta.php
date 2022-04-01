<?php
require_once "../../class/Venta.php";
require_once "../../class/DetalleVenta.php";
require_once "../../class/ProductoTalle.php";


if(!isset($_GET["id_pedido_cliente"])) exit();
$id = $_GET["id_pedido_cliente"];
$estado = 2;
$venta = Venta::obtenerPorId($id);

$venta->setIdEstadoPedido($estado);

$venta->actualizarEstado();

$listadoDetalleVenta= DetalleVenta::obtenerPorIdVenta($id);

foreach  ($listadoDetalleVenta as $detalleVenta): 
	$idProductoTalle= $detalleVenta->getIdProductoTalle();
	$cantidadDisponible= $detalleVenta->productoTalle->getCantidadDisponible();
	$cantidad= $detalleVenta->getCantidad();

	$productoTalle = ProductoTalle::obtenerPorId($idProductoTalle);
	
	
	$productoTalle->setCantidadDisponible ($cantidadDisponible);

	


	$productoTalle->actualizarSumarCantidadDisponible($cantidad);
endforeach;


	header("Location: ./listado.php");
	
?>