-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 12-10-2022 a las 04:27:26
-- Versión del servidor: 5.7.33
-- Versión de PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dataprocclaro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consoldescar`
--

CREATE TABLE `consoldescar` (
  `id_consoldescar` int(10) NOT NULL,
  `numerodecliente` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accountcode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crmorigen` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numeroreferenciadepago` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edaddedeuda` int(10) DEFAULT NULL,
  `modinitcta` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `debtageinicial` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombrecampaña` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fechadeasignacion` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono1` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono2` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono3` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono4` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `documento` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ciudad` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombredelcliente` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccioncompleta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `potencialmark` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prepotencialmark` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `writeoffmark` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refinanciedmark` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customertypeid` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `activeslines` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preciosubscripcion` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accstsname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `consoldescar`
--
ALTER TABLE `consoldescar`
  ADD PRIMARY KEY (`id_consoldescar`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `consoldescar`
--
ALTER TABLE `consoldescar`
  MODIFY `id_consoldescar` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;