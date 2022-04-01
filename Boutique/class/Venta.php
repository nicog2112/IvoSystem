<?php

require_once "MySQL.php";
require_once "Empleado.php";
require_once "Cliente.php";
require_once "EstadoPedido.php";



class Venta  {

	private $_idVenta;
	private $_total;
	private $_fechaHora;
	private $_idCliente;
	private $_idEmpleado;
	private $_idEstadoPedido;

	public $empleado;
	public $cliente;
	public $estado;
	private $_mes;
	private $_cantidad;
	private $_fechaInicio;
	private $_fechaFin;
	private $_ultimoDia;
	private $_semana;
	private $_dia;


	public function getIdVenta() {
		return $this->_idVenta;
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
	
	public function getIdCliente() {
		return $this->_idCliente;
	}

	public function setIdCliente($idCliente) {
		$this->_idCliente = $idCliente;
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

		$sql = "INSERT INTO pedidoclente(`id_pedido_cliente`,`id_cliente`,`id_Empleado`,
			`id_estado_pedido`,`fecha_hora`, `total`) VALUES (NULL,'{$this->_idCliente}', '{$this->_idEmpleado}',
			'{$this->_idEstadoPedido}','{$this->_fechaHora}','{$this->_total}');";


			$database->insertar($sql);

		} 

		public function guardarCliente() {

			$database = new MySQL();

			$sql = "INSERT INTO pedidoclente(`id_pedido_cliente`,`id_cliente`,`id_Empleado`,
				`id_estado_pedido`,`fecha_hora`, `total`) VALUES (NULL,'{$this->_idCliente}', NULL,
				'{$this->_idEstadoPedido}','{$this->_fechaHora}','{$this->_total}');";



				$database->insertar($sql);

			}

			public function actualizarEstado() {

				$database = new MySQL();

				$sql = "UPDATE pedidoclente SET id_estado_pedido = '{$this->_idEstadoPedido}'"
				. "WHERE pedidoclente.id_pedido_cliente = {$this->_idVenta}";

				
				$database->actualizar($sql);

			}

			public static function obtenerPorId($idVenta) {
				$sql = "SELECT * FROM pedidoclente WHERE pedidoclente.id_pedido_cliente =". $idVenta;



				$database = new MySQL();
				$datos = $database->consultar($sql);

				$registro = $datos->fetch_assoc();

				$venta = new Venta();
				$venta->_idVenta = $registro["id_pedido_cliente"];
				$venta->_total= $registro["total"];
				$venta->_fechaHora = $registro["fecha_hora"];
				$venta->_idCliente = $registro["id_cliente"];
				$venta->_idEmpleado = $registro["id_Empleado"];
				$venta->_idEstadoPedido = $registro["id_estado_pedido"];
				
				$venta->cliente = Cliente::obtenerPorId($venta->_idCliente);
				$venta->estado = EstadoPedido::obtenerPorId($venta->_idEstadoPedido);
				

				return $venta;

			}

			public static function obtenerPorIdVenta($idVenta) {
				$sql = "SELECT pedidoclente.total,pedidoclente.id_Empleado,pedidoclente.id_cliente, pedidoclente.id_estado_pedido, pedidoclente.fecha_hora, pedidoclente.id_pedido_cliente FROM pedidoclente WHERE pedidoclente.id_pedido_cliente =". $idVenta;


				$database = new MySQL();
				$datos = $database->consultar($sql);

				$listadoVentas = [];

				while ($registro = $datos->fetch_assoc()) {
					$venta = new Venta();
					$venta->_idVenta = $registro["id_pedido_cliente"];
					$venta->_total= $registro["total"];
					$venta->_fechaHora = $registro["fecha_hora"];
					$venta->_idCliente = $registro["id_cliente"];
					$venta->_idEmpleado = $registro["id_Empleado"];
					$venta->_idEstadoPedido = $registro["id_estado_pedido"];
					
					$venta->cliente = Cliente::obtenerPorId($venta->_idCliente);
					$venta->estado = EstadoPedido::obtenerPorId($venta->_idEstadoPedido);
					
					$listadoVentas[] = $venta;
				}


				return $listadoVentas;
			}




			public static function obtenerTodos($filtroEmpleados = 0,$filtroClientes = 0,$filtrofechaDesde="",$filtrofechaHasta="") {
				$sql = "SELECT pedidoclente.total,pedidoclente.id_Empleado,pedidoclente.id_cliente, pedidoclente.id_estado_pedido, pedidoclente.fecha_hora, pedidoclente.id_pedido_cliente FROM pedidoclente where pedidoclente.id_estado_pedido != 3" ;

				$where = "";

				if ($filtroEmpleados != 0) {
        	// $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
					$where = "and pedidoclente.id_empleado = " . $filtroEmpleados;
				}

				if ($filtroClientes != 0) {
        	// $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
					$where = "and pedidoclente.id_cliente = " . $filtroClientes;
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

				$listadoVentas = [];

				while ($registro = $datos->fetch_assoc()) {
					$venta = new Venta();
					$venta->_idVenta = $registro["id_pedido_cliente"];
					$venta->_total= $registro["total"];
					$venta->_fechaHora = $registro["fecha_hora"];
					$venta->_idCliente = $registro["id_cliente"];
					$venta->_idEmpleado = $registro["id_Empleado"];
					$venta->_idEstadoPedido = $registro["id_estado_pedido"];
					$venta->empleado = Empleado::obtenerPorId($venta->_idEmpleado);
					$venta->cliente = Cliente::obtenerPorId($venta->_idCliente);
					$venta->estado = EstadoPedido::obtenerPorId($venta->_idEstadoPedido);
					
					$listadoVentas[] = $venta;
				}


				return $listadoVentas;
			}

			public static function obtenerTodosPedidos($filtroEmpleados = 0,$filtroClientes = 0,$filtrofechaDesde="",$filtrofechaHasta="") {
				$sql = "SELECT pedidoclente.total,pedidoclente.id_Empleado,pedidoclente.id_cliente, pedidoclente.id_estado_pedido, pedidoclente.fecha_hora, pedidoclente.id_pedido_cliente FROM pedidoclente where pedidoclente.id_Empleado is null" ;

				$where = "";

				if ($filtroEmpleados != 0) {
        	// $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
					$where = "and pedidoclente.id_empleado = " . $filtroEmpleados;
				}

				if ($filtroClientes != 0) {
        	// $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
					$where = "and pedidoclente.id_cliente = " . $filtroClientes;
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

				$listadoVentas = [];

				while ($registro = $datos->fetch_assoc()) {
					$venta = new Venta();
					$venta->_idVenta = $registro["id_pedido_cliente"];
					$venta->_total= $registro["total"];
					$venta->_fechaHora = $registro["fecha_hora"];
					$venta->_idCliente = $registro["id_cliente"];
					$venta->_idEmpleado = $registro["id_Empleado"];
					$venta->_idEstadoPedido = $registro["id_estado_pedido"];
					$venta->empleado = Empleado::obtenerPorId($venta->_idEmpleado);
					$venta->cliente = Cliente::obtenerPorId($venta->_idCliente);
					$venta->estado = EstadoPedido::obtenerPorId($venta->_idEstadoPedido);
					
					$listadoVentas[] = $venta;
				}


				return $listadoVentas;
			}


			public static function obtenerTodosVentas() {
				$sql = "SELECT pedidoclente.total,pedidoclente.id_Empleado,pedidoclente.id_cliente, pedidoclente.id_estado_pedido, pedidoclente.fecha_hora, pedidoclente.id_pedido_cliente FROM pedidoclente where pedidoclente.id_estado_pedido != 3 and id_Empleado is not null" ;

				
				

				$database = new MySQL();
				$datos = $database->consultar($sql);

				$listadoVentas = [];

				while ($registro = $datos->fetch_assoc()) {
					$venta = new Venta();
					$venta->_idVenta = $registro["id_pedido_cliente"];
					$venta->_total= $registro["total"];
					$venta->_fechaHora = $registro["fecha_hora"];
					$venta->_idCliente = $registro["id_cliente"];
					$venta->_idEmpleado = $registro["id_Empleado"];
					$venta->_idEstadoPedido = $registro["id_estado_pedido"];
					$venta->empleado = Empleado::obtenerPorId($venta->_idEmpleado);
					$venta->cliente = Cliente::obtenerPorId($venta->_idCliente);
					$venta->estado = EstadoPedido::obtenerPorId($venta->_idEstadoPedido);
					
					$listadoVentas[] = $venta;
				}


				return $listadoVentas;
			}

			public static function obtenerTodosVentasPorCliente($idCliente) {
				$sql = "SELECT pedidoclente.total,pedidoclente.id_Empleado,pedidoclente.id_cliente, pedidoclente.id_estado_pedido, pedidoclente.fecha_hora, pedidoclente.id_pedido_cliente FROM pedidoclente where pedidoclente.id_cliente =".$idCliente ;
				

				
				

				$database = new MySQL();
				$datos = $database->consultar($sql);

				$listadoVentas = [];

				while ($registro = $datos->fetch_assoc()) {
					$venta = new Venta();
					$venta->_idVenta = $registro["id_pedido_cliente"];
					$venta->_total= $registro["total"];
					$venta->_fechaHora = $registro["fecha_hora"];
					$venta->_idCliente = $registro["id_cliente"];
					$venta->_idEmpleado = $registro["id_Empleado"];
					$venta->_idEstadoPedido = $registro["id_estado_pedido"];
					$venta->empleado = Empleado::obtenerPorId($venta->_idEmpleado);
					$venta->cliente = Cliente::obtenerPorId($venta->_idCliente);
					$venta->estado = EstadoPedido::obtenerPorId($venta->_idEstadoPedido);
					
					$listadoVentas[] = $venta;
				}


				return $listadoVentas;
			}

			public static function obtenerTodosPendientes($filtroEstado = 0) {
				$sql = "SELECT pedidoclente.total,pedidoclente.id_Empleado,pedidoclente.id_cliente, pedidoclente.id_estado_pedido, pedidoclente.fecha_hora, pedidoclente.id_pedido_cliente FROM pedidoclente where pedidoclente.id_Empleado is null" ;
				 $where = "";

        		if ($filtroEstado != 0) {
        	    // $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
            		$where = " and id_estado_pedido = " . $filtroEstado;
        		}

        		$sql = $sql . " " . $where;
     

				$database = new MySQL();
				$datos = $database->consultar($sql);

				$listadoVentas = [];

				while ($registro = $datos->fetch_assoc()) {
					$venta = new Venta();
					$venta->_idVenta = $registro["id_pedido_cliente"];
					$venta->_total= $registro["total"];
					$venta->_fechaHora = $registro["fecha_hora"];
					$venta->_idCliente = $registro["id_cliente"];
					$venta->_idEmpleado = $registro["id_Empleado"];
					$venta->_idEstadoPedido = $registro["id_estado_pedido"];
					
					$venta->cliente = Cliente::obtenerPorId($venta->_idCliente);
					$venta->estado = EstadoPedido::obtenerPorId($venta->_idEstadoPedido);
					
					$listadoVentas[] = $venta;
				}


				return $listadoVentas;
			}


			public static function obtenerVentasPorMesesEmpleado($año,$id_empleado) {
				$sqlEspañol="SET lc_time_names = 'es_ES';";
				$sql = "SELECT MONTHNAME(p.fecha_hora) AS Mes,
				SUM(p.total) AS Total
				FROM pedidoclente p
				WHERE YEAR(p.fecha_hora) = ". $año." and id_estado_pedido = 1 and id_empleado =".$id_empleado."
				GROUP BY Mes
				ORDER BY fecha_hora ASC;
				" ;


				$database = new MySQL();
				$database->consultar($sqlEspañol);
				$datos = $database->consultar($sql);

				$listadoVentas = [];

				while ($registro = $datos->fetch_assoc()) {
					$venta = new Venta();
					$venta->_total= $registro["Total"];
					$venta->_mes = $registro["Mes"];
					
					$listadoVentas[] = $venta;
				}


				return $listadoVentas;
			}



			public static function obtenerVentasPorMeses($año) {
				$sqlEspañol="SET lc_time_names = 'es_ES';";
				$sql = "SELECT MONTHNAME(p.fecha_hora) AS Mes,
				count(*) as cantidad,
				SUM(p.total) AS Total
				FROM pedidoclente p
				WHERE YEAR(p.fecha_hora) = ". $año." and id_estado_pedido = 1
				GROUP BY Mes
				ORDER BY fecha_hora ASC;
				" ;


				$database = new MySQL();
				$database->consultar($sqlEspañol);
				$datos = $database->consultar($sql);

				$listadoVentas = [];

				while ($registro = $datos->fetch_assoc()) {
					$venta = new Venta();
					$venta->_total= $registro["Total"];
					$venta->_cantidad= $registro["cantidad"];
					$venta->_mes = $registro["Mes"];
					
					$listadoVentas[] = $venta;
				}


				return $listadoVentas;
			}

			public static function obtenerPedidosPorMeses($año) {
				$sqlEspañol="SET lc_time_names = 'es_ES';";
				$sql = "SELECT MONTHNAME(p.fecha_hora) AS Mes,
				count(*) as cantidad,
				SUM(p.total) AS Total
				FROM pedidoclente p
				WHERE YEAR(p.fecha_hora) = ". $año." and p.id_Empleado is null
				GROUP BY Mes
				ORDER BY fecha_hora ASC;
				" ;


				$database = new MySQL();
				$database->consultar($sqlEspañol);
				$datos = $database->consultar($sql);

				$listadoVentas = [];

				while ($registro = $datos->fetch_assoc()) {
					$venta = new Venta();
					$venta->_total= $registro["Total"];
					$venta->_cantidad= $registro["cantidad"];
					$venta->_mes = $registro["Mes"];
					
					$listadoVentas[] = $venta;
				}


				return $listadoVentas;
			}


			public static function obtenerVentasPorMesActual() {
				$sql = "select fecha_hora,YEAR(fecha_hora) AS Año, MONTHNAME(fecha_hora) AS Mes, 
				WEEK(fecha_hora, 5) - WEEK(DATE_SUB(fecha_hora, INTERVAL DAYOFMONTH(fecha_hora) - 1 DAY), 5) + 1 as Semana, 
				DATE(DATE_ADD(fecha_hora, INTERVAL(1 - DAYOFWEEK(fecha_hora)) DAY)) fecha_inicio, 
				DATE(DATE_ADD(fecha_hora, INTERVAL (7 - DAYOFWEEK(fecha_hora) ) DAY)) fecha_fin,
				LAST_DAY(fecha_hora) ultimo_dia_del_mes,
				count(*) as cantidad,
				SUM(total) AS Total
 				FROM  pedidoclente
 				WHERE id_estado_pedido = 1 and MONTHNAME(fecha_hora) =  MONTHNAME(curdate()) and YEAR(curdate()) = YEAR(fecha_hora)
 				group by Semana
 				order by Semana ASC;" ;


				$database = new MySQL();
				$datos = $database->consultar($sql);

				$listadoVentas = [];

				while ($registro = $datos->fetch_assoc()) {
					$venta = new Venta();
					$venta->_total= $registro["Total"];
					$venta->_mes = $registro["Mes"];
					$venta->_fechaInicio = $registro["fecha_inicio"];
					$venta->_fechaFin = $registro["fecha_fin"];
					$venta->_ultimoDia = $registro["ultimo_dia_del_mes"];
					$venta->_cantidad= $registro["cantidad"];
					$venta->_semana = $registro["Semana"];
					
					$listadoVentas[] = $venta;
				}


				return $listadoVentas;
			}

			public static function obtenerPedidosPorMesActual() {
				$sql = "select fecha_hora,YEAR(fecha_hora) AS Año, MONTHNAME(fecha_hora) AS Mes, 
				WEEK(fecha_hora, 5) - WEEK(DATE_SUB(fecha_hora, INTERVAL DAYOFMONTH(fecha_hora) - 1 DAY), 5) + 1 as Semana, 
				DATE(DATE_ADD(fecha_hora, INTERVAL(1 - DAYOFWEEK(fecha_hora)) DAY)) fecha_inicio, 
				DATE(DATE_ADD(fecha_hora, INTERVAL (7 - DAYOFWEEK(fecha_hora) ) DAY)) fecha_fin,
				LAST_DAY(fecha_hora) ultimo_dia_del_mes,
				count(*) as cantidad,
				SUM(total) AS Total
 				FROM  pedidoclente
 				WHERE pedidoclente.id_Empleado is null and MONTHNAME(fecha_hora) =  MONTHNAME(curdate()) and YEAR(curdate()) = YEAR(fecha_hora)
 				group by Semana
 				order by Semana ASC;" ;


				$database = new MySQL();
				$datos = $database->consultar($sql);

				$listadoVentas = [];

				while ($registro = $datos->fetch_assoc()) {
					$venta = new Venta();
					$venta->_total= $registro["Total"];
					$venta->_mes = $registro["Mes"];
					$venta->_fechaInicio = $registro["fecha_inicio"];
					$venta->_fechaFin = $registro["fecha_fin"];
					$venta->_ultimoDia = $registro["ultimo_dia_del_mes"];
					$venta->_cantidad= $registro["cantidad"];
					$venta->_semana = $registro["Semana"];
					
					$listadoVentas[] = $venta;
				}


				return $listadoVentas;
			}

			public static function obtenerVentasPorSemanaActual() {
				$sql = "SELECT id_pedido_cliente,
				count(id_pedido_cliente) as cantidad,
						DAYOFWEEK(fecha_hora) as dia,
    					SUM(total) AS Total
						FROM pedidoclente
						WHERE id_estado_pedido = 1 and  YEARWEEK(fecha_hora) = YEARWEEK(CURDATE())
						group by dia
						order by dia asc" ;


				$database = new MySQL();
				$datos = $database->consultar($sql);

				$listadoVentas = [];

				while ($registro = $datos->fetch_assoc()) {
					$venta = new Venta();
					$venta->_total= $registro["Total"];
					$venta->_cantidad = $registro["cantidad"];
					$venta->_dia = $registro["dia"];
					
					
					$listadoVentas[] = $venta;
				}


				return $listadoVentas;
			}


			public static function obtenerPedidosPorSemanaActual() {
				$sql = "SELECT id_pedido_cliente,
				count(id_pedido_cliente) as cantidad,
						DAYOFWEEK(fecha_hora) as dia,
    					SUM(total) AS Total
						FROM pedidoclente
						WHERE pedidoclente.id_Empleado is null and YEARWEEK(fecha_hora) = YEARWEEK(CURDATE())
						group by dia
						order by dia asc" ;


				$database = new MySQL();
				$datos = $database->consultar($sql);

				$listadoVentas = [];

				while ($registro = $datos->fetch_assoc()) {
					$venta = new Venta();
					$venta->_total= $registro["Total"];
					$venta->_cantidad = $registro["cantidad"];
					$venta->_dia = $registro["dia"];
					
					
					$listadoVentas[] = $venta;
				}


				return $listadoVentas;
			}


			public static function obtenerVentasPorDiaActual() {
				
				$sql = "SELECT empleado.id_Empleado as id_empleado, count(id_pedido_cliente) as cantidad
				, sum(total) as total
				FROM pedidoclente 
                join empleado on empleado.id_empleado = pedidoclente.id_empleado
                join persona on persona.id_persona = empleado.id_persona
				WHERE DATE(fecha_hora) = CURDATE()
                group by empleado.id_empleado
                order by cantidad desc
				" ;

				
				$database = new MySQL();
				$datos = $database->consultar($sql);

				$listadoVentas = [];

				while ($registro = $datos->fetch_assoc()) {
					$venta = new Venta();
					$venta->_total= $registro["total"];
					$venta->_cantidad = $registro["cantidad"];
					$venta->_idEmpleado = $registro["id_empleado"];
					$venta->empleado = Empleado::obtenerPorId($venta->_idEmpleado);
					
					$listadoVentas[] = $venta;
				}


				return $listadoVentas;

			}


			public static function obtenerPedidosPorDiaActual() {
				
				$sql = "SELECT pedidoclente.id_Empleado as id_empleado, count(id_pedido_cliente) as cantidad
				, sum(total) as total
				FROM pedidoclente 
               
				WHERE pedidoclente.id_Empleado is null and DATE(fecha_hora) = CURDATE()
                group by pedidoclente.id_empleado
                order by cantidad desc
				" ;

				
				$database = new MySQL();
				$datos = $database->consultar($sql);

				$listadoVentas = [];

				while ($registro = $datos->fetch_assoc()) {
					$venta = new Venta();
					$venta->_total= $registro["total"];
					$venta->_cantidad = $registro["cantidad"];
					$venta->_idEmpleado = $registro["id_empleado"];
					$venta->empleado = Empleado::obtenerPorId($venta->_idEmpleado);
					
					$listadoVentas[] = $venta;
				}


				return $listadoVentas;

			}



			public static function obtenerTodosMasPorCategoria() {
				$sqlEspañol="SET lc_time_names = 'es_ES';";
				$sql = "SELECT categoria.nombre as nombreCategoria,sum(detallepedido.cantidad) as cantidad FROM pedidoclente 
				join detallepedido on pedidoclente.id_pedido_cliente = detallepedido.id_pedido_cliente
				join productotalle on detallepedido.id_producto_talle = productotalle.id_producto_talle
				join producto on productotalle.id_producto = producto.id_producto
				join categoria on producto.id_categoria = categoria.id_categoria
				GROUP BY producto.id_categoria
				ORDER BY SUM(detallepedido.cantidad) DESC
				" ;


				$database = new MySQL();
				$database->consultar($sqlEspañol);
				$datos = $database->consultar($sql);

				$listadoVentas = [];

				while ($registro = $datos->fetch_assoc()) {
					$venta = new Venta();
					$venta->_total= $registro["cantidad"];
					$venta->_mes = $registro["nombreCategoria"];
					
					$listadoVentas[] = $venta;
				}


				return $listadoVentas;
			}



			public static function obtenerVentasPresensiales() {
				
				$sql = "  SELECT  count(id_pedido_cliente) as cantidad
				, sum(total) as total
				FROM pedidoclente 
				WHERE id_empleado is not null
				and id_estado_pedido = 1;
				" ;


				$database = new MySQL();
				$datos = $database->consultar($sql);

				$registro = $datos->fetch_assoc();

				$venta = new Venta();
				$venta->_total= $registro["total"];
				$venta->_cantidad = $registro["cantidad"];
				

				return $venta;
			}


			public static function obtenerVentasVirtuales() {
				
				$sql = "  SELECT  count(id_pedido_cliente) as cantidad
				, sum(total) as total
				FROM pedidoclente 
				WHERE id_empleado is null
				and id_estado_pedido = 1;
				" ;

				$database = new MySQL();
				$datos = $database->consultar($sql);

				$registro = $datos->fetch_assoc();

				$venta = new Venta();
				$venta->_total= $registro["total"];
				$venta->_cantidad = $registro["cantidad"];
				

				return $venta;
			}

			public static function obtenerVentasPorDia() {
				
				$sql = "SELECT  count(id_pedido_cliente) as cantidad
				, sum(total) as total
				FROM pedidoclente 
				WHERE DATE(fecha_hora) = CURDATE() and pedidoclente.id_estado_pedido = 1;
				" ;

				$database = new MySQL();
				$datos = $database->consultar($sql);

				$registro = $datos->fetch_assoc();

				$venta = new Venta();
				$venta->_total= $registro["total"];
				$venta->_cantidad = $registro["cantidad"];
				

				return $venta;

			}

			public static function obtenerVentasPorDiaEmpleado($idEmpleado) {
				
				$sql = "SELECT  count(id_pedido_cliente) as cantidad
				, sum(total) as total
				FROM pedidoclente 
				WHERE DATE(fecha_hora) = CURDATE() and id_empleado =".$idEmpleado;

				$database = new MySQL();
				$datos = $database->consultar($sql);

				$registro = $datos->fetch_assoc();

				$venta = new Venta();
				$venta->_total= $registro["total"];
				$venta->_cantidad = $registro["cantidad"];
				

				return $venta;

			}

			public static function obtenerPedidosPendientes() {
				
				$sql = "SELECT * FROM pedidoclente where id_estado_pedido = 3";


				$database = new MySQL();
				$datos = $database->consultar($sql);

				$listadoVentas = [];

				while ($registro = $datos->fetch_assoc()) {
					$venta = new Venta();
					$venta->_idVenta = $registro["id_pedido_cliente"];
					$venta->_total= $registro["total"];
					$venta->_fechaHora = $registro["fecha_hora"];
					$venta->_idCliente = $registro["id_cliente"];
					$venta->_idEmpleado = $registro["id_Empleado"];
					$venta->_idEstadoPedido = $registro["id_estado_pedido"];
					
					$venta->cliente = Cliente::obtenerPorId($venta->_idCliente);
					$venta->estado = EstadoPedido::obtenerPorId($venta->_idEstadoPedido);
					
					$listadoVentas[] = $venta;
				}


				return $listadoVentas;
			}

			public static function obtenerPromedioVentas($año) {
				
				$sql = "SELECT count(p.id_pedido_cliente) as cantidad,sum(p.total) AS total
				FROM pedidoclente p
				WHERE YEAR(p.fecha_hora) = ".$año." and id_estado_pedido = 1 ORDER BY fecha_hora DESC" ;

				$database = new MySQL();
				$datos = $database->consultar($sql);

				$registro = $datos->fetch_assoc();

				$venta = new Venta();
				$venta->_total= $registro["total"];
				$venta->_cantidad = $registro["cantidad"];
				

				return $venta;

			}

			public static function obtenerPromedioVentasEmpleado($año,$id_empleado) {
				
				$sql = "SELECT count(p.id_pedido_cliente) as cantidad,sum(p.total) AS total
				FROM pedidoclente p
				WHERE YEAR(p.fecha_hora) = ".$año." and id_estado_pedido = 1 and id_empleado =".$id_empleado." ORDER BY fecha_hora DESC" ;

				$database = new MySQL();
				$datos = $database->consultar($sql);

				$registro = $datos->fetch_assoc();

				$venta = new Venta();
				$venta->_total= $registro["total"];
				$venta->_cantidad = $registro["cantidad"];
				

				return $venta;

			}


			public static function obtenerVentasDelMes() {
				
				$sql = " SELECT  count(id_pedido_cliente) as cantidad
				, sum(total) as total
				FROM pedidoclente 
				WHERE MONTH(DATE(fecha_hora)) = month(CURDATE())
				and id_estado_pedido = 1;" ;

				$database = new MySQL();
				$datos = $database->consultar($sql);

				$registro = $datos->fetch_assoc();

				$venta = new Venta();
				$venta->_total= $registro["total"];
				$venta->_cantidad = $registro["cantidad"];
				

				return $venta;

			}


			public static function obtenerVentasDelMesEmpleado($id_empleado) {
				
				$sql = " SELECT  count(id_pedido_cliente) as cantidad
				, sum(total) as total
				FROM pedidoclente 
				WHERE MONTH(DATE(fecha_hora)) = month(CURDATE())
				and id_estado_pedido = 1 and id_empleado =". $id_empleado; ;

				$database = new MySQL();
				$datos = $database->consultar($sql);

				$registro = $datos->fetch_assoc();

				$venta = new Venta();
				$venta->_total= $registro["total"];
				$venta->_cantidad = $registro["cantidad"];
				

				return $venta;

			}

			


			


			
			public static function obtenerId() {
				$sql = "SELECT id_pedido_cliente FROM pedidoclente ORDER BY id_pedido_cliente DESC LIMIT 1;";

				

				$database = new MySQL();
				$datos = $database->consultar($sql);

				if ($datos->num_rows == 0) {
					return false;
				}

				$registro = $datos->fetch_assoc();
				$venta = self::_crearVenta($registro);
				return $venta;

			}


			

			private static function _crearVenta($datos) {
				$venta = new Venta();
				$venta->_idVenta = $datos["id_pedido_cliente"];

				

				return $venta;
			}


		}



	?>