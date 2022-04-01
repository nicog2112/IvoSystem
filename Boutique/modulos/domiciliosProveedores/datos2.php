<?php 
$conexion=mysqli_connect('localhost','root','','boutique');
$provincia=$_POST['provincia'];
$query=$conexion->query("SELECT * FROM localidades WHERE id_provincia={$provincia}");
$states = array();
while($r=$query->fetch_object()){ $states[]=$r; }
if(count($states)>0){
print "<option value=''>-- SELECCIONE --</option>";
foreach ($states as $s) {
	print "<option value='$s->id_localidad'>$s->descripcion</option>";
}
}else{
print "<option value=''>-- NO HAY DATOS --</option>";
}
?>