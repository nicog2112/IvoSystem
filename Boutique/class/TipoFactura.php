<?php

require_once "MySQL.php";


class TipoFactura {

	private $_idTipoFactura; 
	private $_descripcion;
    private $_estado;

    /**
     * @return mixed
     */
    public function getIdTipoFactura()
    {
        return $this->_idTipoFactura;
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

    	$sql = "SELECT * FROM tipos_facturas";

        $where = "";

        if ($filtroEstado != 0) {
            // $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
            $where = "WHERE estado = " . $filtroEstado;
        }

        $sql = $sql . " " . $where;
     

    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoTipoFactura = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$tipoFactura = new TipoFactura();
			$tipoFactura->_idTipoFactura = $registro["id_tipos_facturas"];
			$tipoFactura->_descripcion = $registro["descripcion"];
            $tipoFactura->_estado = $registro["estado"];
    		$listadoTipoFactura[] = $tipoFactura;
    	}


    	return $listadoTipoFactura;

	}

    public static function obtenerTodosActivos() {

        $sql = "SELECT * FROM tipos_facturas WHERE estado = 1";

    

        $database = new MySQL();
        $datos = $database->consultar($sql);

        $listadoTipoFactura = [];

        while ($registro = $datos->fetch_assoc()) {
            $tipoFactura = new TipoFactura();
            $tipoFactura->_idTipoFactura = $registro["id_tipos_facturas"];
            $tipoFactura->_descripcion = $registro["descripcion"];
            $tipoFactura->_estado = $registro["estado"];
            $listadoTipoFactura[] = $tipoFactura;
        }


        return $listadoTipoFactura;

    }

    public static function obtenerPorId($id) {
        $sql = "SELECT  * from tipos_facturas WHERE id_tipos_facturas=" . $id;
          

        $database = new MySQL();
        $datos = $database->consultar($sql);

       if($datos = $database->consultar($sql)){
            $registro = $datos->fetch_assoc();
         }

           $tipoFactura = new TipoFactura();
            $tipoFactura->_idTipoFactura = $registro["id_tipos_facturas"];
            $tipoFactura->_descripcion = $registro["descripcion"];
      
        return $tipoFactura;

    }

    public function guardar() {

        $database = new MySQL();

        $sql = "INSERT INTO tipos_facturas "
             . "(`id_tipos_facturas`, `descripcion` , `estado`)  "
             . "VALUES (NULL, '{$this->_descripcion}',1)";

        $database->insertar($sql);

    }


  public function actualizar() {

        $database = new MySQL();

        $sql = "UPDATE tipos_facturas SET descripcion = '{$this->_descripcion}' "
             . "WHERE tipos_facturas.id_tipos_facturas = {$this->_idTipoFactura}";


        $database->actualizar($sql);

    }

    public function eliminar() {

        $sql = "UPDATE tipos_facturas  " 
             . "SET estado = 2 "
             . "WHERE tipos_facturas.id_tipos_facturas = {$this->_idTipoFactura}";

        
        $database = new MySQL();
        $database->eliminar($sql);

    }

}


?>
