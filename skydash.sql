-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 27, 2021 at 11:37 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skydash`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
CREATE TABLE IF NOT EXISTS `banners` (
  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL,
  `banner_image` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`banner_id`, `status`, `banner_image`, `position`) VALUES
(21, 0, 'images/banners/banner_4.jpg', 8),
(20, 0, 'images/banners/banner_4.jpg', 8),
(19, 0, 'images/banners/banner_3.jpg', 66),
(18, 0, 'images/banners/banner_2.jpg', 6),
(17, 0, 'images/banners/banner_1.jpg', 155),
(16, 0, 'images/banners/838101a3055a4e8a800bb8b560587131.jpg', 15),
(22, 0, 'images/banners/banner_5.jpg', 8),
(23, 0, 'images/banners/banner_6.jpg', 8),
(24, 0, 'images/banners/banner_7.jpg', 89),
(25, 0, 'images/banners/banner_8.jpg', 899),
(26, 0, 'images/banners/banner_9.jpg', 855),
(27, 0, 'images/banners/banner_10.jpg', 855),
(28, 0, 'images/banners/banner_11.jpg', 855),
(29, 0, 'images/banners/banner_12.jpg', 855),
(30, 0, 'images/banners/e00cdd33572171690bff55691794726d.jpg', 855);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_image`) VALUES
(83, 'Electronics', 'images/img/202106112313.jpg'),
(82, 'Fashion', 'images/img/social-holding.jpg'),
(81, 'Mobile', 'images/img/73078527.jpg'),
(84, 'Computers', 'images/img/CleanClipping-Recovered-10.jpg'),
(85, 'Books', 'images/img/GettyImages-955854460.jpg'),
(86, 'Sports', 'images/img/84696161.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(50) NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country`) VALUES
(1, 'Russia'),
(2, 'Canada'),
(3, 'China'),
(4, 'United States'),
(5, 'Brazil'),
(6, 'India');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `country_id` varchar(50) NOT NULL,
  `state_id` varchar(50) NOT NULL,
  `zip` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `firstname`, `lastname`, `email`, `address`, `country_id`, `state_id`, `zip`, `product_id`, `product_name`, `product_image`, `quantity`, `price`, `total`) VALUES
(8, 'test', 'test', 'dshs@fghsdfh.dfhsd', 'hdf', '2', '16', 525525, 193, 'Large Print: Panchatantra Dosti ki Kahaniyan (Hindi) Hardcover â€“ 7 January 2011', 'images/products/51DDcCvycjL._SX409_BO1,204,203,200_.jpg', 1, 186, 186);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `sku` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=202 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`category_id`, `sub_category_id`, `product_id`, `product_name`, `description`, `sku`, `img`, `price`, `status`) VALUES
(85, 73, 191, 'Immortals of Meluha (The Shiva Trilogy Book 1) Kindle Edition', '1900 BC. In what modern Indians mistakenly call the Indus Valley Civilisation.\r\n\r\nThe inhabitants of that period called it the land of Meluha â€“ a near perfect empire created many centuries earlier by Lord Ram, one of the greatest monarchs that ever lived.\r\n\r\nThis once proud empire and its Suryavanshi rulers face severe perils as its primary river, the revered', '1', 'images/products/51JYiWwA5mL.jpg', 147, '1'),
(85, 74, 192, 'Gujarat No Itihas', 'Avail No Cost EMI on select cards for orders abov', '12', 'images/products/51wOX-jl1kL._SX353_BO1,204,203,200_.jpg', 150, '1'),
(85, 72, 193, 'Large Print: Panchatantra Dosti ki Kahaniyan (Hindi) Hardcover â€“ 7 January 2011', '&quot;The Panchatantra is a collection of ancient Indian fables.Many-a-times, the central characters area animals and birds, who show their most identifying characteristics in the various stories, and impart valuable life-lessons and morals. In this book, read a fine selection of six fascinating tales from Panchatantra. Read about the Jackal that turned Blue, the brave sparrows that punished an elephant, the mouse that became a girl and more!&quot;.', '13', 'images/products/51DDcCvycjL._SX409_BO1,204,203,200_.jpg', 186, '0'),
(84, 78, 194, 'HP Slim Tower Desktop PC (Intel Celeron J4025/4GB/1TB HDD/M.2 Slot/WiFi/Bluetooth/Win 10/Jet Black), S01-af1106in', 'Wireless Technologies: Realtek 802.11a/b/g/n/ac (1x1) Wi-Fi and Bluetooth 4.2 combo\r\nOperating System: Pre-loaded Windows 10 Home with lifetime validity\r\nProcessor: Intel Celeron J4025 (2.0 GHz base frequency, up to 2.9 GHz burst frequency, 4 MB L2 cache, 2 cores)\r\nMemory &amp; Storage: 4 GB DDR4-2400 SDRAM (1 x 4 GB) |1 TB HDD 7200 RPM', '25', 'images/products/41j81ScLP0L._AC_SR160,160_.jpg', 19500, '0'),
(84, 76, 195, 'Logitech MK295 Wireless Keyboard and Mouse Combo - SilentTouch Technology, Full Number Keyboard, Shortcut Buttons, Nano USB Receiver, 90% Less Noise - Black', 'SILENTTOUCH TECHNOLOGY: This Logitech MK295 wireless keyboard and mouse combo features advanced optical sensor and delivers the same typing and click experience with 90% less noise\r\nGREAT COMFORT: The keyboard features a full number layout and 8 shortcut buttons for easy navigation and information entry\r\nWIRELESS CONNECTIVITY: Order chaos on your desk thanks to the 2.4 GHz wireless connection without lags. The keyboard also comes with a 10m USB receiver\r\nINSTANT OPERATION: Simply plug them in to use the keyboard and mouse. Plus, they are compatible with Chrome OS and Windows on both your laptop and PC\r\nDURABLE DESIGN: This keyboard was built to withstand potential liquid spills, with a well-defined layout and durable keys. You can adjust its angle thanks to its adjustable stand', '2554', 'images/products/61bfUHrPdVL._AC_UY218_.jpg', 2345, '1'),
(84, 75, 196, 'BenQ GW2480 24-inch (60.5 cm) Eye Care Monitor, IPS Panel with VGA, HDMI, Audio in, Headphone Ports and in-Built Speakers, with Adaptive Brightness Technology - M353231 (Black)', 'Screen Size: 23.8 inch (60.4 cm) Full HD (1920 X 1080) Edge to Edge IPS Panel\r\nConnectivity Port: 1 VGA Port, 1 Display Port, 1 Audio-In Port, 1 Headphone Port, 2 Speakers (1 Watt each)\r\nAspect Ratio: 16:9, Brightness (Typical): 250 cd/mÂ²\r\nRefresh Rate: 60 Hz, Response Time: 5 ms\r\nViewing Angle: 178 degree horizontal 178 degree vertical\r\nFlicker Free Technology: Yes, Low Blue Light Technology: Yes\r\nVESA Wall Mount: 100x100 (mm)\r\nFor any product related queries', '525', 'images/products/71AecexVWZL._AC_UL320_.jpg', 10999, '1'),
(84, 77, 197, 'Logitech M221 Wireless Mouse, Silent Buttons, 2.4 GHz with USB Mini Receiver, 1000 DPI Optical Tracking, 18-Month Battery Life, Ambidextrous PC/Mac/Laptop - Charcoal Grey', 'Ultra-quiet mouse with 90% reduced click sound and same click feel eliminates noise and distractions for you and others around you\r\nComfortable mobile shape is small enough to toss in a bag and an ambidextrous design guides either hand into a natural position\r\nUSB Receiver is provided with the mouse and can be found in the small rectangular slot next to the battery compartment. Flip the mouse and slide the battery cover off to locate the receiver\r\nMouse automatically connects to your computer via a tiny wireless Receiver that Plugs into your computerâ€™s USB port\r\nReliable, long range wireless mouse works up to 33 feet away from your computer (Actual wireless range may vary based on use, settings, and environmental conditions)\r\n18-Month battery life and auto sleep help you go longer between battery changes (battery life may vary based on user and computing conditions)\r\nUltra-quiet mouse with 90% reduced click sound and same click feel eliminates noise and distractions for you and others around you', '5255', 'images/products/61sskFEsc0L._AC_UY218_.jpg', 825, '0'),
(83, 79, 198, 'Fujifilm X-T200 24.2 MP Mirrorless Camera with XC 15-45 mm Lens (APS-C Sensor, Electronic Viewfinder, 3.5&quot; Vari-Angle Touchscreen, Face/Eye AF, 4K Video Vlogging, Film Simulations) - Dark Silver', 'Large APS-C CMOS image sensor, Approx. 24.2megapixels, Copper-wiring structure for better performance, Hybrid phase and contrast detection auto focus\r\nHighly Accurate Face and Eye Detection Algorithm\r\nAchieve focus in dimly lit environments up to -2.0EV and get great image quality with low noise because of the advanced image processing provided by the cameraâ€™s copper wire processor.\r\nX-T200 is equipped with a vari-angle 3.5-inch/ 16:9 Aspect Ratio widescreen LCD touch-screen that can be opened and closed between 0 to 180 degrees and rotated between -90 to +180 degrees\r\nA Legacy in Color Science, Fujifilmâ€™s legacy in color science has given it legendary status among image-makers across the world.\r\nCreatively Express Yourself with Advanced Filters\r\nQuality 4K and Full HD video recording modes\r\nNEW HDR movie mode', '5151', 'images/products/1548234749_832_canon_eos-80d-24mp-dslr-camera.jpg', 54000, '0'),
(83, 80, 199, 'Marshall Major III Bluetooth Wireless On-Ear Headphones (Black)', 'Bluetooth aptX gives you the freedom and convenience of a wireless headphone, Major III Bluetooth features 40 mm dynamic drivers that are custom tuned for enhanced bass, smooth mids and clear highs\r\nMajor III Bluetooth keeps the music going strong with over 30 hours of wireless playtime on a single charge\r\nMajor III Bluetooth features custom-tuned 40 mm drivers that produce an enhanced listening experience\r\nMajor III Bluetooth features streamlined ear cushions, slim hinges, straight fit headband and thick loop wire with reinforced rubber dampers\r\nWith the multi-directional control knob you can play, pause, shuffle and adjust the volume of your device, as well as power your headphones on or off, phone functionality is also included so you can answer, reject or end a call with a few simple clicks\r\nCountry of Origin: China', '515158', 'images/products/1_6f1f0328-6ce7-4269-8fdf-4272e2ba01b3_800x.jpg', 5400, '0'),
(82, 81, 200, 'Peter England White Shirt', 'Care Instructions: Hand Wash Only\r\nFit Type: regular fit\r\nColor : White\r\nMaterial : 82% Polyester and 18% Viscose\r\nFit : Comfort Fit', '544', 'images/products/41wj-c1z9nL._AC_SR160,200_.jpg', 890, '0'),
(86, 84, 201, 'Bat', '', '545', 'images/products/cricket_ap_117.jpg', 2500, '0');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
CREATE TABLE IF NOT EXISTS `state` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `state` varchar(50) NOT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `country_id`, `state`) VALUES
(1, 1, 'Adygey'),
(2, 1, 'Altai'),
(3, 1, 'Bashkortostan'),
(4, 1, 'Buryat'),
(5, 1, 'Chechnya'),
(6, 1, 'Chuvash'),
(7, 1, 'Kalmykia'),
(8, 1, 'Tuva'),
(9, 1, 'Mordovia'),
(10, 1, 'Sakha'),
(11, 1, 'Tatarstan'),
(12, 2, 'Alberta'),
(13, 2, 'British Columbia'),
(14, 2, 'Manitoba'),
(15, 2, 'New Brunswick'),
(16, 2, 'Newfoundland and Labrador'),
(17, 2, 'Northwest Territories'),
(18, 2, 'Nova Scotia'),
(19, 2, 'Nunavut'),
(20, 2, 'Ontario'),
(21, 2, 'Quebec'),
(22, 2, 'Saskatchewan'),
(23, 3, 'Anhui'),
(24, 3, 'Fujian'),
(25, 3, 'Guangdong'),
(26, 3, 'Guizhou'),
(27, 3, 'Hainan'),
(28, 3, 'Hebei'),
(29, 3, 'Henan'),
(30, 3, 'Hubei'),
(31, 3, 'Hunan'),
(32, 3, 'Gansu'),
(33, 3, 'Jiangxi'),
(34, 4, 'Alabama'),
(35, 4, 'Alaska'),
(36, 4, 'Arizona'),
(37, 4, 'Washington'),
(38, 4, 'Missouri'),
(39, 4, 'Georgia'),
(40, 4, 'Florida'),
(41, 4, 'Virginia'),
(42, 4, 'Vermont'),
(43, 4, 'Texas'),
(44, 4, 'New York'),
(45, 5, 'Acre'),
(46, 5, 'Alagoas'),
(47, 5, 'Amazonas'),
(48, 5, 'Bahia'),
(49, 5, 'Pernambuco'),
(50, 5, 'Sergipe'),
(51, 5, 'Tocantins'),
(52, 5, 'Roraima'),
(53, 5, 'Rio de Janeiro'),
(54, 5, 'Rio Grande do Norte'),
(55, 5, 'Mato Grosso'),
(56, 6, 'Assam'),
(57, 6, 'Bihar'),
(58, 6, 'Chhattisgarh'),
(59, 6, 'Goa'),
(60, 6, 'Gujarat'),
(61, 6, 'Haryana'),
(62, 6, 'Uttar Pradesh'),
(63, 6, 'Chandigarh'),
(64, 6, 'Delhi'),
(65, 6, 'Tripura'),
(66, 6, 'Maharashtra');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

DROP TABLE IF EXISTS `sub_category`;
CREATE TABLE IF NOT EXISTS `sub_category` (
  `sub_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` varchar(255) NOT NULL,
  `sub_category_name` varchar(255) NOT NULL,
  `sub_category_image` varchar(255) NOT NULL,
  PRIMARY KEY (`sub_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`sub_category_id`, `category_id`, `sub_category_name`, `sub_category_image`) VALUES
(75, '84', 'Monitor', 'images/sub_img/05R7ApclhnnV0xTx4drU4BE-1.1617290389.fit_lpad.size_625x365.jpg'),
(74, '85', 'Gujarati', 'images/sub_img/GettyImages-955854460.jpg'),
(73, '85', 'English', 'images/sub_img/GettyImages-955854460.jpg'),
(72, '85', 'Hindi', 'images/sub_img/750-X-375-Deals.jpg'),
(76, '84', 'Keyboard', 'images/sub_img/1593240433285_0.jpg'),
(77, '84', 'Mouse', 'images/sub_img/e8384959-ad1a-1b95-762b-2861496b886e.jpg'),
(78, '84', 'CPU', 'images/sub_img/brand-new-cpu-sealed-pack-500x500.jpg'),
(79, '83', 'Camera', 'images/sub_img/1548234749_832_canon_eos-80d-24mp-dslr-camera.jpg'),
(80, '83', 'Headphones', 'images/sub_img/1_6f1f0328-6ce7-4269-8fdf-4272e2ba01b3_800x.jpg'),
(81, '82', 'Clothing', 'images/sub_img/Cleaning_Cloth_Blog.jpg'),
(82, '82', 'Shoe', 'images/sub_img/41Leu3gBUFL.jpg'),
(83, '82', 'Sandal', 'images/sub_img/download.jpg'),
(84, '86', 'Cricket', 'images/sub_img/cricket_ap_117.jpg'),
(85, '86', 'Football', 'images/sub_img/1c5b1aa3386eeb2c21d633f04e2ddfbe.jpg'),
(86, '86', 'Basketball', 'images/sub_img/unnamed.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `country` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `country`, `password`) VALUES
(1, 'test', 'test@test.com', 'IN', '$2y$10$k4ohw20D9BUL7Omc0sNHFeOOrGl//SLcLxdBtHz4LkftkEUuBoyCi');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(12, '', 'test@test.com', '$2y$10$dkiDoHttF/1xMAgnAYikDOmc2e5g4iGzYKo9C6RnUjlLyAUHP8SQS');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
