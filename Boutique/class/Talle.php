<?php

require_once "MySQL.php";


class Talle {

	private $_idTalle; 
	private $_descripcion;
    private $_estado;

    /**
     * @return mixed
     */
    public function getIdTalle()
    {
        return $this->_idTalle;
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

    	$sql = "SELECT * FROM talle";

        $where = "";

        if ($filtroEstado != 0) {
            // $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
            $where = " where estado = " . $filtroEstado;
        }

        $sql = $sql . " " . $where;

    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoTalle = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$talle = new Talle();
			$talle->_idTalle = $registro["id_talle"];
			$talle->_descripcion = $registro["descripcion"];
            $talle->_estado = $registro["estado"];
    		$listadoTalle[] = $talle;
    	}


    	return $listadoTalle;

	}

    public static function obtenerTodosActivos() {

        $sql = "SELECT * FROM talle where estado = 1";

        $database = new MySQL();
        $datos = $database->consultar($sql);

        $listadoTalle = [];

        while ($registro = $datos->fetch_assoc()) {
            $talle = new Talle();
            $talle->_idTalle = $registro["id_talle"];
            $talle->_descripcion = $registro["descripcion"];
            $talle->_estado = $registro["estado"];
            $listadoTalle[] = $talle;
        }


        return $listadoTalle;

    }

    public static function obtenerPorId($id) {
        $sql = "SELECT  * "
             . " FROM talle WHERE id_talle=" . $id;


        $database = new MySQL();
        $datos = $database->consultar($sql);

       if($datos = $database->consultar($sql)){
            $registro = $datos->fetch_assoc();
         }

        $talle = new Talle();
        $talle->_idTalle = $registro["id_talle"];
        $talle->_descripcion = $registro["descripcion"];
        $talle->_estado = $registro["estado"];
        
        return $talle;

    }


    public function guardar() {

        $database = new MySQL();

        $sql = "INSERT INTO talle "
             . "(`id_talle`, `descripcion`,`estado`)  "
             . "VALUES (NULL, '{$this->_descripcion}',1)";

        
        $database->insertar($sql);

    }

    public function actualizar() {

        $database = new MySQL();

        $sql = "UPDATE talle SET descripcion = '{$this->_descripcion}'"
             . "WHERE id_talle = {$this->_idTalle}";


        $database->actualizar($sql);

    }

     public function eliminar() {

        $sql = "UPDATE talle  " 
             . "SET estado = 2 "
             . "WHERE id_talle = {$this->_idTalle}";
        
        $database = new MySQL();
        $database->eliminar($sql);

    }
    
}


?>
