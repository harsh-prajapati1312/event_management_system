-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2024 at 05:59 AM
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
(2, 'Harsh  Prajapati', 'harsh@gmail.com', 'katargam', '../img/2.jpg', 'manager'),
(3, 'Sandip Chavda', 'sandip@gmail.com', 'dabholi', '../img/3.jpg', 'Security Manager'),
(4, 'Utsav Bapodariya', 'utsav@gmail.com', 'dabholi road', '../img/4.jpg', 'Finacial Manager'),
(5, 'Yagn Dabhi', 'yagndabhi@gmail.com', 'pal', '../img/5.jpg', 'Ancouring Manager'),
(6, 'dev Chaniyara', 'dev@gmail.com', 'amroli', '../img/6.jpg', 'Security Manager');

-- --------------------------------------------------------

--
-- Table structure for table `pay`
--

CREATE TABLE `pay` (
  `id` int(11) NOT NULL,
  `booking_Id` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pay`
--

INSERT INTO `pay` (`id`, `booking_Id`, `amount`, `payment_status`, `payment_id`, `added_on`) VALUES
(1, '507402042', 9350.00, 'success', 'pay_NqqZ7FwYIMRZ9V', '2024-03-26 04:10:56'),
(2, '970216999', 9200.00, 'success', 'pay_NtDdA17Hh5Fcw3', '2024-04-01 04:03:39');

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
(1, 'Superuser', '1', '1', NULL, NULL),
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
('dev', 'dev', 'devchaniyara28@gmail.com', 0, '9408844717', '164399d4f6f2b7033e79515fee475368'),
('hitlo', 'hit', 'hitarthsojitra1807@gmail.com', 0, '6356730080', 'd9e9211e8f4bdb8e332dd83b46521a80'),
('HarshPrajapati', 'hp1312', 'bughunter024@gmail.com', 0, '9574248115', 'f0af21f0ca52c7e6409bd4072bb9f263'),
('kevin', 'kevin', 'ashmaniwalakevin@gmail.com', 539144, '8320603038', 'c14730923f61e607b0c17e29abfdf154'),
('sandip', 'sandip', 'sandip@gmail.com', 0, '7698761245', '5deb97ec0f434f25fd228560a4478bf9'),
('spna', 'SAPNA', 'yagndabhi@gmail.com', 0, '9987766554', 'd2a8da21689e152ff4552c9d1109d94a'),
('bhau', 'tejas', 'tejas@gmail.com', 0, '9099987682', '9f48ea362a8aeb39e1d82d688ac69630'),
('utsav', 'utsav', 'bapodariyau@gmail.com', 0, '6354131356', '6a56c53a23d800e82d964cc15daf1497');

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
(2, 'U002', 'Admin', 'kevin', 'kevin', 'ashmaniwala ', 8320603038, 'kevin@gmail.com', 1, '1.jpg', '9d5e3ecdeb4cdb7acfd63075ae046672', '2024-01-01 10:18:39'),
(29, '503', 'Admin', 'harsh', 'harsh', 'prajapati', 9574248115, 'harsh@gmail.com', 1, 'avatar15.jpg', 'd4e3730e8cba214f85cddae5f9331d74', '2024-01-19 13:42:56'),
(30, '504', 'Admin', 'utsav', 'utsav', 'bapodariya', 6354131356, 'utsav@gmail.com', 1, 'avatar15.jpg', '293f4c20a14b49ce509a4e53f600fb8d', '2024-01-19 13:43:47'),
(31, '505', 'Admin', 'yagn', 'yagn', 'dabhi', 9904759070, 'yagn@gmail.com', 1, 'avatar15.jpg', 'fbe8f2afad186fd2066c95d5f9a254b6', '2024-01-19 13:45:06'),
(32, '5', 'Admin', 'ygu', 'dabhi', 'ygu', 9909909909, 'ygu0@gmail.com', 0, 'avatar15.jpg', 'c9e89035e8cac6b7b0b95a158361731e', '2024-04-05 09:59:28');

-- --------------------------------------------------------

--
-- Table structure for table `tblbooking`
--

CREATE TABLE `tblbooking` (
  `ID` int(10) NOT NULL,
  `BookingID` int(10) DEFAULT NULL,
  `ServiceID` varchar(50) DEFAULT NULL,
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
  `is_paid` tinyint(4) NOT NULL,
  `Remark` varchar(200) DEFAULT NULL,
  `Status` varchar(200) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblbooking`
--

INSERT INTO `tblbooking` (`ID`, `BookingID`, `ServiceID`, `Name`, `MobileNumber`, `Email`, `EventDate`, `EventStartingtime`, `EventEndingtime`, `VenueAddress`, `EventType`, `AdditionalInformation`, `BookingDate`, `Total_amount`, `is_paid`, `Remark`, `Status`, `UpdationDate`) VALUES
(14, 954554731, '1,2,3', 'Surabhi Kumawat', 8080808080, 'surabhi@gmail.cmo', '2024-01-22', '11 a.m', '12 p.m', 'Suyojeet Tower, near Relience Petrol Pump, Kinaara Hotel, Nashik', 'Birthday Party', 'Special Menu with Professional waiters', '2024-01-22 09:28:13', '', 0, 'Done', 'Approved', '2024-03-12 04:28:18'),
(15, 977361722, '1,2,4', 'Jayesh Panghawane', 7070707070, 'jayesh768@gmail.com', '2024-03-24', '1 p.m', '5 p.m', 'Bansi Plaza, near Kumar Hotel, Nashik', 'Wedding', 'Special Menu', '2022-03-22 09:29:18', '', 0, 'okkk', 'Approved', '2024-03-12 04:28:41'),
(18, 523245406, '1,2,3,15', 'harsh v prajapati', 1010101010, 'bughunter024@gmail.com', '2024-12-12', '12:03', '13:02', 'hello new', 'Anniversary', 'helloo', '2024-01-17 08:12:20', '10150', 0, 'hii', 'Approved', '2024-04-05 08:30:25'),
(19, 643029466, '3,2', 'asa', 0, 'sssss@gmail.com', '', '17:05', '11:00', 'sdfsds', 'Charity', 'dfdf', '2024-01-17 08:32:33', '', 0, NULL, NULL, NULL),
(20, 262051842, '1,3,2', 'sds', 0, 'sssss@gmail.comss', '2024-01-01', '21:31', '03:33', 'bbbbb', 'Cocktail', 'gttth', '2024-01-17 08:47:24', '', 0, NULL, NULL, NULL),
(21, 759330935, '3,4', 'Harsh V Prajapatii', 9574248115, 'prajapatiharsh@gmail.com', '2024-02-20', '10:09', '20:17', 'hello hello', 'Concert', 'newwwsdhello new', '2024-01-17 12:55:28', '', 0, '8500 payment pending', 'Approved', '2024-03-12 04:29:58'),
(22, 677623626, '1,4', 'chaniyara dev ', 9408844717, 'dev@gmail.com', '2024-02-15', '17:00', '01:03', 'smc communitity hall ,jangirpura,surta', 'College', 'come with extra member ', '2024-01-18 15:35:45', '', 0, 'congo!.....', 'Approved', '2024-03-12 04:30:09'),
(23, 954579768, '1,2', 'utsav', 6354131356, 'utsav@gmail.com', '2024-01-28', '13:17', '12:17', 'smc commminity hall ,tadwadi,surat', 'College', 'bhyuvegfuvg', '2024-01-24 04:48:05', '', 0, NULL, 'Approved', '2024-03-12 04:30:22'),
(24, 254717170, '3,4', 'ravi', 5648351647, 'utsav@gmail.com', '2024-01-31', '14:22', '18:22', 'vapi', 'Get Together', 'jdkg', '2024-01-24 04:52:29', '', 0, NULL, NULL, NULL),
(25, 364482531, '4,1', 'gduivg', 8527419637, 'utsav@gmail.com', '2024-01-26', '16:23', '18:23', 'ycfkud', 'Sangeet', 'grfiuer', '2024-01-24 04:53:59', '', 0, NULL, NULL, NULL),
(27, 970216999, '1,2,4', 'utsav bapodar', 6354131356, 'bapodariyau@gmail.com', '2024-03-30', '10:16', '14:16', 'katargam surat', 'College', 'ohk', '2024-03-12 02:46:21', '9200', 1, 'ohk', 'Approved', '2024-04-01 04:15:46'),
(28, 131455725, '1,2,4', 'Harsh  variya', 1223333333, 'yagndabhi@gmail.com', '2024-11-17', '01:31', '06:31', 'surat', 'Anniversary', 'surat', '2024-03-12 06:02:14', '9200', 0, 'hey', 'Approved', '2024-03-12 06:04:19'),
(29, 380381549, '1,4,14', 'harsh prajapati', 9574248115, 'bughunter024@gmail.com', '2024-03-28', '04:16', '15:16', '157 VITHTHALNAGAR SOC Surat ', 'Sangeet', 'aaa', '2024-03-26 05:46:41', '9400', 0, NULL, NULL, '2024-03-26 05:46:52');

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
(18, 'Wedding', '2024-01-02 07:06:07'),
(25, 'abcd', '2024-03-13 06:10:59');

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
-- Indexes for table `pay`
--
ALTER TABLE `pay`
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `EventType_2` (`EventType`),
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
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pay`
--
ALTER TABLE `pay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tblbooking`
--
ALTER TABLE `tblbooking`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tblvenue`
--
ALTER TABLE `tblvenue`
  MODIFY `vid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
