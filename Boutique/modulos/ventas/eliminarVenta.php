<?php
if(!isset($_GET["id"])) exit();
$id = $_GET["id"];
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("DELETE FROM pedidoclente WHERE id_pedido_cliente = ?;");
$resultado = $sentencia->execute([$id]);
if($resultado === TRUE){
	header("Location: ./ventas.php");
	exit;
}
else echo "Algo salió mal";
?>