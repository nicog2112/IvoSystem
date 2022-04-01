
<?php 
require_once "../../configuracionSesionUsuario.php";
$conexion=mysqli_connect('localhost','root','','boutique');
$productoId=$_POST['producto'];
$query=$conexion->query("SELECT  talle.descripcion,productotalle.id_producto_talle, productotalle.id_talle,productotalle.cantidad_maxima, productotalle.cantidad_minima,productotalle.cantidad_disponible, producto.id_producto from talle join productotalle on productotalle.id_talle = talle.id_talle 
INNER JOIN producto ON producto.id_producto = productotalle.id_producto WHERE  productotalle.estado = 1 and producto.id_producto = {$productoId}");
$talles = array();
while($r=$query->fetch_object()){ $talles[]=$r; }

$cantidadTalle= 0;
foreach ($talles as $s) {
		$cantidad_disponible = $s->cantidad_disponible;
		$cantidadTalle= $cantidadTalle + $cantidad_disponible;
		
	}

$indice = false;
for ($i = 0; $i < count($_SESSION["carrito"]); $i++) {
    if (($_SESSION["carrito"][$i]->producto->getIdProducto() == $productoId)) {
        $indice = $i;


        break;
    }
}




# Si no existe, lo agregamos como nuevo
if ($indice === false) {
	
	
    echo $cantidadTalle;


} else{
	$cantidad= 0;
	foreach ($_SESSION["carrito"] as $producto) {
		if($producto->producto->getIdProducto() == $productoId){
			$cantidad=$cantidad + $producto->cantidad;
		}
	}
	
	$cantidadTotal= $cantidadTalle - $cantidad;

    echo $cantidadTotal;	
}

?>

