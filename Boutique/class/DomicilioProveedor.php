<?php

require_once "Barrio.php";
require_once "MySQL.php";



class DomicilioProveedor {

	protected $_idDomicilio;
	private $_idProveedorDomicilio;
	private $_idProveedor;
	protected $_calle;
	protected $_altura;
	protected $_manzana;
	protected $_numeroCasa;
	protected $_torre;
	protected $_piso;
	protected $_observaciones;
	protected $_idBarrio;
	protected $_estado;


	public function getIdProveedorDomicilio() {
		return $this->_idProveedorDomicilio;
	}

	public function getIdProveedor() {
		return $this->_idProveedor;
	}

	public function setIdProveedor($idProveedor) {
		$this->_idProveedor = $idProveedor;
	}

	public function setIdDomicilio($idDomicilio) {
		$this->_idDomicilio = $idDomicilio;
	}

	public function getIdDomicilio() {
		return $this->_idDomicilio;
	}

	public function getCalle() {
		return $this->_calle;
	}

	public function setCalle($calle) {
		$this->_calle = $calle;
	}

	public function getAltura() {
		return $this->_altura;
	}

	public function setAltura($altura) {
		$this->_altura = $altura;
	}

	public function getManzana() {
		return $this->_manzana;
	}

	public function setManzana($manzana) {
		$this->_manzana = $manzana;
	}

	public function getNumeroCasa() {
		return $this->_numeroCasa;
	}

	public function setNumeroCasa($numeroCasa) {
		$this->_numeroCasa = $numeroCasa;
	}

	public function getTorre() {
		return $this->_torre;
	}

	public function setTorre($torre) {
		$this->_torre = $torre;
	}

	public function getPiso() {
		return $this->_piso;
	}

	public function setPiso($piso) {
		$this->_piso = $piso;
	}

	public function getObservaciones() {
		return $this->_observaciones;
	}

	public function setObservaciones($observaciones) {
		$this->_observaciones = $observaciones;
	}

	public function getIdBarrio() {
		return $this->_idBarrio;
	}

	public function setIdBarrio($idBarrio) {
		$this->_idBarrio = $idBarrio;
	}
	public function setIdEstado($estado) {
		$this->_estado = $estado;
	}
	
	public function getEstado() {
		return $this->_estado;
	}
	public function guardar() {
		$sql = "INSERT INTO `domicilios`  (`id_Domicilios`, `calle`, `altura`, `manzana`, `numero_casa`, `torre`, `piso`, `observaciones`, `id_barrio`,`estado`) VALUES (NULL , '{$this->_calle}','{$this->_altura}','{$this->_manzana}','{$this->_numeroCasa}', '{$this->_torre}', '{$this->_piso}', '{$this->_observaciones}', '{$this->_idBarrio}',1)"; 
			
		
        $database = new MySQL();
        $idInsertado = $database->insertar($sql);

        $this->_idDomicilio = $idInsertado;
	}

	public static function obtenerTodos()
	{
		$sql = "SELECT * FROM domicilios";
		$database = new MySQL();
		$datos = $database->consultar($sql);

    	$listadoDomicilios = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$domicilio = new Domicilio();
			$domicilio->_idDomicilio = $registro["id_domicilios"];
			$domicilio->_calle = $registro["calle"];
			$domicilio->_altura = $registro["altura"];
			$domicilio->_manzana = $registro["manzana"];
			$domicilio->_numeroCasa = $registro["numero_casa"];
			$domicilio->_torre = $registro["torre"];
			$domicilio->_piso = $registro["piso"];
			$domicilio->_observaciones = $registro["observaciones"];
			$domicilio->_idBarrio = $registro["id_barrio"];
    		$listadoDomicilios[] = $domicilio;
    	}


    	return $listadoDomicilios;

	}


	public static function obtenerPorIdProveedorDomicilio($idProveedorDomicilio) {
		$sql ="SELECT proveedor_domicilio.id_proveedor_domicilio, proveedor_domicilio.id_proveedor, proveedor_domicilio.id_domicilios,"
		  ."domicilios.calle ,  domicilios.altura, domicilios.manzana , domicilios.numero_casa , domicilios.torre ,"
		  ." domicilios.piso, domicilios.observaciones , domicilios.id_barrio FROM proveedor_domicilio"
		  ." INNER JOIN domicilios ON domicilios.id_domicilios = proveedor_domicilio.id_domicilios"
		  ." INNER JOIN proveedor ON proveedor.id_proveedor = proveedor_domicilio.id_proveedor WHERE id_proveedor_domicilio={$idProveedorDomicilio}";

		$database = new MySQL();
		$datos = $database->consultar($sql);

		$registro = $datos->fetch_assoc();

		$domicilioProveedor = new DomicilioProveedor();
		$domicilioProveedor->_idProveedorDomicilio = $registro["id_proveedor_domicilio"];
		$domicilioProveedor->_idProveedor = $registro["id_proveedor"];
		$domicilioProveedor->_idDomicilio= $registro["id_domicilios"];
		$domicilioProveedor->_calle = $registro["calle"];
		$domicilioProveedor->_altura = $registro["altura"];
		$domicilioProveedor->_manzana = $registro["manzana"];
		$domicilioProveedor->_numeroCasa = $registro["numero_casa"];
		$domicilioProveedor->_torre = $registro["torre"];
		$domicilioProveedor->_piso = $registro["piso"];
		$domicilioProveedor->_observaciones = $registro["observaciones"];
		$domicilioProveedor->_idBarrio = $registro["id_barrio"];


		return $domicilioProveedor;

	}


	public static function obtenerPorIdProveedor($idProveedor,$filtroEstado = 0) {
		$sql ="SELECT proveedor_domicilio.id_proveedor_domicilio, proveedor_domicilio.id_proveedor, proveedor_domicilio.id_domicilios,"
		  ."domicilios.calle ,  domicilios.altura, domicilios.manzana , domicilios.numero_casa , domicilios.torre ,"
		  ." domicilios.piso, domicilios.observaciones , domicilios.id_barrio, domicilios.estado FROM proveedor_domicilio"
		  ." INNER JOIN domicilios ON domicilios.id_domicilios = proveedor_domicilio.id_domicilios"
		  ." INNER JOIN proveedor ON proveedor.id_proveedor = proveedor_domicilio.id_proveedor WHERE proveedor.id_proveedor={$idProveedor}";


		   $where = "";

        if ($filtroEstado != 0) {
            // $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
            $where = "and domicilios.estado = " . $filtroEstado;
        }

        $sql = $sql . " " . $where;
        

        $database = new MySQL();
        $datos = $database->consultar($sql);

    	$listadoDomicilios = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$domicilioProveedor = new DomicilioProveedor();
		$domicilioProveedor->_idProveedorDomicilio = $registro["id_proveedor_domicilio"];
		$domicilioProveedor->_idProveedor = $registro["id_proveedor"];
		$domicilioProveedor->_idDomicilio= $registro["id_domicilios"];
		$domicilioProveedor->_calle = $registro["calle"];
		$domicilioProveedor->_altura = $registro["altura"];
		$domicilioProveedor->_manzana = $registro["manzana"];
		$domicilioProveedor->_numeroCasa = $registro["numero_casa"];
		$domicilioProveedor->_torre = $registro["torre"];
		$domicilioProveedor->_piso = $registro["piso"];
		$domicilioProveedor->_observaciones = $registro["observaciones"];
		$domicilioProveedor->_idBarrio = $registro["id_barrio"];
		$domicilioProveedor->_estado = $registro["estado"];
		$domicilioProveedor->barrio = Barrio::obtenerPorId($domicilioProveedor->_idBarrio);
		$domicilioProveedor->barrio ->localidad = Localidad::obtenerPorId($domicilioProveedor->barrio->_idLocalidad);
		$domicilioProveedor->barrio ->localidad->provincia = Provincia::obtenerPorId($domicilioProveedor->barrio->localidad->_idProvincia);
		$domicilioProveedor->barrio ->localidad->provincia->pais = Pais::obtenerPorId($domicilioProveedor->barrio->localidad->provincia->_idPais);
    		$listadoDomicilios[] = $domicilioProveedor;
    	}


    	return $listadoDomicilios;

	}

	public static function obtenerPorId($id) {
    	$sql ="SELECT proveedor_domicilio.id_proveedor_domicilio, proveedor_domicilio.id_proveedor, proveedor_domicilio.id_domicilios,"
		  ."domicilios.calle ,  domicilios.altura, domicilios.manzana , domicilios.numero_casa , domicilios.torre ,"
		  ." domicilios.piso, domicilios.observaciones , domicilios.id_barrio FROM proveedor_domicilio"
		  ." INNER JOIN domicilios ON domicilios.id_domicilios = proveedor_domicilio.id_domicilios"
		  ." INNER JOIN proveedor ON proveedor.id_proveedor = proveedor_domicilio.id_proveedor WHERE proveedor.id_proveedor=" . $id;


        $database = new MySQL();
        $datos = $database->consultar($sql);

        // TODO: ver que pasa cuando no existe el empleado
        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$domicilio = self::_crearDomicilio($registro);
		return $domicilio;

    }

	public function eliminar() {
		$sql = "DELETE FROM proveedor_domicilio WHERE id_proveedor_domicilio={$this->_idProveedorDomicilio}";

        $database = new MySQL();
        $database->eliminar($sql);
	
	}

	public function actualizar() {
        $sql = "UPDATE domicilios SET calle = '{$this->_calle}', altura = '{$this->_altura}', "
             . " manzana = '{$this->_manzana}',numero_casa = '{$this->_numeroCasa}',"
             ." torre = '{$this->_torre}' ,  piso = '{$this->_piso}',"
             . " observaciones = '{$this->_observaciones}',"
             . " id_barrio = '{$this->_idBarrio}'"
             . "WHERE id_Domicilios = {$this->_idDomicilio}";




        $database = new MySQL();
        $database->actualizar($sql);
    }


	private static function _crearDomicilio($datos) {
    	$domicilioProveedor = new DomicilioProveedor();
			$domicilioProveedor->_idProveedorDomicilio = $datos["id_proveedor_domicilio"];
			$domicilioProveedor->_idProveedor = $datos["id_proveedor"];
			$domicilioProveedor->_idDomicilio= $datos["id_domicilios"];
			$domicilioProveedor->_calle = $datos["calle"];
			$domicilioProveedor->_altura = $datos["altura"];
			$domicilioProveedor->_manzana = $datos["manzana"];
			$domicilioProveedor->_numeroCasa = $datos["numero_casa"];
			$domicilioProveedor->_torre = $datos["torre"];
			$domicilioProveedor->_piso = $datos["piso"];
			$domicilioProveedor->_observaciones = $datos["observaciones"];
			$domicilioProveedor->_idBarrio = $datos["id_barrio"];
			$domicilioProveedor->barrio = Barrio::obtenerPorId($domicilioProveedor->_idBarrio);
			$domicilioProveedor->barrio ->localidad = Localidad::obtenerPorId($domicilioProveedor->barrio->_idLocalidad);
			$domicilioProveedor->barrio ->localidad->provincia = Provincia::obtenerPorId($domicilioProveedor->barrio->localidad->_idProvincia);
			$domicilioProveedor->barrio ->localidad->provincia->pais = Pais::obtenerPorId($domicilioProveedor->barrio->localidad->provincia->_idPais);

		return $domicilioProveedor;
    }


	
}


?>