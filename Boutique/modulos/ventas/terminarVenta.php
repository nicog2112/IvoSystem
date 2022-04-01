<?php
if(!isset($_POST["total"])) exit;


session_start();


$total = $_POST["total"];
$cliente = $_POST["cliente"];
$empleado = $_POST["Empleado"];
$estado = $_POST["estado"];
$promocion = $_POST["promocion"];
include_once "base_de_datos.php";


$ahora = date("Y-m-d H:i:s");


$sentencia = $base_de_datos->prepare("INSERT INTO pedidoclente(id_cliente,id_Empleado,id_estado_pedido,fecha_hora, total) VALUES (?, ?, ?, ?, ?);");


$sentencia->execute([$cliente,$empleado,$estado,$ahora, $total]);


$sentencia = $base_de_datos->prepare("SELECT id_pedido_cliente FROM pedidoclente ORDER BY id_pedido_cliente DESC LIMIT 1;");
$sentencia->execute();
$resultado = $sentencia->fetch(PDO::FETCH_OBJ);

$idVenta = $resultado === false ? 1 : $resultado->id_pedido_cliente;

$base_de_datos->beginTransaction();
$sentencia = $base_de_datos->prepare("INSERT INTO detallepedido(id_producto_talle, id_pedido_cliente, cantidad, id_producto_promocion) VALUES (?, ?, ?, ?);");
$sentenciaExistencia = $base_de_datos->prepare("UPDATE productotalle SET cantidad_disponible = cantidad_disponible - ? WHERE id_producto_talle = ?;");
foreach ($_SESSION["carrito"] as $producto) {
	$total += $producto->total;
	$sentencia->execute([$producto->id_producto_talle, $idVenta, $producto->cantidad, $promocion]);
	$sentenciaExistencia->execute([$producto->cantidad, $producto->id_producto_talle]);
}
$base_de_datos->commit();
unset($_SESSION["carrito"]);
$_SESSION["carrito"] = [];
header("Location: ./vender.php?status=1");
?>