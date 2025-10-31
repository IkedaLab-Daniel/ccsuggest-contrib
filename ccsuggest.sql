-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 10, 2025 at 08:43 AM
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
(7, '2025_08_20_010000_create_question_options_table', 1);

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
  `tech_field_id` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `text`, `source`, `type`, `created_at`, `updated_at`, `tech_field_id`) VALUES
(1, 'Which activity excites you the most?', 'OECD Future of Skills, 2021', 'single', '2025-09-10 06:06:03', '2025-09-09 22:27:45', 1),
(2, 'How would you like to contribute in a project?', 'Springer Career Surveys in Tech, 2022', 'single', '2025-09-10 06:06:03', '2025-09-09 22:27:49', 11),
(3, 'Which type of problems interest you the most?', 'IEEE Emerging Fields, 2020', 'single', '2025-09-10 06:06:03', '2025-09-09 22:27:50', 1),
(4, 'Which environment do you see yourself working in?', 'IEEE Careers in Computing, 2021', 'single', '2025-09-10 06:06:03', '2025-09-09 22:27:52', 6),
(5, 'What motivates you the most in tech?', 'Towards Data Science – Career Quizzes, 2023', 'single', '2025-09-10 06:06:03', '2025-09-09 22:27:54', 5),
(6, 'How do you prefer to apply your skills?', 'ACM Computing Surveys, 2020', 'single', '2025-09-10 06:06:03', '2025-09-09 22:27:59', 10),
(7, 'Which of these tools would you enjoy mastering?', 'IEEE Access – Developer Skills, 2021', 'single', '2025-09-10 06:06:03', '2025-09-09 22:28:01', 1),
(8, 'Which project would you rather work on?', 'OECD Skills for Future Careers, 2021', 'single', '2025-09-10 06:06:03', '2025-09-09 22:28:04', 7),
(9, 'What kind of innovation excites you most?', 'IEEE Technology Trends, 2022', 'single', '2025-09-10 06:06:03', '2025-09-09 22:28:06', 1),
(10, 'How do you approach problem-solving?', 'Springer Dynamic Questionnaires, 2022', 'single', '2025-09-10 06:06:03', '2025-09-09 22:28:08', 1),
(11, 'What excites you most about AI?', 'IEEE AI Trends, 2021', 'single', '2025-09-10 06:07:34', '2025-09-09 22:28:14', 1),
(12, 'Which AI concept do you want to learn?', 'ACM AI Education Report, 2022', 'single', '2025-09-10 06:07:34', '2025-09-09 22:28:10', 1),
(13, 'What project would you like to do in AI?', 'Springer AI Applications, 2020', 'single', '2025-09-10 06:07:34', '2025-09-09 22:28:16', 1),
(14, 'Which AI tool would you use?', 'IEEE Access – AI Tools, 2021', 'single', '2025-09-10 06:07:34', '2025-09-09 22:28:18', 1),
(15, 'What’s most important in AI projects?', 'AI Journal, 2022', 'single', '2025-09-10 06:07:34', '2025-09-09 22:28:20', 1),
(16, 'Which sector do you see AI being useful in?', 'OECD Future of AI, 2021', 'single', '2025-09-10 06:07:34', '2025-09-09 22:28:26', 1),
(17, 'What’s your favorite area in cybersecurity?', 'IEEE Cybersecurity Careers, 2021', 'single', '2025-09-10 06:08:05', '2025-09-10 06:30:08', 5),
(18, 'What tool would you prefer using?', 'ACM Security Tools Review, 2020', 'single', '2025-09-10 06:08:05', '2025-09-10 06:30:08', 5),
(19, 'Which problem excites you more?', 'Springer Cybersecurity Challenges, 2022', 'single', '2025-09-10 06:08:05', '2025-09-10 06:30:08', 5),
(20, 'Which cybersecurity role fits you?', 'IEEE Security Careers, 2021', 'single', '2025-09-10 06:08:05', '2025-09-10 06:30:08', 5),
(21, 'What’s the biggest threat today?', 'ACM Security Trends, 2021', 'single', '2025-09-10 06:08:05', '2025-09-10 06:30:08', 5),
(22, 'How would you secure a system?', 'IEEE Access – Cybersecurity, 2022', 'single', '2025-09-10 06:08:05', '2025-09-10 06:30:08', 5),
(23, 'What interests you in cloud computing?', 'IEEE Cloud Careers, 2020', 'single', '2025-09-10 06:10:24', '2025-09-10 06:30:08', 6),
(24, 'Which provider would you prefer?', 'Gartner Cloud Report, 2021', 'single', '2025-09-10 06:10:24', '2025-09-10 06:30:08', 6),
(25, 'What’s most important in cloud solutions?', 'Springer Cloud Computing, 2022', 'single', '2025-09-10 06:10:24', '2025-09-10 06:30:08', 6),
(26, 'Which role fits you in cloud?', 'IEEE Cloud Careers, 2021', 'single', '2025-09-10 06:10:24', '2025-09-10 06:30:08', 6),
(27, 'Which task excites you more?', 'ACM Cloud Trends, 2022', 'single', '2025-09-10 06:10:24', '2025-09-10 06:30:08', 6),
(28, 'What kind of cloud service would you like to manage?', 'IEEE Cloud Models, 2020', 'single', '2025-09-10 06:10:24', '2025-09-10 06:30:08', 6),
(29, 'What excites you in data science?', 'Springer Data Science, 2021', 'single', '2025-09-10 06:10:24', '2025-09-10 06:30:08', 4),
(30, 'Which tool would you like to use?', 'ACM Data Tools, 2021', 'single', '2025-09-10 06:10:24', '2025-09-09 22:28:38', 4),
(31, 'Which project sounds fun?', 'IEEE Data Science Projects, 2022', 'single', '2025-09-10 06:10:24', '2025-09-10 06:30:08', 4),
(32, 'What’s most important in data work?', 'Data Science Journal, 2020', 'single', '2025-09-10 06:10:24', '2025-09-10 06:30:08', 4),
(33, 'Which role do you like best?', 'OECD Careers in Data, 2022', 'single', '2025-09-10 06:10:24', '2025-09-10 06:30:08', 4),
(34, 'Where would you apply data science?', 'IEEE Big Data Trends, 2021', 'single', '2025-09-10 06:10:24', '2025-09-10 06:30:08', 4),
(35, 'What part of game dev excites you?', 'ACM Game Dev Careers, 2021', 'single', '2025-09-10 06:11:32', '2025-09-10 06:30:08', 8),
(36, 'Which engine would you use?', 'IEEE Game Engines, 2022', 'single', '2025-09-10 06:11:32', '2025-09-10 06:30:08', 8),
(37, 'Which game type do you prefer to build?', 'Game Development Report, 2020', 'single', '2025-09-10 06:11:32', '2025-09-10 06:30:08', 8),
(38, 'What matters most in game dev?', 'ACM Game Design, 2021', 'single', '2025-09-10 06:11:32', '2025-09-10 06:30:08', 8),
(39, 'Which role would you like?', 'IEEE Game Careers, 2020', 'single', '2025-09-10 06:11:32', '2025-09-10 06:30:08', 8),
(40, 'Where do you see yourself working?', 'Game Dev Trends, 2022', 'single', '2025-09-10 06:11:32', '2025-09-10 06:30:08', 8),
(41, 'What excites you in design?', NULL, 'single', '2025-09-10 06:13:30', '2025-09-10 06:30:08', 11),
(42, 'Which tool would you prefer?', NULL, 'single', '2025-09-10 06:13:30', '2025-09-10 06:30:08', 11),
(43, 'What’s most important in UX?', NULL, 'single', '2025-09-10 06:13:30', '2025-09-10 06:30:08', 11),
(44, 'Which project excites you more?', NULL, 'single', '2025-09-10 06:13:30', '2025-09-10 06:30:08', 11),
(45, 'Which role suits you?', NULL, 'single', '2025-09-10 06:13:30', '2025-09-10 06:30:08', 11),
(46, 'Which principle matters most to you?', NULL, 'single', '2025-09-10 06:13:30', '2025-09-10 06:30:08', 11),
(47, 'What project excites you in IoT?', NULL, 'single', '2025-09-10 06:14:41', '2025-09-10 06:30:08', 7),
(48, 'Which IoT protocol would you prefer to learn?', NULL, 'single', '2025-09-10 06:14:41', '2025-09-10 06:30:08', 7),
(49, 'Which IoT concern matters most?', NULL, 'single', '2025-09-10 06:14:41', '2025-09-10 06:30:08', 7),
(50, 'What excites you most in IoT development?', NULL, 'single', '2025-09-10 06:14:41', '2025-09-10 06:30:08', 7),
(51, 'Which IoT application would you build?', NULL, 'single', '2025-09-10 06:14:41', '2025-09-10 06:30:08', 7),
(52, 'Which skill do you want in IoT?', NULL, 'single', '2025-09-10 06:14:41', '2025-09-10 06:30:08', 7),
(53, 'What interests you most in blockchain?', NULL, 'single', '2025-09-10 06:18:36', '2025-09-10 06:30:08', 10),
(54, 'Which blockchain platform excites you?', NULL, 'single', '2025-09-10 06:18:36', '2025-09-10 06:30:08', 10),
(55, 'Which skill do you want in blockchain?', NULL, 'single', '2025-09-10 06:18:36', '2025-09-10 06:30:08', 10),
(56, 'Which blockchain project would you build?', NULL, 'single', '2025-09-10 06:18:36', '2025-09-10 06:30:08', 10),
(57, 'What matters most in blockchain?', NULL, 'single', '2025-09-10 06:18:36', '2025-09-10 06:30:08', 10),
(58, 'Which role would you choose?', NULL, 'single', '2025-09-10 06:18:36', '2025-09-09 22:28:44', 10),
(59, 'What excites you in robotics?', NULL, 'single', '2025-09-10 06:24:11', '2025-09-10 06:30:08', 12),
(60, 'Which type of robot interests you most?', NULL, 'single', '2025-09-10 06:24:11', '2025-09-10 06:30:08', 12),
(61, 'Which robotics skill do you want?', NULL, 'single', '2025-09-10 06:24:11', '2025-09-10 06:30:08', 12),
(62, 'Which project excites you more?', NULL, 'single', '2025-09-10 06:24:11', '2025-09-10 06:30:08', 12),
(63, 'What’s most important in robotics?', NULL, 'single', '2025-09-10 06:24:11', '2025-09-10 06:30:08', 12),
(64, 'Where do you see yourself working?', NULL, 'single', '2025-09-10 06:24:11', '2025-09-10 06:30:08', 12),
(65, 'Which part of software development excites you most?', NULL, 'single', '2025-09-10 06:26:14', '2025-09-10 06:30:08', 13),
(66, 'Which programming language would you focus on?', NULL, 'single', '2025-09-10 06:26:14', '2025-09-10 06:30:08', 13),
(67, 'When developing software, which part interests you the most?', NULL, 'single', '2025-09-10 06:26:14', '2025-09-10 06:30:08', 13),
(68, 'What type of software project would you enjoy working on?', NULL, 'single', '2025-09-10 06:26:14', '2025-09-10 06:30:08', 13),
(69, 'Which skill do you want to strengthen as a developer?', NULL, 'single', '2025-09-10 06:26:14', '2025-09-10 06:30:08', 13),
(70, 'How do you measure success in a software project?', NULL, 'single', '2025-09-10 06:26:14', '2025-09-10 06:30:08', 13);

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
(65, 17, '0', 'Ethical hacking', '2025-09-10 06:08:10', '2025-09-10 06:38:25'),
(66, 17, '1', 'Network defense', '2025-09-10 06:08:10', '2025-09-10 06:38:26'),
(67, 17, '2', 'Security policy design', '2025-09-10 06:08:10', '2025-09-10 06:38:26'),
(68, 17, '3', 'Digital forensics', '2025-09-10 06:08:10', '2025-09-10 06:38:26'),
(69, 18, '0', 'Wireshark', '2025-09-10 06:08:10', '2025-09-10 06:38:25'),
(70, 18, '1', 'Metasploit', '2025-09-10 06:08:10', '2025-09-10 06:38:26'),
(71, 18, '2', 'Nmap', '2025-09-10 06:08:10', '2025-09-10 06:38:26'),
(72, 18, '3', 'Burp Suite', '2025-09-10 06:08:10', '2025-09-10 06:38:26'),
(73, 19, '0', 'Preventing phishing attacks', '2025-09-10 06:08:10', '2025-09-10 06:38:25'),
(74, 19, '1', 'Securing cloud systems', '2025-09-10 06:08:10', '2025-09-10 06:38:26'),
(75, 19, '2', 'Encrypting sensitive data', '2025-09-10 06:08:10', '2025-09-10 06:38:26'),
(76, 19, '3', 'Detecting malware', '2025-09-10 06:08:10', '2025-09-10 06:38:26'),
(77, 20, '0', 'Penetration tester', '2025-09-10 06:08:10', '2025-09-10 06:38:25'),
(78, 20, '1', 'Security analyst', '2025-09-10 06:08:10', '2025-09-10 06:38:26'),
(79, 20, '2', 'Incident responder', '2025-09-10 06:08:10', '2025-09-10 06:38:26'),
(80, 20, '3', 'SOC engineer', '2025-09-10 06:08:10', '2025-09-10 06:38:26'),
(81, 21, '0', 'Ransomware', '2025-09-10 06:08:10', '2025-09-10 06:38:25'),
(82, 21, '1', 'Data leaks', '2025-09-10 06:08:10', '2025-09-10 06:38:26'),
(83, 21, '2', 'Social engineering', '2025-09-10 06:08:10', '2025-09-10 06:38:26'),
(84, 21, '3', 'Insider threats', '2025-09-10 06:08:10', '2025-09-10 06:38:26'),
(85, 22, '0', 'Regular patching', '2025-09-10 06:08:10', '2025-09-10 06:38:25'),
(86, 22, '1', 'Strong authentication', '2025-09-10 06:08:10', '2025-09-10 06:38:26'),
(87, 22, '2', 'Continuous monitoring', '2025-09-10 06:08:10', '2025-09-10 06:38:26'),
(88, 22, '3', 'Encryption', '2025-09-10 06:08:10', '2025-09-10 06:38:26'),
(89, 23, '0', 'Hosting applications', '2025-09-10 06:10:32', '2025-09-10 06:38:25'),
(90, 23, '1', 'Managing virtual servers', '2025-09-10 06:10:32', '2025-09-10 06:38:26'),
(91, 23, '2', 'Cloud security', '2025-09-10 06:10:32', '2025-09-10 06:38:26'),
(92, 23, '3', 'Cost optimization', '2025-09-10 06:10:32', '2025-09-10 06:38:26'),
(93, 24, '0', 'AWS', '2025-09-10 06:10:32', '2025-09-10 06:38:25'),
(94, 24, '1', 'Microsoft Azure', '2025-09-10 06:10:32', '2025-09-10 06:38:26'),
(95, 24, '2', 'Google Cloud', '2025-09-10 06:10:32', '2025-09-10 06:38:26'),
(96, 24, '3', 'IBM Cloud', '2025-09-10 06:10:32', '2025-09-10 06:38:26'),
(97, 25, '0', 'Scalability', '2025-09-10 06:10:32', '2025-09-10 06:38:25'),
(98, 25, '1', 'Security', '2025-09-10 06:10:32', '2025-09-10 06:38:26'),
(99, 25, '2', 'Performance', '2025-09-10 06:10:32', '2025-09-10 06:38:26'),
(100, 25, '3', 'Reliability', '2025-09-10 06:10:32', '2025-09-10 06:38:26'),
(101, 26, '0', 'Cloud engineer', '2025-09-10 06:10:32', '2025-09-10 06:38:25'),
(102, 26, '1', 'DevOps engineer', '2025-09-10 06:10:32', '2025-09-10 06:38:26'),
(103, 26, '2', 'Cloud security specialist', '2025-09-10 06:10:32', '2025-09-10 06:38:26'),
(104, 26, '3', 'Cloud architect', '2025-09-10 06:10:32', '2025-09-10 06:38:26'),
(105, 27, '0', 'Setting up CI/CD pipelines', '2025-09-10 06:10:32', '2025-09-10 06:38:25'),
(106, 27, '1', 'Migrating apps to cloud', '2025-09-10 06:10:32', '2025-09-10 06:38:26'),
(107, 27, '2', 'Automating deployments', '2025-09-10 06:10:32', '2025-09-10 06:38:26'),
(108, 27, '3', 'Designing hybrid solutions', '2025-09-10 06:10:32', '2025-09-10 06:38:26'),
(109, 28, '0', 'SaaS', '2025-09-10 06:10:32', '2025-09-10 06:38:25'),
(110, 28, '1', 'PaaS', '2025-09-10 06:10:32', '2025-09-10 06:38:26'),
(111, 28, '2', 'IaaS', '2025-09-10 06:10:32', '2025-09-10 06:38:26'),
(112, 28, '3', 'Serverless', '2025-09-10 06:10:32', '2025-09-10 06:38:26'),
(113, 29, '0', 'Data cleaning', '2025-09-10 06:10:33', '2025-09-10 06:38:25'),
(114, 29, '1', 'Visualization', '2025-09-10 06:10:33', '2025-09-10 06:38:26'),
(115, 29, '2', 'Predictive analytics', '2025-09-10 06:10:33', '2025-09-10 06:38:26'),
(116, 29, '3', 'Building models', '2025-09-10 06:10:33', '2025-09-10 06:38:26'),
(121, 31, '0', 'Predicting sales trends', '2025-09-10 06:10:33', '2025-09-10 06:38:25'),
(122, 31, '1', 'Analyzing social media data', '2025-09-10 06:10:33', '2025-09-10 06:38:26'),
(123, 31, '2', 'Fraud detection', '2025-09-10 06:10:33', '2025-09-10 06:38:26'),
(124, 31, '3', 'Customer segmentation', '2025-09-10 06:10:33', '2025-09-10 06:38:26'),
(125, 32, '0', 'Accuracy', '2025-09-10 06:10:33', '2025-09-10 06:38:25'),
(126, 32, '1', 'Speed', '2025-09-10 06:10:33', '2025-09-10 06:38:26'),
(127, 32, '2', 'Data quality', '2025-09-10 06:10:33', '2025-09-10 06:38:26'),
(128, 32, '3', 'Visualization clarity', '2025-09-10 06:10:33', '2025-09-10 06:38:26'),
(129, 33, '0', 'Data analyst', '2025-09-10 06:10:33', '2025-09-10 06:38:25'),
(130, 33, '1', 'Data engineer', '2025-09-10 06:10:33', '2025-09-10 06:38:26'),
(131, 33, '2', 'Data scientist', '2025-09-10 06:10:33', '2025-09-10 06:38:26'),
(132, 33, '3', 'Business intelligence developer', '2025-09-10 06:10:33', '2025-09-10 06:38:26'),
(133, 34, '0', 'Finance', '2025-09-10 06:10:33', '2025-09-10 06:38:25'),
(134, 34, '1', 'Healthcare', '2025-09-10 06:10:33', '2025-09-10 06:38:26'),
(135, 34, '2', 'Marketing', '2025-09-10 06:10:33', '2025-09-10 06:38:26'),
(136, 34, '3', 'Sports', '2025-09-10 06:10:33', '2025-09-10 06:38:26'),
(137, 35, '0', 'Coding game mechanics', '2025-09-10 06:11:58', '2025-09-10 06:38:25'),
(138, 35, '1', 'Designing levels', '2025-09-10 06:11:58', '2025-09-10 06:38:26'),
(139, 35, '2', '3D modeling', '2025-09-10 06:11:58', '2025-09-10 06:38:26'),
(140, 35, '3', 'Game testing', '2025-09-10 06:11:58', '2025-09-10 06:38:26'),
(141, 36, '0', 'Unity', '2025-09-10 06:11:58', '2025-09-10 06:38:25'),
(142, 36, '1', 'Unreal Engine', '2025-09-10 06:11:58', '2025-09-10 06:38:26'),
(143, 36, '2', 'Godot', '2025-09-10 06:11:58', '2025-09-10 06:38:26'),
(144, 36, '3', 'CryEngine', '2025-09-10 06:11:58', '2025-09-10 06:38:26'),
(145, 37, '0', 'RPG', '2025-09-10 06:11:58', '2025-09-10 06:38:25'),
(146, 37, '1', 'Shooter', '2025-09-10 06:11:58', '2025-09-10 06:38:26'),
(147, 37, '2', 'Puzzle', '2025-09-10 06:11:58', '2025-09-10 06:38:26'),
(148, 37, '3', 'Simulation', '2025-09-10 06:11:58', '2025-09-10 06:38:26'),
(149, 38, '0', 'Graphics', '2025-09-10 06:11:58', '2025-09-10 06:38:25'),
(150, 38, '1', 'Gameplay', '2025-09-10 06:11:58', '2025-09-10 06:38:26'),
(151, 38, '2', 'Storytelling', '2025-09-10 06:11:58', '2025-09-10 06:38:26'),
(152, 38, '3', 'Performance', '2025-09-10 06:11:58', '2025-09-10 06:38:26'),
(153, 39, '0', 'Gameplay programmer', '2025-09-10 06:11:58', '2025-09-10 06:38:25'),
(154, 39, '1', 'Game designer', '2025-09-10 06:11:58', '2025-09-10 06:38:26'),
(155, 39, '2', 'Technical artist', '2025-09-10 06:11:58', '2025-09-10 06:38:26'),
(156, 39, '3', 'QA tester', '2025-09-10 06:11:58', '2025-09-10 06:38:26'),
(157, 40, '0', 'Indie studio', '2025-09-10 06:11:58', '2025-09-10 06:38:25'),
(158, 40, '1', 'AAA studio', '2025-09-10 06:11:58', '2025-09-10 06:38:26'),
(159, 40, '2', 'Mobile game company', '2025-09-10 06:11:58', '2025-09-10 06:38:26'),
(160, 40, '3', 'VR/AR game company', '2025-09-10 06:11:58', '2025-09-10 06:38:26'),
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
(185, 47, '0', 'Smart home devices', '2025-09-10 06:14:47', '2025-09-10 06:38:25'),
(186, 47, '1', 'Wearables', '2025-09-10 06:14:47', '2025-09-10 06:38:26'),
(187, 47, '2', 'Smart cities', '2025-09-10 06:14:47', '2025-09-10 06:38:26'),
(188, 47, '3', 'Industrial IoT', '2025-09-10 06:14:47', '2025-09-10 06:38:26'),
(189, 48, '0', 'MQTT', '2025-09-10 06:14:47', '2025-09-10 06:38:25'),
(190, 48, '1', 'CoAP', '2025-09-10 06:14:47', '2025-09-10 06:38:26'),
(191, 48, '2', 'Zigbee', '2025-09-10 06:14:47', '2025-09-10 06:38:26'),
(192, 48, '3', 'LoRaWAN', '2025-09-10 06:14:47', '2025-09-10 06:38:26'),
(193, 49, '0', 'Security', '2025-09-10 06:14:47', '2025-09-10 06:38:25'),
(194, 49, '1', 'Low power consumption', '2025-09-10 06:14:47', '2025-09-10 06:38:26'),
(195, 49, '2', 'Scalability', '2025-09-10 06:14:47', '2025-09-10 06:38:26'),
(196, 49, '3', 'Real-time data', '2025-09-10 06:14:47', '2025-09-10 06:38:26'),
(197, 50, '0', 'Hardware programming', '2025-09-10 06:14:47', '2025-09-10 06:38:25'),
(198, 50, '1', 'Sensor integration', '2025-09-10 06:14:47', '2025-09-10 06:38:26'),
(199, 50, '2', 'Cloud data storage', '2025-09-10 06:14:47', '2025-09-10 06:38:26'),
(200, 50, '3', 'IoT app development', '2025-09-10 06:14:47', '2025-09-10 06:38:26'),
(201, 51, '0', 'Smart farming system', '2025-09-10 06:14:47', '2025-09-10 06:38:25'),
(202, 51, '1', 'Health monitoring device', '2025-09-10 06:14:47', '2025-09-10 06:38:26'),
(203, 51, '2', 'Traffic control system', '2025-09-10 06:14:47', '2025-09-10 06:38:26'),
(204, 51, '3', 'Connected cars', '2025-09-10 06:14:47', '2025-09-10 06:38:26'),
(205, 52, '0', 'Embedded systems', '2025-09-10 06:14:47', '2025-09-10 06:38:25'),
(206, 52, '1', 'Networking', '2025-09-10 06:14:47', '2025-09-10 06:38:26'),
(207, 52, '2', 'Data analytics', '2025-09-10 06:14:47', '2025-09-10 06:38:26'),
(208, 52, '3', 'Security design', '2025-09-10 06:14:47', '2025-09-10 06:38:26'),
(209, 53, '0', 'Cryptocurrency', '2025-09-10 06:18:36', '2025-09-10 06:38:25'),
(210, 53, '1', 'Smart contracts', '2025-09-10 06:18:36', '2025-09-10 06:38:26'),
(211, 53, '2', 'NFTs', '2025-09-10 06:18:36', '2025-09-10 06:38:26'),
(212, 53, '3', 'Supply chain', '2025-09-10 06:18:36', '2025-09-10 06:38:26'),
(213, 54, '0', 'Ethereum', '2025-09-10 06:18:36', '2025-09-10 06:38:25'),
(214, 54, '1', 'Hyperledger', '2025-09-10 06:18:36', '2025-09-10 06:38:26'),
(215, 54, '2', 'Solana', '2025-09-10 06:18:36', '2025-09-10 06:38:26'),
(216, 54, '3', 'Polkadot', '2025-09-10 06:18:36', '2025-09-10 06:38:26'),
(217, 55, '0', 'Writing smart contracts', '2025-09-10 06:18:36', '2025-09-10 06:38:25'),
(218, 55, '1', 'Building dApps', '2025-09-10 06:18:36', '2025-09-10 06:38:26'),
(219, 55, '2', 'Designing consensus', '2025-09-10 06:18:36', '2025-09-10 06:38:26'),
(220, 55, '3', 'Tokenomics', '2025-09-10 06:18:36', '2025-09-10 06:38:26'),
(221, 56, '0', 'Voting system', '2025-09-10 06:18:36', '2025-09-10 06:38:25'),
(222, 56, '1', 'Crypto exchange', '2025-09-10 06:18:36', '2025-09-10 06:38:26'),
(223, 56, '2', 'NFT marketplace', '2025-09-10 06:18:36', '2025-09-10 06:38:26'),
(224, 56, '3', 'Supply chain tracker', '2025-09-10 06:18:36', '2025-09-10 06:38:26'),
(225, 57, '0', 'Transparency', '2025-09-10 06:18:36', '2025-09-10 06:38:25'),
(226, 57, '1', 'Security', '2025-09-10 06:18:36', '2025-09-10 06:38:26'),
(227, 57, '2', 'Scalability', '2025-09-10 06:18:36', '2025-09-10 06:38:26'),
(228, 57, '3', 'Speed', '2025-09-10 06:18:36', '2025-09-10 06:38:26'),
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
(281, 1, '0', 'Designing intelligent systems', '2025-09-09 22:27:45', '2025-09-09 22:27:45'),
(282, 1, '1', 'Protecting networks from threats', '2025-09-09 22:27:45', '2025-09-09 22:27:45'),
(283, 1, '2', 'Analyzing large datasets', '2025-09-09 22:27:45', '2025-09-09 22:27:45'),
(284, 1, '3', 'Creating mobile or web apps', '2025-09-09 22:27:45', '2025-09-09 22:27:45'),
(285, 2, '0', 'Designing user experiences', '2025-09-09 22:27:49', '2025-09-09 22:27:49'),
(286, 2, '1', 'Building game mechanics', '2025-09-09 22:27:49', '2025-09-09 22:27:49'),
(287, 2, '2', 'Deploying cloud solutions', '2025-09-09 22:27:49', '2025-09-09 22:27:49'),
(288, 2, '3', 'Programming hardware integrations', '2025-09-09 22:27:49', '2025-09-09 22:27:49'),
(289, 3, '0', 'Understanding algorithms and logic', '2025-09-09 22:27:50', '2025-09-09 22:27:50'),
(290, 3, '1', 'Investigating system breaches', '2025-09-09 22:27:50', '2025-09-09 22:27:50'),
(291, 3, '2', 'Exploring decentralized transactions', '2025-09-09 22:27:50', '2025-09-09 22:27:50'),
(292, 3, '3', 'Automating physical processes', '2025-09-09 22:27:50', '2025-09-09 22:27:50'),
(293, 4, '0', 'Cloud-based infrastructure', '2025-09-09 22:27:52', '2025-09-09 22:27:52'),
(294, 4, '1', 'A gaming studio', '2025-09-09 22:27:52', '2025-09-09 22:27:52'),
(295, 4, '2', 'A design lab testing usability', '2025-09-09 22:27:52', '2025-09-09 22:27:52'),
(296, 4, '3', 'A robotics research center', '2025-09-09 22:27:52', '2025-09-09 22:27:52'),
(297, 5, '0', 'Solving security challenges', '2025-09-09 22:27:54', '2025-09-09 22:27:54'),
(298, 5, '1', 'Discovering patterns in data', '2025-09-09 22:27:54', '2025-09-09 22:27:54'),
(299, 5, '2', 'Innovating with AI', '2025-09-09 22:27:54', '2025-09-09 22:27:54'),
(300, 5, '3', 'Building immersive worlds', '2025-09-09 22:27:54', '2025-09-09 22:27:54'),
(301, 6, '0', 'Writing smart contracts', '2025-09-09 22:27:59', '2025-09-09 22:27:59'),
(302, 6, '1', 'Designing smart devices', '2025-09-09 22:27:59', '2025-09-09 22:27:59'),
(303, 6, '2', 'Programming user-facing apps', '2025-09-09 22:27:59', '2025-09-09 22:27:59'),
(304, 6, '3', 'Optimizing system performance', '2025-09-09 22:27:59', '2025-09-09 22:27:59'),
(305, 7, '0', 'TensorFlow or PyTorch', '2025-09-09 22:28:01', '2025-09-09 22:28:01'),
(306, 7, '1', 'Wireshark or Metasploit', '2025-09-09 22:28:01', '2025-09-09 22:28:01'),
(307, 7, '2', 'Unity or Unreal Engine', '2025-09-09 22:28:01', '2025-09-09 22:28:01'),
(308, 7, '3', 'Figma or Adobe XD', '2025-09-09 22:28:01', '2025-09-09 22:28:01'),
(309, 8, '0', 'Smart home automation', '2025-09-09 22:28:04', '2025-09-09 22:28:04'),
(310, 8, '1', 'Fraud detection using data', '2025-09-09 22:28:04', '2025-09-09 22:28:04'),
(311, 8, '2', 'Multiplayer online game', '2025-09-09 22:28:04', '2025-09-09 22:28:04'),
(312, 8, '3', 'Cloud-based storage system', '2025-09-09 22:28:04', '2025-09-09 22:28:04'),
(313, 9, '0', 'AI assistants and chatbots', '2025-09-09 22:28:06', '2025-09-09 22:28:06'),
(314, 9, '1', 'Cryptocurrency platforms', '2025-09-09 22:28:06', '2025-09-09 22:28:06'),
(315, 9, '2', 'Self-driving cars', '2025-09-09 22:28:06', '2025-09-09 22:28:06'),
(316, 9, '3', 'Secure online banking', '2025-09-09 22:28:06', '2025-09-09 22:28:06'),
(321, 12, '0', 'Machine Learning', '2025-09-09 22:28:10', '2025-09-09 22:28:10'),
(322, 12, '1', 'Deep Learning', '2025-09-09 22:28:10', '2025-09-09 22:28:10'),
(323, 12, '2', 'Natural Language Processing', '2025-09-09 22:28:10', '2025-09-09 22:28:10'),
(324, 12, '3', 'Computer Vision', '2025-09-09 22:28:10', '2025-09-09 22:28:10'),
(325, 10, '0', 'By experimenting with algorithms', '2025-09-09 22:28:12', '2025-09-09 22:28:12'),
(326, 10, '1', 'By securing weaknesses', '2025-09-09 22:28:12', '2025-09-09 22:28:12'),
(327, 10, '2', 'By designing for better usability', '2025-09-09 22:28:12', '2025-09-09 22:28:12'),
(328, 10, '3', 'By coding solutions into software', '2025-09-09 22:28:12', '2025-09-09 22:28:12'),
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
(349, 30, '0', 'Python (pandas, NumPy)', '2025-09-09 22:28:38', '2025-09-09 22:28:38'),
(350, 30, '1', 'R', '2025-09-09 22:28:38', '2025-09-09 22:28:38'),
(351, 30, '2', 'SQL', '2025-09-09 22:28:38', '2025-09-09 22:28:38'),
(352, 30, '3', 'Tableau/Power BI', '2025-09-09 22:28:38', '2025-09-09 22:28:38'),
(353, 58, '0', 'Blockchain developer', '2025-09-09 22:28:44', '2025-09-09 22:28:44'),
(354, 58, '1', 'Smart contract auditor', '2025-09-09 22:28:44', '2025-09-09 22:28:44'),
(355, 58, '2', 'Blockchain researcher', '2025-09-09 22:28:44', '2025-09-09 22:28:44'),
(356, 58, '3', 'Crypto analyst', '2025-09-09 22:28:44', '2025-09-09 22:28:44');

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
(1, 3, 1, 0.14, '2025-08-21 10:49:16', '2025-08-21 10:49:16'),
(2, 3, 2, 0.13, '2025-08-21 10:49:16', '2025-08-21 10:49:16'),
(3, 3, 3, 0.04, '2025-08-21 10:49:16', '2025-08-21 10:49:16'),
(4, 3, 4, 0.1, '2025-08-21 10:49:16', '2025-08-21 10:49:16'),
(5, 3, 5, 0.03, '2025-08-21 10:49:16', '2025-08-21 10:49:16'),
(6, 3, 6, 0.1, '2025-08-21 10:49:16', '2025-08-21 10:49:16'),
(7, 3, 7, 0.03, '2025-08-21 10:49:16', '2025-08-21 10:49:16'),
(8, 3, 8, 0.1, '2025-08-21 10:49:16', '2025-08-21 10:49:16'),
(9, 3, 9, 0.1, '2025-08-21 10:49:16', '2025-08-21 10:49:16'),
(10, 3, 10, 0.11, '2025-08-21 10:49:16', '2025-08-21 10:49:16'),
(11, 3, 11, 0.12, '2025-08-21 10:49:16', '2025-08-21 10:49:16'),
(12, 4, 1, 0.13, '2025-08-21 11:23:00', '2025-08-21 11:23:00'),
(13, 4, 2, 0.06, '2025-08-21 11:23:00', '2025-08-21 11:23:00'),
(14, 4, 3, 0.2, '2025-08-21 11:23:00', '2025-08-21 11:23:00'),
(15, 4, 4, 0.08, '2025-08-21 11:23:00', '2025-08-21 11:23:00'),
(16, 4, 5, 0.08, '2025-08-21 11:23:00', '2025-08-21 11:23:00'),
(17, 4, 6, 0.18, '2025-08-21 11:23:00', '2025-08-21 11:23:00'),
(18, 4, 7, 0.04, '2025-08-21 11:23:00', '2025-08-21 11:23:00'),
(19, 4, 8, 0.05, '2025-08-21 11:23:00', '2025-08-21 11:23:00'),
(20, 4, 9, 0.05, '2025-08-21 11:23:00', '2025-08-21 11:23:00'),
(21, 4, 10, 0.06, '2025-08-21 11:23:00', '2025-08-21 11:23:00'),
(22, 4, 11, 0.07, '2025-08-21 11:23:00', '2025-08-21 11:23:00'),
(23, 5, 1, 0.08, '2025-08-21 19:37:36', '2025-08-21 19:37:36'),
(24, 5, 2, 0.08, '2025-08-21 19:37:36', '2025-08-21 19:37:36'),
(25, 5, 3, 0.02, '2025-08-21 19:37:36', '2025-08-21 19:37:36'),
(26, 5, 4, 0.14, '2025-08-21 19:37:36', '2025-08-21 19:37:36'),
(27, 5, 5, 0.07, '2025-08-21 19:37:36', '2025-08-21 19:37:36'),
(28, 5, 6, 0.15, '2025-08-21 19:37:36', '2025-08-21 19:37:36'),
(29, 5, 7, 0.08, '2025-08-21 19:37:36', '2025-08-21 19:37:36'),
(30, 5, 8, 0.13, '2025-08-21 19:37:36', '2025-08-21 19:37:36'),
(31, 5, 9, 0.07, '2025-08-21 19:37:36', '2025-08-21 19:37:36'),
(32, 5, 10, 0.14, '2025-08-21 19:37:36', '2025-08-21 19:37:36'),
(33, 5, 11, 0.04, '2025-08-21 19:37:36', '2025-08-21 19:37:36'),
(45, 8, 1, 0.12, '2025-08-22 10:42:46', '2025-08-22 10:42:46'),
(46, 8, 2, 0.52, '2025-08-22 10:42:46', '2025-08-22 10:42:46'),
(47, 8, 3, 0.03, '2025-08-22 10:42:46', '2025-08-22 10:42:46'),
(48, 8, 4, 0.04, '2025-08-22 10:42:46', '2025-08-22 10:42:46'),
(49, 8, 5, 0.04, '2025-08-22 10:42:46', '2025-08-22 10:42:46'),
(50, 8, 6, 0.04, '2025-08-22 10:42:46', '2025-08-22 10:42:46'),
(51, 8, 7, 0.02, '2025-08-22 10:42:46', '2025-08-22 10:42:46'),
(52, 8, 8, 0.03, '2025-08-22 10:42:46', '2025-08-22 10:42:46'),
(53, 8, 9, 0.07, '2025-08-22 10:42:46', '2025-08-22 10:42:46'),
(54, 8, 10, 0.04, '2025-08-22 10:42:46', '2025-08-22 10:42:46'),
(55, 8, 11, 0.05, '2025-08-22 10:42:46', '2025-08-22 10:42:46'),
(67, 1, 1, 0.04, '2025-08-23 08:14:11', '2025-08-23 08:14:11'),
(68, 1, 2, 0.04, '2025-08-23 08:14:11', '2025-08-23 08:14:11'),
(69, 1, 3, 0.17, '2025-08-23 08:14:11', '2025-08-23 08:14:11'),
(70, 1, 4, 0.1, '2025-08-23 08:14:11', '2025-08-23 08:14:11'),
(71, 1, 5, 0.11, '2025-08-23 08:14:11', '2025-08-23 08:14:11'),
(72, 1, 6, 0.08, '2025-08-23 08:14:11', '2025-08-23 08:14:11'),
(73, 1, 7, 0.19, '2025-08-23 08:14:11', '2025-08-23 08:14:11'),
(74, 1, 8, 0.05, '2025-08-23 08:14:11', '2025-08-23 08:14:11'),
(75, 1, 9, 0.09, '2025-08-23 08:14:11', '2025-08-23 08:14:11'),
(76, 1, 10, 0.06, '2025-08-23 08:14:11', '2025-08-23 08:14:11'),
(77, 1, 11, 0.07, '2025-08-23 08:14:11', '2025-08-23 08:14:11'),
(78, 12, 1, 0.09, '2025-08-24 07:53:39', '2025-08-24 07:53:39'),
(79, 12, 2, 0.11, '2025-08-24 07:53:39', '2025-08-24 07:53:39'),
(80, 12, 3, 0.12, '2025-08-24 07:53:39', '2025-08-24 07:53:39'),
(81, 12, 4, 0.09, '2025-08-24 07:53:39', '2025-08-24 07:53:39'),
(82, 12, 5, 0.06, '2025-08-24 07:53:39', '2025-08-24 07:53:39'),
(83, 12, 6, 0.13, '2025-08-24 07:53:39', '2025-08-24 07:53:39'),
(84, 12, 7, 0.19, '2025-08-24 07:53:39', '2025-08-24 07:53:39'),
(85, 12, 8, 0.05, '2025-08-24 07:53:39', '2025-08-24 07:53:39'),
(86, 12, 9, 0.05, '2025-08-24 07:53:39', '2025-08-24 07:53:39'),
(87, 12, 10, 0.06, '2025-08-24 07:53:39', '2025-08-24 07:53:39'),
(88, 12, 11, 0.05, '2025-08-24 07:53:39', '2025-08-24 07:53:39'),
(89, 13, 1, 0.08, '2025-09-09 06:21:00', '2025-09-09 06:21:00'),
(90, 13, 2, 0.05, '2025-09-09 06:21:00', '2025-09-09 06:21:00'),
(91, 13, 3, 0.01, '2025-09-09 06:21:00', '2025-09-09 06:21:00'),
(92, 13, 4, 0.04, '2025-09-09 06:21:00', '2025-09-09 06:21:00'),
(93, 13, 5, 0.03, '2025-09-09 06:21:00', '2025-09-09 06:21:00'),
(94, 13, 6, 0.08, '2025-09-09 06:21:00', '2025-09-09 06:21:00'),
(95, 13, 7, 0.05, '2025-09-09 06:21:00', '2025-09-09 06:21:00'),
(96, 13, 8, 0.05, '2025-09-09 06:21:00', '2025-09-09 06:21:00'),
(97, 13, 9, 0.02, '2025-09-09 06:21:00', '2025-09-09 06:21:00'),
(98, 13, 10, 0.03, '2025-09-09 06:21:00', '2025-09-09 06:21:00'),
(99, 13, 11, 0.56, '2025-09-09 06:21:00', '2025-09-09 06:21:00'),
(100, 14, 1, 0.05, '2025-09-09 06:44:27', '2025-09-09 06:44:27'),
(101, 14, 2, 0.06, '2025-09-09 06:44:27', '2025-09-09 06:44:27'),
(102, 14, 3, 0.06, '2025-09-09 06:44:27', '2025-09-09 06:44:27'),
(103, 14, 4, 0.06, '2025-09-09 06:44:27', '2025-09-09 06:44:27'),
(104, 14, 5, 0.13, '2025-09-09 06:44:27', '2025-09-09 06:44:27'),
(105, 14, 6, 0.02, '2025-09-09 06:44:27', '2025-09-09 06:44:27'),
(106, 14, 7, 0.05, '2025-09-09 06:44:27', '2025-09-09 06:44:27'),
(107, 14, 8, 0.12, '2025-09-09 06:44:27', '2025-09-09 06:44:27'),
(108, 14, 9, 0.33, '2025-09-09 06:44:27', '2025-09-09 06:44:27'),
(109, 14, 10, 0.08, '2025-09-09 06:44:27', '2025-09-09 06:44:27'),
(110, 14, 11, 0.04, '2025-09-09 06:44:27', '2025-09-09 06:44:27'),
(111, 15, 1, 0.04, '2025-09-09 07:00:29', '2025-09-09 07:00:29'),
(112, 15, 2, 0.02, '2025-09-09 07:00:29', '2025-09-09 07:00:29'),
(113, 15, 3, 0.04, '2025-09-09 07:00:29', '2025-09-09 07:00:29'),
(114, 15, 4, 0.06, '2025-09-09 07:00:29', '2025-09-09 07:00:29'),
(115, 15, 5, 0.24, '2025-09-09 07:00:29', '2025-09-09 07:00:29'),
(116, 15, 6, 0.11, '2025-09-09 07:00:29', '2025-09-09 07:00:29'),
(117, 15, 7, 0.37, '2025-09-09 07:00:29', '2025-09-09 07:00:29'),
(118, 15, 8, 0.04, '2025-09-09 07:00:29', '2025-09-09 07:00:29'),
(119, 15, 9, 0.04, '2025-09-09 07:00:29', '2025-09-09 07:00:29'),
(120, 15, 10, 0.04, '2025-09-09 07:00:29', '2025-09-09 07:00:29'),
(121, 15, 11, 0, '2025-09-09 07:00:29', '2025-09-09 07:00:29'),
(122, 16, 1, 0.06, '2025-09-09 22:39:57', '2025-09-09 22:39:57'),
(123, 16, 2, 0.09, '2025-09-09 22:39:57', '2025-09-09 22:39:57'),
(124, 16, 3, 0.15, '2025-09-09 22:39:57', '2025-09-09 22:39:57'),
(125, 16, 4, 0.21, '2025-09-09 22:39:57', '2025-09-09 22:39:57'),
(126, 16, 5, 0.06, '2025-09-09 22:39:57', '2025-09-09 22:39:57'),
(127, 16, 6, 0.18, '2025-09-09 22:39:57', '2025-09-09 22:39:57'),
(128, 16, 7, 0.03, '2025-09-09 22:39:57', '2025-09-09 22:39:57'),
(129, 16, 8, 0.08, '2025-09-09 22:39:57', '2025-09-09 22:39:57'),
(130, 16, 9, 0.05, '2025-09-09 22:39:57', '2025-09-09 22:39:57'),
(131, 16, 10, 0.07, '2025-09-09 22:39:57', '2025-09-09 22:39:57'),
(132, 16, 11, 0.02, '2025-09-09 22:39:57', '2025-09-09 22:39:57');

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
(6, 1);

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
(1, 'Artificial Intelligence & ML', 'AI, machine learning and neural networks', '2025-07-16 02:19:37', '2025-07-16 02:19:37', NULL),
(2, 'Web Development', 'Frontend & backend web technologies', '2025-07-16 02:19:37', '2025-07-16 02:19:37', NULL),
(3, 'Mobile Development', 'iOS, Android and cross-platform apps', '2025-07-16 02:19:37', '2025-07-16 02:19:37', NULL),
(4, 'Data Science', 'Data analysis, statistics, and visualization', '2025-07-16 02:19:37', '2025-07-16 02:19:37', NULL),
(5, 'Cybersecurity', 'Security, penetration testing, cryptography', '2025-07-16 02:19:37', '2025-07-16 02:19:37', NULL),
(6, 'Cloud Computing', 'AWS, Azure, GCP and distributed systems', '2025-07-16 02:19:37', '2025-07-16 02:19:37', NULL),
(7, 'Internet of Things', 'Embedded systems and sensor networks', '2025-07-16 02:19:37', '2025-07-16 02:19:37', NULL),
(8, 'Game Development', '2D/3D game engines and design', '2025-07-16 02:19:37', '2025-07-16 02:19:37', NULL),
(9, 'DevOps', 'CI/CD, automation, and infrastructure as code', '2025-07-16 02:19:37', '2025-07-16 02:19:37', NULL),
(10, 'Blockchain', 'Distributed ledgers and smart contracts', '2025-07-16 02:19:37', '2025-07-16 02:19:37', NULL),
(11, 'UI/UX Design', 'User experience and interface design', '2025-07-16 02:19:37', '2025-07-16 02:19:37', NULL),
(12, 'Robotics', 'Design creation operation and application of robots', NULL, NULL, NULL),
(13, 'Software Development', 'Conceiving, designing, building, testing, deploying, and maintaining software programs', NULL, NULL, NULL);

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ice Ice', 'ice@music.com', NULL, '$2y$10$O2268dfvFMyGXEtKtUUD2unt2Y.sHtknNq/trguq89Woay08zzKri', '3IRmNzO7rUHFJoBg0u5W4Aq4C22EjwYN1Vtrgwfnuh91JUvi5wbzUpBCeLWZ', '2025-08-21 10:20:47', '2025-08-24 08:22:59'),
(3, 'My Real name', '123@gmail.com', NULL, '$2y$10$TlkcShjgXlNLKzO9Zf3.6eknnaJlyuSZyQXjaxf/gioGCeqUXFUtS', NULL, '2025-08-21 10:32:18', '2025-08-21 11:12:32'),
(4, 'Ice Ice Ice', 'iceiceice@gmail.com', NULL, '$2y$10$1hFsx8t9U3ry4IhI1XIZAerAn2fvfzWA14Pj4SmdfaZh9MdOSrUBO', NULL, '2025-08-21 11:12:57', '2025-08-21 11:13:23'),
(5, 'alvin castro', 'alvin@123.com', NULL, '$2y$10$qo.W4ch7BsI7/nKPoBRr2OhuNECFp0mhc7C8WcurlFhrnPe.XEena', NULL, '2025-08-21 19:34:07', '2025-08-21 19:34:07'),
(6, 'admin', 'admin@manage.com', NULL, '$2y$10$8A08kB1BgoDoS9iCt4dKcuXWHwv0N1gVEkcYghyVjLlPWRz.9bs1O', NULL, '2025-08-22 07:26:56', '2025-08-22 07:26:56'),
(7, 'User byAdmin', 'user123@gmail.com', NULL, '$2y$10$FBE1AZ0RIrbl3HH8nBmBVOQY/ulUSM11hi5GDJ.nNAgpmn7Qrk4C.', NULL, '2025-08-22 09:55:41', '2025-08-22 09:55:41'),
(8, 'Daniel Callejas', 'sample@999.com', NULL, '$2y$10$Es/vo9vEqCwVKpecCj4YluCfxotkFwGF5kG2P2GlqD1nUeVpK862C', NULL, '2025-08-22 10:39:09', '2025-08-22 10:43:48'),
(9, 'John Doe', 'weboracle.business@gmail.com', NULL, '$2y$10$Txi12dGRBZp7YxjSziJKLe/cjBefMPRz.8cAN5UhvjqwUgaOQXs7a', 'wKOauKHINebSRnKoIQoS0EzpkcTaht0o2dtnYc5jSGJr8jEYJ0BaGcN2cuII', '2025-08-23 11:23:22', '2025-08-23 11:57:19'),
(10, 'wow wow', 'wow@gmail.com', NULL, '$2y$10$nt8LVKORaqlASBeC0I1fj.UbGBKX51akvA4cTEAW83OnsA64BScQG', NULL, '2025-08-23 15:16:12', '2025-08-23 15:16:12'),
(11, 'pasword', 'pass@gmail.com', NULL, '$2y$10$fCOZ1zwfPRusM422MR6dyOp30XfBWUmmCP8CbEESAowNlvLfci7Sq', NULL, '2025-08-24 07:41:09', '2025-08-24 07:41:09'),
(12, 'Mark Daniel Callejas', 'buyer1@example.com', NULL, '$2y$10$n3YTAm4P1Qo5QWfWP3ge9uy4jmOefM3NnJrOaW9M84Rw1627G4uZa', NULL, '2025-08-24 07:51:44', '2025-08-24 07:51:44'),
(13, 'survey person', 'survey@manage.com', NULL, '$2y$10$iW6aDewe6OmRi9LipcW1veG/emhCLWnqDUp.8O6cd6L13e6jBMNVO', NULL, '2025-09-09 06:19:06', '2025-09-09 06:19:06'),
(14, 'survey person2', 'survey1@manage.com', NULL, '$2y$10$ICHv9nhVFM5rGn9JNnB7Q.OIinYpXdGhHw291Gwv72NrUcn9TQMDG', NULL, '2025-09-09 06:42:30', '2025-09-09 06:42:30'),
(15, 'survey person3', 'survey2@manage.com', NULL, '$2y$10$AL4B2DdGzgJkVLZlP78FY.HCJCkLwkG0c9pRr2ZLS7ghELziX6/MK', NULL, '2025-09-09 06:57:39', '2025-09-09 06:57:39'),
(16, 'sample 1', 'sample22@gmail.com', NULL, '$2y$10$fyDox7uS8qWdRhhuZAUbhe/RmI3VEmuTB2FbhioJMvgSrxgqPujti', NULL, '2025-09-09 22:30:50', '2025-09-09 22:30:50');

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
(1, 1, 5, 'I personally think that the result was allign to my strenghth!', 1, 'maybe categorize the questionaires', '2025-09-09 06:17:16', '2025-09-09 06:17:16'),
(3, 14, 3, NULL, 0, NULL, '2025-09-09 06:52:11', '2025-09-09 06:52:11'),
(5, 15, 5, NULL, 1, NULL, '2025-09-09 07:44:18', '2025-09-09 07:44:18'),
(6, 13, 5, NULL, 1, NULL, '2025-09-09 07:44:57', '2025-09-09 07:44:57');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `question_options`
--
ALTER TABLE `question_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=357;

--
-- AUTO_INCREMENT for table `recommendations`
--
ALTER TABLE `recommendations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `student_profiles`
--
ALTER TABLE `student_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tech_fields`
--
ALTER TABLE `tech_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_survey_responses`
--
ALTER TABLE `user_survey_responses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
