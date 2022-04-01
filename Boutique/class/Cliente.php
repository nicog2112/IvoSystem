<?php

require_once "MySQL.php";
require_once "Persona.php";
require_once "Sexo.php";



class Cliente extends Persona {

	private $_idCliente;
	private $_fechaAlta;
	 private $_estadoCliente;

	public function getIdCliente() {
		return $this->_idCliente;
	}

	public function getFechaAlta() {
		return $this->_fechaAlta;
	}

	public function setFechaAlta($fechaAlta) {
		$this->_fechaAlta = $fechaAlta;
	}

	     /**
     * @return mixed
     */
    public function getEstadoCliente()
    {
        return $this->_estadoCliente;
    }

    /**
     * @param mixed $_estado
     *
     * @return self
     */
    public function setEstadoCliente($_estadoCliente)
    {
        $this->_estadoCliente = $_estadoCliente;

        return $this;
    }

	public function guardar() {
	

		$database = new MySQL();

		$sql = "INSERT INTO cliente "
		     . "(`id_cliente`, `Fecha_Alta`, `id_persona`,`estadoCliente`) "
		     . "VALUES (NULL, '{$this->_fechaAlta}' ,'{$this->_idPersona}',1)";


		$database->insertar($sql);

	}

	public function actualizar() {
        parent::actualizar();

        $database = new MySQL();

        $sql = "UPDATE cliente SET fecha_alta = '{$this->_fechaAlta}'"
             . "WHERE cliente.id_cliente = {$this->_idCliente}";


        $database->actualizar($sql);

    }

	public static function obtenerTodos($filtroEstado = 0) {
    	$sql ="SELECT persona.id_persona, persona.nombre, persona.apellido, persona.id_sexo,"
             . "persona.estado,persona.dni,persona.fecha_de_nacimiento,"
             ."persona.nacionalidad, cliente.id_cliente, cliente.Fecha_Alta, cliente.estadoCliente "
             . "FROM cliente "
             . "JOIN persona ON persona.id_persona = cliente.id_persona";


              $where = "";

        if ($filtroEstado != 0) {
            // $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
            $where = "where cliente.estadoCliente = " . $filtroEstado;
        }

        $sql = $sql . " " . $where;

    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoClientes = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$cliente = new Cliente();
			$cliente->_idCliente = $registro["id_cliente"];
			$cliente->_idPersona = $registro["id_persona"];
			$cliente->_fechaAlta = $registro["Fecha_Alta"];
			$cliente->_nombre = $registro["nombre"];
			$cliente->_apellido = $registro["apellido"];
			$cliente->_fechaNacimiento = $registro["fecha_de_nacimiento"];
			$cliente->_dni = $registro["dni"];
			$cliente->_nacionalidad = $registro["nacionalidad"];
			$cliente->_estado = $registro["estado"];
			$cliente->_estadoCliente = $registro["estadoCliente"];
			$cliente->_idSexo = $registro["id_sexo"];
			
		

    		$listadoClientes[] = $cliente;


    
    	}


    	return $listadoClientes;
	}

	public static function obtenerTodosActivos() {
    	$sql = "SELECT persona.id_persona, persona.nombre, persona.apellido, persona.id_sexo, persona.estado, persona.dni,"
             . "persona.nacionalidad,persona.fecha_de_nacimiento, persona.dni, cliente.id_cliente, cliente.Fecha_Alta FROM cliente "
             . "JOIN persona ON persona.id_persona = cliente.id_persona WHERE persona.estado = 1;";

    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoClientes = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$cliente = new Cliente();
			$cliente->_idCliente = $registro["id_cliente"];
			$cliente->_idPersona = $registro["id_persona"];
			$cliente->_fechaAlta = $registro["Fecha_Alta"];
			$cliente->_nombre = $registro["nombre"];
			$cliente->_apellido = $registro["apellido"];
			$cliente->_fechaNacimiento = $registro["fecha_de_nacimiento"];
			$cliente->_dni = $registro["dni"];
			$cliente->_nacionalidad = $registro["nacionalidad"];
			$cliente->_estado = $registro["estado"];
			$cliente->_idSexo = $registro["id_sexo"];
			
    		$listadoClientes[] = $cliente;
    	}


    	return $listadoClientes;
	}

	public static function obtenerPorId($id) {
    	$sql = "SELECT persona.id_persona, persona.nombre, persona.apellido, "
             . "persona.dni,persona.fecha_de_nacimiento,persona.nacionalidad,persona.estado, persona.id_sexo,cliente.id_cliente,cliente.fecha_alta"
             . " FROM persona "
             . "JOIN cliente ON persona.id_persona = cliente.id_persona "
             . "WHERE id_cliente=" . $id;


        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$cliente = self::_crearCliente($registro);
		return $cliente;

    }

    public static function obtenerPorIdPersona($idPersona) {
    	$sql =  "SELECT persona.id_persona, persona.nombre, persona.apellido, "
             . "persona.dni,persona.fecha_de_nacimiento,persona.nacionalidad,persona.estado, persona.id_sexo,cliente.id_cliente,cliente.fecha_alta"
             . " FROM persona "
             . "JOIN cliente ON persona.id_persona = cliente.id_persona "
             . "WHERE cliente.id_persona=" . $idPersona;

            


		$database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$cliente = self::_crearCliente($registro);
		return $cliente;

    }

    public function eliminar() {
		$sql = "UPDATE cliente JOIN persona ON cliente.id_persona = persona.id_persona " 
             . "SET cliente.estadoCliente = 2 "
             . "WHERE cliente.id_cliente = {$this->_idCliente}";
    	
    	
    	$database = new MySQL();
        $database->eliminar($sql);

        

    }

    private static function _crearCliente($datos) {
    	$cliente = new Cliente();
		$cliente->_idCliente = $datos["id_cliente"];
		$cliente->_idPersona = $datos["id_persona"];
        $cliente->_dni = $datos["dni"];
        $cliente->_estado = $datos["estado"];
		$cliente->_fechaAlta = $datos["fecha_alta"];
		$cliente->_nombre = $datos["nombre"];
		$cliente->_apellido = $datos["apellido"];
		$cliente->_fechaNacimiento = $datos["fecha_de_nacimiento"];
        $cliente->_idSexo = $datos["id_sexo"];
        $cliente->_nacionalidad = $datos["nacionalidad"];


		return $cliente;
    }

}



?>