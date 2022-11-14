-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.8.3-MariaDB-log - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando estructura para tabla aeroclub.aeronave
CREATE TABLE IF NOT EXISTS `aeronave` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `marca` varchar(10) COLLATE utf8mb3_spanish_ci NOT NULL,
  `modelo` varchar(10) COLLATE utf8mb3_spanish_ci NOT NULL,
  `fechaFabricacion` date NOT NULL,
  `matricula` varchar(10) COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla aeroclub.aeronave: ~1 rows (aproximadamente)
DELETE FROM `aeronave`;
INSERT INTO `aeronave` (`id`, `marca`, `modelo`, `fechaFabricacion`, `matricula`) VALUES
	(1, 'asdasdasd', 'asdasdasd', '2022-11-16', 'sadasdasd');

-- Volcando estructura para tabla aeroclub.alumno
CREATE TABLE IF NOT EXISTS `alumno` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(10) COLLATE utf8mb3_spanish_ci NOT NULL,
  `apellido` varchar(10) COLLATE utf8mb3_spanish_ci NOT NULL,
  `dni` int(10) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `fechaInicioCurso` date NOT NULL,
  `cantidadHorasVoladasAlumno` int(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla aeroclub.alumno: ~1 rows (aproximadamente)
DELETE FROM `alumno`;
INSERT INTO `alumno` (`id`, `nombre`, `apellido`, `dni`, `fechaNacimiento`, `fechaInicioCurso`, `cantidadHorasVoladasAlumno`) VALUES
	(1, 'Alumno', 'Alumno', 213123, '2022-11-14', '2022-11-14', 10);

-- Volcando estructura para tabla aeroclub.piloto
CREATE TABLE IF NOT EXISTS `piloto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dni` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `fecha_vencimiento_licencia` date NOT NULL,
  `categoria` enum('PPL','PPA','PCA') COLLATE utf8mb4_unicode_ci NOT NULL,
  `es_instructor` tinyint(1) NOT NULL,
  `cantidad_horas_voladas_piloto` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla aeroclub.piloto: ~1 rows (aproximadamente)
DELETE FROM `piloto`;
INSERT INTO `piloto` (`id`, `nombre`, `apellido`, `dni`, `fecha_nacimiento`, `fecha_vencimiento_licencia`, `categoria`, `es_instructor`, `cantidad_horas_voladas_piloto`) VALUES
	(1, 'Juan', 'Perez', '1234567', '1993-11-01', '2022-11-30', 'PCA', 1, 100);

-- Volcando estructura para tabla aeroclub.turno
CREATE TABLE IF NOT EXISTS `turno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_piloto` int(11) NOT NULL DEFAULT 0,
  `id_alumno` int(11) DEFAULT 0,
  `id_aeronave` int(11) NOT NULL,
  `categoria` enum('piloto','alumno') NOT NULL DEFAULT 'piloto',
  `hora_inicio` time NOT NULL DEFAULT '00:00:00',
  `hora_fin` time NOT NULL DEFAULT '00:00:00',
  `duracion` int(11) NOT NULL DEFAULT 0,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_turno_piloto` (`id_piloto`),
  KEY `FK_turno_aeronave` (`id_aeronave`),
  KEY `FK_turno_alumno` (`id_alumno`),
  CONSTRAINT `FK_turno_aeronave` FOREIGN KEY (`id_aeronave`) REFERENCES `aeronave` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_turno_alumno` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_turno_piloto` FOREIGN KEY (`id_piloto`) REFERENCES `piloto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla aeroclub.turno: ~1 rows (aproximadamente)
DELETE FROM `turno`;
INSERT INTO `turno` (`id`, `id_piloto`, `id_alumno`, `id_aeronave`, `categoria`, `hora_inicio`, `hora_fin`, `duracion`, `fecha`) VALUES
	(1, 1, NULL, 1, 'piloto', '00:08:00', '00:10:00', 2, '2022-11-14');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
