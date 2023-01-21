-- phpMyAdmin SQL Dump
-- version 5.0.4deb2
-- https://www.phpmyadmin.net/
--
-- Host: mysql.info.unicaen.fr:3306
-- Generation Time: Nov 21, 2022 at 12:56 PM
-- Server version: 10.5.11-MariaDB-1
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `22007629_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `Association`
--

CREATE TABLE `Association` (
  `ID` int(11) NOT NULL,
  `ACRONYME` varchar(256) DEFAULT NULL,
  `NOM` varchar(256) DEFAULT NULL,
  `CREATION` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Association`
--

INSERT INTO `Association` (`ID`, `ACRONYME`, `NOM`, `CREATION`) VALUES
(1, 'CSC', 'Corpo Sciences Caen', 1992),
(2, 'FCBN', 'fédération campus basse normandie', 2012),
(3, 'AFNEUS', 'Association Fédérative Nationale des Etudiant en Sciences et en technique d\'ingénieurie', 1992),
(4, 'ADS', 'Amicale des sciences', 1926);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Association`
--
ALTER TABLE `Association`
  ADD PRIMARY KEY (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
