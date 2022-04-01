<?php

require_once "../../class/producto.php";


$accion = $_POST['accion'];
$porcentaje = $_POST['porcentajeAplicar'];
$valorFijo=$_POST['valorFijoAplicar']; 
$metodo = $_POST['cboMetodo'];
$metodoActualizar = $_POST['cboMetodoActualizar'];
$categoria = $_POST['categoriaAplicar'];
$temporada = $_POST['temporadaAplicar'];
$marca = $_POST['marcaNuevo'];

if ($metodo == 1){


	$listadoProductoCategoria = Producto::obtenerPorCategoria($categoria);

	foreach  ($listadoProductoCategoria as $productoCategoria): 
		$precioVenta= $productoCategoria->getPrecioVenta();
		if ($metodoActualizar == 1){
			$resultado= $precioVenta * $porcentaje / 100;
		}else{
			$resultado= $valorFijo;
		}
		if($accion == 1){
			$precioNuevo = $precioVenta + $resultado;
		} else{
			$precioNuevo = $precioVenta - $resultado;
		}

		

		$productoCategoria->setPrecioVenta($precioNuevo);


		$productoCategoria->actualizarPrecio();

	endforeach ;
} elseif ($metodo == 2){

	$listadoProductoTemporada = Producto::obtenerPorTemporada($temporada);

	foreach  ($listadoProductoTemporada as $productoTemporada): 
		$precioVenta= $productoTemporada->getPrecioVenta();
		if ($metodoActualizar == 1){
			$resultado= $precioVenta * $porcentaje / 100;
		}else{
			$resultado= $valorFijo;
		}
		if($accion == 1){
			$precioNuevo = $precioVenta + $resultado;
		} else{
			$precioNuevo = $precioVenta - $resultado;
		}

		$productoTemporada->setPrecioVenta($precioNuevo);


		$productoTemporada->actualizarPrecio();

	endforeach ;
} elseif ($metodo == 3){

	$listadoProductoMarca = Producto::obtenerPorMarca($marca);

	foreach  ($listadoProductoMarca as $productoMarca): 
		$precioVenta= $productoMarca->getPrecioVenta();
		if ($metodoActualizar == 1){
			$resultado= $precioVenta * $porcentaje / 100;
		}else{
			$resultado= $valorFijo;
		}
		if($accion == 1){
			$precioNuevo = $precioVenta + $resultado;
		} else{
			$precioNuevo = $precioVenta - $resultado;
		}

		$productoMarca->setPrecioVenta($precioNuevo);


		$productoMarca->actualizarPrecio();

	endforeach ;
}


header("location: listado.php");


?>