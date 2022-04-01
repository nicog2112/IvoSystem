<?php

require_once "MySQL.php";
require_once "ProductoTalle.php";


class DetalleCompra {

	protected $_idDetalleCompra;
	protected $_precio;
	protected $_cantidad;
	protected $_idPedidoProveedor;
	protected $_idProductoTalle;
	
	public $productoTalle;
	public $pedidoProveedor;
	


	public function getIdDetalleCompra() {
		return $this->_idDetalleCompra;
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
	
	public function getIdPedidoProveedor() {
		return $this->_idPedidoProveedor;
	}

	public function setIdPedidoProveedor($idPedidoProveedor) {
		$this->_idPedidoProveedor = $idPedidoProveedor;
	}

	public function getIdProductoTalle() {
		return $this->_idProductoTalle;
	}

	public function setIdProductoTalle($idProductoTalle) {
		$this->_idProductoTalle = $idProductoTalle;
	}



	public function guardar() {

		$database = new MySQL();

		$sql = "INSERT INTO detallepedidoproveedor(`id_detalle_pedido_proveedor`,`id_producto_talle`,`id_pedido_proveedor`, `cantidad`,`precio`) VALUES (NULL,'{$this->_idProductoTalle}', '{$this->_idPedidoProveedor}','{$this->_cantidad}','{$this->_precio}');";

	
		$database->insertar($sql);

	}


	public static function obtenerPorIdCompra($id_compra) {
    	$sql = "SELECT * from detallepedidoproveedor where id_pedido_proveedor =".$id_compra;
   

    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoDetalleCompras = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$detalleCompra = new DetalleCompra();
			$detalleCompra->_idDetalleCompra = $registro["id_detalle_pedido_proveedor"];
			$detalleCompra->_cantidad= $registro["cantidad"];
			$detalleCompra->_precio = $registro["precio"];
			$detalleCompra->_idPedidoProveedor = $registro["id_pedido_proveedor"];
			$detalleCompra->_idProductoTalle = $registro["id_producto_talle"];
			$detalleCompra->productoTalle = ProductoTalle::obtenerPorId($detalleCompra->_idProductoTalle);
    		$listadoDetalleCompras[] = $detalleCompra;
    	}


    	return $listadoDetalleCompras;
	}
	public static function obtenerId() {
        $sql = "SELECT id_detalle_pedido_proveedor FROM detallepedidoproveedor ORDER BY id_detalle_pedido_proveedor DESC LIMIT 1;";

    
        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
            return false;
        }

        $registro = $datos->fetch_assoc();
        $detalleCompra = self::_crearDetalleCompra($registro);
        return $detalleCompra;

    }

	 public static function obtenerPorId($idDetalleCompra) {
		$sql = "SELECT * FROM detallepedidoproveedor WHERE id_detalle_pedido_proveedor={$idDetalleCompra}";



		$database = new MySQL();
		$datos = $database->consultar($sql);

		$registro = $datos->fetch_assoc();

			$detalleCompra = new DetalleCompra();
			$detalleCompra->_idDetalleCompra = $registro["id_detalle_pedido_proveedor"];
			$detalleCompra->_cantidad= $registro["cantidad"];
			$detalleCompra->_precio = $registro["precio"];
			$detalleCompra->_idPedidoProveedor = $registro["id_pedido_proveedor"];
			$detalleCompra->_idProductoTalle = $registro["id_producto_talle"];
			$detalleCompra->productoTalle = ProductoTalle::obtenerPorId($detalleCompra->_idProductoTalle);
			$detalleCompra->pedidoProveedor = Compra::obtenerPorId($detalleCompra->_idPedidoProveedor);

    		

		return $detalleCompra;

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