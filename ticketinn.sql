-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 15, 2020 at 04:40 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticketinn`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_contact` int(11) NOT NULL,
  `user_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`user_id`, `user_name`, `user_email`, `user_pass`, `user_contact`, `user_image`) VALUES
(1, 'Dayut Upamencano', 'dayut@gmail.com', '1234', 72785388, 'avatar5.png'),
(2, 'George Kanangoya', 'kanangoya@gmail.com', '1234', 797801838, 'avatar04.png'),
(3, 'Wiliam Saliba', 'salibawillems@gmail.com', '48930', 78937494, 'avatar2.png'),
(5, 'Johnny Mundo', 'johnny@gmail.com', '0987', 726803012, 'avatar5.png');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `event_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `ip_add` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `cat_desc` varchar(100) NOT NULL,
  `cat_quantity` int(100) NOT NULL,
  `cat_booked_seats` int(11) DEFAULT 0,
  `cat_price` int(100) NOT NULL,
  `cat_booking_fee` int(11) NOT NULL,
  `cat_image` text NOT NULL,
  `cat_pov_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_desc`, `cat_quantity`, `cat_booked_seats`, `cat_price`, `cat_booking_fee`, `cat_image`, `cat_pov_image`) VALUES
(1, 'Category 2', 'Short side behind the goal tickets', 30, 22, 300, 70, 'seating_plan2.jpg', 'pov1.jpg'),
(2, 'Category 1', 'Long side upper tickets', 20, 10, 250, 70, 'seating_plan3.jpg', 'pov3.jpg'),
(4, 'CAT1 diamond', 'Longside first floor CENTRAL (Best view) Tickets', 30, 3, 500, 70, 'seating_plan4.jpg', 'pov_platinum.jpg'),
(5, 'Best Available', 'Any Available Tickets', 22, 5, 280, 70, 'seating_plan5.jpg', 'pov3.jpg'),
(6, 'Premium Gold', 'Central long side upper(between penalty boxes) tickets', 70, 4, 330, 70, 'seating_plan6.jpg', 'pov_platinum.jpg'),
(7, 'Premium Platinum', 'Short side(behind the goal) lower tickets', 25, 1, 290, 70, 'seating_plan7.jpg', 'pov2.jpg'),
(8, 'Terraces ', 'Top seats from every corner of the field', 25, 6, 150, 50, 'seating_plan3.jpg', 'pov2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cust_id` int(11) NOT NULL,
  `cust_email` varchar(100) NOT NULL,
  `cust_password` varchar(100) NOT NULL,
  `cust_f_name` varchar(100) NOT NULL,
  `cust_l_name` varchar(100) NOT NULL,
  `cust_phone` text NOT NULL,
  `cust_city` varchar(50) NOT NULL,
  `cust_street` varchar(50) NOT NULL,
  `cust_postal_code` text NOT NULL,
  `cust_ip` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cust_id`, `cust_email`, `cust_password`, `cust_f_name`, `cust_l_name`, `cust_phone`, `cust_city`, `cust_street`, `cust_postal_code`, `cust_ip`) VALUES
(15, 'helderpostiga1@gmail.com', '$2y$05$yQveOeZhlE3ZZNmB1iKq.eJ8KvdeJdktWm5bpyHLd7d1S9v6zjQtW', 'Helder', 'Postiga', '726543243', 'Valencia', 'Mestalla', '2753', '127.0.0.1'),
(16, 'JoshuaKimmich@gmail.com', '$2y$05$0LTH8P3BJwAE2shr5t6lku0H.66sObMqEfm/ujFelW3mxwjg4Rcm.', 'Joshua', 'Kimmich', '726736354', 'koln', 'mainz', '1213', '127.0.0.1'),
(20, 'curtisjohnes@gmail.com', '$2y$05$ge0yuUR8kl8RhePPeQ.rw.rpiEpw3XtXuzwVlmgwnq6ZvvIsyrSq.', 'Curtis', 'Johnes', '727826721', 'Nakuru', 'Kenyatta Avenue', '4061-20100', '{cust_ip}'),
(21, 'johnjules@gmail.com', '$2y$05$7nS8x4E8HIXL996Pbklu8.eoCTEJXpgOe/9SFST2qYXGYXDVgBXWi', 'John ', 'Jules', '792873645', 'Kasarani', 'mwiki', '1903', '{cust_ip}'),
(22, 'reiss@gmail.com', '$2y$05$zfa6elZh6bwJje.nIgjIOORBYOXoWFKEtzoNIy7GcsJTRadR3QSkC', 'Reiss', 'Nelson', '747833021', 'Quenns Park', 'QPR plaza', '6940', '{cust_ip}'),
(23, 'josephmwai97@gmail.com', '$2y$05$OtyE2S.hQlPxi2Q6TVgFGu2bS4mjMrrFlbRejDo.WetEv3YBGJQYK', 'Joseph', 'Mwai', '737654367', 'Lanet', 'free-area', '3648', '::1'),
(25, 'simpledaniel.1818@gmail.com', '$2y$05$ynYmUHSV41nW4t7RZ/NWKOSOEi8EqURzVukDUUIzQk.B9hpgFlg3.', 'Simple', 'Daniel', '797656756', 'Nyandas', 'thika road', '1267', '{cust_ip}'),
(26, 'joesoftmwai@gmail.com', '$2y$05$5x7BGZ/58xRbyeWq1yDae.CmoFyLjcU1RS26Y7605mNPoQBoFdpyq', 'Joesoft', 'Mwai', '797653937', 'Naks-vegas', 'J-ways', '2918', '{cust_ip}');

-- --------------------------------------------------------

--
-- Table structure for table `customer_reviews`
--

CREATE TABLE `customer_reviews` (
  `review_id` int(11) NOT NULL,
  `review_customer_id` int(11) NOT NULL,
  `customer_rating` int(11) NOT NULL,
  `customer_review` text NOT NULL,
  `review_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_reviews`
--

INSERT INTO `customer_reviews` (`review_id`, `review_customer_id`, `customer_rating`, `customer_review`, `review_date`) VALUES
(1, 25, 5, 'I wanted to say big thank you for your service. I and my Wife enjoyed the Gor vs Afc game last weekend. Thank you once again and look forward to order again.', 'Apr 11 2020'),
(2, 23, 5, 'I didn\'t imagine i could get my tickets some minutes before Kickoff but guess what, Yeah i did ', 'Apr 12 2020'),
(3, 15, 4, 'Good morning Just a quick thank you for all your communication and service.', 'Apr 13 2020'),
(4, 21, 3, 'Hello, Just wanted to say thank you for the tickets you supplied. The two seats were fantastic and we had a brilliant day, although our team lost . Many Thanks!', 'Apr 10 2020'),
(5, 22, 3, 'Hi ordered my tickets, category VIP but the place I was directed was a bit behind VIP, please consider serving client like us ', 'Apr 6 2020'),
(6, 25, 4, 'Hi Guys, great website, great tickets, great service you are offering . Thanks alot.', 'Apr 12 2020'),
(7, 26, 4, 'Got my e-ticket at the comfort of my house, saved me a lot of travelling, thanks', 'Apr 12 2020'),
(8, 26, 2, 'I wanted to cancel my tickets but it was but was unable', 'Apr 12 2020');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `event_url` text NOT NULL,
  `event_extras` varchar(100) NOT NULL,
  `event_venue` varchar(100) NOT NULL,
  `event_image` text NOT NULL,
  `event_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `event_url`, `event_extras`, `event_venue`, `event_image`, `event_date`) VALUES
(8, 'Gor Mahia Vs Afc Leopards', 'gor-mahia-vs-afc-leopards', 'Kenya Premier League', 'Kasarani Stadium', 'rsz_1event_pic10.jpg', '09/22/2019 15:00:00'),
(9, 'Mseto Campus Tour', 'mseto-campus-tour', 'raw talent search', 'Afraha Stadium', 'mseto_campus_tour.jpg', '09/21/2019 11:30:00'),
(10, 'Kenya harequins vs Mwamba', 'kenya-harequins-vs-mwamba', 'Kenya cup(Prinstloo 7\'s)', 'KasaraniStadium', 'rugby_try.jpg', '09/20/2019 10:00:00'),
(11, 'Chelsea vs Liverpool', 'chelsea-vs-liverpool', 'premier league', 'Stamford bridge', 'mount.jpg', '09/24/2019 18:30:00'),
(12, 'Ulinzi stars vs Tusker FC', 'ulinzi-stars-vs-tusker-fc', 'Kenya premier league', 'kasarani stadium', 'ulinzi.jpg', '12/25/2019 15:00:00'),
(16, 'Mathare united vs Posta rangers', 'mathare-united-vs-posta-rangers', 'Kenyan Premier League', 'Kasarani stadium', 'mathare_united_game.jpg', '01/13/2020 23:00:00'),
(20, 'Arsenal vs Chelsea', 'arsenal-vs-chelsea', 'English Primier League', 'Emirate Stadium', 'aubameyang.jpg', '04/11/2020 15:30:00'),
(21, 'Churchill Show Live Recording', 'churchill-show-live-recording', 'Nakuru Edition', 'Afraha stadium', 'churchill_nakuru.jpg', '04/17/2020 18:00:00'),
(22, 'Kenya Prisons vs Kenya pipeline', 'kenya-prisons-vs-kenya-pipeline', 'National league final', 'Kasarani indoors arena', 'volleybay_nationals_final.jpg', '04/19/2020 15:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(11) NOT NULL,
  `site_title` text NOT NULL,
  `site_desc` text NOT NULL,
  `site_author` text NOT NULL,
  `site_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_title`, `site_desc`, `site_author`, `site_url`) VALUES
(1, 'TicketInn -event tickets marketplace.', 'TicketInn is an automated stadium ticketing and management system.\r\n', 'Muturi Joseph', 'http://localhost/ticketinn');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_no` int(100) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `booked_seats` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `method` text NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_no`, `customer_id`, `category_id`, `event_id`, `booked_seats`, `amount`, `method`, `order_date`, `status`) VALUES
(277, 217135359, 23, 2, 22, 1, 320, 'stripe', '2020-04-15 05:04:44', 'complete'),
(278, 1561121419, 23, 2, 22, 1, 320, 'stripe', '2020-04-15 05:06:09', 'complete'),
(279, 2126654724, 23, 1, 21, 2, 670, 'stripe', '2020-04-15 05:33:08', 'complete'),
(280, 658288779, 23, 1, 21, 1, 370, 'stripe', '2020-04-15 05:37:07', 'complete'),
(281, 893947064, 23, 1, 21, 1, 370, 'stripe', '2020-04-15 05:57:23', 'complete'),
(282, 819878377, 23, 1, 21, 1, 370, 'stripe', '2020-04-15 06:05:09', 'complete'),
(283, 1841280079, 23, 1, 21, 1, 370, 'stripe', '2020-04-15 06:06:46', 'complete'),
(284, 1039515053, 23, 1, 12, 1, 370, 'paypal', '2020-04-15 09:45:59', 'complete'),
(285, 551748452, 23, 5, 10, 1, 350, 'stripe', '2020-04-15 14:32:06', 'complete');

-- --------------------------------------------------------

--
-- Table structure for table `payements`
--

CREATE TABLE `payements` (
  `payment_id` int(11) NOT NULL,
  `invoice` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_method` text NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payements`
--

INSERT INTO `payements` (`payment_id`, `invoice`, `customer_id`, `amount`, `payment_method`, `payment_date`) VALUES
(5, 8959995, 21, 344, 'mpesa', '2020-04-15 11:49:38'),
(7, 4366666, 15, 350, 'Stripe', '2020-04-15 11:49:38'),
(9, 551748452, 23, 350, 'stripe ', '2020-04-15 14:32:16');

-- --------------------------------------------------------

--
-- Table structure for table `payment_settings`
--

CREATE TABLE `payment_settings` (
  `id` int(11) NOT NULL,
  `processing_fee` int(11) NOT NULL,
  `enable_paypal` text NOT NULL,
  `paypal_email` text NOT NULL,
  `paypal_currency_code` text NOT NULL,
  `paypal_sandbox` text NOT NULL,
  `enable_stripe` text NOT NULL,
  `stripe_secret_key` text NOT NULL,
  `stripe_publishable_key` text NOT NULL,
  `stripe_currency_code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_settings`
--

INSERT INTO `payment_settings` (`id`, `processing_fee`, `enable_paypal`, `paypal_email`, `paypal_currency_code`, `paypal_sandbox`, `enable_stripe`, `stripe_secret_key`, `stripe_publishable_key`, `stripe_currency_code`) VALUES
(1, 1, 'yes', 'sb-41q9c975172@business.example.com', 'USD', 'on', 'yes', 'sk_test_zb42n6AD4yNYuCL9HRSxslsz00q1NEbzbz', 'pk_test_xSgoLMLDpMk2ioSoBgZKfmPe0074Zanlde', 'USD');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `slider_id` int(11) NOT NULL,
  `slider_name` text NOT NULL,
  `slider_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`slider_id`, `slider_name`, `slider_image`) VALUES
(1, 'Football Events', 'rsz_1event_pic10.jpg'),
(3, 'Athletics Events', 'rsz_atletic_images.jpg'),
(6, 'Rugby Events', 'rsz_injera-fiji.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `customer_reviews`
--
ALTER TABLE `customer_reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_FK` (`category_id`),
  ADD KEY `events_FK` (`event_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `payements`
--
ALTER TABLE `payements`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `payment_settings`
--
ALTER TABLE `payment_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `customer_reviews`
--
ALTER TABLE `customer_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;

--
-- AUTO_INCREMENT for table `payements`
--
ALTER TABLE `payements`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payment_settings`
--
ALTER TABLE `payment_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `category_FK` FOREIGN KEY (`category_id`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `events_FK` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
