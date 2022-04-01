<?php

require_once "MySQL.php";


class Factura {

	private $_idFactura; 
	private $_numeracion;
    private $_fechaEmision;
    private $_idEstadosPagos;
    private $_idTipoFactura;

    /**
     * @return mixed
     */
    public function getIdFactura()
    {
        return $this->_idFactura;
    }


        /**
     * @return mixed
     */
    public function setIdEstadosPagos($_idEstadosPagos)
    {
        $this->_idEstadosPagos = $_idEstadosPagos;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getIdEstadosPagos()
    {
        return $this->_idEstadosPagos;
    }



        /**
     * @return mixed
     */
    public function setIdTipoFactura($_idTipoFactura)
    {
        $this->_idTipoFactura = $_idTipoFactura;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getIdTipoFactura()
    {
        return $this->_idTipoFactura;
    }

        /**
     * @return mixed
     */
    public function setNumeracion($_numeracion)
    {
        $this->_numeracion = $_numeracion;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getNumeracion()
    {
        return $this->_numeracion;
    }


        /**
     * @return mixed
     */
    public function setFechaEmision($_fechaEmision)
    {
        $this->_fechaEmision = $_fechaEmision;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getFechaEmision()
    {
        return $this->_fechaEmision;
    }


    public function guardar() {

        $database = new MySQL();

        $sql = "INSERT INTO factura(`id_factura`,`id_estados_pagos`,`id_tipos_facturas`,
        `numeracion`,`fechaEmision`) VALUES (NULL,'{$this->_idEstadosPagos}', '{$this->_idTipoFactura}',
        '{$this->_numeracion}','{$this->_fechaEmision}');";
      

        
        $database->insertar($sql);

    }


	public static function obtenerTodos() {

    	$sql = "SELECT * FROM factura";

    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoFactura = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$factura = new Factura();
			$factura->_idTipoFactura = $registro["id_tipos_facturas"];
			$factura->_descripcion = $registro["descripcion"];
    		$listadoFactura[] = $factura;
    	}


    	return $factura;

	}

    public static function obtenerId() {
        $sql = "SELECT id_factura FROM factura ORDER BY id_factura DESC LIMIT 1;";

    
        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
            return false;
        }

        $registro = $datos->fetch_assoc();
        $factura = self::_crearFactura($registro);
        return $factura;

    }

     public static function obtenerPorId($_idFactura) {
        $sql = "SELECT * FROM factura WHERE id_factura={$_idFactura}";



        $database = new MySQL();
        $datos = $database->consultar($sql);

        $registro = $datos->fetch_assoc();

        $factura = new Factura();
        $factura->_idFactura= $registro["id_factura"];
        $factura->_numeracion = $registro["numeracion"];
        $factura->_fechaEmision = $registro["FechaEmision"];
         $factura->_idTipoFactura = $registro["id_tipos_facturas"];
      
        return $factura;

    }

    
    private static function _crearFactura($datos) {
        $factura = new Factura();
        $factura->_idFactura = $datos["id_factura"];

        

        return $factura;
    }

    public static function obtenerUltimaNumeracion() {
        $sql = "SELECT (max(numeracion))+1 as numeracion FROM factura ";



        $database = new MySQL();
        $datos = $database->consultar($sql);

        $registro = $datos->fetch_assoc();

        $factura = new Factura();
       
        $factura->_numeracion = $registro["numeracion"];
       
      
        return $factura;

    }


    
}


?>
