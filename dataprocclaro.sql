-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 23-11-2022 a las 04:47:32
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
-- Estructura de tabla para la tabla `acumciudades`
--

CREATE TABLE `acumciudades` (
  `idacumciudades` int(11) NOT NULL,
  `ciudadLlave` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ciudad` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departamento` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `indicativos` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ascard`
--

CREATE TABLE `ascard` (
  `id_ascard` int(11) NOT NULL,
  `numerocredito` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referenciapago` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marca` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `producto` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `fechadeasignacion` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono1` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono2` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono3` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono4` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `documento` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ciudad` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombredelcliente` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccioncompleta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `potencialmark` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prepotencialmark` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `writeoffmark` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refinanciedmark` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customertypeid` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `activeslines` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preciosubscripcion` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accstsname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exclusiondcto`
--

CREATE TABLE `exclusiondcto` (
  `id_exclusiondcto` int(11) NOT NULL,
  `cuenta` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `segmento` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nota` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `infofechaxx`
--

CREATE TABLE `infofechaxx` (
  `id_infofechaxx` int(10) NOT NULL,
  `numerodecliente` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accountcode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crmorigen` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numeroreferenciadepago` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edaddedeuda` int(10) DEFAULT NULL,
  `aslesoft` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Campo de informe',
  `saldo_aslesoft` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Campo de informe',
  `super` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Campo de informe',
  `concepto` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'campo de informe',
  `segmento` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'campo de informe',
  `prioridad` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'campo de informe',
  `exclusion` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Campo de informe',
  `modinitcta` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `debtageinicial` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cartera` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Campo de informe',
  `ascard` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Campo de informe',
  `verificacion_pyme` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Campo de informe',
  `asignacion` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Campo de informe',
  `region` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Campo de informe',
  `indicativo` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Campo de informe',
  `rango` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Campo de informe',
  `nombrecampaña` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fechadeasignacion` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono1` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono2` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono3` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono4` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
-- Indices de la tabla `acumciudades`
--
ALTER TABLE `acumciudades`
  ADD PRIMARY KEY (`idacumciudades`);

--
-- Indices de la tabla `ascard`
--
ALTER TABLE `ascard`
  ADD PRIMARY KEY (`id_ascard`);

--
-- Indices de la tabla `consoldescar`
--
ALTER TABLE `consoldescar`
  ADD PRIMARY KEY (`id_consoldescar`);

--
-- Indices de la tabla `exclusiondcto`
--
ALTER TABLE `exclusiondcto`
  ADD PRIMARY KEY (`id_exclusiondcto`);

--
-- Indices de la tabla `infofechaxx`
--
ALTER TABLE `infofechaxx`
  ADD PRIMARY KEY (`id_infofechaxx`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acumciudades`
--
ALTER TABLE `acumciudades`
  MODIFY `idacumciudades` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ascard`
--
ALTER TABLE `ascard`
  MODIFY `id_ascard` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `consoldescar`
--
ALTER TABLE `consoldescar`
  MODIFY `id_consoldescar` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `exclusiondcto`
--
ALTER TABLE `exclusiondcto`
  MODIFY `id_exclusiondcto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `infofechaxx`
--
ALTER TABLE `infofechaxx`
  MODIFY `id_infofechaxx` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
