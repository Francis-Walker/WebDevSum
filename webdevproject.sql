-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2020 at 11:04 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webdevproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentID` int(11) NOT NULL,
  `ticketID` int(11) NOT NULL,
  `submitedTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `comment` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentID`, `ticketID`, `submitedTime`, `comment`) VALUES
(96, 108, '2020-05-13 12:22:43', ''),
(97, 109, '2020-05-13 12:30:54', ''),
(98, 110, '2020-05-13 12:30:59', ''),
(99, 111, '2020-05-13 13:18:10', ''),
(100, 112, '2020-05-13 16:01:20', 'hello'),
(101, 113, '2020-05-13 16:02:08', 'hello'),
(102, 114, '2020-05-14 09:02:28', 'test1'),
(103, 115, '2020-05-14 09:02:46', 'test2'),
(104, 116, '2020-05-14 09:03:08', 'test3');

-- --------------------------------------------------------

--
-- Table structure for table `dependents`
--

CREATE TABLE `dependents` (
  `ID` varchar(13) NOT NULL,
  `depID` int(11) NOT NULL,
  `memID` int(12) NOT NULL,
  `coverageDate` date NOT NULL,
  `planID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dependents`
--

INSERT INTO `dependents` (`ID`, `depID`, `memID`, `coverageDate`, `planID`) VALUES
('5971895458822', 13, 27, '0000-00-00', 1),
('6070065878914', 14, 13, '0000-00-00', 1),
('6168236299006', 15, 15, '0000-00-00', 3),
('6266406719098', 16, 19, '0000-00-00', 3),
('6364577139190', 17, 15, '0000-00-00', 1),
('6462747559282', 18, 15, '0000-00-00', 2),
('6560917979374', 19, 11, '0000-00-00', 2),
('6659088399466', 20, 12, '0000-00-00', 1),
('6757258819558', 21, 20, '0000-00-00', 3),
('6855429239650', 22, 21, '0000-00-00', 2),
('6953599659742', 23, 13, '0000-00-00', 2),
('7051770079834', 24, 13, '0000-00-00', 2),
('7149940499926', 25, 22, '0000-00-00', 1),
('7248110920018', 26, 24, '0000-00-00', 3),
('7346281340110', 27, 10, '0000-00-00', 1),
('7444451760202', 28, 22, '0000-00-00', 3),
('7542622180294', 29, 27, '0000-00-00', 1),
('7640792600386', 30, 25, '0000-00-00', 3),
('7738963020478', 31, 27, '0000-00-00', 2),
('7837133440570', 32, 25, '0000-00-00', 2),
('7935303860662', 33, 14, '0000-00-00', 1),
('8033474280754', 34, 27, '0000-00-00', 3),
('8131644700846', 35, 15, '0000-00-00', 1),
('8229815120938', 36, 24, '0000-00-00', 3),
('8327985541030', 37, 23, '0000-00-00', 1),
('8426155961122', 38, 25, '0000-00-00', 3),
('8524326381214', 39, 17, '0000-00-00', 1),
('8622496801306', 40, 10, '0000-00-00', 2),
('8720667221398', 41, 21, '0000-00-00', 2),
('8818837641490', 42, 16, '0000-00-00', 2),
('8917008061582', 43, 10, '0000-00-00', 1),
('9015178481674', 44, 26, '0000-00-00', 3),
('9113348901766', 45, 18, '0000-00-00', 2),
('9211519321858', 46, 15, '0000-00-00', 1),
('9309689741950', 47, 15, '0000-00-00', 1),
('9407860162042', 48, 17, '0000-00-00', 3),
('9506030582134', 49, 15, '0000-00-00', 2),
('9604201002226', 50, 12, '0000-00-00', 3),
('9702371422318', 51, 13, '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `ID` varchar(13) NOT NULL,
  `memID` int(11) NOT NULL,
  `coverageDate` date NOT NULL,
  `planID` int(11) NOT NULL,
  `farmID` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`ID`, `memID`, `coverageDate`, `planID`, `farmID`) VALUES
('5971895458822', 10, '2020-03-01', 2, '2'),
('6070065878914', 11, '2020-05-10', 1, '2'),
('6168236299006', 12, '2020-05-04', 1, '2'),
('6266406719098', 13, '2020-05-10', 2, '2'),
('6364577139190', 14, '2020-05-02', 2, '2'),
('6462747559282', 15, '2020-05-02', 1, '3'),
('6560917979374', 16, '2020-05-01', 1, '3'),
('6659088399466', 17, '2020-05-01', 2, '5'),
('6757258819558', 18, '2020-05-01', 2, '3'),
('6855429239650', 19, '2020-05-01', 1, '3'),
('6953599659742', 20, '2020-05-01', 3, '3'),
('7051770079834', 21, '2020-05-01', 2, '4'),
('7149940499926', 22, '2020-05-01', 2, '4'),
('7248110920018', 23, '2020-04-10', 3, '4'),
('7248110920018', 24, '2020-05-02', 2, '4');

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE `persons` (
  `IDnum` varchar(13) NOT NULL,
  `PhoneNum` varchar(14) NOT NULL,
  `DOB` date NOT NULL,
  `email` varchar(256) NOT NULL,
  `fnames` varchar(256) NOT NULL,
  `sname` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`IDnum`, `PhoneNum`, `DOB`, `email`, `fnames`, `sname`) VALUES
('5971895458822', '6391211460', '0000-00-00', 'placerat@dictum.edu', 'Wing', 'Chambers'),
('6070065878914', '3114519283', '0000-00-00', 'ante.blandit.viverra@auctor.ca', 'Derek', 'Keller'),
('6168236299006', '7701158929', '0000-00-00', 'nunc.sed.pede@libero.co.uk', 'Hedda', 'Vinson'),
('6266406719098', '4120301735', '0000-00-00', 'Integer.aliquam@velmaurisInteger.ca', 'Orlando', 'Rice'),
('6364577139190', '2382116862', '0000-00-00', 'id@dui.org', 'Chelsea', 'Hall'),
('6462747559282', '1892101833', '0000-00-00', 'venenatis.lacus.Etiam@eratinconsectetuer.org', 'Axel', 'Nicholson'),
('6560917979374', '3510884594', '0000-00-00', 'Maecenas.ornare@Curae.edu', 'Bertha', 'Mercado'),
('6659088399466', '7359326112', '0000-00-00', 'fermentum.arcu.Vestibulum@scelerisquenequesed.net', 'Lucius', 'Haynes'),
('6757258819558', '3479507921', '0000-00-00', 'semper.egestas.urna@Proinnonmassa.edu', 'Holmes', 'Rodriquez'),
('6855429239650', '1370293600', '0000-00-00', 'sapien.Aenean.massa@ridiculus.com', 'Conan', 'Flynn'),
('6953599659742', '4600591841', '0000-00-00', 'et.libero@Nullamsuscipitest.co.uk', 'Veda', 'Johnston'),
('7051770079834', '9089421139', '0000-00-00', 'vel.nisl.Quisque@Donecporttitortellus.net', 'Burton', 'Preston'),
('7149940499926', '68326709130', '0000-00-00', 'massa.Integer@interdum.edu', 'Hiram', 'Hendrix'),
('7248110920018', '6695152206', '0000-00-00', 'placerat@dictum.edu', 'Wing', 'Chambers'),
('7346281340110', '2078469375', '0000-00-00', 'ante.blandit.viverra@auctor.ca', 'Derek', 'Keller'),
('7444451760202', '2669511023', '0000-00-00', 'nunc.sed.pede@libero.co.uk', 'Hedda', 'Vinson'),
('7542622180294', '7757509148', '0000-00-00', 'Integer.aliquam@velmaurisInteger.ca', 'Orlando', 'Rice'),
('7640792600386', '3570508763', '0000-00-00', 'id@dui.org', 'Chelsea', 'Hall'),
('7738963020478', '5275582117', '0000-00-00', 'venenatis.lacus.Etiam@eratinconsectetuer.org', 'Axel', 'Nicholson'),
('7837133440570', '6789779793', '0000-00-00', 'Maecenas.ornare@Curae.edu', 'Bertha', 'Mercado'),
('7935303860662', '8725242871', '0000-00-00', 'fermentum.arcu.Vestibulum@scelerisquenequesed.net', 'Lucius', 'Haynes'),
('8033474280754', '6327003639', '0000-00-00', 'semper.egestas.urna@Proinnonmassa.edu', 'Holmes', 'Rodriquez'),
('8131644700846', '5412503578', '0000-00-00', 'sapien.Aenean.massa@ridiculus.com', 'Conan', 'Flynn'),
('8229815120938', '2232726722', '0000-00-00', 'et.libero@Nullamsuscipitest.co.uk', 'Veda', 'Johnston'),
('8327985541030', '5264719910', '0000-00-00', 'vel.nisl.Quisque@Donecporttitortellus.net', 'Burton', 'Preston'),
('8426155961122', '5770617901', '0000-00-00', 'massa.Integer@interdum.edu', 'Hiram', 'Hendrix'),
('8524326381214', '7623301532', '0000-00-00', 'placerat@dictum.edu', 'Wing', 'Chambers'),
('8622496801306', '6983069572', '0000-00-00', 'ante.blandit.viverra@auctor.ca', 'Derek', 'Keller'),
('8720667221398', '4543020639', '0000-00-00', 'nunc.sed.pede@libero.co.uk', 'Hedda', 'Vinson'),
('8818837641490', '1680115830', '0000-00-00', 'Integer.aliquam@velmaurisInteger.ca', 'Orlando', 'Rice'),
('8917008061582', '4328607340', '0000-00-00', 'id@dui.org', 'Chelsea', 'Hall'),
('9015178481674', '5646244108', '0000-00-00', 'venenatis.lacus.Etiam@eratinconsectetuer.org', 'Axel', 'Nicholson'),
('9113348901766', '9350946600', '0000-00-00', 'Maecenas.ornare@Curae.edu', 'Bertha', 'Mercado'),
('9211519321858', '8323791720', '0000-00-00', 'fermentum.arcu.Vestibulum@scelerisquenequesed.net', 'Lucius', 'Haynes'),
('9309689741950', '9052039267', '0000-00-00', 'semper.egestas.urna@Proinnonmassa.edu', 'Holmes', 'Rodriquez'),
('9407860162042', '4401845001', '0000-00-00', 'sapien.Aenean.massa@ridiculus.com', 'Conan', 'Flynn'),
('9506030582134', '4713153443', '0000-00-00', 'et.libero@Nullamsuscipitest.co.uk', 'Veda', 'Johnston'),
('9604201002226', '7648137893', '0000-00-00', 'vel.nisl.Quisque@Donecporttitortellus.net', 'Burton', 'Preston'),
('9702371422318', '9908034799', '0000-00-00', 'massa.Integer@interdum.edu', 'Hiram', 'Hendrix'),
('IDnum', 'PhoneNum', '0000-00-00', 'email', 'fnames', 'sname');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `planID` int(11) NOT NULL,
  `deductionAmount` int(255) NOT NULL,
  `paymentAmount` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`planID`, `deductionAmount`, `paymentAmount`) VALUES
(1, 10, 10000),
(2, 20, 20000),
(3, 30, 30000);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `TicketID` int(11) NOT NULL,
  `Type` varchar(265) NOT NULL,
  `Isolated` int(255) NOT NULL,
  `Changes` varchar(256) NOT NULL,
  `farmID` varchar(265) NOT NULL,
  `adminID` int(255) NOT NULL,
  `Status` int(1) NOT NULL,
  `UserID` int(255) NOT NULL,
  `details` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`TicketID`, `Type`, `Isolated`, `Changes`, `farmID`, `adminID`, `Status`, `UserID`, `details`) VALUES
(108, 'removeMember', 15, '31', '3', 0, 0, 1, ''),
(109, 'removeMember', 12, '31', '2', 0, 0, 2, ''),
(110, 'removeMember', 14, '31', '2', 0, 0, 2, ''),
(111, 'removeMember', 12, '31', '2', 0, 0, 1, ''),
(112, 'testy1', 420, '2', '', 0, 3, 2, 'Default'),
(113, 'testy1', 420, '2', '', 0, 3, 2, 'Default'),
(114, 'removeMember', 10, '31', '2', 0, 0, 1, ''),
(115, 'editMember', 16, '0813404733,haywardwalker@gmail.com,2', '3', 0, 0, 1, ''),
(116, 'addDependent', 15, '99704297349017,Franics,Walker,haywardwalker@gmail.com,0813404733,2020-05-04,2', '3', 0, 0, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Username` varchar(255) NOT NULL,
  `UserType` tinyint(1) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL,
  `UserID` int(11) NOT NULL,
  `FarmName` varchar(255) DEFAULT 'Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Username`, `UserType`, `PasswordHash`, `UserID`, `FarmName`) VALUES
('Bobson', 1, '5f4dcc3b5aa765d61d8327deb882cf99', 1, 'Admin'),
('Francis', 0, '5f4dcc3b5aa765d61d8327deb882cf99', 2, 'FarmnameFrancis'),
('Jake', 0, '5f4dcc3b5aa765d61d8327deb882cf99', 3, 'Farmnamejake'),
('user1', 0, '5f4dcc3b5aa765d61d8327deb882cf99', 4, 'Users farm 1'),
('user0', 0, '5f4dcc3b5aa765d61d8327deb882cf99', 5, 'users farm 0'),
('Bobson1', 1, '5f4dcc3b5aa765d61d8327deb882cf99', 6, 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`);

--
-- Indexes for table `dependents`
--
ALTER TABLE `dependents`
  ADD PRIMARY KEY (`depID`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`memID`);

--
-- Indexes for table `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`IDnum`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`planID`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`TicketID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `dependents`
--
ALTER TABLE `dependents`
  MODIFY `depID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `memID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `planID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `TicketID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
