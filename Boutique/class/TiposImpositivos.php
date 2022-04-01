<?php

require_once "MySQL.php";


class TiposImpositivos{

	private $_idTiposImpositivos; 
	private $_descripcion;
    private $_valorPorcentaje;
    private $_estado;

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
    public function setDescripcion($_descripcion)
    {
        $this->_descripcion = $_descripcion;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->_descripcion;
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
    public function setEstado($_estado)
    {
        $this->_estado = $_estado;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->_estado;
    }

    public static function obtenerPorEstado() {
        $sql = "SELECT * FROM tipos_impositivos where estado = 1";
        
        $database = new MySQL();
        $datos = $database->consultar($sql);

        $listadoTiposImpositivos = [];

        while ($registro = $datos->fetch_assoc()) {
            $tiposImpositivos = new TiposImpositivos();
            $tiposImpositivos->_idTiposImpositivos = $registro["id_tipos_impositivos"];
            $tiposImpositivos->_descripcion = $registro["descripcion"];
            $tiposImpositivos->_valorPorcentaje = $registro["valor_porcentaje"];
            $tiposImpositivos->_estado = $registro["estado"];
            $listadoTiposImpositivos[] = $tiposImpositivos;
        }


        return $listadoTiposImpositivos;

    }

	public static function obtenerTodos($filtroEstado = 0) {

    	$sql = "SELECT * FROM tipos_impositivos";
        
        $where = "";

        if ($filtroEstado != 0) {
            // $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
            $where = "WHERE estado = " . $filtroEstado;
        }

        $sql = $sql . " " . $where;

    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoTiposImpositivos = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$tiposImpositivos = new TiposImpositivos();
			$tiposImpositivos->_idTiposImpositivos = $registro["id_tipos_impositivos"];
			$tiposImpositivos->_descripcion = $registro["descripcion"];
            $tiposImpositivos->_valorPorcentaje = $registro["valor_porcentaje"];
            $tiposImpositivos->_estado = $registro["estado"];
    		$listadoTiposImpositivos[] = $tiposImpositivos;
    	}


    	return $listadoTiposImpositivos;

	}

     public static function obtenerPorId($idTiposImpositivos) {
        $sql = "SELECT * FROM tipos_impositivos WHERE id_tipos_impositivos={$idTiposImpositivos}";



        $database = new MySQL();
        $datos = $database->consultar($sql);

        $registro = $datos->fetch_assoc();

       $tiposImpositivos = new TiposImpositivos();
            $tiposImpositivos->_idTiposImpositivos = $registro["id_tipos_impositivos"];
            $tiposImpositivos->_descripcion = $registro["descripcion"];
            $tiposImpositivos->_valorPorcentaje = $registro["valor_porcentaje"];
            $tiposImpositivos->_estado = $registro["estado"];
      
        return $tiposImpositivos;

    }


    

    public function guardar() {

        $database = new MySQL();

        $sql = "INSERT INTO tipos_impositivos "
             . "(`id_tipos_impositivos`, `descripcion`, `valor_porcentaje`, `estado`)  "
             . "VALUES (NULL, '{$this->_descripcion}','{$this->_valorPorcentaje}','{$this->_estado}')";

        $database->insertar($sql);

    }

    public function actualizar() {

        $database = new MySQL();

        $sql = "UPDATE tipos_impositivos SET descripcion = '{$this->_descripcion}' , `valor_porcentaje` = '{$this->_valorPorcentaje}' "
             . "WHERE tipos_impositivos.id_tipos_impositivos = {$this->_idTiposImpositivos}";
            
    
        $database->actualizar($sql);

    }
      public function eliminar() {

        $sql =  "UPDATE tipos_impositivos  " 
             . "SET estado = 2 "
             . "WHERE tipos_impositivos.id_tipos_impositivos = {$this->_idTiposImpositivos}";

        
        $database = new MySQL();
        $database->eliminar($sql);

    }



}


?>
