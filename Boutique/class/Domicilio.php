<?php

require_once "Barrio.php";
require_once "MySQL.php";



class Domicilio {

	protected $_idDomicilio;
	protected $_calle;
	protected $_altura;
	protected $_manzana;
	protected $_numeroCasa;
	protected $_torre;
	protected $_piso;
	protected $_observaciones;
	protected $_idBarrio;
	protected $_estado;


	

	public function setIdDomicilio($idDomicilio) {
		$this->_idDomicilio = $idDomicilio;
	}

	public function getIdDomicilio() {
		return $this->_idDomicilio;
	}

	public function getCalle() {
		return $this->_calle;
	}

	public function setCalle($calle) {
		$this->_calle = $calle;
	}

	public function getAltura() {
		return $this->_altura;
	}

	public function setAltura($altura) {
		$this->_altura = $altura;
	}

	public function getManzana() {
		return $this->_manzana;
	}

	public function setManzana($manzana) {
		$this->_manzana = $manzana;
	}

	public function getNumeroCasa() {
		return $this->_numeroCasa;
	}

	public function setNumeroCasa($numeroCasa) {
		$this->_numeroCasa = $numeroCasa;
	}

	public function getTorre() {
		return $this->_torre;
	}

	public function setTorre($torre) {
		$this->_torre = $torre;
	}

	public function getPiso() {
		return $this->_piso;
	}

	public function setPiso($piso) {
		$this->_piso = $piso;
	}

	public function getObservaciones() {
		return $this->_observaciones;
	}

	public function setObservaciones($observaciones) {
		$this->_observaciones = $observaciones;
	}

	public function getIdBarrio() {
		return $this->_idBarrio;
	}

	public function setIdBarrio($idBarrio) {
		$this->_idBarrio = $idBarrio;
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
		$sql = "INSERT INTO `domicilios`  (`id_Domicilios`, `calle`, `altura`, `manzana`, `numero_casa`, `torre`, `piso`, `observaciones`, `id_barrio`,`estado`) VALUES (NULL , '{$this->_calle}','{$this->_altura}','{$this->_manzana}','{$this->_numeroCasa}', '{$this->_torre}', '{$this->_piso}', '{$this->_observaciones}', '{$this->_idBarrio}',1)"; 

        $database = new MySQL();
        $idInsertado = $database->insertar($sql);

        $this->_idDomicilio = $idInsertado;
	}
	


	public function eliminar() {
	$sql = "DELETE FROM domicilios WHERE id_Domicilios={$this->_idDomicilio}";


        $database = new MySQL();
        $database->eliminar($sql);
	
	}

	public function actualizar() {
        $sql = "UPDATE domicilios SET calle = '{$this->_calle}', altura = '{$this->_altura}', "
             . " manzana = '{$this->_manzana}',numero_casa = '{$this->_numeroCasa}',"
             ." torre = '{$this->_torre}' ,  piso = '{$this->_piso}',"
             . " observaciones = '{$this->_observaciones}',"
             . " id_barrio = '{$this->_idBarrio}'"
             . "WHERE id_Domicilios = {$this->_idDomicilio}";




        $database = new MySQL();
        $database->actualizar($sql);
    }


	
}


?>