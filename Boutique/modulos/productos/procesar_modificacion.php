<?php

require_once "../../class/producto.php";

$nombreImagen = $_FILES['imagenModificar']['name'];// obtiene el nombre
$archivo = $_FILES['imagenModificar']['tmp_name'];// obtiene el archivo
$ruta ="Imagenes";

$ruta=$ruta."/".$nombreImagen;// imagenes/nombreImagen.jpg
move_uploaded_file($archivo, $ruta);

$id_producto = $_POST["txtIdProducto"];
$nombreProducto= $_POST['nombreProductoModificar'];
$marca = $_POST['marcaProductoModificar'];
$descripcion = $_POST['descripcionProductoModificar'];
$precioCompra = $_POST['precioCompraModificar'];
$precioVenta = $_POST['precioVentaModificar'];
$idTemporada = $_POST['nombreTemporadaModificar'];
$idCategoria = $_POST['nombreCategoriaModificar'];



if (!preg_match("/^([a-zA-ZÀ-ÿ]{3,40})+( [a-zA-ZÀ-ÿ]+)*$/", $nombreProducto)) {
    header("location: listado.php?error=nombreProductoModificar");
	exit;
 }
elseif (!preg_match("/^([a-zA-ZÀ-ÿ]{3,40})+( [a-zA-ZÀ-ÿ]+)*$/", $marca)) {
	header("location: listado.php?error=marcaModificar");
	exit;
}
elseif (!preg_match("/^([a-zA-ZÀ-ÿ]{3,80})+( [a-zA-ZÀ-ÿ]+)*$/", $descripcion)) {
	header("location: listado.php?error=marcaModificar");
	exit;
}
elseif (!preg_match("/^\d{1,5}$/", $precioCompra)) {
	header("location: listado.php?error=precioCompraModificar");
	exit;
}
elseif (!preg_match("/^\d{1,5}$/", $precioVenta)) {
	header("location: listado.php?error=precioVentaModificar");
	exit;
}


$producto = Producto::obtenerPorId($id_producto);

$producto->setImagen($ruta);
$producto->setNombreProducto($nombreProducto);
$producto->setMarca($marca);
$producto->setDescripcion($descripcion);
$producto->setPrecioCompra($precioCompra);
$producto->setPrecioVenta($precioVenta);
$producto->setIdTemporada($idTemporada);
$producto->setIdCategoria($idCategoria);

$producto->actualizar();


header("location: listado.php");


?>