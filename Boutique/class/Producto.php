<?php

require_once "MySQL.php";
require_once "Categoria.php";
require_once "temporada.php";



class Producto{

	private $_idProducto;
	private $_imagen;
	private $_nombre;
	private $_marca;
	private $_descripcion;
	private $_precioCompra;
	private $_precioVenta;
	private $_fecha;
	private $_idTemporada;
	private $_idCategoria;
	private $_estado;

	public $temporada;
	public $categoria;

	public function getIdProducto() {
		return $this->_idProducto;
	}
	public function getImagen() {
		return $this->_imagen;
	}

	public function setImagen($imagen) {
		$this->_imagen = $imagen;
	}

	public function getNombreProducto() {
		return $this->_nombre;
	}

	public function setNombreProducto($nombre) {
		$this->_nombre = $nombre;
	}

	public function getMarca() {
		return $this->_marca;
	}

	public function setMarca($marca) {
		$this->_marca = $marca;
	}

	public function getDescripcion() {
		return $this->_descripcion;
	}

	public function setDescripcion($descripcion) {
		$this->_descripcion = $descripcion;
	}

	public function getPrecioCompra() {
		return $this->_precioCompra;
	}

	public function setPrecioCompra($precioCompra) {
		$this->_precioCompra = $precioCompra;
	}

	public function getPrecioVenta() {
		return $this->_precioVenta;
	}

	public function setPrecioVenta($precioVenta) {
		$this->_precioVenta = $precioVenta;
	}

	public function getFecha() {
		return $this->_fecha;
	}

	public function setFecha($fecha) {
		$this->_fecha = $fecha;
	}

	public function getIdTemporada() {
		return $this->_idTemporada;
	}

	public function setIdTemporada($idTemporada) {
		$this->_idTemporada = $idTemporada;
	}

	public function getIdCategoria() {
		return $this->_idCategoria;
	}

	public function setIdCategoria($idCategoria) {
		$this->_idCategoria = $idCategoria;
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

		If ( $_FILES['imagenProductoNuevo']['name'] =="" ) {
		$sql = "INSERT INTO producto "
		. "(`id_producto`, `imagen`, `nombre`, `marca`, `descripcion`, `precio_compra`, `precio_venta`, `fecha`, `id_temporada`, `id_categoria`, `estado`)  "
		. "VALUES (NULL, 'Imagenes/Predeterminada.png', '{$this->_nombre}','{$this->_marca}',"
		."'{$this->_descripcion}','{$this->_precioCompra}','{$this->_precioVenta}',"
		."'{$this->_fecha}','{$this->_idTemporada}','{$this->_idCategoria}',1)";
		 } else {

		 	$sql = "INSERT INTO producto "
		. "(`id_producto`, `imagen`, `nombre`, `marca`, `descripcion`, `precio_compra`, `precio_venta`, `fecha`, `id_temporada`, `id_categoria`, `estado`)  "
		. "VALUES (NULL, '{$this->_imagen}', '{$this->_nombre}','{$this->_marca}',"
		."'{$this->_descripcion}','{$this->_precioCompra}','{$this->_precioVenta}',"
		."'{$this->_fecha}','{$this->_idTemporada}','{$this->_idCategoria}',1)";
		 }
		$database->insertar($sql);

	}


	public function actualizarPrecioCompra($precioCompra) {

		$database = new MySQL();

		$sql = "UPDATE producto SET precio_compra = ".$precioCompra." WHERE id_producto =  {$this->_idProducto};";




		$database->actualizar($sql);

	}

	public function actualizar() {

		$database = new MySQL();
		If ( $_FILES['imagenModificar']['name'] =="" ) {
			$sql = "UPDATE producto SET "
			. "nombre = '{$this->_nombre}', marca = '{$this->_marca}',"
			. "descripcion = '{$this->_descripcion}', precio_compra = '{$this->_precioCompra}',"
			. "precio_venta = '{$this->_precioVenta}', "
			. "id_temporada = '{$this->_idTemporada}', id_categoria = '{$this->_idCategoria}'"
			. "WHERE producto.id_producto = {$this->_idProducto}";
		} else {
			$sql = "UPDATE producto SET imagen = '{$this->_imagen}',"
			. "nombre = '{$this->_nombre}', marca = '{$this->_marca}',"
			. "descripcion = '{$this->_descripcion}', precio_compra = '{$this->_precioCompra}',"
			. "precio_venta = '{$this->_precioVenta}', "
			. "id_temporada = '{$this->_idTemporada}', id_categoria = '{$this->_idCategoria}'"
			. "WHERE producto.id_producto = {$this->_idProducto}";
		}


		$database->actualizar($sql);


	}

	public function actualizarPrecio() {

		$database = new MySQL();

		$sql = "UPDATE producto SET precio_venta = '{$this->_precioVenta}'
		WHERE producto.id_producto = {$this->_idProducto}";


		
		$database->actualizar($sql);


	}

	public static function obtenerTodos($filtroEstado = 0) {
		$sql = "SELECT * from producto ";


		   $where = "";

        if ($filtroEstado != 0) {
            // $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
            $where = "where producto.estado = " . $filtroEstado;
        }

        $sql = $sql . " " . $where;


		$database = new MySQL();
		$datos = $database->consultar($sql);

		$listadoProducto = [];

		while ($registro = $datos->fetch_assoc()) {
			$producto = new Producto();
			$producto->_idProducto = $registro["id_producto"];
			$producto->_nombre = $registro["nombre"];
			$producto->_marca = $registro["marca"];
			$producto->_descripcion = $registro["descripcion"];
			$producto->_precioCompra = $registro["precio_compra"];
			$producto->_precioVenta = $registro["precio_venta"];
			$producto->_fecha = $registro["fecha"];
			$producto->_imagen = $registro["imagen"];
			$producto->_idTemporada = $registro["id_temporada"];
			$producto->_idCategoria = $registro["id_categoria"];
			$producto->_estado = $registro["estado"];
			$producto->categoria = Categoria::obtenerPorId($producto->_idCategoria);
			$producto->temporada = Temporada::obtenerPorId($producto->_idTemporada);
			$listadoProducto[] = $producto;
		}

		return $listadoProducto;
	}


	public static function obtenerTodosActivos() {
		$sql = "SELECT * from producto where estado = 1 ";


		 

		$database = new MySQL();
		$datos = $database->consultar($sql);

		$listadoProducto = [];

		while ($registro = $datos->fetch_assoc()) {
			$producto = new Producto();
			$producto->_idProducto = $registro["id_producto"];
			$producto->_nombre = $registro["nombre"];
			$producto->_marca = $registro["marca"];
			$producto->_descripcion = $registro["descripcion"];
			$producto->_precioCompra = $registro["precio_compra"];
			$producto->_precioVenta = $registro["precio_venta"];
			$producto->_fecha = $registro["fecha"];
			$producto->_imagen = $registro["imagen"];
			$producto->_idTemporada = $registro["id_temporada"];
			$producto->_idCategoria = $registro["id_categoria"];
			$producto->_estado = $registro["estado"];
			$producto->categoria = Categoria::obtenerPorId($producto->_idCategoria);
			$producto->temporada = Temporada::obtenerPorId($producto->_idTemporada);
			$listadoProducto[] = $producto;
		}

		return $listadoProducto;
	}

	public static function obtenerTodosPorCategoria($idCategoria) {
		$sql = "SELECT * from producto as p
join productotalle as pt on p.id_producto = pt.id_producto  
WHERE p.estado = 1 and pt.cantidad_disponible > 0 and id_categoria = {$idCategoria} group by p.id_producto";


		$database = new MySQL();
		$datos = $database->consultar($sql);

		$listadoProducto = [];

		while ($registro = $datos->fetch_assoc()) {
			$producto = new Producto();
			$producto->_idProducto = $registro["id_producto"];
			$producto->_nombre = $registro["nombre"];
			$producto->_marca = $registro["marca"];
			$producto->_descripcion = $registro["descripcion"];
			$producto->_precioCompra = $registro["precio_compra"];
			$producto->_precioVenta = $registro["precio_venta"];
			$producto->_fecha = $registro["fecha"];
			$producto->_imagen = $registro["imagen"];
			$producto->_idTemporada = $registro["id_temporada"];
			$producto->_idCategoria = $registro["id_categoria"];
			$producto->categoria = Categoria::obtenerPorId($producto->_idCategoria);
			$producto->temporada = Temporada::obtenerPorId($producto->_idTemporada);
			$listadoProducto[] = $producto;
		}

		return $listadoProducto;
	}


	public static function obtenerTodosMasVentas() {
		$sql = "SELECT * ,sum(detallepedido.cantidad)  FROM pedidoclente 
		join detallepedido on pedidoclente.id_pedido_cliente = detallepedido.id_pedido_cliente
		join productotalle on detallepedido.id_producto_talle = productotalle.id_producto_talle
		join producto on productotalle.id_producto = producto.id_producto
		where productotalle.cantidad_disponible > 0
		GROUP BY producto.id_producto
		ORDER BY SUM(detallepedido.cantidad) DESC
		";


		$database = new MySQL();
		$datos = $database->consultar($sql);

		$listadoProducto = [];

		while ($registro = $datos->fetch_assoc()) {
			$producto = new Producto();
			$producto->_idProducto = $registro["id_producto"];
			$producto->_nombre = $registro["nombre"];
			$producto->_marca = $registro["marca"];
			$producto->_descripcion = $registro["descripcion"];
			$producto->_precioCompra = $registro["precio_compra"];
			$producto->_precioVenta = $registro["precio_venta"];
			$producto->_fecha = $registro["fecha"];
			$producto->_imagen = $registro["imagen"];
			$producto->_idTemporada = $registro["id_temporada"];
			$producto->_idCategoria = $registro["id_categoria"];
			$producto->categoria = Categoria::obtenerPorId($producto->_idCategoria);
			$producto->temporada = Temporada::obtenerPorId($producto->_idTemporada);
			$listadoProducto[] = $producto;
		}

		return $listadoProducto;
	}

		public static function obtenerTodosMasVentasPrimero() {
		$sql = "SELECT * ,sum(detallepedido.cantidad)  FROM pedidoclente 
		join detallepedido on pedidoclente.id_pedido_cliente = detallepedido.id_pedido_cliente
		join productotalle on detallepedido.id_producto_talle = productotalle.id_producto_talle
		join producto on productotalle.id_producto = producto.id_producto
		where producto.estado = 1 and productotalle.cantidad_disponible > 0
		GROUP BY producto.id_producto
		ORDER BY SUM(detallepedido.cantidad) DESC
		LIMIT 4
		";


		$database = new MySQL();
		$datos = $database->consultar($sql);

		$listadoProducto = [];

		while ($registro = $datos->fetch_assoc()) {
			$producto = new Producto();
			$producto->_idProducto = $registro["id_producto"];
			$producto->_nombre = $registro["nombre"];
			$producto->_marca = $registro["marca"];
			$producto->_descripcion = $registro["descripcion"];
			$producto->_precioCompra = $registro["precio_compra"];
			$producto->_precioVenta = $registro["precio_venta"];
			$producto->_fecha = $registro["fecha"];
			$producto->_imagen = $registro["imagen"];
			$producto->_idTemporada = $registro["id_temporada"];
			$producto->_idCategoria = $registro["id_categoria"];
			$producto->categoria = Categoria::obtenerPorId($producto->_idCategoria);
			$producto->temporada = Temporada::obtenerPorId($producto->_idTemporada);
			$listadoProducto[] = $producto;
		}

		return $listadoProducto;
	}


	public static function obtenerTodosMasVentasTRES() {
		$sql = "SELECT * ,sum(detallepedido.cantidad)  FROM pedidoclente 
		join detallepedido on pedidoclente.id_pedido_cliente = detallepedido.id_pedido_cliente
		join productotalle on detallepedido.id_producto_talle = productotalle.id_producto_talle
		join producto on productotalle.id_producto = producto.id_producto
		GROUP BY producto.id_producto
		ORDER BY SUM(detallepedido.cantidad) DESC
		LIMIT 3;";


		$database = new MySQL();
		$datos = $database->consultar($sql);

		$listadoProducto = [];

		while ($registro = $datos->fetch_assoc()) {
			$producto = new Producto();
			$producto->_idProducto = $registro["id_producto"];
			$producto->_nombre = $registro["nombre"];
			$producto->_marca = $registro["marca"];
			$producto->_descripcion = $registro["descripcion"];
			$producto->_precioCompra = $registro["precio_compra"];
			$producto->_precioVenta = $registro["precio_venta"];
			$producto->_fecha = $registro["fecha"];
			$producto->_imagen = $registro["imagen"];
			$producto->_idTemporada = $registro["id_temporada"];
			$producto->_idCategoria = $registro["id_categoria"];
			$producto->categoria = Categoria::obtenerPorId($producto->_idCategoria);
			$producto->temporada = Temporada::obtenerPorId($producto->_idTemporada);
			$listadoProducto[] = $producto;
		}

		return $listadoProducto;
	}



	public static function obtenerTodosMasPorCategoria() {
		$sql = "SELECT *,sum(detallepedido.cantidad) FROM pedidoclente 
		join detallepedido on pedidoclente.id_pedido_cliente = detallepedido.id_pedido_cliente
		join productotalle on detallepedido.id_producto_talle = productotalle.id_producto_talle
		join producto on productotalle.id_producto = producto.id_producto
		join categoria on producto.id_categoria = categoria.id_categoria
		GROUP BY producto.id_categoria
		ORDER BY SUM(detallepedido.cantidad) DESC";


		$database = new MySQL();
		$datos = $database->consultar($sql);

		$listadoProducto = [];

		while ($registro = $datos->fetch_assoc()) {
			$producto = new Producto();
			$producto->_idProducto = $registro["id_producto"];
			$producto->_nombre = $registro["nombre"];
			$producto->_marca = $registro["marca"];
			$producto->_descripcion = $registro["descripcion"];
			$producto->_precioCompra = $registro["precio_compra"];
			$producto->_precioVenta = $registro["precio_venta"];
			$producto->_fecha = $registro["fecha"];
			$producto->_imagen = $registro["imagen"];
			$producto->_idTemporada = $registro["id_temporada"];
			$producto->_idCategoria = $registro["id_categoria"];
			$producto->categoria = Categoria::obtenerPorId($producto->_idCategoria);
			$producto->temporada = Temporada::obtenerPorId($producto->_idTemporada);
			$listadoProducto[] = $producto;
		}

		return $listadoProducto;
	}

	public static function obtenerTodosMasVentasDos() {
		$sql = "SELECT * ,sum(detallepedido.cantidad)  FROM pedidoclente 
		join detallepedido on pedidoclente.id_pedido_cliente = detallepedido.id_pedido_cliente
		join productotalle on detallepedido.id_producto_talle = productotalle.id_producto_talle
		join producto on productotalle.id_producto = producto.id_producto
		where producto.estado = 1 and productotalle.cantidad_disponible > 0
		GROUP BY producto.id_producto
		ORDER BY SUM(detallepedido.cantidad) ASC
		LIMIT 4;";


		$database = new MySQL();
		$datos = $database->consultar($sql);

		$listadoProducto = [];

		while ($registro = $datos->fetch_assoc()) {
			$producto = new Producto();
			$producto->_idProducto = $registro["id_producto"];
			$producto->_nombre = $registro["nombre"];
			$producto->_marca = $registro["marca"];
			$producto->_descripcion = $registro["descripcion"];
			$producto->_precioCompra = $registro["precio_compra"];
			$producto->_precioVenta = $registro["precio_venta"];
			$producto->_fecha = $registro["fecha"];
			$producto->_imagen = $registro["imagen"];
			$producto->_idTemporada = $registro["id_temporada"];
			$producto->_idCategoria = $registro["id_categoria"];
			$producto->categoria = Categoria::obtenerPorId($producto->_idCategoria);
			$producto->temporada = Temporada::obtenerPorId($producto->_idTemporada);
			$listadoProducto[] = $producto;
		}

		return $listadoProducto;
	}


	public static function obtenerTodosMasVentasTRESdos() {
		$sql = "SELECT * ,sum(detallepedido.cantidad)  FROM pedidoclente 
		join detallepedido on pedidoclente.id_pedido_cliente = detallepedido.id_pedido_cliente
		join productotalle on detallepedido.id_producto_talle = productotalle.id_producto_talle
		join producto on productotalle.id_producto = producto.id_producto
		GROUP BY producto.id_producto
		ORDER BY SUM(detallepedido.cantidad) ASC
		LIMIT 3;";


		$database = new MySQL();
		$datos = $database->consultar($sql);

		$listadoProducto = [];

		while ($registro = $datos->fetch_assoc()) {
			$producto = new Producto();
			$producto->_idProducto = $registro["id_producto"];
			$producto->_nombre = $registro["nombre"];
			$producto->_marca = $registro["marca"];
			$producto->_descripcion = $registro["descripcion"];
			$producto->_precioCompra = $registro["precio_compra"];
			$producto->_precioVenta = $registro["precio_venta"];
			$producto->_fecha = $registro["fecha"];
			$producto->_imagen = $registro["imagen"];
			$producto->_idTemporada = $registro["id_temporada"];
			$producto->_idCategoria = $registro["id_categoria"];
			$producto->categoria = Categoria::obtenerPorId($producto->_idCategoria);
			$producto->temporada = Temporada::obtenerPorId($producto->_idTemporada);
			$listadoProducto[] = $producto;
		}

		return $listadoProducto;
	}


	public static function obtenerTodosNuevosIngresos() {
		$sql = "SELECT * FROM producto as p 
join productotalle as ptt on p.id_producto = ptt.id_producto
WHERE p.estado = 1 and ptt.cantidad_disponible > 0 and NOT EXISTS(SELECT *
			FROM detallepedido as d join productotalle as pt on d.id_producto_talle = pt.id_producto_talle
			WHERE pt.id_producto = p.id_producto and pt.cantidad_disponible > 0)  group by p.id_producto ORDER BY p.id_producto DESC
		LIMIT 4;";


		$database = new MySQL();
		$datos = $database->consultar($sql);

		$listadoProducto = [];

		while ($registro = $datos->fetch_assoc()) {
			$producto = new Producto();
			$producto->_idProducto = $registro["id_producto"];
			$producto->_nombre = $registro["nombre"];
			$producto->_marca = $registro["marca"];
			$producto->_descripcion = $registro["descripcion"];
			$producto->_precioCompra = $registro["precio_compra"];
			$producto->_precioVenta = $registro["precio_venta"];
			$producto->_fecha = $registro["fecha"];
			$producto->_imagen = $registro["imagen"];
			$producto->_idTemporada = $registro["id_temporada"];
			$producto->_idCategoria = $registro["id_categoria"];
			$producto->categoria = Categoria::obtenerPorId($producto->_idCategoria);
			$producto->temporada = Temporada::obtenerPorId($producto->_idTemporada);
			$listadoProducto[] = $producto;
		}

		return $listadoProducto;
	}

	public static function obtenerTodosNuevosIngresosDos() {
		$sql = "SELECT * FROM producto as p 
join productotalle as ptt on p.id_producto = ptt.id_producto
WHERE p.estado = 1 and ptt.cantidad_disponible > 0 and NOT EXISTS(SELECT *
			FROM detallepedido as d join productotalle as pt on d.id_producto_talle = pt.id_producto_talle
			WHERE pt.id_producto = p.id_producto and pt.cantidad_disponible > 0)  group by p.id_producto ORDER BY p.id_producto ASC
		LIMIT 4";


		$database = new MySQL();
		$datos = $database->consultar($sql);

		$listadoProducto = [];

		while ($registro = $datos->fetch_assoc()) {
			$producto = new Producto();
			$producto->_idProducto = $registro["id_producto"];
			$producto->_nombre = $registro["nombre"];
			$producto->_marca = $registro["marca"];
			$producto->_descripcion = $registro["descripcion"];
			$producto->_precioCompra = $registro["precio_compra"];
			$producto->_precioVenta = $registro["precio_venta"];
			$producto->_fecha = $registro["fecha"];
			$producto->_imagen = $registro["imagen"];
			$producto->_idTemporada = $registro["id_temporada"];
			$producto->_idCategoria = $registro["id_categoria"];
			$producto->categoria = Categoria::obtenerPorId($producto->_idCategoria);
			$producto->temporada = Temporada::obtenerPorId($producto->_idTemporada);
			$listadoProducto[] = $producto;
		}

		return $listadoProducto;
	}


	public static function obtenerPorId($id) {
		$sql = "SELECT producto.id_producto, producto.nombre, producto.marca, "
		. "producto.imagen , producto.descripcion, producto.precio_compra, " 
		. "producto.precio_venta , producto.fecha, producto.id_temporada, producto.estado, " 
		." producto.id_categoria FROM producto "
		. "WHERE id_producto =" . $id;


		$database = new MySQL();
		$datos = $database->consultar($sql);

		if ($datos->num_rows == 0) {
			return false;
		}

		$registro = $datos->fetch_assoc();
		$producto = self::_crearProducto($registro);
		return $producto;

	}

	public static function obtenerPorCategoria($categoria) {
		$sql = "SELECT producto.id_producto, producto.nombre, producto.marca, "
		. "producto.imagen , producto.descripcion, producto.precio_compra, " 
		. "producto.precio_venta , producto.fecha, producto.id_temporada, " 
		." producto.id_categoria FROM producto "
		. "WHERE id_categoria =" . $categoria;




		$database = new MySQL();
		$datos = $database->consultar($sql);

		$listadoProducto = [];

		while ($registro = $datos->fetch_assoc()) {
			$producto = new Producto();
			$producto->_idProducto = $registro["id_producto"];
			$producto->_nombre = $registro["nombre"];
			$producto->_marca = $registro["marca"];
			$producto->_descripcion = $registro["descripcion"];
			$producto->_precioCompra = $registro["precio_compra"];
			$producto->_precioVenta = $registro["precio_venta"];
			$producto->_fecha = $registro["fecha"];
			$producto->_imagen = $registro["imagen"];
			$producto->_idTemporada = $registro["id_temporada"];
			$producto->_idCategoria = $registro["id_categoria"];
			$producto->categoria = Categoria::obtenerPorId($producto->_idCategoria);
			$producto->temporada = Temporada::obtenerPorId($producto->_idTemporada);
			$listadoProducto[] = $producto;
		}

		return $listadoProducto;
	}

	public static function obtenerPorMarca($marca) {
		$sql = "SELECT producto.id_producto, producto.nombre, producto.marca, "
		. "producto.imagen , producto.descripcion, producto.precio_compra, " 
		. "producto.precio_venta , producto.fecha, producto.id_temporada, " 
		." producto.id_categoria FROM producto "
		. "WHERE marca ='" . $marca."'";





		$database = new MySQL();
		$datos = $database->consultar($sql);

		$listadoProducto = [];

		while ($registro = $datos->fetch_assoc()) {
			$producto = new Producto();
			$producto->_idProducto = $registro["id_producto"];
			$producto->_nombre = $registro["nombre"];
			$producto->_marca = $registro["marca"];
			$producto->_descripcion = $registro["descripcion"];
			$producto->_precioCompra = $registro["precio_compra"];
			$producto->_precioVenta = $registro["precio_venta"];
			$producto->_fecha = $registro["fecha"];
			$producto->_imagen = $registro["imagen"];
			$producto->_idTemporada = $registro["id_temporada"];
			$producto->_idCategoria = $registro["id_categoria"];
			$producto->categoria = Categoria::obtenerPorId($producto->_idCategoria);
			$producto->temporada = Temporada::obtenerPorId($producto->_idTemporada);
			$listadoProducto[] = $producto;
		}

		return $listadoProducto;
	}



	public static function obtenerPorTemporada($temporada) {
		$sql = "SELECT producto.id_producto, producto.nombre, producto.marca, "
		. "producto.imagen , producto.descripcion, producto.precio_compra, " 
		. "producto.precio_venta , producto.fecha, producto.id_temporada, " 
		." producto.id_categoria FROM producto "
		. "WHERE id_temporada =" . $temporada;




		$database = new MySQL();
		$datos = $database->consultar($sql);

		$listadoProducto = [];

		while ($registro = $datos->fetch_assoc()) {
			$producto = new Producto();
			$producto->_idProducto = $registro["id_producto"];
			$producto->_nombre = $registro["nombre"];
			$producto->_marca = $registro["marca"];
			$producto->_descripcion = $registro["descripcion"];
			$producto->_precioCompra = $registro["precio_compra"];
			$producto->_precioVenta = $registro["precio_venta"];
			$producto->_fecha = $registro["fecha"];
			$producto->_imagen = $registro["imagen"];
			$producto->_idTemporada = $registro["id_temporada"];
			$producto->_idCategoria = $registro["id_categoria"];
			$producto->categoria = Categoria::obtenerPorId($producto->_idCategoria);
			$producto->temporada = Temporada::obtenerPorId($producto->_idTemporada);
			$listadoProducto[] = $producto;
		}

		return $listadoProducto;
	}


	public function eliminar() {

		$sql = "UPDATE producto  " 
             . "SET estado = 2 "
             . "WHERE producto.id_producto = {$this->_idProducto}";
    	

		$database = new MySQL();
		$database->eliminar($sql);

	}

	public function eliminarCategoria() {

		$sql = "UPDATE producto  " 
             . "SET estado = 2 "
             . "WHERE producto.id_categoria = {$this->_idCategoria}";
    	

		$database = new MySQL();
		$database->eliminar($sql);

	}

	private static function _crearProducto($datos) {
		$producto = new Producto();
		$producto->_idProducto = $datos["id_producto"];
		$producto->_nombre = $datos["nombre"];
		$producto->_marca = $datos["marca"];
		$producto->_descripcion = $datos["descripcion"];
		$producto->_precioCompra = $datos["precio_compra"];
		$producto->_precioVenta = $datos["precio_venta"];
		$producto->_fecha = $datos["fecha"];
		$producto->_imagen = $datos["imagen"];
		$producto->_idTemporada = $datos["id_temporada"];
		$producto->_idCategoria = $datos["id_categoria"];
		$producto->_estado = $datos["estado"];
		$producto->categoria = Categoria::obtenerPorId($producto->_idCategoria);
		$producto->temporada = Temporada::obtenerPorId($producto->_idTemporada);


		return $producto;
	}

}



?>