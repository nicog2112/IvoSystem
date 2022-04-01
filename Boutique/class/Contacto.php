<?php

require_once "MySQL.php";



class Contacto {

	private $_idPersonaContacto;
	private $_idPersona;
	private $_idTipoContacto;
	private $_valor;
	protected $_estado;

	private $_descripcion;

	public function getDescripcion() {
		return $this->_descripcion;
	}

	public function getValor() {
		return $this->_valor;
	}

	public function getIdPersonaContacto() {
		return $this->_idPersonaContacto;
	}

	public function getIdPersona() {
		return $this->_idPersona;
	}

	public function setIdPersona($idPersona) {
		$this->_idPersona = $idPersona;
	}

	public function setIdTipoContacto($idTipoContacto) {
		$this->_idTipoContacto = $idTipoContacto;
	}

	public function getIdTipoContacto() {
		return $this->_idTipoContacto;
	}

	public function setValor($valor) {
		$this->_valor = $valor;
	}
	public function setIdEstado($estado) {
		$this->_estado = $estado;
	}
	
	public function getEstado() {
		return $this->_estado;
	}

	public static function obtenerPorIdPersona($idPersona,$filtroEstado = 0) {
		$sql = "SELECT persona_tipocontacto.id_persona_tipo_contacto, persona_tipocontacto.id_persona, "
             . "persona_tipocontacto.id_tipo_contacto, persona_tipocontacto.valor,persona_tipocontacto.estado, "
       		 . "tipo_de_contacto.descripcion "
			 . "FROM persona_tipocontacto "
             . "INNER JOIN tipo_de_contacto ON tipo_de_contacto.id_tipo_contacto = persona_tipocontacto.id_tipo_contacto "
             . "INNER JOIN persona ON persona.id_persona = persona_tipocontacto.id_persona "
             . "WHERE persona.id_persona = {$idPersona}";



		   $where = "";

        if ($filtroEstado != 0) {
            // $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
            $where = "and persona_tipocontacto.estado = " . $filtroEstado;
        }

        $sql = $sql . " " . $where;
  

        $database = new MySQL();
        $datos = $database->consultar($sql);

    	$listadoContactos = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$contacto = new Contacto();
			$contacto->_idPersonaContacto = $registro["id_persona_tipo_contacto"];
			$contacto->_idPersona = $registro["id_persona"];
			$contacto->_idTipoContacto = $registro["id_tipo_contacto"];
			$contacto->_valor = $registro["valor"];
			$contacto->_descripcion = $registro["descripcion"];
			$contacto->_estado = $registro["estado"];
    		$listadoContactos[] = $contacto;
    	}


    	return $listadoContactos;

	}

	public static function obtenerPorIdPersonaWeb($idPersona) {
		$sql = "SELECT persona_tipocontacto.id_persona_tipo_contacto, persona_tipocontacto.id_persona, "
             . "persona_tipocontacto.id_tipo_contacto, persona_tipocontacto.valor,persona_tipocontacto.estado, "
       		 . "tipo_de_contacto.descripcion "
			 . "FROM persona_tipocontacto "
             . "INNER JOIN tipo_de_contacto ON tipo_de_contacto.id_tipo_contacto = persona_tipocontacto.id_tipo_contacto "
             . "INNER JOIN persona ON persona.id_persona = persona_tipocontacto.id_persona "
             . "WHERE persona.id_persona = {$idPersona} and persona_tipocontacto.estado = 1";




        $database = new MySQL();
        $datos = $database->consultar($sql);

    	$listadoContactos = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$contacto = new Contacto();
			$contacto->_idPersonaContacto = $registro["id_persona_tipo_contacto"];
			$contacto->_idPersona = $registro["id_persona"];
			$contacto->_idTipoContacto = $registro["id_tipo_contacto"];
			$contacto->_valor = $registro["valor"];
			$contacto->_descripcion = $registro["descripcion"];
			$contacto->_estado = $registro["estado"];
    		$listadoContactos[] = $contacto;
    	}


    	return $listadoContactos;

	}

	 public static function obtenerPorId($idPersonaContacto) {
		$sql = "SELECT * FROM persona_tipocontacto WHERE id_persona_tipo_contacto={$idPersonaContacto}";

		$database = new MySQL();
		$datos = $database->consultar($sql);

		$registro = $datos->fetch_assoc();

		$contacto = new Contacto();
		$contacto->_idPersonaContacto = $registro["id_persona_tipo_contacto"];
		$contacto->_idPersona = $registro["id_persona"];
		$contacto->_idTipoContacto = $registro["id_tipo_contacto"];
		$contacto->_valor = $registro["valor"];	
		
    		

		return $contacto;

	}

	public function guardar() {
		$sql = "INSERT INTO persona_tipocontacto "
		     . "(id_persona_tipo_contacto, id_persona, id_tipo_contacto, valor,estado) "
		     . "VALUES (NULL, {$this->_idPersona}, {$this->_idTipoContacto}, '{$this->_valor}',1)";

        $database = new MySQL();
        $idInsertado = $database->insertar($sql);

        $this->_idPersonaContacto = $idInsertado;
	}

	public function eliminar() {
		$sql = "UPDATE persona_tipocontacto SET persona_tipocontacto.estado = 2 WHERE id_persona_tipo_contacto = {$this->_idPersonaContacto}";
		
        $database = new MySQL();
        $database->eliminar($sql);
	}

	public function actualizar() {
        $sql = "UPDATE persona_tipocontacto SET id_tipo_contacto = '{$this->_idTipoContacto}', valor = '{$this->_valor}'"
             . "WHERE id_persona_tipo_contacto = {$this->_idPersonaContacto}";

  
  


        $database = new MySQL();
        $database->actualizar($sql);
    }


}


?>