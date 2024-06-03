-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2024 at 05:52 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proiectpractica`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'DariPtr', '123');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `correct` int(11) DEFAULT NULL,
  `answer_text` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `quiz_id`, `correct`, `answer_text`) VALUES
(5, 9, 21, 1, NULL),
(6, 9, 21, 0, NULL),
(7, 9, 21, 0, NULL),
(8, 9, 21, 0, NULL),
(9, 10, 22, 1, 'Paris'),
(10, 10, 22, 0, 'Roma'),
(11, 10, 22, 0, 'Londra'),
(12, 10, 22, 0, 'Bucuresti'),
(13, 11, 22, 1, 'Bucuresti'),
(14, 11, 22, 0, 'Budapesta'),
(15, 11, 22, 0, 'Amsterdam'),
(16, 11, 22, 0, 'Praga'),
(17, 12, 23, 1, 'Corect'),
(18, 12, 23, 0, 'Gresit'),
(19, 12, 23, 0, 'Gresit'),
(20, 12, 23, 0, 'Gresit');

-- --------------------------------------------------------

--
-- Table structure for table `conturi`
--

CREATE TABLE `conturi` (
  `id` int(11) NOT NULL,
  `nume` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `parola` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_results`
--

CREATE TABLE `exam_results` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `exam_name` varchar(100) NOT NULL,
  `total_question` varchar(10) NOT NULL,
  `correct_answer` varchar(10) NOT NULL,
  `wrong_answer` varchar(10) NOT NULL,
  `exam_time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_results`
--

INSERT INTO `exam_results` (`id`, `email`, `exam_name`, `total_question`, `correct_answer`, `wrong_answer`, `exam_time`) VALUES
(1, 'Darius', 'Quiz Andrei', '2', '1', '1', '2024-06-03'),
(2, 'Darius', 'Quiz Andrei', '2', '1', '1', '2024-06-03'),
(3, 'Darius', 'Quiz Andrei', '2', '2', '0', '2024-06-03'),
(4, 'Darius', 'Quiz Andrei', '2', '2', '0', '2024-06-03'),
(5, 'Darius', 'Quiz Andrei', '2', '1', '1', '2024-06-03'),
(6, 'Darius', 'Quiz Andrei', '2', '2', '0', '2024-06-03'),
(7, 'Darius', 'Quiz Andrei', '2', '2', '0', '2024-06-03');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question_text` text DEFAULT NULL,
  `question_no` int(5) NOT NULL,
  `quiz_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question_text`, `question_no`, `quiz_id`) VALUES
(9, ' Care dintre următoarele opțiuni reprezintă un tip de bază de date relațională?', 1, 21),
(10, 'Care este capitala frantei?', 1, 22),
(11, 'Care este capitala Romaniei?', 2, 22),
(12, 'Intrebarea 1', 1, 23);

-- --------------------------------------------------------

--
-- Table structure for table `quizez`
--

CREATE TABLE `quizez` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` varchar(200) NOT NULL,
  `picture` varchar(60) NOT NULL,
  `time` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizez`
--

INSERT INTO `quizez` (`id`, `name`, `description`, `picture`, `time`) VALUES
(10, 'database', 'Testul practică aptitudinile de scriere a interogărilor SQL', '664e201f4d62a.jpg', 0),
(11, 'CSS', 'Test your knowledge of CSS by completing a series of questions designed to evaluate your understanding of selectors, properties, layout techniques, and responsive design principles\r\n\r\n', '664e20c4d219d.jpg', 0),
(12, 'Database', 'test', '665b1745e364d.jpg', 0),
(13, 'CSS', 'test', '665b190438b85.jpg', 0),
(14, 'css', 'test', '665b1a3938878.jpg', 0),
(15, 'Database', 'test', '665b1bf815944.jpg', 0),
(16, '1', '1', '665b1c1dddd85.jpg', 0),
(17, 'Mihalca Alex', '12', '', 0),
(18, 'Database', 'test', '665b1df380cf5.jpg', 0),
(19, 'Database', 'test', '665b1fea2d74a.jpg', 0),
(20, 'Database', 'test', '665b1fea31f6d.jpg', 0),
(21, 'Database', 'test', '665b3f6343b7c.jpg', 2),
(22, 'Quiz Andrei', 'Quiz ', '665c87110b72f.png', 1),
(23, 'Quiz test', 'test', '665c8c37eb314.png', 3);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `username`, `password`, `email`) VALUES
(1, 'DariPtr', '123', 'badlion30@gmail.com'),
(2, 'Darius', '123', 'Petric.Va.Darius@student.utcluj.ro'),
(4, 'Christi', '123', 'christicgskdnjd@gmail.com'),
(5, 'petric.va.darius', '123', 'sunturat684@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `conturi`
--
ALTER TABLE `conturi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `quizez`
--
ALTER TABLE `quizez`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `conturi`
--
ALTER TABLE `conturi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `quizez`
--
ALTER TABLE `quizez`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quizez` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizez` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
