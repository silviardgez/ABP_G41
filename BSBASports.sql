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
  `DIA` enum('LUNES','MARTES','MIERCOLES','JUEVES','VIERNES','SABADO','DOMINGO') NOT NULL,
  `HORA_INI` time NOT NULL DEFAULT '00:00:00',
  `HORA_FIN` time NOT NULL DEFAULT '00:00:00',
  `COLOR` varchar(7) COLLATE latin1_spanish_ci,
  `DNI_ENTR` varchar(9) COLLATE latin1_spanish_ci NOT NULL
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
-- Estrutura da táboa `EJERCICIO`
--

CREATE TABLE `EJERCICIO` (
  `ID_EJERCICIO` int(10) UNSIGNED NOT NULL,
  `NOMBRE` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `TIPO` enum('ESTIRAMIENTO','MUSCULAR','CARDIO') COLLATE latin1_spanish_ci DEFAULT 'CARDIO',
  `IMAGEN` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VIDEO` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estrutura da táboa `ENGLOBA`
--

CREATE TABLE `ENGLOBA` (
  `ID_ENTRENA` int(10) UNSIGNED NOT NULL,
  `ID_EJER` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estrutura da táboa `ENTRENAMIENTO`
--

CREATE TABLE `ENTRENAMIENTO` (
  `ID_ENTRENA` int(10) UNSIGNED NOT NULL,
  `NUM_REP` int(10) UNSIGNED NOT NULL,
  `TIEMPO` time NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estrutura da táboa `INCLUYE`
--

CREATE TABLE `INCLUYE` (
  `ID_ENTRENA` int(10) UNSIGNED NOT NULL,
  `ID_TABLA` int(11) NOT NULL
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
  `OBSERVACIONES` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `FECHA` date NOT NULL,
  `HORA` time NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estrutura da táboa `TABLA`
--

CREATE TABLE `TABLA` (
  `ID_TABLA` int(11) NOT NULL,
  `ID_SESION` int(11) NOT NULL,
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
('44484761R', '633801916');

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
  `DEPORTISTA` tinyint(1) DEFAULT NULL,
  `ID_SESION` int(11) DEFAULT NULL,
  `ID_TABLA` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Inserts
--

INSERT INTO `USUARIO` (`DNI`, `CONTRASEÑA`, `NOMBRE`, `APELLIDOS`, `EMAIL`, `FECHA_NAC`, `ADMIN`, `ENTRENADOR`, `DEPORTISTA`, `ID_SESION`, `ID_TABLA`) VALUES
('12345678A', 'e3928a3bc4be46516aa33a79bbdfdb08', 'Bruno', 'Cruz', 'brucruz53@gmail.com', '1996-02-19', 1, NULL, NULL, NULL, NULL),
('12345678B', '926e27eecdbc7a18858b3798ba99bddd', 'Pepe', 'Fernández', 'dadad@gmail.com', '2017-11-07', NULL, NULL, 1, NULL, NULL),
('12345678C', '926e27eecdbc7a18858b3798ba99bddd', 'Pepe', 'Glez', 'adsf@yahoo.com', '2017-11-08', NULL, 1, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ACTIVIDAD`
--
ALTER TABLE `ACTIVIDAD`
  ADD PRIMARY KEY (`ID_ACT`),
  ADD KEY `DNI_ENTR` (`DNI_ENTR`);

--
-- Indexes for table `ASISTE`
--
ALTER TABLE `ASISTE`
  ADD PRIMARY KEY (`ID_ACT`,`DNI_DEP`,`FECHA`),
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
  ADD PRIMARY KEY (`ID_ENTRENA`,`ID_EJER`),
  ADD KEY `ID_EJER` (`ID_EJER`),
  ADD KEY `ID_ENTRENA` (`ID_ENTRENA`);

--
-- Indexes for table `ENTRENAMIENTO`
--
ALTER TABLE `ENTRENAMIENTO`
  ADD PRIMARY KEY (`ID_ENTRENA`);

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
  ADD PRIMARY KEY (`ID_TABLA`),
  ADD KEY `ID_SESION` (`ID_SESION`);

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
  ADD PRIMARY KEY (`DNI`),
  ADD KEY `ID_SESION` (`ID_SESION`),
  ADD KEY `ID_TABLA` (`ID_TABLA`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ACTIVIDAD`
--
ALTER TABLE `ACTIVIDAD`
  MODIFY `ID_ACT` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ASISTE`
--
ALTER TABLE `ASISTE`
  MODIFY `ID_ACT` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `EJERCICIO`
--
ALTER TABLE `EJERCICIO`
  MODIFY `ID_EJERCICIO` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ENTRENAMIENTO`
--
ALTER TABLE `ENTRENAMIENTO`
  MODIFY `ID_ENTRENA` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `RESERVA`
--
ALTER TABLE `RESERVA`
  MODIFY `ID_ACT` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `SESION`
--
ALTER TABLE `SESION`
  MODIFY `ID_SESION` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `TABLA`
--
ALTER TABLE `TABLA`
  MODIFY `ID_TABLA` int(11) NOT NULL AUTO_INCREMENT;

--
-- INSERTS
-- 

INSERT INTO `ACTIVIDAD`(`NOMBRE`, `DIA`, `HORA_INI`, `HORA_FIN`, `COLOR`, `DNI_ENTR`) VALUES 
('Zumba','MARTES','15:00','17:15', '#F9742C', '12345678C'),
('Zumba','JUEVES','16:00','17:00', '#F9742C', '12345678C'),
('Pilates','MIERCOLES','09:00','10:00', '#28E52E', '12345678C'),
('Boxeo','JUEVES','11:30','13:30', '#26D9F9', '12345678C'),
('Boxeo','MARTES','10:30','11:45', '#26D9F9', '12345678C'),
('GAP','VIERNES','13:45','14:45', '#F3E22D', '12345678C'),
('GAP','LUNES','19:00','20:00', '#F3E22D', '12345678C'),
('Fitbike','LUNES','10:00','12:45', '#FA3BDD', '12345678C');

--
-- Restricións para os envorcados das táboas
--

--
-- Restricións para a táboa `ACTIVIDAD`
--
ALTER TABLE `ACTIVIDAD`
  ADD CONSTRAINT `ACTIVIDAD_ibfk_1` FOREIGN KEY (`DNI_ENTR`) REFERENCES `USUARIO` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restricións para a táboa `ASISTE`
--
ALTER TABLE `ASISTE`
  ADD CONSTRAINT `ASISTE_ibfk_1` FOREIGN KEY (`DNI_DEP`) REFERENCES `USUARIO` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ASISTE_ibfk_2` FOREIGN KEY (`ID_ACT`) REFERENCES `ACTIVIDAD` (`ID_ACT`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restricións para a táboa `ENGLOBA`
--
ALTER TABLE `ENGLOBA`
  ADD CONSTRAINT `ENGLOBA_ibfk_1` FOREIGN KEY (`ID_ENTRENA`) REFERENCES `ENTRENAMIENTO` (`ID_ENTRENA`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ENGLOBA_ibfk_2` FOREIGN KEY (`ID_EJER`) REFERENCES `EJERCICIO` (`ID_EJERCICIO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restricións para a táboa `ENTRENAMIENTO`
--
ALTER TABLE `ENTRENAMIENTO`
  ADD CONSTRAINT `ENTRENAMIENTO_ibfk_1` FOREIGN KEY (`ID_ENTRENA`) REFERENCES `INCLUYE` (`ID_ENTRENA`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restricións para a táboa `INCLUYE`
--
ALTER TABLE `INCLUYE`
  ADD CONSTRAINT `INCLUYE_ibfk_1` FOREIGN KEY (`ID_TABLA`) REFERENCES `TABLA` (`ID_TABLA`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `SESION_ibfk_1` FOREIGN KEY (`ID_SESION`) REFERENCES `TABLA` (`ID_SESION`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restricións para a táboa `TABLA`
--
ALTER TABLE `TABLA`
  ADD CONSTRAINT `TABLA_ibfk_1` FOREIGN KEY (`ID_TABLA`) REFERENCES `USUARIO` (`ID_TABLA`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restricións para a táboa `TLF_USUARIO`
--
ALTER TABLE `TLF_USUARIO`
  ADD CONSTRAINT `TLF_USUARIO_ibfk_1` FOREIGN KEY (`DNI`) REFERENCES `USUARIO` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restricións para a táboa `USUARIO`
--
ALTER TABLE `USUARIO`
  ADD CONSTRAINT `USUARIO_ibfk_2` FOREIGN KEY (`ID_TABLA`) REFERENCES `TABLA` (`ID_TABLA`) ON DELETE CASCADE ON UPDATE CASCADE;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
