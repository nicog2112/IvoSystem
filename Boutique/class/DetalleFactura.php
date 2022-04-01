<?php

require_once "MySQL.php";
require_once "DetalleVenta.php";
require_once "Factura.php";



class DetalleFactura {

	private $_idFacturaDetalle; 
	private $_idDetallePedido;
    private $_idFactura;

    public $detalleVenta;
    public $factura;


    /**
     * @return mixed
     */
    public function getIdFacturaDetalle()
    {
        return $this->_idFacturaDetalle;
    }

        /**
     * @return mixed
     */
    public function setIdDetallePedido($_idDetallePedido)
    {
        $this->_idDetallePedido = $_idDetallePedido;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getIdDetallePedido()
    {
        return $this->_idDetallePedido;
    }


        /**
     * @return mixed
     */
    public function setIdFactura($_idFactura)
    {
        $this->_idFactura = $_idFactura;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getIdFactura()
    {
        return $this->_idFactura;
    }


    public function guardar() {

        $database = new MySQL();

        $sql = "INSERT INTO facturasdetalles(`id_factura_detalle`,`id_detalle_pedido`,
        `id_factura`) VALUES (NULL,'{$this->_idDetallePedido}', '{$this->_idFactura}');";
     

        
        $database->insertar($sql);

    }

	public static function obtenerTodos() {

    	$sql = "SELECT * FROM tipos_facturas";

    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoTipoFactura = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$tipoFactura = new TipoFactura();
			$tipoFactura->_idTipoFactura = $registro["id_tipos_facturas"];
			$tipoFactura->_descripcion = $registro["descripcion"];
    		$listadoTipoFactura[] = $tipoFactura;
    	}


    	return $listadoTipoFactura;

	}

    public static function obtenerPorIdVenta($id_venta) {
        $sql = "select * from pedidoclente join detallepedido on detallepedido.id_pedido_cliente = pedidoclente.id_pedido_cliente
join facturasdetalles on facturasdetalles.id_detalle_pedido = detallepedido.id_detalle_pedido
join factura on factura.id_factura = facturasdetalles.id_factura where pedidoclente.id_pedido_cliente =".$id_venta;
       
        $database = new MySQL();
        $datos = $database->consultar($sql);

        $listadoDetalleFactura = [];

        while ($registro = $datos->fetch_assoc()) {
            $detalleFactura = new DetalleFactura();
            $detalleFactura->_idFacturaDetalle = $registro["id_factura_detalle"];
            $detalleFactura->_idDetallePedido= $registro["id_detalle_pedido"];
            $detalleFactura->_idFactura = $registro["id_factura"];
            $detalleFactura->detalleVenta = DetalleVenta::obtenerPorId($detalleFactura->_idDetallePedido);
            $detalleFactura->factura = Factura::obtenerPorId($detalleFactura->_idFactura);


            $listadoDetalleFactura[] = $detalleFactura;
        }


        return $listadoDetalleFactura;
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
