<?php

require_once "../class/Usuario.php";

$id_usuario = $_POST["idUsuario"];
$nombre = $_POST['nombreUsuario'];
$apellido = $_POST['apellidoUsuario'];
$dni = $_POST['dniUsuario'];
$fechaNacimiento = $_POST['fechaNacimientoUsuario'];
$sexo = $_POST['sexoUsuario'];
$nacionalidad = $_POST['nacionalidadUsuario'];
$username = $_POST['usernameUsuario'];
$password = $_POST['passwordUsuario'];
$nombreImagen = $_FILES['ImagenPerfil']['name'];// obtiene el nombre
$archivo = $_FILES['ImagenPerfil']['tmp_name'];// obtiene el archivo
$ruta ="Imagenes";
$MoverAruta= "../modulos/miPerfil/Imagenes";
$MoverAruta=$MoverAruta."/".$nombreImagen;
$ruta=$ruta."/".$nombreImagen;// imagenes/nombreImagen.jpg
move_uploaded_file($archivo,$MoverAruta);


        // Queremos que el nombre de usuario sólo tenga letras
if (!preg_match("/^([a-zA-ZÀ-ÿ]{3,40})+( [a-zA-ZÀ-ÿ]+)*$/", $nombre)) {
    header("location: miPerfil.php?error=nombreUsuarioModificar");
	exit;
}elseif (!preg_match("/^([a-zA-ZÀ-ÿ]{3,40})+( [a-zA-ZÀ-ÿ]+)*$/", $apellido)) {
	header("location: miPerfil.php?error=apellidoUsuarioModificar");
	exit;
}elseif (!preg_match("/^\d{8,10}$/", $dni)) {
	header("location: miPerfil.php?error=dniUsuarioModificar");
	exit;
}elseif (!preg_match("/^([a-zA-ZÀ-ÿ]{3,40})+( [a-zA-ZÀ-ÿ]+)*$/", $nacionalidad)) {
	header("location: miPerfil.php?error=nacionalidadUsuarioModificar");
	exit;
}elseif (!preg_match("/^[a-zA-Z0-9\_\-]{4,10}$/", $username)) {
	header("location: miPerfil.php?error=usernameUsuarioModificar");
	exit;
}elseif (!preg_match("/^.{4,12}$/", $password)) {
	header("location: miPerfil.php?error=passwordUsuarioModificar");
	exit;
}


$Usuario = Usuario::obtenerPorId($id_usuario);

$Usuario->setNombre($nombre);
$Usuario->setImagen($ruta);
$Usuario->setApellido($apellido);
$Usuario->setDni($dni);
$Usuario->setFechaNacimiento($fechaNacimiento);
$Usuario->setIdSexo($sexo);
$Usuario->setNacionalidad($nacionalidad);
$Usuario->setUsername($username);
$Usuario->setPassword($password);

$Usuario->actualizar();

header("location: miPerfil.php");


?>