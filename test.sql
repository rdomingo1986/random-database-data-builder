-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 29-12-2017 a las 16:22:08
-- Versión del servidor: 5.7.17-log
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `globaltech_jobs`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client_type`
--

CREATE TABLE `client_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `client_type`
--

INSERT INTO `client_type` (`id`, `name`) VALUES
(1, 'VIP'),
(2, 'Regular'),
(3, 'In Process');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `person`
--

CREATE TABLE `person` (
  `id` int(11) NOT NULL,
  `clienttype_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('male','female') COLLATE utf8_unicode_ci NOT NULL,
  `age` tinyint(4) NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `person`
--

INSERT INTO `person` (`id`, `clienttype_id`, `name`, `last_name`, `gender`, `age`, `address`, `phone`, `created_at`) VALUES
(1, 2, 'Caitlin\r\n', 'Jenkins\r\n', 'male', 20, '', '1159110991', '2018-03-23 09:56:42'),
(2, 2, 'Matt\r\n', 'Grant\r\n', 'male', 62, '623 Deerfield St. Ridgefield, Ct 06877\r\n', '1299163038', '2018-08-13 16:45:50'),
(3, 1, 'Logan\r\n', 'Allen\r\n', 'male', 66, '', '1307465579', '2018-03-19 18:40:11'),
(4, 2, 'Jesse\r\n', 'Perez\r\n', 'male', 26, '692 Franklin Court Victorville, Ca 92392\r\n', '1398202255', '2018-07-24 11:46:57'),
(5, 1, 'Maddie\r\n', 'West\r\n', 'male', 23, '334 Rockledge Ave. Huntington Beach, Ca 92646\r\n', '1002755840', '2018-07-04 16:34:34'),
(6, 2, 'Miranda\r\n', 'Medina\r\n', 'male', 64, '211 Thorne Ave. Lynwood, Ca 90262\r\n', '1299336722', '2018-04-23 19:39:58'),
(7, 3, 'Alyssa\r\n', 'Collins\r\n', 'female', 38, '8772 South Swanson Ave. Raeford, Nc 28376\r\n', '1139167753', '2018-09-17 13:19:51'),
(8, 1, 'Vanessa\r\n', 'Kelley\r\n', 'male', 29, '4 Poplar Ave. Hoffman Estates, Il 60169\r\n', '1180734462', '2018-04-10 01:54:36'),
(9, 3, 'Mackenzie\r\n', 'Henry\r\n', 'female', 52, '', '1312009801', '2018-08-25 04:12:33'),
(10, 1, 'Chase\r\n', 'White\r\n', 'female', 27, '94 St Louis Street Rosemead, Ca 91770\r\n', '1378021141', '2018-11-25 13:01:24'),
(11, 2, 'Isaac\r\n', 'Powell\r\n', 'male', 62, '5306 Walnut Ave., Building A, Sacramento, Ca 95841\r\n', '1223748987', '2018-02-13 01:32:42'),
(12, 3, 'Rachel\r\n', 'Webb\r\n', 'male', 25, '833 High Point Drive San Jose, Ca 95127\r\n', '1362642079', '2018-05-12 00:39:17'),
(13, 2, 'Brandon\r\n', 'Richardson\r\n', 'male', 24, '12 Bohemia Drive San Jose, Ca 95111\r\n', '1355459678', '2018-05-11 12:05:43'),
(14, 1, 'Michael\r\n', 'Thomas\r\n', 'male', 57, '', '1379580892', '2018-02-02 02:01:24'),
(15, 1, 'Christopher\r\n', 'Hayes\r\n', 'male', 34, '9 Colonial Court San Carlos, Ca 94070\r\n', '1230833365', '2018-12-18 23:31:24'),
(16, 1, 'Joshua\r\n', 'Lewis\r\n', 'male', 68, '', '1003552110', '2018-06-09 08:49:55'),
(17, 2, 'Samantha\r\n', 'Smith\r\n', 'female', 53, '', '1211776626', '2018-02-01 01:13:42'),
(18, 1, 'Tyler\r\n', 'Ferguson\r\n', 'female', 31, '', '1143167151', '2018-06-29 04:14:33'),
(19, 1, 'Jennifer\r\n', 'Rodriguez\r\n', 'female', 38, '25 Rockcrest St. Orland Park, Il 60462\r\n', '1133669107', '2018-12-12 11:06:35'),
(20, 1, 'Rachel\r\n', 'Gardner\r\n', 'male', 43, '', '1188893743', '2018-07-01 07:55:54'),
(21, 2, 'Mia\r\n', 'Clark\r\n', 'female', 43, '552 La Sierra Rd. Naugatuck, Ct 06770\r\n', '1377710736', '2018-10-16 22:49:42'),
(22, 3, 'Brianna\r\n', 'Freeman\r\n', 'female', 66, '', '1259866355', '2018-11-23 22:42:54'),
(23, 2, 'Samuel\r\n', 'Cook\r\n', 'female', 18, '7570 Fairground Street Tampa, Fl 33604\r\n', '1223881742', '2018-09-30 19:24:25'),
(24, 2, 'Ashley\r\n', 'Ford\r\n', 'female', 32, '1350 Red Rock Street, Las Vegas, Nv 89146\r\n', '1332038476', '2018-08-31 19:57:30'),
(25, 2, 'Maddie\r\n', 'Holmes\r\n', 'male', 47, '419 Arnold Drive Middleton, Wi 53562\r\n', '1028237522', '2018-05-07 04:00:48'),
(26, 3, 'Christopher\r\n', 'Mendoza\r\n', 'male', 47, '7280 N. Caldwell Avenue, Niles, Il 60714\r\n', '1134380344', '2018-07-19 14:24:34'),
(27, 2, 'Erin\r\n', 'Thompson\r\n', 'male', 31, '', '1389030637', '2018-05-22 18:56:04'),
(28, 2, 'Brianna\r\n', 'Stone\r\n', 'female', 51, '48 Sutor Drive San Jose, Ca 95112\r\n', '1238483919', '2018-05-07 20:16:41'),
(29, 2, 'Carlos\r\n', 'Gonzalez\r\n', 'male', 40, '', '1298701787', '2018-12-10 02:41:46'),
(30, 1, 'Michelle\r\n', 'Roberts\r\n', 'female', 66, '', '1090732589', '2018-07-10 11:39:41'),
(31, 1, 'Austin\r\n', 'Holmes\r\n', 'female', 36, '1907 Spruce Street, Philadelphia, Pa 19103-5732\r\n', '1108563306', '2018-10-17 15:00:12'),
(32, 2, 'Kevin\r\n', 'Marshall\r\n', 'female', 45, '7 Bayberry Street Los Angeles, Ca 90066\r\n', '1036254848', '2018-07-08 06:06:25'),
(33, 1, 'Gabriel\r\n', 'Black\r\n', 'male', 65, '', '1115192052', '2018-10-14 20:54:50'),
(34, 2, 'Nicole\r\n', 'Collins\r\n', 'female', 69, '', '1074827950', '2018-09-22 15:11:56'),
(35, 2, 'Brendan\r\n', 'Long\r\n', 'female', 19, '', '1378059386', '2018-03-28 08:56:28'),
(36, 2, 'Vanessa\r\n', 'Dunn\r\n', 'male', 67, '9286 North Yukon Court Camden, Nj 08105\r\n', '1278554241', '2018-05-08 10:41:13'),
(37, 1, 'Kelsey\r\n', 'Mitchell\r\n', 'male', 50, '', '1104701128', '2018-09-20 13:52:52'),
(38, 1, 'Luis\r\n', 'Adams\r\n', 'female', 58, '828 W. Thompson Drive North Hills, Ca 91343\r\n', '1140951423', '2018-09-08 19:25:21'),
(39, 2, 'Ben\r\n', 'Torres\r\n', 'male', 43, '', '1401485600', '2018-07-06 08:44:46'),
(40, 1, 'Grace\r\n', 'Cook\r\n', 'male', 46, '970 Hawthorne Street San Marcos, Ca 92069\r\n', '1026362354', '2018-02-04 12:19:44'),
(41, 3, 'Christina\r\n', 'Ryan\r\n', 'female', 54, '7 Swanson St. Long Beach, Ca 90813\r\n', '1063715291', '2018-11-15 23:01:22'),
(42, 3, 'Sara\r\n', 'Boyd\r\n', 'male', 20, '', '1268385353', '2018-05-19 22:36:28'),
(43, 3, 'Kayla\r\n', 'Chavez\r\n', 'female', 56, '1350 Red Rock Street, Las Vegas, Nv 89146\r\n', '1229894660', '2018-02-24 16:50:31'),
(44, 3, 'Kate\r\n', 'Myers\r\n', 'female', 48, '', '1201767925', '2018-01-20 20:43:32'),
(45, 1, 'Mark\r\n', 'Palmer\r\n', 'female', 57, '', '1298041740', '2018-01-14 17:20:50'),
(46, 3, 'Mackenzie\r\n', 'Allen\r\n', 'female', 24, '30 Marvon Avenue Davis, Ca 95616\r\n', '1209865405', '2018-10-16 11:31:57'),
(47, 1, 'Zachary\r\n', 'Wood\r\n', 'male', 58, '', '1144174869', '2018-09-13 01:55:03'),
(48, 2, 'Aidan\r\n', 'Snyder\r\n', 'female', 65, '', '1164350225', '2018-06-07 20:11:23'),
(49, 1, 'Kaylee\r\n', 'Ryan\r\n', 'female', 55, '8176 Van Dyke St. Eugene, Or 97402\r\n', '1187840726', '2018-08-31 11:58:40'),
(50, 3, 'Brian\r\n', 'Spencer\r\n', 'female', 50, '', '1184569182', '2018-05-26 17:35:40'),
(51, 1, 'Heather\r\n', 'Robertson\r\n', 'male', 57, '', '1323959225', '2018-06-28 10:27:00'),
(52, 1, 'Jake\r\n', 'Diaz\r\n', 'male', 46, '108 Wood Street Los Angeles, Ca 90042\r\n', '1050718205', '2018-10-05 20:00:08'),
(53, 2, 'Thomas\r\n', 'Nguyen\r\n', 'female', 41, '', '1135562602', '2018-11-13 23:44:19'),
(54, 1, 'Abby\r\n', 'Phillips\r\n', 'male', 48, '', '1010985324', '2018-12-13 00:17:44'),
(55, 2, 'Faith\r\n', 'Peterson\r\n', 'female', 33, '8800 West Pin Oak Rd. San Francisco, Ca 94112\r\n', '1362290624', '2018-05-19 13:13:57'),
(56, 2, 'Samantha\r\n', 'Webb\r\n', 'female', 52, '9658 Brickyard Street Chesterton, In 46304\r\n', '1033902201', '2018-10-20 14:35:18'),
(57, 3, 'Caroline\r\n', 'Adams\r\n', 'female', 42, '8457 Piper St. Palm Beach Gardens, Fl 33410\r\n', '1087448837', '2018-07-27 04:04:22'),
(58, 2, 'Andrea\r\n', 'Henderson\r\n', 'male', 25, '', '1142941019', '2018-07-07 20:26:02'),
(59, 2, 'Emily\r\n', 'Gray\r\n', 'female', 22, '', '1054737282', '2018-04-23 19:09:32'),
(60, 1, 'Austin\r\n', 'Harrison\r\n', 'male', 68, '', '1298906570', '2018-04-04 17:48:41'),
(61, 2, 'Laura\r\n', 'Hart\r\n', 'female', 51, '', '1364171008', '2018-01-05 11:11:08'),
(62, 1, 'Courtney\r\n', 'Edwards\r\n', 'female', 38, '8081 East Miller Street Hernando, Ms 38632\r\n', '1341232501', '2018-06-25 03:44:11'),
(63, 2, 'Abigail\r\n', 'Dixon\r\n', 'female', 30, '', '1195588084', '2018-09-26 23:38:19'),
(64, 2, 'Audrey\r\n', 'Baker\r\n', 'male', 30, '', '1062017834', '2018-02-28 07:29:12'),
(65, 3, 'Christina\r\n', 'Cunningham\r\n', 'female', 21, '', '1018998646', '2018-11-20 14:49:29'),
(66, 1, 'Hannah\r\n', 'Stone\r\n', 'female', 48, '', '1011576500', '2018-02-18 13:39:01'),
(67, 1, 'Andrea\r\n', 'Diaz\r\n', 'female', 61, '8099 Saxton Street Elgin, Il 60120\r\n', '1202382986', '2018-11-04 14:46:35'),
(68, 2, 'Erin\r\n', 'Green\r\n', 'female', 66, '', '1298939045', '2018-06-19 15:45:42'),
(69, 3, 'Alexander\r\n', 'Hicks\r\n', 'female', 37, '', '1179864054', '2018-07-30 20:46:01'),
(70, 2, 'Brittany\r\n', 'Gonzales\r\n', 'male', 37, '', '1057764191', '2018-11-17 18:38:16'),
(71, 3, 'Alexa\r\n', 'Bradley', 'male', 62, '68 Southampton St. Lockport, Ny 14094\r\n', '1271913578', '2018-07-18 10:22:47'),
(72, 3, 'Jared\r\n', 'Mendoza\r\n', 'male', 39, '8723 West Mammoth St. Merced, Ca 95340\r\n', '1074382620', '2018-06-01 18:16:38'),
(73, 1, 'Morgan\r\n', 'Sanders\r\n', 'male', 63, '833 High Point Drive San Jose, Ca 95127\r\n', '1283085118', '2018-09-03 20:07:44'),
(74, 2, 'Tanner\r\n', 'Barnes\r\n', 'female', 45, '610 Cleveland Lane San Diego, Ca 92114\r\n', '1396133182', '2018-01-07 06:40:34'),
(75, 1, 'Daniel\r\n', 'Jackson\r\n', 'male', 26, '', '1205143453', '2018-04-10 06:30:06'),
(76, 1, 'Lauren\r\n', 'Rogers\r\n', 'female', 60, '', '1253701679', '2018-05-12 12:30:13'),
(77, 2, 'Courtney\r\n', 'Walker\r\n', 'male', 44, '78 Columbia Dr. Lancaster, Ca 93535\r\n', '1192293006', '2018-10-31 12:00:31'),
(78, 2, 'Andrea\r\n', 'Rogers\r\n', 'male', 37, '', '1101410006', '2018-04-29 16:03:16'),
(79, 3, 'Sara\r\n', 'Warren\r\n', 'male', 51, '587 E. Clay Street East Elmhurst, Ny 11369\r\n', '1162408097', '2018-03-25 23:30:44'),
(80, 1, 'Elijah\r\n', 'Castro\r\n', 'male', 33, '1907 Spruce Street, Philadelphia, Pa 19103-5732\r\n', '1313981966', '2018-11-21 14:56:30');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `client_type`
--
ALTER TABLE `client_type`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `client_type`
--
ALTER TABLE `client_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;