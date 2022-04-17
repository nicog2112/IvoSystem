<?php

require_once "MySQL.php";
require_once "Empleado.php";
require_once "Proveedor.php";
require_once "EstadoPedido.php";



class Compra  {

	private $_idCompra;
	private $_total;
	private $_fechaHora;
	private $_idProveedor;
	private $_idEmpleado;
	private $_idEstadoPedido;

	public $empleado;
	public $proveedor;
	public $estado;
	private $_mes;
	private $_cantidad;
	private $_fechaInicio;
	private $_fechaFin;
	private $_ultimoDia;
	private $_semana;
	private $_dia;

	public function getIdCompra() {
		return $this->_idCompra;
	}
	public function getTotal() {
		return $this->_total;
	}

	public function setTotal($total) {
		$this->_total = $total;
	}

	public function getCantidad() {
		return $this->_cantidad;
	}

	public function setCantidad($cantidad) {
		$this->_cantidad = $cantidad;
	}
	public function getMes() {
		return $this->_mes;
	}
	public function getDia() {
		return $this->_dia;
	}

	public function getFechaInicio() {
		return $this->_fechaInicio;
	}
	public function getFechaFin() {
		return $this->_fechaFin;
	}
	public function getUltimoDia() {
		return $this->_ultimoDia;
	}
	public function getSemana() {
		return $this->_semana;
	}

	public function setMes($mes) {
		$this->_mes = $mes;
	}

	public function getFechaHora() {
		return $this->_fechaHora;
	}

	public function setFechaHora($fechaHora) {
		$this->_fechaHora = $fechaHora;
	}
	
	public function getIdProveedor() {
		return $this->_idProveedor;
	}

	public function setIdProveedor($idProveedor) {
		$this->_idProveedor = $idProveedor;
	}

	public function getIdEmpleado() {
		return $this->_idEmpleado;
	}

	public function setIdEmpleado($idEmpleado) {
		$this->_idEmpleado = $idEmpleado;
	}

	public function getIdEstadoPedido() {
		return $this->_idEstadoPedido;
	}

	public function setIdEstadoPedido($idEstadoPedido) {
		$this->_idEstadoPedido = $idEstadoPedido;
	}

	public function guardar() {

		$database = new MySQL();

		$sql = "INSERT INTO pedidoproveedor(`id_pedido_proveedor`,`id_proveedor`,`id_Empleado`,
			`id_estado_pedido`,`fecha_hora`, `total`) VALUES (NULL,'{$this->_idProveedor}', '{$this->_idEmpleado}',
			'{$this->_idEstadoPedido}','{$this->_fechaHora}','{$this->_total}');";


			$database->insertar($sql);

		}

		public function actualizarEstado() {

			$database = new MySQL();

			$sql = "UPDATE pedidoproveedor SET id_estado_pedido = '{$this->_idEstadoPedido}'"
			. "WHERE pedidoproveedor.id_pedido_proveedor = {$this->_idCompra}";


			$database->actualizar($sql);
		}

		public static function obtenerPorId($idCompra) {
			$sql = "SELECT * FROM pedidoproveedor WHERE pedidoproveedor.id_pedido_proveedor =". $idCompra;



			$database = new MySQL();
			$datos = $database->consultar($sql);

			$registro = $datos->fetch_assoc();

			$compra = new Compra();
			$compra->_idCompra = $registro["id_pedido_proveedor"];
			$compra->_total= $registro["total"];
			$compra->_fechaHora = $registro["fecha_hora"];
			$compra->_idProveedor = $registro["id_proveedor"];
			$compra->_idEmpleado = $registro["id_Empleado"];
			$compra->_idEstadoPedido = $registro["id_estado_pedido"];
			$compra->empleado = Empleado::obtenerPorId($compra->_idEmpleado);
			$compra->proveedor = Proveedor::obtenerPorId($compra->_idProveedor);
			$compra->estado = EstadoPedido::obtenerPorId($compra->_idEstadoPedido);


			return $compra;

		}

		public static function obtenerPorIdCompra($idCompra) {
			$sql = "SELECT pedidoproveedor.total,pedidoproveedor.id_Empleado,pedidoproveedor.id_proveedor, pedidoproveedor.id_estado_pedido, pedidoproveedor.fecha_hora, pedidoproveedor.id_pedido_proveedor FROM pedidoproveedor WHERE pedidoproveedor.id_pedido_proveedor =". $idCompra;


			$database = new MySQL();
			$datos = $database->consultar($sql);

			$listadoCompras = [];

			while ($registro = $datos->fetch_assoc()) {
				$compra = new Compra();
				$compra->_idCompra = $registro["id_pedido_proveedor"];
				$compra->_total= $registro["total"];
				$compra->_fechaHora = $registro["fecha_hora"];
				$compra->_idProveedor = $registro["id_proveedor"];
				$compra->_idEmpleado = $registro["id_Empleado"];
				$compra->_idEstadoPedido = $registro["id_estado_pedido"];
				$compra->empleado = Empleado::obtenerPorId($compra->_idEmpleado);
				$compra->proveedor = Proveedor::obtenerPorId($compra->_idProveedor);
				$compra->estado = EstadoPedido::obtenerPorId($compra->_idEstadoPedido);


				$listadoCompras[] = $compra;
			}


			return $listadoCompras;
		}

		public static function obtenerTodos($filtroEstado = 0) {
			$sql = "SELECT pedidoproveedor.total,pedidoproveedor.id_Empleado,pedidoproveedor.id_proveedor, pedidoproveedor.id_estado_pedido, pedidoproveedor.fecha_hora, pedidoproveedor.id_pedido_proveedor FROM pedidoproveedor" ;
			$where = "";

			if ($filtroEstado != 0) {
        	    // $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
				$where = " where id_estado_pedido = " . $filtroEstado;
			}

			$sql = $sql . " " . $where;


			$database = new MySQL();
			$datos = $database->consultar($sql);

			$listadoCompras = [];

			while ($registro = $datos->fetch_assoc()) {
				$compra = new Compra();
				$compra->_idCompra = $registro["id_pedido_proveedor"];
				$compra->_total= $registro["total"];
				$compra->_fechaHora = $registro["fecha_hora"];
				$compra->_idProveedor = $registro["id_proveedor"];
				$compra->_idEmpleado = $registro["id_Empleado"];
				$compra->_idEstadoPedido = $registro["id_estado_pedido"];
				$compra->empleado = Empleado::obtenerPorId($compra->_idEmpleado);
				$compra->proveedor = Proveedor::obtenerPorId($compra->_idProveedor);
				$compra->estado = EstadoPedido::obtenerPorId($compra->_idEstadoPedido);


				$listadoCompras[] = $compra;
			}


			return $listadoCompras;
		}


		public static function obtenerTodosComprasProveedor($filtroEmpleados = 0,$filtroProveedor= 0,$filtrofechaDesde="",$filtrofechaHasta="") {
			$sql = "SELECT pedidoproveedor.total,pedidoproveedor.id_Empleado,pedidoproveedor.id_proveedor, pedidoproveedor.id_estado_pedido, pedidoproveedor.fecha_hora, pedidoproveedor.id_pedido_proveedor FROM pedidoproveedor where pedidoproveedor.id_estado_pedido = 1" ;

			$where = "";

			if ($filtroEmpleados != 0) {
        	// $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
				$where = "and pedidoproveedor.id_empleado = " . $filtroEmpleados;
			}

			if ($filtroProveedor != 0) {
        	// $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
				$where = "and pedidoproveedor.id_proveedor = " . $filtroProveedor;
			}

			if ($filtrofechaDesde != "" and $filtrofechaHasta != "") {

				if ($where != "") {

					$where .= " and CAST(fecha_hora AS DATE) >= '{$filtrofechaDesde}' and CAST(fecha_hora AS DATE) <= '{$filtrofechaHasta}'";

				} else {

					$where = " and CAST(fecha_hora AS DATE) >= '{$filtrofechaDesde}' and CAST(fecha_hora AS DATE) <= '{$filtrofechaHasta}'";

				}
			}

			$sql = $sql . " " . $where;

			$database = new MySQL();
			$datos = $database->consultar($sql);

			$listadoCompras = [];

			while ($registro = $datos->fetch_assoc()) {
				$compra = new Compra();
				$compra->_idCompra = $registro["id_pedido_proveedor"];
				$compra->_total= $registro["total"];
				$compra->_fechaHora = $registro["fecha_hora"];
				$compra->_idProveedor = $registro["id_proveedor"];
				$compra->_idEmpleado = $registro["id_Empleado"];
				$compra->_idEstadoPedido = $registro["id_estado_pedido"];
				$compra->empleado = Empleado::obtenerPorId($compra->_idEmpleado);
				$compra->proveedor = Proveedor::obtenerPorId($compra->_idProveedor);
				$compra->estado = EstadoPedido::obtenerPorId($compra->_idEstadoPedido);


				$listadoCompras[] = $compra;
			}


			return $listadoCompras;
		}

		public static function obtenerComprasPorMesActual() {
			$sql = "select fecha_hora,YEAR(fecha_hora) AS Año, MONTHNAME(fecha_hora) AS Mes, 
			WEEK(fecha_hora, 5) - WEEK(DATE_SUB(fecha_hora, INTERVAL DAYOFMONTH(fecha_hora) - 1 DAY), 5) + 1 as Semana, 
			DATE(DATE_ADD(fecha_hora, INTERVAL(1 - DAYOFWEEK(fecha_hora)) DAY)) fecha_inicio, 
			DATE(DATE_ADD(fecha_hora, INTERVAL (7 - DAYOFWEEK(fecha_hora) ) DAY)) fecha_fin,
			LAST_DAY(fecha_hora) ultimo_dia_del_mes,
			count(*) as cantidad,
			SUM(total) AS Total
			FROM  pedidoproveedor
			WHERE id_estado_pedido = 1 and MONTHNAME(fecha_hora) =  MONTHNAME(curdate()) and YEAR(curdate()) = YEAR(fecha_hora)
			group by Semana
			order by Semana ASC;" ;

			$database = new MySQL();
			$datos = $database->consultar($sql);

			$listadoCompras = [];

			while ($registro = $datos->fetch_assoc()) {
				$compra = new Compra();
				$compra->_total= $registro["Total"];
				$compra->_mes = $registro["Mes"];
				$compra->_fechaInicio = $registro["fecha_inicio"];
				$compra->_fechaFin = $registro["fecha_fin"];
				$compra->_ultimoDia = $registro["ultimo_dia_del_mes"];
				$compra->_cantidad= $registro["cantidad"];
				$compra->_semana = $registro["Semana"];


				$listadoCompras[] = $compra;
			}


			return $listadoCompras;
		}

		public static function obtenerComprasPorSemanaActual() {
			$sql = "SELECT id_pedido_proveedor,
			count(id_pedido_proveedor) as cantidad,
			DAYOFWEEK(fecha_hora) as dia,
			SUM(total) AS Total
			FROM pedidoproveedor
			WHERE id_estado_pedido = 1 and YEARWEEK(fecha_hora) = YEARWEEK(CURDATE())
			group by dia
			order by dia asc" ;


			$database = new MySQL();
			$datos = $database->consultar($sql);

			$listadoCompras = [];

			while ($registro = $datos->fetch_assoc()) {
				$compra = new Compra();
				$compra->_total= $registro["Total"];
				$compra->_cantidad = $registro["cantidad"];
				$compra->_dia = $registro["dia"];


				$listadoCompras[] = $compra;
			}


			return $listadoCompras;
		}

		public static function obtenerComprasPorDiaActual() {

			$sql = "SELECT empleado.id_Empleado as id_empleado, count(id_pedido_proveedor) as cantidad
			, sum(total) as total
			FROM pedidoproveedor 
			join empleado on empleado.id_empleado = pedidoproveedor.id_empleado
			join persona on persona.id_persona = empleado.id_persona
			WHERE id_estado_pedido = 1 and DATE(fecha_hora) = CURDATE()
			group by empleado.id_empleado
			order by cantidad desc
			" ;


			$database = new MySQL();
			$datos = $database->consultar($sql);

			$listadoCompras = [];

			while ($registro = $datos->fetch_assoc()) {
				$compra = new Compra();
				$compra->_total= $registro["total"];
				$compra->_cantidad = $registro["cantidad"];
				$compra->_idEmpleado = $registro["id_empleado"];
				$compra->empleado = Empleado::obtenerPorId($compra->_idEmpleado);

				$listadoCompras[] = $compra;
			}


			return $listadoCompras;

		}

		public static function obtenerId() {
			$sql = "SELECT id_pedido_proveedor FROM pedidoproveedor ORDER BY id_pedido_proveedor DESC LIMIT 1;";



			$database = new MySQL();
			$datos = $database->consultar($sql);

			if ($datos->num_rows == 0) {
				return false;
			}

			$registro = $datos->fetch_assoc();
			$compra = self::_crearCompra($registro);
			return $compra;

		}




		private static function _crearCompra($datos) {
			$compra = new Compra();
			$compra->_idCompra = $datos["id_pedido_proveedor"];



			return $compra;
		}

		public static function obtenerComprasPorMeses($año) {
			$sqlEspañol="SET lc_time_names = 'es_ES';";
			$sql = "SELECT MONTHNAME(p.fecha_hora) AS Mes,
			count(*) as cantidad,
			SUM(p.total) AS Total
			FROM pedidoproveedor p
			WHERE id_estado_pedido = 1 and YEAR(p.fecha_hora) = ". $año."
			GROUP BY Mes
			ORDER BY fecha_hora ASC;
			" ;


			$database = new MySQL();
			$database->consultar($sqlEspañol);
			$datos = $database->consultar($sql);

			$listadoCompras = [];

			while ($registro = $datos->fetch_assoc()) {
				$compra = new Compra();
				$compra->_total= $registro["Total"];
				$compra->_cantidad= $registro["cantidad"];
				$compra->_mes = $registro["Mes"];

				$listadoCompras[] = $compra;
			}


			return $listadoCompras;
		}


	}



?>