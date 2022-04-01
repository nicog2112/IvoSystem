<?php

require_once "MySQL.php";


class Proveedor{

	private $_idProveedor;
	private $_nombreProveedor;
	private $_cuit;
	private $_fechaAlta;
	private $_estado;

	public function getIdProveedor() {
		return $this->_idProveedor;
	}
	public function getNombreProveedor() {
		return $this->_nombreProveedor;
	}

	public function setNombreProveedor($nombreProveedor) {
		$this->_nombreProveedor = $nombreProveedor;
	}

	public function getCuit() {
		return $this->_cuit;
	}

	public function setCuit($cuit) {
		$this->_cuit = $cuit;
	}

	public function getFechaAlta() {
		return $this->_fechaAlta;
	}

	public function setFechaAlta($fechaAlta) {
		$this->_fechaAlta = $fechaAlta;
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

		$sql = "INSERT INTO proveedor "
		     . "(`id_Proveedor`, `nombre_proveedor`, `CUIT`,`fecha_alta`,`estado`)  "
		     . "VALUES (NULL, '{$this->_nombreProveedor}', '{$this->_cuit}','{$this->_fechaAlta}','{$this->_estado}') ";

	
		
		$database->insertar($sql);

	}

	public function actualizar() {

        $database = new MySQL();

        $sql = "UPDATE proveedor SET nombre_proveedor = '{$this->_nombreProveedor}',"
		     . "cuit = '{$this->_cuit}' "
             . "WHERE proveedor.id_proveedor = {$this->_idProveedor}";

        
        $database->actualizar($sql);

    }

	public static function obtenerTodos($filtroEstado = 0) {
    	$sql = "SELECT * from proveedor ";

		$where = "";

        if ($filtroEstado != 0) {
        	// $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
        	$where = "WHERE proveedor.estado = " . $filtroEstado;
        }

        $sql = $sql . " " . $where;
       
    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoProveedor = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$proveedor = new Proveedor();
			$proveedor->_idProveedor = $registro["id_proveedor"];
			$proveedor->_nombreProveedor = $registro["nombre_proveedor"];
			$proveedor->_cuit = $registro["cuit"];
			$proveedor->_fechaAlta = $registro["fecha_alta"];
			$proveedor->_estado = $registro["estado"];
    		$listadoProveedor[] = $proveedor;
    	}


    	return $listadoProveedor;
	}

	public static function obtenerTodosActivos() {
    	$sql = "SELECT * from proveedor where estado = 1 ";

		
    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoProveedor = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$proveedor = new Proveedor();
			$proveedor->_idProveedor = $registro["id_proveedor"];
			$proveedor->_nombreProveedor = $registro["nombre_proveedor"];
			$proveedor->_cuit = $registro["cuit"];
			$proveedor->_fechaAlta = $registro["fecha_alta"];
			$proveedor->_estado = $registro["estado"];
    		$listadoProveedor[] = $proveedor;
    	}


    	return $listadoProveedor;
	}

	public static function obtenerPorId($id) {
    	$sql = "SELECT proveedor.id_proveedor, proveedor.nombre_proveedor, proveedor.cuit, "
             . "proveedor.fecha_alta FROM proveedor "
             . "WHERE id_proveedor =" . $id;

       

        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$proveedor = self::_crearProveedor($registro);
		return $proveedor;

    }


    public function eliminar() {


        $sql = "UPDATE proveedor SET estado = '{$this->_estado}' "
             . "WHERE proveedor.id_proveedor = {$this->_idProveedor}";
            
        $database = new MySQL();
        $database->actualizar($sql);

    }

     private static function _crearProveedor($datos) {
    	$proveedor = new Proveedor();
		$proveedor->_idProveedor = $datos["id_proveedor"];
		$proveedor->_nombreProveedor = $datos["nombre_proveedor"];
		$proveedor->_cuit = $datos["cuit"];
        $proveedor->_fechaAlta = $datos["fecha_alta"];


		return $proveedor;
    }


}



?>