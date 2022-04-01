<?php

require_once "MySQL.php";


class Sexo {

	private $_idSexo; 
	private $_descripcion;

    

    /**
     * @return mixed
     */
    public function getIdSexo()
    {
        return $this->_idSexo;
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

	public static function obtenerTodos() {

    	$sql = "SELECT * FROM sexo";

    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoSexo = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$sexo = new Sexo();
			$sexo->_idSexo = $registro["id_sexo"];
			$sexo->_descripcion = $registro["descripcion"];
    		$listadoSexo[] = $sexo;
    	}


    	return $listadoSexo;

	}



    public static function obtenerPorId($idSexo) {
        if(empty($idSexo)){
            $sexo = new Sexo();
            $sexo->_idSexo = "";
            $sexo->_descripcion = "";

             return $sexo;
        }

        $sql = "SELECT * FROM sexo WHERE id_sexo={$idSexo}";

     
        $database = new MySQL();
        //$datos = $database->consultar($sql);
        if($datos = $database->consultar($sql)){
            $registro = $datos->fetch_assoc();
         }
        $sexo = new Sexo();
        $sexo->_idSexo = $registro["id_sexo"];
        $sexo->_descripcion = $registro["descripcion"];
      
        return $sexo;







    }
    

    
}



?>
