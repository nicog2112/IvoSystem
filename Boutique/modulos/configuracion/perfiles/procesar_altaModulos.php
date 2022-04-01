<?php

require_once "../../../class/PerfilModulo.php";


$id_perfil = $_POST["txtIdPerfil"];
if(isset($_POST['chkl'])){
    $modulos = $_POST['chkl'];
}else{
    $modulos = "";#default value
}

$perfilModulo = PerfilModulo::obtenerPorIdPerfiles($id_perfil);


if($perfilModulo > 0){
		$perfilModulo->eliminar();
	}


foreach ($modulos as $moduloId) {
	// echo $moduloId . "<br>";
	// clase PerfilModulo == tabla intermedia
	// new PerfilModulo, asignar valores
	// PerfilModulo guardar()




$perfilModulos = new PerfilModulo();

$perfilModulos->setIdPerfil($id_perfil);
$perfilModulos->setIdModulo($moduloId);


$perfilModulos->guardar();
};

header("location: listado.php?validacion=true");


?>