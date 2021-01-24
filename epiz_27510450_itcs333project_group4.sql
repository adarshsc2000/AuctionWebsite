-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2021 at 10:18 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_27510450_itcs333project_group4`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `ADDRESS_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `ADDRESS` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`ADDRESS_ID`, `USER_ID`, `ADDRESS`) VALUES
(1, 11, 'Manama'),
(2, 11, ''),
(3, 11, ''),
(8, 12, 'road 1215, block 312, bldg 510'),
(7, 12, 'barbar'),
(9, 12, 'budaiya'),
(10, 13, 'po box 21268'),
(11, 13, ''),
(12, 13, ''),
(13, 14, 'Manama'),
(14, 14, ''),
(15, 14, ''),
(16, 15, 'manama'),
(17, 15, ''),
(18, 15, ''),
(19, 16, 'Bahrain'),
(20, 16, ''),
(21, 16, ''),
(45, 1, ''),
(25, 2, 'Bahrain, Muharraq'),
(26, 2, ''),
(27, 2, ''),
(28, 3, 'Bahrain, Manama'),
(29, 3, ''),
(30, 3, ''),
(31, 0, ''),
(32, 4, 'Bahrain, Muharraq'),
(33, 4, ''),
(34, 4, ''),
(35, 5, 'Bahrain, Manama'),
(36, 5, ''),
(37, 5, ''),
(44, 1, 'Bahrain, Salmabad'),
(41, 17, 'Tubli'),
(42, 17, ''),
(43, 17, ''),
(46, 1, ''),
(47, 18, 'Road 2103'),
(48, 18, ''),
(49, 18, ''),
(55, 19, ''),
(54, 19, ''),
(53, 19, '31 sti'),
(56, 20, 'bahrain, muharraq'),
(57, 20, ''),
(58, 20, ''),
(59, 21, 'bahrain, salmadabad'),
(60, 21, ''),
(61, 21, ''),
(62, 22, 'bahrain, salmadabad'),
(63, 22, ''),
(64, 22, ''),
(65, 23, 'bahrain, Isa Town'),
(66, 23, ''),
(67, 23, ''),
(68, 24, 'bahrain, manama'),
(69, 24, ''),
(70, 24, ''),
(71, 25, 'bahrain, Hamad Town'),
(72, 25, ''),
(73, 25, '');

-- --------------------------------------------------------

--
-- Table structure for table `auctions`
--

CREATE TABLE `auctions` (
  `AUCTION_ID` int(11) NOT NULL,
  `OWNER_ID` int(11) NOT NULL,
  `AUCTION_NAME` varchar(50) NOT NULL,
  `DESCRIPTION` varchar(150) NOT NULL,
  `START_TIME_DATE` datetime NOT NULL,
  `END_TIME_DATE` datetime NOT NULL,
  `START_PRICE` decimal(10,3) NOT NULL,
  `HIGHEST_BID` decimal(10,3) DEFAULT NULL,
  `WINNER_ID` int(11) DEFAULT NULL,
  `WINNER_ADDR` varchar(30) NOT NULL,
  `STATUS` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auctions`
--

INSERT INTO `auctions` (`AUCTION_ID`, `OWNER_ID`, `AUCTION_NAME`, `DESCRIPTION`, `START_TIME_DATE`, `END_TIME_DATE`, `START_PRICE`, `HIGHEST_BID`, `WINNER_ID`, `WINNER_ADDR`, `STATUS`) VALUES
(17, 4, 'Mannat', 'Shah Rukh Khan\'s House.', '2021-01-22 12:36:00', '2021-03-22 12:36:00', '5838278.790', NULL, NULL, '', NULL),
(16, 3, ' Corgeut  Watch', '41MM Corgeut Sapphire Black Bay black dial blue bezel Men miyota Automatic Watch', '2021-01-23 00:00:00', '2021-01-23 23:59:00', '40.000', NULL, NULL, '', NULL),
(18, 20, 'Early Chinese antiques', 'Chinese collectors buying antiques and collectibles, and with prices heating up on artwork and antiques created in other Asian countries', '2021-01-23 00:04:00', '2021-01-23 00:10:00', '60.000', '80.000', 21, '', NULL),
(15, 2, 'Porsche 911', 'Porsche 911 is a two-door, 2+2 high performance rear-engined sports car. It has a rear-mounted flat-six engine and all round independent suspensio', '2021-01-23 00:00:00', '2021-01-24 00:00:00', '36900.000', NULL, NULL, '', NULL),
(14, 1, 'iphone 12', 'Awesome Camera\r\nGood Quality', '2021-01-22 01:10:00', '2021-01-31 01:11:00', '300.000', '350.000', 20, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `MESSAGE_ID` int(11) NOT NULL,
  `AUCTION_ID` int(11) NOT NULL,
  `MESSAGE` varchar(100) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `MESSAGE_TIME` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `PICTURE_ID` int(11) NOT NULL,
  `AUCTION_ID` int(11) NOT NULL,
  `PICTURE` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`PICTURE_ID`, `AUCTION_ID`, `PICTURE`) VALUES
(1, 1, 'uploadedfiles/img160848496516401812175fdf8865cfaf8.jpeg'),
(2, 2, 'uploadedfiles/img160848526911380178225fdf8995c7ec6.jpg'),
(3, 3, 'uploadedfiles/img160848560412663137145fdf8ae446424.jpg'),
(4, 4, 'uploadedfiles/img160848589114423772575fdf8c0336334.jpg'),
(5, 5, 'uploadedfiles/img1608486193331199205fdf8d312ae4a.jpg'),
(6, 6, 'uploadedfiles/img160848643316785371565fdf8e210e459.jpg'),
(7, 7, 'uploadedfiles/img160848708817324454205fdf90b0ee675.jpg'),
(8, 8, 'uploadedfiles/img160848741419846338085fdf91f6da0cf.jpg'),
(9, 9, 'uploadedfiles/img160848772410689326025fdf932c58037.jpg'),
(10, 10, 'uploadedfiles/img16084879791662514595fdf942b47301.jpg'),
(11, 11, 'uploadedfiles/img160848821410787470705fdf9516d2346.jpg'),
(12, 12, 'uploadedfiles/img160874475816340665145fe37f3634361.jpg'),
(13, 13, 'uploadedfiles/img16094458866777119205fee31fe8b381.jpg'),
(14, 14, 'uploadedfiles/img161126359712800157086009ee6d6a950.jpg'),
(15, 15, 'uploadedfiles/img161126385721425931376009ef71a1cab.jpg'),
(16, 16, 'uploadedfiles/img161126447219218748106009f1d8bf575.jpg'),
(17, 16, 'uploadedfiles/img16112644728000284446009f1d8c0091.jpg'),
(18, 16, 'uploadedfiles/img161126447220966571186009f1d8c1cda.jpg'),
(19, 17, 'uploadedfiles/img161126507318578368306009f4314614c.jpg'),
(20, 17, 'uploadedfiles/img161126507313510703356009f43146d72.jpg'),
(21, 18, 'uploadedfiles/img1611349363189977006600b3d7341e90.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `QUESTION_ID` int(11) NOT NULL,
  `AUCTION_ID` int(11) NOT NULL,
  `QUESTION` varchar(300) NOT NULL,
  `ANSWER` varchar(300) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`QUESTION_ID`, `AUCTION_ID`, `QUESTION`, `ANSWER`) VALUES
(1, 5, 'Sealed it ?', NULL),
(2, 2, 'ayyy', NULL),
(3, 2, 'can i use this for self defense \r\n', NULL),
(4, 14, 'how much gb space is there in the phone?', '256 gb');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `USER_ID` int(11) NOT NULL,
  `USERNAME` varchar(20) NOT NULL,
  `PASSWORD` varchar(250) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `CONTACT_NUM` int(15) NOT NULL,
  `EMAIL` varchar(40) NOT NULL,
  `COUNTRY` varchar(20) NOT NULL,
  `ADDRESS` varchar(50) NOT NULL,
  `PROFILE_PIC` varchar(100) NOT NULL,
  `BUYER_RATING_SUM` int(11) DEFAULT NULL,
  `BUYER_RATING_COUNT` int(11) DEFAULT NULL,
  `SELLER_RATING_SUM` int(11) DEFAULT NULL,
  `SELLER_RATING_COUNT` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`USER_ID`, `USERNAME`, `PASSWORD`, `NAME`, `CONTACT_NUM`, `EMAIL`, `COUNTRY`, `ADDRESS`, `PROFILE_PIC`, `BUYER_RATING_SUM`, `BUYER_RATING_COUNT`, `SELLER_RATING_SUM`, `SELLER_RATING_COUNT`) VALUES
(1, 'alawi', '$2y$10$MaA/Gjq8Uq6s9.Ew0D.JqOgjAR1OxXSVc1eL/KKnEDqddkZAOc1/i', 'Alawi Hasib', 35399793, 'hazzib7@gmail.com', 'Bahrain', 'bahrain,salmabad', 'picIMG_20201001_172938_86216087771852214599985fe3fde1ea805.jpg', 0, 0, 0, 0),
(2, 'ashraf', '$2y$10$F7wj7EragiZJ7eqz7T7kuO.FnjP/BldcKg/q5OE3.K65sVKHT7/P.', 'Ashraf Haris', 38127823, 'ashraf123@gmail.com', 'Bahrain', 'bahrain ,muharraq', 'picWhatsApp Image 2020-12-20 at 616084886446723304215fdf96c4b9c9a.jpeg', 0, 0, 0, 0),
(3, 'adarsh', '$2y$10$UyLEN7em66GDvio8pNVMO.aTasvy/M5dgdSfJ54kCpxRhGJAL1sT.', 'Adarsh Chandran', 35399797, 'adarsh123@gmail.com', 'Bahrain', 'bahrain ,manama', 'picWhatsApp Image 2020-12-20 at 916084899419833366215fdf9bd54347f.jpeg', 0, 0, 0, 0),
(4, 'tahmid', '$2y$10$ejhokIyGwKAAF27Vyh3P0OzofwlkHJ.gX466UEKOZwVkOynmKxr9C', 'tahmidurrahman', 35399796, 'thahmid123@gmail.com', 'Bahrain', 'bahrain ,muharraq', 'picWhatsApp Image 2020-12-20 at 9160848998510920530505fdf9c010c8f8.jpeg', 0, 0, 0, 0),
(25, 'usama_tahir', '$2y$10$Elxz61nE5QVQG/wfTTEWWeo6DXgntyxFDoPzVeUZzGsppRids/EUm', 'Usama', 36894512, 'usamatahir222@gmail.com', 'Bahrain', '', 'defaultpfp160813439419818483965fda2efae2750.png', 0, 0, 0, 0),
(24, 'mark_henry', '$2y$10$w0yyARq/Lx407ZQDhVuPHOeGmA6zZXwemtdB1M.KXvilMKRhDMIsa', 'Mark', 38765432, 'markhenryishere@gmail.com', 'Bahrain', '', 'defaultpfp160813439419818483965fda2efae2750.png', 0, 0, 0, 0),
(23, 'steve_austin', '$2y$10$7BiXASnwr3gkUGrFNDG0wOzh5ox.ayVgmOes6tA/1aEEp3B1RcBUG', 'Steve', 38383737, 'steveaustin316@hotmail.com', 'Bahrain', '', 'defaultpfp160813439419818483965fda2efae2750.png', 0, 0, 0, 0),
(22, 'viper_orton', '$2y$10$LwQi4kUkDb8CGaGKk9DzUuuQP5Je7fBHwUfjf23OmdWAZ/QdzcKXO', 'Orton', 32112345, 'ortonisman@gmail.com', 'Bahrain', '', 'defaultpfp160813439419818483965fda2efae2750.png', 0, 0, 0, 0),
(21, 'elon_musk_1', '$2y$10$UExt9/4Isws1bTPaD7kNVu.3MzRHe6t8OQ0oO1TdObYNTpeBqQVAS', 'Elon', 33445577, 'elonmuskishere@gmail.com', 'Bahrain', '', 'defaultpfp160813439419818483965fda2efae2750.png', 0, 0, 0, 0),
(20, 'anthony_123', '$2y$10$rW0PRZ4VNwYIXl5baX2z0eR/Qk3rsU0reiA27nvABtAba/RgmlFK.', 'Anthony', 39938998, 'anthonymkv@gmail.com', 'Bahrain', '', 'defaultpfp160813439419818483965fda2efae2750.png', 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`ADDRESS_ID`),
  ADD KEY `fk_userid` (`USER_ID`);

--
-- Indexes for table `auctions`
--
ALTER TABLE `auctions`
  ADD PRIMARY KEY (`AUCTION_ID`),
  ADD KEY `fk_ownerid` (`OWNER_ID`),
  ADD KEY `fk_winnerid` (`WINNER_ID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`MESSAGE_ID`),
  ADD KEY `fk_messagesauctionid` (`AUCTION_ID`),
  ADD KEY `fk_userrid` (`USER_ID`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`PICTURE_ID`),
  ADD KEY `fk_picturesauctionid` (`AUCTION_ID`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`QUESTION_ID`),
  ADD KEY `fk_auctionid` (`AUCTION_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USER_ID`),
  ADD UNIQUE KEY `USERNAME` (`USERNAME`),
  ADD UNIQUE KEY `CONTACT_NUM` (`CONTACT_NUM`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `ADDRESS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `auctions`
--
ALTER TABLE `auctions`
  MODIFY `AUCTION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `MESSAGE_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `PICTURE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `QUESTION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
