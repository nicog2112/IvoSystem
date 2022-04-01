<?php


require_once "MySQL.php";
require_once "Persona.php";
require_once "Perfil.php";



class Usuario extends Persona {

	private $_idUsuario;
	private $_username;
    private $_password;
    private $_imagen;
	private $_idPerfil;
	private $_estaLogueado;
    private $_estadoUsuario;
    public $perfil;


    /**
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->_idUsuario;
    }

    /**
     * @param mixed $_idUsuario
     *
     * @return self
     */
    public function setIdUsuario($_idUsuario)
    {
        $this->_idUsuario = $_idUsuario;

        return $this;
    }

    public function getImagen() {
        return $this->_imagen;
    }

    public function setImagen($_imagen) {
        $this->_imagen = $_imagen;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->_username;
    }

    /**
     * @param mixed $_username
     *
     * @return self
     */
    public function setUsername($_username)
    {
        $this->_username = $_username;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param mixed $_username
     *
     * @return self
     */
    public function setPassword($_password)
    {
        $this->_password = $_password;

        return $this;
    }
    public function getEstadoUsuario()
    {
        return $this->_estadoUsuario;
    }

    /**
     * @param mixed $_estado
     *
     * @return self
     */
    public function setEstadoUsuario($_estadoUsuario)
    {
        $this->_estadoUsuario = $_estadoUsuario;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdPerfil()
    {
        return $this->_idPerfil;
    }

    /**
     * @param mixed $_idPerfil
     *
     * @return self
     */
    public function setIdPerfil($_idPerfil)
    {
        $this->_idPerfil = $_idPerfil;

        return $this;
    }

  

    public function estaLogueado()
    {
    	return $this->_estaLogueado;
    }


    public function guardar() {
        parent::guardar();

        $database = new MySQL();

        $sql = "INSERT INTO usuario "
             . "(`id_usuario`, `id_persona`, `id_perfil`, `username`,`password`) "
             . "VALUES (NULL, {$this->_idPersona}, {$this->_perfil}, '{$this->_username}',"
             ."'{$this->_password}')";


        $database->insertar($sql);

    }

     public function guardarNuevo() {
    

        $database = new MySQL();
        If ( $_FILES['Imagen']['name'] =="" ) {
        $sql = "INSERT INTO usuario "
             . "(`id_usuario`, `id_persona`, `id_perfil`, `username`,`password`,`imagen`,`estado`) "
             . "VALUES (NULL, '{$this->_idPersona}', '{$this->_idPerfil}', '{$this->_username}',"
             ."'{$this->_password}', 'Imagenes/perfil1.png',1 )";

        } else {
            $sql = "INSERT INTO usuario "
             . "(`id_usuario`, `id_persona`, `id_perfil`, `username`,`password`,`imagen`,`estado`) "
             . "VALUES (NULL, '{$this->_idPersona}', '{$this->_idPerfil}', '{$this->_username}',"
             ."'{$this->_password}', '{$this->_imagen}',1 )";
        }

        $database->insertar($sql);

    }

    public function actualizar() {
        parent::actualizar();

        $database = new MySQL();


        If ( $_FILES['ImagenPerfil']['name'] =="" ) {
           $sql = "UPDATE usuario SET username = '{$this->_username}',password = '{$this->_password}' "
             . "WHERE usuario.id_usuario = {$this->_idUsuario}";
        } else {
             $sql = "UPDATE usuario SET username = '{$this->_username}',password = '{$this->_password}' ,imagen = '{$this->_imagen}' "
             . "WHERE usuario.id_usuario = {$this->_idUsuario}";
        }


      
        $database->actualizar($sql);

    }


     public function actualizarNuevo() {
      

        $database = new MySQL();


        If ( $_FILES['Imagen']['name'] =="" ) {
           $sql = "UPDATE usuario SET username = '{$this->_username}',password = '{$this->_password}' "
             . "WHERE usuario.id_usuario = {$this->_idUsuario}";
        } else {
             $sql = "UPDATE usuario SET username = '{$this->_username}',password = '{$this->_password}' ,imagen = '{$this->_imagen}' "
             . "WHERE usuario.id_usuario = {$this->_idUsuario}";
        }


    
        $database->actualizar($sql);

    }
    public static function obtenerTodos($idPerfil,$filtroEstado = 0) {
    	$sql = "SELECT persona.id_persona, persona.nombre, persona.apellido, persona.id_sexo,"
             . "sexo.descripcion, persona.estado,"
             . "persona.dni,persona.fecha_de_nacimiento,persona.nacionalidad, usuario.id_usuario,"
             . "usuario.username, usuario.id_perfil, usuario.password,usuario.imagen,usuario.estado "
             . "FROM usuario JOIN persona ON persona.id_persona = usuario.id_persona "
             . "LEFT JOIN sexo ON persona.id_sexo = sexo.id_sexo where usuario.id_perfil =".$idPerfil;


        $where = "";

        if ($filtroEstado != 0) {
            // $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
            $where = "and usuario.estado = " . $filtroEstado;
        }

        $sql = $sql . " " . $where;

      
   
    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoUsuarios = [];

    	while ($registro = $datos->fetch_assoc()) {
    		$user = self::_crearUsuario($registro);
    		$listadoUsuarios[] = $user;
    	}


    	return $listadoUsuarios;
    }

    public static function login($username, $password) {
    	$sql = "SELECT persona.id_persona, persona.nombre, persona.apellido, "
             . "persona.dni,persona.fecha_de_nacimiento,persona.nacionalidad, usuario.id_usuario,"
             . "persona.id_sexo,usuario.username, usuario.id_perfil ,usuario.imagen,usuario.password,usuario.estado "
             . "FROM usuario "
             . "JOIN persona ON persona.id_persona = usuario.id_persona "
             . "WHERE username = '{$username}' and password = '{$password}' and persona.estado=1 and usuario.id_perfil != 3";

    	$database = new MySQL();
    	$datos = $database->consultar($sql);


    	if ($datos->num_rows > 0) {
    		$registro = $datos->fetch_assoc();
			$user = self::_crearUsuario($registro);
			$user->_estaLogueado = true;

    	} else {
    		$user = new Usuario();
    		$user->_estaLogueado = false;
    	}

		return $user;

    }

     public static function loginCliente($username, $password) {
        $sql = "SELECT persona.id_persona, persona.nombre, persona.apellido, "
             . "persona.dni,persona.fecha_de_nacimiento,persona.nacionalidad, usuario.id_usuario,"
             . "persona.id_sexo,usuario.username, usuario.id_perfil ,usuario.imagen,usuario.password,usuario.estado "
             . "FROM usuario "
             . "JOIN persona ON persona.id_persona = usuario.id_persona "
             . "WHERE username = '{$username}' and password = '{$password}' and usuario.estado=1 and usuario.id_perfil = 3";

        $database = new MySQL();
        $datos = $database->consultar($sql);


        if ($datos->num_rows > 0) {
            $registro = $datos->fetch_assoc();
            $user = self::_crearUsuario($registro);
            $user->_estaLogueado = true;

        } else {
            $user = new Usuario();
            $user->_estaLogueado = false;
        }

        return $user;

    }

    public static function obtenerPorId($id) {
    	$sql = "SELECT persona.id_persona, persona.nombre, persona.apellido, "
             . "persona.dni,persona.fecha_de_nacimiento,persona.nacionalidad,persona.estado, persona.id_sexo,usuario.id_usuario,"
             . "usuario.username,usuario.imagen, usuario.password,usuario.id_perfil,usuario.estado "
             . "FROM usuario "
             . "JOIN persona ON persona.id_persona = usuario.id_persona "
             . "WHERE id_usuario=" . $id;



        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$usuario = self::_crearUsuario($registro);
		return $usuario;

    }

    public static function obtenerPorIdPersonaUsuario($id) {
        $sql = "SELECT persona.id_persona, persona.nombre, persona.apellido, "
             . "persona.dni,persona.fecha_de_nacimiento,persona.nacionalidad,persona.estado, persona.id_sexo "
             . "FROM persona "
             . "WHERE id_persona=" . $id;

        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
            return false;
        }

       $registro = $datos->fetch_assoc();

        $usuario = new Usuario();
        $usuario->_idPersona = $registro["id_persona"];
        $usuario->_dni = $registro["dni"];

        return $usuario;

    }


     public static function obtenerPorIdPersona($id) {
        $sql = "SELECT persona.id_persona, persona.nombre, persona.apellido, "
             . "persona.dni,persona.fecha_de_nacimiento,persona.nacionalidad,persona.estado, persona.id_sexo,usuario.id_usuario,"
             . "usuario.username,usuario.imagen,usuario.password,usuario.id_perfil,usuario.estado "
             . "FROM usuario "
             . "JOIN persona ON persona.id_persona = usuario.id_persona "
             . "WHERE usuario.id_persona=" . $id;


        $database = new MySQL();
        $datos = $database->consultar($sql);

        $listadoUsuarios = [];

        while ($registro = $datos->fetch_assoc()) {
            $user = self::_crearUsuario($registro);
            $listadoUsuarios[] = $user;
        }


        return $listadoUsuarios;
    }

   

    public function eliminar() {

        $sql = "UPDATE usuario JOIN persona ON usuario.id_persona = persona.id_persona " 
             . "SET usuario.estado = 2 "
             . "WHERE usuario.id_usuario = {$this->_idUsuario}";
        
        $database = new MySQL();
        $database->eliminar($sql);

       

    }

    private static function _crearUsuario($datos) {
    	$user = new Usuario();
		$user->_idUsuario = $datos["id_usuario"];
		$user->_idPersona = $datos["id_persona"];
        $user->_imagen = $datos["imagen"];
		$user->_username = $datos["username"];
        $user->_dni = $datos["dni"];
        $user->_password = $datos["password"];
        $user->_estado = $datos["estado"];
		$user->_idPerfil = $datos["id_perfil"];
		$user->_nombre = $datos["nombre"];
		$user->_apellido = $datos["apellido"];
		$user->_fechaNacimiento = $datos["fecha_de_nacimiento"];
        $user->_idSexo = $datos["id_sexo"];
        $user->_nacionalidad = $datos["nacionalidad"];
         $user->_estadoUsuario= $datos["estado"];
        $user->perfil = Perfil::obtenerPorId($user->_idPerfil);

		return $user;
    }
}


?>