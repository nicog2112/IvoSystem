<?php

require_once "../../class/Categoria.php";

$idCategoria = $_GET['id_categoria'];

$categoria = Categoria::obtenerPorId($idCategoria);
$categoria->eliminar();

header("location: listado.php");

?>