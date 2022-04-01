<?php

require_once "MySQL.php";



class TipoContacto {

	private $_idTipoContacto;
	private $_descripcion;
	private $_estado;

	public function getIdTipoContacto() {
		return $this->_idTipoContacto;
	}

	public function getDescripcion() {
		return $this->_descripcion;
	}

	public function setDescripcion($_descripcion)
    {
        $this->_descripcion = $_descripcion;

        return $this;
    }
      /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->_estado;
    }

    /**
     * @param mixed $_estado
     *
     * @return self
     */
    public function setEstado($_estado)
    {
        $this->_estado = $_estado;

        return $this;
    }



	public static function obtenerTodos($filtroEstado = 0) {
	
		$sql = "SELECT * FROM tipo_de_contacto";

		$where = "";

        if ($filtroEstado != 0) {
            // $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
            $where = "WHERE estado = " . $filtroEstado;
        }

        $sql = $sql . " " . $where;
     


		$database = new MySQL();
		$datos = $database->consultar($sql);

    	$listadoTipoContactos = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$tipoContacto = new TipoContacto();
			$tipoContacto->_idTipoContacto = $registro["id_tipo_contacto"];
			$tipoContacto->_descripcion = $registro["descripcion"];
			$tipoContacto->_estado = $registro["estado"];
    		$listadoTipoContactos[] = $tipoContacto;
    	}


    	return $listadoTipoContactos;

	}
	public static function obtenerTodosActivos() {
	
		$sql = "SELECT * FROM tipo_de_contacto where estado = 1";

	
     


		$database = new MySQL();
		$datos = $database->consultar($sql);

    	$listadoTipoContactos = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$tipoContacto = new TipoContacto();
			$tipoContacto->_idTipoContacto = $registro["id_tipo_contacto"];
			$tipoContacto->_descripcion = $registro["descripcion"];
			$tipoContacto->_estado = $registro["estado"];
    		$listadoTipoContactos[] = $tipoContacto;
    	}


    	return $listadoTipoContactos;

	}


	public static function obtenerPorId($idTipoContacto) {
		$sql = "SELECT * FROM tipo_de_contacto WHERE id_tipo_contacto={$idTipoContacto}";


		$database = new MySQL();
		$datos = $database->consultar($sql);

		$registro = $datos->fetch_assoc();

		$contacto = new TipoContacto();
		$contacto->_idTipoContacto = $registro["id_tipo_contacto"];
		$contacto->_descripcion = $registro["descripcion"];

		return $contacto;

	}

	public function guardar() {

		$database = new MySQL();

		$sql = "INSERT INTO tipo_de_contacto "
		     . "(`id_tipo_contacto`, `descripcion`, `estado`)  "
		     . "VALUES (NULL, '{$this->_descripcion}',1)";

		$database->insertar($sql);

	}

	public function actualizar() {

        $database = new MySQL();

        $sql = "UPDATE tipo_de_contacto SET descripcion = '{$this->_descripcion}'"
             . "WHERE tipo_de_contacto.id_tipo_contacto = {$this->_idTipoContacto}";


        $database->actualizar($sql);

    }

	public function eliminar() {

        $sql = "UPDATE tipo_de_contacto  " 
             . "SET estado = 2 "
             . "WHERE tipo_de_contacto.id_tipo_contacto = {$this->_idTipoContacto}";

        
        $database = new MySQL();
        $database->eliminar($sql);

    }
	

}



?>