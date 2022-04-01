<?php

require_once "MySQL.php";
require_once "Producto.php";
require_once "Talle.php";


class ProductoTalle extends Producto {

	private $_idProductoTalle;
	private $_cantidadMaxima;
	private $_cantidadMinima;
	private $_cantidadDisponible;
	private $_idTalle;
	private $_idProducto;
		private $_estado;

	public $producto;
	public $talle;

	public function getIdProductoTalle() {
		return $this->_idProductoTalle;
	}

	public function getCantidadMaxima() {
		return $this->_cantidadMaxima;
	}

	public function setCantidadMaxima($cantidadMaxima) {
		$this->_cantidadMaxima = $cantidadMaxima;
	}

	public function getCantidadMinima() {
		return $this->_cantidadMinima;
	}

	public function setCantidadMinima($cantidadMinima) {
		$this->_cantidadMinima = $cantidadMinima;
	}

	public function getCantidadDisponible() {
		return $this->_cantidadDisponible;
	}

	public function setCantidadDisponible($cantidadDisponible) {
		$this->_cantidadDisponible = $cantidadDisponible;
	}

	public function getIdTalle() {
		return $this->_idTalle;
	}

	public function setIdTalle($idTalle) {
		$this->_idTalle = $idTalle;
	}

	public function getIdProducto() {
		return $this->_idProducto;
	}

	public function setIdProducto($idProducto) {
		$this->_idProducto = $idProducto;
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
		parent::guardar();

		$database = new MySQL();

		$sql = "INSERT INTO productotalle "
		     . "(`id_producto_talle`, `cantidad_maxima`, `cantidad_minima`,`cantidad_disponible`, `id_talle`, `id_producto`,`estado`) "
		     . "VALUES (NULL, '{$this->_cantidadMaxima}' ,'{$this->_cantidadMinima}', '{$this->_cantidadDisponible}' ,'{$this->_idTalle}' ,'{$this->_idProducto}',1)";



		$database->insertar($sql);

	}

	public function actualizarCantidadDisponible($cantidad) {

        $database = new MySQL();

        $sql = "UPDATE productotalle SET cantidad_disponible = cantidad_disponible -".$cantidad." WHERE id_producto_talle =  {$this->_idProductoTalle};";

  
   


        $database->actualizar($sql);

    }

    public function actualizarSumarCantidadDisponible($cantidad) {

        $database = new MySQL();

        $sql = "UPDATE productotalle SET cantidad_disponible = cantidad_disponible +".$cantidad." WHERE id_producto_talle =  {$this->_idProductoTalle};";

  
   


        $database->actualizar($sql);

    }

	public function actualizar() {
     	parent::guardar();

        $database = new MySQL();

        $sql = "UPDATE productotalle SET cantidad_maxima = '{$this->_cantidadMaxima}', 
        cantidad_minima = '{$this->_cantidadMinima}', cantidad_disponible = '{$this->_cantidadDisponible}',
        id_talle  = '{$this->_idTalle}'"
             . "WHERE productotalle.id_producto_talle = {$this->_idProductoTalle}";

  
       


        $database->actualizar($sql);

    }

    public static function obtenerPorIdProducto($idProducto,$filtroEstado = 0) {
		$sql = "SELECT productotalle.id_producto_talle, productotalle.id_talle, "
             . "productotalle.cantidad_maxima, productotalle.cantidad_minima, "
       		 . "productotalle.cantidad_disponible, producto.id_producto,productotalle.estado "
			 . "FROM productotalle  "
             . "INNER JOIN producto ON producto.id_producto = productotalle.id_producto "
             . "WHERE producto.id_producto = {$idProducto}";


  		$where = "";

        if ($filtroEstado != 0) {
            // $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
            $where = " and productotalle.estado = " . $filtroEstado;
        }

        $sql = $sql . " " . $where;

        $database = new MySQL();
        $datos = $database->consultar($sql);

    	$listadoProductos = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$productoTalle = new ProductoTalle();
			$productoTalle->_idProducto = $registro["id_producto"];
			$productoTalle->_idProductoTalle = $registro["id_producto_talle"];
			$productoTalle->_cantidadMaxima = $registro["cantidad_maxima"];
			$productoTalle->_cantidadMinima = $registro["cantidad_minima"];
			$productoTalle->_cantidadDisponible = $registro["cantidad_disponible"];
			$productoTalle->_idTalle = $registro["id_talle"];
			$productoTalle->_estado = $registro["estado"];
			$productoTalle->talle = Talle::obtenerPorId($productoTalle->_idTalle);
	
    		$listadoProductos[] = $productoTalle;
    	}


    	return $listadoProductos;

	}

	public static function obtenerPorIdProductoYTalles($idProducto,$idTalle) {
		$sql = "SELECT productotalle.id_producto_talle, productotalle.id_talle, "
             . "productotalle.cantidad_maxima, productotalle.cantidad_minima, "
       		 . "productotalle.cantidad_disponible, producto.id_producto "
			 . "FROM productotalle  "
             . "INNER JOIN producto ON producto.id_producto = productotalle.id_producto "
             . "WHERE productotalle.estado = 1 and producto.id_producto =".$idProducto." and productotalle.id_talle=".$idTalle;




        $database = new MySQL();
        $datos = $database->consultar($sql);

    	$listadoProductos = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$productoTalle = new ProductoTalle();
			$productoTalle->_idProducto = $registro["id_producto"];
			$productoTalle->_idProductoTalle = $registro["id_producto_talle"];
			$productoTalle->_cantidadMaxima = $registro["cantidad_maxima"];
			$productoTalle->_cantidadMinima = $registro["cantidad_minima"];
			$productoTalle->_cantidadDisponible = $registro["cantidad_disponible"];
			$productoTalle->_idTalle = $registro["id_talle"];
			$productoTalle->talle = Talle::obtenerPorId($productoTalle->_idTalle);
	
    		$listadoProductos[] = $productoTalle;
    	}


    	return $listadoProductos;

	}

	public static function obtenerTodosTalles($id) {
    	$sql ="SELECT producto.id_producto, producto.imagen, producto.nombre, producto.marca,"
             . "producto.descripcion,producto.precio_compra,producto.precio_venta,"
             . "producto.fecha,producto.id_categoria, producto.id_temporada, "
             ."productotalle.cantidad_maxima,productotalle.cantidad_minima,"
             ."productotalle.cantidad_disponible, productotalle.id_talle, productotalle.id_producto_talle "
             . "FROM productotalle "
             . "JOIN producto ON producto.id_producto = productotalle.id_producto"
             . " WHERE producto.id_producto=" . $id;


    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoProductoTalle = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$productoTalle = new ProductoTalle();
			$productoTalle->_idProducto = $registro["id_producto"];
			$productoTalle->_idProductoTalle = $registro["id_producto_talle"];
			$productoTalle->_cantidadMaxima = $registro["cantidad_maxima"];
			$productoTalle->_cantidadMinima = $registro["cantidad_minima"];
			$productoTalle->_cantidadDisponible = $registro["cantidad_disponible"];
			$productoTalle->_nombre = $registro["nombre"];
			$productoTalle->_marca = $registro["marca"];
			$productoTalle->_descripcion = $registro["descripcion"];
			$productoTalle->_precioCompra = $registro["precio_compra"];
			$productoTalle->_precioVenta = $registro["precio_venta"];
			$productoTalle->_fecha = $registro["fecha"];
			$productoTalle->_imagen = $registro["imagen"];
			$productoTalle->_idTalle = $registro["id_talle"];
			$productoTalle->_idTemporada = $registro["id_temporada"];
			$productoTalle->_idCategoria = $registro["id_categoria"];
			$productoTalle->categoria = Categoria::obtenerPorId($productoTalle->_idCategoria);
			$productoTalle->talle = Talle::obtenerPorId($productoTalle->_idTalle);
			$productoTalle->temporada = Temporada::obtenerPorId($productoTalle->_idTemporada);
			$productoTalle->producto = Producto::obtenerPorId($productoTalle->_idProducto);
    		$listadoProductoTalle[] = $productoTalle;
    	}


    	return $listadoProductoTalle;
	}

	public static function obtenerTodosTallesActivos($id) {
    	$sql ="SELECT producto.id_producto, producto.imagen, producto.nombre, producto.marca,"
             . "producto.descripcion,producto.precio_compra,producto.precio_venta,"
             . "producto.fecha,producto.id_categoria, producto.id_temporada, "
             ."productotalle.cantidad_maxima,productotalle.cantidad_minima, productotalle.estado,"
             ."productotalle.cantidad_disponible, productotalle.id_talle, productotalle.id_producto_talle "
             . "FROM productotalle "
             . "JOIN producto ON producto.id_producto = productotalle.id_producto"
             . " WHERE productotalle.estado = 1 and producto.id_producto=" . $id;


    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoProductoTalle = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$productoTalle = new ProductoTalle();
			$productoTalle->_idProducto = $registro["id_producto"];
			$productoTalle->_idProductoTalle = $registro["id_producto_talle"];
			$productoTalle->_cantidadMaxima = $registro["cantidad_maxima"];
			$productoTalle->_cantidadMinima = $registro["cantidad_minima"];
			$productoTalle->_cantidadDisponible = $registro["cantidad_disponible"];
			$productoTalle->_nombre = $registro["nombre"];
			$productoTalle->_marca = $registro["marca"];
			$productoTalle->_descripcion = $registro["descripcion"];
			$productoTalle->_precioCompra = $registro["precio_compra"];
			$productoTalle->_precioVenta = $registro["precio_venta"];
			$productoTalle->_fecha = $registro["fecha"];
			$productoTalle->_imagen = $registro["imagen"];
			$productoTalle->_idTalle = $registro["id_talle"];
			$productoTalle->_idTemporada = $registro["id_temporada"];
			$productoTalle->_idCategoria = $registro["id_categoria"];
			$productoTalle->categoria = Categoria::obtenerPorId($productoTalle->_idCategoria);
			$productoTalle->talle = Talle::obtenerPorId($productoTalle->_idTalle);
			$productoTalle->temporada = Temporada::obtenerPorId($productoTalle->_idTemporada);
			$productoTalle->producto = Producto::obtenerPorId($productoTalle->_idProducto);
    		$listadoProductoTalle[] = $productoTalle;
    	}


    	return $listadoProductoTalle;
	}


	public static function obtenerTodosMenu() {
    	$sql ="Select *,sum(pt.cantidad_disponible) as cantidad_disponible from categoria as c 
join producto as p on c.id_categoria = p.id_categoria 
join productotalle as pt on p.id_producto = pt.id_producto
where c.estado = 1 and cantidad_disponible > 0

group by c.id_categoria";


    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoProductoTalle = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$productoTalle = new ProductoTalle();
			$productoTalle->_idProducto = $registro["id_producto"];
			$productoTalle->_idProductoTalle = $registro["id_producto_talle"];
			$productoTalle->_cantidadMaxima = $registro["cantidad_maxima"];
			$productoTalle->_cantidadMinima = $registro["cantidad_minima"];
			$productoTalle->_cantidadDisponible = $registro["cantidad_disponible"];
			$productoTalle->_nombre = $registro["nombre"];
			$productoTalle->_marca = $registro["marca"];
			$productoTalle->_descripcion = $registro["descripcion"];
			$productoTalle->_precioCompra = $registro["precio_compra"];
			$productoTalle->_precioVenta = $registro["precio_venta"];
			$productoTalle->_fecha = $registro["fecha"];
			$productoTalle->_imagen = $registro["imagen"];
			$productoTalle->_idTalle = $registro["id_talle"];
			$productoTalle->_idTemporada = $registro["id_temporada"];
			$productoTalle->_idCategoria = $registro["id_categoria"];
			$productoTalle->categoria = Categoria::obtenerPorId($productoTalle->_idCategoria);
			$productoTalle->talle = Talle::obtenerPorId($productoTalle->_idTalle);
			$productoTalle->temporada = Temporada::obtenerPorId($productoTalle->_idTemporada);
			$productoTalle->producto = Producto::obtenerPorId($productoTalle->_idProducto);
    		$listadoProductoTalle[] = $productoTalle;
    	}


    	return $listadoProductoTalle;
	}


	public static function obtenerTodosProductos($filtroEstado = 0) {
    	$sql ="SELECT producto.estado,producto.id_producto, producto.imagen, producto.nombre, producto.marca,"
             . "producto.descripcion,producto.precio_compra,producto.precio_venta,"
             . "producto.fecha,producto.id_categoria, producto.id_temporada, "
             ."productotalle.cantidad_maxima,productotalle.cantidad_minima,"
             ."productotalle.cantidad_disponible, productotalle.id_talle, productotalle.id_producto_talle "
             . "FROM productotalle "
             . "JOIN producto ON producto.id_producto = productotalle.id_producto where productotalle.cantidad_disponible < productotalle.cantidad_minima";

          $where = "";

        		if ($filtroEstado != 0) {
        	    // $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
            		$where = " and producto.estado = " . $filtroEstado;
        		}

        		$sql = $sql . " " . $where;
     
    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoProductoTalle = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$productoTalle = new ProductoTalle();
			$productoTalle->_idProducto = $registro["id_producto"];
			$productoTalle->_idProductoTalle = $registro["id_producto_talle"];
			$productoTalle->_cantidadMaxima = $registro["cantidad_maxima"];
			$productoTalle->_cantidadMinima = $registro["cantidad_minima"];
			$productoTalle->_cantidadDisponible = $registro["cantidad_disponible"];
			$productoTalle->_nombre = $registro["nombre"];
			$productoTalle->_marca = $registro["marca"];
			$productoTalle->_descripcion = $registro["descripcion"];
			$productoTalle->_precioCompra = $registro["precio_compra"];
			$productoTalle->_precioVenta = $registro["precio_venta"];
			$productoTalle->_fecha = $registro["fecha"];
			$productoTalle->_imagen = $registro["imagen"];
			$productoTalle->_idTalle = $registro["id_talle"];
			$productoTalle->_idTemporada = $registro["id_temporada"];
			$productoTalle->_idCategoria = $registro["id_categoria"];
			$productoTalle->categoria = Categoria::obtenerPorId($productoTalle->_idCategoria);
			$productoTalle->talle = Talle::obtenerPorId($productoTalle->_idTalle);
			$productoTalle->temporada = Temporada::obtenerPorId($productoTalle->_idTemporada);
			$productoTalle->producto = Producto::obtenerPorId($productoTalle->_idProducto);
    		$listadoProductoTalle[] = $productoTalle;
    	}


    	return $listadoProductoTalle;
	}


	public static function obtenerTodosLosTalles($idProducto) {
    	$sql ="SELECT * FROM producto as p
join productotalle as pt on p.id_producto = pt.id_producto
join talle as t on pt.id_talle = t.id_talle
where pt.id_producto =".$idProducto;


    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoProductoTalle = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$productoTalle = new ProductoTalle();
			$productoTalle->_idProducto = $registro["id_producto"];
			$productoTalle->_idProductoTalle = $registro["id_producto_talle"];
			$productoTalle->_cantidadMaxima = $registro["cantidad_maxima"];
			$productoTalle->_cantidadMinima = $registro["cantidad_minima"];
			$productoTalle->_cantidadDisponible = $registro["cantidad_disponible"];
			$productoTalle->_nombre = $registro["nombre"];
			$productoTalle->_marca = $registro["marca"];
			$productoTalle->_descripcion = $registro["descripcion"];
			$productoTalle->_precioCompra = $registro["precio_compra"];
			$productoTalle->_precioVenta = $registro["precio_venta"];
			$productoTalle->_fecha = $registro["fecha"];
			$productoTalle->_imagen = $registro["imagen"];
			$productoTalle->_idTalle = $registro["id_talle"];
			$productoTalle->_idTemporada = $registro["id_temporada"];
			$productoTalle->_idCategoria = $registro["id_categoria"];
			$productoTalle->categoria = Categoria::obtenerPorId($productoTalle->_idCategoria);
			$productoTalle->talle = Talle::obtenerPorId($productoTalle->_idTalle);
			$productoTalle->temporada = Temporada::obtenerPorId($productoTalle->_idTemporada);
			$productoTalle->producto = Producto::obtenerPorId($productoTalle->_idProducto);
    		$listadoProductoTalle[] = $productoTalle;
    	}


    	return $listadoProductoTalle;
	}


	

     public static function obtenerPorId($idProductoTalle) {
		$sql = "SELECT * FROM productotalle WHERE id_producto_talle={$idProductoTalle}";
	

		$database = new MySQL();
		$datos = $database->consultar($sql);

		$registro = $datos->fetch_assoc();

		$productoTalle = new ProductoTalle();
		$productoTalle->_idProducto = $registro["id_producto"];
		$productoTalle->_idProductoTalle = $registro["id_producto_talle"];
		$productoTalle->_cantidadMaxima = $registro["cantidad_maxima"];
		$productoTalle->_cantidadMinima = $registro["cantidad_minima"];
		$productoTalle->_cantidadDisponible = $registro["cantidad_disponible"];
		$productoTalle->_idTalle = $registro["id_talle"];
		$productoTalle->talle = Talle::obtenerPorId($productoTalle->_idTalle);
		$productoTalle->producto = Producto::obtenerPorId($productoTalle->_idProducto);
    		

		return $productoTalle;

	}

    public function eliminar() {

    	$sql = "UPDATE productotalle  " 
             . "SET estado = 2 "
             . "WHERE productotalle.id_producto_talle = {$this->_idProductoTalle}";

    	$database = new MySQL();
        $database->eliminar($sql);


    }

	public static function obtenerPorIdProductoYtalle($idProducto,$talle) {
		$sql = "SELECT * FROM productotalle join producto on producto.id_producto=productotalle.id_producto WHERE productotalle.id_talle =".$talle." and productotalle.id_producto =".$idProducto." and productotalle.estado = 1";


		
		$database = new MySQL();
		$datos = $database->consultar($sql);

		$registro = $datos->fetch_assoc();

		$productoTalle = new ProductoTalle();
		$productoTalle->_idProducto = $registro["id_producto"];
		$productoTalle->_idProductoTalle = $registro["id_producto_talle"];
		$productoTalle->_cantidadMaxima = $registro["cantidad_maxima"];
		$productoTalle->_cantidadMinima = $registro["cantidad_minima"];
		$productoTalle->_cantidadDisponible = $registro["cantidad_disponible"];
		$productoTalle->_idTalle = $registro["id_talle"];
		$productoTalle->talle = Talle::obtenerPorId($productoTalle->_idTalle);
		$productoTalle->_nombre = $registro["nombre"];
		$productoTalle->_marca = $registro["marca"];
		$productoTalle->_descripcion = $registro["descripcion"];
		$productoTalle->_precioCompra = $registro["precio_compra"];
		$productoTalle->_precioVenta = $registro["precio_venta"];
		$productoTalle->_fecha = $registro["fecha"];
		$productoTalle->_imagen = $registro["imagen"];
		$productoTalle->_idTalle = $registro["id_talle"];
		$productoTalle->_idTemporada = $registro["id_temporada"];
		$productoTalle->_idCategoria = $registro["id_categoria"];
		$productoTalle->categoria = Categoria::obtenerPorId($productoTalle->_idCategoria);
		$productoTalle->talle = Talle::obtenerPorId($productoTalle->_idTalle);
		$productoTalle->temporada = Temporada::obtenerPorId($productoTalle->_idTemporada);
		$productoTalle->producto = Producto::obtenerPorId($productoTalle->_idProducto);
    	$listadoProductoTalle[] = $productoTalle;
    		

		return $productoTalle;

}
}



?>