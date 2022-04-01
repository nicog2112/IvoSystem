<?php

require_once "../../class/Pais.php";

$id_pais = $_POST["txtIdPais"];


$nombrePais = trim($_POST["nombre"]);

        // Queremos que el nombre de usuario sólo tenga letras
if (!preg_match("/^([a-zA-ZÀ-ÿ]{3,40})+( [a-zA-ZÀ-ÿ]+)*$/", $nombrePais)) {
    header("location: listado.php?error=nombrePaisModificar");
	exit;
        }
elseif (strlen($nombrePais) < 3){
	header("location: listado.php?error=nombrePaisModificar");
	exit;
}





$pais = Pais::obtenerPorIdPais($id_pais);

$pais->setDescripcion($nombrePais);

$pais->actualizar();

header("location: listado.php?validacion=true");


?>