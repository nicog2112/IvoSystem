<?php


require_once "Provincia.php";
require_once "MySQL.php";


class Localidad {

	private $_idLocalidad; 
	private $_descripcion;
    public $_idProvincia;
    private $_estado; 

    public $provincia;

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
    public function setIdProvincia($_idProvincia)
    {
        $this->_idProvincia = $_idProvincia;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getIdProvincia()
    {
        return $this->_idProvincia;
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


        $sql = "INSERT INTO localidades (`id_localidad`, `descripcion`,`id_provincia`,`estado`) VALUES 
        (NULL, '{$this->_descripcion}','{$this->_idProvincia}',1)";


        $database->insertar($sql);
    }


    public function actualizar() {

        $database = new MySQL();

        $sql = "UPDATE localidades SET descripcion = '{$this->_descripcion}'"
             . "WHERE localidades.id_localidad = {$this->_idLocalidad}";


        $database->actualizar($sql);

    }

	public static function obtenerTodos() {

    	$sql = "SELECT * FROM localidades";

    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoLocalidad = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$localidad = new Localidad();
			$localidad->_idLocalidad= $registro["id_localidad"];
			$localidad->_descripcion = $registro["descripcion"];
            $localidad->_idProvincia = $registro["id_provincia"];
    		$listadoLocalidad[] = $localidad;
    	}


    	return $listadoLocalidad;

	}

    public static function obtenerPorId($idLocalidad) {
        $sql = "SELECT * FROM localidades WHERE id_localidad={$idLocalidad}";



        $database = new MySQL();
        $datos = $database->consultar($sql);

        $registro = $datos->fetch_assoc();

        $localidad = new Localidad();
        $localidad->_idLocalidad= $registro["id_localidad"];
        $localidad->_descripcion = $registro["descripcion"];
        $localidad->_idProvincia = $registro["id_provincia"];
      
        return $localidad;

    }

     public static function obtenerPorIdProvincia($idProvincia,$filtroEstado = 0) {
        $sql = "SELECT * FROM localidades WHERE id_provincia={$idProvincia}";

         $where = "";

        if ($filtroEstado != 0) {
            // $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
            $where = "and estado = " . $filtroEstado;
        }

        $sql = $sql . " " . $where;

        $database = new MySQL();
        $datos = $database->consultar($sql);

        $listadoLocalidad = [];

        while ($registro = $datos->fetch_assoc()) {
        $localidad = new Localidad();
        $localidad->_idLocalidad= $registro["id_localidad"];
        $localidad->_descripcion = $registro["descripcion"];
        $localidad->_idProvincia = $registro["id_provincia"];
        $localidad->_estado = $registro["estado"];
      
        $listadoLocalidad[] = $localidad;
        }
      
       return $listadoLocalidad;

    }


     public static function obtenerPorIdLocalidad($id) {
        $sql = "SELECT localidades.id_localidad, localidades.descripcion, localidades.id_provincia FROM localidades WHERE id_localidad=". $id;



        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
            return false;
        }

        $registro = $datos->fetch_assoc();
        $localidad = self::_crearLocalidad($registro);
        return $localidad;

    }


      public function eliminar() {

        $sql = "UPDATE localidades  " 
             . "SET estado = 2 "
             . "WHERE localidades.id_localidad = {$this->_idLocalidad}";
        
        $database = new MySQL();
        $database->eliminar($sql);

    }

     private static function _crearLocalidad($datos) {
        $localidad = new Localidad();
        $localidad->_idLocalidad = $datos["id_localidad"];
        $localidad->_descripcion = $datos["descripcion"];
        $localidad->_idProvincia= $datos["id_provincia"];
        

        return $localidad;
    }
}


?>