-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-04-2024 a las 03:26:27
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
-- Base de datos: `kenner`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `armas`
--

CREATE TABLE `armas` (
  `id_arma` int(11) NOT NULL,
  `nombre_arma` varchar(255) DEFAULT NULL,
  `tipo_arma` enum('puño','pistola','francotirador','ametralladora') DEFAULT NULL,
  `tipo_municion` varchar(255) DEFAULT NULL,
  `cantidad_municion` int(11) DEFAULT NULL,
  `daño` int(11) DEFAULT NULL,
  `imagen_arma` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloqueos`
--

CREATE TABLE `bloqueos` (
  `id_bloqueo` int(11) NOT NULL,
  `id_jugador` int(11) DEFAULT NULL,
  `motivo_bloqueo` varchar(255) DEFAULT NULL,
  `tiempo_bloqueo` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticas_jugador`
--

CREATE TABLE `estadisticas_jugador` (
  `id_estadistica` int(11) NOT NULL,
  `id_jugador` int(11) DEFAULT NULL,
  `tipo_accion` varchar(255) DEFAULT NULL,
  `puntos_obtenidos` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ganadores_partida`
--

CREATE TABLE `ganadores_partida` (
  `id_ganador` int(11) NOT NULL,
  `id_partida` int(11) DEFAULT NULL,
  `id_jugador` int(11) DEFAULT NULL,
  `timestamp_ganador` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mundos`
--

CREATE TABLE `mundos` (
  `id_mundo` int(11) NOT NULL,
  `nombre_mundo` varchar(255) DEFAULT NULL,
  `tipo_mundo` enum('BR-Clasificatoria','DE-Clasificatoria','otro') DEFAULT NULL,
  `capacidad_maxima_jugadores` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles`
--

CREATE TABLE `niveles` (
  `id_nivel` int(11) NOT NULL,
  `nombre_nivel` varchar(255) DEFAULT NULL,
  `puntos_requeridos` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidas`
--

CREATE TABLE `partidas` (
  `id_partida` int(11) NOT NULL,
  `id_jugador` int(11) DEFAULT NULL,
  `id_nivel` int(11) DEFAULT NULL,
  `id_arma` int(11) DEFAULT NULL,
  `id_mundo` int(11) DEFAULT NULL,
  `puntos_obtenidos` int(11) DEFAULT NULL,
  `tiempo_inicio` timestamp NULL DEFAULT NULL,
  `tiempo_fin` timestamp NULL DEFAULT NULL,
  `estado_partida` enum('en curso','finalizada','otro') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recuperacion_contrasena`
--

CREATE TABLE `recuperacion_contrasena` (
  `id_solicitud` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `codigo_verificacion` varchar(255) DEFAULT NULL,
  `timestamp_solicitud` timestamp NULL DEFAULT NULL,
  `estado_solicitud` enum('pendiente','completada','otro') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `contraseña` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `sexo` enum('masculino','femenino','otro') DEFAULT NULL,
  `estado` enum('activo','bloqueado','otro') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `armas`
--
ALTER TABLE `armas`
  ADD PRIMARY KEY (`id_arma`);

--
-- Indices de la tabla `bloqueos`
--
ALTER TABLE `bloqueos`
  ADD PRIMARY KEY (`id_bloqueo`),
  ADD KEY `id_jugador` (`id_jugador`);

--
-- Indices de la tabla `estadisticas_jugador`
--
ALTER TABLE `estadisticas_jugador`
  ADD PRIMARY KEY (`id_estadistica`),
  ADD KEY `id_jugador` (`id_jugador`);

--
-- Indices de la tabla `ganadores_partida`
--
ALTER TABLE `ganadores_partida`
  ADD PRIMARY KEY (`id_ganador`),
  ADD KEY `id_partida` (`id_partida`),
  ADD KEY `id_jugador` (`id_jugador`);

--
-- Indices de la tabla `mundos`
--
ALTER TABLE `mundos`
  ADD PRIMARY KEY (`id_mundo`);

--
-- Indices de la tabla `niveles`
--
ALTER TABLE `niveles`
  ADD PRIMARY KEY (`id_nivel`);

--
-- Indices de la tabla `partidas`
--
ALTER TABLE `partidas`
  ADD PRIMARY KEY (`id_partida`),
  ADD KEY `id_jugador` (`id_jugador`),
  ADD KEY `id_nivel` (`id_nivel`),
  ADD KEY `id_arma` (`id_arma`),
  ADD KEY `id_mundo` (`id_mundo`);

--
-- Indices de la tabla `recuperacion_contrasena`
--
ALTER TABLE `recuperacion_contrasena`
  ADD PRIMARY KEY (`id_solicitud`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bloqueos`
--
ALTER TABLE `bloqueos`
  ADD CONSTRAINT `bloqueos_ibfk_1` FOREIGN KEY (`id_jugador`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `estadisticas_jugador`
--
ALTER TABLE `estadisticas_jugador`
  ADD CONSTRAINT `estadisticas_jugador_ibfk_1` FOREIGN KEY (`id_jugador`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `ganadores_partida`
--
ALTER TABLE `ganadores_partida`
  ADD CONSTRAINT `ganadores_partida_ibfk_1` FOREIGN KEY (`id_partida`) REFERENCES `partidas` (`id_partida`),
  ADD CONSTRAINT `ganadores_partida_ibfk_2` FOREIGN KEY (`id_jugador`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `partidas`
--
ALTER TABLE `partidas`
  ADD CONSTRAINT `partidas_ibfk_1` FOREIGN KEY (`id_jugador`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `partidas_ibfk_2` FOREIGN KEY (`id_nivel`) REFERENCES `niveles` (`id_nivel`),
  ADD CONSTRAINT `partidas_ibfk_3` FOREIGN KEY (`id_arma`) REFERENCES `armas` (`id_arma`),
  ADD CONSTRAINT `partidas_ibfk_4` FOREIGN KEY (`id_mundo`) REFERENCES `mundos` (`id_mundo`);

--
-- Filtros para la tabla `recuperacion_contrasena`
--
ALTER TABLE `recuperacion_contrasena`
  ADD CONSTRAINT `recuperacion_contrasena_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
