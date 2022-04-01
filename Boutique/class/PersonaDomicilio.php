<?php

require_once "MySQL.php";
require_once "Domicilio.php";



class PersonaDomicilio extends Domicilio {

	private $_idPersonaDomicilio;
	private $_idPersona;

	public $barrio;


	public function getIdPersonaDomicilio() {
		return $this->_idPersonaDomicilio;
	}

	public function getIdPersona() {
		return $this->_idPersona;
	}

	public function setIdPersona($idPersona) {
		$this->_idPersona = $idPersona;
	}

	public function setIdDomicilio($idDomicilio) {
		$this->_idDomicilio = $idDomicilio;
	}

	


	public static function obtenerPorIdPersona($idPersona,$filtroEstado = 0) {
		$sql ="SELECT persona_domicilio.id_persona_domicilio, persona_domicilio.id_persona, persona_domicilio.id_domicilios,"
		  ."domicilios.calle ,  domicilios.altura, domicilios.manzana , domicilios.numero_casa , domicilios.torre ,domicilios.estado,"
		  ." domicilios.piso, domicilios.observaciones , domicilios.id_barrio FROM persona_domicilio"
		  ." INNER JOIN domicilios ON domicilios.id_domicilios = persona_domicilio.id_domicilios"
		  ." INNER JOIN persona ON persona.id_persona = persona_domicilio.id_persona"
		  ." WHERE persona.id_persona = {$idPersona}";

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
			$personaDomicilio->_estado = $registro["estado"];
			$personaDomicilio->barrio = Barrio::obtenerPorId($personaDomicilio->_idBarrio);
			$personaDomicilio->barrio ->localidad = Localidad::obtenerPorId($personaDomicilio->barrio->_idLocalidad);
			$personaDomicilio->barrio ->localidad->provincia = Provincia::obtenerPorId($personaDomicilio->barrio->localidad->_idProvincia);
			$personaDomicilio->barrio ->localidad->provincia->pais = Pais::obtenerPorId($personaDomicilio->barrio->localidad->provincia->_idPais);
    		$listadoDomicilios[] = $personaDomicilio;
    	}


    	return $listadoDomicilios;

	}

	 public static function obtenerPorId($idPersonaDomicilio) {
		$sql = "SELECT * FROM persona_domicilio WHERE id_persona_domicilio={$idPersonaDomicilio}";

		$database = new MySQL();
		$datos = $database->consultar($sql);

		$registro = $datos->fetch_assoc();

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
		//$personaDomicilio->barrio = Barrio::obtenerPorId($personaDomicilio->_idBarrio);
		//$personaDomicilio->barrio ->localidad = Localidad::obtenerPorId($personaDomicilio->barrio->_idLocalidad);
		//$personaDomicilio->barrio ->localidad->provincia = Provincia::obtenerPorId($personaDomicilio->barrio->localidad->_idProvincia);
		$personaDomicilio->barrio ->localidad->provincia->pais = Pais::obtenerPorId($personaDomicilio->barrio->localidad->provincia->_idPais);
    		

		return $personaDomicilio;

	}
public static function obtenerPorIdPD($id) {
    	$sql ="SELECT persona_domicilio.id_persona_domicilio, persona_domicilio.id_persona, persona_domicilio.id_domicilios,"
		  ."domicilios.calle ,  domicilios.altura, domicilios.manzana , domicilios.numero_casa , domicilios.torre ,"
		  ." domicilios.piso, domicilios.observaciones , domicilios.id_barrio FROM persona_domicilio"
		  ." INNER JOIN domicilios ON domicilios.id_domicilios = persona_domicilio.id_domicilios"
		  ." INNER JOIN persona ON persona.id_persona = persona_domicilio.id_persona WHERE id_persona_domicilio=" . $id;

		
		
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
		$sql ="UPDATE domicilios join persona_domicilio 
on domicilios.id_Domicilios = persona_domicilio.id_Domicilios SET domicilios.estado = 2 
 WHERE persona_domicilio.id_persona_domicilio = {$this->_idPersonaDomicilio}
";

	
        $database = new MySQL();
        $database->eliminar($sql);
        
	}

		private static function _crearDomicilio($datos) {
    	$domicilio = new PersonaDomicilio();
			$domicilio->_idPersonaDomicilio = $datos["id_persona_domicilio"];
			$domicilio->_idPersona = $datos["id_persona"];
			$domicilio->_idDomicilio= $datos["id_domicilios"];
			$domicilio->_calle = $datos["calle"];
			$domicilio->_altura = $datos["altura"];
			$domicilio->_manzana = $datos["manzana"];
			$domicilio->_numeroCasa = $datos["numero_casa"];
			$domicilio->_torre = $datos["torre"];
			$domicilio->_piso = $datos["piso"];
			$domicilio->_observaciones = $datos["observaciones"];
			$domicilio->_idBarrio = $datos["id_barrio"];
			$domicilio->barrio = Barrio::obtenerPorId($domicilio->_idBarrio);
			$domicilio->barrio ->localidad = Localidad::obtenerPorId($domicilio->barrio->_idLocalidad);
			$domicilio->barrio ->localidad->provincia = Provincia::obtenerPorId($domicilio->barrio->localidad->_idProvincia);
			$domicilio->barrio ->localidad->provincia->pais = Pais::obtenerPorId($domicilio->barrio->localidad->provincia->_idPais);

		return $domicilio;
    }



	public function guardar() {
		parent::guardar();

		$database = new MySQL();


		$sql = "INSERT INTO persona_domicilio (`id_persona_domicilio`, `id_Domicilios`, `id_persona`) VALUES (NULL,  {$this->_idDomicilio},  {$this->_idPersona})";
	
        $database->insertar($sql);
	}

	

}


?>