<?php 
$conexion=mysqli_connect('localhost','root','','boutique');
$localidad=$_POST['localidad'];
$query=$conexion->query("SELECT * FROM barrios WHERE id_localidad={$localidad}");
$states = array();
while($r=$query->fetch_object()){ $states[]=$r; }
if(count($states)>0){
print "<option value=''>-- SELECCIONE --</option>";
foreach ($states as $s) {
	print "<option value='$s->id_barrio'>$s->descripcion</option>";
}
}else{
print "<option value=''>-- NO HAY DATOS --</option>";
}
?>