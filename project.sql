-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 13-03-2021 a las 01:29:20
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `project`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `password`) VALUES
(2, 'sistemas@tesi.com', 'sistemas'),
(3, 'informatica@tesi.com', 'informatica'),
(4, 'ambiental@tesi.com', 'ambiental'),
(5, 'electronica@tesi.com', 'electronica'),
(6, 'administracion@tesi.com', 'administracion'),
(7, 'biomedica@tesi.com', 'biomedica'),
(8, 'arquitectura@tesi.com', 'arquitectura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `answer`
--

DROP TABLE IF EXISTS `answer`;
CREATE TABLE IF NOT EXISTS `answer` (
  `qid` text NOT NULL,
  `ansid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `answer`
--

INSERT INTO `answer` (`qid`, `ansid`) VALUES
('60413ef4afc02', '60413ef4b9884'),
('60413ef500d47', '60413ef5075c8'),
('60413ef5214ac', '60413ef527cbe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `schoolnumber` bigint(20) NOT NULL,
  `subject` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `feedback` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `date` date NOT NULL,
  `time` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `options`
--

DROP TABLE IF EXISTS `options`;
CREATE TABLE IF NOT EXISTS `options` (
  `qid` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `qtype` varchar(6) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `option` varchar(5000) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `optionid` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `options`
--

INSERT INTO `options` (`qid`, `qtype`, `option`, `optionid`) VALUES
('60413ef4afc02', 'trfl', 'Verdadero', '60413ef4b9884'),
('60413ef4afc02', 'trfl', 'Falso', '60413ef4b9887'),
('60413ef500d47', 'trfl', 'Verda', '60413ef5075c4'),
('60413ef500d47', 'trfl', 'Fals', '60413ef5075c8'),
('60413ef5214ac', 'trfl', 'Verdadero', '60413ef527cbe'),
('60413ef5214ac', 'trfl', 'Falso', '60413ef527cc1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `qualification`
--

DROP TABLE IF EXISTS `qualification`;
CREATE TABLE IF NOT EXISTS `qualification` (
  `eid` text COLLATE utf8_spanish2_ci NOT NULL,
  `schoolnumber` text COLLATE utf8_spanish2_ci NOT NULL,
  `total_score` float NOT NULL,
  `final_score` float NOT NULL,
  `right_ans` bigint(20) NOT NULL,
  `wrong_ans` bigint(20) NOT NULL,
  `porcent` float NOT NULL,
  `date` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `qualification`
--

INSERT INTO `qualification` (`eid`, `schoolnumber`, `total_score`, `final_score`, `right_ans`, `wrong_ans`, `porcent`, `date`) VALUES
('60413ea600e2a', '201635951', 10, 7, 2, 1, 70, '2021-03-12 03:54:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `eid` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `qid` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `qval` float NOT NULL,
  `topic` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `subtopic` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `objective` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `competence` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `qns` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `image` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `choice` int(10) NOT NULL,
  `sn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `questions`
--

INSERT INTO `questions` (`eid`, `qid`, `qval`, `topic`, `subtopic`, `objective`, `competence`, `qns`, `image`, `choice`, `sn`) VALUES
('60413ea600e2a', '60413ef4afc02', 5, '1.Conceptos bÃ¡sicos', '1.1Historia', 'Conocer la historia de las auditorÃ­as informÃ¡ticas', 'Capacidad de anÃ¡lisis y sÃ­ntesis', 'pregunta 1', 'no image', 4, 1),
('60413ea600e2a', '60413ef500d47', 3, '1.Conceptos bÃ¡sicos', '1.1Historia', 'Conocer la historia de las auditorÃ­as informÃ¡ticas', 'Capacidad de anÃ¡lisis y sÃ­ntesis', 'pregunta 2', 'no image', 4, 2),
('60413ea600e2a', '60413ef5214ac', 2, '1.Conceptos bÃ¡sicos', '1.1Historia', 'Conocer la historia de las auditorÃ­as informÃ¡ticas', 'Capacidad de anÃ¡lisis y sÃ­ntesis', 'pregunta 3', 'no image', 4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quiz`
--

DROP TABLE IF EXISTS `quiz`;
CREATE TABLE IF NOT EXISTS `quiz` (
  `eid` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `employnumber` bigint(10) NOT NULL,
  `subject` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `groupnum` text NOT NULL,
  `total` int(11) NOT NULL,
  `time` bigint(20) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `start_date` timestamp NOT NULL,
  `final_date` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `quiz`
--

INSERT INTO `quiz` (`eid`, `employnumber`, `subject`, `title`, `groupnum`, `total`, `time`, `description`, `date`, `start_date`, `final_date`) VALUES
('60413ea600e2a', 4505, 'Seguridad informÃ¡tica', 'Prueba', '1951', 3, 5, 'aoekÃ±rjlqewrhewor', '2021-03-13 00:45:20', '2021-03-04 20:09:00', '2021-03-22 15:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rank`
--

DROP TABLE IF EXISTS `rank`;
CREATE TABLE IF NOT EXISTS `rank` (
  `schoolnumber` bigint(50) NOT NULL,
  `score` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rank`
--

INSERT INTO `rank` (`schoolnumber`, `score`, `time`) VALUES
(1010, 10, '2021-02-16 22:31:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `results`
--

DROP TABLE IF EXISTS `results`;
CREATE TABLE IF NOT EXISTS `results` (
  `schoolnumber` text COLLATE utf8_spanish2_ci NOT NULL,
  `eid` text COLLATE utf8_spanish2_ci NOT NULL,
  `qid` text COLLATE utf8_spanish2_ci NOT NULL,
  `ansid` text COLLATE utf8_spanish2_ci NOT NULL,
  `studentansid` text COLLATE utf8_spanish2_ci NOT NULL,
  `option` varchar(500) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `results`
--

INSERT INTO `results` (`schoolnumber`, `eid`, `qid`, `ansid`, `studentansid`, `option`) VALUES
('201635951', '60413ea600e2a', '60413ef4afc02', '60413ef4b9884', '60413ef4b9884', 'opcion'),
('201635951', '60413ea600e2a', '60413ef500d47', '60413ef5075c8', '60413ef5075c4', 'opcion'),
('201635951', '60413ea600e2a', '60413ef5214ac', '60413ef527cbe', '60413ef527cbe', 'opcion'),
('201635954', '60413ea600e2a', '60413ef4afc02', '60413ef4b9884', '', 'opcion'),
('201635954', '60413ea600e2a', '60413ef500d47', '60413ef5075c8', '', 'opcion'),
('201635954', '60413ea600e2a', '60413ef5214ac', '60413ef527cbe', '', 'opcion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `teacher`
--

DROP TABLE IF EXISTS `teacher`;
CREATE TABLE IF NOT EXISTS `teacher` (
  `employnumber` bigint(10) NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`employnumber`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `teacher`
--

INSERT INTO `teacher` (`employnumber`, `name`, `password`) VALUES
(4505, 'Daniel Clemente', '149ef6419512be56a93169cd5e6fa8fd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `gender` varchar(5) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `career` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `schoolnumber` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `groupnum` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`name`, `last_name`, `gender`, `career`, `schoolnumber`, `groupnum`, `email`, `password`) VALUES
('Francisco Adrian', 'Arroyo Ponce', 'M', 'IngenierÃ­a en Sistemas Computacionales', '201635951', '1951', '', 'd1134e43fa12e17c934dbb486ab6c6d2'),
('Adrian', 'Perez', 'M', 'IngenierÃ­a en Sistemas Computacionales', '201635954', '1951', 'megasadico@gmail.com', 'a3085373b79344412cc95dc836d1caf7');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
