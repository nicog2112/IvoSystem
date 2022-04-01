<?php

require_once "MySQL.php";


class Temporada{

	private $_idTemporada;
	private $_nombre;
	private $_año;
	private $_estado;

	public function getIdTemporada() {
		return $this->_idTemporada;
	}
	public function getNombre() {
		return $this->_nombre;
	}

	public function setNombre($nombre) {
		$this->_nombre = $nombre;
	}

	
	public function getAño() {
		return $this->_año;
	}

	public function setAño($año) {
		$this->_año = $año;
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
	public function guardar() {

		$database = new MySQL();

		$sql = "INSERT INTO temporada "
		     . "(`id_temporada`, `nombre`, `anio`, `estado`)  "
		     . "VALUES (NULL, '{$this->_nombre}', '{$this->_año}',1)";



		$database->insertar($sql);

	}

	public function actualizar() {

        $database = new MySQL();

        $sql = "UPDATE temporada SET nombre = '{$this->_nombre}',"
		     . "anio = '{$this->_año}'"
             . "WHERE temporada.id_temporada = {$this->_idTemporada}";


        $database->actualizar($sql);

    }

	public static function obtenerTodos($filtroEstado = 0) {
    	$sql = "SELECT temporada.id_temporada, temporada.nombre, temporada.anio, temporada.estado from temporada ";

    	$where = "";

        if ($filtroEstado != 0) {
            // $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
            $where = " where estado = " . $filtroEstado;
        }

        $sql = $sql . " " . $where;


    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoTemporada = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$temporada = new Temporada();
			$temporada->_idTemporada = $registro["id_temporada"];
			$temporada->_nombre = $registro["nombre"];
			$temporada->_año = $registro["anio"];
			$temporada->_estado = $registro["estado"];
    		$listadoTemporada[] = $temporada;
    	}


    	return $listadoTemporada;
	}

	public static function obtenerTodosActivos() {
    	$sql = "SELECT temporada.id_temporada, temporada.nombre, temporada.anio, temporada.estado from temporada where estado = 1 ";

    	


    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoTemporada = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$temporada = new Temporada();
			$temporada->_idTemporada = $registro["id_temporada"];
			$temporada->_nombre = $registro["nombre"];
			$temporada->_año = $registro["anio"];
			$temporada->_estado = $registro["estado"];
    		$listadoTemporada[] = $temporada;
    	}


    	return $listadoTemporada;
	}

	public static function obtenerPorId($id) {
    	$sql = "SELECT temporada.id_temporada, temporada.nombre, temporada.anio "
             . " FROM temporada "
             . "WHERE id_temporada =" . $id;




        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$temporada = self::_crearTemporada($registro);
		return $temporada;

    }


    public function eliminar() {

        $sql =  "UPDATE temporada  " 
             . "SET estado = 2 "
             . "WHERE temporada.id_temporada = {$this->_idTemporada}";
        $database = new MySQL();
        $database->eliminar($sql);

    }

     private static function _crearTemporada($datos) {
    	$temporada = new Temporada();
		$temporada->_idTemporada = $datos["id_temporada"];
		$temporada->_nombre = $datos["nombre"];
		$temporada->_año = $datos["anio"];


		return $temporada;
    }


}



?>