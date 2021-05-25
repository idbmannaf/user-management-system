-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2021 at 11:35 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `usermanagment`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(2, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feedback` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `replied` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `uid`, `subject`, `feedback`, `created_at`, `replied`) VALUES
(1, 17, 'Test', 'Hello admin', '2021-04-16 18:40:29', 0),
(2, 17, 'sdfds', 'ddsf', '2021-04-16 18:46:20', 0),
(3, 17, 'testing notification', 'testing', '2021-04-16 19:13:27', 0),
(4, 17, 'Just Wow', 'This is Awesome system', '2021-04-17 16:59:07', 0),
(6, 21, 'Hello', 'I Need Help', '2021-04-18 18:46:14', 1),
(7, 21, 'Wowo', 'Great Tecniquers', '2021-04-18 18:49:24', 1),
(8, 21, 'testing', 'OK', '2021-04-18 18:51:11', 1),
(9, 21, 'ddddd', 'ddd', '2021-04-18 18:52:18', 1),
(10, 21, 'Just Nice', 'Really?', '2021-04-18 18:54:38', 1),
(11, 21, 'Good', 'What is that?', '2021-04-18 18:57:45', 1),
(12, 21, 'Lovely', 'Really?', '2021-04-18 18:59:42', 1),
(13, 21, 'ddd', 'dddd', '2021-04-18 19:00:18', 1),
(14, 21, 'Feedback Checking', 'Dear admin,\r\nHow are you', '2021-04-18 19:02:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `uid`, `title`, `note`, `created_at`, `updated_at`) VALUES
(1, 17, 'Python', 'Python is an interpreted, high-level and general-purpose programming language. Python\'s design philosophy emphasizes code readability with its notable use of significant indentation.', '2021-04-13 19:56:53', '2021-04-16 18:04:03'),
(2, 17, 'JavaScript', 'JavaScript, often abbreviated as JS, is a programming language that conforms to the ECMAScript specification. JavaScript is high-level, often just-in-time compiled, and multi-paradigm. It has curly-bracket syntax, dynamic typing, prototype-based object-orientation, and first-class functions.', '2021-04-13 20:01:23', '2021-04-16 18:04:09'),
(3, 17, 'PHP 8', 'PHP is a general-purpose scripting language especially suited to web development. It was originally created by Danish-Canadian programmer Rasmus Lerdorf in 1994. The PHP reference implementation is now produced by The PHP Group', '2021-04-13 20:01:58', '2021-04-16 18:04:19'),
(4, 17, 'Java', 'Java is a class-based, object-oriented programming language that is designed to have as few implementation dependencies as possible. It is a general-purpose programming language intended to let application developers write once, run anywhere (WORA),[16] meaning that compiled Java code can run on all platforms that support Java without the need for recompilation.[17] Java applications are typically compiled to bytecode that can run on any Java virtual machine (JVM) regardless of the underlying computer architecture. The syntax of Java is similar to C and C++, but has fewer low-level facilities than either of them. The Java runtime provides dynamic capabilities (such as reflection and runtime code modification) that are typically not available in traditional compiled languages. As of 2019, Java was one of the most popular programming languages in use according to GitHub,[18][19] particularly for client-server web applications, with a reported 9 million developers.[20]', '2021-04-13 20:02:23', '2021-04-16 18:04:44'),
(5, 17, 'WordPress', 'WordPress is a free and open-source content management system written in PHP and paired with a MySQL or MariaDB database. Features include a plugin architecture and a template system, referred to within WordPress as Themes', '2021-04-13 20:13:19', '2021-04-16 18:04:44'),
(6, 17, 'Test', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2021-04-13 20:38:05', '2021-04-16 18:04:44'),
(8, 17, 'C#', 'C# is a general-purpose, multi-paradigm programming language encompassing static typing, strong typing, lexically scoped, imperative, declarative, functional, generic, object-oriented', '2021-04-13 21:28:16', '2021-04-16 19:06:49'),
(13, 17, 'C++', 'C++ is a general-purpose programming language created by Bjarne Stroustrup as an extension of the C programming language, or \"C with Classes\".', '2021-04-13 21:36:07', '2021-04-16 18:04:44'),
(19, 17, 'add New Note', 'New Note Added', '2021-04-16 19:04:52', '2021-04-16 19:04:52'),
(20, 22, 'I am Alisha', 'Hi I am alisha', '2021-04-17 20:55:02', '2021-04-17 20:55:02'),
(21, 21, 'Room Rent', '$1800', '2021-04-18 15:59:02', '2021-04-18 15:59:02'),
(23, 21, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy', 'Where does it come from?\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', '2021-04-18 17:08:24', '2021-04-18 17:08:24'),
(24, 21, 'Cicero are also reproduced', '<b>Hello</b>\r\nWhere does it come from?\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', '2021-04-18 17:09:14', '2021-04-18 17:14:37'),
(25, 21, 'Gash Bill', 'Total Gash Bill In This Month $500 \r\nNext Bill Comming', '2021-04-18 20:00:35', '2021-04-18 20:01:08');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `msg` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `uid`, `type`, `msg`, `created_at`) VALUES
(14, 17, 'user', 'Hello Dear, Welcome To User Management System', '2021-04-16 21:23:31'),
(42, 21, 'user', 'I am fine. Thanks for Asking', '2021-04-18 19:02:50'),
(43, 21, 'admin', 'Note Added', '2021-04-18 20:00:35'),
(44, 21, 'admin', 'Note Updated', '2021-04-18 20:01:08'),
(45, 23, 'admin', 'Profile Updated', '2021-04-18 20:48:44'),
(46, 23, 'admin', 'Profile Updated', '2021-04-18 20:50:04'),
(47, 23, 'admin', 'Profile Updated', '2021-04-18 20:50:37'),
(48, 23, 'admin', 'Profile Updated', '2021-04-18 20:50:39'),
(49, 23, 'admin', 'Profile Updated', '2021-04-18 20:50:39'),
(50, 23, 'admin', 'Profile Updated', '2021-04-18 20:55:09'),
(51, 23, 'admin', 'Profile Updated', '2021-04-18 20:58:17'),
(52, 23, 'admin', 'Profile Updated', '2021-04-18 20:58:31'),
(53, 23, 'admin', 'Profile Updated', '2021-04-18 20:58:46'),
(54, 23, 'admin', 'Profile Updated', '2021-04-18 20:58:52'),
(55, 23, 'admin', 'Profile Updated', '2021-04-18 21:00:16'),
(56, 23, 'admin', 'Profile Updated', '2021-04-18 21:00:34'),
(57, 23, 'admin', 'Profile Updated', '2021-04-18 21:00:54'),
(58, 23, 'admin', 'Profile Updated', '2021-04-18 21:01:48'),
(59, 23, 'admin', 'Profile Updated', '2021-04-18 21:02:53'),
(60, 23, 'admin', 'Profile Updated', '2021-04-18 21:03:02'),
(61, 23, 'admin', 'Profile Updated', '2021-04-18 21:03:47'),
(62, 23, 'admin', 'Profile Updated', '2021-04-18 21:03:59'),
(63, 23, 'admin', 'Profile Updated', '2021-04-18 21:05:18'),
(64, 23, 'admin', 'Profile Updated', '2021-04-18 21:06:06'),
(65, 23, 'admin', 'Profile Updated', '2021-04-18 21:06:46'),
(66, 23, 'admin', 'Profile Updated', '2021-04-18 21:06:53'),
(67, 23, 'admin', 'Profile Updated', '2021-04-18 21:07:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token_expire` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `crated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `verified` tinyint(4) NOT NULL DEFAULT 0,
  `deleted` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `gender`, `dob`, `photo`, `token`, `token_expire`, `crated_at`, `verified`, `deleted`) VALUES
(17, 'Mannaf Ali', 'idbmannaf@gmail.com', '$2y$10$B6Oc6PdZd4KbEGB.MBoXYuEITIEVAEX.4ZXD3ghRiWvFLNbAkuYQ2', '01744508287', 'Male', '1993-06-08', 'uploads/683bf15f-27c8-433e-ac2a-b3444f1145dd.jpg', '', '2021-04-17 17:31:44', '2021-04-16 17:45:07', 1, 1),
(18, 'Mannfa', 'mannaf444@gmail.com', '$2y$10$jqEtezpY1GhDZIuqthwyn.r94zM7zvhQ98sIFS8o1Dc6V16MGlaeW', '', '', '', '', '', '2021-04-17 16:46:14', '2021-04-17 16:46:14', 0, 1),
(19, 'ddd', 'dddd@gmail.com', '45', '01745689', 'Female', '20', '', '', '2021-04-18 18:44:56', '2021-04-17 17:30:50', 1, 0),
(20, 'Andrea', 'andrea@gmail.com', '$2y$10$n3CaobR2ikQZt5l7YBJR/urkCSqbmU3hQdKc6T0nsAzJQ.PH5kdrS', '', '', '', '', '', '2021-04-18 18:44:47', '2021-04-17 20:39:26', 1, 0),
(21, 'Andrea', 'abdemannafb@gmail.com', '$2y$10$NhQFc/casNfZpUZbrXky0enZNb8tVlb5Y4.t4q8iSSRWDv/jkSCNa', '01788542587', 'Male', '2010-06-18', 'uploads/mandy.jpg', '', '2021-04-18 18:46:00', '2021-04-17 20:39:45', 1, 1),
(22, 'Alisa', 'alisha@gmail.com', '$2y$10$7adiq.4fTahqGWxeVUnlqOpkAVka.DHtgJ1TG2FvVjxh9iMY2njaC', '0258745874', 'Female', '2002-01-29', 'uploads/mic.jpg', '', '2021-04-17 20:56:40', '2021-04-17 20:54:36', 1, 1),
(23, 'antonyd', 'antony@gmail.com', '$2y$10$ROjWkxadKYfd5h.YYoHzx.6qHJs0kl30SEyYXNOhfXL4ZJo/7Wz2q', '5874558', 'Female', '2021-04-01', 'uploads/download.png', '', '2021-04-18 21:09:57', '2021-04-18 20:24:43', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(2) NOT NULL,
  `hits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `hits`) VALUES
(0, 27);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
