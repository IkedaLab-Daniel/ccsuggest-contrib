-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 06, 2025 at 02:54 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ccsuggest`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_08_19_000000_create_tech_fields_table', 1),
(6, '2025_08_20_000000_create_questions_table', 1),
(7, '2025_08_20_010000_create_question_options_table', 1),
(8, '2025_09_19_134707_add_dynamic_fields_to_questions_table', 2),
(9, '2025_09_22_161243_create_universities_table', 3),
(10, '2025_10_31_163854_add_soft_deletes_to_users_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('ice@music.com', '$2y$10$6yEaN5q81EzMLE/Xcb/K4eicLcyAerkInIVOKUeA2G6S4dYYM5RC.', '2025-08-23 11:00:49'),
('weboracle.business@gmail.com', '$2y$10$CzgiDR6X2qVPhud64KkfdeRYnoA3nxasT.v/h0/T5Czuqdl931wYy', '2025-08-23 12:00:25');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `text` varchar(255) NOT NULL,
  `source` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tech_field_id` tinyint(3) UNSIGNED DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT 1,
  `tech_field_weights` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tech_field_weights`)),
  `depends_on_question_id` int(11) DEFAULT NULL,
  `depends_on_answer` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `scoring_rules` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `text`, `source`, `type`, `created_at`, `updated_at`, `tech_field_id`, `priority`, `tech_field_weights`, `depends_on_question_id`, `depends_on_answer`, `is_active`, `scoring_rules`) VALUES
(1, 'Which activity excites you the most?', 'OECD Future of Skills, 2021', 'single', '2025-09-10 06:06:03', '2025-09-09 22:27:45', 1, 1, NULL, NULL, NULL, 1, NULL),
(2, 'How would you like to contribute in a project?', 'Springer Career Surveys in Tech, 2022', 'single', '2025-09-10 06:06:03', '2025-09-21 03:57:00', 6, 1, NULL, NULL, NULL, 1, NULL),
(3, 'Which type of problems interest you the most?', 'IEEE Emerging Fields, 2020', 'single', '2025-09-10 06:06:03', '2025-09-21 03:57:08', 4, 1, NULL, NULL, NULL, 1, NULL),
(4, 'Which environment do you see yourself working in?', 'IEEE Careers in Computing, 2021', 'single', '2025-09-10 06:06:03', '2025-09-21 03:57:12', 7, 1, NULL, NULL, NULL, 1, NULL),
(5, 'What motivates you the most in tech?', 'Towards Data Science – Career Quizzes, 2023', 'single', '2025-09-10 06:06:03', '2025-09-21 03:57:23', 2, 1, NULL, NULL, NULL, 1, NULL),
(6, 'How do you prefer to apply your skills?', 'ACM Computing Surveys, 2020', 'single', '2025-09-10 06:06:03', '2025-09-09 22:27:59', 10, 1, NULL, NULL, NULL, 1, NULL),
(7, 'Which of these tools would you enjoy mastering?', 'IEEE Access – Developer Skills, 2021', 'single', '2025-09-10 06:06:03', '2025-09-09 22:28:01', 1, 1, NULL, NULL, NULL, 1, NULL),
(8, 'Which project would you rather work on?', 'OECD Skills for Future Careers, 2021', 'single', '2025-09-10 06:06:03', '2025-09-21 03:57:45', 8, 1, NULL, NULL, NULL, 1, NULL),
(9, 'What kind of innovation excites you most?', 'IEEE Technology Trends, 2022', 'single', '2025-09-10 06:06:03', '2025-09-09 22:28:06', 1, 1, NULL, NULL, NULL, 1, NULL),
(10, 'How do you approach problem-solving?', 'Springer Dynamic Questionnaires, 2022', 'single', '2025-09-10 06:06:03', '2025-09-21 03:58:01', 4, 1, NULL, NULL, NULL, 1, NULL),
(11, 'What excites you most about AI?', 'IEEE AI Trends, 2021', 'single', '2025-09-10 06:07:34', '2025-09-09 22:28:14', 1, 1, NULL, NULL, NULL, 1, NULL),
(12, 'Which AI concept do you want to learn?', 'ACM AI Education Report, 2022', 'single', '2025-09-10 06:07:34', '2025-09-09 22:28:10', 1, 1, NULL, NULL, NULL, 1, NULL),
(13, 'What project would you like to do in AI?', 'Springer AI Applications, 2020', 'single', '2025-09-10 06:07:34', '2025-09-09 22:28:16', 1, 1, NULL, NULL, NULL, 1, NULL),
(14, 'Which AI tool would you use?', 'IEEE Access – AI Tools, 2021', 'single', '2025-09-10 06:07:34', '2025-09-09 22:28:18', 1, 1, NULL, NULL, NULL, 1, NULL),
(15, 'What’s most important in AI projects?', 'AI Journal, 2022', 'single', '2025-09-10 06:07:34', '2025-09-09 22:28:20', 1, 1, NULL, NULL, NULL, 1, NULL),
(16, 'Which sector do you see AI being useful in?', 'OECD Future of AI, 2021', 'single', '2025-09-10 06:07:34', '2025-09-09 22:28:26', 1, 1, NULL, NULL, NULL, 1, NULL),
(17, 'What’s your favorite area in cybersecurity?', 'IEEE Cybersecurity Careers, 2021', 'single', '2025-09-10 06:08:05', '2025-09-21 00:58:31', 2, 1, NULL, NULL, NULL, 1, NULL),
(18, 'What tool would you prefer using?', 'ACM Security Tools Review, 2020', 'single', '2025-09-10 06:08:05', '2025-09-21 00:58:44', 2, 1, NULL, NULL, NULL, 1, NULL),
(19, 'Which problem excites you more?', 'Springer Cybersecurity Challenges, 2022', 'single', '2025-09-10 06:08:05', '2025-09-21 00:58:57', 2, 1, NULL, NULL, NULL, 1, NULL),
(20, 'Which cybersecurity role fits you?', 'IEEE Security Careers, 2021', 'single', '2025-09-10 06:08:05', '2025-09-21 00:59:11', 2, 1, NULL, NULL, NULL, 1, NULL),
(21, 'What’s the biggest threat today?', 'ACM Security Trends, 2021', 'single', '2025-09-10 06:08:05', '2025-09-21 00:59:19', 2, 1, NULL, NULL, NULL, 1, NULL),
(22, 'How would you secure a system?', 'IEEE Access – Cybersecurity, 2022', 'single', '2025-09-10 06:08:05', '2025-09-21 00:59:53', 2, 1, NULL, NULL, NULL, 1, NULL),
(23, 'What interests you in cloud computing?', 'IEEE Cloud Careers, 2020', 'single', '2025-09-10 06:10:24', '2025-09-21 00:55:30', 7, 1, NULL, NULL, NULL, 1, NULL),
(24, 'Which provider would you prefer?', 'Gartner Cloud Report, 2021', 'single', '2025-09-10 06:10:24', '2025-09-21 01:03:11', 7, 1, NULL, NULL, NULL, 1, NULL),
(25, 'What’s most important in cloud solutions?', 'Springer Cloud Computing, 2022', 'single', '2025-09-10 06:10:24', '2025-09-10 06:30:08', 6, 1, NULL, NULL, NULL, 1, NULL),
(26, 'Which role fits you in cloud?', 'IEEE Cloud Careers, 2021', 'single', '2025-09-10 06:10:24', '2025-09-21 01:03:37', 7, 1, NULL, NULL, NULL, 1, NULL),
(27, 'Which task excites you more?', 'ACM Cloud Trends, 2022', 'single', '2025-09-10 06:10:24', '2025-09-21 01:03:47', 7, 1, NULL, NULL, NULL, 1, NULL),
(28, 'What kind of cloud service would you like to manage?', 'IEEE Cloud Models, 2020', 'single', '2025-09-10 06:10:24', '2025-09-21 01:03:56', 7, 1, NULL, NULL, NULL, 1, NULL),
(29, 'What excites you in data science?', 'Springer Data Science, 2021', 'single', '2025-09-10 06:10:24', '2025-09-21 01:04:38', 3, 1, NULL, NULL, NULL, 1, NULL),
(30, 'Which tool would you like to use?', 'ACM Data Tools, 2021', 'single', '2025-09-10 06:10:24', '2025-09-21 01:04:50', 3, 1, NULL, NULL, NULL, 1, NULL),
(31, 'Which project sounds fun?', 'IEEE Data Science Projects, 2022', 'single', '2025-09-10 06:10:24', '2025-09-21 01:05:00', 3, 1, NULL, NULL, NULL, 1, NULL),
(32, 'What’s most important in data work?', 'Data Science Journal, 2020', 'single', '2025-09-10 06:10:24', '2025-09-21 01:05:08', 3, 1, NULL, NULL, NULL, 1, NULL),
(33, 'Which role do you like best?', 'OECD Careers in Data, 2022', 'single', '2025-09-10 06:10:24', '2025-09-21 01:05:20', 3, 1, NULL, NULL, NULL, 1, NULL),
(34, 'Where would you apply data science?', 'IEEE Big Data Trends, 2021', 'single', '2025-09-10 06:10:24', '2025-09-10 06:30:08', 4, 1, NULL, NULL, NULL, 1, NULL),
(35, 'What part of game dev excites you?', 'ACM Game Dev Careers, 2021', 'single', '2025-09-10 06:11:32', '2025-09-21 01:05:45', 5, 1, NULL, NULL, NULL, 1, NULL),
(36, 'Which engine would you use?', 'IEEE Game Engines, 2022', 'single', '2025-09-10 06:11:32', '2025-09-21 01:05:53', 5, 1, NULL, NULL, NULL, 1, NULL),
(37, 'Which game type do you prefer to build?', 'Game Development Report, 2020', 'single', '2025-09-10 06:11:32', '2025-09-21 01:06:05', 5, 1, NULL, NULL, NULL, 1, NULL),
(38, 'What matters most in game dev?', 'ACM Game Design, 2021', 'single', '2025-09-10 06:11:32', '2025-09-21 01:06:13', 5, 1, NULL, NULL, NULL, 1, NULL),
(39, 'Which role would you like?', 'IEEE Game Careers, 2020', 'single', '2025-09-10 06:11:32', '2025-09-21 01:06:25', 5, 1, NULL, NULL, NULL, 1, NULL),
(40, 'Where do you see yourself working?', 'Game Dev Trends, 2022', 'single', '2025-09-10 06:11:32', '2025-09-21 01:06:43', 5, 1, NULL, NULL, NULL, 1, NULL),
(41, 'What excites you in design?', NULL, 'single', '2025-09-10 06:13:30', '2025-09-10 06:30:08', 11, 1, NULL, NULL, NULL, 1, NULL),
(42, 'Which tool would you prefer?', NULL, 'single', '2025-09-10 06:13:30', '2025-09-10 06:30:08', 11, 1, NULL, NULL, NULL, 1, NULL),
(43, 'What’s most important in UX?', NULL, 'single', '2025-09-10 06:13:30', '2025-09-10 06:30:08', 11, 1, NULL, NULL, NULL, 1, NULL),
(44, 'Which project excites you more?', NULL, 'single', '2025-09-10 06:13:30', '2025-09-10 06:30:08', 11, 1, NULL, NULL, NULL, 1, NULL),
(45, 'Which role suits you?', NULL, 'single', '2025-09-10 06:13:30', '2025-09-10 06:30:08', 11, 1, NULL, NULL, NULL, 1, NULL),
(46, 'Which principle matters most to you?', NULL, 'single', '2025-09-10 06:13:30', '2025-09-10 06:30:08', 11, 1, NULL, NULL, NULL, 1, NULL),
(47, 'What project excites you in IoT?', NULL, 'single', '2025-09-10 06:14:41', '2025-09-21 01:08:03', 8, 1, NULL, NULL, NULL, 1, NULL),
(48, 'Which IoT protocol would you prefer to learn?', NULL, 'single', '2025-09-10 06:14:41', '2025-09-21 01:08:12', 8, 1, NULL, NULL, NULL, 1, NULL),
(49, 'Which IoT concern matters most?', NULL, 'single', '2025-09-10 06:14:41', '2025-09-21 01:08:45', 8, 1, NULL, NULL, NULL, 1, NULL),
(50, 'What excites you most in IoT development?', NULL, 'single', '2025-09-10 06:14:41', '2025-09-21 01:08:53', 8, 1, NULL, NULL, NULL, 1, NULL),
(51, 'Which IoT application would you build?', NULL, 'single', '2025-09-10 06:14:41', '2025-09-21 01:09:04', 8, 1, NULL, NULL, NULL, 1, NULL),
(52, 'Which skill do you want in IoT?', NULL, 'single', '2025-09-10 06:14:41', '2025-09-21 01:09:11', 8, 1, NULL, NULL, NULL, 1, NULL),
(53, 'What interests you most in blockchain?', NULL, 'single', '2025-09-10 06:18:36', '2025-09-21 01:10:01', 9, 1, NULL, NULL, NULL, 1, NULL),
(54, 'Which blockchain platform excites you?', NULL, 'single', '2025-09-10 06:18:36', '2025-09-21 01:10:18', 9, 1, NULL, NULL, NULL, 1, NULL),
(55, 'Which skill do you want in blockchain?', NULL, 'single', '2025-09-10 06:18:36', '2025-09-21 01:10:24', 9, 1, NULL, NULL, NULL, 1, NULL),
(56, 'Which blockchain project would you build?', NULL, 'single', '2025-09-10 06:18:36', '2025-09-21 01:10:30', 9, 1, NULL, NULL, NULL, 1, NULL),
(57, 'What matters most in blockchain?', NULL, 'single', '2025-09-10 06:18:36', '2025-09-21 01:10:58', 9, 1, NULL, NULL, NULL, 1, NULL),
(58, 'Which role would you choose?', NULL, 'single', '2025-09-10 06:18:36', '2025-09-21 01:11:16', 9, 1, NULL, NULL, NULL, 1, NULL),
(59, 'What excites you in robotics?', NULL, 'single', '2025-09-10 06:24:11', '2025-09-10 06:30:08', 12, 1, NULL, NULL, NULL, 1, NULL),
(60, 'Which type of robot interests you most?', NULL, 'single', '2025-09-10 06:24:11', '2025-09-10 06:30:08', 12, 1, NULL, NULL, NULL, 1, NULL),
(61, 'Which robotics skill do you want?', NULL, 'single', '2025-09-10 06:24:11', '2025-09-19 20:06:45', 12, 2, NULL, NULL, NULL, 1, NULL),
(62, 'Which project excites you more?', NULL, 'single', '2025-09-10 06:24:11', '2025-09-19 20:06:45', 12, 2, NULL, NULL, NULL, 1, NULL),
(63, 'What’s most important in robotics?', NULL, 'single', '2025-09-10 06:24:11', '2025-09-19 20:06:45', 12, 2, NULL, NULL, NULL, 1, NULL),
(64, 'Where do you see yourself working?', NULL, 'single', '2025-09-10 06:24:11', '2025-09-19 20:06:45', 12, 2, NULL, NULL, NULL, 1, NULL),
(65, 'Which part of software development excites you most?', NULL, 'single', '2025-09-10 06:26:14', '2025-09-19 20:06:45', 13, 2, NULL, NULL, NULL, 1, NULL),
(66, 'Which programming language would you focus on?', NULL, 'single', '2025-09-10 06:26:14', '2025-09-19 20:06:45', 13, 3, NULL, NULL, NULL, 1, NULL),
(67, 'When developing software, which part interests you the most?', NULL, 'single', '2025-09-10 06:26:14', '2025-09-19 20:06:45', 13, 3, NULL, NULL, NULL, 1, NULL),
(68, 'What type of software project would you enjoy working on?', NULL, 'single', '2025-09-10 06:26:14', '2025-09-19 20:06:45', 13, 3, NULL, NULL, NULL, 1, NULL),
(69, 'Which skill do you want to strengthen as a developer?', NULL, 'single', '2025-09-10 06:26:14', '2025-09-19 20:06:45', 13, 3, NULL, NULL, NULL, 1, NULL),
(70, 'How do you measure success in a software project?', NULL, 'single', '2025-09-10 06:26:14', '2025-09-19 20:06:45', 13, 3, NULL, NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `question_options`
--

CREATE TABLE `question_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `text` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question_options`
--

INSERT INTO `question_options` (`id`, `question_id`, `value`, `text`, `created_at`, `updated_at`) VALUES
(97, 25, '0', 'Scalability', '2025-09-10 06:10:32', '2025-09-10 06:38:25'),
(98, 25, '1', 'Security', '2025-09-10 06:10:32', '2025-09-10 06:38:26'),
(99, 25, '2', 'Performance', '2025-09-10 06:10:32', '2025-09-10 06:38:26'),
(100, 25, '3', 'Reliability', '2025-09-10 06:10:32', '2025-09-10 06:38:26'),
(133, 34, '0', 'Finance', '2025-09-10 06:10:33', '2025-09-10 06:38:25'),
(134, 34, '1', 'Healthcare', '2025-09-10 06:10:33', '2025-09-10 06:38:26'),
(135, 34, '2', 'Marketing', '2025-09-10 06:10:33', '2025-09-10 06:38:26'),
(136, 34, '3', 'Sports', '2025-09-10 06:10:33', '2025-09-10 06:38:26'),
(161, 41, '0', 'Wireframing', '2025-09-10 06:13:38', '2025-09-10 06:38:25'),
(162, 41, '1', 'Prototyping', '2025-09-10 06:13:38', '2025-09-10 06:38:26'),
(163, 41, '2', 'Usability testing', '2025-09-10 06:13:38', '2025-09-10 06:38:26'),
(164, 41, '3', 'Visual design', '2025-09-10 06:13:38', '2025-09-10 06:38:26'),
(165, 42, '0', 'Figma', '2025-09-10 06:13:38', '2025-09-10 06:38:25'),
(166, 42, '1', 'Adobe XD', '2025-09-10 06:13:38', '2025-09-10 06:38:26'),
(167, 42, '2', 'Sketch', '2025-09-10 06:13:38', '2025-09-10 06:38:26'),
(168, 42, '3', 'InVision', '2025-09-10 06:13:38', '2025-09-10 06:38:26'),
(169, 43, '0', 'Accessibility', '2025-09-10 06:13:38', '2025-09-10 06:38:25'),
(170, 43, '1', 'Ease of use', '2025-09-10 06:13:38', '2025-09-10 06:38:26'),
(171, 43, '2', 'Aesthetics', '2025-09-10 06:13:38', '2025-09-10 06:38:26'),
(172, 43, '3', 'Speed', '2025-09-10 06:13:38', '2025-09-10 06:38:26'),
(173, 44, '0', 'Mobile app design', '2025-09-10 06:13:38', '2025-09-10 06:38:25'),
(174, 44, '1', 'Web app design', '2025-09-10 06:13:38', '2025-09-10 06:38:26'),
(175, 44, '2', 'VR interface', '2025-09-10 06:13:38', '2025-09-10 06:38:26'),
(176, 44, '3', 'Smart device UI', '2025-09-10 06:13:38', '2025-09-10 06:38:26'),
(177, 45, '0', 'UX researcher', '2025-09-10 06:13:38', '2025-09-10 06:38:25'),
(178, 45, '1', 'UI designer', '2025-09-10 06:13:38', '2025-09-10 06:38:26'),
(179, 45, '2', 'Interaction designer', '2025-09-10 06:13:38', '2025-09-10 06:38:26'),
(180, 45, '3', 'UX writer', '2025-09-10 06:13:38', '2025-09-10 06:38:26'),
(181, 46, '0', 'Consistency', '2025-09-10 06:13:38', '2025-09-10 06:38:25'),
(182, 46, '1', 'Feedback', '2025-09-10 06:13:38', '2025-09-10 06:38:26'),
(183, 46, '2', 'Learnability', '2025-09-10 06:13:38', '2025-09-10 06:38:26'),
(184, 46, '3', 'Efficiency', '2025-09-10 06:13:38', '2025-09-10 06:38:26'),
(233, 59, '0', 'Building robots', '2025-09-10 06:24:11', '2025-09-10 06:38:25'),
(234, 59, '1', 'Programming robots', '2025-09-10 06:24:11', '2025-09-10 06:38:26'),
(235, 59, '2', 'Using AI in robots', '2025-09-10 06:24:11', '2025-09-10 06:38:26'),
(236, 59, '3', 'Testing robots', '2025-09-10 06:24:11', '2025-09-10 06:38:26'),
(237, 60, '0', 'Industrial robots', '2025-09-10 06:24:11', '2025-09-10 06:38:25'),
(238, 60, '1', 'Service robots', '2025-09-10 06:24:11', '2025-09-10 06:38:26'),
(239, 60, '2', 'Medical robots', '2025-09-10 06:24:11', '2025-09-10 06:38:26'),
(240, 60, '3', 'Autonomous vehicles', '2025-09-10 06:24:11', '2025-09-10 06:38:26'),
(241, 61, '0', 'Embedded systems', '2025-09-10 06:24:11', '2025-09-10 06:38:25'),
(242, 61, '1', 'Control systems', '2025-09-10 06:24:11', '2025-09-10 06:38:26'),
(243, 61, '2', 'AI integration', '2025-09-10 06:24:11', '2025-09-10 06:38:26'),
(244, 61, '3', 'Mechanical design', '2025-09-10 06:24:11', '2025-09-10 06:38:26'),
(245, 62, '0', 'Drone navigation', '2025-09-10 06:24:11', '2025-09-10 06:38:25'),
(246, 62, '1', 'Warehouse automation', '2025-09-10 06:24:11', '2025-09-10 06:38:26'),
(247, 62, '2', 'Humanoid robots', '2025-09-10 06:24:11', '2025-09-10 06:38:26'),
(248, 62, '3', 'Disaster-response robots', '2025-09-10 06:24:11', '2025-09-10 06:38:26'),
(249, 63, '0', 'Accuracy', '2025-09-10 06:24:11', '2025-09-10 06:38:25'),
(250, 63, '1', 'Safety', '2025-09-10 06:24:11', '2025-09-10 06:38:26'),
(251, 63, '2', 'Efficiency', '2025-09-10 06:24:11', '2025-09-10 06:38:26'),
(252, 63, '3', 'Flexibility', '2025-09-10 06:24:11', '2025-09-10 06:38:26'),
(253, 64, '0', 'Manufacturing', '2025-09-10 06:24:11', '2025-09-10 06:38:25'),
(254, 64, '1', 'Healthcare', '2025-09-10 06:24:11', '2025-09-10 06:38:26'),
(255, 64, '2', 'Research lab', '2025-09-10 06:24:11', '2025-09-10 06:38:26'),
(256, 64, '3', 'Automotive industry', '2025-09-10 06:24:11', '2025-09-10 06:38:26'),
(257, 65, '0', 'Writing backend code', '2025-09-10 06:26:14', '2025-09-10 06:38:25'),
(258, 65, '1', 'Designing frontend features', '2025-09-10 06:26:14', '2025-09-10 06:38:26'),
(259, 65, '2', 'Managing databases', '2025-09-10 06:26:14', '2025-09-10 06:38:26'),
(260, 65, '3', 'Testing applications', '2025-09-10 06:26:14', '2025-09-10 06:38:26'),
(261, 66, '0', 'Java', '2025-09-10 06:26:14', '2025-09-10 06:38:25'),
(262, 66, '1', 'Python', '2025-09-10 06:26:14', '2025-09-10 06:38:26'),
(263, 66, '2', 'JavaScript', '2025-09-10 06:26:14', '2025-09-10 06:38:26'),
(264, 66, '3', 'C#', '2025-09-10 06:26:14', '2025-09-10 06:38:26'),
(265, 67, '0', 'Writing and optimizing backend logic', '2025-09-10 06:26:14', '2025-09-10 06:38:25'),
(266, 67, '1', 'Building user-friendly interfaces', '2025-09-10 06:26:14', '2025-09-10 06:38:26'),
(267, 67, '2', 'Integrating databases with applications', '2025-09-10 06:26:14', '2025-09-10 06:38:26'),
(268, 67, '3', 'Testing and debugging code for reliability', '2025-09-10 06:26:14', '2025-09-10 06:38:26'),
(269, 68, '0', 'Mobile applications for Android/iOS', '2025-09-10 06:26:14', '2025-09-10 06:38:25'),
(270, 68, '1', 'Web platforms and portals', '2025-09-10 06:26:14', '2025-09-10 06:38:26'),
(271, 68, '2', 'Enterprise systems for organizations', '2025-09-10 06:26:14', '2025-09-10 06:38:26'),
(272, 68, '3', 'Open-source community projects', '2025-09-10 06:26:14', '2025-09-10 06:38:26'),
(273, 69, '0', 'Problem-solving through algorithms', '2025-09-10 06:26:14', '2025-09-10 06:38:25'),
(274, 69, '1', 'Writing clean and efficient code', '2025-09-10 06:26:14', '2025-09-10 06:38:26'),
(275, 69, '2', 'Collaborating in a development team', '2025-09-10 06:26:14', '2025-09-10 06:38:26'),
(276, 69, '3', 'Adapting to new frameworks and tools', '2025-09-10 06:26:14', '2025-09-10 06:38:26'),
(277, 70, '0', 'High performance and scalability', '2025-09-10 06:26:14', '2025-09-10 06:38:25'),
(278, 70, '1', 'Great user experience and design', '2025-09-10 06:26:14', '2025-09-10 06:38:26'),
(279, 70, '2', 'Minimal bugs and strong reliability', '2025-09-10 06:26:14', '2025-09-10 06:38:26'),
(280, 70, '3', 'Meeting deadlines and client needs', '2025-09-10 06:26:14', '2025-09-10 06:38:26'),
(321, 12, '0', 'Machine Learning', '2025-09-09 22:28:10', '2025-09-09 22:28:10'),
(322, 12, '1', 'Deep Learning', '2025-09-09 22:28:10', '2025-09-09 22:28:10'),
(323, 12, '2', 'Natural Language Processing', '2025-09-09 22:28:10', '2025-09-09 22:28:10'),
(324, 12, '3', 'Computer Vision', '2025-09-09 22:28:10', '2025-09-09 22:28:10'),
(329, 11, '0', 'Building chatbots', '2025-09-09 22:28:14', '2025-09-09 22:28:14'),
(330, 11, '1', 'Creating recommendation systems', '2025-09-09 22:28:14', '2025-09-09 22:28:14'),
(331, 11, '2', 'Automating tasks', '2025-09-09 22:28:14', '2025-09-09 22:28:14'),
(332, 11, '3', 'Developing self-learning programs', '2025-09-09 22:28:14', '2025-09-09 22:28:14'),
(333, 13, '0', 'Image recognition', '2025-09-09 22:28:16', '2025-09-09 22:28:16'),
(334, 13, '1', 'Speech-to-text app', '2025-09-09 22:28:16', '2025-09-09 22:28:16'),
(335, 13, '2', 'Predictive analytics', '2025-09-09 22:28:16', '2025-09-09 22:28:16'),
(336, 13, '3', 'Smart assistants', '2025-09-09 22:28:16', '2025-09-09 22:28:16'),
(337, 14, '0', 'TensorFlow', '2025-09-09 22:28:18', '2025-09-09 22:28:18'),
(338, 14, '1', 'PyTorch', '2025-09-09 22:28:18', '2025-09-09 22:28:18'),
(339, 14, '2', 'Scikit-learn', '2025-09-09 22:28:18', '2025-09-09 22:28:18'),
(340, 14, '3', 'OpenAI API', '2025-09-09 22:28:18', '2025-09-09 22:28:18'),
(341, 15, '0', 'Accuracy of models', '2025-09-09 22:28:20', '2025-09-09 22:28:20'),
(342, 15, '1', 'Processing speed', '2025-09-09 22:28:20', '2025-09-09 22:28:20'),
(343, 15, '2', 'Large datasets', '2025-09-09 22:28:20', '2025-09-09 22:28:20'),
(344, 15, '3', 'Easy deployment', '2025-09-09 22:28:20', '2025-09-09 22:28:20'),
(345, 16, '0', 'Healthcare', '2025-09-09 22:28:26', '2025-09-09 22:28:26'),
(346, 16, '1', 'Finance', '2025-09-09 22:28:26', '2025-09-09 22:28:26'),
(347, 16, '2', 'Education', '2025-09-09 22:28:26', '2025-09-09 22:28:26'),
(348, 16, '3', 'Transportation', '2025-09-09 22:28:26', '2025-09-09 22:28:26'),
(587, 23, '0', 'Hosting applications', '2025-09-21 00:55:30', '2025-09-21 00:55:30'),
(588, 23, '1', 'Managing virtual servers', '2025-09-21 00:55:30', '2025-09-21 00:55:30'),
(589, 23, '2', 'Cloud security', '2025-09-21 00:55:30', '2025-09-21 00:55:30'),
(590, 23, '3', 'Cost optimization', '2025-09-21 00:55:30', '2025-09-21 00:55:30'),
(591, 17, '0', 'Ethical hacking', '2025-09-21 00:58:31', '2025-09-21 00:58:31'),
(592, 17, '1', 'Network defense', '2025-09-21 00:58:31', '2025-09-21 00:58:31'),
(593, 17, '2', 'Security policy design', '2025-09-21 00:58:31', '2025-09-21 00:58:31'),
(594, 17, '3', 'Digital forensics', '2025-09-21 00:58:31', '2025-09-21 00:58:31'),
(595, 18, '0', 'Wireshark', '2025-09-21 00:58:44', '2025-09-21 00:58:44'),
(596, 18, '1', 'Metasploit', '2025-09-21 00:58:44', '2025-09-21 00:58:44'),
(597, 18, '2', 'Nmap', '2025-09-21 00:58:44', '2025-09-21 00:58:44'),
(598, 18, '3', 'Burp Suite', '2025-09-21 00:58:44', '2025-09-21 00:58:44'),
(599, 19, '0', 'Preventing phishing attacks', '2025-09-21 00:58:57', '2025-09-21 00:58:57'),
(600, 19, '1', 'Securing cloud systems', '2025-09-21 00:58:57', '2025-09-21 00:58:57'),
(601, 19, '2', 'Encrypting sensitive data', '2025-09-21 00:58:57', '2025-09-21 00:58:57'),
(602, 19, '3', 'Detecting malware', '2025-09-21 00:58:57', '2025-09-21 00:58:57'),
(603, 20, '0', 'Penetration tester', '2025-09-21 00:59:11', '2025-09-21 00:59:11'),
(604, 20, '1', 'Security analyst', '2025-09-21 00:59:11', '2025-09-21 00:59:11'),
(605, 20, '2', 'Incident responder', '2025-09-21 00:59:11', '2025-09-21 00:59:11'),
(606, 20, '3', 'SOC engineer', '2025-09-21 00:59:11', '2025-09-21 00:59:11'),
(607, 21, '0', 'Ransomware', '2025-09-21 00:59:19', '2025-09-21 00:59:19'),
(608, 21, '1', 'Data leaks', '2025-09-21 00:59:19', '2025-09-21 00:59:19'),
(609, 21, '2', 'Social engineering', '2025-09-21 00:59:19', '2025-09-21 00:59:19'),
(610, 21, '3', 'Insider threats', '2025-09-21 00:59:19', '2025-09-21 00:59:19'),
(611, 22, '0', 'Regular patching', '2025-09-21 00:59:53', '2025-09-21 00:59:53'),
(612, 22, '1', 'Strong authentication', '2025-09-21 00:59:53', '2025-09-21 00:59:53'),
(613, 22, '2', 'Continuous monitoring', '2025-09-21 00:59:53', '2025-09-21 00:59:53'),
(614, 22, '3', 'Encryption', '2025-09-21 00:59:53', '2025-09-21 00:59:53'),
(615, 24, '0', 'AWS', '2025-09-21 01:03:11', '2025-09-21 01:03:11'),
(616, 24, '1', 'Microsoft Azure', '2025-09-21 01:03:11', '2025-09-21 01:03:11'),
(617, 24, '2', 'Google Cloud', '2025-09-21 01:03:11', '2025-09-21 01:03:11'),
(618, 24, '3', 'IBM Cloud', '2025-09-21 01:03:11', '2025-09-21 01:03:11'),
(619, 26, '0', 'Cloud engineer', '2025-09-21 01:03:37', '2025-09-21 01:03:37'),
(620, 26, '1', 'DevOps engineer', '2025-09-21 01:03:37', '2025-09-21 01:03:37'),
(621, 26, '2', 'Cloud security specialist', '2025-09-21 01:03:37', '2025-09-21 01:03:37'),
(622, 26, '3', 'Cloud architect', '2025-09-21 01:03:37', '2025-09-21 01:03:37'),
(623, 27, '0', 'Setting up CI/CD pipelines', '2025-09-21 01:03:47', '2025-09-21 01:03:47'),
(624, 27, '1', 'Migrating apps to cloud', '2025-09-21 01:03:47', '2025-09-21 01:03:47'),
(625, 27, '2', 'Automating deployments', '2025-09-21 01:03:47', '2025-09-21 01:03:47'),
(626, 27, '3', 'Designing hybrid solutions', '2025-09-21 01:03:47', '2025-09-21 01:03:47'),
(627, 28, '0', 'SaaS', '2025-09-21 01:03:56', '2025-09-21 01:03:56'),
(628, 28, '1', 'PaaS', '2025-09-21 01:03:56', '2025-09-21 01:03:56'),
(629, 28, '2', 'IaaS', '2025-09-21 01:03:56', '2025-09-21 01:03:56'),
(630, 28, '3', 'Serverless', '2025-09-21 01:03:56', '2025-09-21 01:03:56'),
(631, 29, '0', 'Data cleaning', '2025-09-21 01:04:38', '2025-09-21 01:04:38'),
(632, 29, '1', 'Visualization', '2025-09-21 01:04:38', '2025-09-21 01:04:38'),
(633, 29, '2', 'Predictive analytics', '2025-09-21 01:04:38', '2025-09-21 01:04:38'),
(634, 29, '3', 'Building models', '2025-09-21 01:04:38', '2025-09-21 01:04:38'),
(635, 30, '0', 'Python (pandas, NumPy)', '2025-09-21 01:04:50', '2025-09-21 01:04:50'),
(636, 30, '1', 'R', '2025-09-21 01:04:50', '2025-09-21 01:04:50'),
(637, 30, '2', 'SQL', '2025-09-21 01:04:50', '2025-09-21 01:04:50'),
(638, 30, '3', 'Tableau/Power BI', '2025-09-21 01:04:50', '2025-09-21 01:04:50'),
(639, 31, '0', 'Predicting sales trends', '2025-09-21 01:05:00', '2025-09-21 01:05:00'),
(640, 31, '1', 'Analyzing social media data', '2025-09-21 01:05:00', '2025-09-21 01:05:00'),
(641, 31, '2', 'Fraud detection', '2025-09-21 01:05:00', '2025-09-21 01:05:00'),
(642, 31, '3', 'Customer segmentation', '2025-09-21 01:05:00', '2025-09-21 01:05:00'),
(643, 32, '0', 'Accuracy', '2025-09-21 01:05:08', '2025-09-21 01:05:08'),
(644, 32, '1', 'Speed', '2025-09-21 01:05:08', '2025-09-21 01:05:08'),
(645, 32, '2', 'Data quality', '2025-09-21 01:05:08', '2025-09-21 01:05:08'),
(646, 32, '3', 'Visualization clarity', '2025-09-21 01:05:08', '2025-09-21 01:05:08'),
(647, 33, '0', 'Data analyst', '2025-09-21 01:05:20', '2025-09-21 01:05:20'),
(648, 33, '1', 'Data engineer', '2025-09-21 01:05:20', '2025-09-21 01:05:20'),
(649, 33, '2', 'Data scientist', '2025-09-21 01:05:20', '2025-09-21 01:05:20'),
(650, 33, '3', 'Business intelligence developer', '2025-09-21 01:05:20', '2025-09-21 01:05:20'),
(651, 35, '0', 'Coding game mechanics', '2025-09-21 01:05:45', '2025-09-21 01:05:45'),
(652, 35, '1', 'Designing levels', '2025-09-21 01:05:45', '2025-09-21 01:05:45'),
(653, 35, '2', '3D modeling', '2025-09-21 01:05:45', '2025-09-21 01:05:45'),
(654, 35, '3', 'Game testing', '2025-09-21 01:05:45', '2025-09-21 01:05:45'),
(655, 36, '0', 'Unity', '2025-09-21 01:05:53', '2025-09-21 01:05:53'),
(656, 36, '1', 'Unreal Engine', '2025-09-21 01:05:53', '2025-09-21 01:05:53'),
(657, 36, '2', 'Godot', '2025-09-21 01:05:53', '2025-09-21 01:05:53'),
(658, 36, '3', 'CryEngine', '2025-09-21 01:05:53', '2025-09-21 01:05:53'),
(659, 37, '0', 'RPG', '2025-09-21 01:06:05', '2025-09-21 01:06:05'),
(660, 37, '1', 'Shooter', '2025-09-21 01:06:05', '2025-09-21 01:06:05'),
(661, 37, '2', 'Puzzle', '2025-09-21 01:06:05', '2025-09-21 01:06:05'),
(662, 37, '3', 'Simulation', '2025-09-21 01:06:05', '2025-09-21 01:06:05'),
(663, 38, '0', 'Graphics', '2025-09-21 01:06:13', '2025-09-21 01:06:13'),
(664, 38, '1', 'Gameplay', '2025-09-21 01:06:13', '2025-09-21 01:06:13'),
(665, 38, '2', 'Storytelling', '2025-09-21 01:06:13', '2025-09-21 01:06:13'),
(666, 38, '3', 'Performance', '2025-09-21 01:06:13', '2025-09-21 01:06:13'),
(667, 39, '0', 'Gameplay programmer', '2025-09-21 01:06:25', '2025-09-21 01:06:25'),
(668, 39, '1', 'Game designer', '2025-09-21 01:06:25', '2025-09-21 01:06:25'),
(669, 39, '2', 'Technical artist', '2025-09-21 01:06:25', '2025-09-21 01:06:25'),
(670, 39, '3', 'QA tester', '2025-09-21 01:06:25', '2025-09-21 01:06:25'),
(671, 40, '0', 'Indie studio', '2025-09-21 01:06:43', '2025-09-21 01:06:43'),
(672, 40, '1', 'AAA studio', '2025-09-21 01:06:43', '2025-09-21 01:06:43'),
(673, 40, '2', 'Mobile game company', '2025-09-21 01:06:43', '2025-09-21 01:06:43'),
(674, 40, '3', 'VR/AR game company', '2025-09-21 01:06:43', '2025-09-21 01:06:43'),
(675, 47, '0', 'Smart home devices', '2025-09-21 01:08:03', '2025-09-21 01:08:03'),
(676, 47, '1', 'Wearables', '2025-09-21 01:08:03', '2025-09-21 01:08:03'),
(677, 47, '2', 'Smart cities', '2025-09-21 01:08:03', '2025-09-21 01:08:03'),
(678, 47, '3', 'Industrial IoT', '2025-09-21 01:08:03', '2025-09-21 01:08:03'),
(683, 48, '0', 'MQTT', '2025-09-21 01:08:25', '2025-09-21 01:08:25'),
(684, 48, '1', 'CoAP', '2025-09-21 01:08:25', '2025-09-21 01:08:25'),
(685, 48, '2', 'Zigbee', '2025-09-21 01:08:25', '2025-09-21 01:08:25'),
(686, 48, '3', 'LoRaWAN', '2025-09-21 01:08:25', '2025-09-21 01:08:25'),
(687, 49, '0', 'Security', '2025-09-21 01:08:45', '2025-09-21 01:08:45'),
(688, 49, '1', 'Low power consumption', '2025-09-21 01:08:45', '2025-09-21 01:08:45'),
(689, 49, '2', 'Scalability', '2025-09-21 01:08:45', '2025-09-21 01:08:45'),
(690, 49, '3', 'Real-time data', '2025-09-21 01:08:45', '2025-09-21 01:08:45'),
(691, 50, '0', 'Hardware programming', '2025-09-21 01:08:53', '2025-09-21 01:08:53'),
(692, 50, '1', 'Sensor integration', '2025-09-21 01:08:53', '2025-09-21 01:08:53'),
(693, 50, '2', 'Cloud data storage', '2025-09-21 01:08:53', '2025-09-21 01:08:53'),
(694, 50, '3', 'IoT app development', '2025-09-21 01:08:53', '2025-09-21 01:08:53'),
(695, 51, '0', 'Smart farming system', '2025-09-21 01:09:04', '2025-09-21 01:09:04'),
(696, 51, '1', 'Health monitoring device', '2025-09-21 01:09:04', '2025-09-21 01:09:04'),
(697, 51, '2', 'Traffic control system', '2025-09-21 01:09:04', '2025-09-21 01:09:04'),
(698, 51, '3', 'Connected cars', '2025-09-21 01:09:04', '2025-09-21 01:09:04'),
(699, 52, '0', 'Embedded systems', '2025-09-21 01:09:11', '2025-09-21 01:09:11'),
(700, 52, '1', 'Networking', '2025-09-21 01:09:11', '2025-09-21 01:09:11'),
(701, 52, '2', 'Data analytics', '2025-09-21 01:09:11', '2025-09-21 01:09:11'),
(702, 52, '3', 'Security design', '2025-09-21 01:09:11', '2025-09-21 01:09:11'),
(703, 53, '0', 'Cryptocurrency', '2025-09-21 01:10:01', '2025-09-21 01:10:01'),
(704, 53, '1', 'Smart contracts', '2025-09-21 01:10:01', '2025-09-21 01:10:01'),
(705, 53, '2', 'NFTs', '2025-09-21 01:10:01', '2025-09-21 01:10:01'),
(706, 53, '3', 'Supply chain', '2025-09-21 01:10:01', '2025-09-21 01:10:01'),
(707, 54, '0', 'Ethereum', '2025-09-21 01:10:18', '2025-09-21 01:10:18'),
(708, 54, '1', 'Hyperledger', '2025-09-21 01:10:18', '2025-09-21 01:10:18'),
(709, 54, '2', 'Solana', '2025-09-21 01:10:18', '2025-09-21 01:10:18'),
(710, 54, '3', 'Polkadot', '2025-09-21 01:10:18', '2025-09-21 01:10:18'),
(711, 55, '0', 'Writing smart contracts', '2025-09-21 01:10:24', '2025-09-21 01:10:24'),
(712, 55, '1', 'Building dApps', '2025-09-21 01:10:24', '2025-09-21 01:10:24'),
(713, 55, '2', 'Designing consensus', '2025-09-21 01:10:24', '2025-09-21 01:10:24'),
(714, 55, '3', 'Tokenomics', '2025-09-21 01:10:24', '2025-09-21 01:10:24'),
(715, 56, '0', 'Voting system', '2025-09-21 01:10:30', '2025-09-21 01:10:30'),
(716, 56, '1', 'Crypto exchange', '2025-09-21 01:10:30', '2025-09-21 01:10:30'),
(717, 56, '2', 'NFT marketplace', '2025-09-21 01:10:30', '2025-09-21 01:10:30'),
(718, 56, '3', 'Supply chain tracker', '2025-09-21 01:10:30', '2025-09-21 01:10:30'),
(719, 57, '0', 'Transparency', '2025-09-21 01:10:58', '2025-09-21 01:10:58'),
(720, 57, '1', 'Security', '2025-09-21 01:10:58', '2025-09-21 01:10:58'),
(721, 57, '2', 'Scalability', '2025-09-21 01:10:58', '2025-09-21 01:10:58'),
(722, 57, '3', 'Speed', '2025-09-21 01:10:58', '2025-09-21 01:10:58'),
(723, 58, '0', 'Blockchain developer', '2025-09-21 01:11:16', '2025-09-21 01:11:16'),
(724, 58, '1', 'Smart contract auditor', '2025-09-21 01:11:16', '2025-09-21 01:11:16'),
(725, 58, '2', 'Blockchain researcher', '2025-09-21 01:11:16', '2025-09-21 01:11:16'),
(726, 58, '3', 'Crypto analyst', '2025-09-21 01:11:16', '2025-09-21 01:11:16'),
(751, 7, '0', 'TensorFlow or PyTorch', '2025-09-21 03:57:37', '2025-09-21 03:57:37'),
(752, 7, '1', 'Wireshark or Metasploit', '2025-09-21 03:57:37', '2025-09-21 03:57:37'),
(753, 7, '2', 'Unity or Unreal Engine', '2025-09-21 03:57:37', '2025-09-21 03:57:37'),
(754, 7, '3', 'Figma or Adobe XD', '2025-09-21 03:57:37', '2025-09-21 03:57:37'),
(755, 8, '0', 'Smart home automation', '2025-09-21 03:57:45', '2025-09-21 03:57:45'),
(756, 8, '1', 'Fraud detection using data', '2025-09-21 03:57:45', '2025-09-21 03:57:45'),
(757, 8, '2', 'Multiplayer online game', '2025-09-21 03:57:45', '2025-09-21 03:57:45'),
(758, 8, '3', 'Cloud-based storage system', '2025-09-21 03:57:45', '2025-09-21 03:57:45'),
(759, 9, '0', 'AI assistants and chatbots', '2025-09-21 03:57:52', '2025-09-21 03:57:52'),
(760, 9, '1', 'Cryptocurrency platforms', '2025-09-21 03:57:52', '2025-09-21 03:57:52'),
(761, 9, '2', 'Self-driving cars', '2025-09-21 03:57:52', '2025-09-21 03:57:52'),
(762, 9, '3', 'Secure online banking', '2025-09-21 03:57:52', '2025-09-21 03:57:52'),
(763, 10, '0', 'By experimenting with algorithms', '2025-09-21 03:58:01', '2025-09-21 03:58:01'),
(764, 10, '1', 'By securing weaknesses', '2025-09-21 03:58:01', '2025-09-21 03:58:01'),
(765, 10, '2', 'By designing for better usability', '2025-09-21 03:58:01', '2025-09-21 03:58:01'),
(766, 10, '3', 'By coding solutions into software', '2025-09-21 03:58:01', '2025-09-21 03:58:01'),
(767, 1, '0', 'I like experimenting with systems that can learn, adapt, or make predictions.', '2025-10-21 23:56:24', '2025-10-21 23:56:24'),
(768, 1, '1', 'Protecting networks from threats', '2025-10-21 23:56:24', '2025-10-21 23:56:24'),
(769, 1, '2', 'Analyzing large datasets', '2025-10-21 23:56:24', '2025-10-21 23:56:24'),
(770, 1, '3', 'Creating mobile or web apps', '2025-10-21 23:56:24', '2025-10-21 23:56:24'),
(771, 2, '0', 'I like designing visual layouts or improving the usability of websites or apps.', '2025-10-21 23:56:59', '2025-10-21 23:56:59'),
(772, 2, '1', 'Building game mechanics', '2025-10-21 23:56:59', '2025-10-21 23:56:59'),
(773, 2, '2', 'Deploying cloud solutions', '2025-10-21 23:56:59', '2025-10-21 23:56:59'),
(774, 2, '3', 'Programming hardware integrations', '2025-10-21 23:56:59', '2025-10-21 23:56:59'),
(775, 3, '0', 'I enjoy building and maintaining websites or web applications.', '2025-10-21 23:57:26', '2025-10-21 23:57:26'),
(776, 3, '1', 'Investigating system breaches', '2025-10-21 23:57:26', '2025-10-21 23:57:26'),
(777, 3, '2', 'Exploring decentralized transactions', '2025-10-21 23:57:26', '2025-10-21 23:57:26'),
(778, 3, '3', 'Automating physical processes', '2025-10-21 23:57:26', '2025-10-21 23:57:26'),
(779, 4, '0', 'I like setting up or maintaining secure computer networks and devices.', '2025-10-21 23:58:20', '2025-10-21 23:58:20'),
(780, 4, '1', 'A gaming studio', '2025-10-21 23:58:20', '2025-10-21 23:58:20'),
(781, 4, '2', 'A design lab testing usability', '2025-10-21 23:58:20', '2025-10-21 23:58:20'),
(782, 4, '3', 'A robotics research center', '2025-10-21 23:58:20', '2025-10-21 23:58:20'),
(783, 5, '0', 'I like investigating and solving problems related to computer or network security.', '2025-10-21 23:59:57', '2025-10-21 23:59:57'),
(784, 5, '1', 'Discovering patterns in data', '2025-10-21 23:59:57', '2025-10-21 23:59:57'),
(785, 5, '2', 'Innovating with AI', '2025-10-21 23:59:57', '2025-10-21 23:59:57'),
(786, 5, '3', 'Building immersive worlds', '2025-10-21 23:59:57', '2025-10-21 23:59:57'),
(787, 6, '0', 'I like developing systems that connect devices and automate real-world actions.', '2025-10-22 00:00:16', '2025-10-22 00:00:16'),
(788, 6, '1', 'Designing smart devices', '2025-10-22 00:00:16', '2025-10-22 00:00:16'),
(789, 6, '2', 'Programming user-facing apps', '2025-10-22 00:00:16', '2025-10-22 00:00:16'),
(790, 6, '3', 'Optimizing system performance', '2025-10-22 00:00:16', '2025-10-22 00:00:16');

-- --------------------------------------------------------

--
-- Table structure for table `recommendations`
--

CREATE TABLE `recommendations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tech_field_id` tinyint(3) UNSIGNED NOT NULL,
  `score` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recommendations`
--

INSERT INTO `recommendations` (`id`, `user_id`, `tech_field_id`, `score`, `created_at`, `updated_at`) VALUES
(386, 1, 1, 0.07, '2025-10-22 00:11:19', '2025-10-22 00:11:19'),
(387, 1, 2, 0.15, '2025-10-22 00:11:19', '2025-10-22 00:11:19'),
(388, 1, 3, 0.08, '2025-10-22 00:11:19', '2025-10-22 00:11:19'),
(389, 1, 4, 0.04, '2025-10-22 00:11:19', '2025-10-22 00:11:19'),
(390, 1, 5, 0.04, '2025-10-22 00:11:19', '2025-10-22 00:11:19'),
(391, 1, 6, 0.16, '2025-10-22 00:11:19', '2025-10-22 00:11:19'),
(392, 1, 7, 0.02, '2025-10-22 00:11:19', '2025-10-22 00:11:19'),
(393, 1, 8, 0.24, '2025-10-22 00:11:19', '2025-10-22 00:11:19'),
(394, 1, 9, 0.08, '2025-10-22 00:11:19', '2025-10-22 00:11:19'),
(395, 1, 10, 0.07, '2025-10-22 00:11:19', '2025-10-22 00:11:19'),
(396, 1, 11, 0.05, '2025-10-22 00:11:19', '2025-10-22 00:11:19');

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE `responses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` smallint(5) UNSIGNED NOT NULL,
  `option_id` bigint(20) UNSIGNED DEFAULT NULL,
  `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2025-07-16 02:19:37', '2025-07-16 02:19:37'),
(2, 'student', '2025-07-16 02:19:37', '2025-07-16 02:19:37'),
(1, 'admin', '2025-07-16 02:19:37', '2025-07-16 02:19:37'),
(2, 'student', '2025-07-16 02:19:37', '2025-07-16 02:19:37');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(6, 1),
(6, 1),
(28, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_profiles`
--

CREATE TABLE `student_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `gpa` decimal(3,2) DEFAULT NULL,
  `senior_high_grade` decimal(5,2) DEFAULT NULL COMMENT 'Senior High School final grade (0–100)',
  `interests` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `student_profiles`
--

INSERT INTO `student_profiles` (`id`, `user_id`, `full_name`, `date_of_birth`, `gender`, `gpa`, `senior_high_grade`, `interests`, `created_at`, `updated_at`) VALUES
(1, 3, 'My Real name', '2005-08-07', 'male', 4.00, 100.00, '[\"Programming\",\"Web Development\",\"Mobile Apps\",\"Cybersecurity\",\"Networking\"]', '2025-08-21 10:55:44', '2025-08-21 11:12:32'),
(2, 4, 'Ice Ice Ice', '2025-08-20', 'male', 4.00, 100.00, '[\"Web Development\",\"Mobile Apps\",\"Data Science\",\"Networking\"]', '2025-08-21 11:13:23', '2025-08-21 11:13:23'),
(3, 1, 'Ice Ice', '2005-08-07', 'male', 4.00, 88.00, '[\"Programming\",\"Web Development\",\"Mobile Apps\",\"Data Science\",\"Cybersecurity\",\"Networking\"]', '2025-08-22 09:31:13', '2025-08-24 08:22:59'),
(4, 8, 'Daniel Callejas', '2000-08-07', 'male', 4.00, 100.00, '[\"Mobile Apps\",\"Cybersecurity\",\"Networking\"]', '2025-08-22 10:43:48', '2025-08-22 10:43:58');

-- --------------------------------------------------------

--
-- Table structure for table `tech_fields`
--

CREATE TABLE `tech_fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tech_field_id` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tech_fields`
--

INSERT INTO `tech_fields` (`id`, `name`, `description`, `created_at`, `updated_at`, `tech_field_id`) VALUES
(1, 'Artificial Intelligence', NULL, '2025-09-21 11:07:33', '2025-09-21 11:07:33', NULL),
(2, 'Cybersecurity', NULL, '2025-09-21 11:07:33', '2025-09-21 11:07:33', NULL),
(3, 'Data Science & Analytics', NULL, '2025-09-21 11:07:33', '2025-09-21 11:07:33', NULL),
(4, 'Software Development', NULL, '2025-09-21 11:07:33', '2025-09-21 11:07:33', NULL),
(5, 'Game Development', NULL, '2025-09-21 11:07:33', '2025-09-21 11:07:33', NULL),
(6, 'UI/UX Design', NULL, '2025-09-21 11:07:33', '2025-09-21 11:07:33', NULL),
(7, 'Cloud Computing', NULL, '2025-09-21 11:07:33', '2025-09-21 11:07:33', NULL),
(8, 'Internet of Things (IoT)', NULL, '2025-09-21 11:07:33', '2025-09-21 11:07:33', NULL),
(9, 'Blockchain', NULL, '2025-09-21 11:07:33', '2025-09-21 11:07:33', NULL),
(10, 'Robotics', NULL, '2025-09-21 11:07:33', '2025-09-21 11:07:33', NULL),
(11, 'Mobile Development', NULL, '2025-09-21 11:07:33', '2025-09-21 11:07:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `universities`
--

CREATE TABLE `universities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `programs` text DEFAULT NULL,
  `tech_fields` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`tech_fields`)),
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `universities`
--

INSERT INTO `universities` (`id`, `name`, `type`, `location`, `programs`, `tech_fields`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Central Luzon State University (CLSU)', 'public', 'Nueva Ecija', 'BSIT (Software Systems & Web Apps Eng, Network Systems & Infra Eng), BSCS', '{\"Software Development\":\"Direct (BSIT Software Systems, BSCS)\",\"Cybersecurity\":\"Partial\\/Direct (Network Systems covers security topics)\",\"Cloud Computing\":\"Partial (infra\\/network electives)\",\"Data Science & Analytics\":\"Partial (CS\\/IT electives, research)\",\"Artificial Intelligence\":\"Partial (electives\\/research)\",\"UI\\/UX\":\"Partial (web apps)\",\"IoT\":\"Partial (research\\/electives)\"}', NULL, '2025-09-22 08:15:06', '2025-09-22 08:15:06'),
(2, 'Tarlac State University (TSU)', 'public', 'Tarlac', 'BSIT (Network Admin, Technical Service Management, Web & Mobile Apps), BSIS, BSCS', '{\"Software Development\":\"Direct (BSIT WMA, BSCS)\",\"Cybersecurity\":\"Direct\\/Partial (BSIT \\u2014 Network Admin)\",\"Cloud Computing\":\"Partial (TSM topics)\",\"Data Science & Analytics\":\"Partial\\/Direct (BSIS \\/ BSCS subjects)\",\"UI\\/UX\":\"Partial (Web & Mobile subjects)\"}', NULL, '2025-09-22 08:15:06', '2025-09-22 08:15:06'),
(3, 'Bulacan State University (BulSU)', 'public', 'Bulacan', 'BSIT, BSCS, BS Math (major in CS)', '{\"Software Development\":\"Direct (BSIT\\/BSCS)\",\"Data Science & Analytics\":\"Direct\\/Partial (BS Math (CS), CS electives)\",\"Cybersecurity\":\"Partial (networking\\/security subjects)\",\"Artificial Intelligence\":\"Partial (elective\\/research)\"}', NULL, '2025-09-22 08:15:06', '2025-09-22 08:15:06'),
(4, 'Nueva Ecija University of Science & Technology (NEUST)', 'public', 'Nueva Ecija', 'BSIT (Database, Network, Web Systems), BSCS', '{\"Software Development\":\"Direct (BSIT\\/BSCS)\",\"Cybersecurity\":\"Partial (Network Systems topics)\",\"Data Science & Analytics\":\"Partial (database\\/analytics subjects)\"}', NULL, '2025-09-22 08:15:06', '2025-09-22 08:15:06'),
(5, 'Bataan Peninsula State University (BPSU)', 'public', 'Bataan', 'BSIT, BSCS (multiple campuses; some EMC/multimedia)', '{\"Software Development\":\"Direct (BSIT\\/BSCS)\",\"Game Development\":\"Partial (EMC at some campuses)\",\"Data Science & Analytics\":\"Partial\"}', NULL, '2025-09-22 08:15:06', '2025-09-22 08:15:06'),
(6, 'Don Honorio Ventura Technological State University (DHVTSU)', 'public', 'Pampanga', 'BSIT, BSCS, BSIS', '{\"Software Development\":\"Direct (BSIT\\/BSCS\\/BSIS)\",\"Cybersecurity\":\"Partial (networking topics)\",\"Data Science & Analytics\":\"Partial (IS\\/CS subjects)\"}', NULL, '2025-09-22 08:15:06', '2025-09-22 08:15:06'),
(7, 'Pampanga State Agricultural University (PSAU)', 'public', 'Pampanga', 'BSIT/BSCS (campus dependent)', '{\"Software Development\":\"Direct (BSIT\\/BSCS where offered)\",\"Data Science & Analytics\":\"Partial (agri-data application)\",\"IoT\":\"Partial (agri-IoT projects)\",\"Robotics\":\"Partial (agri-automation potential)\"}', NULL, '2025-09-22 08:15:06', '2025-09-22 08:15:06'),
(8, 'Aurora State College of Technology (ASCOT)', 'public', 'Aurora', 'BSIT, BSCS (STEM/tech programs)', '{\"Software Development\":\"Direct\",\"Data Science & Analytics\":\"Partial\",\"IoT\":\"Partial\",\"Robotics\":\"Partial\"}', NULL, '2025-09-22 08:15:06', '2025-09-22 08:15:06'),
(9, 'Polytechnic University of the Philippines (PUP) — Pulilan', 'public', 'Bulacan', 'BSIT, BSCS, Computer Engineering (PUP system)', '{\"Software Development\":\"Direct\",\"Cybersecurity\":\"Partial\",\"Data Science & Analytics\":\"Partial\",\"IoT\":\"Partial\"}', NULL, '2025-09-22 08:15:06', '2025-09-22 08:15:06'),
(10, 'Holy Angel University (HAU)', 'private', 'Angeles City', 'BSCS, BSIT, BS Cybersecurity, Entertainment & Multimedia Computing (EMC)', '{\"Cybersecurity\":\"Direct (BS Cybersecurity)\",\"Software Development\":\"Direct (BSCS\\/BSIT)\",\"Game Development\":\"Direct\\/Partial (EMC \\u2014 Game\\/Animation track)\",\"UI\\/UX\":\"Direct\\/Partial (EMC \\/ multimedia)\",\"Data Science & Analytics\":\"Partial\"}', NULL, '2025-09-22 08:15:06', '2025-09-22 08:15:06'),
(11, 'Angeles University Foundation (AUF)', 'private', 'Angeles City', 'BSCS (Data Science track), BSIT, BMMA (multimedia / UI/UX)', '{\"Data Science & Analytics\":\"Direct (BSCS data track)\",\"Software Development\":\"Direct\",\"UI\\/UX\":\"Direct (BMMA)\",\"Artificial Intelligence\":\"Partial\",\"Robotics\":\"Partial\"}', NULL, '2025-09-22 08:15:06', '2025-09-22 08:15:06'),
(12, 'AMA Computer University (Region III)', 'private', 'Region III campuses', 'BSIT, BSCS, BSIS; professional certificates in AI, Cybersecurity, Cloud, Data Science', '{\"Software Development\":\"Direct\",\"Cybersecurity\":\"Direct\\/Certs\",\"Cloud Computing\":\"Direct\\/Certs\",\"Data Science & Analytics\":\"Direct\\/Certs\",\"Artificial Intelligence\":\"Direct\\/Certs\",\"Game Development\":\"Partial (electives \\/ certs)\",\"UI\\/UX\":\"Partial (electives \\/ certs)\",\"IoT\":\"Partial (electives \\/ certs)\",\"Blockchain\":\"Partial (electives \\/ certs)\",\"Robotics\":\"Partial (electives \\/ certs)\"}', NULL, '2025-09-22 08:15:06', '2025-09-22 08:15:06'),
(13, 'Our Lady of Fatima University (OLFU) — Pampanga', 'private', 'Pampanga', 'BSCS, BSIT', '{\"Software Development\":\"Direct\",\"Data Science & Analytics\":\"Partial\",\"Cybersecurity\":\"Partial\"}', NULL, '2025-09-22 08:15:06', '2025-09-22 08:15:06'),
(14, 'Centro Escolar University — Malolos (CEU-Malolos)', 'private', 'Malolos, Bulacan', 'BSCS, BSIT', '{\"Software Development\":\"Direct\",\"Cloud Computing\":\"Partial\",\"Data Science & Analytics\":\"Partial\"}', NULL, '2025-09-22 08:15:06', '2025-09-22 08:15:06'),
(15, 'La Consolacion University Philippines (LCUP) — Baliwag', 'private', 'Baliwag, Bulacan', 'BSIT, BSCS', '{\"Software Development\":\"Direct\",\"Data Science & Analytics\":\"Partial\"}', NULL, '2025-09-22 08:15:06', '2025-09-22 08:15:06'),
(16, 'Baliuag University', 'private', 'Baliwag, Bulacan', 'BSIT, BSIS', '{\"Software Development\":\"Direct\",\"Data Science & Analytics\":\"Partial (BSIS)\"}', NULL, '2025-09-22 08:15:06', '2025-09-22 08:15:06'),
(17, 'Araullo University (AU)', 'private', 'Cabanatuan', 'BSIT, BSCS', '{\"Software Development\":\"Direct\",\"Data Science & Analytics\":\"Partial\"}', NULL, '2025-09-22 08:15:06', '2025-09-22 08:15:06'),
(18, 'Wesleyan University — Philippines (WU-P)', 'private', 'Cabanatuan', 'BSIT, BSCS', '{\"Software Development\":\"Direct\",\"Data Science & Analytics\":\"Partial\"}', NULL, '2025-09-22 08:15:06', '2025-09-22 08:15:06'),
(19, 'Lyceum of Subic Bay', 'private', 'Subic Bay', 'BSIT, BSCS', '{\"Software Development\":\"Direct\",\"Game Development\":\"Partial\",\"UI\\/UX\":\"Partial\",\"IoT\":\"Partial\",\"Robotics\":\"Partial\"}', NULL, '2025-09-22 08:15:06', '2025-09-22 08:15:06'),
(20, 'University of the Assumption (UA)', 'private', 'Pampanga', 'BSIT, BSCS', '{\"Software Development\":\"Direct\",\"Data Science & Analytics\":\"Partial\"}', NULL, '2025-09-22 08:15:06', '2025-09-22 08:15:06'),
(21, 'Guagua National Colleges (GNC)', 'private', 'Guagua, Pampanga', 'BSIT, BSCS', '{\"Software Development\":\"Direct\",\"Data Science & Analytics\":\"Partial\"}', NULL, '2025-09-22 08:15:06', '2025-09-22 08:15:06'),
(22, 'First City Providential College (FCPC)', 'private', 'San Jose del Monte', 'BSIT / BSCS', '{\"Software Development\":\"Direct\",\"Data Science & Analytics\":\"Partial\"}', NULL, '2025-09-22 08:15:06', '2025-09-22 08:15:06'),
(23, 'Meycauayan College', 'private', 'Meycauayan, Bulacan', 'BSIT, BSCS', '{\"Software Development\":\"Direct\",\"Data Science & Analytics\":\"Partial\"}', NULL, '2025-09-22 08:15:06', '2025-09-22 08:15:06'),
(24, 'Maritime Academy of Asia & the Pacific (MAAP)', 'private', 'Mariveles/Bataan', 'Maritime + technical IT programs', '{\"Software Development\":\"Partial (maritime IT systems)\",\"IoT\":\"Partial (maritime sensors)\",\"Robotics\":\"Partial (marine robotics potential)\",\"Cybersecurity\":\"Partial (maritime systems security)\"}', NULL, '2025-09-22 08:15:06', '2025-09-22 08:15:06'),
(25, 'Colegio de San Gabriel Arcangel', 'private', 'Local HEI', 'BSIT, BSCS', '{\"Software Development\":\"Direct\",\"Data Science & Analytics\":\"Partial\"}', NULL, '2025-09-22 08:15:06', '2025-09-22 08:15:06'),
(26, 'Columban College', 'private', 'Olongapo', 'BSIT, BSCS', '{\"Software Development\":\"Direct\",\"Data Science & Analytics\":\"Partial\"}', NULL, '2025-09-22 08:15:06', '2025-09-22 08:15:06'),
(27, 'Dr. Yanga\'s Colleges', 'private', 'Bocaue, Bulacan', 'BSIT, BSCS', '{\"Software Development\":\"Direct\",\"Data Science & Analytics\":\"Partial\"}', NULL, '2025-09-22 08:15:06', '2025-09-22 08:15:06'),
(28, 'MV Gallego Foundation Colleges', 'private', 'Local HEI', 'BSIT/BSCS', '{\"Software Development\":\"Direct\",\"Data Science & Analytics\":\"Partial\"}', NULL, '2025-09-22 08:15:06', '2025-09-22 08:15:06'),
(29, 'Union Christian College', 'private', 'Local HEI', 'BSIT, BSCS', '{\"Software Development\":\"Direct\",\"Data Science & Analytics\":\"Partial\"}', NULL, '2025-09-22 08:15:06', '2025-09-22 08:15:06'),
(30, 'Lyceum-Northwestern University', 'private', 'Region III campus', 'BSIT, BSCS', '{\"Software Development\":\"Direct\",\"Data Science & Analytics\":\"Partial\"}', NULL, '2025-09-22 08:15:06', '2025-09-22 08:15:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ice Ice', 'ice@music.com', '2025-11-06 01:50:08', '$2y$10$O2268dfvFMyGXEtKtUUD2unt2Y.sHtknNq/trguq89Woay08zzKri', 'H5Z0hlbPFiDLLB3jgjqDeEKOlhtzDN3BNYUxnK4WswjEjPFmgFm1K7Cj7aOx', '2025-08-21 10:20:47', '2025-08-24 08:22:59', NULL),
(3, 'My Real name', '123@gmail.com', '2025-11-06 01:50:08', '$2y$10$TlkcShjgXlNLKzO9Zf3.6eknnaJlyuSZyQXjaxf/gioGCeqUXFUtS', NULL, '2025-08-21 10:32:18', '2025-08-21 11:12:32', NULL),
(4, 'Ice Ice Ice', 'iceiceice@gmail.com', '2025-11-06 01:50:08', '$2y$10$1hFsx8t9U3ry4IhI1XIZAerAn2fvfzWA14Pj4SmdfaZh9MdOSrUBO', NULL, '2025-08-21 11:12:57', '2025-08-21 11:13:23', NULL),
(5, 'alvin castro', 'alvin@123.com', '2025-11-06 01:50:08', '$2y$10$qo.W4ch7BsI7/nKPoBRr2OhuNECFp0mhc7C8WcurlFhrnPe.XEena', NULL, '2025-08-21 19:34:07', '2025-08-21 19:34:07', NULL),
(6, 'admin', 'admin@manage.com', '2025-11-06 01:50:08', '$2y$10$8A08kB1BgoDoS9iCt4dKcuXWHwv0N1gVEkcYghyVjLlPWRz.9bs1O', NULL, '2025-08-22 07:26:56', '2025-08-22 07:26:56', NULL),
(7, 'User byAdmin', 'user123@gmail.com', '2025-11-06 01:50:08', '$2y$10$FBE1AZ0RIrbl3HH8nBmBVOQY/ulUSM11hi5GDJ.nNAgpmn7Qrk4C.', NULL, '2025-08-22 09:55:41', '2025-10-31 09:54:22', '2025-10-31 09:54:22'),
(8, 'Daniel Callejas', 'sample@999.com', '2025-11-06 01:50:08', '$2y$10$Es/vo9vEqCwVKpecCj4YluCfxotkFwGF5kG2P2GlqD1nUeVpK862C', NULL, '2025-08-22 10:39:09', '2025-10-31 09:54:18', '2025-10-31 09:54:18'),
(9, 'John Doe', 'weboracle.business@gmail.com', '2025-11-06 01:50:08', '$2y$10$Txi12dGRBZp7YxjSziJKLe/cjBefMPRz.8cAN5UhvjqwUgaOQXs7a', 'wKOauKHINebSRnKoIQoS0EzpkcTaht0o2dtnYc5jSGJr8jEYJ0BaGcN2cuII', '2025-08-23 11:23:22', '2025-08-23 11:57:19', NULL),
(10, 'wow wow', 'wow@gmail.com', '2025-11-06 01:50:08', '$2y$10$nt8LVKORaqlASBeC0I1fj.UbGBKX51akvA4cTEAW83OnsA64BScQG', NULL, '2025-08-23 15:16:12', '2025-08-23 15:16:12', NULL),
(11, 'pasword', 'pass@gmail.com', '2025-11-06 01:50:08', '$2y$10$fCOZ1zwfPRusM422MR6dyOp30XfBWUmmCP8CbEESAowNlvLfci7Sq', NULL, '2025-08-24 07:41:09', '2025-08-24 07:41:09', NULL),
(12, 'Mark Daniel Callejas', 'buyer1@example.com', '2025-11-06 01:50:08', '$2y$10$n3YTAm4P1Qo5QWfWP3ge9uy4jmOefM3NnJrOaW9M84Rw1627G4uZa', NULL, '2025-08-24 07:51:44', '2025-10-31 09:54:25', '2025-10-31 09:54:25'),
(13, 'survey person', 'survey@manage.com', '2025-11-06 01:50:08', '$2y$10$iW6aDewe6OmRi9LipcW1veG/emhCLWnqDUp.8O6cd6L13e6jBMNVO', NULL, '2025-09-09 06:19:06', '2025-09-09 06:19:06', NULL),
(14, 'survey person2', 'survey1@manage.com', '2025-11-06 01:50:08', '$2y$10$ICHv9nhVFM5rGn9JNnB7Q.OIinYpXdGhHw291Gwv72NrUcn9TQMDG', NULL, '2025-09-09 06:42:30', '2025-09-09 06:42:30', NULL),
(15, 'survey person3', 'survey2@manage.com', '2025-11-06 01:50:08', '$2y$10$AL4B2DdGzgJkVLZlP78FY.HCJCkLwkG0c9pRr2ZLS7ghELziX6/MK', NULL, '2025-09-09 06:57:39', '2025-09-09 06:57:39', NULL),
(16, 'sample 1', 'sample22@gmail.com', '2025-11-06 01:50:08', '$2y$10$fyDox7uS8qWdRhhuZAUbhe/RmI3VEmuTB2FbhioJMvgSrxgqPujti', NULL, '2025-09-09 22:30:50', '2025-10-31 09:54:13', '2025-10-31 09:54:13'),
(17, 'asjkd', 'qwe@qwe.com', '2025-11-06 01:50:08', '$2y$10$kw7A5O1yvgGWXoPGovLU4OtGfcBHeZ2FeU38RD/SGkITQpafxpFDG', NULL, '2025-09-09 22:43:54', '2025-09-09 22:43:54', NULL),
(18, 'aa aa', 'aaa@aaa.com', '2025-11-06 01:50:08', '$2y$10$8nwi5HcGg84U56qjqQrQOew7YQVFY9iUoB4xAcbbplsOCKnYHWpmq', NULL, '2025-09-11 11:18:13', '2025-09-11 11:18:13', NULL),
(19, 'Test User', 'test@example.com', '2025-11-06 01:50:08', '$2y$10$mOSDf5LRiiRJZLdzgHsPQOcCA3iyDuGRk2eE284o7G1DlNOt8DpFq', NULL, '2025-09-19 20:10:49', '2025-10-31 08:53:42', '2025-10-31 08:53:42'),
(22, 'Mark Daniel Callejas', 'ice@mus2ic.com', '2025-11-06 01:50:08', '$2y$10$6nsSQ0zcT9wOuX3.ivLk/upBu28JPaA3n70d/GpKhk1W5ov47H9WC', NULL, '2025-11-01 08:43:03', '2025-11-01 08:43:03', NULL),
(23, 'Ice Ice', 'callejasmark63@gmail.com', '2025-11-06 01:50:08', '$2y$10$c6pJn2oGqGsl.B3OC8UxkuePhXYiByqK83H27wvCSE2fmchf.uKo2', NULL, '2025-11-01 08:49:51', '2025-11-01 08:50:06', NULL),
(24, 'Sample User1', 'sampleuser1@ccsuggest.com', '2025-11-06 01:50:08', '$2y$10$ejcuDkNlzyUoBttlfzqTROqJT6DttSaomGdBVZBa0HxgaPLbomlgO', NULL, '2025-11-05 17:45:02', '2025-11-05 17:45:02', NULL),
(25, 'Sample User2', 'sampleuser2@ccsuggest.com', '2025-11-06 01:50:08', '$2y$10$5gNUf3aOK5UYnhj8.xrCy.m0TtziM1Q8ao8bGV7Y4LWQZTxWFJA3a', NULL, '2025-11-05 17:45:57', '2025-11-05 17:45:57', NULL),
(26, 'Sample User3', 'sampleuser3@ccsuggest.com', '2025-11-06 01:50:08', '$2y$10$GuUIHDl5esB7ZQMzuKK..eiewGjPN1ib2hkNTmztVBlBM3IlNGplG', NULL, '2025-11-05 17:46:53', '2025-11-05 17:46:53', NULL),
(27, 'Sample User4', 'sampleuser4@ccsuggest.com', '2025-11-06 01:50:08', '$2y$10$ZNsciMXbBCd/VvFFMKoMlOSTZ3gCYdrNhTg.lYchVdWIGzyiNF6Ta', NULL, '2025-11-05 17:47:34', '2025-11-05 17:47:34', NULL),
(28, 'Admin CCSuggest', 'admin@ccsuggest.com', '2025-11-06 01:50:08', '$2y$10$0tCpiTIOryHF7i/tnpZFauWLsfx2cNFBEF9qCl8h7NdKIkBTWvEqq', NULL, '2025-11-05 17:48:07', '2025-11-05 17:48:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_survey_responses`
--

CREATE TABLE `user_survey_responses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `satisfaction_rating` int(11) NOT NULL,
  `feedback` text DEFAULT NULL,
  `would_recommend` tinyint(1) NOT NULL DEFAULT 0,
  `improvements` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_survey_responses`
--

INSERT INTO `user_survey_responses` (`id`, `user_id`, `satisfaction_rating`, `feedback`, `would_recommend`, `improvements`, `created_at`, `updated_at`) VALUES
(3, 14, 3, NULL, 0, NULL, '2025-09-09 06:52:11', '2025-09-09 06:52:11'),
(5, 15, 5, NULL, 1, NULL, '2025-09-09 07:44:18', '2025-09-09 07:44:18'),
(6, 13, 5, NULL, 1, NULL, '2025-09-09 07:44:57', '2025-09-09 07:44:57'),
(7, 17, 2, NULL, 1, NULL, '2025-09-09 22:46:47', '2025-09-09 22:46:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_options`
--
ALTER TABLE `question_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_options_ibfk_1` (`question_id`);

--
-- Indexes for table `recommendations`
--
ALTER TABLE `recommendations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_profiles`
--
ALTER TABLE `student_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_fields`
--
ALTER TABLE `tech_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `universities`
--
ALTER TABLE `universities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_survey_responses`
--
ALTER TABLE `user_survey_responses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_survey_responses_user_id_unique` (`user_id`),
  ADD KEY `user_survey_responses_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `question_options`
--
ALTER TABLE `question_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=791;

--
-- AUTO_INCREMENT for table `recommendations`
--
ALTER TABLE `recommendations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=397;

--
-- AUTO_INCREMENT for table `student_profiles`
--
ALTER TABLE `student_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tech_fields`
--
ALTER TABLE `tech_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `universities`
--
ALTER TABLE `universities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user_survey_responses`
--
ALTER TABLE `user_survey_responses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `question_options`
--
ALTER TABLE `question_options`
  ADD CONSTRAINT `question_options_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_survey_responses`
--
ALTER TABLE `user_survey_responses`
  ADD CONSTRAINT `user_survey_responses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
