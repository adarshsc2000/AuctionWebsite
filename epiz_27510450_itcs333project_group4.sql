-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql204.epizy.com
-- Generation Time: Jan 20, 2021 at 06:00 AM
-- Server version: 5.6.48-88.0
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
(53, 19, '31 sti');

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
(1, 2, 'Henry Koehler (American, 1927 - 2018) \"Blue and Pi', 'Henry Koehler (American, 1927 - 2018)\"Blue and Pink Jockey, Below, 1973\"oil on canvassigned, dated and titled Henry Koehler lower right verso24\" x 20\"', '2020-12-20 20:19:00', '2021-01-01 20:20:00', '8.000', '10.000', 8, '', 'pending'),
(2, 1, 'Early 20th C. Thai Iron Dha Sword w/ Painted Sheat', '100% of the Buyer\'s Premium of all lots sold in this auction will be donated to Community Food Share by Artemis Gallery. $1.00 = 3 meals!\r\n\r\n**First T', '2020-12-20 20:27:00', '2021-01-20 20:27:00', '100.000', '275.000', 19, '', NULL),
(3, 1, '1909-S LINCOLN CENT', 'PCGS XF-40 KEY COIN! ESTIMATE: $200-$300', '2020-12-20 20:31:00', '2021-01-04 20:32:00', '122.999', '230.000', 14, '', NULL),
(4, 3, 'Laurel Lamp Manufacturing Mushroom Table Lamp', 'Metal fluted base, felted bottom detached. Untested, measures 17x12 inches.', '2020-12-20 20:37:00', '2021-01-05 20:37:00', '64.998', '75.000', 8, '', NULL),
(5, 4, 'Linden German Mantel clock', 'Made by Cuckoo Clock May in West Germany unadjusted. Stamped 1050-020, measures 8.25x12x5.25 inches.', '2020-12-20 20:42:00', '2021-01-06 08:42:00', '84.999', '200.000', 12, '', NULL),
(6, 5, 'Navajo vintage silver & bear claw necklace w/ turq', 'A rare Navajo vintage silver and bear claw necklace with turquoise, total 12 claws, wt. 306gm', '2020-12-20 08:45:00', '2020-12-20 20:51:00', '999.999', '1000.000', 1, '', 'pending'),
(7, 6, 'Hermes Birkin 30 Veau Togo Geranium Red Vermillon', 'Product details: Gold-plated hardware. Dual rolled top handles. Protective feet at base. Gold foil-stamped logo at flap underside. Leather lining. Dua', '2020-12-20 20:57:00', '2020-12-20 20:59:00', '56.000', '70.000', 7, '', 'pending'),
(8, 5, 'ICONIC VINTAGE ALEXANDER MCQUEEN MINK FUR Coat 40', 'ALEXANDER MCQUEEN MINK FUR COAT Relaxed fit Two pockets Knee length Content: 100% mink fur IT 40 - US 4/6 shoulder to shoulder 18\" armpit to armpit 18', '2020-12-20 09:02:00', '2020-12-31 21:03:00', '20.000', '40.000', 12, '', 'pending'),
(9, 2, 'Rolex Mens 18K Yellow Gold Black Diamond Quickset', 'One Mens Quickset Rolex Day Date 18K Yellow Gold President Polished, Serviced & Electronically Tested, 18K Yellow Gold Case: 36mm, 18K Yellow Gold Cro', '2020-12-20 09:07:00', '2020-12-30 21:08:00', '999.999', '1001.000', 9, '', 'pending'),
(10, 1, 'Generous Lot of Seiko Watches.', 'lot includes Seiko automatic 33 jewels (6106-5480)…SEIKO BELL MATIC 17 JEWELS (4006-6027 ) Seiko Sports 100 ( H556-5029) …Seiko Automatic 19 Jewels ( ', '2020-12-20 09:12:00', '2020-12-29 09:12:00', '1999.900', '2006.000', 11, '', 'pending'),
(11, 3, 'Gustav Stickley Hall Seat Model No. 182', 'Gustav Stickley (American, 1858-1952) Hall Seat, model number 182, circa 1901-1903, oak bench / settee with lift top seat opening to reveal storage, m', '2020-12-20 09:15:00', '2020-12-20 21:24:00', '78.899', '90.000', 4, '', 'pending'),
(12, 11, 'Cat ', 'Her name is mia .she\'s so adorable ', '2020-12-23 20:30:00', '2020-12-24 15:15:00', '50.000', '57.000', 1, '', 'pending'),
(13, 19, 'shoe', 'Black', '2020-12-31 23:17:00', '2020-12-31 23:17:00', '25.000', NULL, NULL, '', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `MESSAGE_ID` int(11) NOT NULL,
  `AUCTION_ID` int(11) NOT NULL,
  `MESSAGE` varchar(100) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `time` datetime NOT NULL
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
(13, 13, 'uploadedfiles/img16094458866777119205fee31fe8b381.jpg');

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
(3, 2, 'can i use this for self defense \r\n', NULL);

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
(5, 'reema', '$2y$10$v4aEt4E8ha0q9bPTpGLco.0BugXtUkwmSZwYVFj8EoTiS7goHG1pW', 'Reema shaikh', 35399799, 'reema123@gmail.com', 'Bahrain', 'bahrain ,manama', 'picreema160849005720696333265fdf9c492d10a.jpg', 0, 0, 0, 0),
(6, 'ansab', '$2y$10$dHO8eea9MDNwLkkbj4iJguI1QrTsWzLbB3QgS4Ffy0bVWzJ6C6osS', 'Muhammed ansab', 35399790, 'ansab@gmail.com', 'Bahrain', 'bahrain ,muharraq', 'picansab160849025211472657445fdf9d0c7646a.jpg', 0, 0, 0, 0),
(7, 'haris', '$2y$10$4mLHmTsXV8wpu8w1G.Dv8.0lDT3LY/.YPwnnCg/NgQbRapQo1Zhzu', 'Muhammed Haris', 35099793, 'haris123@gmail.com', 'Bahrain', 'bahrain,salmabad', 'picharis160849030914720998425fdf9d45988d4.jpg', 0, 0, 0, 0),
(8, 'shanib', '$2y$10$Xp.UOvZnb2uzNf7FP3QMCOB1cVU9g0Wkt568/iXB1WdbljS.sIb/a', 'Shanib ibrahim', 35399890, 'shanib123@gmail.com', 'Bahrain', 'bahrain,salmabad', 'picshanib16084904258464805705fdf9db910f9c.jpg', 0, 0, 0, 0),
(9, 'aseeb', '$2y$10$//wtlnkSOwKDQh6SzcgzYOc8MfZon4nlQmp8pgR9kd4WUD5g1yJG6', 'aseeb ibrahim', 35399745, 'adam234@gmail.com', 'Bahrain', 'bahrain,salmabad', 'picaseeb160849046915555301655fdf9de5b6d20.jpg', 0, 0, 0, 0),
(10, 'fathima', '$2y$10$eKESsW50pFFK6Uz1.RTyGu55TrH4L.Il.BWd3Pg.ZFkL1dtG7LFAC', 'Fathima abbas', 35399756, 'fathima345@gmail.com', 'Bahrain', 'bahrain ,salmaniya', 'picfathima160848944917764233075fdf99e90a3a7.jpg', 0, 0, 0, 0),
(11, 'Hasib', '$2y$10$QFqjDOjDxehuudtF6mkpjuYlsXq6EZUetVPydHCyJ6IYl6zeewbkK', 'Hasib', 35399700, 'Hazib7@gmail.com', 'Bahrain', '', 'defaultpfp160813439419818483965fda2efae2750.png', 0, 0, 0, 0),
(12, 'reemanawaz8', '$2y$10$EdiHNIXsbNuSyNafFAVus.yl2rUZSajOccqpC1YqlINFxIH1bG7I.', 'Reema Nawaz', 38079532, 'shaikh-reema8@hotmail.com', 'Bahrain', '', 'defaultpfp160813439419818483965fda2efae2750.png', 0, 0, 0, 0),
(13, 'bargoooo', '$2y$10$atJBLKhNije20Jo7YHb38.CPw12PTt2CVUJU/WEUhmY1m2UGVC/2S', 'Ebrahim Khalil', 36884464, 'ebrahim_alhamar@hotnail.com', 'Bahrain', '', 'defaultpfp160813439419818483965fda2efae2750.png', 0, 0, 0, 0),
(14, 'AliZubair', '$2y$10$Af8u6bpOqwOy2q0NCVQjp.61DY54eBJa3bxClu1Vuut6ggbrGMqY6', 'Ali', 39876317, 'ali293.ma@gmail.com', 'Bahrain', '', 'defaultpfp160813439419818483965fda2efae2750.png', 0, 0, 0, 0),
(15, 'mk180898', '$2y$10$qzZrQxBq1UOeZ040oxdc8eZt96zYkPNwhHRaAQUrn5TnxfRIC3AUe', 'mohamed', 37777777, 'mk180898@gmail.com', 'Bahrain', '', 'defaultpfp160813439419818483965fda2efae2750.png', 0, 0, 0, 0),
(16, 'F3hoom', '$2y$10$mJ7olpSalLuhiyg7yHlHju20oU3NTNZEwiFfwiXtBqJY7ebqXnB1q', 'Fahima suman', 33333333, 'Fahima123@gmail.com', 'Bahrain', '', 'defaultpfp160813439419818483965fda2efae2750.png', 0, 0, 0, 0),
(17, '20188776', '$2y$10$aATkvAFYVX1Q4D4fKgZlh.d.82qziJhezPqSr5C0IhEqSxTo/xpri', 'Jannat', 39876677, 'jannnaaathmed375@gmail.com', 'Bahrain', '', 'defaultpfp160813439419818483965fda2efae2750.png', 0, 0, 0, 0),
(18, 'Abdaal', '$2y$10$OlRdzuQRBvsbkBtVCZocTOXlKfc0Lt4hhNVbOOKHJWUdWxF1aoLUu', 'Abdaal', 35102706, 'Ab@gmail.com', 'Bahrain', '', 'defaultpfp160813439419818483965fda2efae2750.png', 0, 0, 0, 0),
(19, 'Aj12345678', '$2y$10$8jYwfpbE6gGCTNo3v.lLvuFZDnyaszsu.GVn70Z1ePpRS9pgNVM8y', 'aman', 37246969, 'aj7@gmail.com', 'Bahrain', '', 'defaultpfp160813439419818483965fda2efae2750.png', 0, 0, 0, 0);

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
  MODIFY `ADDRESS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `auctions`
--
ALTER TABLE `auctions`
  MODIFY `AUCTION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `MESSAGE_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `PICTURE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `QUESTION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
