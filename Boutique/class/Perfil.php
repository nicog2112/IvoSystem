<?php

require_once "Modulo.php";
require_once "MySQL.php";


class Perfil {

	private $_idPerfil;
	private $_descripcion;
	private $_estado;
	private $_listadoModulos;

	/**
     * @return mixed
     */
    public function getIdPerfil()
    {
        return $this->_idPerfil;
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


	public function getModulos() {
		return $this->_listadoModulos;
	}

	public function guardar() {

		$database = new MySQL();

		$sql = "INSERT INTO perfil "
		     . "(`id_perfil`, `descripcion`,`estado`)  "
		     . "VALUES (NULL, '{$this->_descripcion}',1)";

		$database->insertar($sql);

	}

	public function actualizar() {

        $database = new MySQL();

        $sql = "UPDATE perfil SET descripcion = '{$this->_descripcion}'"
             . "WHERE perfil.id_perfil = {$this->_idPerfil}";


        $database->actualizar($sql);

    }

    public function eliminar() {

        $sqlPrimero = "UPDATE perfil JOIN usuario ON usuario.id_perfil = perfil.id_perfil JOIN persona on usuario.id_persona = persona.id_persona " 
             . "SET perfil.estado = 2 ,persona.estado = 2 "
             . "WHERE perfil.id_perfil = {$this->_idPerfil}";


        
        $database = new MySQL();
        $database->eliminar($sqlPrimero);

       $sql = "UPDATE perfil SET perfil.estado = 2 WHERE perfil.id_perfil = {$this->_idPerfil}";

        $database = new MySQL();
        $database->eliminar($sql);

    }

    

	public static function obtenerTodos($filtroEstado = 0) {
    	$sql = "SELECT * FROM perfil";

    	$where = "";

        if ($filtroEstado != 0) {
        	// $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
        	$where = "WHERE estado = " . $filtroEstado;
        }

        $sql = $sql . " " . $where;
     

    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoPerfil = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$perfil = new Perfil();
			$perfil->_idPerfil = $registro["id_perfil"];
			$perfil->_descripcion = $registro["descripcion"];
			$perfil->_estado = $registro["estado"];
    		$listadoPerfil[] = $perfil;
    	}


    	return $listadoPerfil;

	}

	public static function obtenerPorId($idPerfil) {
		$sql = "SELECT * FROM perfil WHERE id_perfil={$idPerfil}";
	

		$database = new MySQL();
		$datos = $database->consultar($sql);

		$registro = $datos->fetch_assoc();

		$perfil = new Perfil();
		$perfil->_idPerfil = $registro["id_perfil"];
		$perfil->_descripcion = $registro["descripcion"];
		$perfil->_listadoModulos = Modulo::obtenerPorIdPerfil($perfil->_idPerfil);

		return $perfil;

	}

	

}


?>