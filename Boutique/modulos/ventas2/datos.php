
<?php 
$conexion=mysqli_connect('localhost','root','','boutique');
$producto=$_POST['producto'];
$query=$conexion->query("SELECT  talle.descripcion,productotalle.id_producto_talle, productotalle.id_talle,productotalle.cantidad_maxima, productotalle.cantidad_minima,productotalle.cantidad_disponible, producto.id_producto from talle join productotalle on productotalle.id_talle = talle.id_talle 
INNER JOIN producto ON producto.id_producto = productotalle.id_producto WHERE productotalle.estado = 1 and producto.id_producto = {$producto}");

$talles = array();
while($r=$query->fetch_object()){ $talles[]=$r; }
if(count($talles)>0){
	print "<option value='NULL'>-- SELECCIONE --</option>";
	foreach ($talles as $s) {
		print "<option value='$s->id_talle'>$s->descripcion</option>";
	}
}else{
	print "<option value='NULL'>-- SELECCIONE --</option>";
}
?>

