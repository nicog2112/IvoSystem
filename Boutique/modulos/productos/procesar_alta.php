<?php

require_once "../../class/producto.php";

$nombreImagen = $_FILES['imagenProductoNuevo']['name'];// obtiene el nombre
$archivo = $_FILES['imagenProductoNuevo']['tmp_name'];// obtiene el archivo
$ruta ="Imagenes";

$ruta=$ruta."/".$nombreImagen;// imagenes/nombreImagen.jpg
move_uploaded_file($archivo, $ruta);

$nombreProducto= $_POST['nombreProductoNuevo'];
$marca = $_POST['marcaProductoNuevo'];
$descripcion = $_POST['descripcionProductoNuevo'];
$precioCompra = $_POST['precioCompraNuevo'];
$precioVenta = $_POST['precioVentaNuevo'];
$idTemporada = $_POST['temporadaNuevo'];
$idCategoria = $_POST['nombreCategoria'];

if (!preg_match("/^([a-zA-ZÀ-ÿ]{3,40})+( [a-zA-ZÀ-ÿ]+)*$/", $nombreProducto)) {
    header("location: listado.php?error=nombreProductoAñadir");
	exit;
 }
elseif (!preg_match("/^([a-zA-ZÀ-ÿ]{3,40})+( [a-zA-ZÀ-ÿ]+)*$/", $marca)) {
	header("location: listado.php?error=marcaAñadir");
	exit;
}
elseif (!preg_match("/^([a-zA-ZÀ-ÿ]{3,80})+( [a-zA-ZÀ-ÿ]+)*$/", $descripcion)) {
	header("location: listado.php?error=descripcionAñadir");
	exit;
}
elseif (!preg_match("/^\d{1,5}$/", $precioCompra)) {
	header("location: listado.php?error=precioCompraAñadir");
	exit;
}
elseif (!preg_match("/^\d{1,5}$/", $precioVenta)) {
	header("location: listado.php?error=precioVentaAñadir");
	exit;
}


$producto = new producto();

$producto->setImagen($ruta);
$producto->setNombreProducto($nombreProducto);
$producto->setMarca($marca);
$producto->setDescripcion($descripcion);
$producto->setPrecioCompra($precioCompra);
$producto->setPrecioVenta($precioVenta);
$producto->setIdTemporada($idTemporada);
$producto->setIdCategoria($idCategoria);

$producto->guardar();

header("location: listado.php");


?>