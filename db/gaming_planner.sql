-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 27-04-2024 a las 19:58:00
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

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
-- Estructura de tabla para la tabla `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `activity`
--

INSERT INTO `activity` (`id`, `name`) VALUES
(1, 'VOD'),
(2, 'Teórico'),
(3, 'PRACC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `daily_activities`
--

CREATE TABLE `daily_activities` (
  `id` int(11) NOT NULL,
  `idDay` int(11) NOT NULL,
  `idActivity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `daily_activities`
--

INSERT INTO `daily_activities` (`id`, `idDay`, `idActivity`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `day`
--

CREATE TABLE `day` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `day`
--

INSERT INTO `day` (`id`, `name`) VALUES
(1, 'Lunes'),
(2, 'Martes'),
(3, 'Miércoles'),
(4, 'Jueves'),
(5, 'Viernes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `month`
--

CREATE TABLE `month` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `month`
--

INSERT INTO `month` (`id`, `name`) VALUES
(1, 'Enero'),
(2, 'Febrero'),
(3, 'Marzo'),
(4, 'Abril'),
(5, 'Mayo'),
(6, 'Junio'),
(7, 'Julio'),
(8, 'Agosto'),
(9, 'Septiembre'),
(10, 'Octubre'),
(11, 'Noviembre'),
(12, 'Diciembre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planner`
--

CREATE TABLE `planner` (
  `id` int(11) NOT NULL,
  `idMonth` int(11) NOT NULL,
  `idWeekDay` int(11) NOT NULL,
  `idDailyAct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(4, 'PLAYER', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `idPlanner` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `team`
--

INSERT INTO `team` (`id`, `name`, `idPlanner`) VALUES
(1, 'CROW DYNASTY', NULL),
(2, 'FUSYON', NULL),
(3, 'KRÜ', NULL),
(4, 'SENTINELS', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tournament`
--

CREATE TABLE `tournament` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tournament`
--

INSERT INTO `tournament` (`id`, `name`) VALUES
(1, 'Circuito Tormenta'),
(2, 'Liga Radiante');

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
  `password` varchar(50) NOT NULL,
  `idRol` int(11) NOT NULL,
  `idTeam` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `idRol`, `idTeam`) VALUES
(1, 'ADMIN', 'admin1234@gmail.com', 'c93ccd78b2076528346216b3b2f701e6', 1, NULL),
(2, 'pruebaAPI', 'prueba1@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 2, NULL);

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `week`
--

CREATE TABLE `week` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `week`
--

INSERT INTO `week` (`id`, `name`) VALUES
(1, 'Semana 1'),
(2, 'Semana 2'),
(3, 'Semana 3'),
(4, 'Semana 4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `week_day`
--

CREATE TABLE `week_day` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `idWeek` int(11) NOT NULL,
  `idDay` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `week_day`
--

INSERT INTO `week_day` (`id`, `name`, `idWeek`, `idDay`) VALUES
(3, 'S1Lunes', 1, 1),
(5, 'S1Martes', 1, 2),
(6, 'S1Miercoles', 1, 3),
(7, 'S1Jueves', 1, 4),
(8, 'S1Viernes', 1, 5),
(9, 'S2Lunes', 2, 1),
(10, 'S2Martes', 2, 2),
(11, 'S2Miercoles', 2, 3),
(12, 'S2Jueves', 2, 4),
(13, 'S2Viernes', 2, 5),
(14, 'S3Lunes', 3, 1),
(15, 'S3Martes', 3, 2),
(16, 'S3Miercoles', 3, 3),
(17, 'S3Jueves', 3, 4),
(18, 'S3Viernes', 3, 5),
(19, 'S4Lunes', 4, 1),
(20, 'S4Martes', 4, 2),
(21, 'S4Miercoles', 4, 3),
(22, 'S4Jueves', 4, 4),
(23, 'S4Viernes', 4, 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `daily_activities`
--
ALTER TABLE `daily_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idDay` (`idDay`) USING BTREE,
  ADD KEY `idActivity` (`idActivity`) USING BTREE;

--
-- Indices de la tabla `day`
--
ALTER TABLE `day`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `month`
--
ALTER TABLE `month`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `planner`
--
ALTER TABLE `planner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idMonth` (`idMonth`) USING BTREE,
  ADD KEY `idDailyAct` (`idDailyAct`) USING BTREE,
  ADD KEY `idWeek` (`idWeekDay`) USING BTREE;

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPlanner` (`idPlanner`) USING BTREE;

--
-- Indices de la tabla `tournament`
--
ALTER TABLE `tournament`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `week`
--
ALTER TABLE `week`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `week_day`
--
ALTER TABLE `week_day`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idDay` (`idDay`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `daily_activities`
--
ALTER TABLE `daily_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `day`
--
ALTER TABLE `day`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `month`
--
ALTER TABLE `month`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `planner`
--
ALTER TABLE `planner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tournament`
--
ALTER TABLE `tournament`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tournament_team`
--
ALTER TABLE `tournament_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users_token`
--
ALTER TABLE `users_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `week`
--
ALTER TABLE `week`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `week_day`
--
ALTER TABLE `week_day`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `daily_activities`
--
ALTER TABLE `daily_activities`
  ADD CONSTRAINT `activityID_fk_2` FOREIGN KEY (`idActivity`) REFERENCES `activity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dayID_fk_1` FOREIGN KEY (`idDay`) REFERENCES `day` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `planner`
--
ALTER TABLE `planner`
  ADD CONSTRAINT `dailyAct_fk_3` FOREIGN KEY (`idDailyAct`) REFERENCES `daily_activities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `month_fk_1` FOREIGN KEY (`idMonth`) REFERENCES `month` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `weekDay_fk_2` FOREIGN KEY (`idWeekDay`) REFERENCES `week_day` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `plannerID_fk_1` FOREIGN KEY (`idPlanner`) REFERENCES `planner` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Filtros para la tabla `week_day`
--
ALTER TABLE `week_day`
  ADD CONSTRAINT `day_fk_2` FOREIGN KEY (`idDay`) REFERENCES `day` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `weekId_fk_1` FOREIGN KEY (`idWeek`) REFERENCES `week` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
