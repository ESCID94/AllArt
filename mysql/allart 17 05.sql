-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 17-05-2018 a las 08:41:03
-- Versión del servidor: 5.7.21-0ubuntu0.16.04.1
-- Versión de PHP: 7.2.2-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `allart`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `password` varchar(70) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Email` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `FechaNac` date DEFAULT NULL,
  `Descripcion` text COLLATE utf8mb4_spanish_ci,
  `imagenPerfil` varchar(70) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `rol` varchar(20) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `patrocinador` varchar(40) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `Email`, `FechaNac`, `Descripcion`, `imagenPerfil`, `rol`, `patrocinador`) VALUES
(1, 'cos@example.com', '$2y$10$0eR.KhfTH5ybn/jlB86hwe/1nQeCKXk2RcLEjBscJbpUaF504kSOi', 'prueba@email.com', NULL, 'aaa', 'img/cosmin.jpg', 'usuario', 'Asus'),
(2, 'user@example.org', '$2y$10$0eR.KhfTH5ybn/jlB86hwe/1nQeCKXk2RcLEjBscJbpUaF504kSOi', 'user@example.orggg', NULL, 'Por fin', 'img/descarga.jpg', 'usuario', NULL),
(3, 'admin@example.com', '$2y$10$0eR.KhfTH5ybn/jlB86hwe/1nQeCKXk2RcLEjBscJbpUaF504kSOi', 'admin@example.com', NULL, NULL, NULL, 'usuario', 'Intel'),
(4, 'arodulfo@ucm.es', '$2y$10$umKIwaohJ8L.c/hg33HPvu0X/Bc6Aa.BE9PoshMY03HgfN9E7IlMW', 'arodulfo@ucm.es', '2018-04-26', 'a', NULL, 'usuario', 'Intel'),
(5, 'Intel', '$2y$10$0eR.KhfTH5ybn/jlB86hwe/1nQeCKXk2RcLEjBscJbpUaF504kSOi', 'intel@example.org', '2017-11-23', 'Intel', NULL, 'patrocinador', NULL),
(6, 'prueba', '$2y$10$icsh5zF/V6XD3CwBfL44J.2WaPZcjLSs5ioO8bPM9noYH54kcfuTy', 'prueba@prueba.com', '2018-04-25', 'imagen', 'img/imgBasica.jpg', 'usuario', NULL),
(9, 'alvant01', '$2y$10$6SKHjfRhZvd5h8sEZ5UIKuIkjMUUlfUAp4Zo26bU8dngtRPfNItv.', 'alvant01@ucm.es', '2018-04-23', 'prueba de registro y perfil', 'img/imgBasica.jpg', 'usuario', NULL),
(10, 'Kike', '$2y$10$BI9/MzJQmJHdXXnWb8dIXeMkBtJGLdcq/mDZYw2KZ0RYC5rQlcQ1m', 'k_15j@hotmail.com', '1994-07-15', 'admin', 'img/enrique.jpg', 'admin', 'Asus'),
(11, 'pr2', '$2y$10$eEiJFn7ho0mYsEW4sfIcCeOaOqPTe.l9fYzj3ZcbKc5lR7dYu8O9G', 'pr2@pr2.es', '2018-05-17', 'pr2', 'img/imgBasica.jpg', 'usuario', NULL),
(12, 'Asus', '$2y$10$nLKzNkt7ZDCNn6of54k5oe9/NrXOwQI3aoaPoEIAgt7LQaQ3qvxH2', 'pepito', '0001-01-01', 'p', 'img/imgBasica.jpg', 'patrocinador', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
