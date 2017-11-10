-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 10, 2017 at 11:48 AM
-- Server version: 5.7.15-0ubuntu0.16.04.1
-- PHP Version: 5.6.27-1+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `BSBASports`
--

-- --------------------------------------------------------

--
-- Table structure for table `ACTIVIDAD`
--

CREATE TABLE `ACTIVIDAD` (
  `ID_ACT` int(11) UNSIGNED NOT NULL,
  `NOMBRE` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `TIPO` enum('INDIVIDUAL','GRUPAL') COLLATE latin1_spanish_ci NOT NULL DEFAULT 'GRUPAL',
  `HORA_INI` time NOT NULL DEFAULT '00:00:00',
  `HORA_FIN` time NOT NULL DEFAULT '00:00:00',
  `DNI_ENTR` varchar(9) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ASISTE`
--

CREATE TABLE `ASISTE` (
  `ID_ACT` int(11) UNSIGNED NOT NULL,
  `DNI_DEP` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `FECHA` date NOT NULL,
  `HORA` time NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `EJERCICIO`
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
-- Table structure for table `ENGLOBA`
--

CREATE TABLE `ENGLOBA` (
  `ID_ENTRENA` int(10) UNSIGNED NOT NULL,
  `ID_EJER` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ENTRENAMIENTO`
--

CREATE TABLE `ENTRENAMIENTO` (
  `ID_ENTRENA` int(10) UNSIGNED NOT NULL,
  `NUM_REP` int(10) UNSIGNED NOT NULL,
  `TIEMPO` time NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `INCLUYE`
--

CREATE TABLE `INCLUYE` (
  `ID_ENTRENA` int(10) UNSIGNED NOT NULL,
  `ID_TABLA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `RESERVA`
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
-- Table structure for table `SESION`
--

CREATE TABLE `SESION` (
  `ID_SESION` int(11) NOT NULL,
  `OBSERVACIONES` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `FECHA` date NOT NULL,
  `HORA` time NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `TABLA`
--

CREATE TABLE `TABLA` (
  `ID_TABLA` int(11) NOT NULL,
  `ID_SESION` int(11) NOT NULL,
  `TIPO` enum('PERSONALIZADA','ESTANDAR') COLLATE latin1_spanish_ci NOT NULL DEFAULT 'ESTANDAR'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `TLF_USUARIO`
--

CREATE TABLE `TLF_USUARIO` (
  `DNI` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `TELEFONO` varchar(9) COLLATE latin1_spanish_ci NOT NULL DEFAULT '000000000'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `USUARIO`
--

CREATE TABLE `USUARIO` (
  `DNI` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
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
  ADD PRIMARY KEY (`ID_ACT`,`DNI_DEP`),
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
  MODIFY `ID_EJERCICIO` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
-- Constraints for dumped tables
--

--
-- Constraints for table `ACTIVIDAD`
--
ALTER TABLE `ACTIVIDAD`
  ADD CONSTRAINT `ACTIVIDAD_ibfk_1` FOREIGN KEY (`DNI_ENTR`) REFERENCES `USUARIO` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ACTIVIDAD_ibfk_2` FOREIGN KEY (`ID_ACT`) REFERENCES `RESERVA` (`ID_ACT`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ASISTE`
--
ALTER TABLE `ASISTE`
  ADD CONSTRAINT `ASISTE_ibfk_1` FOREIGN KEY (`DNI_DEP`) REFERENCES `USUARIO` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ASISTE_ibfk_2` FOREIGN KEY (`ID_ACT`) REFERENCES `ACTIVIDAD` (`ID_ACT`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ENGLOBA`
--
ALTER TABLE `ENGLOBA`
  ADD CONSTRAINT `ENGLOBA_ibfk_1` FOREIGN KEY (`ID_ENTRENA`) REFERENCES `ENTRENAMIENTO` (`ID_ENTRENA`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ENGLOBA_ibfk_2` FOREIGN KEY (`ID_EJER`) REFERENCES `EJERCICIO` (`ID_EJERCICIO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ENTRENAMIENTO`
--
ALTER TABLE `ENTRENAMIENTO`
  ADD CONSTRAINT `ENTRENAMIENTO_ibfk_1` FOREIGN KEY (`ID_ENTRENA`) REFERENCES `INCLUYE` (`ID_ENTRENA`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `INCLUYE`
--
ALTER TABLE `INCLUYE`
  ADD CONSTRAINT `INCLUYE_ibfk_1` FOREIGN KEY (`ID_TABLA`) REFERENCES `TABLA` (`ID_TABLA`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `RESERVA`
--
ALTER TABLE `RESERVA`
  ADD CONSTRAINT `RESERVA_ibfk_1` FOREIGN KEY (`DNI_DEP`) REFERENCES `USUARIO` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `SESION`
--
ALTER TABLE `SESION`
  ADD CONSTRAINT `SESION_ibfk_1` FOREIGN KEY (`ID_SESION`) REFERENCES `TABLA` (`ID_SESION`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `USUARIO`
--
ALTER TABLE `USUARIO`
  ADD CONSTRAINT `USUARIO_ibfk_1` FOREIGN KEY (`ID_SESION`) REFERENCES `SESION` (`ID_SESION`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `USUARIO_ibfk_2` FOREIGN KEY (`ID_TABLA`) REFERENCES `TABLA` (`ID_TABLA`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `USUARIO_ibfk_3` FOREIGN KEY (`DNI`) REFERENCES `TLF_USUARIO` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
