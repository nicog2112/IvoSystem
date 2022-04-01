<?php

require_once "MySQL.php";


class EstadosPagos {

	private $_idEstadosPagos; 
	private $_descripcion;

    /**
     * @return mixed
     */
    public function getIdEstadosPagos()
    {
        return $this->_idEstadosPagos;
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

	public static function obtenerTodos() {

    	$sql = "SELECT * FROM estados_pagos";

    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoEstadosPagos = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$estadosPagos = new EstadosPagos();
			$estadosPagos->_idEstadosPagos = $registro["id_estados_pagos"];
			$estadosPagos->_descripcion = $registro["descripcion"];
    		$listadoEstadosPagos[] = $estadosPagos;
    	}


    	return $listadoEstadosPagos;

	}

    public static function obtenerPorId($id) {
        $sql = "SELECT  talle.id_talle, talle.descripcion "
             . " FROM talle WHERE id_talle=" . $id;


        $database = new MySQL();
        $datos = $database->consultar($sql);

       if($datos = $database->consultar($sql)){
            $registro = $datos->fetch_assoc();
         }

        $talle = new Talle();
        $talle->_idTalle = $registro["id_talle"];
        $talle->_descripcion = $registro["descripcion"];
      
        return $talle;

    }

    
}


?>
