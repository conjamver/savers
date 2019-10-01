-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2019 at 09:53 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `savers`
--

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `bank_id` int(11) UNSIGNED NOT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `bank_abbr` varchar(10) DEFAULT NULL,
  `bank_url` varchar(256) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`bank_id`, `bank_name`, `bank_abbr`, `bank_url`, `timestamp`) VALUES
(1, 'Up Bank', NULL, 'https://up.com.au/', '2019-09-25 12:38:49'),
(2, 'ING', NULL, 'https://www.ing.com.au/savings.html', '2019-09-25 12:38:30'),
(3, 'National Australia Bank', 'NAB', 'https://www.nab.com.au/personal/accounts/savings-accounts', '2019-09-25 12:37:20'),
(4, 'UBank', NULL, 'https://www.ubank.com.au/campaigns/savings-and-transaction-accounts', '2019-09-25 12:37:07'),
(5, 'Commonwealth Bank', 'CommBank', 'https://www.commbank.com.au/savings-accounts.html?pid=46423&sc_psk=34940&sc_crkey=153612994511&c', '2019-09-25 12:36:20'),
(6, 'Australia and New Zealnd Banking Group', 'ANZ', 'https://www.anz.com.au/personal/bank-accounts/savings-accounts/', '2019-09-25 12:37:58'),
(7, 'Bendigo Bank', NULL, 'https://www.bendigobank.com.au/personal/savings-accounts/', '2019-09-25 12:35:38'),
(8, '86 400', NULL, 'https://www.86400.com.au/pay-and-save/', '2019-09-25 12:49:59'),
(9, 'Bank of Queensland', 'BOQ', 'https://www.boq.com.au/personal/banking/savings-and-term-deposits/fast-track-starter-account', '2019-09-25 12:43:08'),
(10, 'Westpac', NULL, 'https://www.westpac.com.au/personal-banking/bank-accounts/savings-accounts/life/?pid=iwc:dp:sav-cat_1803:cta:lifelnkFOM', '2019-09-29 09:41:01'),
(11, 'Suncorp', NULL, 'https://www.suncorp.com.au/banking/bank-accounts/savings-accounts.html', '2019-09-30 11:10:45'),
(12, 'ME Bank', NULL, 'https://www.mebank.com.au/lps/osa/high-online-savings-account/?cid=OSAC0167&&gclid=Cj0KCQjwz8bsBRC6ARIsAEyNnvoNjRv94puQTIUltbxsDkYmgkTvGocMPop5l_AHl58kOVqSfh0igVkaAvuVEALw_wcB&gclsrc=aw.ds', '2019-09-30 11:21:26'),
(13, 'AMP Bank', NULL, 'https://www.amp.com.au/personal/banking/products/savings-accounts/amp-saver-account?extcmp=saver-sem-google-brand&gclid=Cj0KCQjwz8bsBRC6ARIsAEyNnvoucjw5s7pVcV3-VSTEUZeY6ZW8eNu9-J6R3Pn5ZxyP2BHchCuKLL8aAkinEALw_wcB&gclsrc=aw.ds', '2019-09-30 11:21:45'),
(14, 'Bankwest', NULL, 'https://www.bankwest.com.au/personal/save-invest/savings-accounts?promocode=bwexp563&icid=bwexp563', '2019-09-30 11:37:41');

-- --------------------------------------------------------

--
-- Table structure for table `savers`
--

CREATE TABLE `savers` (
  `saver_id` int(11) NOT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `rank_id` int(11) DEFAULT '8',
  `saver_name` varchar(128) DEFAULT NULL,
  `saver_date` datetime DEFAULT NULL,
  `v_rate` decimal(9,2) DEFAULT '0.00',
  `b_rate` decimal(9,2) DEFAULT '0.00',
  `req` varchar(255) DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `savers`
--

INSERT INTO `savers` (`saver_id`, `bank_id`, `rank_id`, `saver_name`, `saver_date`, `v_rate`, `b_rate`, `req`, `visible`, `timestamp`) VALUES
(1, 3, 5, 'ISaver', '2019-09-28 00:00:00', '0.11', '2.00', 'Make a minimum of one deposit each month.', 1, '2019-09-28 11:49:03'),
(2, 3, 4, 'Reward Saver', '2019-09-28 00:00:00', '0.11', '1.75', 'Bonus rate applies to the first four months of opening ISaver account for balances up to 20 Mil.', 1, '2019-09-28 11:49:06'),
(3, 2, 1, 'Savings Maximiser', '2019-09-28 00:00:00', '0.50', '1.70', 'Deposit $1000 or more per month into your ING Orange every day account and make 5+ card purchases each month.', 1, '2019-09-28 11:49:08'),
(4, 4, 2, 'Ultra Saver', '2019-09-28 00:00:00', '1.35', '1.06', 'Link USaver account and deposit $200 or more monthly. ', 1, '2019-09-28 11:49:10'),
(5, 6, 4, 'Goal based saving', '2019-09-28 00:00:00', '0.01', '1.84', 'Make a $10 deposit or more each month with no withdrawal.', 1, '2019-09-28 11:49:12'),
(6, 6, 5, 'Flexible Saving', '2019-09-28 00:00:00', '0.10', '1.75', 'Bonus interest for 3 months.', 1, '2019-09-28 11:49:14'),
(7, 1, 1, 'Savings', '2019-09-28 00:00:00', '0.50', '2.00', 'Make 5+ card purchases per month with Everyday transaction account.', 1, '2019-09-28 12:35:53'),
(8, 8, 2, 'Savings', '2019-09-28 00:00:00', '0.40', '2.10', 'Deposit $1000+ into any 86 400 account.', 1, '2019-09-28 11:49:20'),
(9, 9, 3, 'Fast Track Starter', '2019-09-29 00:00:00', '0.35', '3.15', 'Deposit $200+ into linked Day2Day Plus account.', 1, '2019-09-29 09:44:45'),
(10, 9, 2, 'Fast Track Saver', '2019-09-29 00:00:00', '0.35', '2.50', '$1000+ is credited to the linked Day2Day plus account.', 1, '2019-09-29 09:44:47'),
(11, 10, 3, 'Goal saving', '2019-09-29 00:00:00', '0.60', '1.30', 'Deposit every month and make sure that latest balance is greater than last balance.', 1, '2019-09-29 09:44:49'),
(12, 11, 3, 'Growth Saver', '2019-09-30 00:00:00', '0.20', '1.85', 'Deposit $200+ every month and make no more than one withdrawl per month.', 1, '2019-09-30 11:12:25'),
(13, 12, 2, 'Online Savings', '2019-09-30 00:00:00', '0.80', '1.55', 'Make a tap and go payment with transaction account card.', 1, '2019-09-30 11:16:55'),
(14, 13, NULL, 'Saver Account', NULL, '1.65', '0.96', 'Introductory bonus rate for the first 4 moths for balances up to $250,000', 1, '2019-09-30 11:27:46'),
(15, 13, 4, 'Savings', '2019-09-30 00:00:00', '1.65', '0.96', 'Introductory bonus for first 4 months for balances up to $200,000.', 1, '2019-09-30 11:52:50'),
(16, 13, 6, 'B3tter', '2019-09-30 00:00:00', '1.00', '0.75', 'Deposit $2000+ into your AMP account.', 1, '2019-09-30 11:41:17'),
(17, 6, 5, 'Progress Saver', '2019-09-30 00:00:00', '0.01', '1.84', 'Deposit $10+ each month and no withdrawals each month.', 1, '2019-09-30 11:38:40'),
(18, 14, 3, 'Hero Saver', '2019-09-30 00:00:00', '0.01', '2.10', 'Deposit $200+ each month and no withdrawals each month.', 1, '2019-09-30 11:38:44'),
(19, 14, 7, 'TeleNet Saver', '2019-09-30 00:00:00', '0.50', '2.35', 'Introductory bonus for first 4 months and a linked transaction account.', 1, '2019-09-30 11:41:48');

-- --------------------------------------------------------

--
-- Table structure for table `s_cons`
--

CREATE TABLE `s_cons` (
  `ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `s_pros`
--

CREATE TABLE `s_pros` (
  `ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `s_rank`
--

CREATE TABLE `s_rank` (
  `rank_id` int(11) UNSIGNED NOT NULL,
  `rank` varchar(10) DEFAULT NULL,
  `rank_color` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `s_rank`
--

INSERT INTO `s_rank` (`rank_id`, `rank`, `rank_color`) VALUES
(1, 'S', '#8e44ad'),
(2, 'A', '#3498db'),
(3, 'B', '#27ae60'),
(4, 'C', '#f39c12'),
(5, 'D', '#d35400'),
(6, 'E', '#e74c3c'),
(7, 'F', '#e74c3c'),
(8, 'TBA', '#d2d2d2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `savers`
--
ALTER TABLE `savers`
  ADD PRIMARY KEY (`saver_id`);

--
-- Indexes for table `s_rank`
--
ALTER TABLE `s_rank`
  ADD PRIMARY KEY (`rank_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `bank_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `savers`
--
ALTER TABLE `savers`
  MODIFY `saver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `s_rank`
--
ALTER TABLE `s_rank`
  MODIFY `rank_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
