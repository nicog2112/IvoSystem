<?php

require_once "MySQL.php";


class EstadoPedido {

	private $_idEstadoPedido; 
	private $_descripcion;

    /**
     * @return mixed
     */
    public function getIdEstadoPedido()
    {
        return $this->_idEstadoPedido;
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

    	$sql = "SELECT * FROM estadopedido";

    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoEstadoPedido = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$estadoPedido = new EstadoPedido();
			$estadoPedido->_idEstadoPedido = $registro["id_estado_pedido"];
			$estadoPedido->_descripcion = $registro["descripcion"];
    		$listadoEstadoPedido[] = $estadoPedido;
    	}


    	return $listadoEstadoPedido;

	}

    public static function obtenerPorId($id) {
        $sql = "SELECT  estadopedido.id_estado_pedido, estadopedido.descripcion "
             . " FROM estadopedido WHERE id_estado_pedido=" . $id;


        $database = new MySQL();
        $datos = $database->consultar($sql);

        $registro = $datos->fetch_assoc();

       $estadoPedido = new EstadoPedido();
        $estadoPedido->_idEstadoPedido = $registro["id_estado_pedido"];
        $estadoPedido->_descripcion = $registro["descripcion"];
      
        return $estadoPedido;

    }

    
}


?>