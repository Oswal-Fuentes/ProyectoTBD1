<?php

class Avion
{
    private $numeroRegistro;
    private $numeroModelo;

    function __construct($numeroRegistro, $numeroModelo)
    {
        $this->numeroRegistro = $numeroRegistro;
        $this->numeroModelo = $numeroModelo;
    }

    public function getNumeroRegistro()
    {
        return $this->numeroRegistro;
    }

    public function setNumeroRegistro($numeroRegistro)
    {
        $this->numeroRegistro = $numeroRegistro;
    }

    public function getNumeroModelo()
    {
        return $this->numeroModelo;
    }

    public function setNumeroModelo($numeroModelo)
    {
        $this->numeroModelo = $numeroModelo;
    }

    public static function eliminarAvion($link, $registro) {
		$sql = "DELETE FROM aviones WHERE `numeroRegistro` = $registro";
		$resultado = $link->ejecutarInstruccion($sql);
		if ($resultado) {
			$link->liberarResultado($resultado);
		}
    }

    public static function generarTabla($link) {
		$resultado = $link->ejecutarInstruccion("
            SELECT a.numeroRegistro AS registro,
            a.numeroModelo AS modelo_avion,
            b.numero AS modelo_modelos,
            b.capacidad as capacidad,
            b.peso as peso
            FROM aviones a
            INNER JOIN modelos b
            ON (a.numeroModelo = b.numero)
		");

		while ($fila = $link->obtenerFila($resultado)) {
			echo "<tr>";
			echo "<td><input type='radio' name='rad-aviones' value='".$fila["registro"]."'></td>";
			echo "<td>".$fila["registro"]."</td>";
			echo "<td>".$fila["modelo_avion"]."</td>";
			echo "<td>".$fila["capacidad"]."</td>";
			echo "<td>".$fila["peso"]."</td>";
			echo "</tr>";
		}

		$link->liberarResultado($resultado);
    }

    public static function obtenerLlavePrimaria($link) {
		// obtener la llave primaria max y retornar la siguiente
		$sql = "SELECT MAX(numeroRegistro) AS 'llave_max' FROM aviones";
		$resultado = $link->ejecutarInstruccion($sql);
		if ($link->cantidadRegistros($resultado) > 0)
        {
			$fila = $link->obtenerFila($resultado);
			return $fila["llave_max"] + 1;
        } else {
			return 0;
		}
	}

	public static function generarSelectRegistro($link) {
		$resultado = $link->ejecutarInstruccion("
            SELECT a.numeroRegistro AS registro,
            a.numeroModelo AS modelo_avion,
            b.numero AS modelo_modelos,
            b.capacidad as capacidad,
            b.peso as peso
            FROM aviones a
            INNER JOIN modelos b
            ON (a.numeroModelo = b.numero)
		");

		echo '<select class="form-control" id="slc-registro-prueba">';

		while ($fila = $link->obtenerFila($resultado)) {
			echo "<option value='".$fila["registro"]."'>";
			echo "Modelo: " . $fila["modelo_avion"] . ", capacidad: " . $fila["capacidad"] . ", peso: " . $fila["peso"];
			echo "</option>";
		}

		echo '</select>';
	}

	public static function generarSelect($link){
		$resultado = $link->ejecutarInstruccion("
			SELECT numero, capacidad, peso
			FROM modelos
		");

		echo '<select class="form-control" id="slc-modelo-avion">';

		while ($fila = $link->obtenerFila($resultado)) {
			echo "<option value='".$fila["numero"]."'>";
			echo "Modelo: " . $fila["numero"] . ", capacidad: " . $fila["capacidad"] . ", peso: " . $fila["peso"];
			echo "</option>";
		}

		echo '</select>';
	}

    public function agregarAvion($link)
    {
        $sql = sprintf("INSERT INTO aviones VALUES (NULL, %s);",
            stripslashes($this->numeroModelo)
        );

        echo $sql;
        if($link->ejecutarInstruccion($sql))
            echo "Avion agregado con exito!";
        else
            echo "Error! No se agrego el avion.";
    }

    public static function obtenerAvion($link, $numeroRegistro)
    {
        $sql = sprintf("
            SELECT numeroRegistro, numeroModelo
            FROM Aviones
            WHERE numeroRegistro = '%s'",
            stripslashes($numeroRegistro)
        );
        $resultado = $link->ejecutarInstruccion($sql);
        $fila = $link->obtenerFila($resultado);
        $link->liberarResultado($resultado);
        return $fila;
    }

    public function modificarAvion($link)
    {
        $sql = sprintf("
            UPDATE Aviones
            SET numeroRegistro= '%s', numeroModelo= '%s'
            WHERE numeroRegistro = '%s'",
            stripslashes($this->numeroRegistro),
            stripslashes($this->numeroModelo)
        );
        if($link->ejecutarInstruccion($sql))
        {
            echo "Avion modificado con exito!";
        }
        else
        {
            echo "Error! No se modifico el Avion.";
        }
    }

}

?>