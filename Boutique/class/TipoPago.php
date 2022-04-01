<?php

require_once "MySQL.php";


class TipoPago {

	private $_idTipoPago; 
	private $_descripcion;
    private $_valorPorcentaje;
    private $_estado;

    /**
     * @return mixed
     */
    public function getIdTipoPago()
    {
        return $this->_idTipoPago;
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

    public function setValorPorcentaje($_valorPorcentaje)
    {
        $this->_valorPorcentaje = $_valorPorcentaje;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getValorPorcentaje()
    {
        return $this->_valorPorcentaje;
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

    	$sql = "SELECT * FROM tipos_pagos";

        $where = "";

        if ($filtroEstado != 0) {
            // $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
            $where = "WHERE estado = " . $filtroEstado;
        }

        $sql = $sql . " " . $where;
     

    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoTipoPago = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$tipoPago = new TipoPago();
			$tipoPago->_idTipoPago = $registro["id_tipos_pagos"];
			$tipoPago->_descripcion = $registro["descripcion"];
            $tipoPago->_valorPorcentaje = $registro["valor_porcentaje"];
            $tipoPago->_estado = $registro["estado"];
    		$listadoTipoPago[] = $tipoPago;
    	}


    	return $listadoTipoPago;

	}

    public static function obtenerTodosActivos() {

        $sql = "SELECT * FROM tipos_pagos where estado = 1";

       

        $database = new MySQL();
        $datos = $database->consultar($sql);

        $listadoTipoPago = [];

        while ($registro = $datos->fetch_assoc()) {
            $tipoPago = new TipoPago();
            $tipoPago->_idTipoPago = $registro["id_tipos_pagos"];
            $tipoPago->_descripcion = $registro["descripcion"];
            $tipoPago->_valorPorcentaje = $registro["valor_porcentaje"];
            $tipoPago->_estado = $registro["estado"];
            $listadoTipoPago[] = $tipoPago;
        }


        return $listadoTipoPago;

    }

    public static function obtenerPorId($id) {
        $sql = "SELECT  * from tipos_pagos WHERE id_tipos_pagos=" . $id;


        $database = new MySQL();
        $datos = $database->consultar($sql);

       if($datos = $database->consultar($sql)){
            $registro = $datos->fetch_assoc();
         }

        $tipoPago = new TipoPago();
            $tipoPago->_idTipoPago = $registro["id_tipos_pagos"];
            $tipoPago->_descripcion = $registro["descripcion"];
            $tipoPago->_valorPorcentaje = $registro["valor_porcentaje"];
      
        return $tipoPago;

    }

    public function guardar() {

        $database = new MySQL();

        $sql = "INSERT INTO tipos_pagos "
             . "(`id_tipos_pagos`, `descripcion`, `valor_porcentaje`,`estado`)  "
             . "VALUES (NULL, '{$this->_descripcion}','{$this->_valorPorcentaje}',1)";
     
        $database->insertar($sql);

    }


  public function actualizar() {

        $database = new MySQL();

        $sql = "UPDATE tipos_pagos SET descripcion = '{$this->_descripcion}' , `valor_porcentaje` = '{$this->_valorPorcentaje}' "
             . "WHERE tipos_pagos.id_tipos_pagos = {$this->_idTipoPago}";


        $database->actualizar($sql);

    }

    public function eliminar() {

        $sql = "UPDATE tipos_pagos  " 
             . "SET estado = 2 "
             . "WHERE tipos_pagos.id_tipos_pagos = {$this->_idTipoPago}";

        
        $database = new MySQL();
        $database->eliminar($sql);

    }

    
}


?>
