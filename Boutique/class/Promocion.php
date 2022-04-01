<?php

require_once "MySQL.php";


class Promocion {

	private $_idPromocion;
	private $_nombre;
	private $_fechaInicio;
	private $_fechaFin;
	

	/**
     * @return mixed
     */
    public function getIdPromocion()
    {
        return $this->_idPromocion;
    }

        /**
     * @return mixed
     */
    public function setNombre($_nombre)
    {
        $this->_nombre = $_nombre;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->_nombre;
    }

        /**
     * @return mixed
     */
    public function setFechaInicio($_fechaInicio)
    {
        $this->_fechaInicio = $_fechaInicio;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getFechaInicio()
    {
        return $this->_fechaInicio;
    }

            /**
     * @return mixed
     */
    public function setFechaFin($_fechaFin)
    {
        $this->_fechaFin = $_fechaFin;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getFechaFin()
    {
        return $this->_fechaFin;
    }


	public function guardar() {

		$database = new MySQL();

		$sql = "INSERT INTO promocion "
		     . "(`id_promocion`, `nombre` , `fecha_inicio`, `fecha_fin`)  "
		     . "VALUES (NULL, '{$this->_nombre}' , '{$this->_fechaInicio}'  , '{$this->_fechaFin}')";

		$database->insertar($sql);

	}

	public function actualizar() {

        $database = new MySQL();

        $sql = "UPDATE promocion SET nombre = '{$this->_nombre}', fecha_inicio = '{$this->_fechaInicio}'"
       		 . ", fecha_fin = '{$this->_fechaFin}'"
             . "WHERE promocion.id_promocion = {$this->_idPromocion}";


        $database->actualizar($sql);

    }

    public function eliminar() {

        $sql = "DELETE FROM promocion WHERE id_promocion={$this->_idPromocion}";
        
        $database = new MySQL();
        $database->eliminar($sql);

    }

	public static function obtenerTodos() {

    	$sql = "SELECT * FROM promocion";


    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoPromocion = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$promocion = new Promocion();
			$promocion->_idPromocion = $registro["id_promocion"];
			$promocion->_nombre = $registro["nombre"];
			$promocion->_fechaInicio = $registro["fecha_inicio"];
			$promocion->_fechaFin = $registro["fecha_fin"];
    		$listadoPromocion[] = $promocion;
    	}


    	return $listadoPromocion;

	}

	public static function obtenerPorId($idPromocion) {
		$sql = "SELECT * FROM promocion WHERE id_promocion={$idPromocion}";

		$database = new MySQL();
		$datos = $database->consultar($sql);

		$registro = $datos->fetch_assoc();

		$promocion = new Promocion();
		$promocion->_idPromocion = $registro["id_promocion"];
		$promocion->_nombre = $registro["nombre"];
		$promocion->_fechaInicio = $registro["fecha_inicio"];
		$promocion->_fechaFin = $registro["fecha_fin"];

		return $promocion;

	}

}


?>