-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 15, 2021 lúc 09:09 AM
-- Phiên bản máy phục vụ: 10.4.19-MariaDB
-- Phiên bản PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ep_aquarium`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ep_contact`
--

CREATE TABLE `ep_contact` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `img` varchar(200) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `ep_contact`
--

INSERT INTO `ep_contact` (`id`, `name`, `title`, `content`, `img`, `email`, `created`, `status`) VALUES
(1, 'Mr.doc', 'event The Aquarium', 'Very good service!', '', 'docc@gmail.com', '2021-06-14 17:45:09', 1),
(2, 'unknow', 'View', 'Spacious and airy view !', '', 'unknow@gmail.com', '2021-06-14 17:47:17', 1),
(7, 'chuchimbebong', 'Nice	', 'The ideal place to come', '/Aquarium/public/templates/upload/public/144-309-whale_9.jpg', 'ccbebong@gmail.com', '2021-06-14 17:58:29', 1),
(4, 'soinhochancuu', 'omg', 'gooooooooooood', '', 'soinhochancuu@gmail.com', '2021-06-14 17:50:34', 1),
(5, 'rengo is the best', 'rengo', 'nicee', '/Aquarium/public/templates/upload/public/984-053-dophin.jpg', 'rengo@gmail.com', '2021-06-14 17:54:13', 1),
(6, 'noname', 'Goood', 'gg', '/Aquarium/public/templates/upload/public/609-182-sharkk.jpg', 'noname@gmail.com', '2021-06-14 17:56:22', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ep_customer`
--

CREATE TABLE `ep_customer` (
  `id` int(11) NOT NULL,
  `customer_code` varchar(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `cus_name` varchar(150) NOT NULL,
  `gender` tinyint(1) NOT NULL COMMENT 'Nam 0, nữ 1',
  `datebirth` date NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `avatar` varchar(200) NOT NULL DEFAULT '/Aquarium/public/templates/upload/avatar/default-avatar.png',
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL,
  `token` mediumint(6) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `ep_customer`
--

INSERT INTO `ep_customer` (`id`, `customer_code`, `username`, `password`, `cus_name`, `gender`, `datebirth`, `phone`, `email`, `address`, `avatar`, `created`, `updated`, `token`, `status`) VALUES
(1, 'KH000001', 'customer1', '$2y$10$AF7xIRhhnriJEmWFoolJtOV2SHFD8q1eErZKrMuNLWXgBCIltzoFS', 'customer1', 0, '0000-00-00', '098456987', 'customer1@gmail.com', 'Ha Noi', '/Aquarium/public/templates/upload/avatar/default-avatar.png', '2021-06-14 16:58:57', '0000-00-00 00:00:00', 0, 1),
(2, 'KH000002', 'customer2', '$2y$10$onOExNBeBfBVSBdu8DfoOuByPAknwa.ZleqNWlR0BzjaCq5H.btn2', 'customer2', 1, '0000-00-00', '045678913', 'customer2@gmail.com', 'Hanoi', '/Aquarium/public/templates/upload/avatar/default-avatar.png', '2021-06-14 17:08:26', '0000-00-00 00:00:00', 0, 1),
(3, 'KH000003', 'customer3', '$2y$10$onOExNBeBfBVSBdu8DfoOuByPAknwa.ZleqNWlR0BzjaCq5H.btn2', 'customer3', 1, '0000-00-00', '0454562178', 'customer3@gmail.com', 'Hanoi', '/Aquarium/public/templates/upload/avatar/default-avatar.png', '2021-06-14 17:08:26', '0000-00-00 00:00:00', 0, 1),
(4, 'KH000004', 'customer4', '$2y$10$AF7xIRhhnriJEmWFoolJtOV2SHFD8q1eErZKrMuNLWXgBCIltzoFS', 'customer4', 0, '0000-00-00', '03245423487', 'customer4@gmail.com', 'Ha Tay', '/Aquarium/public/templates/upload/avatar/default-avatar.png', '2021-06-14 16:58:57', '0000-00-00 00:00:00', 0, 1),
(5, 'KH000005', 'customer5', '$2y$10$AF7xIRhhnriJEmWFoolJtOV2SHFD8q1eErZKrMuNLWXgBCIltzoFS', 'customer5', 1, '0000-00-00', '03245612487', 'customer5@gmail.com', 'Ha Noi', '/Aquarium/public/templates/upload/avatar/default-avatar.png', '2021-06-14 16:58:57', '0000-00-00 00:00:00', 0, 1),
(6, 'KH000006', 'customer6', '$2y$10$AF7xIRhhnriJEmWFoolJtOV2SHFD8q1eErZKrMuNLWXgBCIltzoFS', 'customer6', 1, '0000-00-00', '03245612487', 'customer6@gmail.com', 'Ha Dong', '/Aquarium/public/templates/upload/avatar/default-avatar.png', '2021-06-14 16:58:57', '0000-00-00 00:00:00', 0, 1),
(7, 'KH000007', 'customer7', '$2y$10$AF7xIRhhnriJEmWFoolJtOV2SHFD8q1eErZKrMuNLWXgBCIltzoFS', 'customer7', 1, '0000-00-00', '03245612487', 'customer7@gmail.com', 'Ha Nam', '/Aquarium/public/templates/upload/avatar/default-avatar.png', '2021-06-14 16:58:57', '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ep_event`
--

CREATE TABLE `ep_event` (
  `id` int(11) NOT NULL,
  `event_code` varchar(10) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `event_img` varchar(200) NOT NULL,
  `event_sub_img` varchar(200) NOT NULL,
  `event_intro` varchar(200) NOT NULL,
  `ticket_num` int(11) NOT NULL,
  `ticket_price` varchar(32) NOT NULL,
  `time_start` datetime NOT NULL,
  `time_end` datetime NOT NULL,
  `locations` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `ep_event`
--

INSERT INTO `ep_event` (`id`, `event_code`, `event_name`, `event_img`, `event_sub_img`, `event_intro`, `ticket_num`, `ticket_price`, `time_start`, `time_end`, `locations`, `created`, `status`) VALUES
(1, 'EV000001', 'OUT NIGHT', '/Aquarium/public/templates/upload/event/262-009-sharks-predators-of-the-deep-7-1440x454.jpg', '/Aquarium/public/templates/upload/event/913-336-out-night-2-250x175.jpg', 'ADULTS-ONLY EVENTS', 888, '99', '2021-06-01 07:00:00', '2021-06-30 23:00:00', 'Nesux Aquarium', '2021-05-27 22:07:31', 1),
(2, 'EV000002', 'Dragon Con Night', '/Aquarium/public/templates/upload/event/154-270-dragon-con-night-5-1440x454.jpg', '/Aquarium/public/templates/upload/event/453-098-dragon-con-night-7-250x175.jpg', 'It’s baaaccccck!', 666, '149', '2021-06-23 06:00:00', '2021-06-30 23:00:00', 'Aquarium Berlin', '2021-05-27 22:11:10', 1),
(3, 'EV000003', 'Sips – Y2K', '/Aquarium/public/templates/upload/event/715-921-2880x908-Masthead_R1-500x158@2x.jpg', '/Aquarium/public/templates/upload/event/662-249-680x680-Featured_R1-250x175.jpg', 'ADULTS-ONLY EVENTS', 100, '69', '2021-06-01 07:00:00', '2021-06-01 20:00:00', 'Georgia Aquarium', '2021-05-27 23:12:01', 1),
(4, 'EV000004', 'Corporate Group Outings', '/Aquarium/public/templates/upload/event/246-810-atlanta-ga-event-venues-414-1440x454.jpg', '/Aquarium/public/templates/upload/event/319-180-atlanta-ga-event-venues-414-250x175.jpg', 'GROUP OUTINGS AT GEORGIA AQUARIUM', 300, '89', '2021-06-08 07:00:00', '2021-06-14 20:00:00', 'Nexus Aquarium , Washington', '2021-05-27 23:15:02', 1),
(5, 'EV000005', 'Sleep Under the Sea', '/Aquarium/public/templates/upload/event/138-534-sleep-under-the-sea-17-e1573236125944-1440x454.jpg', '/Aquarium/public/templates/upload/event/513-958-sleep-ud-sea-250x175.jpg', 'EXPERIENCE', 99, '129', '2021-06-15 07:00:00', '2021-06-05 23:00:00', 'Georgia Aquarium', '2021-05-27 23:22:14', 1),
(6, 'EV000006', 'Pilates by the Water', '/Aquarium/public/templates/upload/event/849-374-pilates-by-the-water-1440x454.jpg', '/Aquarium/public/templates/upload/event/632-493-pilates-by-the-water-2-250x175.jpg', 'FAMILY EVENTS', 999, '49', '2021-06-10 07:00:00', '2021-09-30 20:00:00', 'New England Aquarium', '2021-05-27 23:36:14', 1),
(7, 'EV000007', '“The Aquarium”', '/Aquarium/public/templates/upload/event/246-810-atlanta-ga-event-venues-414-1440x454.jpg', '/Aquarium/public/templates/upload/event/967-419-visit-today-georgia-6-250x175.jpg', 'Season 2 – Episode 9', 666, '39', '2021-08-15 20:00:00', '2021-08-15 22:00:00', 'Georgia Aquarium', '2021-05-27 23:43:30', 1),
(8, 'EV000008', 'Mother’s Day', '/Aquarium/public/templates/upload/event/810-391-mothers-day-at-georgia-aquarium-1600x504.jpg', '/Aquarium/public/templates/upload/event/773-391-mothers-day-at-georgia-aquarium-2-250x175.jpg', 'A Mother&lsquo;s Day', 499, '66', '2021-06-15 07:00:00', '2021-06-29 20:00:00', 'Georgia Aquarium', '2021-06-14 18:16:31', 1),
(9, 'EV000009', 'Camp H2O – Week 1', '/Aquarium/public/templates/upload/event/344-807-camp-h2o-week-1-1600x504.jpg', '/Aquarium/public/templates/upload/event/937-807-camp-h2o-2-250x175.jpg', 'CAMPS', 777, '66', '2021-06-21 07:00:00', '2021-06-28 20:00:00', 'Georgia Aquarium', '2021-06-14 18:23:27', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ep_even_description`
--

CREATE TABLE `ep_even_description` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `des_name` varchar(150) NOT NULL,
  `des_content` text NOT NULL,
  `des_img` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `ep_even_description`
--

INSERT INTO `ep_even_description` (`id`, `event_id`, `des_name`, `des_content`, `des_img`) VALUES
(1, 1, 'OUT NIGHT - an LGBTQ Night at Georgia Aquarium', '<p>It&rsquo;s time!&nbsp; It&rsquo;s time to reconnect and reunite the LGBTQ+ Community.&nbsp; Join us for one of the first Atlanta Pride in person events in over a year!&nbsp; Guests will enjoy extended hours, exclusively for our 21+ guests! A quieter and safety-focused version of our popular evening cocktail experience; enjoy a one-of-a-kind, socially distanced night at the Aquarium. Experience exploring our galleries in a more intimate adult setting. Capacity is limited, face coverings are required, and the night is yours!</p>\n\n<p>OUT Night at Georgia Aquarium is exclusively for adults 21 and older. This modified version will include three cocktails (so no cash is exchanged), dining options for purchase, and unique ambient sounds by&nbsp;<strong>DJ Seth Breezy</strong>&nbsp;and&nbsp;<strong>DJ Ree De La Vega</strong>.&nbsp; Our limited capacity to allow for safe social distancing. Face coverings are required in our galleries but may be taken off to actively sip on cocktails or while eating food in our designated areas. You&rsquo;ll have access to the Aquarium in a way that makes it feel like you&rsquo;ve got the place to yourself!</p>\n', ''),
(2, 1, 'Ticket Option', '<p><strong>General Admission Ticket Includes:</strong></p>\n\n<ul>\n	<li>Admission from 7:00pm-10:00pm</li>\n	<li>Three (3) alcoholic/non-alcoholic drink tickets</li>\n	<li>Dining options available for purchase in Caf&eacute; Aquaria until 9:00pm</li>\n</ul>\n', '/Aquarium/public/templates/upload/event/562-122-out-night-2-250x250@2x.jpg'),
(4, 2, 'Dragon Con Night at Georgia Aquarium', '<p>It&rsquo;s baaaccccck!&nbsp; Channel your inner fantasy and join us for the return of Dragon Con Night at Georgia Aquarium.&nbsp; Here, you can experience exclusive after hours touring of the Aquarium galleries, with ambient music, Food and Drinks available for purchase in General Admission.&nbsp; To take your experience to the next level, consider the VIP experience which includes food and drinks located in a private ballroom with upgraded d&eacute;cor.&nbsp; In efforts to provide a mystical and magical experience, there will be reduced guest capacity for your touring pleasure of 11 million gallons of wondrous water.&nbsp; We can&rsquo;t wait to see your creativity in all things Dragon Con on this special night.</p>\n\n<p><strong>Update for 2021</strong>&nbsp;&ndash; For the safety of our guests, &nbsp;The Legend of the Chosen Costume Contest portion will be on pause for 2021 but will return with a fierce rebound in 2022.</p>\n\n<p><strong>Please Note:</strong><img alt=\"\" src=\"https://www.georgiaaquarium.org/wp-content/uploads/2019/03/dragon-con-night-7-340x340.jpg\" style=\"border-style:solid; border-width:3px; float:right; height:340px; width:340px\" /></p>\n\n<ul>\n	<li><strong>Temperature Checks Required for All Visitors</strong></li>\n	<li><strong>Face masks required</strong></li>\n	<li><strong>Limited Capacity for 2021</strong></li>\n	<li>Guests have the option to buy General Admission or VIP Admission.</li>\n	<li>Dragon Con badge lanyards are&nbsp;<strong>not accepted</strong>&nbsp;for admission.</li>\n	<li>Dragon Con has a clear no weapons policy that will be enforced.&nbsp;Click here for rules.</li>\n</ul>\n\n<p><strong>Important Information</strong></p>\n\n<ul>\n	<li>Food court opens from 7:00pm-9:00pm</li>\n	<li>Cash bars open from 7:00pm-10:00pm</li>\n	<li>There will be tight security scanning and bag checks for all guests</li>\n	<li>No gum - no lighters - no pocketknives</li>\n	<li>No changing room or bag storage available</li>\n	<li>Dragon Con has a clear no weapons policy that will be strictly enforced</li>\n</ul>\n', ''),
(5, 2, 'General Admission', '<ul>\n	<li>General Admission &ndash;&nbsp;<strong>$30</strong>&nbsp;through August 5, 2021</li>\n	<li>General Admission &ndash;&nbsp;&nbsp;<strong>$35</strong>&nbsp;after August 5, 2021</li>\n</ul>\n\n<h2>VIP Admission</h2>\n\n<ul>\n	<li>Includes admission to the event, upgraded private lounge, scenic views, 3 hour open bar, light bites and 2nd DJ</li>\n	<li>VIP Admission &ndash;&nbsp;<strong>$90</strong>&nbsp;through June 5, 2021</li>\n	<li>VIP Admission &ndash;&nbsp;<strong>$110</strong>&nbsp;after June 5, 2021</li>\n</ul>\n', '/Aquarium/public/templates/upload/event/157-585-dragon-con-night-6-250x250@2x.jpg'),
(6, 3, 'Like It’s 1999 Again… (but This Time with Masks!)', '<p>It&rsquo;s throwback night at Georgia Aquarium! Join us for extended hours, exclusively for our 21+ guests! A quieter and safety-focused version of our popular Sips Under the Sea experience; enjoy a one-of-a-kind, socially distanced night at the Aquarium. Experience exploring our galleries in a more intimate adult setting. Capacity is limited, face coverings are required, and the night is yours!</p>\n\n<p>Sips Under the Sea is exclusively for adults 21 and older. This modified version of Sips Under the Sea will still feature popular cocktails, dining options and a live DJ, but with limited capacity to allow for safe social distancing. Face coverings are required in our galleries but may be taken off to actively sip on cocktails or while eating food in our designated areas. You&rsquo;ll have access to the Aquarium in a way that makes it feel like you&rsquo;ve got the place to yourself!</p>\n', ''),
(7, 3, 'Ticket Options', '<p><strong>General Admission Ticket Includes:</strong></p>\n\n<ul>\n	<li>Admission from 7:00pm-10:00pm</li>\n	<li>Dining options available for purchase in Caf&eacute; Aquaria until 9:00pm</li>\n</ul>\n\n<p><strong>VIP Ticket Includes:</strong></p>\n\n<ul>\n	<li>Admission from 7:00pm-10:00pm</li>\n	<li>Three (3) alcoholic/non-alcoholic drink tickets</li>\n	<li>Dining options available for purchase in Caf&eacute; Aquaria until 9:00pm</li>\n</ul>\n', '/Aquarium/public/templates/upload/event/249-969-680x680-Featured_R1-210x210@2x.jpg'),
(8, 3, 'Please Note', '<ul>\n	<li>Guests must be 21 or older to enter the Aquarium for this event and will be required to show ID for entry, alcoholic drink consumption and/or ticket purchase.</li>\n	<li>Additional drink tickets and food will be available for purchase with credit at event. No cash!</li>\n	<li>Guests enter through Georgia Aquarium&rsquo;s main entrance.</li>\n	<li>Face coverings are required for this event and must be properly used except when actively sipping on your beverage or seated in designated face covering free areas.</li>\n	<li>Tickets available online or via the call center at 404-581-4000.</li>\n	<li>Tickets go off sale at noon on the event date or when sold out, whichever comes first.</li>\n	<li>Tickets will NOT be available for purchase at the door.</li>\n	<li>Last Pour for alcohol is at 9:45pm.</li>\n	<li>The event ends promptly at 10:00pm.</li>\n</ul>\n\n<p><em>Refunds are not available for any Sips Under the Sea event. A date may be changed free of charge if the change is made more than 10 days in advance of the original date of your visit. If the change is made less than 10 days prior to the original date of your visit, a $20 change fee per ticket will be charged. Late arrivals, cancellations and no shows will not be refunded or rescheduled. To change your reservation, please contact Georgia Aquarium Call Center at 404.581.4000.</em></p>\n', ''),
(9, 4, 'Book Your Next Gathering', '<p>Georgia Aquarium&rsquo;s Group Outings are available for hospitality services for intimate groups of 25+ guests.</p>\n\n<ul>\n	<li>$70 per guest* &ndash; minimum guest count of 25</li>\n	<li>$60 per guest* &ndash; minimum guest count of 50</li>\n	<li>$50 per guest* &ndash; minimum guest count of 100</li>\n</ul>\n\n<p>Includes:</p>\n\n<ul>\n	<li>Access to Aquarium exhibits</li>\n	<li>2 hour reception</li>\n	<li>Selection of one cuisine style</li>\n	<li>Non-alcoholic beverage service for 2 hours</li>\n	<li>High quality disposable serviceware (Food is individually packaged)</li>\n</ul>\n\n<p>Sales tax &amp; service charge additional</p>\n\n<p>Located in downtown Atlanta GA, Georgia Aquarium offers a number of unique special event venues with up to 23,000+ square feet of flexible space. To learn more about the different special event venues available, visit our venue space page&nbsp;<a href=\"https://www.georgiaaquarium.org/booking/venues/\">here.</a></p>\n', ''),
(10, 4, 'Menus', '<ul>\n	<li>\n	<p><strong>SOUTHERN</strong></p>\n\n	<p>Mixed Green Salad, Creamy Ranch, Baked Chicken, Greens, Mac &lsquo;n&rsquo; Cheese, Dinner Rolls, Cookies &amp; Brownies</p>\n	</li>\n	<li>\n	<p><strong>AMERICAN PICNIC</strong></p>\n\n	<p>Grilled Hamburgers &amp; Hot Dogs, Traditional Condiments &amp; Buns, Baked Potato Salad, Baked Beans, Cookies &amp; Brownies</p>\n	</li>\n	<li>\n	<p><strong>ITALIAN</strong></p>\n\n	<p>Penne Pasta with Bolognese, Tomato &amp; Cucumber Salad, Grilled Sausage &amp; Peppers, Dinner Rolls, Cookies &amp; Brownies</p>\n	</li>\n</ul>\n\n<p>&nbsp;</p>\n', ''),
(11, 4, 'Add a Bar Package!', '<ul>\n	<li>\n	<p><strong>BEER &amp; WINE (2 HOURS)</strong></p>\n\n	<p>$23.00, per person,<br />\n	plus tax<br />\n	bartender fee included</p>\n	</li>\n	<li>\n	<p><strong>CLASSIC BAR (2 HOURS)</strong></p>\n\n	<p>$27.00, per person,<br />\n	plus tax<br />\n	bartender fee included</p>\n	</li>\n</ul>\n\n<h2>Wolfgang Puck Catering</h2>\n\n<p>Wolfgang Puck Catering&nbsp;has been the proud partner and exclusive caterer for Georgia Aquarium since its opening in 2005.</p>\n', ''),
(12, 5, 'Forget Sleeping Under the Stars…', '<p><strong>And Sleep Under the Sea!</strong></p>\n\n<p>You&rsquo;ll be counting fish instead of sheep when you spend an unforgettable night at Georgia Aquarium! Come sea our amazing aquatic animals with a night filled of excitement and exploration. All of our memorable sleepovers include admission to the Aquarium at&nbsp;7:00pm the day of your sleepover, as well as the entire next day. Not to mention you will get access to all presentations, a bedtime snack, a complimentary breakfast, guided tours and activities as well as the best sleeping spot in front of one of our captivating gallery windows. Come dive into your sleeping bag for a slumber party to remember!</p>\n\n<p><strong>Minimum age requirement for sleepovers, unless otherwise specified (i.e. middle school, adult) is 7 years old.&nbsp;Any guests under 18 years of age must be accompanied by an adult of 21 years of age or older.&nbsp;Adult sleepovers have a minimum age of 21+.</strong></p>\n\n<p><strong>Covid-19 Guidelines:</strong>&nbsp;In 2021, our program has been modified with your safety in mind. Capacity has been limited and sleeping locations will be spread 6 feet apart for guests in separate households. Guests are encouraged to bring their own cot or air mattress (battery operated is best, as there are limited outlets). If you do not have one of these, a sanitized mat will be provided for you. Guests will be required to wear a facial covering throughout their sleepover except when eating or sleeping. Additional cleaning time is required and necessitates a wake-up call of 5:30am. If sleepovers do not reach a minimum of 20 guests, the program may be cancelled. If this happens you will be notified two weeks prior to your event.</p>\n', ''),
(13, 5, 'Upcoming Sleepover Dates', '<blockquote>\n<p>The following dates for the sleepover program are listed below and subject to change based on availability. We continue to evaluate future sleepover dates that might be impacted as a result of the pandemic and CDC guidelines.</p>\n</blockquote>\n\n<h3><strong>Group &amp; Family Sleepovers</strong></h3>\n\n<table>\n	<tbody>\n		<tr>\n			<td><strong>June 2021</strong></td>\n			<td>6/4, 6/5, 6/26</td>\n		</tr>\n		<tr>\n			<td><strong>July 2021</strong></td>\n			<td>7/2, 7/10, 7/16, 7/17, 7/30</td>\n		</tr>\n		<tr>\n			<td><strong>August 2021</strong></td>\n			<td>8/6, 8/7, 8/14, 8/28</td>\n		</tr>\n		<tr>\n			<td><strong>September 2021</strong></td>\n			<td>9/3, 9/10, 9/24, 9/25</td>\n		</tr>\n		<tr>\n			<td><strong>October 2021</strong></td>\n			<td>10/9, 10/16</td>\n		</tr>\n		<tr>\n			<td><strong>November 2021</strong></td>\n			<td>11/3, 11/6</td>\n		</tr>\n		<tr>\n			<td><strong>December 2021</strong></td>\n			<td>12/4, 12/10, 12/11</td>\n		</tr>\n	</tbody>\n</table>\n\n<h3><strong>Girl Scout Sleepovers</strong></h3>\n\n<table>\n	<tbody>\n		<tr>\n			<td><strong>May 2021</strong></td>\n			<td>5/8</td>\n		</tr>\n		<tr>\n			<td><strong>June 2021</strong></td>\n			<td>6/12</td>\n		</tr>\n		<tr>\n			<td><strong>July 2021</strong></td>\n			<td>7/24</td>\n		</tr>\n		<tr>\n			<td><strong>August 2021</strong></td>\n			<td>8/20</td>\n		</tr>\n		<tr>\n			<td><strong>September 2021</strong></td>\n			<td>9/17, 9/18</td>\n		</tr>\n		<tr>\n			<td><strong>October 2021</strong></td>\n			<td>10/2, 10/15</td>\n		</tr>\n		<tr>\n			<td><strong>November 2021</strong></td>\n			<td>11/12, 11/13</td>\n		</tr>\n	</tbody>\n</table>\n', '/Aquarium/public/templates/upload/event/144-858-sleep-under-the-sea-4-1060x705.jpg'),
(14, 6, 'A Pilates Class in the Most Unique Way', '<p>Break a sweat at the most unique and inspiring fitness studio Atlanta has to offer &ndash; Georgia Aquarium! Now offering Pilates!</p>\n\n<p>Pilates by the Water offers socially distant Pilates classes led by local instructors which are designed to challenge students of all experience levels. Sessions take place in our magnificent Oceans Ballroom, offering incredible views of manta rays and whale sharks while you challenge your mind and body. If your fitness goal is to become a happier and healthier version of yourself, this is the studio for you!</p>\n\n<p>Tickets are $25 and include a 60-minute class and complimentary parking in Georgia Aquarium&rsquo;s garage. Doors open at 6 pm; class begins at 6:30. All proceeds from Pilates by the Water benefit Georgia Aquarium&rsquo;s research and conservation initiatives.</p>\n', ''),
(15, 6, 'Event Info', '<ul>\n	<li>Please bring your own exercise mat, towel and water.</li>\n	<li>All participants must wear facial coverings to enter the Aquarium and must remain properly worn for the entirety of the visit, including the class.</li>\n	<li>All participants must consent to a contactless temperature scan before entering the Aquarium.</li>\n	<li>Participants will be spaced at least six feet apart to maintain appropriate social distancing.</li>\n	<li>Intended for guests ages 8 and up.</li>\n	<li>Doors open at 6:00pm.&nbsp; Class begins promptly at 6:30pm</li>\n	<li>Complimentary parking is available in our attached covered garage.&nbsp; Please bring your parking ticket with you to receive your validation sticker.</li>\n	<li>Advance registration required. Tickets will not be sold at the door. Space is very limited, so please book early as we expect to reach capacity prior to each class.</li>\n	<li>This ticket does not include Aquarium Admission.</li>\n	<li>Refunds will not be issued for cancellations, no shows or late arrivals.</li>\n	<li>Access to class via Oceans Ballroom Entrance on the first floor of Georgia Aquarium&rsquo;s parking garage ONLY.</li>\n</ul>\n', '/Aquarium/public/templates/upload/event/271-441-pilates-by-the-water-3-500x333.jpg'),
(16, 7, 'Back for Season 2 on Animal Planet...&quot;The Aquarium&quot;', '<p>The groundbreaking series, The Aquarium, which documents life behind-the-scenes at Georgia Aquarium and the vital role it plays in aquatic conservation around the world, returns to Animal Planet for a second season, beginning Sunday, Feb. 9 at 8pm ET/PT.</p>\n\n<p><strong>THE AQUARIUM</strong>&nbsp;series introduces and shares the stories of the amazing animals who call the 10 million gallons of water at Georgia Aquarium home, including a moray eel, green sea turtle, fantail rays, rescued sea otters and more!</p>\n\n<p><strong>THE AQUARIUM</strong>&nbsp;also documents Georgia Aquarium&rsquo;s ongoing efforts to protect aquatic species in the wild, traveling to their own backyard and beyond to help animals in need. This season, the adventures continue off the coast of Florida, as camera crews follow Georgia Aquarium biologists under the nighttime waves, to film a rare and wondrous event few have ever witnessed: the spawning of critically endangered corals.</p>\n\n<p><strong>THE AQUARIUM</strong>&nbsp;is produced for Animal Planet by Left/Right, a Red Arrow Studios company, and Copper Pot Pictures. Banks Tarver, Ken Druckerman,&nbsp;Anneka Jones and Michael LaHaie are the executive producers; Jessie Findlay is co-executive producer for Left/Right. David LaMattina and Chad Walker are the executive producers for Copper Pot Pictures. Lisa Lucas is the executive producer, Patrick Keegan is supervising producer and Meredith Russell is coordinating producer for Animal Planet.</p>\n', ''),
(17, 7, 'About the Show&lsquo;s Creators', '<h2>&nbsp;</h2>\n\n<h3>About Georgia Aquarium</h3>\n\n<p>Georgia Aquarium is a leading 501(c)(3) non-profit organization located in Atlanta, Ga. that is Humane Certified by American Humane and accredited by the Alliance of Marine Mammal Parks and Aquariums and the Association of Zoos and Aquariums. Georgia Aquarium is committed to working on behalf of all marine life through education, preservation, exceptional&nbsp;animal care, and research across the globe. Georgia Aquarium continues its mission each day to inspire, educate, and entertain its millions of guests about the aquatic biodiversity throughout the world through its hundreds of exhibits and tens of thousands of animals across its seven major galleries.&nbsp;</p>\n\n<h3>About Animal Planet</h3>\n\n<p>Animal Planet, one of Discovery, Inc.&rsquo;s great global brands, is dedicated to creating high quality content with&nbsp;global appeal delivering on its mission to keep the childhood joy and wonder of animals alive by bringing people up close in every way. Available to&nbsp;360 million homes in more than 205 countries and territories, Animal Planet combines content that explores the undeniable bonds forged between animals and humans, optimized&nbsp;across all screens around the world. In the U.S.,&nbsp;Animal Planet audiences can enjoy their favorite programming anytime, anywhere through the Animal Planet Go app which features live and on-demand access.&nbsp;</p>\n\n<h3>About Discovery</h3>\n\n<p>Discovery, Inc. (Nasdaq: DISCA, DISCB, DISCK) is a global leader in real life entertainment, serving a passionate audience of superfans around the world with content that inspires, informs and entertains. Discovery delivers over 8,000 hours of original programming each year and has category leadership across deeply loved content genres around the world. Available in 220 countries and territories and nearly 50 languages, Discovery is a platform innovator, reaching viewers on all screens, including TV Everywhere products such as the GO portfolio of apps; direct-to-consumer streaming services such as Eurosport Player and MotorTrend OnDemand; digital-first and social content from Group Nine Media;&nbsp;a landmark natural history and factual content partnership with the BBC; and a strategic alliance with PGA TOUR to create the international home of golf. Discovery&rsquo;s portfolio of premium brands includes Discovery Channel, HGTV, Food Network, TLC, Investigation Discovery, Travel Channel, MotorTrend, Animal Planet, and Science Channel, as well as OWN: Oprah Winfrey Network in the U.S., Discovery Kids in Latin America, and Eurosport, the leading provider of locally relevant, premium sports and Home of the Olympic Games across Europe.</p>\n\n<h3>About Left/Right</h3>\n\n<p>Over the last dozen years, LEFT/RIGHT has produced hundreds of hours of television in an extraordinarily eclectic mix of genres, ranging from hard-hitting documentaries to side-splitting comedies, covering topics from sex to secret societies to stand-up comedy to science fiction to school segregation. Past and present productions include our Emmy Award-winning television adaptation of the popular public radio show &ldquo;This American Life&rdquo; (Showtime)&hellip; to multiple episodes of the award-winning investigative series &ldquo;FRONTLINE&rdquo; (PBS)&hellip; to &ldquo;The Circus&rdquo; (Showtime), a fast-turnaround documentary series that pulls back the curtain on American politics&hellip; to &ldquo;James Cameron&rsquo;s Story of Science Fiction&rdquo; (AMC), which examines and celebrates the most dominant genre in the world today&hellip; to our upcoming New York Times series &ldquo;The Weekly&rdquo; for FX and Hulu. Our shows have been nominated for over 15 Emmy&reg; Awards and have won multiple awards, including an Emmy&reg; for Best Nonfiction Series. Left/Right is part of Red Arrow Studios, an international production and distribution company, and is represented by WME Entertainment.&nbsp;</p>\n', ''),
(18, 8, 'A Mother&lsquo;s Day to Relax', '<p>On Mother&rsquo;s Day, Mom should relax, put up her feet and not worry about a thing all day!</p>\n\n<p>While that may never happen, Georgia Aquarium wants to treat you and your mom to a special&nbsp;<strong>2 for $60*&nbsp;</strong>discounted admission on Sunday, May 12, 2019.</p>\n\n<p>Tickets must be purchased online in advance and applies to any age group.&nbsp; Additional tickets may also be purchased at our discounted online, advanced ticket rate.</p>\n\n<p>*Cannot be combined with other discounts or offers. Offer redeemable for visits on May 12, 2019 only.</p>\n\n<p><strong>Discount will be applied in shopping cart. Limit one offer per transaction.</strong></p>\n', ''),
(19, 8, 'Please Note:', '<h3>&nbsp;</h3>\n\n<ul>\n	<li>The promotion is buy two (2) General Admission tickets for $60.</li>\n	<li>2 for $60 tickets apply to any age visitor.</li>\n	<li>This offer may ONLY be purchased ONLINE.</li>\n	<li>Additional tickets may be purchased online or at the ticketing window.</li>\n	<li>Unfortunately, there are no rain checks for this offer for guests that are not able to visit on this date.</li>\n	<li>This offer cannot be combined with the Birthday Offer ticket or any other discounts or offers.</li>\n	<li>Refunds will not be issued for tickets previously purchase at the standard rate.</li>\n</ul>\n', '/Aquarium/public/templates/upload/event/283-479-mothers-day-at-georgia-aquarium-2-385x385.jpg'),
(20, 9, 'Camp H2O - June 21th-28th', '<p>Campers will spend the week engaged in fun and exciting activities! They will discover interesting facts about our aquatic friends and their habitats, as well as explore the wondrous ocean ecosystem. All Aquarium galleries and presentations are included.</p>\n', ''),
(21, 9, 'Seaside Sleuths', '<p style=\'color: blue;\'><strong>Ages:&nbsp;5 &ndash; 7 years old</strong></p>\n\n<p>Campers will explore Georgia Aquarium and learn about the ocean&rsquo;s mysteries. They will dive into fact versus fiction with crafts, games, animals, hands-on activities, meet and greets with animal experts and lots of fun. Many secrets dwell deep in the ocean, so it&rsquo;s time for campers to dive in and discover the truth of the ocean for themselves!</p>\n', ''),
(22, 9, 'Georgia Explorers', '<p style=\'color: blue;\'><strong>Ages:&nbsp;8 &ndash; 10 years old</strong></p>\n\n<p>Set out on a journey to discover the amazing flora and fauna that call Georgia home. Team up in inquiry-based activities to explore all things Georgia, from the Blue Ridge Mountains to the Atlantic Ocean. Navigate through the way&rsquo;s exploration fits into scientific research and learn how to become a conservationist in your own backyard. By the end of the week, you will have explored the rarely navigated areas of the Aquarium and mastered skills to preserve and protect the world around you.</p>\n', ''),
(23, 9, 'Conservation Champions', '<p style=\'color: blue;\'><strong>Ages: 11 &ndash; 13 years old</strong></p>\n\n<p>We need your help!&nbsp;<em>Do you have what it takes to be a conservation champion?</em>&nbsp;Join the next generation of environmental heroes for a week of conservation activities and training here at Georgia Aquarium. Learn about coral restoration, sustainable seafood, animal conservation research, and so much more!&nbsp; With a mixture of collaborative projects, animal interactions, and hands-on experiments, this is sure to be an experience your camper will remember forever. After the week is over, your camper will be inspired to make changes in their daily life and educate others about the importance of environmental stewardship.</p>\n', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ep_feedback`
--

CREATE TABLE `ep_feedback` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `ep_feedback`
--

INSERT INTO `ep_feedback` (`id`, `event_id`, `customer_id`, `comment`, `created`, `status`) VALUES
(1, 1, 1, 'wow', '2021-06-14 17:07:47', 1),
(2, 1, 1, '&lt;3 good', '2021-06-14 17:07:54', 1),
(3, 2, 5, 'I really like it!', '2021-06-14 17:28:10', 1),
(4, 3, 5, 'wow', '2021-06-14 17:28:31', 1),
(5, 6, 5, 'so beautiful..!', '2021-06-14 17:28:57', 1),
(6, 7, 6, 'that so beautiful...', '2021-06-14 17:38:54', 1),
(7, 7, 6, 'I very like it!!', '2021-06-14 17:39:07', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ep_order`
--

CREATE TABLE `ep_order` (
  `id` int(11) NOT NULL,
  `order_code` varchar(10) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_method_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `order_update` datetime DEFAULT NULL,
  `note` varchar(255) NOT NULL,
  `check_view` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 isn''t view , 1 is view',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '-1 là admin hủy, 0 cus là hủy, 1 là chưa sử lí, \r\n2 là đang sử lý, 3 là hoàn thành'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `ep_order`
--

INSERT INTO `ep_order` (`id`, `order_code`, `customer_id`, `order_method_id`, `order_date`, `order_update`, `note`, `check_view`, `status`) VALUES
(1, 'OD000001', 1, 1, '2021-06-14 16:59:32', '2021-06-14 15:20:33', '', 1, 2),
(2, 'OD000002', 1, 2, '2021-06-14 17:07:11', NULL, '', 1, 3),
(3, 'OD000003', 2, 2, '2021-06-14 17:13:50', NULL, '', 1, 3),
(4, 'OD000004', 2, 1, '2021-06-14 17:17:47', '2021-06-14 15:20:08', '', 1, -1),
(5, 'OD000005', 3, 2, '2021-06-14 17:21:01', NULL, '', 1, 3),
(6, 'OD000006', 5, 1, '2021-06-14 17:22:47', NULL, '', 0, 1),
(7, 'OD000007', 5, 2, '2021-06-14 17:23:01', NULL, '', 1, 0),
(8, 'OD000008', 5, 1, '2021-06-14 17:23:20', NULL, '', 1, 3),
(9, 'OD000009', 5, 1, '2021-06-14 17:23:36', NULL, '', 1, 3),
(10, 'OD000010', 5, 2, '2021-06-14 17:23:59', NULL, '', 1, 1),
(11, 'OD000011', 5, 1, '2021-06-14 17:24:20', '2021-06-14 15:20:42', '', 1, 2),
(12, 'OD000012', 6, 1, '2021-06-14 17:59:42', NULL, '', 0, 1),
(13, 'OD000013', 6, 2, '2021-06-14 17:59:52', NULL, '', 1, 3),
(14, 'OD000014', 6, 1, '2021-06-14 18:00:10', '2021-06-14 15:20:48', '', 1, 2),
(15, 'OD000015', 6, 2, '2021-06-14 18:00:29', NULL, '', 1, 1),
(16, 'OD000016', 6, 1, '2021-06-14 18:00:55', NULL, '', 0, 0),
(17, 'OD000017', 2, 1, '2021-06-14 18:02:35', NULL, '', 0, 1),
(18, 'OD000018', 2, 1, '2021-06-14 18:02:46', NULL, '', 0, 1),
(19, 'OD000019', 2, 2, '2021-06-14 18:03:10', NULL, '', 0, 1),
(20, 'OD000020', 2, 2, '2021-06-14 18:03:23', NULL, '', 0, 1),
(21, 'OD000021', 1, 1, '2021-06-14 18:03:41', NULL, '', 0, 1),
(22, 'OD000022', 1, 1, '2021-06-14 18:03:52', NULL, '', 1, 3),
(23, 'OD000023', 1, 2, '2021-06-14 18:04:08', NULL, '', 0, 1),
(24, 'OD000024', 1, 1, '2021-06-14 18:04:21', NULL, '', 0, 1),
(25, 'OD000025', 4, 1, '2021-06-14 18:04:52', NULL, '', 0, 1),
(26, 'OD000026', 4, 1, '2021-06-14 18:05:16', NULL, '', 0, 1),
(27, 'OD000027', 5, 2, '2021-06-14 18:06:06', NULL, '', 0, 1),
(28, 'OD000028', 5, 2, '2021-06-14 18:06:18', NULL, '', 0, 1),
(29, 'OD000029', 5, 1, '2021-06-14 18:06:32', NULL, '', 0, 1),
(30, 'OD000030', 3, 1, '2021-06-14 18:06:55', NULL, '', 0, 1),
(31, 'OD000031', 3, 1, '2021-06-14 18:07:13', NULL, '', 0, 1),
(32, 'OD000032', 3, 2, '2021-06-14 18:07:37', NULL, '', 0, 1),
(33, 'OD000033', 2, 1, '2021-06-14 18:32:45', NULL, '', 0, 1),
(34, 'OD000034', 2, 1, '2021-06-14 18:33:07', NULL, '', 0, 1),
(35, 'OD000035', 2, 2, '2021-06-14 18:33:20', NULL, '', 0, 1),
(36, 'OD000036', 1, 1, '2021-06-14 18:33:38', NULL, '', 0, 1),
(37, 'OD000037', 1, 1, '2021-06-14 18:33:51', NULL, '', 0, 1),
(38, 'OD000038', 1, 2, '2021-06-14 18:34:11', NULL, '', 0, 1),
(39, 'OD000039', 6, 1, '2021-06-14 18:34:31', NULL, '', 0, 1),
(40, 'OD000040', 6, 1, '2021-06-14 18:34:50', NULL, '', 0, 1),
(41, 'OD000041', 6, 2, '2021-06-14 18:35:05', NULL, '', 0, 1),
(42, 'OD000042', 7, 2, '2021-06-14 18:35:25', NULL, '', 1, 3),
(43, 'OD000043', 7, 1, '2021-06-14 18:35:45', NULL, '', 0, 1),
(44, 'OD000044', 7, 1, '2021-06-14 18:35:57', NULL, '', 0, 1),
(45, 'OD000045', 5, 2, '2021-06-14 18:36:13', NULL, '', 0, 1),
(46, 'OD000046', 5, 2, '2021-06-14 18:36:26', NULL, '', 0, 1),
(47, 'OD000047', 5, 2, '2021-06-14 18:36:40', NULL, '', 1, 3),
(48, 'OD000048', 5, 1, '2021-06-14 18:37:31', NULL, '', 0, 1),
(49, 'OD000049', 4, 1, '2021-06-14 18:37:55', NULL, '', 0, 1),
(50, 'OD000050', 4, 2, '2021-06-14 18:38:13', NULL, '', 0, 1),
(51, 'OD000051', 4, 1, '2021-06-14 18:38:30', NULL, '', 0, 1),
(52, 'OD000052', 2, 1, '2021-06-14 18:38:52', NULL, '', 0, 1),
(53, 'OD000053', 2, 2, '2021-06-14 18:39:05', NULL, '', 0, 1),
(54, 'OD000054', 2, 1, '2021-06-14 18:39:16', NULL, '', 0, 1),
(55, 'OD000055', 6, 1, '2021-06-14 18:39:33', NULL, '', 0, 1),
(56, 'OD000056', 6, 2, '2021-06-14 18:39:43', NULL, '', 0, 1),
(57, 'OD000057', 6, 1, '2021-06-14 18:40:00', NULL, '', 0, 1),
(58, 'OD000058', 6, 2, '2021-06-14 18:40:31', NULL, '', 0, 1),
(59, 'OD000059', 1, 2, '2021-06-14 18:40:49', NULL, '', 0, 1),
(60, 'OD000060', 1, 1, '2021-06-14 18:41:00', NULL, '', 0, 1),
(61, 'OD000061', 1, 1, '2021-06-14 18:41:23', NULL, '', 0, 1),
(62, 'OD000062', 1, 1, '2021-06-14 18:41:36', NULL, '', 1, 3),
(63, 'OD000063', 1, 1, '2021-06-14 18:41:49', NULL, '', 0, 1),
(64, 'OD000064', 7, 2, '2021-06-14 18:42:09', NULL, '', 0, 1),
(65, 'OD000065', 7, 1, '2021-06-14 18:42:26', NULL, '', 0, 1),
(66, 'OD000066', 7, 2, '2021-06-14 18:42:37', NULL, '', 0, 1),
(67, 'OD000067', 2, 1, '2021-06-14 20:02:59', NULL, '', 0, 1),
(68, 'OD000068', 2, 1, '2021-06-14 20:03:22', NULL, '', 0, 1),
(69, 'OD000069', 2, 1, '2021-06-14 20:03:38', NULL, '', 0, 1),
(70, 'OD000070', 2, 2, '2021-06-14 20:03:52', NULL, '', 0, 1),
(71, 'OD000071', 6, 1, '2021-06-14 20:04:13', NULL, '', 0, 1),
(72, 'OD000072', 6, 1, '2021-06-14 20:04:28', NULL, '', 0, 1),
(73, 'OD000073', 6, 2, '2021-06-14 20:04:41', NULL, '', 0, 1),
(74, 'OD000074', 6, 2, '2021-06-14 20:04:59', NULL, '', 0, 1),
(75, 'OD000075', 6, 1, '2021-06-14 20:06:04', NULL, '', 0, 1),
(76, 'OD000076', 1, 2, '2021-06-14 20:06:20', NULL, '', 0, 1),
(77, 'OD000077', 1, 1, '2021-06-14 20:06:33', NULL, '', 0, 1),
(78, 'OD000078', 1, 2, '2021-06-14 20:06:45', NULL, '', 0, 1),
(79, 'OD000079', 5, 1, '2021-06-14 20:07:07', NULL, '', 0, 1),
(80, 'OD000080', 5, 1, '2021-06-14 20:07:19', NULL, '', 0, 1),
(81, 'OD000081', 5, 1, '2021-06-14 20:07:29', NULL, '', 0, 1),
(82, 'OD000082', 5, 1, '2021-06-14 20:07:42', NULL, '', 0, 1),
(83, 'OD000083', 4, 2, '2021-06-14 20:08:00', NULL, '', 0, 1),
(84, 'OD000084', 4, 1, '2021-06-14 20:08:10', NULL, '', 0, 1),
(85, 'OD000085', 4, 1, '2021-06-14 20:08:21', NULL, '', 0, 1),
(86, 'OD000086', 4, 1, '2021-06-14 20:08:40', NULL, '', 0, 1),
(87, 'OD000087', 7, 1, '2021-06-14 20:09:02', NULL, '', 0, 1),
(88, 'OD000088', 7, 2, '2021-06-14 20:09:23', NULL, '', 0, 1),
(89, 'OD000089', 7, 2, '2021-06-14 20:09:38', NULL, '', 0, 1),
(90, 'OD000090', 7, 1, '2021-06-14 20:10:04', NULL, '', 0, 1),
(91, 'OD000091', 3, 2, '2021-06-14 20:10:39', NULL, '', 0, 1),
(92, 'OD000092', 3, 1, '2021-06-14 20:10:50', NULL, '', 0, 1),
(93, 'OD000093', 3, 1, '2021-06-14 20:11:01', NULL, '', 0, 1),
(94, 'OD000094', 3, 1, '2021-06-14 20:11:16', NULL, '', 0, 1),
(95, 'OD000095', 3, 1, '2021-06-14 20:11:30', NULL, '', 0, 1),
(96, 'OD000096', 3, 2, '2021-06-14 20:11:44', NULL, '', 0, 1),
(97, 'OD000097', 6, 1, '2021-06-14 20:12:04', NULL, '', 0, 1),
(98, 'OD000098', 6, 2, '2021-06-14 20:12:17', NULL, '', 0, 1),
(99, 'OD000099', 6, 2, '2021-06-14 20:12:32', NULL, '', 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ep_order_detail`
--

CREATE TABLE `ep_order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `even_id` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 là general, 1 là VIP',
  `number` int(11) NOT NULL,
  `price` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `ep_order_detail`
--

INSERT INTO `ep_order_detail` (`id`, `order_id`, `even_id`, `type`, `number`, `price`) VALUES
(1, 1, 1, 0, 3, '99'),
(2, 1, 1, 1, 3, '119'),
(3, 2, 2, 0, 3, '149'),
(4, 2, 2, 1, 1, '169'),
(5, 2, 3, 0, 1, '69'),
(6, 2, 3, 1, 10, '89'),
(7, 2, 4, 1, 5, '109'),
(8, 2, 4, 0, 1, '89'),
(9, 3, 7, 1, 3, '59'),
(10, 3, 6, 0, 3, '49'),
(11, 4, 2, 1, 2, '169'),
(12, 5, 4, 0, 6, '89'),
(13, 6, 1, 0, 1, '99'),
(14, 6, 1, 1, 4, '119'),
(15, 7, 3, 0, 3, '69'),
(16, 8, 6, 1, 6, '69'),
(17, 9, 2, 1, 6, '169'),
(18, 10, 5, 1, 1, '149'),
(19, 10, 7, 0, 2, '39'),
(20, 10, 7, 1, 2, '59'),
(21, 11, 4, 0, 1, '89'),
(22, 11, 4, 1, 2, '109'),
(23, 11, 1, 0, 1, '99'),
(24, 11, 1, 1, 2, '119'),
(25, 12, 1, 1, 1, '119'),
(26, 13, 3, 0, 1, '69'),
(27, 14, 3, 0, 1, '69'),
(28, 14, 3, 1, 1, '89'),
(29, 14, 1, 0, 1, '99'),
(30, 14, 1, 1, 1, '119'),
(31, 15, 7, 0, 1, '39'),
(32, 15, 7, 1, 2, '59'),
(33, 16, 6, 0, 1, '49'),
(34, 16, 6, 1, 1, '69'),
(35, 16, 3, 0, 2, '69'),
(36, 16, 3, 1, 3, '89'),
(37, 17, 1, 1, 1, '119'),
(38, 18, 3, 0, 1, '69'),
(39, 18, 3, 1, 1, '89'),
(40, 19, 4, 1, 1, '109'),
(41, 19, 6, 0, 1, '49'),
(42, 19, 6, 1, 1, '69'),
(43, 20, 5, 0, 1, '129'),
(44, 21, 2, 1, 1, '169'),
(45, 22, 4, 0, 3, '89'),
(46, 23, 6, 1, 2, '69'),
(47, 24, 1, 0, 5, '99'),
(48, 25, 1, 0, 2, '99'),
(49, 25, 2, 1, 1, '169'),
(50, 26, 4, 1, 1, '109'),
(51, 26, 2, 0, 1, '149'),
(52, 27, 2, 1, 2, '169'),
(53, 28, 4, 1, 2, '109'),
(54, 29, 7, 0, 1, '39'),
(55, 29, 7, 1, 1, '59'),
(56, 30, 1, 0, 1, '99'),
(57, 30, 1, 1, 3, '119'),
(58, 31, 2, 0, 1, '149'),
(59, 31, 2, 1, 1, '169'),
(60, 31, 7, 0, 2, '39'),
(61, 32, 7, 1, 3, '59'),
(62, 32, 5, 0, 3, '129'),
(63, 32, 5, 1, 1, '149'),
(64, 33, 6, 1, 1, '69'),
(65, 33, 9, 0, 1, '66'),
(66, 33, 9, 1, 1, '86'),
(67, 34, 7, 1, 1, '59'),
(68, 34, 8, 0, 2, '66'),
(69, 35, 3, 0, 1, '69'),
(70, 36, 2, 1, 2, '169'),
(71, 37, 4, 0, 1, '89'),
(72, 37, 4, 1, 1, '109'),
(73, 38, 9, 1, 2, '86'),
(74, 39, 4, 0, 1, '89'),
(75, 39, 4, 1, 1, '109'),
(76, 40, 9, 0, 1, '66'),
(77, 40, 9, 1, 1, '86'),
(78, 40, 5, 1, 1, '149'),
(79, 41, 7, 0, 3, '39'),
(80, 41, 7, 1, 1, '59'),
(81, 42, 4, 0, 1, '89'),
(82, 42, 4, 1, 2, '109'),
(83, 42, 8, 1, 1, '86'),
(84, 43, 2, 1, 1, '169'),
(85, 43, 1, 0, 1, '99'),
(86, 43, 1, 1, 1, '119'),
(87, 44, 3, 0, 3, '69'),
(88, 44, 3, 1, 3, '89'),
(89, 45, 7, 1, 1, '59'),
(90, 46, 7, 0, 2, '39'),
(91, 46, 9, 0, 2, '66'),
(92, 46, 9, 1, 1, '86'),
(93, 47, 4, 0, 1, '89'),
(94, 47, 4, 1, 1, '109'),
(95, 48, 6, 0, 1, '49'),
(96, 48, 6, 1, 1, '69'),
(97, 49, 7, 0, 1, '39'),
(98, 49, 7, 1, 1, '59'),
(99, 49, 2, 1, 1, '169'),
(100, 50, 1, 0, 2, '99'),
(101, 50, 8, 1, 2, '86'),
(102, 51, 4, 0, 1, '89'),
(103, 51, 9, 1, 3, '86'),
(104, 52, 9, 0, 1, '66'),
(105, 52, 1, 0, 1, '99'),
(106, 53, 2, 1, 2, '169'),
(107, 54, 4, 0, 1, '89'),
(108, 55, 6, 0, 1, '49'),
(109, 55, 6, 1, 2, '69'),
(110, 56, 9, 1, 3, '86'),
(111, 57, 8, 0, 3, '66'),
(112, 57, 8, 1, 1, '86'),
(113, 57, 3, 0, 1, '69'),
(114, 57, 3, 1, 1, '89'),
(115, 58, 2, 0, 1, '149'),
(116, 59, 9, 0, 2, '66'),
(117, 60, 2, 1, 1, '169'),
(118, 61, 6, 0, 2, '49'),
(119, 61, 3, 0, 1, '69'),
(120, 61, 3, 1, 2, '89'),
(121, 62, 8, 0, 1, '66'),
(122, 62, 8, 1, 1, '86'),
(123, 63, 4, 0, 1, '89'),
(124, 63, 4, 1, 1, '109'),
(125, 64, 7, 0, 1, '39'),
(126, 64, 7, 1, 1, '59'),
(127, 65, 3, 0, 5, '69'),
(128, 65, 3, 1, 1, '89'),
(129, 66, 1, 1, 1, '119'),
(130, 67, 6, 0, 5, '49'),
(131, 68, 1, 1, 3, '119'),
(132, 68, 4, 0, 5, '89'),
(133, 68, 4, 1, 1, '109'),
(134, 69, 8, 1, 4, '86'),
(135, 70, 3, 1, 4, '89'),
(136, 71, 7, 0, 1, '39'),
(137, 71, 7, 1, 1, '59'),
(138, 72, 4, 1, 1, '109'),
(139, 72, 1, 0, 2, '99'),
(140, 73, 6, 1, 5, '69'),
(141, 74, 7, 0, 1, '39'),
(142, 74, 7, 1, 1, '59'),
(143, 75, 2, 0, 1, '149'),
(144, 76, 6, 0, 2, '49'),
(145, 77, 4, 0, 1, '89'),
(146, 78, 2, 0, 1, '149'),
(147, 78, 2, 1, 3, '169'),
(148, 79, 6, 0, 2, '49'),
(149, 79, 6, 1, 2, '69'),
(150, 80, 2, 1, 1, '169'),
(151, 81, 4, 0, 1, '89'),
(152, 81, 4, 1, 1, '109'),
(153, 82, 8, 1, 3, '86'),
(154, 83, 5, 0, 1, '129'),
(155, 84, 4, 0, 1, '89'),
(156, 84, 4, 1, 1, '109'),
(157, 85, 8, 0, 4, '66'),
(158, 86, 9, 1, 9, '86'),
(159, 86, 2, 0, 7, '149'),
(160, 87, 9, 1, 2, '86'),
(161, 87, 4, 0, 1, '89'),
(162, 87, 4, 1, 1, '109'),
(163, 88, 4, 1, 2, '109'),
(164, 88, 3, 0, 1, '69'),
(165, 88, 3, 1, 9, '89'),
(166, 89, 2, 0, 1, '149'),
(167, 89, 2, 1, 1, '169'),
(168, 90, 2, 1, 1, '169'),
(169, 90, 4, 1, 1, '109'),
(170, 91, 9, 1, 3, '86'),
(171, 92, 4, 1, 2, '109'),
(172, 93, 6, 0, 2, '49'),
(173, 94, 7, 0, 3, '39'),
(174, 95, 1, 0, 1, '99'),
(175, 95, 1, 1, 2, '119'),
(176, 96, 3, 0, 2, '69'),
(177, 97, 4, 1, 4, '109'),
(178, 98, 9, 0, 6, '66'),
(179, 98, 9, 1, 1, '86'),
(180, 99, 7, 0, 6, '39'),
(181, 99, 7, 1, 6, '59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ep_order_method`
--

CREATE TABLE `ep_order_method` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `ep_order_method`
--

INSERT INTO `ep_order_method` (`id`, `name`, `status`) VALUES
(1, 'Bank transfer', 1),
(2, 'Pay cash', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ep_sea_animal`
--

CREATE TABLE `ep_sea_animal` (
  `sea_id` int(11) NOT NULL,
  `sea_name` varchar(150) NOT NULL,
  `sea_group_id` int(11) NOT NULL,
  `sea_img` varchar(200) NOT NULL,
  `sea_sub_img` varchar(200) NOT NULL,
  `sea_info` varchar(200) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'Người tạo bài viết',
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `ep_sea_animal`
--

INSERT INTO `ep_sea_animal` (`sea_id`, `sea_name`, `sea_group_id`, `sea_img`, `sea_sub_img`, `sea_info`, `user_id`, `created`, `status`) VALUES
(1, 'Whale Shark', 30, '/Aquarium/public/templates/upload/animal/484-196-whale-shark-3-1440x454.jpg', '/Aquarium/public/templates/upload/animal/814-312-whale-shark-5-250x175@2x.jpg', 'The whale shark is the largest fish in the sea!', 1, '2021-05-27 22:18:14', 1),
(2, 'Sandbar Shark', 30, '/Aquarium/public/templates/upload/animal/344-338-sandbar-shark-2-1440x454.jpg', '/Aquarium/public/templates/upload/animal/168-405-sandbar-shark-3-250x175.jpg', 'The sandbar shark is listed as “Vulnerable” on the International Union for the Conservation of Nature Red List.', 1, '2021-05-27 22:28:58', 1),
(3, 'Blacktip Reef Shark', 30, '/Aquarium/public/templates/upload/animal/861-999-blacktip-reef-shark-2-1440x454.jpg', '/Aquarium/public/templates/upload/animal/113-577-blacktip-reef-shark-3-250x175.jpg', 'Fast-swimming and active', 1, '2021-05-28 09:46:39', 1),
(4, 'Tiger Shark', 30, '/Aquarium/public/templates/upload/animal/156-469-sharks-10-1440x454.jpg', '/Aquarium/public/templates/upload/animal/842-621-sharks-10-250x175.jpg', 'The tiger shark is one of the largest carnivores in the ocean.', 1, '2021-05-28 09:54:29', 1),
(5, 'Zebra Shark', 30, '/Aquarium/public/templates/upload/animal/576-180-zebra-shark-3.jpg', '/Aquarium/public/templates/upload/animal/250-685-zebra-shark-4-250x175.jpg', 'A docile, slow-moving shark', 1, '2021-05-28 10:05:53', 1),
(6, 'Alligator Snapping Turtle', 60, '/Aquarium/public/templates/upload/animal/610-859-alligator-snapping-turtle-4-e1572987876491-1440x454.jpg', '/Aquarium/public/templates/upload/animal/647-859-alligator-snapping-turtle-3-250x175.jpg', 'Alligator snapping turtles use a pink worm-like tongue to lure fish in murky water.', 1, '2021-06-14 20:37:39', 1),
(7, 'Green Sea Turtle', 60, '/Aquarium/public/templates/upload/animal/908-379-green-sea-turtle-2-1440x454.jpg', '/Aquarium/public/templates/upload/animal/203-379-green-sea-turtle-4-250x175.jpg', 'The green sea turtle gets its name from the greenish color of its fat.', 1, '2021-06-14 20:46:19', 1),
(8, 'Razorback Musk Turtle', 60, '/Aquarium/public/templates/upload/animal/458-680-razorback-musk-turtle-2-1440x454.jpg', '/Aquarium/public/templates/upload/animal/814-680-razorback-musk-turtle-3-250x175.jpg', 'Razorback musk turtles are a favorite of home aquarists because of their small size and ease of care.', 1, '2021-06-14 20:51:20', 1),
(9, 'Longnose Butterflyfish', 31, '/Aquarium/public/templates/upload/animal/104-676-longnose-butterflyfish-2-1440x454.jpg', '/Aquarium/public/templates/upload/animal/456-676-longnose-butterflyfish-3-250x175.jpg', 'Adult longnose butterflyfish are usually found in pairs', 1, '2021-06-14 21:07:56', 1),
(10, 'Copperband Butterflyfish', 31, '/Aquarium/public/templates/upload/animal/530-897-copperband-butterflyfish-2-1440x454.jpg', '/Aquarium/public/templates/upload/animal/256-897-copperband-butterflyfish-3-250x175.jpg', 'The copperband butterflyfish is found primarily in shallow water.', 1, '2021-06-14 21:11:37', 1),
(11, 'Pyramid Butterfly Fish', 31, '/Aquarium/public/templates/upload/animal/273-039-pyramid-butterfly-fish-2-1440x454.jpg', '/Aquarium/public/templates/upload/animal/796-039-pyramid-butterfly-fish-3-250x175.jpg', 'Th pyramid butterflyfish is common throughout its range', 1, '2021-06-14 21:30:39', 1),
(12, 'Banded Rainbowfish', 31, '/Aquarium/public/templates/upload/animal/484-242-banded-rainbowfish-1440x454.jpg', '/Aquarium/public/templates/upload/animal/739-242-banded-rainbowfish-2-250x175.jpg', 'The banded rainbowfish is an aseasonal breeding species that breeds continuously throughout the year.', 1, '2021-06-14 21:34:02', 1),
(13, 'African Penguin', 61, '/Aquarium/public/templates/upload/animal/922-632-african-penguin-3-1440x454.jpg', '/Aquarium/public/templates/upload/animal/793-632-african-penguin-2-250x175.jpg', 'African penguins molt once a year. During this time, they lose all of their feathers and grow a new set.', 1, '2021-06-14 21:40:32', 1),
(14, 'White Spotted Jelly', 62, '/Aquarium/public/templates/upload/animal/723-901-white-spotted-jelly-2-1440x454.jpg', '/Aquarium/public/templates/upload/animal/830-901-white-spotted-jelly-3-250x175.jpg', 'A large group of jellies is called a smack.', 1, '2021-06-14 21:45:01', 1),
(15, 'Longcomb Sawfish', 30, '/Aquarium/public/templates/upload/animal/427-119-longcomb-sawfish-4-1440x454.jpg', '/Aquarium/public/templates/upload/animal/726-119-longcomb-sawfish-3-250x175.jpg', 'The longcomb sawfish’s “saw” can be as long as 5.4 feet (1.6 m).', 1, '2021-06-14 21:48:39', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ep_sea_description`
--

CREATE TABLE `ep_sea_description` (
  `id` int(11) NOT NULL,
  `sea_id` int(11) NOT NULL COMMENT 'Fk',
  `des_name` varchar(150) NOT NULL,
  `top_content` text NOT NULL,
  `img` varchar(150) NOT NULL,
  `bot_content` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `ep_sea_description`
--

INSERT INTO `ep_sea_description` (`id`, `sea_id`, `des_name`, `top_content`, `img`, `bot_content`) VALUES
(1, 1, 'Physical Characteristics', '<p><strong>Size</strong></p>\n\n<ul>\n	<li>The whale shark is the largest fish in the world and the largest fish known to have lived on this planet. Because of its size and cartilaginous skeleton, it does not fossilize well and in life it is very difficult to weigh accurately.</li>\n	<li>The largest accurately measured whale shark was 61.7 feet (18.8 m).</li>\n	<li>The average length is between 18 and 32.8 feet (5.5 &ndash; 10 m).</li>\n	<li>Newborns measure 21 to 25 inches (53 &ndash; 64 cm) long.</li>\n</ul>\n\n<p><strong>Body Composition</strong></p>\n\n<ul>\n	<li>Whale shark has a broad, flat head, relatively small eyes, five large gill slits, two dorsal fins, two long pectoral fins, two pelvic fins, one anal fin and a large sweeping tail. It has a vestigial spiracle behind the eye, which is an evolutionary remnant of its common ancestry with bottom-dwelling (benthic) carpet sharks.</li>\n	<li>Unlike most shark species, its mouth is located at the front of the head (terminal) instead of the underside of the rostrum (subterminal).</li>\n	<li>The whale shark has a huge mouth, which can reach up to 4 feet (1.4 m) across, located at the front of the head.</li>\n	<li>Inside the mouth are specialized flaps called velums. These stop the backflow of water as the whale shark closes its mouth, preventing the loss of food.</li>\n	<li>The skin of an adult whale shark can be as thick as 4 inches (10 cm) and has the consistency of strong rubber, which limits possible predators to killer whales, great white sharks, tiger sharks and humans.</li>\n</ul>\n\n<p><strong>Color</strong></p>\n\n<ul>\n	<li>Whale shark has a two-toned pattern of light spots on its dark gray back with a white underside.</li>\n	<li>Each whale shark has its own individual spot pattern; like human fingerprints, no two are exactly alike.</li>\n</ul>\n\n<p><strong>Teeth</strong></p>\n\n<ul>\n	<li>Teeth of the whale shark are tiny and pointed backward; they are thought to have no function in feeding.</li>\n	<li>There are about 300 rows of tiny teeth along the inner surface of each jaw, just inside the mouth.</li>\n</ul>\n', '', ''),
(2, 1, 'ANIMAL FACT', '<h2 style=\"color: blue;\">Although it&rsquo;s the largest fish in the world, the whale shark eats some of the tiniest creatures in the ocean, called zooplankton.</h2>\n', '', ''),
(3, 1, 'Diet / Feeding', '<h2>&nbsp;</h2>\n\n<p><strong>Diet</strong></p>\n\n<ul>\n	<li>Consists of zooplankton, specifically sergestid shrimps and fish eggs as well as krill, jellies, copepods, coral spawn, etc. and small fishes (sardines, anchovies, etc).</li>\n	<li>Can only swallow small prey because its throat is very narrow, often compared to the size of a quarter.</li>\n</ul>\n\n<p><strong>Feeding Behaviors</strong></p>\n\n<ul>\n	<li>A whale shark filters food from the water by &ldquo;cross-flow filtration,&rdquo; which means the particles do not catch on the filter. Rather, water is directed away through the gills while particles (which have more momentum) carry on towards the back of the mouth in an ever more concentrated stream. A bolus or spinning ball of food grows in diameter at the back of the throat until it triggers a swallowing reflex. This is very efficient and does not clog the filters.</li>\n	<li>Multiple feeding methods may be observed in whale sharks:\n	<ul>\n		<li>When food concentrations are high, the shark will use one of two suction-type feeding methods: active suction feeding and vertical suction feeding.</li>\n		<li>Active surface suction feeding is the most common type of feeding method, and is characterized by the shark swimming in a normal orientation while feeding.</li>\n		<li>When food is densely concentrated, the shark will often exhibit vertical suction feeding: remaining stationary in a semi-vertical position, facing the surface.</li>\n		<li>During vertical and active surface suction feeding, the shark will open and close its mouth, creating a strong suction and bringing in large volumes of water.</li>\n		<li>When the sharks are fed in Ocean Voyager, they employ this suction-type feeding style, while following feeding ladles along the surface.</li>\n		<li>During active surface feeding, the top jaw typically breaks the surface.</li>\n	</ul>\n	</li>\n</ul>\n', '', ''),
(4, 1, 'Any Infomation.', '<h2>Range / Habitat</h2>\n\n<p><strong>Range</strong></p>\n\n<ul>\n	<li>Occurs worldwide in the tropical Atlantic, Pacific, and Indian Oceans between about 30 degrees North and 35 degrees South, though it has been sighted as far as 41 degrees North and 36.5 degrees South.</li>\n</ul>\n\n<p><strong>Habitat</strong></p>\n\n<ul>\n	<li>Typically found offshore but will come close to shore, sometimes entering lagoons or coral atolls. Frequents shallow water areas near bays and upwelling coastal areas near continental drop-offs, sometimes during seasonal plankton blooms.</li>\n</ul>\n\n<h2>Reproduction &amp; Growth</h2>\n\n<ul>\n	<li>The whale shark is ovoviviparous, meaning the embryo is formed within an egg, which then hatches in the mother&rsquo;s uterus. At term, the young are released into the sea fully-formed. The only litter size that has ever been documented was more than 300 pups.</li>\n	<li>Very little is known about whale shark mating behavior as it has been observed only twice in its natural habitat, and never in an aquarium setting.</li>\n</ul>\n\n<h2>Conservation Status</h2>\n\n<ul>\n	<li>&ldquo;Endangered&rdquo; on the IUCN Red List.</li>\n	<li>Appendix II of CITES.</li>\n	<li>Appendix II of CMS</li>\n	<li>In 2016, the global whale shark population as a whole was downgraded from Vulnerable to Endangered on the IUCN Red List.</li>\n	<li>Specific threats to whale sharks include entanglement in fishing nets, boat strikes, ingestion of marine debris and micro plastics, and in some cases human interference through unregulated tourism.</li>\n	<li>In southern China and Oman, whale sharks are opportunistically fished.</li>\n</ul>\n\n<h2>Additional Information</h2>\n\n<ul>\n	<li>Usual swim speed when feeding at the surface is roughly 2 knots (a typical walking pace of 2.3 mph). When cruising, it averages about 2.5 knots (2.9 mph). When alarmed, the whale shark has been observed accelerating to a body length per second for very short bursts, but they cannot sustain fast swimming for long.</li>\n	<li>The whale shark is not thought to be able to breach at all, unlike the basking shark.</li>\n</ul>\n', '', ''),
(5, 2, 'More infomation', '<blockquote>\n<p><strong>Physical Characteristics</strong></p>\n</blockquote>\n\n<p><strong>Size</strong></p>\n\n<ul>\n	<li>Typically, sandbar shark is about 6 feet (2 m) in length and weighs 100 to 200 lbs. (45 to 90 kg). The size record for this species is just over 8 feet (2.5 m) and 260 lbs. (118 kg). Females are usually heavier than males.</li>\n</ul>\n\n<p><strong>Body Composition</strong></p>\n\n<ul>\n	<li>Sandbar shark has a stout body with a moderately long, rounded snout and a large first dorsal fin.</li>\n</ul>\n\n<p><strong>Color</strong></p>\n\n<ul>\n	<li>This shark exhibits countershading; it is gray-brown to bronze on the back and flanks, and white underneath. The tips and margins of the fins are sometimes darker than the rest of the body.</li>\n</ul>\n\n<blockquote>\n<p>The most abundant shark in the western Atlantic, the sandbar shark is rarely seen at the surface, instead swimming at depths between 60-200 feet. This species can be found over smooth substrates in shallow, coastal waters in tropical and warm temperate regions worldwide. Along the east coast of the United States, the sandbar shark undergoes annual migrations, swimming south in the winter, and heading north again when warmer weather returns. During these migrations, the sharks head to deeper waters &ndash; in some cases well over 900 feet (280 m) deep. There, males form large schools and move en masse, while females typically migrate alone. The sandbar shark is an opportunistic feeder, and will consume a variety of prey, including bony fish, smaller sharks, rays, crabs and shrimp.</p>\n</blockquote>\n', '/Aquarium/public/templates/upload/animal/492-811-fc3935960aa77746cfe5dc68e8e7c6bf.jpg', '<h2>Diet / Feeding</h2>\n\n<p><strong>Diet</strong></p>\n\n<ul>\n	<li>This species is an opportunistic feeder preying on bony fishes, smaller sharks, rays, cephalopods, gastropods, crabs and shrimp.</li>\n</ul>\n\n<p><strong>Feeding Behaviors</strong></p>\n\n<ul>\n	<li>Feeds throughout the day, but is more active at night.</li>\n</ul>\n\n<h2>Range / Habitat</h2>\n\n<p><strong>Range</strong></p>\n\n<ul>\n	<li>Sandbar shark is a coastal-pelagic species, common in tropical and warm temperate waters worldwide. Occurs in the Western Atlantic from Cape Cod south to Argentina, including the Gulf of Mexico, the Bahamas, Cuba and parts of the Caribbean.</li>\n	<li>In the Eastern Atlantic it ranges from Portugal to equatorial Africa, including the Mediterranean. It is present in scattered locations in the Indo-Pacific from Eastern Africa and the Red Sea to the Hawaiian Islands. It also occurs in the Eastern Pacific in the Galapagos and Revillagigedo islands.</li>\n</ul>\n\n<p><strong>Habitat</strong></p>\n\n<ul>\n	<li>This shark is essentially a coastal shallow-water shark that is seldom seen at the surface. It can be found offshore over the continental shelf and around islands, typically at depths between about 60 and 200 feet (20-65 m). Occasionally, it moves into the adjacent water to depths of over 900 feet (280 m) during migrations (see below).</li>\n	<li>Often found in bays, river mouths and harbors with smooth substrate. It avoids coral reefs and other rough-bottom areas. This shark will not ascend rivers into fresh water.</li>\n</ul>\n'),
(6, 2, 'Reproduction &amp; Growth', '<p><strong>Reproduction</strong></p>\n\n<ul>\n	<li>Mating takes place from May to June in the Northern Hemisphere and from October to January south of the Equator. Females often carry deep scrapes and lacerations inflicted by aggressive males.</li>\n	<li>Sandbar shark is viviparous, nourishing embryos in her uterus via a placental sac. Gestation lasts 8 to 12 months depending on geographic location and the mother gives birth to 6 to 13 pups. Litter size varies by region. Females breed every other year.</li>\n	<li>Birthing occurs in shallow water nursery grounds where the pups are protected from larger sharks, particularly the bull shark, which is known to prey heavily on small sandbar sharks. Bays and estuaries on the U.S. coast between Delaware and North Carolina are common sandbar shark nurseries.</li>\n</ul>\n\n<p><strong>Growth</strong></p>\n\n<ul>\n	<li>The juveniles remain in or near the nursery for 9 or 10 months and then form schools that move into deeper water. They return to the nurseries during warmer months. These migrations cover much shorter distances than those of the adult. The juveniles repeat this movement pattern until they are about five years old when they follow the wider migration pattern of the adults.</li>\n</ul>\n\n<h2>Conservation Status</h2>\n\n<ul>\n	<li>&ldquo;Vulnerable&rdquo; on the IUCN Red List.</li>\n</ul>\n\n<h2>Additional Information</h2>\n\n<ul>\n	<li>Sandbar shark is the most abundant shark in the Western Atlantic.</li>\n	<li>Populations along the U.S. East Coast undertake extended annual migrations, moving south for the winter and returning north as coastal waters warm up. The southward migration is made in large schools, typically composed only of males. The females appear to migrate alone. Seasonal migrations also have been reported in some populations along the Southeast Coast of Africa.</li>\n	<li>Migrations are made in deep water, well below the usual depths which the sandbar shark occupies. Ocean currents play an important role in these migrations, which scientists believe cover long distances.</li>\n	<li>This species is an important component of shark fisheries. It is caught for its meat, oil and skin, as well as for its fins (for shark fin soup). It also is used for Chinese medicine.</li>\n	<li>Sandbar shark populations in the Western North Atlantic have been severely overfished both commercially and by sport fishermen. The species appears to be recovering since the U.S. began tightly managing the fishery under a management plan implemented in 1993.</li>\n</ul>\n', '', '<i style=\'display: none\'></i>'),
(7, 3, 'Physical Characteristics', '<p><strong>Size</strong></p>\n\n<ul>\n	<li>Blacktip reef shark reaches a maximum size of 6.6 feet (200 cm).</li>\n	<li>The maximum recorded weight is 30 lbs. (13.6 kg).</li>\n</ul>\n\n<p><strong>Body Composition</strong></p>\n\n<ul>\n	<li>A smaller shark with a rounded snout and distinct black tipped fins.</li>\n</ul>\n\n<p><strong>Color</strong></p>\n\n<ul>\n	<li>Blacktip reef shark exhibits counter-shading, being gray to gray-brown on the upper body and white ventrally.</li>\n	<li>Also displays a conspicuous white band on its flanks, which extends rearward to the pelvic fins.</li>\n</ul>\n', '', '<p>ANIMAL FACT</p>\n\n<h2>The blacktip reef shark is often seen cruising just below the surface, with only its dorsal fin showing above.</h2>\n'),
(8, 3, 'Range / Habitat', '<p><strong>Range</strong></p>\n\n<ul>\n	<li>Occurs in the Indo-Pacific from the Red Sea and East Africa to the Hawaiian Islands and south to French Polynesia. It also has moved into the eastern Mediterranean through the Suez Canal.</li>\n</ul>\n\n<p><strong>Habitat</strong></p>\n\n<ul>\n	<li>Found in shallow inshore waters on coral reefs, in the intertidal zone (reef flats) and near reef drop-offs. Also found in mangrove areas, moving in and out with the tide.&nbsp;Has been observed in fresh water, but not in tropical lakes and rivers far from the sea.</li>\n	<li>Usually found in depths 65 to 246 feet (20-75 m).</li>\n</ul>\n', '', '<h2>Reproduction &amp; Growth</h2>\n\n<ul>\n	<li>Female blacktip reef shark produces two to four pups, measuring 1.5 to 1.7 feet (46-52 cm), after an 8-16-month gestation period, which is thought to vary due to water temperature.</li>\n</ul>\n\n<h2>Conservation Status</h2>\n\n<ul>\n	<li>&ldquo;Near Threatened&rdquo; on the IUCN Red List.</li>\n</ul>\n\n<h2>Additional Information</h2>\n\n<ul>\n	<li>This shark cruises in very shallow water with its dorsal (top) fin often extending above the surface. It has been known at times to jump completely out of the water while in the shallows.</li>\n	<li>Blacktip reef shark may become aggressive in areas where spear fishing is common.</li>\n	<li>It is regularly caught by inshore fisheries and is vulnerable to depletion because of its small litter size and long gestation period. It is generally sold as fillets, its fins are valued for shark-fin soup and the liver as a source of oil.</li>\n	<li>This species is found singly or in small groups.</li>\n	<li>Blacktip reef shark is not to be confused with the blacktip shark, which is a different species.</li>\n</ul>\n'),
(9, 4, 'Physical Characteristics', '<ul>\n	<li>Juvenile has tiger-like stripes, which give this species its name. Stripes fade as shark grows into adulthood but are still visible.</li>\n	<li>Unlike many shark species, the male tiger shark is larger than the female.</li>\n	<li>May grow longer than 16 feet (4.9 m) and weigh more than 1,400 pounds (635 kg).</li>\n	<li>One of the largest carnivores in the ocean.</li>\n	<li>Broad, wedge shaped head with blunt snout.</li>\n	<li>Coloration is dark gray to bluish or greenish-grey on the dorsal surface. Underside is stark white.</li>\n</ul>\n', '', '<blockquote>\n<p>The tiger shark is one of the most dangerous sharks to humans in terms of number of attacks recorded, second only to the white shark.</p>\n\n<p>They are curious and aggressive in contact with humans and they are the largest of the requiem sharks. Other common names include the leopard shark, maneater shark, and spotted shark.</p>\n</blockquote>\n\n<p>&nbsp;</p>\n\n<h2>ANIMAL FACT</h2>\n\n<h3 style=\'color: blue;\'>The tiger shark is one of the largest carnivores in the ocean.</h3>\n'),
(10, 4, 'Diet / Feeding', '<ul>\n	<li>Diet of the tiger shark is one of the most diverse of any shark.</li>\n	<li>Diet consists of many species of bony fish, sharks, rays, marine mammals (such as seals and dolphins), marine reptiles (such as turtles and sea snakes), invertebrates (such as crustaceans, cephalopods and jellies) and sea birds.</li>\n	<li>Known to consume almost any type of marine debris that ends up in the ocean.</li>\n</ul>\n\n<h2>Range / Habitat</h2>\n\n<ul>\n	<li>Occurs in tropical and temperature ocean environments worldwide.</li>\n	<li>Found on or near continental shelves or islands and coral reefs. Occasionally found in river estuaries and harbors.</li>\n</ul>\n\n<h2>Reproduction &amp; Growth</h2>\n\n<ul>\n	<li>Both male and female will have multiple mates and will not form pair bonds.</li>\n	<li>Only species of the family Carcharhinidae (requiem sharks) that does not use a placenta to nourish developing embryos.</li>\n	<li>Gestation usually takes 13-16 months.</li>\n	<li>Litter size of 10-82 pups.</li>\n	<li>Female may mate again even before giving birth to current litter.</li>\n</ul>\n', '', ''),
(11, 5, 'Physical Characteristics', '<p><strong>Size</strong></p>\n\n<ul>\n	<li>Maximum length of 12 feet (3.65 m); the long tail fin may account for about half of the total body length.</li>\n</ul>\n\n<p><strong>Body Composition</strong></p>\n\n<ul>\n	<li>Body is cylindrical and thick, with prominent ridges along the flanks. Head is broad and conical with a very rounded snout and fleshy barbels at the corners of the mouth. Upper lobe of the caudal fin is greatly elongated.</li>\n	<li>Spiracles located behind the eyes allow this shark to rest motionless on the bottom and still circulate water over its gills.</li>\n</ul>\n\n<p><strong>Color</strong></p>\n\n<ul>\n	<li>Coloration of adults is tan with dark spots.</li>\n	<li>Juvenile is dark with yellowish bars, lending to the name, &ldquo;zebra shark.&rdquo;</li>\n</ul>\n', '', '<h2>ANIMAL FACT</h2>\n\n<h3 style=\'color: blue;\'>Sharks have multiple methods of reproduction &ndash; some species give birth to live young, while others lay egg cases, called mermaids purses. The zebra shark lays large, dark brown to purplish black egg cases.</h3>\n'),
(12, 5, 'Diet / Feeding', '<p><strong>Diet</strong></p>\n\n<ul>\n	<li>Diet consists primarily of benthic invertebrates such as snails, shrimp, crabs and sea urchins, as well as small fishes.</li>\n</ul>\n\n<p><strong>Feeding Behaviors</strong></p>\n\n<ul>\n	<li>Can fit into small crevices and holes in the reef as it searches for food.</li>\n</ul>\n', '', '<h2>Range / Habitat</h2>\n\n<ul>\n	<li>Occurs in the shallow waters of the Indian Ocean and West Pacific from South Africa to the Red Sea, from Pakistan, India and Southeast Asia to China, Indonesia and the Philippines and from Australia and New Caledonia to Southern Japan.</li>\n	<li>Found on and adjacent to coral reefs, usually in areas with sandy seafloor.</li>\n</ul>\n\n<h2>Reproduction &amp; Growth</h2>\n\n<p><strong>Reproduction</strong></p>\n\n<ul>\n	<li>Oviparous, or egg-laying, species; female lays large, dark brown or purplish black egg cases.</li>\n</ul>\n\n<p><strong>Growth:</strong></p>\n\n<ul>\n	<li>Newly hatched young is 8 to 10 inches (20-26 cm).</li>\n	<li>Juvenile will begin feeding on its own in the protected reef shallows.</li>\n</ul>\n\n<h2>Conservation Status</h2>\n\n<ul>\n	<li>&ldquo;Vulnerable&rdquo; on the IUCN Red List.</li>\n</ul>\n\n<h2>Additional Information</h2>\n\n<ul>\n	<li>Nocturnal; rests on the ocean bottom during the day.</li>\n	<li>A slow moving shark, considered harmless to humans.</li>\n</ul>\n'),
(13, 6, 'Physical Characteristics', '<ul>\n	<li>The carapace, or upper shell, of the alligator snapping turtle is black, dark brown, grey or green in color. The carapace has three large ridges on top. Its skin is dark brown to grey in color.</li>\n	<li>This turtle has a large head with powerful jaws, a hooked beak and eyes on the side of its head.</li>\n	<li>Can weigh 155 to 175 pounds (70-80 kg) and can reach up to 3 feet (1 m) in length.</li>\n	<li>Alligator snapping turtles have sexual dimorphism; males are larger than females.</li>\n</ul>\n', '', '<p><strong>ANIMAL FACT</strong></p>\n\n<h3 style=\'color:blue\'>Alligator snapping turtles use a pink worm-like tongue to lure fish in murky water.</h3>\n'),
(14, 6, 'Diet / Feeding', '<ul>\n	<li>Carnivorous; diet consists of mostly fish, reptiles and small birds.</li>\n	<li>Uses pink worm-like tongue to lure fish in murky waters.</li>\n	<li>Nocturnal hunters and dormant during the day.</li>\n</ul>\n', '', '<h2>Range / Habitat</h2>\n\n<ul>\n	<li>Occurs in southern Georgia to northern Florida, as well as southern states surrounding the Gulf of Mexico.</li>\n	<li>Found in a temperate climate, often in large freshwater lakes, ponds, rivers and streams.</li>\n	<li>Juveniles are found in small ponds, lakes and streams.</li>\n</ul>\n\n<h2>Reproduction &amp; Growth</h2>\n\n<ul>\n	<li>Female turtles reproduce annually or bi-annually.</li>\n	<li>Nesting season varies by location but generally falls during April through June.</li>\n	<li>Mating season is in early spring in Florida or late spring the Mississippi Valley.</li>\n	<li>During nesting season, females dig nests in sand 50 meters from a body of water.</li>\n	<li>Eggs incubate for approximately three to four months.</li>\n	<li>Juveniles are active and independent upon hatching.</li>\n	<li>Sexual maturity is reached between 11 to 13 years of age.</li>\n</ul>\n\n<h2>Conservation Status</h2>\n\n<ul>\n	<li>&ldquo;Vulnerable&rdquo; on the IUCN Red List.</li>\n</ul>\n\n<h2>Additional Information</h2>\n\n<ul>\n	<li>Largest freshwater turtle in North America.</li>\n	<li>Spends most of its life in water, save for hatching and nesting events.</li>\n	<li>Lifespan in human care averages 70 years.</li>\n</ul>\n'),
(15, 7, 'Physical Characteristics', '<p><strong>Size</strong></p>\n\n<ul>\n	<li>Averages in weight from 300 to 500 lbs. (135&ndash;160 kg) and reaches approximately 3 feet (1 m) in length.</li>\n	<li>Hatchling is about 2 inches (5 cm) long and weighs 0.05 ounces (25 g).</li>\n</ul>\n\n<p><strong>Body Composition</strong></p>\n\n<ul>\n	<li>The carapace, or upper shell, of the green sea turtle is light to dark brown in color with a creamy underside, or plastron. The carapace is often blotched or streaked with olive or other shades of brown. Its skin is cream to yellow in color.</li>\n	<li>This turtle has a relatively small, rounded head.</li>\n	<li>Unlike land turtles, a sea turtle is unable to tuck its head and legs into its shell, making it vulnerable to sharks, the sea turtle&rsquo;s only natural predator.</li>\n</ul>\n\n<p><strong>Color</strong></p>\n\n<ul>\n	<li>Green sea turtle fat is greenish in color. Its vegetarian diet is believed to be the reason for this.</li>\n</ul>\n', '', '<p><strong>ANIMAL FACT</strong></p>\n\n<h3 style=\'color:blue;\'>The green sea turtle gets its name from the greenish color of its fat.</h3>\n'),
(16, 7, 'Diet / Feeding', '<p><strong>Diet</strong></p>\n\n<ul>\n	<li>Diet consists of sea grasses and algae.</li>\n</ul>\n\n<p><strong>Feeding Behaviors</strong></p>\n\n<ul>\n	<li>This species is the only herbivorous sea turtle.</li>\n	<li>Young turtle feeds on pelagic vegetation.</li>\n</ul>\n', '', '<h2>Range / Habitat</h2>\n\n<p><strong>Range</strong></p>\n\n<ul>\n	<li>Occurs all over the world in the Atlantic, Pacific and Indian Oceans, as well as the Mediterranean Sea.</li>\n</ul>\n\n<p><strong>Habitat</strong></p>\n\n<ul>\n	<li>Found in tropical and subtropical waters, often in coastal areas and around remote ocean islands.</li>\n</ul>\n\n<h2>Reproduction &amp; Growth</h2>\n\n<p><strong>Reproduction</strong></p>\n\n<ul>\n	<li>The female turtle returns to the same beach (known as &ldquo;natal beaches,&rdquo;) every two to four years to make a nest and lay eggs.</li>\n	<li>Nesting season varies by location, but generally falls during the summer months.</li>\n	<li>During nesting season, the female emerges from the water at night and drags her body up the beach to dig a nest for her eggs.&nbsp;Once she reaches an area on the beach well above the high water line or into the dune face, she digs a hole by scooping sand with her rear flippers.&nbsp;After depositing the eggs, she covers them with sand, smoothing the area with her body to disguise the location of the nest from predators such as raccoons.&nbsp;Female then returns to the sea.</li>\n	<li>Mating season in southeastern U.S. is April through July, with turtles nesting in late June through early September.</li>\n	<li>Typical clutch size commonly ranges anywhere between 75 to 200 eggs.</li>\n</ul>\n\n<p><strong>Growth</strong></p>\n\n<ul>\n	<li>Eggs incubate for approximately two months.</li>\n	<li>Hatchling is active as soon as it breaks out of its egg.&nbsp;Emerges from the nest, after days of digging its way up through the sand, and makes its way to the ocean.&nbsp;During this period, the tiny turtle is vulnerable to ghost crabs, birds and other predators.&nbsp;Once in the water, hatchling swims out to the nearest floating mass of sargassum weed and spends the first portion of its life there feeding, growing and drifting with the currents.</li>\n	<li>&ldquo;Lost years&rdquo; is the period of time between hatching and the turtle&rsquo;s return to coastal waters as a juvenile. The newly hatched turtle will often spend its first 3 to 7 years in floating mats of sargassum seaweed.</li>\n</ul>\n\n<h2>Conservation Status</h2>\n\n<ul>\n	<li>&ldquo;Endangered&rdquo; on the IUCN Red List.</li>\n</ul>\n\n<h2>Additional Information</h2>\n\n<ul>\n	<li>The term &ldquo;green&rdquo; in its name is due to the fact that the turtle&rsquo;s subdermal fat is green.</li>\n	<li>Of hard-shelled sea turtles, this species is the largest.</li>\n	<li>Passes entire life in the ocean, save for hatching and nesting events.</li>\n	<li>Spends much of its time floating at the ocean&rsquo;s surface.</li>\n	<li>Lifespan in human care averages 75 years.</li>\n</ul>\n'),
(17, 8, 'Physical Characteristics', '<ul>\n	<li>Razorback musk turtle ranges in color from olive green to shades of gray and tan. The head and feet are usually marked with darker speckling or streaking, and the carapace is similarly marked.</li>\n	<li>A high, strong ridge or &ldquo;dorsal keel,&rdquo; is an identifying feature of this species. It is especially noticeable in hatchlings and juveniles.</li>\n	<li>Carapace is commonly 5.1 &ndash; 6.3 inches (13 &ndash; 16cm) long with a maximum size of 8.3 inches (20.9 cm).</li>\n</ul>\n', '', '<p><strong>ANIMAL FACT</strong></p>\n\n<h2 style=\'color:blue;\'>Razorback musk turtles are a favorite of home aquarists because of their small size and ease of care.</h2>\n'),
(18, 8, 'Diet / Feeding', '<ul>\n	<li>Diet consists of fish, snails, crustaceans, clams and aquatic insects.</li>\n</ul>\n', '', '<h2>Range / Habitat</h2>\n\n<ul>\n	<li>Occurs in North America from middle Texas and southern Oklahoma through Arkansas and southern Mississippi.</li>\n	<li>Most often found in streams and river systems with gravel or sandy substrate. Also found in lakes and swamps. The razorback musk turtle appears to prefer habitats with the presence of dead wood for basking and hiding under.</li>\n</ul>\n\n<h2>Reproduction &amp; Growth</h2>\n\n<ul>\n	<li>Reproductive maturity is reached between the ages of four to eight years, at a size of about 3.0 &ndash; 4.7 (8 &ndash; 12 cm).</li>\n	<li>Females typically produce two or three clutches per year. A single clutch usually consists of one to seven eggs.</li>\n	<li>Hatchlings range in length from 0.9 to 1.1 inches (25 &ndash; 28 mm).</li>\n</ul>\n\n<h2>Conservation Status</h2>\n\n<ul>\n	<li>&ldquo;Least Concern&rdquo; on the IUCN Red List.</li>\n</ul>\n\n<h2>Additional Information</h2>\n\n<ul>\n	<li>Also called the &ldquo;keeled musk turtle.&rdquo;</li>\n	<li>A popular turtle for home aquarists due to its small size and ease of care.</li>\n</ul>\n'),
(19, 9, 'Physical Characteristics', '<ul>\n	<li>Bright yellow body with a head that is black on top and silvery-white below. This species has a long snout.</li>\n	<li>Can reach lengths of 8.7 inches (22 cm).</li>\n</ul>\n', '', '<p><strong>ANIMAL FACT</strong></p>\n\n<h3 style=\'color:blue\'>Adult longnose butterflyfish are usually found in pairs, particularly during breeding, but may also be solitary or in small groups.</h3>\n'),
(20, 9, 'Diet / Feeding', '<ul>\n	<li>Diet consists of hydroids, fish eggs and small crustaceans.</li>\n	<li>Prefers to eat the tube feet and pedicellaria of echinoderms or the tentacles of polychaetes.</li>\n</ul>\n', '', '<h2>Range / Habitat</h2>\n\n<ul>\n	<li>Occurs in the Indo-Pacific from the Red Sea and East Africa to the Hawaiian and Easter islands, north to southern Japan, south to Lord Howe Island and throughout Micronesia. Also inhabits the Eastern Pacific from Baja California, Mexico, to the Revillagigedo and Galapagos islands.</li>\n	<li>Found in exposed seaward reefs but also appears in lagoon reefs at depths to 476 feet (145 m).</li>\n</ul>\n\n<h2>Reproduction &amp; Growth</h2>\n\n<p>Courtship ritual is elaborate:</p>\n\n<ul>\n	<li>Female and one or more males rapidly swim in tight circles and move up near the ocean surface to release eggs and sperm into the water.</li>\n	<li>Fertilized eggs hatch in the sea in about 24 hours.</li>\n	<li>Larvae drift as plankton for 3 to 8 weeks, depending on the species.</li>\n	<li>Young then seek shelter on shallow reefs, where they develop into adults.</li>\n</ul>\n\n<h2>Conservation Status</h2>\n\n<ul>\n	<li>&ldquo;Least Concern&rdquo; on the IUCN Red List.</li>\n</ul>\n\n<h2>Additional Information</h2>\n\n<ul>\n	<li>Very similar in appearance to the big longnose butterflyfish (<em>Forcipiger longirostris</em>), a much less common species.</li>\n	<li>Most widely-distributed butterfly species.</li>\n	<li>Adult usually found in pairs, particularly during breeding, but may also be solitary or in small groups.</li>\n</ul>\n'),
(21, 10, 'Physical Characteristics', '<ul>\n	<li>Readily identifiable by its distinctive coloration and long snout.</li>\n	<li>Body is silvery-white with three broad vertical, orange to copper-colored bars. A narrower copper bar on the head passes through the eye.</li>\n	<li>Black spot at the base of the second dorsal fin and a thin black bar on the caudal peduncle.</li>\n	<li>Grows to 8 inches (20 cm) in length.</li>\n</ul>\n', '', '<p><strong>ANIMAL FACT</strong></p>\n\n<h3 style=\'color:blue;\'>The copperband butterflyfish is found primarily in shallow water.</h3>\n'),
(22, 10, 'Diet / Feeding', '<ul>\n	<li>Diet consists primarily of benthic invertebrates.</li>\n	<li>Sometimes used to control Aiptasia, a common nuisance anemone species, in an aquarium.</li>\n</ul>\n', '', '<h2>Range / Habitat</h2>\n\n<ul>\n	<li>Occurs in the Western Pacific from the Andaman Sea to the Ryukyu Islands and Australia.</li>\n	<li>Found along rocky shores, coral reefs, estuaries and on silty inner reefs.</li>\n	<li>This species is common on coral reefs.</li>\n	<li>Its preferred depth range is 3-82 feet (1-25 m).</li>\n</ul>\n\n<h2>Reproduction &amp; Growth</h2>\n\n<ul>\n	<li>Forms pairs during breeding and is believed to be monogamous.</li>\n	<li>Larval and juvenile stages have similar marking to the adult, but lack its long snout.</li>\n</ul>\n\n<h2>Conservation Status</h2>\n\n<ul>\n	<li>&ldquo;Least Concern&rdquo; on the IUCN Red List.</li>\n</ul>\n\n<h2>Additional Information</h2>\n\n<ul>\n	<li>Encountered singly or in pairs.</li>\n	<li>Forms pairs during breeding and is believed to be monogamous.</li>\n	<li>Life span is about 10 years.</li>\n	<li>Larval and juvenile stages have similar marking to the adult, but lack its long snout.</li>\n	<li>The long snout is an adaptation for feeding on benthic invertebrates in crevices and holes.</li>\n	<li>Considered difficult to keep in a home aquarium.</li>\n	<li>Other common names include &ldquo;beaked coralfish&rdquo; and &ldquo;copper-banded butterflyfish.&rdquo;</li>\n</ul>\n'),
(23, 11, 'Physical Characteristics', '<ul>\n	<li>Pyramid butterflyfish is readily identifiable by its distinctive coloration.</li>\n	<li>The head is brown and black and the dorsal and anal fins are orange-yellow. The yellow color on the dorsal fin extends downward behind the head and on the posterior body toward the causal peduncle. The majority of the side of this fish is white, as are the caudal peduncle, caudal fin and pectoral fin.</li>\n	<li>This species draws its name from the large white triangle on the side that is formed by the yellow area above the caudal peduncle and the triangular patch behind the head.</li>\n	<li>Pyramid butterflyfish grows to 7 inches (18 cm) in length.</li>\n</ul>\n', '', '<p>ANIMAL FACT</p>\n\n<h3 style=\'color: blue;\'>Th pyramid butterflyfish is common throughout its range, forming large aggregations over steep, current-swept outer reef slopes.</h3>\n'),
(24, 11, 'Range / Habitat', '<ul>\n	<li>Pyramid butterflyfish occurs in the Indo-West Pacific to Hawaii and Pitcairn Islands, north to Japan, and south to New Caledonia.</li>\n	<li>Commonly found on the outer reef slopes at depths of about 10 to 200 feet (3 &ndash; 60 m).</li>\n</ul>\n', '', '<h2>Reproduction &amp; Growth</h2>\n\n<ul>\n	<li>Butterflyfish as a group have an elaborate courtship ritual. The female and one or more males rapidly swim in tight circles and move up near the ocean surface to release their eggs and sperm into the water. Fertilized eggs hatch in the sea in about 24 hours and the larvae drift as plankton for 3 to 8 weeks, depending on the species. The young fish then seek shelter on shallow reefs, where the juveniles develop into adults.</li>\n</ul>\n\n<h2>Conservation Status</h2>\n\n<ul>\n	<li>&ldquo;Least Concern&rdquo; on the IUCN Red List.</li>\n</ul>\n\n<h2>Additional Information</h2>\n\n<ul>\n	<li>Pyramid butterflyfish is common throughout its range, forming large aggregations over steep, current-swept outer reef slopes.</li>\n	<li>Also known as the shy butterflyfish.</li>\n	<li>This species forms pairs during spawning</li>\n</ul>\n'),
(25, 12, 'Physical Characteristics', '<ul>\n	<li>Coloration varies widely based on geography, water conditions and diet.</li>\n	<li>Coloration typically silver to blue-green on the sides of the body, with a lighter silver color on the lower portion of the body and a black midlateral stripe. Fins typically dull or bright orange-red.</li>\n	<li>Male is larger and more brightly colored than female and develops longer dorsal and anal fins.</li>\n	<li>Common length of 3.1 inches (8 cm). Maximum length of 5.1 inches (13 cm).</li>\n</ul>\n', '', '<p>ANIMAL FACT</p>\n\n<h3 style=\'color:blue;\'>The banded rainbowfish is an aseasonal breeding species that breeds continuously throughout the year.</h3>\n'),
(26, 12, 'Diet / Feeding', '<ul>\n	<li>Omnivorous species.</li>\n	<li>Diet consists of aquatic insects, algae and plant material.</li>\n	<li>Benthopelagic; feeds near the bottom, midwaters and at the surface of the water.</li>\n	<li>Juvenile also feeds on zooplankton.</li>\n</ul>\n', '', '<h2>Range / Habitat</h2>\n\n<ul>\n	<li>Occurs in freshwater habitats in northern Australia, from the Northern Territory to Queensland.</li>\n	<li>Found mainly in streams or water holes at depths from 11.8 inches (30 cm) to 6.6 feet (20 m).</li>\n	<li>Habitat is usually well-vegetated and may contain rocks, gravel, leaves and mud.</li>\n</ul>\n\n<h2>Reproduction &amp; Growth</h2>\n\n<ul>\n	<li>An oviparous, or egg-laying species.</li>\n	<li>Female attaches eggs to aquatic plants using adhesive threads or tendrils.</li>\n	<li>An aseasonal breeding species that breeds continuously throughout the year.</li>\n</ul>\n\n<h2>Conservation Status</h2>\n\n<ul>\n	<li>&ldquo;Not Evaluated&rdquo; on the IUCN Red List.</li>\n</ul>\n'),
(27, 13, 'Physical Characteristics', '<p><strong>Size</strong></p>\n\n<ul>\n	<li>The adult African penguin stands 18 to 25 inches (46 &ndash; 64 cm) tall and weighs 6 to 7 lbs. (2.7 &ndash; 3.2 kg).</li>\n</ul>\n\n<p><strong>Appearance</strong></p>\n\n<ul>\n	<li>Black back and a white breast. Chest and belly may also have black markings. The white color extends in a semicircular pattern behind and over the head. A horseshoe-shaped black stripe extends across the chest and flanks. Bare flesh-pink skin surrounds the eyes.</li>\n	<li>Juvenile feathers are shades of grey with a lighter belly and chest. They maintain their juvenile feathers for one year post fledging when they molt to their adult plumage.</li>\n	<li>Both sexes look the same. Therefore, not sexually dimorphic.</li>\n</ul>\n\n<p><strong>Feathers/Allopreening</strong></p>\n\n<ul>\n	<li>Penguin feathers are stiff and overlap in layers to trap air next to the skin for insulation. The feathers are very resistant to wind and water.</li>\n	<li>The birds waterproof themselves by using their beak to spread oil from a gland at the base of the tail.</li>\n	<li>African penguins are often seen preening each other (allopreening). Allopreening helps birds preen clean and arrange feathers in areas they cannot reach, such as their neck.</li>\n	<li>Allopreening plays a role in strengthening bonds between mates.</li>\n</ul>\n\n<p><strong>Molt</strong></p>\n\n<ul>\n	<li>Before their yearly molt, penguins feed avidly, putting on extra weight in the form of fat.</li>\n	<li>Molting generally takes place during the summer months (May-September for our penguins; November- January in South Africa [summer in southern hemisphere]). It is common to see some birds molt outside of these seasons.</li>\n	<li>The molting process is stressful because these birds lose their thermal protection and are unable to hunt for food or swim.</li>\n	<li>Molting takes approximately two weeks. They fast during this time, lose weight, and become listless.</li>\n	<li>It takes another four to ten days for new feathers to grow in and become waterproof. Only then can the penguin return to the sea to feed.</li>\n</ul>\n\n<p><strong>Bones</strong></p>\n\n<ul>\n	<li>The bones of penguins are solid, unlike the hollow bones of flying birds, to increase body weight and provide ballast when diving. The solid bones of the penguin make the bird too heavy to fly.</li>\n</ul>\n\n<p><strong>Wings</strong></p>\n\n<ul>\n	<li>Wings of this flightless bird are flippers modified for swimming.</li>\n	<li>The wing bones are flattened and broadened to take the thrust of water.</li>\n	<li>The surface of the wings is covered with scale-like feathers.</li>\n</ul>\n', '', '<p><strong>ANIMAL FACT</strong></p>\n\n<h3 style=\'color:blue\'>African penguins molt once a year. During this time, they lose all of their feathers and grow a new set.</h3>\n'),
(28, 13, 'Diet / Feeding', '<p><strong>Diet</strong></p>\n\n<ul>\n	<li>Diet consists of marine species. Includes twenty-five species of fish (which make up 42 percent of its diet), eighteen species of crustaceans, three species of squid, and one species of polychaete (worms).</li>\n</ul>\n\n<p><strong>Feeding Behaviors</strong></p>\n\n<ul>\n	<li>Feeds at sea, frequently foraging 9 miles (14.5 km) from its rookery area, and occasionally as far as 60 miles (96.6 km) offshore in search of food.</li>\n	<li>Swallows food whole.</li>\n	<li>Barb like structures on the roof of mouth help them grasp the fish.</li>\n</ul>\n', '', '<h2>Range / Habitat</h2>\n\n<p><strong>Range</strong></p>\n\n<ul>\n	<li>Occurs on the southernmost coast of Africa.</li>\n</ul>\n\n<p><strong>Distribution</strong></p>\n\n<ul>\n	<li>Found in temperate climates near water that is between 40 to 70 degrees F (5 &ndash; 20 degrees C).</li>\n</ul>\n\n<p><strong>Habitat</strong></p>\n\n<ul>\n	<li>Breeds on 24 islands offshore between Namibia and Port Elizabeth, South Africa. On the mainland, there are colonies of African penguins in South Africa&rsquo;s Betty&rsquo;s Bay and Simonstown, as well as in Namibia.</li>\n</ul>\n\n<h2>Reproduction &amp; Growth</h2>\n\n<ul>\n	<li>African penguin pair-bond for life. Prior to mating, the penguins bray and flap flippers in unison. Breeding occurs all year but peak times are November and March. There are two broods a year.</li>\n	<li>Two (sometimes 3 or 4) whitish eggs are laid and incubated for 38-42 days. Both parents sit on the nest and tend to their young, relieving each other daily.</li>\n	<li>After hatching, chicks are fed by the parents for up to 3 months, until they molt their down and grow their juvenile feathers. Process is called fledging.</li>\n</ul>\n\n<h2>Conservation Status</h2>\n\n<ul>\n	<li>&ldquo;Endangered&rdquo; on the IUCN Red List.\n	<ul>\n		<li>Downgraded from &ldquo;Vulnerable&rdquo; in August 2010.</li>\n		<li>Reflects the continuing decline in its populations.</li>\n	</ul>\n	</li>\n</ul>\n\n<p><strong>Threats</strong></p>\n\n<ul>\n	<li>Natural predators include South African fur seals, sharks, kelp gulls, skuas, and sacred ibis.</li>\n	<li>Gulls and ibises devour up to 40 percent of eggs before they hatch and also prey on penguin chicks.</li>\n	<li>Human impact include oil spills, habitat degradation from&nbsp;<em>guano</em>&nbsp;collection, food shortages from fisheries</li>\n	<li><em>Guano&nbsp;</em>(bird droppings) is rich in nitrogen compounds. Guano is removed from shoreline rookery areas, processed, and made into fertilizer, which is then sold around the world.</li>\n</ul>\n\n<p><strong>Conservation</strong></p>\n\n<ul>\n	<li>People have begun to take steps to preserve populations of the African penguin.</li>\n	<li>All the islands where the penguins breed have been set aside as nature reserves or national parks, and fences have been constructed around their breeding grounds. This prevents predation on eggs and young by some natural predators.</li>\n	<li>The South African National Foundation for the Conservation of Coastal Birds has rescued many of the species from oil spills and has rehabilitated them for return to their natural environments.</li>\n</ul>\n\n<h2>Additional Information</h2>\n\n<p><strong>Lifespan</strong></p>\n\n<ul>\n	<li>10-15 years in their natural environment.</li>\n	<li>Mid to late-20s in human care.</li>\n</ul>\n\n<p><strong>Communication</strong></p>\n\n<ul>\n	<li>They emit a loud, harsh call, similar to a donkey, to communicate.</li>\n	<li>Very vocal, they have a variety of vocalizations that they make to communicate different things (i.e. courtship/mating, territorial/aggression, calling to mate/chicks, etc.)</li>\n</ul>\n\n<p><strong>Lungs</strong></p>\n\n<ul>\n	<li>Lungs are protected from increased water pressure by air sacs that compress as the bird dives.</li>\n</ul>\n\n<p><strong>Nasal Glands</strong></p>\n\n<ul>\n	<li>Penguins must excrete the excess salt that they take in when they swallow seawater with their food. They have specialized nasal glands that remove the salt from the blood and expel it through the nostrils.</li>\n</ul>\n\n<p><strong>Thermoregulation</strong></p>\n\n<ul>\n	<li>A layer of blubber under the skin helps to keep the penguins warm. If they become overheated, blood vessels in the skin fill with blood, bringing heat from within the body to the surface where it is radiated into the air.</li>\n	<li>Featherless patches on face and feet also allow excess heat to escape</li>\n</ul>\n\n<p><strong>Vision</strong></p>\n\n<ul>\n	<li>These birds are near-sighted on land but have excellent vision underwater.</li>\n</ul>\n\n<p><strong>Swim Behavior</strong></p>\n\n<ul>\n	<li>The penguin often porpoises, plunging in and out of the water, as it swims in order to renew air inside its lungs without interrupting forward progress.</li>\n</ul>\n\n<p><strong>Swim Speed</strong></p>\n\n<ul>\n	<li>It travels at a speed of 4 to 6 miles per hour (6.4 &ndash; 9.7 km per hour) while porpoising, but can reach up to about 12.5 miles per hour (20 km per hour) for very short bursts.</li>\n</ul>\n'),
(29, 14, 'Physical Characteristics', '<ul>\n	<li>Coloration is translucent white to brownish with white spots on its large, gelatinous bell.</li>\n	<li>Eight, long fleshy oral arms, each with flaps of tissue.</li>\n	<li>Maximum bell diameter of 1.6 feet (50 cm).</li>\n	<li>Zooxanthellae may live in tissue, contributing to brownish color.</li>\n</ul>\n', '', '<p><strong>ANIMAL FACT</strong></p>\n\n<h2 style=\'color:blue\'>A large group of jellies is called a smack.</h2>\n'),
(30, 14, 'Diet / Feeding', '<ul>\n	<li>Diet consists of zooplankton.</li>\n	<li>Feed by using oral arms to capture zooplankton by filter feeding.</li>\n</ul>\n', '', '<h2>Range / Habitat</h2>\n\n<ul>\n	<li>Occurs in the Indo-Pacific near Australia (native). Populations introduced in Caribbean, Gulf of Mexico, California&rsquo;s coast and Florida&rsquo;s Indian River Lagoon. Populations also reported in Atlantic off the coast of Brazil.</li>\n	<li>Found near coasts and in estuaries.</li>\n</ul>\n\n<h2>Conservation Status</h2>\n\n<ul>\n	<li>&ldquo;Not evaluated&rdquo; on the IUCN Red List.</li>\n</ul>\n\n<h2>Additional Information</h2>\n\n<ul>\n	<li>Also known as the &ldquo;Australian spotted jellyfish.&rdquo;</li>\n	<li>Invasive species around the U.S. coasts. Jellies feed on the zooplankton that native species rely on, disrupting the ecosystem. Jellies also take a toll on shrimp fisheries by clogging nets and damaging fishing equipment.</li>\n	<li>Appear to be introduced in non-native areas through ships; polyps may survive in tanks of large ships.</li>\n	<li>Typically travel in large groups called smacks.</li>\n</ul>\n'),
(31, 15, 'Physical Characteristics', '<p><strong>Size</strong></p>\n\n<ul>\n	<li>Common length of 18 feet (550 cm), with a maximum length of 23.9 feet (730 cm).</li>\n</ul>\n\n<p><strong>Body Composition</strong></p>\n\n<ul>\n	<li>Heavy, shark like body; very flat on ventral side.</li>\n	<li>Long, narrow rostrum is common to all sawfish. In this species, the &ldquo;saw&rdquo; is the longest of all, reaching a maximum length of 5.4 feet (164.5 cm).</li>\n	<li>Typically 25-34 rostal teeth (actually modified dermal dentricles) on either side of the saw.</li>\n</ul>\n\n<p><strong>Color</strong></p>\n\n<ul>\n	<li>Displays countershading; dark olive or grey on dorsal side and pale yellow or white underneath.</li>\n</ul>\n', '', '<p><strong>ANIMAL FACT</strong></p>\n\n<h3 style=\'color:blue;\'>The longcomb sawfish&rsquo;s &ldquo;saw&rdquo; can be as long as 5.4 feet (1.6 m).</h3>\n'),
(32, 15, 'Diet / Feeding', '<p><strong>Diet</strong></p>\n\n<ul>\n	<li>Diet consists primarily of slow schooling fishes, such as mullet.</li>\n</ul>\n\n<p><strong>Feeding</strong></p>\n\n<ul>\n	<li>Stuns prey by quick swipes of the saw.</li>\n	<li>Shellfish and crustaceans are also consumed; sawfish will use its saw to sweep these animals out of the sand.</li>\n</ul>\n', '', '<h2>Range / Habitat</h2>\n\n<p><strong>Range</strong></p>\n\n<ul>\n	<li>Occurs in the Indo-West Pacific, Australia and Papua New Guinea, eastern coast of Africa north to the Red Sea, as well as China and south to New South Wales.</li>\n</ul>\n\n<p><strong>Habitat</strong></p>\n\n<ul>\n	<li>Mainly bottom dwelling, found in shallow bays, lagoons and estuaries. Has been found at depths up to 131 feet (40 m), but 1 to 16 feet (1 to 5 m) seems to be most common.</li>\n</ul>\n\n<h2>Reproduction &amp; Growth</h2>\n\n<ul>\n	<li>It has been suggested (Grant, 1978) that adult males will use their saws in dominance and mating battles.</li>\n</ul>\n\n<h2>Conservation Status</h2>\n\n<ul>\n	<li>&ldquo;Critically Endangered&rdquo; on the IUCN Red List.</li>\n</ul>\n\n<h2>Additional Information</h2>\n\n<ul>\n	<li>Also known as the &ldquo;green&rdquo; sawfish and the &ldquo;narrowsnout&rdquo; sawfish.</li>\n	<li>Vulnerable to nets; both fishing and shark control nets surrounding beaches.</li>\n	<li>Predators include tiger and bull sharks, as well as freshwater crocodiles.</li>\n</ul>\n');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ep_sea_group`
--

CREATE TABLE `ep_sea_group` (
  `id` int(11) NOT NULL,
  `group_name` varchar(100) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `ep_sea_group`
--

INSERT INTO `ep_sea_group` (`id`, `group_name`, `parent_id`, `created`, `updated`, `status`) VALUES
(1, 'Fish species', -1, '2021-05-19 22:04:38', '2021-06-04 12:39:08', 1),
(2, 'Turtle', -1, '2021-05-19 22:06:11', '2021-06-14 20:34:10', 1),
(3, 'Cold sea species', -1, '2021-05-19 22:06:51', '2021-06-14 21:37:20', 1),
(30, 'Deep sea fish', 1, '2021-05-20 13:26:32', '0000-00-00 00:00:00', 1),
(60, 'Sea Turtle', 2, '2021-05-28 12:16:40', '2021-06-14 20:34:24', 1),
(31, 'Aquarium Fish', 1, '2021-06-14 21:01:31', '0000-00-00 00:00:00', 1),
(61, 'Penguin', 3, '2021-06-14 21:39:10', '0000-00-00 00:00:00', 1),
(62, 'Jellyfish', 1, '2021-06-14 21:43:49', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ep_users`
--

CREATE TABLE `ep_users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `group_id` tinyint(3) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `ep_users`
--

INSERT INTO `ep_users` (`id`, `username`, `password`, `email`, `name`, `created`, `group_id`, `status`) VALUES
(1, 'admin', '$2y$10$cJKDSb4tYyGzxDMLC3dX7ujGRX3ew4LwXhobP5DDxI.Q1dtM65gsC', 'admin@gmail.com', 'admin', '2021-06-14 16:10:22', 1, 1),
(2, 'manage1', '$2y$10$pmo/odDmH/Aq2gQdU2Om0OS.KU5PXW9KR5rJPB.7GnOWKmDQIIlyW', 'manage1@gmail.com', 'Manage1', '2021-06-14 16:14:20', 2, 1),
(3, 'manage', '$2y$10$VKYMKJLjdTnIjy1wTxtQ.e6VEhwPcLvJss7sfLAsR.E1aEBFeTla6', 'manage2@gmail.com', 'Manage2', '2021-06-14 16:14:48', 2, 1),
(4, 'manage3', '$2y$10$6NigOkIez7CB2HJiFSFWvO0m8CEK1o1SjJxhq9ikP.O8p/reEyrAW', 'manage@gmail.com', 'Manage3', '2021-06-14 16:15:06', 2, 1),
(5, 'manage4', '$2y$10$NlH3pxnolpn09bwSj5odVOgigUBbMwc9TofMg.YUMAkZVlbxkSI1S', 'manage4@gmail.com', 'Manage4', '2021-06-14 16:15:36', 2, 1),
(6, 'manage5', '$2y$10$m4lOv9jqMgG54MoAfcrTC.LwhdWqvCie9q7CeCk2bixvSE06LNmZu', 'manage@gmail.com', 'Manage5', '2021-06-14 16:16:11', 2, 1),
(7, 'Staff1', '$2y$10$A5De/cAg3LR8xbLkpN3t.eXeyJgCH.GwCnQOdXDnYmCgPO9GAP7cW', 'Staff1@gmail.com', 'Staff1', '2021-06-14 16:16:37', 3, 1),
(8, 'Staff2', '$2y$10$xWxH27A.et79QiD9z5h75OIVWbNDdLv/Wb6jKnjUv2aXIUpx1X8vu', 'Staff2@gmail.com', 'Staff2', '2021-06-14 16:16:58', 3, 1),
(9, 'Staff3', '$2y$10$/xUkluZuJUjDlbnO9/xfr.TA4dQ6HB7jkFhuoC/qyRa7Ps5aLyY6a', 'Staff3@gmail.com', 'Staff3', '2021-06-14 16:17:18', 3, 1),
(10, 'Staff4', '$2y$10$oDfbzjkZoOZZiz.h9DNE6OJKncApgOyYVvubxmFu16aha9RRit/ke', 'c4@gamil.com', 'Staff4', '2021-06-14 16:17:43', 3, 1),
(11, 'Staff5', '$2y$10$QUdb5RJA6mavQX7Hs34vo.zZOpdKWetg6alxb8xNFktyARAKTRWD.', 'Staff5@gmail.com', 'Staff5', '2021-06-14 16:18:06', 3, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ep_users_group`
--

CREATE TABLE `ep_users_group` (
  `id` tinyint(3) NOT NULL,
  `group_name` varchar(100) NOT NULL,
  `group_permission` tinyint(3) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `ep_users_group`
--

INSERT INTO `ep_users_group` (`id`, `group_name`, `group_permission`, `created`) VALUES
(1, 'Admin', 10, '2021-06-14 16:11:44'),
(2, 'Manager', 6, '2021-06-14 16:11:44'),
(3, 'Staff', 3, '2021-06-14 16:11:44');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `ep_contact`
--
ALTER TABLE `ep_contact`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ep_customer`
--
ALTER TABLE `ep_customer`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ep_event`
--
ALTER TABLE `ep_event`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ep_even_description`
--
ALTER TABLE `ep_even_description`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ep_feedback`
--
ALTER TABLE `ep_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ep_order`
--
ALTER TABLE `ep_order`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ep_order_detail`
--
ALTER TABLE `ep_order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ep_order_method`
--
ALTER TABLE `ep_order_method`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ep_sea_animal`
--
ALTER TABLE `ep_sea_animal`
  ADD PRIMARY KEY (`sea_id`);

--
-- Chỉ mục cho bảng `ep_sea_description`
--
ALTER TABLE `ep_sea_description`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ep_sea_group`
--
ALTER TABLE `ep_sea_group`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ep_users`
--
ALTER TABLE `ep_users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ep_users_group`
--
ALTER TABLE `ep_users_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `ep_contact`
--
ALTER TABLE `ep_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `ep_customer`
--
ALTER TABLE `ep_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `ep_event`
--
ALTER TABLE `ep_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `ep_even_description`
--
ALTER TABLE `ep_even_description`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `ep_feedback`
--
ALTER TABLE `ep_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `ep_order`
--
ALTER TABLE `ep_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT cho bảng `ep_order_detail`
--
ALTER TABLE `ep_order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT cho bảng `ep_order_method`
--
ALTER TABLE `ep_order_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `ep_sea_animal`
--
ALTER TABLE `ep_sea_animal`
  MODIFY `sea_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `ep_sea_description`
--
ALTER TABLE `ep_sea_description`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `ep_sea_group`
--
ALTER TABLE `ep_sea_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT cho bảng `ep_users`
--
ALTER TABLE `ep_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `ep_users_group`
--
ALTER TABLE `ep_users_group`
  MODIFY `id` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
