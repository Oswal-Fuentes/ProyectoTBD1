<?php
include_once("../class/class_conexion.php");
include_once("../class/class_avion.php");

$link = new Conexion();

switch ($_GET["accion"])
{
    case 'guardarAvion':
        $aviones = new Avion(
            NULL,
            $_POST["slc-modelo-avion"]
        );
        echo $aviones->agregarAvion($link);
        break;

    case 'generarTabla':
        echo Avion::generarTabla($link);
        break;

    case 'eliminarAvion':
        Avion::eliminarAvion($link, $_POST["numeroRegistro"]);
        break;

    case 'obtenerAvion':
        echo json_encode(Avion::obtenerAvion($link, $_POST["numeroRegistro"]));
        break;

    case 'modificarAvion':
        if(Avion::verificarModificar($link, $_POST["txt-numeroRegistro-avion"], $_POST["txt-numeroModelo-avion"]))
        {
            $aviones = new Avion(
                $_POST["txt-numeroRegistro-avion"],
                null,
                $_POST["txt-numeroModelo-avion"]
            );
            echo $aviones->modificarAvion($link);
        }
        else
        {
            echo header('HTTP', true, 500);
        }
        break;

    default:
        echo header('HTTP', true, 500);
        break;
}

$link->cerrarConexion();

?>
