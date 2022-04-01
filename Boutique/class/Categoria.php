<?php

require_once "MySQL.php";


class Categoria{

	private $_idCategoria;
	private $_nombre;
	 private $_estado;

	public function getIdCategoria() {
		return $this->_idCategoria;
	}
	public function getNombre() {
		return $this->_nombre;
	}

	public function setNombre($nombre) {
		$this->_nombre = $nombre;
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

		$sql = "INSERT INTO Categoria "
		     . "(`id_categoria`, `nombre`,`estado`)  "
		     . "VALUES (NULL, '{$this->_nombre}',1)";

		
		$database->insertar($sql);

	}

	public function actualizar() {

        $database = new MySQL();

        $sql = "UPDATE Categoria SET nombre = '{$this->_nombre}'"
             . "WHERE categoria.id_categoria = {$this->_idCategoria}";


        $database->actualizar($sql);

    }

	public static function obtenerTodos($filtroEstado = 0) {
    	$sql = "SELECT * from categoria ";
    	$where = "";

        if ($filtroEstado != 0) {
            // $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
            $where = " where estado = " . $filtroEstado;
        }

        $sql = $sql . " " . $where;


    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoCategoria = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$categoria = new Categoria();
			$categoria->_idCategoria = $registro["id_categoria"];
			$categoria->_nombre = $registro["nombre"];
			$categoria->_estado = $registro["estado"];
    		$listadoCategoria[] = $categoria;
    	}


    	return $listadoCategoria;
	}


	public static function obtenerTodosActivos() {
    	$sql = "SELECT * from categoria where estado = 1";
    	


    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoCategoria = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$categoria = new Categoria();
			$categoria->_idCategoria = $registro["id_categoria"];
			$categoria->_nombre = $registro["nombre"];
			$categoria->_estado = $registro["estado"];
    		$listadoCategoria[] = $categoria;
    	}


    	return $listadoCategoria;
	}


	public static function obtenerTodosMenu() {
    	$sql = "SELECT c.id_categoria, c.nombre from categoria as c
join producto as p on c.id_categoria = p.id_categoria
join productotalle as pt on p.id_producto = pt.id_producto group by c.id_categoria";



    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoCategoria = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$categoria = new Categoria();
			$categoria->_idCategoria = $registro["id_categoria"];
			$categoria->_nombre = $registro["nombre"];
    		$listadoCategoria[] = $categoria;
    	}


    	return $listadoCategoria;
	}

	public static function obtenerPorId($id) {
    	$sql = "SELECT categoria.id_categoria, categoria.nombre "
             . " FROM categoria "
             . "WHERE id_categoria =" . $id;



        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$categoria = self::_crearCategoria($registro);
		return $categoria;

    }


    public function eliminar() {

        $sql = "UPDATE categoria  " 
             . "SET estado = 2 "
             . "WHERE categoria.id_categoria = {$this->_idCategoria}";
        
        $database = new MySQL();
        $database->eliminar($sql);

    }

     private static function _crearCategoria($datos) {
    	$categoria = new Categoria();
		$categoria->_idCategoria = $datos["id_categoria"];
		$categoria->_nombre = $datos["nombre"];
		

		return $categoria;
    }


}



?>