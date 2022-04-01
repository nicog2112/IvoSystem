<?php

require_once "../class/Persona.php";
require_once "../class/Cliente.php";
require_once "../class/Usuario.php";

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
    header("location: registroLogin.php?errorRegistro=nombrePersonaNuevo");
	exit;
}elseif (!preg_match("/^([a-zA-ZÀ-ÿ]{3,20})+( [a-zA-ZÀ-ÿ]+)*$/", $apellido)) {
	header("location: registroLogin.php?errorRegistro=apellidoPersonaNuevo");
	exit;
}elseif (!preg_match("/^\d{8,11}$/", $dni)) {
	header("location: registroLogin.php?errorRegistro=dniPersonaNuevo");
	exit;
}elseif (!preg_match("/^([a-zA-ZÀ-ÿ]{0,20})+( [a-zA-ZÀ-ÿ]+)*$/", $nacionalidad)) {
	header("location: registroLogin.php?errorRegistro=nacionalidadPersonaNuevo");
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
        header("location: registroLogin.php?errorRegistro=dniExistente");
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



$cliente = new Cliente();

$cliente->setIdPersona($idPersona);
$cliente->setFechaAlta($fecha_actual);


$cliente->guardar();



$conexion=mysqli_connect('localhost','root','','boutique');

$perfil = 3;

$username = $_POST['username'];
$password = $_POST['password'];
$nombreImagen = $_FILES['Imagen']['name'];// obtiene el nombre
$archivo = $_FILES['Imagen']['tmp_name'];// obtiene el archivo
$ruta ="Imagenes";
$MoverAruta= "../modulos/miPerfil/Imagenes";
$MoverAruta=$MoverAruta."/".$nombreImagen;
$ruta=$ruta."/".$nombreImagen;// imagenes/nombreImagen.jpg
move_uploaded_file($archivo,$MoverAruta);




 $query = $conexion->query("SELECT * FROM usuario join persona on usuario.id_persona = persona.id_persona WHERE id_perfil = '{$perfil}' and (username =  '{$username}' or dni = '{$dni}')");
 $query2 = $conexion->query("SELECT * FROM usuario join persona on usuario.id_persona = persona.id_persona WHERE  username =  '{$username}'");


 $user = array();
 $user2 = array();
while($q=$query->fetch_object()){ $user[]=$q; }
while($q2=$query2->fetch_object()){ $user2[]=$q2; }
 //verificamos si el user exite con un condicional




 if(count($user)>0){
        header("location: registroLogin.php?id_perfil=".$perfil."&errorRegistro=usuarioExistente");
        exit;
 		//echo 'el user ya esta registrado, ingresa otro';
	//exit;
		
}  if(count($user2)>0){
        header("location: registroLogin.php?id_perfil=".$perfil."&errorRegistro=usuarioExistente");
        exit;
                //echo 'el user ya esta registrado, ingresa otro';
        //exit;
                
} if (!preg_match("/^[a-zA-Z0-9\_\-]{4,10}$/", $username)) {
    header("location: registroLogin.php?id_perfil=".$perfil."&errorRegistro=username");
        exit;
        }
elseif (!preg_match("/^.{4,12}$/", $password)) {
    header("location: registroLogin.php?id_perfil=".$perfil."&errorRegistro=password");
        exit;
}




$Usuario = new Usuario();

$Usuario->setIdPersona($idPersona);
$Usuario->setIdPerfil($perfil);
$Usuario->setImagen($ruta);
$Usuario->setUsername($username);
$Usuario->setPassword($password);

$Usuario->guardarNuevo();


header("location: registroLogin.php");


?>