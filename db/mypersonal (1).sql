-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 21 Jan 2021 pada 05.59
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mypersonal`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tm_education`
--

CREATE TABLE `tm_education` (
  `education_id` int(11) NOT NULL,
  `education_name` varchar(100) NOT NULL,
  `start_date` date DEFAULT NULL,
  `finish_date` date DEFAULT NULL,
  `description` varchar(1000) NOT NULL,
  `education_type` varchar(100) NOT NULL,
  `field` varchar(50) NOT NULL,
  `update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tm_education`
--

INSERT INTO `tm_education` (`education_id`, `education_name`, `start_date`, `finish_date`, `description`, `education_type`, `field`, `update_date`) VALUES
(1, 'SMKN5 Negeri Kota Bekasi', '2016-06-01', '2019-06-01', 'No many activity as long school in SMK5 Kota Bekasi. Just Palang Merah Remaja weekly activity. Im very interested while studied programming lesson, especially PHP. At that time when third grade, im started to working as a freelancer.', 'Senior High School', 'Software Engineering', '2020-12-06 23:03:29'),
(2, 'Bhayangkara University', '2020-10-01', NULL, '', 'Bachelor Degree', 'Information And Technology', '2020-12-24 13:40:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tm_experience`
--

CREATE TABLE `tm_experience` (
  `experience_id` int(11) NOT NULL,
  `company` varchar(200) NOT NULL,
  `start_date` date NOT NULL,
  `finish_date` date DEFAULT NULL,
  `job_position` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tm_experience`
--

INSERT INTO `tm_experience` (`experience_id`, `company`, `start_date`, `finish_date`, `job_position`, `description`, `date_time`) VALUES
(1, 'Projects.co.id', '2019-01-01', NULL, 'Writing & Web Development Freelancer', '', '2020-12-31 14:49:26'),
(2, 'PT Aplikanusa Lintasarta, Jakarta Pusat', '2019-08-05', NULL, 'Oracle Engineer', '', '2020-12-31 14:49:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tm_internship`
--

CREATE TABLE `tm_internship` (
  `internship_id` int(11) NOT NULL,
  `company` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `finish_date` date NOT NULL,
  `description` varchar(1000) NOT NULL,
  `internship_position` varchar(100) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tm_internship`
--

INSERT INTO `tm_internship` (`internship_id`, `company`, `start_date`, `finish_date`, `description`, `internship_position`, `date_time`) VALUES
(1, 'PT Selahonje Jaya Abadi (Hisana Group)', '2017-05-29', '2017-09-30', 'PT Selahonje Jaya Abadi is a company producing food and drink. I started internship on May and ends on September 2017. ', 'Marketing', '2020-12-24 14:00:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tm_users`
--

CREATE TABLE `tm_users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone_number` bigint(15) NOT NULL,
  `password` mediumtext NOT NULL,
  `last_update` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `date_registered` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tm_users`
--

INSERT INTO `tm_users` (`user_id`, `email`, `full_name`, `phone_number`, `password`, `last_update`, `last_login`, `date_registered`) VALUES
(1, 'sulistioirvan@gmail.com', 'Irvan Sulistio', 87886569885, '$2y$12$s7uLX0qJvw9NHAmnuOXMduwhlYMmbBJMDDfSGmW3GLLSp3CrIV.gW', '2020-12-31 19:29:13', '2020-12-31 19:29:13', '2020-12-31 19:29:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_experience`
--

CREATE TABLE `tr_experience` (
  `detail_experience_id` int(11) NOT NULL,
  `experience_id` int(11) NOT NULL,
  `job_desc` varchar(1000) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tr_experience`
--

INSERT INTO `tr_experience` (`detail_experience_id`, `experience_id`, `job_desc`, `date_time`) VALUES
(1, 1, 'Writing SEO article with some category as client requested', '2020-12-31 15:18:20'),
(2, 1, 'Modification or add new fitur for website already finished before. Sometimes fixing bug.', '2020-12-31 15:24:07'),
(3, 1, 'Create a web application from zero with some programming languange (PHP, Javascript, Codeigniter, etc).  ', '2020-12-31 15:25:27'),
(4, 2, 'Maintenance & fixing bug internal application from my company. Im manage Financial Accounting System.', '2020-12-31 15:28:36'),
(5, 2, 'Create a SQL scripts from Oracle Database for user data requirement (Usually for audit report requirement or data that cannot provide from Application).', '2020-12-31 15:30:30'),
(6, 2, 'Handle a ticket from user who report a problem Application.', '2020-12-31 15:32:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_internship`
--

CREATE TABLE `tr_internship` (
  `detail_internship_id` int(11) NOT NULL,
  `internship_id` int(11) NOT NULL,
  `job_desc` varchar(1000) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tr_internship`
--

INSERT INTO `tr_internship` (`detail_internship_id`, `internship_id`, `job_desc`, `date_time`) VALUES
(1, 1, 'Input employee timesheet recap', '2020-12-26 16:43:07'),
(2, 1, 'Using SEO (Search Engine Optimization) to manage images content from company.', '2020-12-26 16:50:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_configurable`
--

CREATE TABLE `t_configurable` (
  `data_id` int(11) NOT NULL,
  `value` varchar(1000) NOT NULL,
  `description` varchar(100) NOT NULL,
  `content` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_configurable`
--

INSERT INTO `t_configurable` (`data_id`, `value`, `description`, `content`) VALUES
(1, '28 June 2001', 'Birthday', 'about'),
(2, 'Oracle Programmer & Backend Developer', 'Title', 'job'),
(3, '19', 'Age', 'About'),
(4, '+62 878 8656 9885', 'Phone', 'about'),
(5, 'Senior High School', 'Last Education', 'about'),
(6, 'Bekasi', 'City', 'about'),
(7, 'sulistioirvan@gmail.com', 'Email', 'about'),
(8, 'Available', 'Freelance', 'about'),
(9, 'Indonesia', 'Country', 'about'),
(10, 'Hello my name Irvan Sulistio from Indonesia. Currently, im working at Lintasarta for a year and a half and working as a Freelancer. Besides that, im studied at Bhayangkara University. For now, im interested with backend developer.', 'Describe', 'Describe'),
(11, 'Im still young, very energic, thirst for programming knowledge & communicative. Fast learner & problem solving is my power to come in Programming. I have other interest, like Astronomy, Sains, Technology, Artificial Intellegence, etc.', 'Little Description', 'Little Description'),
(12, 'Ujung Harapan, Kabupaten Bekasi', 'Location', 'Location'),
(13, 'sulistioirvan@gmail.com', 'Email', 'Email'),
(14, '+62 878 8656 9885', 'Phone', 'Phone'),
(15, 'irvan.png', 'Photo for about.', 'Photo Default');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_home`
--

CREATE TABLE `t_home` (
  `id` int(11) NOT NULL,
  `my_name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_home`
--

INSERT INTO `t_home` (`id`, `my_name`, `description`, `date_time`) VALUES
(1, 'Irvan Sulistio', 'Freelancer, Backend Developer', '2020-12-05 21:53:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_portfolio`
--

CREATE TABLE `t_portfolio` (
  `portfolio_id` int(11) NOT NULL,
  `application_name` varchar(1000) NOT NULL,
  `walpaper` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `requirements` varchar(1000) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_portfolio`
--

INSERT INTO `t_portfolio` (`portfolio_id`, `application_name`, `walpaper`, `description`, `requirements`, `date_time`) VALUES
(1, 'Aplikasi Perpustakaan dengan Scan QR Code', '', 'lorem lorem lorem lorem lorem lorem lorem lorem', '[ \r\n   { \"skills\": \"adaw\" }, \r\n   { \"skills\": \"cuk\" }\r\n]', '2020-12-31 16:56:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_skills`
--

CREATE TABLE `t_skills` (
  `skills_id` int(11) NOT NULL,
  `font` varchar(10000) NOT NULL,
  `tag` varchar(100) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_skills`
--

INSERT INTO `t_skills` (`skills_id`, `font`, `tag`, `date_time`) VALUES
(1, '<svg viewBox=\"0 0 128 128\" style=\"height:110px;\">\r\n              <path fill=\"#131313\" d=\"M89.234 5.856h-7.384l7.679 8.333v3.967h-15.816v-4.645h7.678l-7.678-8.333v-3.971h15.521v4.649zm-18.657 0h-7.384l7.679 8.333v3.967h-15.817v-4.645h7.679l-7.679-8.333v-3.971h15.522v4.649zm-18.474.19h-7.968v7.271h7.968v4.839h-13.632v-16.949h13.632v4.839z\"></path><path fill=\"#1572B6\" d=\"M27.613 116.706l-8.097-90.813h88.967l-8.104 90.798-36.434 10.102-36.332-10.087z\"></path><path fill=\"#33A9DC\" d=\"M64.001 119.072l29.439-8.162 6.926-77.591h-36.365v85.753z\"></path><path fill=\"#fff\" d=\"M64 66.22h14.738l1.019-11.405h-15.757v-11.138h27.929000000000002l-.267 2.988-2.737 30.692h-24.925v-11.137z\"></path><path fill=\"#EBEBEB\" d=\"M64.067 95.146l-.049.014-12.404-3.35-.794-8.883h-11.178999999999998l1.561 17.488 22.814 6.333.052-.015v-11.587z\"></path><path fill=\"#fff\" d=\"M77.792 76.886l-1.342 14.916-12.422 3.353v11.588l22.833-6.328.168-1.882 1.938-21.647h-11.175z\"></path><path fill=\"#EBEBEB\" d=\"M64.039 43.677v11.136999999999999h-26.903000000000002l-.224-2.503-.507-5.646-.267-2.988h27.901zM64 66.221v11.138h-12.247l-.223-2.503-.508-5.647-.267-2.988h13.245z\"></path>\r\n</svg>', 'CSS3', '2020-12-23 22:48:58'),
(2, '<i class=\"devicon-bootstrap-plain-wordmark colored\" style=\"font-size:120px;\"></i>', 'Bootstrap', '2020-12-23 22:53:19'),
(3, '<i class=\"devicon-html5-plain-wordmark colored\" style=\"font-size:110px;\"></i>', 'HTML5', '2020-12-23 22:54:16'),
(4, '<i class=\"devicon-javascript-plain colored\" style=\"font-size:100px;\"></i>', 'Javascript', '2020-12-23 22:54:51'),
(5, '<i class=\"devicon-jquery-plain-wordmark colored\" style=\"font-size:120px;\"></i>', 'JQuery', '2020-12-23 22:55:08'),
(6, '<i class=\"devicon-php-plain colored\" style=\"font-size:120px;\"></i>', 'PHP', '2020-12-23 22:55:23'),
(7, '<i class=\"devicon-codeigniter-plain-wordmark colored\" style=\"font-size:120px;\"></i>', 'Codeigniter', '2020-12-23 22:55:35'),
(8, '<i class=\"devicon-mysql-plain-wordmark colored\" style=\"font-size:120px;\"></i>', 'MySQL', '2020-12-23 22:55:45'),
(9, '<i class=\"devicon-oracle-original colored\" style=\"font-size:120px;\"></i>', 'Oracle', '2020-12-23 22:56:08');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tm_education`
--
ALTER TABLE `tm_education`
  ADD PRIMARY KEY (`education_id`);

--
-- Indeks untuk tabel `tm_experience`
--
ALTER TABLE `tm_experience`
  ADD PRIMARY KEY (`experience_id`);

--
-- Indeks untuk tabel `tm_internship`
--
ALTER TABLE `tm_internship`
  ADD PRIMARY KEY (`internship_id`);

--
-- Indeks untuk tabel `tm_users`
--
ALTER TABLE `tm_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeks untuk tabel `tr_experience`
--
ALTER TABLE `tr_experience`
  ADD PRIMARY KEY (`detail_experience_id`),
  ADD KEY `experience_id` (`experience_id`) USING BTREE;

--
-- Indeks untuk tabel `tr_internship`
--
ALTER TABLE `tr_internship`
  ADD PRIMARY KEY (`detail_internship_id`);

--
-- Indeks untuk tabel `t_configurable`
--
ALTER TABLE `t_configurable`
  ADD PRIMARY KEY (`data_id`);

--
-- Indeks untuk tabel `t_home`
--
ALTER TABLE `t_home`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_portfolio`
--
ALTER TABLE `t_portfolio`
  ADD PRIMARY KEY (`portfolio_id`);

--
-- Indeks untuk tabel `t_skills`
--
ALTER TABLE `t_skills`
  ADD PRIMARY KEY (`skills_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tm_education`
--
ALTER TABLE `tm_education`
  MODIFY `education_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tm_experience`
--
ALTER TABLE `tm_experience`
  MODIFY `experience_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tm_internship`
--
ALTER TABLE `tm_internship`
  MODIFY `internship_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tm_users`
--
ALTER TABLE `tm_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tr_experience`
--
ALTER TABLE `tr_experience`
  MODIFY `detail_experience_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tr_internship`
--
ALTER TABLE `tr_internship`
  MODIFY `detail_internship_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `t_configurable`
--
ALTER TABLE `t_configurable`
  MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `t_home`
--
ALTER TABLE `t_home`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `t_portfolio`
--
ALTER TABLE `t_portfolio`
  MODIFY `portfolio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `t_skills`
--
ALTER TABLE `t_skills`
  MODIFY `skills_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
