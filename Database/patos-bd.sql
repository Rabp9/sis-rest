-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 18-06-2014 a las 21:36:15
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `patos-bd`
--
CREATE DATABASE IF NOT EXISTS `patos-bd` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `patos-bd`;

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_mesasReservas`(IN _fechaHora DATETIME)
BEGIN
	SELECT
		m.idMesa,
		m.descripcion,
		CASE WHEN fn_reservado(m.idMesa, _fechaHora) IS NOT NULL 
			THEN 'SI'
			ELSE 'NO'
		END AS 'reservado'
	FROM 
		Mesa m;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_reporteConsumo`(IN _fechaInicio DATE, IN _fechaFin DATE)
BEGIN
	SELECT
		pl.descripcion,
		pl.precio,
		SUM(dp.cantidad) 'cantidad',
		SUM(dp.importe) 'importe'
	FROM
		Producto pl
		INNER JOIN DetallePedido dp ON dp.idProducto = pl.idProducto
		INNER JOIN Pedido pd ON pd.idPedido = dp.idPedido
	WHERE 
		pl.estado = 1
		AND pd.fecha BETWEEN _fechaInicio AND _fechaFin
	GROUP BY pl.descripcion
	ORDER BY pl.descripcion ASC;
END$$

--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `fn_reservado`(_idMesa INT, _fechaHora DATETIME) RETURNS char(5) CHARSET utf8
    DETERMINISTIC
BEGIN
	DECLARE _reservado CHAR(5);
	SET _reservado = (
		SELECT
			r.idReserva
		FROM
			Mesa m 
			LEFT JOIN Reserva r ON r.idMesa = m.idMesa
			LEFT JOIN Hora h ON h.idHora = r.idHora
		WHERE m.idMesa = _idMesa AND h.horaInicio = _fechaHora
	);

	RETURN _reservado;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fn_ultimaFechaReserva`() RETURNS date
    DETERMINISTIC
BEGIN
	DECLARE _fecha DATE;
	SET _fecha = (
		SELECT
			DATE(h.horaInicio)
		FROM 
			Hora h
		ORDER BY h.horaInicio desc
		LIMIT 1
	);

	RETURN _fecha;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `idCliente` char(5) NOT NULL,
  `nombres` varchar(60) NOT NULL,
  `apellidoPaterno` varchar(40) NOT NULL,
  `apellidoMaterno` varchar(40) NOT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `direccion` varchar(60) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `idUsuario` char(3) DEFAULT NULL,
  `estado` char(1) NOT NULL,
  PRIMARY KEY (`idCliente`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idCliente`, `nombres`, `apellidoPaterno`, `apellidoMaterno`, `telefono`, `direccion`, `email`, `idUsuario`, `estado`) VALUES
('C0001', 'Guillermo', 'Juarez', 'Linares', '95354605', 'Jr. Amadeus 205', 'guillermo@hotmail.com', 'U03', '1'),
('C0002', 'Claudio', 'Fernandez', 'Reyes', '975624605', 'Jr. Costa Rica 412', 'cfernandez@gmail.com', NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedido`
--

CREATE TABLE IF NOT EXISTS `detallepedido` (
  `idDetallePedido` int(11) NOT NULL AUTO_INCREMENT,
  `idPedido` char(5) NOT NULL,
  `idProducto` char(4) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `importe` decimal(6,2) DEFAULT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idDetallePedido`,`idPedido`,`idProducto`),
  KEY `fk_DetallePedido_Pedido_idx` (`idPedido`),
  KEY `fk_DetallePedido_Producto1_idx` (`idProducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `detallepedido`
--

INSERT INTO `detallepedido` (`idDetallePedido`, `idPedido`, `idProducto`, `cantidad`, `importe`, `estado`) VALUES
(1, 'O0001', 'P003', 2, '40.00', '1'),
(2, 'O0001', 'P001', 7, '119.00', '1'),
(3, 'O0001', 'P002', 1, '17.00', '1'),
(4, 'O0002', 'P001', 1, '17.00', '1'),
(5, 'O0002', 'P003', 1, '20.00', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hora`
--

CREATE TABLE IF NOT EXISTS `hora` (
  `idHora` int(11) NOT NULL AUTO_INCREMENT,
  `horaInicio` datetime NOT NULL,
  `horaFin` datetime NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idHora`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `hora`
--

INSERT INTO `hora` (`idHora`, `horaInicio`, `horaFin`, `estado`) VALUES
(1, '2014-06-13 11:00:00', '2014-06-13 13:00:00', '1'),
(2, '2014-06-13 13:00:00', '2014-06-13 15:00:00', '1'),
(3, '2014-06-13 15:00:00', '2014-06-13 17:00:00', '1'),
(4, '2014-06-14 11:00:00', '2014-06-14 13:00:00', '1'),
(5, '2014-06-14 13:00:00', '2014-06-14 15:00:00', '1'),
(6, '2014-06-14 15:00:00', '2014-06-14 17:00:00', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugar`
--

CREATE TABLE IF NOT EXISTS `lugar` (
  `idLugar` char(3) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` varchar(700) NOT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `estado` char(1) NOT NULL,
  PRIMARY KEY (`idLugar`),
  UNIQUE KEY `titulo_UNIQUE` (`titulo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `lugar`
--

INSERT INTO `lugar` (`idLugar`, `titulo`, `descripcion`, `foto`, `estado`) VALUES
('L01', 'La Casona de Talambo', 'La Casona se encuentra en el poblado de Talambo, ubicado a 3 Km. Al este de la Ciudad de Chepén. Talambo, tiene un rico y milenario pasado histórico, evidenciado en el canal Mochica “Acequia Talambo” y en el incidente producido entre trabajadores talambinos y vascos, el 4 de agosto de 1863, causa de la guerra con España, que terminó con el triunfo del combate del 2 de mayo de 1866.', 'casona-talambo.jpg', '1'),
('L02', 'Complejo Lurifico', 'El conjunto arquitectónico Lurifico, se encuentra en el Km. 698 de la carretera Panamericana Norte, en la ciudad de Chepén. Está Construido casi en su totalidad con barro y adobe, utilizando en pocos espacios el ladrillo. Se dice que fue sede del cuartel general de don Simón Bolívar, en su paso de Lambayeque a Trujillo. Aquí funcionó la única fábrica de alcohol en el país de esa época, además las fábricas de jabón, azúcar y aceite, trabajados por esclavos chinos, de cuya existencia quedan como evidencia los galpones.', 'complejo-lurifico.jpg', '1'),
('L03', 'Playa Cherrepe	', 'Playa Chérrepe está situada en el límite entre La Libertad y Lambayeque, en una zona de bellezas y contrastes. En esta hermosa playa se muestra sus lugares, sus imágenes, su naturaleza, su geografía, su historia, su belleza, sus costumbres, su cocina…', 'cherrepe.jpg', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE IF NOT EXISTS `mesa` (
  `idMesa` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(40) NOT NULL,
  `estado` char(1) NOT NULL,
  PRIMARY KEY (`idMesa`),
  UNIQUE KEY `descripcion_UNIQUE` (`descripcion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`idMesa`, `descripcion`, `estado`) VALUES
(1, 'Mesa 1', '1'),
(2, 'Mesa 2', '1'),
(3, 'Mesa 3', '1'),
(4, 'Mesa 4', '1'),
(5, 'Mesa 5', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mozo`
--

CREATE TABLE IF NOT EXISTS `mozo` (
  `idMozo` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` char(3) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidoPaterno` varchar(40) NOT NULL,
  `apellidoMaterno` varchar(40) NOT NULL,
  `direccion` varchar(60) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idMozo`,`idUsuario`),
  KEY `fk_Mozo_Usuario1_idx` (`idUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `mozo`
--

INSERT INTO `mozo` (`idMozo`, `idUsuario`, `nombres`, `apellidoPaterno`, `apellidoMaterno`, `direccion`, `telefono`, `estado`) VALUES
(1, 'U02', 'Miguel', 'Ramirez', 'Mendoza', 'Jr. Las Rosas 250 - Urb. Los Floripondios', '946678914', '1'),
(2, 'U04', 'Juan', 'Peralta', 'Flores', 'Jr. Las Rocas 150 - Urb. Los Ladrillos', '916878951', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `idPedido` char(5) NOT NULL,
  `idMesa` int(11) NOT NULL,
  `idCliente` char(5) NOT NULL,
  `idMozo` int(11) NOT NULL,
  `idUsuario` char(3) NOT NULL,
  `fecha` date NOT NULL,
  `importeTotal` decimal(6,2) DEFAULT NULL,
  `observaciones` varchar(600) DEFAULT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idPedido`,`idMesa`,`idCliente`,`idMozo`,`idUsuario`),
  KEY `fk_Pedido_Mesa1_idx` (`idMesa`),
  KEY `fk_Pedido_Cliente1_idx` (`idCliente`),
  KEY `fk_Pedido_Mozo1_idx` (`idMozo`),
  KEY `fk_Pedido_Usuario1_idx` (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`idPedido`, `idMesa`, `idCliente`, `idMozo`, `idUsuario`, `fecha`, `importeTotal`, `observaciones`, `estado`) VALUES
('O0001', 3, 'C0002', 1, 'U02', '2014-06-15', '176.00', '', '1'),
('O0002', 3, 'C0001', 1, 'U02', '2014-06-15', '37.00', '', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `idProducto` char(4) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `precio` decimal(4,2) NOT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `estado` char(1) NOT NULL,
  PRIMARY KEY (`idProducto`),
  UNIQUE KEY `descripcion_UNIQUE` (`descripcion`),
  UNIQUE KEY `foto_UNIQUE` (`foto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `descripcion`, `precio`, `foto`, `estado`) VALUES
('P001', 'Arroz con Pato', '17.00', 'arroz-con-pato.jpg', '1'),
('P002', 'Pollo a la Brasa', '17.00', 'pollo-brasa.jpg', '1'),
('P003', 'Lomo Saltado', '20.00', 'lomo-saltado.jpg', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE IF NOT EXISTS `reserva` (
  `idReserva` char(5) NOT NULL,
  `idMesa` int(11) NOT NULL,
  `idHora` int(11) NOT NULL,
  `idUsuario` char(3) NOT NULL,
  `fechaHora` datetime NOT NULL,
  `nPersonas` int(11) DEFAULT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idReserva`,`idMesa`,`idHora`,`idUsuario`),
  KEY `fk_Reserva_Mesa1_idx` (`idMesa`),
  KEY `fk_Reserva_Hora1_idx` (`idHora`),
  KEY `fk_Reserva_Usuario1_idx` (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`idReserva`, `idMesa`, `idHora`, `idUsuario`, `fechaHora`, `nPersonas`, `estado`) VALUES
('R0001', 1, 1, 'U03', '2014-05-05 10:10:00', 2, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` char(3) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(45) DEFAULT NULL,
  `rol` varchar(20) NOT NULL,
  `estado` char(1) DEFAULT '1',
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `username`, `password`, `rol`, `estado`) VALUES
('U01', 'admin', '123', 'administrador', '1'),
('U02', 'mozo1', '456', 'mozo', '1'),
('U03', 'cliente', '123456', 'cliente', '1'),
('U04', 'mozo2', '456', 'mozo', '1'),
('U05', 'jefecocina', '654321', 'jefecocina', '1');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vw_cliente`
--
CREATE TABLE IF NOT EXISTS `vw_cliente` (
`idCliente` char(5)
,`nombreCompleto` varchar(143)
,`telefono` varchar(10)
,`direccion` varchar(60)
,`email` varchar(45)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vw_detallepedido`
--
CREATE TABLE IF NOT EXISTS `vw_detallepedido` (
`idPedido` char(5)
,`idProducto` char(4)
,`producto` varchar(50)
,`precio` decimal(4,2)
,`cantidad` int(11)
,`importe` decimal(6,2)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vw_mozo`
--
CREATE TABLE IF NOT EXISTS `vw_mozo` (
`idMozo` int(11)
,`nombreCompleto` varchar(133)
,`telefono` varchar(10)
,`direccion` varchar(60)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vw_pedido`
--
CREATE TABLE IF NOT EXISTS `vw_pedido` (
`idPedido` char(5)
,`idCliente` char(5)
,`cliente` varchar(143)
,`mesa` varchar(40)
,`idMozo` int(11)
,`mozo` varchar(133)
,`fecha` date
,`importeTotal` decimal(6,2)
,`estado` char(1)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vw_reportepedidos`
--
CREATE TABLE IF NOT EXISTS `vw_reportepedidos` (
`idPedido` char(5)
,`nombreCompleto` varchar(143)
,`descripcion` varchar(40)
,`fecha` date
,`productos` decimal(32,0)
,`importeTotal` decimal(6,2)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vw_reservas`
--
CREATE TABLE IF NOT EXISTS `vw_reservas` (
`idReserva` char(5)
,`idUsuario` char(3)
,`mesa` varchar(40)
,`hora` varchar(41)
,`nPersonas` int(11)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vw_reservasactuales`
--
CREATE TABLE IF NOT EXISTS `vw_reservasactuales` (
`fecha` date
,`reservas` bigint(21)
);
-- --------------------------------------------------------

--
-- Estructura para la vista `vw_cliente`
--
DROP TABLE IF EXISTS `vw_cliente`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_cliente` AS select `c`.`idCliente` AS `idCliente`,concat(`c`.`apellidoPaterno`,' ',`c`.`apellidoMaterno`,', ',`c`.`nombres`) AS `nombreCompleto`,`c`.`telefono` AS `telefono`,`c`.`direccion` AS `direccion`,`c`.`email` AS `email` from `cliente` `c` where (`c`.`estado` = '1');

-- --------------------------------------------------------

--
-- Estructura para la vista `vw_detallepedido`
--
DROP TABLE IF EXISTS `vw_detallepedido`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_detallepedido` AS select `dp`.`idPedido` AS `idPedido`,`pl`.`idProducto` AS `idProducto`,`pl`.`descripcion` AS `producto`,`pl`.`precio` AS `precio`,`dp`.`cantidad` AS `cantidad`,`dp`.`importe` AS `importe` from (`detallepedido` `dp` join `producto` `pl` on((`dp`.`idProducto` = `pl`.`idProducto`))) order by `pl`.`idProducto`;

-- --------------------------------------------------------

--
-- Estructura para la vista `vw_mozo`
--
DROP TABLE IF EXISTS `vw_mozo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_mozo` AS select `m`.`idMozo` AS `idMozo`,concat(`m`.`apellidoPaterno`,' ',`m`.`apellidoMaterno`,', ',`m`.`nombres`) AS `nombreCompleto`,`m`.`telefono` AS `telefono`,`m`.`direccion` AS `direccion` from `mozo` `m` where (`m`.`estado` = '1');

-- --------------------------------------------------------

--
-- Estructura para la vista `vw_pedido`
--
DROP TABLE IF EXISTS `vw_pedido`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_pedido` AS select `p`.`idPedido` AS `idPedido`,`c`.`idCliente` AS `idCliente`,`c`.`nombreCompleto` AS `cliente`,`me`.`descripcion` AS `mesa`,`mo`.`idMozo` AS `idMozo`,concat(`mo`.`apellidoPaterno`,' ',`mo`.`apellidoMaterno`,', ',`mo`.`nombres`) AS `mozo`,`p`.`fecha` AS `fecha`,`p`.`importeTotal` AS `importeTotal`,`p`.`estado` AS `estado` from (((`pedido` `p` join `vw_cliente` `c` on((`p`.`idCliente` = `c`.`idCliente`))) join `mesa` `me` on((`p`.`idMesa` = `me`.`idMesa`))) join `mozo` `mo` on((`mo`.`idMozo` = `p`.`idMozo`)));

-- --------------------------------------------------------

--
-- Estructura para la vista `vw_reportepedidos`
--
DROP TABLE IF EXISTS `vw_reportepedidos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_reportepedidos` AS select `p`.`idPedido` AS `idPedido`,`c`.`nombreCompleto` AS `nombreCompleto`,`m`.`descripcion` AS `descripcion`,`p`.`fecha` AS `fecha`,sum(`dp`.`cantidad`) AS `productos`,`p`.`importeTotal` AS `importeTotal` from (((`pedido` `p` join `vw_cliente` `c` on((`p`.`idCliente` = `c`.`idCliente`))) join `mesa` `m` on((`p`.`idMesa` = `m`.`idMesa`))) join `detallepedido` `dp` on((`p`.`idPedido` = `dp`.`idPedido`))) where (`p`.`estado` = 1) group by `p`.`idPedido`;

-- --------------------------------------------------------

--
-- Estructura para la vista `vw_reservas`
--
DROP TABLE IF EXISTS `vw_reservas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_reservas` AS select `r`.`idReserva` AS `idReserva`,`r`.`idUsuario` AS `idUsuario`,`m`.`descripcion` AS `mesa`,concat(`h`.`horaInicio`,' - ',`h`.`horaFin`) AS `hora`,`r`.`nPersonas` AS `nPersonas` from ((`reserva` `r` join `mesa` `m` on((`m`.`idMesa` = `r`.`idMesa`))) join `hora` `h` on((`h`.`idHora` = `r`.`idHora`))) where (`r`.`estado` = 1);

-- --------------------------------------------------------

--
-- Estructura para la vista `vw_reservasactuales`
--
DROP TABLE IF EXISTS `vw_reservasactuales`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_reservasactuales` AS select cast(`h`.`horaInicio` as date) AS `fecha`,count(`r`.`idReserva`) AS `reservas` from (`hora` `h` left join `reserva` `r` on((`r`.`idHora` = `h`.`idHora`))) group by `fecha`;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD CONSTRAINT `fk_DetallePedido_Pedido` FOREIGN KEY (`idPedido`) REFERENCES `pedido` (`idPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DetallePedido_Producto1` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mozo`
--
ALTER TABLE `mozo`
  ADD CONSTRAINT `fk_Mozo_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_Pedido_Mesa1` FOREIGN KEY (`idMesa`) REFERENCES `mesa` (`idMesa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Pedido_Cliente1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Pedido_Mozo1` FOREIGN KEY (`idMozo`) REFERENCES `mozo` (`idMozo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Pedido_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `fk_Reserva_Mesa1` FOREIGN KEY (`idMesa`) REFERENCES `mesa` (`idMesa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Reserva_Hora1` FOREIGN KEY (`idHora`) REFERENCES `hora` (`idHora`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Reserva_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
