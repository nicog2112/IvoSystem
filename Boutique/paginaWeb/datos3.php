
<?php 

require_once "../class/ProductoTalle.php";
session_start();
if(!isset($_SESSION["carritoCliente"])) $_SESSION["carritoCliente"] = [];
			$granTotal = 0;

$conexion=mysqli_connect('localhost','root','','boutique');
$productoId=$_POST['producto'];
$talle=$_POST['talle'];
$query=$conexion->query("SELECT  talle.descripcion,productotalle.id_producto_talle, productotalle.id_talle,productotalle.cantidad_maxima, productotalle.cantidad_minima,productotalle.cantidad_disponible, producto.id_producto from talle join productotalle on productotalle.id_talle = talle.id_talle 
INNER JOIN producto ON producto.id_producto = productotalle.id_producto WHERE  productotalle.estado = 1 and producto.id_producto =".$productoId." and productotalle.id_talle =".$talle);
$talles = array();
while($r=$query->fetch_object()){ $talles[]=$r; }
$cantidadTalle= 0;
foreach ($talles as $s) {
		$cantidad_disponible = $s->cantidad_disponible;
		$cantidadTalle= $cantidadTalle + $cantidad_disponible;
		
	}

$indice = false;
for ($i = 0; $i < count($_SESSION["carritoCliente"]); $i++) {
    if (($_SESSION["carritoCliente"][$i]->producto->getIdProducto() == $productoId) and ($_SESSION["carritoCliente"][$i]->getIdTalle() == $talle)) {
        $indice = $i;


        break;
    }
}


# Si no existe, lo agregamos como nuevo
if ($indice === false) {
	
	
    echo $cantidadTalle;


} else{
	$cantidad= $_SESSION["carritoCliente"][$indice]->cantidad;
	
	$cantidadTotal= $cantidadTalle - $cantidad;

    echo $cantidadTotal;	
}















/*


foreach($_SESSION["carrito"] as $indice => $producto){ 
    $id = $producto->getIdProducto();
    $talleId= $producto->getIdTalle();
 	$cantidadExistente= $producto->getCantidadDisponible();   
    if($id = $productoId && $talleId = $talle){
 
		echo $talle;                
   
} 
} 

$cantidad= 0;
if(count($talles)>0){
	
	foreach ($talles as $s) {
		$cantidad_disponible = $s->cantidad_disponible;
		$cantidad= $cantidad + $cantidad_disponible;
		
	}
	print $cantidad;
}else{
	print $cantidad;
}*/
?>
