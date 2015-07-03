-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 01-07-2015 a las 17:40:33
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `prueba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE IF NOT EXISTS `persona` (
  `N_identidad` varchar(20) NOT NULL,
  `Primer_nombre` varchar(20) NOT NULL,
  `Segundo_nombre` varchar(20) DEFAULT NULL,
  `Primer_apellido` varchar(45) NOT NULL,
  `Segundo_apellido` varchar(20) DEFAULT NULL,
  `Fecha_nacimiento` date NOT NULL,
  `Sexo` varchar(1) DEFAULT NULL,
  `Direccion` varchar(300) NOT NULL,
  `Correo_electronico` varchar(40) DEFAULT NULL,
  `Estado_Civil` varchar(15) DEFAULT NULL,
  `Nacionalidad` varchar(20) NOT NULL,
  `foto_perfil` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`N_identidad`, `Primer_nombre`, `Segundo_nombre`, `Primer_apellido`, `Segundo_apellido`, `Fecha_nacimiento`, `Sexo`, `Direccion`, `Correo_electronico`, `Estado_Civil`, `Nacionalidad`, `foto_perfil`) VALUES
('0000-0000-00000', 'Prueba', 'Prueba', 'Prueba', 'Prueba', '2015-03-29', 'M', 'prueba', 'prueba@prueba.com', 'soltero', 'prueba', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `rol_ID` int(2) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`rol_ID`, `descripcion`) VALUES
(0, 'internos'),
(1, 'administrador'),
(2, 'Jefe de Sala'),
(3, 'Residente'),
(4, 'interno'),
(5, 'enfermera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(256) NOT NULL,
  `rol_ID` int(2) NOT NULL,
  `usuario_ID` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_alta` date DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `Logeado` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario`, `contrasena`, `rol_ID`, `usuario_ID`, `fecha_creacion`, `fecha_alta`, `estado`, `Logeado`) VALUES
('pedro', '4', 2, 3, '0000-00-00', NULL, 0, 0),
('pineda1234', '$2a$07$7PqV8qgy4K9toN3aiWoOueysZN8SOCoL.62VauwPTx7rPA4t46jRW', 1, 8, '2015-06-25', NULL, 1, 1),
('Arle2', '$2a$07$LqmyTQCJu1b.MhuPo/.wRuA8kcM2axSlqx4Aa3HC0EBRaVVoN7TH.', 1, 11, '2015-06-27', NULL, 0, 0),
('Arle2', '$2a$07$QDet8H8GLtGDFsDsi1FBHu7/rD19MQyOcxSfDBsXphHyDnG.NcLoy', 1, 12, '2015-06-27', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_logs`
--

CREATE TABLE IF NOT EXISTS `usuario_logs` (
  `id_logs` int(11) NOT NULL,
  `usuario_log` varchar(25) NOT NULL,
  `fecha_ingreso` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_salida` datetime NOT NULL,
  `ip_conexion` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario_logs`
--

INSERT INTO `usuario_logs` (`id_logs`, `usuario_log`, `fecha_ingreso`, `fecha_salida`, `ip_conexion`) VALUES
(1, 'pineda1234', '2015-06-26 23:55:30', '2015-06-27 16:15:00', ':192.168'),
(2, 'pineda1234', '2015-06-26 23:55:43', '2015-06-27 16:15:00', ':192.168'),
(3, 'pineda1234', '2015-06-27 00:20:46', '2015-06-28 08:19:11', '192.168.0.1'),
(4, '', '2015-04-27 00:28:47', '0000-00-00 00:00:00', '127.0.0.1'),
(5, '', '2015-03-27 00:29:40', '0000-00-00 00:00:00', '127.0.0.1'),
(7, 'pineda1234', '2015-06-27 00:31:18', '0000-00-00 00:00:00', '127.0.0.1'),
(8, 'pineda1234', '2015-06-27 00:33:00', '0000-00-00 00:00:00', '127.0.0.1'),
(9, 'pineda1234', '2015-06-27 07:49:51', '0000-00-00 00:00:00', '127.0.0.1'),
(10, 'pineda1234', '2015-06-27 16:06:01', '0000-00-00 00:00:00', '::1'),
(11, 'pineda1234', '2015-06-27 20:33:48', '0000-00-00 00:00:00', '::1'),
(12, '', '2015-05-27 20:44:23', '0000-00-00 00:00:00', '::1'),
(13, 'pineda1234', '2015-03-27 22:23:07', '0000-00-00 00:00:00', '::1'),
(14, 'pineda1234', '2015-06-27 23:27:34', '0000-00-00 00:00:00', '::1'),
(15, 'pineda1234', '2015-02-27 23:27:55', '0000-00-00 00:00:00', '::1'),
(16, 'pineda1234', '2015-01-29 06:42:39', '0000-00-00 00:00:00', '::1'),
(17, 'pineda1234', '2015-06-29 07:06:43', '0000-00-00 00:00:00', '::1'),
(18, 'pineda1234', '2015-06-29 07:07:03', '0000-00-00 00:00:00', '::1'),
(19, 'pineda1234', '2015-06-29 07:07:25', '0000-00-00 00:00:00', '::1'),
(20, 'pineda1234', '2015-06-29 07:10:27', '0000-00-00 00:00:00', '::1'),
(21, 'Axel Herrera', '2015-06-29 07:11:24', '0000-00-00 00:00:00', '::1'),
(22, 'pineda1234', '2015-06-29 07:26:56', '0000-00-00 00:00:00', '::1'),
(23, 'pineda1234', '2015-06-29 07:50:26', '0000-00-00 00:00:00', '::1'),
(24, 'pineda1234', '2015-06-29 09:56:04', '0000-00-00 00:00:00', '::1'),
(25, 'pineda1234', '2015-06-29 09:58:35', '0000-00-00 00:00:00', '::1'),
(26, 'pineda1234', '2015-06-29 10:48:06', '0000-00-00 00:00:00', '::1'),
(27, 'pineda1234', '2015-06-29 11:50:11', '0000-00-00 00:00:00', '::1'),
(28, 'pineda1234', '2015-06-29 12:08:13', '0000-00-00 00:00:00', '::1'),
(29, 'pineda1234', '2015-06-29 12:11:52', '0000-00-00 00:00:00', '::1'),
(30, 'pineda1234', '2015-06-29 12:12:20', '0000-00-00 00:00:00', '::1'),
(31, 'pineda1234', '2015-06-29 12:16:00', '0000-00-00 00:00:00', '::1'),
(32, 'pineda1234', '2015-06-29 12:23:52', '0000-00-00 00:00:00', '::1'),
(33, 'pineda1234', '2015-06-29 13:00:08', '0000-00-00 00:00:00', '::1'),
(34, 'pineda1234', '2015-06-29 13:00:34', '0000-00-00 00:00:00', '::1'),
(35, 'pineda1234', '2015-06-29 13:07:20', '0000-00-00 00:00:00', '::1'),
(36, 'pineda1234', '2015-06-29 13:11:43', '0000-00-00 00:00:00', '192.168.43.1'),
(37, 'pineda1234', '2015-06-29 14:22:01', '0000-00-00 00:00:00', '::1'),
(38, 'pineda1234', '2015-06-29 14:23:21', '0000-00-00 00:00:00', '::1'),
(39, 'pineda1234', '2015-06-29 14:23:32', '0000-00-00 00:00:00', '::1'),
(40, 'pineda1234', '2015-06-29 14:34:41', '0000-00-00 00:00:00', '::1'),
(41, 'pineda1234', '2015-06-29 14:37:01', '0000-00-00 00:00:00', '::1'),
(42, 'pineda1234', '2015-06-29 14:40:21', '0000-00-00 00:00:00', '::1'),
(43, 'pineda1234', '2015-06-29 14:40:30', '0000-00-00 00:00:00', '::1'),
(44, 'pineda1234', '2015-06-29 14:40:50', '0000-00-00 00:00:00', '::1'),
(45, 'pineda1234', '2015-06-29 14:41:19', '0000-00-00 00:00:00', '::1'),
(46, 'pineda1234', '2015-06-29 18:56:41', '0000-00-00 00:00:00', '::1'),
(47, 'pineda1234', '2015-06-29 18:56:46', '0000-00-00 00:00:00', '::1'),
(48, 'pineda1234', '2015-06-30 07:20:49', '0000-00-00 00:00:00', '::1'),
(49, 'pineda1234', '2015-06-30 13:23:55', '0000-00-00 00:00:00', '::1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol_ID`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_ID`),
  ADD KEY `FK_usuario_rol` (`rol_ID`);

--
-- Indices de la tabla `usuario_logs`
--
ALTER TABLE `usuario_logs`
  ADD PRIMARY KEY (`id_logs`),
  ADD KEY `usuario_log` (`usuario_log`),
  ADD KEY `usuario_log_2` (`usuario_log`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `usuario_logs`
--
ALTER TABLE `usuario_logs`
  MODIFY `id_logs` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_usuario_rol` FOREIGN KEY (`rol_ID`) REFERENCES `rol` (`rol_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
