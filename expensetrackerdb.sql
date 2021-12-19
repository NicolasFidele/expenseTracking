-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2021 at 09:07 AM
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
-- Database: `expensetrackerdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `income_expenditure`
--

CREATE TABLE `income_expenditure` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `transaction_date` date NOT NULL,
  `transaction_type` varchar(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `amount` varchar(10) NOT NULL,
  `category` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `income_expenditure`
--

INSERT INTO `income_expenditure` (`id`, `user_id`, `transaction_date`, `transaction_type`, `item_name`, `amount`, `category`) VALUES
(48, 2, '2021-12-17', 'expenses', 'asdfasdf', '123', 'bills'),
(49, 1, '2021-12-18', 'expenses', 'roti', '30', 'clothing'),
(50, 1, '2021-12-18', 'expenses', 'dlahpuri', '120', 'restaurant'),
(52, 1, '2021-12-18', 'income', 'Chris', '30000', 'salary'),
(53, 5, '2021-12-18', 'expenses', 'asf;aj', '100', 'groceries'),
(54, 5, '2021-12-18', 'expenses', 'asdfas', '123', 'bills'),
(61, 1, '2021-11-17', 'expenses', 'food', '200', 'groceries'),
(62, 1, '2021-11-17', 'expenses', 'food', '200', 'groceries'),
(63, 1, '2021-11-17', 'expenses', 'food', '200', 'groceries'),
(64, 1, '2021-11-17', 'expenses', 'food', '200', 'groceries'),
(65, 1, '2021-11-17', 'expenses', 'food', '200', 'groceries'),
(66, 1, '2021-11-17', 'expenses', 'food', '200', 'groceries'),
(67, 1, '2021-11-17', 'expenses', 'food', '200', 'groceries'),
(68, 1, '2021-11-17', 'expenses', 'food', '200', 'groceries'),
(69, 1, '2021-11-17', 'income', 'food', '200', 'bonus'),
(70, 1, '2021-11-17', 'income', 'food', '200', 'lottery'),
(72, 1, '2021-11-17', 'expenses', 'food', '200', 'groceries'),
(73, 1, '2021-11-04', 'expenses', 'Chris', '150', 'other'),
(74, 6, '2021-11-06', 'expenses', 'CWA', '110', 'bills'),
(75, 6, '2021-11-09', 'expenses', 'CEB', '520', 'bills'),
(77, 6, '2021-11-12', 'expenses', 'commissions', '1793', 'groceries'),
(78, 6, '2021-11-14', 'expenses', 'Perfume', '1200', 'clothing'),
(79, 6, '2021-11-14', 'expenses', 'Shirts', '1200', 'clothing'),
(82, 6, '2021-11-12', 'expenses', 'Tacos', '209', 'restaurant'),
(83, 6, '2021-11-16', 'expenses', 'Softdrinks', '250', 'restaurant'),
(84, 6, '2021-11-17', 'expenses', 'Commissions', '1490', 'groceries'),
(85, 6, '2021-11-19', 'expenses', 'Cat liter', '249', 'groceries'),
(86, 6, '2021-11-12', 'expenses', 'My.T', '1290', 'bills'),
(88, 6, '2021-11-22', 'expenses', 'hotel', '800', 'other'),
(89, 6, '2021-11-12', 'expenses', 'fuel', '800', 'transport'),
(90, 6, '2021-11-23', 'income', 'salary', '15000', 'salary'),
(91, 6, '2021-11-25', 'income', 'bank', '2000', 'interests'),
(92, 6, '2021-11-25', 'income', 'bike sales', '8500', 'other_inc'),
(93, 6, '2021-11-28', 'expenses', 'Mine frit', '850', 'restaurant'),
(94, 6, '2021-12-02', 'expenses', 'Commissions', '1245', 'groceries'),
(95, 6, '2021-12-05', 'expenses', 'gifts', '2100', 'other_exp'),
(96, 6, '2021-12-07', 'expenses', 'Commissions', '1800', 'groceries'),
(97, 6, '2021-12-07', 'expenses', 'Drinks', '850', 'restaurant'),
(98, 6, '2021-12-10', 'expenses', 'dress', '800', 'clothing'),
(99, 6, '2021-12-12', 'expenses', 'shampoo', '294', 'groceries'),
(100, 6, '2021-12-13', 'expenses', 'cat food', '355', 'groceries'),
(101, 6, '2021-12-14', 'expenses', 'cat liter', '249', 'groceries'),
(102, 6, '2021-12-15', 'expenses', 'CWA', '110', 'bills'),
(103, 6, '2021-12-16', 'expenses', 'CEB', '520', 'bills'),
(104, 6, '2021-12-16', 'expenses', 'fuel', '550', 'transport'),
(105, 6, '2021-12-17', 'expenses', 'myT', '1290', 'bills'),
(106, 6, '2021-12-17', 'expenses', 'fuel', '400', 'transport'),
(107, 6, '2021-12-18', 'income', 'salary', '15000', 'salary'),
(108, 6, '2021-12-18', 'income', 'eoy bonus', '12500', 'bonus'),
(109, 6, '2021-12-18', 'expenses', 'gift', '5000', 'other_exp'),
(130, 6, '2021-12-18', 'income', 'asdf', '30000', 'salary'),
(131, 6, '2021-12-18', 'income', 'Chris', '100', 'bonus'),
(132, 6, '2021-12-19', 'expenses', 'Dhal puri', '45', 'restaurant'),
(134, 6, '2021-12-19', 'income', 'Interests MCB', '2500', 'interests');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `transaction_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `transaction_id`) VALUES
(38, 1, 49),
(39, 1, 50),
(41, 1, 52),
(44, 1, 73),
(37, 2, 48),
(42, 5, 53),
(43, 5, 54),
(45, 6, 74),
(46, 6, 75),
(48, 6, 77),
(49, 6, 78),
(50, 6, 79),
(53, 6, 82),
(54, 6, 83),
(55, 6, 84),
(56, 6, 85),
(57, 6, 86),
(59, 6, 88),
(60, 6, 89),
(61, 6, 90),
(62, 6, 91),
(63, 6, 92),
(64, 6, 93),
(65, 6, 94),
(66, 6, 95),
(67, 6, 96),
(68, 6, 97),
(69, 6, 98),
(70, 6, 99),
(71, 6, 100),
(72, 6, 101),
(73, 6, 102),
(74, 6, 103),
(75, 6, 104),
(76, 6, 105),
(77, 6, 106),
(78, 6, 107),
(79, 6, 108),
(80, 6, 109),
(101, 6, 130),
(102, 6, 131),
(103, 6, 132),
(105, 6, 134);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`) VALUES
(1, 'Christophe Fidele', 'a@a.com', 'e10adc3949ba59abbe56e057f20f883e'),
(2, 'user1', 'b@b.com', 'e10adc3949ba59abbe56e057f20f883e'),
(3, 'User 1', 'user1@user.com', 'e10adc3949ba59abbe56e057f20f883e'),
(4, 'user2', 'user2@user.com', 'e10adc3949ba59abbe56e057f20f883e'),
(5, 'testing', 'testing@testing.com', 'e10adc3949ba59abbe56e057f20f883e'),
(6, 'Nicolas Fidele', 'test@test.com', 'b025a0d0ec287ba8ad0d90f4ff69158f');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `income_expenditure`
--
ALTER TABLE `income_expenditure`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`transaction_id`),
  ADD KEY `transactions_ibfk_2` (`transaction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `income_expenditure`
--
ALTER TABLE `income_expenditure`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `income_expenditure`
--
ALTER TABLE `income_expenditure`
  ADD CONSTRAINT `income_expenditure_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`transaction_id`) REFERENCES `income_expenditure` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
