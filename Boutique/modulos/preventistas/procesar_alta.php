<?php

require_once "../../class/Preventista.php";
$persona = $_POST['personaAñadir'];

$proveedor = $_POST['txtIdProveedor'];

if($persona == "NULL") {
       header("location: listado.php?id_proveedor=". $proveedor."&error=select");
       exit;

       
     } ;



$preventista = new Preventista();


$preventista->setIdPersona($persona);
$preventista->setIdProveedor($proveedor);

$preventista->guardar();

header("location: listado.php?id_proveedor=". $proveedor);


?>