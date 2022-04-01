<?php

require_once "MySQL.php";
require_once "TiposImpositivos.php";


class FacturaImpuestos{

	private $_idFacturaImpuesto; 
    private $_valorPorcentaje;
    private $_idTiposImpositivos;
    private $_idFactura;

    public $tiposImpositivos;

    /**
     * @return mixed
     */
    public function getIdFacturaImpuestos()
    {
        return $this->_idFacturaImpuesto;
    }

        /**
     * @return mixed
     */
    public function setIdTiposImpositivos($_idTiposImpositivos)
    {
        $this->_idTiposImpositivos = $_idTiposImpositivos;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getIdTiposImpositivos()
    {
        return $this->_idTiposImpositivos;
    }

        /**
     * @return mixed
     */
    public function setValorPorcentaje($_valorPorcentaje)
    {
        $this->_valorPorcentaje = $_valorPorcentaje;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getValorPorcentaje()
    {
        return $this->_valorPorcentaje;
    }

        /**
     * @return mixed
     */
    public function setIdFactura($_idFactura)
    {
        $this->_idFactura = $_idFactura;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getIdFactura()
    {
        return $this->_idFactura;
    }

     public function guardar() {

        $database = new MySQL();
       


        $sql = "INSERT INTO facturaimpuestos(`id_DetalleFacturaImpuesto`,`valor_porcentaje`,`id_tipos_impositivos`,
        `id_factura`) VALUES (NULL,'{$this->_valorPorcentaje}', '{$this->_idTiposImpositivos}','{$this->_idFactura}');";
      


        $database->insertar($sql);

    }

    public static function obtenerPorIdFactura($idFactura) {
        $sql = "SELECT * FROM facturaimpuestos where id_factura =". $idFactura;



        $database = new MySQL();
        $datos = $database->consultar($sql);

        $listadoFacturaImpuestos = [];

        while ($registro = $datos->fetch_assoc()) {
            $facturaImpuestos = new FacturaImpuestos();
            $facturaImpuestos->_idFacturaImpuesto = $registro["id_DetalleFacturaImpuesto"];
            $facturaImpuestos->_idTiposImpositivos = $registro["id_tipos_impositivos"];
            $facturaImpuestos->_valorPorcentaje = $registro["valor_porcentaje"];
            $facturaImpuestos->_idFactura = $registro["id_factura"];
            $facturaImpuestos->tiposImpositivos = TiposImpositivos::obtenerPorId($facturaImpuestos->_idTiposImpositivos);
            $listadoFacturaImpuestos[] = $facturaImpuestos;
        }


        return $listadoFacturaImpuestos;

    }

	public static function obtenerTodos() {

    	$sql = "SELECT * FROM tipos_impositivos";

    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoTiposImpositivos = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$tiposImpositivos = new TiposImpositivos();
			$tiposImpositivos->_idTipoFactura = $registro["id_tipos_impositivos"];
			$tiposImpositivos->_descripcion = $registro["descripcion"];
            $tiposImpositivos->_valorPorcentaje = $registro["valor_porcentaje"];
            $tiposImpositivos->_estado = $registro["estado"];
    		$listadoTiposImpositivos[] = $tiposImpositivos;
    	}


    	return $listadoTiposImpositivos;

	}

    public static function obtenerPorId($id) {
        $sql = "SELECT  talle.id_talle, talle.descripcion "
             . " FROM talle WHERE id_talle=" . $id;


        $database = new MySQL();
        $datos = $database->consultar($sql);

       if($datos = $database->consultar($sql)){
            $registro = $datos->fetch_assoc();
         }

        $talle = new Talle();
        $talle->_idTalle = $registro["id_talle"];
        $talle->_descripcion = $registro["descripcion"];
      
        return $talle;

    }

    
}


?>
