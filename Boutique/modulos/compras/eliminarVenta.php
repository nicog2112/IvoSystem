<?php
require_once "../../class/Compra.php";
require_once "../../class/DetalleCompra.php";
require_once "../../class/ProductoTalle.php";


if(!isset($_GET["id_pedido_proveedor"])) exit();
$id = $_GET["id_pedido_proveedor"];
$estado = 2;
$compra = Compra::obtenerPorId($id);



$compra->setIdEstadoPedido($estado);

$compra->actualizarEstado();

$listadoDetalleCompra= DetalleCompra::obtenerPorIdCompra($id);

foreach  ($listadoDetalleCompra as $detalleCompra): 
	$idProductoTalle= $detalleCompra->getIdProductoTalle();
	$cantidadDisponible= $detalleCompra->productoTalle->getCantidadDisponible();
	$cantidad= $detalleCompra->getCantidad();

	$productoTalle = ProductoTalle::obtenerPorId($idProductoTalle);
	
	
	$productoTalle->setCantidadDisponible ($cantidadDisponible);

	


	$productoTalle->actualizarCantidadDisponible($cantidad);
endforeach;


	header("Location: ./listado.php");
	
?>