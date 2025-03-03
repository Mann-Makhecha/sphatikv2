-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2025 at 02:12 PM
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
-- Database: `sphatik`
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
-- Table structure for table `instructor_documents`
--

CREATE TABLE `instructor_documents` (
  `doc_id` int(11) NOT NULL,
  `mem_id` int(11) NOT NULL,
  `college_name` varchar(255) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `gov_id_proof` varchar(255) NOT NULL,
  `qualification_proof` varchar(255) NOT NULL,
  `college_id_card` varchar(255) NOT NULL,
  `employment_letter` varchar(255) NOT NULL,
  `latest_payslip` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `mem_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('instructor','local_service_provider','freelancer','user','admin') NOT NULL DEFAULT 'user',
  `status` enum('verified','pending','rejected','submitted') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`mem_id`, `username`, `email`, `address`, `phone`, `password`, `created_at`, `role`, `status`) VALUES
(1, 'mann', 'admin@mail.com', 'street1,city1,state1', '9872365287', '$2y$10$BcZ/qFe7l.LtJoob5ulKQOUpKM7AvBcZSVlf7y2rGY1z8N/aXu7uq', '2025-03-03 12:47:29', 'admin', 'verified'),
(1740753216, 'Samkit', 'samk@gmail.com', 'Khara Kuva No Kha Ho Degham', '9876543210', '$2y$10$n.O8t954e7Ch427lubG8LOYsn3XwJ0u1NnutQnk7I0abea2ICPI7S', '2025-02-28 14:33:37', 'freelancer', 'pending'),
(1740753966, 'Chirag', 'Chirag@gmail.com', 'Khara Kuva No Kha Ho Degham', '1234567890', '$2y$10$j2rY3sBQR4V925gDAIlyrO4CSwWB4094CNqwmd/.qrpDphiIcsXEq', '2025-02-28 14:46:06', 'instructor', 'pending'),
(1740821786, 'Samkit-Jain', 'samkitjain2809@gmail.coms', 'Khara Kuva No Kha Ho Degham', '8200700139', '$2y$10$qbO2fIg4SDRxvFWpM6h1qecLTL2Eh1AZEjoeArADumbn93yeW95Zm', '2025-03-01 09:36:26', 'instructor', 'pending');

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
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

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `created_at`, `address`, `phone`) VALUES
(1740751687, 'Samkit', 'samk@gmail.com', '$2y$10$eijmjrnng9OPYARYSi7ogu.teluAMjO42oJm5ZM2oSm1U3QeYt/72', '2025-02-28 14:08:07', 'Khara Kuva No Kha Ho Degham', '8200700139'),
(1740753364, 'Krish', 'krish@mail.com', '$2y$10$hGKkSE7fg/./zKzAZ2KEm.Q/.L58A1eW0bAXUII4pCDiNo1Ain/p2', '2025-02-28 14:36:04', 'Khara Kuva No Kha Ho Degham', '8200700139');

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
-- Indexes for table `instructor_documents`
--
ALTER TABLE `instructor_documents`
  ADD PRIMARY KEY (`doc_id`),
  ADD KEY `mem_id` (`mem_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`mem_id`),
  ADD UNIQUE KEY `email` (`email`);

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
  ADD PRIMARY KEY (`user_id`),
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
-- AUTO_INCREMENT for table `instructor_documents`
--
ALTER TABLE `instructor_documents`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1740848016;

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1740753365;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `freelancer_contacts`
--
ALTER TABLE `freelancer_contacts`
  ADD CONSTRAINT `freelancer_contacts_ibfk_1` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `instructor_documents`
--
ALTER TABLE `instructor_documents`
  ADD CONSTRAINT `instructor_documents_ibfk_1` FOREIGN KEY (`mem_id`) REFERENCES `members` (`mem_id`) ON DELETE CASCADE;

--
-- Constraints for table `service_bookings`
--
ALTER TABLE `service_bookings`
  ADD CONSTRAINT `service_bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_bookings_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
