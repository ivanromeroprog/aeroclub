-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2022 a las 20:11:58
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `aeroclub`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aeronave`
--

CREATE TABLE `aeronave` (
  `id` int(5) NOT NULL,
  `marca` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `modelo` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `fechaFabricación` date NOT NULL,
  `matricula` varchar(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `id` int(5) NOT NULL,
  `nombre` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `dni` int(10) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `fechaInicioCurso` date NOT NULL,
  `cantidadHorasVoladasAlumno` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `piloto`
--

CREATE TABLE `piloto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dni` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `fecha_vencimiento_licencia` date NOT NULL,
  `categoria` enum('PPL','PPA','PCA') COLLATE utf8mb4_unicode_ci NOT NULL,
  `es_instructor` tinyint(1) NOT NULL,
  `cantidad_horas_voladas_piloto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `piloto`
--

INSERT INTO `piloto` (`id`, `nombre`, `apellido`, `dni`, `fecha_nacimiento`, `fecha_vencimiento_licencia`, `categoria`, `es_instructor`, `cantidad_horas_voladas_piloto`) VALUES
(1, 'Juan', 'Perez', '1234567', '1993-11-01', '2022-11-30', 'PCA', 1, 100);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aeronave`
--
ALTER TABLE `aeronave`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `piloto`
--
ALTER TABLE `piloto`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aeronave`
--
ALTER TABLE `aeronave`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `piloto`
--
ALTER TABLE `piloto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
