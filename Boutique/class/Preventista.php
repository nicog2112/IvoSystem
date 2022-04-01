<?php

require_once "MySQL.php";
require_once "Persona.php";
require_once "Proveedor.php";


class Preventista extends Persona {

	private $_idPreventista;
    private $_estadoPreventista;

	public $proveedor;



	public function getIdPreventista() {
		return $this->_idPreventista;
	}




    /**
     * @return mixed
     */
    public function getIdProveedor()
    {
        return $this->_idProveedor;
    }

    /**
     * @param mixed $_idPerfil
     *
     * @return self
     */
    public function setIdProveedor($_idProveedor)
    {
        $this->_idProveedor = $_idProveedor;

        return $this;
    }

     /**
     * @return mixed
     */
    public function getEstadoPreventista()
    {
        return $this->_estadoPreventista;
    }

    /**
     * @param mixed $_estado
     *
     * @return self
     */
    public function setEstadoPreventista($_estadoPreventista)
    {
        $this->_estadoPreventista = $_estadoPreventista;

        return $this;
    }

	public function guardar() {
		

		$database = new MySQL();

		$sql = "INSERT INTO preventista "
		     . "(`id_preventista`, `id_persona`, `id_proveedor`,`estadoPreventista`) "
		     . "VALUES (NULL,'{$this->_idPersona}','{$this->_idProveedor}',1)";
     
		$database->insertar($sql);

	}

	public function actualizar() {
        parent::actualizar();

        $database = new MySQL();

        $sql = "UPDATE preventista SET id_proveedor = '{$this->_idProveedor}' "
             . "WHERE preventista.id_preventista = {$this->_idPreventista}";


        $database->actualizar($sql);

    }

	public static function obtenerTodos($id,$filtroEstado = 0) {
    	$sql ="SELECT * FROM preventista "
             . "JOIN persona ON persona.id_persona = preventista.id_persona"
             . " WHERE id_proveedor=" . $id;

        $where = "";

        if ($filtroEstado != 0) {
            // $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
            $where = "AND preventista.estadoPreventista = " . $filtroEstado;
        }

        $sql = $sql . " " . $where;

    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoPreventista = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$preventista = new Preventista();
			$preventista->_idPreventista = $registro["id_preventista"];
			$preventista->_idPersona = $registro["id_persona"];
			$preventista->_idProveedor = $registro["id_proveedor"];
			$preventista->_nombre = $registro["nombre"];
			$preventista->_apellido = $registro["apellido"];
			$preventista->_fechaNacimiento = $registro["fecha_de_nacimiento"];
			$preventista->_dni = $registro["dni"];
			$preventista->_nacionalidad = $registro["nacionalidad"];
			$preventista->_estado = $registro["estado"];
            $preventista->_estadoPreventista = $registro["estadoPreventista"];
			$preventista->_idSexo = $registro["id_sexo"];
			$preventista->proveedor = Proveedor::obtenerPorId($preventista->_idProveedor);
            $preventista->sexo = Sexo::obtenerPorId($preventista->_idSexo);
    		$listadoPreventista[] = $preventista;
    	}


    	return $listadoPreventista;
	}

	public static function obtenerPorId($id) {
    	$sql = "SELECT persona.id_persona, persona.nombre, persona.apellido, "
             . "persona.dni,persona.fecha_de_nacimiento,persona.nacionalidad,persona.estado, persona.id_sexo,preventista.id_preventista,preventista.id_proveedor"
             . " FROM persona "
             . "JOIN preventista ON persona.id_persona = preventista.id_persona "
             . "WHERE id_preventista=" . $id;



        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$preventista = self::_crearPreventista($registro);
		return $preventista;

    }


    public static function obtenerPorIdPersona($idPersona) {
        $sql = "SELECT persona.id_persona, persona.nombre, persona.apellido, "
             . "persona.dni,persona.fecha_de_nacimiento,persona.nacionalidad,persona.estado, persona.id_sexo,preventista.id_preventista,preventista.id_proveedor"
             . " FROM persona "
             . "JOIN preventista ON persona.id_persona = preventista.id_persona "
             . "WHERE preventista.id_persona=" . $idPersona;



        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
            return false;
        }

        $registro = $datos->fetch_assoc();
        $preventista = self::_crearPreventista($registro);
        return $preventista;

    }
  
    public function eliminar() {

        $sql = "UPDATE preventista JOIN persona ON preventista.id_persona = persona.id_persona " 
             . "SET preventista.estadoPreventista = '{$this->_estado}' "
             . "WHERE preventista.id_preventista = {$this->_idPreventista}";
    	
    	$database = new MySQL();
        $database->eliminar($sql);

     

    }

    private static function _crearPreventista($datos) {
    	$preventista = new Preventista();
		$preventista->_idPreventista = $datos["id_preventista"];
		$preventista->_idPersona = $datos["id_persona"];
        $preventista->_idProveedor = $datos["id_proveedor"];
        $preventista->_dni = $datos["dni"];
        $preventista->_estado = $datos["estado"];
		$preventista->_nombre = $datos["nombre"];
		$preventista->_apellido = $datos["apellido"];
		$preventista->_fechaNacimiento = $datos["fecha_de_nacimiento"];
        $preventista->_idSexo = $datos["id_sexo"];
        $preventista->_nacionalidad = $datos["nacionalidad"];


		return $preventista;
    }

}



?>