-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 09-09-2021 a las 19:19:40
-- Versión del servidor: 10.3.31-MariaDB-0ubuntu0.20.04.1
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agenda_php`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `correo` varchar(60) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `editado` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `agenda`
--

INSERT INTO `agenda` (`id`, `nombre`, `telefono`, `correo`, `usuario_id`, `editado`) VALUES
(7, 'Manu', '8112345678', 'banobacoa@fakemai.com', 3, '2021-09-09 18:05:36'),
(8, 'Manueldongo Act', '8112345678', 'banobacoa@fakemai.com', 3, '2021-09-09 18:46:55'),
(9, 'Jason', '8112345678', 'banobacoa1@fakemai.com', 1, '2021-09-09 17:57:16'),
(10, 'Paris', '8112345678', 'banobacoa1@fakemai.com', 1, '2021-09-09 17:57:25'),
(11, 'Stevie', '8112345678', 'banobacoa1@fakemai.com', 1, '2021-09-09 17:57:32'),
(12, 'Jeno', '8112345678', 'banobacoa1@fakemai.com', 1, '2021-09-09 17:57:41'),
(13, 'Ornel', '8112345678', 'banobacoa1@fakemai.com', 1, '2021-09-09 17:57:49'),
(14, 'Manueldongo Act', '8112345678', 'banobacoa@fakemai.com', 1, '2021-09-09 19:04:41'),
(17, 'Manueldongo Act', '8112345678', 'banobacoa@fakemai.com', 1, '2021-09-09 19:04:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `token` varchar(32) NOT NULL,
  `fecha` varchar(60) NOT NULL,
  `activo` int(1) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tokens`
--

INSERT INTO `tokens` (`id`, `token`, `fecha`, `activo`, `usuario_id`) VALUES
(1, 'b8d871a49fdc8d853b07991f97d5ada8', '2021-09-09 17:56:40', 1, 1),
(4, 'b458a781ce0e9f32c7ff36c64af91fff', '2021-09-09 18:51:36', 1, 2),
(5, 'd29156bcb6a609c56a54766af5d28e1f', '2021-09-09 11:05:35', 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `email`, `password`) VALUES
(1, 'prueba1', 'email@prueba1.com', '$2y$12$v3Wx8cHRxwYZ5q1VP1Othu.vZx8UAHQ6KAEbxy/zlqTbZf8TMxgfS'),
(2, 'prueba2', 'email@prueba2.com', '$2y$12$vqFJZrT1bIfsnKLWF7lkCuD1HetHKDPLh8mB1MvCihEMUgeHx3/9i'),
(3, 'prueba3', 'email@prueba3.com', '$2y$12$uDr9ZTQPrSyMkkAFYO4gE.8plUhxY9hpt2XiNvLuEJ.1AbyAl0DFi');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `agenda_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `tokens`
--
ALTER TABLE `tokens`
  ADD CONSTRAINT `tokens_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
