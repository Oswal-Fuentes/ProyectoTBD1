<?php

class Prueba{

	private $numeroPrueba;
	private $numeroRegistro;
	private $dni;
	private $nombre;
	private $puntuacion;
	private $fecha;
	private $horas;
	private $calificacion;

	function __construct($numeroPrueba, $numeroRegistro, $dni, $nombre, $puntuacion, $fecha, $horas, $calificacion){
		$this->numeroPrueba = $numeroPrueba;
		$this->numeroRegistro = $numeroRegistro;
		$this->dni = $dni;
		$this->nombre = $nombre;
		$this->puntuacion = $puntuacion;
		$this->fecha = $fecha;
		$this->horas = $horas;
		$this->calificacion = $calificacion;
	}

	public function getNumeroPrueba(){
	    return $this->numeroPrueba;
	}

	public function setNumeroPrueba($numeroPrueba){
	    $this->numeroPrueba = $numeroPrueba;
	}

	public function getNumeroRegistro(){
	    return $this->numeroRegistro;
	}

    public function setNumeroRegistro(){
	    $this->numeroRegistro = $numeroRegistro;
	}

	public function getDni(){
	    return $this->dni;
	}

	public function setDni($dni){
	    $this->dni = $dni;
	}

	public function getNombre(){
	    return $this->nombre;
	}

	public function setNombre($nombre){
	    $this->nombre = $nombre;
	}

	public function getPuntuacion(){
	    return $this->puntuacion;
	}

	public function setPuntuacion($puntuacion){
	    $this->puntuacion = $puntuacion;
	}

	public function getFecha(){
	    return $this->fecha;
	}

	public function setFecha($fecha){
	    $this->fecha = $fecha;
	}

	public function getHoras(){
	    return $this->horas;
	}

	public function setHoras($horas){
	    $this->horas = $horas;
	}

	public function getCalificacion(){
	    return $this->calificacion;
	}

	public function setCalificacion($calificacion){
	    $this->calificacion = $calificacion;
	}

	/*
	public static function eliminarSeccion($link, $numeroPrueba){
		$sql = sprintf("
			DELETE FROM tbl_secciones_x_usuarios
			WHERE numeroPrueba = '%s'",
			stripslashes($numeroPrueba)
		);

		$link->ejecutarInstruccion($sql);

		$sql = sprintf("
			DELETE FROM tbl_secciones
			WHERE numeroPrueba = '%s'",
			stripslashes($numeroPrueba)
		);

		$link->ejecutarInstruccion($sql);
	}
	*/
	public function agregarPrueba($link)
    {
		// si es una cadena: '%s'
		// si no es una cadena: %s
		// quitar url_imagen de la bd
        $sql = "INSERT INTO pruebas VALUES
		(NULL, $this->numeroRegistro, $this->dni,
		'$this->nombre', $this->puntuacion,
		'$this->fecha', $this->horas, $this->calificacion);";
        if($link->ejecutarInstruccion($sql)) {
			echo "Prueba agregada con exito!";
			$sql_correo = "INSERT INTO `correos`(`codigoCorreo`, `dni`, `mensaje`) VALUES (NULL, $this->dni, 'Se acaba de realizar una prueba.');";
			if ($link->ejecutarInstruccion($sql_correo)) {
				echo "Correo mandado con exito!";
			} else {
				echo "No se pudo mandar el correo!";
			}
		} else {
			// no se agrega porque tienen como que el dni es una llave foranea de tecnicos, no de empleados
			// esta bueno asi? si entran con un tecnico se puede agregar
			echo "Error! No se agrego la Prueba.";
			echo $sql;
		}
	}

	public static function generarPrueba($link) {
		$resultado = $link->ejecutarInstruccion("SELECT `numeroPrueba`, `numeroRegistro`, `dni`, `nombre`, `puntuacion`, `fecha`, `horas`, `calificacion` FROM `pruebas` WHERE 1");

		while ($fila = $link->obtenerFila($resultado)) {
			echo "<tr>";
			echo "<td><input type='radio' name='rad-pruebas' value='".$fila["numeroPrueba"]."'></td>";
			echo "<td>".$fila["numeroPrueba"]."</td>";
			echo "<td>".$fila["numeroRegistro"]."</td>";
			echo "<td>".$fila["dni"]."</td>";
			echo "<td>".$fila["nombre"]."</td>";
			echo "<td>".$fila["puntuacion"]."</td>";
			echo "<td>".$fila["fecha"]."</td>";
			echo "<td>".$fila["horas"]."</td>";
			echo "<td>".$fila["calificacion"]."</td>";
			echo "</tr>";
		}

		$link->liberarResultado($resultado);
	}

	public static function obtenerLlavePrimaria($link) {
		$sql = "SELECT MAX(numeroPrueba) AS 'llave_max' FROM pruebas";
		$resultado = $link->ejecutarInstruccion($sql);
		if ($link->cantidadRegistros($resultado) > 0)
        {
			$fila = $link->obtenerFila($resultado);
			return $fila["llave_max"] + 1;
        } else {
			return 0;
		}
	}

	public static function verificarIntegridad($link, $fecha, $horas, $nombre){
		$sql = sprintf("
			SELECT fecha, horas, nombre
			FROM tbl_secciones
			WHERE (fecha = '%s' AND horas = '%s')
			OR (nombre = '%s' AND horas = '%s')",
			stripslashes($fecha),
			stripslashes($horas),
			stripslashes($nombre),
			stripslashes($horas)
		);

		return($link->cantidadRegistros($link->ejecutarInstruccion($sql)) == 0);
	}

	public static function verificarModificar($link, $fecha, $horas, $nombre, $numeroPrueba){
		$sql = sprintf("
			SELECT numeroPrueba fecha, horas, nombre
			FROM tbl_secciones
			WHERE ((fecha = '%s' AND horas = '%s')
			OR (nombre = '%s' AND horas = '%s'))
			AND numeroPrueba != '%s'",
			stripslashes($fecha),
			stripslashes($horas),
			stripslashes($nombre),
			stripslashes($horas),
			stripslashes($numeroPrueba)
		);

		return($link->cantidadRegistros($link->ejecutarInstruccion($sql)) == 0);
	}

	public static function generarTabla($link){
		$sql = "SELECT `numeroPrueba`, `numeroRegistro`, `dni`, `nombre`, `puntuacion`, `fecha`, `horas`, `calificacion` FROM `pruebas` WHERE 1";

		if($resultado = $link->ejecutarInstruccion($sql)){
			while ($fila = $link->obtenerFila($resultado)) {
				echo "<tr>";
				echo "<td><input type='radio' name='rad-pruebas' value='".$fila["numeroPrueba"]."'></td>";
				echo "<td>".$fila["numeroPrueba"]."</td>";
				echo "<td>".$fila["numeroRegistro"]."</td>";
				echo "<td>".$fila["dni"]."</td>";
				echo "<td>".$fila["puntuacion"]."</td>";
				echo "<td>".$fila["fecha"]."</td>";
				echo "<td>".$fila["horas"]."</td>";
				echo "<td>".$fila["calificacion"]."</td>";
				echo "</tr>";
			}

			$link->liberarResultado($resultado);
		}
	}

	public static function eliminarPrueba($link, $numeroPrueba) {
		$sql = "DELETE FROM pruebas WHERE `numeroPrueba` = $numeroPrueba";
		$resultado = $link->ejecutarInstruccion($sql);
		if ($resultado) {
			$link->liberarResultado($resultado);
		}
	}

	public function agregarSeccion($link){
		$sql = sprintf("
			INSERT INTO tbl_secciones
			(numeroPrueba, numeroRegistro, dni, nombre, puntuacion, fecha, horas, calificacion)
			VALUES (NULL, '%s', '%s', '%s', '%s', '%s', '%s', '%s');",
			stripslashes($this->numeroRegistro),
			stripslashes($this->dni),
			stripslashes($this->nombre),
			stripslashes($this->puntuacion),
			stripslashes($this->fecha),
			stripslashes($this->horas),
			stripslashes($this->calificacion)
		);

		if($link->ejecutarInstruccion($sql))
			echo "Seccion agregada con exito!";
		else
			echo "Error! No se agrego la seccion.";
	}

	public static function obtenerSeccion($link, $numeroPrueba){
		$sql = sprintf("
			SELECT numeroPrueba, numeroRegistro, dni, nombre, puntuacion, fecha, horas, calificacion
			FROM tbl_secciones
			WHERE numeroPrueba = '%s'",
			stripslashes($numeroPrueba)
		);

		return $link->obtenerFila($link->ejecutarInstruccion($sql));
	}

	public function modificarSeccion($link){
		$sql = sprintf("
			UPDATE tbl_secciones
			SET numeroRegistro='%s', dni='%s', nombre='%s', puntuacion='%s', fecha='%s', horas='%s', calificacion='%s'
			WHERE numeroPrueba = '%s'",
			stripslashes($this->numeroRegistro),
			stripslashes($this->dni),
			stripslashes($this->nombre),
			stripslashes($this->puntuacion),
			stripslashes($this->fecha),
			stripslashes($this->horas),
			stripslashes($this->calificacion),
			stripslashes($this->numeroPrueba)
		);

		if($link->ejecutarInstruccion($sql))
			echo "Seccion modificada con exito!";
		else
			echo "Error! No se modifico la seccion.";
	}

}

?>