-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-01-2022 a las 09:38:46
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `covidcitas_reto`
--
CREATE DATABASE IF NOT EXISTS `covidcitas_reto` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `covidcitas_reto`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centros`
--

CREATE TABLE `centros` (
  `cod_centro` int(50) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Municipio` varchar(50) NOT NULL,
  `Hora_apertura` time NOT NULL,
  `Hora_cierre` time NOT NULL,
  `Lunes` text NOT NULL,
  `Martes` text NOT NULL,
  `Miercoles` text NOT NULL,
  `Jueves` text NOT NULL,
  `Viernes` text NOT NULL,
  `Sabado` text NOT NULL,
  `Domingo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `centros`
--

INSERT INTO `centros` (`cod_centro`, `Nombre`, `Municipio`, `Hora_apertura`, `Hora_cierre`, `Lunes`, `Martes`, `Miercoles`, `Jueves`, `Viernes`, `Sabado`, `Domingo`) VALUES
(0, 'Centro de salud Gernika', 'Gernika', '08:00:00', '20:00:00', '', '', '', '', '', '', ''),
(1, 'Centro de salud Amorebieta-Etxano', 'Amorebieta-Etxano', '08:00:00', '20:00:00', '', '', '', '', '', '', ''),
(2, 'Centro de Salud de Durango-Landako', 'Durango', '08:00:00', '20:00:00', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `cod_cita` int(50) NOT NULL,
  `Fecha` date NOT NULL,
  `Horas` time(4) NOT NULL,
  `Tipo_vacuna` varchar(50) NOT NULL,
  `cod_centro` int(50) NOT NULL,
  `TIS` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`cod_cita`, `Fecha`, `Horas`, `Tipo_vacuna`, `cod_centro`, `TIS`) VALUES
(1, '2022-01-20', '10:15:00.0000', 'Pfizer', 2, 2328241),
(2, '2022-01-17', '13:00:00.0000', 'AstraZeneca', 1, 6237435),
(3, '2022-02-16', '09:30:00.0000', 'Moderna', 0, 7302170);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `cod_historial` int(55) NOT NULL,
  `Tipo` varchar(50) NOT NULL,
  `Num_Dosis` int(50) NOT NULL,
  `Fecha` date NOT NULL,
  `TIS` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`cod_historial`, `Tipo`, `Num_Dosis`, `Fecha`, `TIS`) VALUES
(1, 'Janssen', 1, '2021-12-02', 6237435);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `TIS` int(8) NOT NULL,
  `Fecha_PCR_pos` date DEFAULT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `Nombre` text NOT NULL,
  `Apellido` text NOT NULL,
  `Edad` int(50) NOT NULL,
  `cod_centro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`TIS`, `Fecha_PCR_pos`, `Fecha_Nacimiento`, `Nombre`, `Apellido`, `Edad`, `cod_centro`) VALUES
(2328241, NULL, '2001-09-11', 'Kevin', 'Stevens-addo', 20, 1),
(6237435, NULL, '2015-01-10', 'John', 'Johnson', 6, 2),
(7302170, '2021-11-15', '2006-04-12', 'James', 'Jameson', 15, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `cod_usuarios` int(50) NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `Contraseña` varchar(50) NOT NULL,
  `Tipo` varchar(50) NOT NULL,
  `cod_centro` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`cod_usuarios`, `Correo`, `Contraseña`, `Tipo`, `cod_centro`) VALUES
(1, 'fake_email@yahoo.com', 'contraseña', '', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `centros`
--
ALTER TABLE `centros`
  ADD PRIMARY KEY (`cod_centro`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`cod_cita`),
  ADD UNIQUE KEY `cod_centro` (`cod_centro`),
  ADD UNIQUE KEY `TIS` (`TIS`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`cod_historial`),
  ADD UNIQUE KEY `cod_paciente` (`TIS`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`TIS`),
  ADD UNIQUE KEY `cod_centro` (`cod_centro`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cod_usuarios`),
  ADD UNIQUE KEY `cod_centro` (`cod_centro`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `cod_cita` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `cod_historial` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `cod_usuarios` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`TIS`) REFERENCES `pacientes` (`TIS`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `historial_ibfk_1` FOREIGN KEY (`TIS`) REFERENCES `pacientes` (`TIS`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `pacientes_ibfk_1` FOREIGN KEY (`cod_centro`) REFERENCES `centros` (`cod_centro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`cod_centro`) REFERENCES `centros` (`cod_centro`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
