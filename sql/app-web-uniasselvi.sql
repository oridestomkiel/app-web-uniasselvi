-- phpMyAdmin SQL Dump
-- version 4.3.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 08-Maio-2024 às 14:47
-- Versão do servidor: 5.7.42
-- PHP Version: 5.6.40-68+ubuntu22.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `app-web-uniasselvi`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `Agenda`
--

CREATE TABLE IF NOT EXISTS `Agenda` (
  `id` int(11) NOT NULL,
  `Data` date DEFAULT NULL,
  `Hora` int(2) NOT NULL,
  `Tutor_id` int(11) DEFAULT NULL,
  `Pet_id` int(11) DEFAULT NULL,
  `Servico` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Pet`
--

CREATE TABLE IF NOT EXISTS `Pet` (
  `id` int(11) NOT NULL,
  `Tutor_Id` int(11) NOT NULL,
  `Nome` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Especie` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Sexo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Observacoes` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Tutor`
--

CREATE TABLE IF NOT EXISTS `Tutor` (
  `id` int(11) NOT NULL,
  `Nome` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Telefone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CEP` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Endereco` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Numero` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Complemento` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Bairro` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Cidade` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Estado` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Agenda`
--
ALTER TABLE `Agenda`
  ADD PRIMARY KEY (`id`), ADD KEY `Tutor_id` (`Tutor_id`), ADD KEY `Pet_id` (`Pet_id`);

--
-- Indexes for table `Pet`
--
ALTER TABLE `Pet`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_pet_tutor` (`Tutor_Id`);

--
-- Indexes for table `Tutor`
--
ALTER TABLE `Tutor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Agenda`
--
ALTER TABLE `Agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=96;
--
-- AUTO_INCREMENT for table `Pet`
--
ALTER TABLE `Pet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `Tutor`
--
ALTER TABLE `Tutor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `Agenda`
--
ALTER TABLE `Agenda`
ADD CONSTRAINT `Agenda_ibfk_1` FOREIGN KEY (`Tutor_id`) REFERENCES `Tutor` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `Agenda_ibfk_2` FOREIGN KEY (`Pet_id`) REFERENCES `Pet` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `Pet`
--
ALTER TABLE `Pet`
ADD CONSTRAINT `fk_pet_tutor` FOREIGN KEY (`Tutor_Id`) REFERENCES `Tutor` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
