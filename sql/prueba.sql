-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-07-2015 a las 07:09:15
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

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Log_ID`(OUT `ID` INT(10) UNSIGNED, IN `usuario_log` VARCHAR(25), IN `fecha_ingreso` DATE, IN `ip_conexion` VARCHAR(40))
    NO SQL
    DETERMINISTIC
INSERT into usuario_logs (id_logs,usuario_log,fecha_ingreso,ip_conexion)VALUES(1,@usuario_log,@fecha_ingreso,@ip_conexion)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INSERTAR_LOG`(
    IN IPCONG VARCHAR(40),
    IN USER_LOG VARCHAR(25), 
    OUT `ULTIMOID` INT(11))
BEGIN 

   START TRANSACTION;
   
   INSERT INTO usuario_logs ( usuario_log, fecha_ingreso, ip_conexion) VALUES ( USER_LOG, CURRENT_TIMESTAMP, IPCONG);
 
     SET ULTIMOID = last_insert_id(); 
   
   COMMIT;
END$$

DELIMITER ;

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario`, `contrasena`, `rol_ID`, `usuario_ID`, `fecha_creacion`, `fecha_alta`, `estado`, `Logeado`) VALUES
('pineda1234', '$2a$07$7PqV8qgy4K9toN3aiWoOueysZN8SOCoL.62VauwPTx7rPA4t46jRW', 1, 8, '2015-06-25', NULL, 1, 1),
('Arleandino', '$2a$07$.TYyvGoiHPP/jA0drgfN0e5hIfwd965he8El1tVxSe2r0VLaiCIr6', 5, 11, '2015-06-27', '2015-07-08', 0, 0),
('Arle Reyes', '$2a$07$p550WnRYfbI4VCVyZ.QZO.Zpwh5ST6j9Xk1Adca8WvHPvxecnDYuO', 5, 12, '2015-06-27', '2015-07-08', 0, 0),
('hllanos', '$2a$07$TX1seqOwkG76jFPKlLpZe.3ajaLKclf0jzCSMfYXQOfGy0sM4Gyeu', 1, 16, '2015-07-06', '0000-00-00', 1, 0),
('hectorllanos', '$2a$07$88EXV6GmXGpYLoHx402l5OfhbaYXnqZ87pohRJNxHu1kIEx5WOYVm', 5, 17, '2015-07-08', '2015-07-08', 0, 0),
('prueba', '$2a$07$85JeqXKUI2z23IgA7bamaeCSr30hAq/EolgnIwfxL2t2YmFcys3au', 2, 18, '2015-07-08', NULL, 0, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=222 DEFAULT CHARSET=latin1;

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
(49, 'pineda1234', '2015-06-30 13:23:55', '0000-00-00 00:00:00', '::1'),
(50, 'pineda1234', '2015-07-01 10:38:56', '0000-00-00 00:00:00', '127.0.0.1'),
(51, 'pineda1234', '2015-07-01 11:05:28', '0000-00-00 00:00:00', '127.0.0.1'),
(52, 'pineda1234', '2015-07-01 11:07:00', '0000-00-00 00:00:00', '127.0.0.1'),
(53, 'pineda1234', '2015-07-01 11:07:59', '0000-00-00 00:00:00', '127.0.0.1'),
(54, 'pineda1234', '2015-07-01 11:08:37', '0000-00-00 00:00:00', '127.0.0.1'),
(55, 'pineda1234', '2015-07-01 11:17:53', '0000-00-00 00:00:00', '127.0.0.1'),
(56, 'pineda1234', '2015-07-01 11:33:30', '0000-00-00 00:00:00', '127.0.0.1'),
(57, 'pineda1234', '2015-07-01 13:41:21', '0000-00-00 00:00:00', '127.0.0.1'),
(58, 'pineda1234', '2015-07-01 13:46:17', '0000-00-00 00:00:00', '127.0.0.1'),
(59, 'pineda1234', '2015-07-01 13:48:17', '0000-00-00 00:00:00', '127.0.0.1'),
(60, 'pineda1234', '2015-07-01 13:49:00', '0000-00-00 00:00:00', '127.0.0.1'),
(61, 'pineda1234', '2015-07-01 13:52:30', '0000-00-00 00:00:00', '127.0.0.1'),
(62, 'pineda1234', '2015-07-01 13:56:27', '0000-00-00 00:00:00', '127.0.0.1'),
(63, 'pineda1234', '2015-07-01 13:57:01', '0000-00-00 00:00:00', '127.0.0.1'),
(64, 'pineda1234', '2015-07-01 14:39:53', '0000-00-00 00:00:00', '127.0.0.1'),
(65, 'pineda1234', '2015-07-01 14:44:49', '0000-00-00 00:00:00', '127.0.0.1'),
(66, 'pineda1234', '2015-07-01 14:50:15', '0000-00-00 00:00:00', '127.0.0.1'),
(67, 'pineda1234', '2015-07-01 14:53:14', '0000-00-00 00:00:00', '127.0.0.1'),
(68, 'pineda1234', '2015-07-01 14:53:38', '0000-00-00 00:00:00', '127.0.0.1'),
(69, 'pineda1234', '2015-07-01 15:02:06', '0000-00-00 00:00:00', '127.0.0.1'),
(70, 'pineda1234', '2015-07-01 15:27:51', '0000-00-00 00:00:00', '127.0.0.1'),
(71, 'pineda1234', '2015-07-01 15:30:24', '0000-00-00 00:00:00', '127.0.0.1'),
(72, 'pineda1234', '2015-07-01 15:34:54', '0000-00-00 00:00:00', '127.0.0.1'),
(73, 'pineda1234', '2015-07-01 15:39:09', '0000-00-00 00:00:00', '127.0.0.1'),
(74, 'pineda1234', '2015-07-01 15:46:14', '0000-00-00 00:00:00', '127.0.0.1'),
(75, 'pineda1234', '2015-07-01 15:48:32', '0000-00-00 00:00:00', '127.0.0.1'),
(76, 'pineda1234', '2015-07-01 15:51:46', '0000-00-00 00:00:00', '127.0.0.1'),
(77, 'pineda1234', '2015-07-01 16:01:52', '0000-00-00 00:00:00', '127.0.0.1'),
(78, 'pineda1234', '2015-07-01 16:06:19', '0000-00-00 00:00:00', '127.0.0.1'),
(79, 'pineda1234', '2015-07-01 16:08:33', '0000-00-00 00:00:00', '127.0.0.1'),
(80, 'pineda1234', '2015-07-01 16:10:23', '0000-00-00 00:00:00', '127.0.0.1'),
(81, 'pineda1234', '2015-07-01 19:36:37', '0000-00-00 00:00:00', '127.0.0.1'),
(82, 'pineda1234', '2015-07-01 20:28:25', '0000-00-00 00:00:00', '127.0.0.1'),
(83, 'pineda1234', '2015-07-01 20:57:36', '0000-00-00 00:00:00', '127.0.0.1'),
(84, 'pineda1234', '2015-07-01 22:57:12', '0000-00-00 00:00:00', '127.0.0.1'),
(85, 'pineda1234', '2015-07-01 23:02:07', '0000-00-00 00:00:00', '127.0.0.1'),
(86, 'pineda1234', '2015-07-01 23:02:35', '0000-00-00 00:00:00', '127.0.0.1'),
(87, 'pineda1234', '2015-07-01 23:03:46', '0000-00-00 00:00:00', '127.0.0.1'),
(88, 'pineda1234', '2015-07-01 23:10:38', '0000-00-00 00:00:00', '127.0.0.1'),
(89, 'pineda1234', '2015-07-02 22:11:30', '0000-00-00 00:00:00', '127.0.0.1'),
(90, 'pineda1234', '2015-07-03 00:42:08', '0000-00-00 00:00:00', '127.0.0.1'),
(91, 'pineda1234', '2015-07-03 13:14:53', '0000-00-00 00:00:00', '127.0.0.1'),
(92, 'pineda1234', '2015-07-03 13:20:43', '0000-00-00 00:00:00', '127.0.0.1'),
(93, 'pineda1234', '2015-07-03 13:35:08', '0000-00-00 00:00:00', '127.0.0.1'),
(94, 'pineda1234', '2015-07-03 13:36:13', '0000-00-00 00:00:00', '127.0.0.1'),
(95, 'pineda1234', '2015-07-03 13:37:50', '0000-00-00 00:00:00', '127.0.0.1'),
(96, 'pineda1234', '2015-07-04 14:25:13', '0000-00-00 00:00:00', '127.0.0.1'),
(97, 'pineda1234', '2015-07-05 12:50:46', '0000-00-00 00:00:00', '127.0.0.1'),
(98, 'pineda1234', '2015-07-05 13:13:14', '0000-00-00 00:00:00', '127.0.0.1'),
(99, 'pineda1234', '2015-07-05 13:13:37', '0000-00-00 00:00:00', '127.0.0.1'),
(100, 'pineda1234', '2015-07-05 13:13:58', '0000-00-00 00:00:00', '127.0.0.1'),
(101, 'pineda1234', '2015-07-05 15:37:00', '0000-00-00 00:00:00', '127.0.0.1'),
(102, 'pineda1234', '2015-07-05 15:37:50', '0000-00-00 00:00:00', '127.0.0.1'),
(103, 'pineda1234', '2015-07-05 15:39:59', '0000-00-00 00:00:00', '127.0.0.1'),
(104, 'pineda1234', '2015-07-05 15:48:30', '0000-00-00 00:00:00', '127.0.0.1'),
(105, 'pineda1234', '2015-07-05 15:50:46', '0000-00-00 00:00:00', '127.0.0.1'),
(106, 'pineda1234', '2015-07-05 15:51:35', '0000-00-00 00:00:00', '127.0.0.1'),
(107, 'pineda1234', '2015-07-05 15:54:37', '0000-00-00 00:00:00', '127.0.0.1'),
(108, 'pineda1234', '2015-07-05 15:55:32', '0000-00-00 00:00:00', '127.0.0.1'),
(109, 'pineda1234', '2015-07-05 16:12:14', '0000-00-00 00:00:00', '127.0.0.1'),
(110, 'pineda1234', '2015-07-05 16:40:20', '0000-00-00 00:00:00', '127.0.0.1'),
(111, 'pineda1234', '2015-07-05 16:43:28', '0000-00-00 00:00:00', '127.0.0.1'),
(112, 'pineda1234', '2015-07-05 16:48:47', '0000-00-00 00:00:00', '127.0.0.1'),
(113, 'hllanos', '2015-07-05 16:49:40', '0000-00-00 00:00:00', '127.0.0.1'),
(114, 'pineda1234', '2015-07-05 21:29:20', '0000-00-00 00:00:00', '127.0.0.1'),
(115, 'hllanos', '2015-07-05 21:47:48', '0000-00-00 00:00:00', '127.0.0.1'),
(116, 'hllanos', '2015-07-05 22:06:46', '0000-00-00 00:00:00', '127.0.0.1'),
(117, 'pineda1234', '2015-07-06 09:54:51', '0000-00-00 00:00:00', '127.0.0.1'),
(118, 'pineda1234', '2015-07-06 09:55:11', '0000-00-00 00:00:00', '127.0.0.1'),
(119, 'pineda1234', '2015-07-06 23:13:34', '0000-00-00 00:00:00', '127.0.0.1'),
(120, 'pineda1234', '2015-07-07 00:21:49', '0000-00-00 00:00:00', '127.0.0.1'),
(121, 'hllanos', '2015-07-07 00:23:10', '0000-00-00 00:00:00', '127.0.0.1'),
(122, 'pineda1234', '2015-07-07 00:27:54', '0000-00-00 00:00:00', '127.0.0.1'),
(123, 'pineda1234', '2015-07-07 00:28:13', '0000-00-00 00:00:00', '127.0.0.1'),
(124, 'pineda1234', '2015-07-07 11:13:58', '0000-00-00 00:00:00', '127.0.0.1'),
(125, 'hllanos', '2015-07-07 11:52:48', '0000-00-00 00:00:00', '127.0.0.1'),
(126, 'hllanos', '2015-07-07 12:14:32', '0000-00-00 00:00:00', '127.0.0.1'),
(127, 'pineda1234', '2015-07-07 12:25:12', '0000-00-00 00:00:00', '127.0.0.1'),
(128, 'pineda1234', '2015-07-07 12:36:03', '0000-00-00 00:00:00', '127.0.0.1'),
(129, 'pineda1234', '2015-07-07 12:59:05', '0000-00-00 00:00:00', '127.0.0.1'),
(130, 'pineda1234', '2015-07-07 13:00:23', '0000-00-00 00:00:00', '127.0.0.1'),
(131, 'hllanos', '2015-07-07 13:51:47', '0000-00-00 00:00:00', '127.0.0.1'),
(132, 'pineda1234', '2015-07-07 14:01:53', '0000-00-00 00:00:00', '127.0.0.1'),
(133, 'pineda1234', '2015-07-07 14:27:47', '0000-00-00 00:00:00', '127.0.0.1'),
(134, 'pineda1234', '2015-07-07 15:20:17', '0000-00-00 00:00:00', '127.0.0.1'),
(135, 'pineda1234', '2015-07-07 15:22:25', '0000-00-00 00:00:00', '127.0.0.1'),
(136, 'pineda1234', '2015-07-07 16:28:09', '0000-00-00 00:00:00', '127.0.0.1'),
(137, 'pineda1234', '2015-07-07 16:51:15', '0000-00-00 00:00:00', '127.0.0.1'),
(138, 'pineda1234', '2015-07-07 16:53:54', '0000-00-00 00:00:00', '127.0.0.1'),
(139, 'pineda1234', '2015-07-07 17:04:59', '0000-00-00 00:00:00', '127.0.0.1'),
(140, 'hllanos', '2015-07-07 17:10:27', '0000-00-00 00:00:00', '127.0.0.1'),
(141, 'pineda1234', '2015-07-08 10:53:49', '0000-00-00 00:00:00', '127.0.0.1'),
(142, 'hllanos', '2015-07-08 13:54:41', '0000-00-00 00:00:00', '127.0.0.1'),
(143, 'hllanos', '2015-07-08 14:07:16', '0000-00-00 00:00:00', '127.0.0.1'),
(144, 'hllanos', '2015-07-08 14:25:59', '0000-00-00 00:00:00', '127.0.0.1'),
(145, 'hllanos', '2015-07-08 21:27:45', '0000-00-00 00:00:00', '127.0.0.1'),
(146, 'hllanos', '2015-07-08 22:12:20', '0000-00-00 00:00:00', '127.0.0.1'),
(147, 'hllanos', '2015-07-09 00:46:04', '0000-00-00 00:00:00', '127.0.0.1'),
(148, 'hllanos', '2015-07-09 00:47:02', '0000-00-00 00:00:00', '127.0.0.1'),
(149, 'hllanos', '2015-07-09 00:47:36', '0000-00-00 00:00:00', '127.0.0.1'),
(150, 'hllanos', '2015-07-09 00:47:49', '0000-00-00 00:00:00', '127.0.0.1'),
(151, 'hllanos', '2015-07-09 00:48:11', '0000-00-00 00:00:00', '127.0.0.1'),
(152, 'pineda1234', '2015-07-12 09:58:23', '0000-00-00 00:00:00', '::1'),
(153, 'pineda1234', '2015-07-12 10:03:59', '0000-00-00 00:00:00', '::1'),
(154, 'hllanos', '2015-07-12 10:07:44', '0000-00-00 00:00:00', '192.168.0.14'),
(155, 'pineda1234', '2015-07-12 10:23:31', '0000-00-00 00:00:00', '::1'),
(156, 'pineda1234', '2015-07-12 10:24:48', '0000-00-00 00:00:00', '::1'),
(157, 'pineda1234', '2015-07-12 10:25:52', '0000-00-00 00:00:00', '::1'),
(158, 'pineda1234', '2015-07-12 10:26:20', '0000-00-00 00:00:00', '::1'),
(159, 'pineda1234', '2015-07-12 10:31:38', '0000-00-00 00:00:00', '::1'),
(160, 'pineda1234', '2015-07-12 10:50:52', '0000-00-00 00:00:00', '::1'),
(161, 'pineda1234', '2015-07-12 10:50:57', '0000-00-00 00:00:00', '::1'),
(162, 'pineda1234', '2015-07-12 10:51:26', '0000-00-00 00:00:00', '::1'),
(163, 'pineda1234', '2015-07-12 10:54:13', '0000-00-00 00:00:00', '::1'),
(164, 'pineda1234', '2015-07-12 10:56:03', '0000-00-00 00:00:00', '::1'),
(165, 'pineda1234', '2015-07-12 11:51:39', '0000-00-00 00:00:00', '192.168.0.12'),
(166, 'pineda1234', '2015-07-12 13:05:57', '0000-00-00 00:00:00', '192.168.0.15'),
(167, 'hllanos', '2015-07-12 14:55:11', '0000-00-00 00:00:00', '::1'),
(168, 'pineda1234', '2015-07-12 18:07:58', '0000-00-00 00:00:00', '::1'),
(169, 'pineda1234', '2015-07-12 18:18:04', '0000-00-00 00:00:00', '::1'),
(170, 'pineda1234', '2015-07-12 18:18:31', '0000-00-00 00:00:00', '::1'),
(171, 'pineda1234', '2015-07-12 18:20:07', '0000-00-00 00:00:00', '::1'),
(172, 'pineda1234', '2015-07-12 18:21:05', '0000-00-00 00:00:00', '::1'),
(173, 'pineda1234', '2015-07-12 18:21:47', '0000-00-00 00:00:00', '::1'),
(174, 'pineda1234', '2015-07-12 18:22:19', '0000-00-00 00:00:00', '::1'),
(175, 'pineda1234', '2015-07-12 18:22:37', '0000-00-00 00:00:00', '::1'),
(176, 'pineda1234', '2015-07-12 18:24:09', '0000-00-00 00:00:00', '::1'),
(177, 'pineda1234', '2015-07-12 18:25:44', '0000-00-00 00:00:00', '::1'),
(182, 'pineda1234', '2015-07-12 21:00:47', '0000-00-00 00:00:00', '::1'),
(183, 'pineda1234', '2015-07-12 21:07:35', '0000-00-00 00:00:00', '::1'),
(184, 'pineda1234', '2015-07-12 21:09:29', '2015-07-12 21:09:31', '::1'),
(185, 'pineda1234', '2015-07-12 21:09:42', '2015-07-12 21:10:37', '::1'),
(186, 'pineda1234', '2015-07-12 21:10:41', '0000-00-00 00:00:00', '::1'),
(187, 'pineda1234', '2015-07-12 21:12:07', '0000-00-00 00:00:00', '::1'),
(188, 'pineda1234', '2015-07-12 21:51:15', '0000-00-00 00:00:00', '::1'),
(189, 'pineda1234', '2015-07-12 22:05:36', '0000-00-00 00:00:00', '::1'),
(190, 'pineda1234', '2015-07-12 22:08:14', '2015-07-12 22:08:37', '::1'),
(191, 'pineda1234', '2015-07-12 22:08:42', '0000-00-00 00:00:00', '::1'),
(192, 'pineda1234', '2015-07-12 22:09:20', '2015-07-12 22:10:07', '::1'),
(193, 'pineda1234', '2015-07-12 22:10:11', '0000-00-00 00:00:00', '::1'),
(194, 'pineda1234', '2015-07-12 22:11:45', '0000-00-00 00:00:00', '::1'),
(195, 'pineda1234', '2015-07-12 22:13:17', '0000-00-00 00:00:00', '::1'),
(196, 'pineda1234', '2015-07-12 22:13:37', '0000-00-00 00:00:00', '::1'),
(197, 'pineda1234', '2015-07-12 22:14:21', '0000-00-00 00:00:00', '::1'),
(198, 'pineda1234', '2015-07-12 22:14:54', '0000-00-00 00:00:00', '::1'),
(199, 'pineda1234', '2015-07-12 22:16:06', '0000-00-00 00:00:00', '::1'),
(200, 'pineda1234', '2015-07-12 22:16:42', '2015-07-12 22:16:56', '::1'),
(201, 'pineda1234', '2015-07-12 22:17:03', '2015-07-12 22:17:21', '::1'),
(202, 'pineda1234', '2015-07-12 22:19:24', '0000-00-00 00:00:00', '::1'),
(203, 'pineda1234', '2015-07-12 22:19:58', '0000-00-00 00:00:00', '::1'),
(204, 'pineda1234', '2015-07-12 22:21:42', '2015-07-12 22:21:59', '::1'),
(205, 'pineda1234', '2015-07-12 22:22:04', '0000-00-00 00:00:00', '::1'),
(206, 'pineda1234', '2015-07-12 22:22:41', '0000-00-00 00:00:00', '::1'),
(207, 'pineda1234', '2015-07-12 22:26:47', '2015-07-12 22:27:26', '::1'),
(208, 'pineda1234', '2015-07-12 22:34:09', '2015-07-12 22:34:30', '::1'),
(209, 'pineda1234', '2015-07-12 22:35:30', '2015-07-12 22:35:34', '::1'),
(210, 'pineda1234', '2015-07-12 22:36:17', '2015-07-12 22:36:38', '::1'),
(211, 'pineda1234', '2015-07-12 22:36:59', '2015-07-12 22:37:01', '::1'),
(212, 'pineda1234', '2015-07-12 22:37:06', '2015-07-12 22:37:38', '::1'),
(213, 'pineda1234', '2015-07-12 22:43:14', '2015-07-12 22:43:23', '::1'),
(214, 'pineda1234', '2015-07-12 22:43:58', '0000-00-00 00:00:00', '::1'),
(215, 'pineda1234', '2015-07-12 23:00:04', '0000-00-00 00:00:00', '::1'),
(216, 'pineda1234', '2015-07-12 23:00:30', '0000-00-00 00:00:00', '::1'),
(217, 'pineda1234', '2015-07-12 23:01:04', '0000-00-00 00:00:00', '::1'),
(218, 'pineda1234', '2015-07-12 23:01:27', '0000-00-00 00:00:00', '::1'),
(219, 'pineda1234', '2015-07-12 23:04:23', '0000-00-00 00:00:00', '::1'),
(220, 'pineda1234', '2015-07-12 23:04:45', '2015-07-12 23:04:49', '::1'),
(221, 'pineda1234', '2015-07-12 23:04:54', '0000-00-00 00:00:00', '::1');

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
  ADD PRIMARY KEY (`usuario_ID`), ADD KEY `FK_usuario_rol` (`rol_ID`);

--
-- Indices de la tabla `usuario_logs`
--
ALTER TABLE `usuario_logs`
  ADD PRIMARY KEY (`id_logs`), ADD KEY `usuario_log` (`usuario_log`), ADD KEY `usuario_log_2` (`usuario_log`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `usuario_logs`
--
ALTER TABLE `usuario_logs`
  MODIFY `id_logs` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=222;
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
