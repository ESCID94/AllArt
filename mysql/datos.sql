-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 26, 2016 at 06:13 PM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40101 SET foreign_key_checks = 0 */;

--
-- Truncate table before insert `Roles`
--

TRUNCATE TABLE `Roles`;
--
-- Dumping data for table `Roles`
--

INSERT INTO `Roles` (`id`, `nombre`) VALUES
(1, 'user'),
(2, 'admin');

--
-- Truncate table before insert `RolesUsuario`
--

TRUNCATE TABLE `RolesUsuario`;
--
-- Dumping data for table `RolesUsuario`
--

INSERT INTO `RolesUsuario` (`usuario`, `rol`) VALUES
(1, 1),
(2, 1),
(2, 2);

--
-- Truncate table before insert `Usuarios`
--

TRUNCATE TABLE `Usuarios`;
--
-- Dumping data for table `Usuarios`
--

INSERT INTO `Usuarios` (`id`, `username`, `password`) VALUES
(1, 'user@example.org', '$2y$10$0eR.KhfTH5ybn/jlB86hwe/1nQeCKXk2RcLEjBscJbpUaF504kSOi'),
(2, 'admin@example.org', '$2y$10$0eR.KhfTH5ybn/jlB86hwe/1nQeCKXk2RcLEjBscJbpUaF504kSOi');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET foreign_key_checks = 1 */;
