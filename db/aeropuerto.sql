-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2018 at 09:46 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aeropuerto`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`` PROCEDURE `agregar_controlador` (IN `_dni` INT(11), IN `_fechaExamen` DATE)  INSERT INTO controlador_aereo
(dni, fechaExamen)
VALUES
(_dni, _fechaExamen)$$

CREATE DEFINER=`` PROCEDURE `agregar_empleado` (IN `_afiliacion` INT(11), IN `_nombre` VARCHAR(40), IN `_username` VARCHAR(20), IN `_pass` VARCHAR(30), IN `_tipo` TINYINT(4))  INSERT INTO empleado
(afiliacion, nombre, username, pass, tipo)
VALUES
(_afiliacion, _nombre, _username, _pass, _tipo)$$

CREATE DEFINER=`` PROCEDURE `agregar_tecnico` (IN `_dni` INT, IN `_direccion` VARCHAR(40), IN `_telefono` VARCHAR(20), IN `_sueldo` INT(11))  INSERT INTO tecnicos
(dni, direccion, telefono, sueldo)
VALUES
(_dni, _direccion, _telefono, _sueldo)$$

CREATE DEFINER=`` PROCEDURE `eliminar_empleado` (IN `_dni` INT(11))  DELETE FROM empleado
WHERE dni=_dni$$

CREATE DEFINER=`` PROCEDURE `modificar_controlador` (IN `_dni` INT(11), IN `_fechaExamen` DATE)  UPDATE controlador_aereo
SET fechaExamen = _fechaExamen
WHERE dni=_dni$$

CREATE DEFINER=`` PROCEDURE `modificar_empleado` (IN `_dni` INT(11), IN `_afiliacion` INT(11), IN `_nombre` VARCHAR(40), IN `_username` VARCHAR(20), IN `_pass` VARCHAR(30))  UPDATE empleado
SET afiliacion = _afiliacion, nombre = _nombre, username = _username, pass=_pass
WHERE dni=_dni$$

CREATE DEFINER=`` PROCEDURE `modificar_tecnico` (IN `_dni` INT(11), IN `_direccion` VARCHAR(40), IN `_telefono` VARCHAR(20), IN `_sueldo` INT(11))  UPDATE tecnicos
SET direccion = _direccion, telefono = _telefono, sueldo = _sueldo
WHERE dni=_dni$$

CREATE DEFINER=`` PROCEDURE `seguimiento_tecnicos` ()  SELECT dni, COUNT(*) AS Aviones				 
FROM tecnicosxmodelos
GROUP BY dni
ORDER BY dni DESC$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `aviones`
--

CREATE TABLE `aviones` (
  `numeroRegistro` int(11) NOT NULL,
  `numeroModelo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aviones`
--

INSERT INTO `aviones` (`numeroRegistro`, `numeroModelo`) VALUES
(4, 220),
(5, 220);

--
-- Triggers `aviones`
--
DELIMITER $$
CREATE TRIGGER `log_aviones` AFTER UPDATE ON `aviones` FOR EACH ROW INSERT INTO registro_aviones (numeroRegistro, numeroModelo)
VALUES (old.numeroRegistro, old.numeroModelo)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `controlador_aereo`
--

CREATE TABLE `controlador_aereo` (
  `dni` int(11) DEFAULT NULL,
  `fechaExamen` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `controlador_aereo`
--

INSERT INTO `controlador_aereo` (`dni`, `fechaExamen`) VALUES
(NULL, '0000-00-00'),
(16, '2018-09-18');

-- --------------------------------------------------------

--
-- Table structure for table `correos`
--

CREATE TABLE `correos` (
  `codigoCorreo` int(11) NOT NULL,
  `dni` int(11) DEFAULT NULL,
  `mensaje` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `correos`
--

INSERT INTO `correos` (`codigoCorreo`, `dni`, `mensaje`) VALUES
(1, 1, 'Hola desde phpmyadmin'),
(2, 9, 'Se acaba de realizar una prueba.');

-- --------------------------------------------------------

--
-- Table structure for table `empleado`
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
-- Dumping data for table `empleado`
--

INSERT INTO `empleado` (`dni`, `afiliacion`, `nombre`, `username`, `pass`, `isAdmin`, `tipo`) VALUES
(1, 6, 'Oswal', 'admin', 'clave', 1, 1),
(9, 7, 'No Maria', 'mariadb', 'clave', 0, 1),
(12, 678, 'Pedro', '678', '678', 0, 1),
(16, 123, 'tyu', 'uio', '123', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `modelos`
--

CREATE TABLE `modelos` (
  `numero` int(11) NOT NULL,
  `capacidad` int(11) DEFAULT NULL,
  `peso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modelos`
--

INSERT INTO `modelos` (`numero`, `capacidad`, `peso`) VALUES
(220, 100, 3000),
(420, 100, 3000),
(444, 100, 3000);

-- --------------------------------------------------------

--
-- Table structure for table `pruebas`
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
-- Dumping data for table `pruebas`
--

INSERT INTO `pruebas` (`numeroPrueba`, `numeroRegistro`, `dni`, `nombre`, `puntuacion`, `fecha`, `horas`, `calificacion`) VALUES
(2, 4, 9, 'Peso', 100, '2018-09-15', 1, 12),
(3, 4, 9, 'Prueba de Gravedad', 15, '2018-09-05', 5, 15);

--
-- Triggers `pruebas`
--
DELIMITER $$
CREATE TRIGGER `log_pruebas` AFTER UPDATE ON `pruebas` FOR EACH ROW INSERT INTO registro_pruebas (numeroPrueba, numeroRegistro, dni, nombre, puntuacion, fecha, horas, calificacion)
VALUES (old.numeroPrueba, old.numeroRegistro, old.dni, old.nombre, old.puntuacion, old.fecha, old.horas, old.calificacion, now())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `registro_aviones`
--

CREATE TABLE `registro_aviones` (
  `numeroRegistro` int(11) NOT NULL,
  `numeroModelo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `registro_pruebas`
--

CREATE TABLE `registro_pruebas` (
  `numeroPrueba` int(11) NOT NULL DEFAULT '0',
  `numeroRegistro` int(11) DEFAULT NULL,
  `dni` int(11) DEFAULT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `puntuacion` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `horas` int(11) DEFAULT NULL,
  `calificacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tecnicos`
--

CREATE TABLE `tecnicos` (
  `dni` int(11) DEFAULT NULL,
  `direccion` varchar(40) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `sueldo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tecnicos`
--

INSERT INTO `tecnicos` (`dni`, `direccion`, `telefono`, `sueldo`) VALUES
(9, 'Col maria', '33783378', 123),
(12, '678', '678', 678);

-- --------------------------------------------------------

--
-- Table structure for table `tecnicosxmodelos`
--

CREATE TABLE `tecnicosxmodelos` (
  `dni` int(11) DEFAULT NULL,
  `numeroModelo` int(11) DEFAULT NULL,
  `maestria` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aviones`
--
ALTER TABLE `aviones`
  ADD PRIMARY KEY (`numeroRegistro`),
  ADD KEY `numeroModelo` (`numeroModelo`);

--
-- Indexes for table `controlador_aereo`
--
ALTER TABLE `controlador_aereo`
  ADD KEY `dni` (`dni`);

--
-- Indexes for table `correos`
--
ALTER TABLE `correos`
  ADD PRIMARY KEY (`codigoCorreo`),
  ADD KEY `dni` (`dni`);

--
-- Indexes for table `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`dni`);

--
-- Indexes for table `modelos`
--
ALTER TABLE `modelos`
  ADD PRIMARY KEY (`numero`);

--
-- Indexes for table `pruebas`
--
ALTER TABLE `pruebas`
  ADD PRIMARY KEY (`numeroPrueba`),
  ADD KEY `numeroRegistro` (`numeroRegistro`),
  ADD KEY `dni` (`dni`);

--
-- Indexes for table `registro_aviones`
--
ALTER TABLE `registro_aviones`
  ADD PRIMARY KEY (`numeroRegistro`),
  ADD KEY `numeroModelo` (`numeroModelo`);

--
-- Indexes for table `tecnicos`
--
ALTER TABLE `tecnicos`
  ADD KEY `dni` (`dni`);

--
-- Indexes for table `tecnicosxmodelos`
--
ALTER TABLE `tecnicosxmodelos`
  ADD KEY `dni` (`dni`),
  ADD KEY `numeroModelo` (`numeroModelo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aviones`
--
ALTER TABLE `aviones`
  MODIFY `numeroRegistro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `correos`
--
ALTER TABLE `correos`
  MODIFY `codigoCorreo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `empleado`
--
ALTER TABLE `empleado`
  MODIFY `dni` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `modelos`
--
ALTER TABLE `modelos`
  MODIFY `numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=445;

--
-- AUTO_INCREMENT for table `pruebas`
--
ALTER TABLE `pruebas`
  MODIFY `numeroPrueba` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `registro_aviones`
--
ALTER TABLE `registro_aviones`
  MODIFY `numeroRegistro` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aviones`
--
ALTER TABLE `aviones`
  ADD CONSTRAINT `aviones_ibfk_1` FOREIGN KEY (`numeroModelo`) REFERENCES `modelos` (`numero`);

--
-- Constraints for table `controlador_aereo`
--
ALTER TABLE `controlador_aereo`
  ADD CONSTRAINT `controlador_aereo_ibfk_1` FOREIGN KEY (`dni`) REFERENCES `empleado` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `correos`
--
ALTER TABLE `correos`
  ADD CONSTRAINT `correos_ibfk_1` FOREIGN KEY (`dni`) REFERENCES `empleado` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pruebas`
--
ALTER TABLE `pruebas`
  ADD CONSTRAINT `pruebas_ibfk_1` FOREIGN KEY (`numeroRegistro`) REFERENCES `aviones` (`numeroRegistro`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pruebas_ibfk_2` FOREIGN KEY (`dni`) REFERENCES `tecnicos` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tecnicos`
--
ALTER TABLE `tecnicos`
  ADD CONSTRAINT `tecnicos_ibfk_1` FOREIGN KEY (`dni`) REFERENCES `empleado` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tecnicosxmodelos`
--
ALTER TABLE `tecnicosxmodelos`
  ADD CONSTRAINT `tecnicosxmodelos_ibfk_1` FOREIGN KEY (`dni`) REFERENCES `tecnicos` (`dni`),
  ADD CONSTRAINT `tecnicosxmodelos_ibfk_2` FOREIGN KEY (`numeroModelo`) REFERENCES `modelos` (`numero`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
