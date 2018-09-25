-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-09-2018 a las 15:09:38
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `aeropuerto`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `agregar_controlador` (IN `_dni` INT(11), IN `_fechaExamen` DATE)  INSERT INTO controlador_aereo
(dni, fechaExamen)
VALUES
(_dni, _fechaExamen)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `agregar_empleado` (IN `_afiliacion` INT(11), IN `_nombre` VARCHAR(40), IN `_username` VARCHAR(20), IN `_pass` VARCHAR(30), IN `_tipo` TINYINT(4), IN `_isAdmin` INT(1))  INSERT INTO empleado
(afiliacion, nombre, username, pass, isAdmin, tipo)
VALUES
(_afiliacion, _nombre, _username, _pass, _isAdmin, _tipo)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `agregar_tecnico` (IN `_dni` INT, IN `_direccion` VARCHAR(40), IN `_telefono` VARCHAR(20), IN `_sueldo` INT(11))  INSERT INTO tecnicos
(dni, direccion, telefono, sueldo)
VALUES
(_dni, _direccion, _telefono, _sueldo)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_empleado` (IN `_dni` INT(11))  DELETE FROM empleado
WHERE dni=_dni$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_controlador` (IN `_dni` INT(11), IN `_fechaExamen` DATE)  UPDATE controlador_aereo
SET fechaExamen = _fechaExamen
WHERE dni=_dni$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_empleado` (IN `_dni` INT(11), IN `_afiliacion` INT(11), IN `_nombre` VARCHAR(40), IN `_username` VARCHAR(20), IN `_pass` INT(30))  UPDATE empleado
SET afiliacion = _afiliacion, nombre = _nombre, username = _username, pass=_pass
WHERE dni=_dni$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_tecnico` (IN `_dni` INT(11), IN `_direccion` VARCHAR(40), IN `_telefono` VARCHAR(20), IN `_sueldo` INT(11))  UPDATE tecnicos
SET direccion = _direccion, telefono = _telefono, sueldo = _sueldo
WHERE dni=_dni$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aviones`
--

CREATE TABLE `aviones` (
  `numeroRegistro` int(11) NOT NULL,
  `numeroModelo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `aviones`
--

INSERT INTO `aviones` (`numeroRegistro`, `numeroModelo`) VALUES
(2, 256),
(3, 340);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `controlador_aereo`
--

CREATE TABLE `controlador_aereo` (
  `dni` int(11) DEFAULT NULL,
  `fechaExamen` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `controlador_aereo`
--

INSERT INTO `controlador_aereo` (`dni`, `fechaExamen`) VALUES
(NULL, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `dni` int(11) NOT NULL,
  `afiliacion` int(11) DEFAULT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `pass` varchar(30) DEFAULT NULL,
  `isAdmin` tinyint(1) DEFAULT '0',
  `tipo` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`dni`, `afiliacion`, `nombre`, `username`, `pass`, `isAdmin`, `tipo`) VALUES
(1, 1, 'Oswal', 'oswal', '123', 1, 1),
(18, 8, 'Juan', 'juan', 'clave', 1, 0),
(19, 2, 'Jose', 'josesito', 'clave', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelos`
--

CREATE TABLE `modelos` (
  `numero` int(11) NOT NULL,
  `capacidad` int(11) DEFAULT NULL,
  `peso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `modelos`
--

INSERT INTO `modelos` (`numero`, `capacidad`, `peso`) VALUES
(128, 125, 3200),
(256, 95, 2800),
(340, 150, 3500),
(420, 100, 3000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pruebas`
--

CREATE TABLE `pruebas` (
  `numeroPrueba` int(11) NOT NULL,
  `numeroRegistro` int(11) DEFAULT NULL,
  `dni` int(11) DEFAULT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `puntuacion` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `horas` int(11) DEFAULT NULL,
  `calificacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pruebas`
--

INSERT INTO `pruebas` (`numeroPrueba`, `numeroRegistro`, `dni`, `nombre`, `puntuacion`, `fecha`, `horas`, `calificacion`) VALUES
(4, 2, 19, 'Prueba de peso', 15, '2018-09-12', 5, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnicos`
--

CREATE TABLE `tecnicos` (
  `dni` int(11) DEFAULT NULL,
  `direccion` varchar(40) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `sueldo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tecnicos`
--

INSERT INTO `tecnicos` (`dni`, `direccion`, `telefono`, `sueldo`) VALUES
(18, 'direccion', '242424', 555),
(19, 'COl alameda', '22337832', 8989);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnicosxmodelos`
--

CREATE TABLE `tecnicosxmodelos` (
  `dni` int(11) DEFAULT NULL,
  `numeroModelo` int(11) DEFAULT NULL,
  `maestria` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aviones`
--
ALTER TABLE `aviones`
  ADD PRIMARY KEY (`numeroRegistro`),
  ADD KEY `numeroModelo` (`numeroModelo`);

--
-- Indices de la tabla `controlador_aereo`
--
ALTER TABLE `controlador_aereo`
  ADD KEY `dni` (`dni`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD PRIMARY KEY (`numero`);

--
-- Indices de la tabla `pruebas`
--
ALTER TABLE `pruebas`
  ADD PRIMARY KEY (`numeroPrueba`),
  ADD KEY `numeroRegistro` (`numeroRegistro`),
  ADD KEY `dni` (`dni`);

--
-- Indices de la tabla `tecnicos`
--
ALTER TABLE `tecnicos`
  ADD KEY `dni` (`dni`);

--
-- Indices de la tabla `tecnicosxmodelos`
--
ALTER TABLE `tecnicosxmodelos`
  ADD KEY `dni` (`dni`),
  ADD KEY `numeroModelo` (`numeroModelo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aviones`
--
ALTER TABLE `aviones`
  MODIFY `numeroRegistro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `dni` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `modelos`
--
ALTER TABLE `modelos`
  MODIFY `numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=421;
--
-- AUTO_INCREMENT de la tabla `pruebas`
--
ALTER TABLE `pruebas`
  MODIFY `numeroPrueba` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aviones`
--
ALTER TABLE `aviones`
  ADD CONSTRAINT `aviones_ibfk_1` FOREIGN KEY (`numeroModelo`) REFERENCES `modelos` (`numero`);

--
-- Filtros para la tabla `controlador_aereo`
--
ALTER TABLE `controlador_aereo`
  ADD CONSTRAINT `controlador_aereo_ibfk_1` FOREIGN KEY (`dni`) REFERENCES `empleado` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pruebas`
--
ALTER TABLE `pruebas`
  ADD CONSTRAINT `pruebas_ibfk_1` FOREIGN KEY (`numeroRegistro`) REFERENCES `aviones` (`numeroRegistro`),
  ADD CONSTRAINT `pruebas_ibfk_2` FOREIGN KEY (`dni`) REFERENCES `tecnicos` (`dni`);

--
-- Filtros para la tabla `tecnicos`
--
ALTER TABLE `tecnicos`
  ADD CONSTRAINT `tecnicos_ibfk_1` FOREIGN KEY (`dni`) REFERENCES `empleado` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tecnicosxmodelos`
--
ALTER TABLE `tecnicosxmodelos`
  ADD CONSTRAINT `tecnicosxmodelos_ibfk_1` FOREIGN KEY (`dni`) REFERENCES `tecnicos` (`dni`),
  ADD CONSTRAINT `tecnicosxmodelos_ibfk_2` FOREIGN KEY (`numeroModelo`) REFERENCES `modelos` (`numero`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
