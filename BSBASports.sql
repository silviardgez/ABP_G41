-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Xerado en: 12 de Nov de 2017 ás 20:59
-- Versión do servidor: 5.7.15-0ubuntu0.16.04.1
-- Versión do PHP: 5.6.27-1+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `BSBASports`
--
DROP DATABASE IF EXISTS `BSBASports`;
CREATE DATABASE IF NOT EXISTS `BSBASports` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `BSBASports`;

-- --------------------------------------------------------

--
-- Estrutura da táboa `ACTIVIDAD`
--

CREATE TABLE `ACTIVIDAD` (
  `ID_ACT` int(11) UNSIGNED NOT NULL,
  `NOMBRE` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `TIPO` enum('INDIVIDUAL','GRUPAL') COLLATE latin1_spanish_ci NOT NULL DEFAULT 'GRUPAL',
  `DIA` enum('MONDAY','TUESDAY','WEDNESDAY','THURSDAY','FRIDAY','SATURDAY','SUNDAY') NOT NULL,
  `HORA_INI` time NOT NULL DEFAULT '00:00:00',
  `HORA_FIN` time NOT NULL DEFAULT '00:00:00',
  `COLOR` varchar(7) COLLATE latin1_spanish_ci,
  `DNI_ENTR` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `ID_AULA` int(4) UNSIGNED NOT NULL,
  `PLAZAS` int(4) UNSIGNED NOT NULL DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


-- --------------------------------------------------------

--
-- Estrutura da táboa `ASISTE`
--

CREATE TABLE `ASISTE` (
  `ID_ACT` int(11) UNSIGNED NOT NULL,
  `DNI_DEP` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `FECHA` date NOT NULL,
  `HORA` time NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estrutura da táboa `ASISTE`
--

CREATE TABLE `AULAS` (
  `ID_AULA` int(4) UNSIGNED NOT NULL,
  `NOMBRE_AULA` varchar(25) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estrutura da táboa `EJERCICIO`
--

CREATE TABLE `EJERCICIO` (
  `ID_EJERCICIO` int(10) UNSIGNED NOT NULL,
  `NOMBRE` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `TIPO` enum('ESTIRAMIENTO','MUSCULAR','CARDIO') COLLATE latin1_spanish_ci DEFAULT 'CARDIO',
  `DESCRIPCION` varchar(800) COLLATE latin1_spanish_ci DEFAULT NULL,
  `IMAGEN` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VIDEO` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estrutura da táboa `ENGLOBA`
--

CREATE TABLE `ENGLOBA` (
  `ID_ENGLOBA` int(10) UNSIGNED NOT NULL,
  `ID_TABLA` int(11) UNSIGNED NOT NULL,
  `DNI_USUARIO` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `DNI_ENTRENADOR` varchar(9) COLLATE latin1_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estrutura da táboa `ENTRENAMIENTO`
--

CREATE TABLE `ENTRENAMIENTO` (
  `ID_ENTRENA` int(10) UNSIGNED NOT NULL,
  `ID_EJERCICIO` int(10) UNSIGNED NOT NULL,
  `NUM_REP` int(10) UNSIGNED NOT NULL,
  `TIEMPO` time NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estrutura da táboa `INCLUYE`
--

CREATE TABLE `INCLUYE` (
  `ID_ENTRENA` int(10) UNSIGNED NOT NULL,
  `ID_TABLA` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estrutura da táboa `RESERVA`
--

CREATE TABLE `RESERVA` (
  `ID_ACT` int(10) UNSIGNED NOT NULL,
  `DNI_DEP` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `FECHA` date NOT NULL,
  `HORA` time NOT NULL DEFAULT '00:00:00',
  `CONFIRMADO` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estrutura da táboa `SESION`
--

CREATE TABLE `SESION` (
  `ID_SESION` int(11) NOT NULL,
  `ID_ENGLOBA` int(10) UNSIGNED NOT NULL,
  `OBSERVACIONES` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `FECHA` date NOT NULL,
  `HORA_INI` time NOT NULL DEFAULT '00:00:00',
  `HORA_FIN` time NOT NULL DEFAULT '00:00:00',
  `DURACION` time NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estrutura da táboa `TABLA`
--

CREATE TABLE `TABLA` (
  `ID_TABLA` int(11) UNSIGNED NOT NULL,
  `TIPO` enum('PERSONALIZADA','ESTANDAR') COLLATE latin1_spanish_ci NOT NULL DEFAULT 'ESTANDAR'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estrutura da táboa `TLF_USUARIO`
--

CREATE TABLE `TLF_USUARIO` (
  `DNI` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `TELEFONO` varchar(9) COLLATE latin1_spanish_ci NOT NULL DEFAULT '000000000'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- A extraer os datos da táboa `TLF_USUARIO`
--

INSERT INTO `TLF_USUARIO` (`DNI`, `TELEFONO`) VALUES
('12345678Z', '633801916'),
('11111111H', '657154511'),
('12345670Y', '693524875'),
('12345679S', '988274516'),
('22222222J', '988714830'),
('33333333P', '611872654');

-- --------------------------------------------------------

--
-- Estrutura da táboa `USUARIO`
--

CREATE TABLE `USUARIO` (
  `DNI` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `CONTRASEÑA` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `NOMBRE` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `APELLIDOS` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `EMAIL` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `FECHA_NAC` date NOT NULL,
  `ADMIN` tinyint(1) DEFAULT NULL,
  `ENTRENADOR` tinyint(1) DEFAULT NULL,
  `DEPORTISTA_TDU` tinyint(1) DEFAULT NULL,
  `DEPORTISTA_PEF` tinyint(1) DEFAULT NULL,
  `ACTIVO` tinyint(1) DEFAULT 1,
  `ID_SESION` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Estrutura da táboa `NOTIFICACION`
--

CREATE TABLE `NOTIFICACION` (
  `ID_NOTIFICACION` int(11) NOT NULL,
  `REMITENTE` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `DESTINATARIO` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `ASUNTO` varchar(800) COLLATE utf8_spanish_ci NOT NULL,
  `MENSAJE` varchar(800) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Inserts
--

INSERT INTO `USUARIO` (`DNI`, `CONTRASEÑA`, `NOMBRE`, `APELLIDOS`, `EMAIL`, `FECHA_NAC`, `ADMIN`, `ENTRENADOR`, `DEPORTISTA_TDU`, `DEPORTISTA_PEF`, `ACTIVO`) VALUES
('12345678Z', '21232f297a57a5a743894a0e4a801fc3', 'Bruno', 'Cruz', 'brucruz53@gmail.com', '1996-02-19', 1, NULL, NULL, NULL, 1),
('12345679S', '74d996a70f40c654f73f9b56c63fc28a', 'Pepe', 'Fernández', 'rosilvia@hotmail.com', '2017-11-07', NULL, NULL, 1, NULL, 1),
('11111111H', 'e77a37f64e93e3e3e0211e76bfe512b7', 'Brais', 'Domínguez', 'braisda@gmail.com', '1991-07-10', NULL, 1, NULL, 1, 1),
('22222222J', 'e5cb7c411f1d9a67f68deff4a954cfbc', 'Silvia', 'Rodríguez', 'silviardguez@gmail.com', '1995-08-17', NULL, NULL, NULL, 1, 1),
('33333333P', 'c5e3539121c4944f2bbe097b425ee774', 'Marcos', 'Arias', 'srigleisas@esei.uvigo.es', '2017-11-07', NULL, 1, 1, NULL, 1),
('12345670Y', 'a990ba8861d2b344810851e7e6b49104', 'Pepe', 'Glez', 'panocadas@gmail.com', '2017-11-08', NULL, 1, NULL, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ACTIVIDAD`
--
ALTER TABLE `ACTIVIDAD`
  ADD PRIMARY KEY (`ID_ACT`),
  ADD KEY `ID_AULA` (`ID_AULA`),
  ADD KEY `DNI_ENTR` (`DNI_ENTR`);

--
-- Indexes for table `AULAS`
--
ALTER TABLE `AULAS`
  ADD PRIMARY KEY (`ID_AULA`);

--
-- Indexes for table `ASISTE`
--
ALTER TABLE `ASISTE`
  ADD PRIMARY KEY (`ID_ACT`,`DNI_DEP`,`FECHA`,`HORA`),
  ADD KEY `ID_ACT` (`ID_ACT`),
  ADD KEY `DNI_DEP` (`DNI_DEP`);

--
-- Indexes for table `EJERCICIO`
--
ALTER TABLE `EJERCICIO`
  ADD PRIMARY KEY (`ID_EJERCICIO`);

--
-- Indexes for table `ENGLOBA`
--
ALTER TABLE `ENGLOBA`
  ADD PRIMARY KEY (`ID_ENGLOBA`);

--
-- Indexes for table `ENTRENAMIENTO`
--
ALTER TABLE `ENTRENAMIENTO`
  ADD PRIMARY KEY (`ID_ENTRENA`),
  ADD KEY `ID_EJERCICIO` (`ID_EJERCICIO`);

--
-- Indexes for table `INCLUYE`
--
ALTER TABLE `INCLUYE`
  ADD PRIMARY KEY (`ID_ENTRENA`,`ID_TABLA`),
  ADD KEY `ID_ENTRENA` (`ID_ENTRENA`),
  ADD KEY `ID_TABLA` (`ID_TABLA`);

--
-- Indexes for table `RESERVA`
--
ALTER TABLE `RESERVA`
  ADD PRIMARY KEY (`ID_ACT`,`DNI_DEP`),
  ADD KEY `ID_ACT` (`ID_ACT`),
  ADD KEY `DNI_DEP` (`DNI_DEP`);

--
-- Indexes for table `SESION`
--
ALTER TABLE `SESION`
  ADD PRIMARY KEY (`ID_SESION`);

--
-- Indexes for table `TABLA`
--
ALTER TABLE `TABLA`
  ADD PRIMARY KEY (`ID_TABLA`);

--
-- Indexes for table `TLF_USUARIO`
--
ALTER TABLE `TLF_USUARIO`
  ADD PRIMARY KEY (`DNI`,`TELEFONO`),
  ADD KEY `DNI` (`DNI`);

--
-- Indexes for table `USUARIO`
--
ALTER TABLE `USUARIO`
  ADD PRIMARY KEY (`DNI`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ACTIVIDAD`
--
ALTER TABLE `ACTIVIDAD`
  MODIFY `ID_ACT` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ACTIVIDAD`
--
ALTER TABLE `AULAS`
  MODIFY `ID_AULA` int(4) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- INSERTS
--
INSERT INTO `AULAS` (`ID_AULA`, `NOMBRE_AULA`) VALUES
(1, 'SALA 1'),
(2, 'SALA 2'),
(3, 'SALA 3'),
(4, 'SALA FITNESS'),
(5, 'SALA BAILE'),
(6, 'PISCINA'),
(7, 'PISTA TENIS'),
(8, 'SALA PILATES'),
(9, 'AULA FITBIKE');


INSERT INTO `ACTIVIDAD`(`NOMBRE`, `DIA`, `HORA_INI`, `HORA_FIN`, `COLOR`, `DNI_ENTR`, `ID_AULA`, `PLAZAS`) VALUES
('Zumba','TUESDAY','15:00','17:15', '#F9742C', '12345670Y',1,50),
('Zumba','THURSDAY','16:00','17:00', '#F9742C', '12345670Y',2,30),
('Pilates','WEDNESDAY','09:00','10:00', '#28E52E', '12345670Y',8,2),
('Boxeo','THURSDAY','11:30','13:30', '#26D9F9', '12345670Y',1,1),
('Boxeo','TUESDAY','10:30','11:45', '#26D9F9', '12345670Y',2,2),
('GAP','FRIDAY','13:45','14:45', '#F3E22D', '12345670Y',2,30),
('GAP','MONDAY','19:00','20:00', '#F3E22D', '12345670Y',3,20),
('Fitbike','MONDAY','10:00','12:45', '#FA3BDD', '12345670Y',9,8);


--
-- AUTO_INCREMENT for table `ASISTE`
--
ALTER TABLE `ASISTE`
  MODIFY `ID_ACT` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

INSERT INTO `ASISTE`(`ID_ACT`, `DNI_DEP`, `FECHA`, `HORA`) VALUES
(1,"22222222J","2017-01-01","15:00"),
(1,"22222222J","2017-01-02","15:00"),
(1,"22222222J","2017-01-03","15:00"),
(1,"11111111H","2017-01-04","15:00"),

(1,"22222222J","2017-02-05","15:00"),
(1,"22222222J","2017-02-06","15:00"),
(1,"22222222J","2017-02-07","15:00"),
(1,"11111111H","2017-02-07","15:00"),
(1,"11111111H","2017-02-08","15:00"),
(1,"11111111H","2017-02-09","15:00"),
(1,"11111111H","2017-02-10","15:00"),

(1,"22222222J","2017-03-11","15:00"),
(1,"22222222J","2017-03-12","15:00"),
(1,"22222222J","2017-03-13","15:00"),
(1,"11111111H","2017-03-11","15:00"),

(1,"22222222J","2017-04-14","15:00"),
(1,"22222222J","2017-04-15","15:00"),
(1,"22222222J","2017-04-16","15:00"),

(1,"22222222J","2017-05-17","15:00"),
(1,"22222222J","2017-05-18","15:00"),
(1,"22222222J","2017-05-19","15:00"),
(1,"11111111H","2017-05-17","15:00"),
(1,"11111111H","2017-05-14","15:00"),

(1,"22222222J","2017-06-20","15:00"),
(1,"22222222J","2017-06-21","15:00"),
(1,"22222222J","2017-06-22","15:00"),
(1,"11111111H","2017-06-20","15:00"),

(1,"22222222J","2017-07-21","15:00"),
(1,"22222222J","2017-07-22","15:00"),
(1,"22222222J","2017-07-23","15:00"),
(1,"11111111H","2017-07-18","15:00"),
(1,"11111111H","2017-07-19","15:00"),
(1,"11111111H","2017-07-20","15:00"),
(1,"11111111H","2017-07-21","15:00"),

(1,"22222222J","2017-08-07","15:00"),
(1,"22222222J","2017-08-14","15:00"),
(1,"22222222J","2017-08-21","15:00"),
(1,"11111111H","2017-08-08","15:00"),
(1,"11111111H","2017-08-14","15:00"),

(1,"22222222J","2017-09-07","15:00"),
(1,"22222222J","2017-09-14","15:00"),
(1,"22222222J","2017-09-21","15:00"),
(1,"11111111H","2017-09-17","15:00"),
(1,"11111111H","2017-09-14","15:00"),
(1,"11111111H","2017-09-12","15:00"),

(1,"22222222J","2017-10-07","15:00"),
(1,"22222222J","2017-10-14","15:00"),
(1,"22222222J","2017-10-21","15:00"),
(1,"11111111H","2017-10-11","15:00"),
(1,"11111111H","2017-10-14","15:00"),

(1,"22222222J","2017-11-07","15:00"),
(1,"22222222J","2017-11-14","15:00"),
(1,"22222222J","2017-11-21","15:00"),
(1,"11111111H","2017-11-14","15:00"),

(1,"22222222J","2017-12-07","15:00"),
(1,"22222222J","2017-12-08","15:00"),
(1,"22222222J","2017-12-09","15:00"),
(1,"11111111H","2017-12-10","15:00"),
(1,"11111111H","2017-12-14","15:00"),


(2,"22222222J","2017-01-07","16:00"),
(2,"22222222J","2017-01-10","16:00"),
(2,"22222222J","2017-01-21","16:00"),
(2,"22222222J","2017-01-14","16:00"),

(2,"22222222J","2017-02-07","16:00"),
(2,"22222222J","2017-02-22","16:00"),
(2,"22222222J","2017-02-21","16:00"),
(2,"22222222J","2017-02-17","16:00"),
(2,"22222222J","2017-02-14","16:00"),
(2,"22222222J","2017-02-27","16:00"),
(2,"22222222J","2017-02-24","16:00"),

(2,"22222222J","2017-03-07","16:00"),
(2,"22222222J","2017-03-24","16:00"),
(2,"22222222J","2017-03-21","16:00"),
(2,"22222222J","2017-03-14","16:00"),

(2,"22222222J","2017-04-07","16:00"),
(2,"22222222J","2017-04-14","16:00"),
(2,"22222222J","2017-04-21","16:00"),

(2,"22222222J","2017-05-07","16:00"),
(2,"22222222J","2017-05-24","16:00"),
(2,"22222222J","2017-05-21","16:00"),
(2,"22222222J","2017-05-17","16:00"),
(2,"22222222J","2017-05-14","16:00"),

(2,"22222222J","2017-06-07","16:00"),
(2,"22222222J","2017-06-14","16:00"),
(2,"22222222J","2017-06-21","16:00"),
(2,"22222222J","2017-06-24","16:00"),

(2,"22222222J","2017-07-07","16:00"),
(2,"22222222J","2017-07-14","16:00"),
(2,"22222222J","2017-07-21","16:00"),
(2,"22222222J","2017-07-17","16:00"),
(2,"22222222J","2017-07-13","16:00"),
(2,"22222222J","2017-07-27","16:00"),
(2,"22222222J","2017-07-24","16:00"),

(2,"22222222J","2017-08-07","16:00"),
(2,"22222222J","2017-08-14","16:00"),
(2,"22222222J","2017-08-21","16:00"),
(2,"22222222J","2017-08-08","16:00"),
(2,"22222222J","2017-08-24","16:00"),

(2,"22222222J","2017-09-07","16:00"),
(2,"22222222J","2017-09-14","16:00"),
(2,"22222222J","2017-09-21","16:00"),
(2,"22222222J","2017-09-17","16:00"),
(2,"22222222J","2017-09-24","16:00"),
(2,"22222222J","2017-09-12","16:00"),

(2,"22222222J","2017-10-07","16:00"),
(2,"22222222J","2017-10-14","16:00"),
(2,"22222222J","2017-10-21","16:00"),
(2,"22222222J","2017-10-11","16:00"),
(2,"22222222J","2017-10-24","16:00"),

(2,"22222222J","2017-11-07","16:00"),
(2,"22222222J","2017-11-14","16:00"),
(2,"22222222J","2017-11-21","16:00"),
(2,"22222222J","2017-11-24","16:00"),

(2,"22222222J","2017-12-07","16:00"),
(2,"22222222J","2017-12-08","16:00"),
(2,"22222222J","2017-12-09","16:00"),
(2,"22222222J","2017-12-10","16:00"),
(2,"22222222J","2017-12-14","16:00"),


(3,"12345679S","2017-01-07","09:00"),
(3,"12345679S","2017-01-14","09:00"),
(3,"12345679S","2017-01-21","09:00"),
(3,"12345679S","2017-01-24","09:00"),

(3,"12345679S","2017-02-07","09:00"),
(3,"12345679S","2017-02-14","09:00"),
(3,"12345679S","2017-02-21","09:00"),
(3,"12345679S","2017-02-17","09:00"),
(3,"12345679S","2017-02-22","09:00"),
(3,"12345679S","2017-02-27","09:00"),
(3,"12345679S","2017-02-24","09:00"),

(3,"12345679S","2017-03-07","09:00"),
(3,"12345679S","2017-03-14","09:00"),
(3,"12345679S","2017-03-21","09:00"),
(3,"12345679S","2017-03-24","09:00"),

(3,"12345679S","2017-04-07","09:00"),
(3,"12345679S","2017-04-14","09:00"),
(3,"12345679S","2017-04-21","09:00"),

(3,"12345679S","2017-05-07","09:00"),
(3,"12345679S","2017-05-14","09:00"),
(3,"12345679S","2017-05-21","09:00"),
(3,"12345679S","2017-05-17","09:00"),
(3,"12345679S","2017-05-24","09:00"),

(3,"12345679S","2017-06-07","09:00"),
(3,"12345679S","2017-06-14","09:00"),
(3,"12345679S","2017-06-21","09:00"),
(3,"12345679S","2017-06-24","09:00"),

(3,"12345679S","2017-07-07","09:00"),
(3,"12345679S","2017-07-14","09:00"),
(3,"12345679S","2017-07-21","09:00"),
(3,"12345679S","2017-07-17","09:00"),
(3,"12345679S","2017-07-20","09:00"),
(3,"12345679S","2017-07-27","09:00"),
(3,"12345679S","2017-07-24","09:00"),

(3,"12345679S","2017-08-07","09:00"),
(3,"12345679S","2017-08-14","09:00"),
(3,"12345679S","2017-08-21","09:00"),
(3,"12345679S","2017-08-08","09:00"),
(3,"12345679S","2017-08-24","09:00"),

(3,"12345679S","2017-09-07","09:00"),
(3,"12345679S","2017-09-14","09:00"),
(3,"12345679S","2017-09-21","09:00"),
(3,"12345679S","2017-09-17","09:00"),
(3,"12345679S","2017-09-24","09:00"),
(3,"12345679S","2017-09-12","09:00"),

(3,"12345679S","2017-10-07","09:00"),
(3,"12345679S","2017-10-14","09:00"),
(3,"12345679S","2017-10-21","09:00"),
(3,"12345679S","2017-10-11","09:00"),
(3,"12345679S","2017-10-24","09:00"),

(3,"12345679S","2017-11-07","09:00"),
(3,"12345679S","2017-11-14","09:00"),
(3,"12345679S","2017-11-21","09:00"),
(3,"12345679S","2017-11-24","09:00"),

(3,"12345679S","2017-12-07","09:00"),
(3,"12345679S","2017-12-08","09:00"),
(3,"12345679S","2017-12-09","09:00"),
(3,"12345679S","2017-12-10","09:00"),
(3,"12345679S","2017-12-14","09:00"),


(4,"11111111H","2017-01-07","11:30"),
(4,"11111111H","2017-01-14","11:30"),
(4,"11111111H","2017-01-21","11:30"),
(4,"11111111H","2017-01-24","11:30"),

(4,"11111111H","2017-02-07","11:30"),
(4,"11111111H","2017-02-14","11:30"),
(4,"11111111H","2017-02-22","11:30"),
(4,"11111111H","2017-02-17","11:30"),
(4,"11111111H","2017-02-21","11:30"),
(4,"11111111H","2017-02-27","11:30"),
(4,"11111111H","2017-02-24","11:30"),

(4,"11111111H","2017-03-07","11:30"),
(4,"11111111H","2017-03-14","11:30"),
(4,"11111111H","2017-03-21","11:30"),
(4,"11111111H","2017-03-24","11:30"),

(4,"11111111H","2017-04-07","11:30"),
(4,"11111111H","2017-04-14","11:30"),
(4,"11111111H","2017-04-21","11:30"),

(4,"11111111H","2017-05-07","11:30"),
(4,"11111111H","2017-05-14","11:30"),
(4,"11111111H","2017-05-21","11:30"),
(4,"11111111H","2017-05-17","11:30"),
(4,"11111111H","2017-05-24","11:30"),

(4,"11111111H","2017-06-07","11:30"),
(4,"11111111H","2017-06-24","11:30"),
(4,"11111111H","2017-06-21","11:30"),
(4,"11111111H","2017-06-14","11:30"),

(4,"11111111H","2017-07-07","11:30"),
(4,"11111111H","2017-07-14","11:30"),
(4,"11111111H","2017-07-21","11:30"),
(4,"11111111H","2017-07-17","11:30"),
(4,"11111111H","2017-07-22","11:30"),
(4,"11111111H","2017-07-27","11:30"),
(4,"11111111H","2017-07-24","11:30"),

(4,"11111111H","2017-08-07","11:30"),
(4,"11111111H","2017-08-14","11:30"),
(4,"11111111H","2017-08-21","11:30"),
(4,"11111111H","2017-08-08","11:30"),
(4,"11111111H","2017-08-24","11:30"),

(4,"11111111H","2017-09-07","11:30"),
(4,"11111111H","2017-09-14","11:30"),
(4,"11111111H","2017-09-21","11:30"),
(4,"11111111H","2017-09-17","11:30"),
(4,"11111111H","2017-09-24","11:30"),
(4,"11111111H","2017-09-12","11:30"),

(4,"11111111H","2017-10-07","11:30"),
(4,"11111111H","2017-10-14","11:30"),
(4,"11111111H","2017-10-21","11:30"),
(4,"11111111H","2017-10-11","11:30"),
(4,"11111111H","2017-10-24","11:30"),

(4,"11111111H","2017-11-07","11:30"),
(4,"11111111H","2017-11-14","11:30"),
(4,"11111111H","2017-11-21","11:30"),
(4,"11111111H","2017-11-24","11:30"),

(4,"11111111H","2017-12-07","11:30"),
(4,"11111111H","2017-12-08","11:30"),
(4,"11111111H","2017-12-09","11:30"),
(4,"11111111H","2017-12-10","11:30"),
(4,"11111111H","2017-12-14","11:30"),


(5,"22222222J","2017-01-07","10:30"),
(5,"22222222J","2017-01-14","10:30"),
(5,"22222222J","2017-01-21","10:30"),
(5,"22222222J","2017-01-24","10:30"),

(5,"22222222J","2017-02-07","10:30"),
(5,"22222222J","2017-02-14","10:30"),
(5,"22222222J","2017-02-21","10:30"),
(5,"22222222J","2017-02-17","10:30"),
(5,"22222222J","2017-02-24","10:30"),
(5,"22222222J","2017-02-27","10:30"),
(5,"22222222J","2017-02-25","10:30"),

(5,"22222222J","2017-03-07","10:30"),
(5,"22222222J","2017-03-14","10:30"),
(5,"22222222J","2017-03-21","10:30"),
(5,"22222222J","2017-03-24","10:30"),

(5,"22222222J","2017-04-07","10:30"),
(5,"22222222J","2017-04-14","10:30"),
(5,"22222222J","2017-04-21","10:30"),

(5,"22222222J","2017-05-07","10:30"),
(5,"22222222J","2017-05-14","10:30"),
(5,"22222222J","2017-05-21","10:30"),
(5,"22222222J","2017-05-17","10:30"),
(5,"22222222J","2017-05-24","10:30"),

(5,"22222222J","2017-06-07","10:30"),
(5,"22222222J","2017-06-14","10:30"),
(5,"22222222J","2017-06-21","10:30"),
(5,"22222222J","2017-06-24","10:30"),

(5,"22222222J","2017-07-07","10:30"),
(5,"22222222J","2017-07-14","10:30"),
(5,"22222222J","2017-07-21","10:30"),
(5,"22222222J","2017-07-17","10:30"),
(5,"22222222J","2017-07-24","10:30"),
(5,"22222222J","2017-07-27","10:30"),
(5,"22222222J","2017-07-25","10:30"),

(5,"22222222J","2017-08-07","10:30"),
(5,"22222222J","2017-08-14","10:30"),
(5,"22222222J","2017-08-21","10:30"),
(5,"22222222J","2017-08-08","10:30"),
(5,"22222222J","2017-08-24","10:30"),

(5,"22222222J","2017-09-07","10:30"),
(5,"22222222J","2017-09-14","10:30"),
(5,"22222222J","2017-09-21","10:30"),
(5,"22222222J","2017-09-17","10:30"),
(5,"22222222J","2017-09-24","10:30"),
(5,"22222222J","2017-09-12","10:30"),

(5,"22222222J","2017-10-07","10:30"),
(5,"22222222J","2017-10-14","10:30"),
(5,"22222222J","2017-10-21","10:30"),
(5,"22222222J","2017-10-11","10:30"),
(5,"22222222J","2017-10-24","10:30"),

(5,"22222222J","2017-11-07","10:30"),
(5,"22222222J","2017-11-14","10:30"),
(5,"22222222J","2017-11-21","10:30"),
(5,"22222222J","2017-11-24","10:30"),

(5,"22222222J","2017-12-07","10:30"),
(5,"22222222J","2017-12-08","10:30"),
(5,"22222222J","2017-12-09","10:30"),
(5,"22222222J","2017-12-10","10:30"),
(5,"22222222J","2017-12-14","10:30"),



(6,"22222222J","2017-01-07","13:45"),
(6,"22222222J","2017-01-14","13:45"),
(6,"22222222J","2017-01-21","13:45"),
(6,"11111111H","2017-01-24","13:45"),

(6,"22222222J","2017-02-07","13:45"),
(6,"22222222J","2017-02-14","13:45"),
(6,"22222222J","2017-02-21","13:45"),
(6,"11111111H","2017-02-17","13:45"),
(6,"11111111H","2017-02-16","13:45"),
(6,"11111111H","2017-02-27","13:45"),
(6,"11111111H","2017-02-24","13:45"),

(6,"22222222J","2017-03-07","13:45"),
(6,"22222222J","2017-03-14","13:45"),
(6,"22222222J","2017-03-21","13:45"),
(6,"11111111H","2017-03-24","13:45"),

(6,"22222222J","2017-04-07","13:45"),
(6,"22222222J","2017-04-14","13:45"),
(6,"22222222J","2017-04-21","13:45"),

(6,"22222222J","2017-05-07","13:45"),
(6,"22222222J","2017-05-14","13:45"),
(6,"22222222J","2017-05-21","13:45"),
(6,"11111111H","2017-05-17","13:45"),
(6,"11111111H","2017-05-24","13:45"),

(6,"22222222J","2017-06-07","13:45"),
(6,"22222222J","2017-06-14","13:45"),
(6,"22222222J","2017-06-21","13:45"),
(6,"11111111H","2017-06-24","13:45"),

(6,"22222222J","2017-07-07","13:45"),
(6,"22222222J","2017-07-14","13:45"),
(6,"22222222J","2017-07-21","13:45"),
(6,"11111111H","2017-07-17","13:45"),
(6,"11111111H","2017-07-24","13:45"),
(6,"11111111H","2017-07-27","13:45"),
(6,"11111111H","2017-07-25","13:45"),

(6,"22222222J","2017-08-08","13:45"),
(6,"22222222J","2017-08-14","13:45"),
(6,"22222222J","2017-08-21","13:45"),
(6,"11111111H","2017-08-07","13:45"),
(6,"11111111H","2017-08-24","13:45"),

(6,"22222222J","2017-09-07","13:45"),
(6,"22222222J","2017-09-14","13:45"),
(6,"22222222J","2017-09-21","13:45"),
(6,"11111111H","2017-09-17","13:45"),
(6,"11111111H","2017-09-24","13:45"),
(6,"11111111H","2017-09-12","13:45"),

(6,"22222222J","2017-10-07","13:45"),
(6,"22222222J","2017-10-14","13:45"),
(6,"22222222J","2017-10-21","13:45"),
(6,"11111111H","2017-10-11","13:45"),
(6,"11111111H","2017-10-24","13:45"),

(6,"22222222J","2017-11-07","13:45"),
(6,"22222222J","2017-11-14","13:45"),
(6,"22222222J","2017-11-21","13:45"),
(6,"11111111H","2017-11-24","13:45"),

(6,"22222222J","2017-12-07","13:45"),
(6,"22222222J","2017-12-08","13:45"),
(6,"22222222J","2017-12-09","13:45"),
(6,"11111111H","2017-12-10","13:45"),
(6,"11111111H","2017-12-14","13:45"),





(7,"22222222J","2017-01-07","19:00"),
(7,"22222222J","2017-01-14","19:00"),
(7,"22222222J","2017-01-21","19:00"),
(7,"11111111H","2017-01-24","19:00"),

(7,"22222222J","2017-02-07","19:00"),
(7,"22222222J","2017-02-14","19:00"),
(7,"22222222J","2017-02-21","19:00"),
(7,"11111111H","2017-02-17","19:00"),
(7,"11111111H","2017-02-13","19:00"),
(7,"11111111H","2017-02-27","19:00"),
(7,"11111111H","2017-02-24","19:00"),

(7,"22222222J","2017-03-07","19:00"),
(7,"22222222J","2017-03-14","19:00"),
(7,"22222222J","2017-03-21","19:00"),
(7,"11111111H","2017-03-24","19:00"),

(7,"22222222J","2017-04-07","19:00"),
(7,"22222222J","2017-04-14","19:00"),
(7,"22222222J","2017-04-21","19:00"),

(7,"22222222J","2017-05-07","19:00"),
(7,"22222222J","2017-05-14","19:00"),
(7,"22222222J","2017-05-21","19:00"),
(7,"11111111H","2017-05-17","19:00"),
(7,"11111111H","2017-05-24","19:00"),

(7,"22222222J","2017-06-07","19:00"),
(7,"22222222J","2017-06-14","19:00"),
(7,"22222222J","2017-06-21","19:00"),
(7,"11111111H","2017-06-24","19:00"),

(7,"22222222J","2017-07-07","19:00"),
(7,"22222222J","2017-07-14","19:00"),
(7,"22222222J","2017-07-21","19:00"),
(7,"11111111H","2017-07-17","19:00"),
(7,"11111111H","2017-07-13","19:00"),
(7,"11111111H","2017-07-27","19:00"),
(7,"11111111H","2017-07-24","19:00"),

(7,"22222222J","2017-08-08","19:00"),
(7,"22222222J","2017-08-14","19:00"),
(7,"22222222J","2017-08-21","19:00"),
(7,"11111111H","2017-08-07","19:00"),
(7,"11111111H","2017-08-24","19:00"),

(7,"22222222J","2017-09-07","19:00"),
(7,"22222222J","2017-09-14","19:00"),
(7,"22222222J","2017-09-21","19:00"),
(7,"11111111H","2017-09-17","19:00"),
(7,"11111111H","2017-09-24","19:00"),
(7,"11111111H","2017-09-12","19:00"),

(7,"22222222J","2017-10-07","19:00"),
(7,"22222222J","2017-10-14","19:00"),
(7,"22222222J","2017-10-21","19:00"),
(7,"11111111H","2017-10-11","19:00"),
(7,"11111111H","2017-10-24","19:00"),

(7,"22222222J","2017-11-07","19:00"),
(7,"22222222J","2017-11-14","19:00"),
(7,"22222222J","2017-11-21","19:00"),
(7,"11111111H","2017-11-24","19:00"),

(7,"22222222J","2017-12-07","19:00"),
(7,"22222222J","2017-12-08","19:00"),
(7,"22222222J","2017-12-09","19:00"),
(7,"11111111H","2017-12-10","19:00"),
(7,"11111111H","2017-12-14","19:00"),


(8,"12345679S","2017-01-07","10:00"),
(8,"12345679S","2017-01-14","10:00"),
(8,"12345679S","2017-01-21","10:00"),
(8,"12345679S","2017-01-24","10:00"),

(8,"12345679S","2017-02-07","10:00"),
(8,"12345679S","2017-02-14","10:00"),
(8,"12345679S","2017-02-21","10:00"),
(8,"12345679S","2017-02-17","10:00"),
(8,"12345679S","2017-02-13","10:00"),
(8,"12345679S","2017-02-27","10:00"),
(8,"12345679S","2017-02-24","10:00"),

(8,"12345679S","2017-03-07","10:00"),
(8,"12345679S","2017-03-14","10:00"),
(8,"12345679S","2017-03-21","10:00"),
(8,"12345679S","2017-03-24","10:00"),

(8,"12345679S","2017-04-07","10:00"),
(8,"12345679S","2017-04-14","10:00"),
(8,"12345679S","2017-04-21","10:00"),

(8,"12345679S","2017-05-07","10:00"),
(8,"12345679S","2017-05-14","10:00"),
(8,"12345679S","2017-05-21","10:00"),
(8,"12345679S","2017-05-17","10:00"),
(8,"12345679S","2017-05-24","10:00"),

(8,"12345679S","2017-06-07","10:00"),
(8,"12345679S","2017-06-14","10:00"),
(8,"12345679S","2017-06-21","10:00"),
(8,"12345679S","2017-06-24","10:00"),

(8,"12345679S","2017-07-07","10:00"),
(8,"12345679S","2017-07-14","10:00"),
(8,"12345679S","2017-07-21","10:00"),
(8,"12345679S","2017-07-17","10:00"),
(8,"12345679S","2017-07-13","10:00"),
(8,"12345679S","2017-07-27","10:00"),
(8,"12345679S","2017-07-24","10:00"),

(8,"12345679S","2017-08-07","10:00"),
(8,"12345679S","2017-08-14","10:00"),
(8,"12345679S","2017-08-21","10:00"),
(8,"12345679S","2017-08-08","10:00"),
(8,"12345679S","2017-08-24","10:00"),

(8,"12345679S","2017-09-07","10:00"),
(8,"12345679S","2017-09-14","10:00"),
(8,"12345679S","2017-09-21","10:00"),
(8,"12345679S","2017-09-17","10:00"),
(8,"12345679S","2017-09-24","10:00"),
(8,"12345679S","2017-09-12","10:00"),

(8,"12345679S","2017-10-07","10:00"),
(8,"12345679S","2017-10-14","10:00"),
(8,"12345679S","2017-10-21","10:00"),
(8,"12345679S","2017-10-11","10:00"),
(8,"12345679S","2017-10-24","10:00"),

(8,"12345679S","2017-11-07","10:00"),
(8,"12345679S","2017-11-14","10:00"),
(8,"12345679S","2017-11-21","10:00"),
(8,"12345679S","2017-11-24","10:00"),

(8,"12345679S","2017-12-07","10:00"),
(8,"12345679S","2017-12-08","10:00"),
(8,"12345679S","2017-12-09","10:00"),
(8,"12345679S","2017-12-10","10:00"),
(8,"12345679S","2017-12-14","10:00");

--
-- AUTO_INCREMENT for table `EJERCICIO`
--
ALTER TABLE `EJERCICIO`
  MODIFY `ID_EJERCICIO` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;


INSERT INTO `EJERCICIO`(`NOMBRE`, `TIPO`, `DESCRIPCION`, `IMAGEN`, `VIDEO`) VALUES
("Elíptica","CARDIO","Súbete a la máquina.
  Alinea tus pies con tus caderas.
  Párate derecho, manteniendo la columna en una posición neutral para reducir el estrés durante el ejercicio. Empuja tu pelvis hacia adelante, de manera que no estés arqueando tu espalda de más y jala con tus músculos abdominales para darle apoyo a la espalda.
  Comienza a pedalear hacia adelante para activar la pantalla en la elíptica.","src/eliptica.jpg",NULL),
("Cinta de correr","CARDIO","Inicie la máquina y configurela con la velocidad que mejor se adapte al ritmo que desea seguir.
  Inicie el movimiento de correr durante el tiempo estipulado dentro de la cinta en movimiento","src/cinta.jpg",NULL),
("Bicicleta","CARDIO",NULL,"src/bici.jpg",NULL),
("Remo","CARDIO","Comienza con los brazos extendidos, las rodillas dobladas y el peso del cuerpo sobre las puntas de los pies.
    Con la espalda recta y el núcleo compacto, empuja hacia atrás utilizando sólo las piernas.
    Mantén los brazos extendidos en todo momento.
    Es hora de poner todo junto! Con la espalda recta, núcleo compacto y los pies firmes, empuja primero con la parte inferior del cuerpo y a continuación utiliza la espalda para tirar las manos hacia el pecho.
    Después, suelta los brazos hacia la base y dobla las rodillas para que puedas deslizarte y volver a la posición inicial.","src/remo.jpg",NULL),
("Dominadas","MUSCULAR","
    Para hacer dominadas estrictas (agarre prono) debes colgarte de una barra fija con las manos un poco más abierta que la separación entre tus hombros. Las manos deben mirar hacia el frente y si deseas subir la intensidad el dedo pulgar debe estar sobre la barra y no rodeándola. También si nos enfocamos en que el dorsal ancho trabaje más, es mejor fijar la escápula hacia abajo y hacia atrás.
    Inhala aire por las fosas nasales antes de iniciar el movimiento.
    Ejecuta la tracción del cuerpo entero flexionando los brazos y contrayendo los músculos de la espalda sin tensionar el cuello. El movimiento de elevación debe ser tan explosivo como te sea posible para tener mejores resultados y debes espirar durante la subida en los momentos de mayor esfuerzo.
    El movimiento de tracción debe finalizar cuando la totalidad del rostro supere la altura de la barra sin perder la postura recta del cuerpo, sin encoger los hombros y manteniendo las piernas relajadas contrayendo los glúteos para una mejor activación abdominal (de preferencia tener las piernas estiradas salvo que al bajar toquen el suelo, en este caso es mejor mantener las rodillas dobladas).
    Desciende de forma controlada hasta que tus brazos queden estirados totalmente y puedas subir las escápulas ligeramente antes de la siguiente repetición. Durante el descenso es importante inhalar para estar listo para la siguiente repetición.","src/dominadas.jpg",NULL),
("Sentadillas","MUSCULAR",NULL,"src/sentadillas.jpg",NULL),
("Flexiones","MUSCULAR","Acuéstese boca abajo.
  Coloque las palmas de las manos en el suelo a la altura de los hombros, ligeramente más abiertos que el ancho de sus hombros.
  Mantenga su cuerpo erguido.
  Levante el cuerpo hacia arriba e ir enderezando los brazos, procura mantener una postura erguida. Evita inclinar el tronco hacia atrás.
  El cuerpo debe apoyarse únicamente sobre las manos y los dedos de los pies, manteniendo la posición erguida todo el tiempo.
  Bajamos el cuerpo doblando los brazos, volvemos a la posición inicial extendiendo los brazos.
  No acostarse en el suelo durante el ejercicio. Desde el primer ejercicio de flexión de brazos hasta el último, el contacto con el suelo sólo lo deben tener los dedos de las manos y pies.
","src/flexiones.jpg",NULL),
("Press banca de pecho","MUSCULAR",NULL,"src/presspecho.jpg",NULL),
("Curl de antebrazos","MUSCULAR",NULL,"src/curlantebrazo.jpg",NULL),
("Curl de piernas acostado","MUSCULAR",NULL,"src/curlpiernasacostado.jpg",NULL),
("Abdominales superiores","MUSCULAR"," Tendrás que tumbarte sobre la esterilla, alzar las piernas en un ángulo de 90 grados y colocar las manos en tu nuca. En esta posición, deberás elevar el torso notando cómo trabajan los músculos abdominales y haciendo el número de repeticiones indicado.","src/abdominales.jpg",NULL),
("Press de pierna","MUSCULAR",NULL,"src/presspierna.jpg",NULL),
("Abducción de cadera","MUSCULAR",NULL,"src/abduccioncadera.jpg",NULL),
("Cuádriceps","ESTIRAMIENTO",NULL,"src/cuadriceps.jpg",NULL),
("Gemelos","ESTIRAMIENTO",NULL,"src/gemelo.jpg",NULL),
("Glúteo","ESTIRAMIENTO","El ejercicio es simple, nos tumbaos sobre una superficie cómoda, flexionamos las rodillas y ponemos el pie del lado que queremos estirar encima de la rodilla contraria, sujetamos ésta por el hueco popliteo y tiramos suavemente hacia nosotros.","src/gluteo.jpg",NULL),
("Cadera","ESTIRAMIENTO",NULL,"src/cadera.jpg",NULL),
("Aductor","ESTIRAMIENTO",NULL,"src/aductor.jpg",NULL);


--
-- AUTO_INCREMENT for table `ENGLOBA`
--
ALTER TABLE `ENGLOBA`
  MODIFY `ID_ENGLOBA` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

INSERT INTO `ENGLOBA` (`ID_TABLA`,`DNI_USUARIO`,`DNI_ENTRENADOR`) VALUES
(4,"22222222J","33333333P"),
(2,"22222222J","11111111H"),
(3,"11111111H","33333333P"),
(2,"11111111H","33333333P"),
(3,"12345679S", NULL),
(2,"12345679S", NULL);


--
-- AUTO_INCREMENT for table `ENTRENAMIENTO`
--
ALTER TABLE `ENTRENAMIENTO`
  MODIFY `ID_ENTRENA` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

INSERT INTO `ENTRENAMIENTO`(`ID_EJERCICIO`, `NUM_REP`, `TIEMPO`) VALUES
(1,1,"00:20"),
(1,1,"00:15"),
(2,1,"00:20"),
(2,1,"00:15"),
(3,1,"00:20"),
(3,1,"00:15"),
(4,1,"00:20"),
(4,1,"00:15"),
(5,10,"00:00"),
(5,15,"00:00"),
(5,8,"00:00"),
(6,10,"00:00"),
(6,15,"00:00"),
(6,8,"00:00"),
(7,10,"00:00"),
(7,15,"00:00"),
(7,8,"00:00"),
(8,10,"00:00"),
(8,15,"00:00"),
(8,8,"00:00"),
(9,10,"00:00"),
(9,15,"00:00"),
(9,8,"00:00"),
(10,10,"00:00"),
(10,15,"00:00"),
(10,8,"00:00"),
(11,10,"00:00"),
(11,15,"00:00"),
(11,8,"00:00"),
(12,10,"00:00"),
(12,15,"00:00"),
(12,8,"00:00"),
(13,10,"00:00"),
(13,15,"00:00"),
(13,8,"00:00"),
(14,2,"00:00:30"),
(14,4,"00:00:15"),
(14,1,"00:01"),
(15,2,"00:00:30"),
(15,4,"00:00:15"),
(15,1,"00:01"),
(16,2,"00:00:30"),
(16,4,"00:00:15"),
(16,1,"00:01"),
(17,2,"00:00:30"),
(17,4,"00:00:15"),
(17,1,"00:01"),
(18,2,"00:00:30"),
(18,4,"00:00:15"),
(18,1,"00:01");

--
-- AUTO_INCREMENT for table `RESERVA`
--
ALTER TABLE `RESERVA`
  MODIFY `ID_ACT` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

INSERT INTO `RESERVA`(`ID_ACT`,`DNI_DEP`, `FECHA`, `HORA`, `CONFIRMADO`) VALUES
(1,"22222222J","2017-11-08","18:00",1),
(1,"11111111H","2017-11-10","18:00",1),
(2,"22222222J","2017-11-18","18:00",1),
(3,"12345679S","2017-11-08","18:00",1),
(4,"11111111H","2017-11-08","18:00",1),
(5,"22222222J","2017-11-18","18:00",1),
(7,"33333333P","2017-11-08","18:00",1),
(8,"12345679S","2017-11-08","18:00",1),
(7,"12345679S","2017-11-08","18:00",1),
(6,"33333333P","2017-11-08","18:00",1);

--
-- AUTO_INCREMENT for table `SESION`
--
ALTER TABLE `SESION`
  MODIFY `ID_SESION` int(11) NOT NULL AUTO_INCREMENT;

 INSERT INTO `SESION` (`ID_ENGLOBA`,`OBSERVACIONES`,`FECHA`,`HORA_INI`,`HORA_FIN`,`DURACION`) VALUES
 (1,"Realizada correctamente", "2017-01-08","18:00","19:00","00:40:00"),
 (1,"Realizada correctamente", "2017-01-09","18:00","19:00","00:35:00"),
 (1,"Realizadas más repeticiones en los ejercicios musculares.", "2017-01-11","18:00","19:30","01:20:00"),
 (1,"Realizada correctamente", "2017-01-18","18:00","19:00","00:45:00"),
 (1,"Realizada correctamente", "2017-01-19","18:00","19:00","00:36:00"),
 (1,"Realizadas más repeticiones en los ejercicios musculares.", "2017-01-21","18:00","19:30","01:20:00"),

 (2,"No se pudo terminar", "2017-01-10","19:00","21:00","01:12:00"),
 (2,"Realizada correctamente", "2017-01-09","18:00","19:00","00:55:00"),
 (2,"Realizadas más repeticiones en los ejercicios musculares.", "2017-01-11","18:00","19:30","01:00:00"),
 (2,"Realizada correctamente", "2017-01-18","18:00","19:00","00:55:00"),
 (2,"Realizada correctamente", "2017-01-19","18:00","19:00","00:56:00"),
 (2,"Realizadas más repeticiones en los ejercicios musculares.", "2017-01-21","18:00","19:30","01:05:00"),

 (3,"Realizada correctamente", "2017-01-08","18:00","18:45","01:00:00"),
 (3,"No se pudo terminar", "2017-01-10","19:00","21:00","01:12:00"),
 (3,"Realizada correctamente", "2017-01-09","18:00","19:00","00:55:00"),
 (3,"Realizadas más repeticiones en los ejercicios musculares.", "2017-01-11","18:00","19:30","01:00:00"),
 (3,"Realizada correctamente", "2017-01-18","18:00","19:00","00:55:00"),
 (3,"Realizada correctamente", "2017-01-19","18:00","19:00","00:56:00"),

 (4,"Realizada correctamente", "2017-01-10","19:00","20:12","01:12:00"),
 (4,"No se pudo terminar", "2017-01-10","19:00","21:00","01:12:00"),
 (4,"Realizada correctamente", "2017-01-09","18:00","19:00","00:55:00"),
 (4,"Realizadas más repeticiones en los ejercicios musculares.", "2017-01-11","18:00","19:30","01:00:00"),
 (4,"Realizada correctamente", "2017-01-18","18:00","19:00","00:55:00"),
 (4,"Realizada correctamente", "2017-01-19","18:00","19:00","00:56:00"),

 (5,"Interrumpida por problemas personales", "2017-01-11","10:00","10:30","00:17:00"),
 (5,"No se pudo terminar", "2017-01-10","19:00","21:00","01:12:00"),
 (5,"Realizada correctamente", "2017-01-09","18:00","19:00","00:55:00"),
 (5,"Realizadas más repeticiones en los ejercicios musculares.", "2017-01-11","18:00","19:30","01:00:00"),
 (5,"Realizada correctamente", "2017-01-18","18:00","19:00","00:55:00"),
 (5,"Realizada correctamente", "2017-01-19","18:00","19:00","00:56:00"),

 (6,"Realizada correctamente", "2017-01-08","12:00","13:00","00:57:38"),
 (6,"No se pudo terminar", "2017-01-10","19:00","21:00","01:12:00"),
 (6,"Realizada correctamente", "2017-01-09","18:00","19:00","00:55:00"),
 (6,"Realizadas más repeticiones en los ejercicios musculares.", "2017-01-11","18:00","19:30","01:00:00"),
 (6,"Realizada correctamente", "2017-01-18","18:00","19:00","00:55:00"),
 (6,"Realizada correctamente", "2017-01-19","18:00","19:00","00:56:00");

--
-- AUTO_INCREMENT for table `TABLA`
--
ALTER TABLE `TABLA`
  MODIFY `ID_TABLA` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

INSERT INTO `TABLA` (`ID_TABLA`,`TIPO`) VALUES
(2,"ESTANDAR");
INSERT INTO `TABLA`(`TIPO`) VALUES
("ESTANDAR"),
("PERSONALIZADA"),
("PERSONALIZADA");


INSERT INTO `INCLUYE` (`ID_ENTRENA`, `ID_TABLA`) VALUES
(1,3),
(9,3),
(12,3),
(15,3),
(18,3),
(21,3),
(50,3),
(47,3),
(3,2),
(24,2),
(27,2),
(30,2),
(33,2),
(23,2),
(44,2),
(41,2),
(1,4),
(9,4),
(12,4),
(15,4),
(18,4),
(21,4),
(50,4),
(47,4);
--
-- Restricións para os envorcados das táboas
--

--
-- Restricións para a táboa `ACTIVIDAD`
--
ALTER TABLE `ACTIVIDAD`
  ADD CONSTRAINT `ACTIVIDAD_ibfk_1` FOREIGN KEY (`DNI_ENTR`) REFERENCES `USUARIO` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ACTIVIDAD_ibfk_2` FOREIGN KEY (`ID_AULA`) REFERENCES `AULAS` (`ID_AULA`) ON DELETE CASCADE ON UPDATE CASCADE;

--
  -- Indexes for table `NOTIFICACION`
  --
  ALTER TABLE `NOTIFICACION`
    ADD PRIMARY KEY (`ID_NOTIFICACION`);

  --
  -- AUTO_INCREMENT for dumped tables
  --

  --
  -- AUTO_INCREMENT for table `NOTIFICACION`
  --
  ALTER TABLE `NOTIFICACION`
    MODIFY `ID_NOTIFICACION` int(11) NOT NULL AUTO_INCREMENT;

--
-- INSERTS
--

INSERT INTO `NOTIFICACION` (`ID_NOTIFICACION`, `REMITENTE`, `DESTINATARIO`, `ASUNTO`, `MENSAJE`) VALUES
(1, 'sda@yahoo.es', '12345678Z', 'mensaje de pago', 'Aviso de que debe pagar la cuota del gimnasio antes del dia 30.'),
(2, 'bsbasports@gmail.com', '12345678Z', 'mensaje de pago', 'Se ha recibido el pago de la cuota mensual.');

--
-- Restricións para a táboa `ASISTE`
--
ALTER TABLE `ASISTE`
  ADD CONSTRAINT `ASISTE_ibfk_1` FOREIGN KEY (`DNI_DEP`) REFERENCES `USUARIO` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ASISTE_ibfk_2` FOREIGN KEY (`ID_ACT`) REFERENCES `ACTIVIDAD` (`ID_ACT`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restricións para a táboa `ENTRENAMIENTO`
--
ALTER TABLE `ENTRENAMIENTO`
  ADD CONSTRAINT `ENTRENAMIENTO_ibfk_1` FOREIGN KEY (`ID_EJERCICIO`) REFERENCES `EJERCICIO` (`ID_EJERCICIO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restricións para a táboa `INCLUYE`
--
ALTER TABLE `INCLUYE`
  ADD CONSTRAINT `INCLUYE_ibfk_1` FOREIGN KEY (`ID_TABLA`) REFERENCES `TABLA` (`ID_TABLA`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `INCLUYE_ibfk_2` FOREIGN KEY (`ID_ENTRENA`) REFERENCES `ENTRENAMIENTO` (`ID_ENTRENA`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restricións para a táboa `RESERVA`
--
ALTER TABLE `RESERVA`
  ADD CONSTRAINT `RESERVA_ibfk_1` FOREIGN KEY (`DNI_DEP`) REFERENCES `USUARIO` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `RESERVA_ibfk_2` FOREIGN KEY (`ID_ACT`) REFERENCES `ACTIVIDAD` (`ID_ACT`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restricións para a táboa `SESION`
--
ALTER TABLE `SESION`
  ADD CONSTRAINT `SESION_ibfk_1` FOREIGN KEY (`ID_ENGLOBA`) REFERENCES `ENGLOBA` (`ID_ENGLOBA`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restricións para a táboa `ENGLOBA`
--
ALTER TABLE `ENGLOBA`
  ADD CONSTRAINT `ENGLOBA_ibfk_1` FOREIGN KEY (`DNI_USUARIO`) REFERENCES `USUARIO` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ENGLOBA_ibfk_2` FOREIGN KEY (`ID_TABLA`) REFERENCES `TABLA` (`ID_TABLA`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ENGLOBA_ibfk_3` FOREIGN KEY (`DNI_ENTRENADOR`) REFERENCES `USUARIO` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restricións para a táboa `TLF_USUARIO`
--
ALTER TABLE `TLF_USUARIO`
  ADD CONSTRAINT `TLF_USUARIO_ibfk_1` FOREIGN KEY (`DNI`) REFERENCES `USUARIO` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
