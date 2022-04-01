<?php

require_once "../../class/Persona.php";
require_once "../../class/Empleado.php";
require_once "../../class/Cliente.php";

date_default_timezone_set('america/argentina/buenos_aires');
$fecha_actual = date("Y-m-d");

$nombre = trim($_POST['nombrePersona']);
$apellido = trim($_POST['apellidoPersona']);
$fechaNacimiento = $_POST['fechaNacimientoPersona'];
$sexo = $_POST['sexoPersona'];
$nacionalidad = trim($_POST['nacionalidadPersona']);
$estado = 1;
$dni = trim($_POST['dniPersona']);


$fecha_actual = date("Y-m-d");
$fecha_nacimiento = strtotime($fechaNacimiento);
        // Queremos que el nombre de usuario sólo tenga letras
if (!preg_match("/^([a-zA-ZÀ-ÿ]{3,20})+( [a-zA-ZÀ-ÿ]+)*$/", $nombre)) {
    header("location: listado.php?error=nombrePersonaNuevo");
	exit;
}elseif (!preg_match("/^([a-zA-ZÀ-ÿ]{3,20})+( [a-zA-ZÀ-ÿ]+)*$/", $apellido)) {
	header("location: listado.php?error=apellidoPersonaNuevo");
	exit;
}elseif (!preg_match("/^\d{8,11}$/", $dni)) {
	header("location: listado.php?error=dniPersonaNuevo");
	exit;
}elseif (!preg_match("/^([a-zA-ZÀ-ÿ]{0,20})+( [a-zA-ZÀ-ÿ]+)*$/", $nacionalidad)) {
	header("location: listado.php?error=nacionalidadPersonaNuevo");
	exit;
} 
/*if (!preg_match("/^[a-zA-Z]+/", $nombre)) {
    header("location: listado.php?error=nombre");
	exit;
        }
elseif (strlen($nombre) < 3){
	header("location: listado.php?error=nombre");
	exit;
}
elseif (!preg_match("/^[a-zA-Z]+/", $apellido)) {
    header("location: listado.php?error=apellido");
	exit;
        }
elseif (strlen($apellido)< 3 ){
	header("location: listado.php?error=apellido");
	exit;
}
elseif (strlen($dni) > 8  ){
	header("location: listado.php?error=dni");
	exit;
}
elseif (!preg_match("/^[a-zA-Z]+/", $nacionalidad)) {
    header("location: listado.php?error=nacionalidad");
	exit;
        }
elseif (strlen($nacionalidad) < 5  ){
	header("location: listado.php?error=nacionalidad");
	exit;
}

elseif ($fechaNacimiento > $fecha_actual) {
    header("location: listado.php?error=fechaNacimiento");
	exit;
}*/

$personaDNI = Persona::obtenerPorDNI($dni);

 if(count($personaDNI)>0){
        header("location: listado.php?error=dniExistente");
        exit;
 		//echo 'el user ya esta registrado, ingresa otro';
	//exit;
}

$persona = new Persona();

$persona->setNombre($nombre);
$persona->setApellido($apellido);
$persona->setFechaNacimiento($fechaNacimiento);
$persona->setIdSexo($sexo);
$persona->setDni($dni);
$persona->setEstado($estado);
$persona->setNacionalidad($nacionalidad);

$persona->guardar();

$ultimaPersona= Persona::obtenerIdPersona();
$idPersona= $ultimaPersona->getIdPersona();


if(isset($_POST['checkCliente'])){
    $checkCliente = $_POST['checkCliente'];
    $cliente = new Cliente();


	$cliente->setIdPersona($idPersona);
	$cliente->setFechaAlta($fecha_actual);


	$cliente->guardar();
}
if(isset($_POST['checkEmpleado'])){
    $checkEmpleado = $_POST['checkEmpleado'];
    $numeroLegajo= $_POST['legajoNuevo'];
    if (!preg_match("/^\d{0,11}$/", $numeroLegajo)) {
	header("location: listado.php?error=legajoNuevo");
	exit;
};
   	$Empleado = new Empleado();
   	$Empleado->setIdPersona($idPersona);
   	$Empleado->setFechaAlta($fecha_actual);
   	$Empleado->setNumeroLegajo($numeroLegajo);


	$Empleado->guardar();

}
if(isset($_POST['checkPreventista'])){
    $checkPreventista = $_POST['checkPreventista'];
}


header("location: listado.php");


?>