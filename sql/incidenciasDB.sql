-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 24, 2017 at 09:33 PM
-- Server version: 5.7.17
-- PHP Version: 5.6.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `incidenciasDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `incidencia`
--

CREATE TABLE `incidencia` (
  `id` int(11) NOT NULL,
  `idUsusario` int(11) NOT NULL,
  `idTipo` int(11) NOT NULL,
  `comentario` varchar(255) COLLATE utf8_bin NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `incidencia`
--

INSERT INTO `incidencia` (`id`, `idUsusario`, `idTipo`, `comentario`, `fecha`) VALUES
(1, 1, 1, 'Juan llego tarde debido al autobús', '2017-01-24'),
(2, 1, 2, 'Pablo salió al servicio', '2017-01-24');

-- --------------------------------------------------------

--
-- Table structure for table `tipoIncidencia`
--

CREATE TABLE `tipoIncidencia` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tipoIncidencia`
--

INSERT INTO `tipoIncidencia` (`id`, `tipo`) VALUES
(1, 'Retraso'),
(2, 'Salida al WC'),
(3, 'No trabaja'),
(4, 'Falta de respeto'),
(5, 'Otros');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `super` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `super`) VALUES
(1, 'lourdes', '1cdd29ec1cb59765b749d8bac1fc5e6733d4a30d', 0),
(2, 'eliseo', 'c3d06cc7e96a497c7ceceed837aeaa502102ce8f', 0),
(3, 'sebastian', 'db043b2055cb3a47b2eb0b5aebf4e114a8c24a5a', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `incidencia`
--
ALTER TABLE `incidencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsusario` (`idUsusario`),
  ADD KEY `idTipo` (`idTipo`);

--
-- Indexes for table `tipoIncidencia`
--
ALTER TABLE `tipoIncidencia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `incidencia`
--
ALTER TABLE `incidencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tipoIncidencia`
--
ALTER TABLE `tipoIncidencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `incidencia`
--
ALTER TABLE `incidencia`
  ADD CONSTRAINT `incidencia_ibfk_1` FOREIGN KEY (`idUsusario`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `incidencia_ibfk_2` FOREIGN KEY (`idTipo`) REFERENCES `tipoIncidencia` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
