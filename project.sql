-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 22-03-2021 a las 18:49:43
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
-- Estructura de tabla para la tabla `admon`
--

DROP TABLE IF EXISTS `admon`;
CREATE TABLE IF NOT EXISTS `admon` (
  `user` text COLLATE utf8_spanish2_ci NOT NULL,
  `password` text COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `admon`
--

INSERT INTO `admon` (`user`, `password`) VALUES
('administrador', 'admin12345abcd..');

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
('6055b5c29dcf3', '6055b5c2a9a64');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `career_chief`
--

DROP TABLE IF EXISTS `career_chief`;
CREATE TABLE IF NOT EXISTS `career_chief` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL,
  `name` text NOT NULL,
  `career` text NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `career_chief`
--

INSERT INTO `career_chief` (`admin_id`, `email`, `password`, `name`, `career`) VALUES
(2, 'sistemas@tesi.com', 'sistemas', 'Diana Casanova Lara', 'Ingeniería en Sistemas Computacionales'),
(3, 'informatica@tesi.com', 'informatica', 'Carlos Alberto Tellez Morales', 'Ingeniería Informática'),
(4, 'ambiental@tesi.com', 'ambiental', 'María Eva Castillo Rezendis', 'Ingeniería Ambiental'),
(5, 'electronica@tesi.com', 'electronica', 'Christian Villareal', 'Ingeniería Electrónica'),
(6, 'administracion@tesi.com', 'administracion', 'Raquel Guzmán Sánchez', 'Licenciatura en Administración'),
(7, 'biomedica@tesi.com', 'biomedica', 'Adriana Berenice Martínez Bello', 'Ingeniería Biomédica'),
(8, 'arquitectura@tesi.com', 'arquitectura', 'Edgar Humberto Castro López', 'Arquitectura');

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
('60555072d279a', 'trfl', 'Verdadero', '60555072d2fcb'),
('60555072d279a', 'trfl', 'Falso', '60555072d2fcf'),
('605550731c53e', 'trfl', 'Verdadero', '605550731d4dd'),
('605550731c53e', 'trfl', 'Falso', '605550731d4e0'),
('6055507335425', 'trfl', 'Verdadero', '6055507335870'),
('6055507335425', 'trfl', 'Falso', '6055507335878'),
('6055507352e05', 'trfl', 'Verdadero', '6055507353015'),
('6055507352e05', 'trfl', 'Falso', '6055507353019'),
('6055b5c29dcf3', 'closed', 'opcion a', '6055b5c2a9a50'),
('6055b5c29dcf3', 'closed', 'opcion b', '6055b5c2a9a64'),
('6055b5c29dcf3', 'closed', 'opcion c', '6055b5c2a9a6f'),
('6055b5c29dcf3', 'closed', 'opcion d', '6055b5c2a9a76');

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
  `status` text COLLATE utf8_spanish2_ci NOT NULL,
  `date` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

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
  `video` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `audio` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `doc` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `choice` int(10) NOT NULL,
  `sn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `questions`
--

INSERT INTO `questions` (`eid`, `qid`, `qval`, `topic`, `subtopic`, `objective`, `competence`, `qns`, `image`, `video`, `audio`, `doc`, `choice`, `sn`) VALUES
('6055b59f71986', '6055b5c29dcf3', 100, '1.Conceptos bÃ¡sicos', '1.1Historia', 'Conocer la historia de las redes', 'Capacidad de anÃ¡lisis y sÃ­ntesis', 'Pregunta 1', 'no image', 'no video', 'no audio', 'no file', 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quiz`
--

DROP TABLE IF EXISTS `quiz`;
CREATE TABLE IF NOT EXISTS `quiz` (
  `eid` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `employnumber` bigint(10) NOT NULL,
  `career` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
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

INSERT INTO `quiz` (`eid`, `employnumber`, `career`, `subject`, `title`, `groupnum`, `total`, `time`, `description`, `date`, `start_date`, `final_date`) VALUES
('6055b59f71986', 4505, 'IngenierÃ­a en Sistemas Computacionales', 'Seguridad informatica', 'Prueba', '1951', 1, 8, 'prueba', '2021-03-20 08:43:11', '2021-03-20 08:42:00', '2021-03-23 08:42:00');

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
  `option` varchar(500) COLLATE utf8_spanish2_ci NOT NULL,
  `left_time` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `results`
--

INSERT INTO `results` (`schoolnumber`, `eid`, `qid`, `ansid`, `studentansid`, `option`, `left_time`) VALUES
('201632958', '6055b59f71986', '6055b5c29dcf3', '6055b5c2a9a64', '6055b5c2a9a64', 'opcion', 7.84998);

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
('Jose Andres', 'Samano Reyes', 'M', 'IngenierÃ­a en Sistemas Computacionales', '201632957', '1951', 'josÃ©@gmail.com', '407d99d8276fced628f17ee7b47aae13'),
('Joaquin ', 'Moreno Robles', 'M', 'IngenierÃ­a en Sistemas Computacionales', '201632789', '1951', 'juan@gmail.com', '16f2beedbdcadadae64168b3904ef9fe'),
('Berenice ', 'Santiago Martinez', 'F', 'IngenierÃ­a en Sistemas Computacionales', '201632958', '1951', 'bere_082598@outlook.com', 'f4e81fba7babf0836b8a448af1bb7fd4'),
('Luis Fernando', 'Morales Sanchez', 'M', 'IngenierÃ­a en Sistemas Computacionales', '201632891', '1951', 'feermorales@outlook.com', '69a7d40ac91ce56cc989cc0da75e4b52'),
('Martin', 'Gomez Sanchez', 'M', 'IngenierÃ­a en Sistemas Computacionales', '201632123', '1951', 'josÃ©@gmail.com', '48be94685ae284988a6fbf0bd780013f'),
('Joaquin ', 'Sanchez Lopez', 'M', 'IngenierÃ­a en Sistemas Computacionales', '201632456', '1951', 'juan@gmail.com', '2e7fcfb2dde358fc510b1482cf262025');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
