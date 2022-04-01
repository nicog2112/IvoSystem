<?php


require_once "MySQL.php";


class Modulo {

	private $_idModulo;
	private $_descripcion;
	private $_directorio;
    private $_orden;
    private $_nivel;
    private $_icono;
    private $_hijoDe;



    /**
     * @return mixed
     */
    public function getIdModulo()
    {
        return $this->_idModulo;
    }

    /**
     * @param mixed $_idPerfil
     *
     * @return self
     */
    public function setIdModulo($_idModulo)
    {
        $this->_idModulo = $_idModulo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->_descripcion;
    }

    public function setDescripcion($_descripcion)
    {
        $this->_descripcion = $_descripcion;

        return $this;
    }

       public function setDirectorio($_directorio)
    {
        $this->_directorio = $_directorio;

        return $this;
    }


    public function getDirectorio()
    {
        return $this->_directorio;
    }

        /**
     * @return mixed
     */
    public function getOrden()
    {
        return $this->_orden;
    }

    /**
     * @param mixed 
     *
     * @return self
     */
    public function setOrden($_orden)
    {
        $this->_orden = $_orden;

        return $this;
    }

        /**
     * @return mixed
     */
    public function getNivel()
    {
        return $this->_nivel;
    }

    /**
     * @param mixed
     *
     * @return self
     */
    public function setNivel($_nivel)
    {
        $this->_nivel = $_nivel;

        return $this;
    }

     /**
     * @return mixed
     */
    public function getIcono()
    {
        return $this->_icono;
    }

    /**
     * @param mixed 
     *
     * @return self
     */
    public function setIcono($_icono)
    {
        $this->_icono = $_icono;

        return $this;
    }

     /**
     * @return mixed
     */
    public function getHijoDe()
    {
        return $this->_hijoDe;
    }

    /**
     * @param mixed $_idPerfil
     *
     * @return self
     */
    public function setHijoDe($_hijoDe)
    {
        $this->_hijoDe = $_hijoDe;

        return $this;
    }


	public function actualizar() {

        $database = new MySQL();

        $sql = "UPDATE modulo SET descripcion = '{$this->_descripcion}',"
         ."directorio = '{$this->_directorio}'"
             . "WHERE modulo.id_modulo = {$this->_idModulo}";


        $database->actualizar($sql);

    }

    public function guardar() {

		$database = new MySQL();

		$sql = "INSERT INTO Modulo "
		     . "(`id_modulo`, `descripcion`,`directorio`)  "
		     . "VALUES (NULL, '{$this->_descripcion}', '{$this->_directorio}')";

        
		$database->insertar($sql);

	}

    public static function obtenerTodos() {
    	$sql = "SELECT * from modulo ";



    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoModulos = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$modulo = new Modulo();
			$modulo->_idModulo = $registro["id_modulo"];
			$modulo->_descripcion = $registro["descripcion"];
			$modulo->_directorio = $registro["directorio"];
            $modulo->_orden = $registro["orden"];
            $modulo->_nivel = $registro["nivel"];
            $modulo->_icono = $registro["icono"];
            $modulo->_hijoDe = $registro["hijoDe"];
    		$listadoModulos[] = $modulo;
    	}




    	return $listadoModulos;
	}


	public static function obtenerPorIdPerfil($idPerfil) {

		$sql = "SELECT modulo.id_modulo, modulo.descripcion, modulo.directorio, modulo.orden, modulo.nivel, "
			 . "modulo.icono , modulo.hijoDe FROM modulo "
			 . "JOIN perfil_modulo ON perfil_modulo.id_modulo = modulo.id_modulo "
			 . "JOIN perfil ON perfil.id_perfil = perfil_modulo.id_perfil "
			 . "WHERE perfil_modulo.id_perfil = {$idPerfil}
             order by modulo.orden asc";
    


		$databse = new MySQL();
		$datos = $databse->consultar($sql);

		$listadoModulos = [];

		while ($registro = $datos->fetch_assoc()) {
			$modulo = new Modulo();
			$modulo->_idModulo = $registro["id_modulo"];
			$modulo->_descripcion = $registro["descripcion"];
			$modulo->_directorio = $registro["directorio"];
            $modulo->_orden = $registro["orden"];
            $modulo->_nivel = $registro["nivel"];
            $modulo->_icono = $registro["icono"];
            $modulo->_hijoDe = $registro["hijoDe"];
			$listadoModulos[] = $modulo;
    	}

    	return $listadoModulos;
      

	}

	public static function obtenerPorId($id) {
    	$sql = "SELECT modulo.id_modulo, modulo.descripcion, modulo.directorio, modulo.orden, modulo.nivel, "
             . "modulo.icono , modulo.hijoDe "
             . " FROM modulo "
             . "WHERE id_modulo =" . $id;

        

        $database = new MySQL();
        $datoss = $database->consultar($sql);

        if ($datoss->num_rows == 0) {
        	return false;
        }

        $registro = $datoss->fetch_assoc();
    	$modulo = self::_crearModulo($registro);
		return $modulo;

    }

    public function eliminar() {

        $sql = "DELETE FROM modulo WHERE id_modulo={$this->_idModulo}";
        
        $database = new MySQL();
        $database->eliminar($sql);

    }

	private static function _crearModulo($datoss) {
    	$modulo = new Modulo();
		$modulo->_idModulo = $datoss["id_modulo"];
		$modulo->_descripcion = $datoss["descripcion"];
		$modulo->_directorio = $datoss ["directorio"];
        $modulo->_orden = $datoss["orden"];
        $modulo->_nivel = $datoss["nivel"];
        $modulo->_icono = $datoss["icono"];
        $modulo->_hijoDe = $datoss["hijoDe"];
		

		return $modulo;
    }


}


?>