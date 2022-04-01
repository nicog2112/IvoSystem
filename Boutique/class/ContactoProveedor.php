<?php

require_once "MySQL.php";



class ContactoProveedor {

	private $_idProveedorContacto;
	private $_idProveedor;
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

	public function getIdProveedorContacto() {
		return $this->_idProveedorContacto;
	}

	public function getIdProveedor() {
		return $this->_idProveedor;
	}

	public function setIdProveedor($idProveedor) {
		$this->_idProveedor = $idProveedor;
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

	public static function obtenerPorIdProveedor($idProveedor,$filtroEstado = 0) {
		$sql = "SELECT proveedor_tipocontacto.id_proveedor_tipo_contacto, proveedor_tipocontacto.id_proveedor, "
             . "proveedor_tipocontacto.id_tipo_contacto, proveedor_tipocontacto.valor, "
       		 . "tipo_de_contacto.descripcion,proveedor_tipocontacto.estado "
			 . "FROM proveedor_tipocontacto "
             . "INNER JOIN tipo_de_contacto ON tipo_de_contacto.id_tipo_contacto = proveedor_tipocontacto.id_tipo_contacto "
             . "INNER JOIN proveedor ON proveedor.id_proveedor = proveedor_tipocontacto.id_proveedor "
             . "WHERE proveedor.id_proveedor = {$idProveedor}";



		   $where = "";

        if ($filtroEstado != 0) {
            // $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
            $where = "and proveedor_tipocontacto.estado = " . $filtroEstado;
        }

        $sql = $sql . " " . $where;
        

        $database = new MySQL();
        $datos = $database->consultar($sql);

    	$listadoContactos = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$contacto = new ContactoProveedor();
			$contacto->_idProveedorContacto = $registro["id_proveedor_tipo_contacto"];
			$contacto->_idProveedor = $registro["id_proveedor"];
			$contacto->_idTipoContacto = $registro["id_tipo_contacto"];
			$contacto->_valor = $registro["valor"];
			$contacto->_descripcion = $registro["descripcion"];
			$contacto->_estado = $registro["estado"];
    		$listadoContactos[] = $contacto;
    	}


    	return $listadoContactos;

	}

	 public static function obtenerPorId($idProveedorContacto) {
		$sql = "SELECT * FROM proveedor_tipocontacto WHERE id_proveedor_tipo_contacto={$idProveedorContacto}";


		$database = new MySQL();
		$datos = $database->consultar($sql);

		$registro = $datos->fetch_assoc();

		$contacto = new ContactoProveedor();
		$contacto->_idProveedorContacto = $registro["id_proveedor_tipo_contacto"];
		$contacto->_idProveedor = $registro["id_proveedor"];
		$contacto->_idTipoContacto = $registro["id_tipo_contacto"];
		$contacto->_valor = $registro["valor"];

    		

		return $contacto;

	}

	public function guardar() {
		$sql = "INSERT INTO proveedor_tipocontacto "
		     . "(id_proveedor_tipo_contacto, id_proveedor, id_tipo_contacto, valor, estado) "
		     . "VALUES (NULL, {$this->_idProveedor}, {$this->_idTipoContacto}, '{$this->_valor}',1)";

        $database = new MySQL();
        $idInsertado = $database->insertar($sql);

        $this->_idProveedorContacto = $idInsertado;
	}

	public function eliminar() {
		$sql = "UPDATE proveedor_tipocontacto SET proveedor_tipocontacto.estado = 2 WHERE id_proveedor_tipo_contacto = {$this->_idProveedorContacto}";

        $database = new MySQL();
        $database->eliminar($sql);
	}

	public function actualizar() {
        $sql = "UPDATE proveedor_tipocontacto SET id_tipo_contacto = '{$this->_idTipoContacto}', valor = '{$this->_valor}'"
             . "WHERE id_proveedor_tipo_contacto = {$this->_idProveedorContacto}";

  
  


        $database = new MySQL();
        $database->actualizar($sql);
    }

}


?>