-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2019 at 08:14 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_pharmacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `firstName` varchar(125) NOT NULL,
  `lastName` varchar(125) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `confirmCode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstName`, `lastName`, `email`, `mobile`, `address`, `password`, `type`, `confirmCode`) VALUES
(3, 'khawar', 'khalil', 'khawar@gmail.com', '03125544555', 'Islamabad, Pakistan', 'aa030295ae26e8acbd3d1c9415a60f12', 'manager', '117631');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `oplace` text NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `dstatus` varchar(10) NOT NULL DEFAULT 'no',
  `odate` date NOT NULL,
  `ddate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `uid`, `pid`, `quantity`, `oplace`, `mobile`, `dstatus`, `odate`, `ddate`) VALUES
(1, 7, 28, 0, 'Manikganj Sadar', '01677531881', 'no', '2017-04-07', '0000-00-00'),
(2, 7, 31, 0, 'Nikunja 2, Khilkhet, Dhaka', '01677531881', 'yes', '2017-04-07', '0000-00-00'),
(4, 7, 26, 0, 'South Seota, Manikganj Sadar', '01677531881', 'no', '2017-04-07', '0000-00-00'),
(9, 7, 44, 1, 'Nikunja 2, Khilkhet, Dhaka', '01677531881', 'no', '2017-04-08', '0000-00-00'),
(10, 7, 44, 3, 'Nikunja 2, Khilkhet, Dhaka', '01677531881', 'Yes', '2017-04-08', '0000-00-00'),
(13, 7, 11, 2, 'Nikunja 2, Khilkhet, Dhaka', '01677531881', 'Cancel', '2017-04-08', '0000-00-00'),
(14, 7, 40, 1, 'Nikunja 2, Khilkhet, Dhaka', '01677531881', 'no', '2017-04-08', '0000-00-00'),
(15, 7, 43, 1, 'Nikunja 2, Khilkhet, Dhaka', '01677531881', 'no', '2017-04-08', '0000-00-00'),
(16, 7, 29, 3, 'Nikunja 2, Khilkhet, Dhaka', '01677531881', 'no', '2017-04-09', '0000-00-00'),
(17, 11, 35, 1, 'Saver, Dhaka', '01678293748', 'no', '2017-04-09', '0000-00-00'),
(18, 7, 31, 1, 'Nikunja 2, Khilkhet, Dhaka', '01677531881', 'no', '2017-04-09', '0000-00-00'),
(19, 13, 43, 3, 'asdfas', '789', 'Yes', '2017-04-09', '0000-00-00'),
(20, 13, 29, 1, 'asdfas', '789', 'Yes', '2017-04-09', '2017-04-14'),
(21, 7, 43, 1, 'Nikunja 2, Khilkhet, Dhaka', '01677531881', 'no', '2017-04-09', '0000-00-00'),
(22, 11, 45, 1, 'Saver, Dhaka', '01678293748', 'no', '2017-04-09', '0000-00-00'),
(23, 11, 32, 1, 'Saver, Dhaka', '01678293748', 'no', '2017-04-10', '0000-00-00'),
(24, 11, 32, 1, 'Saver, Dhaka', '01678293748', 'no', '2017-04-10', '0000-00-00'),
(25, 11, 51, 1, 'Saver, Dhaka', '01678293748', 'no', '2017-04-10', '0000-00-00'),
(26, 11, 29, 2, 'Saver, Dhaka', '01678293748', 'Cancel', '2017-04-10', '0000-00-00'),
(27, 7, 43, 1, 'Nikunja 2, Khilkhet, Dhaka', '01677531881', 'no', '2017-04-10', '0000-00-00'),
(28, 11, 29, 1, 'Saver, Dhaka', '01678293748', 'no', '2017-04-10', '2017-04-11'),
(29, 11, 43, 1, 'Saver, Dhaka', '01678293748', 'no', '2017-04-10', '2017-06-12'),
(30, 15, 96, 1, 'Rawalpindi', '4039252439', 'no', '2019-10-10', '2019-10-17'),
(31, 17, 88, 2, 'Rawalpindi, Pakistan', '033387467639', 'no', '2019-10-11', '2019-10-18'),
(32, 17, 137, 4, 'Rawalpindi, Pakistan', '033387467639', 'no', '2019-10-11', '2019-10-18'),
(33, 17, 87, 1, 'Rawalpindi, Pakistan', '033387467639', 'no', '2019-10-11', '2019-10-18');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `pName` varchar(100) NOT NULL,
  `formula` varchar(50) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `available` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `pCode` varchar(20) NOT NULL,
  `picture` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `pName`, `formula`, `price`, `description`, `available`, `category`, `type`, `pCode`, `picture`) VALUES
(67, 'Orthix', 'C2H2O5', 10, 'For Pain and Headache', 20, 'AntiDepression', 'Tablet', '12', '1570684030.jpg'),
(68, 'Painkiller', 'c2h4h', 10, 'Painkiller', 25, 'Medicine', 'Tablet', '15', '1570684097.jpg'),
(69, 'Taramadolll', 'C2C3C4', 10, 'For Pain and Headache', 50, 'category', 'clothing', '12', '1570691052.jpg'),
(73, 'Painkiller', 'c1h2', 10, 'For Pain and Headache', 50, 'AntiDepression', 'Injection', '11', '1570695643.jpg'),
(74, 'Painkiller', 'N11', 10, 'New Syrup', 15, 'Depression', 'Syrup', '15', '1570699868.jpg'),
(78, 'Aspirin', 'C9H8O4', 20, 'For Pain and Headache', 25, 'Headache', 'Tablet', '1', '1570705676.jpg'),
(79, 'Amoxicillin', 'C16H19N3O5S', 200, 'Anti Infection', 20, 'Infection', 'Tablet', '2', '1570706357.jpg'),
(80, 'Alamast', 'C10H7KN6O', 150, 'Anti Allergic Drops', 15, 'Allergy', 'Drops', '5', '1570710292.jpg'),
(81, 'Ativan', 'C15H10CL2N2O2', 30, 'Anti Nausea Drugs', 10, 'Nausea', 'Tablet', '6', '1570713359.jpg'),
(82, 'Acticlate', 'C22H24N2O8', 50, 'Eye Infection Drugs', 10, 'EyeInfection', 'Tablet', '8', '1570714502.jpg'),
(83, 'Panadol', 'C8H9NO2', 15, 'For Pain and Headache', 30, 'Headache', 'Tablet', '9', '1570715239.jpg'),
(84, 'Fenoprofen', 'C15H14O3', 70, 'For Pain and Headache', 15, 'Headache', 'Tablet', '12', '1570716081.jpg'),
(85, 'Flurbiprofen', 'C15H13FO2', 35, 'For Pain and Headache', 20, 'Headache', 'Tablet', '13', '1570716190.jpg'),
(86, 'Ibuprofen', 'C13H18O2', 200, 'For Pain and Headache', 25, 'Headache', 'Tablet', '14', '1570716260.jpg'),
(87, 'paracetamol', 'C8H9NO2', 50, 'For Pain and Headache', 30, 'Headache', 'Tablet', '16', '1570716363.jpg'),
(88, 'Disprin', 'C9H8O4', 10, 'For Pain and Headache', 50, 'Headache', 'Tablet', '17', '1570716429.jpg'),
(89, 'Abilify', 'C23H27CL2N3O2', 75, 'Anti Depression Drugs', 30, 'Depression', 'Tablet', '18', '1570716739.png'),
(90, 'Bupropion', 'C13H18CINO', 90, 'Anti Depression Drugs', 25, 'Depression', 'Tablet', '19', '1570716840.jpg'),
(91, 'Cymbalta', 'C18H19NOS', 125, 'Anti Depression Drugs', 50, 'Depression', 'Tablet', '20', '1570716913.jpg'),
(92, 'Doxepin', 'C19H21NO', 50, 'Anti Depression Drugs', 33, 'Depression', 'Tablet', '21', '1570717021.jpg'),
(93, 'lexapro', 'C20H21FN2O', 85, 'Anti Depression Drugs', 30, 'Depression', 'Tablet', '22', '1570717103.jpg'),
(94, 'Prozac', 'C17H18F3NO', 54, 'Anti Depression Drugs', 22, 'Depression', 'Tablet', '23', '1570717164.jpg'),
(95, 'Sertraline', 'C17H18F3NO', 65, 'Anti Depression Drugs', 35, 'Depression', 'Syrup', '24', '1570717230.jpg'),
(96, 'Zoloft', 'C17H17NCL', 55, 'Anti Depression Drugs', 22, 'Depression', 'Tablet', '25', '1570717291.gif'),
(97, 'Amoxil', 'C16H19N3O5S', 45, 'Anti Infection Drugs', 31, 'Infection', 'Tablet', '26', '1570717544.jpg'),
(98, 'Doxycycline', 'C22H24N2O6', 65, 'Anti Infection Drugs', 15, 'Infection', 'Tablet', '27', '1570719501.jpg'),
(99, 'Levaquin', 'C18H20FN3O', 87, 'Anti Infection Drugs', 12, 'Infection', 'Tablet', '28', '1570719586.png'),
(100, 'Macrodantin', 'C8H6N4O5', 34, 'Anti Infection Drugs', 27, 'Infection', 'Tablet', '29', '1570719666.jpg'),
(101, 'Macrobid', 'NULL', 150, 'Anti Infection Drugs', 10, 'Infection', 'Tablet', '30', '1570719745.jpg'),
(102, 'Ciprofloxacin', 'C17H18FN3O3', 67, 'Anti Infection Drugs', 13, 'Infection', 'Tablet', '31', '1570719838.jpg'),
(103, 'Bactrim', 'NULL', 31, 'Anti Infection Drugs', 8, 'Infection', 'Tablet', '32', '1570719908.jpg'),
(104, 'Carbamazepine', 'C15H12N2O', 300, 'Nutritional Supplements ', 20, 'category', 'Type', '33', '1570720137.jpg'),
(105, 'Carbamazepine', 'C15H12N2O', 420, 'Nutritional Supplements ', 13, 'Nutritional', 'Tablet', '34', '1570720611.jpg'),
(106, 'Chloramphenicol', 'C11H12C12N2O5', 200, 'Nutritional Supplements ', 15, 'Nutritional', 'Syrup', '35', '1570720752.jpg'),
(107, 'Cyclophosphamide', 'C7H15C12N2O2P', 450, 'Nutritional Supplements ', 5, 'Nutritional', 'Syrup', '36', '1570720877.jpg'),
(108, 'Cyclosporine', 'C62H111N11O12', 67, 'Nutritional Supplements ', 18, 'Nutritional', 'Tablet', '37', '1570720989.jpg'),
(109, 'Indomethacin', 'C19H16CINO4', 120, 'Nutritional Supplements ', 34, 'Nutritional', 'Tablet', '38', '1570721083.jpg'),
(110, 'Metoclopramide', 'C14H22CIN3O2', 54, 'Nutritional Supplements ', 43, 'Nutritional', 'Tablet', '39', '1570721171.jpg'),
(111, 'Potassium iodide', 'KI', 250, 'Nutritional Supplements ', 26, 'Nutritional', 'Tablet', '40', '1570721248.jpg'),
(112, 'Tetracycline', 'C22H24N2O8', 310, 'Nutritional Supplements ', 17, 'Nutritional', 'Tablet', '41', '1570721324.jpg'),
(113, 'Acetaminophen', 'C8H9NO2', 310, 'Treatment of Bones/Muscles', 15, 'Orthopedic', 'Tablet', '42', '1570721529.jpg'),
(114, 'Zarontin', 'C7H11NO2', 356, 'Treatment of Bones/Muscles', 24, 'Orthopedic', 'Tablet', '43', '1570721619.jpg'),
(115, 'Neurontin', 'C9H17NO2', 38, 'Treatment of Bones/Muscles', 34, 'Orthopedic', 'Tablet', '44', '1570721715.jpeg'),
(116, 'Lamotrigine', 'C9H7CL2N5', 455, 'Treatment of Bones/Muscles', 23, 'Orthopedic', 'Tablet', '45', '1570721770.jpg'),
(117, 'Diazepam', 'C16H13CIN2O', 325, 'Treatment of Bones/Muscles', 41, 'Orthopedic', 'Tablet', '46', '1570721835.png'),
(118, 'Gabapentin', 'C9H17NO2', 58, 'Treatment of Bones/Muscles', 23, 'Orthopedic', 'Tablet', '47', '1570721902.jpg'),
(119, 'Alamast', 'C10H7KN6O', 62, 'Allergy Medications', 31, 'Allergy', 'Drops', '48', '1570722070.jpg'),
(120, 'Alaway', 'NULL', 370, 'Allergy Medications', 17, 'Allergy', 'Drops', '49', '1570722156.jpg'),
(121, 'Astelin', 'C22H24CIN3O', 41, 'Allergy Medications', 23, 'Allergy', 'Drops', '50', '1570722254.jpg'),
(122, 'Benadryl', 'C17H21NO', 367, 'Allergy Medications', 31, 'Allergy', 'Tablet', '51', '1570722387.jpg'),
(123, 'Claritin', 'C22H23CIN2O2', 285, 'Allergy Medications', 28, 'Allergy', 'Tablet', '52', '1570722476.jpg'),
(124, 'Claritin', 'C22H23CIN2O2', 285, 'Allergy Medications', 28, 'category', 'Type', '52', '1570722492.jpg'),
(125, 'Prochlorperazine', 'C20H10CL2N2O2', 16, 'Anti Nausea Drugs', 20, 'Nausea', 'Tablet', '53', '1570722667.jpg'),
(126, 'Metoclopramide', 'C14H22CIN3O2', 324, 'Anti Nausea Drugs', 24, 'Nausea', 'Tablet', '54', '1570722749.jpg'),
(127, 'Zofran', 'C18H19N3O', 415, 'Anti Nausea Drugs', 23, 'Nausea', 'Tablet', '55', '1570722835.jpg'),
(128, 'Phenergan', 'C17H20N2S', 38, 'Anti Nausea Drugs', 19, 'Nausea', 'Syrup', '56', '1570722923.jpg'),
(129, 'Doxycycline', 'C22H24N2O8', 35, 'Eye Infection Medication', 16, 'EyeInfection', 'Tablet', '57', '1570723087.jpg'),
(130, 'Vibramycin', 'C22H24N2O8', 330, 'Eye Infection Medication', 17, 'EyeInfection', 'Tablet', '58', '1570723202.jpg'),
(131, 'Ciloxan', 'C17H18FN3O3', 50, 'Eye Infection Medication', 37, 'EyeInfection', 'Drops', '59', '1570723282.jpg'),
(132, 'Ciprofloxacin', 'C17H18FN3O3', 258, 'Eye Infection Medication', 8, 'EyeInfection', 'Tablet', '60', '1570723358.jpg'),
(133, 'levaquin', 'C18H20FN3O', 376, 'Eye Infection Medication', 12, 'EyeInfection', 'Tablet', '61', '1570723437.png'),
(134, 'Lorazepam', 'C15H10CL2N2O2', 39, 'Treatment of Bones/Muscles', 16, 'Orthopedic', 'Tablet', '62', '1570735805.jpg'),
(135, 'Paraldehyde', 'C6H12O3', 165, 'Treatment of Bones/Muscles', 17, 'Orthopedic', 'Syrup', '63', '1570735920.jpg'),
(137, 'Primidone', 'C12H14N2O2', 220, 'Treatment of Bones/Muscles', 19, 'Orthopedic', 'Tablet', '65', '1570736097.jpg'),
(138, 'Pred Forte', 'C21H28O5', 85, 'Eye Infection Medication', 15, 'EyeInfection', 'Drops', '66', '1570755908.jpg'),
(139, 'Cortisone', 'C21H28O5', 45, 'Eye Infection Medication', 23, 'EyeInfection', 'Tablet', '67', '1570756033.jpg'),
(140, 'Prednisone', 'C21H28O5', 90, 'Eye Infection Medication', 42, 'EyeInfection', 'Tablet', '68', '1570756130.jpg'),
(141, 'Promethazine', 'C17H20N2S', 55, 'Anti Nausea Drugs', 9, 'Nausea', 'Tablet', '69', '1570756318.jpg'),
(142, 'Zofran', 'C18H19N3O', 35, 'Anti Nausea Drugs', 13, 'Nausea', 'Tablet', '70', '1570756402.jpg'),
(143, 'Ondansetron', 'C18H19N3O', 85, 'Anti Nausea Drugs', 27, 'Nausea', 'Tablet', '71', '1570756490.jpg'),
(144, 'Dymista', 'C47H56CL2F3', 58, 'Allergy Medications', 8, 'Allergy', 'Drops', '72', '1570756666.jpg'),
(145, 'Epinephrine', 'C9H13NO3', 400, 'Allergy Medications', 4, 'Allergy', 'Injection', '73', '1570756781.jpg'),
(146, 'Flonase', 'C25H31F3O5S', 150, 'Allergy Medications', 16, 'Allergy', 'Drops', '74', '1570756889.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `address` varchar(120) NOT NULL,
  `password` varchar(100) NOT NULL,
  `confirmCode` varchar(10) NOT NULL,
  `activation` varchar(10) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `mobile`, `address`, `password`, `confirmCode`, `activation`) VALUES
(9, 'Borsha', 'Tanjina', 'Tanjina@gmail.com', '01578399283', 'Pehshawar,Pakistan', 'aa030295ae26e8acbd3d1c9415a60f12', '217576', 'yes'),
(10, 'Trisha', 'Rehman', 'trisha@gmail.com', '01923457834', 'Mirpur 2, Dhaka', '5af7a513a7c48f6cc97253254b29509b', '0', 'yes'),
(11, 'Akhi', 'Alam', 'akhi@gmail.com', '01678293748', 'Lahore, Pakistan', 'ca52febd8be7c4480ae90cdae8438a03', '0', 'yes'),
(15, 'Bila', 'Ali', 'bila@gmail.com', '4039252439', 'Rawalpindi', '698d51a19d8a121ce581499d7b701668', '514856', 'no'),
(16, 'Ahmed', 'Khalil', 'ahmedkhalil0999@gmail.com', '02156895328', 'Isalamabad, Pakistan', '698d51a19d8a121ce581499d7b701668', '102057', 'no'),
(17, 'Omer', 'Ali', 'omer@gmail.com', '033387467639', 'Rawalpindi, Pakistan', '698d51a19d8a121ce581499d7b701668', '111048', 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
