<?php

require_once "MySQL.php";
require_once "DomicilioProveedor.php";



class ProveedorDomicilio extends DomicilioProveedor {

	private $_idProveedorDomicilio;
	private $_idProveedor;



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
	



	public static function obtenerPorIdPersona($idPersona) {
		$sql ="SELECT persona_domicilio.id_persona_domicilio, persona_domicilio.id_persona, persona_domicilio.id_domicilios,"
		  ."domicilios.calle ,  domicilios.altura, domicilios.manzana , domicilios.numero_casa , domicilios.torre ,"
		  ." domicilios.piso, domicilios.observaciones , domicilios.id_barrio FROM persona_domicilio"
		  ." INNER JOIN domicilios ON domicilios.id_domicilios = persona_domicilio.id_domicilios"
		  ." INNER JOIN persona ON persona.id_persona = persona_domicilio.id_persona"
		  ." WHERE persona.id_persona = {$idPersona}";


        $database = new MySQL();
        $datos = $database->consultar($sql);

    	$listadoDomicilios = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$personaDomicilio = new PersonaDomicilio();
			$personaDomicilio->_idPersonaDomicilio = $registro["id_persona_domicilio"];
			$personaDomicilio->_idPersona = $registro["id_persona"];
			$personaDomicilio->_idDomicilio= $registro["id_domicilios"];
			$personaDomicilio->_calle = $registro["calle"];
			$personaDomicilio->_altura = $registro["altura"];
			$personaDomicilio->_manzana = $registro["manzana"];
			$personaDomicilio->_numeroCasa = $registro["numero_casa"];
			$personaDomicilio->_torre = $registro["torre"];
			$personaDomicilio->_piso = $registro["piso"];
			$personaDomicilio->_observaciones = $registro["observaciones"];
			$personaDomicilio->_idBarrio = $registro["id_barrio"];
			$personaDomicilio->barrio = Barrio::obtenerPorId($personaDomicilio->_idBarrio);
			$personaDomicilio->barrio ->localidad = Localidad::obtenerPorId($personaDomicilio->barrio->_idLocalidad);
			$personaDomicilio->barrio ->localidad->provincia = Provincia::obtenerPorId($personaDomicilio->barrio->localidad->_idProvincia);
			$personaDomicilio->barrio ->localidad->provincia->pais = Pais::obtenerPorId($personaDomicilio->barrio->localidad->provincia->_idPais);
    		$listadoDomicilios[] = $personaDomicilio;
    	}


    	return $listadoDomicilios;

	}

	 public static function obtenerPorId($id,$filtroEstado = 0) {
		$sql = "SELECT proveedor_domicilio.id_proveedor_domicilio, proveedor_domicilio.id_proveedor, proveedor_domicilio.id_domicilios,"
		."domicilios.calle ,  domicilios.altura, domicilios.manzana , domicilios.numero_casa , domicilios.torre ,"
		  ."domicilios.piso, domicilios.observaciones , domicilios.id_barrio FROM proveedor_domicilio"
		  ." INNER JOIN domicilios ON domicilios.id_domicilios = proveedor_domicilio.id_domicilios"
		  ." INNER JOIN proveedor ON proveedor.id_proveedor = proveedor_domicilio.id_proveedor WHERE id_proveedor_domicilio=" . $id;

		   $where = "";

        if ($filtroEstado != 0) {
            // $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
            $where = "and domicilios.estado = " . $filtroEstado;
        }

        $sql = $sql . " " . $where;


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



    private static function _crearDomicilio($datos) {
    	$proveedorDomicilio = new ProveedorDomicilio();
		$proveedorDomicilio->_idProveedorDomicilio = $datos["id_proveedor_domicilio"];
		$proveedorDomicilio->_idProveedor = $datos["id_proveedor"];
		$proveedorDomicilio->_idDomicilio= $datos["id_domicilios"];
		$proveedorDomicilio->_calle = $datos["calle"];
		$proveedorDomicilio->_altura = $datos["altura"];
		$proveedorDomicilio->_manzana = $datos["manzana"];
		$proveedorDomicilio->_numeroCasa = $datos["numero_casa"];
		$proveedorDomicilio->_torre = $datos["torre"];
		$proveedorDomicilio->_piso = $datos["piso"];
		$proveedorDomicilio->_observaciones = $datos["observaciones"];
		$proveedorDomicilio->_idBarrio = $datos["id_barrio"];
		$proveedorDomicilio->barrio = Barrio::obtenerPorId($proveedorDomicilio->_idBarrio);
		$proveedorDomicilio->barrio ->localidad = Localidad::obtenerPorId($proveedorDomicilio->barrio->_idLocalidad);
		$proveedorDomicilio->barrio ->localidad->provincia = Provincia::obtenerPorId($proveedorDomicilio->barrio->localidad->_idProvincia);
		$proveedorDomicilio->barrio ->localidad->provincia->pais = Pais::obtenerPorId($proveedorDomicilio->barrio->localidad->provincia->_idPais);
    		

		return $proveedorDomicilio;


    }
	
	public function guardar() {
		parent::guardar();

		$database = new MySQL();


		$sql = "INSERT INTO proveedor_domicilio (`id_proveedor_domicilio`, `id_Domicilios`, `id_proveedor`) VALUES (NULL,  {$this->_idDomicilio},  {$this->_idProveedor})";
	
        $database->insertar($sql);
	}

	public function eliminar() {
		
		$sql = "UPDATE domicilios join proveedor_domicilio on domicilios.id_Domicilios = proveedor_domicilio.id_Domicilios SET domicilios.estado = 2 WHERE proveedor_domicilio.id_proveedor_domicilio = {$this->_idProveedorDomicilio}
";

        $database = new MySQL();
        $database->eliminar($sql);
	}

}


?>