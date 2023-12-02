-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 02, 2023 at 04:16 AM
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
-- Database: `airport_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `Airlines`
--

CREATE TABLE `Airlines` (
  `AirlineCode` varchar(10) NOT NULL,
  `COMPANY` text DEFAULT NULL,
  `EMAIL` text DEFAULT NULL,
  `phoneNumber` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Airlines`
--

INSERT INTO `Airlines` (`AirlineCode`, `COMPANY`, `EMAIL`, `phoneNumber`) VALUES
('AA', 'American Airlines', 'American.Airlines@aa.com', '800-433-7300'),
('AF', 'Air France', 'contact@airfrance.fr', '800-237-2747'),
('DL', 'Delta Airlines', 'ticketreceipt@delta.com', '800-325-8224'),
('KL', 'KLM', 'mail@klm-info.com', '800-618-0104'),
('QR', 'Qatar Airways', 'support@qatarairways', '877-777-2827'),
('TA', 'Turkish Airlines Inc', 'support@turkishairlines.com', '800-874-8875');

-- --------------------------------------------------------

--
-- Table structure for table `Bookings`
--

CREATE TABLE `Bookings` (
  `BookingID` varchar(50) NOT NULL,
  `BookingDate` date NOT NULL,
  `CustomerID` int(100) DEFAULT NULL,
  `TicketID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Bookings`
--

INSERT INTO `Bookings` (`BookingID`, `BookingDate`, `CustomerID`, `TicketID`) VALUES
('0YTO8', '2023-12-01', 19, 3),
('2D9EN', '2023-12-01', 19, 3),
('2PE9D', '2023-12-01', 19, 3),
('35G61', '2023-11-29', 7, 19),
('7LDMJ', '2023-11-29', 26, 5),
('81RUG', '2023-11-29', 19, 3),
('9F46B', '2023-12-01', 19, 3),
('ABCDE', '2023-09-06', 20, 7),
('B9YUN', '2023-12-01', 19, 3),
('BMKS1', '2023-12-01', 19, 3),
('CGMT4', '2023-11-26', 7, 3),
('CXBG6', '2023-11-29', 20, 20),
('DTUIV', '2023-12-01', 19, 3),
('F9NVG', '2023-11-29', 20, 21),
('F9NVG', '2023-11-29', 20, 23),
('KQTNJ', '2023-11-29', 20, 21),
('KQTNJ', '2023-11-29', 20, 23),
('KTS8M', '2023-12-01', 25, 3),
('KZN85', '2023-11-29', 20, 5),
('KZN85', '2023-11-29', 20, 7),
('L3IST', '2023-11-26', 20, 3),
('MKPG7', '2023-11-29', 8, 3),
('N482Z', '2023-11-29', 20, 1),
('N482Z', '2023-11-29', 20, 3),
('RXYQ6', '2023-11-26', 19, 3),
('SVW1T', '2023-11-29', 20, 3),
('UAXLN', '2023-11-29', 19, 3),
('V0ABC', '2023-11-29', 20, 3),
('VIN3P', '2023-12-01', 30, 1),
('VIN3P', '2023-12-01', 30, 3),
('VOXEK', '2023-12-01', 19, 3),
('WZUB9', '2023-11-29', 19, 3),
('XROLK', '2023-11-27', 19, 3),
('YQ0M4', '2023-11-29', 19, 3);

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

CREATE TABLE `Customer` (
  `CustomerID` int(11) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phonenumber` varchar(10) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`CustomerID`, `firstname`, `lastname`, `email`, `phonenumber`, `password`) VALUES
(7, 'Sarah', 'Lewis', 'sl232@gmail.com', '3737432734', 'sarlew9023'),
(8, 'marc', 'jacobs', 'marjac@yahoo.com', '6789872635', 'jacmar!7328'),
(9, 'Katie\r\n', 'Nathan', 'katinathan@gmail.com', '6783874567', '1nathkatie23'),
(10, 'Brooke', 'Davis', 'bdavis@hotmail.com', '3467343893', 'bdavis22002'),
(15, 'nia', 'wills', 'nia123@gmail.com', '6783451234', 'test123'),
(19, 'Blake', 'Lively', 'bl@gmail.com', '6789567456', 'bLakeLi472'),
(20, 'Jim', 'Smith', 'jj@gmail.com', '9876784454', 'jimj13'),
(23, 'Test', 'Person', 'test1@gmail.com', '6789876785', 'testperson1'),
(24, 'Test8', 'Person', 'test2@gmail.com', '1234567890', 'testing'),
(25, 'sample', 'person', 'test@gmail.com', '1239283813', 'samplepass'),
(27, 'Sam', 'Smith', 's23@gmail.com', '1234567890', 'ssrockstar23'),
(28, 'Sammy', 'Lewis', 'sl@gmail.com', '6784563452', 'samlew'),
(29, 'jimmy', 'green', 'jgreen@yahoo.com', '6781234345', 'jgreen23'),
(30, 'Grant James', 'Park', 'gpark@gmail.com', '4702232132', 'grantp29'),
(31, 'Riley', 'Cam', 'rcam@gmail.com', '4702345566', 'rc23');

-- --------------------------------------------------------

--
-- Table structure for table `Tickets`
--

CREATE TABLE `Tickets` (
  `TicketID` int(20) NOT NULL,
  `DepartureCity` varchar(100) NOT NULL,
  `ArrivalCity` varchar(100) NOT NULL,
  `DepartureDate` date NOT NULL,
  `ArrivalDate` date NOT NULL,
  `DepartureTime` time NOT NULL,
  `ArrivalTime` time NOT NULL,
  `Price` decimal(6,2) NOT NULL,
  `AirlineCode` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Tickets`
--

INSERT INTO `Tickets` (`TicketID`, `DepartureCity`, `ArrivalCity`, `DepartureDate`, `ArrivalDate`, `DepartureTime`, `ArrivalTime`, `Price`, `AirlineCode`) VALUES
(1, 'Istanbul, Turkey', 'Hartsfield-Jackson Int, United States', '2025-01-02', '2025-01-03', '09:31:13', '10:31:13', 999.00, 'TA'),
(2, 'Sydney, Australia', 'Istanbul, Turkey', '2024-03-14', '2024-03-15', '02:00:00', '06:00:00', 1205.99, 'TA'),
(3, 'Hartsfield-Jackson Int, United States', 'Istanbul, Turkey', '2024-12-01', '2024-12-02', '10:00:00', '04:00:00', 1300.00, 'DL'),
(4, 'Buenos Aires, Argentina', 'Jeju International Airport, South Korea', '2024-02-20', '2024-02-21', '08:00:00', '07:00:00', 940.90, 'DL'),
(5, 'Hartsfield-Jackson Int, United States', 'Sydney, Australia', '2024-12-01', '2024-12-02', '12:00:00', '09:00:00', 1020.99, 'QR'),
(6, 'Buenos Aires, Argentina', 'Beijing Capital International, China', '2024-02-20', '2024-02-21', '10:00:00', '23:00:00', 960.78, 'QR'),
(7, 'Sydney, Australia', 'Hartsfield-Jackson Int, United States', '2024-12-25', '2024-12-25', '04:00:00', '23:00:00', 1050.99, 'KL'),
(8, 'Hartsfield-Jackson Int, United States', 'Buenos Aires, Argentina', '2023-11-01', '2023-11-02', '17:02:15', '11:02:15', 1300.00, 'AA'),
(19, 'John F Kennedy Intl, United States', 'Jeju International Airport, South Korea', '2023-11-02', '2023-11-03', '11:00:00', '04:00:00', 943.76, 'AA'),
(20, 'Jeju International Airport, South Korea', 'John F Kennedy Intl, United States', '2024-03-06', '2024-03-07', '10:00:00', '14:00:00', 1330.00, 'QR'),
(21, 'Incheon International Airport, South Korea', 'Paris, France', '2024-02-01', '2024-02-02', '11:00:00', '04:00:00', 1430.00, 'AF'),
(22, 'Hartsfield-Jackson Int, United States', 'LaGuardia Airport, New York', '2023-12-20', '2023-12-20', '10:50:00', '18:00:00', 1230.00, 'DL'),
(23, 'Paris, France', 'Incheon International Airport, South Korea', '2023-11-28', '2023-11-29', '09:30:00', '13:32:23', 1450.00, 'AF');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Airlines`
--
ALTER TABLE `Airlines`
  ADD PRIMARY KEY (`AirlineCode`),
  ADD UNIQUE KEY `AIRLINE CODE_UNIQUE` (`AirlineCode`);

--
-- Indexes for table `Bookings`
--
ALTER TABLE `Bookings`
  ADD PRIMARY KEY (`BookingID`,`TicketID`) USING BTREE;

--
-- Indexes for table `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`CustomerID`),
  ADD UNIQUE KEY `CUSTOMER ID_UNIQUE` (`CustomerID`);

--
-- Indexes for table `Tickets`
--
ALTER TABLE `Tickets`
  ADD PRIMARY KEY (`TicketID`),
  ADD UNIQUE KEY `TicketID_UNIQUE` (`TicketID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Customer`
--
ALTER TABLE `Customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `Tickets`
--
ALTER TABLE `Tickets`
  MODIFY `TicketID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
