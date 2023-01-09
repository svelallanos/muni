-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
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


-- Volcando estructura de base de datos para aesanluc_biblioteca
DROP DATABASE IF EXISTS `aesanluc_biblioteca`;
CREATE DATABASE IF NOT EXISTS `aesanluc_biblioteca` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `aesanluc_biblioteca`;

-- Volcando estructura para tabla aesanluc_biblioteca.autores
DROP TABLE IF EXISTS `autores`;
CREATE TABLE IF NOT EXISTS `autores` (
  `autores_id` int NOT NULL AUTO_INCREMENT,
  `autores_nombre` varchar(200) NOT NULL,
  `autores_descripcion` varchar(500) DEFAULT NULL,
  `autores_imagen` varchar(100) NOT NULL,
  `autores_estado` tinyint NOT NULL DEFAULT '1',
  `autores_fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `autores_fechaupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`autores_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aesanluc_biblioteca.autores: ~2 rows (aproximadamente)
INSERT INTO `autores` (`autores_id`, `autores_nombre`, `autores_descripcion`, `autores_imagen`, `autores_estado`, `autores_fechacreacion`, `autores_fechaupdate`) VALUES
	(6, 'Homero', 'Poeta griego al que se atribuye la autoría de la Ilíada y la Odisea, los dos grandes poemas épicos de la antigua Grecia.', 'autor_profile_20221110_110313.jpg', 1, '2022-11-10 16:03:13', '2022-11-10 16:03:13'),
	(7, 'Frances Hodgson Burnett', '-', 'autor_profile_20221114_095022.jpg', 1, '2022-11-14 14:48:43', '2022-11-14 14:50:22');

-- Volcando estructura para tabla aesanluc_biblioteca.bloqueo
DROP TABLE IF EXISTS `bloqueo`;
CREATE TABLE IF NOT EXISTS `bloqueo` (
  `bloqueo_id` int NOT NULL AUTO_INCREMENT,
  `usuarios_id` int NOT NULL,
  `tipo_bloqueo_id` int NOT NULL,
  `bloqueo_fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bloqueo_fechaupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`bloqueo_id`),
  UNIQUE KEY `UQ_usuario_tipo_bloqueo` (`usuarios_id`,`tipo_bloqueo_id`),
  KEY `FK_bloqueo_tipo_bloqueo` (`tipo_bloqueo_id`),
  KEY `FK_bloqueo_usuario` (`usuarios_id`),
  CONSTRAINT `FK_bloqueo_tipo_bloqueo` FOREIGN KEY (`tipo_bloqueo_id`) REFERENCES `tipo_bloqueo` (`tipo_bloqueo_id`),
  CONSTRAINT `FK_bloqueo_usuarios` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`usuarios_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aesanluc_biblioteca.bloqueo: ~0 rows (aproximadamente)

-- Volcando estructura para tabla aesanluc_biblioteca.calificaciones_libro
DROP TABLE IF EXISTS `calificaciones_libro`;
CREATE TABLE IF NOT EXISTS `calificaciones_libro` (
  `calificaciones_libro_id` int NOT NULL AUTO_INCREMENT,
  `calificaciones_libro_valoracion` int NOT NULL,
  `calificaciones_libro_comentario` varchar(300) DEFAULT NULL,
  `libro_id` int NOT NULL,
  `calificaciones_libro_fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `calificaciones_libro_fechaupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`calificaciones_libro_id`),
  KEY `FK_calificaciones_libro_libro` (`libro_id`),
  CONSTRAINT `FK_calificaciones_libro_libro` FOREIGN KEY (`libro_id`) REFERENCES `libro` (`libro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aesanluc_biblioteca.calificaciones_libro: ~0 rows (aproximadamente)

-- Volcando estructura para tabla aesanluc_biblioteca.categorias
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `categorias_id` int NOT NULL AUTO_INCREMENT,
  `categorias_nombre` varchar(150) NOT NULL,
  `categorias_descripcion` varchar(200) DEFAULT NULL,
  `categorias_estado` tinyint NOT NULL DEFAULT '1',
  `categorias_fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `categorias_fechaupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`categorias_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aesanluc_biblioteca.categorias: ~2 rows (aproximadamente)
INSERT INTO `categorias` (`categorias_id`, `categorias_nombre`, `categorias_descripcion`, `categorias_estado`, `categorias_fechacreacion`, `categorias_fechaupdate`) VALUES
	(1, 'Enfermería técnica', 'Aca se desarrolla todas clases de anatomía funcional y además se involuvra sus practicas pre profesionales.', 1, '2022-10-22 01:04:54', '2022-10-23 15:46:02'),
	(5, 'Transversales', 'Todo tipo de libro', 1, '2022-11-01 15:47:05', '2022-11-01 15:47:05');

-- Volcando estructura para tabla aesanluc_biblioteca.conocimiento
DROP TABLE IF EXISTS `conocimiento`;
CREATE TABLE IF NOT EXISTS `conocimiento` (
  `conocimiento_id` int NOT NULL AUTO_INCREMENT,
  `conocimiento_descripcion` text NOT NULL,
  `conocimiento_fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `conocimiento_fechaupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`conocimiento_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aesanluc_biblioteca.conocimiento: ~15 rows (aproximadamente)
INSERT INTO `conocimiento` (`conocimiento_id`, `conocimiento_descripcion`, `conocimiento_fechacreacion`, `conocimiento_fechaupdate`) VALUES
	(24, 'En El jardín secreto está todo lo que tienes que saber si algún día quieres escribir una buena novela.', '2022-11-14 16:23:02', '2022-11-14 16:23:02'),
	(25, 'Al principio hay una idea. Las ideas son las semillas de las que crecen las rosas, las campanillas blancas o una vieja llave oxidada que abre la puerta de un jardín secreto.', '2022-11-14 16:54:39', '2022-11-14 16:54:39'),
	(26, 'Es imposible definir qué es una semilla adecuada en un relato de ficción. Puede ser un nombre, un objeto, un personaje, un recuerdo de la infancia, un olor…', '2022-11-14 17:13:49', '2022-11-14 17:13:49'),
	(27, 'Voz, estilo. Las palabras no crean voces por sí mismas; lo que realmente da fluidez a un texto es el modo en que las palabras se juntan y componen oraciones.', '2022-11-14 20:17:14', '2022-11-14 20:17:14'),
	(28, 'La voz narrativa es en realidad algo muy corriente: solo es la persona que somos, proyectada en un arte.', '2022-11-14 20:25:08', '2022-11-14 20:25:08'),
	(29, 'Por otro lado, cuando comienzas un relato de ficción, esperas que parezca real, aunque sea una vida que no conoces ni conocerás nunca.', '2022-11-14 21:03:43', '2022-11-14 21:03:43'),
	(30, 'Quieres entrar en ella, vivir allí durante una temporada, sentir frío o calor, hambre, miedo, llorar o reír con los personajes.', '2022-11-14 21:04:35', '2022-11-14 21:04:35'),
	(31, 'El escenario es decir, el espacio y el tiempo de la historia te ayudarán en el sentido más físico posible.', '2022-11-14 21:05:28', '2022-11-14 21:05:28'),
	(32, 'luego está el personaje. Los personajes plenamente vivos nunca se revelan del todo; es como el interior de una casa visto solo a través de las ventanas.', '2022-11-14 21:06:17', '2022-11-14 21:06:17'),
	(33, 'Una parte importante permanece oculta, abierta al misterio, a la intriga, a las conjeturas.', '2022-11-14 21:08:09', '2022-11-14 21:08:09'),
	(34, 'Los personajes pueden tener deseos enormes y apasionantes como el de viajar a la luna o menores y más sencillos como encontrar la llave oxidada de un jardín abandonado para entrar a cuidarlo.', '2022-11-14 21:09:23', '2022-11-14 21:09:23'),
	(35, 'Pero el deseo siempre genera conflicto y para que la historia funcione, hay que sembrar de obstáculos el camino de nuestro personaje principal.', '2022-11-14 21:10:34', '2022-11-14 21:10:34'),
	(36, 'Que el personaje desee algo con fuerza nos permite identificarnos y empatizar con él. A partir de esa necesidad, crece la línea argumental.', '2022-11-14 21:11:36', '2022-11-14 21:11:36'),
	(37, 'En el corazón de toda ficción late una emoción cuando sentimos que el relato persigue algo específico, cuando sigue una trama.', '2022-11-14 21:12:41', '2022-11-14 21:12:41'),
	(38, 'La trama aporta coherencia a la ficción uniendo todos los personajes, los ambientes, los diálogos, el suspense, la voz, el ritmo, el punto de vista, etc.', '2022-11-14 21:13:43', '2022-11-14 21:13:43');

-- Volcando estructura para tabla aesanluc_biblioteca.copias
DROP TABLE IF EXISTS `copias`;
CREATE TABLE IF NOT EXISTS `copias` (
  `copias_id` int NOT NULL AUTO_INCREMENT,
  `libro_id` int NOT NULL,
  `copia_codigo` varchar(15) NOT NULL,
  `copia_estado` tinyint NOT NULL DEFAULT '1',
  `copia_fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `copia_fechaupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`copias_id`),
  UNIQUE KEY `UQ_copias_codigo_libro` (`libro_id`,`copia_codigo`),
  KEY `FK_copias_libro` (`libro_id`),
  CONSTRAINT `FK_copias_libro` FOREIGN KEY (`libro_id`) REFERENCES `libro` (`libro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aesanluc_biblioteca.copias: ~0 rows (aproximadamente)

-- Volcando estructura para tabla aesanluc_biblioteca.detalle_autor
DROP TABLE IF EXISTS `detalle_autor`;
CREATE TABLE IF NOT EXISTS `detalle_autor` (
  `detalle_autor_id` int NOT NULL AUTO_INCREMENT,
  `autores_id` int NOT NULL,
  `libro_id` int NOT NULL,
  `detalle_autor_fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `detalle_autor_fechaupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`detalle_autor_id`),
  UNIQUE KEY `UQ_autores_libro` (`libro_id`,`autores_id`),
  KEY `FK_detalle_autor_autores` (`autores_id`),
  KEY `FK_detalle_autor_libro` (`libro_id`),
  CONSTRAINT `FK_detalle_autor_autores` FOREIGN KEY (`autores_id`) REFERENCES `autores` (`autores_id`),
  CONSTRAINT `FK_detalle_autor_libro` FOREIGN KEY (`libro_id`) REFERENCES `libro` (`libro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aesanluc_biblioteca.detalle_autor: ~2 rows (aproximadamente)
INSERT INTO `detalle_autor` (`detalle_autor_id`, `autores_id`, `libro_id`, `detalle_autor_fechacreacion`, `detalle_autor_fechaupdate`) VALUES
	(13, 6, 22, '2022-11-10 16:25:04', '2022-11-10 16:25:04'),
	(14, 7, 23, '2022-11-14 14:55:14', '2022-11-14 14:55:14');

-- Volcando estructura para tabla aesanluc_biblioteca.detalle_conocimiento
DROP TABLE IF EXISTS `detalle_conocimiento`;
CREATE TABLE IF NOT EXISTS `detalle_conocimiento` (
  `detalle_conocimiento_id` int NOT NULL AUTO_INCREMENT,
  `detalle_niveles_id` int NOT NULL,
  `detalle_conocimiento_orden` int NOT NULL,
  `parrafos_id` int NOT NULL,
  `conocimiento_id` int NOT NULL,
  `detalle_conocimiento_fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `detalle_conocimiento_fechaupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`detalle_conocimiento_id`),
  KEY `FK_detalle_conocimiento_parrafos` (`parrafos_id`),
  KEY `FK_detalle_conocimiento_detalle_niveles` (`detalle_niveles_id`),
  KEY `FK_detalle_conocimiento_conocimiento` (`conocimiento_id`),
  CONSTRAINT `FK_detalle_conocimiento_conocimiento` FOREIGN KEY (`conocimiento_id`) REFERENCES `conocimiento` (`conocimiento_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_detalle_conocimiento_detalle_niveles` FOREIGN KEY (`detalle_niveles_id`) REFERENCES `detalle_niveles` (`detalle_niveles_id`),
  CONSTRAINT `FK_detalle_conocimiento_parrafos` FOREIGN KEY (`parrafos_id`) REFERENCES `parrafos` (`parrafos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aesanluc_biblioteca.detalle_conocimiento: ~15 rows (aproximadamente)
INSERT INTO `detalle_conocimiento` (`detalle_conocimiento_id`, `detalle_niveles_id`, `detalle_conocimiento_orden`, `parrafos_id`, `conocimiento_id`, `detalle_conocimiento_fechacreacion`, `detalle_conocimiento_fechaupdate`) VALUES
	(25, 53, 1, 1, 24, '2022-11-14 16:23:02', '2022-11-14 16:23:02'),
	(26, 53, 1, 2, 25, '2022-11-14 16:54:39', '2022-11-14 16:54:39'),
	(27, 53, 2, 2, 26, '2022-11-14 17:13:49', '2022-11-14 17:13:49'),
	(28, 53, 1, 3, 27, '2022-11-14 20:17:14', '2022-11-14 20:17:14'),
	(29, 53, 2, 3, 28, '2022-11-14 20:25:08', '2022-11-14 20:25:08'),
	(30, 53, 3, 3, 29, '2022-11-14 21:03:43', '2022-11-14 21:03:43'),
	(31, 53, 4, 3, 30, '2022-11-14 21:04:35', '2022-11-14 21:04:35'),
	(32, 53, 5, 3, 31, '2022-11-14 21:05:28', '2022-11-14 21:05:28'),
	(33, 53, 6, 3, 32, '2022-11-14 21:06:17', '2022-11-14 21:06:17'),
	(34, 53, 1, 4, 33, '2022-11-14 21:08:09', '2022-11-14 21:08:09'),
	(35, 53, 2, 4, 34, '2022-11-14 21:09:23', '2022-11-14 21:09:23'),
	(36, 53, 3, 4, 35, '2022-11-14 21:10:35', '2022-11-14 21:10:35'),
	(37, 53, 4, 4, 36, '2022-11-14 21:11:36', '2022-11-14 21:11:36'),
	(38, 53, 5, 4, 37, '2022-11-14 21:12:41', '2022-11-14 21:12:41'),
	(39, 53, 1, 5, 38, '2022-11-14 21:13:43', '2022-11-14 21:13:43');

-- Volcando estructura para tabla aesanluc_biblioteca.detalle_keywords
DROP TABLE IF EXISTS `detalle_keywords`;
CREATE TABLE IF NOT EXISTS `detalle_keywords` (
  `detalle_keywords_id` int NOT NULL AUTO_INCREMENT,
  `keywords_id` int NOT NULL,
  `libro_id` int NOT NULL,
  `detalle_keywords_fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `detalle_keywords_fechaupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`detalle_keywords_id`),
  UNIQUE KEY `UQ_keywords_libro` (`keywords_id`,`libro_id`),
  KEY `FK_detalle_keywords_libro` (`libro_id`),
  KEY `FK_detalle_keywords_keywords` (`keywords_id`),
  CONSTRAINT `FK_detalle_keywords_keywords` FOREIGN KEY (`keywords_id`) REFERENCES `keywords` (`keywords_id`),
  CONSTRAINT `FK_detalle_keywords_libro` FOREIGN KEY (`libro_id`) REFERENCES `libro` (`libro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aesanluc_biblioteca.detalle_keywords: ~0 rows (aproximadamente)

-- Volcando estructura para tabla aesanluc_biblioteca.detalle_materias
DROP TABLE IF EXISTS `detalle_materias`;
CREATE TABLE IF NOT EXISTS `detalle_materias` (
  `detalle_materias_id` int NOT NULL AUTO_INCREMENT,
  `libro_id` int NOT NULL,
  `materias_id` int NOT NULL,
  `detalle_materias_fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `detalle_materias_fechaupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`detalle_materias_id`),
  UNIQUE KEY `UQ_libro_materias` (`materias_id`,`libro_id`),
  KEY `FK_detalle_materias_libro` (`libro_id`),
  KEY `FK_detalle_materias_materias` (`materias_id`),
  CONSTRAINT `FK_detalle_materias_libro` FOREIGN KEY (`libro_id`) REFERENCES `libro` (`libro_id`),
  CONSTRAINT `FK_detalle_materias_materias` FOREIGN KEY (`materias_id`) REFERENCES `materias` (`materias_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aesanluc_biblioteca.detalle_materias: ~2 rows (aproximadamente)
INSERT INTO `detalle_materias` (`detalle_materias_id`, `libro_id`, `materias_id`, `detalle_materias_fechacreacion`, `detalle_materias_fechaupdate`) VALUES
	(10, 22, 8, '2022-11-10 16:25:12', '2022-11-10 16:25:12'),
	(11, 23, 8, '2022-11-14 14:55:25', '2022-11-14 14:55:25');

-- Volcando estructura para tabla aesanluc_biblioteca.detalle_niveles
DROP TABLE IF EXISTS `detalle_niveles`;
CREATE TABLE IF NOT EXISTS `detalle_niveles` (
  `detalle_niveles_id` int NOT NULL AUTO_INCREMENT,
  `niveles_id` int NOT NULL,
  `libro_id` int NOT NULL,
  `detalle_niveles_orden` int NOT NULL,
  `detalle_niveles_dependencia` int DEFAULT NULL,
  `detalle_niveles_titulo` text NOT NULL,
  `detalle_niveles_fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `detalle_niveles_fechaupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`detalle_niveles_id`),
  KEY `FK_detalle_niveles_niveles` (`niveles_id`),
  KEY `FK_detalle_niveles_libro` (`libro_id`),
  CONSTRAINT `FK_detalle_niveles_libro` FOREIGN KEY (`libro_id`) REFERENCES `libro` (`libro_id`),
  CONSTRAINT `FK_detalle_niveles_niveles` FOREIGN KEY (`niveles_id`) REFERENCES `niveles` (`niveles_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aesanluc_biblioteca.detalle_niveles: ~0 rows (aproximadamente)
INSERT INTO `detalle_niveles` (`detalle_niveles_id`, `niveles_id`, `libro_id`, `detalle_niveles_orden`, `detalle_niveles_dependencia`, `detalle_niveles_titulo`, `detalle_niveles_fechacreacion`, `detalle_niveles_fechaupdate`) VALUES
	(53, 1, 23, 1, NULL, 'Invitación a la lectura', '2022-11-14 14:57:10', '2022-11-14 14:57:10');

-- Volcando estructura para tabla aesanluc_biblioteca.detalle_rol_permiso
DROP TABLE IF EXISTS `detalle_rol_permiso`;
CREATE TABLE IF NOT EXISTS `detalle_rol_permiso` (
  `drp_id` int NOT NULL AUTO_INCREMENT,
  `permiso_id` int NOT NULL,
  `roles_id` int NOT NULL,
  `drp_fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `drp_fechaupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`drp_id`) USING BTREE,
  UNIQUE KEY `UQ_permiso_rol` (`permiso_id`,`roles_id`),
  KEY `FK_detalle_rol_permiso_roles` (`roles_id`),
  KEY `FK_detalle_rol_permiso_permiso` (`permiso_id`),
  CONSTRAINT `FK_detalle_rol_permiso_permiso` FOREIGN KEY (`permiso_id`) REFERENCES `permiso` (`permiso_id`),
  CONSTRAINT `FK_detalle_rol_permiso_roles` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`roles_id`)
) ENGINE=InnoDB AUTO_INCREMENT=569 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aesanluc_biblioteca.detalle_rol_permiso: ~25 rows (aproximadamente)
INSERT INTO `detalle_rol_permiso` (`drp_id`, `permiso_id`, `roles_id`, `drp_fechacreacion`, `drp_fechaupdate`) VALUES
	(498, 21, 10, '2022-11-02 21:27:20', '2022-11-02 21:27:20'),
	(499, 21, 4, '2022-11-02 21:33:33', '2022-11-02 21:33:33'),
	(545, 1, 1, '2022-11-28 11:30:49', '2022-11-28 11:30:49'),
	(546, 2, 1, '2022-11-28 11:30:49', '2022-11-28 11:30:49'),
	(547, 3, 1, '2022-11-28 11:30:49', '2022-11-28 11:30:49'),
	(548, 8, 1, '2022-11-28 11:30:49', '2022-11-28 11:30:49'),
	(549, 9, 1, '2022-11-28 11:30:49', '2022-11-28 11:30:49'),
	(550, 11, 1, '2022-11-28 11:30:49', '2022-11-28 11:30:49'),
	(551, 12, 1, '2022-11-28 11:30:49', '2022-11-28 11:30:49'),
	(552, 13, 1, '2022-11-28 11:30:49', '2022-11-28 11:30:49'),
	(553, 14, 1, '2022-11-28 11:30:49', '2022-11-28 11:30:49'),
	(554, 15, 1, '2022-11-28 11:30:49', '2022-11-28 11:30:49'),
	(555, 16, 1, '2022-11-28 11:30:49', '2022-11-28 11:30:49'),
	(556, 17, 1, '2022-11-28 11:30:49', '2022-11-28 11:30:49'),
	(557, 18, 1, '2022-11-28 11:30:49', '2022-11-28 11:30:49'),
	(558, 4, 1, '2022-11-28 11:30:49', '2022-11-28 11:30:49'),
	(559, 5, 1, '2022-11-28 11:30:49', '2022-11-28 11:30:49'),
	(560, 6, 1, '2022-11-28 11:30:49', '2022-11-28 11:30:49'),
	(561, 7, 1, '2022-11-28 11:30:49', '2022-11-28 11:30:49'),
	(562, 10, 1, '2022-11-28 11:30:49', '2022-11-28 11:30:49'),
	(563, 19, 1, '2022-11-28 11:30:49', '2022-11-28 11:30:49'),
	(564, 20, 1, '2022-11-28 11:30:49', '2022-11-28 11:30:49'),
	(565, 21, 1, '2022-11-28 11:30:49', '2022-11-28 11:30:49'),
	(566, 22, 1, '2022-11-28 11:30:49', '2022-11-28 11:30:49'),
	(567, 23, 1, '2022-11-28 11:30:49', '2022-11-28 11:30:49'),
	(568, 24, 1, '2022-11-28 11:30:49', '2022-11-28 11:30:49');

-- Volcando estructura para tabla aesanluc_biblioteca.detalle_rol_usuario
DROP TABLE IF EXISTS `detalle_rol_usuario`;
CREATE TABLE IF NOT EXISTS `detalle_rol_usuario` (
  `dru_id` int NOT NULL AUTO_INCREMENT,
  `roles_id` int NOT NULL,
  `usuarios_id` int NOT NULL,
  `dru_fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dru_fechaupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`dru_id`),
  UNIQUE KEY `roles_usuarios` (`roles_id`,`usuarios_id`) USING BTREE,
  KEY `FK_detalle_rol_usuario_roles` (`roles_id`),
  KEY `FK_detalle_rol_usuario_usuario` (`usuarios_id`),
  CONSTRAINT `FK_detalle_rol_usuario_roles` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`roles_id`),
  CONSTRAINT `FK_detalle_rol_usuario_usuarios` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`usuarios_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aesanluc_biblioteca.detalle_rol_usuario: ~7 rows (aproximadamente)
INSERT INTO `detalle_rol_usuario` (`dru_id`, `roles_id`, `usuarios_id`, `dru_fechacreacion`, `dru_fechaupdate`) VALUES
	(33, 1, 14, '2022-10-03 23:14:41', '2022-10-03 23:14:41'),
	(34, 3, 12, '2022-10-03 23:14:50', '2022-10-03 23:14:50'),
	(36, 10, 15, '2022-10-03 23:15:27', '2022-10-03 23:15:27'),
	(37, 9, 2, '2022-10-04 12:34:59', '2022-10-04 12:34:59'),
	(47, 9, 22, '2022-10-07 16:44:15', '2022-10-07 16:44:15'),
	(49, 1, 1, '2022-10-12 13:25:00', '2022-10-12 13:25:00'),
	(50, 2, 24, '2022-10-31 02:15:16', '2022-10-31 02:15:16');

-- Volcando estructura para tabla aesanluc_biblioteca.detalle_terminologia_conocimiento
DROP TABLE IF EXISTS `detalle_terminologia_conocimiento`;
CREATE TABLE IF NOT EXISTS `detalle_terminologia_conocimiento` (
  `detalle_terminologia_conocimiento_id` int NOT NULL AUTO_INCREMENT,
  `terminologias_id` int DEFAULT NULL,
  `conocimiento_id` int NOT NULL,
  PRIMARY KEY (`detalle_terminologia_conocimiento_id`),
  UNIQUE KEY `UQ_terminologia_conocimiento` (`terminologias_id`,`conocimiento_id`),
  KEY `FK__conocimiento` (`conocimiento_id`),
  KEY `FK__terminologias` (`terminologias_id`),
  CONSTRAINT `FK__conocimiento` FOREIGN KEY (`conocimiento_id`) REFERENCES `conocimiento` (`conocimiento_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK__terminologias` FOREIGN KEY (`terminologias_id`) REFERENCES `terminologias` (`terminologias_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=173 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aesanluc_biblioteca.detalle_terminologia_conocimiento: ~147 rows (aproximadamente)
INSERT INTO `detalle_terminologia_conocimiento` (`detalle_terminologia_conocimiento_id`, `terminologias_id`, `conocimiento_id`) VALUES
	(31, 39, 24),
	(42, 40, 24),
	(36, 41, 24),
	(28, 42, 24),
	(26, 43, 24),
	(35, 44, 24),
	(27, 48, 24),
	(40, 49, 24),
	(33, 50, 24),
	(32, 51, 24),
	(69, 51, 26),
	(29, 52, 24),
	(39, 53, 24),
	(38, 54, 24),
	(102, 54, 29),
	(41, 55, 24),
	(30, 56, 24),
	(37, 58, 24),
	(34, 59, 24),
	(57, 60, 25),
	(56, 61, 25),
	(94, 61, 28),
	(55, 62, 25),
	(52, 63, 25),
	(54, 64, 25),
	(45, 65, 25),
	(44, 66, 25),
	(49, 67, 25),
	(51, 68, 25),
	(53, 69, 25),
	(78, 69, 26),
	(48, 70, 25),
	(74, 70, 26),
	(50, 71, 25),
	(75, 71, 26),
	(43, 72, 25),
	(62, 72, 26),
	(47, 73, 25),
	(72, 73, 26),
	(46, 74, 25),
	(71, 74, 26),
	(73, 75, 26),
	(59, 76, 26),
	(60, 77, 26),
	(64, 78, 26),
	(63, 79, 26),
	(65, 80, 26),
	(68, 81, 26),
	(76, 82, 26),
	(77, 83, 26),
	(67, 84, 26),
	(66, 85, 26),
	(61, 86, 26),
	(70, 87, 26),
	(58, 88, 26),
	(79, 89, 27),
	(84, 90, 27),
	(81, 91, 27),
	(85, 92, 27),
	(80, 93, 27),
	(83, 94, 27),
	(82, 95, 27),
	(86, 96, 27),
	(93, 97, 28),
	(87, 98, 28),
	(91, 99, 28),
	(89, 100, 28),
	(90, 101, 28),
	(88, 102, 28),
	(92, 103, 28),
	(104, 104, 29),
	(103, 105, 29),
	(97, 106, 29),
	(95, 107, 29),
	(96, 108, 29),
	(101, 109, 29),
	(105, 110, 29),
	(98, 111, 29),
	(106, 112, 29),
	(99, 113, 29),
	(100, 114, 29),
	(111, 115, 30),
	(122, 115, 32),
	(108, 116, 30),
	(119, 116, 32),
	(107, 117, 30),
	(118, 117, 32),
	(137, 117, 34),
	(152, 117, 36),
	(167, 117, 38),
	(110, 118, 30),
	(121, 118, 32),
	(141, 118, 34),
	(155, 118, 36),
	(172, 118, 38),
	(109, 119, 30),
	(120, 119, 32),
	(139, 119, 34),
	(153, 119, 36),
	(169, 119, 38),
	(112, 120, 31),
	(113, 121, 31),
	(114, 122, 31),
	(116, 123, 31),
	(117, 124, 31),
	(115, 125, 31),
	(126, 126, 33),
	(123, 127, 33),
	(130, 128, 33),
	(129, 129, 33),
	(131, 130, 33),
	(125, 131, 33),
	(128, 132, 33),
	(127, 133, 33),
	(124, 134, 33),
	(138, 135, 34),
	(135, 136, 34),
	(145, 136, 35),
	(140, 137, 34),
	(148, 137, 35),
	(133, 138, 34),
	(143, 138, 35),
	(134, 139, 34),
	(144, 139, 35),
	(136, 140, 34),
	(146, 140, 35),
	(132, 141, 34),
	(142, 141, 35),
	(150, 142, 35),
	(149, 143, 35),
	(147, 144, 35),
	(154, 145, 36),
	(157, 146, 36),
	(151, 147, 36),
	(156, 148, 36),
	(158, 149, 36),
	(163, 150, 37),
	(160, 155, 37),
	(159, 156, 37),
	(164, 157, 37),
	(165, 158, 37),
	(162, 159, 37),
	(161, 160, 37),
	(166, 161, 38),
	(168, 162, 38),
	(171, 163, 38),
	(170, 164, 38);

-- Volcando estructura para tabla aesanluc_biblioteca.detalle_tipolibro
DROP TABLE IF EXISTS `detalle_tipolibro`;
CREATE TABLE IF NOT EXISTS `detalle_tipolibro` (
  `detalle_tipolibro_id` int NOT NULL AUTO_INCREMENT,
  `libro_id` int NOT NULL,
  `tipo_libro_id` int NOT NULL,
  `detalle_tipolibro_fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `detalle_tipolibro_fechaupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`detalle_tipolibro_id`),
  UNIQUE KEY `UQ_detalle_libro_tipo` (`libro_id`,`tipo_libro_id`),
  KEY `FK_detalle_tipolibro_tipo_libro` (`tipo_libro_id`),
  KEY `FK_detalle_libro_libro` (`libro_id`),
  CONSTRAINT `FK_detalle_tipolibro_libro` FOREIGN KEY (`libro_id`) REFERENCES `libro` (`libro_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_detalle_tipolibro_tipo_libro` FOREIGN KEY (`tipo_libro_id`) REFERENCES `tipo_libro` (`tipo_libro_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aesanluc_biblioteca.detalle_tipolibro: ~2 rows (aproximadamente)
INSERT INTO `detalle_tipolibro` (`detalle_tipolibro_id`, `libro_id`, `tipo_libro_id`, `detalle_tipolibro_fechacreacion`, `detalle_tipolibro_fechaupdate`) VALUES
	(45, 22, 2, '2022-11-10 16:00:18', '2022-11-10 16:00:18'),
	(46, 23, 2, '2022-11-14 14:54:11', '2022-11-14 14:54:11');

-- Volcando estructura para tabla aesanluc_biblioteca.det_permiso_usuarios
DROP TABLE IF EXISTS `det_permiso_usuarios`;
CREATE TABLE IF NOT EXISTS `det_permiso_usuarios` (
  `dpu_id` int NOT NULL AUTO_INCREMENT,
  `usuarios_id` int NOT NULL,
  `permiso_id` int NOT NULL,
  `dpu_estado` tinyint NOT NULL DEFAULT '1',
  `dpu_fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dpu_fechaupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`dpu_id`),
  UNIQUE KEY `permiso_id` (`permiso_id`),
  UNIQUE KEY `usuarios_id` (`usuarios_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aesanluc_biblioteca.det_permiso_usuarios: ~0 rows (aproximadamente)

-- Volcando estructura para tabla aesanluc_biblioteca.editoriales
DROP TABLE IF EXISTS `editoriales`;
CREATE TABLE IF NOT EXISTS `editoriales` (
  `editoriales_id` int NOT NULL AUTO_INCREMENT,
  `editoriales_nombre` varchar(150) NOT NULL,
  `editoriales_descripcion` varchar(500) DEFAULT NULL,
  `editoriales_estado` tinyint NOT NULL DEFAULT '1',
  `editoriales_fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editoriales_fechaupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`editoriales_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aesanluc_biblioteca.editoriales: ~2 rows (aproximadamente)
INSERT INTO `editoriales` (`editoriales_id`, `editoriales_nombre`, `editoriales_descripcion`, `editoriales_estado`, `editoriales_fechacreacion`, `editoriales_fechaupdate`) VALUES
	(5, 'Grandes Obras de la Literatura Universal', 'Cincuenta escritores, críticos y personalidades del mundo de la cultura han elegido sus preferencias literarias para elaborar esta lista.', 1, '2022-11-10 16:05:00', '2022-11-10 16:05:00'),
	(6, 'Siruela', '-', 1, '2022-11-14 14:48:21', '2022-11-14 14:48:21');

-- Volcando estructura para tabla aesanluc_biblioteca.grupo_permiso
DROP TABLE IF EXISTS `grupo_permiso`;
CREATE TABLE IF NOT EXISTS `grupo_permiso` (
  `grupo_permiso_id` int NOT NULL AUTO_INCREMENT,
  `grupo_permiso_nombre` varchar(50) NOT NULL,
  `grupo_permiso_estado` tinyint NOT NULL DEFAULT '1',
  `grupo_permiso_fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `grupo_permiso_fechaupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`grupo_permiso_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aesanluc_biblioteca.grupo_permiso: ~3 rows (aproximadamente)
INSERT INTO `grupo_permiso` (`grupo_permiso_id`, `grupo_permiso_nombre`, `grupo_permiso_estado`, `grupo_permiso_fechacreacion`, `grupo_permiso_fechaupdate`) VALUES
	(1, 'Administrador del sistema', 1, '2022-08-25 09:13:38', '2022-09-02 15:52:58'),
	(2, 'Administrador', 1, '2022-08-25 09:13:48', '2022-09-02 15:52:51'),
	(3, 'Bibliotecario', 1, '2022-09-02 15:52:34', '2022-09-29 13:26:07');

-- Volcando estructura para tabla aesanluc_biblioteca.keywords
DROP TABLE IF EXISTS `keywords`;
CREATE TABLE IF NOT EXISTS `keywords` (
  `keywords_id` int NOT NULL AUTO_INCREMENT,
  `keywords_nombre` varchar(150) NOT NULL,
  `keywords_descripcion` varchar(300) NOT NULL,
  `keywords_fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `keywords_fechaupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`keywords_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aesanluc_biblioteca.keywords: ~0 rows (aproximadamente)

-- Volcando estructura para tabla aesanluc_biblioteca.libro
DROP TABLE IF EXISTS `libro`;
CREATE TABLE IF NOT EXISTS `libro` (
  `libro_id` int NOT NULL AUTO_INCREMENT,
  `libro_titulo` varchar(500) NOT NULL,
  `libro_resumen` varchar(800) DEFAULT NULL,
  `libro_paginas` int NOT NULL,
  `libro_isbn` varchar(50) DEFAULT NULL,
  `libro_edision` varchar(50) DEFAULT NULL,
  `libro_volumen` int NOT NULL DEFAULT '0',
  `libro_peso` int DEFAULT NULL,
  `libro_imagen` varchar(200) NOT NULL,
  `libro_valoracion` int NOT NULL DEFAULT '0',
  `categorias_id` int NOT NULL,
  `editoriales_id` int DEFAULT NULL,
  `libro_estado` tinyint NOT NULL DEFAULT '1',
  `libro_fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `libro_fechaupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`libro_id`),
  UNIQUE KEY `libro_titulo` (`libro_titulo`),
  KEY `FK_libro_categorias` (`categorias_id`),
  KEY `FK_libro_editoriales` (`editoriales_id`),
  CONSTRAINT `FK_libro_categorias` FOREIGN KEY (`categorias_id`) REFERENCES `categorias` (`categorias_id`),
  CONSTRAINT `FK_libro_editoriales` FOREIGN KEY (`editoriales_id`) REFERENCES `editoriales` (`editoriales_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aesanluc_biblioteca.libro: ~2 rows (aproximadamente)
INSERT INTO `libro` (`libro_id`, `libro_titulo`, `libro_resumen`, `libro_paginas`, `libro_isbn`, `libro_edision`, `libro_volumen`, `libro_peso`, `libro_imagen`, `libro_valoracion`, `categorias_id`, `editoriales_id`, `libro_estado`, `libro_fechacreacion`, `libro_fechaupdate`) VALUES
	(22, 'La Odisea', 'La odisea es un poema épico que narra las aventuras de Odiseo, también conocido como Ulises, en su viaje de regreso a su patria, Ítaca, desde el momento en que finaliza la guerra de Troya, narrada en la Ilíada, hasta el momento en que finalmente vuelve a su hogar, muchos años después.', 190, '978-950-13-2336-8', '1a ed. - Buenos Aires', 0, NULL, 'libro_profile_20221110_105957.jpg', 0, 5, 5, 1, '2022-11-10 15:58:20', '2022-11-10 16:24:56'),
	(23, 'El jardín secreto', 'Es un escrito que nos ayudará a sintetizar las ideas principales de un texto, en este caso de la novela El Jardín Secreto. De esta manera, con ayuda del resumen, podremos emitir opiniones e interpretaciones sobre este tema.', 354, NULL, NULL, 0, NULL, 'libro_profile_20221114_095501.jpg', 0, 5, 6, 1, '2022-11-14 14:54:11', '2022-11-14 14:55:18');

-- Volcando estructura para tabla aesanluc_biblioteca.materias
DROP TABLE IF EXISTS `materias`;
CREATE TABLE IF NOT EXISTS `materias` (
  `materias_id` int NOT NULL AUTO_INCREMENT,
  `materias_nombre` varchar(150) NOT NULL,
  `materias_fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `materias_fechaupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`materias_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aesanluc_biblioteca.materias: ~0 rows (aproximadamente)
INSERT INTO `materias` (`materias_id`, `materias_nombre`, `materias_fechacreacion`, `materias_fechaupdate`) VALUES
	(8, 'Literatura', '2022-11-10 16:23:41', '2022-11-10 16:23:41');

-- Volcando estructura para tabla aesanluc_biblioteca.niveles
DROP TABLE IF EXISTS `niveles`;
CREATE TABLE IF NOT EXISTS `niveles` (
  `niveles_id` int NOT NULL AUTO_INCREMENT,
  `niveles_descripcion` varchar(100) NOT NULL,
  `niveles_orden` int NOT NULL,
  `niveles_fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `niveles_fechaupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`niveles_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aesanluc_biblioteca.niveles: ~5 rows (aproximadamente)
INSERT INTO `niveles` (`niveles_id`, `niveles_descripcion`, `niveles_orden`, `niveles_fechacreacion`, `niveles_fechaupdate`) VALUES
	(1, 'Nivel 1', 1, '2022-10-23 16:09:35', '2022-10-23 16:09:35'),
	(2, 'Nivel 2', 2, '2022-10-23 16:32:58', '2022-10-23 16:52:54'),
	(5, 'Nivel 3', 3, '2022-11-01 21:46:39', '2022-11-01 21:46:39'),
	(6, 'Nivel 4', 4, '2022-11-01 21:46:47', '2022-11-01 21:46:47'),
	(7, 'Nivel 5', 5, '2022-11-01 21:46:55', '2022-11-01 21:46:55');

-- Volcando estructura para tabla aesanluc_biblioteca.parrafos
DROP TABLE IF EXISTS `parrafos`;
CREATE TABLE IF NOT EXISTS `parrafos` (
  `parrafos_id` int NOT NULL AUTO_INCREMENT,
  `parrafos_descripcion` varchar(100) NOT NULL,
  `parrafos_orden` int NOT NULL,
  `parrafos_fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `parrafos_fechaupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`parrafos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aesanluc_biblioteca.parrafos: ~12 rows (aproximadamente)
INSERT INTO `parrafos` (`parrafos_id`, `parrafos_descripcion`, `parrafos_orden`, `parrafos_fechacreacion`, `parrafos_fechaupdate`) VALUES
	(1, 'Párrafo 1', 1, '2022-10-19 23:03:07', '2022-10-19 23:03:07'),
	(2, 'Párrafo 2', 2, '2022-10-19 23:03:18', '2022-10-20 13:54:40'),
	(3, 'Párrafo 3', 3, '2022-10-20 05:27:12', '2022-11-02 14:41:48'),
	(4, 'Párrafo 4', 4, '2022-10-20 06:00:34', '2022-11-02 14:41:50'),
	(5, 'Párrafo 5', 5, '2022-10-20 06:01:14', '2022-11-02 14:41:51'),
	(6, 'Párrafo 6', 6, '2022-10-29 20:13:10', '2022-11-02 14:41:52'),
	(12, 'Párrafo 7', 7, '2022-11-14 14:51:33', '2022-11-14 14:51:33'),
	(13, 'Párrafo 8', 8, '2022-11-14 14:51:40', '2022-11-14 14:51:40'),
	(14, 'Párrafo 9', 9, '2022-11-14 14:51:46', '2022-11-14 14:51:46'),
	(15, 'Párrafo 10', 10, '2022-11-14 14:51:52', '2022-11-14 14:51:52'),
	(16, 'Párrafo 11', 11, '2022-11-14 14:51:59', '2022-11-14 14:51:59'),
	(17, 'Párrafo 12', 12, '2022-11-14 14:52:05', '2022-11-14 14:52:05');

-- Volcando estructura para tabla aesanluc_biblioteca.permiso
DROP TABLE IF EXISTS `permiso`;
CREATE TABLE IF NOT EXISTS `permiso` (
  `permiso_id` int NOT NULL AUTO_INCREMENT,
  `permiso_nombre` varchar(200) NOT NULL,
  `grupo_permiso_id` int NOT NULL,
  `permiso_orden` int DEFAULT NULL,
  `permiso_estado` tinyint NOT NULL DEFAULT '1',
  `permiso_fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `permiso_fechaupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`permiso_id`),
  KEY `FK_permiso_grupo_permiso` (`grupo_permiso_id`),
  CONSTRAINT `FK_permiso_grupo_permiso` FOREIGN KEY (`grupo_permiso_id`) REFERENCES `grupo_permiso` (`grupo_permiso_id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aesanluc_biblioteca.permiso: ~24 rows (aproximadamente)
INSERT INTO `permiso` (`permiso_id`, `permiso_nombre`, `grupo_permiso_id`, `permiso_orden`, `permiso_estado`, `permiso_fechacreacion`, `permiso_fechaupdate`) VALUES
	(1, 'Ver roles y agregar', 1, 1, 1, '2022-08-25 09:15:53', '2022-10-17 16:30:44'),
	(2, 'Ver lista de usuarios', 1, 2, 1, '2022-08-25 09:19:43', '2022-10-17 16:31:57'),
	(3, 'Lista de usuarios administradores', 1, 4, 1, '2022-08-25 09:20:40', '2022-10-17 16:38:54'),
	(4, 'Lista de usuarios de intranet', 2, 5, 1, '2022-08-25 09:21:03', '2022-10-17 16:39:04'),
	(5, 'Ver perfil', 2, 6, 1, '2022-08-25 09:21:21', '2022-10-18 22:22:23'),
	(6, 'Agregar libros', 3, 7, 1, '2022-08-25 09:22:19', '2022-10-18 22:33:22'),
	(7, 'Agregar autores', 3, 12, 1, '2022-10-18 22:33:46', '2022-10-18 22:33:51'),
	(8, 'Ver bloqueos', 1, 8, 1, '2022-10-17 15:44:02', '2022-10-17 15:44:06'),
	(9, 'Ver permisos personalizados', 1, 11, 1, '2022-10-17 15:44:32', '2022-10-17 15:44:36'),
	(10, 'Agregar editoriales', 3, 13, 1, '2022-10-18 22:34:25', '2022-10-18 22:34:36'),
	(11, 'Indexación de libros', 1, 14, 1, '2022-10-18 22:53:44', '2022-10-19 22:48:15'),
	(12, 'Agregar párrafos', 1, 15, 1, '2022-10-19 22:37:46', '2022-10-19 22:37:46'),
	(13, 'Agregar palabras claves', 1, 16, 1, '2022-10-20 16:21:20', '2022-10-20 16:21:23'),
	(14, 'Agregar materias', 1, 17, 1, '2022-10-21 04:07:30', '2022-10-21 04:07:39'),
	(15, 'Agregar categorias', 1, 18, 1, '2022-10-22 00:51:32', '2022-10-22 00:51:32'),
	(16, 'Agregar niveles', 1, 19, 1, '2022-10-23 15:49:24', '2022-10-23 15:49:24'),
	(17, 'Agregar terminologías', 1, 20, 1, '2022-10-23 17:17:56', '2022-10-23 17:17:56'),
	(18, 'Ver terminologías vinculadas', 1, 21, 1, '2022-10-24 20:55:42', '2022-10-24 20:55:42'),
	(19, 'Agregar contenido libro', 3, 22, 1, '2022-10-28 16:20:14', '2022-10-28 16:20:14'),
	(20, 'Agregar concepto a los titulos', 3, 23, 1, '2022-11-01 22:53:50', '2022-11-01 22:56:19'),
	(21, 'Motor de busqueda', 3, 24, 1, '2022-11-02 20:39:53', '2022-11-02 20:39:53'),
	(22, 'Reservas de libros', 3, 25, 1, '2022-11-02 21:34:32', '2022-11-02 21:35:27'),
	(23, 'Prestamos de libros', 3, 26, 1, '2022-11-02 21:35:13', '2022-11-02 21:35:31'),
	(24, 'Generar reporte conocimientos', 3, 27, 1, '2022-11-28 11:29:37', '2022-11-28 11:29:55');

-- Volcando estructura para tabla aesanluc_biblioteca.prestamos
DROP TABLE IF EXISTS `prestamos`;
CREATE TABLE IF NOT EXISTS `prestamos` (
  `prestamos_id` int NOT NULL AUTO_INCREMENT,
  `prestamos_fechaprestamos` timestamp NULL DEFAULT NULL,
  `prestamos_fechadevolucion` timestamp NULL DEFAULT NULL,
  `prestamos_observacion_devolucion` varchar(300) NOT NULL,
  `copias_id` int NOT NULL,
  `usuarios_id` int NOT NULL,
  `prestamos_estado` tinyint NOT NULL DEFAULT '1',
  `prestamos_fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `prestamos_fechaupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`prestamos_id`),
  UNIQUE KEY `UQ_copias_usuarios` (`copias_id`,`usuarios_id`),
  KEY `FK_prestamos_copia` (`copias_id`),
  CONSTRAINT `FK_prestamos_copias` FOREIGN KEY (`copias_id`) REFERENCES `copias` (`copias_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aesanluc_biblioteca.prestamos: ~0 rows (aproximadamente)

-- Volcando estructura para tabla aesanluc_biblioteca.reservas
DROP TABLE IF EXISTS `reservas`;
CREATE TABLE IF NOT EXISTS `reservas` (
  `reservas_id` int NOT NULL AUTO_INCREMENT,
  `reservas_fechareserva` timestamp NULL DEFAULT NULL,
  `copias_id` int NOT NULL,
  `usuarios_id` int NOT NULL,
  `reservas_estado` tinyint NOT NULL DEFAULT '1',
  `reservas_fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reservas_fechaupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`reservas_id`),
  UNIQUE KEY `UQ_copias_usuarios_reservas` (`copias_id`,`usuarios_id`),
  KEY `FK_reservas_copias` (`copias_id`),
  CONSTRAINT `FK_reservas_copias` FOREIGN KEY (`copias_id`) REFERENCES `copias` (`copias_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aesanluc_biblioteca.reservas: ~0 rows (aproximadamente)

-- Volcando estructura para tabla aesanluc_biblioteca.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `roles_id` int NOT NULL AUTO_INCREMENT,
  `roles_nombre` varchar(100) NOT NULL,
  `roles_descripcion` varchar(300) NOT NULL,
  `roles_estado` tinyint NOT NULL DEFAULT '1',
  `roles_fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `roles_fechaupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`roles_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aesanluc_biblioteca.roles: ~6 rows (aproximadamente)
INSERT INTO `roles` (`roles_id`, `roles_nombre`, `roles_descripcion`, `roles_estado`, `roles_fechacreacion`, `roles_fechaupdate`) VALUES
	(1, 'Administrador del sistema', 'Encargado del mantenimiento de todo el sistema', 1, '2022-08-24 13:17:28', '2022-09-22 12:24:21'),
	(2, 'Administrador', 'Encargado de manejar toda la gestion', 1, '2022-08-25 09:13:02', '2022-09-02 15:55:52'),
	(3, 'Bibliotecario', 'Encargado de alimentar la biblioteca', 1, '2022-09-02 15:54:41', '2022-09-29 13:25:46'),
	(4, 'Usuarios intranet', 'Rol creado para los usuarios que serán eliminados en algún momento', 1, '2022-10-12 15:47:59', '2022-11-02 21:32:35'),
	(9, 'Invitado', 'Rol creado para los usuarios que serán eliminados en algún momento', 1, '2022-09-29 13:34:24', '2022-09-29 13:38:49'),
	(10, 'Estudiante', 'Rol creado para los usuarios que serán eliminados en algún momento', 1, '2022-09-29 13:39:04', '2022-10-02 16:49:34');

-- Volcando estructura para tabla aesanluc_biblioteca.terminologias
DROP TABLE IF EXISTS `terminologias`;
CREATE TABLE IF NOT EXISTS `terminologias` (
  `terminologias_id` int NOT NULL AUTO_INCREMENT,
  `terminologias_nombre` varchar(300) NOT NULL,
  `terminologias_descripcion` varchar(500) NOT NULL,
  `terminologias_orden` int NOT NULL,
  `terminologias_dependencia` int DEFAULT NULL,
  `terminologias_fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `terminologias_fechaupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`terminologias_id`)
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aesanluc_biblioteca.terminologias: ~118 rows (aproximadamente)
INSERT INTO `terminologias` (`terminologias_id`, `terminologias_nombre`, `terminologias_descripcion`, `terminologias_orden`, `terminologias_dependencia`, `terminologias_fechacreacion`, `terminologias_fechaupdate`) VALUES
	(39, 'Escribir una buena novela.', '-', 1, NULL, '2022-11-14 15:10:54', '2022-11-14 15:10:54'),
	(40, 'transcribir', '-', 2, 39, '2022-11-14 15:11:23', '2022-11-14 15:11:23'),
	(41, 'manuscribir', '-', 2, 39, '2022-11-14 15:11:36', '2022-11-14 15:11:36'),
	(42, 'copiar', '-', 2, 39, '2022-11-14 15:12:16', '2022-11-14 15:12:16'),
	(43, 'anotar', '-', 2, 39, '2022-11-14 15:12:27', '2022-11-14 15:12:27'),
	(44, 'firmar', '-', 2, 39, '2022-11-14 15:12:42', '2022-11-14 15:12:42'),
	(48, 'componer', '-', 2, 39, '2022-11-14 15:21:01', '2022-11-14 15:21:01'),
	(49, 'redactar', '-', 2, 39, '2022-11-14 15:21:12', '2022-11-14 15:21:12'),
	(50, 'expresar', '-', 2, 39, '2022-11-14 15:21:28', '2022-11-14 15:21:28'),
	(51, 'exponer', '-', 2, 39, '2022-11-14 15:21:38', '2022-11-14 15:21:38'),
	(52, 'crear', '-', 2, 39, '2022-11-14 15:21:56', '2022-11-14 15:21:56'),
	(53, 'novelar', '-', 2, 39, '2022-11-14 15:22:06', '2022-11-14 15:22:06'),
	(54, 'narración', '-', 2, 39, '2022-11-14 15:22:24', '2022-11-14 15:22:24'),
	(55, 'relato', '-', 2, 39, '2022-11-14 15:22:34', '2022-11-14 15:22:34'),
	(56, 'cuento', '-', 2, 39, '2022-11-14 15:22:45', '2022-11-14 15:22:45'),
	(58, 'mentira', '-', 2, 39, '2022-11-14 15:23:32', '2022-11-14 15:23:32'),
	(59, 'farsa', '-', 2, 39, '2022-11-14 15:24:13', '2022-11-14 15:24:13'),
	(60, 'La importancia de las semillas', '-', 1, NULL, '2022-11-14 16:48:38', '2022-11-14 16:48:55'),
	(61, 'valor', '-', 2, 60, '2022-11-14 16:49:13', '2022-11-14 16:49:13'),
	(62, 'valía', '-', 2, 60, '2022-11-14 16:51:29', '2022-11-14 16:51:29'),
	(63, 'relevancia', '-', 2, 60, '2022-11-14 16:51:39', '2022-11-14 16:51:39'),
	(64, 'trascendencia', '-', 2, 60, '2022-11-14 16:51:43', '2022-11-14 16:51:43'),
	(65, 'estimación', '-', 2, 60, '2022-11-14 16:51:47', '2022-11-14 16:51:47'),
	(66, 'envergadura', '-', 2, 60, '2022-11-14 16:51:52', '2022-11-14 16:51:52'),
	(67, 'peso', '-', 2, 60, '2022-11-14 16:51:57', '2022-11-14 16:51:57'),
	(68, 'realce', '-', 2, 60, '2022-11-14 16:52:02', '2022-11-14 16:52:02'),
	(69, 'simiente', '-', 2, 60, '2022-11-14 16:52:08', '2022-11-14 16:52:08'),
	(70, 'pepita', '-', 2, 60, '2022-11-14 16:52:13', '2022-11-14 16:52:13'),
	(71, 'pipa', '-', 2, 60, '2022-11-14 16:52:17', '2022-11-14 16:52:17'),
	(72, 'embrión', '-', 2, 60, '2022-11-14 16:52:27', '2022-11-14 16:52:27'),
	(73, 'grano', '-', 2, 60, '2022-11-14 16:52:32', '2022-11-14 16:52:32'),
	(74, 'germen', '-', 2, 60, '2022-11-14 16:52:36', '2022-11-14 16:52:36'),
	(75, 'Lo dificil de definir una semilla', '-', 1, NULL, '2022-11-14 17:09:17', '2022-11-14 17:09:17'),
	(76, 'complejo', '-', 2, 75, '2022-11-14 17:09:39', '2022-11-14 17:09:39'),
	(77, 'complicado', '-', 2, 75, '2022-11-14 17:09:44', '2022-11-14 17:09:44'),
	(78, 'enredado', '-', 2, 75, '2022-11-14 17:09:50', '2022-11-14 17:09:50'),
	(79, 'enmarañado', '-', 2, 75, '2022-11-14 17:09:55', '2022-11-14 17:09:55'),
	(80, 'enrevesado', '-', 2, 75, '2022-11-14 17:10:00', '2022-11-14 17:10:00'),
	(81, 'explicar', '-', 2, 75, '2022-11-14 17:10:05', '2022-11-14 17:10:05'),
	(82, 'precisar', '-', 2, 75, '2022-11-14 17:10:09', '2022-11-14 17:10:09'),
	(83, 'puntualizar', '-', 2, 75, '2022-11-14 17:10:14', '2022-11-14 17:10:14'),
	(84, 'establecer', '-', 2, 75, '2022-11-14 17:10:19', '2022-11-14 17:10:19'),
	(85, 'especificar', '-', 2, 75, '2022-11-14 17:10:24', '2022-11-14 17:10:24'),
	(86, 'concretar', '-', 2, 75, '2022-11-14 17:10:28', '2022-11-14 17:10:28'),
	(87, 'fijar', '-', 2, 75, '2022-11-14 17:10:34', '2022-11-14 17:10:34'),
	(88, 'aclarar', '-', 2, 75, '2022-11-14 17:10:39', '2022-11-14 17:10:39'),
	(89, 'Composición de las palabras', '-', 1, NULL, '2022-11-14 20:15:22', '2022-11-14 20:15:22'),
	(90, 'elaboración', '-', 2, 89, '2022-11-14 20:15:35', '2022-11-14 20:15:35'),
	(91, 'confección', '-', 2, 89, '2022-11-14 20:15:43', '2022-11-14 20:15:43'),
	(92, 'formación', '-', 2, 89, '2022-11-14 20:15:47', '2022-11-14 20:15:47'),
	(93, 'concepción', '-', 2, 89, '2022-11-14 20:15:53', '2022-11-14 20:15:53'),
	(94, 'creación', '-', 2, 89, '2022-11-14 20:15:57', '2022-11-14 20:15:57'),
	(95, 'constitución', '-', 2, 89, '2022-11-14 20:16:02', '2022-11-14 20:16:02'),
	(96, 'hechura', '-', 2, 89, '2022-11-14 20:16:07', '2022-11-14 20:16:07'),
	(97, 'validéz de la voz narrativa', '-', 2, 89, '2022-11-14 20:23:12', '2022-11-14 20:23:12'),
	(98, 'autenticidad', '-', 3, 97, '2022-11-14 20:23:29', '2022-11-14 20:23:29'),
	(99, 'legitimidad', '-', 3, 97, '2022-11-14 20:23:34', '2022-11-14 20:23:34'),
	(100, 'eficacia', '-', 3, 97, '2022-11-14 20:23:39', '2022-11-14 20:23:39'),
	(101, 'habla', '-', 3, 97, '2022-11-14 20:23:44', '2022-11-14 20:23:44'),
	(102, 'dicción', '-', 3, 97, '2022-11-14 20:23:53', '2022-11-14 20:23:53'),
	(103, 'narratorio', '-', 3, 97, '2022-11-14 20:23:58', '2022-11-14 20:23:58'),
	(104, 'Relato de ficción', '-', 3, 97, '2022-11-14 20:51:26', '2022-11-14 20:51:26'),
	(105, 'relación', '-', 3, 97, '2022-11-14 20:51:33', '2022-11-14 20:51:33'),
	(106, 'exposición', '-', 3, 97, '2022-11-14 20:51:38', '2022-11-14 20:51:38'),
	(107, 'descripción', '-', 3, 97, '2022-11-14 20:51:43', '2022-11-14 20:51:43'),
	(108, 'explicación', '-', 3, 97, '2022-11-14 20:51:54', '2022-11-14 20:51:54'),
	(109, 'informe', '-', 3, 97, '2022-11-14 20:51:58', '2022-11-14 20:51:58'),
	(110, 'resumen', '-', 3, 97, '2022-11-14 20:52:03', '2022-11-14 20:52:03'),
	(111, 'fingimiento', '-', 3, 97, '2022-11-14 20:52:06', '2022-11-14 20:52:06'),
	(112, 'simulación', '-', 3, 97, '2022-11-14 20:52:10', '2022-11-14 20:52:10'),
	(113, 'ilusión', '-', 3, 97, '2022-11-14 20:52:14', '2022-11-14 20:52:14'),
	(114, 'imaginación', '-', 3, 97, '2022-11-14 20:52:18', '2022-11-14 20:52:18'),
	(115, 'Vida de los personajes', '-', 3, 97, '2022-11-14 20:52:34', '2022-11-14 20:52:34'),
	(116, 'existencia', '-', 3, 97, '2022-11-14 20:52:41', '2022-11-14 20:52:41'),
	(117, 'celebridad', '-', 4, 115, '2022-11-14 20:53:25', '2022-11-14 20:53:25'),
	(118, 'personalidad', '-', 4, 115, '2022-11-14 20:53:30', '2022-11-14 20:53:30'),
	(119, 'figura', '-', 4, 115, '2022-11-14 20:53:34', '2022-11-14 20:53:34'),
	(120, 'El escenario', '-', 1, NULL, '2022-11-14 20:53:51', '2022-11-14 20:54:17'),
	(121, 'escena', '-', 2, 120, '2022-11-14 20:55:03', '2022-11-14 20:55:03'),
	(122, 'plató', '-', 2, 120, '2022-11-14 20:55:07', '2022-11-14 20:55:07'),
	(123, 'tablado', '-', 2, 120, '2022-11-14 20:55:11', '2022-11-14 20:55:11'),
	(124, 'tablas', '-', 2, 120, '2022-11-14 20:55:15', '2022-11-14 20:55:15'),
	(125, 'proscenio', '-', 2, 120, '2022-11-14 20:55:19', '2022-11-14 20:55:19'),
	(126, 'El misterio de las cosas.', '-', 1, NULL, '2022-11-14 20:55:39', '2022-11-14 20:55:50'),
	(127, 'arcano', '-', 2, 126, '2022-11-14 20:56:08', '2022-11-14 20:56:08'),
	(128, 'secreto', '-', 2, 126, '2022-11-14 20:56:13', '2022-11-14 20:56:13'),
	(129, 'reserva', '-', 2, 126, '2022-11-14 20:56:18', '2022-11-14 20:56:18'),
	(130, 'sigilo', '-', 2, 126, '2022-11-14 20:56:21', '2022-11-14 20:56:21'),
	(131, 'discreción', '-', 2, 126, '2022-11-14 20:56:24', '2022-11-14 20:56:24'),
	(132, 'recato', '-', 2, 126, '2022-11-14 20:56:29', '2022-11-14 20:56:29'),
	(133, 'objeto', '-', 2, 126, '2022-11-14 20:56:32', '2022-11-14 20:56:32'),
	(134, 'artículo', '-', 2, 126, '2022-11-14 20:56:36', '2022-11-14 20:56:36'),
	(135, 'Deseo de los personajes', '-', 1, NULL, '2022-11-14 20:56:48', '2022-11-14 20:56:48'),
	(136, 'apetencia', '-', 2, 135, '2022-11-14 20:57:03', '2022-11-14 20:57:03'),
	(137, 'gana', '-', 2, 135, '2022-11-14 20:57:08', '2022-11-14 20:57:08'),
	(138, 'anhelo', '-', 2, 135, '2022-11-14 20:57:12', '2022-11-14 20:57:12'),
	(139, 'ansia', '-', 2, 135, '2022-11-14 20:57:16', '2022-11-14 20:57:16'),
	(140, 'aspiración', '-', 2, 135, '2022-11-14 20:57:20', '2022-11-14 20:57:20'),
	(141, 'ambición', '-', 2, 135, '2022-11-14 20:57:25', '2022-11-14 20:57:25'),
	(142, 'Problemas del deseo', '-', 1, NULL, '2022-11-14 20:57:53', '2022-11-14 20:57:53'),
	(143, 'obstáculos', '-', 2, 142, '2022-11-14 20:58:34', '2022-11-14 20:58:34'),
	(144, 'atolladeros', '-', 2, 142, '2022-11-14 20:58:38', '2022-11-14 20:58:38'),
	(145, 'Identificación con los personajes', '-', 1, NULL, '2022-11-14 20:58:49', '2022-11-14 20:58:49'),
	(146, 'reconocimiento', '-', 2, 145, '2022-11-14 20:58:58', '2022-11-14 20:58:58'),
	(147, 'caracterización', '-', 2, 145, '2022-11-14 20:59:03', '2022-11-14 20:59:03'),
	(148, 'personalización', '-', 2, 145, '2022-11-14 20:59:07', '2022-11-14 20:59:07'),
	(149, 'tipificación', '-', 2, 145, '2022-11-14 20:59:11', '2022-11-14 20:59:11'),
	(150, 'sentimientos revividos', '-', 1, NULL, '2022-11-14 20:59:27', '2022-11-14 20:59:27'),
	(155, 'afecto', '-', 2, 150, '2022-11-14 21:00:49', '2022-11-14 21:00:49'),
	(156, 'afección', '-', 2, 150, '2022-11-14 21:00:54', '2022-11-14 21:00:54'),
	(157, 'sentir', '-', 2, 150, '2022-11-14 21:00:58', '2022-11-14 21:00:58'),
	(158, 'ternura', '-', 2, 150, '2022-11-14 21:01:05', '2022-11-14 21:01:05'),
	(159, 'resucitar', '-', 2, 150, '2022-11-14 21:01:09', '2022-11-14 21:01:09'),
	(160, 'renacer', '-', 2, 150, '2022-11-14 21:01:13', '2022-11-14 21:01:13'),
	(161, 'Ambiente de los personajes', '-', 1, NULL, '2022-11-14 21:01:30', '2022-11-14 21:01:30'),
	(162, 'entorno', '-', 2, 161, '2022-11-14 21:01:45', '2022-11-14 21:01:45'),
	(163, 'medio', '-', 2, 161, '2022-11-14 21:01:50', '2022-11-14 21:01:50'),
	(164, 'hábitat', '-', 2, 161, '2022-11-14 21:01:55', '2022-11-14 21:01:55');

-- Volcando estructura para tabla aesanluc_biblioteca.tipo_bloqueo
DROP TABLE IF EXISTS `tipo_bloqueo`;
CREATE TABLE IF NOT EXISTS `tipo_bloqueo` (
  `tipo_bloqueo_id` int NOT NULL AUTO_INCREMENT,
  `tipo_bloqueo_descripcion` varchar(200) NOT NULL,
  `tipo_bloqueo_estado` tinyint NOT NULL DEFAULT '1',
  `tipo_bloqueo_fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo_bloqueo_fechaupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`tipo_bloqueo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aesanluc_biblioteca.tipo_bloqueo: ~3 rows (aproximadamente)
INSERT INTO `tipo_bloqueo` (`tipo_bloqueo_id`, `tipo_bloqueo_descripcion`, `tipo_bloqueo_estado`, `tipo_bloqueo_fechacreacion`, `tipo_bloqueo_fechaupdate`) VALUES
	(1, 'No labora en esta institución', 1, '2022-10-06 16:20:50', '2022-10-06 16:20:50'),
	(2, 'Prueba 2', 1, '2022-10-06 16:39:50', '2022-10-06 16:39:50'),
	(3, 'Prueba 3', 1, '2022-10-06 16:39:58', '2022-10-06 16:39:58');

-- Volcando estructura para tabla aesanluc_biblioteca.tipo_libro
DROP TABLE IF EXISTS `tipo_libro`;
CREATE TABLE IF NOT EXISTS `tipo_libro` (
  `tipo_libro_id` int NOT NULL AUTO_INCREMENT,
  `tipo_libro_nombre` varchar(150) NOT NULL,
  `tipo_libro_fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo_libro_fechaupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`tipo_libro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aesanluc_biblioteca.tipo_libro: ~2 rows (aproximadamente)
INSERT INTO `tipo_libro` (`tipo_libro_id`, `tipo_libro_nombre`, `tipo_libro_fechacreacion`, `tipo_libro_fechaupdate`) VALUES
	(1, 'Fisico', '2022-10-27 15:56:31', '2022-10-27 15:56:31'),
	(2, 'Digital', '2022-10-27 15:56:40', '2022-10-27 15:56:40');

-- Volcando estructura para tabla aesanluc_biblioteca.usuarios
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuarios_id` int NOT NULL AUTO_INCREMENT,
  `usuarios_login` varchar(20) NOT NULL,
  `usuarios_nombres` varchar(150) NOT NULL,
  `usuarios_paterno` varchar(150) NOT NULL,
  `usuarios_materno` varchar(100) NOT NULL,
  `usuarios_dni` varchar(12) NOT NULL,
  `usuarios_email` varchar(100) NOT NULL,
  `usuarios_password` varchar(100) NOT NULL,
  `usuarios_estado` tinyint NOT NULL DEFAULT '1',
  `usuarios_foto` varchar(100) NOT NULL,
  `usuarios_fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuarios_fechaupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuarios_updatepassword` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`usuarios_id`),
  UNIQUE KEY `UQ_login_dni` (`usuarios_login`,`usuarios_dni`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aesanluc_biblioteca.usuarios: ~7 rows (aproximadamente)
INSERT INTO `usuarios` (`usuarios_id`, `usuarios_login`, `usuarios_nombres`, `usuarios_paterno`, `usuarios_materno`, `usuarios_dni`, `usuarios_email`, `usuarios_password`, `usuarios_estado`, `usuarios_foto`, `usuarios_fechacreacion`, `usuarios_fechaupdate`, `usuarios_updatepassword`) VALUES
	(1, 'admin', 'Samuel', 'VELA', 'LLANOS', '71116734', 'svelallanos@gmail.com', '$2y$10$iOn96RHvDcPG.bMmpQLtue8ltLBv8hHygx0hadmYn2Un7aUe/IIe2', 1, '', '2022-10-12 13:24:04', '2022-10-12 13:24:47', '2022-10-12 13:32:48'),
	(2, 'invitado', 'Invitado', 'paterno', 'materno', '90000000', 's@s.com', '$2y$10$0wLVRt1PE/1SOSNrBBvKZ.bNjAc0z26QG1YY8cTegXqGbym69O47u', 1, 'sin_foto.png', '2022-08-05 21:07:33', '2022-10-18 21:37:40', '2022-10-12 13:32:48'),
	(12, '45120607', 'Alejandria', 'MARLO', 'RODRIGUEZ', '45120607', 'samu@gmail.com', '$2y$10$DdxvkuPuq3sYwP9vB6RtFewkjyPLT8PSqW6Xsr4wLrbZqW13tZyK6', 1, 'sin_foto.png', '2022-09-23 14:52:32', '2022-10-03 21:58:57', '2022-10-12 13:32:48'),
	(14, '71585536', 'Sleyther', 'ADRIANZEN', 'RODRIGUEZ', '71585536', 'samuel@gmail.com', '$2y$10$CPokoXxd37n/bayTQkCgae3Miw2z8tg.A99bVWSX8LKj8iqL0f3ZC', 1, 'sin_foto.png', '2022-09-23 14:55:33', '2022-10-03 21:58:55', '2022-10-12 13:32:48'),
	(15, '71121863', 'Yeyson Daniel', 'MALIMBA', 'CAMPOS', '71121863', 's@s.com', '$2y$10$o.gCjrz7mjmw8QwUM.xgrOJ4R2P2lPnNOaR2e3lkjWavvQTyGBtoS', 1, 'sin_foto.png', '2022-09-23 14:55:36', '2022-10-03 23:15:27', '2022-10-12 13:32:48'),
	(22, '71116732', 'Iliana Aydee', 'RUIZ', 'ALTAMIRANO', '71116732', 'samu@gmail.com', '$2y$10$poR7.BzmsRUQ0OvyOShJUOL.q/i6GCFrtS0IVwbpRbVS8IyM8vjMO', 1, '', '2022-10-05 17:11:09', '2022-10-05 17:11:09', '2022-10-12 13:32:48'),
	(24, '77064230', 'Thalia Veronica', 'TANANTA', 'HUAMAN', '77064230', 'tanantahuamanthaly@gmail.com', '$2y$10$F2EEQWqFkD8Oq2/jID/AleI2lYleKXd3jHW2K7YDWgicKucTbiEbW', 1, 'user_profile_20221030_211534.jpg', '2022-10-31 02:15:16', '2022-10-31 02:15:34', '2022-10-31 02:15:16');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
