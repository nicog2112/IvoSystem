
<?php 
$conexion=mysqli_connect('localhost','root','','boutique');
$pais=$_POST['pais'];
$query=$conexion->query("SELECT * FROM provincia WHERE id_pais={$pais}");
$states = array();
while($r=$query->fetch_object()){ $states[]=$r; }
if(count($states)>0){
print "<option value='0'>-- SELECCIONE --</option>";
foreach ($states as $s) {
	print "<option value='$s->id_provincia'>$s->descripcion</option>";
}
}else{
print "<option value=''>-- SELECCIONE --</option>";
}
?>