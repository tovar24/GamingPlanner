-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 08-06-2026 a las 12:49:48
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
-- Base de datos: `gaming_planner`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `idTipeAct` int(11) NOT NULL,
  `idTeam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `activities`
--

INSERT INTO `activities` (`id`, `date`, `idTipeAct`, `idTeam`) VALUES
(1, '2024-06-03', 1, 1),
(6, '2024-06-03', 2, 1),
(7, '2024-06-03', 1, 3),
(8, '2024-06-04', 2, 3),
(9, '2024-06-05', 3, 3),
(10, '2024-06-05', 2, 3),
(11, '2024-06-05', 1, 3),
(12, '2024-07-02', 1, 3),
(13, '2024-06-05', 3, 1),
(14, '2024-06-05', 1, 2),
(15, '2024-06-05', 2, 2),
(16, '2024-07-05', 2, 1),
(17, '2024-07-03', 2, 3),
(18, '2024-06-02', 3, 3),
(19, '2024-06-02', 1, 3),
(20, '2024-06-02', 2, 3),
(21, '2024-06-04', 1, 3),
(22, '2024-06-13', 2, 3),
(23, '2026-06-02', 1, 3),
(24, '2026-06-03', 1, 3),
(25, '2026-06-04', 2, 3),
(27, '2026-06-05', 3, 3),
(28, '2026-06-01', 2, 3),
(29, '2026-06-01', 3, 3),
(30, '2026-06-02', 1, 3),
(31, '2026-06-08', 2, 3),
(32, '2026-06-09', 3, 3),
(34, '2026-07-02', 2, 3),
(35, '2026-07-07', 3, 3),
(39, '2026-06-01', 1, 1),
(40, '2026-06-02', 2, 1),
(41, '2026-06-03', 3, 1),
(42, '2026-06-04', 2, 1),
(43, '2026-06-05', 1, 1),
(44, '2026-06-01', 2, 1),
(45, '2026-06-04', 3, 1),
(46, '2026-06-04', 1, 1),
(47, '2026-05-28', 2, 1),
(48, '2026-05-27', 1, 1),
(49, '2026-06-08', 1, 1),
(50, '2026-06-08', 2, 1),
(51, '2026-06-09', 2, 1),
(52, '2026-06-09', 3, 1),
(53, '2026-06-09', 1, 1),
(54, '2026-06-10', 2, 1),
(55, '2026-06-11', 1, 1),
(56, '2026-06-11', 3, 1),
(57, '2026-06-11', 1, 1),
(58, '2026-06-11', 2, 1),
(59, '2026-06-11', 2, 1),
(61, '2026-06-12', 3, 1),
(62, '2026-06-11', 2, 1),
(63, '2026-06-11', 3, 1),
(64, '2026-06-11', 3, 1),
(65, '2026-06-10', 3, 1),
(66, '2026-06-15', 1, 1),
(67, '2026-06-16', 2, 1),
(68, '2026-06-17', 3, 1),
(69, '2026-06-18', 2, 1),
(70, '2026-06-19', 1, 1),
(71, '2026-06-17', 2, 1),
(72, '2026-06-17', 1, 1),
(73, '2026-06-22', 2, 1),
(74, '2026-06-20', 1, 1),
(75, '2026-06-23', 3, 1),
(76, '2026-06-23', 1, 1),
(78, '2026-06-24', 3, 1),
(79, '2026-06-25', 2, 1),
(80, '2026-06-26', 1, 1),
(81, '2026-06-29', 1, 1),
(83, '2026-07-01', 1, 1),
(84, '2026-07-01', 2, 1),
(85, '2026-07-03', 3, 1),
(86, '2026-07-03', 2, 1),
(87, '2026-07-02', 1, 1),
(88, '2026-06-30', 3, 1),
(89, '2026-07-07', 2, 1),
(91, '2026-07-09', 3, 1),
(92, '2026-05-27', 1, 2),
(93, '2026-05-25', 2, 2),
(94, '2026-05-29', 3, 2),
(95, '2026-06-01', 1, 2),
(96, '2026-06-02', 2, 2),
(97, '2026-06-03', 3, 2),
(98, '2026-06-04', 2, 2),
(99, '2026-06-05', 1, 2),
(100, '2026-06-03', 1, 2),
(101, '2026-06-03', 2, 2),
(102, '2026-06-08', 3, 2),
(103, '2026-06-09', 2, 2),
(104, '2026-06-10', 1, 2),
(105, '2026-06-11', 2, 2),
(106, '2026-06-12', 3, 2),
(107, '2026-06-10', 2, 2),
(108, '2026-06-10', 3, 2),
(109, '2026-06-11', 3, 2),
(110, '2026-06-08', 2, 2),
(111, '2026-06-08', 1, 2),
(112, '2026-06-10', 2, 2),
(113, '2026-06-10', 1, 2),
(114, '2026-06-10', 3, 2),
(115, '2026-06-10', 1, 2),
(116, '2026-06-10', 2, 2),
(117, '2026-06-11', 1, 2),
(118, '2026-06-11', 3, 2),
(119, '2026-06-15', 1, 2),
(120, '2026-06-16', 2, 2),
(121, '2026-06-17', 3, 2),
(122, '2026-06-18', 2, 2),
(123, '2026-06-19', 3, 2),
(124, '2026-06-16', 1, 2),
(125, '2026-06-19', 1, 2),
(126, '2026-06-16', 3, 2),
(127, '2026-06-22', 1, 2),
(128, '2026-06-23', 2, 2),
(129, '2026-06-24', 3, 2),
(130, '2026-06-24', 1, 2),
(131, '2026-06-25', 2, 2),
(132, '2026-06-25', 3, 2),
(133, '2026-06-25', 1, 2),
(134, '2026-06-26', 3, 2),
(135, '2026-06-29', 1, 2),
(136, '2026-06-30', 2, 2),
(137, '2026-06-30', 3, 2),
(138, '2026-07-01', 2, 2),
(139, '2026-07-02', 3, 2),
(140, '2026-07-03', 2, 2),
(141, '2026-07-03', 1, 2),
(142, '2026-07-03', 3, 2),
(143, '2026-07-08', 3, 2),
(144, '2026-06-10', 1, 2),
(145, '2026-07-10', 1, 2),
(146, '2026-06-02', 2, 3),
(147, '2026-06-10', 1, 3),
(148, '2026-06-11', 2, 3),
(149, '2026-06-12', 3, 3),
(150, '2026-06-12', 1, 3),
(151, '2026-06-12', 2, 3),
(152, '2026-06-12', 2, 3),
(153, '2026-06-12', 1, 3),
(154, '2026-06-12', 3, 3),
(155, '2026-06-12', 3, 3),
(156, '2026-06-12', 1, 3),
(157, '2026-06-08', 3, 3),
(158, '2026-06-08', 1, 3),
(159, '2026-06-11', 3, 3),
(160, '2026-06-11', 1, 3),
(161, '2026-05-26', 2, 3),
(162, '2026-05-28', 1, 3),
(163, '2026-05-27', 3, 3),
(164, '2026-05-27', 1, 3),
(165, '2026-06-15', 2, 3),
(166, '2026-06-17', 1, 3),
(167, '2026-06-18', 3, 3),
(168, '2026-06-15', 1, 3),
(169, '2026-06-19', 2, 3),
(170, '2026-06-19', 1, 3),
(171, '2026-06-19', 3, 3),
(172, '2026-06-22', 1, 3),
(173, '2026-06-23', 1, 3),
(174, '2026-06-23', 2, 3),
(175, '2026-06-23', 3, 3),
(176, '2026-06-25', 2, 3),
(177, '2026-06-26', 1, 3),
(178, '2026-06-24', 3, 3),
(179, '2026-06-30', 3, 3),
(180, '2026-06-30', 2, 3),
(181, '2026-07-02', 1, 3),
(182, '2026-07-01', 1, 3),
(183, '2026-07-09', 2, 3),
(184, '2026-07-08', 1, 3),
(185, '2026-07-09', 1, 3),
(186, '2026-06-09', 1, 4),
(187, '2026-06-10', 2, 4),
(188, '2026-06-08', 3, 4),
(189, '2026-06-11', 1, 4),
(190, '2026-06-12', 3, 4),
(191, '2026-06-10', 1, 4),
(193, '2026-06-10', 2, 4),
(194, '2026-06-10', 3, 4),
(195, '2026-06-10', 3, 4),
(196, '2026-06-10', 3, 4),
(197, '2026-06-10', 3, 4),
(198, '2026-06-10', 2, 4),
(199, '2026-06-08', 2, 4),
(200, '2026-06-12', 2, 4),
(201, '2026-06-01', 2, 4),
(202, '2026-06-03', 3, 4),
(203, '2026-06-02', 1, 4),
(204, '2026-06-02', 2, 4),
(205, '2026-06-04', 2, 4),
(206, '2026-06-04', 3, 4),
(207, '2026-06-04', 1, 4),
(208, '2026-06-05', 1, 4),
(209, '2026-06-15', 1, 4),
(210, '2026-06-16', 2, 4),
(211, '2026-06-17', 3, 4),
(212, '2026-06-18', 2, 4),
(213, '2026-06-19', 1, 4),
(214, '2026-06-10', 1, 4),
(215, '2026-06-17', 1, 4),
(216, '2026-05-26', 2, 4),
(217, '2026-06-28', 1, 4),
(218, '2026-05-28', 3, 4),
(219, '2026-05-28', 1, 4),
(220, '2026-06-22', 2, 4),
(221, '2026-06-23', 1, 4),
(222, '2026-06-24', 3, 4),
(223, '2026-06-25', 1, 4),
(224, '2026-06-25', 2, 4),
(225, '2026-06-26', 2, 4),
(226, '2026-06-23', 3, 4),
(227, '2026-06-23', 2, 4),
(228, '2026-06-29', 1, 4),
(229, '2026-06-30', 2, 4),
(230, '2026-06-30', 3, 4),
(231, '2026-07-01', 2, 4),
(232, '2026-07-02', 1, 4),
(233, '2026-07-03', 3, 4),
(234, '2026-07-02', 2, 4),
(235, '2026-07-07', 1, 4),
(236, '2026-07-09', 3, 4),
(237, '2026-07-09', 2, 4),
(238, '2026-07-10', 1, 4),
(239, '2026-07-06', 2, 4),
(240, '2026-07-08', 3, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `game`
--

CREATE TABLE `game` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `result` varchar(10) DEFAULT NULL,
  `idTournament` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `game`
--

INSERT INTO `game` (`id`, `date`, `result`, `idTournament`) VALUES
(1, '2024-06-01', '13-10', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `game_team`
--

CREATE TABLE `game_team` (
  `id` int(11) NOT NULL,
  `idGame` int(11) NOT NULL,
  `idTeam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `game_team`
--

INSERT INTO `game_team` (`id`, `idGame`, `idTeam`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `rol` varchar(20) NOT NULL,
  `privileges` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `rol`, `privileges`) VALUES
(1, 'CEO', b'1'),
(2, 'STAFF', NULL),
(3, 'COACH', NULL),
(4, 'PLAYER', NULL),
(5, 'SUPERADMIN', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `team`
--

INSERT INTO `team` (`id`, `name`) VALUES
(1, 'CROW DYNASTY'),
(2, 'FUSYON'),
(3, 'KRÜ'),
(4, 'SENTINELS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipe_activity`
--

CREATE TABLE `tipe_activity` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipe_activity`
--

INSERT INTO `tipe_activity` (`id`, `name`) VALUES
(1, 'VOD'),
(2, 'Teórico'),
(3, 'PRACC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tournament`
--

CREATE TABLE `tournament` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `idGame` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tournament`
--

INSERT INTO `tournament` (`id`, `name`, `url`, `idGame`) VALUES
(1, 'Circuito Tormenta', NULL, NULL),
(2, 'Liga Radiante', NULL, NULL),
(3, 'Clutch Series', 'https://circuitotormenta.com/landing/clutch-series', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tournament_team`
--

CREATE TABLE `tournament_team` (
  `id` int(11) NOT NULL,
  `idTournament` int(11) NOT NULL,
  `idTeam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `idRol` int(11) DEFAULT NULL,
  `idTeam` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `idRol`, `idTeam`) VALUES
(1, 'ADMIN', 'admin1234@gmail.com', 'c93ccd78b2076528346216b3b2f701e6', 1, NULL),
(2, 'pruebaAPI', 'prueba1@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 2, NULL),
(5, 'prueba2', 'prueba2@gmail.com', '12345', 3, NULL),
(7, 'Camilo', 'camilo@gmail.com', '$2y$10$vM8x4NOk/nUsIn7M8F6CQODuFCNojlCaAZMjvxZC4Xo2QCC2.tbW2', 3, NULL),
(8, 'Cristian', 'cristian@gmail.com', '$2y$10$z7LxjmUNjGn80888/ZeyueBBwBRcOv.KvmCJbYGcbRrwjkfXpSIgq', 1, NULL),
(9, 'jose', 'jose@gmail.com', '$2y$10$QN64m4hOTVDLLBuOTADCiey2KAmGJR5c66DqsXGHsfwe1TmqOa3vu', 4, NULL),
(10, 'Sofia', 'sofia@gmail.com', '$2y$10$G1H7ycgHO/5SkPQ5NmRSr.cKMC4Js5te0h1RfaYih7xbNlqTwyXO.', 4, NULL),
(11, 'prueba rol 1', 'pruebarol@gmail.com', '$2y$10$qU5hraNfgjk4lqPZybywsenUrMaytq08L7eC/z0t1IaCy38/RmeE2', 2, NULL),
(12, 'superadmin', 'superadmin@gmail.com', '$2y$10$cZIGHeypknFiLXENFKiB6.hRRQLk0SwjuMmEpJ11pZZafviXwnDga', 5, NULL),
(13, 'prueba user', 'pruebauser@gmail.com', '$2y$10$T/WBrMIk2UR1uyUEMJ6zkOUsqbYdItQxOT9exwJRZYluUkRKCcBXe', 4, NULL),
(14, 'CEO_CD', 'CeoCrowDinasty@gmail.com', '$2y$10$QT63c0a99smqyMlmzQCI8Ohq6Evjitph/pvXJgoBG0uYuxPbNNpx6', 1, 1),
(15, 'CEO_FS', 'CeoFusyon@gmail.com', '$2y$10$7vVu31xL5KW3HmtXoWbKherATE3lTld4I7iyx5RWgahxcutEYayk2', 1, 2),
(16, 'Jugador1_CD', 'Jugador1_CD@gmail.com', '$2y$10$7eyAEzzP2q5fis/Yd5dPk.gWryDHx8wm9CA1nOiEpjhn6gBwHEWZe', 4, 1),
(17, 'Jugador2_CD', 'Jugador2_CD@gmail.com', '$2y$10$hkhGM0KIGlAnayix6f3VKeTsfm8dj4SKosaqV0BjtajuEFf0tzziK', 4, 1),
(18, 'Jugador3_CD', 'Jugador3_CD@gmail.com', '$2y$10$UyMpfAC7RzPjsYBNGHuxbeqwKr0oK8bJndlltmWTG2aWx4Yf8E8Aq', 4, 1),
(19, 'Jugador4_CD', 'Jugador4_CD@gmail.com', '$2y$10$o.KsBGHX7bzW5aGi1puws.TFuqq/.juK8xNz0hBsz6a7HbEdYhYgS', 4, 1),
(20, 'Jugador5_CD', 'Jugador5_CD@gmail.com', '$2y$10$/h6GSb9avKl0VqhMpfaTXOsrH9r/yjoB9C6I8y0vRNUQEL6JkxBSu', 4, 1),
(21, 'COACH_CD', 'Coach_CD@gmail.com', '$2y$10$5RJ7uat7BPcRDqqd5B6YSuR898oB7tVCB7efDSuPI8bMqyO981TjW', 3, 1),
(22, 'STAFF1_CD', 'STAFF1_CD@gmail.com', '$2y$10$iD1zdJhkNfUucgthlHQAM.eTr/RoEhKC.Y2X3PW1zIpOHHasKHQxO', 2, 1),
(23, 'STAFF2_CD', 'STAFF2_CD@gmail.com', '$2y$10$U8X8.oYNdjkBqC6h7msVG.ewdM3Zecl8PmoQbm8nwDhmLAZILp7Wm', 2, 1),
(24, 'STAFF1_FS', 'STAFF1_FS@gmail.com', '$2y$10$GuaDvnamk62PKLgV950dketA4GaMNwzTH7C71g7.jluuQemdUFq1.', 2, 2),
(25, 'STAFF2_FS', 'STAFF2_FS@gmail.com', '$2y$10$Ru9ILk1DcWOTB.M5fuaHI.DFRiaAe07KG05aUeZ/klxPjUcAuCpuS', 2, 2),
(26, 'COACH_FS', 'COACH_FS@gmail.com', '$2y$10$Lmgf3Qo8MreWnQF0syvBAeKqaPbEpaLh6luTjKvkrtoEW./Tzq6uO', 3, 2),
(27, 'Jugador1_FS', 'Jugador1_FS@gmail.com', '$2y$10$JIT1Z8LqLt49pRzRnDHQWuIFYVTMRhN5.L7dbsYw4FLgrYRuqJmPq', 4, 2),
(28, 'Jugador2_FS', 'Jugador2_FS@gmail.com', '$2y$10$AzJzY9DPM9KHYcr1iEPLgO8NgqITFgqZowB4Fk69KyRSQ.UQ7t3wi', 4, 2),
(29, 'Jugador3_FS', 'Jugador3_FS@gmail.com', '$2y$10$nm5iopbWP4RTE.aRtPCZfOYt5fbVuGcto4Z2sYET3/0rTzMxmDH1u', 4, 2),
(30, 'Jugador5_FS', 'Jugador5_FS@gmail.com', '$2y$10$3NM5QN1QAscMdP3VkdjdDOKYXwTXJ0yEC80fLy0VZUG5k/By/TOM2', 4, 2),
(31, 'Jugador4_FS', 'Jugador4_FS@gmail.com', '$2y$10$QuxylD/4X8eu2qvCWy.wueEk6R0kwZmY8w9irpN1d97Sbs.alcxza', 4, 2),
(32, 'CEO_SEN', 'CEO_SEN@gmail.com', '$2y$10$JF/HqWSYiX3idOplAhACW.kHSHOHy0HJcZZwj5sGdmFLPJQ4GA4SS', 1, 4),
(33, 'COACH_SEN ', 'COACH_SEN@gmail.com', '$2y$10$6vBpKxNdSyX2.j08DaGBteZGqu5IpGuN9rXiFvDcKfdalB9bSxQnm', 3, 4),
(34, 'STAFF1_SEN', 'STAFF1_SEN@gmail.com', '$2y$10$6apbl1Y2pexLAisgbFtdTuMIy.dm0Z4NVFcFw/DeniIdtfV8BDNwa', 2, 4),
(35, 'STAFF2_SEN', 'STAFF2_SEN@gmail.com', '$2y$10$9fsz3jvFnLmXMDzgcmasu.gA0fYdBCksiyKrf9DBUhENX6qXUYAEK', 2, 4),
(36, 'Jugador1_SEN', 'Jugador1_SEN@gmail.com', '$2y$10$BjPv.TM1Y1sWV5j14i3FvecrP2Z771AKq5ZtdclnVTuc7.EKtj6Rq', 4, 4),
(37, 'Jugador2_SEN', 'Jugador2_SEN@gmail.com', '$2y$10$Wq1/JavS/02CKVvm.vzOUO4AnHFrRqt9hrYcsI7BF5QHNNV7ND.re', 4, 4),
(38, 'Jugador3_SEN', 'Jugador3_SEN@gmail.com', '$2y$10$1B/15QVDkRH7YeTAMSdFTeTAxWekYny.8ro2lvjHdtOorzxyino3O', 4, 4),
(39, 'Jugador4_SEN', 'Jugador4_SEN@gmail.com', '$2y$10$4u0HAj/Sbbn/7BoNDu7J6.xluCJV6miGBJrAHaZqd1BiSU0PqxZW2', 4, 4),
(40, 'Jugador5_SEN', 'Jugador5_SEN@gmail.com', '$2y$10$ZVm9kHOg5B0tnTYnYtZlXOiB2LwHwwIlJeOKb7a7Qax7XIOq8DlXu', 4, 4),
(41, 'CEO_KRU', 'CEO_KRU@gmail.com', '$2y$10$zlwNshqKhmQVAAXcHsFKkujHd6eWSpbGSGP5lQIdIPxwC60C2YzDW', 1, 3),
(42, 'COACH_KRU', 'COACH_KRU@gmail.com', '$2y$10$21/NrkUPPGqOKHdDz9.aHek5n8hzBi8EMA.wmGr3E57btu/Sq6mUK', 3, 3),
(43, 'STAFF1_KRU', 'STAFF1_KRU@gmail.com', '$2y$10$gGjy7CR2EXq/biqbVmAEdORACKmm5Sb9hL0qQQ3a./DLUg4UryqKe', 2, 3),
(44, 'STAFF2_KRU', 'STAFF2_KRU@gmail.com', '$2y$10$dDwPsL2U1pY9XMVGUeFmTuK2pphhhH/z0pyx/rlB13ZVuMQ9hKWX.', 2, 3),
(45, 'Jugador1_KRU', 'Jugador1_KRU@gmail.com', '$2y$10$yuzhOlnJQVYcV7P3j8osR.oAEAyX.AcDnC2c8I2jxM3nWv2aZPMN.', 4, 3),
(46, 'Jugador2_KRU', 'Jugador2_KRU@gmail.com', '$2y$10$3cKoDrj5GqQf2q3rAQHBR.eZrholdPf9mi8Puai7BdAy1h/f0EuPa', 4, 3),
(47, 'Jugador3_KRU', 'Jugador3_KRU@gmail.com', '$2y$10$MbJIMb6fi2ngqj87X9VRYuNSO3VUOBW33TtRfJ8Xs6JSt/0ulsUpe', 4, 3),
(48, 'Jugador4_KRU', 'Jugador4_KRU@gmail.com', '$2y$10$Gv7v/McI/QilFB6hGxIEa.AoCsqre3cZFGelRoG3TbZflPnFbxIFO', 4, 3),
(49, 'Jugador5_KRU', 'Jugador5_KRU@gmail.com', '$2y$10$CyrbopHa//3Iiod7GOuimOA6almc2g/6RhybNT/FI2VBBNXMDyNly', 4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_token`
--

CREATE TABLE `users_token` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users_token`
--

INSERT INTO `users_token` (`id`, `idUser`, `token`, `fecha`) VALUES
(1, 1, 'dba672c0c7159a43cc68864e2d888a02', '2024-04-27'),
(2, 2, 'fbb3681913dbc8243d8a49ce4c6568d8', '2024-04-27');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tipeAct_1` (`idTipeAct`),
  ADD KEY `fk_teamID_2` (`idTeam`);

--
-- Indices de la tabla `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tournamentID_1` (`idTournament`);

--
-- Indices de la tabla `game_team`
--
ALTER TABLE `game_team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_IdGame_1` (`idGame`),
  ADD KEY `fk_IdTeam_2` (`idTeam`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipe_activity`
--
ALTER TABLE `tipe_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tournament`
--
ALTER TABLE `tournament`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_gameID_1` (`idGame`);

--
-- Indices de la tabla `tournament_team`
--
ALTER TABLE `tournament_team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idTournament` (`idTournament`) USING BTREE,
  ADD KEY `idTeam` (`idTeam`) USING BTREE;

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idRol` (`idRol`) USING BTREE,
  ADD KEY `idTeam` (`idTeam`) USING BTREE;

--
-- Indices de la tabla `users_token`
--
ALTER TABLE `users_token`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idUser` (`idUser`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT de la tabla `game`
--
ALTER TABLE `game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `game_team`
--
ALTER TABLE `game_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipe_activity`
--
ALTER TABLE `tipe_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tournament`
--
ALTER TABLE `tournament`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tournament_team`
--
ALTER TABLE `tournament_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `users_token`
--
ALTER TABLE `users_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `fk_teamID_2` FOREIGN KEY (`idTeam`) REFERENCES `team` (`id`),
  ADD CONSTRAINT `fk_tipeAct_1` FOREIGN KEY (`idTipeAct`) REFERENCES `tipe_activity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `fk_tournamentID_1` FOREIGN KEY (`idTournament`) REFERENCES `tournament` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `game_team`
--
ALTER TABLE `game_team`
  ADD CONSTRAINT `fk_IdGame_1` FOREIGN KEY (`idGame`) REFERENCES `game` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_IdTeam_2` FOREIGN KEY (`idTeam`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tournament`
--
ALTER TABLE `tournament`
  ADD CONSTRAINT `fk_gameID_1` FOREIGN KEY (`idGame`) REFERENCES `game` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tournament_team`
--
ALTER TABLE `tournament_team`
  ADD CONSTRAINT `team_fk_1` FOREIGN KEY (`idTeam`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tournament_fk_2` FOREIGN KEY (`idTournament`) REFERENCES `tournament` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `rolUser_fk_1` FOREIGN KEY (`idRol`) REFERENCES `rol` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `team_fk_2` FOREIGN KEY (`idTeam`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users_token`
--
ALTER TABLE `users_token`
  ADD CONSTRAINT `users_fk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
