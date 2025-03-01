-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2024 at 07:40 AM
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
-- Database: `ukhy_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `emp`
--

CREATE TABLE `emp` (
  `eid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `dname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp`
--

INSERT INTO `emp` (`eid`, `name`, `email`, `address`, `image`, `dname`) VALUES
(1, 'Kevin Ashmaniwala', 'kevin@gmail.com', 'tadwadi, rander road', '../img/1.jpg', 'HOST'),
(2, 'Harsh  Prajapati', 'harsh@gmail.com', 'katargam', '../img/2.jpg', 'HOST'),
(3, 'Sandip Chavda', 'sandip@gmail.com', 'dabholi', '../img/3.jpg', 'Security Manager'),
(4, 'Utsav Bapodariya', 'utsav@gmail.com', 'dabholi road', '../img/4.jpg', 'Security Manager'),
(5, 'Yagn Dabhi', 'yagndabhi@gmail.com', 'pal', '../img/5.jpg', 'Security Manager'),
(6, 'dev Chaniyara', 'dev@gmail.com', 'amroli', '../img/6.jpg', 'Security Manager');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `permission` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `createuser` varchar(255) DEFAULT NULL,
  `deleteuser` varchar(255) DEFAULT NULL,
  `createbid` varchar(255) DEFAULT NULL,
  `updatebid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `permission`, `createuser`, `deleteuser`, `createbid`, `updatebid`) VALUES
(1, 'Superuser', '1', '1', '1', '1'),
(2, 'Admin', '1', NULL, '1', '1'),
(3, 'User', NULL, NULL, '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `name` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `OTP` int(20) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`name`, `username`, `email`, `OTP`, `contact`, `password`) VALUES
('admin', 'admin', 'admin@gmail.com', 0, '9825262305', 'admin'),
('dev', 'dev', 'devchaniyara28@gmail.com', 0, '9408844717', 'dev2004'),
('hitlo', 'hit', 'hitarthsojitra1807@gmail.com', 0, '6356730080', 'hit2004'),
('HarshPrajapati', 'hp1312', 'bughunter024@gmail.com', 0, '9574248115', 'harsh@harsh'),
('kevin', 'kevin', 'ashmaniwalakevin@gmail.com', 539144, '8320603038', 'kevin@2003'),
('sandip', 'sandip', 'sandip@gmail.com', 0, '7698761245', 'sandip12'),
('utsav', 'utsav', 'bapodariyau@gmail.com', 0, '8866490461', 'BAPUBAPU');

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `Staffid` varchar(255) DEFAULT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Status` int(11) NOT NULL DEFAULT 1,
  `Photo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'avatar15.jpg',
  `Password` varchar(120) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `Staffid`, `AdminName`, `UserName`, `FirstName`, `LastName`, `MobileNumber`, `Email`, `Status`, `Photo`, `Password`, `AdminRegdate`) VALUES
(2, 'U002', 'Admin', 'kevin', 'kevin', 'ashmaniwala', 8320603038, 'kevin@gmail.com', 1, '1.jpg', '9d5e3ecdeb4cdb7acfd63075ae046672', '2024-01-01 10:18:39'),
(29, '503', 'Admin', 'harsh', 'harsh', 'prajapati', 9574248115, 'harsh@gmail.com', 1, 'avatar15.jpg', 'd4e3730e8cba214f85cddae5f9331d74', '2024-01-19 13:42:56'),
(30, '504', 'Admin', 'utsav', 'utsav', 'bapodariya', 6354131356, 'utsav@gmail.com', 1, 'avatar15.jpg', '293f4c20a14b49ce509a4e53f600fb8d', '2024-01-19 13:43:47'),
(31, '505', 'Admin', 'yagn', 'yagn', 'dabhi', 9904759070, 'yagn@gmail.com', 1, 'avatar15.jpg', 'fbe8f2afad186fd2066c95d5f9a254b6', '2024-01-19 13:45:06');

-- --------------------------------------------------------

--
-- Table structure for table `tblbooking`
--

CREATE TABLE `tblbooking` (
  `ID` int(10) NOT NULL,
  `BookingID` int(10) DEFAULT NULL,
  `ServiceID` int(10) DEFAULT NULL,
  `Name` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `EventDate` varchar(200) DEFAULT NULL,
  `EventStartingtime` varchar(200) DEFAULT NULL,
  `EventEndingtime` varchar(200) DEFAULT NULL,
  `VenueAddress` mediumtext DEFAULT NULL,
  `EventType` varchar(200) DEFAULT NULL,
  `AdditionalInformation` mediumtext DEFAULT NULL,
  `BookingDate` timestamp NULL DEFAULT current_timestamp(),
  `Total_amount` varchar(255) NOT NULL,
  `Remark` varchar(200) DEFAULT NULL,
  `Status` varchar(200) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblbooking`
--

INSERT INTO `tblbooking` (`ID`, `BookingID`, `ServiceID`, `Name`, `MobileNumber`, `Email`, `EventDate`, `EventStartingtime`, `EventEndingtime`, `VenueAddress`, `EventType`, `AdditionalInformation`, `BookingDate`, `Total_amount`, `Remark`, `Status`, `UpdationDate`) VALUES
(14, 954554731, 1, 'Surabhi Kumawat', 8080808080, 'surabhi@gmail.cmo', '2024-01-22', '11 a.m', '12 p.m', 'Suyojeet Tower, near Relience Petrol Pump, Kinaara Hotel, Nashik', 'Birthday Party', 'Special Menu with Professional waiters', '2024-01-22 09:28:13', '', 'Done', 'Approved', '2024-01-12 12:43:10'),
(15, 977361722, 1, 'Jayesh Panghawane', 7070707070, 'jayesh768@gmail.com', '2024-03-24', '1 p.m', '5 p.m', 'Bansi Plaza, near Kumar Hotel, Nashik', 'Wedding', 'Special Menu', '2022-03-22 09:29:18', '', 'okkk', 'Approved', '2024-02-28 03:38:52'),
(16, 139723303, NULL, 'krvin', 7652375891, 'kevin@gmail.com', '2024-01-14', '2 a.m', '3 a.m', 'vivekanand clg.', 'College', '', '2024-01-09 06:32:14', '', 'ohk', NULL, '2024-01-24 04:38:26'),
(17, 621642691, NULL, 'yagn', 9904759070, 'yagndabhi@gmail.com', '2024-01-12', '3 a.m', '7 a.m', 'wetwretet', 'Sangeet', 'regrtr', '2024-01-17 06:33:23', '', NULL, NULL, NULL),
(18, 179186220, 1, 'harsh v prajapati', 909090909090, 'prajapatiharsh1312@gmail.com', '2024-12-12', '12:03', '13:02', 'hello', 'Anniversary', 'hello', '2024-01-17 08:12:20', '', NULL, NULL, NULL),
(19, 643029466, 3, 'asa', 0, 'sssss@gmail.com', '', '17:05', '11:00', 'sdfsds', 'Charity', 'dfdf', '2024-01-17 08:32:33', '', NULL, NULL, NULL),
(20, 262051842, 1, 'sds', 0, 'sssss@gmail.comss', '2024-01-01', '21:31', '03:33', 'bbbbb', 'Cocktail', 'gttth', '2024-01-17 08:47:24', '', NULL, NULL, NULL),
(21, 759330935, 3, 'Harsh V Prajapatii', 9574248115, 'prajapatiharsh@gmail.com', '2024-02-20', '10:09', '20:17', 'hello hello', 'Concert', 'newwwsdhello new', '2024-01-17 12:55:28', '', '8500 payment pending', 'Approved', '2024-01-18 13:34:03'),
(22, 677623626, 1, 'chaniyara dev ', 9408844717, 'dev@gmail.com', '2024-02-15', '17:00', '01:03', 'smc communitity hall ,jangirpura,surta', 'College', 'come with extra member ', '2024-01-18 15:35:45', '', 'congo!.....', 'Approved', '2024-01-23 13:41:14'),
(23, 954579768, 2, 'utsav', 6354131356, 'utsav@gmail.com', '2024-01-28', '13:17', '12:17', 'smc commminity hall ,tadwadi,surat', 'College', 'bhyuvegfuvg', '2024-01-24 04:48:05', '', NULL, 'Approved', '2024-01-24 04:50:46'),
(24, 254717170, 3, 'ravi', 5648351647, 'utsav@gmail.com', '2024-01-31', '14:22', '18:22', 'vapi', 'Get Together', 'jdkg', '2024-01-24 04:52:29', '', NULL, NULL, NULL),
(25, 364482531, 4, 'gduivg', 8527419637, 'utsav@gmail.com', '2024-01-26', '16:23', '18:23', 'ycfkud', 'Sangeet', 'grfiuer', '2024-01-24 04:53:59', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblcompany`
--

CREATE TABLE `tblcompany` (
  `id` int(11) NOT NULL,
  `regno` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `companyname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `companyemail` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `country` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `companyphone` text NOT NULL,
  `companyaddress` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `companylogo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'avatar15.jpg',
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcompany`
--

INSERT INTO `tblcompany` (`id`, `regno`, `companyname`, `companyemail`, `country`, `companyphone`, `companyaddress`, `companylogo`, `status`, `creationdate`) VALUES
(4, '43422332', 'UKHY Event', 'prajapatiharsh1312@gmail.com', 'India', '9574248115', 'Vivekanand college,usrat', 'logo.jpg', '1', '2024-01-02 12:17:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbldept`
--

CREATE TABLE `tbldept` (
  `did` int(11) NOT NULL,
  `dname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbldept`
--

INSERT INTO `tbldept` (`did`, `dname`) VALUES
(1, 'Host'),
(2, 'Security Manager'),
(3, 'Finacial manager'),
(4, 'decoration manager'),
(5, 'Ancouring Manager '),
(7, 'Music Manager');

-- --------------------------------------------------------

--
-- Table structure for table `tbleventtype`
--

CREATE TABLE `tbleventtype` (
  `ID` int(10) NOT NULL,
  `EventType` varchar(200) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbleventtype`
--

INSERT INTO `tbleventtype` (`ID`, `EventType`, `CreationDate`) VALUES
(1, 'Anniversary', '2024-01-02 07:01:39'),
(2, 'Birthday Party', '2024-01-02 07:01:41'),
(3, 'Charity', '2024-01-02 07:02:43'),
(4, 'Cocktail', '2024-01-02 07:03:00'),
(5, 'College', '2024-01-02 07:03:11'),
(6, 'Community', '2024-01-02 07:03:24'),
(7, 'Concert', '2024-01-02 07:03:35'),
(8, 'Engagement', '2024-01-02 07:03:51'),
(9, 'Get Together', '2024-01-02 07:04:04'),
(10, 'Government', '2024-01-02 07:04:15'),
(11, 'Night Club', '2024-01-02 07:04:26'),
(13, 'Post Wedding', '2024-01-02 07:05:01'),
(14, 'Pre Engagement', '2024-01-02 07:05:18'),
(15, 'Religious', '2024-01-02 07:05:27'),
(16, 'Sangeet', '2024-01-02 07:05:43'),
(17, 'Social', '2024-01-02 07:05:58'),
(18, 'Wedding', '2024-01-02 07:06:07');

-- --------------------------------------------------------

--
-- Table structure for table `tblfeedback`
--

CREATE TABLE `tblfeedback` (
  `fid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(25) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblfeedback`
--

INSERT INTO `tblfeedback` (`fid`, `name`, `email`, `subject`, `message`) VALUES
(1, 'yagn', 'harsh@gmail.com', 'ada', 'hello'),
(2, 'utsav bapodariya', 'sandip@gmail.com', 'hii', 'hiioo'),
(3, 'kevin ashmaniwala', 'harsh@gmail.com', 'thank you', 'your service is best.'),
(4, 'yagn dabhi', 'bapodariyau@gmail.com', 'hindi', 'abcdiydkfsidh');

-- --------------------------------------------------------

--
-- Table structure for table `tblgallery`
--

CREATE TABLE `tblgallery` (
  `gid` int(11) NOT NULL,
  `gimgpath` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblgallery`
--

INSERT INTO `tblgallery` (`gid`, `gimgpath`) VALUES
(3, '../img/gallery/1.jpg'),
(4, '../img/gallery/2.jpg'),
(5, '../img/gallery/3.jpg'),
(6, '../img/gallery/4.jpg'),
(7, '../img/gallery/5.jpg'),
(8, '../img/gallery/6.jpg'),
(10, '../img/gallery/8.jpg'),
(11, '../img/gallery/7.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblservice`
--

CREATE TABLE `tblservice` (
  `ID` int(10) NOT NULL,
  `ServiceName` varchar(200) DEFAULT NULL,
  `SerImgPath` varchar(200) NOT NULL,
  `SerDes` varchar(250) NOT NULL,
  `ServicePrice` varchar(200) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblservice`
--

INSERT INTO `tblservice` (`ID`, `ServiceName`, `SerImgPath`, `SerDes`, `ServicePrice`, `CreationDate`) VALUES
(1, 'Party decorations', 'img\\decor.jpg', 'we finish designing 4 hours  before your ceremony .', '8000', '2024-01-04 07:17:43'),
(2, 'Party DJ', 'img\\dj.jpg', '(we install the DJ equipment 1 hour before your selected event start time)', '700', '2024-01-04 07:18:32'),
(3, 'Ceremony Music', 'img\\music.jpg', 'Our ceremony music service is a popular add on to our wedding DJ stay all day hire.', '650', '2024-01-04 07:19:14'),
(4, 'Photo Booth Hire', 'img\\pre.jpg', 'we install the DJ equipment before your ceremony ', '500', '2024-01-04 07:19:51'),
(13, 'new', '../img/41FQRweFDVL._SX300_SY300_QL70_FMwebp_.jpg', 'dsds', '1200', '2024-02-26 13:45:09');

-- --------------------------------------------------------

--
-- Table structure for table `tblvenue`
--

CREATE TABLE `tblvenue` (
  `vid` int(10) NOT NULL,
  `vimgpath` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblvenue`
--

INSERT INTO `tblvenue` (`vid`, `vimgpath`) VALUES
(11, '../img/venue-gallery/101.jpg'),
(12, '../img/venue-gallery/102.jpg'),
(13, '../img/venue-gallery/103.jpg'),
(14, '../img/venue-gallery/104.jpg'),
(15, '../img/venue-gallery/105.jpg'),
(16, '../img/venue-gallery/106.jpg'),
(17, '../img/venue-gallery/107.jpg'),
(18, '../img/venue-gallery/108.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emp`
--
ALTER TABLE `emp`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblbooking`
--
ALTER TABLE `tblbooking`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ServiceID` (`ServiceID`),
  ADD KEY `EventType` (`EventType`(191));

--
-- Indexes for table `tblcompany`
--
ALTER TABLE `tblcompany`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbldept`
--
ALTER TABLE `tbldept`
  ADD PRIMARY KEY (`did`);

--
-- Indexes for table `tbleventtype`
--
ALTER TABLE `tbleventtype`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `EventType` (`EventType`(191));

--
-- Indexes for table `tblfeedback`
--
ALTER TABLE `tblfeedback`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `tblgallery`
--
ALTER TABLE `tblgallery`
  ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `tblservice`
--
ALTER TABLE `tblservice`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- Indexes for table `tblvenue`
--
ALTER TABLE `tblvenue`
  ADD PRIMARY KEY (`vid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emp`
--
ALTER TABLE `emp`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tblbooking`
--
ALTER TABLE `tblbooking`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tblcompany`
--
ALTER TABLE `tblcompany`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbldept`
--
ALTER TABLE `tbldept`
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbleventtype`
--
ALTER TABLE `tbleventtype`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tblfeedback`
--
ALTER TABLE `tblfeedback`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblgallery`
--
ALTER TABLE `tblgallery`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tblservice`
--
ALTER TABLE `tblservice`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tblvenue`
--
ALTER TABLE `tblvenue`
  MODIFY `vid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
