-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2026 at 09:00 PM
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
-- Database: `library_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `comments` text DEFAULT NULL,
  `floor` int(11) NOT NULL,
  `isle` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `year`, `comments`, `floor`, `isle`) VALUES
(1, 'The Great Adventure 1', 'John Smith', 1990, 'Adventure story 1', 1, 'A1'),
(2, 'The Great Adventure 2', 'John Smith', 1991, 'Adventure story 2', 1, 'A1'),
(3, 'The Great Adventure 3', 'John Smith', 1992, 'Adventure story 3', 1, 'A1'),
(4, 'The Great Adventure 4', 'John Smith', 1993, 'Adventure story 4', 1, 'A2'),
(5, 'The Great Adventure 5', 'John Smith', 1994, 'Adventure story 5', 1, 'A2'),
(6, 'History of Science 1', 'Alice Brown', 1980, 'Science history volume 1', 2, 'B1'),
(7, 'History of Science 2', 'Alice Brown', 1981, 'Science history volume 2', 2, 'B1'),
(8, 'History of Science 3', 'Alice Brown', 1982, 'Science history volume 3', 2, 'B1'),
(9, 'History of Science 4', 'Alice Brown', 1983, 'Science history volume 4', 2, 'B2'),
(10, 'History of Science 5', 'Alice Brown', 1984, 'Science history volume 5', 2, 'B2'),
(11, 'Modern Computing 1', 'Bob Johnson', 2000, 'Computing basics 1', 3, 'C1'),
(12, 'Modern Computing 2', 'Bob Johnson', 2001, 'Computing basics 2', 3, 'C1'),
(13, 'Modern Computing 3', 'Bob Johnson', 2002, 'Computing basics 3', 3, 'C1'),
(14, 'Modern Computing 4', 'Bob Johnson', 2003, 'Computing basics 4', 3, 'C2'),
(15, 'Modern Computing 5', 'Bob Johnson', 2004, 'Computing basics 5', 3, 'C2'),
(16, 'Classic Novel 1', 'Emily Clark', 1950, 'Classic novel edition 1', 1, 'D1'),
(17, 'Classic Novel 2', 'Emily Clark', 1951, 'Classic novel edition 2', 1, 'D1'),
(18, 'Classic Novel 3', 'Emily Clark', 1952, 'Classic novel edition 3', 1, 'D1'),
(19, 'Classic Novel 4', 'Emily Clark', 1953, 'Classic novel edition 4', 1, 'D2'),
(20, 'Classic Novel 5', 'Emily Clark', 1954, 'Classic novel edition 5', 1, 'D2'),
(21, 'Mathematics Handbook 1', 'David Lee', 1995, 'Math reference 1', 2, 'E1'),
(22, 'Mathematics Handbook 2', 'David Lee', 1996, 'Math reference 2', 2, 'E1'),
(23, 'Mathematics Handbook 3', 'David Lee', 1997, 'Math reference 3', 2, 'E1'),
(24, 'Mathematics Handbook 4', 'David Lee', 1998, 'Math reference 4', 2, 'E2'),
(25, 'Mathematics Handbook 5', 'David Lee', 1999, 'Math reference 5', 2, 'E2'),
(26, 'Physics Fundamentals 1', 'Sarah Miller', 1988, 'Physics intro 1', 2, 'F1'),
(27, 'Physics Fundamentals 2', 'Sarah Miller', 1989, 'Physics intro 2', 2, 'F1'),
(28, 'Physics Fundamentals 3', 'Sarah Miller', 1990, 'Physics intro 3', 2, 'F1'),
(29, 'Physics Fundamentals 4', 'Sarah Miller', 1991, 'Physics intro 4', 2, 'F2'),
(30, 'Physics Fundamentals 5', 'Sarah Miller', 1992, 'Physics intro 5', 2, 'F2'),
(31, 'Art of Painting 1', 'Laura Wilson', 1970, 'Painting techniques 1', 4, 'G1'),
(32, 'Art of Painting 2', 'Laura Wilson', 1971, 'Painting techniques 2', 4, 'G1'),
(33, 'Art of Painting 3', 'Laura Wilson', 1972, 'Painting techniques 3', 4, 'G1'),
(34, 'Art of Painting 4', 'Laura Wilson', 1973, 'Painting techniques 4', 4, 'G2'),
(35, 'Art of Painting 5', 'Laura Wilson', 1974, 'Painting techniques 5', 4, 'G2'),
(36, 'World History 1', 'Michael Davis', 1960, 'World history part 1', 4, 'H1'),
(37, 'World History 2', 'Michael Davis', 1961, 'World history part 2', 4, 'H1'),
(38, 'World History 3', 'Michael Davis', 1962, 'World history part 3', 4, 'H1'),
(39, 'World History 4', 'Michael Davis', 1963, 'World history part 4', 4, 'H2'),
(40, 'World History 5', 'Michael Davis', 1964, 'World history part 5', 4, 'H2'),
(41, 'Biology Basics 1', 'Nancy Young', 1990, 'Biology basics volume 1', 3, 'I1'),
(42, 'Biology Basics 2', 'Nancy Young', 1991, 'Biology basics volume 2', 3, 'I1'),
(43, 'Biology Basics 3', 'Nancy Young', 1992, 'Biology basics volume 3', 3, 'I1'),
(44, 'Biology Basics 4', 'Nancy Young', 1993, 'Biology basics volume 4', 3, 'I2'),
(45, 'Biology Basics 5', 'Nancy Young', 1994, 'Biology basics volume 5', 3, 'I2'),
(46, 'Programming in C 1', 'Chris Evans', 2005, 'C programming basics 1', 3, 'J1'),
(47, 'Programming in C 2', 'Chris Evans', 2006, 'C programming basics 2', 3, 'J1'),
(48, 'Programming in C 3', 'Chris Evans', 2007, 'C programming basics 3', 3, 'J1'),
(49, 'Programming in C 4', 'Chris Evans', 2008, 'C programming basics 4', 3, 'J2'),
(50, 'Programming in C 5', 'Chris Evans', 2009, 'C programming basics 5', 3, 'J2'),
(51, 'Web Development 1', 'Olivia Harris', 2010, 'HTML & CSS basics 1', 3, 'K1'),
(52, 'Web Development 2', 'Olivia Harris', 2011, 'HTML & CSS basics 2', 3, 'K1'),
(53, 'Web Development 3', 'Olivia Harris', 2012, 'HTML & CSS basics 3', 3, 'K1'),
(54, 'Web Development 4', 'Olivia Harris', 2013, 'HTML & CSS basics 4', 3, 'K2'),
(55, 'Web Development 5', 'Olivia Harris', 2014, 'HTML & CSS basics 5', 3, 'K2'),
(56, 'Database Design 1', 'Peter Walker', 2000, 'Database concepts 1', 3, 'L1'),
(57, 'Database Design 2', 'Peter Walker', 2001, 'Database concepts 2', 3, 'L1'),
(58, 'Database Design 3', 'Peter Walker', 2002, 'Database concepts 3', 3, 'L1'),
(59, 'Database Design 4', 'Peter Walker', 2003, 'Database concepts 4', 3, 'L2'),
(60, 'Database Design 5', 'Peter Walker', 2004, 'Database concepts 5', 3, 'L2'),
(61, 'Children Stories 1', 'Grace King', 1995, 'Story for kids 1', 1, 'M1'),
(62, 'Children Stories 2', 'Grace King', 1996, 'Story for kids 2', 1, 'M1'),
(63, 'Children Stories 3', 'Grace King', 1997, 'Story for kids 3', 1, 'M1'),
(64, 'Children Stories 4', 'Grace King', 1998, 'Story for kids 4', 1, 'M2'),
(65, 'Children Stories 5', 'Grace King', 1999, 'Story for kids 5', 1, 'M2'),
(66, 'Travel Guide 1', 'Henry Scott', 2005, 'Travel guide 1', 1, 'N1'),
(67, 'Travel Guide 2', 'Henry Scott', 2006, 'Travel guide 2', 1, 'N1'),
(68, 'Travel Guide 3', 'Henry Scott', 2007, 'Travel guide 3', 1, 'N1'),
(69, 'Travel Guide 4', 'Henry Scott', 2008, 'Travel guide 4', 1, 'N2'),
(70, 'Travel Guide 5', 'Henry Scott', 2009, 'Travel guide 5', 1, 'N2'),
(71, 'Psychology 1', 'Irene Adams', 1985, 'Psychology basics 1', 2, 'O1'),
(72, 'Psychology 2', 'Irene Adams', 1986, 'Psychology basics 2', 2, 'O1'),
(73, 'Psychology 3', 'Irene Adams', 1987, 'Psychology basics 3', 2, 'O1'),
(74, 'Psychology 4', 'Irene Adams', 1988, 'Psychology basics 4', 2, 'O2'),
(75, 'Psychology 5', 'Irene Adams', 1989, 'Psychology basics 5', 2, 'O2'),
(76, 'Chemistry Intro 1', 'James Baker', 1990, 'Chemistry intro 1', 2, 'P1'),
(77, 'Chemistry Intro 2', 'James Baker', 1991, 'Chemistry intro 2', 2, 'P1'),
(78, 'Chemistry Intro 3', 'James Baker', 1992, 'Chemistry intro 3', 2, 'P1'),
(79, 'Chemistry Intro 4', 'James Baker', 1993, 'Chemistry intro 4', 2, 'P2'),
(80, 'Chemistry Intro 5', 'James Baker', 1994, 'Chemistry intro 5', 2, 'P2'),
(81, 'English Grammar 1', 'Karen Turner', 1980, 'Grammar lessons 1', 1, 'Q1'),
(82, 'English Grammar 2', 'Karen Turner', 1981, 'Grammar lessons 2', 1, 'Q1'),
(83, 'English Grammar 3', 'Karen Turner', 1982, 'Grammar lessons 3', 1, 'Q1'),
(84, 'English Grammar 4', 'Karen Turner', 1983, 'Grammar lessons 4', 1, 'Q2'),
(85, 'English Grammar 5', 'Karen Turner', 1984, 'Grammar lessons 5', 1, 'Q2'),
(86, 'Music Theory 1', 'Liam Moore', 1975, 'Music theory basics 1', 4, 'R1'),
(87, 'Music Theory 2', 'Liam Moore', 1976, 'Music theory basics 2', 4, 'R1'),
(88, 'Music Theory 3', 'Liam Moore', 1977, 'Music theory basics 3', 4, 'R1'),
(89, 'Music Theory 4', 'Liam Moore', 1978, 'Music theory basics 4', 4, 'R2'),
(90, 'Music Theory 5', 'Liam Moore', 1979, 'Music theory basics 5', 4, 'R2'),
(91, 'Economics 1', 'Mia Rogers', 1990, 'Economics intro 1', 3, 'S1'),
(92, 'Economics 2', 'Mia Rogers', 1991, 'Economics intro 2', 3, 'S1'),
(93, 'Economics 3', 'Mia Rogers', 1992, 'Economics intro 3', 3, 'S1'),
(94, 'Economics 4', 'Mia Rogers', 1993, 'Economics intro 4', 3, 'S2'),
(95, 'Economics 5', 'Mia Rogers', 1994, 'Economics intro 5', 3, 'S2'),
(96, 'Philosophy 1', 'Noah Reed', 1965, 'Philosophy basics 1', 4, 'T1'),
(97, 'Philosophy 2', 'Noah Reed', 1966, 'Philosophy basics 2', 4, 'T1'),
(98, 'Philosophy 3', 'Noah Reed', 1967, 'Philosophy basics 3', 4, 'T1'),
(99, 'Philosophy 4', 'Noah Reed', 1968, 'Philosophy basics 4', 4, 'T2'),
(100, 'Philosophy 5', 'Noah Reed', 1969, 'Philosophy basics 5', 4, 'T2'),
(101, 'Data Structures 1', 'Paul Green', 2015, 'Data structures basics 1', 3, 'U1'),
(102, 'Data Structures 2', 'Paul Green', 2016, 'Data structures basics 2', 3, 'U1'),
(103, 'Data Structures 3', 'Paul Green', 2017, 'Data structures basics 3', 3, 'U1'),
(104, 'Data Structures 4', 'Paul Green', 2018, 'Data structures basics 4', 3, 'U2'),
(105, 'Data Structures 5', 'Paul Green', 2019, 'Data structures basics 5', 3, 'U2'),
(106, 'Machine Learning 1', 'Quinn Foster', 2016, 'ML basics 1', 3, 'V1'),
(107, 'Machine Learning 2', 'Quinn Foster', 2017, 'ML basics 2', 3, 'V1'),
(108, 'Machine Learning 3', 'Quinn Foster', 2018, 'ML basics 3', 3, 'V1'),
(109, 'Machine Learning 4', 'Quinn Foster', 2019, 'ML basics 4', 3, 'V2'),
(110, 'Machine Learning 5', 'Quinn Foster', 2020, 'ML basics 5', 3, 'V2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'test', '$2y$10$URmpk8mgby7Jck7.nhRgROw6NzZkEkmQBuwGwMz.LvuPGCIly0w4W', '2026-01-01 06:10:32'),
(2, 'testtest', '$2y$10$ImZpdMUm9jkFl4NnmL7bNeLcTQfKL6yQB/GgTtw0iOhBNWZYyI/LW', '2026-01-01 06:10:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
