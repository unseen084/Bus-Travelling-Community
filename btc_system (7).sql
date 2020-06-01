-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2017 at 07:38 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `btc_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `about_id` int(11) NOT NULL,
  `busID` int(11) NOT NULL,
  `reviewID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`about_id`, `busID`, `reviewID`) VALUES
(2, 4, 3),
(3, 7, 4),
(4, 3, 18),
(5, 3, 20),
(6, 3, 22);

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `bus_id` int(11) NOT NULL,
  `bus_name` varchar(50) NOT NULL,
  `departure_time` time NOT NULL DEFAULT '00:00:00',
  `arrival_time` time NOT NULL DEFAULT '00:00:00',
  `total_seat` int(11) NOT NULL,
  `seat_price` int(11) NOT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`bus_id`, `bus_name`, `departure_time`, `arrival_time`, `total_seat`, `seat_price`, `type`) VALUES
(1, 'Sheba Paribahan', '10:00:00', '12:00:00', 40, 170, 'AC'),
(2, 'AC Delux', '08:30:00', '14:15:00', 40, 250, 'Non AC'),
(3, 'Dhaka Express', '00:00:00', '00:00:00', 40, 170, NULL),
(4, 'Green Line', '00:00:00', '00:00:00', 40, 230, NULL),
(5, 'Comfort Line', '00:00:00', '00:00:00', 40, 240, NULL),
(6, 'MM Paribahan', '00:00:00', '00:00:00', 40, 150, NULL),
(7, 'Bilash Paribahan', '00:00:00', '00:00:00', 40, 140, NULL),
(8, 'Rajdhani Express ', '00:00:00', '00:00:00', 40, 150, NULL),
(9, 'Shohagh Paribahan', '00:00:00', '00:00:00', 40, 160, NULL),
(10, 'Sky Line ', '00:00:00', '00:00:00', 40, 220, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bus_company`
--

CREATE TABLE `bus_company` (
  `bus_name` varchar(50) NOT NULL,
  `company_id` int(11) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `rating` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bus_company`
--

INSERT INTO `bus_company` (`bus_name`, `company_id`, `description`, `rating`) VALUES
('Sheba Paribahan', 1, NULL, 4),
('AC Delux', 2, NULL, 5),
('Dhaka Express', 3, NULL, 3.5),
('Green Line', 4, NULL, 4.75),
('Comfort Line', 5, NULL, 3.75),
('MM Paribahan', 6, NULL, 3.5),
('Bilash Paribahan', 7, NULL, 3),
('Rajdhani Express ', 8, NULL, 4.75),
('Shohagh Paribahan', 9, NULL, 5),
('Sky Line ', 10, NULL, 3.75);

-- --------------------------------------------------------

--
-- Table structure for table `buys`
--

CREATE TABLE `buys` (
  `buys_id` int(11) NOT NULL,
  `passengerID` int(11) NOT NULL,
  `ticketID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buys`
--

INSERT INTO `buys` (`buys_id`, `passengerID`, `ticketID`) VALUES
(1, 11, 1),
(2, 12, 2),
(3, 13, 3),
(4, 14, 4),
(5, 15, 5),
(6, 16, 6),
(7, 17, 7),
(8, 18, 8),
(9, 19, 9),
(10, 20, 10);

-- --------------------------------------------------------

--
-- Table structure for table `comments_on`
--

CREATE TABLE `comments_on` (
  `comments_on_id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `reviewID` int(11) NOT NULL,
  `msg` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments_on`
--

INSERT INTO `comments_on` (`comments_on_id`, `userID`, `reviewID`, `msg`) VALUES
(1, 12, 7, 'mani na manbo na :P'),
(2, 12, 7, 'kotha akdom sotto');

-- --------------------------------------------------------

--
-- Table structure for table `isbooked_for`
--

CREATE TABLE `isbooked_for` (
  `isbooked_for_id` int(11) NOT NULL,
  `busID` int(11) NOT NULL,
  `ticketID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `isbooked_for`
--

INSERT INTO `isbooked_for` (`isbooked_for_id`, `busID`, `ticketID`) VALUES
(1, 3, 1),
(2, 3, 2),
(3, 3, 3),
(4, 3, 4),
(5, 3, 5),
(6, 3, 6),
(7, 3, 7),
(8, 3, 8),
(9, 3, 9),
(10, 6, 10);

-- --------------------------------------------------------

--
-- Table structure for table `isof`
--

CREATE TABLE `isof` (
  `isof_id` int(11) NOT NULL,
  `busID` int(11) NOT NULL,
  `compID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `passenger_id` int(11) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `passenger_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`passenger_id`, `contact`, `passenger_name`, `email`, `gender`) VALUES
(1, '01677123456', 'gb_riyad', 'gb_riyad@gmail.com', 'male'),
(2, '01625299883', 'reza07', 'reza07@gmail.com', 'male'),
(3, '01688266211', 'samrin_riya', 'samrin_riya07@gmail.com', 'female'),
(4, '01789076541', 'rahman.12', 'rahman.12@yahoo.com', 'male'),
(5, '01812345678', 'mum_tahina', 'mum_tahina@yahoo.com', 'female'),
(6, '01552345678', 'rakib_suvo', 'suvo11@hotmail.com', 'male'),
(7, '01956789012', 'razon_cse', 'razon_cse@yahoo.com', 'male'),
(8, '01768902345', 'rayhan_ahmed', 'rayhan03@gmail.com', 'male'),
(9, '01789012345', 'sanzida04', 'sanzida04@yahoo.com', 'female'),
(10, '01912309876', 'sabbir003', 'sabbir_ahmed@hotmail.com', 'male'),
(11, 'g', 'h', 'd', 'male'),
(12, 'g', 'h', 'd', 'male'),
(13, 'g', 'h', 'd', 'male'),
(14, 'g', 'h', 'd', 'male'),
(15, 'g', 'h', 'd', 'male'),
(16, 'g', 'h', 'd', 'male'),
(17, 'g', 'h', 'd', 'male'),
(18, 'g', 'h', 'd', 'male'),
(19, 'g', 'h', 'd', 'male'),
(20, 'g', 'h', 'd', 'male');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `posts_id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `reviewID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`posts_id`, `userID`, `reviewID`) VALUES
(14, 13, 3),
(15, 14, 20),
(16, 11, 4),
(17, 12, 18),
(18, 15, 23),
(19, 15, 7);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `description` text,
  `fare` double NOT NULL,
  `up` int(11) DEFAULT NULL,
  `down` int(11) DEFAULT NULL,
  `post_date` date NOT NULL,
  `rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `description`, `fare`, `up`, `down`, `post_date`, `rate`) VALUES
(3, 'chole bt not that good', 50, 6, 8, '2017-04-18', 3),
(4, 'kisu boler nai', 60, 10, 4, '2017-04-01', 4),
(7, 'bus service aro vlo kora dorker', 30, 5, 2, '2017-04-21', 4),
(18, 'service vlo na tao kisu korer nai', 450, 9, 0, '0000-00-00', 5),
(20, 'student der jonno vlo', 10, 15, 0, '0000-00-00', 5),
(22, 'service akhn r ager moto nai', 10, 7, 1, '2017-04-20', 4),
(23, 'valoi', 250, 9, 2, '2017-04-21', 3);

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `route_id` int(11) NOT NULL,
  `source` varchar(50) NOT NULL,
  `destination` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`route_id`, `source`, `destination`) VALUES
(1, 'Dhaka', 'Bogra'),
(2, 'Dhaka', 'Comilla'),
(3, 'Tangail', 'Dhaka'),
(4, 'Rajshahi', 'Manikganj'),
(5, 'Dhaka', 'Sylhet'),
(6, 'Gaibandha', 'Chittagong'),
(7, 'Bogra', 'Bandarban'),
(8, 'Barisal', 'Sylhet'),
(9, 'Dhaka', 'Rangpur'),
(10, 'Comilla', 'Rangpur'),
(11, 'Tangail', 'Barisal'),
(12, 'Rangamati', 'Dhaka'),
(13, 'Gazipur', 'Sylhet'),
(14, 'Dhaka', 'Teknaf'),
(15, 'Dhaka', 'Pabna'),
(16, 'Noahkhali', 'Manikganj'),
(17, 'Dhaka', 'Bandarban'),
(18, 'Khulna', 'Dinajpur'),
(19, 'Dhaka', 'Khulna'),
(20, 'Mymensingh', 'Chittagong');

-- --------------------------------------------------------

--
-- Table structure for table `seats_of_ticket`
--

CREATE TABLE `seats_of_ticket` (
  `ticket_id` int(10) NOT NULL,
  `seat_no` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seats_of_ticket`
--

INSERT INTO `seats_of_ticket` (`ticket_id`, `seat_no`) VALUES
(7, '1_1'),
(7, '1_2'),
(7, '2_2'),
(8, '1_1'),
(8, '1_2'),
(8, '2_2'),
(8, '6_2'),
(8, '7_2'),
(9, '1_1'),
(9, '1_2'),
(9, '2_2'),
(9, '4_5'),
(9, '5_5'),
(9, '6_2'),
(9, '6_4'),
(9, '7_2'),
(10, '1_5'),
(10, '2_4'),
(10, '2_5');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL,
  `travel_date` date NOT NULL,
  `booking_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `confirm` tinyint(1) NOT NULL,
  `price` double NOT NULL,
  `remaining_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `travel_date`, `booking_time`, `confirm`, `price`, `remaining_time`) VALUES
(1, '2017-04-22', '2017-04-22 17:28:57', 0, 170, '0000-00-00 00:00:00'),
(2, '2017-04-22', '2017-04-22 17:29:03', 0, 170, '0000-00-00 00:00:00'),
(3, '2017-04-22', '2017-04-22 17:29:48', 0, 170, '0000-00-00 00:00:00'),
(4, '2017-04-22', '2017-04-22 17:29:48', 0, 170, '0000-00-00 00:00:00'),
(5, '2017-04-22', '2017-04-22 17:32:29', 0, 170, '0000-00-00 00:00:00'),
(6, '2017-04-22', '2017-04-22 17:33:43', 0, 170, '0000-00-00 00:00:00'),
(7, '2017-04-22', '2017-04-22 17:34:40', 0, 170, '0000-00-00 00:00:00'),
(8, '2017-04-22', '2017-04-22 17:34:44', 0, 170, '0000-00-00 00:00:00'),
(9, '2017-04-22', '2017-04-22 17:34:47', 0, 170, '0000-00-00 00:00:00'),
(10, '2017-04-22', '2017-04-22 17:37:37', 0, 150, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `travels_through`
--

CREATE TABLE `travels_through` (
  `route_id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `travels_through`
--

INSERT INTO `travels_through` (`route_id`, `bus_id`) VALUES
(1, 3),
(1, 6),
(1, 8),
(1, 9),
(2, 4),
(4, 6),
(14, 5),
(15, 10);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dp` blob,
  `uup` int(11) NOT NULL,
  `udown` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`firstName`, `lastName`, `userName`, `email`, `password`, `user_id`, `dp`, `uup`, `udown`) VALUES
('Gb', 'Riyad', 'gbriyad', 'gbriyad@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 11, '', 5, 2),
('Mushfiqur', 'Rahman', 'unseen', 'mushfiqur696@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 12, '', 0, 0),
('Mum', 'Tahina', 'mumtahina', 'mumtahina@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 13, '', 0, 0),
('Shahriar', 'Reza', 'msrr', 'msrrusel@gmail.com', '6e2686834b146015ade645ec80cd974737661176db0b7f53eb88a5e6d2f575c1', 14, '', 0, 0),
('Samrin', 'Riya', 'sriya', 'samrin@hotmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 15, '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `votes_id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `reviewID` int(11) NOT NULL,
  `liked` int(11) NOT NULL,
  `disliked` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`votes_id`, `userID`, `reviewID`, `liked`, `disliked`) VALUES
(28, 12, 23, 1, 0),
(35, 12, 22, 0, 1),
(37, 11, 7, 1, 0),
(38, 11, 4, 1, 0),
(39, 13, 23, 1, 0),
(40, 13, 22, 1, 0),
(41, 15, 3, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`about_id`),
  ADD KEY `busID` (`busID`),
  ADD KEY `reviewID` (`reviewID`);

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`bus_id`);

--
-- Indexes for table `bus_company`
--
ALTER TABLE `bus_company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `buys`
--
ALTER TABLE `buys`
  ADD PRIMARY KEY (`buys_id`),
  ADD KEY `passengerID` (`passengerID`),
  ADD KEY `ticketID` (`ticketID`);

--
-- Indexes for table `comments_on`
--
ALTER TABLE `comments_on`
  ADD PRIMARY KEY (`comments_on_id`),
  ADD KEY `userID` (`userID`),
  ADD KEY `reviewID` (`reviewID`);

--
-- Indexes for table `isbooked_for`
--
ALTER TABLE `isbooked_for`
  ADD PRIMARY KEY (`isbooked_for_id`),
  ADD KEY `busID` (`busID`),
  ADD KEY `ticketID` (`ticketID`);

--
-- Indexes for table `isof`
--
ALTER TABLE `isof`
  ADD PRIMARY KEY (`isof_id`),
  ADD KEY `busID` (`busID`),
  ADD KEY `compID` (`compID`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`passenger_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`posts_id`),
  ADD KEY `userID` (`userID`),
  ADD KEY `reviewID` (`reviewID`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `seats_of_ticket`
--
ALTER TABLE `seats_of_ticket`
  ADD PRIMARY KEY (`ticket_id`,`seat_no`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `travels_through`
--
ALTER TABLE `travels_through`
  ADD PRIMARY KEY (`route_id`,`bus_id`),
  ADD KEY `fk_bus_id` (`bus_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`votes_id`),
  ADD KEY `userID` (`userID`),
  ADD KEY `reviewID` (`reviewID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `about_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `bus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `bus_company`
--
ALTER TABLE `bus_company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `buys`
--
ALTER TABLE `buys`
  MODIFY `buys_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `comments_on`
--
ALTER TABLE `comments_on`
  MODIFY `comments_on_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `isbooked_for`
--
ALTER TABLE `isbooked_for`
  MODIFY `isbooked_for_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `isof`
--
ALTER TABLE `isof`
  MODIFY `isof_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `passenger`
--
ALTER TABLE `passenger`
  MODIFY `passenger_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `posts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `route`
--
ALTER TABLE `route`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `votes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `about`
--
ALTER TABLE `about`
  ADD CONSTRAINT `about_ibfk_1` FOREIGN KEY (`busID`) REFERENCES `bus` (`bus_id`),
  ADD CONSTRAINT `about_ibfk_2` FOREIGN KEY (`reviewID`) REFERENCES `review` (`review_id`);

--
-- Constraints for table `buys`
--
ALTER TABLE `buys`
  ADD CONSTRAINT `buys_ibfk_1` FOREIGN KEY (`passengerID`) REFERENCES `passenger` (`passenger_id`),
  ADD CONSTRAINT `buys_ibfk_2` FOREIGN KEY (`ticketID`) REFERENCES `ticket` (`ticket_id`);

--
-- Constraints for table `comments_on`
--
ALTER TABLE `comments_on`
  ADD CONSTRAINT `comments_on_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `comments_on_ibfk_2` FOREIGN KEY (`reviewID`) REFERENCES `review` (`review_id`);

--
-- Constraints for table `isbooked_for`
--
ALTER TABLE `isbooked_for`
  ADD CONSTRAINT `isbooked_for_ibfk_1` FOREIGN KEY (`busID`) REFERENCES `bus` (`bus_id`),
  ADD CONSTRAINT `isbooked_for_ibfk_2` FOREIGN KEY (`ticketID`) REFERENCES `ticket` (`ticket_id`);

--
-- Constraints for table `isof`
--
ALTER TABLE `isof`
  ADD CONSTRAINT `isof_ibfk_1` FOREIGN KEY (`busID`) REFERENCES `bus` (`bus_id`),
  ADD CONSTRAINT `isof_ibfk_2` FOREIGN KEY (`compID`) REFERENCES `bus_company` (`company_id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`reviewID`) REFERENCES `review` (`review_id`);

--
-- Constraints for table `seats_of_ticket`
--
ALTER TABLE `seats_of_ticket`
  ADD CONSTRAINT `fk_ticket_id` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`ticket_id`);

--
-- Constraints for table `travels_through`
--
ALTER TABLE `travels_through`
  ADD CONSTRAINT `fk_bus_id` FOREIGN KEY (`bus_id`) REFERENCES `bus` (`bus_id`),
  ADD CONSTRAINT `fk_route_id` FOREIGN KEY (`route_id`) REFERENCES `route` (`route_id`);

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`reviewID`) REFERENCES `review` (`review_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
