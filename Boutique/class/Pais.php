<?php


require_once "MySQL.php";


class Pais {

	private $_idPais; 
	private $_descripcion;
    private $_estado;


    /**
     * @return mixed
     */
    public function getIdPais()
    {
        return $this->_idPais;
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


    public function guardar() {
        

        $database = new MySQL();


        $sql = "INSERT INTO paises (`id_pais`, `descripcion`,`estado`) VALUES (NULL, '{$this->_descripcion}',1)";

        $database->insertar($sql);
    }
    


    public function actualizar() {

        $database = new MySQL();

        $sql = "UPDATE paises SET descripcion = '{$this->_descripcion}'"
             . "WHERE paises.id_pais = {$this->_idPais}";


        $database->actualizar($sql);

    }

	public static function obtenerTodos($filtroEstado = 0) {

    	$sql = "SELECT * FROM paises";

        $where = "";

        if ($filtroEstado != 0) {
            // $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
            $where = "WHERE estado = " . $filtroEstado;
        }

        $sql = $sql . " " . $where;
     


    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoPais = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$pais = new Pais();
			$pais->_idPais = $registro["id_pais"];
			$pais->_descripcion = $registro["descripcion"];
            $pais->_estado = $registro["estado"];
    		$listadoPais[] = $pais;
    	}


    	return $listadoPais;

	}

    public static function obtenerTodosActivos() {

        $sql = "SELECT * FROM paises where estado = 1";

        


        $database = new MySQL();
        $datos = $database->consultar($sql);

        $listadoPais = [];

        while ($registro = $datos->fetch_assoc()) {
            $pais = new Pais();
            $pais->_idPais = $registro["id_pais"];
            $pais->_descripcion = $registro["descripcion"];
            $pais->_estado = $registro["estado"];
            $listadoPais[] = $pais;
        }


        return $listadoPais;

    }

    public static function obtenerPorId($idPais) {
        $sql = "SELECT * FROM paises WHERE id_pais={$idPais}";

        $database = new MySQL();
        $datos = $database->consultar($sql);

        $registro = $datos->fetch_assoc();

        $pais = new Pais();
        $pais->_idPais = $registro["id_pais"];
        $pais->_descripcion = $registro["descripcion"];
        
        return $pais;

    }

    public static function obtenerPorIdPais($id) {
        $sql = "SELECT paises.id_pais, paises.descripcion FROM paises WHERE id_pais=". $id;



        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
            return false;
        }

        $registro = $datos->fetch_assoc();
        $pais = self::_crearPais($registro);
        return $pais;

    }


     public function eliminar() {

        $sql =  "UPDATE paises  " 
             . "SET estado = 2 "
             . "WHERE paises.id_pais = {$this->_idPais}";
  
        $database = new MySQL();
        $database->eliminar($sql);

    }



     private static function _crearPais($datos) {
        $pais = new Pais();
        $pais->_idPais = $datos["id_pais"];
        $pais->_descripcion = $datos["descripcion"];
        

        return $pais;
    }


   
}


?>