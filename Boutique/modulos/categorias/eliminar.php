<?php

require_once "../../class/Categoria.php";
require_once "../../class/Producto.php";

$idCategoria = $_GET['id'];

$categoria = Categoria::obtenerPorId($idCategoria);
$lista = Producto::obtenerPorCategoria($idCategoria);

$categoria->eliminar();

foreach  ($lista as $Producto):
$Producto->eliminarCategoria();
endforeach;



header("location: listado.php");

?>