<?php

require_once "MySQL.php";
require_once "Sexo.php";

class Persona {

    protected $_idPersona;
    protected $_nombre;
    protected $_apellido;
    protected $_dni;
    protected $_fechaNacimiento;
    protected $_nacionalidad;
    protected $_estado;
    protected $_idSexo;

    public $sexo;


    /**
     * @return mixed
     */
    public function getIdPersona()
    {
        return $this->_idPersona;
    }

    /**
     * @param mixed $_idPersona
     *
     * @return self
     */
    public function setIdPersona($_idPersona)
    {
        $this->_idPersona = $_idPersona;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->_nombre;
    }

    /**
     * @param mixed $_nombre
     *
     * @return self
     */
    public function setNombre($_nombre)
    {
        $this->_nombre = $_nombre;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getApellido()
    {
        return $this->_apellido;
    }

    /**
     * @param mixed $_apellido
     *
     * @return self
     */
    public function setApellido($_apellido)
    {
        $this->_apellido = $_apellido;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDni()
    {
        return $this->_dni;
    }

    /**
     * @param mixed $_apellido
     *
     * @return self
     */
    public function setDni($_dni)
    {
        $this->_dni = $_dni;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getFechaNacimiento()
    {
        return $this->_fechaNacimiento;
    }

    /**
     * @param mixed $_fechaNacimiento
     *
     * @return self
     */
    public function setFechaNacimiento($_fechaNacimiento)
    {
        $this->_fechaNacimiento = $_fechaNacimiento;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNacionalidad()
    {
        return $this->_nacionalidad;
    }

    /**
     * @param mixed $_apellido
     *
     * @return self
     */
    public function setNacionalidad($_nacionalidad)
    {
        $this->_nacionalidad = $_nacionalidad;

        return $this;
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

    public function setIdSexo($_idSexo)
    {
        $this->_idSexo = $_idSexo;

        return $this;
    }

    public function getIdSexo() {
        return $this->_idSexo;
    }

    public static function obtenerPorId($id) {
        $sql = "SELECT * from persona "
     
             . "WHERE id_persona=" . $id;



        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
            return false;
        }

        $registro = $datos->fetch_assoc();
        $persona = self::_crearPersona($registro);
        return $persona;

    }


     public static function obtenerTodosActivos() {
        $sql = "SELECT * from persona where estado = 1";



      
        $database = new MySQL();
        $datos = $database->consultar($sql);

        $listadoPersonas = [];

        while ($registro = $datos->fetch_assoc()) {
            $persona = new Persona();
          
            $persona->_idPersona = $registro["id_persona"];

            $persona->_nombre = $registro["nombre"];
            $persona->_apellido = $registro["apellido"];
            $persona->_fechaNacimiento = $registro["fecha_de_nacimiento"];
            $persona->_dni = $registro["dni"];
            $persona->_nacionalidad = $registro["nacionalidad"];
            $persona->_estado = $registro["estado"];
            $persona->_idSexo = $registro["id_sexo"];
        
            $persona->sexo = Sexo::obtenerPorId($persona->_idSexo);
            $listadoPersonas[] = $persona;
        }


        return $listadoPersonas;
    }


     public static function obtenerPorDNI($dni) {
        $sql = "SELECT * from persona "
     
             . "WHERE dni=" . $dni;



      
        $database = new MySQL();
        $datos = $database->consultar($sql);

        $listadoPersonas = [];

        while ($registro = $datos->fetch_assoc()) {
            $persona = new Persona();
          
            $persona->_idPersona = $registro["id_persona"];

            $persona->_nombre = $registro["nombre"];
            $persona->_apellido = $registro["apellido"];
            $persona->_fechaNacimiento = $registro["fecha_de_nacimiento"];
            $persona->_dni = $registro["dni"];
            $persona->_nacionalidad = $registro["nacionalidad"];
            $persona->_estado = $registro["estado"];
            $persona->_idSexo = $registro["id_sexo"];
        
            $persona->sexo = Sexo::obtenerPorId($persona->_idSexo);
            $listadoPersonas[] = $persona;
        }


        return $listadoPersonas;
    }



    public static function obtenerTodosPersonas($filtroEstado = 0) {
        $sql ="SELECT * FROM persona ";

        $where = "";

        if ($filtroEstado != 0) {
            // $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
            $where = "where persona.estado = " . $filtroEstado;
        }

        $sql = $sql . " " . $where;

  
        $database = new MySQL();
        $datos = $database->consultar($sql);

        $listadoPersonas = [];

        while ($registro = $datos->fetch_assoc()) {
            $persona = new Persona();
          
            $persona->_idPersona = $registro["id_persona"];

            $persona->_nombre = $registro["nombre"];
            $persona->_apellido = $registro["apellido"];
            $persona->_fechaNacimiento = $registro["fecha_de_nacimiento"];
            $persona->_dni = $registro["dni"];
            $persona->_nacionalidad = $registro["nacionalidad"];
            $persona->_estado = $registro["estado"];
            $persona->_idSexo = $registro["id_sexo"];
        
            $persona->sexo = Sexo::obtenerPorId($persona->_idSexo);
            $listadoPersonas[] = $persona;
        }


        return $listadoPersonas;
    }


    public function guardar() {
        $database = new MySQL();

        $sql = "INSERT INTO `persona` "
             . "(`id_persona`, `nombre`, `apellido`,`dni`, `fecha_de_nacimiento`, `nacionalidad`,`id_sexo`,`estado`)"
             . "VALUES (NULL, '{$this->_nombre}', '{$this->_apellido}',{$this->_dni}," 
             . "'{$this->_fechaNacimiento}','{$this->_nacionalidad}', "
             . "{$this->_idSexo}, '{$this->_estado}')";

   
        $idPersona = $database->insertar($sql);

        $this->_idPersona = $idPersona;
    }
    
    public function actualizar() {
        $sql = "UPDATE persona SET nombre = '{$this->_nombre}', apellido = '{$this->_apellido}', "
             . " dni = '{$this->_dni}',fecha_de_nacimiento = '{$this->_fechaNacimiento}',"
             ." id_sexo = {$this->_idSexo} ,  estado = '{$this->_estado}',"
             . " nacionalidad = '{$this->_nacionalidad}' "
             . "WHERE persona.id_persona = {$this->_idPersona}";
           

        $database = new MySQL();
        $database->actualizar($sql);
    }

    public function eliminar() {

        $sql = "UPDATE persona SET estado = 2 where id_persona={$this->_idPersona}";
    
        
        $database = new MySQL();
        $database->eliminar($sql);

    }


    public function __toString() {
        return "{$this->_apellido}, {$this->_nombre}";
        // return $this->_apellido . ", " . $this->_nombre;
    }

    public static function obtenerIdPersona() {
                $sql = "SELECT * FROM persona ORDER BY id_persona DESC LIMIT 1;";

                

                $database = new MySQL();
                $datos = $database->consultar($sql);

                if ($datos->num_rows == 0) {
                    return false;
                }

                $registro = $datos->fetch_assoc();
                $persona = self::_crearPersona($registro);
                return $persona;

            }

    private static function _crearPersona($datos) {
        $persona = new Persona();
        $persona->_idPersona = $datos["id_persona"];
        $persona->_dni = $datos["dni"];
        $persona->_estado = $datos["estado"];
        $persona->_nombre = $datos["nombre"];
        $persona->_apellido = $datos["apellido"];
        $persona->_fechaNacimiento = $datos["fecha_de_nacimiento"];
        $persona->_idSexo = $datos["id_sexo"];
        $persona->_nacionalidad = $datos["nacionalidad"];
          $persona->sexo = Sexo::obtenerPorId($persona->_idSexo);


        return $persona;
    }
}


?>