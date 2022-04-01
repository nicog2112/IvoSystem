<?php

require_once "../../class/Pais.php";

$nombrePais = trim($_POST['txtNombrePais']);


if (strlen($nombrePais) < 3){
	header("location: nuevo.php?error=nombrePais");
	exit;
}
//if (trim($nombreCategoria) == ""){
//	echo "error nombre de la categoria vacio";
//	exit;
//}


$pais = new Pais();

$pais->setDescripcion ($nombrePais);



$pais->guardar();

header("location: ../../modulos/domicilios/domicilios.php");


?>