-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-01-2022 a las 20:15:12
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.2

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centros`
--

CREATE TABLE `centros` (
  `cod_centro` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Municipio` varchar(50) NOT NULL,
  `Hora_apertura` time NOT NULL,
  `Hora_cierre` time NOT NULL,
  `Lunes` tinyint(1) NOT NULL,
  `Martes` tinyint(1) NOT NULL,
  `Miercoles` tinyint(1) NOT NULL,
  `Jueves` tinyint(1) NOT NULL,
  `Viernes` tinyint(1) NOT NULL,
  `Sabado` tinyint(1) NOT NULL,
  `Domingo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `centros`
--

INSERT INTO `centros` (`cod_centro`, `Nombre`, `Municipio`, `Hora_apertura`, `Hora_cierre`, `Lunes`, `Martes`, `Miercoles`, `Jueves`, `Viernes`, `Sabado`, `Domingo`) VALUES
(1, 'Centro de salud Gernika', 'Gernika', '08:00:00', '20:00:00', 1, 1, 1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `cod_cita` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Horas` time(4) NOT NULL,
  `cod_vacuna` int(11) NOT NULL,
  `cod_centro` int(11) NOT NULL,
  `TIS` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `cod_historial` int(11) NOT NULL,
  `Tipo_vacuna` varchar(50) NOT NULL,
  `Num_Dosis` int(50) NOT NULL,
  `Fecha` date NOT NULL,
  `TIS` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `foto` longtext DEFAULT 'fotoPerfil.jpg',
  `cod_centro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`TIS`, `Fecha_PCR_pos`, `Fecha_Nacimiento`, `Nombre`, `Apellido`, `foto`, `cod_centro`) VALUES
(123, '2001-01-01', '0001-01-01', 'Aitor', 'Mugira', 'foto de perfil.png', 1),
(123456, NULL, '2001-10-07', 'Kevin', 'Stevens', 'fotoPerfil.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `cod_usuario` int(11) NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `Contrasena` varchar(50) NOT NULL,
  `cod_centro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`cod_usuario`, `Correo`, `Contrasena`, `cod_centro`) VALUES
(1, 'fake_email@yahoo.com', 'contrasena', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacunas`
--

CREATE TABLE `vacunas` (
  `cod_vacuna` int(11) NOT NULL,
  `Tipo_Vacuna` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vacunas`
--

INSERT INTO `vacunas` (`cod_vacuna`, `Tipo_Vacuna`) VALUES
(0, 'AstraZeneca '),
(1, 'Pfizer-BioNTech'),
(2, 'Moderna'),
(3, 'Janssen');

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
  ADD KEY `cod_vacuna` (`cod_vacuna`),
  ADD KEY `cod_centro` (`cod_centro`) USING BTREE,
  ADD KEY `TIS` (`TIS`) USING BTREE;

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
  ADD KEY `cod_centro` (`cod_centro`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cod_usuario`),
  ADD KEY `cod_centro` (`cod_centro`);

--
-- Indices de la tabla `vacunas`
--
ALTER TABLE `vacunas`
  ADD PRIMARY KEY (`cod_vacuna`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `centros`
--
ALTER TABLE `centros`
  MODIFY `cod_centro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `cod_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `cod_historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `cod_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`TIS`) REFERENCES `pacientes` (`TIS`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`cod_vacuna`) REFERENCES `vacunas` (`cod_vacuna`);

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `historial_ibfk_1` FOREIGN KEY (`TIS`) REFERENCES `pacientes` (`TIS`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `pacientes_ibfk_1` FOREIGN KEY (`cod_centro`) REFERENCES `centros` (`cod_centro`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`cod_centro`) REFERENCES `centros` (`cod_centro`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
