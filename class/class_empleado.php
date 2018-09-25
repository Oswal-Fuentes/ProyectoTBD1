<?php
class Empleado
{
	private $dni;
	private $afiliacion;
	private $nombre;
	private $username;
	private $pass;
	private $isAdmin;
	private $tipo;
	private $direccion;
	private $telefono;
	private $sueldo;
	private $fechaExamen;

	function __construct($dni, $afiliacion, $nombre, $username, $pass, $isAdmin, $tipo, $direccion, $telefono, $sueldo, $fechaExamen)
	{
		$this->dni = $dni;
		$this->afiliacion = $afiliacion;
		$this->nombre = $nombre;
		$this->username = $username;
		$this->pass = $pass;
		$this->isAdmin = $isAdmin;
		$this->tipo = $tipo;
		$this->direccion = $direccion;
		$this->telefono = $telefono;
		$this->sueldo = $sueldo;
		$this->fechaExamen = $fechaExamen;
	}

	public function getDni()
	{
	    return $this->dni;
	}

	public function setDni($dni)
	{
	    $this->dni = $dni;
	}

	public function getAfiliacion()
	{
	    return $this->afiliacion;
	}

	public function setAfiliacion($afiliacion)
	{
	    $this->afiliacion = $afiliacion;
	}

	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}

	public function getUsername()
	{
	    return $this->username;
	}

	public function setUsername($username)
	{
	    $this->username = $username;
	}

	public function getPass()
	{
	    return $this->pass;
	}

	public function setPass($pass)
	{
	    $this->pass = $pass;
	}

	public function getisAdmin()
	{
	    return $this->isAdmin;
	}

	public function setisAdmin($isAdmin)
	{
	    $this->isAdmin = $isAdmin;
	}

	public function getTipo()
	{
	    return $this->tipo;
	}

	public function setTipo($tipo)
	{
	    $this->tipo = $tipo;
	}

	public function getdireccion()
	{
	    return $direccion->direccion;
	}

	public function setdireccion($direccion)
	{
	    $this->direccion = $direccion;
	}

	public function gettelefono()
	{
	    return $telefono->telefono;
	}

	public function settelefono($telefono)
	{
	    $this->telefono = $telefono;
	}

	public function getsueldo()
	{
	    return $sueldo->sueldo;
	}

	public function setsueldo($sueldo)
	{
	    $this->sueldo = $sueldo;
	}

	public function getfechaExamen()
	{
	    return $fechaExamen->fechaExamen;
	}

	public function setfechaExamen($fechaExamen)
	{
	    $this->fechaExamen = $fechaExamen;
	}

	public static function obtenerEmpleado($link, $dni) {
		$sql = "SELECT `dni`, `afiliacion`, `nombre`, `username`, `pass`, `isAdmin`, `tipo` FROM `empleado` WHERE `dni` = $dni";
		if ($link->cantidadRegistros($resultado) > 0) {
			$fila = $link->obtenerFila($resultado);
			return $fila;
        } else {
			return false;
		}
	}

	public static function eliminarEmpleado($link, $dni) {
		$sql = "CALL eliminar_empleado ($dni)";
		$resultado = $link->ejecutarInstruccion($sql);
		if ($resultado) {
			$link->liberarResultado($resultado);
		}
	}

	public static function generarEmpleado($link) {
		$sql = "SELECT `dni`, `afiliacion`, `nombre`, `username`, `pass`, `isAdmin`, `tipo` FROM `empleado`";
		if($resultado = $link->ejecutarInstruccion($sql)) {
			while ($fila = $link->obtenerFila($resultado)) {
				echo "<tr>";
                echo "<td><input type='radio' name='rad-empleados' value='".$fila["dni"]."'></td>";
                echo "<td>".$fila["dni"]."</td>";
                echo "<td>".$fila["afiliacion"]."</td>";
                echo "<td id='td-tipo-" . $fila["dni"] . "'>".$fila["tipo"]."</td>";
                echo "<td>".$fila["nombre"]."</td>";
                echo "<td>".$fila["username"]."</td>";
			}
		$link->liberarResultado($resultado);
		}
	}

	public function modificarTecnico($link) {
		// dni afiliacion nombre username pass
		// dni direccion telefono sueldo
		$sql_empleado = "CALL modificar_empleado ($this->dni, $this->afiliacion, '$this->nombre', '$this->username', '$this->pass')";
		$sql_tecnico = "CALL modificar_tecnico ($this->dni, '$this->direccion', '$this->telefono', $this->sueldo)";

		echo $sql_empleado;
		echo $sql_tecnico;

		$resultado_empleado = $link->ejecutarInstruccion($sql_empleado);
		$resultado_tecnico = $link->ejecutarInstruccion($sql_tecnico);

		if ($resultado_empleado)
			echo 'Empleado modificado';
		else
			echo 'Empleado no modificado';
		if ($resultado_tecnico)
			echo 'Tecnico modificado';
		else
			echo 'Tecnico no modificado';
	}

	public function modificarControlador($link) {
		// dni afiliacion nombre username pass
		// dni fecha examen
		$sql_empleado = "CALL modificar_empleado ($this->dni, $this->afiliacion, '$this->nombre', '$this->username', '$this->pass')";
		$sql_controlador = "CALL modificar_controlador ($this->dni, '$this->fechaExamen')";

		echo $sql_empleado;
		echo $sql_controlador;

		$resultado_empleado = $link->ejecutarInstruccion($sql_empleado);
		$resultado_controlador = $link->ejecutarInstruccion($sql_controlador);

		if ($resultado_empleado)
			echo 'Empleado modificado';
		else
			echo 'Empleado no modificado';
		if ($resultado_controlador)
			echo 'Controlador modificado';
		else
			echo 'Controlador no modificado';
	}
	
	public static function obtenerLlavePrimaria($link) {
		// obtener la llave primaria max y retornar la siguiente
		$sql = "SELECT MAX(dni) AS 'llave_max' FROM empleado";
		$resultado = $link->ejecutarInstruccion($sql);
		if ($link->cantidadRegistros($resultado) > 0)
        {
			$fila = $link->obtenerFila($resultado);
			return $fila["llave_max"] + 1;
        } else {
			return 0;
		}
	}

    public static function verificarEmpleado($link, $username, $pass)
    {
        $sql = sprintf(
            "SELECT dni, afiliacion, nombre, username, pass, isAdmin, tipo
            FROM empleado
            WHERE username = '%s'
            AND pass = '%s'",
            stripslashes($username),
            stripslashes($pass)
        );
        $resultado = $link->ejecutarInstruccion($sql);
        if ($link->cantidadRegistros($resultado) > 0)
        {
            $fila = $link->obtenerFila($resultado);
            $respuesta = array(
                "existe" => true,
                "dni" => $fila["dni"],
                "afiliacion" => $fila["afiliacion"],
                "nombre" => $fila["nombre"],
				"username" => $fila["username"],
				"pass" => $fila["pass"],
				"isAdmin" => $fila["isAdmin"],
				"tipo" => $fila["tipo"]
            );
        }
        else
        {
            $respuesta = array( "existe" => false );
        }
        $link->liberarResultado($resultado);
        return $respuesta;
    }

    public function agregarEmpleado($link)
    {
		// si es una cadena: '%s'
		// si no es una cadena: %s
		// quitar url_imagen de la bd
        $sql = sprintf("INSERT INTO empleado VALUES (%s, %s, '%s', '%s', '%s', '%s', %s);",
            stripslashes($this->dni),
            stripslashes($this->afiliacion),
            stripslashes($this->nombre),
            stripslashes($this->username),
            stripslashes($this->pass),
			stripslashes($this->isAdmin),
			stripslashes($this->tipo)
        );
        if($link->ejecutarInstruccion($sql))
            echo "Empleado agregado con exito!";
        else
            echo "Error! No se agrego el Empleado.";
	}

	public function agregarTecnico($link)
    {
		// solo funciona si no se elimina el valor maximo en la tabla
		$sql_empleado = sprintf("CALL agregar_empleado (%s, '%s', '%s', '%s', %s);",
            stripslashes($this->afiliacion),
            stripslashes($this->nombre),
            stripslashes($this->username),
            stripslashes($this->pass),
			stripslashes($this->tipo)
		);

		$sql_tecnico = sprintf("CALL agregar_tecnico (%s, '%s', '%s', %s);",
            stripslashes($this->dni),
            stripslashes($this->direccion),
            stripslashes($this->telefono),
            stripslashes($this->sueldo)
		);
		echo $sql_empleado;
		echo $sql_tecnico;

		$resultado_empleado = $link->ejecutarInstruccion($sql_empleado);
		$resultado_tecnico = $link->ejecutarInstruccion($sql_tecnico);

		if ($resultado_empleado)
			echo 'Empleado agregado ';
		else
			echo 'Empleado no agregado ';
		if ($resultado_tecnico)
			echo 'Tecnico agregado ';
		else
			echo 'Tecnico no agregado ';

	}

	public function agregarControladorAereo($link)
    {
		// solo funciona si no se elimina el valor maximo en la tabla
		$sql_empleado = sprintf("CALL agregar_empleado (%s, '%s', '%s', '%s', %s);",
            stripslashes($this->afiliacion),
            stripslashes($this->nombre),
            stripslashes($this->username),
            stripslashes($this->pass),
			stripslashes($this->isAdmin)
		);

		$sql_controlador = sprintf("CALL agregar_controlador (%s, '%s');",
            stripslashes($this->dni),
            stripslashes($this->fechaExamen)
		);
		echo $sql_empleado;
		echo $sql_controlador;

		$resultado_empleado = $link->ejecutarInstruccion($sql_empleado);
		$resultado_controlador = $link->ejecutarInstruccion($sql_controlador);

		if ($resultado_empleado)
			echo 'Empleado agregado ';
		else
			echo 'Empleado no agregado ';
		if ($resultado_controlador)
			echo 'Controlador agregado ';
		else
			echo 'Controlador no agregado ';

	}

	public function modificarEstudiante($link)
    {
        $sql = sprintf("
            UPDATE empleado
            SET dni= '%s', afiliacion= '%s', nombre= '%s', username= '%s', pass= '%s', isAdmin= '%s', tipo= '%s'
            WHERE dni = '%s'",
			stripslashes($this->dni),
            stripslashes($this->afiliacion),
            stripslashes($this->nombre),
            stripslashes($this->username),
            stripslashes($this->pass),
			stripslashes($this->isAdmin),
			stripslashes($this->tipo)
        );
        if($link->ejecutarInstruccion($sql))
        {
            echo "Empleado modificado con exito!";
        }
        else
        {
            echo "Error! No se modifico el empleado.";
        }
    }
}

?>