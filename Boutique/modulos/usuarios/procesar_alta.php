<?php

require_once "../../class/Usuario.php";




if($_POST['cliente'] != "NULL" ) {
        $persona = $_POST['cliente'];

     } 
else {
        $persona = $_POST['Empleado'];
 
     } 

$usuario= Usuario::obtenerPorIdPersonaUsuario($persona);
$dni=  $usuario->getDni();


$conexion=mysqli_connect('localhost','root','','boutique');

$perfil = $_POST['idPerfilDeUsuario'];

$username = $_POST['username'];
$password = $_POST['password'];
$nombreImagen = $_FILES['Imagen']['name'];// obtiene el nombre
$archivo = $_FILES['Imagen']['tmp_name'];// obtiene el archivo
$ruta ="Imagenes";
$ruta=$ruta."/".$nombreImagen;// imagenes/nombreImagen.jpg
move_uploaded_file($archivo, $ruta);


 $query = $conexion->query("SELECT * FROM usuario join persona on usuario.id_persona = persona.id_persona WHERE usuario.estado = 1  and id_perfil = '{$perfil}' and (username =  '{$username}' or dni = '{$dni}')");
 $query2 = $conexion->query("SELECT * FROM usuario join persona on usuario.id_persona = persona.id_persona WHERE usuario.estado = 1  and username =  '{$username}'");


 $user = array();
 $user2 = array();
while($q=$query->fetch_object()){ $user[]=$q; }
while($q2=$query2->fetch_object()){ $user2[]=$q2; }
 //verificamos si el user exite con un condicional




 if(count($user)>0){
        header("location: listado.php?id_perfil=".$perfil."&error=usuarioExistente");
        exit;
 		//echo 'el user ya esta registrado, ingresa otro';
	//exit;
		
}  if(count($user2)>0){
        header("location: listado.php?id_perfil=".$perfil."&error=usuarioExistente");
        exit;
                //echo 'el user ya esta registrado, ingresa otro';
        //exit;
                
} if (!preg_match("/^[a-zA-Z0-9\_\-]{4,10}$/", $username)) {
    header("location: listado.php?id_perfil=".$perfil."&error=username");
        exit;
        }
elseif (!preg_match("/^.{4,12}$/", $password)) {
    header("location: listado.php?id_perfil=".$perfil."&error=password");
        exit;
}




$Usuario = new Usuario();

$Usuario->setIdPersona($persona);
$Usuario->setIdPerfil($perfil);
$Usuario->setImagen($ruta);
$Usuario->setUsername($username);
$Usuario->setPassword($password);

$Usuario->guardarNuevo();

header("location: listado.php?id_perfil=".$perfil);


?>
