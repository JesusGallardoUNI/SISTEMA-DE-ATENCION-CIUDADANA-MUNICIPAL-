-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-08-2026 a las 03:58:58
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gobierno_municipal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `cargo` varchar(30) NOT NULL,
  `acceso` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id`, `cargo`, `acceso`) VALUES
(1, 'Secretario1@gob.gpe.mx', '$2y$10$INkHVYxMVmrl43a2uCWUSu9NNwk1rvJLZsnNRsdUXmQlDM4IGQnLe'),
(2, 'Secretario2@gob.gpe.mx', '$2y$10$wzDvFA5JGhROm1fW65VD1.4K2zwlJNLS5sMPMSBMiWZecnHoRT1pa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ayuntamiento`
--

CREATE TABLE `ayuntamiento` (
  `id` int(11) NOT NULL,
  `municipio` varchar(50) NOT NULL DEFAULT 'Guadalupe',
  `nombre` varchar(80) NOT NULL,
  `cargo` varchar(30) NOT NULL,
  `correo` varchar(80) NOT NULL,
  `clave` varchar(80) NOT NULL,
  `habilitado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ayuntamiento`
--

INSERT INTO `ayuntamiento` (`id`, `municipio`, `nombre`, `cargo`, `correo`, `clave`, `habilitado`) VALUES
(1, 'Guadalupe', 'Héctor García García', 'Alcalde', 'carlos.gallardogr@uanl.edu.mx', '$2y$10$ErrUO35Hjaz12IHiUeE/5.R.qFjxKIDnwe2VcaW9krD3TKaXXdvPq', NULL),
(3, 'Guadalupe', 'Carlos Jesús Gallardo Guerra', 'Regidor', 'carlos@uanl.edu.mx', '$2y$10$Rx1.ieTv2Wf5/vv1Mt115ufyLm9L.NLpo2kFPuvFTn6FUbPlh.Tz6', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colonias_guadalupe`
--

CREATE TABLE `colonias_guadalupe` (
  `id` int(11) NOT NULL,
  `tipo_asentamiento` varchar(20) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `codigo_postal` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `colonias_guadalupe`
--

INSERT INTO `colonias_guadalupe` (`id`, `tipo_asentamiento`, `nombre`, `codigo_postal`) VALUES
(1, 'Colonia', '10 de Mayo', 67123),
(2, 'Colonia', '13 de Mayo', 67185),
(3, 'Colonia', '15 de Mayo', 67170),
(4, 'Colonia', '18 de Marzo', 67126),
(5, 'Colonia', '2 de Junio', 67189),
(6, 'Colonia', '20 de Noviembre', 67170),
(7, 'Colonia', '21 de Enero', 67164),
(8, 'Colonia', '23 de Noviembre', 67182),
(9, 'Colonia', '25 de Noviembre', 67174),
(10, 'Colonia', '29 de Julio', 67205),
(11, 'Unidad habitacional', '3 Caminos', 67190),
(12, 'Colonia', '3 Caminos Norte', 67190),
(13, 'Colonia', '31 de Diciembre', 67200),
(14, 'Colonia', '5 de Enero (La Cuchilla)', 67202),
(15, 'Colonia', '6 de Marzo', 67169),
(16, 'Fraccionamiento', 'Acacia Residencial', 67195),
(17, 'Colonia', 'Acapulco', 67198),
(18, 'Colonia', 'Acueducto Guadalupe', 67193),
(19, 'Colonia', 'Adolfo Prieto', 67120),
(20, 'Colonia', 'Adolfo Prieto Sector 2', 67120),
(21, 'Colonia', 'Adolfo Prieto Sector 3', 67120),
(22, 'Colonia', 'Adolfo Prieto Sector 4', 67124),
(23, 'Colonia', 'Agua Nueva', 67185),
(24, 'Colonia', 'Alamedas de la Hacienda', 67155),
(25, 'Fraccionamiento', 'Albana Linda Vista', 67125),
(26, 'Colonia', 'Alfonso Martínez Domínguez', 67178),
(27, 'Colonia', 'Almaguer', 67182),
(28, 'Colonia', 'Almendros', 67112),
(29, 'Colonia', 'Altos San Roque (Fomerrey 26)', 67177),
(30, 'Colonia', 'América', 67125),
(31, 'Colonia', 'América Obrera', 67120),
(32, 'Colonia', 'Ampliación México Nuevo', 67183),
(33, 'Fraccionamiento', 'Andara Residencial', 67133),
(34, 'Colonia', 'Aragonés', 67124),
(35, 'Colonia', 'Arboledas de Acapulco', 67113),
(36, 'Colonia', 'Arboledas de Corregidora', 67123),
(37, 'Colonia', 'Arboledas de la Silla', 67182),
(38, 'Colonia', 'Arboledas de San Miguel', 67110),
(39, 'Colonia', 'Arboledas de Santa Cecilia', 67134),
(40, 'Colonia', 'Arboledas del Oriente', 67117),
(41, 'Colonia', 'Arboledas Nueva Lindavista', 67129),
(42, 'Zona industrial', 'Areya Guadalupe Industrial Park', 67116),
(43, 'Colonia', 'Atoyac de Álvarez', 67174),
(44, 'Colonia', 'Azteca', 67150),
(45, 'Colonia', 'Balcones de San Miguel', 67113),
(46, 'Fraccionamiento', 'Bello Amanecer', 67132),
(47, 'Colonia', 'Benito Juárez', 67144),
(48, 'Unidad habitacional', 'Benito Juárez', 67116),
(49, 'Colonia', 'Bosques de la Pastora', 67174),
(50, 'Colonia', 'Bosques de la Silla', 67183),
(51, 'Colonia', 'Bosques del Contry', 67174),
(52, 'Colonia', 'Bosques del Oriente', 67110),
(53, 'Colonia', 'Bosques del Rey', 67194),
(54, 'Colonia', 'Bosques del Sol', 67130),
(55, 'Colonia', 'Bugambilias de la Sierra', 67192),
(56, 'Colonia', 'Burócratas Municipales', 67180),
(57, 'Colonia', 'Camino Real', 67170),
(58, 'Colonia', 'Campestre la Silla', 67183),
(59, 'Unidad habitacional', 'Cañada Blanca', 67117),
(60, 'Colonia', 'Cañón de la Silla', 67182),
(61, 'Colonia', 'Carmen Serdán', 67198),
(62, 'Zona comercial', 'Central de Abastos', 67140),
(63, 'Zona comercial', 'Central de Carga', 67129),
(64, 'Colonia', 'Centroamérica', 67117),
(65, 'Fraccionamiento', 'Cerrada México', 67130),
(66, 'Colonia', 'Cerradas de Bugambilias', 67188),
(67, 'Colonia', 'Cerradas de la Silla', 67185),
(68, 'Colonia', 'Cerradas de Lindavista', 67125),
(69, 'Colonia', 'Cerro Azul', 67190),
(70, 'Colonia', 'Cerro de la Silla', 67177),
(71, 'Colonia', 'Cerro de la Silla UC', 67190),
(72, 'Colonia', 'Chinameca', 67140),
(73, 'Colonia', 'Chula Vista', 67188),
(74, 'Colonia', 'Ciudad CNOP', 67200),
(75, 'Unidad habitacional', 'Ciudad CROC', 67195),
(76, 'Colonia', 'Colibrí Dos', 67189),
(77, 'Colonia', 'Colibrí Tres', 67184),
(78, 'Colonia', 'Colinas de Guadalupe', 67182),
(79, 'Colonia', 'Colinas de la Silla', 67182),
(80, 'Colonia', 'Colinas del Rey', 67194),
(81, 'Fraccionamiento', 'Collados de Guadalupe Primer Sector', 67186),
(82, 'Fraccionamiento', 'Collados de Guadalupe Segundo Sector', 67186),
(83, 'Fraccionamiento', 'Collados de Guadalupe Tercer Sector', 67186),
(84, 'Colonia', 'Colonial de San Miguel', 67113),
(85, 'Colonia', 'Coloniales San Miguel Sector Uno', 67113),
(86, 'Colonia', 'Condado de Santa Lucía', 67184),
(87, 'Fraccionamiento', 'Condocasa Lindavista', 67125),
(88, 'Unidad habitacional', 'Cóndor', 67140),
(89, 'Fraccionamiento', 'Constanza', 67134),
(90, 'Colonia', 'Contry la Costa', 67173),
(91, 'Colonia', 'Contry la Escondida', 67173),
(92, 'Colonia', 'Contry la Silla', 67173),
(93, 'Fraccionamiento', 'Contry los Encinos', 67178),
(94, 'Colonia', 'Contry los Nogales', 67173),
(95, 'Colonia', 'Contry Sol', 67174),
(96, 'Fraccionamiento', 'Cortijo la Silla', 67197),
(97, 'Colonia', 'Crispín Treviño', 67204),
(98, 'Colonia', 'Cuesta Verde', 67186),
(99, 'Colonia', 'David Cavazos', 67204),
(100, 'Colonia', 'Del Maestro', 67140),
(101, 'Colonia', 'Díaz Ordaz', 67180),
(102, 'Colonia', 'División del Norte', 67190),
(103, 'Colonia', 'Doctor Ángel Martínez Villarreal', 67126),
(104, 'Fraccionamiento', 'Dos Ríos', 67134),
(105, 'Colonia', 'Eduardo Caballero', 67117),
(106, 'Colonia', 'El Bajío', 67144),
(107, 'Colonia', 'El Milagro', 67185),
(108, 'Colonia', 'El Peñón', 67182),
(109, 'Colonia', 'El Quetzal', 67169),
(110, 'Colonia', 'El Sabino', 67154),
(111, 'Colonia', 'Emiliano Zapata (Fomerrey 18)', 67118),
(112, 'Colonia', 'Encino de la Silla', 67182),
(113, 'Colonia', 'Escamilla', 67124),
(114, 'Colonia', 'Esmeralda', 67140),
(115, 'Fraccionamiento', 'Evania', 67134),
(116, 'Fraccionamiento', 'Evante Residencial', 67169),
(117, 'Fraccionamiento', 'Evolución', 67200),
(118, 'Colonia', 'Expo Ganadera', 67155),
(119, 'Colonia', 'Exposición', 67155),
(120, 'Colonia', 'Exposición Modelo', 67154),
(121, 'Colonia', 'Faisanes Sur', 67169),
(122, 'Fraccionamiento', 'Fátima', 67132),
(123, 'Colonia', 'Felipe Ángeles', 67175),
(124, 'Colonia', 'Fomerrey 20 (2 de Mayo)', 67180),
(125, 'Colonia', 'Fomerrey 32', 67185),
(126, 'Colonia', 'Fomerrey Tres', 67198),
(127, 'Fraccionamiento', 'Fontana Residencial', 67134),
(128, 'Colonia', 'FOVISSSTE Camino Real', 67177),
(129, 'Colonia', 'Fresnos la Silla', 67176),
(130, 'Fraccionamiento', 'Fuentes de Guadalupe', 67205),
(131, 'Colonia', 'Fuentes de San Miguel', 67113),
(132, 'Fraccionamiento', 'Galerías del Camino Real Primer Sector', 67177),
(133, 'Fraccionamiento', 'Galerías del Camino Real Segundo Sector', 67177),
(134, 'Colonia', 'Garza Melo', 67183),
(135, 'Colonia', 'Gloria Mendiola', 67186),
(136, 'Colonia', 'Granjitas la Silla', 67178),
(137, 'Colonia', 'Guadalupe Centro', 67100),
(138, 'Colonia', 'Guadalupe Chávez', 67182),
(139, 'Colonia', 'Guadalupe la Silla', 67190),
(140, 'Colonia', 'Guadalupe Victoria', 67185),
(141, 'Colonia', 'Guadalupe Zitoon', 67155),
(142, 'Colonia', 'Guajardo', 67183),
(143, 'Colonia', 'Guerra', 67144),
(144, 'Colonia', 'Hacienda de Guadalupe', 67197),
(145, 'Fraccionamiento', 'Hacienda de los Arcángeles', 67168),
(146, 'Colonia', 'Hacienda la Española', 67118),
(147, 'Colonia', 'Hacienda la Silla', 67199),
(148, 'Fraccionamiento', 'Hacienda los Encinos', 67112),
(149, 'Colonia', 'Hacienda los Lermas', 67168),
(150, 'Colonia', 'Hacienda San Miguel', 67113),
(151, 'Colonia', 'Hacienda San Sebastián', 67203),
(152, 'Colonia', 'Hércules', 67120),
(153, 'Colonia', 'Huerta de Guadalupe', 67204),
(154, 'Colonia', 'Ignacio Allende', 67179),
(155, 'Colonia', 'Ignacio Altamirano', 67140),
(156, 'Colonia', 'Ignacio Zaragoza', 67163),
(157, 'Zona industrial', 'Industrial Jardines San Rafael', 67119),
(158, 'Zona industrial', 'Industrial la Silla', 67204),
(159, 'Unidad habitacional', 'INFONAVIT Azteca', 67150),
(160, 'Colonia', 'INFONAVIT Benito Juárez', 67113),
(161, 'Colonia', 'INFONAVIT la Joya', 67160),
(162, 'Colonia', 'INFONAVIT la Joya Cuarto Sector', 67167),
(163, 'Colonia', 'INFONAVIT la Joya Quinto Sector', 67167),
(164, 'Colonia', 'Insurgentes', 67184),
(165, 'Colonia', 'Jardines de Andalucía', 67193),
(166, 'Colonia', 'Jardines de Casa Blanca', 67116),
(167, 'Colonia', 'Jardines de Lindavista', 67123),
(168, 'Colonia', 'Jardines de San Miguel', 67116),
(169, 'Colonia', 'Jardines de San Rafael', 67119),
(170, 'Colonia', 'Jardines de Santa Clara', 67184),
(171, 'Colonia', 'Jardines de Tolteca', 67178),
(172, 'Colonia', 'Jardines de Xochimilco', 67196),
(173, 'Colonia', 'Jardines del Río', 67116),
(174, 'Colonia', 'Jardines Guadalupe', 67116),
(175, 'Colonia', 'Jardines la Pastora', 67140),
(176, 'Colonia', 'Jardines la Victoria', 67110),
(177, 'Colonia', 'Jardines Nueva Lindavista', 67129),
(178, 'Colonia', 'José Luis Mora', 67185),
(179, 'Colonia', 'José María Morelos', 67150),
(180, 'Colonia', 'Josefa Ortiz de Domínguez', 67186),
(181, 'Colonia', 'Josefa Zozaya', 67117),
(182, 'Colonia', 'Juan Álvarez', 67140),
(183, 'Zona industrial', 'Kalos Guadalupe', 67205),
(184, 'Zona industrial', 'Kalos Guadalupe Aeropuerto', 67133),
(185, 'Colonia', 'La Alianza de Ruteros', 67183),
(186, 'Colonia', 'La Amistad', 67110),
(187, 'Colonia', 'La Comedia', 67184),
(188, 'Colonia', 'La Condesa', 67130),
(189, 'Fraccionamiento', 'La Escondida Residencial', 67194),
(190, 'Colonia', 'La Floresta', 67118),
(191, 'Colonia', 'La Fuente', 67154),
(192, 'Colonia', 'La Hacienda', 67155),
(193, 'Colonia', 'La Herradura', 67140),
(194, 'Colonia', 'La Huerta', 67144),
(195, 'Colonia', 'La Joyita', 67167),
(196, 'Colonia', 'La Luz', 67120),
(197, 'Colonia', 'La Pastora', 67140),
(198, 'Colonia', 'La Playa', 67180),
(199, 'Colonia', 'La Playita', 67180),
(200, 'Colonia', 'La Purísima', 67129),
(201, 'Colonia', 'La Quinta', 67175),
(202, 'Colonia', 'La Roca', 67185),
(203, 'Unidad habitacional', 'La Talaverna Módulo Social FOVISSSTE', 67129),
(204, 'Colonia', 'La Trinidad', 67202),
(205, 'Colonia', 'La Victoria', 67110),
(206, 'Fraccionamiento', 'Lantana Privadas Residencial', 67190),
(207, 'Colonia', 'Las Águilas', 67133),
(208, 'Fraccionamiento', 'Las Águilas', 67174),
(209, 'Colonia', 'Las Avenidas', 67185),
(210, 'Colonia', 'Las Canteras', 67150),
(211, 'Colonia', 'Las Colinas', 67192),
(212, 'Fraccionamiento', 'Las Dalias', 67112),
(213, 'Colonia', 'Las Escobas', 67133),
(214, 'Rancho', 'Las Escobas', 67196),
(215, 'Colonia', 'Las Flores', 67190),
(216, 'Colonia', 'Las Palmas', 67192),
(217, 'Unidad habitacional', 'Las Plazas Dos', 67140),
(218, 'Unidad habitacional', 'Las Plazas Tres', 67140),
(219, 'Unidad habitacional', 'Las Plazas Uno', 67140),
(220, 'Colonia', 'Las Sabinas (Solidaridad Fomerrey)', 67168),
(221, 'Fraccionamiento', 'Las Terrassas', 67186),
(222, 'Colonia', 'Las Villas', 67175),
(223, 'Colonia', 'León XIII', 67120),
(224, 'Colonia', 'Libertad', 67123),
(225, 'Colonia', 'Libertadores de América', 67169),
(226, 'Colonia', 'Linda Vista', 67123),
(227, 'Colonia', 'Lolyta', 67125),
(228, 'Colonia', 'Loma Verde', 67186),
(229, 'Colonia', 'Lomas de la Silla (Fomerrey 14)', 67177),
(230, 'Colonia', 'Lomas de San Miguel', 67113),
(231, 'Colonia', 'Lomas de San Roque', 67186),
(232, 'Colonia', 'Lomas de Tolteca', 67178),
(233, 'Fraccionamiento', 'Lomas del Rey', 67194),
(234, 'Colonia', 'Los Ángeles', 67189),
(235, 'Colonia', 'Los Canelos', 67178),
(236, 'Colonia', 'Los Cristales', 67117),
(237, 'Colonia', 'Los Cristales Tercer Sector', 67117),
(238, 'Colonia', 'Los Delfines', 67183),
(239, 'Colonia', 'Los Encinos', 67165),
(240, 'Fraccionamiento', 'Los Faisanes', 67169),
(241, 'Colonia', 'Los Faisanes Sector el Dorado', 67169),
(242, 'Colonia', 'Los Faisanes Sector Platino', 67169),
(243, 'Colonia', 'Los Independientes', 67199),
(244, 'Colonia', 'Los Lermas', 67188),
(245, 'Colonia', 'Los Manantiales', 67204),
(246, 'Colonia', 'Los Olivos', 67110),
(247, 'Colonia', 'Los Sauces', 67140),
(248, 'Colonia', 'Lucio Blanco', 67186),
(249, 'Colonia', 'Luis Donaldo Colosio', 67183),
(250, 'Colonia', 'María Teresa', 67203),
(251, 'Fraccionamiento', 'Marsella Residencial', 67168),
(252, 'Colonia', 'Marte', 67144),
(253, 'Fraccionamiento', 'Maya', 67115),
(254, 'Colonia', 'Melchor Ocampo', 67188),
(255, 'Colonia', 'México 86', 67194),
(256, 'Colonia', 'Miguel de la Madrid', 67183),
(257, 'Colonia', 'Miguel Hidalgo', 67202),
(258, 'Colonia', 'Miguel Hidalgo (Fomerrey 19)', 67180),
(259, 'Colonia', 'Mirador de la Silla', 67176),
(260, 'Colonia', 'Mirasol', 67170),
(261, 'Colonia', 'Misión de Guadalupe', 67117),
(262, 'Fraccionamiento', 'Misión de la Silla', 67197),
(263, 'Colonia', 'Misión del Valle', 67118),
(264, 'Colonia', 'Misión Santa Cruz', 67205),
(265, 'Colonia', 'Misión Santa Fe', 67193),
(266, 'Colonia', 'Mixcoac', 67113),
(267, 'Colonia', 'Molino del Rey', 67194),
(268, 'Colonia', 'Morenita Guajardo', 67182),
(269, 'Colonia', 'Niños Héroes', 67190),
(270, 'Fraccionamiento', 'Nosara Residencial', 67194),
(271, 'Colonia', 'Nueva Aurora', 67192),
(272, 'Colonia', 'Nueva Exposición', 67150),
(273, 'Fraccionamiento', 'Nueva Joya', 67168),
(274, 'Colonia', 'Nueva Libertad', 67120),
(275, 'Colonia', 'Nueva Linda Vista', 67129),
(276, 'Colonia', 'Nuevo Almaguer', 67186),
(277, 'Colonia', 'Nuevo León', 67202),
(278, 'Colonia', 'Nuevo México', 67183),
(279, 'Fraccionamiento', 'Nuevo Milenio', 67115),
(280, 'Colonia', 'Nuevo San Miguel', 67116),
(281, 'Colonia', 'Nuevo San Rafael', 67118),
(282, 'Colonia', 'Nuevo San Sebastián', 67188),
(283, 'Fraccionamiento', 'Nuevo Santa María', 67198),
(284, 'Colonia', 'Nuevo Tamaulipas', 67200),
(285, 'Fraccionamiento', 'Oasis Residencial', 67203),
(286, 'Condominio', 'Olivas', 67170),
(287, 'Colonia', 'Orizaba', 67167),
(288, 'Colonia', 'Pablo Livas', 67184),
(289, 'Colonia', 'Paraíso', 67140),
(290, 'Zona industrial', 'Parque Industrial Acueducto', 67193),
(291, 'Zona industrial', 'Parque Industrial FINSA Monterrey-Guadalupe', 67132),
(292, 'Zona industrial', 'Parque Industrial Guadalupe', 67190),
(293, 'Zona industrial', 'Parque Industrial la Silla', 67195),
(294, 'Zona industrial', 'Parque Industrial las Américas', 67128),
(295, 'Zona industrial', 'Parque Industrial Nexxus', 67130),
(296, 'Zona industrial', 'Parque Industrial Viga', 67115),
(297, 'Colonia', 'Parque San Andrés', 67180),
(298, 'Colonia', 'Parques de Guadalupe', 67185),
(299, 'Fraccionamiento', 'Paseo Amberes', 67130),
(300, 'Fraccionamiento', 'Paseo de Guadalupe', 67199),
(301, 'Colonia', 'Paseo San Miguel', 67110),
(302, 'Colonia', 'Pedregal Contry', 67173),
(303, 'Colonia', 'Pedregal de Guadalupe', 67195),
(304, 'Colonia', 'Pedregal de Lindavista', 67110),
(305, 'Colonia', 'Pedregal de Lindavista II', 67112),
(306, 'Colonia', 'Pedregal de Oriente', 67115),
(307, 'Fraccionamiento', 'Península Residencial', 67134),
(308, 'Colonia', 'Plan del Río', 67175),
(309, 'Colonia', 'Plaza San Antonio', 67110),
(310, 'Colonia', 'Polanco', 67140),
(311, 'Colonia', 'Polanco Oriente', 67140),
(312, 'Colonia', 'Policía Auxiliar', 67113),
(313, 'Colonia', 'Portal de la Hacienda', 67168),
(314, 'Colonia', 'Portal de Xochimilco', 67196),
(315, 'Colonia', 'Portales de la Silla', 67194),
(316, 'Fraccionamiento', 'Portales de la Silla Segundo Sector', 67194),
(317, 'Colonia', 'Praderas de Guadalupe', 67203),
(318, 'Fraccionamiento', 'Praderas de la Silla', 67186),
(319, 'Colonia', 'Praderas de San Rafael', 67119),
(320, 'Colonia', 'Privada Chapultepec', 67153),
(321, 'Fraccionamiento', 'Privada el Mirador', 67186),
(322, 'Colonia', 'Privada Laura', 67153),
(323, 'Fraccionamiento', 'Privada los Sabinos', 67176),
(324, 'Fraccionamiento', 'Privada Purísima', 67125),
(325, 'Fraccionamiento', 'Privada San Carlos', 67134),
(326, 'Fraccionamiento', 'Privada San Fernando', 67113),
(327, 'Colonia', 'Privada Vicente Ferrer', 67182),
(328, 'Fraccionamiento', 'Privada Villas del Río', 67204),
(329, 'Fraccionamiento', 'Privadas de Contry', 67178),
(330, 'Fraccionamiento', 'Privadas de la Silla', 67196),
(331, 'Fraccionamiento', 'Privadas de Lindavista', 67112),
(332, 'Fraccionamiento', 'Privadas de San Miguel', 67130),
(333, 'Fraccionamiento', 'Privadas del Rey', 67194),
(334, 'Fraccionamiento', 'Privadas Masai', 67205),
(335, 'Colonia', 'Progreso', 67170),
(336, 'Zona industrial', 'PROMOFISA', 67115),
(337, 'Colonia', 'Provivienda', 67112),
(338, 'Colonia', 'Provivienda la Esperanza', 67112),
(339, 'Colonia', 'Puerta del Sol', 67200),
(340, 'Fraccionamiento', 'Puerta Oriente', 67116),
(341, 'Colonia', 'Puesta del Sol', 67174),
(342, 'Colonia', 'Punta Contry', 67173),
(343, 'Colonia', 'Rafael Ramírez Sector I', 67185),
(344, 'Colonia', 'Rafael Ramírez Sector II', 67185),
(345, 'Colonia', 'Rancho Viejo Sector Dos', 67192),
(346, 'Colonia', 'Rancho Viejo Sector Uno', 67192),
(347, 'Colonia', 'Raúl Caballero', 67117),
(348, 'Colonia', 'Real de Minas', 67124),
(349, 'Fraccionamiento', 'Real de San Miguel Sector Cuatro', 67113),
(350, 'Fraccionamiento', 'Real de San Miguel Sector Dos', 67113),
(351, 'Fraccionamiento', 'Real de San Miguel Sector Tres', 67113),
(352, 'Fraccionamiento', 'Real de San Miguel Sector Uno', 67113),
(353, 'Zona industrial', 'Regio Parque Industrial Guadalupe', 67132),
(354, 'Fraccionamiento', 'Residencial 15 de Mayo', 67170),
(355, 'Fraccionamiento', 'Residencial Avante', 67113),
(356, 'Colonia', 'Residencial Azteca', 67150),
(357, 'Colonia', 'Residencial Cerro de la Silla', 67140),
(358, 'Colonia', 'Residencial Colibrí', 67189),
(359, 'Fraccionamiento', 'Residencial Guadalupe', 67190),
(360, 'Colonia', 'Residencial las Quintas', 67165),
(361, 'Colonia', 'Residencial Minerva', 67120),
(362, 'Fraccionamiento', 'Residencial Privada las Plazas', 67134),
(363, 'Fraccionamiento', 'Residencial Real de la Silla', 67177),
(364, 'Fraccionamiento', 'Residencial San Antonio', 67112),
(365, 'Fraccionamiento', 'Residencial Santa Fe', 67112),
(366, 'Fraccionamiento', 'Residencial Santa María', 67202),
(367, 'Fraccionamiento', 'Residencial Torremolinos', 67117),
(368, 'Colonia', 'Revolución', 67140),
(369, 'Colonia', 'Reynosa', 67190),
(370, 'Fraccionamiento', 'Riberas de Dos Ríos', 67134),
(371, 'Colonia', 'Riberas del Contry', 67174),
(372, 'Colonia', 'Riberas del Río', 67160),
(373, 'Colonia', 'Rincón Colonial la Silla', 67173),
(374, 'Colonia', 'Rincón de Guadalupe', 67198),
(375, 'Colonia', 'Rincón de la Azteca', 67150),
(376, 'Fraccionamiento', 'Rincón de la Hacienda', 67168),
(377, 'Colonia', 'Rincón de la Primavera', 67173),
(378, 'Colonia', 'Rincón de la Purísima', 67129),
(379, 'Colonia', 'Rincón de la Sierra', 67194),
(380, 'Colonia', 'Rincón de los Sabinos', 67205),
(381, 'Colonia', 'Rincón del Contry', 67174),
(382, 'Colonia', 'Rincón la Silla', 67196),
(383, 'Fraccionamiento', 'Rincón Lindavista', 67110),
(384, 'Colonia', 'Río', 67164),
(385, 'Colonia', 'Rivera de la Pastora', 67140),
(386, 'Colonia', 'Rivera de Linda Vista', 67126),
(387, 'Colonia', 'Riveras de la Purísima', 67126),
(388, 'Colonia', 'Riveras de la Silla (Fomerrey 31)', 67116),
(389, 'Fraccionamiento', 'Riviera de Guadalupe', 67132),
(390, 'Colonia', 'Riviera del Contry', 67144),
(391, 'Colonia', 'Roble Santa María', 67190),
(392, 'Colonia', 'Rosalinda', 67188),
(393, 'Colonia', 'Rosita', 67167),
(394, 'Colonia', 'Ruiz Cortínes', 67176),
(395, 'Colonia', 'Sabinitas', 67169),
(396, 'Colonia', 'San Agustín', 67163),
(397, 'Colonia', 'San Cristóbal', 67184),
(398, 'Colonia', 'San Diego', 67154),
(399, 'Colonia', 'San Eduardo', 67186),
(400, 'Zona industrial', 'San Miguel', 67115),
(401, 'Colonia', 'San Rafael', 67119),
(402, 'Zona industrial', 'San Rafael', 67110),
(403, 'Colonia', 'San Sebastián', 67184),
(404, 'Colonia', 'Sandra Saavedra', 67202),
(405, 'Fraccionamiento', 'Santa Clara', 67134),
(406, 'Fraccionamiento', 'Santa Clara', 67185),
(407, 'Colonia', 'Santa Cruz', 67205),
(408, 'Colonia', 'Santa Elena', 67189),
(409, 'Fraccionamiento', 'Santa Fe Living', 67117),
(410, 'Colonia', 'Santa Isabel', 67184),
(411, 'Colonia', 'Santa Margarita', 67140),
(412, 'Colonia', 'Santa María', 67198),
(413, 'Colonia', 'SCOP', 67198),
(414, 'Colonia', 'SCT', 67199),
(415, 'Colonia', 'Sebastián Elizondo', 67115),
(416, 'Fraccionamiento', 'Serena', 67129),
(417, 'Colonia', 'Sierra Morena', 67193),
(418, 'Colonia', 'Siete Colinas Sector Palatino', 67116),
(419, 'Colonia', 'Simuplade', 67168),
(420, 'Colonia', 'Solidaridad', 67189),
(421, 'Colonia', 'Tacubaya', 67184),
(422, 'Colonia', 'Talaberna', 67110),
(423, 'Colonia', 'Tamaulipas', 67200),
(424, 'Colonia', 'Tierra Propia Sector Dos', 67197),
(425, 'Colonia', 'Tierra Propia Sector Uno', 67197),
(426, 'Colonia', 'Tolteca', 67175),
(427, 'Fraccionamiento', 'Torremolinos la Fe', 67117),
(428, 'Colonia', 'Torres de San Miguel', 67113),
(429, 'Colonia', 'Torres Lindavista', 67126),
(430, 'Unidad habitacional', 'Unidad Piloto', 67186),
(431, 'Colonia', 'Unión', 67164),
(432, 'Colonia', 'Unión Modelo', 67165),
(433, 'Colonia', 'Valle de Chapultepec', 67140),
(434, 'Colonia', 'Valle de Guadalupe', 67177),
(435, 'Colonia', 'Valle de las Flores', 67130),
(436, 'Colonia', 'Valle de las Sabinas', 67168),
(437, 'Colonia', 'Valle de Lindavista', 67125),
(438, 'Colonia', 'Valle de los Encinos', 67197),
(439, 'Fraccionamiento', 'Valle de San Andrés', 67184),
(440, 'Colonia', 'Valle de San Antonio', 67112),
(441, 'Colonia', 'Valle de San Roque', 67192),
(442, 'Colonia', 'Valle del Contry', 67174),
(443, 'Colonia', 'Valle del Sol', 67196),
(444, 'Colonia', 'Valle Hermoso Sector Dos', 67164),
(445, 'Colonia', 'Valle Hermoso Sector Uno', 67160),
(446, 'Colonia', 'Valle la Silla', 67186),
(447, 'Colonia', 'Valle Real', 67176),
(448, 'Colonia', 'Valle San Miguel', 67113),
(449, 'Colonia', 'Valle San Rafael', 67118),
(450, 'Fraccionamiento', 'Valle San Roque', 67184),
(451, 'Colonia', 'Valle Soleado', 67130),
(452, 'Fraccionamiento', 'Valle Torremolinos', 67117),
(453, 'Unidad habitacional', 'Valles de Guadalupe', 67195),
(454, 'Colonia', 'Valles de la Silla', 67180),
(455, 'Colonia', 'Vaquerías', 67203),
(456, 'Colonia', 'Venus', 67144),
(457, 'Zona industrial', 'Vesta Park Guadalupe', 67184),
(458, 'Fraccionamiento', 'Via Antigua', 67188),
(459, 'Colonia', 'Vicente Ferrer', 67186),
(460, 'Colonia', 'Vicente Guerrero', 67163),
(461, 'Colonia', 'Villa Alegre', 67195),
(462, 'Colonia', 'Villa de los Reyes', 67180),
(463, 'Colonia', 'Villa de San Miguel', 67110),
(464, 'Colonia', 'Villa Española', 67118),
(465, 'Colonia', 'Villa Olímpica', 67183),
(466, 'Colonia', 'Villa Pastora', 67174),
(467, 'Colonia', 'Villa San Antonio', 67110),
(468, 'Colonia', 'Villa San Sebastián', 67184),
(469, 'Colonia', 'Villas del Río', 67112),
(470, 'Colonia', 'Villas del Río', 67204),
(471, 'Colonia', 'Vista Sol', 67125),
(472, 'Colonia', 'Vivienda Popular', 67176),
(473, 'Colonia', 'Xochimilco', 67196),
(474, 'Colonia', 'Zertuche Primer Sector', 67184),
(475, 'Colonia', 'Zertuche Segundo Sector', 67180),
(476, 'Colonia', 'Zozayita', 67117);

--
-- Disparadores `colonias_guadalupe`
--
DELIMITER $$
CREATE TRIGGER `ActualizarNombres` AFTER UPDATE ON `colonias_guadalupe` FOR EACH ROW BEGIN
    UPDATE reportes_colonias
    SET nombre_colonia = NEW.nombre_colonia
    WHERE nombre_colonia = OLD.nombre_colonia;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `BorrarNombres` AFTER DELETE ON `colonias_guadalupe` FOR EACH ROW BEGIN
    DELETE FROM reportes_colonias
    WHERE nombre_colonia = OLD.nombre_colonia;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes_colonias`
--

CREATE TABLE `reportes_colonias` (
  `id` int(11) NOT NULL,
  `nombre_persona` varchar(60) DEFAULT NULL,
  `telefono_persona` bigint(20) DEFAULT NULL,
  `estado` varchar(15) NOT NULL,
  `municipio` varchar(30) NOT NULL,
  `codigo_postal` int(11) NOT NULL,
  `nombre_colonia` varchar(50) NOT NULL,
  `tipo_reporte` int(11) NOT NULL,
  `especificacion` varchar(30) NOT NULL,
  `descripcion` varchar(400) NOT NULL,
  `nombre_calle` varchar(50) NOT NULL,
  `ubicacion` varchar(75) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `clave` varchar(30) NOT NULL,
  `resuelto` varchar(15) NOT NULL,
  `descartado` varchar(5) DEFAULT NULL,
  `id_encargado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reportes_colonias`
--

INSERT INTO `reportes_colonias` (`id`, `nombre_persona`, `telefono_persona`, `estado`, `municipio`, `codigo_postal`, `nombre_colonia`, `tipo_reporte`, `especificacion`, `descripcion`, `nombre_calle`, `ubicacion`, `imagen`, `fecha`, `clave`, `resuelto`, `descartado`, `id_encargado`) VALUES
(1, 'Carlos Jesús Gallardo Guerra', 8140225362, 'Nuevo León', 'Guadalupe', 67200, 'Evolución', 2, '', 'se fue la luz', 'san pedro del alto', '25.670495, -100.147704', 'c54adc728997f02fbd897e76a81dc0c6.jpg', '2026-08-08', 'YGYk9pXf', 'si', NULL, 1),
(2, 'Carlos Jesús Gallardo Guerra', 8140225362, 'Nuevo León', 'Guadalupe', 67200, 'Evolución', 7, '', 'solo quiero queso', 'aldama', '25.677516, -100.248651', '89a0f72e2a2d40cf984c16321b6c677e.jpg', '2026-08-08', 'tcvMMLtF', 'no', NULL, NULL),
(3, 'Carlos Jesús Gallardo Guerra', 8140225362, 'Nuevo León', 'Guadalupe', 67200, 'Evolución', 7, '', 'limpien esa madre esta fea y rallada', '3 de marzo', '25.669509, -100.146158', '076f841e9027cb005e2e2a86887e0c4b.jpg', '2026-08-08', 'khHhcLZX', 'no', NULL, NULL),
(4, 'Carlos Jesús Gallardo Guerra', 8140225362, 'Nuevo León', 'Guadalupe', 67200, 'Evolución', 3, '', 'hay un cabron acostado', 'san pedro bernal', '25.676511, -100.247535', 'ba707c385bce76de71d64de2a8911abb.jpg', '2026-08-08', 'QdmgiYr3', 'no', NULL, NULL),
(5, 'Andres Lopez', 8140225362, 'Nuevo León', 'Guadalupe', 67200, 'Evolución', 4, '', 'eee', 'san pedro bernal', '25.682467, -100.250669', '3fc67b62795d04a2657e6fd14fa3bbe3.jpg', '2026-08-08', '7YyFEJTg', 'no', NULL, NULL),
(6, 'Carlos Jesús Gallardo Guerra', 8140225362, 'Nuevo León', 'Guadalupe', 67200, 'Evolución', 2, '', 'no hay luz y no se a dado solucion', 'san pedro bernal', '25.670621, -100.147455', 'ce36220ac6892851320aa03cbad67cc1.jpg', '2026-08-08', 'i61EdIGv', 'no', 'si', 1),
(7, 'Carlos Jesús Gallardo Guerra', 8140225362, 'Nuevo León', 'Guadalupe', 67200, 'Evolución', 1, 'Calles sucias', 'tralalero tralala', 'san pedro bernal', '25.670467, -100.147398', 'a4fab3402820051c1edd819d98e8977e.jpg', '2026-08-14', 'OJKn0Zhy', 'no', NULL, NULL),
(8, 'Carlos Jesús Gallardo Guerra', 8140225362, 'Nuevo León', 'Guadalupe', 67180, 'Díaz Ordaz', 1, 'Calles sucias', 'tralalero tralalarilarila', 'los locos adams', '25.670516, -100.147424', '863139d417cbc8b5a9c63ff253b61268.jpg', '2026-08-14', 'SWW3p1I9', 'no', NULL, NULL),
(10, 'Carlos Jesús Gallardo Guerra', 8140225362, 'Nuevo León', 'Guadalupe', 67200, 'Evolución', 1, 'Calles sucias', 'larililira', 'san pedro bernal', '25.670502, -100.147414', 'bdf063c10fd6b150381f2feeabc7e13c.jpg', '2026-08-14', 'wlSz98kI', 'no', NULL, NULL),
(11, 'Carlos Jesús Gallardo Guerra', 8140225362, 'Nuevo León', 'Guadalupe', 67200, 'Evolución', 1, 'Calles sucias', 'que es lo que vez', 'aldama', '25.670521, -100.147424', 'ba558ed70b023ce39d5b998d8133c967.jpg', '2026-08-14', 'LzI57Fv1', 'no', NULL, NULL),
(12, 'Carlos Jesús Gallardo Guerra', 8140225362, 'Nuevo León', 'Guadalupe', 67200, 'Evolución', 1, 'Calles sucias', 'boys', 'san pedro bernal', '25.670426, -100.147379', '729ee598e937f12493de3c22139f633e.jpg', '2026-08-14', 'EuNNm2B5', 'no', NULL, NULL),
(13, 'Carlos Jesús Gallardo Guerra', 8140225362, 'Nuevo León', 'Guadalupe', 67200, 'Evolución', 1, 'Calles sucias', 'checalo', 'los locos adams', '25.670510, -100.147417', '8f9b077493d03f8aca5ffc391a46a6e4.jpg', '2026-08-14', 'B3dql7pB', 'no', NULL, NULL),
(14, 'Carlos Jesús Gallardo guerra', 8140225362, 'Nuevo León', 'Guadalupe', 67117, 'Zozayita', 1, 'Calles sucias', 'checando mis errores', 'san pedro bernal', '25.670508, -100.147422', '7e8939c4a2fec0f7f8c3b29a57fc1d1a.jpg', '2026-08-16', 'Qgu8yLGE', 'no', NULL, NULL),
(15, 'Andres Lopez', 8140225362, 'Nuevo León', 'Guadalupe', 67200, 'Evolución', 1, 'Calles sucias', 'tralalero con 28 años despues', 'cuautemoc', '25.670543, -100.147394', '1245edab5bc8445b089e23767fb39900.jpg', '2026-08-19', 'JwnCUJOQ', 'no', NULL, NULL),
(16, 'Carlos Jesús Gallardo Guerra', 8140225362, 'Nuevo León', 'Guadalupe', 67200, 'Evolución', 1, 'Calles sucias', 'NO SE', 'san pedro bernal', '25.670509, -100.147427', '1f98465d938095aff9769913e2f223eb.jpg', '2026-08-19', '14', 'no', NULL, NULL),
(17, 'Carlos Jesús Gallardo Guerra', 8140225362, 'Nuevo León', 'Guadalupe', 67155, 'Expo Ganadera', 1, 'Calles sucias', 'NO LO SE RICK ME PARESE FALSO', 'los locos adams', '25.670470, -100.147425', 'd82acde2a0286440247260bd4f406054.jpg', '2026-08-19', '15', 'no', NULL, NULL),
(18, 'Carlos Jesús Gallardo Guerra', 8140225362, 'Nuevo León', 'Guadalupe', 67200, 'Evolución', 1, 'Calles sucias', 'tralalero tralala de fime', 'aldama', '25.670451, -100.147410', '9ca763fcdd2462a96e7a1fe2e10832a5.jpg', '2026-08-19', '16', 'no', NULL, NULL),
(19, 'Carlos Jesús Gallardo Guerra', 8140225362, 'Nuevo León', 'Guadalupe', 67200, 'Evolución', 1, 'Calles sucias', 'si o que ', 'cuautemoc', '25.670469, -100.147423', '18ab9fd643fe7505579dbecf6fe149e7.jpg', '2026-08-19', '17', 'no', NULL, NULL),
(20, 'Carlos Jesús Gallardo Guerra', 8140225362, 'Nuevo León', 'Guadalupe', 67200, 'Evolución', 1, 'Calles sucias', '}no ko ponesda', 'san pedro bernal', '25.670505, -100.147413', '8c42e0588ba1b46772816c7626ec1f39.jpg', '2026-08-19', '18', 'no', NULL, NULL),
(21, 'Carlos Jesús Gallardo Guerra', 8140225362, 'Nuevo León', 'Guadalupe', 67200, 'Evolución', 1, 'Calles sucias', 'descripcion', 'los locos adams', '25.670475, -100.147404', 'a90f9f9326ccd9bda9a4dd9c9ed232be.jpg', '2026-08-19', '19', 'no', NULL, NULL),
(22, 'Carlos Jesús Gallardo Guerra', 8140225362, 'Nuevo León', 'Guadalupe', 67200, 'Evolución', 1, 'Calles sucias', 'tralalero tralala', 'aldama', '25.670508, -100.147404', 'bf0ba29b01bd098a15aa83e2ef2a0547.jpg', '2026-08-19', '20', 'no', NULL, NULL),
(23, 'Carlos Jesús Gallardo Guerra', 8140225362, 'Nuevo León', 'Guadalupe', 67200, 'Evolución', 1, 'Calles sucias', 'sigo sin quitarlo', '3 de marzo', '25.670524, -100.147403', '73c2159dbb38c858b8d4bf33d5a0ea46.jpg', '2026-08-20', '21', 'no', NULL, NULL),
(24, 'Carlos Jesús Gallardo Guerra', 8140225361, 'Nuevo León', 'Guadalupe', 67200, 'Evolución', 1, 'Calles sucias', 'propuesta de mejora de la IA', 'san pedro bernal', '25.670496, -100.147402', '68395e5402ef8978863e30423507f16c.jpg', '2026-08-20', '22', 'no', NULL, NULL),
(25, 'Carlos Jesús Gallardo Guerra', 8140225362, 'Nuevo León', 'Guadalupe', 67200, 'Evolución', 1, 'Calles sucias', 'finalizacion de las pruebas ', 'los locos adams', '25.670502, -100.147411', 'da0588e31a03029906893f6848d575b4.jpg', '2026-08-20', '23', 'no', NULL, NULL),
(26, 'Carlos Jesús Gallardo Guerra', 8140225362, 'Nuevo León', 'Guadalupe', 67200, 'Evolución', 1, 'Calles sucias', 'Estas farmeando muuucha aura', 'San Pedro del Alto #312', '25.670501, -100.147424', '8d433b59fb9fa0a751079f2e488d1c23.jpg', '2026-08-20', '24', 'no', NULL, NULL),
(27, 'Carlos Jesús Gallardo Guerra', 8140225362, 'Nuevo León', 'Guadalupe', 67200, 'Evolución', 7, 'servicio de bacheo en calles y', 'hay un bache en la esquina con san pedro del alto', 'san pedro bernal', '25.670460, -100.147456', 'd6baa7d1262923d0d1b4a3f42a70b481.jpg', '2026-08-25', '25', 'no', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes_descartados`
--

CREATE TABLE `reportes_descartados` (
  `id` int(11) NOT NULL,
  `id_reporte` int(11) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `motivo` varchar(150) NOT NULL,
  `encargado` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reportes_descartados`
--

INSERT INTO `reportes_descartados` (`id`, `id_reporte`, `tipo`, `motivo`, `encargado`) VALUES
(1, 6, 'Reporte falso', 'Esto no es real', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes_especificacion`
--

CREATE TABLE `reportes_especificacion` (
  `id` int(11) NOT NULL,
  `seccion` varchar(60) NOT NULL,
  `secretaria_nombre` varchar(60) NOT NULL,
  `problema` varchar(70) NOT NULL,
  `encargado` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reportes_especificacion`
--

INSERT INTO `reportes_especificacion` (`id`, `seccion`, `secretaria_nombre`, `problema`, `encargado`) VALUES
(5, '2', 'Servicios Públicos', 'Luz intermitente', 'Dirección de alumbrado'),
(6, '1', 'Servicios Públicos', 'Desazolve y limpieza de alcantarillas', 'Dirección de bacheo'),
(7, '1', 'Servicios Públicos', 'Limpieza de canales pluviales', 'Dirección de bacheo'),
(8, '1', 'Servicios Públicos', 'Limpieza de arroyos', 'Dirección de bacheo'),
(9, '1', 'Servicios Públicos', 'Limpieza de ríos', 'Dirección de bacheo'),
(10, '7', 'Servicios Públicos', 'servicio de bacheo en calles y avenidas', 'Dirección de bacheo'),
(11, '7', 'Servicios Públicos', 'instalación de bordos y/o boyas en zonas de alto riesgo', 'Dirección de bacheo'),
(12, '3', 'Servicios Públicos', 'retiro de escombros de las calles y avenidas', 'Dirección de limpia'),
(13, '7', 'Servicios Públicos', 'ornato', 'Dirección de imagen urbana'),
(14, '7', 'Servicios Públicos', 'forestación', 'Dirección de imagen urbana'),
(15, '7', 'Servicios Públicos', 'mantenimiento rehabilitación y equipamiento de jardines', 'Dirección de imagen urbana'),
(16, '7', 'Servicios Públicos', 'mantenimiento rehabilitación y equipamiento de áreas verdes', 'Dirección de imagen urbana'),
(17, '7', 'Servicios Públicos', 'mantenimiento, rehabilitación y equipamiento de parques ', 'Dirección de parques y plazas municipales'),
(18, '7', 'Servicios Públicos', 'mantenimiento, rehabilitación y equipamiento de plazas', 'Dirección de parques y plazas municipales'),
(19, '3', 'Servicios Públicos', 'Barrido', 'Dirección de limpia'),
(20, '3', 'Servicios Públicos', 'limpieza', 'Dirección de limpia'),
(21, '3', 'Servicios Públicos', 'Recolección de residuos urbanos', 'Dirección de limpia'),
(22, '3', 'Servicios Públicos', 'Pintado', 'Dirección de limpia'),
(23, '3', 'Servicios Públicos', 'Poda de árboles', 'Dirección de limpia'),
(24, '3', 'Servicios Públicos', 'Poda de arbustos', 'Dirección de limpia'),
(25, '3', 'Servicios Públicos', 'Desmonte', 'Dirección de limpia'),
(26, '3', 'Servicios Públicos', 'Deshierbe ', 'Dirección de limpia'),
(27, '3', 'Servicios Públicos', 'Retiro y traslado de cadáveres animales ', 'Dirección de limpia'),
(28, '3', 'Servicios Públicos', 'Recolección de llantas, cacharros y otros', 'Dirección de limpia'),
(29, '3', 'Servicios Públicos', 'Recolección de basura domiciliaria', 'Dirección de limpia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes_resueltos`
--

CREATE TABLE `reportes_resueltos` (
  `id` int(11) NOT NULL,
  `clave` varchar(30) NOT NULL,
  `nombre_colonia` varchar(50) NOT NULL,
  `tipo_reporte` int(11) NOT NULL,
  `resuelto` varchar(5) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `costo` decimal(10,2) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `fecha_resuelto` date NOT NULL,
  `retraso` int(11) NOT NULL,
  `id_encargado` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reportes_resueltos`
--

INSERT INTO `reportes_resueltos` (`id`, `clave`, `nombre_colonia`, `tipo_reporte`, `resuelto`, `foto`, `costo`, `descripcion`, `fecha_resuelto`, `retraso`, `id_encargado`) VALUES
(1, 'YGYk9pXf', 'Evolución', 2, 'si', '73ed78ce8b68aa5c3d9d2c920eb881f2.jpg', 125.00, 'se resolvio algo que no sabia que era', '2026-08-22', 14, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secretarias`
--

CREATE TABLE `secretarias` (
  `id` int(11) NOT NULL,
  `nombre_secretaria` varchar(60) NOT NULL,
  `area_encargada` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `secretarias`
--

INSERT INTO `secretarias` (`id`, `nombre_secretaria`, `area_encargada`) VALUES
(1, 'Servicios Públicos', 'Dirección de bacheo'),
(2, 'Servicios Públicos', 'Dirección de control y seguimiento'),
(3, 'Servicios Públicos', 'Dirección de limpia'),
(4, 'Servicios Públicos', 'Dirección de alumbrado'),
(5, 'Servicios Públicos', 'Dirección de imagen urbana'),
(6, 'Servicios Públicos', 'Dirección de parques y plazas municipales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secretarias_cuentas`
--

CREATE TABLE `secretarias_cuentas` (
  `id_encargado` int(11) NOT NULL,
  `Nombres` varchar(50) NOT NULL,
  `Apellidos` varchar(50) NOT NULL,
  `Edad` int(11) NOT NULL,
  `Sexo` varchar(15) NOT NULL,
  `FDN` date NOT NULL,
  `Telefono` bigint(20) NOT NULL,
  `Departamento` varchar(50) NOT NULL,
  `Correo` varchar(30) NOT NULL,
  `Acceso` varchar(30) NOT NULL,
  `Curp` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `secretarias_cuentas`
--

INSERT INTO `secretarias_cuentas` (`id_encargado`, `Nombres`, `Apellidos`, `Edad`, `Sexo`, `FDN`, `Telefono`, `Departamento`, `Correo`, `Acceso`, `Curp`) VALUES
(1, 'Carlos Jesús', 'Gallardo Guerra', 23, 'Masculino', '2002-06-22', 8119938866, '2', 'carlos.gallardogr@uanl.edu.mx', 'lol887jaja', 'GAGC123422HNLLRRA2'),
(4, 'Juan escutia', 'se aventó ', 45, 'Masculino', '1987-03-24', 8140225362, '8', 'carlos.ramirz@uanl.edu.mx', 'lol887jaja', 'qqw2377iyghkfddddd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_cambios`
--

CREATE TABLE `solicitud_cambios` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `cargo_actual` int(11) NOT NULL,
  `cargo_nuevo` int(11) NOT NULL,
  `cambio_permanente` varchar(5) NOT NULL,
  `motivos` varchar(500) NOT NULL,
  `Aprobado` varchar(5) DEFAULT NULL,
  `indicaciones` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitud_cambios`
--

INSERT INTO `solicitud_cambios` (`id`, `fecha`, `id_empleado`, `nombre`, `cargo_actual`, `cargo_nuevo`, `cambio_permanente`, `motivos`, `Aprobado`, `indicaciones`) VALUES
(1, '2026-03-15', 1, 'Carlos Jesús Gallardo Guerra', 2, 3, 'no', 'Prueba si funcional #1', 'si', 'quiero que vengas entre las 8:00 a 9:30 de la mañana'),
(2, '2026-08-22', 1, 'Carlos Jesús Gallardo Guerra', 2, 7, 'no', 'aver si jala', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ayuntamiento`
--
ALTER TABLE `ayuntamiento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `colonias_guadalupe`
--
ALTER TABLE `colonias_guadalupe`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reportes_colonias`
--
ALTER TABLE `reportes_colonias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uno` (`clave`),
  ADD KEY `nombre_colonia` (`nombre_colonia`),
  ADD KEY `nombre_colonia_2` (`nombre_colonia`);

--
-- Indices de la tabla `reportes_descartados`
--
ALTER TABLE `reportes_descartados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reportes_especificacion`
--
ALTER TABLE `reportes_especificacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reportes_resueltos`
--
ALTER TABLE `reportes_resueltos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uno` (`clave`);

--
-- Indices de la tabla `secretarias`
--
ALTER TABLE `secretarias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `secretarias_cuentas`
--
ALTER TABLE `secretarias_cuentas`
  ADD PRIMARY KEY (`id_encargado`);

--
-- Indices de la tabla `solicitud_cambios`
--
ALTER TABLE `solicitud_cambios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ayuntamiento`
--
ALTER TABLE `ayuntamiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `colonias_guadalupe`
--
ALTER TABLE `colonias_guadalupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=477;

--
-- AUTO_INCREMENT de la tabla `reportes_colonias`
--
ALTER TABLE `reportes_colonias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `reportes_descartados`
--
ALTER TABLE `reportes_descartados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `reportes_especificacion`
--
ALTER TABLE `reportes_especificacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `reportes_resueltos`
--
ALTER TABLE `reportes_resueltos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `secretarias`
--
ALTER TABLE `secretarias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `secretarias_cuentas`
--
ALTER TABLE `secretarias_cuentas`
  MODIFY `id_encargado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `solicitud_cambios`
--
ALTER TABLE `solicitud_cambios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
