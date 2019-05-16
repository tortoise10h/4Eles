-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2019 at 05:37 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `4eles`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `totalPrice` int(11) NOT NULL,
  `processStatus` int(11) NOT NULL DEFAULT '1',
  `customerID` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`id`, `created_at`, `totalPrice`, `processStatus`, `customerID`, `status`) VALUES
('11052019191400', '2019-05-11 19:14:00', 210, 1, 13, 1),
('11052019191534', '2019-05-11 19:15:34', 249, 1, 13, 1),
('11052019191703', '2019-05-11 19:17:03', 189, 4, 13, 1),
('12052019111159', '2019-05-12 11:11:59', 90, 4, 14, 1),
('14052019180918', '2019-05-14 18:09:19', 100, 3, 15, 1),
('15052019093754', '2019-05-15 09:37:54', 175, 1, 16, 1),
('15052019093827', '2019-05-15 09:38:27', 20, 1, 16, 1),
('15052019140249', '2019-05-15 14:02:49', 30, 1, 15, 1),
('15052019140323', '2019-05-15 14:03:23', 100, 1, 15, 1),
('15052019140428', '2019-05-15 14:04:28', 80, 1, 15, 1),
('15052019150937', '2019-05-15 15:09:37', 370, 1, 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `billdetail`
--

CREATE TABLE `billdetail` (
  `billID` varchar(100) NOT NULL,
  `productID` varchar(155) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `totalPrice` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `billdetail`
--

INSERT INTO `billdetail` (`billID`, `productID`, `quantity`, `totalPrice`, `created_at`, `status`) VALUES
('11052019191400', 'fig13', 3, 90, '2019-05-11 19:14:00', 1),
('11052019191400', 'hat12', 2, 120, '2019-05-11 19:14:00', 1),
('11052019191534', 'fig17', 3, 129, '2019-05-11 19:15:34', 1),
('11052019191534', 'hat12', 2, 120, '2019-05-11 19:15:34', 1),
('11052019191703', 'fig15', 1, 60, '2019-05-11 19:17:03', 1),
('11052019191703', 'fig17', 3, 129, '2019-05-11 19:17:03', 1),
('12052019111159', 'fig13', 3, 90, '2019-05-12 11:12:00', 1),
('14052019180918', 'fig21', 1, 75, '2019-05-14 18:09:19', 1),
('14052019180918', 'shi21', 1, 25, '2019-05-14 18:09:19', 1),
('15052019093754', 'fig12', 1, 50, '2019-05-15 09:37:54', 1),
('15052019093754', 'shi21', 5, 125, '2019-05-15 09:37:54', 1),
('15052019093827', 'hat21', 1, 20, '2019-05-15 09:38:28', 1),
('15052019140249', 'fig13', 1, 30, '2019-05-15 14:02:49', 1),
('15052019140323', 'fig12', 2, 100, '2019-05-15 14:03:23', 1),
('15052019140428', 'plu21', 1, 80, '2019-05-15 14:04:28', 1),
('15052019150937', 'fig12', 1, 50, '2019-05-15 15:09:37', 1),
('15052019150937', 'plu19', 8, 320, '2019-05-15 15:09:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryID` varchar(100) NOT NULL,
  `categoryName` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `categoryName`, `status`, `created_at`) VALUES
('fig', 'Figure', 1, '2019-05-12 11:35:33'),
('hat', 'Hat', 1, '2019-05-12 11:35:47'),
('plu', 'Plush', 1, '2019-05-12 11:35:47'),
('shi', 'Shirt', 1, '2019-05-12 11:35:33');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `categoryID` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `total` int(11) NOT NULL,
  `description` mediumtext NOT NULL,
  `imgLink` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `categoryID`, `price`, `total`, `description`, `imgLink`, `color`, `status`, `created_at`) VALUES
('fig00', 'Pikachu, Bulbasaur, Charmander & Squirtle', 'fig', 30, 0, 'Includes figures of Bulbasaur, Charmander, and Squirtle, plus a Pokémon Center-exclusive Pikachu%\r\n	Included face plates let you change Red’s expression between a quiet, confident look and a dynamic, battling look%\r\n	lso comes with a backpack, Poké Ball, and articulated figma stand%\r\n	Features smooth yet posable joints, plus flexible plastic that retains its proportions%', '/images/products/fig/fig00', 'yellow', 1, '2019-03-27 16:59:30'),
('fig01', 'Pokémon Gallery Figure DX: Mewtwo-Psystrike', 'fig', 44, 0, 'Measures about 5 1/2 inches tall—larger than standard Pokémon Gallery Figures%\r\n	Includes Mewtwo figure with attached base (other pictured items not included)%\r\n	Watch out for that Psystrike attack!%Pokémon Center Original%', '/images/products/fig/fig01', 'pink', 1, '2019-03-27 16:59:30'),
('fig02', 'PokmonFigureDX:Charizard-BlastBurn', 'fig', 50, 0, 'Measuresabout41', '/images/products/fig/fig02', 'orange', 1, '2019-03-27 16:59:30'),
('fig03', 'Pokémon Gallery Figure: Umbreon—Dark Pulse', 'fig', 30, 0, 'Umbreon in the midst of its Dark Pulse power!%Part of the Gallery Figure line%', '/images/products/fig/fig03', 'purple', 1, '2019-03-27 17:04:37'),
('fig04', 'PokmonGalleryFigure:EspeonLightScreen', 'fig', 60, 0, 'Espeoncaughtinmid-leap!%PartoftheGalleryFigureline%KhoaakakingofBinhChanh%huhuhu%hihih%', '/images/products/fig/fig04', 'white', 1, '2019-03-27 17:04:37'),
('fig05', 'Pokémon Gallery Figure: Mew—Psychic', 'fig', 33, 0, 'Amazing battle pose!%Pokémon Center original%', '/images/products/fig/fig05', 'pink', 1, '2019-03-27 17:04:37'),
('fig06', 'PokmonFigure:PikachuThunderbolt', 'fig', 50, 3, 'Amazingbattlepose!%PokmonCenteroriginal%huyhuyhuy%', '/images/products/fig/fig06', 'yellow', 1, '2019-03-27 17:06:41'),
('fig07', 'Pokémon Gallery Figure: Absol-Perish Song', 'fig', 60, 0, 'Translucent orange and purple effects catch the light to help set a scene%\r\n	Part of the Pokémon Gallery Figures collection%', '/images/products/fig/fig07', 'orange', 1, '2019-03-27 17:06:41'),
('fig08', 'Pokémon Gallery Figure DX: Gengar-Shadow Ball', 'fig', 30, 0, 'Measures about 6 inches tall—larger than standard Pokémon Gallery Figures%\r\n	Includes Gengar figure with attached base (other pictured items not included)%\r\n	A figure full of ghostly fun!%\r\n	Pokémon Center Original%', '/images/products/fig/fig08', 'purple', 1, '2019-03-27 17:06:41'),
('fig09', 'Pokémon Gallery Figure: Vulpix—Fire Spin', 'fig', 48, 0, 'Vulpix leaping through transparent flames!%Part of the Gallery Figure line%', '/images/products/fig/fig09', 'orange', 1, '2019-03-27 17:06:41'),
('fig10', 'Pokémon Gallery Figure: Psyduck—Confusion', 'fig', 55, 0, 'Psyduck shows off a bit of psychic power!%Part of the Gallery Figure line%', '/images/products/fig/fig10', 'yellow', 1, '2019-03-27 17:06:41'),
('fig11', 'Pokémon Gallery Figure: Magikarp—Splash', 'fig', 30, 0, 'Amazing battle pose!%Pokémon Center original%', '/images/products/fig/fig11', 'blue', 1, '2019-03-27 17:06:41'),
('fig12', 'Pokmon Gallery Figure: Eevee Swift ', 'fig', 50, 0, 'Amazing battle pose!%Pokmon Center original%', '/images/products/fig/fig12', 'brown', 1, '2019-03-27 17:07:48'),
('fig123', 'abc', 'fig', 10, 20, 'dfjsnfjsdf%sdfsdfsdf-sd%sdfsdf%-', '/images/products/fig/fig123', 'yellow', 1, '2019-05-15 15:13:24'),
('fig13', 'Pokmon Gallery Figure :Cubone BoneClub', 'fig', 30, 0, 'Cu bones skull and bone look amazing!%Part of the Gallery Figure line%huy huy huy%', '/images/products/fig/fig13', 'grey', 1, '2019-03-27 17:07:48'),
('fig14', 'PokmonGalleryFigure:Delibird-Present', 'fig', 40, 0, 'Stars, clouds,andonebigPresent!%PartofthePokmonGalleryFigurescollection%PokmonCenterOriginal%NguyenTanHuy%', '/images/products/fig/fig14', 'red', 0, '2019-03-27 17:07:48'),
('fig15', 'Pokémon Gallery Figure: Litten—Ember', 'fig', 60, 0, 'Litten on the prowl!%Alolan first partner Pokémon%Pokémon Center Original design%', '/images/products/fig/fig15', 'orange', 1, '2019-03-27 17:07:48'),
('fig16', 'Nendoroid:RedPosableFigure', 'fig', 30, 0, 'ThespiritofthePokmonTrainerinaposablefigure!%Nendoroidcollectiblefigure%ComeswiththreeuniqueexpressionsandthreePokmonfriends!%Includesabodyandthreelegswithsixarmsandhandsplushairandhat%huyhuyhuyhuy%', '/images/products/fig/fig16', 'blue', 1, '2019-03-27 17:07:48'),
('fig17', 'Nendoroid: Lana Posable Figure', 'fig', 43, 0, 'Pose her with the adorable Wishiwashi (Solo Form) or awesome Wishiwashi (School Form)%\r\n	Pokémon Center purchases include an exclusive Dive Ball accessory%', '/images/products/fig/fig17', 'white', 1, '2019-03-27 17:07:48'),
('fig18', 'Nendoroid: N Posable Figure', 'fig', 50, 0, 'Nendoroid collectible figure%A famous figure from the Pokémon world in Nendoroid style!%\r\n	Nendoroid and Pokémon quality%N figure is hand-painted. There may be slight variations between products.%\r\n	Includes Reshiram Pokémon figure%', '/images/products/fig/fig18', 'green', 1, '2019-03-27 17:07:48'),
('fig19', 'Nendoroid: Cynthia Posable Figure', 'fig', 30, 0, 'Nendoroid collectible figure%A famous figure from the Pokémon world in Nendoroid style!%\r\n	Cynthia figure is hand-painted. There may be slight variations between products.%\r\n	Comes with two unique expressions plus a Garchomp friend!%\r\n	Change pose and details so Cynthia is just right!%', '/images/products/fig/fig19', 'yellow', 1, '2019-03-27 17:07:48'),
('fig20', 'HelloWorld', 'fig', 10, 0, 'Hello world%Hello world%Hello world%Hello world%Hello world%', '/images/products/fig/fig20', 'black', 0, '2019-05-13 23:46:21'),
('fig21', 'SuperFunnyShiba', 'fig', 75, 0, 'The most funny dog%Can make you laugh all day%Always follow you%Love children%But eat too much%', '/images/products/fig/fig21', 'orange', 1, '2019-05-13 23:55:30'),
('fig22', 'For test', 'fig', 1, 1, 'no des%', '/images/products/fig/fig22', 'Black', 0, '2019-05-14 00:18:24'),
('fig88', 'huy dep trai', 'fig', 1000, 0, 'huy dep trai%-', '/images/products/fig/fig88', 'white', 0, '2019-05-15 15:15:17'),
('hat00', 'Froakie Poké Plush Hat', 'hat', 40, 0, 'One of the most recognizable XY Pokémon%A Pokémon fan favorite%', '/images/products/hat/hat00', 'blue', 1, '2019-03-27 16:59:30'),
('hat01', 'Pokémon: Lets Go Trainer Male Baseball Cap by New Era', 'hat', 45, 0, 'A design that shows you are ready for a Pokémon battle!%Based on the male player character’s hat from Pokémon: Let’s Go, \r\nPikachu! and Pokémon: Let’s Go, Eevee!%Designed by Pokémon Center, made by New Era%', '/images/products/hat/hat01', 'red', 1, '2019-03-27 16:59:30'),
('hat02', 'Legendary Mewtwo 9FIFTY Baseball Cap by New Era', 'hat', 30, 0, 'Adjustable snapback closure provides a custom fit%Part of the Legendary Mewtwo collection%Designed by Pokémon Center, made by New Era%', '/images/products/hat/hat02', 'purple', 1, '2019-03-27 16:59:30'),
('hat03', 'Piplup Bubbly Beach 9FIFTY Baseball Cap by New Era', 'hat', 40, 0, 'Adjustable snapback closure provides a custom fit%Screen printed graphics underneath bill%\r\nPart of the Piplup Bubbly Beach collection%Designed by Pokémon Center, made by New Era%', '/images/products/hat/hat03', 'blue', 1, '2019-03-27 17:04:37'),
('hat04', 'Electric Rock 9FORTY Baseball Cap by New Era', 'hat', 45, 0, 'Snapback closure for a custom fit%This is the cap for Trainers who rock!%Part of the Electric Rock collection%Designed by Pokémon Center, made by New Era%', '/images/products/hat/hat04', 'black', 1, '2019-03-27 17:04:37'),
('hat05', 'Tapu Koko 9FIFTY Baseball Cap by New Era', 'hat', 35, 0, 'Adjustable snapback closure%Embroidered and screen printed graphics%Designed by Pokémon Center, made by New Era%', '/images/products/hat/hat05', 'orange', 1, '2019-03-27 17:04:37'),
('hat06', 'Litten’s Playhouse 9FIFTY Baseball Cap by New Era', 'hat', 40, 0, 'This is the cap for Trainers who love Litten!%Detailed embroidery%Adjustable snapback closure for the perfect fit%', '/images/products/hat/hat06', 'white', 1, '2019-03-27 17:06:41'),
('hat07', 'Fire Spinner Marowak 9FIFTY Baseball Cap by New Era', 'hat', 50, 0, 'Green accent trim on interior%Pokémon Center Original design%This is the cap for Trainers!%', '/images/products/hat/hat07', 'purple', 1, '2019-03-27 17:06:41'),
('hat08', 'Snoozing Snorlax 9FIFTY Baseball Cap by New Era', 'hat', 45, 0, 'You are so chill you’re almost asleep! Snorlax gonna chillax!%Pokemon Center Original design%', '/images/products/hat/hat08', 'blue', 1, '2019-03-27 17:06:41'),
('hat09', 'Alola Friends 9FIFTY Baseball Cap by New Era', 'hat', 30, 0, 'Bring the Pokémon of Alola to the mainland!%Bring the good times to your wardrobe!%Pokémon Center Original design%', '/images/products/hat/hat09', 'white', 1, '2019-03-27 17:06:41'),
('hat10', 'Bellossom Tropics 9FIFTY Baseball Cap by New Era', 'hat', 50, 0, 'Bright tropical Bellossom with leafy background%High-quality New Era cap%Leafy pattern underbill%Snapback closure%Pokémon Center Original%', '/images/products/hat/hat10', 'blue', 1, '2019-03-27 17:06:41'),
('hat11', 'Latios and Latias Eon Edge 9FORTY Baseball Cap by New Era', 'hat', 40, 0, 'You can get that Eon Edge for a super-sharp look!%High-quality New Era cap%Embroidered with a spiky look%', '/images/products/hat/hat11', 'white', 1, '2019-03-27 17:06:41'),
('hat12', 'Pikachu Silhouette Sync 9FIFTY Baseball Cap by New Era', 'hat', 60, 0, 'Pikachu: Thunderbolt!%High-quality New Era cap%Circle up Sync!%Snapback closure%Pokémon Center Original%', '/images/products/hat/hat12', 'black', 1, '2019-03-27 17:07:48'),
('hat13', 'Mew 9FORTY Baseball Cap by New Era', 'hat', 55, 0, 'Two-color embroidered Mew is front and center!%High-quality New Era cap%Light blue underbill%Pokémon Center Original%', '/images/products/hat/hat13', 'grey', 1, '2019-03-27 17:07:48'),
('hat14', 'Mythical Mania 9FIFTY Baseball Cap by New Era', 'hat', 40, 0, 'Mythical Pokémon from Darkrai to Celebi and Jirachi to Mew!%High-quality New Era cap%Gray underbill%', '/images/products/hat/hat14', 'blue', 1, '2019-03-27 17:07:48'),
('hat15', 'Mega Rayquaza Eclipse 9FIFTY Baseball Cap by New Era', 'hat', 60, 0, 'Mega Rayquaza goes all out!%High-quality New Era cap%Embroidered with shining green thread!%Pokémon Center Original%', '/images/products/hat/hat15', 'black', 1, '2019-03-27 17:07:48'),
('hat16', 'Gengar Smirk 9FORTY Baseball Cap by New Era', 'hat', 30, 0, 'Gengar has a big grin!%High-quality New Era cap%Purple underbill and Gengar outline on the side%Adjustable straps for a perfect fit%', '/images/products/hat/hat16', 'purple', 1, '2019-03-27 17:07:48'),
('hat17', 'Chespin Poké Plush Hat', 'hat', 40, 0, 'A first partner Pokémon from Kalos%Adjustable strap fits most%', '/images/products/hat/hat17', 'green', 1, '2019-03-27 17:07:48'),
('hat18', 'Fennekin Poké Plush Hat', 'hat', 50, 0, 'One of the most recognizable XY Pokémon%Playful style%A Pokémon fan favorite%', '/images/products/hat/hat18', 'orange', 1, '2019-03-27 17:07:48'),
('hat19', 'Pikachu Poké Plush Hat', 'hat', 45, 0, 'World’s most famous Pokémon%Soft%', '/images/products/hat/hat19', 'yellow', 1, '2019-03-27 17:07:48'),
('hat21', 'Hat shiba', 'hat', 20, 0, 'This is a hat with shiba image%This is a hat with shiba image%This is a hat with shiba image%This is a hat with shiba image%This is a hat with shiba image%', '/images/products/hat/hat21', 'orange', 1, '2019-05-14 00:12:33'),
('hat22', 'Hello hat', 'hat', 2, 0, 'hello hat%hello hat%hello hat%hello hat%hello hat%hello hat%', '/images/products/hat/hat22', 'yellow', 0, '2019-05-14 10:24:40'),
('plu00', 'Huy khá thích con này', 'plu', 50, 0, 'Team Magma logo on Pikachu outfit and belt pouch%Hood can be removed to free up Pikachu ears%\r\n	Pokémon Center Original design%\r\n	This Pikachu plush is shown here with other Pikachu plush for display purposes only—other plush sold separately%', '/images/products/plu/plu00', 'red', 1, '2019-03-27 16:59:30'),
('plu01', 'PikachuEerieDelightsPokPlush-91', 'plu', 40, 0, 'Hat and cape are sewn on%Includes Pikachu plush (other pictured items not included)%\r\n	Part of the Eerie Delights collection&\r\n	Pokémon Center Original%This is really awesome%', '/images/products/plu/plu01', 'yellow', 1, '2019-03-27 16:59:30'),
('plu02', 'Alolan Vulpix Pokémon Dolls Plush - 6 In.', 'plu', 35, 0, 'Huge embroidered eyes%Pokémon Center Original%', '/images/products/plu/plu02', 'white', 1, '2019-03-27 16:59:30'),
('plu03', 'Vaporeon Pokémon Dolls Plush - 7 In.', 'plu', 40, 0, 'Scalloped edges and fins everywhere!%Pokémon Center Original design%', '/images/products/plu/plu03', 'blue', 1, '2019-03-27 17:04:37'),
('plu04', 'Jolteon Pokémon Dolls Plush - 6.5 In.', 'plu', 60, 0, 'Lightning zigzags and a white ruff!%Pokémon Center Original design%', '/images/products/plu/plu04', 'yellow', 1, '2019-03-27 17:04:37'),
('plu05', 'Hyhy Suffed Chuschus', 'plu', 50, 0, 'Held in March, this special day revolves around displaying beautiful dolls in the court dress of the Heian period in Japan.%', '/images/products/plu/plu05', 'orange', 1, '2019-03-27 17:04:37'),
('plu06', 'Espeon Pokémon Dolls Plush - 6 In.', 'plu', 45, 0, 'Embroidered red dot and split tail!%Pokémon Center Original%', '/images/products/plu/plu06', 'purple', 1, '2019-03-27 17:06:41'),
('plu07', 'Umbreon Pokémon Dolls Plush - 6 1/2 In.', 'plu', 60, 0, 'Fierce red eyes!%Pokémon Center Original%', '/images/products/plu/plu07', 'black', 1, '2019-03-27 17:06:41'),
('plu08', 'Leafeon Pokémon Dolls Plush - 7 In.', 'plu', 50, 0, 'Four-color ears%Pokémon Center Original design%', '/images/products/plu/plu08', 'yellow', 1, '2019-03-27 17:06:41'),
('plu09', 'Glaceon Pokémon Dolls Plush - 7 In.', 'plu', 30, 0, 'Embroidered blue eyes!%Pokémon Center Original design%', '/images/products/plu/plu09', 'blue', 1, '2019-03-27 17:06:41'),
('plu11', 'Pikachu Pokémon Holiday Extravaganza Poké Plush - 9 1/2 In. ', 'plu', 40, 0, 'Pikachu’s looking jolly and bright!%A fun, festive plush to celebrate the season (other pictured items not included)%\r\n	Part of the Pokémon Holiday Extravaganza collection%\r\n	Pokémon Center Original%', '/images/products/plu/plu11', 'red', 1, '2019-03-27 17:06:41'),
('plu12', 'Eevee Pokémon Holiday Extravaganza Poké Plush - 9 1/2 In.', 'plu', 50, 0, 'Epaulets and a cape give Eevee a formal holiday look%\r\n	A fun, festive plush to celebrate the season (other pictured items not included)%\r\n	Part of the Pokémon Holiday Extravaganza collection%Pokémon Center Original%', '/images/products/plu/plu12', 'orange', 1, '2019-03-27 17:06:41'),
('plu13', 'Mimikyu Eerie Delights Poké Plush - 9 1/2 In.', 'plu', 46, 0, 'Noibat mask is sewn on%Includes Mimikyu plush (other pictured items not included)%\r\n	Part of the Eerie Delights collection%\r\n	Pokémon Center Original%', '/images/products/plu/plu13', 'purple', 1, '2019-03-27 17:07:48'),
('plu14', 'Victini Cape Pikachu Poké Plush - 8 1/2 In.', 'plu', 30, 0, 'Big ears stand up tall!%Pokémon Center Original%', '/images/products/plu/plu14', 'yellow', 1, '2019-03-27 17:07:48'),
('plu15', 'Rowlet Cape Pikachu Poké Plush - 7 In.', 'plu', 60, 0, 'Super-cute cape with green bow tie!%Pokémon Center Original%', '/images/products/plu/plu15', 'green', 1, '2019-03-27 17:07:48'),
('plu16', 'Holiday Rockruff Poké Plush - 7 1/2 In.', 'plu', 50, 0, 'Plaid lining inside its cape!%Pokémon Center Original design%', '/images/products/plu/plu16', 'red', 1, '2019-03-27 17:07:48'),
('plu17', 'Flareon Pokémon Dolls Plush - 6 In.', 'plu', 34, 0, 'Extra fluffy ruff and top!%Pokémon Center Original design%', '/images/products/plu/plu17', 'orange', 1, '2019-03-27 17:07:48'),
('plu18', 'Vulpix Cape Pikachu Poké Plush (Standard) - 8.5 In.', 'plu', 60, 0, 'Hood partly removable%Pokémon Center Original design%', '/images/products/plu/plu18', 'orange', 1, '2019-03-27 17:07:48'),
('plu19', 'Paired Pikachu Celebrations: Doll Festival Pikachu Plush - 8 1/2 In.', 'plu', 40, 0, 'Held in March, this special day revolves around displaying beautiful dolls in the court dress of the Heian period in Japan.%\r\n	These two Pikachu are dressed up as the Emperor and Empress!%\r\n	Silky robes printed with floral and leaf patterns%Part of the Paired Pikachu Celebrations line', '/images/products/plu/plu19', 'yellow', 1, '2019-03-27 17:07:48'),
('plu20', 'Linh Dak Lak', 'plu', 1, 99, 'linh khong cute%linh khong cute%linh khong cute%linh khong cute%linh khong cute%linh khong cute%', '/images/products/plu/plu20', 'black', 0, '2019-05-15 14:08:15'),
('plu21', 'Luxury Shiba', 'plu', 80, 0, 'Really cute%Can make you laugh all day%Need to be loved%', '/images/products/plu/plu21', 'orange', 1, '2019-05-13 23:44:58'),
('plu22', 'linh nha', 'plu', 2, 0, 'linh linh linh%linh linh linh%linh linh linh%linh linh linh%', '/images/products/plu/plu22', 'yellow', 0, '2019-05-15 14:10:04'),
('shi00', 'Tapu Koko Fitted Crew Neck T-Shirt - Adult S', 'shi', 40, 0, 'Features a fitted cut that runs smaller than other cuts; please refer to the size chart to determine fit%\r\n	Soft, breathable tri-blend fabric%Legendary Pokémon from Alola in a vintage-style design%\r\n	Pokémon Center Original%', '/images/products/shi/shi00', 'black', 1, '2019-03-27 16:59:30'),
('shi01', 'Litten’s Playhouse Relaxed Fit Crewneck T-Shirt - Adult S', 'shi', 38, 0, 'Purrfect for those who love hanging with furry friends!%Cotton fabric is breathable and easy to clean%\r\n	Pokémon Center Original%', '/images/products/shi/shi01', 'grey', 1, '2019-03-27 16:59:30'),
('shi02', 'Flareon, Jolteon & Vaporeon Triple Threat Relaxed Fit Crewneck T-Shirt - Adult S', 'shi', 45, 0, 'Printed both front and back%Bold art style%Pokémon Center Original design%', '/images/products/shi/shi02', 'black', 1, '2019-03-27 16:59:30'),
('shi03', 'First Partner Power Relaxed Fit Crewneck T-Shirt - Adult S', 'shi', 55, 0, 'Awesome Alolan island style%Pokémon Center Original design%', '/images/products/shi/shi03', 'grey', 1, '2019-03-27 17:04:37'),
('shi04', 'Vulpix Frozen Forest Relaxed Fit Crewneck T-Shirt - Adult S', 'shi', 47, 0, 'A frosty and fiery Pokémon style!%Two kinds of Vulpix: from Kanto and Alola!%\r\n	Pokémon Center Original design%', '/images/products/shi/shi04', 'purple', 1, '2019-03-27 17:04:37'),
('shi05', 'Growlithe and Arcanine Relaxed Fit Crewneck T-Shirt - Adult S', 'shi', 35, 0, 'Step up to a golden touch!%Generous cut for an easy fit!%Arcanine in full roar%', '/images/products/shi/shi05', 'red', 1, '2019-03-27 17:04:37'),
('shi06', 'Mimikyu Relaxed Fit Crewneck T-Shirt - Adult S', 'shi', 60, 0, 'Mimikyu wants to be your friend!%Is Mimikyu’s disguise on right?%\r\n	Fun-loving and slightly spooky design%Pokémon Center Original%', '/images/products/shi/shi06', 'blue', 1, '2019-03-27 17:04:37'),
('shi07', 'Charizard Firestorm Men’s Fitted Crewneck T-Shirt - S', 'shi', 46, 0, 'Burn it up with Charizard!%Check out the whole Firestorm Collection!%', '/images/products/shi/shi07', 'orange', 1, '2019-03-27 17:06:41'),
('shi08', 'Rotom Mystery Room Relaxed Fit Adult Crewneck T-Shirt - S', 'shi', 30, 0, 'Pokémon Center Original design%', '/images/products/shi/shi08', 'black', 1, '2019-03-27 17:06:41'),
('shi09', 'Pikachu Brushwork Men’s Fitted Crewneck T-Shirt - S', 'shi', 50, 0, 'Bold graffiti-style in a Pokémon shirt!%Clever Smeargle on the back%Pokémon Center Original design%', '/images/products/shi/shi09', 'green', 1, '2019-03-27 17:06:41'),
('shi10', 'Solgaleo and Lunala Relaxed Fit Crewneck T-Shirt - Adult', 'shi', 60, 0, 'Two Legendary Pokémon in a beautiful design%Pokémon Center Original%', '/images/products/shi/shi10', 'purple', 1, '2019-03-27 17:06:41'),
('shi11', 'Mew Mythical Mania Men’s Relaxed Fit Crewneck T-Shirt - Adult S', 'shi', 30, 0, 'Bright Mythical Pokémon in a wild pattern!%Relaxed fit for comfort.%Pokémon Center Original Design%', '/images/products/shi/shi11', 'pink', 1, '2019-03-27 17:06:41'),
('shi12', 'Articuno 151 Cut Adult Crewneck T-Shirt - S', 'shi', 45, 0, 'Articuno in a heraldic style%POLYGRAPH graphic design%', '/images/products/shi/shi12', 'blue', 1, '2019-03-27 17:06:41'),
('shi13', 'Mew 151 Cut Adult Crewneck T-Shirt - S', 'shi', 58, 0, 'Mysterious Mewtwo in a hypnotic striped pattern!%POLYGRAPH graphic design%', '/images/products/shi/shi13', 'black', 1, '2019-03-27 17:07:48'),
('shi14', 'Popplio Relaxed Fit Crewneck T-Shirt - Adult S', 'shi', 36, 0, 'Ready for an Alolan adventure!%First partner Pokémon!%Pokémon Center Original%', '/images/products/shi/shi14', 'grey', 1, '2019-03-27 17:07:48'),
('shi15', 'Gengar Smirk Relaxed Fit Crewneck T-Shirt - Adult S', 'shi', 43, 0, 'Sneaky Gengar has quite a grin!%Pokémon Center Original%', '/images/products/shi/shi15', 'purple', 1, '2019-03-27 17:07:48'),
('shi16', 'Zygarde Relaxed Fit Crewneck T-Shirt - Youth S', 'shi', 30, 0, 'Comfortable relaxed fit T-shirt%Zygarde 50% Forme design%Printed on both sides%Pokémon Center Original%', '/images/products/shi/shi16', 'green', 1, '2019-03-27 17:07:48'),
('shi17', 'Hoopa Unbound Adult Relaxed Fit Crewneck T-Shirt - S', 'shi', 60, 0, 'Hoopa Unbound!%Relaxed fit crewneck looks good!%Pokémon Center Original%', '/images/products/shi/shi17', 'pink', 1, '2019-03-27 17:07:48'),
('shi18', 'Plusle and Minun Relaxed Fit Crewneck T-Shirt - Youth XS', 'shi', 40, 0, 'Official Pokémon T-shirt%Relaxed fit crewneck looks good!%Plusle and Minun are super energetic!\r\n	%A Pokémon Center Original%', '/images/products/shi/shi18', 'grey', 1, '2019-03-27 17:07:48'),
('shi19', 'Mega Diancie Relaxed Fit Crewneck T-Shirt - Youth XS', 'shi', 35, 0, 'Relaxed fit crewneck%Mega Diancie is Mega fun!%Sparkles on the shirt give you a shine\r\n	%A Pokémon Center Original%', '/images/products/shi/shi19', 'pink', 1, '2019-03-27 17:07:48'),
('shi20', 'I am a shiba shirt', 'shi', 35, 0, 'I am a shiba shirt%Black color%Good material%cheaper than another shopp%', '/images/products/shi/shi20', 'black', 1, '2019-05-13 23:50:10'),
('shi21', 'Blue mountain shirt', 'shi', 25, 16, 'Good material%Have many size%Nice form%For both girl and boy%', '/images/products/shi/shi21', 'blue', 0, '2019-05-14 00:14:41');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `roleID` int(11) NOT NULL,
  `permission` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`roleID`, `permission`, `status`, `created_at`) VALUES
(1, 'User', 1, '2019-05-15 09:20:15'),
(9, 'Manager', 1, '2019-05-15 09:20:15'),
(99, 'Admin', 1, '2019-05-15 09:20:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `birthday` date NOT NULL,
  `sex` tinyint(1) NOT NULL DEFAULT '1',
  `address` mediumtext NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_alt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  `roleID` varchar(100) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `phone`, `birthday`, `sex`, `address`, `password`, `created_alt`, `status`, `roleID`) VALUES
(9, 'Huy', 'Nguyễn Tấn', 'tortoise10h@gmail.com', '0397097276', '1999-10-02', 1, 'Nhà huy ở xa xa thật xa', '$2y$10$i2UsqaVR0WEKvAw0lV0fpe7U7ZdqEaptP/ACu5ZrK3Zb5ZXTI/R26', '2019-03-29 15:06:21', 1, '1'),
(10, 'meo', 'bay', 'meobay@gmail.com', '0123456789', '2000-01-01', 0, 'Xóm mèo xưa', '$2y$10$rFNT4v9X5EGcf3J9EZAT8ufXCoMn.3l/x9aG3DOTouhMFJoLbk1GG', '2019-03-29 15:12:13', 0, '99'),
(11, 'cho', 'nhay', 'chonhay@gmail.com', '0123456789', '0000-00-00', 0, '', '$2y$10$TSwhO5FXazEgoXqGjAKXweW0qUx8lh2fTbrL8XpYPfk2mbi6ZbF0y', '2019-03-30 14:22:31', 0, '9'),
(12, 'tên', 'họ', 'hovaten@gmail.com', '0123456789', '0000-00-00', 0, '', '$2y$10$SZOzcER8pgsZ0lUMkyoIO.lDmUJJ0kAqiyZrV535ID0IdRIkM9W0a', '2019-04-06 22:49:45', 1, '1'),
(13, 'thor', 'beo', 'thorbeo@gmail.com', '0123456789', '0000-00-00', 1, 'New Asgard', '$2y$10$w2K9Ilbd3ai9ZsrG4LE4wuH0MCYsrvyFjye8pR9kkpLKbIV7u6xVu', '2019-05-10 17:47:48', 1, '1'),
(14, 'cap', 'deo', 'capdeo@gmail.com', '0123456789', '0000-00-00', 1, '', '$2y$10$JbRHF0M4myClhvGIgSo77uG5VJkfVosRJga109aUDmRvrHBoAJZse', '2019-05-11 10:24:22', 1, '1'),
(15, 'Tony', 'Stark', 'uncletony@gmail.com', '0999999999', '0000-00-00', 1, 'Earth, New York City, Avenger Tower ', '$2y$10$T4H1L4D8rzIBkq2v1Mbf5uGYh1qyBHXHlvyIGaUMebDJdPX0qZn32', '2019-05-12 12:11:33', 1, '9'),
(16, 'pepper', 'potts', 'pepperpotts@gmail.com', '0123456789', '0000-00-00', 0, '', '$2y$10$N3/qrrdkEq2XeM0K6Uo8qesakkRpq5bErFJJlCHBJSyXqiiPxYCqe', '2019-05-15 07:30:34', 1, '99'),
(18, '', '', 'huysgh@gmail.com', '', '0000-00-00', 0, '', '$2y$10$XU39qLoernjN8IrFGy0WU.qn1fKy6BwnY4MV.UUtqBrBF4dR0Ou5W', '2019-05-15 13:43:02', 1, '99'),
(19, '', '', 'linhdaklak@gmail.com', '', '0000-00-00', 0, '', '$2y$10$So9pCwP1Q67uAzS4LH7BYeOEhP2PW7EWdfooC4bAgevzZQJX.ZACO', '2019-05-15 13:44:12', 1, '1'),
(20, 'sdfds', 'sef', 'sfsrtd@gmail.com', '0111111114', '0000-00-00', 1, '118/8/1 Nguyễn thị thập', '$2y$10$rbIW3I5OTwGxXolS.rmG6uvxrFW/93EWusEp0SuYZSedj00eCQL6y', '2019-05-15 15:03:41', 1, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billdetail`
--
ALTER TABLE `billdetail`
  ADD PRIMARY KEY (`billID`,`productID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
