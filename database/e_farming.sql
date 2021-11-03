-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 03, 2021 at 02:59 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_farming`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `blog_id` varchar(200) NOT NULL,
  `blog_blog_category_id` varchar(200) NOT NULL,
  `blog_image_1` longtext DEFAULT NULL,
  `blog_video_url_1` longtext DEFAULT NULL,
  `blog_details` longtext DEFAULT NULL,
  `blog_date_published` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `blog_published_by` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`blog_id`, `blog_blog_category_id`, `blog_image_1`, `blog_video_url_1`, `blog_details`, `blog_date_published`, `blog_published_by`) VALUES
('1a785046d32492246c3c532f9cb5b5345342b0f64f', '31a207d1f7fea664c5d64d153e25fdab7dd25499d4', NULL, NULL, '<p>Updated - Chopping the beef into small pieces first means everything cooks through in about five minutes. Chopping the beef into small pieces first means everything cooks through in about five minutes. Chopping the beef into small pieces first means everything cooks through in about five minutes. Chopping the beef into small pieces first means everything cooks through in about five minutes. Chopping the beef into small pieces first means everything cooks through in about five minutes. Chopping the beef into small pieces first means everything cooks through in about five minutes. Chopping the beef into small pieces first means everything cooks through in about five minutes. Chopping the beef into small pieces first means everything cooks through in about five minutes. Chopping the beef into small pieces first means everything cooks through in about five minutes. Chopping the beef into small pieces first means everything cooks through in about five minutes. Chopping the beef into small pieces first means everything cooks through in about five minutes. Chopping the beef into small pieces first means everything cooks through in about five minutes. Chopping the beef into small pieces first means everything cooks through in about five minutes. Chopping the beef into small pieces first means everything cooks through in about five minutes. Chopping the beef into small pieces first means everything cooks through in about five minutes.&nbsp; <br></p>', '2021-10-30 12:42:49', '223872e7bb07a6c1b6beeee008c129ed912ef87704'),
('39c4000bcc760b22e0557a9848b1ecfe40661ee15d', '965fc3984045864d621dea0ebba6b4337b68206d1f', 'PAO.webp', 'https://youtube.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.<br>', '2021-10-30 13:24:00', '223872e7bb07a6c1b6beeee008c129ed912ef87704'),
('4ff6f05a9e7299fc6f728f64686efafdb86d05df50', '31a207d1f7fea664c5d64d153e25fdab7dd25499d4', NULL, NULL, '<p>We go the extra mile to bring you vegetables which are tasty and fresh to create healthy meals for you and your family. Browse our range of veg which includes floury potatoes for roasting or mashing, crunchy cabbage, sweet butternut squash and leafy green curly kale.We go the extra mile to bring you vegetables which are tasty and fresh to create healthy meals for you and your family. Browse our range of veg which includes floury potatoes for roasting or mashing, crunchy cabbage, sweet butternut squash and leafy green curly kale.We go the extra mile to bring you vegetables which are tasty and fresh to create healthy meals for you and your family. Browse our range of veg which includes floury potatoes for roasting or mashing, crunchy cabbage, sweet butternut squash and leafy green curly kale.We go the extra mile to bring you vegetables which are tasty and fresh to create healthy meals for you and your family. Browse our range of veg which includes floury potatoes for roasting or mashing, crunchy cabbage, sweet butternut squash and leafy green curly kale.We go the extra mile to bring you vegetables which are tasty and fresh to create healthy meals for you and your family. Browse our range of veg which includes floury potatoes for roasting or mashing, crunchy cabbage, sweet butternut squash and leafy green curly kale.<br></p>', '2021-10-30 13:25:20', '223872e7bb07a6c1b6beeee008c129ed912ef87704'),
('bf721a5e958ddf22123cd653e2fdad93a73a4f70b4', 'e9d372a2aadac8a456d7acce42ea8d12b425122ee8', NULL, NULL, '<blockquote class=\"page-generator__lorem\" id=\"output\">Lorem ipsum dolor \r\nsit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt \r\nut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud \r\nexercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. \r\nDuis aute irure dolor in reprehenderit in voluptate velit esse cillum \r\ndolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non \r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.</blockquote>', '2021-11-02 15:57:26', '223872e7bb07a6c1b6beeee008c129ed912ef87704');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `blog_category_id` varchar(200) NOT NULL,
  `blog_category_name` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`blog_category_id`, `blog_category_name`) VALUES
('31a207d1f7fea664c5d64d153e25fdab7dd25499d4', 'Agri-Tech'),
('965fc3984045864d621dea0ebba6b4337b68206d1f', 'Chronic Animal Ailments'),
('e9d372a2aadac8a456d7acce42ea8d12b425122ee8', 'Farm Equipments & Tools');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` varchar(200) NOT NULL,
  `cart_user_id` varchar(200) NOT NULL,
  `cart_product_id` varchar(200) NOT NULL,
  `cart_product_quantity` varchar(200) DEFAULT NULL,
  `cart_checkout_status` varchar(200) DEFAULT 'Pending',
  `cart_shipping_status` varchar(200) DEFAULT NULL,
  `cart_product_added_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `cart_user_id`, `cart_product_id`, `cart_product_quantity`, `cart_checkout_status`, `cart_shipping_status`, `cart_product_added_at`) VALUES
('09ea6e89292dad8dbc94a86b0dd8956aece22507fc', '29e3f0093bd551ecf79951128cf6932d358dac587a', '04f807438e16eb6c716983d4b75cc34ba0ad3455b4', '1', 'Paid', 'Delivered', '2021-11-03 13:52:22'),
('12204de0c15b40b023d782b4bf33eda4d7daa6ae99', '230c02d2426cb052304cb43a27f6d3793b1a2e1cf5', '87ec06d784a3c9fbcd0f1ec588299db0d55e39e1de', '2', 'Paid', '', '2021-10-31 18:14:39'),
('17a0ccb49f65d1d87a19b8563b5fb51cf993f83e20', '230c02d2426cb052304cb43a27f6d3793b1a2e1cf5', '87ec06d784a3c9fbcd0f1ec588299db0d55e39e1de', '3', 'Paid', '', '2021-11-02 07:53:52'),
('5635599e16840708e4ec2b3d5a8f7169a85ff1ff0d', '1da9220c6484d1931c07a281a455a0e3eb14f219f5', '87ec06d784a3c9fbcd0f1ec588299db0d55e39e1de', '3', 'Paid', 'Delivered', '2021-11-03 13:57:25'),
('658ffe7db25c4384010e1e38d8202be3c11c175924', '230c02d2426cb052304cb43a27f6d3793b1a2e1cf5', '18a4e778f80feb72c5ff925daa17cb367331e72637', '1', 'Paid', '', '2021-11-02 07:51:55'),
('67608176479aa47269941eb2eeed5ae095009feaea', '29e3f0093bd551ecf79951128cf6932d358dac587a', '3e377cac6b4bd2dba6747c941f626da3173b84c34b', '1', 'Paid', 'Delivered', '2021-11-03 13:54:53'),
('685588c6f80212e3585b2f0612046d94b0c9532e3c', '1da9220c6484d1931c07a281a455a0e3eb14f219f5', '18a4e778f80feb72c5ff925daa17cb367331e72637', '1', 'Paid', 'Delivered', '2021-11-03 13:34:55'),
('82cc858f96a8e3820ced8a4d7f85c3f150db3eb933', '230c02d2426cb052304cb43a27f6d3793b1a2e1cf5', '87ec06d784a3c9fbcd0f1ec588299db0d55e39e1de', '3', 'Paid', '', '2021-10-29 13:03:56'),
('9ca66485c8dda52c9061302a8e18628409c9d753f0', '230c02d2426cb052304cb43a27f6d3793b1a2e1cf5', '18a4e778f80feb72c5ff925daa17cb367331e72637', '2', 'Paid', '', '2021-10-31 18:26:01'),
('ae740e5094ed3b55b075aa82b8a8c5dcdefa4ca632', '29e3f0093bd551ecf79951128cf6932d358dac587a', '18a4e778f80feb72c5ff925daa17cb367331e72637', '2', 'Paid', '', '2021-10-31 18:47:59'),
('b689ae31a4c0dcf940d8666ee2b343deb95b5844b8', '1da9220c6484d1931c07a281a455a0e3eb14f219f5', '3e377cac6b4bd2dba6747c941f626da3173b84c34b', '2', 'Paid', '', '2021-11-02 15:35:30'),
('e67edfbedc6747895f8b713fd7e6c0069ec36b56a5', '230c02d2426cb052304cb43a27f6d3793b1a2e1cf5', '87ec06d784a3c9fbcd0f1ec588299db0d55e39e1de', '10', 'Paid', '', '2021-10-28 14:02:20'),
('e86b83e024c39fb870e121150b240cc7505737d819', '230c02d2426cb052304cb43a27f6d3793b1a2e1cf5', '3e377cac6b4bd2dba6747c941f626da3173b84c34b', '3', 'Paid', '', '2021-10-28 14:01:43');

-- --------------------------------------------------------

--
-- Table structure for table `mailer_setttings`
--

CREATE TABLE `mailer_setttings` (
  `mailer_host` varchar(200) NOT NULL,
  `mailer_username` varchar(200) NOT NULL,
  `mailer_from_email` varchar(200) NOT NULL,
  `mailer_password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mailer_setttings`
--

INSERT INTO `mailer_setttings` (`mailer_host`, `mailer_username`, `mailer_from_email`, `mailer_password`) VALUES
('smtp.gmail.com', 'martdevelopers254@gmail.com', 'sandbox@martdev.info', '0704031263');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` varchar(200) NOT NULL,
  `payment_cart_id` varchar(200) NOT NULL,
  `payment_transaction_code` varchar(200) DEFAULT NULL,
  `payment_amount` varchar(200) DEFAULT NULL,
  `payment_date_posted` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_cart_id`, `payment_transaction_code`, `payment_amount`, `payment_date_posted`) VALUES
('16a1dfe667cceb4fb07db73032dbd07c8e313cbb48', 'b689ae31a4c0dcf940d8666ee2b343deb95b5844b8', '90IT25TFGE', '400', '2021-11-02 15:35:29'),
('4928762faf8af8eed0b274668c576e3b52ab447e28', '658ffe7db25c4384010e1e38d8202be3c11c175924', 'TGF7831231', '100', '2021-11-02 07:51:55'),
('4ccd5ca6b2d3a705be459ce096ac4086a2f7074d55', '67608176479aa47269941eb2eeed5ae095009feaea', '90IT25TFGE', '200', '2021-11-03 12:58:23'),
('586289fbbe82cb92d069cbf04884ed76bdd0a8c3e5', '5635599e16840708e4ec2b3d5a8f7169a85ff1ff0d', '900900TGTF', '600', '2021-11-03 13:56:05'),
('58dbfa9dd4363c4b469bc8c5e0ac1db22e7b13acbc', 'e86b83e024c39fb870e121150b240cc7505737d819', 'JABIQ03G9N', '600', '2021-10-28 14:01:43'),
('7b5cfba81b72c6266a2240b8451b7ba645a7c258bf', '685588c6f80212e3585b2f0612046d94b0c9532e3c', 'U6QVY3M4OG', '100', '2021-11-03 13:17:02'),
('80902106a0fb45515d71f8f1ef0a96969bc99bdd71', '12204de0c15b40b023d782b4bf33eda4d7daa6ae99', 'JEZLV54IS6', '400', '2021-10-31 18:14:39'),
('828958a1c385313bd45fa5e61b2dc0f99f132b8916', '82cc858f96a8e3820ced8a4d7f85c3f150db3eb933', 'YGXOQBJ9NZ', '600', '2021-10-29 13:03:56'),
('871e5a1fe9b92282fb4d0e2500b72806721802f403', '17a0ccb49f65d1d87a19b8563b5fb51cf993f83e20', '90125TFGEE', '600', '2021-11-02 07:53:51'),
('9ae57563f44793d211d7e9fcfe6b1fcb30d909daf5', '09ea6e89292dad8dbc94a86b0dd8956aece22507fc', 'EAQG2YSK1U', '100', '2021-11-03 13:49:08'),
('9d2970aa545ff8dad5394b4ef94c253b19e8304f76', 'ae740e5094ed3b55b075aa82b8a8c5dcdefa4ca632', '6EDUIKPOAM', '200', '2021-10-31 18:47:59'),
('de4e9328e53bab43e592a283eb8fe46e3228366ab8', 'e67edfbedc6747895f8b713fd7e6c0069ec36b56a5', 'M06PX3QGYL', '2000', '2021-10-28 14:02:19'),
('e20b0867e6ae18e8d80e29d57e2cd21eca6b7f345c', '9ca66485c8dda52c9061302a8e18628409c9d753f0', '4TVY073O6P', '200', '2021-10-31 18:26:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` varchar(200) NOT NULL,
  `product_sku_code` varchar(200) DEFAULT NULL,
  `product_user_id` varchar(200) NOT NULL,
  `product_category_id` varchar(200) NOT NULL,
  `product_name` longtext DEFAULT NULL,
  `product_image_1` longtext DEFAULT NULL,
  `product_image_2` longtext DEFAULT NULL,
  `product_image_3` longtext DEFAULT NULL,
  `product_price` varchar(200) DEFAULT NULL,
  `product_quantity` varchar(200) DEFAULT NULL,
  `product_details` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_sku_code`, `product_user_id`, `product_category_id`, `product_name`, `product_image_1`, `product_image_2`, `product_image_3`, `product_price`, `product_quantity`, `product_details`) VALUES
('04f807438e16eb6c716983d4b75cc34ba0ad3455b4', 'YQPFC76138', '0314047b42eb00a4dc9a660b07148c086af393cf3c', 'e52b15f2eb486da132b68da6b037b87ed10d80a656', 'Cabbage', NULL, NULL, NULL, '100', '99', '    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
('18a4e778f80feb72c5ff925daa17cb367331e72637', 'PTOMR12485', '6950c7223925e97d0c1226ac0ec2e6efceb4659623', 'de1e396cea15deb1cd924d8bd0d0061a60fbb69c26', 'Carrots', 'DWA.jpg', 'JMO.webp', 'MFS.webp', '100', '91', 'A pumpkin is a cultivar of winter squash that is round with smooth, slightly ribbed skin, and is most often deep yellow to orange in coloration.[1] The thick shell contains the seeds and pulp. The name is most commonly used for cultivars of Cucurbita pepo, but some cultivars of Cucurbita maxima, C. argyrosperma, and C. moschata with similar appearance are also sometimes called \"pumpkins\".[1]\r\n\r\nNative to North America (northeastern Mexico and the southern United States),[1] pumpkins are one of the oldest domesticated plants, having been used as early as 7,000 to 5,500 BC.[1] Pumpkins are widely grown for commercial use and as food, aesthetics, and recreational purposes. Pumpkin pie, for instance, is a traditional part of Thanksgiving meals in Canada and the United States, and pumpkins are frequently carved as jack-o\'-lanterns for decoration around Halloween, although commercially canned pumpkin purée and pumpkin pie fillings are usually made from different kinds of winter squash from the ones used for jack-o\'-lanterns.[1] In 2019, China accounted for 37% of the world\'s production of pumpkins. '),
('3e377cac6b4bd2dba6747c941f626da3173b84c34b', 'EBZAO40196', '98d9f94bdae5b2b918ba8dd1aab7aedc96c6ece711', '28ebee8861444842eecbf73ef40452108f810757fd', 'Pumpkins', 'WCQ.jpg', 'ALW.jpg', 'XRH.jpg', '200', '113', 'A pumpkin is a cultivar of winter squash that is round with smooth, slightly ribbed skin, and is most often deep yellow to orange in coloration.[1] The thick shell contains the seeds and pulp. The name is most commonly used for cultivars of Cucurbita pepo, but some cultivars of Cucurbita maxima, C. argyrosperma, and C. moschata with similar appearance are also sometimes called \"pumpkins\".[1]\n\nNative to North America (northeastern Mexico and the southern United States),[1] pumpkins are one of the oldest domesticated plants, having been used as early as 7,000 to 5,500 BC.[1] Pumpkins are widely grown for commercial use and as food, aesthetics, and recreational purposes. Pumpkin pie, for instance, is a traditional part of Thanksgiving meals in Canada and the United States, and pumpkins are frequently carved as jack-o\'-lanterns for decoration around Halloween, although commercially canned pumpkin purée and pumpkin pie fillings are usually made from different kinds of winter squash from the ones used for jack-o\'-lanterns.[1] In 2019, China accounted for 37% of the world\'s production of pumpkins. '),
('87ec06d784a3c9fbcd0f1ec588299db0d55e39e1de', 'QZXIS84126', '6950c7223925e97d0c1226ac0ec2e6efceb4659623', 'd77adf5845cbabd0d0fd21b878d1212381a980c006', 'Coriander', 'CVK.jpg', 'GIE.jpg', 'ACK.jpeg', '200', '69', 'Coriander (/ˌkɒriˈændər, ˈkɒriændər/;[1] Coriandrum sativum) is an annual herb in the family Apiaceae. It is also known as Chinese parsley, dhania or cilantro (/sɪˈlæntroʊ, -ˈlɑːn-/).[2] All parts of the plant are edible, but the fresh leaves and the dried seeds (as a spice) are the parts most traditionally used in cooking. Most people perceive the taste of coriander leaves as a tart, lemon/lime taste, but to nearly a quarter of those surveyed, the leaves taste like dish soap, linked to a gene which detects some specific aldehydes that are also used as odorant substances in many soaps and detergents.[3] ');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `category_id` varchar(200) NOT NULL,
  `category_code` longtext DEFAULT NULL,
  `category_name` longtext DEFAULT NULL,
  `category_details` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`category_id`, `category_code`, `category_name`, `category_details`) VALUES
('28ebee8861444842eecbf73ef40452108f810757fd', 'ERVZN37928', 'Fruits', 'Fruits should be an important part of your daily diet. They are naturally good and contain vitamins and minerals that can help to keep you healthy. They can also help protect against some diseases.'),
('d77adf5845cbabd0d0fd21b878d1212381a980c006', 'IMGZD58034', ' Herbs', ' The perfect finishing touch for salads, stews and everything in between, add flavour with our range of fresh and fragrant herbs. '),
('de1e396cea15deb1cd924d8bd0d0061a60fbb69c26', 'CVIQJ94056', ' Salads', 'Our range of salad is perfect for healthy lunches.Explore our range of salad produce, from delicious tomatoes, ripened on the vine, to crisp Cos lettuce and peppery rocket leaves.\r\n'),
('e52b15f2eb486da132b68da6b037b87ed10d80a656', 'PYUGR05678', 'Vegetables ', 'We go the extra mile to bring you vegetables which are tasty and fresh to create healthy meals for you and your family. Browse our range of veg which includes floury potatoes for roasting or mashing, crunchy cabbage, sweet butternut squash and leafy green curly kale.');

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `shipping_id` varchar(200) NOT NULL,
  `shippings_order_id` varchar(200) NOT NULL,
  `shipping_address` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shippings`
--

INSERT INTO `shippings` (`shipping_id`, `shippings_order_id`, `shipping_address`) VALUES
('0add7292f51fd300eb735cbe80bb9262b04869bb22', '67608176479aa47269941eb2eeed5ae095009feaea', '90126 Localhost, Opposite 127.0.0.1'),
('3f4f60b28c2f479c715307f52a744299707e8ada1d', '09ea6e89292dad8dbc94a86b0dd8956aece22507fc', '100 Localhost, Opposite To 127.0.0.1'),
('e5a505014151148064c9ee84e76f71edb1373e4f00', '5635599e16840708e4ec2b3d5a8f7169a85ff1ff0d', '120 Katoloni'),
('e83809486b387fadcca6ac04531fdd1fb9685c2475', '685588c6f80212e3585b2f0612046d94b0c9532e3c', '90125 Localhost, Katoloni.');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `sys_id` int(200) NOT NULL,
  `sys_name` longtext DEFAULT NULL,
  `sys_logo` longtext DEFAULT NULL,
  `sys_tagline` longtext DEFAULT NULL,
  `sys_contacts` longtext DEFAULT NULL,
  `sys_email` longtext DEFAULT NULL,
  `sys_paybill_no` varchar(200) DEFAULT NULL,
  `sys_about` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`sys_id`, `sys_name`, `sys_logo`, `sys_tagline`, `sys_contacts`, `sys_email`, `sys_paybill_no`, `sys_about`) VALUES
(1, 'Katoloni', NULL, 'Instilling Technology Innovation In Agriculture With New Perspective', '+254737229776 ', 'hello@e-farming.org', '90126', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(200) NOT NULL,
  `user_name` varchar(200) DEFAULT NULL,
  `user_number` varchar(200) DEFAULT NULL,
  `user_idno` varchar(200) DEFAULT NULL,
  `user_email` varchar(200) DEFAULT NULL,
  `user_password` varchar(200) DEFAULT NULL,
  `user_dpic` varchar(200) DEFAULT NULL,
  `user_phone_no` varchar(200) DEFAULT NULL,
  `user_bio` longtext DEFAULT NULL,
  `user_access_level` varchar(200) DEFAULT NULL,
  `user_created_at` varchar(200) DEFAULT NULL,
  `is_account_deleted` varchar(200) DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_number`, `user_idno`, `user_email`, `user_password`, `user_dpic`, `user_phone_no`, `user_bio`, `user_access_level`, `user_created_at`, `is_account_deleted`) VALUES
('0314047b42eb00a4dc9a660b07148c086af393cf3c', 'Martin Mbithi', 'RYNLP06723', NULL, 'farmermartin@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', NULL, '123096754', NULL, 'farmer', '02 Nov 2021', 'No'),
('1da9220c6484d1931c07a281a455a0e3eb14f219f5', 'Grace ', 'FXWTJ63142', NULL, 'gracemusyimi51@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', NULL, '0796390266', NULL, 'customer', '02 Nov 2021', 'No'),
('223872e7bb07a6c1b6beeee008c129ed912ef87704', 'System Administrator', 'EUHOB75962', '1234567890', 'sysadmin@eagri.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', NULL, '+2547899074', NULL, 'admin', '22 Oct 2021 9:38am', 'No'),
('230c02d2426cb052304cb43a27f6d3793b1a2e1cf5', 'Jasmine Doe', 'EHURI95306', '90013124131', 'jas@mail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', NULL, '0719090912', '    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'customer', '27, Oct 2021', 'No'),
('29e3f0093bd551ecf79951128cf6932d358dac587a', 'Mart Developers Inc', 'NGLDQ26904', NULL, 'mail@martdevelopers.inc', 'a69681bcf334ae130217fea4505fd3c994f5683f', NULL, '0766544123', NULL, 'customer', '31 Oct 2021', 'No'),
('6950c7223925e97d0c1226ac0ec2e6efceb4659623', 'Jane Doe', 'XFSBD91567', '127001', 'janedoe@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'FRL.png', '+254737229776', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'farmer', '27, Oct 2021', 'No'),
('8b866c94e7a0b765c2fe2b7007e40af4422c758d23', 'James doe', 'PEWXL27936', '0222167095', 'jamesdo90@mail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', NULL, '0710020036', NULL, 'customer', '28, Oct 2021', 'No'),
('98d9f94bdae5b2b918ba8dd1aab7aedc96c6ece711', 'James Doe', 'UQPAM17965', '9008731', 'jamesdoe@mail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', NULL, '0790090012', '    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'farmer', '27, Oct 2021', 'No'),
('c12a5a5f457db6da5050610d57a75ce937938ce97d', 'J Janet D Doe', 'DMWZA75639', '127841212', 'jjanetdoe@mail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', NULL, '+87654563', '\n\nPlaceholder content for the tab panel. This one relates to the home tab. Takes you miles high, so high, \'cause she’s got that one international smile. There\'s a stranger in my bed, there\'s a pounding in my head. Oh, no. In another life I would make you stay. ‘Cause I, I’m capable of anything. Suiting up for my crowning battle. Used to steal your parents\' liquor and climb to the roof. Tone, tan fit and ready, turn it up cause its gettin\' heavy. Her love is like a drug. I guess that I forgot I had a choice.\n', 'farmer', '27, Oct 2021', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` varchar(200) NOT NULL,
  `wishlist_user_id` varchar(200) NOT NULL,
  `wishlist_product_id` varchar(200) NOT NULL,
  `wishlist_created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wishlist_id`, `wishlist_user_id`, `wishlist_product_id`, `wishlist_created_on`) VALUES
('72b62611e03896c23e98aaed83ffb803b49030edef', '1da9220c6484d1931c07a281a455a0e3eb14f219f5', '04f807438e16eb6c716983d4b75cc34ba0ad3455b4', '2021-11-03 13:58:16'),
('8bbc6a692f7c4a4139bbf180361d9b4598c84a6dbf', '1da9220c6484d1931c07a281a455a0e3eb14f219f5', '18a4e778f80feb72c5ff925daa17cb367331e72637', '2021-11-03 13:43:27'),
('9f5f4b95db4b0aa23a82353e1f74fb89a19c3bf24b', '1da9220c6484d1931c07a281a455a0e3eb14f219f5', '87ec06d784a3c9fbcd0f1ec588299db0d55e39e1de', '2021-11-03 13:43:12'),
('d8b19189eeef24152f384ca44ddcc331666929760a', '29e3f0093bd551ecf79951128cf6932d358dac587a', '3e377cac6b4bd2dba6747c941f626da3173b84c34b', '2021-11-03 12:25:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blog_id`),
  ADD KEY `blog_category_id` (`blog_blog_category_id`),
  ADD KEY `blog_by` (`blog_published_by`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`blog_category_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `Cart_Owner` (`cart_user_id`),
  ADD KEY `Cart_Product` (`cart_product_id`);

--
-- Indexes for table `mailer_setttings`
--
ALTER TABLE `mailer_setttings`
  ADD PRIMARY KEY (`mailer_host`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `Cart_payment` (`payment_cart_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `Product_Owner` (`product_user_id`),
  ADD KEY `Product_Category` (`product_category_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`shipping_id`),
  ADD KEY `Order_ID` (`shippings_order_id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`sys_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `UserId` (`wishlist_user_id`),
  ADD KEY `ProductID` (`wishlist_product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `sys_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blog_by` FOREIGN KEY (`blog_published_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blog_category_id` FOREIGN KEY (`blog_blog_category_id`) REFERENCES `blog_categories` (`blog_category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `Cart_Owner` FOREIGN KEY (`cart_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Cart_Product` FOREIGN KEY (`cart_product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `Cart_payment` FOREIGN KEY (`payment_cart_id`) REFERENCES `cart` (`cart_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `Product_Category` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Product_Owner` FOREIGN KEY (`product_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shippings`
--
ALTER TABLE `shippings`
  ADD CONSTRAINT `Order_ID` FOREIGN KEY (`shippings_order_id`) REFERENCES `cart` (`cart_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `ProductID` FOREIGN KEY (`wishlist_product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `UserId` FOREIGN KEY (`wishlist_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
