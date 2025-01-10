-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 01, 2024 at 10:24 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `bookID` int NOT NULL AUTO_INCREMENT,
  `bookname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `bookauthor` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `year` int NOT NULL,
  `availability` int NOT NULL,
  PRIMARY KEY (`bookID`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bookID`, `bookname`, `bookauthor`, `year`, `availability`) VALUES
(1, 'MATH210', 'Mohammad Al Khatib', 2016, 30),
(2, 'ENGL201', 'Alia El Hawari', 2020, 50),
(3, 'CSCI205', 'Garo Pilawijian', 2006, 40),
(4, 'MATH225', 'Ragheb Mghames', 2020, 30),
(5, 'CSCI200', 'Fouad Najem', 2019, 100),
(6, 'CSCI250', 'Natasha Al Bitar', 2008, 50),
(7, 'CSCI250L', 'DIna Al Jurdi', 2008, 40),
(8, 'MATH 260', 'Karim Amin', 2012, 35),
(9, 'ENGL251', 'Diana AL Khatib', 2021, 50),
(10, 'CSCI335', 'Garo Pilawijian', 2017, 40),
(11, 'CSCI342', 'AbdulRahman Al Kadri', 2014, 60),
(12, 'CSCI345', 'Fouad Najem', 2020, 40),
(13, 'CSCI300', 'Garo Pilawijian', 2022, 20),
(14, 'CSCI300L', 'Fouad Najem', 2023, 50),
(15, 'CSCI378', 'Omar Mohammad', 2023, 30),
(16, 'CSCI380', 'Said Jabre', 2023, 20),
(17, 'CSCi392', 'AbdulRahman Al Kadri', 2022, 50),
(18, 'CSCI390', 'Haitham Al-Awar', 2015, 40),
(19, 'CSCI351', 'Kawthar Dokmak', 2021, 40),
(20, 'CSCI435', 'Haitham Al-Awar', 2023, 30),
(21, 'CSCI430', 'Omar Mohammad', 2023, 30),
(22, 'CSCI430L', 'Omar Mohammad', 2013, 12),
(23, 'MAth310', 'Ragheb Mghames', 2024, 40),
(24, 'CSCI490', 'Haitham Al-Awar', 2024, 44),
(25, 'CSCI475', 'Kawthar dokmak', 2019, 22),
(26, 'CSCI374', 'Omar Mohammad', 2021, 40);

-- --------------------------------------------------------

--
-- Table structure for table `borrowedbooks`
--

DROP TABLE IF EXISTS `borrowedbooks`;
CREATE TABLE IF NOT EXISTS `borrowedbooks` (
  `borrowID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `bookID` int NOT NULL,
  `issuedate` date NOT NULL,
  `duedate` date NOT NULL,
  `returndate` date DEFAULT NULL,
  `fees` int DEFAULT NULL,
  PRIMARY KEY (`borrowID`),
  KEY `username` (`username`),
  KEY `bookID` (`bookID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `editbooksby`
--

DROP TABLE IF EXISTS `editbooksby`;
CREATE TABLE IF NOT EXISTS `editbooksby` (
  `username` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `bookID` int NOT NULL,
  `action` varchar(20) NOT NULL,
  KEY `username-fk` (`username`),
  KEY `bookID-fk` (`bookID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `editbooksby`
--

INSERT INTO `editbooksby` (`username`, `bookID`, `action`) VALUES
('ibrahim-saadi', 1, 'add'),
('ibrahim-saadi', 2, 'add'),
('ibrahim-saadi', 3, 'add'),
('ibrahim-saadi', 4, 'add'),
('ibrahim-saadi', 5, 'add'),
('ibrahim-saadi', 6, 'add'),
('ibrahim-saadi', 7, 'add'),
('ibrahim-saadi', 8, 'add'),
('ibrahim-saadi', 9, 'add'),
('ibrahim-saadi', 10, 'add'),
('ibrahim-saadi', 11, 'add'),
('ibrahim-saadi', 12, 'add'),
('ibrahim-saadi', 13, 'add'),
('ibrahim-saadi', 14, 'add'),
('ibrahim-saadi', 15, 'add'),
('ibrahim-saadi', 16, 'add'),
('ibrahim-saadi', 17, 'add'),
('ibrahim-saadi', 18, 'add'),
('ibrahim-saadi', 19, 'add'),
('ibrahim-saadi', 20, 'add'),
('ibrahim-saadi', 21, 'add'),
('ibrahim-saadi', 22, 'add'),
('ibrahim-saadi', 23, 'add'),
('ibrahim-saadi', 24, 'add'),
('ibrahim-saadi', 25, 'add'),
('ibrahim-saadi', 26, 'add');

-- --------------------------------------------------------

--
-- Table structure for table `issuerequests`
--

DROP TABLE IF EXISTS `issuerequests`;
CREATE TABLE IF NOT EXISTS `issuerequests` (
  `issueID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `bookID` int NOT NULL,
  `issuedate` date NOT NULL,
  PRIMARY KEY (`issueID`),
  KEY `username` (`username`),
  KEY `bookID` (`bookID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `msgID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `bookID` int NOT NULL,
  `message` varchar(250) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`msgID`),
  KEY `username` (`username`),
  KEY `bookID` (`bookID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `registerID` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `number` int NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(225) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `email` varchar(45) NOT NULL,
  `role` varchar(5) NOT NULL,
  `username` varchar(30) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `registerID` (`registerID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`registerID`, `fname`, `lname`, `number`, `dob`, `password`, `gender`, `email`, `role`, `username`) VALUES
(2, 'ibrahim', 'saadi', 70673877, '1999-03-31', '$2y$10$iFYsc6YO4W0Mr6nhaCHjUuScrCCpLcFFC1nebeFTmCxZBjDO3nyWm', 'Mal', 'ibrahim-saadi@gmail.com', 'admin', 'ibrahim-saadi'),
(5, 'Mohammad', 'Rida', 70123456, '0000-00-00', '$2y$10$YTjlrsS9NZW.itbZQm6ONO8wV9t0wZ/NZ3FIIDNHRLbtS9xdIWZqu', 'Mal', 'mohammad-rida@gmail.com', 'user', 'moe-rida');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowedbooks`
--
ALTER TABLE `borrowedbooks`
  ADD CONSTRAINT `borrowedbooks_ibfk_1` FOREIGN KEY (`bookID`) REFERENCES `books` (`bookID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `borrowedbooks_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `editbooksby`
--
ALTER TABLE `editbooksby`
  ADD CONSTRAINT `editbooksby_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `editbooksby_ibfk_2` FOREIGN KEY (`bookID`) REFERENCES `books` (`bookID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `issuerequests`
--
ALTER TABLE `issuerequests`
  ADD CONSTRAINT `issuerequests_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `issuerequests_ibfk_2` FOREIGN KEY (`bookID`) REFERENCES `books` (`bookID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`bookID`) REFERENCES `books` (`bookID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
