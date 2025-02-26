-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2025 at 05:20 PM
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
-- Database: `user_auth_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `enroll_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`, `image`, `created_at`, `enroll_link`) VALUES
(1, 'Web Development', 'Learn the fundamentals of web development.', 'C:\\xampp\\htdocs\\sphatikv2\\includes\\images\\python.jpg', '2025-02-14 17:29:24', '#'),
(2, 'Python', 'Pyhtin Course to Levitate your Skills', 'C:\\xampp\\htdocs\\sphatikv2\\includes\\images\\python.jpg', '2025-02-15 03:51:32', '#'),
(3, 'Python', 'Pyhtin Course to Levitate your Skills', 'C:\\xampp\\htdocs\\sphatikv2\\includes\\images\\python.jpg', '2025-02-15 03:52:37', '#'),
(4, 'DATA STRUCTURE', '...', 'C:\\xampp\\htdocs\\sphatikv2\\includes\\images\\python.jpg', '2025-02-15 05:42:57', 'https://youtu.be/5_5oE5lgrhw?si=dRLZtMzYMjhfwE2p');

-- --------------------------------------------------------

--
-- Table structure for table `freelancers`
--

CREATE TABLE `freelancers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `expertise` varchar(255) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `contact_link` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `freelancers`
--

INSERT INTO `freelancers` (`id`, `name`, `expertise`, `profile_image`, `contact_link`, `created_at`) VALUES
(1, 'Alice Williams', 'UI/UX Designer', 'uploads/alice-williams.jpg', 'contact_freelance.php\r\n', '2025-02-14 17:45:03'),
(2, 'David Brown', 'Full-Stack Developer', 'uploads/david-brown.jpg', 'https://example.com/david', '2025-02-14 17:45:43'),
(3, 'mann', 'App Developer', '#', 'mailto:mail@mail.com', '2025-02-15 03:59:54'),
(4, 'aryan', 'MERN Stack Developer', '#', '#', '2025-02-15 04:00:40');

-- --------------------------------------------------------

--
-- Table structure for table `freelancer_contacts`
--

CREATE TABLE `freelancer_contacts` (
  `id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `freelancer_contacts`
--

INSERT INTO `freelancer_contacts` (`id`, `freelancer_id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 1, 'mann', 'mann@mail.ocm', 'need help', '2025-02-15 03:00:47');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('instructor','local_service_provider','freelancer','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `username`, `email`, `password`, `created_at`, `role`) VALUES
(1740496778, 'Samkit', 'alooooo@gmail.com', '$2y$10$omzbY1mcFYq7O/VxwCgZsuhvH7RpxpF40J46Fac1sJ1xlNbA5Rcui', '2025-02-25 15:19:38', 'freelancer');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `service_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `icon`, `created_at`, `service_link`) VALUES
(1, 'Plumbing', 'Expert plumbing services for repairs and installations.', 'fas fa-wrench', '2025-02-15 02:21:27', ''),
(2, 'Electrician', 'Certified electricians for home and office.', 'fas fa-bolt', '2025-02-15 02:21:27', ''),
(3, 'Car Repair', 'Reliable car repair and maintenance services.', 'fas fa-car', '2025-02-15 02:21:27', '');

-- --------------------------------------------------------

--
-- Table structure for table `service_bookings`
--

CREATE TABLE `service_bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_bookings`
--

INSERT INTO `service_bookings` (`id`, `user_id`, `service_id`, `name`, `email`, `phone`, `address`, `booking_date`) VALUES
(1, 1, 1, 'mann', 'mann@mail.com', '977795522', 'abc', '2025-02-15 04:26:05'),
(2, 1, 2, 'mann', 'mann@mail.com', '4569872145', 'ggj', '2025-02-15 04:56:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `address` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `address`, `phone`) VALUES
(1, 'mann', 'mann@mail.com', '$2y$10$VXzzsFLMf3GNtxmO80u.NORkRi1l.U9G6V3vG7v0UzT57mvfLF3da', '2025-02-14 15:52:32', '', ''),
(2, 'dhiraj', 'dhiraj@mail.com', '$2y$10$jwUDZ75EXH2fpVPSGOJNxun8UnTFp0fAonAZNaT7cddMNRHcv7p76', '2025-02-15 02:42:53', '', ''),
(4, 'Samkit', 'sam@gmail.com', '$2y$10$XxepoaMl8UhPYP3wBztw4.jk2Z5Ff9pZ3upDnOpiYLgGQ9eLr6amC', '2025-02-26 10:16:34', '', ''),
(5, 'Krish', 'Krish@gmail.com', '$2y$10$L5v7LLCK5KZwsVYRN73U0.sE.aV925apJQIQ67ae.3y3Uyd/DH2Q2', '2025-02-26 15:37:22', 'Khara Kuva No Khancho Ahmedabad', '8200700139');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `freelancers`
--
ALTER TABLE `freelancers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `freelancer_contacts`
--
ALTER TABLE `freelancer_contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `freelancer_id` (`freelancer_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_bookings`
--
ALTER TABLE `service_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `freelancers`
--
ALTER TABLE `freelancers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `freelancer_contacts`
--
ALTER TABLE `freelancer_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `service_bookings`
--
ALTER TABLE `service_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `freelancer_contacts`
--
ALTER TABLE `freelancer_contacts`
  ADD CONSTRAINT `freelancer_contacts_ibfk_1` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_bookings`
--
ALTER TABLE `service_bookings`
  ADD CONSTRAINT `service_bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_bookings_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
