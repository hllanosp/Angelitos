-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-10-2015 a las 00:32:40
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `Log_ID`(OUT `ID` INT(10) UNSIGNED, IN `usuario_log` VARCHAR(25), IN `fecha_ingreso` DATE, IN `ip_conexion` VARCHAR(40))
    NO SQL
    DETERMINISTIC
INSERT into usuario_logs (id_logs,usuario_log,fecha_ingreso,ip_conexion)VALUES(1,@usuario_log,@fecha_ingreso,@ip_conexion)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PA_entradas`()
    READS SQL DATA
    SQL SECURITY INVOKER
SELECT 
	i_entrada.fecha_entrada, 
	i_entrada.cant_entrada, 
	(
		SELECT 
			usuario.usuario 
		FROM 
			usuario 
		WHERE 
			usuario.usuario_ID = i_entrada.usuario_ID
	) as usuario, 
	(
		SELECT 
			i_producto.nombre 
		FROM 
			i_producto 
		WHERE 
			i_producto.id_producto = (
				SELECT 
					i_instancia_producto.id_producto 
				FROM 
					i_instancia_producto 
				WHERE 
					i_instancia_producto.id_instancia = i_entrada.id_instancia
			)
	) as producto 
FROM 
	i_entrada$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PA_instancia_producto`(IN `productoID` INT)
    READS SQL DATA
    SQL SECURITY INVOKER
SELECT 
	i_instancia_producto.id_instancia as indice
FROM 
	i_instancia_producto 
WHERE 
	i_instancia_producto.id_producto = productoID
ORDER BY
	i_instancia_producto.id_instancia DESC
LIMIT
	1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PA_nueva_entrada`(IN `instancia` INT(11), IN `cantidad` INT(11), IN `usuario` INT(11))
    MODIFIES SQL DATA
    SQL SECURITY INVOKER
INSERT INTO `i_entrada`(
	`id_instancia`, `fecha_entrada`, 
	`usuario_ID`, `cant_entrada`
) 
VALUES 
	(
		instancia, CURRENT_TIMESTAMP, usuario, cantidad
	)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PA_nueva_instancia`(IN `producto` INT(11), IN `cantidad` INT(11), IN `fecha` DATE)
    MODIFIES SQL DATA
    SQL SECURITY INVOKER
INSERT INTO `i_instancia_producto`(
	`fecha_exp`, `cantidad`, 
	`id_producto`
) 
VALUES 
	(
		fecha, cantidad, producto
	)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PA_nueva_salida`(IN `instancia` INT, IN `cantidad` INT, IN `usuario` INT)
    MODIFIES SQL DATA
    SQL SECURITY INVOKER
INSERT INTO `i_salida`(
	`id_instancia`, `fecha_salida`, 
	`usuario_ID`, `cantidad_salida`
) 
VALUES 
	(
		instancia, CURRENT_TIMESTAMP, usuario, cantidad
	)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PA_reducir_STOCK`(IN `producto_ID` INT(11), IN `entrada` INT(11))
    MODIFIES SQL DATA
    SQL SECURITY INVOKER
update 
	i_instancia_producto 
set 
	i_instancia_producto.cantidad = i_instancia_producto.cantidad - entrada 
where 
	i_instancia_producto.id_producto = producto_ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PA_resumen`()
    READS SQL DATA
    SQL SECURITY INVOKER
select 
	i_producto.id_producto, 
	i_producto.nombre, 
	i_producto.tipo_producto, 
	SUM(i_instancia_producto.cantidad) as cantidad
FROM 
	i_producto 
	inner join i_instancia_producto on i_instancia_producto.id_producto = i_producto.id_producto 
GROUP BY 
	i_producto.id_producto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PA_salidas`()
    READS SQL DATA
    SQL SECURITY INVOKER
SELECT 
	i_salida.fecha_salida, 
	(
		SELECT 
			usuario.usuario 
		FROM 
			usuario 
		WHERE 
			usuario.usuario_ID = i_salida.usuario_ID
	) as usuario, 
	(
		SELECT 
			i_producto.nombre 
		FROM 
			i_producto 
		WHERE 
			i_producto.id_producto = (
				SELECT 
					i_instancia_producto.id_producto 
				FROM 
					i_instancia_producto 
				WHERE 
					i_instancia_producto.id_instancia = i_salida.id_instancia
			)
	) as producto, 
	i_salida.cantidad_salida 
from 
	i_salida$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Reabastecer`(IN `producto_ID` INT(11), IN `entrada` INT(11), IN `usuario` VARCHAR(50))
    NO SQL
INSERT into i_entrada ( id_instancia, fecha_entrada, usuario_ID, cant_entrada)      VALUES ( producto_ID, CURRENT_TIMESTAMP, usuario, entrada)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ACTUALIZAR_CATEGORIA`(
IN `pcnombre` VARCHAR(50), -- nuevo nombre que se le quiere poner a la categoria
IN `pcCodigo` INT, -- codigo de la categoria que queremos modificar
OUT `mensajeError` VARCHAR(500)
)
BEGIN 

DECLARE EXIT HANDLER FOR SQLEXCEPTION
BEGIN
ROLLBACK;
SET mensajeError = "No se pudo actualizar la categoria, por favor revise los datos que desea modificar";
END;

   START TRANSACTION;
        UPDATE i_tipo_producto
        SET  i_tipo_producto.descripcion=pcnombre
        where i_tipo_producto.id_tipo_producto = pcCodigo;
COMMIT;   
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ACTUALIZAR_MARCA`(
IN `pcnombre` VARCHAR(50), -- nuevo nombre que se le quiere poner a la marca
IN `pcCodigo` INT, -- codigo de la marca que queremos modificar
OUT `mensajeError` VARCHAR(500)
)
BEGIN 

DECLARE EXIT HANDLER FOR SQLEXCEPTION
BEGIN
ROLLBACK;
SET mensajeError = "No se pudo actualizar la marca, por favor revise los datos que desea modificar";
END;

   START TRANSACTION;
        UPDATE i_marca
        SET  i_marca.descripcion=pcnombre
        where i_marca.id_marca = pcCodigo;
COMMIT;   
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ACTUALIZAR_PRODUCTO`(
IN `pcnombre` VARCHAR(50), -- nuevo nombre que se le quiere poner a el producto
IN `pcCodigo` INT, -- codigo de el  producto que queremos modificar
IN `pcMarca` int, -- Almacena el nombre de la marca
IN `pcTipo` int, -- Almacena elnombre el tipo de producto
OUT `mensajeError` VARCHAR(500)
)
BEGIN 

DECLARE EXIT HANDLER FOR SQLEXCEPTION
BEGIN
ROLLBACK;
SET mensajeError = "No se pudo actualizar el producto, por favor revise los datos que desea modificar";
END;

   START TRANSACTION;
        UPDATE i_producto
        SET  i_producto.nombre=pcnombre, i_producto.tipo_producto = pcTipo,i_producto.id_marca = pcMarca 
        where i_producto.id_producto = pcCodigo;
COMMIT;   
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ELIMINAR_CATEGORIAS`(
	in pcCodigo int, -- Codigo asociado a la categorias que queremos eliminar
	OUT `mensaje` VARCHAR(150)
)
SP: begin

   DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
	 SET mensaje = "No se pudo realizar la operacion, por favor intende de nuevo dentro de un momento";
     ROLLBACK;
   END;
   
   IF EXISTS
   (
		SELECT
			tipo_producto
		FROM 	
			i_producto
		WHERE 
			tipo_producto = pcCodigo
   )
   THEN
		BEGIN
			SET mensaje = 'Existen categorias asociadas a una producto por lo que, No puede ser borrada.';
            LEAVE SP;
        END;
   END IF;
   
	delete from i_tipo_producto where id_tipo_producto= pcCodigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ELIMINAR_MARCA`(
	in pcCodigo int, -- Codigo asociado a la marca que queremos eliminar
	OUT `mensaje` VARCHAR(150)
)
SP: begin

   DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
	 SET mensaje = "No se pudo realizar la operacion, por favor intende de nuevo dentro de un momento";
     ROLLBACK;
   END;
   
   IF EXISTS
   (
		SELECT
			id_marca
		FROM 	
			i_producto
		WHERE 
			id_marca = pcCodigo
   )
   THEN
		BEGIN
			SET mensaje = 'Existen marcas asociadas a una producto por lo que, No puede ser borrada.';
            LEAVE SP;
        END;
   END IF;
   
	delete from i_marca where id_marca= pcCodigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ELIMINAR_PRODUCTO`(
	in pcCodigo int, -- Codigo asociado a el producto que queremos eliminar
	OUT `mensaje` VARCHAR(150)
)
SP: begin

   DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
	 SET mensaje = "No se pudo realizar la operacion, por favor intende de nuevo dentro de un momento";
     ROLLBACK;
   END;
   
   IF EXISTS
   (
		SELECT
			id_producto 
		FROM 	
			i_instancia_producto
		WHERE
			id_producto = pcCodigo
   )
   THEN
		BEGIN
			SET mensaje = 'Error, hay producto con ese nombre.';
            LEAVE SP;
        END;
   END IF;
   
	delete from i_producto where id_producto= pcCodigo;
END$$

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_CATEGORIA`(
    IN pcnombre VARCHAR(50), -- Almacena el nombre de la categoria
    OUT pcMensajeError VARCHAR(500) -- Mensaje mostrado el sistema
    -- Descripción: Registra una categoria
	-- ClaudioPaz
)
SP:BEGIN
 
	DECLARE vcTempMensajeError VARCHAR(500) DEFAULT ''; -- Variable para almacenar posibles errores no controlados de servidor
	DECLARE vnContadorSolicitud INT DEFAULT 0; -- Variable determina si el nombre ya esta introducido
    
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
    
		ROLLBACK;
    
        SET vcTempMensajeError := CONCAT('Error: ', vcTempMensajeError);
        SET pcMensajeError := vcTempMensajeError;
    
    END;    
    
     -- Determinar si el nombre de la categoria ya está siendo usado
    SET vcTempMensajeError := 'Error al seleccionar COUNT de nombre de ciudad';
	SELECT
		COUNT(descripcion)
	INTO
		vnContadorSolicitud
	FROM
		i_tipo_producto
	WHERE
		descripcion = pcnombre;
        
        
	-- Ya hay una categoria con ese nombre
	IF vnContadorSolicitud > 0 then
    
		SET pcMensajeError := 'Esta categoria ya esta registrada, intenta otra';
        LEAVE SP;
    
    END IF;
    
    SET vcTempMensajeError := 'Error al crear el registro';
    INSERT INTO i_tipo_producto (descripcion)
    VALUES (pcnombre);    

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_ENTRADA`(
	IN pcCodigo VARCHAR(50), -- Almacena el codigo del producto
    IN pcCantidad int, -- Almacena la cantidad que se esta ingresando.
    IN pcUsuario int, -- Almacena el usuario que ingreso la entrada.
    IN pcFecha_exp date, -- Almacena la fecha de expiracion.
    OUT pcMensajeError VARCHAR(500) -- Mensaje mostrado el sistema
)
SP: BEGIN

    DECLARE vnCodigoNuevaInstancia INT;
	DECLARE vcTempMensajeError VARCHAR(500);
    DECLARE mensajeErrorServidor VARCHAR(200);
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
		
		ROLLBACK;
		GET DIAGNOSTICS CONDITION 1 mensajeErrorServidor = MESSAGE_TEXT;
        SET vcTempMensajeError := CONCAT('Error: ', vcTempMensajeError,mensajeErrorServidor);
        SET pcMensajeError := vcTempMensajeError;
    
    END;
    
    START TRANSACTION;
    -- Determinar si hay una fecha y un id con ese mismo producto para sumarle la cantidad a la instancia de ese producto
    IF EXISTS
    (
		SELECT id_instancia
        FROM i_instancia_producto
        WHERE i_instancia_producto.id_producto = pcCodigo and i_instancia_producto.fecha_exp = pcFecha_exp 
    )
    THEN
		BEGIN

			-- Le suma a ese producto la cantidad que se esta ingresando
			SET vcTempMensajeError := 'Error al registrar la instancia de este producto';
            
			UPDATE i_instancia_producto
            SET cantidad = cantidad + pcCantidad
            WHERE i_instancia_producto.id_producto = pcCodigo and i_instancia_producto.fecha_exp = pcFecha_exp;
            
			INSERT INTO i_entrada(id_instancia,fecha_entrada,usuario_ID,cant_entrada)    
			VALUES((SELECT id_instancia
					FROM i_instancia_producto
                    WHERE i_instancia_producto.id_producto = pcCodigo and i_instancia_producto.fecha_exp = pcFecha_exp),CURDATE(),pcUsuario,pcCantidad);
			
        END;
	ELSE 
		SET vcTempMensajeError := 'Al registrar la nueva solicitud';
        INSERT INTO i_instancia_producto(fecha_exp,cantidad,id_producto)
        VALUES(pcFecha_exp,pcCantidad,pcUsuario);
        
		SET vnCodigoNuevaInstancia := LAST_INSERT_ID();
        
        INSERT INTO i_entrada(id_instancia,fecha_entrada,usuario_ID,cant_entrada)    
			VALUES(vnCodigoNuevaInstancia,CURDATE(),pcUsuario,pcCantidad);
	END IF;	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_MARCA`(
    IN pcnombre VARCHAR(50), -- Almacena el nombre de la marca
    OUT pcMensajeError VARCHAR(500) -- Mensaje mostrado el sistema
    -- Descripción: Registra una marca
	-- ClaudioPaz
)
SP:BEGIN
 
	DECLARE vcTempMensajeError VARCHAR(500) DEFAULT ''; -- Variable para almacenar posibles errores no controlados de servidor
	DECLARE vnContadorSolicitud INT DEFAULT 0; -- Variable determina si el nombre ya esta introducido
    
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
    
		ROLLBACK;
    
        SET vcTempMensajeError := CONCAT('Error: ', vcTempMensajeError);
        SET pcMensajeError := vcTempMensajeError;
    
    END;    
    
     -- Determinar si el nombre de la marca ya está siendo usado
    SET vcTempMensajeError := 'Error al seleccionar COUNT de la marca';
	SELECT
		COUNT(descripcion)
	INTO
		vnContadorSolicitud
	FROM
		i_marca
	WHERE
		descripcion = pcnombre;
        
        
	-- Ya hay una marca con ese nombre
	IF vnContadorSolicitud > 0 then
    
		SET pcMensajeError := 'Esta marca ya esta registrada, intenta otra';
        LEAVE SP;
    
    END IF;
    
    SET vcTempMensajeError := 'Error al crear el registro';
    INSERT INTO i_marca (descripcion)
    VALUES (pcnombre);    

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_PRODUCTO`(
    IN pcnombre VARCHAR(50), -- Almacena el nombre de el producto
    IN pcTipo int, -- Almacena el nombre de la marca
    IN pcMarca int, -- Almacena elnombre el tipo de producto
    OUT pcMensajeError VARCHAR(500) -- Mensaje mostrado el sistema
    -- Descripción: Registra un produco
	-- ClaudioPaz
)
SP:BEGIN
 
	DECLARE vcTempMensajeError VARCHAR(500) DEFAULT ''; -- Variable para almacenar posibles errores no controlados de servidor
	DECLARE vnContadorSolicitud INT DEFAULT 0; -- Variable determina si el nombre ya esta introducido
    
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
    
		ROLLBACK;
    
        SET vcTempMensajeError := CONCAT('Error: ', vcTempMensajeError);
        SET pcMensajeError := vcTempMensajeError;
    
    END;    
    
     -- Determinar si el nombre de la categoria ya está siendo usado
    SET vcTempMensajeError := 'Error al seleccionar COUNT de nombre de el producto ya esta siendo usado';
	SELECT
		COUNT(nombre)
	INTO
		vnContadorSolicitud
	FROM
		i_producto
	WHERE
		nombre = pcnombre and tipo_producto = pcTipo  and id_marca = pcMarca;
        
        
	-- Ya hay un producto con ese nombre
	IF vnContadorSolicitud > 0 then
    
		SET pcMensajeError := 'Este producto  ya esta registrado, intenta otra';
        LEAVE SP;
    
    END IF;
    
    SET vcTempMensajeError := 'Error al crear el registro';
    INSERT INTO i_producto (nombre,tipo_producto,id_marca)
    VALUES (pcnombre,pcTipo,pcMarca);    

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
(0, 'Pedro  Pablo Perez Hernandez'),
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
  `cant_entrada` int(11) DEFAULT NULL,
  `item` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `i_entrada`
--

INSERT INTO `i_entrada` (`id_instancia`, `fecha_entrada`, `usuario_ID`, `cant_entrada`, `item`) VALUES
(8, '2015-08-28', 16, 1000, 4),
(10, '2015-08-28', 16, 100, 5),
(12, '2015-08-28', 16, 1000, 6),
(16, '2015-08-31', 8, 100, 7),
(17, '2015-08-31', 8, 100, 8),
(18, '2015-09-04', 16, 800, 9),
(19, '2015-09-04', 16, 800, 10),
(20, '2015-09-04', 16, 800, 11),
(21, '2015-09-04', 16, 800, 12),
(29, '2015-09-04', 16, 56, 13),
(32, '2015-09-06', 8, 1, 14),
(33, '2015-09-06', 8, 899, 15),
(34, '2015-09-13', 8, 21, 16),
(35, '2015-09-13', 8, 10, 17),
(36, '2015-09-13', 8, 3, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `i_instancia_producto`
--

CREATE TABLE IF NOT EXISTS `i_instancia_producto` (
  `id_instancia` int(11) NOT NULL,
  `fecha_exp` date DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `i_instancia_producto`
--

INSERT INTO `i_instancia_producto` (`id_instancia`, `fecha_exp`, `cantidad`, `id_producto`) VALUES
(1, '2015-08-28', 100, 8),
(8, '2015-08-31', 1000, 8),
(9, '0000-00-00', -200, 8),
(10, '2015-07-27', 100, 8),
(11, '0000-00-00', -500, 8),
(12, '2015-08-31', 1000, 8),
(13, '0000-00-00', -6, 8),
(14, '0000-00-00', -100, 8),
(15, '0000-00-00', -100, 8),
(16, '0000-00-00', 100, 8),
(17, '0000-00-00', 100, 8),
(18, '0000-00-00', 800, 8),
(19, '0000-00-00', 800, 8),
(20, '0000-00-00', 800, 8),
(21, '0000-00-00', 800, 8),
(22, '0000-00-00', -67, 8),
(23, '0000-00-00', -67, 8),
(24, '0000-00-00', -67, 8),
(25, '0000-00-00', -67, 8),
(26, '0000-00-00', -67, 8),
(27, '0000-00-00', -67, 8),
(28, '0000-00-00', -67, 8),
(29, '2015-09-16', 56, 8),
(30, '0000-00-00', -1000, 8),
(31, '0000-00-00', -1000, 8),
(32, '2015-09-17', 1, 8),
(33, '2015-09-30', 899, 8),
(34, '0000-00-00', 21, 8),
(35, '0000-00-00', 10, 8),
(36, '0000-00-00', 3, 8),
(37, '0000-00-00', -67, 8),
(38, '0000-00-00', -67, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `i_marca`
--

CREATE TABLE IF NOT EXISTS `i_marca` (
  `id_marca` int(11) NOT NULL,
  `descripcion` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `i_marca`
--

INSERT INTO `i_marca` (`id_marca`, `descripcion`) VALUES
(1, 'Ceteco'),
(4, 'Patito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `i_producto`
--

CREATE TABLE IF NOT EXISTS `i_producto` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `tipo_producto` int(11) DEFAULT NULL,
  `id_marca` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `i_producto`
--

INSERT INTO `i_producto` (`id_producto`, `nombre`, `tipo_producto`, `id_marca`) VALUES
(8, 'Pañales', 4, 1),
(9, 'Mantas ', 4, 1),
(12, 'alcohol', 11, 1),
(13, 'toallas', 11, 1),
(14, 'toallas', 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `i_salida`
--

CREATE TABLE IF NOT EXISTS `i_salida` (
  `id_instancia` int(11) DEFAULT NULL,
  `fecha_salida` date DEFAULT NULL,
  `usuario_ID` int(11) DEFAULT NULL,
  `cantidad_salida` int(11) DEFAULT NULL,
  `item` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `i_salida`
--

INSERT INTO `i_salida` (`id_instancia`, `fecha_salida`, `usuario_ID`, `cantidad_salida`, `item`) VALUES
(9, '2015-08-28', 16, 200, 2),
(11, '2015-08-28', 16, 500, 3),
(13, '2015-08-31', 8, 6, 4),
(14, '2015-08-31', 8, 100, 5),
(15, '2015-08-31', 8, 100, 6),
(22, '2015-09-04', 16, 67, 7),
(23, '2015-09-04', 16, 67, 8),
(24, '2015-09-04', 16, 67, 9),
(25, '2015-09-04', 16, 67, 10),
(26, '2015-09-04', 16, 67, 11),
(27, '2015-09-04', 16, 67, 12),
(28, '2015-09-04', 16, 67, 13),
(30, '2015-09-04', 16, 1000, 14),
(31, '2015-09-04', 16, 1000, 15),
(37, '2015-09-19', 8, 67, 16),
(38, '2015-09-19', 8, 67, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `i_tipo_producto`
--

CREATE TABLE IF NOT EXISTS `i_tipo_producto` (
  `id_tipo_producto` int(11) NOT NULL,
  `descripcion` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `i_tipo_producto`
--

INSERT INTO `i_tipo_producto` (`id_tipo_producto`, `descripcion`) VALUES
(4, 'Desechables'),
(9, 'Limpieza'),
(11, 'Medicos'),
(12, 'Comestibles');

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
(14, 'UPI', 0);

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
('pineda1234', '$2a$07$7PqV8qgy4K9toN3aiWoOueysZN8SOCoL.62VauwPTx7rPA4t46jRW', 1, 8, '2015-06-25', NULL, 1, 0),
('Arleandinooo', '$2a$07$0Bti6VzhknuYxIJ4JEk1HunhqmQEIo/CLpH/7iNeR4ZilEpPmgEWO', 1, 11, '2015-06-27', '2015-10-06', 0, 0),
('ArleReyes', '$2a$07$O2NlXrsvbRMNPybi4HoDH.a6Lw1q5xj23NOYbFQKJC1jwqTpTBwFa', 5, 12, '2015-06-27', '0000-00-00', 1, 0),
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
) ENGINE=InnoDB AUTO_INCREMENT=473 DEFAULT CHARSET=latin1;

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
(222, 'pineda1234', '2015-07-13 00:49:11', '2015-07-13 00:49:41', '::1'),
(223, 'pineda1234', '2015-07-13 00:50:10', '2015-07-13 00:50:34', '::1'),
(224, 'pineda1234', '2015-07-13 00:50:37', '0000-00-00 00:00:00', '::1'),
(225, 'pineda1234', '2015-07-13 00:50:53', '2015-07-13 00:50:55', '::1'),
(226, 'hllanos', '2015-07-13 01:05:10', '0000-00-00 00:00:00', '::1'),
(227, 'hllanos', '2015-07-13 01:06:52', '0000-00-00 00:00:00', '::1'),
(228, 'hllanos', '2015-07-13 01:08:12', '2015-07-13 01:08:16', '::1'),
(229, 'pineda1234', '2015-07-13 01:18:55', '2015-07-13 01:19:21', '::1'),
(230, 'pineda1234', '2015-07-13 01:21:22', '2015-07-13 01:21:43', '::1'),
(231, 'pineda1234', '2015-07-13 01:22:32', '2015-07-13 01:22:53', '::1'),
(232, 'pineda1234', '2015-07-13 01:24:26', '2015-07-13 01:24:46', '::1'),
(233, 'pineda1234', '2015-07-13 01:29:13', '2015-07-13 01:29:36', '::1'),
(234, 'pineda1234', '2015-07-15 13:55:04', '0000-00-00 00:00:00', '::1'),
(235, 'pineda1234', '2015-07-15 13:59:00', '0000-00-00 00:00:00', '::1'),
(236, 'pineda1234', '2015-07-15 13:59:14', '0000-00-00 00:00:00', '::1'),
(237, 'pineda1234', '2015-07-15 13:59:58', '2015-07-15 14:00:18', '::1'),
(238, 'pineda1234', '2015-07-18 20:23:14', '2015-07-18 20:24:33', '::1'),
(239, 'pineda1234', '2015-07-19 23:28:51', '0000-00-00 00:00:00', '::1'),
(240, 'pineda1234', '2015-07-19 23:29:07', '0000-00-00 00:00:00', '::1'),
(241, 'pineda1234', '2015-07-20 11:58:32', '0000-00-00 00:00:00', '::1'),
(242, 'pineda1234', '2015-07-20 12:19:42', '0000-00-00 00:00:00', '::1'),
(243, 'pineda1234', '2015-07-20 12:19:58', '2015-07-20 12:23:09', '::1'),
(244, 'hllanos', '2015-07-20 12:21:53', '2015-07-20 12:22:53', '::1'),
(245, 'pineda1234', '2015-07-20 12:23:58', '2015-07-20 12:24:01', '::1'),
(246, 'pineda1234', '2015-07-20 12:24:06', '2015-07-20 12:27:55', '::1'),
(247, 'pineda1234', '2015-07-20 16:40:47', '0000-00-00 00:00:00', '::1'),
(248, 'pineda1234', '2015-07-20 16:41:07', '2015-07-20 16:42:38', '::1'),
(249, 'pineda1234', '2015-07-20 16:43:19', '0000-00-00 00:00:00', '::1'),
(250, 'pineda1234', '2015-07-20 16:44:25', '0000-00-00 00:00:00', '::1'),
(251, 'pineda1234', '2015-07-20 16:45:48', '0000-00-00 00:00:00', '::1'),
(252, 'pineda1234', '2015-07-20 16:46:14', '0000-00-00 00:00:00', '::1'),
(253, 'pineda1234', '2015-07-22 16:12:10', '0000-00-00 00:00:00', '127.0.0.1'),
(254, 'hllanos', '2015-07-22 16:25:29', '0000-00-00 00:00:00', '127.0.0.1'),
(255, 'pineda1234', '2015-07-26 19:41:08', '2015-07-26 19:42:00', '127.0.0.1'),
(256, 'hllanos', '2015-07-26 19:42:12', '2015-07-26 19:42:26', '127.0.0.1'),
(257, 'pineda1234', '2015-07-26 19:42:31', '2015-07-26 19:42:33', '127.0.0.1'),
(258, 'pineda1234', '2015-08-23 19:33:44', '2015-08-23 19:38:29', '::1'),
(259, 'pineda1234', '2015-08-23 19:48:45', '0000-00-00 00:00:00', '::1'),
(260, 'pineda1234', '2015-08-23 19:50:21', '0000-00-00 00:00:00', '::1'),
(261, 'pineda1234', '2015-08-23 22:06:43', '2015-08-23 22:11:40', '::1'),
(262, 'pineda1234', '2015-08-23 22:13:51', '0000-00-00 00:00:00', '::1'),
(263, 'pineda1234', '2015-08-23 22:26:28', '0000-00-00 00:00:00', '::1'),
(264, 'pineda1234', '2015-08-23 22:32:56', '0000-00-00 00:00:00', '::1'),
(265, 'pineda1234', '2015-08-23 22:35:58', '0000-00-00 00:00:00', '::1'),
(266, 'pineda1234', '2015-08-23 22:39:33', '0000-00-00 00:00:00', '::1'),
(267, 'pineda1234', '2015-08-23 22:52:58', '2015-08-23 23:04:22', '::1'),
(268, 'pineda1234', '2015-08-23 23:04:35', '0000-00-00 00:00:00', '::1'),
(269, 'pineda1234', '2015-08-23 23:17:35', '2015-08-23 23:27:16', '::1'),
(270, 'pineda1234', '2015-08-23 23:27:42', '0000-00-00 00:00:00', '::1'),
(271, 'pineda1234', '2015-08-23 23:38:19', '0000-00-00 00:00:00', '::1'),
(272, 'pineda1234', '2015-08-23 23:38:46', '2015-08-23 23:45:30', '::1'),
(273, 'pineda1234', '2015-08-23 23:45:37', '0000-00-00 00:00:00', '::1'),
(274, 'pineda1234', '2015-08-23 23:46:36', '2015-08-24 08:45:04', '::1'),
(275, 'pineda1234', '2015-08-24 12:32:33', '0000-00-00 00:00:00', '::1'),
(276, 'hllanos', '2015-08-24 21:09:55', '2015-08-24 21:30:32', '::1'),
(277, 'hllanos', '2015-08-24 21:45:28', '0000-00-00 00:00:00', '::1'),
(278, 'hllanos', '2015-08-24 21:46:02', '0000-00-00 00:00:00', '::1'),
(279, 'hllanos', '2015-08-24 22:00:45', '0000-00-00 00:00:00', '::1'),
(280, 'hllanos', '2015-08-24 22:01:01', '2015-08-24 22:22:44', '::1'),
(281, 'hllanos', '2015-08-25 08:31:27', '2015-08-25 08:41:50', '::1'),
(282, 'hllanos', '2015-08-25 08:52:29', '0000-00-00 00:00:00', '::1'),
(283, 'hllanos', '2015-08-25 09:03:39', '0000-00-00 00:00:00', '::1'),
(284, 'hllanos', '2015-08-25 09:05:33', '0000-00-00 00:00:00', '::1'),
(285, 'hllanos', '2015-08-25 09:05:55', '2015-08-25 09:21:15', '::1'),
(286, 'hllanos', '2015-08-25 09:21:47', '2015-08-25 09:33:56', '::1'),
(287, 'hllanos', '2015-08-25 09:37:18', '0000-00-00 00:00:00', '::1'),
(288, 'hllanos', '2015-08-25 09:43:39', '2015-08-25 09:51:05', '::1'),
(289, 'hllanos', '2015-08-25 11:22:48', '0000-00-00 00:00:00', '::1'),
(290, 'hllanos', '2015-08-25 11:25:34', '0000-00-00 00:00:00', '::1'),
(291, 'hllanos', '2015-08-25 11:26:32', '2015-08-25 11:28:37', '::1'),
(292, 'hllanos', '2015-08-25 15:56:09', '2015-08-25 16:06:22', '::1'),
(293, 'hllanos', '2015-08-25 16:16:51', '2015-08-25 16:20:30', '::1'),
(294, 'hllanos', '2015-08-25 19:13:38', '2015-08-25 19:28:13', '::1'),
(295, 'hllanos', '2015-08-25 19:30:50', '2015-08-25 19:36:06', '::1'),
(296, 'hllanos', '2015-08-25 19:40:49', '2015-08-25 19:45:42', '::1'),
(297, 'hllanos', '2015-08-25 19:52:18', '0000-00-00 00:00:00', '::1'),
(298, 'hllanos', '2015-08-25 19:54:54', '2015-08-25 20:02:42', '::1'),
(299, 'hllanos', '2015-08-25 20:29:28', '2015-08-25 20:35:49', '::1'),
(300, 'hllanos', '2015-08-25 20:36:32', '2015-08-25 20:40:47', '::1'),
(301, 'hllanos', '2015-08-25 20:41:27', '2015-08-25 20:53:05', '::1'),
(302, 'hllanos', '2015-08-25 21:21:18', '0000-00-00 00:00:00', '::1'),
(303, 'hllanos', '2015-08-25 21:22:17', '0000-00-00 00:00:00', '::1'),
(304, 'hllanos', '2015-08-25 21:56:11', '2015-08-25 22:00:31', '::1'),
(305, 'hllanos', '2015-08-25 22:10:09', '0000-00-00 00:00:00', '::1'),
(306, 'hllanos', '2015-08-25 22:46:28', '0000-00-00 00:00:00', '::1'),
(307, 'hllanos', '2015-08-25 22:46:54', '2015-08-25 22:52:21', '::1'),
(308, 'hllanos', '2015-08-25 22:52:58', '0000-00-00 00:00:00', '::1'),
(309, 'hllanos', '2015-08-25 23:00:08', '2015-08-25 23:05:01', '::1'),
(310, 'hllanos', '2015-08-25 23:06:34', '0000-00-00 00:00:00', '::1'),
(311, 'hllanos', '2015-08-25 23:07:24', '2015-08-25 23:51:17', '::1'),
(312, 'hllanos', '2015-08-25 23:52:01', '0000-00-00 00:00:00', '::1'),
(313, 'hllanos', '2015-08-25 23:53:24', '0000-00-00 00:00:00', '::1'),
(314, 'hllanos', '2015-08-26 00:05:16', '2015-08-26 00:08:57', '::1'),
(315, 'hllanos', '2015-08-26 00:14:31', '0000-00-00 00:00:00', '::1'),
(316, 'hllanos', '2015-08-26 00:19:52', '0000-00-00 00:00:00', '::1'),
(317, 'hllanos', '2015-08-26 01:00:52', '0000-00-00 00:00:00', '::1'),
(318, 'hllanos', '2015-08-26 01:03:57', '0000-00-00 00:00:00', '::1'),
(319, 'hllanos', '2015-08-26 01:18:51', '2015-08-26 07:20:25', '::1'),
(320, 'hllanos', '2015-08-27 15:14:41', '2015-08-27 15:35:24', '::1'),
(321, 'hllanos', '2015-08-27 15:50:51', '0000-00-00 00:00:00', '::1'),
(322, 'hllanos', '2015-08-27 16:30:52', '2015-08-27 16:41:09', '::1'),
(323, 'hllanos', '2015-08-27 16:41:23', '0000-00-00 00:00:00', '::1'),
(324, 'hllanos', '2015-08-27 16:55:10', '2015-08-27 17:02:22', '::1'),
(325, 'hllanos', '2015-08-27 17:03:09', '0000-00-00 00:00:00', '::1'),
(326, 'hllanos', '2015-08-27 17:22:10', '0000-00-00 00:00:00', '::1'),
(327, 'hllanos', '2015-08-27 17:28:10', '2015-08-27 18:45:37', '::1'),
(328, 'hllanos', '2015-08-27 18:48:45', '2015-08-27 18:52:27', '::1'),
(329, 'hllanos', '2015-08-27 18:53:05', '2015-08-27 18:56:54', '::1'),
(330, 'hllanos', '2015-08-27 19:04:21', '2015-08-27 19:11:14', '::1'),
(331, 'hllanos', '2015-08-27 19:12:07', '0000-00-00 00:00:00', '::1'),
(332, 'hllanos', '2015-08-27 23:10:07', '2015-08-27 23:13:37', '::1'),
(333, 'hllanos', '2015-08-27 23:19:38', '2015-08-27 23:23:40', '::1'),
(334, 'hllanos', '2015-08-27 23:26:38', '0000-00-00 00:00:00', '::1'),
(335, 'hllanos', '2015-08-27 23:58:27', '2015-08-28 00:02:35', '::1'),
(336, 'hllanos', '2015-08-28 00:37:51', '0000-00-00 00:00:00', '::1'),
(337, 'hllanos', '2015-08-28 00:44:52', '2015-08-28 00:59:07', '::1'),
(338, 'hllanos', '2015-08-28 01:12:54', '2015-08-28 01:30:52', '::1'),
(339, 'pineda1234', '2015-08-28 01:38:10', '0000-00-00 00:00:00', '::1'),
(340, 'hllanos', '2015-08-28 07:07:10', '0000-00-00 00:00:00', '::1'),
(341, 'hllanos', '2015-08-28 07:11:41', '2015-08-28 07:16:37', '::1'),
(342, 'hllanos', '2015-08-28 07:17:56', '0000-00-00 00:00:00', '::1'),
(343, 'hllanos', '2015-08-28 08:26:55', '2015-08-28 08:33:07', '::1'),
(344, 'hllanos', '2015-08-28 08:34:01', '2015-08-28 08:40:09', '::1'),
(345, 'hllanos', '2015-08-28 08:59:38', '2015-08-28 09:03:07', '::1'),
(346, 'hllanos', '2015-08-28 09:22:36', '0000-00-00 00:00:00', '::1'),
(347, 'hllanos', '2015-08-28 09:23:05', '2015-08-28 09:32:32', '::1'),
(348, 'hllanos', '2015-08-28 09:33:49', '2015-08-28 09:39:53', '::1'),
(349, 'hllanos', '2015-08-28 09:40:31', '0000-00-00 00:00:00', '::1'),
(350, 'hllanos', '2015-08-28 09:48:20', '0000-00-00 00:00:00', '::1'),
(351, 'hllanos', '2015-08-28 09:50:50', '0000-00-00 00:00:00', '::1'),
(352, 'hllanos', '2015-08-28 09:54:50', '0000-00-00 00:00:00', '::1'),
(353, 'hllanos', '2015-08-28 09:58:54', '0000-00-00 00:00:00', '::1'),
(354, 'hllanos', '2015-08-28 09:59:17', '0000-00-00 00:00:00', '::1'),
(355, 'hllanos', '2015-08-28 10:10:18', '0000-00-00 00:00:00', '::1'),
(356, 'hllanos', '2015-08-28 10:13:23', '0000-00-00 00:00:00', '::1'),
(357, 'hllanos', '2015-08-28 10:13:38', '2015-08-28 10:19:59', '::1'),
(358, 'hllanos', '2015-08-28 10:27:46', '0000-00-00 00:00:00', '::1'),
(359, 'hllanos', '2015-08-28 10:29:56', '0000-00-00 00:00:00', '::1'),
(360, 'hllanos', '2015-08-28 19:24:14', '2015-08-28 19:27:36', '127.0.0.1'),
(361, 'hllanos', '2015-08-28 19:53:00', '0000-00-00 00:00:00', '127.0.0.1'),
(362, 'hllanos', '2015-08-28 19:53:06', '2015-08-28 20:02:06', '127.0.0.1'),
(363, 'hllanos', '2015-08-28 20:09:41', '2015-08-28 20:24:20', '127.0.0.1'),
(364, 'hllanos', '2015-08-28 20:30:43', '2015-08-28 20:38:57', '127.0.0.1'),
(365, 'hllanos', '2015-08-28 20:39:13', '2015-08-28 20:45:14', '127.0.0.1'),
(366, 'hllanos', '2015-08-28 20:52:33', '2015-08-28 20:56:36', '127.0.0.1'),
(367, 'hllanos', '2015-08-28 21:01:02', '2015-08-28 21:14:21', '127.0.0.1'),
(368, 'hllanos', '2015-08-28 21:16:30', '2015-08-28 21:55:54', '127.0.0.1'),
(369, 'hllanos', '2015-08-28 21:58:11', '2015-08-28 22:46:46', '127.0.0.1'),
(370, 'hllanos', '2015-08-28 22:46:55', '0000-00-00 00:00:00', '127.0.0.1'),
(371, 'hllanos', '2015-08-28 22:49:09', '0000-00-00 00:00:00', '127.0.0.1'),
(372, 'pineda1234', '2015-08-29 00:34:13', '2015-08-29 00:39:36', '127.0.0.1'),
(373, 'pineda1234', '2015-08-29 00:40:26', '2015-08-29 00:44:07', '127.0.0.1'),
(374, 'pineda1234', '2015-08-29 00:44:11', '2015-08-29 00:46:43', '127.0.0.1'),
(375, 'hllanos', '2015-08-29 00:47:48', '2015-08-29 00:48:34', '127.0.0.1'),
(376, 'hllanos', '2015-08-29 00:48:40', '2015-08-29 00:56:28', '127.0.0.1'),
(377, 'hllanos', '2015-08-29 01:20:10', '2015-08-29 01:26:50', '127.0.0.1'),
(378, 'hllanos', '2015-08-29 01:40:05', '0000-00-00 00:00:00', '127.0.0.1'),
(379, 'hllanos', '2015-08-29 01:43:30', '2015-08-29 01:53:10', '127.0.0.1'),
(380, 'hllanos', '2015-08-29 02:08:39', '2015-08-29 02:12:22', '127.0.0.1'),
(381, 'hllanos', '2015-08-29 02:13:59', '2015-08-29 02:18:33', '127.0.0.1'),
(382, 'hllanos', '2015-08-29 02:22:44', '2015-08-29 11:21:25', '127.0.0.1'),
(383, 'pineda1234', '2015-08-31 18:47:18', '2015-08-31 18:53:57', '127.0.0.1'),
(384, 'pineda1234', '2015-08-31 18:54:06', '0000-00-00 00:00:00', '127.0.0.1'),
(385, 'hllanos', '2015-09-04 16:33:33', '2015-09-04 16:47:47', '127.0.0.1'),
(386, 'hllanos', '2015-09-04 17:58:36', '2015-09-04 18:05:51', '127.0.0.1'),
(387, 'hllanos', '2015-09-04 18:06:13', '0000-00-00 00:00:00', '127.0.0.1'),
(388, 'hllanos', '2015-09-04 18:09:57', '2015-09-04 18:11:49', '127.0.0.1'),
(389, 'pineda1234', '2015-09-04 18:11:54', '2015-09-04 18:12:21', '127.0.0.1'),
(390, 'pineda1234', '2015-09-04 18:12:25', '2015-09-04 18:12:27', '127.0.0.1'),
(391, 'pineda1234', '2015-09-04 18:12:35', '0000-00-00 00:00:00', '127.0.0.1'),
(392, 'pineda1234', '2015-09-06 08:41:42', '2015-09-06 08:50:50', '127.0.0.1'),
(393, 'pineda1234', '2015-09-06 08:55:28', '2015-09-06 09:04:43', '127.0.0.1'),
(394, 'pineda1234', '2015-09-07 08:31:25', '0000-00-00 00:00:00', '127.0.0.1'),
(395, 'pineda1234', '2015-09-07 08:32:30', '0000-00-00 00:00:00', '127.0.0.1'),
(396, 'pineda1234', '2015-09-07 08:32:46', '0000-00-00 00:00:00', '127.0.0.1'),
(397, 'pineda1234', '2015-09-07 08:33:58', '2015-09-07 08:37:51', '127.0.0.1'),
(398, 'pineda1234', '2015-09-13 12:08:22', '2015-09-13 12:13:56', '127.0.0.1'),
(399, 'pineda1234', '2015-09-13 12:15:52', '2015-09-13 12:19:42', '127.0.0.1'),
(400, 'pineda1234', '2015-09-19 19:12:54', '2015-09-19 19:19:14', '127.0.0.1'),
(401, 'pineda1234', '2015-09-19 19:19:42', '2015-09-19 19:30:42', '127.0.0.1'),
(402, 'pineda1234', '2015-09-19 19:50:23', '0000-00-00 00:00:00', '127.0.0.1'),
(403, 'hllanos', '2015-10-02 08:51:55', '2015-10-02 08:56:53', '127.0.0.1'),
(404, 'hllanos', '2015-10-02 09:21:31', '2015-10-02 09:27:13', '127.0.0.1'),
(405, 'hllanos', '2015-10-02 09:28:52', '2015-10-02 09:33:06', '127.0.0.1'),
(406, 'hllanos', '2015-10-02 09:34:06', '2015-10-02 09:41:05', '127.0.0.1'),
(407, 'hllanos', '2015-10-05 22:05:02', '0000-00-00 00:00:00', '127.0.0.1'),
(408, 'hllanos', '2015-10-08 19:18:05', '2015-10-08 19:22:37', '127.0.0.1'),
(409, 'hllanos', '2015-10-08 19:23:00', '2015-10-08 19:26:31', '127.0.0.1'),
(410, 'hllanos', '2015-10-08 19:30:40', '0000-00-00 00:00:00', '127.0.0.1'),
(411, 'hllanos', '2015-10-08 19:33:19', '0000-00-00 00:00:00', '127.0.0.1'),
(412, 'hllanos', '2015-10-08 19:40:18', '0000-00-00 00:00:00', '127.0.0.1'),
(413, 'hllanos', '2015-10-08 19:41:03', '2015-10-08 19:44:46', '127.0.0.1'),
(414, 'hllanos', '2015-10-08 19:51:27', '2015-10-08 19:57:58', '127.0.0.1'),
(415, 'hllanos', '2015-10-08 19:58:08', '2015-10-08 21:19:53', '127.0.0.1'),
(416, 'hllanos', '2015-10-08 21:23:15', '2015-10-08 21:54:37', '127.0.0.1'),
(417, 'hllanos', '2015-10-08 21:54:55', '0000-00-00 00:00:00', '127.0.0.1'),
(418, 'pineda1234', '2015-10-09 14:44:25', '2015-10-09 14:49:14', '127.0.0.1'),
(419, 'pineda1234', '2015-10-09 14:50:08', '2015-10-09 14:50:10', '127.0.0.1'),
(420, 'pineda1234', '2015-10-09 14:50:13', '2015-10-09 14:54:21', '127.0.0.1'),
(421, 'pineda1234', '2015-10-09 22:49:12', '2015-10-10 00:36:18', '127.0.0.1'),
(422, 'pineda1234', '2015-10-10 00:47:24', '2015-10-10 00:51:37', '127.0.0.1'),
(423, 'pineda1234', '2015-10-10 00:57:35', '2015-10-10 01:03:50', '127.0.0.1'),
(424, 'pineda1234', '2015-10-10 06:37:27', '2015-10-10 07:23:53', '127.0.0.1'),
(425, 'pineda1234', '2015-10-10 07:25:02', '2015-10-10 07:30:09', '127.0.0.1'),
(426, 'pineda1234', '2015-10-10 07:35:31', '2015-10-10 07:38:58', '127.0.0.1'),
(427, 'pineda1234', '2015-10-10 07:47:45', '2015-10-10 07:51:09', '127.0.0.1'),
(428, 'pineda1234', '2015-10-10 07:55:06', '2015-10-10 07:58:37', '127.0.0.1'),
(429, 'pineda1234', '2015-10-10 07:58:56', '2015-10-10 08:05:30', '127.0.0.1'),
(430, 'pineda1234', '2015-10-10 08:06:44', '2015-10-10 08:10:33', '127.0.0.1'),
(431, 'pineda1234', '2015-10-10 08:11:51', '2015-10-10 08:21:42', '127.0.0.1'),
(432, 'pineda1234', '2015-10-10 08:23:21', '2015-10-10 08:27:00', '127.0.0.1'),
(433, 'pineda1234', '2015-10-10 08:28:52', '0000-00-00 00:00:00', '127.0.0.1'),
(434, 'pineda1234', '2015-10-10 08:29:04', '0000-00-00 00:00:00', '127.0.0.1'),
(435, 'pineda1234', '2015-10-10 08:35:24', '0000-00-00 00:00:00', '127.0.0.1'),
(436, 'pineda1234', '2015-10-10 08:35:39', '0000-00-00 00:00:00', '127.0.0.1'),
(437, 'pineda1234', '2015-10-10 08:37:35', '2015-10-10 08:38:13', '127.0.0.1'),
(438, 'pineda1234', '2015-10-10 08:41:20', '2015-10-10 08:41:27', '127.0.0.1'),
(439, 'pineda1234', '2015-10-10 08:43:17', '2015-10-10 08:43:25', '127.0.0.1'),
(440, 'pineda1234', '2015-10-10 08:46:42', '2015-10-10 08:46:52', '127.0.0.1'),
(441, 'pineda1234', '2015-10-10 08:48:17', '2015-10-10 08:48:21', '127.0.0.1'),
(442, 'pineda1234', '2015-10-10 08:48:32', '0000-00-00 00:00:00', '127.0.0.1'),
(443, 'pineda1234', '2015-10-10 08:49:06', '2015-10-10 08:56:30', '127.0.0.1'),
(444, 'pineda1234', '2015-10-10 09:01:28', '2015-10-10 09:09:46', '127.0.0.1'),
(445, 'pineda1234', '2015-10-10 12:18:13', '2015-10-10 12:25:24', '127.0.0.1'),
(446, 'pineda1234', '2015-10-10 12:33:16', '0000-00-00 00:00:00', '127.0.0.1'),
(447, 'pineda1234', '2015-10-10 12:33:26', '0000-00-00 00:00:00', '127.0.0.1'),
(448, 'pineda1234', '2015-10-10 12:33:33', '0000-00-00 00:00:00', '127.0.0.1'),
(449, 'pineda1234', '2015-10-10 12:34:07', '2015-10-10 12:48:08', '127.0.0.1'),
(450, 'pineda1234', '2015-10-10 12:51:35', '2015-10-10 12:56:52', '127.0.0.1'),
(451, 'pineda1234', '2015-10-10 13:18:59', '2015-10-10 13:24:30', '127.0.0.1'),
(452, 'pineda1234', '2015-10-10 13:27:26', '2015-10-10 13:36:03', '127.0.0.1'),
(453, 'pineda1234', '2015-10-10 15:34:57', '2015-10-10 19:04:09', '127.0.0.1'),
(454, 'pineda1234', '2015-10-11 17:04:00', '2015-10-11 17:34:24', '127.0.0.1'),
(455, 'pineda1234', '2015-10-11 17:35:44', '2015-10-11 17:55:56', '127.0.0.1'),
(456, 'pineda1234', '2015-10-11 18:36:24', '2015-10-13 21:56:05', '127.0.0.1'),
(457, 'pineda1234', '2015-10-13 22:02:58', '2015-10-13 22:07:50', '127.0.0.1'),
(458, 'pineda1234', '2015-10-13 22:11:08', '2015-10-13 22:32:27', '127.0.0.1'),
(459, 'pineda1234', '2015-10-13 23:40:09', '2015-10-13 23:55:31', '127.0.0.1'),
(460, 'pineda1234', '2015-10-14 15:24:20', '0000-00-00 00:00:00', '127.0.0.1'),
(461, 'pineda1234', '2015-10-14 17:14:57', '2015-10-14 17:25:44', '127.0.0.1'),
(462, 'pineda1234', '2015-10-14 17:26:52', '2015-10-14 18:09:27', '127.0.0.1'),
(463, 'pineda1234', '2015-10-14 18:10:20', '2015-10-14 18:13:44', '127.0.0.1'),
(464, 'pineda1234', '2015-10-14 18:15:25', '2015-10-14 21:12:02', '127.0.0.1'),
(465, 'pineda1234', '2015-10-15 00:03:48', '2015-10-15 11:12:40', '127.0.0.1'),
(466, 'pineda1234', '2015-10-15 11:25:05', '2015-10-15 11:33:40', '127.0.0.1'),
(467, 'pineda1234', '2015-10-15 13:06:49', '2015-10-15 13:11:41', '127.0.0.1'),
(468, 'pineda1234', '2015-10-15 13:16:20', '2015-10-15 13:26:24', '127.0.0.1'),
(469, 'pineda1234', '2015-10-15 15:32:30', '2015-10-15 16:24:39', '127.0.0.1'),
(470, 'pineda1234', '2015-10-15 16:34:42', '2015-10-15 17:09:46', '127.0.0.1'),
(471, 'pineda1234', '2015-10-15 17:14:52', '2015-10-15 17:28:47', '127.0.0.1'),
(472, 'pineda1234', '2015-10-15 18:58:17', '2015-10-15 19:04:10', '127.0.0.1');

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
  ADD PRIMARY KEY (`item`),
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
  ADD PRIMARY KEY (`item`),
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
-- AUTO_INCREMENT de la tabla `i_entrada`
--
ALTER TABLE `i_entrada`
  MODIFY `item` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `i_instancia_producto`
--
ALTER TABLE `i_instancia_producto`
  MODIFY `id_instancia` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT de la tabla `i_marca`
--
ALTER TABLE `i_marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `i_producto`
--
ALTER TABLE `i_producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `i_salida`
--
ALTER TABLE `i_salida`
  MODIFY `item` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `i_tipo_producto`
--
ALTER TABLE `i_tipo_producto`
  MODIFY `id_tipo_producto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `usuario_logs`
--
ALTER TABLE `usuario_logs`
  MODIFY `id_logs` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=473;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clases_has_experiencia_academica`
--
ALTER TABLE `clases_has_experiencia_academica`
  ADD CONSTRAINT `fclex` FOREIGN KEY (`ID_Clases`) REFERENCES `clases` (`ID_Clases`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`N_identidad`) REFERENCES `persona` (`N_identidad`);

--
-- Filtros para la tabla `empleado_has_cargo`
--
ALTER TABLE `empleado_has_cargo`
  ADD CONSTRAINT `empleado_has_cargo_ibfk_1` FOREIGN KEY (`No_Empleado`) REFERENCES `empleado` (`No_Empleado`),
  ADD CONSTRAINT `empleado_has_cargo_ibfk_2` FOREIGN KEY (`ID_cargo`) REFERENCES `cargo` (`ID_cargo`);

--
-- Filtros para la tabla `estudios_academico`
--
ALTER TABLE `estudios_academico`
  ADD CONSTRAINT `estudios_academico_ibfk_1` FOREIGN KEY (`ID_Tipo_estudio`) REFERENCES `tipo_estudio` (`ID_Tipo_estudio`),
  ADD CONSTRAINT `estudios_academico_ibfk_2` FOREIGN KEY (`N_identidad`) REFERENCES `persona` (`N_identidad`),
  ADD CONSTRAINT `estudios_academico_ibfk_3` FOREIGN KEY (`Id_universidad`) REFERENCES `universidad` (`Id_universidad`);

--
-- Filtros para la tabla `experiencia_laboral`
--
ALTER TABLE `experiencia_laboral`
  ADD CONSTRAINT `experiencia_laboral_ibfk_1` FOREIGN KEY (`N_identidad`) REFERENCES `persona` (`N_identidad`);

--
-- Filtros para la tabla `experiencia_laboral_has_cargo`
--
ALTER TABLE `experiencia_laboral_has_cargo`
  ADD CONSTRAINT `experiencia_laboral_has_cargo_ibfk_1` FOREIGN KEY (`ID_Experiencia_laboral`) REFERENCES `experiencia_laboral` (`ID_Experiencia_laboral`),
  ADD CONSTRAINT `experiencia_laboral_has_cargo_ibfk_2` FOREIGN KEY (`ID_cargo`) REFERENCES `cargo` (`ID_cargo`);

--
-- Filtros para la tabla `idioma_has_persona`
--
ALTER TABLE `idioma_has_persona`
  ADD CONSTRAINT `idioma_has_persona_ibfk_1` FOREIGN KEY (`ID_Idioma`) REFERENCES `idioma` (`ID_Idioma`),
  ADD CONSTRAINT `idioma_has_persona_ibfk_2` FOREIGN KEY (`N_identidad`) REFERENCES `persona` (`N_identidad`);

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
