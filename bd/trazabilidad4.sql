-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-03-2024 a las 23:41:06
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `trazabilidad4`
--
CREATE DATABASE IF NOT EXISTS `trazabilidad4` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `trazabilidad4`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `IdProyecto` int(11) NOT NULL,
  `CodigoProyecto` varchar(10) NOT NULL,
  `NombreProyecto` varchar(50) NOT NULL,
  `InicioProyecto` date NOT NULL,
  `IdUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`IdProyecto`, `CodigoProyecto`, `NombreProyecto`, `InicioProyecto`, `IdUsuario`) VALUES
(1, 'P01', 'Sistema de ventas', '2023-06-29', 1),
(2, 'P02', 'Sistema Control de Inventario', '2023-06-30', 1),
(3, 'P005', 'Cañete Pet', '2023-07-14', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requerimiento`
--

CREATE TABLE `requerimiento` (
  `IdRequerimiento` int(11) NOT NULL,
  `CodigoRequerimiento` varchar(10) NOT NULL,
  `NombreRequerimiento` varchar(50) NOT NULL,
  `DescripcionRequerimiento` varchar(200) NOT NULL,
  `PrioridadRequerimiento` varchar(5) NOT NULL,
  `IdProyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `requerimiento`
--

INSERT INTO `requerimiento` (`IdRequerimiento`, `CodigoRequerimiento`, `NombreRequerimiento`, `DescripcionRequerimiento`, `PrioridadRequerimiento`, `IdProyecto`) VALUES
(1, 'RF01', 'Nuevo Registro', 'El sistema permitirá al usuario agregar un nuevo registro', 'Alta', 1),
(2, 'RF02', 'Modificar Registro', 'El sistema permitirá al usuario modificar el registro', 'Media', 1),
(3, 'RF01', 'Eliminar Registro', 'El sistema permitirá al usuario eliminar un registro', 'Media', 2),
(4, 'RF003', 'Eliminar Registro', '1', 'Media', 1),
(5, 'RF001', 'Nuevo Registro', 'El sistema permitirá al usuario registrar un nuevo registro', 'Alta', 3),
(6, 'RF002', 'Modificar Registro', 'El sistema permitirá al usuario modificar un registro', 'Media', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revision1`
--

CREATE TABLE `revision1` (
  `IdRevision1` int(11) NOT NULL,
  `NumeroIteracionRevision1` int(11) NOT NULL,
  `FechaRevision1` date NOT NULL,
  `NombreRevision1` varchar(20) NOT NULL,
  `EstadoRequerimientoRevision1` varchar(2) NOT NULL,
  `IdRequerimiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `revision1`
--

INSERT INTO `revision1` (`IdRevision1`, `NumeroIteracionRevision1`, `FechaRevision1`, `NombreRevision1`, `EstadoRequerimientoRevision1`, `IdRequerimiento`) VALUES
(1, 1, '2023-06-29', 'Revision1', 'Si', 1),
(3, 1, '2023-06-30', 'Revision1', 'Si', 2),
(4, 1, '2023-06-30', 'Revision1', 'Si', 3),
(5, 1, '2023-06-20', 'Revision1', 'Si', 5),
(6, 1, '2023-06-20', 'Revision1', 'No', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revision2`
--

CREATE TABLE `revision2` (
  `IdRevision2` int(11) NOT NULL,
  `NumeroIteracionRevision2` int(11) NOT NULL,
  `FechaRevision2` date NOT NULL,
  `NombreRevision2` varchar(20) NOT NULL,
  `EstadoRequerimientoRevision2` varchar(2) NOT NULL,
  `IdRequerimiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `revision2`
--

INSERT INTO `revision2` (`IdRevision2`, `NumeroIteracionRevision2`, `FechaRevision2`, `NombreRevision2`, `EstadoRequerimientoRevision2`, `IdRequerimiento`) VALUES
(1, 2, '2023-06-30', 'Revision2', 'Si', 1),
(3, 2, '2023-07-21', 'Revision2', 'Si', 5),
(4, 2, '2023-07-21', 'Revision2', 'Si', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revision3`
--

CREATE TABLE `revision3` (
  `IdRevision3` int(11) NOT NULL,
  `NumeroIteracionRevision3` int(11) NOT NULL,
  `FechaRevision3` date NOT NULL,
  `NombreRevision3` varchar(20) NOT NULL,
  `EstadoRequerimientoRevision3` varchar(2) NOT NULL,
  `IdRequerimiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `revision3`
--

INSERT INTO `revision3` (`IdRevision3`, `NumeroIteracionRevision3`, `FechaRevision3`, `NombreRevision3`, `EstadoRequerimientoRevision3`, `IdRequerimiento`) VALUES
(2, 3, '2023-07-01', 'Revision3', 'Si', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revision4`
--

CREATE TABLE `revision4` (
  `IdRevision4` int(11) NOT NULL,
  `NumeroIteracionRevision4` int(11) NOT NULL,
  `FechaRevision4` date NOT NULL,
  `NombreRevision4` varchar(20) NOT NULL,
  `EstadoRequerimientoRevision4` varchar(2) NOT NULL,
  `IdRequerimiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `revision4`
--

INSERT INTO `revision4` (`IdRevision4`, `NumeroIteracionRevision4`, `FechaRevision4`, `NombreRevision4`, `EstadoRequerimientoRevision4`, `IdRequerimiento`) VALUES
(1, 4, '2023-07-03', 'Revision4', 'Si', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revision5`
--

CREATE TABLE `revision5` (
  `IdRevision5` int(11) NOT NULL,
  `NumeroIteracionRevision5` int(11) NOT NULL,
  `FechaRevision5` date NOT NULL,
  `NombreRevision5` varchar(20) NOT NULL,
  `EstadoRequerimientoRevision5` varchar(2) NOT NULL,
  `IdRequerimiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `revision5`
--

INSERT INTO `revision5` (`IdRevision5`, `NumeroIteracionRevision5`, `FechaRevision5`, `NombreRevision5`, `EstadoRequerimientoRevision5`, `IdRequerimiento`) VALUES
(1, 5, '2023-07-04', 'Revision5', 'Si', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revision6`
--

CREATE TABLE `revision6` (
  `IdRevision6` int(11) NOT NULL,
  `NumeroIteracionRevision6` int(11) NOT NULL,
  `FechaRevision6` date NOT NULL,
  `NombreRevision6` varchar(20) NOT NULL,
  `EstadoRequerimientoRevision6` varchar(2) NOT NULL,
  `IdRequerimiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `revision6`
--

INSERT INTO `revision6` (`IdRevision6`, `NumeroIteracionRevision6`, `FechaRevision6`, `NombreRevision6`, `EstadoRequerimientoRevision6`, `IdRequerimiento`) VALUES
(1, 6, '2023-07-06', 'Revision6', 'Si', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revision7`
--

CREATE TABLE `revision7` (
  `IdRevision7` int(11) NOT NULL,
  `NumeroIteracionRevision7` int(11) NOT NULL,
  `FechaRevision7` date NOT NULL,
  `NombreRevision7` varchar(20) NOT NULL,
  `EstadoRequerimientoRevision7` varchar(2) NOT NULL,
  `IdRequerimiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `revision7`
--

INSERT INTO `revision7` (`IdRevision7`, `NumeroIteracionRevision7`, `FechaRevision7`, `NombreRevision7`, `EstadoRequerimientoRevision7`, `IdRequerimiento`) VALUES
(1, 7, '2023-07-07', 'Revision7', 'Si', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revision8`
--

CREATE TABLE `revision8` (
  `IdRevision8` int(11) NOT NULL,
  `NumeroIteracionRevision8` int(11) NOT NULL,
  `FechaRevision8` date NOT NULL,
  `NombreRevision8` varchar(20) NOT NULL,
  `EstadoRequerimientoRevision8` varchar(2) NOT NULL,
  `IdRequerimiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `revision8`
--

INSERT INTO `revision8` (`IdRevision8`, `NumeroIteracionRevision8`, `FechaRevision8`, `NombreRevision8`, `EstadoRequerimientoRevision8`, `IdRequerimiento`) VALUES
(1, 8, '2023-07-08', 'Revision8', 'Si', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revision9`
--

CREATE TABLE `revision9` (
  `IdRevision9` int(11) NOT NULL,
  `NumeroIteracionRevision9` int(11) NOT NULL,
  `FechaRevision9` date NOT NULL,
  `NombreRevision9` varchar(20) NOT NULL,
  `EstadoRequerimientoRevision9` varchar(2) NOT NULL,
  `IdRequerimiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `revision9`
--

INSERT INTO `revision9` (`IdRevision9`, `NumeroIteracionRevision9`, `FechaRevision9`, `NombreRevision9`, `EstadoRequerimientoRevision9`, `IdRequerimiento`) VALUES
(1, 9, '2023-07-09', 'Revision9', 'Si', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revision10`
--

CREATE TABLE `revision10` (
  `IdRevision10` int(11) NOT NULL,
  `NumeroIteracionRevision10` int(11) NOT NULL,
  `FechaRevision10` date NOT NULL,
  `NombreRevision10` varchar(20) NOT NULL,
  `EstadoRequerimientoRevision10` varchar(2) NOT NULL,
  `IdRequerimiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `revision10`
--

INSERT INTO `revision10` (`IdRevision10`, `NumeroIteracionRevision10`, `FechaRevision10`, `NombreRevision10`, `EstadoRequerimientoRevision10`, `IdRequerimiento`) VALUES
(1, 10, '2023-07-10', 'Revision10', 'Si', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revision11`
--

CREATE TABLE `revision11` (
  `IdRevision11` int(11) NOT NULL,
  `NumeroIteracionRevision11` int(11) NOT NULL,
  `FechaRevision11` date NOT NULL,
  `NombreRevision11` varchar(20) NOT NULL,
  `EstadoRequerimientoRevision11` varchar(2) NOT NULL,
  `IdRequerimiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `revision11`
--

INSERT INTO `revision11` (`IdRevision11`, `NumeroIteracionRevision11`, `FechaRevision11`, `NombreRevision11`, `EstadoRequerimientoRevision11`, `IdRequerimiento`) VALUES
(1, 11, '2023-07-11', 'Revision11', 'Si', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revision12`
--

CREATE TABLE `revision12` (
  `IdRevision12` int(11) NOT NULL,
  `NumeroIteracionRevision12` int(11) NOT NULL,
  `FechaRevision12` date NOT NULL,
  `NombreRevision12` varchar(20) NOT NULL,
  `EstadoRequerimientoRevision12` varchar(2) NOT NULL,
  `IdRequerimiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `revision12`
--

INSERT INTO `revision12` (`IdRevision12`, `NumeroIteracionRevision12`, `FechaRevision12`, `NombreRevision12`, `EstadoRequerimientoRevision12`, `IdRequerimiento`) VALUES
(1, 12, '2023-07-12', 'Revision12', 'Si', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `IdUsuario` int(11) NOT NULL,
  `NombreUsuario` varchar(50) NOT NULL,
  `EmailUsuario` varchar(30) NOT NULL,
  `ContrasenaUsuario` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IdUsuario`, `NombreUsuario`, `EmailUsuario`, `ContrasenaUsuario`) VALUES
(1, 'Richard Navarro', 'richardnb@email.com', '123'),
(2, 'admin', 'admin@email.com', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`IdProyecto`),
  ADD KEY `IdUsuario` (`IdUsuario`);

--
-- Indices de la tabla `requerimiento`
--
ALTER TABLE `requerimiento`
  ADD PRIMARY KEY (`IdRequerimiento`),
  ADD KEY `IdProyecto` (`IdProyecto`);

--
-- Indices de la tabla `revision1`
--
ALTER TABLE `revision1`
  ADD PRIMARY KEY (`IdRevision1`),
  ADD KEY `IdRequerimiento` (`IdRequerimiento`);

--
-- Indices de la tabla `revision2`
--
ALTER TABLE `revision2`
  ADD PRIMARY KEY (`IdRevision2`),
  ADD KEY `IdRequerimiento` (`IdRequerimiento`);

--
-- Indices de la tabla `revision3`
--
ALTER TABLE `revision3`
  ADD PRIMARY KEY (`IdRevision3`),
  ADD KEY `IdRequerimiento` (`IdRequerimiento`);

--
-- Indices de la tabla `revision4`
--
ALTER TABLE `revision4`
  ADD PRIMARY KEY (`IdRevision4`),
  ADD KEY `IdRequerimiento` (`IdRequerimiento`);

--
-- Indices de la tabla `revision5`
--
ALTER TABLE `revision5`
  ADD PRIMARY KEY (`IdRevision5`),
  ADD KEY `IdRequerimiento` (`IdRequerimiento`);

--
-- Indices de la tabla `revision6`
--
ALTER TABLE `revision6`
  ADD PRIMARY KEY (`IdRevision6`),
  ADD KEY `IdRequerimiento` (`IdRequerimiento`);

--
-- Indices de la tabla `revision7`
--
ALTER TABLE `revision7`
  ADD PRIMARY KEY (`IdRevision7`),
  ADD KEY `IdRequerimiento` (`IdRequerimiento`);

--
-- Indices de la tabla `revision8`
--
ALTER TABLE `revision8`
  ADD PRIMARY KEY (`IdRevision8`),
  ADD KEY `IdRequerimiento` (`IdRequerimiento`);

--
-- Indices de la tabla `revision9`
--
ALTER TABLE `revision9`
  ADD PRIMARY KEY (`IdRevision9`),
  ADD KEY `IdRequerimiento` (`IdRequerimiento`);

--
-- Indices de la tabla `revision10`
--
ALTER TABLE `revision10`
  ADD PRIMARY KEY (`IdRevision10`),
  ADD KEY `IdRequerimiento` (`IdRequerimiento`);

--
-- Indices de la tabla `revision11`
--
ALTER TABLE `revision11`
  ADD PRIMARY KEY (`IdRevision11`),
  ADD KEY `IdRequerimiento` (`IdRequerimiento`);

--
-- Indices de la tabla `revision12`
--
ALTER TABLE `revision12`
  ADD PRIMARY KEY (`IdRevision12`),
  ADD KEY `IdRequerimiento` (`IdRequerimiento`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IdUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `IdProyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `requerimiento`
--
ALTER TABLE `requerimiento`
  MODIFY `IdRequerimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `revision1`
--
ALTER TABLE `revision1`
  MODIFY `IdRevision1` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `revision2`
--
ALTER TABLE `revision2`
  MODIFY `IdRevision2` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `revision3`
--
ALTER TABLE `revision3`
  MODIFY `IdRevision3` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `revision4`
--
ALTER TABLE `revision4`
  MODIFY `IdRevision4` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `revision5`
--
ALTER TABLE `revision5`
  MODIFY `IdRevision5` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `revision6`
--
ALTER TABLE `revision6`
  MODIFY `IdRevision6` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `revision7`
--
ALTER TABLE `revision7`
  MODIFY `IdRevision7` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `revision8`
--
ALTER TABLE `revision8`
  MODIFY `IdRevision8` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `revision9`
--
ALTER TABLE `revision9`
  MODIFY `IdRevision9` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `revision10`
--
ALTER TABLE `revision10`
  MODIFY `IdRevision10` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `revision11`
--
ALTER TABLE `revision11`
  MODIFY `IdRevision11` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `revision12`
--
ALTER TABLE `revision12`
  MODIFY `IdRevision12` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD CONSTRAINT `proyecto_ibfk_1` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`);

--
-- Filtros para la tabla `requerimiento`
--
ALTER TABLE `requerimiento`
  ADD CONSTRAINT `requerimiento_ibfk_1` FOREIGN KEY (`IdProyecto`) REFERENCES `proyecto` (`IdProyecto`);

--
-- Filtros para la tabla `revision1`
--
ALTER TABLE `revision1`
  ADD CONSTRAINT `revision1_ibfk_1` FOREIGN KEY (`IdRequerimiento`) REFERENCES `requerimiento` (`IdRequerimiento`);

--
-- Filtros para la tabla `revision2`
--
ALTER TABLE `revision2`
  ADD CONSTRAINT `revision2_ibfk_1` FOREIGN KEY (`IdRequerimiento`) REFERENCES `requerimiento` (`IdRequerimiento`);

--
-- Filtros para la tabla `revision3`
--
ALTER TABLE `revision3`
  ADD CONSTRAINT `revision3_ibfk_1` FOREIGN KEY (`IdRequerimiento`) REFERENCES `requerimiento` (`IdRequerimiento`);

--
-- Filtros para la tabla `revision4`
--
ALTER TABLE `revision4`
  ADD CONSTRAINT `revision4_ibfk_1` FOREIGN KEY (`IdRequerimiento`) REFERENCES `requerimiento` (`IdRequerimiento`);

--
-- Filtros para la tabla `revision5`
--
ALTER TABLE `revision5`
  ADD CONSTRAINT `revision5_ibfk_1` FOREIGN KEY (`IdRequerimiento`) REFERENCES `requerimiento` (`IdRequerimiento`);

--
-- Filtros para la tabla `revision6`
--
ALTER TABLE `revision6`
  ADD CONSTRAINT `revision6_ibfk_1` FOREIGN KEY (`IdRequerimiento`) REFERENCES `requerimiento` (`IdRequerimiento`);

--
-- Filtros para la tabla `revision7`
--
ALTER TABLE `revision7`
  ADD CONSTRAINT `revision7_ibfk_1` FOREIGN KEY (`IdRequerimiento`) REFERENCES `requerimiento` (`IdRequerimiento`);

--
-- Filtros para la tabla `revision8`
--
ALTER TABLE `revision8`
  ADD CONSTRAINT `revision8_ibfk_1` FOREIGN KEY (`IdRequerimiento`) REFERENCES `requerimiento` (`IdRequerimiento`);

--
-- Filtros para la tabla `revision9`
--
ALTER TABLE `revision9`
  ADD CONSTRAINT `revision9_ibfk_1` FOREIGN KEY (`IdRequerimiento`) REFERENCES `requerimiento` (`IdRequerimiento`);

--
-- Filtros para la tabla `revision10`
--
ALTER TABLE `revision10`
  ADD CONSTRAINT `revision10_ibfk_1` FOREIGN KEY (`IdRequerimiento`) REFERENCES `requerimiento` (`IdRequerimiento`);

--
-- Filtros para la tabla `revision11`
--
ALTER TABLE `revision11`
  ADD CONSTRAINT `revision11_ibfk_1` FOREIGN KEY (`IdRequerimiento`) REFERENCES `requerimiento` (`IdRequerimiento`);

--
-- Filtros para la tabla `revision12`
--
ALTER TABLE `revision12`
  ADD CONSTRAINT `revision12_ibfk_1` FOREIGN KEY (`IdRequerimiento`) REFERENCES `requerimiento` (`IdRequerimiento`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
