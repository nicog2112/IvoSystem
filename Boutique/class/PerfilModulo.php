<?php

require_once "Modulo.php";
require_once "Perfil.php";
require_once "MySQL.php";


class PerfilModulo {

	private $_idPerfilModulo;
	private $_idPerfil;
	private $_idModulo;

	
	/**
     * @return mixed
     */
    public function getIdPerfilModulo()
    {
        return $this->_idPerfilModulo;
    }

        /**
     * @return mixed
     */
    public function setIdPerfilModulo($idPerfilModulo)
    {
        $this->_idPerfilModulo = $idPerfilModulo;

        return $this;
    }
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
    public function setIdPerfil($idPerfil)
    {
        $this->_idPerfil = $idPerfil;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getIdModulo()
    {
        return $this->_idModulo;
    }

         /**
     * @return mixed
     */
    public function setIdModulo($idModulo)
    {
        $this->_idModulo = $idModulo;

        return $this;
    }

	public function getModulos() {
		return $this->_listadoModulos;
	}

	public function guardar() {

		$database = new MySQL();

		$sql = "INSERT INTO perfil_modulo "
		     . "(`id_Perfil_Modulo`,`id_perfil`, `id_modulo`)  "
		     . "VALUES (NULL, '{$this->_idPerfil}','{$this->_idModulo}')";
   
		$database->insertar($sql);

	}




	public function actualizar() {

        $database = new MySQL();

        $sql = "UPDATE perfil SET descripcion = '{$this->_descripcion}'"
             . "WHERE perfil.id_perfil = {$this->_idPerfil}";


        $database->actualizar($sql);

    }

    public function eliminar() {

        $sql = "DELETE FROM perfil_modulo WHERE id_perfil={$this->_idPerfil}";
          
        $database = new MySQL();
        $database->eliminar($sql);

    }

	public static function obtenerTodos() {

    	$sql = "SELECT * FROM perfil";

    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoPerfil = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$perfil = new Perfil();
			$perfil->_idPerfil = $registro["id_perfil"];
			$perfil->_descripcion = $registro["descripcion"];
    		$listadoPerfil[] = $perfil;
    	}


    	return $listadoPerfil;

	}

	public static function obtenerPorIdPerfil($idPerfil) {
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

	public static function obtenerPorId($id) {
    	$sql = "SELECT perfil_modulo.id_perfil, perfil_modulo.id_Perfil_Modulo, perfil_modulo.id_modulo FROM perfil_modulo WHERE id_perfil=" . $id;



        $database = new MySQL();

        $datos = $database->consultar($sql);

          if ($datos->num_rows == 0) {
            return false;
        }

       	$listadoModulos = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$perfilModulo = new PerfilModulo();
			$perfilModulo->_idPerfilModulo = $registro["id_Perfil_Modulo"];
			$perfilModulo->_idPerfil = $registro["id_perfil"];
        	$perfilModulo->_idModulo = $registro["id_modulo"];
    		$listadoModulos[] = $perfilModulo;
    	}
  
    	return $listadoModulos;

    }

    public static function obtenerPorIdPerfiles($id) {
        $sql = "SELECT perfil_modulo.id_perfil, perfil_modulo.id_Perfil_Modulo, perfil_modulo.id_modulo FROM perfil_modulo WHERE id_perfil=" . $id;



        $database = new MySQL();

        $datos = $database->consultar($sql);

          if ($datos->num_rows == 0) {
            return false;
        }

        $listadoModulos = [];

        while ($registro = $datos->fetch_assoc()) {
            $perfilModulo = new PerfilModulo();
            $perfilModulo->_idPerfilModulo = $registro["id_Perfil_Modulo"];
            $perfilModulo->_idPerfil = $registro["id_perfil"];
            $perfilModulo->_idModulo = $registro["id_modulo"];
            $listadoModulos[] = $perfilModulo;
        }
  
        return $perfilModulo;

    }





    private static function _crearPerfilModulo($datos) {
    	$perfilModulo = new PerfilModulo();
		$perfilModulo->_idPerfilModulo = $datos["id_Perfil_Modulo"];
		$perfilModulo->_idPerfil = $datos["id_perfil"];
        $perfilModulo->_idModulo = $datos["id_modulo"];
    

		return $perfilModulo;
    }
}


?>