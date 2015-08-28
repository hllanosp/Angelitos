-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 28-08-2015 a las 09:05:33
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.5.24

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
CREATE DEFINER=`root`@`localhost` PROCEDURE `aumentar_STOCK`(IN `producto_ID` INT(11), IN `nombre` INT(11), IN `entrada` INT)
    NO SQL
update  i_instancia_producto set i_instancia_producto.cantidad = i_instancia_producto.cantidad + entrada where i_instancia_producto.id_producto = producto_ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Log_ID`(OUT `ID` INT(10) UNSIGNED, IN `usuario_log` VARCHAR(25), IN `fecha_ingreso` DATE, IN `ip_conexion` VARCHAR(40))
    NO SQL
    DETERMINISTIC
INSERT into usuario_logs (id_logs,usuario_log,fecha_ingreso,ip_conexion)VALUES(1,@usuario_log,@fecha_ingreso,@ip_conexion)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Reabastecer`(IN `producto_ID` INT(11), IN `entrada` INT(11), IN `usuario` VARCHAR(50))
    NO SQL
INSERT into i_entrada ( id_instancia, fecha_entrada, usuario_ID, cant_entrada)      VALUES ( producto_ID, CURRENT_TIMESTAMP, usuario, entrada)$$

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
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE IF NOT EXISTS `cargo` (
  `ID_cargo` int(11) NOT NULL,
  `Cargo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`ID_cargo`, `Cargo`) VALUES
(1, 'Administrador Principal'),
(2, 'Medico Residente '),
(3, 'Enfermera'),
(4, 'Enfermera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE IF NOT EXISTS `clases` (
  `ID_Clases` int(11) NOT NULL,
  `Clase` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases_has_experiencia_academica`
--

CREATE TABLE IF NOT EXISTS `clases_has_experiencia_academica` (
  `ID_Clases` int(11) NOT NULL,
  `ID_Experiencia_academica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento_laboral`
--

CREATE TABLE IF NOT EXISTS `departamento_laboral` (
  `Id_departamento_laboral` int(11) NOT NULL,
  `nombre_departamento` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `departamento_laboral`
--

INSERT INTO `departamento_laboral` (`Id_departamento_laboral`, `nombre_departamento`) VALUES
(0, 'Salud'),
(1, 'administrativo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE IF NOT EXISTS `empleado` (
  `No_Empleado` varchar(20) NOT NULL,
  `N_identidad` varchar(20) NOT NULL,
  `Id_departamento` int(11) NOT NULL,
  `Fecha_ingreso` date NOT NULL,
  `fecha_salida` date DEFAULT NULL,
  `Observacion` text,
  `estado_empleado` tinyint(1) DEFAULT NULL,
  `foto_perfil` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`No_Empleado`, `N_identidad`, `Id_departamento`, `Fecha_ingreso`, `fecha_salida`, `Observacion`, `estado_empleado`, `foto_perfil`) VALUES
('123', '0801-1991-17475', 1, '2015-03-11', '0000-00-00', 'jajajaja', 1, 0x6e756c6c),
('aa92', '0801-1992-06985', 1, '2015-03-11', '0000-00-00', 'holaaaaaaa', 1, 0x6e756c6c),
('flux', '0801-1991-04000', 1, '2015-03-06', '0000-00-00', 'jode', 1, 0x6e756c6c),
('lm91', '0801-1991-17475', 1, '2015-03-06', '0000-00-00', 'problemas siguiendo ordenes', 1, ''),
('mo93', '0801-1993-01722', 1, '2015-03-06', '0000-00-00', 'trabajador', 1, 0x6e756c6c);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado_has_cargo`
--

CREATE TABLE IF NOT EXISTS `empleado_has_cargo` (
  `No_Empleado` varchar(20) NOT NULL,
  `ID_cargo` int(11) NOT NULL,
  `Fecha_ingreso_cargo` date NOT NULL,
  `Fecha_salida_cargo` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudios_academico`
--

CREATE TABLE IF NOT EXISTS `estudios_academico` (
  `ID_Estudios_academico` int(11) NOT NULL,
  `Nombre_titulo` varchar(45) NOT NULL,
  `ID_Tipo_estudio` int(11) NOT NULL,
  `N_identidad` varchar(20) NOT NULL,
  `Id_universidad` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experiencia_academica`
--

CREATE TABLE IF NOT EXISTS `experiencia_academica` (
  `ID_Experiencia_academica` int(11) NOT NULL,
  `Institucion` varchar(45) NOT NULL,
  `Tiempo` int(3) NOT NULL,
  `N_identidad` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experiencia_laboral`
--

CREATE TABLE IF NOT EXISTS `experiencia_laboral` (
  `ID_Experiencia_laboral` int(11) NOT NULL,
  `Nombre_empresa` varchar(45) NOT NULL,
  `Tiempo` int(3) NOT NULL,
  `N_identidad` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experiencia_laboral_has_cargo`
--

CREATE TABLE IF NOT EXISTS `experiencia_laboral_has_cargo` (
  `ID_Experiencia_laboral` int(11) NOT NULL,
  `ID_cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `idioma`
--

CREATE TABLE IF NOT EXISTS `idioma` (
  `ID_Idioma` int(11) NOT NULL,
  `Idioma` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `idioma`
--

INSERT INTO `idioma` (`ID_Idioma`, `Idioma`) VALUES
(0, 'Portugues'),
(1, 'Frances'),
(2, 'espaÃƒÂ±ol'),
(3, 'espaÃƒÂ±ol');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `idioma_has_persona`
--

CREATE TABLE IF NOT EXISTS `idioma_has_persona` (
  `ID_Idioma` int(11) NOT NULL,
  `N_identidad` varchar(20) NOT NULL,
  `Nivel` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `i_entrada`
--

CREATE TABLE IF NOT EXISTS `i_entrada` (
  `id_instancia` int(11) DEFAULT NULL,
  `fecha_entrada` date DEFAULT NULL,
  `usuario_ID` int(11) DEFAULT NULL,
  `cant_entrada` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `i_entrada`
--

INSERT INTO `i_entrada` (`id_instancia`, `fecha_entrada`, `usuario_ID`, `cant_entrada`) VALUES
(1, '2015-08-27', 16, 100),
(2, '2015-08-27', 16, 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `i_instancia_producto`
--

CREATE TABLE IF NOT EXISTS `i_instancia_producto` (
  `id_instancia` int(11) NOT NULL,
  `fecha_exp` date DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `i_instancia_producto`
--

INSERT INTO `i_instancia_producto` (`id_instancia`, `fecha_exp`, `cantidad`, `id_producto`) VALUES
(5, '2016-01-14', 7800, 1),
(6, '2016-09-08', 5050, 2),
(7, '2015-12-10', 150, 3),
(8, '2016-06-13', 100, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `i_marca`
--

CREATE TABLE IF NOT EXISTS `i_marca` (
  `id_marca` int(11) NOT NULL,
  `descripcion` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `i_producto`
--

CREATE TABLE IF NOT EXISTS `i_producto` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `tipo_producto` int(11) DEFAULT NULL,
  `id_marca` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `i_producto`
--

INSERT INTO `i_producto` (`id_producto`, `nombre`, `tipo_producto`, `id_marca`) VALUES
(1, 'alcohol', 1, NULL),
(2, 'panales', 2, NULL),
(3, 'talco', 1, NULL),
(4, 'Leche porlvo', 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `i_salida`
--

CREATE TABLE IF NOT EXISTS `i_salida` (
  `id_instancia` int(11) DEFAULT NULL,
  `fecha_salida` date DEFAULT NULL,
  `usuario_ID` int(11) DEFAULT NULL,
  `cantidad_salida` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `i_tipo_producto`
--

CREATE TABLE IF NOT EXISTS `i_tipo_producto` (
  `id_tipo_producto` int(11) NOT NULL,
  `descripcion` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `i_tipo_producto`
--

INSERT INTO `i_tipo_producto` (`id_tipo_producto`, `descripcion`) VALUES
(1, 'Medicamento'),
(2, 'accesorios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE IF NOT EXISTS `pais` (
  `Id_pais` int(11) NOT NULL,
  `Nombre_pais` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`Id_pais`, `Nombre_pais`) VALUES
(0, 'Estados Unidos'),
(1, 'Honduras'),
(2, 'Guatemala'),
(3, 'Mexico'),
(4, 'Panama city');

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
-- Estructura de tabla para la tabla `telefono`
--

CREATE TABLE IF NOT EXISTS `telefono` (
  `ID_Telefono` int(11) NOT NULL,
  `Tipo` varchar(45) NOT NULL,
  `Numero` varchar(20) NOT NULL,
  `N_identidad` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `telefono`
--

INSERT INTO `telefono` (`ID_Telefono`, `Tipo`, `Numero`, `N_identidad`) VALUES
(0, 'Celular', '96413007', '0000-0000-00000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_area`
--

CREATE TABLE IF NOT EXISTS `tipo_area` (
  `id_Tipo_Area` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `observaciones` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_area`
--

INSERT INTO `tipo_area` (`id_Tipo_Area`, `nombre`, `observaciones`) VALUES
(1, 'exterior1', 'cara de mono'),
(3, 'pollo1', 'ffdd'),
(4, 'alksndal', 'asda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_estudio`
--

CREATE TABLE IF NOT EXISTS `tipo_estudio` (
  `ID_Tipo_estudio` int(11) NOT NULL,
  `Tipo_estudio` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_estudio`
--

INSERT INTO `tipo_estudio` (`ID_Tipo_estudio`, `Tipo_estudio`) VALUES
(0, 'Cientifico'),
(1, 'licenciatura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `titulo`
--

CREATE TABLE IF NOT EXISTS `titulo` (
  `id_titulo` int(11) NOT NULL,
  `titulo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `titulo`
--

INSERT INTO `titulo` (`id_titulo`, `titulo`) VALUES
(0, 'Medico Cirujano');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_academica`
--

CREATE TABLE IF NOT EXISTS `unidad_academica` (
  `Id_UnidadAcademica` int(11) NOT NULL,
  `NombreUnidadAcademica` text NOT NULL,
  `UbicacionUnidadAcademica` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `universidad`
--

CREATE TABLE IF NOT EXISTS `universidad` (
  `Id_universidad` int(11) NOT NULL,
  `nombre_universidad` varchar(50) NOT NULL,
  `Id_pais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `universidad`
--

INSERT INTO `universidad` (`Id_universidad`, `nombre_universidad`, `Id_pais`) VALUES
(0, 'UNITEC', 0),
(1, 'UNAH', 0),
(11, 'CATOLICA', 0),
(13, 'ceutec', 1),
(14, 'hola', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=281 DEFAULT CHARSET=latin1;

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
(221, 'pineda1234', '2015-07-12 23:04:54', '0000-00-00 00:00:00', '::1'),
(222, 'hllanos', '2015-08-27 11:47:52', '2015-08-27 11:52:23', '127.0.0.1'),
(223, 'hllanos', '2015-08-27 12:01:22', '2015-08-27 12:13:07', '127.0.0.1'),
(224, 'hllanos', '2015-08-27 12:16:52', '2015-08-27 12:32:01', '127.0.0.1'),
(225, 'hllanos', '2015-08-27 12:46:04', '2015-08-27 12:50:08', '127.0.0.1'),
(226, 'hllanos', '2015-08-27 13:06:37', '2015-08-27 13:16:32', '127.0.0.1'),
(227, 'hllanos', '2015-08-27 13:16:54', '2015-08-27 13:26:22', '127.0.0.1'),
(228, 'hllanos', '2015-08-27 13:33:45', '0000-00-00 00:00:00', '127.0.0.1'),
(229, 'hllanos', '2015-08-27 15:50:01', '0000-00-00 00:00:00', '127.0.0.1'),
(230, 'hllanos', '2015-08-27 16:49:39', '2015-08-27 16:53:51', '127.0.0.1'),
(231, 'hllanos', '2015-08-27 17:00:34', '2015-08-27 17:05:27', '127.0.0.1'),
(232, 'hllanos', '2015-08-27 17:07:08', '2015-08-27 17:14:24', '127.0.0.1'),
(233, 'hllanos', '2015-08-27 17:14:49', '0000-00-00 00:00:00', '127.0.0.1'),
(234, 'hllanos', '2015-08-27 17:16:23', '0000-00-00 00:00:00', '127.0.0.1'),
(235, 'hllanos', '2015-08-27 17:16:50', '0000-00-00 00:00:00', '127.0.0.1'),
(236, 'hllanos', '2015-08-27 17:17:45', '0000-00-00 00:00:00', '127.0.0.1'),
(237, 'hllanos', '2015-08-27 17:19:01', '0000-00-00 00:00:00', '127.0.0.1'),
(238, 'hllanos', '2015-08-27 17:19:29', '0000-00-00 00:00:00', '127.0.0.1'),
(239, 'hllanos', '2015-08-27 17:20:02', '0000-00-00 00:00:00', '127.0.0.1'),
(240, 'hllanos', '2015-08-27 17:26:00', '0000-00-00 00:00:00', '127.0.0.1'),
(241, 'hllanos', '2015-08-27 17:26:31', '0000-00-00 00:00:00', '127.0.0.1'),
(242, 'hllanos', '2015-08-27 17:27:49', '0000-00-00 00:00:00', '127.0.0.1'),
(243, 'hllanos', '2015-08-27 17:28:29', '2015-08-27 17:32:03', '127.0.0.1'),
(244, 'hllanos', '2015-08-27 17:34:34', '0000-00-00 00:00:00', '127.0.0.1'),
(245, 'hllanos', '2015-08-27 18:05:48', '0000-00-00 00:00:00', '127.0.0.1'),
(246, 'hllanos', '2015-08-27 18:07:11', '0000-00-00 00:00:00', '127.0.0.1'),
(247, 'hllanos', '2015-08-27 18:09:11', '0000-00-00 00:00:00', '127.0.0.1'),
(248, 'hllanos', '2015-08-27 18:13:09', '2015-08-27 18:21:31', '127.0.0.1'),
(249, 'hllanos', '2015-08-27 18:31:27', '2015-08-27 18:54:15', '127.0.0.1'),
(250, 'hllanos', '2015-08-27 18:59:08', '2015-08-27 19:04:54', '127.0.0.1'),
(251, 'hllanos', '2015-08-27 19:07:17', '2015-08-27 19:08:29', '127.0.0.1'),
(252, 'hllanos', '2015-08-27 19:09:05', '0000-00-00 00:00:00', '127.0.0.1'),
(253, 'hllanos', '2015-08-27 19:15:16', '2015-08-27 19:19:03', '127.0.0.1'),
(254, 'hllanos', '2015-08-27 22:41:37', '2015-08-27 22:56:17', '127.0.0.1'),
(255, 'hllanos', '2015-08-27 22:58:52', '2015-08-27 23:04:17', '127.0.0.1'),
(256, 'hllanos', '2015-08-27 23:04:38', '2015-08-27 23:08:02', '127.0.0.1'),
(257, 'hllanos', '2015-08-27 23:11:30', '0000-00-00 00:00:00', '127.0.0.1'),
(258, 'hllanos', '2015-08-27 23:11:46', '2015-08-27 23:15:18', '127.0.0.1'),
(259, 'hllanos', '2015-08-27 23:16:40', '0000-00-00 00:00:00', '127.0.0.1'),
(260, 'hllanos', '2015-08-27 23:16:58', '0000-00-00 00:00:00', '127.0.0.1'),
(261, 'hllanos', '2015-08-27 23:19:57', '2015-08-27 23:30:14', '127.0.0.1'),
(262, 'hllanos', '2015-08-27 23:32:13', '0000-00-00 00:00:00', '127.0.0.1'),
(263, 'hllanos', '2015-08-27 23:32:36', '0000-00-00 00:00:00', '127.0.0.1'),
(264, 'hllanos', '2015-08-27 23:33:05', '0000-00-00 00:00:00', '127.0.0.1'),
(265, 'hllanos', '2015-08-27 23:33:46', '0000-00-00 00:00:00', '127.0.0.1'),
(266, 'hllanos', '2015-08-27 23:34:18', '0000-00-00 00:00:00', '127.0.0.1'),
(267, 'hllanos', '2015-08-27 23:35:46', '0000-00-00 00:00:00', '127.0.0.1'),
(268, 'hllanos', '2015-08-27 23:36:21', '0000-00-00 00:00:00', '127.0.0.1'),
(269, 'hllanos', '2015-08-27 23:37:31', '0000-00-00 00:00:00', '127.0.0.1'),
(270, 'hllanos', '2015-08-27 23:37:48', '0000-00-00 00:00:00', '127.0.0.1'),
(271, 'hllanos', '2015-08-27 23:38:39', '2015-08-27 23:42:14', '127.0.0.1'),
(272, 'hllanos', '2015-08-27 23:53:26', '2015-08-27 23:57:00', '127.0.0.1'),
(273, 'hllanos', '2015-08-28 00:03:57', '0000-00-00 00:00:00', '127.0.0.1'),
(274, 'hllanos', '2015-08-28 00:04:26', '2015-08-28 00:08:38', '127.0.0.1'),
(275, 'hllanos', '2015-08-28 00:14:16', '0000-00-00 00:00:00', '127.0.0.1'),
(276, 'hllanos', '2015-08-28 00:17:54', '0000-00-00 00:00:00', '127.0.0.1'),
(277, 'hllanos', '2015-08-28 00:18:18', '0000-00-00 00:00:00', '127.0.0.1'),
(278, 'hllanos', '2015-08-28 00:18:52', '2015-08-28 00:22:22', '127.0.0.1'),
(279, 'hllanos', '2015-08-28 00:50:32', '0000-00-00 00:00:00', '127.0.0.1'),
(280, 'hllanos', '2015-08-28 00:51:07', '2015-08-28 00:54:41', '127.0.0.1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`ID_cargo`);

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`ID_Clases`);

--
-- Indices de la tabla `clases_has_experiencia_academica`
--
ALTER TABLE `clases_has_experiencia_academica`
  ADD PRIMARY KEY (`ID_Clases`,`ID_Experiencia_academica`),
  ADD KEY `fk_Clases_has_Experiencia_academica_Experiencia_academica1_idx` (`ID_Experiencia_academica`),
  ADD KEY `fk_Clases_has_Experiencia_academica_Clases1_idx` (`ID_Clases`);

--
-- Indices de la tabla `departamento_laboral`
--
ALTER TABLE `departamento_laboral`
  ADD PRIMARY KEY (`Id_departamento_laboral`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`No_Empleado`,`N_identidad`),
  ADD KEY `fk_Empleado_Persona1_idx` (`N_identidad`),
  ADD KEY `fk_empleado_dep` (`Id_departamento`),
  ADD KEY `No_Empleado` (`No_Empleado`);

--
-- Indices de la tabla `empleado_has_cargo`
--
ALTER TABLE `empleado_has_cargo`
  ADD PRIMARY KEY (`No_Empleado`,`ID_cargo`),
  ADD KEY `fk_Empleado_has_Cargo_Cargo1_idx` (`ID_cargo`),
  ADD KEY `fk_Empleado_has_Cargo_Empleado1_idx` (`No_Empleado`),
  ADD KEY `No_Empleado` (`No_Empleado`);

--
-- Indices de la tabla `estudios_academico`
--
ALTER TABLE `estudios_academico`
  ADD PRIMARY KEY (`Id_universidad`),
  ADD KEY `fk_Estudios_academico_Tipo_estudio1_idx` (`ID_Tipo_estudio`),
  ADD KEY `fk_Estudios_academico_Persona1_idx` (`N_identidad`),
  ADD KEY `fk_estudio_universidad` (`Id_universidad`);

--
-- Indices de la tabla `experiencia_academica`
--
ALTER TABLE `experiencia_academica`
  ADD PRIMARY KEY (`ID_Experiencia_academica`),
  ADD KEY `fk_Experiencia_academica_Persona1_idx` (`N_identidad`);

--
-- Indices de la tabla `experiencia_laboral`
--
ALTER TABLE `experiencia_laboral`
  ADD PRIMARY KEY (`ID_Experiencia_laboral`),
  ADD KEY `fk_Experiencia_laboral_Persona1_idx` (`N_identidad`);

--
-- Indices de la tabla `experiencia_laboral_has_cargo`
--
ALTER TABLE `experiencia_laboral_has_cargo`
  ADD PRIMARY KEY (`ID_Experiencia_laboral`,`ID_cargo`),
  ADD KEY `fk_Experiencia_laboral_has_Cargo_Cargo1_idx` (`ID_cargo`),
  ADD KEY `fk_Experiencia_laboral_has_Cargo_Experiencia_laboral1_idx` (`ID_Experiencia_laboral`);

--
-- Indices de la tabla `idioma`
--
ALTER TABLE `idioma`
  ADD PRIMARY KEY (`ID_Idioma`);

--
-- Indices de la tabla `idioma_has_persona`
--
ALTER TABLE `idioma_has_persona`
  ADD PRIMARY KEY (`ID_Idioma`,`N_identidad`),
  ADD KEY `fk_Idioma_has_Persona_Persona1_idx` (`N_identidad`),
  ADD KEY `fk_Idioma_has_Persona_Idioma_idx` (`ID_Idioma`);

--
-- Indices de la tabla `i_entrada`
--
ALTER TABLE `i_entrada`
  ADD KEY `usuario_ID` (`usuario_ID`);

--
-- Indices de la tabla `i_instancia_producto`
--
ALTER TABLE `i_instancia_producto`
  ADD PRIMARY KEY (`id_instancia`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `i_marca`
--
ALTER TABLE `i_marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `i_producto`
--
ALTER TABLE `i_producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_marca` (`id_marca`),
  ADD KEY `tipo_producto` (`tipo_producto`);

--
-- Indices de la tabla `i_salida`
--
ALTER TABLE `i_salida`
  ADD KEY `usuario_ID` (`usuario_ID`);

--
-- Indices de la tabla `i_tipo_producto`
--
ALTER TABLE `i_tipo_producto`
  ADD PRIMARY KEY (`id_tipo_producto`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`Id_pais`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`N_identidad`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol_ID`);

--
-- Indices de la tabla `telefono`
--
ALTER TABLE `telefono`
  ADD PRIMARY KEY (`ID_Telefono`);

--
-- Indices de la tabla `tipo_area`
--
ALTER TABLE `tipo_area`
  ADD PRIMARY KEY (`id_Tipo_Area`);

--
-- Indices de la tabla `tipo_estudio`
--
ALTER TABLE `tipo_estudio`
  ADD PRIMARY KEY (`ID_Tipo_estudio`);

--
-- Indices de la tabla `titulo`
--
ALTER TABLE `titulo`
  ADD PRIMARY KEY (`id_titulo`);

--
-- Indices de la tabla `unidad_academica`
--
ALTER TABLE `unidad_academica`
  ADD PRIMARY KEY (`Id_UnidadAcademica`);

--
-- Indices de la tabla `universidad`
--
ALTER TABLE `universidad`
  ADD PRIMARY KEY (`Id_universidad`);

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
-- AUTO_INCREMENT de la tabla `i_instancia_producto`
--
ALTER TABLE `i_instancia_producto`
  MODIFY `id_instancia` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `i_marca`
--
ALTER TABLE `i_marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `i_producto`
--
ALTER TABLE `i_producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `i_tipo_producto`
--
ALTER TABLE `i_tipo_producto`
  MODIFY `id_tipo_producto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `usuario_logs`
--
ALTER TABLE `usuario_logs`
  MODIFY `id_logs` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=281;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `i_entrada`
--
ALTER TABLE `i_entrada`
  ADD CONSTRAINT `FK_EntradaUsuario` FOREIGN KEY (`usuario_ID`) REFERENCES `usuario` (`usuario_ID`);

--
-- Filtros para la tabla `i_instancia_producto`
--
ALTER TABLE `i_instancia_producto`
  ADD CONSTRAINT `FK_InstanciaProducto` FOREIGN KEY (`id_producto`) REFERENCES `i_producto` (`id_producto`);

--
-- Filtros para la tabla `i_producto`
--
ALTER TABLE `i_producto`
  ADD CONSTRAINT `FK_marcaProducto` FOREIGN KEY (`id_marca`) REFERENCES `i_marca` (`id_marca`),
  ADD CONSTRAINT `FK_tipoProdcto` FOREIGN KEY (`tipo_producto`) REFERENCES `i_tipo_producto` (`id_tipo_producto`);

--
-- Filtros para la tabla `i_salida`
--
ALTER TABLE `i_salida`
  ADD CONSTRAINT `FK_SalidaUsuario` FOREIGN KEY (`usuario_ID`) REFERENCES `usuario` (`usuario_ID`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_usuario_rol` FOREIGN KEY (`rol_ID`) REFERENCES `rol` (`rol_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
