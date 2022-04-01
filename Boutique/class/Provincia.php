<?php

require_once "Pais.php";
require_once "MySQL.php";


class Provincia {

	private $_idProvincia; 
	private $_descripcion;
     private $_estado;
    public $_idPais; 

    public $pais;

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
    public function setIdPais($_idPais)
    {
        $this->_idPais = $_idPais;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getIdPais()
    {
        return $this->_idPais;
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


        $sql = "INSERT INTO provincia (`id_provincia`, `descripcion`,`id_pais`,`estado`) VALUES 
        (NULL, '{$this->_descripcion}','{$this->_idPais}',1)";


        $database->insertar($sql);
    }


    public function actualizar() {

        $database = new MySQL();

        $sql = "UPDATE provincia SET descripcion = '{$this->_descripcion}'"
             . "WHERE provincia.id_provincia = {$this->_idProvincia}";


        $database->actualizar($sql);

    }

	public static function obtenerTodos() {

    	$sql = "SELECT * FROM provincia  ";

    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoProvincia = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$provincia = new Provincia();
			$provincia->_idProvincia = $registro["id_provincia"];
			$provincia->_descripcion = $registro["descripcion"];
            $provincia->_idPais = $registro["id_pais"];
    		$listadoProvincia[] = $provincia;
    	}


    	return $listadoProvincia;

	}

    public static function obtenerPorId($idProvincia) {
        $sql = "SELECT * FROM provincia WHERE id_provincia={$idProvincia}";

        $database = new MySQL();
        $datos = $database->consultar($sql);

        $registro = $datos->fetch_assoc();

        $provincia = new Provincia();
        $provincia->_idProvincia = $registro["id_provincia"];
        $provincia->_descripcion = $registro["descripcion"];
        $provincia->_idPais = $registro["id_pais"];
      
        return $provincia;

    }

    public static function obtenerPorIdPais($idPais,$filtroEstado = 0) {
        $sql = "SELECT * FROM provincia WHERE id_pais={$idPais}";
        $where = "";

        if ($filtroEstado != 0) {
            // $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
            $where = "and estado = " . $filtroEstado;
        }

        $sql = $sql . " " . $where;

        $database = new MySQL();
        $datos = $database->consultar($sql);

        $listadoProvincia = [];

        while ($registro = $datos->fetch_assoc()) {
        $provincia = new Provincia();
        $provincia->_idProvincia = $registro["id_provincia"];
        $provincia->_descripcion = $registro["descripcion"];
        $provincia->_idPais = $registro["id_pais"];
        $provincia->_estado = $registro["estado"];
        $listadoProvincia[] = $provincia;
        }
      
       return $listadoProvincia;

    }

     public static function obtenerPorIdProvincia($id) {
        $sql = "SELECT provincia.id_provincia, provincia.descripcion, provincia.id_pais FROM provincia WHERE id_provincia=". $id;



        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
            return false;
        }

        $registro = $datos->fetch_assoc();
        $provincia = self::_crearProvincia($registro);
        return $provincia;

    }


     public function eliminar() {

        $sql = "UPDATE provincia  " 
             . "SET estado = 2 "
             . "WHERE provincia.id_provincia = {$this->_idProvincia}";
        
        $database = new MySQL();
        $database->eliminar($sql);

    }

     private static function _crearProvincia($datos) {
        $provincia = new Provincia();
        $provincia->_idProvincia = $datos["id_provincia"];
        $provincia->_descripcion = $datos["descripcion"];
        $provincia->_idPais = $datos["id_pais"];
        

        return $provincia;
    }


    
}


?>