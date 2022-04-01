<?php

require_once "Localidad.php";
require_once "MySQL.php";


class Barrio {

	private $_idBarrio; 
	private $_descripcion;
    public $_idLocalidad; 
    private $_estado; 

    public $localidad;

    /**
     * @return mixed
     */
    public function getIdBarrio()
    {
        return $this->_idBarrio;
    }

        /**
     * @return mixed
     */
    public function setDescripcion($_descripcion)
    {
        $this->_descripcion = $_descripcion;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->_descripcion;
    }

        /**
     * @return mixed
     */
    public function setIdLocalidad($_idLocalidad)
    {
        $this->_idLocalidad = $_idLocalidad;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getIdLocalidad()
    {
        return $this->_idLocalidad;
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


        $sql = "INSERT INTO barrios (`id_barrio`, `descripcion`,`id_localidad`,`estado`) VALUES 
        (NULL, '{$this->_descripcion}','{$this->_idLocalidad}',1)";


        $database->insertar($sql);
    }


     public function actualizar() {

        $database = new MySQL();

        $sql = "UPDATE barrios SET descripcion = '{$this->_descripcion}'"
             . "WHERE barrios.id_barrio = {$this->_idBarrio}";


        $database->actualizar($sql);

    }

	public static function obtenerTodos() {

    	$sql = "SELECT * FROM barrios";

    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoBarrio = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$barrio = new Barrio();
			$barrio->_idBarrio = $registro["id_barrio"];
			$barrio->_descripcion = $registro["descripcion"];
            $barrio->_idLocalidad = $registro["id_localidad"];
    		$listadoBarrio[] = $barrio;
    	}


    	return $listadoBarrio;

	}

    public static function obtenerPorId($idBarrio) {
        $sql = "SELECT * FROM barrios WHERE id_barrio={$idBarrio}";

        $database = new MySQL();
        $datos = $database->consultar($sql);

        $registro = $datos->fetch_assoc();

        $barrio = new Barrio();
        $barrio->_idBarrio = $registro["id_barrio"];
        $barrio->_descripcion = $registro["descripcion"];
        $barrio->_idLocalidad = $registro["id_localidad"];
      
        return $barrio;

    }


     public static function obtenerPorIdLocalidad($idLocalidad,$filtroEstado = 0) {
        $sql = "SELECT * FROM barrios WHERE id_localidad={$idLocalidad}";


         $where = "";

        if ($filtroEstado != 0) {
            // $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
            $where = "and estado = " . $filtroEstado;
        }

        $sql = $sql . " " . $where;


        $database = new MySQL();
        $datos = $database->consultar($sql);

        $listadoBarrio = [];

        while ($registro = $datos->fetch_assoc()) {
        $barrio = new Barrio();
        $barrio->_idBarrio = $registro["id_barrio"];
        $barrio->_descripcion = $registro["descripcion"];
        $barrio->_idLocalidad = $registro["id_localidad"];
         $barrio->_estado= $registro["estado"];
      
      
        $listadoBarrio[] = $barrio;
        }
      
       return $listadoBarrio;

    }

     public static function obtenerPorIdBarrio($id) {
        $sql = "SELECT barrios.id_barrio, barrios.descripcion, barrios.id_localidad FROM barrios WHERE id_barrio=". $id;



        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
            return false;
        }

        $registro = $datos->fetch_assoc();
        $barrio = self::_crearBarrio($registro);
        return $barrio;

    }


      public function eliminar() {

        $sql = "UPDATE barrios  " 
             . "SET estado = 2 "
             . "WHERE barrios.id_barrio = {$this->_idBarrio}";
        
        $database = new MySQL();
        $database->eliminar($sql);

    }

     private static function _crearBarrio($datos) {
        $barrio = new Barrio();
        $barrio->_idBarrio = $datos["id_barrio"];
        $barrio->_descripcion = $datos["descripcion"];
        $barrio->_idLocalidad= $datos["id_localidad"];
        

        return $barrio;
    }

}


?>