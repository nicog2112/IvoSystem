<?php

require_once "MySQL.php";
require_once "Persona.php";


class Empleado extends Persona {

	private $_idEmpleado;
	private $_numeroLegajo;
	private $_fechaAlta;
	private $_cargo;
	private $_estadoEmpleado;

	public function getIdEmpleado() {
		return $this->_idEmpleado;
	}

	public function getNumeroLegajo() {
		return $this->_numeroLegajo;
	}

    public function setNumeroLegajo($numeroLegajo) {
		$this->_numeroLegajo = $numeroLegajo;
	}

	public function setFechaAlta($fechaAlta) {
		$this->_fechaAlta = $fechaAlta;
	}

	public function getFechaAlta() {
		return $this->_fechaAlta;
	}

	public function setCargo($cargo) {
		$this->_cargo= $cargo;
	}

	public function getCargo() {
		return $this->_cargo;
	}
	 /**
     * @return mixed
     */
    public function getEstadoEmpleado()
    {
        return $this->_estadoEmpleado;
    }

    /**
     * @param mixed $_estado
     *
     * @return self
     */
    public function setEstadoEmpleado($_estadoEmpleado)
    {
        $this->_estadoEmpleado = $_estadoEmpleado;

        return $this;
    }


	public function guardar() {
		

		$database = new MySQL();

		$sql = "INSERT INTO empleado "
		     . "(`id_empleado`, `id_persona`, `estadoEmpleado`,`numero_legajo`) "
		     . "VALUES (NULL, {$this->_idPersona},1, {$this->_numeroLegajo})";


		$database->insertar($sql);

	}
	public function actualizar() {
		parent::actualizar();

		$database = new MySQL();

		$sql = "UPDATE empleado SET numero_legajo = '{$this->_numeroLegajo}'"
             . "WHERE empleado.id_empleado = {$this->_idEmpleado}";

         
        $database->actualizar($sql);

	}

	public static function obtenerTodos($filtroEstado = 0) {
    	$sql = "SELECT persona.id_persona, persona.nombre, persona.apellido, persona.id_sexo, persona.estado, persona.dni,"
             . "persona.nacionalidad,persona.fecha_de_nacimiento, persona.dni, empleado.id_empleado,empleado.numero_legajo, "
             . "empleado.fecha_alta, empleado.cargo , empleado.estadoEmpleado FROM empleado "
             . "JOIN persona ON persona.id_persona = empleado.id_persona";

         $where = "";

        if ($filtroEstado != 0) {
            // $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
            $where = "where empleado.estadoEmpleado = " . $filtroEstado;
        }

        $sql = $sql . " " . $where;

    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoEmpleados = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$empleado = new Empleado();
			$empleado->_idEmpleado = $registro["id_empleado"];
			$empleado->_idPersona = $registro["id_persona"];
			$empleado->_numeroLegajo = $registro["numero_legajo"];
			$empleado->_nombre = $registro["nombre"];
			$empleado->_apellido = $registro["apellido"];
			$empleado->_dni = $registro["dni"];
			$empleado->_fechaNacimiento = $registro["fecha_de_nacimiento"];
			$empleado->_cargo = $registro["cargo"];
			$empleado->_fechaAlta = $registro["fecha_alta"];
			$empleado->_estado = $registro["estado"];
			$empleado->_estadoEmpleado = $registro["estadoEmpleado"];
			
    		$listadoEmpleados[] = $empleado;
    	}


    	return $listadoEmpleados;
	}

	public static function obtenerTodosActivos() {
    	$sql = "SELECT persona.id_persona, persona.nombre, persona.apellido, persona.id_sexo, persona.estado, persona.dni,"
             . "persona.nacionalidad,persona.fecha_de_nacimiento, persona.dni, empleado.id_empleado,empleado.numero_legajo, "
             . "empleado.fecha_alta, empleado.cargo FROM empleado "
             . "JOIN persona ON persona.id_persona = empleado.id_persona WHERE persona.estado = 1;";

    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoEmpleados = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$empleado = new Empleado();
			$empleado->_idEmpleado = $registro["id_empleado"];
			$empleado->_idPersona = $registro["id_persona"];
			$empleado->_numeroLegajo = $registro["numero_legajo"];
			$empleado->_nombre = $registro["nombre"];
			$empleado->_apellido = $registro["apellido"];
			$empleado->_dni = $registro["dni"];
			$empleado->_fechaNacimiento = $registro["fecha_de_nacimiento"];
			$empleado->_cargo = $registro["cargo"];
			$empleado->_fechaAlta = $registro["fecha_alta"];
			$empleado->_estado = $registro["estado"];
			
    		$listadoEmpleados[] = $empleado;
    	}


    	return $listadoEmpleados;
	}

    public static function obtenerPorId($id) {
    	if(empty($id)){
            $empleado = new Empleado();
           $empleado->_idEmpleado =" ";
		$empleado->_idPersona = " ";
		$empleado->_nombre = " ";
		$empleado->_apellido = " ";
		$empleado->_dni = " ";
		$empleado->_idSexo = " ";
		$empleado->_estado = " ";
		$empleado->_fechaNacimiento = " ";
		$empleado->_nacionalidad = " ";
		$empleado->_numeroLegajo = " ";
		$empleado->_cargo = " ";
		$empleado->_fechaAlta = " ";

             return $empleado;
        }
    	$sql = "SELECT persona.id_persona, persona.nombre, persona.apellido, persona.dni, persona.nacionalidad, "
             . "persona.fecha_de_nacimiento,persona.nacionalidad, persona.id_sexo, persona.estado, empleado.id_empleado, "
             . "empleado.numero_legajo, empleado.cargo, empleado.fecha_alta "
             . "FROM empleado "
             . "JOIN persona ON persona.id_persona = empleado.id_persona "
             . "WHERE id_empleado=" . $id;


        $database = new MySQL();
        $datos = $database->consultar($sql);

        // TODO: ver que pasa cuando no existe el empleado
        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$empleado = self::_crearEmpleado($registro);
		return $empleado;

    }

    public function eliminar() {

    	$sql = "UPDATE empleado JOIN persona ON empleado.id_persona = persona.id_persona " 
             . "SET empleado.estadoEmpleado = 2 "
             . "WHERE empleado.id_empleado = {$this->_idEmpleado}";

    	$database = new MySQL();
        $database->eliminar($sql);



    }

    public static function obtenerPorIdPersona($idPersona) {
    	$sql = "SELECT persona.id_persona, persona.nombre, persona.apellido, persona.dni, persona.nacionalidad, "
             . "persona.fecha_de_nacimiento, persona.id_sexo, persona.estado, empleado.id_empleado, "
             . "empleado.numero_legajo , empleado.cargo, empleado.fecha_alta "
             . "FROM empleado "
             . "JOIN persona ON persona.id_persona = empleado.id_persona "
             . "WHERE empleado.id_persona=" . $idPersona;

            



        $database = new MySQL();
        $datos = $database->consultar($sql);

        // TODO: ver que pasa cuando no existe el empleado
        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$empleado = self::_crearEmpleado($registro);
		return $empleado;

    }

    private static function _crearEmpleado($datos) {
    	$empleado = new Empleado();
		$empleado->_idEmpleado = $datos["id_empleado"];
		$empleado->_idPersona = $datos["id_persona"];
		$empleado->_nombre = $datos["nombre"];
		$empleado->_apellido = $datos["apellido"];
		$empleado->_dni = $datos["dni"];
		$empleado->_idSexo = $datos["id_sexo"];
		$empleado->_estado = $datos["estado"];
		$empleado->_fechaNacimiento = $datos["fecha_de_nacimiento"];
		$empleado->_nacionalidad = $datos["nacionalidad"];
		$empleado->_numeroLegajo = $datos["numero_legajo"];
		$empleado->_cargo = $datos["cargo"];
		$empleado->_fechaAlta = $datos["fecha_alta"];

		return $empleado;
    }


}



?>