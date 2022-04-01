<?php

require_once "MySQL.php";
require_once "ProductoTalle.php";
require_once "Venta.php";


class DetalleVenta {

	protected $_idDetalleVenta;
	protected $_precio;
	protected $_cantidad;
	protected $_idPedidoCliente;
	protected $_idProductoTalle;
	protected $_idProductoPromocion;

	public $productoTalle;
	public $pedidoCliente;
	


	public function getIdDetalleVenta() {
		return $this->_idDetalleVenta;
	}
	public function getPrecio() {
		return $this->_precio;
	}

	public function setPrecio($precio) {
		$this->_precio = $precio;
	}

	public function getCantidad() {
		return $this->_cantidad;
	}

	public function setCantidad($cantidad) {
		$this->_cantidad = $cantidad;
	}
	
	public function getIdPedidoCliente() {
		return $this->_idPedidoCliente;
	}

	public function setIdPedidoCliente($idPedidoCliente) {
		$this->_idPedidoCliente = $idPedidoCliente;
	}

	public function getIdProductoTalle() {
		return $this->_idProductoTalle;
	}

	public function setIdProductoTalle($idProductoTalle) {
		$this->_idProductoTalle = $idProductoTalle;
	}

	public function getIdProductoPromocion() {
		return $this->_idProductoPromocion;
	}

	public function setIdProductoPromocion($idProductoPromocion) {
		$this->_idProductoPromocion = $idProductoPromocion;
	}


	public function guardar() {

		$database = new MySQL();

		$sql = "INSERT INTO detallepedido(`id_detalle_pedido`,`id_producto_talle`,`id_pedido_cliente`, `cantidad`,`precio_venta`, `id_producto_promocion`) VALUES (NULL,'{$this->_idProductoTalle}', '{$this->_idPedidoCliente}','{$this->_cantidad}','{$this->_precio}', '{$this->_idProductoPromocion}');";
	
		$database->insertar($sql);

	}


	public static function obtenerPorIdVenta($id_venta) {
    	$sql = "SELECT * from detallepedido where id_pedido_cliente =".$id_venta;
    	
    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoDetalleVentas = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$detalleVenta = new DetalleVenta();
			$detalleVenta->_idDetalleVenta = $registro["id_detalle_pedido"];
			$detalleVenta->_cantidad= $registro["cantidad"];
			$detalleVenta->_precio = $registro["precio_venta"];
			$detalleVenta->_idPedidoCliente = $registro["id_pedido_cliente"];
			$detalleVenta->_idProductoTalle = $registro["id_producto_talle"];
			$detalleVenta->_idProductoPromocion = $registro["id_producto_promocion"];
			$detalleVenta->productoTalle = ProductoTalle::obtenerPorId($detalleVenta->_idProductoTalle);
    		$listadoDetalleVentas[] = $detalleVenta;
    	}


    	return $listadoDetalleVentas;
	}
	public static function obtenerId() {
        $sql = "SELECT id_detalle_pedido FROM detallepedido ORDER BY id_detalle_pedido DESC LIMIT 1;";

    
        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
            return false;
        }

        $registro = $datos->fetch_assoc();
        $detalleVenta = self::_crearDetalleVenta($registro);
        return $detalleVenta;

    }

    public static function obtenerTodosMasVentas() {
		$sql = "SELECT * ,sum(detallepedido.cantidad) as cantidad  FROM pedidoclente 
		join detallepedido on pedidoclente.id_pedido_cliente = detallepedido.id_pedido_cliente
		join productotalle on detallepedido.id_producto_talle = productotalle.id_producto_talle
		join producto on productotalle.id_producto = producto.id_producto
		 where pedidoclente.id_estado_pedido = 1
		GROUP BY producto.id_producto
		ORDER BY cantidad DESC
		";


		$database = new MySQL();
		$datos = $database->consultar($sql);

		$listadoProducto = [];

		$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoDetalleVentas = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$detalleVenta = new DetalleVenta();
			$detalleVenta->_idDetalleVenta = $registro["id_detalle_pedido"];
			$detalleVenta->_cantidad= $registro["cantidad"];
			$detalleVenta->_precio = $registro["precio_venta"];
			$detalleVenta->_idPedidoCliente = $registro["id_pedido_cliente"];
			$detalleVenta->_idProductoTalle = $registro["id_producto_talle"];
			$detalleVenta->_idProductoPromocion = $registro["id_producto_promocion"];
			$detalleVenta->productoTalle = ProductoTalle::obtenerPorId($detalleVenta->_idProductoTalle);
			$detalleVenta->pedidoCliente = Venta::obtenerPorId($detalleVenta->_idPedidoCliente);
    		$listadoDetalleVentas[] = $detalleVenta;
    	}
		return $listadoDetalleVentas;
	}

	 public static function obtenerPorId($idDetalleVenta) {
		$sql = "SELECT * FROM detallepedido WHERE id_detalle_pedido={$idDetalleVenta}";



		$database = new MySQL();
		$datos = $database->consultar($sql);

		$registro = $datos->fetch_assoc();

			$detalleVenta = new DetalleVenta();
			$detalleVenta->_idDetalleVenta = $registro["id_detalle_pedido"];
			$detalleVenta->_cantidad= $registro["cantidad"];
			$detalleVenta->_precio = $registro["precio_venta"];
			$detalleVenta->_idPedidoCliente = $registro["id_pedido_cliente"];
			$detalleVenta->_idProductoTalle = $registro["id_producto_talle"];
			$detalleVenta->_idProductoPromocion = $registro["id_producto_promocion"];
			$detalleVenta->productoTalle = ProductoTalle::obtenerPorId($detalleVenta->_idProductoTalle);
			$detalleVenta->pedidoCliente = Venta::obtenerPorId($detalleVenta->_idPedidoCliente);

    		

		return $detalleVenta;

	}


    public function eliminar() {

        $sql = "DELETE FROM categoria WHERE id_categoria={$this->_idCategoria}";
        
        $database = new MySQL();
        $database->eliminar($sql);

    }

     private static function _crearDetalleVenta($datos) {
        $detalleVenta = new DetalleVenta();
        $detalleVenta->_idDetalleVenta = $datos["id_detalle_pedido"];

        

        return $detalleVenta;
    }


}



?>