-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-01-2017 a las 18:10:50
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `euskotrunk`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `apellido` varchar(150) NOT NULL,
  `dni` varchar(10) NOT NULL,
  `direccion` varchar(250) DEFAULT NULL,
  `cp` varchar(5) DEFAULT NULL,
  `provincia` varchar(150) DEFAULT NULL,
  `telefono` int(9) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellido`, `dni`, `direccion`, `cp`, `provincia`, `telefono`, `email`) VALUES
(1, 'Estefania', 'Arocha Pasadas', 'ddfsddgfh', 'Padre, 109', '50871', 'Zaragoza', 9999999, 'esteap@altecom.es'),
(2, 'Queralt', 'Viso Gilabert', '95643716X', 'Casa Cordellas', '99999', 'Barcelona', 625418753, 'agata@hotmail.com'),
(3, 'Joan', 'Ayala Ferreras', '42852883L', 'Doctor Fleming 11', '88888', 'Bizkaia', 674125894, 'ayala@gmail.com'),
(4, 'Eliot', 'Arnau Moreno', '53086839X', 'Pintor Sert, 12 1A', '68492', 'Salamanca', 613547951, 'besugo@hotmail.es'),
(5, 'Maria', 'Isabel Comas', '94049553T', 'Jaume Galobart 12', '54781', 'Tarragona', 684212359, 'comas@gmail.es'),
(6, 'Jordi', 'Raya Gavilan', '25414813C', 'Jacint Verdaguer 52 2A', '54781', 'Girona', 624874912, 'bond@terra.es'),
(7, 'Luis', 'Zambudio Figuls', '01924859N', 'Casa Nova', '87421', 'Lleida', 687423594, 'bondd@hotmail.es'),
(8, 'Jornia', 'Aguilar Rodriguez', '14575716H', 'Galileu 12', '74258', 'Madrid', 698745123, 'f5@wandoo.es'),
(9, 'Ingrid', 'Bidault Perez', '38183662M', 'Artes 1 2N', '78521', 'Alicante', 985471354, 'exporto@hotmail.com'),
(10, 'Oliver', 'Altamiras Armenteros', '92515146S', 'Sant Bener 12 4C', '87632', 'Cantabria', 68542147, 'ato@gmail.es'),
(11, 'aaa', 'bbb', '123', 'asd', '12345', 'asdf', 1234, 'afa'),
(12, 'prueba', 'aaaa', '14918285W', 'avenida...', '14785', 'Aqui', 321654497, 'asdsa@as.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `nombre`) VALUES
(1, 'Aceptado'),
(2, 'Pendiente de aprobacion'),
(3, 'Esperando respuesta'),
(4, 'Cancelado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `usuario` varchar(150) NOT NULL,
  `alias` varchar(150) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `log`
--

INSERT INTO `log` (`id`, `idusuario`, `usuario`, `alias`, `descripcion`, `fecha`) VALUES
(35, 1, 'admin admin', 'admin', 'Borro al usuario: clientes  clientes', '2016-11-26 17:21:38'),
(36, 1, 'admin admin', 'admin', 'Registro al usuario: cli cli', '2016-11-26 17:21:51'),
(37, 1, 'admin admin', 'admin', 'Registro al usuario: usu usu', '2016-11-26 17:22:55'),
(38, 2, '', 'usu', 'Fallo de identificacion, Datos incorrectos', '2016-11-26 17:25:25'),
(39, 2, '', 'usu', 'Fallo de identificacion, Datos incorrectos', '2016-11-26 17:25:29'),
(40, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2016-11-26 17:25:33'),
(41, 1, 'admin admin', 'admin', 'Modifico datos del usuario: u u', '2016-11-26 17:25:46'),
(42, 7, 'u u', 'u', 'Identificado correctamente, acceso permitido', '2016-11-26 17:25:53'),
(43, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2016-11-26 17:26:04'),
(44, 1, 'admin admin', 'admin', 'Modifico datos del usuario: u u', '2016-11-26 17:26:11'),
(45, 7, 'u u', 'u', 'Identificado correctamente, acceso permitido', '2016-11-26 17:26:16'),
(46, 7, 'u u', 'u', 'Modifico datos del usuario: cli cli', '2016-11-26 17:36:21'),
(47, 7, 'u u', 'u', 'Modifico datos del usuario: cli cli', '2016-11-26 17:36:33'),
(48, 7, 'u u', 'u', 'Modifico datos del usuario: cli cli', '2016-11-26 17:40:18'),
(49, 7, 'u u', 'u', 'Modifico datos del usuario: cli cli', '2016-11-26 17:53:16'),
(50, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2016-11-26 17:53:28'),
(51, 1, 'admin admin', 'admin', 'Modifico datos del usuario: u u', '2016-11-26 17:53:36'),
(52, 7, 'u u', 'u', 'Identificado correctamente, acceso permitido', '2016-11-26 17:53:41'),
(53, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2016-12-04 19:20:48'),
(54, 1, 'admin admin', 'admin', 'Registro al cliente: aaa bbb', '2016-12-04 20:51:16'),
(55, 1, 'admin admin', 'admin', 'Modifico datos del cliente: Joan Ayala Ferreras', '2016-12-04 21:06:41'),
(56, 1, 'admin admin', 'admin', 'Modifico datos del cliente: Queralt Viso Gilabert', '2016-12-04 21:06:55'),
(57, 1, 'admin admin', 'admin', 'Modifico datos del cliente: Queralt Viso Gilabert', '2016-12-04 21:11:26'),
(58, 2, '', 'a', 'Fallo de identificacion, Datos incorrectos', '2016-12-08 14:23:39'),
(59, 2, '', 'a', 'Fallo de identificacion, Datos incorrectos', '2016-12-08 14:23:45'),
(60, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2016-12-08 14:23:50'),
(61, 1, 'admin admin', 'admin', 'Modifico datos del cliente: Joan Ayala Ferreras', '2016-12-08 14:24:14'),
(62, 1, 'admin admin', 'admin', 'Modifico datos del cliente: Estefania Arocha Pasadas', '2016-12-08 14:28:45'),
(63, 1, 'admin admin', 'admin', 'Modifico datos del cliente: aaa bbb', '2016-12-08 14:28:55'),
(64, 1, 'admin admin', 'admin', 'Modifico datos del cliente: Queralt Viso Gilabert', '2016-12-08 14:32:32'),
(65, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2016-12-08 15:32:35'),
(66, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2016-12-08 15:38:56'),
(67, 7, 'u u', 'u', 'Identificado correctamente, acceso permitido', '2016-12-08 16:16:01'),
(68, 2, '', 'cli', 'Fallo de identificacion, Datos incorrectos', '2016-12-08 16:16:13'),
(69, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2016-12-08 16:16:18'),
(70, 1, 'admin admin', 'admin', 'Modifico datos del cliente: Estefania Arocha Pasadas', '2016-12-08 16:20:15'),
(71, 1, 'admin admin', 'admin', 'Modifico datos del cliente: Estefania Arocha Pasadas', '2016-12-08 16:21:11'),
(72, 1, 'admin admin', 'admin', 'Modifico datos del cliente: Estefania Arocha Pasadas', '2016-12-08 16:21:26'),
(73, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2016-12-18 20:03:08'),
(74, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2016-12-18 20:20:22'),
(75, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2016-12-18 21:26:46'),
(76, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2016-12-18 21:29:13'),
(77, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2016-12-20 19:42:05'),
(78, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2016-12-21 21:07:28'),
(79, 1, 'admin admin', 'admin', 'Modifico datos del usuario:  ', '2016-12-21 23:15:39'),
(80, 1, 'admin admin', 'admin', 'Modifico datos del cliente: Estefania Arocha Pasadas', '2016-12-21 23:48:23'),
(81, 1, 'admin admin', 'admin', 'Modifico datos del cliente: Estefania Arocha Pasadas', '2016-12-21 23:50:19'),
(82, 1, 'admin admin', 'admin', 'Modifico datos del cliente: Estefania Arocha Pasadas', '2016-12-21 23:50:20'),
(83, 1, 'admin admin', 'admin', 'Modifico datos del cliente: Estefania Arocha Pasadas', '2016-12-21 23:50:21'),
(84, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2016-12-22 00:10:50'),
(85, 1, 'admin admin', 'admin', 'Modifico el pedido numero 1', '2016-12-22 00:27:35'),
(86, 1, 'admin admin', 'admin', 'Modifico el pedido numero 1', '2016-12-22 00:28:53'),
(87, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2016-12-25 16:24:33'),
(88, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-03 22:01:21'),
(89, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-03 22:01:59'),
(90, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-03 22:02:12'),
(91, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-03 22:02:46'),
(92, 2, '', 'a', 'Fallo de identificacion, Datos incorrectos', '2017-01-03 22:03:59'),
(93, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-03 22:04:04'),
(94, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-03 22:04:32'),
(95, 1, 'admin admin', 'admin', 'Vendio el vehiculo: 3', '2017-01-03 23:45:04'),
(96, 1, 'admin admin', 'admin', 'Vendio el vehiculo: 7', '2017-01-03 23:48:50'),
(97, 1, 'admin admin', 'admin', 'Vendio el vehiculo: 6', '2017-01-04 00:19:18'),
(98, 1, 'admin admin', 'admin', 'Vendio el vehiculo: 6', '2017-01-04 00:20:32'),
(99, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-06 15:44:39'),
(100, 2, '', 'admin', 'Fallo de identificacion, Datos incorrectos', '2017-01-06 19:35:04'),
(101, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-06 19:35:08'),
(102, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-10 20:27:07'),
(103, 2, '', '', 'Fallo de identificacion, Datos incorrectos', '2017-01-10 22:33:54'),
(104, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-10 22:34:13'),
(105, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-10 22:35:58'),
(106, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-11 19:28:53'),
(107, 1, 'admin admin', 'admin', 'Borro al usuario: u  u', '2017-01-11 20:19:48'),
(108, 1, 'admin admin', 'admin', 'Registro al usuario: prueba prueba', '2017-01-11 20:20:02'),
(109, 8, 'prueba prueba', 'prueba', 'Identificado correctamente, acceso permitido', '2017-01-11 20:20:11'),
(110, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-11 20:21:31'),
(111, 1, 'admin admin', 'admin', 'Modifico datos del cliente: Queralt Viso Gilabert', '2017-01-11 20:21:45'),
(112, 1, 'admin admin', 'admin', 'Registro al cliente: prueba aaaa', '2017-01-11 20:22:26'),
(113, 1, 'admin admin', 'admin', 'Vendio el vehiculo: 1', '2017-01-11 20:23:10'),
(114, 1, 'admin admin', 'admin', 'Modifico datos del usuario: prueba prueba', '2017-01-11 21:21:34'),
(115, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-15 20:16:34'),
(116, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-15 20:37:27'),
(117, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-15 20:55:30'),
(120, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-15 21:06:22'),
(121, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-15 21:15:35'),
(122, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-15 21:16:35'),
(123, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-15 21:24:31'),
(124, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-17 21:09:25'),
(125, 1, 'admin admin', 'admin', 'Modifico datos del usuario: cli cli', '2017-01-17 21:12:29'),
(126, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-17 21:12:53'),
(127, 1, 'admin admin', 'admin', 'Modifico datos del usuario: cli cli', '2017-01-17 21:13:01'),
(128, 6, 'cli cli', 'clicli', 'Identificado correctamente, acceso permitido', '2017-01-17 21:15:07'),
(129, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-17 21:33:00'),
(130, 1, 'admin admin', 'admin', 'Modifico el pedido numero 16', '2017-01-17 23:08:09'),
(131, 1, 'admin admin', 'admin', 'Modifico el pedido numero 18', '2017-01-17 23:08:35'),
(132, 1, 'admin admin', 'admin', 'Modifico el pedido numero 18', '2017-01-17 23:09:03'),
(133, 1, 'admin admin', 'admin', 'Modifico el pedido numero 18', '2017-01-17 23:09:19'),
(134, 1, 'admin admin', 'admin', 'Modifico el pedido numero 18', '2017-01-17 23:13:00'),
(135, 1, 'admin admin', 'admin', 'Modifico el pedido numero 18', '2017-01-17 23:14:10'),
(136, 1, 'admin admin', 'admin', 'Modifico el pedido numero 18', '2017-01-17 23:14:28'),
(137, 1, 'admin admin', 'admin', 'Modifico el pedido numero 18', '2017-01-17 23:15:12'),
(138, 1, 'admin admin', 'admin', 'Modifico el pedido numero 18', '2017-01-17 23:15:36'),
(139, 1, 'admin admin', 'admin', 'Modifico el pedido numero 18', '2017-01-17 23:16:56'),
(140, 1, 'admin admin', 'admin', 'Modifico el pedido numero 18', '2017-01-17 23:17:09'),
(142, 1, ' ', '', 'Creo el PDF del vehiculo 1', '2017-01-18 00:24:36'),
(143, 1, 'admin admin', 'admin', 'Creo el PDF del vehiculo 1', '2017-01-18 00:24:56'),
(144, 1, 'admin admin', 'admin', 'Creo el PDF del vehiculo 6', '2017-01-18 00:27:25'),
(145, 1, 'admin admin', 'admin', 'Creo el PDF de la venta ', '2017-01-18 00:27:36'),
(146, 1, 'admin admin', 'admin', 'Creo el PDF de la venta ', '2017-01-18 00:28:22'),
(147, 1, 'admin admin', 'admin', 'Creo el PDF de la venta ', '2017-01-18 00:29:12'),
(148, 1, 'admin admin', 'admin', 'Creo el PDF de la venta 18', '2017-01-18 00:30:13'),
(149, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-19 20:15:16'),
(150, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-19 20:19:15'),
(151, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-19 20:53:00'),
(152, 1, 'admin admin', 'admin', 'Creo el PDF de la venta 18', '2017-01-19 21:41:17'),
(153, 1, 'admin admin', 'admin', 'Vendio el vehiculo: 5', '2017-01-19 21:45:51'),
(154, 1, 'admin admin', 'admin', 'Vendio el vehiculo: 5', '2017-01-19 21:46:55'),
(155, 1, 'admin admin', 'admin', 'Modifico el pedido numero 19', '2017-01-19 21:47:24'),
(156, 1, 'admin admin', 'admin', 'Modifico el pedido numero 20', '2017-01-19 21:47:50'),
(157, 1, 'admin admin', 'admin', 'Modifico el pedido numero 16', '2017-01-19 21:48:07'),
(158, 1, 'admin admin', 'admin', 'Modifico el pedido numero 2', '2017-01-19 21:48:54'),
(159, 1, 'admin admin', 'admin', 'Creo el PDF del vehiculo 1', '2017-01-19 21:58:59'),
(160, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-20 00:11:46'),
(161, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-20 00:11:55'),
(162, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-20 00:12:18'),
(163, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-20 00:15:30'),
(164, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-20 18:46:03'),
(165, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-20 19:22:15'),
(166, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-20 20:39:44'),
(167, 1, 'admin admin', 'admin', 'Modifico el pedido numero ', '2017-01-20 21:19:07'),
(168, 1, 'admin admin', 'admin', 'Modifico el pedido numero ', '2017-01-20 21:19:35'),
(169, 1, 'admin admin', 'admin', 'Envio un mensaje al cliente ', '2017-01-20 21:22:01'),
(170, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-20 23:41:17'),
(171, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-20 23:47:03'),
(172, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-20 23:50:52'),
(173, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-21 00:02:07'),
(174, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-21 00:10:26'),
(175, 1, 'admin admin', 'admin', 'Creo el PDF de la venta 19', '2017-01-21 00:10:58'),
(176, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-21 01:54:07'),
(177, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-21 15:46:55'),
(178, 1, 'admin admin', 'admin', 'Identificado correctamente, acceso permitido', '2017-01-21 18:08:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(4) NOT NULL,
  `alias` varchar(150) NOT NULL,
  `pass` varchar(150) NOT NULL,
  `usuarios` int(1) NOT NULL DEFAULT '0',
  `clientes` int(1) NOT NULL DEFAULT '0',
  `pedidos` int(1) NOT NULL DEFAULT '0',
  `vehiculos` int(1) NOT NULL DEFAULT '0',
  `nombre` varchar(150) NOT NULL,
  `apellido` varchar(150) NOT NULL,
  `activo` int(1) NOT NULL DEFAULT '0',
  `borrado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `alias`, `pass`, `usuarios`, `clientes`, `pedidos`, `vehiculos`, `nombre`, `apellido`, `activo`, `borrado`) VALUES
(1, 'admin', 'PrDCv1dpb6Wno', 1, 1, 1, 1, 'admin', 'admin', 1, 0),
(2, 'aaa', '', 0, 0, 0, 0, 'aaaaa', '0', 1, 0),
(5, 'clientes', 'Prk9uqGp0aasE', 1, 0, 0, 0, 'clientes', 'clientes', 1, 1),
(6, 'clicli', 'PrDCv1dpb6Wno', 0, 0, 0, 0, 'cli', 'cli', 1, 0),
(7, 'u', 'Pr2kSbUG8Q1Bo', 0, 1, 1, 1, 'u', 'u', 1, 1),
(8, 'prueba', 'PrtUWydgDE3B2', 1, 0, 0, 1, 'prueba', 'prueba', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` int(11) NOT NULL,
  `marca` varchar(150) CHARACTER SET latin1 NOT NULL,
  `modelo` varchar(150) CHARACTER SET latin1 NOT NULL,
  `cv` int(11) NOT NULL,
  `cc` int(11) NOT NULL,
  `gasolina` varchar(15) CHARACTER SET utf32 NOT NULL,
  `cambio` varchar(15) CHARACTER SET utf32 NOT NULL,
  `marchas` int(1) NOT NULL,
  `precio` int(11) NOT NULL,
  `observaciones` varchar(250) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`id`, `marca`, `modelo`, `cv`, `cc`, `gasolina`, `cambio`, `marchas`, `precio`, `observaciones`) VALUES
(1, 'Man', 'TGX', 550, 15000, 'Diesel', 'Manual', 9, 65000, ''),
(2, 'Man', 'XLX', 650, 15000, 'Diesel', 'Automatico', 10, 42500, 'Oferta KM0'),
(3, 'Man', 'TGM', 320, 9000, 'Gasolina', 'Manual', 8, 37000, ''),
(4, 'Scania', 'SERIE P', 320, 6000, 'Diesel', 'Manual', 8, 35000, ''),
(5, 'Scania', 'SERIE R', 430, 7500, 'Diesel', 'Automático', 9, 49000, ''),
(6, 'Iveco', 'MLG', 500, 8000, 'Gasolina', 'Manual', 10, 52000, ''),
(7, 'Iveco', 'E18', 480, 6700, 'Diesel', 'Automático', 8, 45000, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idusuario` int(4) NOT NULL,
  `idcliente` int(4) NOT NULL,
  `idvehiculo` int(4) NOT NULL,
  `preciobase` int(11) NOT NULL,
  `descuento` int(11) DEFAULT NULL,
  `preciototal` int(11) NOT NULL,
  `estado` int(1) NOT NULL,
  `comentarios` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `fecha`, `idusuario`, `idcliente`, `idvehiculo`, `preciobase`, `descuento`, `preciototal`, `estado`, `comentarios`) VALUES
(1, '2016-12-22', 1, 2, 4, 34000, 25, 25500, 3, 'blabalba00000'),
(2, '2016-12-15', 1, 4, 6, 52000, 22, 40560, 3, 'prueba'),
(9, '2017-01-03', 1, 7, 7, 45000, 50, 22500, 3, ''),
(16, '2017-01-05', 1, 1, 6, 52000, 49, 26520, 3, 'hhhhhhh'),
(17, '2017-01-04', 1, 5, 6, 52000, 0, 52000, 2, ''),
(18, '2017-01-11', 1, 12, 1, 65000, 99, 650, 4, 'Prueba descuento al 99'),
(19, '2017-01-12', 1, 3, 5, 49000, 51, 24010, 3, 'SI SI no'),
(20, '2017-01-12', 1, 3, 5, 49000, 51, 24010, 3, 'SI SI NO');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
