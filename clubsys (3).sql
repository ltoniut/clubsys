-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2015 at 02:33 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `clubsys`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `agregar_usuario`(IN `_tipo` INT, IN `_nombres` VARCHAR(150), IN `_apellido` VARCHAR(100), IN `_password` VARCHAR(100), IN `_direccion` VARCHAR(150), IN `_nacimiento` DATE)
    NO SQL
INSERT INTO `usuario`(`tipo`, `nombres`, `apellido`, `hash`, `direccion`, `fecha_nacimiento`) VALUES (_tipo,_nombres,_apellido,PASSWORD(_password),_direccion,_nacimiento)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `actividad`
--

CREATE TABLE IF NOT EXISTS `actividad` (
`id` int(11) NOT NULL,
  `instructor` int(11) NOT NULL,
  `nombre` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` varchar(800) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=3 ;

--
-- Dumping data for table `actividad`
--

INSERT INTO `actividad` (`id`, `instructor`, `nombre`, `descripcion`) VALUES
(1, 4, 'natación', 'La natación es un deporte que consiste en el desplazamiento de una persona en el agua, sin que esta toque el suelo. Es regulado por la Federación Internacional de Natación.'),
(2, 7, 'sumo', 'Sumo es un tipo de lucha libre donde dos luchadores contrincantes o rikishi se enfrentan en un área circular. Es de origen japonés y mantiene gran parte de la tradición sintoista antigua.');

-- --------------------------------------------------------

--
-- Table structure for table `actividad_por_usuario`
--

CREATE TABLE IF NOT EXISTS `actividad_por_usuario` (
  `fecha_inicio` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_finalizacion` date DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_actividad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

--
-- Dumping data for table `actividad_por_usuario`
--

INSERT INTO `actividad_por_usuario` (`fecha_inicio`, `fecha_finalizacion`, `id_usuario`, `id_actividad`) VALUES
('2015-03-06 12:52:10', NULL, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `titulo` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `contenido` varchar(10000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

-- --------------------------------------------------------

--
-- Table structure for table `clase`
--

CREATE TABLE IF NOT EXISTS `clase` (
`id` int(11) NOT NULL,
  `actividad_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `clase_por_usuario`
--

CREATE TABLE IF NOT EXISTS `clase_por_usuario` (
  `id_usuario` int(11) NOT NULL,
  `id_clase` int(11) NOT NULL,
  `horario_llegada` time NOT NULL,
  `horario_salida` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

-- --------------------------------------------------------

--
-- Table structure for table `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_blog` int(11) NOT NULL,
  `conenido` varchar(2000) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

-- --------------------------------------------------------

--
-- Table structure for table `historial_horario`
--

CREATE TABLE IF NOT EXISTS `historial_horario` (
`id` int(11) NOT NULL,
  `id_actividad` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `año` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `historial_precio`
--

CREATE TABLE IF NOT EXISTS `historial_precio` (
`id` int(11) NOT NULL,
  `fecha_implementacion` date NOT NULL,
  `tipo_pago` int(11) NOT NULL,
  `actividad` int(11) DEFAULT NULL,
  `valor` decimal(11,2) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=4 ;

--
-- Dumping data for table `historial_precio`
--

INSERT INTO `historial_precio` (`id`, `fecha_implementacion`, `tipo_pago`, `actividad`, `valor`) VALUES
(1, '2015-01-01', 1, NULL, '1240.34'),
(2, '2015-01-01', 2, NULL, '230.00'),
(3, '2015-04-01', 2, NULL, '270.00');

-- --------------------------------------------------------

--
-- Table structure for table `pago`
--

CREATE TABLE IF NOT EXISTS `pago` (
`id` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `actividad` int(11) DEFAULT NULL,
  `tesorero` int(11) DEFAULT NULL,
  `usuario` int(11) NOT NULL,
  `mes` date NOT NULL,
  `vencimiento` date NOT NULL,
  `fecha_abonado` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `permiso`
--

CREATE TABLE IF NOT EXISTS `permiso` (
`id` int(11) NOT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=8 ;

--
-- Dumping data for table `permiso`
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
-- Table structure for table `tipo_pago`
--

CREATE TABLE IF NOT EXISTS `tipo_pago` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

--
-- Dumping data for table `tipo_pago`
--

INSERT INTO `tipo_pago` (`id`, `nombre`) VALUES
(1, 'matrícula'),
(2, 'cuota');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_por_permiso`
--

CREATE TABLE IF NOT EXISTS `tipo_por_permiso` (
  `id_tipo` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

--
-- Dumping data for table `tipo_por_permiso`
--

INSERT INTO `tipo_por_permiso` (`id_tipo`, `id_permiso`) VALUES
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
-- Table structure for table `tipo_usuario`
--

CREATE TABLE IF NOT EXISTS `tipo_usuario` (
`id` int(11) NOT NULL,
  `nombre` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id`, `nombre`) VALUES
(1, 'administrador'),
(2, 'tesorero'),
(3, 'instructor'),
(4, 'socio');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
`id` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `nombres` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellido` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `hash` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `direccion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `fecha_inscripcion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=8 ;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `tipo`, `nombres`, `apellido`, `hash`, `direccion`, `fecha_nacimiento`, `fecha_inscripcion`) VALUES
(1, 1, 'Michael', 'Jordan', '*948F9BEBA5FA4AD15FFF190593AC3EE1F9EDFE3F', 'Basket Blvd 512', '1973-02-17', '2015-03-06 10:32:11'),
(3, 2, 'Donald', 'Trump', '*BFA23CCF482AA32DA037CAA02C47E441539B62BB', 'Trump hotel nr. 3, 14C', '1946-06-14', '2015-03-06 10:40:03'),
(4, 3, 'Michael', 'Phelps', '*4F576A4C669E01243A30CAE93A4E54E402966BA2', 'Nobody', '1985-06-30', '2015-03-06 10:44:38'),
(5, 4, 'Tiger', 'Woods', '*D382EF28FB7C47A3650AB8C4759F31A348014994', 'House of Tiger 34', '1975-12-30', '2015-03-06 10:54:54'),
(6, 4, 'Aaron', 'Peirsol', '*EE780D4E296B6274F126A02EDDC3475B41C1D8AC', 'irvania', '1983-07-23', '2015-03-06 11:14:41'),
(7, 3, 'Rikisaburo', 'Kakuryu', '*7E5E8E5443C19887D307CF1FC86FB31ACF0CB25F', 'Gran Templo numero 3', '1985-08-10', '2015-03-06 12:11:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actividad`
--
ALTER TABLE `actividad`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
 ADD PRIMARY KEY (`session_id`), ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `clase`
--
ALTER TABLE `clase`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `historial_horario`
--
ALTER TABLE `historial_horario`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `historial_precio`
--
ALTER TABLE `historial_precio`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pago`
--
ALTER TABLE `pago`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permiso`
--
ALTER TABLE `permiso`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipo_pago`
--
ALTER TABLE `tipo_pago`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actividad`
--
ALTER TABLE `actividad`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `clase`
--
ALTER TABLE `clase`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `historial_horario`
--
ALTER TABLE `historial_horario`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `historial_precio`
--
ALTER TABLE `historial_precio`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pago`
--
ALTER TABLE `pago`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permiso`
--
ALTER TABLE `permiso`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
