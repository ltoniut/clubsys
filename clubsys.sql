-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-03-2015 a las 16:21:16
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `clubsys`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `agregar_actividad`(IN `instructor` INT, IN `nombre` VARCHAR(200), IN `descripcion` VARCHAR(200), IN `fecha_inicio` DATE)
    NO SQL
BEGIN

INSERT INTO `actividad`(`instructor_id`, `nombre`, `descripcion`) VALUES (instructor,nombre,descripcion);

INSERT INTO `historial_horario`(`actividad`, `fecha_implementacion`) VALUES ((SELECT id FROM actividad ORDER BY id DESC LIMIT 1),fecha_inicio);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `agregar_historial_horario`(IN `actividad` INT, IN `fecha_inicio` INT)
    NO SQL
BEGIN

	INSERT INTO `historial_horario`(`actividad_id`, `fecha_implementacion`)
    VALUES (actividad,fecha_inicio);
    
    DELETE FROM `clase` WHERE clase.actividad_id = actividad
    AND clase.fecha > fecha_inicio;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `agregar_horario`(IN `actividad` INT, IN `dia` INT, IN `horario_llegada` TIME, IN `hora_salida` TIME)
    NO SQL
BEGIN

INSERT INTO `horario`(`hora_entrada`, `hora_salida`, `dia`, `historial_id`) VALUES (horario_llegada,hora_salida,dia, (SELECT id FROM historial_horario WHERE actividad_id = actividad
ORDER BY id DESC LIMIT 1));


SELECT @primerDia := `fecha_implementacion`
FROM historial_horario
WHERE historial_horario.actividad_id = actividad
ORDER BY id DESC LIMIT 1;

SELECT @cantidad := COUNT(*) FROM actividad
INNER JOIN historial_horario INNER JOIN horario
WHERE historial_horario.actividad_id = actividad.id
AND horario.historial_id = historial_horario.id;

SELECT @horario := horario.dia as dia FROM actividad
INNER JOIN historial_horario INNER JOIN horario
WHERE historial_horario.actividad_id = actividad.id
AND horario.historial_id = historial_horario.id
ORDER BY horario.id DESC LIMIT 1;



    WHILE WEEKDAY(@primerDia) != dia DO
        SET @primerDia = DATE_ADD(@primerDia, INTERVAL 1 DAY);
    END WHILE;

    WHILE YEAR(@primerDia) = YEAR(CURDATE()) DO
        INSERT INTO `clase`(`actividad_id`, `fecha`)
        VALUES (actividad,@primerDia);
        
        SET @primerDia = DATE_ADD(@primerDia, INTERVAL 7 DAY);
    END WHILE;
    
    
    SELECT WEEKDAY(@primerDia);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `agregar_usuario`(IN `tipo` INT, IN `nombres` VARCHAR(150), IN `apellido` VARCHAR(100), IN `pass` VARCHAR(100), IN `direccion` VARCHAR(150), IN `nacimiento` DATE)
    NO SQL
INSERT INTO `usuario`(`tipo_id`, `nombres`, `apellido`, `hash`, `direccion`, `fecha_nacimiento`) VALUES (tipo,nombres,apellido,PASSWORD(pass),direccion,nacimiento)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE IF NOT EXISTS `actividad` (
`id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `nombre` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` varchar(800) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`id`, `instructor_id`, `nombre`, `descripcion`) VALUES
(1, 4, 'natación', 'La natación es un deporte que consiste en el desplazamiento de una persona en el agua, sin que esta toque el suelo. Es regulado por la Federación Internacional de Natación.'),
(2, 7, 'sumo', 'Sumo es un tipo de lucha libre donde dos luchadores contrincantes o rikishi se enfrentan en un área circular. Es de origen japonés y mantiene gran parte de la tradición sintoista antigua.'),
(3, 8, 'aikido', 'El aikidō es un gendai budō o arte marcial moderno del Japón.Fue desarrollado inicialmente por el maestro Morihei Ueshiba (1883-1969), aproximadamente entre los años de 1930 y 1960.La característica fundamental del Aikido es la búsqueda de la neutralización del contrario en situaciones de conflicto, dando lugar a la derrota del adversario sin dañarlo, en lugar de simplemente destruirlo o humillarlo.'),
(4, 1, 'futbol', 'holasasa'),
(5, 1, 'futbol', 'holasasa'),
(6, 1, 'Futbol', 'Holaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad_por_usuario`
--

CREATE TABLE IF NOT EXISTS `actividad_por_usuario` (
  `fecha_inicio` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_finalizacion` date DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  `actividad_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

--
-- Volcado de datos para la tabla `actividad_por_usuario`
--

INSERT INTO `actividad_por_usuario` (`fecha_inicio`, `fecha_finalizacion`, `usuario_id`, `actividad_id`) VALUES
('2015-03-06 12:52:10', NULL, 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncio`
--

CREATE TABLE IF NOT EXISTS `anuncio` (
`id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `titulo` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `contenido` varchar(10000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=ascii AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

--
-- Volcado de datos para la tabla `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('e908ece5150c307587a152785921738b', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', 1426605158, 'a:1:{s:15:"flash:new:error";s:353:"<div class="alert alert-danger" role="alert">El campo Nombres es obligatorio.</div>\n<div class="alert alert-danger" role="alert">El campo Apellidos es obligatorio.</div>\n<div class="alert alert-danger" role="alert">El campo Direcci?n es obligatorio.</div>\n<div class="alert alert-danger" role="alert">El campo Fecha de nacimiento es obligatorio.</div>\n";}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase`
--

CREATE TABLE IF NOT EXISTS `clase` (
`id` int(11) NOT NULL,
  `actividad_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=194 ;

--
-- Volcado de datos para la tabla `clase`
--

INSERT INTO `clase` (`id`, `actividad_id`, `fecha`, `descripcion`) VALUES
(41, 2, '2015-07-19', NULL),
(42, 2, '2015-07-26', NULL),
(43, 2, '2015-08-02', NULL),
(44, 2, '2015-08-09', NULL),
(45, 2, '2015-08-16', NULL),
(46, 2, '2015-08-23', NULL),
(47, 2, '2015-08-30', NULL),
(48, 2, '2015-09-06', NULL),
(49, 2, '2015-09-13', NULL),
(50, 2, '2015-09-20', NULL),
(51, 2, '2015-09-27', NULL),
(52, 2, '2015-10-04', NULL),
(53, 2, '2015-10-11', NULL),
(54, 2, '2015-10-18', NULL),
(55, 2, '2015-10-25', NULL),
(56, 2, '2015-11-01', NULL),
(57, 2, '2015-11-08', NULL),
(58, 2, '2015-11-15', NULL),
(59, 2, '2015-11-22', NULL),
(60, 2, '2015-11-29', NULL),
(61, 2, '2015-12-06', NULL),
(62, 2, '2015-12-13', NULL),
(63, 2, '2015-12-20', NULL),
(64, 2, '2015-12-27', NULL),
(65, 2, '2015-07-16', NULL),
(66, 2, '2015-07-23', NULL),
(67, 2, '2015-07-30', NULL),
(68, 2, '2015-08-06', NULL),
(69, 2, '2015-08-13', NULL),
(70, 2, '2015-08-20', NULL),
(71, 2, '2015-08-27', NULL),
(72, 2, '2015-09-03', NULL),
(73, 2, '2015-09-10', NULL),
(74, 2, '2015-09-17', NULL),
(75, 2, '2015-09-24', NULL),
(76, 2, '2015-10-01', NULL),
(77, 2, '2015-10-08', NULL),
(78, 2, '2015-10-15', NULL),
(79, 2, '2015-10-22', NULL),
(80, 2, '2015-10-29', NULL),
(81, 2, '2015-11-05', NULL),
(82, 2, '2015-11-12', NULL),
(83, 2, '2015-11-19', NULL),
(84, 2, '2015-11-26', NULL),
(85, 2, '2015-12-03', NULL),
(86, 2, '2015-12-10', NULL),
(87, 2, '2015-12-17', NULL),
(88, 2, '2015-12-24', NULL),
(89, 2, '2015-12-31', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase_por_usuario`
--

CREATE TABLE IF NOT EXISTS `clase_por_usuario` (
  `usuario_id` int(11) NOT NULL,
  `id_clase` int(11) NOT NULL,
  `horario_llegada` time DEFAULT NULL,
  `hora_salida` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
`id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `anuncio_id` int(11) NOT NULL,
  `conenido` varchar(2000) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=ascii AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiqueta`
--

CREATE TABLE IF NOT EXISTS `etiqueta` (
`id` int(11) NOT NULL,
  `nombre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiqueta_por_anuncio`
--

CREATE TABLE IF NOT EXISTS `etiqueta_por_anuncio` (
  `anuncio_id` int(11) NOT NULL,
  `etiqueta_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_horario`
--

CREATE TABLE IF NOT EXISTS `historial_horario` (
`id` int(11) NOT NULL,
  `actividad_id` int(11) NOT NULL,
  `fecha_implementacion` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `historial_horario`
--

INSERT INTO `historial_horario` (`id`, `actividad_id`, `fecha_implementacion`) VALUES
(1, 3, '2015-05-01'),
(2, 4, '2015-03-12'),
(3, 5, '2015-03-12'),
(4, 6, '2015-03-12'),
(5, 1, '2015-04-14'),
(6, 2, '2015-07-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_precio`
--

CREATE TABLE IF NOT EXISTS `historial_precio` (
`id` int(11) NOT NULL,
  `fecha_implementacion` date NOT NULL,
  `tipo_pago` int(11) NOT NULL,
  `actividad_id` int(11) DEFAULT NULL,
  `valor` decimal(11,2) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `historial_precio`
--

INSERT INTO `historial_precio` (`id`, `fecha_implementacion`, `tipo_pago`, `actividad_id`, `valor`) VALUES
(1, '2015-01-01', 1, NULL, '1240.34'),
(2, '2015-01-01', 2, NULL, '230.00'),
(3, '2015-04-01', 2, NULL, '270.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE IF NOT EXISTS `horario` (
`id` int(11) NOT NULL,
  `historial_id` int(11) NOT NULL,
  `hora_entrada` time NOT NULL,
  `hora_salida` time NOT NULL,
  `dia` tinyint(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`id`, `historial_id`, `hora_entrada`, `hora_salida`, `dia`) VALUES
(1, 7, '13:00:00', '16:00:00', 9),
(2, 7, '13:00:00', '15:00:00', 4),
(3, 7, '03:00:00', '15:00:00', 6),
(4, 7, '03:00:00', '15:00:00', 6),
(5, 7, '03:00:00', '15:00:00', 6),
(6, 7, '03:00:00', '15:00:00', 2),
(7, 7, '03:00:00', '15:00:00', 6),
(8, 7, '03:00:00', '15:00:00', 6),
(9, 7, '03:00:00', '15:00:00', 6),
(10, 7, '03:00:00', '15:00:00', 3),
(11, 6, '03:00:00', '15:00:00', 6),
(12, 6, '03:00:00', '15:00:00', 3),
(13, 8, '03:00:00', '15:00:00', 2),
(14, 8, '03:00:00', '15:00:00', 4);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `lista_actividades`
--
CREATE TABLE IF NOT EXISTS `lista_actividades` (
`id` int(11)
,`instructor` varchar(202)
,`nombre` varchar(30)
,`descripcion` varchar(800)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `lista_clase`
--
CREATE TABLE IF NOT EXISTS `lista_clase` (
`nombre` varchar(30)
,`CONCAT(usuario.apellido,', ', usuario.nombres)` varchar(202)
,`fecha` date
,`descripcion` varchar(200)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `lista_usuarios`
--
CREATE TABLE IF NOT EXISTS `lista_usuarios` (
`#` int(11)
,`tipoId` int(11)
,`Tipo` varchar(120)
,`Apellidos y nombres` varchar(202)
,`Dirección` varchar(100)
,`Fecha de nacimiento` date
,`Fecha de inscripción` date
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE IF NOT EXISTS `pago` (
`id` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `actividad_id` int(11) DEFAULT NULL,
  `tesorero` int(11) DEFAULT NULL,
  `usuario` int(11) NOT NULL,
  `mes` date NOT NULL,
  `vencimiento` date NOT NULL,
  `fecha_abonado` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE IF NOT EXISTS `permiso` (
`id` int(11) NOT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id`, `descripcion`) VALUES
(1, 'escribir blog'),
(2, 'registrar asistencias'),
(3, 'describir actividad'),
(4, 'efectuar cobros'),
(5, 'modificar precios'),
(6, 'enviar mail a usuarios'),
(7, 'administrar usuarios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pago`
--

CREATE TABLE IF NOT EXISTS `tipo_pago` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

--
-- Volcado de datos para la tabla `tipo_pago`
--

INSERT INTO `tipo_pago` (`id`, `nombre`) VALUES
(1, 'matrícula'),
(2, 'cuota');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_por_permiso`
--

CREATE TABLE IF NOT EXISTS `tipo_por_permiso` (
  `tipo_id` tinyint(4) NOT NULL,
  `permiso_id` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

--
-- Volcado de datos para la tabla `tipo_por_permiso`
--

INSERT INTO `tipo_por_permiso` (`tipo_id`, `permiso_id`) VALUES
(1, 1),
(1, 3),
(1, 5),
(1, 6),
(1, 7),
(2, 4),
(3, 1),
(3, 2),
(2, 6),
(3, 3),
(3, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE IF NOT EXISTS `tipo_usuario` (
`id` int(11) NOT NULL,
  `nombre` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id`, `nombre`) VALUES
(1, 'administrador'),
(2, 'tesorero'),
(3, 'instructor'),
(4, 'socio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
`id` int(11) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `nombres` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellido` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `direccion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `hora_inscripcion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `tipo_id`, `nombres`, `apellido`, `password`, `direccion`, `fecha_nacimiento`, `hora_inscripcion`) VALUES
(1, 1, 'Michael', 'Jordan', '*948F9BEBA5FA4AD15FFF190593AC3EE1F9EDFE3F', 'Basket Blvd 512', '1973-02-17', '2015-03-06 10:32:11'),
(3, 2, 'Donald', 'Trump', '*BFA23CCF482AA32DA037CAA02C47E441539B62BB', 'Trump hotel nr. 3, 14C', '1946-06-14', '2015-03-06 10:40:03'),
(4, 3, 'Michael', 'Phelps', '*4F576A4C669E01243A30CAE93A4E54E402966BA2', 'Nobody', '1985-06-30', '2015-03-06 10:44:38'),
(5, 4, 'Tiger', 'Woods', '*D382EF28FB7C47A3650AB8C4759F31A348014994', 'House of Tiger 34', '1975-12-30', '2015-03-06 10:54:54'),
(6, 4, 'Aaron', 'Peirsol', '*EE780D4E296B6274F126A02EDDC3475B41C1D8AC', 'irvania', '1983-07-23', '2015-03-06 11:14:41'),
(7, 3, 'Rikisaburo', 'Kakuryu', '*7E5E8E5443C19887D307CF1FC86FB31ACF0CB25F', 'Gran Templo numero 3', '1985-08-10', '2015-03-06 12:11:12'),
(8, 3, 'Masafumi', 'Sakanashi', '*4E26442531A60232D7E3B2CB44295EC6997CC04A', 'Quilmes 3', '1954-10-31', '2015-03-12 10:37:19');

-- --------------------------------------------------------

--
-- Estructura para la vista `lista_actividades`
--
DROP TABLE IF EXISTS `lista_actividades`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lista_actividades` AS select `actividad`.`id` AS `id`,concat(`usuario`.`apellido`,', ',`usuario`.`nombres`) AS `instructor`,`actividad`.`nombre` AS `nombre`,`actividad`.`descripcion` AS `descripcion` from (`actividad` join `usuario` on((`actividad`.`instructor_id` = `usuario`.`id`)));

-- --------------------------------------------------------

--
-- Estructura para la vista `lista_clase`
--
DROP TABLE IF EXISTS `lista_clase`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lista_clase` AS select `actividad`.`nombre` AS `nombre`,concat(`usuario`.`apellido`,', ',`usuario`.`nombres`) AS `CONCAT(usuario.apellido,', ', usuario.nombres)`,`clase`.`fecha` AS `fecha`,`clase`.`descripcion` AS `descripcion` from ((`clase` join `actividad`) join `usuario` on(((`clase`.`actividad_id` = `actividad`.`id`) and (`actividad`.`instructor_id` = `usuario`.`id`)))) order by `clase`.`fecha`;

-- --------------------------------------------------------

--
-- Estructura para la vista `lista_usuarios`
--
DROP TABLE IF EXISTS `lista_usuarios`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lista_usuarios` AS select `usuario`.`id` AS `#`,`tipo_usuario`.`id` AS `tipoId`,concat(ucase(left(`tipo_usuario`.`nombre`,1)),substr(`tipo_usuario`.`nombre`,2)) AS `Tipo`,concat(`usuario`.`apellido`,', ',`usuario`.`nombres`) AS `Apellidos y nombres`,`usuario`.`direccion` AS `Dirección`,`usuario`.`fecha_nacimiento` AS `Fecha de nacimiento`,cast(`usuario`.`hora_inscripcion` as date) AS `Fecha de inscripción` from (`usuario` join `tipo_usuario`) where (`usuario`.`tipo_id` = `tipo_usuario`.`id`);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `anuncio`
--
ALTER TABLE `anuncio`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ci_sessions`
--
ALTER TABLE `ci_sessions`
 ADD PRIMARY KEY (`session_id`), ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indices de la tabla `clase`
--
ALTER TABLE `clase`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `etiqueta`
--
ALTER TABLE `etiqueta`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial_horario`
--
ALTER TABLE `historial_horario`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial_precio`
--
ALTER TABLE `historial_precio`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `anuncio`
--
ALTER TABLE `anuncio`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `clase`
--
ALTER TABLE `clase`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=194;
--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `etiqueta`
--
ALTER TABLE `etiqueta`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `historial_horario`
--
ALTER TABLE `historial_horario`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `historial_precio`
--
ALTER TABLE `historial_precio`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
