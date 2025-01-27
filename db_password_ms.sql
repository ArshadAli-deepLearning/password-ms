-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2025 at 03:44 PM
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
-- Database: `db_password_ms`
--

-- --------------------------------------------------------

--
-- Table structure for table `qstn_list`
--

CREATE TABLE `qstn_list` (
  `exid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `qstn` varchar(200) NOT NULL,
  `qstn_o1` varchar(100) NOT NULL,
  `qstn_o2` varchar(100) NOT NULL,
  `qstn_o3` varchar(100) NOT NULL,
  `qstn_o4` varchar(100) NOT NULL,
  `qstn_ans` varchar(100) NOT NULL,
  `sno` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_list`
--

CREATE TABLE `quiz_list` (
  `exid` int(11) NOT NULL,
  `exname` varchar(100) NOT NULL,
  `nq` int(11) NOT NULL,
  `desp` varchar(255) NOT NULL,
  `subt` datetime NOT NULL,
  `extime` datetime NOT NULL,
  `datetime` datetime NOT NULL,
  `subject` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_list`
--

INSERT INTO `quiz_list` (`exid`, `exname`, `nq`, `desp`, `subt`, `extime`, `datetime`, `subject`) VALUES
(1, 'Password Security Knowledge', 3, 'First Session quiz', '2025-01-27 12:57:49', '2025-01-27 12:57:49', '2025-01-27 12:57:49', 'Security'),
(4, 'Final Password Security Quiz Test', 1, 'This is the Final Exam', '2025-01-30 22:29:00', '2025-02-22 21:28:00', '0000-00-00 00:00:00', 'Security');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `id` int(11) NOT NULL COMMENT 'role_id',
  `role` varchar(255) DEFAULT NULL COMMENT 'role_text'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Editor'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tutorials`
--

CREATE TABLE `tbl_tutorials` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `detail` text DEFAULT NULL,
  `link` varchar(2083) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_tutorials`
--

INSERT INTO `tbl_tutorials` (`id`, `title`, `detail`, `link`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'What Is Password Management? [Complete Guide]', 'What is password management?\r\nPassword management is the process of creating, storing, and using strong and unique passwords for all your online accounts. A password manager is a program or application that helps you with this process by generating secure passwords for you, storing them in a safe location, and autofilling them on websites you visit. All you need to access your stored passwords is a master password that lets you into the manager and allows you to access your saved login information.\r\n\r\nPassword management helps you store other sensitive information like credit card numbers, addresses, phone numbers, and secure notes. Many password managers also autofill your personal information on web forms, saving you time during account creation or online checkout.', 'https://teampassword.com/_next/image?url=https%3A%2F%2Fcdn.buttercms.com%2Fl7FCdvy5ScqwANJhmfT3&w=1920&q=100', 22, '2025-01-26 16:40:31', '2025-01-26 16:40:31'),
(2, 'What is Password Hashing and why is it important', 'Password hashing is a crucial aspect of password management in the digital world, particularly for developers managing user authentication systems. It involves transforming a plaintext password into a fixed-length string of characters using a hashing algorithm. This one-way function ensures that even if someone gains unauthorized access to the hashed password, they cannot easily revert it to the original password.\r\n\r\nCommon algorithms used for password hashing include the bcrypt algorithm, Argon2, and the Secure Hash Algorithm 2 (SHA-2) family, which includes SHA-256. These algorithms are designed to handle inputs of any length and produce a consistent hash. They are built to resist attacks by being computationally intensive, requiring significant computation time and resources to break.\r\n\r\nWhen a user creates an account and sets a password, the system applies a hashing algorithm to convert the plaintext password into a hash. This hash is stored in the database, not the plaintext password. When the user attempts to log in, the system hashes the entered password and compares it with the stored hash. If they match, the user is authenticated.\r\n\r\nA key characteristic of password hashing is that the same input will always produce the same output. This is vital for comparison purposes, ensuring that the correct password is matched every time. However, this also means that two identical passwords will produce the same hash, which could be exploited if not mitigated by techniques like salting passwords.', 'https://supertokens.com/covers/password_hashing_and_salting.png', 22, '2025-01-26 18:03:14', '2025-01-26 18:03:14'),
(5, 'Cybersecurity Awareness Month (CSAM) 2025', 'Cybersecurity Awareness Month (CSAM) was created by the U.S. Department of Homeland Security (DHS) and the Cybersecurity and Infrastructure Security Agency (CISA) in 2004. Ever since, it has become an annual campaign to raise awareness about the importance of cybersecurity. Each October, CSAM focuses on empowering everyone to be secure online by offering actionable tips and guidelines against cyber threats.\r\n\r\n\r\n\r\nThis year’s theme for Cybersecurity Awareness Month is “Secure Our World”, highlighting the crucial role of robust digital hygiene practices. This is especially true as cyberattacks targeting vulnerable systems and weak credentials remain prevalent. One of the key recommendations provided by CISA is the use of strong passwords in cybersecurity. - along with turning on Multi-Factor Authentication (MFA), recognizing and reporting phishing scams, and updating software.\r\n\r\n\r\n\r\nIn this article, we will discuss the importance of strong passwords for cybersecurity and the risks associated with weak passwords. We will also highlight notable security breaches that have occurred due to password vulnerabilities. Finally, we will provide best practices to ensure password security.', 'https://www.sangfor.com/sites/default/files/inline-images/CSAM-2024-Understanding-the-Importance-of-Strong-Passwords.jpg', 22, '2025-01-27 09:51:26', '2025-01-27 09:51:26'),
(6, 'Beyond Password Managers', 'How do password managers work?\r\nA password manager is a small vault (typically a database) that stores all your credentials and passwords—encrypted— and is usually protected by a master password or by biometrics, sometimes with additional authentication protection such as two-step or multifactor authentication (MFA). In most configurations, unfortunately, the additional authentication protection is disabled by default and must be enabled by the user. \r\n\r\nYou can usually create multiple vaults, each protected with a master password. The most common way to create new entries in the vault is via a browser extension. Then, when you’re entering information into a username and password field on a web form, the extension will offer to save those credentials in the vault. The fields can then be automatically populated the next time you go to the same website.\r\n\r\nThe vault can be synchronized across multiple devices providing you with an effortless way to fill out your username and password on web forms without having to remember your password or type it in directly. A password manager helps you generate strong passwords for each account and audit the strength of your unique passwords.', 'https://delinea.com/hs-fs/hubfs/delinea-how-does-a-password-manager-work-blog.png?width=750&name=delinea-how-does-a-password-manager-work-blog.png', 22, '2025-01-27 09:56:14', '2025-01-27 09:56:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile` varchar(25) DEFAULT NULL,
  `roleid` tinyint(4) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `username`, `email`, `password`, `mobile`, `roleid`, `isActive`, `created_at`, `updated_at`) VALUES
(7, 'Nababur', 'Nababurbd', 'nababurbd@gmail.com', '188000e1f0fb4075ae1c659697b96296f982cdc4', '01717090233', 1, 0, '2020-03-12 16:23:01', '2020-03-12 16:23:01'),
(12, 'Rayhan', 'Rayhan', 'rayhankabir@gmail.com', '188000e1f0fb4075ae1c659697b96296f982cdc4', '01717090233', 2, 0, '2020-03-12 18:20:24', '2020-03-12 18:20:24'),
(15, 'Sanjia Akther', 'Sanjida', 'sanjida@gmail.com', '188000e1f0fb4075ae1c659697b96296f982cdc4', '01717090233', 2, 0, '2020-03-12 19:32:27', '2020-03-12 19:32:27'),
(16, 'Abid Ali', 'Abid', 'abid@gmail.com', '188000e1f0fb4075ae1c659697b96296f982cdc4', '01717090233', 3, 0, '2020-03-13 05:08:26', '2020-03-13 05:08:26'),
(17, 'Abdur Rouf', 'Rouf', 'rouf@gmail.com', '188000e1f0fb4075ae1c659697b96296f982cdc4', '01717090233', 2, 0, '2020-03-13 05:08:53', '2020-03-13 05:08:53'),
(18, 'Maruf Jaman', 'Maruf', 'maruf@gmail.com', '188000e1f0fb4075ae1c659697b96296f982cdc4', '01717090233', 2, 0, '2020-03-13 05:09:18', '2020-03-13 05:09:18'),
(19, 'Humayun ', 'Munna', 'munna@gmail.com', '66c3241204bea40578eb993f41f7c4b1ab982dab', '01717090233', 3, 0, '2020-03-13 05:09:49', '2020-03-13 05:09:49'),
(20, 'Rased ', 'Rashed', 'rashed@gmail.com', '188000e1f0fb4075ae1c659697b96296f982cdc4', '01717090233', 2, 1, '2020-03-13 05:10:24', '2020-03-13 05:10:24'),
(21, 'Millon ', 'Millon', 'millon@gmail.com', '05c19fb114728eabf85f47c858914ca42ddd2dae', '01717090233', 1, 1, '2020-03-13 05:11:02', '2020-03-13 05:11:02'),
(22, 'Arshad Khan', 'Arshad', 'arshadali0343@gmail.com', '4635ac2d1ff7d32a5c0a820172c47b197c3905a3', '01164917944', 1, 0, '2025-01-26 12:48:27', '2025-01-26 12:48:27'),
(23, 'Arshad Khan', 'Arshad786', 'arshad@gmail.com', '4635ac2d1ff7d32a5c0a820172c47b197c3905a3', '01164917944', 3, 0, '2025-01-27 05:10:08', '2025-01-27 05:10:08'),
(24, 'Arshad Khan', 'ALi', 'ali0343@gmail.com', 'f58cf5e7e10f195e21b553096d092c763ed18b0e', '01164917944', 3, 0, '2025-01-27 05:17:41', '2025-01-27 05:17:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `qstn_list`
--
ALTER TABLE `qstn_list`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `quiz_list`
--
ALTER TABLE `quiz_list`
  ADD PRIMARY KEY (`exid`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tutorials`
--
ALTER TABLE `tbl_tutorials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `qstn_list`
--
ALTER TABLE `qstn_list`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_list`
--
ALTER TABLE `quiz_list`
  MODIFY `exid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'role_id', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_tutorials`
--
ALTER TABLE `tbl_tutorials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
