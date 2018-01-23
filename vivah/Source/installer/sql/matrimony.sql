-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2016 at 01:00 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `matrimony`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--
DROP TABLE `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(500) NOT NULL,
  `role_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(505) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `role`, `role_id`, `email`, `mobile`) VALUES
(1, 'admin   ', 'YWRtaW4=', 'admin ', 5, 'najeelap.a@gmail.com', '3243242444'),
(6, 'sample ', '1234', 'agent', 7, 'oliviya.techware@gmail.com ', '8891664959 ');

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--
DROP TABLE `advertisement`;
CREATE TABLE IF NOT EXISTS `advertisement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_name` varchar(500) NOT NULL,
  `ad_image` varchar(500) NOT NULL,
  `ad_posted_date` date NOT NULL,
  `uploaded_by` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `advertisement`
--

INSERT INTO `advertisement` (`id`, `ad_name`, `ad_image`, `ad_posted_date`, `uploaded_by`) VALUES
(30, 'aaaa', 'assets/advertisement_images/35831-logo.png', '2016-01-14', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `agent_reg`
--
DROP TABLE `agent_reg`;
CREATE TABLE IF NOT EXISTS `agent_reg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agent_status` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `company` varchar(500) NOT NULL,
  `contact_num` int(11) NOT NULL,
  `added_user` varchar(50) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `agent_reg`
--

INSERT INTO `agent_reg` (`id`, `agent_status`, `username`, `password`, `email`, `address`, `company`, `contact_num`, `added_user`, `date`) VALUES
(3, 0, 'dff', 'admin_indo', 'nk@gmail.com', 'dffffffffffffffffffffffffffffffffffffffffffff', '', 2147483647, 'vdfvfd', '2016-01-16');

-- --------------------------------------------------------

--
-- Table structure for table `caste`
--
DROP TABLE `caste`;
CREATE TABLE IF NOT EXISTS `caste` (
  `caste_id` int(11) NOT NULL AUTO_INCREMENT,
  `religion_id` int(11) DEFAULT NULL,
  `caste` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`caste_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `caste`
--

INSERT INTO `caste` (`caste_id`, `religion_id`, `caste`) VALUES
(12, 2, 'Ambalavasi'),
(13, 2, 'Brahmin'),
(14, 2, 'Chettiar'),
(15, 2, 'Dheevara'),
(16, 2, 'Ezhava'),
(17, 2, 'Ezhuthachan'),
(18, 2, 'Gatti'),
(19, 2, 'Nair'),
(20, 3, 'Evangelist'),
(21, 3, 'Jacobite'),
(22, 3, 'Knanaya'),
(23, 3, 'Marthoma'),
(24, 3, 'CSI'),
(25, 3, 'Cathelic'),
(26, 51, 'Sunni'),
(27, 51, 'Mujahid'),
(28, 51, 'Shia');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--
DROP TABLE `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sendr_id` int(11) NOT NULL,
  `receivr_id` int(11) NOT NULL,
  `from_user` varchar(255) NOT NULL DEFAULT '',
  `to_user` varchar(255) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `sent` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recd` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `sendr_id`, `receivr_id`, `from_user`, `to_user`, `message`, `sent`, `recd`) VALUES
(11, 0, 0, 'shahina', 'Amal', 'hai amal', '2016-01-09 08:53:05', 1),
(19, 0, 0, 'Amal', 'Radha', 'hlw', '2016-01-11 10:52:01', 0),
(26, 0, 0, 'Amal', 'Anna', 'hlwggggg', '2016-01-20 10:26:00', 1),
(29, 0, 0, 'Anna', 'Amal', 'hlw amal', '2016-01-20 10:33:31', 1),
(30, 0, 0, 'Amal', 'Anna', 'hai  hw u?', '2016-01-20 10:34:03', 1),
(33, 0, 0, 'Amal', 'shahina', 'hwu?', '2016-01-21 05:43:46', 0),
(34, 0, 0, 'Anna', 'dfdgfdg', 'hlw i am amal', '2016-01-21 09:24:22', 0),
(35, 0, 0, 'aeaee', 'Anna', 'hlw i am anna', '2016-01-21 09:25:05', 1),
(36, 0, 0, 'Anna', 'dfdgfdg', 'hlw i am anna', '2016-01-21 09:29:56', 0),
(37, 0, 0, 'Anna', 'dfdgfdg', 'hlwww', '2016-01-21 09:30:25', 0),
(38, 0, 0, 'aeaee', 'Anna', 'hlwwwww anna', '2016-01-21 09:30:47', 1),
(39, 0, 0, 'aeaee', 'Anna', 'hlw', '2016-01-21 09:30:54', 1),
(40, 0, 0, 'aeaee', 'Anna', 'ssss', '2016-01-21 09:34:31', 1),
(41, 0, 0, 'aeaee', 'Anna', 'ffff', '2016-01-21 09:44:00', 1),
(42, 0, 0, 'aeaee', 'Anna', 'ffff', '2016-01-21 09:44:05', 1),
(43, 0, 0, 'aeaee', 'Anna', 'ssss', '2016-01-21 09:44:09', 1),
(44, 0, 0, 'aeaee', 'Anna', 'tttttt', '2016-01-21 09:44:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--
DROP TABLE `contact_details`;
CREATE TABLE IF NOT EXISTS `contact_details` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `your_name` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `message` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=243 ;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`id`, `your_name`, `phone`, `email`, `message`) VALUES
(241, 'rt54rt', '8891664959', 'najeelap.a@gmail.com', '32222222222222222'),
(242, 'rt54rt', '8891664959', 'najeelap.a@gmail.com', '32222222222222222');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--
DROP TABLE `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `country_id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `country` varchar(200) DEFAULT NULL,
  `iso_alpha2` varchar(2) DEFAULT NULL,
  `iso_alpha3` varchar(3) DEFAULT NULL,
  `iso_numeric` int(11) DEFAULT NULL,
  `currency_code` char(3) DEFAULT NULL,
  `currency_name` varchar(32) DEFAULT NULL,
  `currency_symbol` varchar(3) DEFAULT NULL,
  `flag` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=240 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country`, `iso_alpha2`, `iso_alpha3`, `iso_numeric`, `currency_code`, `currency_name`, `currency_symbol`, `flag`) VALUES
(1, 'Afghanistan', 'AF', 'AFG', 4, 'AFN', 'Afghani', '؋', 'AF.png'),
(2, 'Albania', 'AL', 'ALB', 8, 'ALL', 'Lek', 'Lek', 'AL.png'),
(3, 'Algeria', 'DZ', 'DZA', 12, 'DZD', 'Dinar', NULL, 'DZ.png'),
(4, 'American Samoa', 'AS', 'ASM', 16, 'USD', 'Dollar', '$', 'AS.png'),
(5, 'Andorra', 'AD', 'AND', 20, 'EUR', 'Euro', '€', 'AD.png'),
(6, 'Angola', 'AO', 'AGO', 24, 'AOA', 'Kwanza', 'Kz', 'AO.png'),
(7, 'Anguilla', 'AI', 'AIA', 660, 'XCD', 'Dollar', '$', 'AI.png'),
(8, 'Antarctica', 'AQ', 'ATA', 10, '', '', NULL, 'AQ.png'),
(9, 'Antigua and Barbuda', 'AG', 'ATG', 28, 'XCD', 'Dollar', '$', 'AG.png'),
(10, 'Argentina', 'AR', 'ARG', 32, 'ARS', 'Peso', '$', 'AR.png'),
(11, 'Armenia', 'AM', 'ARM', 51, 'AMD', 'Dram', NULL, 'AM.png'),
(12, 'Aruba', 'AW', 'ABW', 533, 'AWG', 'Guilder', 'ƒ', 'AW.png'),
(13, 'Australia', 'AU', 'AUS', 36, 'AUD', 'Dollar', '$', 'AU.png'),
(14, 'Austria', 'AT', 'AUT', 40, 'EUR', 'Euro', '€', 'AT.png'),
(15, 'Azerbaijan', 'AZ', 'AZE', 31, 'AZN', 'Manat', 'ман', 'AZ.png'),
(16, 'Bahamas', 'BS', 'BHS', 44, 'BSD', 'Dollar', '$', 'BS.png'),
(17, 'Bahrain', 'BH', 'BHR', 48, 'BHD', 'Dinar', NULL, 'BH.png'),
(18, 'Bangladesh', 'BD', 'BGD', 50, 'BDT', 'Taka', NULL, 'BD.png'),
(19, 'Barbados', 'BB', 'BRB', 52, 'BBD', 'Dollar', '$', 'BB.png'),
(20, 'Belarus', 'BY', 'BLR', 112, 'BYR', 'Ruble', 'p.', 'BY.png'),
(21, 'Belgium', 'BE', 'BEL', 56, 'EUR', 'Euro', '€', 'BE.png'),
(22, 'Belize', 'BZ', 'BLZ', 84, 'BZD', 'Dollar', 'BZ$', 'BZ.png'),
(23, 'Benin', 'BJ', 'BEN', 204, 'XOF', 'Franc', NULL, 'BJ.png'),
(24, 'Bermuda', 'BM', 'BMU', 60, 'BMD', 'Dollar', '$', 'BM.png'),
(25, 'Bhutan', 'BT', 'BTN', 64, 'BTN', 'Ngultrum', NULL, 'BT.png'),
(26, 'Bolivia', 'BO', 'BOL', 68, 'BOB', 'Boliviano', '$b', 'BO.png'),
(27, 'Bosnia and Herzegovina', 'BA', 'BIH', 70, 'BAM', 'Marka', 'KM', 'BA.png'),
(28, 'Botswana', 'BW', 'BWA', 72, 'BWP', 'Pula', 'P', 'BW.png'),
(29, 'Bouvet Island', 'BV', 'BVT', 74, 'NOK', 'Krone', 'kr', 'BV.png'),
(30, 'Brazil', 'BR', 'BRA', 76, 'BRL', 'Real', 'R$', 'BR.png'),
(31, 'British Indian Ocean Territory', 'IO', 'IOT', 86, 'USD', 'Dollar', '$', 'IO.png'),
(32, 'British Virgin Islands', 'VG', 'VGB', 92, 'USD', 'Dollar', '$', 'VG.png'),
(33, 'Brunei', 'BN', 'BRN', 96, 'BND', 'Dollar', '$', 'BN.png'),
(34, 'Bulgaria', 'BG', 'BGR', 100, 'BGN', 'Lev', 'лв', 'BG.png'),
(35, 'Burkina Faso', 'BF', 'BFA', 854, 'XOF', 'Franc', NULL, 'BF.png'),
(36, 'Burundi', 'BI', 'BDI', 108, 'BIF', 'Franc', NULL, 'BI.png'),
(37, 'Cambodia', 'KH', 'KHM', 116, 'KHR', 'Riels', '៛', 'KH.png'),
(38, 'Cameroon', 'CM', 'CMR', 120, 'XAF', 'Franc', 'FCF', 'CM.png'),
(39, 'Canada', 'CA', 'CAN', 124, 'CAD', 'Dollar', '$', 'CA.png'),
(40, 'Cape Verde', 'CV', 'CPV', 132, 'CVE', 'Escudo', NULL, 'CV.png'),
(41, 'Cayman Islands', 'KY', 'CYM', 136, 'KYD', 'Dollar', '$', 'KY.png'),
(42, 'Central African Republic', 'CF', 'CAF', 140, 'XAF', 'Franc', 'FCF', 'CF.png'),
(43, 'Chad', 'TD', 'TCD', 148, 'XAF', 'Franc', NULL, 'TD.png'),
(44, 'Chile', 'CL', 'CHL', 152, 'CLP', 'Peso', NULL, 'CL.png'),
(45, 'China', 'CN', 'CHN', 156, 'CNY', 'Yuan Renminbi', '¥', 'CN.png'),
(46, 'Christmas Island', 'CX', 'CXR', 162, 'AUD', 'Dollar', '$', 'CX.png'),
(47, 'Cocos Islands', 'CC', 'CCK', 166, 'AUD', 'Dollar', '$', 'CC.png'),
(48, 'Colombia', 'CO', 'COL', 170, 'COP', 'Peso', '$', 'CO.png'),
(49, 'Comoros', 'KM', 'COM', 174, 'KMF', 'Franc', NULL, 'KM.png'),
(50, 'Cook Islands', 'CK', 'COK', 184, 'NZD', 'Dollar', '$', 'CK.png'),
(51, 'Costa Rica', 'CR', 'CRI', 188, 'CRC', 'Colon', '₡', 'CR.png'),
(52, 'Croatia', 'HR', 'HRV', 191, 'HRK', 'Kuna', 'kn', 'HR.png'),
(53, 'Cuba', 'CU', 'CUB', 192, 'CUP', 'Peso', '₱', 'CU.png'),
(54, 'Cyprus', 'CY', 'CYP', 196, 'CYP', 'Pound', NULL, 'CY.png'),
(55, 'Czech Republic', 'CZ', 'CZE', 203, 'CZK', 'Koruna', 'KĿ', 'CZ.png'),
(56, 'Democratic Republic of the Congo', 'CD', 'COD', 180, 'CDF', 'Franc', NULL, 'CD.png'),
(57, 'Denmark', 'DK', 'DNK', 208, 'DKK', 'Krone', 'kr', 'DK.png'),
(58, 'Djibouti', 'DJ', 'DJI', 262, 'DJF', 'Franc', NULL, 'DJ.png'),
(59, 'Dominica', 'DM', 'DMA', 212, 'XCD', 'Dollar', '$', 'DM.png'),
(60, 'Dominican Republic', 'DO', 'DOM', 214, 'DOP', 'Peso', 'RD$', 'DO.png'),
(61, 'East Timor', 'TL', 'TLS', 626, 'USD', 'Dollar', '$', 'TL.png'),
(62, 'Ecuador', 'EC', 'ECU', 218, 'USD', 'Dollar', '$', 'EC.png'),
(63, 'Egypt', 'EG', 'EGY', 818, 'EGP', 'Pound', '£', 'EG.png'),
(64, 'El Salvador', 'SV', 'SLV', 222, 'SVC', 'Colone', '$', 'SV.png'),
(65, 'Equatorial Guinea', 'GQ', 'GNQ', 226, 'XAF', 'Franc', 'FCF', 'GQ.png'),
(66, 'Eritrea', 'ER', 'ERI', 232, 'ERN', 'Nakfa', 'Nfk', 'ER.png'),
(67, 'Estonia', 'EE', 'EST', 233, 'EEK', 'Kroon', 'kr', 'EE.png'),
(68, 'Ethiopia', 'ET', 'ETH', 231, 'ETB', 'Birr', NULL, 'ET.png'),
(69, 'Falkland Islands', 'FK', 'FLK', 238, 'FKP', 'Pound', '£', 'FK.png'),
(70, 'Faroe Islands', 'FO', 'FRO', 234, 'DKK', 'Krone', 'kr', 'FO.png'),
(71, 'Fiji', 'FJ', 'FJI', 242, 'FJD', 'Dollar', '$', 'FJ.png'),
(72, 'Finland', 'FI', 'FIN', 246, 'EUR', 'Euro', '€', 'FI.png'),
(73, 'France', 'FR', 'FRA', 250, 'EUR', 'Euro', '€', 'FR.png'),
(74, 'French Guiana', 'GF', 'GUF', 254, 'EUR', 'Euro', '€', 'GF.png'),
(75, 'French Polynesia', 'PF', 'PYF', 258, 'XPF', 'Franc', NULL, 'PF.png'),
(76, 'French Southern Territories', 'TF', 'ATF', 260, 'EUR', 'Euro  ', '€', 'TF.png'),
(77, 'Gabon', 'GA', 'GAB', 266, 'XAF', 'Franc', 'FCF', 'GA.png'),
(78, 'Gambia', 'GM', 'GMB', 270, 'GMD', 'Dalasi', 'D', 'GM.png'),
(79, 'Georgia', 'GE', 'GEO', 268, 'GEL', 'Lari', NULL, 'GE.png'),
(80, 'Germany', 'DE', 'DEU', 276, 'EUR', 'Euro', '€', 'DE.png'),
(81, 'Ghana', 'GH', 'GHA', 288, 'GHC', 'Cedi', '¢', 'GH.png'),
(82, 'Gibraltar', 'GI', 'GIB', 292, 'GIP', 'Pound', '£', 'GI.png'),
(83, 'Greece', 'GR', 'GRC', 300, 'EUR', 'Euro', '€', 'GR.png'),
(84, 'Greenland', 'GL', 'GRL', 304, 'DKK', 'Krone', 'kr', 'GL.png'),
(85, 'Grenada', 'GD', 'GRD', 308, 'XCD', 'Dollar', '$', 'GD.png'),
(86, 'Guadeloupe', 'GP', 'GLP', 312, 'EUR', 'Euro', '€', 'GP.png'),
(87, 'Guam', 'GU', 'GUM', 316, 'USD', 'Dollar', '$', 'GU.png'),
(88, 'Guatemala', 'GT', 'GTM', 320, 'GTQ', 'Quetzal', 'Q', 'GT.png'),
(89, 'Guinea', 'GN', 'GIN', 324, 'GNF', 'Franc', NULL, 'GN.png'),
(90, 'Guinea-Bissau', 'GW', 'GNB', 624, 'XOF', 'Franc', NULL, 'GW.png'),
(91, 'Guyana', 'GY', 'GUY', 328, 'GYD', 'Dollar', '$', 'GY.png'),
(92, 'Haiti', 'HT', 'HTI', 332, 'HTG', 'Gourde', 'G', 'HT.png'),
(93, 'Heard Island and McDonald Islands', 'HM', 'HMD', 334, 'AUD', 'Dollar', '$', 'HM.png'),
(94, 'Honduras', 'HN', 'HND', 340, 'HNL', 'Lempira', 'L', 'HN.png'),
(95, 'Hong Kong', 'HK', 'HKG', 344, 'HKD', 'Dollar', '$', 'HK.png'),
(96, 'Hungary', 'HU', 'HUN', 348, 'HUF', 'Forint', 'Ft', 'HU.png'),
(97, 'Iceland', 'IS', 'ISL', 352, 'ISK', 'Krona', 'kr', 'IS.png'),
(98, 'India', 'IN', 'IND', 356, 'INR', 'Rupee', '₹', 'IN.png'),
(99, 'Indonesia', 'ID', 'IDN', 360, 'IDR', 'Rupiah', 'Rp', 'ID.png'),
(100, 'Iran', 'IR', 'IRN', 364, 'IRR', 'Rial', '﷼', 'IR.png'),
(101, 'Iraq', 'IQ', 'IRQ', 368, 'IQD', 'Dinar', NULL, 'IQ.png'),
(102, 'Ireland', 'IE', 'IRL', 372, 'EUR', 'Euro', '€', 'IE.png'),
(103, 'Israel', 'IL', 'ISR', 376, 'ILS', 'Shekel', '₪', 'IL.png'),
(104, 'Italy', 'IT', 'ITA', 380, 'EUR', 'Euro', '€', 'IT.png'),
(105, 'Ivory Coast', 'CI', 'CIV', 384, 'XOF', 'Franc', NULL, 'CI.png'),
(106, 'Jamaica', 'JM', 'JAM', 388, 'JMD', 'Dollar', '$', 'JM.png'),
(107, 'Japan', 'JP', 'JPN', 392, 'JPY', 'Yen', '¥', 'JP.png'),
(108, 'Jordan', 'JO', 'JOR', 400, 'JOD', 'Dinar', NULL, 'JO.png'),
(109, 'Kazakhstan', 'KZ', 'KAZ', 398, 'KZT', 'Tenge', 'лв', 'KZ.png'),
(110, 'Kenya', 'KE', 'KEN', 404, 'KES', 'Shilling', NULL, 'KE.png'),
(111, 'Kiribati', 'KI', 'KIR', 296, 'AUD', 'Dollar', '$', 'KI.png'),
(112, 'Kuwait', 'KW', 'KWT', 414, 'KWD', 'Dinar', NULL, 'KW.png'),
(113, 'Kyrgyzstan', 'KG', 'KGZ', 417, 'KGS', 'Som', 'лв', 'KG.png'),
(114, 'Laos', 'LA', 'LAO', 418, 'LAK', 'Kip', '₭', 'LA.png'),
(115, 'Latvia', 'LV', 'LVA', 428, 'LVL', 'Lat', 'Ls', 'LV.png'),
(116, 'Lebanon', 'LB', 'LBN', 422, 'LBP', 'Pound', '£', 'LB.png'),
(117, 'Lesotho', 'LS', 'LSO', 426, 'LSL', 'Loti', 'L', 'LS.png'),
(118, 'Liberia', 'LR', 'LBR', 430, 'LRD', 'Dollar', '$', 'LR.png'),
(119, 'Libya', 'LY', 'LBY', 434, 'LYD', 'Dinar', NULL, 'LY.png'),
(120, 'Liechtenstein', 'LI', 'LIE', 438, 'CHF', 'Franc', 'CHF', 'LI.png'),
(121, 'Lithuania', 'LT', 'LTU', 440, 'LTL', 'Litas', 'Lt', 'LT.png'),
(122, 'Luxembourg', 'LU', 'LUX', 442, 'EUR', 'Euro', '€', 'LU.png'),
(123, 'Macao', 'MO', 'MAC', 446, 'MOP', 'Pataca', 'MOP', 'MO.png'),
(124, 'Macedonia', 'MK', 'MKD', 807, 'MKD', 'Denar', 'ден', 'MK.png'),
(125, 'Madagascar', 'MG', 'MDG', 450, 'MGA', 'Ariary', NULL, 'MG.png'),
(126, 'Malawi', 'MW', 'MWI', 454, 'MWK', 'Kwacha', 'MK', 'MW.png'),
(127, 'Malaysia', 'MY', 'MYS', 458, 'MYR', 'Ringgit', 'RM', 'MY.png'),
(128, 'Maldives', 'MV', 'MDV', 462, 'MVR', 'Rufiyaa', 'Rf', 'MV.png'),
(129, 'Mali', 'ML', 'MLI', 466, 'XOF', 'Franc', NULL, 'ML.png'),
(130, 'Malta', 'MT', 'MLT', 470, 'MTL', 'Lira', NULL, 'MT.png'),
(131, 'Marshall Islands', 'MH', 'MHL', 584, 'USD', 'Dollar', '$', 'MH.png'),
(132, 'Martinique', 'MQ', 'MTQ', 474, 'EUR', 'Euro', '€', 'MQ.png'),
(133, 'Mauritania', 'MR', 'MRT', 478, 'MRO', 'Ouguiya', 'UM', 'MR.png'),
(134, 'Mauritius', 'MU', 'MUS', 480, 'MUR', 'Rupee', '₨', 'MU.png'),
(135, 'Mayotte', 'YT', 'MYT', 175, 'EUR', 'Euro', '€', 'YT.png'),
(136, 'Mexico', 'MX', 'MEX', 484, 'MXN', 'Peso', '$', 'MX.png'),
(137, 'Micronesia', 'FM', 'FSM', 583, 'USD', 'Dollar', '$', 'FM.png'),
(138, 'Moldova', 'MD', 'MDA', 498, 'MDL', 'Leu', NULL, 'MD.png'),
(139, 'Monaco', 'MC', 'MCO', 492, 'EUR', 'Euro', '€', 'MC.png'),
(140, 'Mongolia', 'MN', 'MNG', 496, 'MNT', 'Tugrik', '₮', 'MN.png'),
(141, 'Montserrat', 'MS', 'MSR', 500, 'XCD', 'Dollar', '$', 'MS.png'),
(142, 'Morocco', 'MA', 'MAR', 504, 'MAD', 'Dirham', NULL, 'MA.png'),
(143, 'Mozambique', 'MZ', 'MOZ', 508, 'MZN', 'Meticail', 'MT', 'MZ.png'),
(144, 'Myanmar', 'MM', 'MMR', 104, 'MMK', 'Kyat', 'K', 'MM.png'),
(145, 'Namibia', 'NA', 'NAM', 516, 'NAD', 'Dollar', '$', 'NA.png'),
(146, 'Nauru', 'NR', 'NRU', 520, 'AUD', 'Dollar', '$', 'NR.png'),
(147, 'Nepal', 'NP', 'NPL', 524, 'NPR', 'Rupee', '₨', 'NP.png'),
(148, 'Netherlands', 'NL', 'NLD', 528, 'EUR', 'Euro', '€', 'NL.png'),
(149, 'Netherlands Antilles', 'AN', 'ANT', 530, 'ANG', 'Guilder', 'ƒ', 'AN.png'),
(150, 'New Caledonia', 'NC', 'NCL', 540, 'XPF', 'Franc', NULL, 'NC.png'),
(151, 'New Zealand', 'NZ', 'NZL', 554, 'NZD', 'Dollar', '$', 'NZ.png'),
(152, 'Nicaragua', 'NI', 'NIC', 558, 'NIO', 'Cordoba', 'C$', 'NI.png'),
(153, 'Niger', 'NE', 'NER', 562, 'XOF', 'Franc', NULL, 'NE.png'),
(154, 'Nigeria', 'NG', 'NGA', 566, 'NGN', 'Naira', '₦', 'NG.png'),
(155, 'Niue', 'NU', 'NIU', 570, 'NZD', 'Dollar', '$', 'NU.png'),
(156, 'Norfolk Island', 'NF', 'NFK', 574, 'AUD', 'Dollar', '$', 'NF.png'),
(157, 'North Korea', 'KP', 'PRK', 408, 'KPW', 'Won', '₩', 'KP.png'),
(158, 'Northern Mariana Islands', 'MP', 'MNP', 580, 'USD', 'Dollar', '$', 'MP.png'),
(159, 'Norway', 'NO', 'NOR', 578, 'NOK', 'Krone', 'kr', 'NO.png'),
(160, 'Oman', 'OM', 'OMN', 512, 'OMR', 'Rial', '﷼', 'OM.png'),
(161, 'Pakistan', 'PK', 'PAK', 586, 'PKR', 'Rupee', '₨', 'PK.png'),
(162, 'Palau', 'PW', 'PLW', 585, 'USD', 'Dollar', '$', 'PW.png'),
(163, 'Palestinian Territory', 'PS', 'PSE', 275, 'ILS', 'Shekel', '₪', 'PS.png'),
(164, 'Panama', 'PA', 'PAN', 591, 'PAB', 'Balboa', 'B/.', 'PA.png'),
(165, 'Papua New Guinea', 'PG', 'PNG', 598, 'PGK', 'Kina', NULL, 'PG.png'),
(166, 'Paraguay', 'PY', 'PRY', 600, 'PYG', 'Guarani', 'Gs', 'PY.png'),
(167, 'Peru', 'PE', 'PER', 604, 'PEN', 'Sol', 'S/.', 'PE.png'),
(168, 'Philippines', 'PH', 'PHL', 608, 'PHP', 'Peso', 'Php', 'PH.png'),
(169, 'Pitcairn', 'PN', 'PCN', 612, 'NZD', 'Dollar', '$', 'PN.png'),
(170, 'Poland', 'PL', 'POL', 616, 'PLN', 'Zloty', 'zł', 'PL.png'),
(171, 'Portugal', 'PT', 'PRT', 620, 'EUR', 'Euro', '€', 'PT.png'),
(172, 'Puerto Rico', 'PR', 'PRI', 630, 'USD', 'Dollar', '$', 'PR.png'),
(173, 'Qatar', 'QA', 'QAT', 634, 'QAR', 'Rial', '﷼', 'QA.png'),
(174, 'Republic of the Congo', 'CG', 'COG', 178, 'XAF', 'Franc', 'FCF', 'CG.png'),
(175, 'Reunion', 'RE', 'REU', 638, 'EUR', 'Euro', '€', 'RE.png'),
(176, 'Romania', 'RO', 'ROU', 642, 'RON', 'Leu', 'lei', 'RO.png'),
(177, 'Russia', 'RU', 'RUS', 643, 'RUB', 'Ruble', 'руб', 'RU.png'),
(178, 'Rwanda', 'RW', 'RWA', 646, 'RWF', 'Franc', NULL, 'RW.png'),
(179, 'Saint Helena', 'SH', 'SHN', 654, 'SHP', 'Pound', '£', 'SH.png'),
(180, 'Saint Kitts and Nevis', 'KN', 'KNA', 659, 'XCD', 'Dollar', '$', 'KN.png'),
(181, 'Saint Lucia', 'LC', 'LCA', 662, 'XCD', 'Dollar', '$', 'LC.png'),
(182, 'Saint Pierre and Miquelon', 'PM', 'SPM', 666, 'EUR', 'Euro', '€', 'PM.png'),
(183, 'Saint Vincent and the Grenadines', 'VC', 'VCT', 670, 'XCD', 'Dollar', '$', 'VC.png'),
(184, 'Samoa', 'WS', 'WSM', 882, 'WST', 'Tala', 'WS$', 'WS.png'),
(185, 'San Marino', 'SM', 'SMR', 674, 'EUR', 'Euro', '€', 'SM.png'),
(186, 'Sao Tome and Principe', 'ST', 'STP', 678, 'STD', 'Dobra', 'Db', 'ST.png'),
(187, 'Saudi Arabia', 'SA', 'SAU', 682, 'SAR', 'Rial', '﷼', 'SA.png'),
(188, 'Senegal', 'SN', 'SEN', 686, 'XOF', 'Franc', NULL, 'SN.png'),
(189, 'Serbia and Montenegro', 'CS', 'SCG', 891, 'RSD', 'Dinar', 'Дин', 'CS.png'),
(190, 'Seychelles', 'SC', 'SYC', 690, 'SCR', 'Rupee', '₨', 'SC.png'),
(191, 'Sierra Leone', 'SL', 'SLE', 694, 'SLL', 'Leone', 'Le', 'SL.png'),
(192, 'Singapore', 'SG', 'SGP', 702, 'SGD', 'Dollar', '$', 'SG.png'),
(193, 'Slovakia', 'SK', 'SVK', 703, 'SKK', 'Koruna', 'Sk', 'SK.png'),
(194, 'Slovenia', 'SI', 'SVN', 705, 'EUR', 'Euro', '€', 'SI.png'),
(195, 'Solomon Islands', 'SB', 'SLB', 90, 'SBD', 'Dollar', '$', 'SB.png'),
(196, 'Somalia', 'SO', 'SOM', 706, 'SOS', 'Shilling', 'S', 'SO.png'),
(197, 'South Africa', 'ZA', 'ZAF', 710, 'ZAR', 'Rand', 'R', 'ZA.png'),
(198, 'South Georgia and the South Sandwich Islands', 'GS', 'SGS', 239, 'GBP', 'Pound', '£', 'GS.png'),
(199, 'South Korea', 'KR', 'KOR', 410, 'KRW', 'Won', '₩', 'KR.png'),
(200, 'Spain', 'ES', 'ESP', 724, 'EUR', 'Euro', '€', 'ES.png'),
(201, 'Sri Lanka', 'LK', 'LKA', 144, 'LKR', 'Rupee', '₨', 'LK.png'),
(202, 'Sudan', 'SD', 'SDN', 736, 'SDD', 'Dinar', NULL, 'SD.png'),
(203, 'Suriname', 'SR', 'SUR', 740, 'SRD', 'Dollar', '$', 'SR.png'),
(204, 'Svalbard and Jan Mayen', 'SJ', 'SJM', 744, 'NOK', 'Krone', 'kr', 'SJ.png'),
(205, 'Swaziland', 'SZ', 'SWZ', 748, 'SZL', 'Lilangeni', NULL, 'SZ.png'),
(206, 'Sweden', 'SE', 'SWE', 752, 'SEK', 'Krona', 'kr', 'SE.png'),
(207, 'Switzerland', 'CH', 'CHE', 756, 'CHF', 'Franc', 'CHF', 'CH.png'),
(208, 'Syria', 'SY', 'SYR', 760, 'SYP', 'Pound', '£', 'SY.png'),
(209, 'Taiwan', 'TW', 'TWN', 158, 'TWD', 'Dollar', 'NT$', 'TW.png'),
(210, 'Tajikistan', 'TJ', 'TJK', 762, 'TJS', 'Somoni', NULL, 'TJ.png'),
(211, 'Tanzania', 'TZ', 'TZA', 834, 'TZS', 'Shilling', NULL, 'TZ.png'),
(212, 'Thailand', 'TH', 'THA', 764, 'THB', 'Baht', '฿', 'TH.png'),
(213, 'Togo', 'TG', 'TGO', 768, 'XOF', 'Franc', NULL, 'TG.png'),
(214, 'Tokelau', 'TK', 'TKL', 772, 'NZD', 'Dollar', '$', 'TK.png'),
(215, 'Tonga', 'TO', 'TON', 776, 'TOP', 'Pa''anga', 'T$', 'TO.png'),
(216, 'Trinidad and Tobago', 'TT', 'TTO', 780, 'TTD', 'Dollar', 'TT$', 'TT.png'),
(217, 'Tunisia', 'TN', 'TUN', 788, 'TND', 'Dinar', NULL, 'TN.png'),
(218, 'Turkey', 'TR', 'TUR', 792, 'TRY', 'Lira', 'YTL', 'TR.png'),
(219, 'Turkmenistan', 'TM', 'TKM', 795, 'TMM', 'Manat', 'm', 'TM.png'),
(220, 'Turks and Caicos Islands', 'TC', 'TCA', 796, 'USD', 'Dollar', '$', 'TC.png'),
(221, 'Tuvalu', 'TV', 'TUV', 798, 'AUD', 'Dollar', '$', 'TV.png'),
(222, 'U.S. Virgin Islands', 'VI', 'VIR', 850, 'USD', 'Dollar', '$', 'VI.png'),
(223, 'Uganda', 'UG', 'UGA', 800, 'UGX', 'Shilling', NULL, 'UG.png'),
(224, 'Ukraine', 'UA', 'UKR', 804, 'UAH', 'Hryvnia', '₴', 'UA.png'),
(225, 'United Arab Emirates', 'AE', 'ARE', 784, 'AED', 'Dirham', NULL, 'AE.png'),
(226, 'United Kingdom', 'GB', 'GBR', 826, 'GBP', 'Pound', '£', 'GB.png'),
(227, 'United States', 'US', 'USA', 840, 'USD', 'Dollar', '$', 'US.png'),
(228, 'United States Minor Outlying Islands', 'UM', 'UMI', 581, 'USD', 'Dollar ', '$', 'UM.png'),
(229, 'Uruguay', 'UY', 'URY', 858, 'UYU', 'Peso', '$U', 'UY.png'),
(230, 'Uzbekistan', 'UZ', 'UZB', 860, 'UZS', 'Som', 'лв', 'UZ.png'),
(231, 'Vanuatu', 'VU', 'VUT', 548, 'VUV', 'Vatu', 'Vt', 'VU.png'),
(232, 'Vatican', 'VA', 'VAT', 336, 'EUR', 'Euro', '€', 'VA.png'),
(233, 'Venezuela', 'VE', 'VEN', 862, 'VEF', 'Bolivar', 'Bs', 'VE.png'),
(234, 'Vietnam', 'VN', 'VNM', 704, 'VND', 'Dong', '₫', 'VN.png'),
(235, 'Wallis and Futuna', 'WF', 'WLF', 876, 'XPF', 'Franc', NULL, 'WF.png'),
(236, 'Western Sahara', 'EH', 'ESH', 732, 'MAD', 'Dirham', NULL, 'EH.png'),
(237, 'Yemen', 'YE', 'YEM', 887, 'YER', 'Rial', '﷼', 'YE.png'),
(238, 'Zambia', 'ZM', 'ZMB', 894, 'ZMK', 'Kwacha', 'ZK', 'ZM.png'),
(239, 'Zimbabwe', 'ZW', 'ZWE', 716, 'ZWD', 'Dollar', 'Z$', 'ZW.png');

-- --------------------------------------------------------

--
-- Table structure for table `deleted_messages`
--
DROP TABLE `deleted_messages`;
CREATE TABLE IF NOT EXISTS `deleted_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deleted_date` date NOT NULL,
  `chat_messages` longtext NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `deleted_messages`
--

INSERT INTO `deleted_messages` (`id`, `deleted_date`, `chat_messages`, `user_id`) VALUES
(6, '2016-01-15', '[{"id":34,"sender_id":"248","receiver_id":241,"message":"sdsdsd","read_status":"","message_date":"2016-01-15","online_status":"online"}]', 241),
(7, '2016-01-15', '[{"id":25,"sender_id":"250","receiver_id":242,"message":"haiii hw u?","read_status":"","message_date":"2015-12-31","online_status":"online"}]', 241),
(8, '2016-01-15', '[{"id":30,"sender_id":"243","receiver_id":241,"message":"hlw i m jose","read_status":"","message_date":"2015-12-31","online_status":"online"}]', 241),
(9, '2016-02-06', '[{"id":43,"sender_id":"240","receiver_id":241,"message":"hai i am anna","read_status":"","message_date":"2016-01-15","online_status":"online"},{"id":46,"sender_id":"240","receiver_id":241,"message":"hlw tdefdf","read_status":"","message_date":"2016-02-06","online_status":"online"}]', 241),
(10, '2016-02-11', '[{"id":47,"sender_id":"240","receiver_id":241,"message":"dffdfdefdfdfdfdfd","read_status":"","message_date":"2016-02-06","online_status":"online"}]', 241);

-- --------------------------------------------------------

--
-- Table structure for table `delete_user_profile`
--
DROP TABLE `delete_user_profile`;
CREATE TABLE IF NOT EXISTS `delete_user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `deleted_date` date NOT NULL,
  `reason` varchar(500) NOT NULL,
  `source` varchar(500) NOT NULL,
  `date_of_mrg` date NOT NULL,
  `experience` varchar(500) NOT NULL,
  `address` longtext NOT NULL,
  `user_details` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `district`
--
DROP TABLE `district`;
CREATE TABLE IF NOT EXISTS `district` (
  `district_id` int(250) NOT NULL AUTO_INCREMENT,
  `state_id` int(250) NOT NULL,
  `district` varchar(250) NOT NULL,
  PRIMARY KEY (`district_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=133 ;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`district_id`, `state_id`, `district`) VALUES
(12, 2, 'Chennai'),
(13, 2, 'Salem'),
(14, 2, 'Dindigul'),
(15, 2, 'Ariyalur'),
(16, 2, 'Coimbatore'),
(17, 2, 'Cuddalore'),
(18, 2, 'Dharmapuri'),
(19, 2, 'Erode'),
(20, 2, 'Kanchipuram'),
(21, 2, 'Kanyakumari'),
(22, 2, 'Karur'),
(23, 2, 'Krishnagiri'),
(24, 2, 'Madurai'),
(25, 2, 'Nagapattinam'),
(26, 2, 'Namakkal'),
(27, 2, 'The Nilgiris'),
(28, 2, 'Perambalur'),
(29, 2, 'Pudukkottai'),
(30, 2, 'Ramanathapuram'),
(31, 2, 'Salem'),
(32, 2, 'Sivaganga'),
(33, 2, 'Thanjavur'),
(34, 2, 'Theni'),
(35, 2, 'Thoothukudi'),
(36, 2, 'Tiruchirappalli'),
(46, 14, 'Trivandrum'),
(47, 14, 'Kollam'),
(48, 14, 'Alappuzha'),
(49, 14, 'Ernakulam'),
(50, 5, 'Sonomo'),
(51, 5, 'Inyo'),
(52, 6, 'SoHo'),
(53, 6, 'Chelsea'),
(54, 0, ''),
(55, 15, 'Bagrami'),
(56, 15, 'Char'),
(57, 15, 'Asiab'),
(58, 15, 'Deh'),
(59, 15, 'Sabz'),
(60, 15, 'Farza'),
(61, 15, 'Guldara'),
(62, 15, 'Istalif'),
(63, 15, 'Kabul'),
(64, 15, 'Kalakan'),
(65, 15, 'Khaki'),
(66, 15, 'Jabbar'),
(67, 15, 'Mir'),
(68, 15, 'Bacha'),
(69, 15, 'Kot'),
(70, 15, 'Mussahi'),
(71, 15, 'Paghman'),
(72, 15, 'Qarabagh'),
(73, 15, 'Shakardara'),
(74, 15, 'Surobi '),
(75, 16, 'Arghandab'),
(76, 16, 'Arghistan'),
(77, 18, 'Adraskan'),
(78, 18, 'Farsi'),
(79, 20, 'Ali Abad'),
(80, 20, 'Archi'),
(81, 21, 'Baharak'),
(82, 21, 'Bangi'),
(83, 22, 'Hisarak'),
(84, 22, 'Rodat'),
(85, 23, 'Kahmard'),
(86, 23, 'Dhusi'),
(87, 24, 'Bagram'),
(88, 24, 'Ghorband'),
(89, 25, 'Aqcha'),
(90, 25, 'Darzab'),
(91, 26, 'Ab Band '),
(92, 26, 'Ajristan'),
(93, 27, 'Balkhab'),
(94, 27, 'Gosfandi'),
(95, 28, 'Bak'),
(96, 28, 'Gurbuz'),
(97, 29, 'Tulak'),
(98, 29, 'Saghar'),
(99, 31, 'Anar Dara'),
(100, 31, 'Bakwa'),
(101, 33, 'Azra'),
(102, 33, 'Bala Buluk'),
(103, 34, 'Aybak'),
(104, 34, 'Darah Sof Balla'),
(105, 35, 'Aynak'),
(106, 35, 'Nava'),
(107, 47, 'Leven'),
(108, 47, 'Fier'),
(109, 49, 'Diber'),
(110, 49, 'Tirrana'),
(111, 50, 'puke'),
(112, 50, 'Skhoder'),
(113, 51, 'Arras'),
(114, 51, 'Lure'),
(115, 52, 'Tit'),
(116, 52, 'Tsabit'),
(117, 53, 'Abou El Hassan'),
(118, 53, 'Ain Merane'),
(119, 54, 'Aflou'),
(120, 54, 'Aïn Mahdi'),
(121, 55, ' Ain Beida'),
(122, 55, 'Ain Fakroun'),
(123, 56, 'Ain Djasser'),
(124, 56, 'Ain Touta'),
(125, 57, 'Western'),
(126, 57, 'Manu''a'),
(127, 58, 'Moffat'),
(128, 58, 'Rouit'),
(129, 63, 'Altona\r\n'),
(130, 63, 'Bass'),
(131, 64, 'Cairns'),
(132, 64, 'Dalrymple');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--
DROP TABLE `education`;
CREATE TABLE IF NOT EXISTS `education` (
  `education_id` int(250) NOT NULL AUTO_INCREMENT,
  `education` varchar(250) NOT NULL,
  PRIMARY KEY (`education_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`education_id`, `education`) VALUES
(1, 'AE'),
(2, 'BE');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_details`
--
DROP TABLE `feedback_details`;
CREATE TABLE IF NOT EXISTS `feedback_details` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `your_namef` varchar(250) NOT NULL,
  `matrimony_idf` varchar(250) NOT NULL,
  `priority` varchar(250) NOT NULL,
  `groom_namef` varchar(250) NOT NULL,
  `suggestion_feedback` varchar(250) NOT NULL,
  `send_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `feedback_details`
--

INSERT INTO `feedback_details` (`id`, `userid`, `your_namef`, `matrimony_idf`, `priority`, `groom_namef`, `suggestion_feedback`, `send_date`) VALUES
(1, 241, 'fdff', 'dfsffffff', 'dfdfdfdf', 'sfsdfdf', 'gffffffffgffggfgf', '2016-01-15');

-- --------------------------------------------------------

--
-- Table structure for table `interests`
--
DROP TABLE `interests`;
CREATE TABLE IF NOT EXISTS `interests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `sender_name` varchar(250) NOT NULL,
  `interested_member` varchar(250) NOT NULL,
  `intrst_status` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=301 ;

--
-- Dumping data for table `interests`
--

INSERT INTO `interests` (`id`, `sender_id`, `sender_name`, `interested_member`, `intrst_status`, `date`) VALUES
(275, 243, 'Radha', '242', 1, '2015-12-30'),
(277, 242, 'Raju', '243', 1, '2015-12-30'),
(281, 246, 'aagman', '243', 1, '2015-12-30'),
(284, 247, 'Lekshmi', '246', 1, '2015-12-30'),
(285, 251, 'jose', '243', 1, '2015-12-31'),
(286, 251, 'jose', '240', 1, '2015-12-31'),
(289, 252, 'jacob', '240', 1, '2015-12-31'),
(291, 251, 'jose', '248', 1, '2015-12-31'),
(292, 240, 'Anna', '241', 1, '2015-12-31'),
(293, 245, 'shahina', '244', 1, '2016-01-08'),
(294, 241, 'Amal', '245', 1, '2016-01-15'),
(297, 253, 'Remya', '241', 1, '2016-01-19'),
(298, 241, 'Amal', '253', 1, '2016-01-19'),
(300, 241, 'Amal', '240', 1, '2016-01-20');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--
DROP TABLE `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` varchar(50) NOT NULL,
  `receiver_id` int(50) NOT NULL,
  `message` varchar(50) NOT NULL,
  `read_status` varchar(50) NOT NULL,
  `message_date` date NOT NULL,
  `online_status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `read_status`, `message_date`, `online_status`) VALUES
(32, '245', 241, 'hlwww', '', '2015-12-31', 'online'),
(44, '241', 253, 'dfdfdfdf', '', '2016-01-19', 'online'),
(45, '240', 241, 'ttgtgyy', '', '2016-01-19', 'online'),
(53, '241', 245, 'asdfadf', '', '2016-02-11', 'online');

-- --------------------------------------------------------

--
-- Table structure for table `mother_tongue`
--
DROP TABLE `mother_tongue`;
CREATE TABLE IF NOT EXISTS `mother_tongue` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `mother_tongue_id` int(250) NOT NULL,
  `mother_tongue` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `mother_tongue`
--

INSERT INTO `mother_tongue` (`id`, `mother_tongue_id`, `mother_tongue`) VALUES
(1, 1, 'Malayalam'),
(2, 2, 'Hindhi'),
(3, 3, 'Tamil'),
(4, 4, 'Bengali'),
(5, 5, 'Telugu'),
(6, 6, 'Marathi'),
(7, 7, 'Urdu'),
(8, 8, 'Gujarati'),
(9, 9, 'Kannada'),
(10, 10, 'Odia'),
(11, 11, ' Punjabi'),
(12, 12, 'Assamese'),
(13, 13, 'Maithili'),
(14, 14, 'Bhili/Bhilodi'),
(15, 15, 'Santali'),
(16, 16, 'Kashmiri'),
(17, 17, 'Nepali'),
(18, 18, 'Gondi'),
(19, 19, 'Sindhi'),
(20, 20, 'Konkani'),
(21, 21, 'Dogri'),
(22, 22, 'Khandeshi'),
(23, 23, 'Kurukh'),
(24, 24, 'Tulu'),
(25, 25, 'Meitei/Manipuri'),
(26, 26, 'Bodo'),
(27, 27, 'Khasi'),
(28, 28, 'Mundari'),
(29, 28, 'English');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--
DROP TABLE `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `intrst_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `r_id` int(11) NOT NULL,
  `date1` date NOT NULL,
  `tm` time NOT NULL,
  `status` int(11) NOT NULL,
  `intrst_status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2400 ;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `intrst_id`, `s_id`, `r_id`, `date1`, `tm`, `status`, `intrst_status`, `user_id`, `content`) VALUES
(2374, 275, 243, 242, '2015-12-30', '00:20:15', 1, 1, 0, ''),
(2376, 277, 242, 243, '2015-12-30', '00:20:15', 1, 1, 0, ''),
(2380, 281, 246, 243, '2015-12-30', '00:20:15', 1, 1, 0, ''),
(2383, 284, 247, 246, '2015-12-30', '00:20:15', 1, 1, 0, ''),
(2384, 285, 251, 243, '2015-12-31', '00:20:15', 1, 1, 0, ''),
(2385, 286, 251, 240, '2015-12-31', '00:20:15', 1, 1, 0, ''),
(2388, 289, 252, 240, '2015-12-31', '00:20:15', 1, 1, 0, ''),
(2390, 291, 251, 248, '2015-12-31', '00:20:15', 1, 1, 0, ''),
(2391, 292, 240, 241, '2015-12-31', '00:20:15', 1, 1, 0, ''),
(2392, 293, 245, 244, '2016-01-08', '00:20:16', 1, 1, 0, ''),
(2393, 294, 241, 245, '2016-01-15', '00:20:16', 1, 1, 0, ''),
(2396, 297, 253, 241, '2016-01-19', '00:20:16', 1, 1, 0, ''),
(2397, 298, 241, 253, '2016-01-19', '00:20:16', 1, 1, 0, ''),
(2399, 300, 241, 240, '2016-01-20', '00:20:16', 1, 1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `occupation`
--
DROP TABLE `occupation`;
CREATE TABLE IF NOT EXISTS `occupation` (
  `occupation_id` int(250) NOT NULL AUTO_INCREMENT,
  `education_id` int(250) NOT NULL,
  `occupation` varchar(250) NOT NULL,
  PRIMARY KEY (`occupation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=124 ;

--
-- Dumping data for table `occupation`
--

INSERT INTO `occupation` (`occupation_id`, `education_id`, `occupation`) VALUES
(1, 1, 'Manager'),
(2, 1, 'Supervisor'),
(3, 1, 'Officer'),
(4, 1, 'Administrative Professionl'),
(5, 1, 'Executive'),
(6, 1, 'Clerk'),
(7, 1, 'Human Resoursess Professional'),
(8, 1, 'Agriculture & Farming Professional'),
(9, 1, 'Pilot'),
(10, 1, 'Air Hostess'),
(11, 1, 'Airline Professional'),
(12, 1, 'Architect'),
(13, 1, 'Interior Designer'),
(14, 1, 'Chartered Accountant'),
(15, 1, 'Company Secretary'),
(16, 1, 'Accounts/Finance Professional'),
(17, 1, 'Banking Professional Services'),
(18, 1, 'Auditor'),
(19, 1, 'Financial Accountant'),
(20, 1, 'Financial Analyst/Planning'),
(21, 1, 'Fashion Designer'),
(22, 1, 'Beautician'),
(23, 1, 'Civil Services(IAS/IPS/IRS/IES/IFS)'),
(24, 1, 'Army'),
(26, 1, 'Navy'),
(27, 1, 'Airforce'),
(28, 1, 'Professor/Lecturer'),
(29, 1, 'Teaching Academician'),
(30, 1, 'Educational Professional'),
(31, 1, 'Hotel / Hospitality Professional'),
(32, 1, 'Software Professional'),
(33, 1, 'Hardware Professsional'),
(44, 1, 'Engineer - Non IT'),
(45, 1, 'Designer - IT & Engineering'),
(46, 1, 'Lawyer & Legal Professional'),
(47, 1, 'Law Enforcement Officer'),
(48, 1, 'Doctor'),
(50, 1, 'Health Care Professional'),
(51, 1, 'Paramedical Professional'),
(52, 1, 'Nurse'),
(53, 1, 'Marketing Professional'),
(54, 1, 'Sales Professional'),
(55, 1, 'Sales Professional'),
(56, 1, 'Journalist'),
(57, 1, 'Media Professional'),
(58, 1, 'Entertainment Professional'),
(59, 1, 'Event Management Professional'),
(60, 1, 'Advertising / PR Professional'),
(61, 1, 'Designer - Media & Entertainment'),
(62, 1, 'Mariner / Merchant Navy'),
(63, 1, 'Scientist/Researcher'),
(64, 1, 'CXO ? President,Director,Chairman'),
(65, 1, 'Business Analyst'),
(66, 1, 'Consultant'),
(67, 1, 'Customer Care Professional'),
(68, 1, 'Social Worker'),
(69, 1, 'Sportsman'),
(70, 1, 'Technician'),
(71, 1, 'Arts & Craftsman'),
(72, 1, 'Student'),
(73, 1, 'Librarian'),
(74, 1, 'Not Working'),
(75, 2, 'Manager'),
(76, 2, 'Supervisor'),
(77, 2, 'Officer'),
(78, 2, 'Administrative Professional'),
(79, 2, 'Executive'),
(80, 2, 'Clerk'),
(81, 2, 'Human Resources Professional'),
(82, 2, 'Human Resources Professional'),
(83, 2, 'Pilot'),
(84, 2, 'Air Hostess'),
(85, 2, 'Airline Professional'),
(86, 2, 'Architect'),
(87, 2, 'Interior Designer'),
(88, 2, 'Chartered Accountant'),
(89, 2, 'Company Secretary'),
(90, 2, 'Accounts Finance Professional'),
(91, 2, 'Banking Service Professional'),
(92, 2, 'Auditor'),
(93, 2, 'Financial Accountant'),
(94, 2, 'Financial Analyst/Planning'),
(95, 2, 'Fashion Designer'),
(96, 2, 'Beautician'),
(97, 2, 'Civil Services (IAS/IPS/IRS/IES/IFS)'),
(98, 2, 'Army'),
(99, 2, 'Navy'),
(100, 2, 'Airforce'),
(101, 2, 'Professor / Lecturer'),
(102, 2, 'Teaching / Academician'),
(103, 2, 'Education Professional'),
(104, 2, 'Hotel / Hospitality Professional'),
(105, 2, 'Software Professional'),
(106, 2, 'Hardware Professional'),
(107, 2, 'Engineer - Non IT'),
(108, 2, 'Designer - IT & Engineering'),
(109, 2, 'Lawyer & Legal Professional'),
(110, 2, 'Law Enforcement Officer'),
(111, 2, 'Doctor'),
(112, 2, 'Health Care Professional'),
(113, 2, 'Paramedical Professional'),
(114, 2, 'Nurse'),
(115, 2, 'Marketing Professional'),
(116, 2, 'Sales Professional'),
(117, 2, 'Journalist'),
(118, 2, 'Media Professional'),
(119, 2, 'Entertainment Professional'),
(120, 2, 'Event Management Professional'),
(121, 2, 'Advertising / PR Professional'),
(123, 3, 'NIL');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--
DROP TABLE `packages`;
CREATE TABLE IF NOT EXISTS `packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_name` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `package_name`) VALUES
(1, 'CLASSIC'),
(2, 'PERSONALIZED');

-- --------------------------------------------------------

--
-- Table structure for table `package_details`
--
DROP TABLE `package_details`;
CREATE TABLE IF NOT EXISTS `package_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` varchar(250) NOT NULL,
  `period` varchar(250) NOT NULL,
  `rate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `package_details`
--

INSERT INTO `package_details` (`id`, `package_id`, `period`, `rate`) VALUES
(3, '1', '90', 2000),
(4, '1', '180', 4000),
(26, '2', '90', 2500),
(31, '2', '180', 4500);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--
DROP TABLE `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `pages` varchar(500) NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`p_id`, `pages`) VALUES
(1, 'dashboard'),
(2, 'newley-registered-mem-list'),
(3, 'all-users-list'),
(4, 'agent-list'),
(5, 'agent-list-edit'),
(6, 'package'),
(7, 'package-list'),
(8, 'package-list-edit'),
(9, 'add-country'),
(10, 'place-list'),
(11, 'place-list-edit'),
(12, 'user-payment-list'),
(13, 'add-religion'),
(14, 'religion-list'),
(15, 'religion-list-edit'),
(16, 'add-caste'),
(17, 'caste-list'),
(18, 'caste-list-edit'),
(19, 'add-star'),
(20, 'star-list'),
(21, 'star-list-edit'),
(22, 'add-rasi'),
(23, 'rasi-list'),
(24, 'rasi-list-edit'),
(25, 'add-zodiac'),
(26, 'zodiac-list'),
(27, 'zodiac-list-edit'),
(28, 'add-education'),
(29, 'education-list'),
(30, 'education-list-edit'),
(31, 'role-management-page'),
(32, 'add-agent'),
(33, 'add-backend-user'),
(34, 'backend-user-list'),
(35, 'change-password');

-- --------------------------------------------------------

--
-- Table structure for table `rassi_moonsign`
--

DROP TABLE `rassi_moonsign`;
CREATE TABLE IF NOT EXISTS `rassi_moonsign` (
  `rassimoonsign_id` int(250) NOT NULL AUTO_INCREMENT,
  `star_id` int(250) NOT NULL,
  `rassi_moonsign` varchar(250) NOT NULL,
  PRIMARY KEY (`rassimoonsign_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `rassi_moonsign`
--

INSERT INTO `rassi_moonsign` (`rassimoonsign_id`, `star_id`, `rassi_moonsign`) VALUES
(1, 1, 'Medam(Aries)'),
(6, 2, 'Edavam(Taurus)'),
(8, 3, 'Mithunam(Gemini)'),
(10, 4, 'mithunam(gemini)'),
(12, 5, 'karkitakam(cancer)'),
(14, 11, 'Chingam(Leo)'),
(15, 12, 'Kanni(Virgo)'),
(16, 12, 'Chingam(Leo)'),
(18, 14, 'Kanni(Virgo)'),
(19, 14, 'Thulam(Libra)'),
(23, 17, 'Vrischigam(Scorpio)'),
(27, 21, 'Dhanu(Sagittarius)'),
(31, 23, 'Makaram(Capricorn)'),
(33, 25, 'Kumbam(Aquarius)'),
(38, 28, 'Medam(Aries)');

-- --------------------------------------------------------

--
-- Table structure for table `religion`
--
DROP TABLE `religion`;
CREATE TABLE IF NOT EXISTS `religion` (
  `religion_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `religion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`religion_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `religion`
--

INSERT INTO `religion` (`religion_id`, `religion`) VALUES
(2, 'Hindu'),
(3, 'Christian'),
(51, 'Muslim');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `rolename` varchar(500) NOT NULL,
  `created_date` date NOT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`r_id`, `rolename`, `created_date`) VALUES
(5, 'admin', '2015-12-03'),
(7, 'agent', '2015-12-03');

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--
DROP TABLE `role_permission`;
CREATE TABLE IF NOT EXISTS `role_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `page_id` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `role_permission`
--

INSERT INTO `role_permission` (`id`, `role_id`, `page_id`) VALUES
(1, 5, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35'),
(2, 7, '2,3');

-- --------------------------------------------------------

--
-- Table structure for table `sent_deleted_messages`
--
DROP TABLE `sent_deleted_messages`;
CREATE TABLE IF NOT EXISTS `sent_deleted_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deleted_date` date NOT NULL,
  `message` longtext NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `sent_deleted_messages`
--

INSERT INTO `sent_deleted_messages` (`id`, `deleted_date`, `message`, `uid`) VALUES
(5, '2015-12-31', '[{"id":22,"sender_id":"250","receiver_id":"242","message":"hlwwww","read_status":"","message_date":"2015-12-31","online_status":"online"},{"id":23,"sender_id":"250","receiver_id":"242","message":"haiiiiiiiiiiiiiiii","read_status":"","message_date":"2015-12-31","online_status":"online"},{"id":24,"sender_id":"250","receiver_id":"241","message":"test","read_status":"","message_date":"2015-12-31","online_status":"online"}]', 250),
(6, '2015-12-31', '[{"id":22,"sender_id":"250","receiver_id":"242","message":"hlwwww","read_status":"","message_date":"2015-12-31","online_status":"online"},{"id":23,"sender_id":"250","receiver_id":"242","message":"haiiiiiiiiiiiiiiii","read_status":"","message_date":"2015-12-31","online_status":"online"},{"id":24,"sender_id":"250","receiver_id":"241","message":"test","read_status":"","message_date":"2015-12-31","online_status":"online"}]', 250),
(7, '2015-12-31', '[{"id":25,"sender_id":"250","receiver_id":"242","message":"haiii hw u?","read_status":"","message_date":"2015-12-31","online_status":"online"},{"id":26,"sender_id":"250","receiver_id":"244","message":"test","read_status":"","message_date":"2015-12-31","online_status":"online"},{"id":27,"sender_id":"250","receiver_id":"246","message":"test","read_status":"","message_date":"2015-12-31","online_status":"online"}]', 250),
(8, '2015-12-31', '[{"id":28,"sender_id":"250","receiver_id":"246","message":"test","read_status":"","message_date":"2015-12-31","online_status":"online"}]', 250),
(9, '2016-01-15', '[{"id":36,"sender_id":"241","receiver_id":247,"message":"sdsdhsjd","read_status":"","message_date":"2016-01-15","online_status":"online"}]', 241),
(10, '2016-01-15', '[{"id":35,"sender_id":"241","receiver_id":245,"message":"fasd","read_status":"","message_date":"2016-01-15","online_status":"online"}]', 241),
(11, '2016-01-15', '[{"id":29,"sender_id":"251","receiver_id":243,"message":"haiii","read_status":"","message_date":"2015-12-31","online_status":"online"},{"id":33,"sender_id":"241","receiver_id":243,"message":"dfdf","read_status":"","message_date":"2016-01-15","online_status":"online"},{"id":37,"sender_id":"241","receiver_id":243,"message":"sdsdsd","read_status":"","message_date":"2016-01-15","online_status":"online"}]', 241),
(12, '2016-01-15', '[{"id":40,"sender_id":"241","receiver_id":249,"message":"sdsdhsjd","read_status":"","message_date":"2016-01-15","online_status":"online"}]', 241),
(13, '2016-01-15', '[{"id":41,"sender_id":"241","receiver_id":249,"message":"sdsdsd","read_status":"","message_date":"2016-01-15","online_status":"online"}]', 241),
(14, '2016-01-15', '[{"id":39,"sender_id":"245","receiver_id":241,"message":"fdsfdsf","read_status":"","message_date":"2016-01-15","online_status":"online"}]', 241),
(15, '2016-02-11', '[{"id":42,"sender_id":"241","receiver_id":245,"message":"dfsfsfsf","read_status":"","message_date":"2016-01-15","online_status":"online"},{"id":48,"sender_id":"241","receiver_id":245,"message":"test","read_status":"","message_date":"2016-02-11","online_status":"online"}]', 241);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `religion` int(11) NOT NULL,
  `place` int(11) NOT NULL,
  `education` int(11) NOT NULL,
  `occupation` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `search_without_login` varchar(500) NOT NULL,
  `smtp_username` varchar(250) NOT NULL,
  `smtp_host` varchar(250) NOT NULL,
  `smtp_password` varchar(250) NOT NULL,
  `currency` varchar(500) NOT NULL,
  `fav_icon` varchar(500) NOT NULL,
  `image` varchar(500) NOT NULL,
  `payment_gateway_username` varchar(500) NOT NULL,
  `payment_gateway_password` varchar(500) NOT NULL,
  `payment_gateway_signature` varchar(500) NOT NULL,
  `payment_gateway_testmode` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `religion`, `place`, `education`, `occupation`, `age`, `search_without_login`, `smtp_username`, `smtp_host`, `smtp_password`, `currency`, `fav_icon`, `image`, `payment_gateway_username`, `payment_gateway_password`, `payment_gateway_signature`, `payment_gateway_testmode`) VALUES
(1, 'Soulmate', 1, 1, 1, 1, 1, 'on', 'no-reply@techware.in', 'mail.techware.in', 'Golden_reply', '$', 'assets/settingsimages/favicon.ico', 'assets/settingsimages/logo.png', 'shajeermhmmd-facilitator_api1.gmail.com', 'WLNW9ZAZ67R39Z7Y', 'AiPC9BjkCyDFQXbSkoZcgqH3hpacAeGlrg4u9bfsrQbjCcxnzFSrEZ0x', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `star`
--
DROP TABLE `star`;
CREATE TABLE IF NOT EXISTS `star` (
  `star_id` int(11) NOT NULL AUTO_INCREMENT,
  `star` varchar(250) NOT NULL,
  PRIMARY KEY (`star_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `star`
--

INSERT INTO `star` (`star_id`, `star`) VALUES
(1, 'Aswathi'),
(2, 'Bharani'),
(3, 'Krithiga'),
(4, 'Rohini'),
(5, 'Makayiram'),
(6, 'Thiruvathira'),
(7, 'Punartham'),
(8, 'Pooyam'),
(9, 'Ayilyam'),
(10, 'Magam'),
(11, 'Pooram'),
(12, 'Uthram'),
(13, 'Atham'),
(14, 'Chithira'),
(15, 'Chothi'),
(16, 'Visakham'),
(17, 'Ketta'),
(18, 'Moolam'),
(19, 'Pooradam'),
(20, 'Uthiradam'),
(21, 'Thiruvonam'),
(22, 'Avittam'),
(23, 'Chadayam'),
(24, 'Pooruttathi'),
(25, 'Uthirattathi'),
(26, 'Revathi'),
(28, 'Bharani');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

DROP TABLE `state`;
CREATE TABLE IF NOT EXISTS `state` (
  `state_id` int(250) NOT NULL AUTO_INCREMENT,
  `country_id` int(250) NOT NULL,
  `state` varchar(250) NOT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `country_id`, `state`) VALUES
(2, 98, 'Tamilnadu'),
(5, 227, 'California'),
(6, 227, 'New York'),
(14, 98, 'Kerala'),
(15, 1, 'Kabul'),
(16, 1, 'Kandahar'),
(18, 1, 'Herat'),
(19, 1, 'Mazar-i-Sharif'),
(20, 1, 'Kunduz'),
(21, 1, 'Taloqan'),
(22, 1, 'Jalalabad'),
(23, 1, 'Puli Khumri'),
(24, 1, 'Charikar'),
(25, 1, 'Sheberghan'),
(26, 1, 'Ghazni'),
(27, 1, 'Sar-e Pol'),
(28, 1, 'Khost'),
(29, 1, 'Chaghcharan'),
(30, 1, 'Mihtarlam'),
(31, 1, 'Farah'),
(34, 1, 'Samangan'),
(35, 1, 'Lashkar Gah'),
(47, 2, 'Berat'),
(48, 2, 'Bulqize'),
(49, 2, 'Delvine'),
(50, 2, 'Devoll'),
(51, 2, 'Diber'),
(52, 3, 'Adrar'),
(53, 3, 'Chlef'),
(54, 3, 'Laghouat'),
(55, 3, 'Oum el-Bouaghi'),
(56, 3, ' Batna'),
(57, 4, 'Tutulia'),
(58, 4, 'Colorado'),
(59, 5, 'Canillo'),
(60, 5, 'Ordino'),
(61, 6, 'Bengo'),
(62, 6, 'Benguela'),
(63, 13, 'Victoria'),
(64, 13, 'Queensland');

-- --------------------------------------------------------

--
-- Table structure for table `sub_caste`
--
DROP TABLE `sub_caste`;
CREATE TABLE IF NOT EXISTS `sub_caste` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `religion_id` int(11) NOT NULL,
  `sub_caste` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `success_stories`
--
DROP TABLE `success_stories`;
CREATE TABLE IF NOT EXISTS `success_stories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bride_name` varchar(500) NOT NULL,
  `groom_name` varchar(500) NOT NULL,
  `user_matrimony_id` varchar(500) NOT NULL,
  `partners_matrimony_id` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `address` text NOT NULL,
  `mrg_date` date NOT NULL,
  `engagement_date` date NOT NULL,
  `country_livingin` varchar(500) NOT NULL,
  `state` varchar(500) NOT NULL,
  `contact_num` int(11) NOT NULL,
  `success_story` text NOT NULL,
  `images` varchar(500) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `success_stories`
--

INSERT INTO `success_stories` (`id`, `bride_name`, `groom_name`, `user_matrimony_id`, `partners_matrimony_id`, `email`, `address`, `mrg_date`, `engagement_date`, `country_livingin`, `state`, `contact_num`, `success_story`, `images`, `id_user`) VALUES
(1, 'sdsd', 'dad', 'ada', 'ada', 'najeelap.a@gmail.com', 'adad', '2016-01-12', '2016-01-12', 'ded', 'dfd', 2147483647, 'adsasd', 'assets/success_stories/95865-49517-logo.png', 241);

-- --------------------------------------------------------

--
-- Table structure for table `user_payment_details`
--
DROP TABLE `user_payment_details`;
CREATE TABLE IF NOT EXISTS `user_payment_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `paid_date` date NOT NULL,
  `username` varchar(500) NOT NULL,
  `package_id` int(11) NOT NULL,
  `period` varchar(500) NOT NULL,
  `rate` int(11) NOT NULL,
  `user_payment_status` int(11) NOT NULL,
  `ack` varchar(500) NOT NULL,
  `transaction_id` varchar(500) NOT NULL,
  `transaction_type` varchar(500) NOT NULL,
  `payment_type` varchar(500) NOT NULL,
  `datetime` datetime NOT NULL,
  `currency_code` varchar(500) NOT NULL,
  `payment_status` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user_payment_details`
--

INSERT INTO `user_payment_details` (`id`, `uid`, `paid_date`, `username`, `package_id`, `period`, `rate`, `user_payment_status`, `ack`, `transaction_id`, `transaction_type`, `payment_type`, `datetime`, `currency_code`, `payment_status`) VALUES
(1, 240, '2016-01-01', 'Anna', 1, '90 ', 2500, 1, 'Success', '88720456CN6572247', 'expresscheckout', 'instant', '2015-12-31 10:38:08', 'AUD', 'Pending'),
(3, 242, '2015-12-31', 'Raju', 2, '90 ', 2500, 1, 'Success', '1T445242611089810', 'expresscheckout', 'instant', '2015-12-31 10:48:24', 'AUD', 'Pending'),
(4, 243, '2015-12-31', 'Radha', 1, '90 ', 2500, 1, 'Success', '9YT6054859183834U', 'expresscheckout', 'instant', '2015-12-31 10:51:39', 'AUD', 'Pending'),
(5, 244, '2015-12-31', 'sha', 1, '90 ', 2500, 1, 'Success', '2HK03510CF3103325', 'expresscheckout', 'instant', '2015-12-31 10:53:46', 'AUD', 'Pending'),
(6, 245, '2015-12-31', 'shahina', 2, '90', 2500, 1, 'Success', '44U37385XX473210P', 'expresscheckout', 'instant', '2015-12-31 10:55:49', 'AUD', 'Pending'),
(7, 246, '2016-01-11', 'aagman', 2, '90 ', 2500, 1, 'Success', '7BK13007GW2548446', 'expresscheckout', 'instant', '2016-01-11 11:07:40', 'AUD', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--
DROP TABLE `user_profile`;
CREATE TABLE IF NOT EXISTS `user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `age` varchar(500) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `other_religion` varchar(200) NOT NULL,
  `caste` varchar(50) NOT NULL,
  `other_caste` varchar(50) NOT NULL,
  `path` varchar(500) NOT NULL,
  `img_status` int(11) NOT NULL,
  `height` varchar(11) NOT NULL,
  `weight` varchar(11) NOT NULL,
  `marital_status` varchar(50) NOT NULL,
  `children` varchar(50) NOT NULL,
  `body_type` varchar(50) NOT NULL,
  `complexion` varchar(50) NOT NULL,
  `mother_tongue` varchar(55) NOT NULL,
  `education` varchar(50) NOT NULL,
  `other_education` varchar(500) NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `annual_income` varchar(500) NOT NULL,
  `hobbies` varchar(50) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `family_values` varchar(50) NOT NULL,
  `family_type` varchar(505) NOT NULL,
  `employedin` varchar(50) NOT NULL,
  `habits` varchar(50) NOT NULL,
  `physical_status` varchar(50) NOT NULL,
  `district_id` varchar(50) NOT NULL,
  `package_payment` int(11) NOT NULL,
  `smoking_habits` varchar(500) NOT NULL,
  `drinking_habit` varchar(500) NOT NULL,
  `sudhhajadhagam` varchar(50) NOT NULL,
  `star` varchar(50) NOT NULL,
  `rassi_moonsign` varchar(500) NOT NULL,
  `other_moonsign` varchar(500) NOT NULL,
  `familystatus` varchar(50) NOT NULL,
  `eating_habits` varchar(500) NOT NULL,
  `other_star` varchar(500) NOT NULL,
  `zodiac_starsign` varchar(500) NOT NULL,
  `other_zodiac` varchar(500) NOT NULL,
  `country_livingin` varchar(500) NOT NULL,
  `other_country_livingin` varchar(500) NOT NULL,
  `citizenship` varchar(500) NOT NULL,
  `other_citizenship` varchar(500) NOT NULL,
  `state` varchar(500) NOT NULL,
  `other_residing_state` varchar(500) NOT NULL,
  `district` varchar(500) NOT NULL,
  `other_residing_city` varchar(500) NOT NULL,
  `other_highesteducation` varchar(500) NOT NULL,
  `other_occupation` varchar(500) NOT NULL,
  `college` varchar(500) NOT NULL,
  `education_in_detail` varchar(500) NOT NULL,
  `occupation_in_detail` varchar(500) NOT NULL,
  `fathers_status` varchar(500) NOT NULL,
  `mothers_status` varchar(500) NOT NULL,
  `no_of_brothers` varchar(500) NOT NULL,
  `brothers_married` varchar(500) NOT NULL,
  `no_of_sisters` varchar(500) NOT NULL,
  `sisters_married` varchar(500) NOT NULL,
  `about_my_family` varchar(500) NOT NULL,
  `facebook` varchar(500) DEFAULT NULL,
  `twitter` varchar(500) DEFAULT NULL,
  `google_plus` varchar(500) DEFAULT NULL,
  `upgrade_status` int(11) NOT NULL,
  `profile_strength` varchar(500) NOT NULL,
  `user_visibility` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=164 ;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `user_id`, `name`, `age`, `religion`, `other_religion`, `caste`, `other_caste`, `path`, `img_status`, `height`, `weight`, `marital_status`, `children`, `body_type`, `complexion`, `mother_tongue`, `education`, `other_education`, `occupation`, `annual_income`, `hobbies`, `photo`, `family_values`, `family_type`, `employedin`, `habits`, `physical_status`, `district_id`, `package_payment`, `smoking_habits`, `drinking_habit`, `sudhhajadhagam`, `star`, `rassi_moonsign`, `other_moonsign`, `familystatus`, `eating_habits`, `other_star`, `zodiac_starsign`, `other_zodiac`, `country_livingin`, `other_country_livingin`, `citizenship`, `other_citizenship`, `state`, `other_residing_state`, `district`, `other_residing_city`, `other_highesteducation`, `other_occupation`, `college`, `education_in_detail`, `occupation_in_detail`, `fathers_status`, `mothers_status`, `no_of_brothers`, `brothers_married`, `no_of_sisters`, `sisters_married`, `about_my_family`, `facebook`, `twitter`, `google_plus`, `upgrade_status`, `profile_strength`, `user_visibility`) VALUES
(150, 240, 'Anna', '', '3', '', '21', '', 'assets/profileimages/de98cbe2a2f790b07416f6eb056f44be.jpg', 1, '136', '40', 'Never Married', '', 'Slim', 'Fair', '1', '2', '', '1', 'Monthly', '', '', 'Moderate', 'Nuclear Family', 'Private', '', 'Normal', '', 0, 'No', 'No', '', '1', '1', '', 'Middle Class', 'Non Vegetarian', '', '1', '', '98', '', '', '', '14', '', '49', '', '', '', 'Punjar Engineering College', 'B.tech,Punjar Engineering College,Kottayam', 'worked at Engineering college', 'Father is Alexander', 'Mother is Mariya', '1', '1', '1', '1', 'I am Anna.I am a BE graduate from Cochi university.I have completed a B.Tech course .Now I am working as Teacher in a private firm.', 'fb.com', 'mobile.twitter.com', 'plus.google.com', 0, '88', '{"name":"1","body_type":"1","complexion":"1","height":"1","physical_status":"0","weight":"1","marital_status":"1","eating_habits":"1","drinking_habits":"1","smoking_habits":"1","religion":"1","caste":"1","star":"1","rasi":"1","zodiac":"1","country":"1","state":"1","mother_tongue":"1","district":"1","education":"1","occupation":"1","college":"1","education_in_detail":"1","occupation_in_detail":"1","employed_in":"1","annual_income":"1","fathers_status":"1","mother_status":"1","family_values":"1","family_type":"1","family_status":"1","no_of_brothers":"1","no_of_sisters":"1","brothers_married":"1","sisters_married":"0","about_my_family":"1"}'),
(151, 241, 'amal', '', '3', '', '21', '', 'assets/profileimages/amal.jpg', 1, '140', '44', 'Never Married', '', 'Slim', 'Fair', '1', '2', '', '1', 'Below 1,00,000/-', '', '', 'Traditional', 'Nuclear Family', 'Government', '', 'Normal', '', 0, 'No', 'No', '', '1', '1', '', 'Rich', 'Vegetarian', '', '2', '', '98', '', '', '', '14', '', '49', '', '', '', 'mangalam college of engineering', 'B.tech,mangalam Engineering College,Kottayam', 'Web Designer', 'Father is Thankachan', 'Mother is Mini', '2', 'None', '2', '2', 'I am Amal.I am a BE graduate from M.G university.I have completed a B.Tech course .Now I am working as Web Designer in a private firm.', 'fb.com', 'mobile.twitter.com', 'plus.google.com', 0, '88', '{"name":"1","body_type":"1","complexion":"1","height":"1","physical_status":"0","weight":"1","marital_status":"1","eating_habits":"1","drinking_habits":"1","smoking_habits":"1","religion":"1","caste":"1","star":"1","rasi":"1","zodiac":"1","country":"1","state":"1","mother_tongue":"1","district":"1","education":"1","occupation":"1","college":"1","education_in_detail":"1","occupation_in_detail":"1","employed_in":"1","annual_income":"1","fathers_status":"1","mother_status":"1","family_values":"1","family_type":"1","family_status":"1","no_of_brothers":"1","no_of_sisters":"1","brothers_married":"1","sisters_married":"0","about_my_family":"1"}'),
(152, 242, 'Raju', '', '2', '', '19', '', 'assets/images/default_profile.jpg', 0, '142', '40', 'Never Married', '', 'Slim', 'Fair', '1', '1', '', '1', 'Monthly', '', '', 'Orthodox', 'Nuclear Family', 'Private', '', 'Normal', '', 0, 'No', 'No', '', '1', '1', '', 'Middle Class', 'Non Vegetarian', '', '1', '', '1', '', '', '', '14', '', '48', '', '', '', 'Punjar Engineering College', 'B.tech,Punjar Engineering College,Kottayam', 'worked at Engineering college', 'Father is Ramu', 'Mother is Maya', '0', '0', '0', '0', 'I am Raju.I am a BE graduate from Cochi university.I have completed a B.Tech course .Now I am working as Teacher in a private firm.', 'fb.com', 'mobile.twitter.com', 'plus.google.com', 0, '70', '{"name":"1","body_type":"1","complexion":"1","height":"1","physical_status":"0","weight":"1","marital_status":"1","eating_habits":"1","drinking_habits":"1","smoking_habits":"1","religion":"1","caste":"1","star":"1","rasi":"1","zodiac":"1","country":"1","state":"1","mother_tongue":"1","district":"1","education":"1","occupation":"1","college":"1","education_in_detail":"1","occupation_in_detail":"1","employed_in":"1","annual_income":"1","fathers_status":"1","mother_status":"1","family_values":"1","family_type":"1","family_status":"1","no_of_brothers":"1","no_of_sisters":"1","brothers_married":"1","sisters_married":"0","about_my_family":"1"}'),
(153, 243, 'Radha', '', '2', '', '19', '', 'assets/profileimages/66e5e2df03e69b648cb84caea2c1553c.jpg', 1, '140', '35', 'Never Married', '', 'Slim', 'Fair', '1', '1', '', '1', 'Monthly', '', '', 'Orthodox', 'Nuclear Family', 'Private', '', 'Normal', '', 0, 'No', 'No', '', '1', '1', '', 'Middle Class', 'Non Vegetarian', '', '1', '', '1', '', '', '', '14', '', '48', '', '', '', 'CE college', 'Aeronautical Engineering', 'worked at Chennai airport', 'Father is Rash', 'Mother is Maya', '1', '1', '1', '1', 'I am Radha.I am a AE graduate from Cochi university.I have completed a AE course .Now I am working as Pilotin a private firm.', 'fb.com', 'mobile.twitter.com', 'plus.google.com', 0, '88', '{"name":"1","body_type":"1","complexion":"1","height":"1","physical_status":"0","weight":"1","marital_status":"1","eating_habits":"1","drinking_habits":"1","smoking_habits":"1","religion":"1","caste":"1","star":"1","rasi":"1","zodiac":"1","country":"1","state":"1","mother_tongue":"1","district":"1","education":"1","occupation":"1","college":"1","education_in_detail":"1","occupation_in_detail":"1","employed_in":"1","annual_income":"1","fathers_status":"1","mother_status":"1","family_values":"1","family_type":"1","family_status":"1","no_of_brothers":"1","no_of_sisters":"1","brothers_married":"1","sisters_married":"0","about_my_family":"1"}'),
(154, 244, 'Sha', '', '51', '', '26', '', 'assets/images/default_profile.jpg', 0, '146', '58', 'Never Married', '', 'Slim', 'Fair', '3', '2', '', '1', 'Monthly', '', '', 'Traditional', 'Nuclear Family', 'Government', '', 'Normal', '', 0, 'No', 'No', '', '1', '1', '', 'Upper Middle Class', 'Non Vegetarian', '', '1', '', '1', '', '', '', '2', '', '12', '', '', '', 'mangalam college of engineering', 'B.tech,mangalam Engineering College,Kottayam', 'manager', 'Father is Hamd', 'Mother is Mash', '2', '2', '0', '2', 'I am Sha.I am a BE graduate from Cochi university.I have completed a B.Tech course .Now I am working as Manager in a govt firm.', 'fb.com', 'mobile.twitter.com', 'plus.google.com', 0, '76', '{"name":"1","body_type":"1","complexion":"1","height":"1","physical_status":"0","weight":"1","marital_status":"1","eating_habits":"1","drinking_habits":"1","smoking_habits":"1","religion":"1","caste":"1","star":"1","rasi":"1","zodiac":"1","country":"1","state":"1","mother_tongue":"1","district":"1","education":"1","occupation":"1","college":"1","education_in_detail":"1","occupation_in_detail":"1","employed_in":"1","annual_income":"1","fathers_status":"1","mother_status":"1","family_values":"1","family_type":"1","family_status":"1","no_of_brothers":"1","no_of_sisters":"1","brothers_married":"1","sisters_married":"0","about_my_family":"1"}'),
(155, 245, 'shahina', '', '51', '', '26', '', 'assets/profileimages/28f5f6f04b08b0c436846d5d17f81a76.jpg', 0, '135', '52', 'Never Married', '', 'Slim', 'Fair', '3', '2', '', '1', 'Monthly', '', '', 'Moderate', 'Nuclear Family', 'Private', '', 'Normal', '', 0, 'No', 'No', '', '1', '1', '', 'Upper Middle Class', 'Vegetarian', '', '1', '', '1', '', '', '', '2', '', '12', '', '', '', 'mangalam college of engineering', 'B.tech,Punjar Engineering College,Kottayam', 'HR manager', 'Father is Raagh', 'Mother is Mashiya', '1', '0', '0', '0', 'I am shahina.I am a BE graduate from Cochi university.I have completed a BE course .Now I am working as  HR in a private firm.', 'fb.com', 'mobile.twitter.com', 'plus.google.com', 0, '82', '{"name":"1","body_type":"1","complexion":"1","height":"1","physical_status":"0","weight":"1","marital_status":"1","eating_habits":"1","drinking_habits":"1","smoking_habits":"1","religion":"1","caste":"1","star":"1","rasi":"1","zodiac":"1","country":"1","state":"1","mother_tongue":"1","district":"1","education":"1","occupation":"1","college":"1","education_in_detail":"1","occupation_in_detail":"1","employed_in":"1","annual_income":"1","fathers_status":"1","mother_status":"1","family_values":"1","family_type":"1","family_status":"1","no_of_brothers":"1","no_of_sisters":"1","brothers_married":"1","sisters_married":"0","about_my_family":"1"}'),
(156, 246, 'aagman', '', '2', '', '19', '', 'assets/images/default_profile.jpg', 0, '151', '70', 'Never Married', '', 'Slim', 'Fair', '1', '2', '', '1', 'Monthly', '', '', 'Moderate', 'Nuclear Family', 'Government', '', 'Normal', '', 0, 'No', 'No', '', '1', '1', '', 'Middle Class', 'Vegetarian', '', '1', '', '1', '', '', '', '14', '', '49', '', '', '', 'Punjar Engineering College', 'B.tech,Punjar Engineering College,Kottayam', 'worked at Engineering college', 'Father is adarsh', 'Mother is Meera', '1', '1', '1', '1', 'I am Aagman.I am a BE graduate from Cochi university.I have completed a B.Tech course .Now I am working as Teacher in a private firm.', 'fb.com', 'mobile.twitter.com', 'plus.google.com', 0, '78', '{"name":"1","body_type":"1","complexion":"1","height":"1","physical_status":"0","weight":"1","marital_status":"1","eating_habits":"1","drinking_habits":"1","smoking_habits":"1","religion":"1","caste":"1","star":"1","rasi":"1","zodiac":"1","country":"1","state":"1","mother_tongue":"1","district":"1","education":"1","occupation":"1","college":"1","education_in_detail":"1","occupation_in_detail":"1","employed_in":"1","annual_income":"1","fathers_status":"1","mother_status":"1","family_values":"1","family_type":"1","family_status":"1","no_of_brothers":"1","no_of_sisters":"1","brothers_married":"1","sisters_married":"0","about_my_family":"1"}'),
(157, 247, 'lekshmi', '', '2', '', '19', '', 'assets/images/default_profile.jpg', 0, '143', '51', 'Never Married', '', 'Slim', 'Very Fair', '1', '2', '', '1', 'Monthly', '', '', 'Liberal', 'Nuclear Family', 'Private', '', 'Normal', '', 0, 'No', 'No', '', '1', '1', '', 'Upper Middle Class', 'Vegetarian', '', '1', '', '1', '', '', '', '14', '', '49', '', '', '', 'Punjar Engineering College', 'B.tech,mangalam Engineering College,Kottayam', 'worked as officer', 'Father is Raman', 'Mother is malu', '0', '0', '0', '0', 'I am lekshmi.I am a BE graduate from Cochi university.I have completed a BE course .Now I am working as Officer in a private firm.', 'fb.com', 'mobile.twitter.com', 'plus.google.com', 0, '70', '{"name":"1","body_type":"1","complexion":"1","height":"1","physical_status":"0","weight":"1","marital_status":"1","eating_habits":"1","drinking_habits":"1","smoking_habits":"1","religion":"1","caste":"1","star":"1","rasi":"1","zodiac":"1","country":"1","state":"1","mother_tongue":"1","district":"1","education":"1","occupation":"1","college":"1","education_in_detail":"1","occupation_in_detail":"1","employed_in":"1","annual_income":"1","fathers_status":"1","mother_status":"1","family_values":"1","family_type":"1","family_status":"1","no_of_brothers":"1","no_of_sisters":"1","brothers_married":"1","sisters_married":"0","about_my_family":"1"}'),
(158, 248, 'liya', '', '3', '', '21', '', 'assets/profileimages/18ddef5ab7cabb4042a929b66b7f5a44.jpg', 1, '142', '52', 'Never Married', '', 'Slim', 'Fair', '1', '2', '', '1', 'Monthly', '', '', 'Traditional', 'Nuclear Family', 'Private', '', 'Normal', '', 0, 'No', 'No', '', '1', '1', '', 'Upper Middle Class', 'Non Vegetarian', '', '2', '', '1', '', '', '', '14', '', '49', '', '', '', 'mangalam college of engineering', 'B.tech,mangalam Engineering College,Kottayam', 'worked at bank', 'Father is Alex', 'Mother is Mariyam', '1', '1', '2', '0', 'I am Radha.I am a BE graduate from Cochi university.I have completed a BE course .Now I am working as clerk in a private firm.', 'fb.com', 'mobile.twitter.com', 'plus.google.com', 0, '86', '{"name":"1","body_type":"1","complexion":"1","height":"1","physical_status":"0","weight":"1","marital_status":"1","eating_habits":"1","drinking_habits":"1","smoking_habits":"1","religion":"1","caste":"1","star":"1","rasi":"1","zodiac":"1","country":"1","state":"1","mother_tongue":"1","district":"1","education":"1","occupation":"1","college":"1","education_in_detail":"1","occupation_in_detail":"1","employed_in":"1","annual_income":"1","fathers_status":"1","mother_status":"1","family_values":"1","family_type":"1","family_status":"1","no_of_brothers":"1","no_of_sisters":"1","brothers_married":"1","sisters_married":"0","about_my_family":"1"}'),
(159, 249, 'rose', '', '3', '', '24', '', 'assets/images/default_profile.jpg', 0, '135', '36', 'Never Married', '', 'Slim', 'Very Fair', '3', '1', '', '1', 'Annual', '', '', 'Orthodox', 'Joint Family', 'Government', '', 'Handicapped', '', 0, 'Occasionally', 'Occasionally', '', '1', '1', '', 'Middle Class', 'Non Vegetarian', '', '1', '', '1', '', '', '', '2', '', '12', '', '', '', 'test', 'test', 'test', 'Father is Ramu', 'Mother is Mariyam', '2', '2', '1', '1', 'I am Aagman.I am a BE graduate from Cochi university.I have completed a B.Tech course .Now I am working as Teacher in a private firm.', 'fb.com', 'mobile.twitter.com', 'plus.google.com', 0, '78', '{"name":"1","body_type":"1","complexion":"1","height":"1","physical_status":"0","weight":"1","marital_status":"1","eating_habits":"1","drinking_habits":"1","smoking_habits":"1","religion":"1","caste":"1","star":"1","rasi":"1","zodiac":"1","country":"1","state":"1","mother_tongue":"1","district":"1","education":"1","occupation":"1","college":"1","education_in_detail":"1","occupation_in_detail":"1","employed_in":"1","annual_income":"1","fathers_status":"1","mother_status":"1","family_values":"1","family_type":"1","family_status":"1","no_of_brothers":"1","no_of_sisters":"1","brothers_married":"1","sisters_married":"0","about_my_family":"1"}'),
(160, 250, 'angel', '', '3', '', '21', '', 'assets/profileimages/8da309c1b652aae76dc570358a7f7e58.jpg', 1, '153', '44', 'Never Married', '', 'Slim', 'Wheatish', '1', '2', '', '1', 'Monthly', '', '', 'Liberal', 'Nuclear Family', 'Private', '', 'Normal', '', 0, 'No', 'No', '', '1', '1', '', 'Upper Middle Class', 'Non Vegetarian', '', '1', '', '1', '', '', '', '14', '', '49', '', '', '', 'test', 'test', 'test', 'test', 'test', '0', '1', '0', '0', 'I am Angel.I am a AE graduate from Cochi university.I have completed a AE course .Now I am working as airhostess in a private firm.', 'fb.com', 'mobile.twitter.com', 'plus.google.com', 0, '82', '{"name":"1","body_type":"1","complexion":"1","height":"1","physical_status":"0","weight":"1","marital_status":"1","eating_habits":"1","drinking_habits":"1","smoking_habits":"1","religion":"1","caste":"1","star":"1","rasi":"1","zodiac":"1","country":"1","state":"1","mother_tongue":"1","district":"1","education":"1","occupation":"1","college":"1","education_in_detail":"1","occupation_in_detail":"1","employed_in":"1","annual_income":"1","fathers_status":"1","mother_status":"1","family_values":"1","family_type":"1","family_status":"1","no_of_brothers":"1","no_of_sisters":"1","brothers_married":"1","sisters_married":"0","about_my_family":"1"}'),
(161, 251, 'jose', '', '3', '', '21', '', 'assets/profileimages/0a63281c6f3ad6e31412141224686d59.jpg', 1, '159', '73', 'Never Married', '', 'Athletic', 'Wheatish Brown', '1', '2', '', '1', 'Monthly', '', '', 'Liberal', 'Nuclear Family', 'Government', '', 'Normal', '', 0, 'No', 'Occasionally', '', '1', '1', '', 'Upper Middle Class', 'Non Vegetarian', '', '1', '', '1', '', '', '', '14', '', '49', '', '', '', 'test', 'test', 'test', 'test', 'test', '1', '1', '2', '2', 'I am Jose.I am a AE graduate from Cochi university.I have completed a AE course .Now I am working as pilotin a private firm.', 'fb.com', 'mobile.twitter.com', 'plus.google.com', 0, '88', '{"name":"1","body_type":"1","complexion":"1","height":"1","physical_status":"0","weight":"1","marital_status":"1","eating_habits":"1","drinking_habits":"1","smoking_habits":"1","religion":"1","caste":"1","star":"1","rasi":"1","zodiac":"1","country":"1","state":"1","mother_tongue":"1","district":"1","education":"1","occupation":"1","college":"1","education_in_detail":"1","occupation_in_detail":"1","employed_in":"1","annual_income":"1","fathers_status":"1","mother_status":"1","family_values":"1","family_type":"1","family_status":"1","no_of_brothers":"1","no_of_sisters":"1","brothers_married":"1","sisters_married":"0","about_my_family":"1"}'),
(162, 252, 'jacob', '', '3', '', '21', '', 'assets/profileimages/3bcefd06d7addf805e9417a7387788bf.jpg', 1, '162', '66', 'Never Married', '', 'Slim', 'Wheatish', '1', '1', '', '1', 'Monthly', '', '', 'Traditional', 'Joint Family', 'Private', '', 'Normal', '', 0, 'No', 'No', '', '1', '1', '', 'Middle Class', 'Vegetarian', '', '1', '', '1', '', '', '', '14', '', '49', '', '', '', 'test', 'test', 'test', 'test', 'test', '1', '1', '2', '2', 'I am jacob.I am a BE graduate from Cochi university.I have completed a B.Tech course .Now I am working as sir in a private firm.', 'fb.com', 'mobile.twitter.com', 'plus.google.com', 0, '88', '{"name":"1","body_type":"1","complexion":"1","height":"1","physical_status":"0","weight":"1","marital_status":"1","eating_habits":"1","drinking_habits":"1","smoking_habits":"1","religion":"1","caste":"1","star":"1","rasi":"1","zodiac":"1","country":"1","state":"1","mother_tongue":"1","district":"1","education":"1","occupation":"1","college":"1","education_in_detail":"1","occupation_in_detail":"1","employed_in":"1","annual_income":"1","fathers_status":"1","mother_status":"1","family_values":"1","family_type":"1","family_status":"1","no_of_brothers":"1","no_of_sisters":"1","brothers_married":"1","sisters_married":"0","about_my_family":"1"}'),
(163, 253, 'Remya', '', '3', '', '21', '', 'assets/profileimages/7f19eca4da09bf5ac818a1c318714e08.jpg', 1, '155', '46', 'Never Married', '', 'Slim', 'Fair', '3', '1', '', '1', 'Monthly', '', '', 'Moderate', 'Nuclear Family', 'Government', '', 'Normal', '', 0, 'No', 'No', '', '1', '1', '', 'Middle Class', 'Non Vegetarian', '', '1', '', '1', '', '', '', '14', '', '49', '', '', '', 'ngfngf', 'gffg', 'gnfgnf', 'hgdg', 'hgdfhdgf', '2', '2', '3', '3', 'fdtcdddddddddddddddddddddddddddftyfyffffffffffffffffffffffffffffff', 'fb.com', 'mobile.twitter.com', 'plus.google.com', 0, '88', '{"name":"1","body_type":"1","complexion":"1","height":"1","physical_status":"0","weight":"1","marital_status":"1","eating_habits":"1","drinking_habits":"1","smoking_habits":"1","religion":"1","caste":"1","star":"1","rasi":"1","zodiac":"1","country":"1","state":"1","mother_tongue":"1","district":"1","education":"1","occupation":"1","college":"1","education_in_detail":"1","occupation_in_detail":"1","employed_in":"1","annual_income":"1","fathers_status":"1","mother_status":"1","family_values":"1","family_type":"1","family_status":"1","no_of_brothers":"1","no_of_sisters":"1","brothers_married":"1","sisters_married":"0","about_my_family":"1"}');

-- --------------------------------------------------------

--
-- Table structure for table `user_reg`
--
DROP TABLE `user_reg`;
CREATE TABLE IF NOT EXISTS `user_reg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rand_id` varchar(150) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `change_email` varchar(500) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `date` date NOT NULL,
  `contact_num` int(11) NOT NULL,
  `deactivate_status` int(11) NOT NULL,
  `deactivate_days` int(11) NOT NULL,
  `deactivation_date` date NOT NULL,
  `conf_code` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `approval_status` varchar(50) NOT NULL,
  `notification` varchar(150) NOT NULL,
  `email_key` longtext,
  `remember_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=254 ;

--
-- Dumping data for table `user_reg`
--

INSERT INTO `user_reg` (`id`, `rand_id`, `username`, `password`, `email`, `change_email`, `gender`, `dob`, `date`, `contact_num`, `deactivate_status`, `deactivate_days`, `deactivation_date`, `conf_code`, `status`, `approval_status`, `notification`, `email_key`, `remember_token`) VALUES
(240, 'B9QHBEVJ', 'Anna', 'MTIzNA==', 'anna@gmail.com', '', 'female', '1993-04-23', '2016-02-11', 2147483647, 0, 0, '0000-00-00', '', 'offline', '', '', NULL, NULL),
(241, '722PDXQX', 'Amal', 'MTIzNA==', 'demo@gmail.com', '', 'male', '1993-04-13', '2016-02-11', 2147483647, 0, 0, '0000-00-00', '', 'online', '', '', NULL, NULL),
(242, 'FBTIT0DG', 'Raju', 'MTIzNA==', 'raju@gmail.com', '', 'male', '1988-06-11', '2016-02-11', 2147483647, 0, 0, '0000-00-00', '', 'offline', '', '', NULL, NULL),
(243, '2WAGQ8NM', 'Radha', 'MTIzNA==', 'radha@gmail.com', '', 'female', '1992-06-11', '2016-02-11', 2147483647, 0, 0, '0000-00-00', '', 'offline', '', '', NULL, NULL),
(244, '1O6GR3BT', 'sha', 'MTIzNA==', 'sha@gmail.com', '', 'male', '1986-06-11', '2016-02-11', 2147483647, 0, 0, '0000-00-00', '', 'offline', '', '', NULL, NULL),
(245, 'K0ZCT0OO', 'shahina', 'MTIzNA==', 'shahina@gmail.com', '', 'female', '1988-06-11', '2016-02-11', 1111111111, 0, 0, '0000-00-00', '', 'offline', '', '', NULL, NULL),
(246, 'TOIIZUG7', 'aagman', 'MTIzNA==', 'aagman@gmail.com', '', 'male', '1987-06-11', '2016-02-11', 2147483647, 0, 0, '0000-00-00', '', 'offline', '', '', NULL, NULL),
(247, '6HBQFCO4', 'Lekshmi', 'MTIzNA==', 'lekshmi@gmail.com', '', 'female', '1990-06-11', '2016-02-11', 2147483647, 0, 0, '0000-00-00', '', 'offline', '', '', NULL, NULL),
(248, 'F8VLWLDA', 'liya', 'MTIzNA==', 'liya@gmail.com', '', 'female', '1987-06-11', '2016-02-11', 2147483647, 0, 0, '0000-00-00', '', 'offline', '', '', NULL, NULL),
(249, 'TVSOGQG1', 'rose', 'MTIzNA==', 'rose@gmail.com', '', 'female', '1991-06-11', '2016-02-11', 2147483647, 0, 0, '0000-00-00', '', 'offline', '', '', NULL, NULL),
(250, 'L1Z9O8JO', 'angel', 'MTIzNA==', 'angel@gmail.com', '', 'female', '1991-07-11', '2016-02-11', 2147483647, 0, 0, '0000-00-00', '', 'offline', '', '', NULL, NULL),
(251, 'J6MCC92Z', 'jose', 'MTIzNA==', 'jose@gmail.com', '', 'male', '1991-07-11', '2016-02-11', 2147483647, 0, 0, '0000-00-00', '', 'offline', '', '', NULL, NULL),
(252, 'L5TT1HTJ', 'jacob', 'MTIzNA==', 'jacob@gmail.com', '', 'male', '1990-07-11', '2016-02-11', 2147483647, 0, 0, '0000-00-00', '', 'offline', '', '', NULL, NULL),
(253, '3KLC2ARQ', 'Remya', 'MTIzNA==', 'remya@gmail.com', '', 'female', '1991-07-11', '2016-02-11', 2147483647, 0, 0, '0000-00-00', '', 'offline', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `zodiac_starsign`
--
DROP TABLE `zodiac_starsign`;
CREATE TABLE IF NOT EXISTS `zodiac_starsign` (
  `zodiac_starsign_id` int(11) NOT NULL AUTO_INCREMENT,
  `rassi_id` int(11) NOT NULL,
  `zodiac_starsign` varchar(250) NOT NULL,
  PRIMARY KEY (`zodiac_starsign_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `zodiac_starsign`
--

INSERT INTO `zodiac_starsign` (`zodiac_starsign_id`, `rassi_id`, `zodiac_starsign`) VALUES
(1, 1, 'Aries'),
(2, 6, 'Taurus'),
(3, 0, 'Gemini'),
(4, 0, 'Cancer'),
(5, 0, 'Leo'),
(6, 0, 'Virgo'),
(7, 0, 'Libra'),
(8, 0, 'Scorpio'),
(9, 0, 'Sagittarius'),
(10, 0, 'Capricorn'),
(11, 0, 'Aquarius'),
(12, 0, 'Pisces');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
