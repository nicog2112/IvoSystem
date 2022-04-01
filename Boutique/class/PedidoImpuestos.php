<?php

require_once "MySQL.php";
require_once "TiposImpositivos.php";


class PedidoImpuestos{

	private $_idPedidoImpuesto; 
    private $_valorPorcentaje;
    private $_idTiposImpositivos;
    private $_idVenta;

    public $tiposImpositivos;

    /**
     * @return mixed
     */
    public function getIdPedidoImpuestos()
    {
        return $this->_idPedidoImpuesto;
    }

        /**
     * @return mixed
     */
    public function setIdTiposImpositivos($_idTiposImpositivos)
    {
        $this->_idTiposImpositivos = $_idTiposImpositivos;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getIdTiposImpositivos()
    {
        return $this->_idTiposImpositivos;
    }

        /**
     * @return mixed
     */
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
    public function setIdVenta($_idVenta)
    {
        $this->_idVenta = $_idVenta;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getIdVenta()
    {
        return $this->_idVenta;
    }

     public function guardar() {

        $database = new MySQL();
       


        $sql = "INSERT INTO detallepedidoimpuestos(`id_DetallePedidoImpuesto`,`valor_porcentaje`,`id_tipos_impositivos`,
        `id_pedido_cliente`) VALUES (NULL,'{$this->_valorPorcentaje}', '{$this->_idTiposImpositivos}','{$this->_idVenta}');";
      

        $database->insertar($sql);

    }

    public static function obtenerPorIdVenta($idVenta) {
        $sql = "SELECT * FROM detallepedidoimpuestos where id_pedido_cliente =". $idVenta;



        $database = new MySQL();
        $datos = $database->consultar($sql);

        $listadoPedidoImpuestos = [];

        while ($registro = $datos->fetch_assoc()) {
            $pedidoImpuestos = new PedidoImpuestos();
            $pedidoImpuestos->_idPedidoImpuesto = $registro["id_DetallePedidoImpuesto"];
            $pedidoImpuestos->_idTiposImpositivos = $registro["id_tipos_impositivos"];
            $pedidoImpuestos->_valorPorcentaje = $registro["valor_porcentaje"];
            $pedidoImpuestos->_idVenta = $registro["id_pedido_cliente"];
            $pedidoImpuestos->tiposImpositivos = TiposImpositivos::obtenerPorId($pedidoImpuestos->_idTiposImpositivos);
            $listadoPedidoImpuestos[] = $pedidoImpuestos;
        }


        return $listadoPedidoImpuestos;

    }

	public static function obtenerTodos() {

    	$sql = "SELECT * FROM tipos_impositivos";

    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoTiposImpositivos = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$tiposImpositivos = new TiposImpositivos();
			$tiposImpositivos->_idTipoFactura = $registro["id_tipos_impositivos"];
			$tiposImpositivos->_descripcion = $registro["descripcion"];
            $tiposImpositivos->_valorPorcentaje = $registro["valor_porcentaje"];
            $tiposImpositivos->_estado = $registro["estado"];
    		$listadoTiposImpositivos[] = $tiposImpositivos;
    	}


    	return $listadoTiposImpositivos;

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
