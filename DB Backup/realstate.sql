-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2023 at 10:12 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `realstate`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `roleId` bigint(20) UNSIGNED DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `license` varchar(255) DEFAULT NULL,
  `about` text,
  `skype` varchar(255) DEFAULT NULL,
  `address` varchar(2000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `user_id`, `roleId`, `firstName`, `lastName`, `facebook`, `fax`, `linkedin`, `license`, `about`, `skype`, `address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, 'John', 'Doe', NULL, NULL, NULL, NULL, NULL, NULL, '123, ABC Street, XYZ City, 123456', '2023-05-12 09:24:08', '2023-05-12 09:24:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_contacts`
--

CREATE TABLE `admin_contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `license` varchar(255) DEFAULT NULL,
  `about` text,
  `skype` varchar(255) DEFAULT NULL,
  `address` varchar(2000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `agent_contacts`
--

CREATE TABLE `agent_contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `agentId` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `amenity_types`
--

CREATE TABLE `amenity_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amenity` varchar(255) DEFAULT NULL,
  `amenityType` enum('General Amenities','Interior Amenities','Exterior Amenities') DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1=Active,2=Inactive,0=Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `play_film_banner` varchar(255) DEFAULT NULL,
  `search_banner` varchar(255) DEFAULT NULL,
  `map_banner` varchar(255) DEFAULT NULL,
  `featured_banner` varchar(255) DEFAULT NULL,
  `neighbour_banner` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1=Active,2=Inactive,0=Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `buyers`
--

CREATE TABLE `buyers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `license` varchar(255) DEFAULT NULL,
  `about` text,
  `skype` varchar(255) DEFAULT NULL,
  `address` varchar(2000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1=Active,2=Inactive,0=Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1=Active,2=Inactive,0=Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `commenter_id` varchar(255) DEFAULT NULL,
  `commenter_type` varchar(255) DEFAULT NULL,
  `guest_name` varchar(255) DEFAULT NULL,
  `guest_email` varchar(255) DEFAULT NULL,
  `commentable_type` varchar(255) NOT NULL,
  `commentable_id` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '1',
  `child_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1=Active,2=Inactive,0=Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Dhaka', 1, '2023-05-18 01:25:56', '2023-05-18 01:25:56', NULL),
(2, 'Khulna', 1, '2023-05-18 01:26:09', '2023-05-18 01:26:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE `downloads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `shareStatus` varchar(255) NOT NULL COMMENT '0=Not Shared, 1=Shared',
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `garage_types`
--

CREATE TABLE `garage_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1=Active,2=Inactive,0=Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `help_desks`
--

CREATE TABLE `help_desks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userId` bigint(20) UNSIGNED DEFAULT NULL,
  `userType` tinyint(4) DEFAULT NULL COMMENT '1=Admin,2=Agent,3=Buyer,4=Seller,5=Guest user',
  `email` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1=Active,2=Read,0=Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `help_desk_details`
--

CREATE TABLE `help_desk_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `helpDeskId` bigint(20) UNSIGNED DEFAULT NULL,
  `userId` bigint(20) UNSIGNED DEFAULT NULL,
  `userType` tinyint(4) DEFAULT NULL COMMENT '1=Admin,2=Agent,3=Buyer,4=Seller,5=Guest user',
  `message` varchar(5000) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1=Active,2=Read,0=Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `market_activities`
--

CREATE TABLE `market_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reportName` varchar(255) NOT NULL,
  `reportSubject` varchar(255) NOT NULL,
  `reportDetails` text NOT NULL,
  `shareStatus` varchar(255) NOT NULL COMMENT '0=Not Shared, 1=Shared',
  `bannerImage` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `attachmentThree` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` longtext,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `receiver` bigint(20) UNSIGNED NOT NULL,
  `is_seen` tinyint(1) NOT NULL DEFAULT '0',
  `file` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(43, '2014_10_12_000000_create_users_table', 1),
(44, '2014_10_12_100000_create_password_resets_table', 1),
(45, '2018_06_30_113500_create_comments_table', 1),
(46, '2019_08_19_000000_create_failed_jobs_table', 1),
(47, '2023_01_23_171321_create_permission_tables', 1),
(48, '2023_01_24_104034_create_system_logs_table', 1),
(49, '2023_01_24_104039_create_system_errors_table', 1),
(50, '2023_02_04_192149_create_countries_table', 1),
(51, '2023_02_04_192202_create_cities_table', 1),
(52, '2023_02_04_192215_create_states_table', 1),
(53, '2023_02_21_142221_create_admins_table', 1),
(54, '2023_02_21_142258_create_agents_table', 1),
(55, '2023_02_21_142310_create_buyers_table', 1),
(56, '2023_02_21_142322_create_sellers_table', 1),
(57, '2023_03_01_174859_create_amenity_types_table', 1),
(58, '2023_03_01_183616_create_banners_table', 1),
(59, '2023_03_01_184705_create_property_types_table', 1),
(60, '2023_03_01_184727_create_garage_types_table', 1),
(61, '2023_03_01_184822_create_sliders_table', 1),
(62, '2023_03_01_184840_create_properties_table', 1),
(63, '2023_03_01_184857_create_help_desks_table', 1),
(64, '2023_03_01_184916_create_help_desk_details_table', 1),
(65, '2023_03_01_185006_create_neighbour_categories_table', 1),
(66, '2023_03_01_185009_create_neighbors_table', 1),
(67, '2023_03_01_185057_create_categories_table', 1),
(68, '2023_03_01_190746_create_property_details_table', 1),
(69, '2023_03_04_184258_create_property_categories_table', 1),
(70, '2023_03_04_184440_create_property_addresses_table', 1),
(71, '2023_03_04_184604_create_property_amenities_table', 1),
(72, '2023_03_04_184637_create_property_images_table', 1),
(73, '2023_03_13_171712_create_market_activities_table', 1),
(74, '2023_03_20_201105_create_transections_table', 1),
(75, '2023_03_30_154721_create_resoapi_properties_table', 1),
(76, '2023_03_31_091524_create_website_infos_table', 1),
(77, '2023_03_31_100316_create_agent_contacts_table', 1),
(78, '2023_04_07_110149_create_save_property_table', 1),
(79, '2023_04_11_152217_create_messages_table', 1),
(80, '2023_04_15_183731_create_jobs_table', 1),
(81, '2023_04_20_062751_create_property_messages_table', 1),
(82, '2023_04_25_084855_create_downloads_table', 1),
(83, '2023_04_25_190010_create_admin_contacts_table', 1),
(84, '2023_04_28_151920_create_neighbour_messages_table', 1),
(85, '2023_05_17_21266649_create_ore_gons_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `neighbors`
--

CREATE TABLE `neighbors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `categoryId` bigint(20) UNSIGNED NOT NULL,
  `titleOne` varchar(255) DEFAULT NULL,
  `titleOneDetails` text NOT NULL,
  `titleTwo` varchar(255) DEFAULT NULL,
  `titleTwoDetails` text,
  `titleThree` varchar(255) DEFAULT NULL,
  `titleThreeDetails` text,
  `photo` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1=Active,2=Inactive,0=Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `neighbors`
--

INSERT INTO `neighbors` (`id`, `name`, `categoryId`, `titleOne`, `titleOneDetails`, `titleTwo`, `titleTwoDetails`, `titleThree`, `titleThreeDetails`, `photo`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Zack Littel', 1, 'Lead Optimization Orchestrator', '<p>quisquam et aliquid omnis occaecati eos. Repellat in consequatur magnam dolorem esse consectetur. Tempore assumenda provident a reiciendis adipisci harum sed quam corrupti.Corporis voluptates doloribus. Nulla eos officiis dolores doloremque dicta aliquid tempore cupiditate exercitationem. Nihil sed aut cum et.Ullam sed et consequatur iusto et doloribus. Quia laboriosam beatae voluptatem et facere. Impedit eius optio sint eos porro illum vel.quisquam et aliquid omnis occaecati eos. Repellat in consequatur magnam dolorem esse consectetur. Tempore assumenda provident a reiciendis adipisci harum sed quam corrupti.Corporis voluptates doloribus. Nulla eos officiis dolores doloremque dicta aliquid tempore cupiditate exercitationem. Nihil sed aut cum et.Ullam sed et consequatur iusto et doloribus. Quia laboriosam beatae voluptatem et facere. Impedit eius optio sint eos porro illum vel.</p>', 'Omnis ea', '<p>quisquam et aliquid omnis occaecati eos. Repellat in consequatur magnam dolorem esse consectetur. Tempore assumenda provident a reiciendis adipisci harum sed quam corrupti.Corporis voluptates doloribus. Nulla eos officiis dolores doloremque dicta aliquid tempore cupiditate exercitationem. Nihil sed aut cum et.Ullam sed et consequatur iusto et doloribus. Quia laboriosam beatae voluptatem et facere. Impedit eius optio sint eos porro illum vel.quisquam et aliquid omnis occaecati eos. Repellat in consequatur magnam dolorem esse consectetur. Tempore assumenda provident a reiciendis adipisci harum sed quam corrupti.Corporis voluptates doloribus. Nulla eos officiis dolores doloremque dicta aliquid tempore cupiditate exercitationem. Nihil sed aut cum et.Ullam sed et consequatur iusto et doloribus. Quia laboriosam beatae voluptatem et facere. Impedit eius optio sint eos porro illum vel.</p>', 'Shanahan', '<p>quisquam et aliquid omnis occaecati eos. Repellat in consequatur magnam dolorem esse consectetur. Tempore assumenda provident a reiciendis adipisci harum sed quam corrupti.Corporis voluptates doloribus. Nulla eos officiis dolores doloremque dicta aliquid tempore cupiditate exercitationem. Nihil sed aut cum et.Ullam sed et consequatur iusto et doloribus. Quia laboriosam beatae voluptatem et facere. Impedit eius optio sint eos porro illum vel.quisquam et aliquid omnis occaecati eos. Repellat in consequatur magnam dolorem esse consectetur. Tempore assumenda provident a reiciendis adipisci harum sed quam corrupti.Corporis voluptates doloribus. Nulla eos officiis dolores doloremque dicta aliquid tempore cupiditate exercitationem. Nihil sed aut cum et.Ullam sed et consequatur iusto et doloribus. Quia laboriosam beatae voluptatem et facere. Impedit eius optio sint eos porro illum vel.</p>', 'http://localhost/property/images/defaultneighbour.png', 1, '2023-05-12 09:31:49', '2023-05-12 09:31:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `neighbour_categories`
--

CREATE TABLE `neighbour_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1=Active,2=Inactive,0=Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `neighbour_categories`
--

INSERT INTO `neighbour_categories` (`id`, `name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'City Town', 1, '2023-05-12 09:24:32', '2023-05-12 09:24:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `neighbour_messages`
--

CREATE TABLE `neighbour_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ore_gons`
--

CREATE TABLE `ore_gons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ore_gons`
--

INSERT INTO `ore_gons` (`id`, `name`, `url`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Property', 'https://resoapi.rmlsweb.com/reso/odata/Property', 1, '2023-05-18 01:03:31', '2023-05-18 01:03:31'),
(2, 'Member', 'https://resoapi.rmlsweb.com/reso/odata/Member', 1, '2023-05-18 01:03:31', '2023-05-18 01:03:31'),
(3, 'Office', 'https://resoapi.rmlsweb.com/reso/odata/Office', 1, '2023-05-18 01:03:31', '2023-05-18 01:03:31'),
(4, 'OpenHouse', 'https://resoapi.rmlsweb.com/reso/odata/OpenHouse', 1, '2023-05-18 01:03:31', '2023-05-18 01:03:31'),
(5, 'Media', 'https://resoapi.rmlsweb.com/reso/odata/Media', 1, '2023-05-18 01:03:31', '2023-05-18 01:03:31'),
(6, 'DataSystem', 'https://resoapi.rmlsweb.com/reso/odata/DataSystem', 1, '2023-05-18 01:03:31', '2023-05-18 01:03:31'),
(7, 'Resource', 'https://resoapi.rmlsweb.com/reso/odata/Resource', 1, '2023-05-18 01:03:31', '2023-05-18 01:03:31'),
(8, 'PropertyGreenVerification', 'https://resoapi.rmlsweb.com/reso/odata/PropertyGreenVerification', 1, '2023-05-18 01:03:31', '2023-05-18 01:03:31'),
(9, 'Deleted', 'https://resoapi.rmlsweb.com/reso/odata/Deleted', 1, '2023-05-18 01:03:31', '2023-05-18 01:03:31');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=Active,2=Inactive,0=Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `agentId` bigint(20) UNSIGNED DEFAULT NULL,
  `buyerId` bigint(20) UNSIGNED DEFAULT NULL,
  `sellerId` bigint(20) UNSIGNED DEFAULT NULL,
  `adminId` bigint(20) UNSIGNED DEFAULT NULL,
  `typeId` bigint(20) UNSIGNED DEFAULT NULL,
  `garageTypeId` bigint(20) UNSIGNED DEFAULT NULL,
  `neighbourhoodId` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `title` varchar(1000) DEFAULT NULL,
  `mlsId` varchar(1000) DEFAULT NULL,
  `availableDate` date DEFAULT NULL,
  `expireDate` date DEFAULT NULL,
  `price` decimal(10,2) DEFAULT '0.00',
  `originalPrice` decimal(10,2) DEFAULT '0.00',
  `thumbnail` varchar(1000) DEFAULT NULL,
  `videoUrl` varchar(1000) DEFAULT NULL,
  `slug` varchar(1000) DEFAULT NULL,
  `virtualTour` varchar(1000) DEFAULT NULL,
  `previewText` text,
  `isHideAddress` tinyint(4) DEFAULT '1' COMMENT '1=Yes,0=No',
  `callForPrice` tinyint(4) DEFAULT '1' COMMENT '1=Yes,0=No',
  `status` tinyint(4) DEFAULT '1' COMMENT '1=Active,2=Inactive,0=Deleted',
  `is_sold` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=Not sold,1=Sold',
  `is_featured` tinyint(4) DEFAULT '0' COMMENT '0=None,1=requested,2=featured',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `property_addresses`
--

CREATE TABLE `property_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `propertyId` bigint(20) UNSIGNED DEFAULT NULL,
  `cityId` bigint(20) UNSIGNED DEFAULT NULL,
  `stateId` bigint(20) UNSIGNED DEFAULT NULL,
  `countryId` bigint(20) UNSIGNED DEFAULT NULL,
  `streetNumber` varchar(255) DEFAULT NULL,
  `streetAddressOne` varchar(255) DEFAULT NULL,
  `streetAddressTwo` varchar(255) DEFAULT NULL,
  `shuitAppertment` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `subDivision` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `property_amenities`
--

CREATE TABLE `property_amenities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `propertyId` bigint(20) UNSIGNED DEFAULT NULL,
  `amenityId` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `property_categories`
--

CREATE TABLE `property_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `propertyId` bigint(20) UNSIGNED DEFAULT NULL,
  `categoryId` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `property_details`
--

CREATE TABLE `property_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `propertyId` bigint(20) UNSIGNED DEFAULT NULL,
  `numOfBedroom` varchar(255) DEFAULT NULL,
  `numOfBathroom` varchar(255) DEFAULT NULL,
  `totalUnit` varchar(255) DEFAULT NULL,
  `squareFeet` varchar(255) DEFAULT NULL,
  `lotSize` varchar(255) DEFAULT NULL,
  `lotAcre` varchar(255) DEFAULT NULL,
  `lotType` varchar(255) DEFAULT NULL,
  `heat` varchar(255) DEFAULT NULL,
  `locker` varchar(255) DEFAULT NULL,
  `fees` varchar(255) DEFAULT NULL,
  `exposure` varchar(255) DEFAULT NULL,
  `balcony` varchar(255) DEFAULT NULL,
  `kitchen` varchar(255) DEFAULT NULL,
  `parking` varchar(255) DEFAULT NULL,
  `style` varchar(255) DEFAULT NULL,
  `cooling` varchar(255) DEFAULT NULL,
  `fuel` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1=Active,2=Inactive,0=Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `property_images`
--

CREATE TABLE `property_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `propertyId` bigint(20) UNSIGNED DEFAULT NULL,
  `imageUrl` varchar(255) DEFAULT NULL,
  `type` enum('Image','Video') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `property_messages`
--

CREATE TABLE `property_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `property_types`
--

CREATE TABLE `property_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1=Active,2=Inactive,0=Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `resoapi_properties`
--

CREATE TABLE `resoapi_properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `BathroomsTotalInteger` int(11) DEFAULT NULL,
  `BedroomsTotal` int(11) DEFAULT NULL,
  `BuildingAreaTotal` double(8,2) DEFAULT NULL,
  `BuyerOfficeName` varchar(255) DEFAULT NULL,
  `BuyerOfficePhone` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `CloseDate` varchar(255) DEFAULT NULL,
  `ClosePrice` bigint(20) UNSIGNED DEFAULT NULL,
  `CondominiumElevatorYN` varchar(255) DEFAULT NULL,
  `CondominiumGarageType` varchar(255) DEFAULT NULL,
  `Country` varchar(255) DEFAULT NULL,
  `CurrentPriceForStatus` bigint(20) UNSIGNED DEFAULT NULL,
  `Directions` varchar(255) DEFAULT NULL,
  `GarageSpaces` double(8,2) DEFAULT NULL,
  `GarageType` varchar(255) DEFAULT NULL,
  `Latitude` varchar(255) DEFAULT NULL,
  `ListPrice` varchar(255) DEFAULT NULL,
  `Longitude` varchar(255) DEFAULT NULL,
  `ListingId` varchar(255) DEFAULT NULL,
  `LotSizeDimensions` varchar(255) DEFAULT NULL,
  `LotSizeSquareFeet` bigint(20) UNSIGNED DEFAULT NULL,
  `MainLevelAreaTotal` int(11) DEFAULT NULL,
  `ParkingTotal` double(8,2) DEFAULT NULL,
  `Photo1URL` varchar(255) DEFAULT NULL,
  `PropertyType` varchar(255) DEFAULT NULL,
  `PropertySubType` varchar(255) DEFAULT NULL,
  `PublicRemarks` longtext,
  `StreetName` varchar(255) DEFAULT NULL,
  `StreetNumber` varchar(255) DEFAULT NULL,
  `StreetNumberNumeric` int(11) DEFAULT NULL,
  `YearBuilt` int(11) DEFAULT NULL,
  `PostalCode` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `resoapi_properties`
--

INSERT INTO `resoapi_properties` (`id`, `BathroomsTotalInteger`, `BedroomsTotal`, `BuildingAreaTotal`, `BuyerOfficeName`, `BuyerOfficePhone`, `City`, `CloseDate`, `ClosePrice`, `CondominiumElevatorYN`, `CondominiumGarageType`, `Country`, `CurrentPriceForStatus`, `Directions`, `GarageSpaces`, `GarageType`, `Latitude`, `ListPrice`, `Longitude`, `ListingId`, `LotSizeDimensions`, `LotSizeSquareFeet`, `MainLevelAreaTotal`, `ParkingTotal`, `Photo1URL`, `PropertyType`, `PropertySubType`, `PublicRemarks`, `StreetName`, `StreetNumber`, `StreetNumberNumeric`, `YearBuilt`, `PostalCode`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 1782.00, 'Non Rmls Broker', '503-236-7657', 'WhiteCity', '2014-11-20', 227000, NULL, NULL, 'US', 227000, 'East on Hwy234 past Antioch Rd (Past Raineys Corner 1.4miles to address on left) (white vinyl fence)', 2.00, 'Detached', '42.515274', '227000', '-122.878181', '2950003', '279655 SQFT', 279655, 1782, 2.00, 'https://www.rmlsweb.com/webphotos/02900000/50000/0000/2950003-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'Open living space with a split bedroom plan. Upgrades: new floors, interior paint, new deck. A seasonal pond, two wells (one produces 13gpm per owner, the other currently unused), completely fenced & cross fenced with 28X36 detached shop with an additional 12X28 covered parking area alongside. Located only one mile from the Dodge Bridge Boat ramp and day use area. Listing agent is related to seller.', 'Highway 234', '3508', 3508, 1988, '97503', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(2, 2, 3, 1672.00, 'Non Rmls Broker', '503-236-7657', 'GrantsPass', '2014-11-24', 225000, NULL, NULL, 'US', 225000, 'Redwood Avenue, take right onto Darneille and take left on Golden Aspen. House is on the right hand', 2.00, NULL, '42.427059', '230000', '-123.384644', '2950164', '11761 SQFT', 11761, NULL, 2.00, 'https://www.rmlsweb.com/webphotos/02900000/50000/0000/2950164-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'Wonderful single level home in an outstanding location! 3 bedroom, 2 bath home has been beautifully kept and maintained. Located at the end of a cul-de-sac, on .27 of an acre with a huge backyard in the Redwood Area.  Open living area with a spacious kitchen, formal dining, and gas fireplace.  Large Master suite with an attractive bath with dual vanities.  2 car garage plus plenty of off street parking and a side yard area for a boat/trailer.  Move in ready.', 'Golden Aspen', '2941', 2941, 2001, '97527', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(3, 1, 2, 1020.00, 'Kendon Leet Real Estate, Inc', '541-956-8582', 'GrantsPass', '2015-02-27', 128000, NULL, NULL, 'US', 128000, 'New Hope Road to Stringer Gap, subject property is located on the right. New Hope Road', 0.00, NULL, '42.369656', '159900', '-123.370193', '2950359', '138521 SQFT', 138520, 1020, 0.00, 'https://www.rmlsweb.com/webphotos/02900000/50000/0000/2950359-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'Possible 2-family set up, established back away from the road. Flat usable land a short distance from town! Including two separate septic tanks & three wells, two of the three wells produce 30GPM & 8GPM(per well logs). 2Bd/1Ba house plus attic and a 2bd/2ba single-wide mobile. Per County Planning, Mobile is \'Grandfathered In\' but not permitted. May be able to have a two-family set up, Buyer to do Due Diligence.', 'Stringer Gap', '164', 164, 1936, '97527', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(4, 3, 3, 1722.00, 'Non Rmls Broker', '503-236-7657', 'GrantsPass', '2014-10-16', 266500, NULL, NULL, 'US', 266500, 'Redwood Hwy to Demaray Drive to Jerome Prairie.  Address on left just past Sleepy Hollow Loop. Sleep', 2.00, NULL, '42.388416', '259900', '-123.420509', '2950464', '159865 SQFT', 159865, NULL, 2.00, 'https://www.rmlsweb.com/webphotos/02900000/50000/0000/2950464-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'Fruit trees line the driveway to this very comfortable home in the desirable Jerome Prairie area. This 3.67 beautiful, flat, irrigated acre property is fenced and cross fenced for your horses or hobby farm. The home has had upgrades such as a new roof, heat pump and septic lines in the last two years. Fenced garden area, shop, barn with stalls and a chicken coop. There is also a 3 bedroom, 2 bath, 1296 sq. ft. manufactured home built in 1990 with expired hardship on the property. Buyer to perform their own due diligence into the potential uses of the manufactured home. 20gpm Well (per Well Log).', 'Jerome Prairie', '4749', 4749, 1962, '97527', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(5, NULL, NULL, NULL, 'Kendon Leet Real Estate, Inc', '541-956-8582', 'Agness', '2015-05-06', 80000, NULL, NULL, 'US', 80000, 'Cross the Rogue River at Coon Rock Bridge, make a right at Agness Road, property at left. Call listi', NULL, NULL, '42.630304', '75000', '-124.072306', '2950556', '454331 SQFT', 454330, NULL, NULL, 'https://www.rmlsweb.com/webphotos/02900000/50000/0000/2950556-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Over 10 acres  of wooded property with Riley Creek front, water rights and an established homesite near Coon Rock Bridge in beautiful Wild & Scenic Agness. World renowned fishing at the lower Rogue River a short distance away. Property had a house/mobile home that is now partially taken apart but left in present condition to maintain established home site. May also purchase adjacent .97 acre with 2 (vintage) mobiles/trailers, fruit trees, road frontage - all very close to the Rogue River. Great investment.', 'Agness', '4685', 4685, NULL, '97406', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(6, NULL, NULL, NULL, 'Remax Coast and Country', '541-412-9535', 'Agness', '2015-08-17', 57000, NULL, NULL, 'US', 57000, 'Cross the Rogue River at Coon Rock Bridge, make a right at Agness Road, property at left.', NULL, NULL, '42.624208', '60000', '-124.071478', '2950557', '42253 SQFT', 42253, NULL, NULL, 'https://www.rmlsweb.com/webphotos/02900000/50000/0000/2950557-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Nearly an acre of old homesteaded land near Coon Rock Bridge in beautiful Wild & Scenic Agness. World renowned fishing at the lower Rogue River a short distance away. 2 vintage mobile homes/trailers/established home-sites, RV parking, shed, a carport and established landscaping, mature fruit trees, roses & trumpet vines. Water rights!', 'Agness', '4671', 4671, NULL, '97406', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(7, NULL, NULL, 0.00, NULL, NULL, 'CoosBay', NULL, 0, NULL, NULL, 'US', 595000, 'Between 26th & 28th street, next to Umpqua Dairy', NULL, NULL, '43.38126', '595000', '-124.245421', '4062042', 'Irreg', 86684, NULL, NULL, 'https://www.rmlsweb.com/webphotos/04000000/60000/2000/4062042-1-a.jpg', 'CommercialSale', 'Commercial', '210\' of major highway frontage, zoned C-2 & R-3.  Ready for development. Fill leveled and compacted. Access to 28th St. also.  Unique property, includes 1 house.', 'Ocean', '2750', 2750, 1951, '97420', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(8, 3, 2, 1944.00, 'Windermere/North Point, Inc.', '541-269-1601', 'CoosBay', '2012-08-15', 155000, NULL, NULL, 'US', 155000, '101 to Ingersoll to West end of Street', 2.00, 'Attached', '43.360021', '200000', '-124.226884', '5047901', NULL, 0, 1104, 2.00, 'https://www.rmlsweb.com/webphotos/05000000/40000/7000/5047901-1-a.jpg', 'Residential', 'Condominium', 'Coos Bay\'s finest condominium units, one of four located in the center of 3.5 landscaped, secluded acres. These luxurious units are in the city but surrounded by trees. Must see to appreciate. Over 1900 sq ft including 2 bed 2 1/2 bath, loft laundry and separate guest area.', 'INGERSOLL', '1340', 1340, 1973, '97420', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(9, NULL, NULL, NULL, 'Oregon Professional Real Estate Group', '541-824-0070', 'PortOrford', '2018-07-23', 675000, NULL, NULL, 'US', 675000, 'Call Listing Agent', NULL, NULL, '42.63676', '695000', '-124.394518', '5081049', NULL, 3976592, NULL, NULL, 'https://www.rmlsweb.com/webphotos/05000000/80000/1000/5081049-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Immense front and center, ringside OCEAN and rock island views from 91 diverse acres of meadows, forest, stony outcroppings, waterfalls, primeval Jurrasic Park areas, pasture. Build your home and guest house for the ultimate Oregon Dream!', 'Pacific Highlands', '37861', 37861, NULL, '97465', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(10, NULL, NULL, NULL, 'Century 21 Agate Realty', '541-469-2143', 'Brookings', '2014-01-21', 20000, NULL, NULL, 'US', 20000, '101S- Turn left on Oak, Rt on Fir, Rt side of road', NULL, NULL, '42.056592', '35000', '-124.27624', '5084617', NULL, 16988, NULL, NULL, 'https://www.rmlsweb.com/webphotos/05000000/80000/4000/5084617-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Nestled back in an established neighborhood, this lot has been surveyed and cleared. Bring your plans and build your custom home or place your new manufactured home on this lot. The utilities are to the street. Owner may carry!', 'Fir Street', NULL, NULL, NULL, '97415', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(11, NULL, NULL, NULL, 'Prudential Seaboard Properties', '541-396-5532', 'Coquille', '2016-05-20', 105000, NULL, NULL, 'US', 105000, 'L at light, R on 2nd, to Shelley, to WoodRidge, to Western, end of RD.', NULL, NULL, '43.171429', '109000', '-124.162549', '5088038', 'IRREGULAR', 612453, NULL, NULL, 'https://www.rmlsweb.com/webphotos/05000000/80000/8000/5088038-1-a.jpg', 'Land', 'SingleFamilyResidence', 'NEW LOW PRICE! BIG VALLEY VIEW 14.06 ACRE DEVELOPMENT PARCEL IN THE COQUILLE CITY LIMITS - Zoned R, Water, Sewer & Power are to the property. \"Development Assessment Report\" on file describing possible subdivision for up to 30 lots subject to availability of city sewer hookups. Surveyed & CC&R\'s apply. Possible Owner Financing!', 'Western', NULL, NULL, NULL, '97423', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(12, NULL, NULL, NULL, 'Beach Loop Realty', '541-347-1800', 'Bandon', '2015-10-29', 19500, NULL, NULL, 'US', 19500, '101 to Fillmore straight to Rosa, L on Astor, L on Harlem, on right.', NULL, NULL, '43.108584', '19500', '-124.404851', '6003127', 'appr. 163\' x 163\'', 27007, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06000000/00000/3000/6003127-1-a.jpg', 'Land', 'SingleFamilyResidence', '.62 ACRE LOT in warm East Bandon location in the county yet on the edge of the city limits. Will need DEQ septic approval for onsite septic system and a well drilled for domestic water. Lot is mostly unimproved but the price is right. Buyer and their broker should inquire to county/city planning in regards to potential development. Seller financing is available, terms negotiable.', 'HARLEM', NULL, NULL, NULL, '97411', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(13, NULL, NULL, NULL, 'Gold Coast Properties, Inc.', '541-347-4533', 'Bandon', '2018-02-16', 19000, NULL, NULL, 'US', 19000, '101 to Fillmore straight to Rosa, L on Astor, L on Harlem, on right.', NULL, NULL, '43.108128', '24500', '-124.40486', '6003130', '163\' x 163\'+-', 27007, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06000000/00000/3000/6003130-1-a.jpg', 'Land', 'SingleFamilyResidence', '.62 ACRE LOT in warm East Bandon location in the county yet on the edge of the city limits. Will need DEQ septic approval for onsite septic system. City water is available or a well may be drilled for domestic water. Lot is mostly unimproved but the price is right. Buyer and their broker should inquire to county/city planning in regards to potential development. Seller financing is available, terms negotiable.', 'HARLEM', NULL, NULL, NULL, '97411', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(14, NULL, NULL, NULL, 'Keller Williams Realty Portland Premiere', '503-597-2444', 'Sherwood', '2012-12-21', 1250000, NULL, NULL, 'US', 1250000, '99W to Sunset Blvd, Rt on Ladd Hill Rd, Rt on Parrett Mtn Rd, Prop on RT', NULL, NULL, '45.329021', '1250000', '-122.853227', '6012690', NULL, 1990256, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06000000/10000/2000/6012690-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Wow! Views! Views! Views! Fantastic Opportunity for a Developer to sub-divide.  Current zoning is AF-5 w/ potential for up to nine, 5 acre lots on the much desired Parrett Mountain!  A 22 gallon per minute well has been drilled on the property (Per Well Log).  Developer packet available.', 'PARRETT MOUNTAIN', '17015', 17015, NULL, '97140', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(15, NULL, NULL, NULL, 'Bandon Property, LLC', '541-347-1234', 'Bandon', '2014-12-10', 45000, NULL, NULL, 'US', 45000, '101S to Seabird, R on Seabird to Lincoln,  L on Lincoln, property on R.', NULL, NULL, '43.097392', '49900', '-124.428096', '6016499', '80 x 120', 9583, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06000000/10000/6000/6016499-1-a.jpg', 'Land', 'SingleFamilyResidence', 'SHORT WALK TO THE BEACH! Owner may finance! Large .22 acre lot in premier subdivision in upscale beach area neighborhood of custom homes. All underground city services, stamped concrete sidewalks and value protective CC&R\'s. Possible 2nd story Ocean view?', 'Lincoln', '1', 1, NULL, '97411', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(16, 2, 3, 1581.00, 'Cates Properties', '541-479-2767', 'Murphy', '2012-03-27', 510000, NULL, NULL, 'US', 510000, 'Hwy 238 (leaving Grants Pass) to Murphy Creek Rd to address', 2.00, 'Attached', '42.321165', '574950', '-123.335038', '6017915', 'irreg.', 6969600, 1581, 2.00, 'https://www.rmlsweb.com/webphotos/06000000/10000/7000/6017915-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'WOW!! 160 ACRES! VIEWS, VIEWS, VIEWS, TREES, SOME MARKETABLE, NEAT AS A PIN HOME + SHOP, WILDLIFE HAVEN, BLM-2 SIDES. Buyer to pay for ALL inspections and tests or accept the ones done Sept. 2010.', 'MURPHY CREEK', '715', 715, 1990, '97533', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(17, 2, 3, 1581.00, 'Cates Properties', '541-479-2767', 'Murphy', '2012-03-27', 510000, NULL, NULL, 'US', 510000, 'Hwy 238 out of Grants Pass to Murphy Creek Rd to address', 2.00, 'Attached', '42.321165', '574950', '-123.335038', '6017926', 'irreg.', 6969600, 1581, 2.00, 'https://www.rmlsweb.com/webphotos/06000000/10000/7000/6017926-1-a.jpg', 'Residential', NULL, 'WOW!! 160 ACRES! VIEWS, VIEWS, VIEWS, TREES, SOME MARKETABLE, NEAT AS A PIN HOME + SHOP, WILDLIFE HAVEN, BLM-2 SIDES. Per Seller: 400 thousand board feet of marketable timber 12 inches or more. Only 10 miles from town.', 'MURPHY CREEK', '715', 715, 1990, '97533', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(18, NULL, NULL, NULL, 'Beach Loop Realty', '541-347-1800', 'Bandon', '2013-09-18', 70000, NULL, NULL, 'US', 70000, 'From Beach Loop go east on Golf Links, Left on Spyglass to lot on left.', NULL, NULL, '43.095674', '82000', '-124.424151', '6018346', '11,993 sq ft', 12196, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06000000/10000/8000/6018346-1-a.jpg', 'Land', 'SingleFamilyResidence', 'PREMIER OCEAN TERRACE LOT! Motivated Seller! Level & ready to build elevated OCEANVIEW, Huge .28 acre, 11,993 sq. ft. sheltered by large elegant trees. Underground city services. Golf right around the corner or walk to Beautiful Bandon Beaches! CC&R\'s apply to protect your investment.', 'Spyglass', NULL, NULL, NULL, '97411', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(19, NULL, NULL, NULL, 'CENTURY 21 The Neil Company RE', '541-673-4417', 'MyrtleCreek', '2019-06-27', 136000, NULL, NULL, 'US', 136000, 'X108 Main St - lft at Riverside-turn right at Woody Ct  and SIGN', NULL, NULL, '43.02232', '35900', '-123.282867', '6020107', 'irreg', 6534, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06000000/20000/0000/6020107-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Stick built only Subdivision; remaining lots $45000 per lot.. CC&R\'s; Flood Plain Certificates required, but buildable portion above fp. Common area, paved cult-de-sac and curbing;  utilities at street;   I-5, schools, Golf course nearby. Take a drive by.  Parcels filled by permit. Buildable portion above flood plain. Common area for enjoyment and watch the creek go by. Broker related to seller.', 'WOODY', NULL, NULL, NULL, '97457', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(20, NULL, NULL, 1800.00, 'Century 21 Agate Realty/Gold', '541-247-6612', 'Brookings', '2012-12-03', 110000, NULL, NULL, 'US', 110000, 'On highway 101 in Brookings across from Century 21 Agate Realty Unit C', NULL, NULL, '42.054893', '115000', '-124.290233', '6032743', NULL, 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06000000/30000/2000/6032743-1-a.jpg', 'CommercialSale', 'Commercial', 'Centrally located in Brookings, Century Plaza presents a great opportunity to own a two-story executive office suite with exposure to Hwy 101 & Fred Meyers .Price reflected is for the OUTER SHELL ONLY!  You may customize and upgrade this unit to reflect your business style & personal needs.', 'Chetco Ave Unit C', '937', 937, 2006, '97415', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(21, 2, 3, 1290.00, 'Coldwell Banker Seal', '360-892-7325', 'Springfield', '2013-09-16', 180000, NULL, NULL, 'US', 180000, 'JASPER RD TO LAUREL LEFT ON LANE PAST 1071 LAUREL', 2.00, 'Oversized', '44.034164', '179800', '-122.973268', '6038589', NULL, 11325, 1290, 2.00, 'https://www.rmlsweb.com/webphotos/06000000/30000/8000/6038589-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'YOUR first home or your last home?COME,LOOK BUY!comfortable floorplan,HUGE 2car GARAGE/ton\'s of BIs in full service UTILITY ROOM,EASY CARE fenced yard.Pretty much everything here & ready to go.Definity one of the best GOOD BUYS!Lots of square footage for the price!', 'LAUREL', '1073', 1073, 1997, '97478', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(22, NULL, NULL, NULL, 'Oregon Coast Realty', '541-469-7755', 'Langlois', '2015-02-11', 92000, NULL, NULL, 'US', 92000, 'Hwy 101 to Cope to Pacific View', NULL, NULL, '42.907498', '124000', '-124.44998', '6041454', NULL, 455202, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06000000/40000/1000/6041454-1-a.jpg', 'Land', 'SingleFamilyResidence', 'OCEAN VIEW PARCEL - Only 20 minutes to Bandon Dunes Golf Resort -10+ secluded acres near ready to build with road to prepared homesite, septic approvals, underground utilities to within 25 feet of parcel boundaries & water hookup already paid for by seller.  Potential to divide into two 5 acre parcels subject to County approval. A unique southern Oregon coastal property with panoramic views at a great price.', 'Pacrific View', NULL, NULL, NULL, '97450', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(23, NULL, NULL, NULL, 'Beach Loop Realty', '541-347-1800', 'Langlois', '2016-10-28', 120000, NULL, NULL, 'US', 120000, 'Hwy 101 to Cope to Pacific View', NULL, NULL, '42.906362', '149000', '-124.450389', '6041459', NULL, 449103, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06000000/40000/1000/6041459-1-a.jpg', 'Land', 'SingleFamilyResidence', 'OCEAN VIEW PARCEL - Only 20 minutes to Bandon Dunes Golf Resort -10+ secluded acres ready to build with road to nearly prepared homesite, septic approval, underground utilities to property boundary & community water right already paid for by seller.  Potential to divide into two 5 acre parcels subject to County approval. A unique southern Oregon coastal property with panoramic views at a great price.', 'Pacific View', NULL, NULL, NULL, '97450', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(24, 2, 3, 2125.00, 'United Country Coastal Frontie', '541-425-5555', 'GoldBeach', '2015-02-09', 100000, NULL, NULL, 'US', 100000, 'highway l0l, west on 3rd street 1.5 blocks', 2.00, NULL, '42.412603', '112000', '-124.418353', '6047936', NULL, 0, 2125, 2.00, 'https://www.rmlsweb.com/webphotos/06000000/40000/7000/6047936-1-a.jpg', 'Residential', 'ManufacturedHomeonRealProperty', 'Triple wide newer home located in convenient location within a mile from schools, shopping, library,the beach,restuarants.Also has a charming, old style 1200-+ sq. ft. home on the property that has been used as a rental. Great for Mother-in-Law or 2 family set up or for rental income. Newer carpet in main home.  Property being sold as-is.', 'THIRD', '94227', 94227, 1996, '97444', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(25, NULL, NULL, NULL, 'TR Hunter Real Estate', '541-997-1200', 'Florence', '2019-12-06', 73560, NULL, NULL, 'US', 73560, 'Hwy 101, N of Heceta Beach Rd, L on Lake Point Dr', NULL, NULL, '44.024527', '78000', '-124.107219', '6054648', NULL, 9583, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06000000/50000/4000/6054648-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Gorgeous views, cleared building site with seasonal lake and nature preserve frontage in new development, with Heceta Water, underground utilities and Septic Permit included. Seller financing may be available: 25% down, 7% interest, quarterly interest-only payments, 3 year balloon.', 'LAKE POINT', NULL, NULL, NULL, '97439', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(26, NULL, NULL, NULL, 'TR Hunter Real Estate', '541-997-1200', 'Florence', '2020-01-23', 78000, NULL, NULL, 'US', 78000, 'Hwy 101, N of Heceta Beach Rd, L on Lake Point Dr.', NULL, NULL, '44.024755', '78000', '-124.107375', '6054700', NULL, 9583, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06000000/50000/4000/6054700-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Gorgeous views, cleared building site with seasonal lake and nature preserve frontage in new development, with Heceta Water, underground utilities and septic approval and permit. Seller financing may be available: 25% down, 7% interest, quarterly interest-only payments, 3 year balloon.', 'LAKE POINT', NULL, NULL, NULL, '97439', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(27, NULL, NULL, NULL, 'Coldwell Banker Coast Real Est', '541-997-7777', 'Florence', '2014-02-13', 190000, NULL, NULL, 'US', 190000, 'Hwy 101 S to Clear Lake; lt on Clear Lake to Cloud Nine; lt to end.', NULL, NULL, '43.91264', '199000', '-124.090082', '6065101', 'Varied', 43560, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06000000/60000/5000/6065101-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Dunes City\'s newest waterfront area.  Wooded waterfront 1 acre lots on beautiful Woahink Lake.  Boat or swim from your own dock.  Very private neighborhood and lots.  Underground utilities installed; water and septic approvals furnished.  Weather protected area with wonderful views.', 'Cloud Nine Road', NULL, NULL, NULL, '97439', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(28, NULL, NULL, NULL, 'RE/MAX River and Sea', '503-738-9552', 'Gearhart', '2013-03-29', 69500, NULL, NULL, 'US', 69500, 'Hwy 101 N to 5th, W to Kershul', NULL, NULL, '46.026625', '79500', '-123.913749', '6078441', '97x111', 10890, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06000000/70000/8000/6078441-1-a.jpg', 'Land', 'SingleFamilyResidence', 'BEACH ESTATES AT GEARHART. Pristine corner lot in one of west Gearhart\'s newest subdivisions. Lot is septic approved and building ready.', 'Kershul', NULL, NULL, NULL, '97138', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(29, NULL, NULL, NULL, 'Windermere RE Lane County', '541-484-2022', 'Florence', '2013-04-17', 190000, NULL, NULL, 'US', 190000, 'Hwy 101 S to Clear Lake; lt on Clear Lake to Cloud Nine; lt to end.', NULL, NULL, '43.912465', '199000', '-124.089932', '6083732', 'Varied', 43560, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06000000/80000/3000/6083732-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Dunes City\'s newest waterfront area.  Wooded waterfront 1 acre lots on beautiful Woahink Lake.  Boat or swim from your own dock.  Very private neighborhood and lots.  Underground utilities installed; water and septic approvals furnished.  Weather protected area with wonderful views.', 'Cloud Nine', NULL, NULL, NULL, '97439', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(30, NULL, NULL, NULL, 'Wasco Realty', '541-993-4111', 'Maupin', '2022-04-29', 115000, NULL, NULL, 'US', 115000, 'South on 197 to Juniper Flat Rd, rt Victor Rd, lft on Paulson Rd', NULL, NULL, '45.180318', '130000', '-121.18596', '6088273', NULL, 574556, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06000000/80000/8000/6088273-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Unique 13 acres in Juniper Flat  Views of Badger Canyon& Mt. Hood.  Close to Portland, Kahneeta, Central Oregon,  Deschutes River or Mt. Hood.  Make this your recreation headquarters!  Check with Wasco County regarding a conditional use permit for a non farm dwelling.  Owners will carry contract!', 'Paulson', NULL, NULL, NULL, '97037', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(31, NULL, NULL, NULL, 'Lighthouse Realty/Ocean Park', '360-665-4141', 'LongBeach', '2017-06-01', 147000, NULL, NULL, 'US', 147000, 'West on Sid Snyder Drive (South 10th)', NULL, NULL, '46.346374', '160000', '-124.058577', '6088871', '100 x 100 (x2)', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06000000/80000/8000/6088871-1-a.jpg', 'Land', 'Industrial', 'Owners terms. Grow your business from the ground up! Own a piece of Long Beach Prime Real Estate. Two lots on Sid Snyder Drive and corner of proposed Sea Shore Drive. Right on the beach approach & steps to the Board Walk.', 'Sid Snyder', NULL, NULL, NULL, '98631', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(32, NULL, NULL, NULL, 'Coldwell Banker Seal', '360-892-7325', 'Camas', '2012-06-25', 60000, NULL, NULL, 'US', 60000, 'Brady Road to 24th Avenue, east to Maryland, left to property', NULL, NULL, '45.59802', '60000', '-122.445699', '6091352', '153x73', 10890, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06000000/90000/1000/6091352-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Build your dream house here!  This prime building lot has all utilities available, is graded, and is ready for you to get started.  Best of all, the location is on a very quiet street with nice territorial views.  Check it out today.', '26TH', '3512', 3512, NULL, '98607', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(33, NULL, NULL, NULL, 'Century 21 Agate Realty', '541-469-2143', 'Brookings', '2014-01-24', 275000, NULL, NULL, 'US', 275000, 'RAILROAD TO WHARF JUST PAST THE COVE ON LEFT', NULL, NULL, '42.04633', '299900', '-124.286461', '6104651', '70\' X 150\'', 22215, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06100000/00000/4000/6104651-1-a.jpg', 'Land', 'SingleFamilyResidence', 'LAST OCEAN FRONT LOT IN THIS EXCLUSIVE GATED COMMUNITY, NESTLED BETWEEN MILLION DOLLAR HOMES, BREATHTAKING VIEWS OF THE OCEAN, SOUTHCOAST AND COASTAL MOUNTAINS. BUILD YOUR DREAM HOME ON THIS DREAM LOT. COMMON WALKWAY TO BEACH.', 'Chetco Point', '845', 845, NULL, '97415', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(34, NULL, NULL, NULL, 'Empire Real Estate', '503-397-5556', 'Prescott', '2012-05-22', 35000, NULL, NULL, 'US', 35000, 'Hwy 30 to Graham Rd, Cross RR Tracks to Dwight St. Lot #6 in Prescott', NULL, NULL, NULL, '46000', NULL, '6106436', NULL, 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06100000/00000/6000/6106436-1-a.jpg', 'Land', 'SingleFamilyResidence', 'FISCHER\'S PARADISE, just a few blocks to the MIGHTY COLUMBIA RIVER, partial view of the River from LARGE LOT.  Watch the ships/boats go by, great fishing too.  Community, Water, septic approved.  Build your dream home here.  Enjoy PRESCOTT BEACH in the Summertime.  Seller/Lister Brokers', 'Dwight', NULL, NULL, NULL, '90704', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(35, NULL, NULL, NULL, 'Windermere/Stellar Group, LLC', '360-253-3600', 'Vancouver', '2013-04-17', 53233, NULL, NULL, 'US', 53233, 'HWY 99 go East on 68th St and North on 28th Ave', NULL, NULL, '45.674651', '49900', '-122.641395', '6106484', '50x93', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06100000/00000/6000/6106484-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Close In New Subdivision situated on 9.8 acres touching the city limits of Vancouver. Easy access to shopping and freeways. Level and gently sloping topography adds character to the lots with many enjoying a view of the surrounding area. 5,000+ sqft lots average.', '72nd', '2802', 2802, NULL, '98665', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(36, NULL, NULL, NULL, 'Windermere/Stellar Group, LLC', '360-253-3600', 'Vancouver', '2013-04-17', 53233, NULL, NULL, 'US', 53233, 'HWY 99 go East on 68th St and North on 28th Ave', NULL, NULL, '45.674904', '54900', '-122.641404', '6106487', '53x90', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06100000/00000/6000/6106487-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Close In New Subdivision situated on 9.8 acres touching the city limits of Vancouver. Easy access to shopping and freeways. Level and gently sloping topography adds character to the lots with many enjoying a view of the surrounding area. 5,000+ sqft lots average.', '72nd', '2806', 2806, NULL, '98665', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(37, NULL, NULL, NULL, 'Windermere/Stellar Group, LLC', '360-253-3600', 'Vancouver', '2013-04-18', 53233, NULL, NULL, 'US', 53233, 'HWY 99 go East on 68th St and North on 28th Ave', NULL, NULL, '45.672798', '54900', '-122.642092', '6106582', '45x85 prox', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06100000/00000/6000/6106582-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Close In New Subdivision situated on 9.8 acres touching the city limits of Vancouver. Easy access to shopping and freeways. Level and gently sloping topography adds character to the lots with many enjoying a view of the surrounding area. 5,000+ sqft lots average.', '70th', '2714', 2714, NULL, '98665', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(38, NULL, NULL, NULL, 'Gold Coast Properties, Inc.', '541-347-4533', 'Bandon', '2014-03-07', 179900, NULL, NULL, 'US', 179900, 'Call Listing Agent', NULL, NULL, '43.122536', '199900', '-124.305404', '6106799', NULL, 871200, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06100000/00000/6000/6106799-1-a.jpg', 'Land', 'FarmForest', 'Remarkable views of Coquille River & Valley. Distant ocean view. 20 acre lot parcel just 10 minutes from Bandon. Lots of flat land. Paved road and utilities to property. Great for horses! This property has had a recent property line adjustment and has not been mapped.', 'NORTH BANK', NULL, NULL, NULL, '97423', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(39, NULL, NULL, NULL, 'North Point, Inc.', '541-269-1601', 'Reedsport', '2021-11-01', 220000, NULL, NULL, 'US', 220000, 'Hwy 101 N, left on 20th St to address', NULL, NULL, '43.699768', '200000', '-124.121532', '6108670', 'irregular', 9147, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06100000/00000/8000/6108670-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Excellent building site in new CC&R protected subdivision adjacent to golf course. Lots #9 through #14.', 'Masters', '9', 9, NULL, '97467', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(40, NULL, NULL, NULL, 'Mastco Properties', '541-662-0348', 'Reedsport', '2021-08-26', 59950, NULL, NULL, 'US', 59950, 'Hwy 101 N, left on 20th St to Masters Way to address', NULL, NULL, '43.699768', '59950', '-124.121532', '6108736', NULL, 7840, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06100000/00000/8000/6108736-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Excellent building site in new CC&R protected subdivision adjacent to golf course.', 'Masters', '15', 15, NULL, '97467', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(41, NULL, NULL, NULL, 'Mastco Properties', '541-662-0348', 'Reedsport', '2021-08-20', 64950, NULL, NULL, 'US', 64950, 'Hwy 101 N, left on 20th St to Masters Way to Masters Lane', NULL, NULL, '43.699768', '64950', '-124.121532', '6108740', NULL, 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06100000/00000/8000/6108740-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Excellent building site in new CC&R protected subdivision adjacent to golf course.', 'Masters', '16', 16, NULL, '97467', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(42, NULL, NULL, NULL, 'North Point, Inc.', '541-269-1601', 'Reedsport', '2021-07-19', 57000, NULL, NULL, 'US', 57000, 'Hwy 101 N, left on 20th St to Masters Way to Masters Lane to Masters Ct', NULL, NULL, '43.699768', '64950', '-124.121532', '6108749', 'irreg', 16117, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06100000/00000/8000/6108749-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Excellent building site in new CC&R protected subdivision adjacent to golf course.', 'Masters', '17', 17, NULL, '97467', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(43, NULL, NULL, NULL, NULL, NULL, 'Reedsport', NULL, 0, NULL, NULL, 'US', 99950, 'Hwy 101N, left on 20th St to Masters Way to address', NULL, NULL, '43.699768', '99950', '-124.121532', '6108754', 'Irreg', 16988, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06100000/00000/8000/6108754-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Excellent building site in new CC&R protected subdivision adjacent to golf course.', 'Masters', '8', 8, NULL, '97467', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(44, NULL, NULL, NULL, 'North Point, Inc.', '541-269-1601', 'Reedsport', '2021-08-26', 59950, NULL, NULL, 'US', 59950, 'Hwy 101N, left on 20th to Masters Way to Masters Lane to Masters Court', NULL, NULL, '43.699768', '59950', '-124.121532', '6108779', NULL, 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06100000/00000/8000/6108779-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Excellent building site in new CC&R protected subdivision adjacent to golf course. Lots 5 & 6 combined.', 'Masters', '5', 5, NULL, '97467', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(45, NULL, NULL, NULL, 'North Point, Inc.', '541-269-1601', 'Reedsport', '2019-10-10', 45000, NULL, NULL, 'US', 45000, 'Hwy 101N, left on 20th to Masters Way to Masters Lane to Masters Ct.', NULL, NULL, '43.699768', '64950', '-124.121532', '6108782', 'Irreg', 11325, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06100000/00000/8000/6108782-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Excellent building site in new CC&R protected subdivision adjacent to golf course.', 'Masters', '4', 4, NULL, '97467', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(46, NULL, NULL, NULL, 'North Point, Inc.', '541-269-1601', 'Reedsport', '2019-10-10', 45000, NULL, NULL, 'US', 45000, 'Hwy 101N, left on 20th St to Masters Way to Masters Lane to Masters Ct.', NULL, NULL, '43.699768', '64950', '-124.121532', '6108785', NULL, 8276, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06100000/00000/8000/6108785-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Excellent building site in new CC&R protected subdivision adjacent to golf course.', 'Masters', '3', 3, NULL, '97467', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(47, NULL, NULL, NULL, 'North Point, Inc.', '541-269-1601', 'Reedsport', '2019-10-10', 45000, NULL, NULL, 'US', 45000, 'Hwy 101N, left on 20th to Masters Way to Masters Lane to Masters Ct.', NULL, NULL, '43.699768', '64950', '-124.121532', '6108789', NULL, 8276, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06100000/00000/8000/6108789-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Excellent building site in new CC&R protected subdivision adjacent to golf course.', 'Masters', '2', 2, NULL, '97467', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(48, NULL, NULL, NULL, 'North Point, Inc.', '541-269-1601', 'Reedsport', '2019-10-10', 45000, NULL, NULL, 'US', 45000, 'Hwy 101 N, left on 20th St to Masters Way to Masters Lane to Masters Ct.', NULL, NULL, '43.699768', '64950', '-124.121532', '6108794', NULL, 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/06100000/00000/8000/6108794-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Excellent building site in new CC&R protected subdivision adjacent to golf course.', 'Masters', '1', 1, NULL, '97467', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(49, NULL, NULL, NULL, 'Maupin Realty', '541-395-2479', 'Maupin', '2012-02-01', 20000, NULL, NULL, 'US', 20000, 'US  HWY  197  TO  BLUEROCK  RD', NULL, NULL, '45.170216', '25000', '-121.091625', '7002634', NULL, 5662, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/00000/2000/7002634-1-a.jpg', 'Land', 'SingleFamilyResidence', 'BEAUTIFUL NEW SUBDIVISION IN MAUPIN. PONDS,PARK AND OPEN SPACE MAKES THIS PLANNED COMMUNITY A SPECIAL PLACE TO LIVE.PRIME BUILDING LOTS. BUILD YOUR DREAM HOME IN SUNNY MAUPIN AND ENJOY THE DESCHUTES RIVER. SUBJECT TO  CC@RS AND BYLAWS. UNDERGROUND UTILITIES.', 'FISH TAIL', '50', 50, NULL, '97037', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(50, NULL, NULL, NULL, 'Siskiyou Coast Realty', '541-332-7777', 'PortOrford', '2018-05-31', 74000, NULL, NULL, 'US', 74000, 'hwy 101, west on 9th St, up Coast Guard Hill, right on Boothill aka Spyglass Lane', NULL, NULL, '42.74371', '85000', '-124.5026', '7004965', NULL, 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/00000/4000/7004965-1-a.jpg', 'Land', 'SingleFamilyResidence', 'NICELY SHELTERED lot in an ocean view subdivision with protective CC&R\'s.', 'Spyglass', NULL, NULL, NULL, '97465', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(51, 3, 3, 3014.00, 'RE/MAX River and Sea', '503-738-9552', 'Seaside', '2012-04-13', 349000, NULL, NULL, 'US', 349000, '101 to Lewis and Clark Road to Royal View', 3.00, 'Attached', '46.012192', '349000', '-123.895006', '7004999', 'irregular', 20473, 2246, 3.00, 'https://www.rmlsweb.com/webphotos/07000000/00000/4000/7004999-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'Outstanding ocean & city views from this beautifully cared for contemporary home in desirable Royal View. This home features and open floor plan, extensive tile work, a spectacular stone fireplace with gas insert, great outdoor living space, fenced yard, and other amenities galore, such as a sauna, central vac, and security system.', 'ROYAL VIEW', '2345', 2345, 1992, '97138', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(52, NULL, NULL, NULL, 'Don Nunamaker Realtors', '541-386-4400', 'Dallesport', '2017-07-10', 140000, NULL, NULL, 'US', 140000, 'E St. to Sunridge Ave., Make Right, Property on Right.', NULL, NULL, '45.61709', '139900', '-121.189659', '7008198', '200x203x200x211', 40946, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/00000/8000/7008198-1-a.jpg', 'Land', 'SingleFamilyResidence', 'New Price. Easy to Build. Almost 1 acre. Private near end of cul-de-sac location. Great neighborhood. Beautiful views of Gorge mountains and The Dalles city lights. Southern exposure. Easy to build with power on property, city sewer in the street and one water hook-up included. Lot backs to wetlands area. Buildable area is approx. 104x203x180x211(street). Minutes to airport, hospital, shopping and recreation.Only 14\" of rain annually.', 'Sunridge', NULL, NULL, NULL, '98617', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(53, NULL, NULL, NULL, 'RE/MAX Professional Realty', '541-673-3272', 'Roseburg', '2013-01-25', 15500, NULL, NULL, 'US', 15500, 'I-5 Exit 119, left at 2nd light, right on Brittney to Highlands, to top', NULL, NULL, '43.135241', '84900', '-123.384398', '7008591', NULL, 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/00000/8000/7008591-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Excellent view lots in an adult (55+) community.  Clubhouse with pool, exercise areas, sauna, meeting rooms, kitchen, TV area and more.  Gated entry, walking trail, manufactured homes or stick built allowed.  CC&R\'s for your protection.', 'HIGHLAND VISTA', '633', 633, NULL, '97470', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(54, NULL, NULL, NULL, 'Berkshire Hathaway HomeServices Real Estate Professionals', '541-673-1890', 'MyrtleCreek', '2016-06-02', 235000, NULL, NULL, 'US', 235000, 'Riverside to S. Myrtle, out about 11 miles to Letitia creek on left.', NULL, NULL, '43.040999', '399900', '-123.09157', '7009777', NULL, 1879614, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/00000/9000/7009777-1-a.jpg', 'Land', 'FarmForest', 'Nice secluded parcel 10 miles out of town. Over 40 acres with year round creek.Planning says property is buildable, buyer and agent to verify with planning. No timber cruise has been done, or assay for gold mine. Miles of trails on and north of property.', 'S. Myrtle', '0', 0, NULL, '97457', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(55, NULL, NULL, NULL, 'Allen & Co. Real Estate LLC', '541-329-0497', 'Bandon', '2012-10-02', 20000, NULL, NULL, 'US', 20000, '11th ST W, R on Beach Loop, R on 8th, R on Madison, lot on L.', NULL, NULL, '43.115728', '25000', '-124.428928', '7013327', '66\' x 138\'+/-', 9147, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/10000/3000/7013327-1-a.jpg', 'Land', 'SingleFamilyResidence', 'GREAT LOCATION & SECOND STORY OCEAN VIEWS possible from this 66\' x 138\' lot on Bandon\'s westside.  Short walk to Beach Access & adjacent to Bandon City Library, Sprague Theater, Community Center and City Park.  Ideal for new construction or manufactured home.  Duplex construction may be possible. This is a short sale subject to lender\'s approval.', 'Madison', NULL, NULL, NULL, '97411', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(56, NULL, NULL, NULL, 'Maupin Realty', '541-395-2479', 'Maupin', '2012-05-09', 22500, NULL, NULL, 'US', 22500, 'US  HWY  197  TO  BLUEROCK  RD', NULL, NULL, '45.170216', '25000', '-121.091625', '7016547', NULL, 5662, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/10000/6000/7016547-1-a.jpg', 'Land', 'SingleFamilyResidence', 'BEAUTIFUL NEW SUBDIVISION IN MAUPIN. PONDS,PARK AND OPEN SPACE MAKES THIS PLANNED COMMUNITY A SPECIAL PLACE TO LIVE.PRIME BUILDING LOTS. BUILD YOUR DREAM HOME IN SUNNY MAUPIN AND ENJOY THE DESCHUTES RIVER. SUBJECT TO  CC@RS AND BYLAWS. UNDERGROUND UTILITIES.', 'LOT 47  FISH TALE', NULL, NULL, NULL, '97037', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(57, NULL, NULL, 1800.00, 'Neath The Wind Realty, Inc.', '541-332-9463', 'PortOrford', '2017-06-08', 120000, NULL, NULL, 'US', 120000, 'north on Port Orford Loop Road, shop and property on west side', NULL, NULL, '42.760876', '165000', '-124.494667', '7020039', NULL, 74052, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/20000/0000/7020039-1-a.jpg', 'CommercialSale', 'Warehouse', 'Just reduced! Huge shop in a Commercial Zone and located in a rural area. Currently rented as a Tire and Auto Repair shop. Property is within City limits and is hooked up to city utilities. There are 3 lots included in this sale for a total acreage of 1.7 acres. A seasonal creek runs at the back of the property.Lots of potential with this level and easily accessible land.', 'Port Orford Loop', '2851', 2851, 1980, '97465', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(58, NULL, NULL, NULL, 'Roseburg Homes Realty', '541-580-2211', 'Roseburg', '2013-06-28', 130000, NULL, NULL, 'US', 130000, 'GARDEN VALLEY, R ON CHEROKEE TO END, THRU GATE & STRAIGHT AT THE Y, LOT ON LEFT', NULL, NULL, '43.277425', '139500', '-123.399904', '7025658', '289X198X202X93', 45738, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/20000/5000/7025658-1-a.jpg', 'Land', 'SingleFamilyResidence', 'ROSEBURG\'S NEWEST RURAL COMMUNITY. ENJOY THE SECURITY OF THIS GATED COMMUNITY AT THE END OF CHEROKEE AVENUE. CLOSE TO ROSEBURG COUNTRY CLUB AND ONLY MINUTES FROM TOWN. RIVER ACCESS AND IRRIGATION, CALL FOR DETAILS.', 'CHEROKEE', '776', 776, NULL, '97470', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(59, NULL, NULL, NULL, 'RE/MAX Professional Realty', '541-673-3272', 'Roseburg', '2012-02-24', 125000, NULL, NULL, 'US', 125000, 'GARDEN VALLEY, R ON CHEROKEE TO END, NEW SUBDIVISION', NULL, NULL, '43.276356', '139500', '-123.403247', '7025687', '177X249X118X299', 46173, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/20000/5000/7025687-1-a.jpg', 'Land', 'SingleFamilyResidence', 'ROSEBURG\'S NEWEST RURAL COMMUNITY. ENJOY THE SECURITY OF THIS GATED COMMUNITY AT THE END OF CHEROKEE AVENUE. CLOSE TO ROSEBURG COUNTRY CLUB AND ONLY MINUTES FROM TOWN. RIVER ACCESS AND IRRIGATION, CALL FOR DETAILS.', 'CHEROKEE', '560', 560, NULL, '97470', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(60, NULL, NULL, NULL, 'Coldwell Banker Professional', '503-538-0468', 'Gervais', '2013-08-20', 600000, NULL, NULL, 'US', 600000, 'Gervais, W on St. Louis Rd, cross I-5 , first left', NULL, NULL, '45.116188', '899000', '-122.918587', '7031707', NULL, 4481017, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/30000/1000/7031707-1-a.jpg', 'Land', 'FarmForest', 'Bring all offers! Property is owned outright. Over 100 acres of level Farm Land bordering I-5. Bring your dreams to this well drained parcel. Zoned EFU, may build with farm plan or have ag related business. Call Marion County Planning Dept. for more details.', 'SAINT LOUIS', '7176', 7176, NULL, '97026', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(61, NULL, NULL, 1000.00, 'Prudential Seaboard Properties', '541-269-0355', 'CoosBay', '2012-11-01', 95000, NULL, NULL, 'US', 95000, 'north of abel insurance on Newport avenue', 20.00, NULL, '43.356064', '145000', '-124.202506', '7032760', 'IRREG', 20473, NULL, 20.00, 'https://www.rmlsweb.com/webphotos/07000000/30000/2000/7032760-1-a.jpg', 'CommercialSale', 'Commercial', 'Great location with high traffic count commercial building and 2 homes. 240 feet of high traffic paved road frontage and easily viewable within a few feet of highway 101. Lots of potential for a commercial investment.', 'Newport', '93705', 93705, 1923, '97420', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(62, 3, 4, 2945.00, 'Prudential Seaboard Properties', '541-269-0355', 'CoosBay', '2012-06-19', 362000, NULL, NULL, 'US', 362000, 'W. on Ocean L on Radar (R) on Fulton and Left on Prefontain to Inlet', 2.00, 'Attached', '43.321005', '419000', '-124.080508', '7037563', NULL, 10454, 2945, 2.00, 'https://www.rmlsweb.com/webphotos/07000000/30000/7000/7037563-1-a.jpg', 'Residential', 'Attached', 'THIS IS A WONDERFUL CUSTOM BUILT HOME!!  OCEAN AND BAY VIEWS!!! ALL ON ONE LEVEL!!!  4 Large Bedrooms!!! THE MASTER SUITE HAS A DECK THAT YOU CAN WATCH THE SHIPS COME IN EVERY MORNING AND EVENING!!!  THERE IS SO MUCH MORE ABOUT THIS HOME THAT WORDS CAN\'T EVEN DESCRIBE!!!!', 'Inlet Loop', '964', 964, 2007, '97420', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(63, NULL, NULL, 19076.00, 'Century 21 Agate Realty', '541-469-2143', 'Brookings', '2017-08-10', 1500000, NULL, NULL, 'US', 1500000, '101N , Rt on 5th st. at the corner of 5th & Easy', NULL, NULL, '42.058285', '1600000', '-124.288654', '7042864', NULL, 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/40000/2000/7042864-1-a.jpg', 'MultiFamily', NULL, 'A 20 UNIT APARTMENT COMPLEX FOR THE SERIOUS INVESTOR. THERE ARE 2-3BD/2BA UNITS, 14-2BD/2BA UNITS & 4-1BD/1BA UNITS LOCATED JUST MINUTES TO SHOPPING, SCHOOLS AND PARKS.', 'FIFTH', '650', 650, 1977, '97415', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(64, 2, 3, 1523.00, 'Coldwell Banker Coast Real Est', '541-997-7777', 'Florence', '2014-07-07', 205000, NULL, NULL, 'US', 205000, 'WEST ON 9th, NORTH ON HEMLOCK', 2.00, 'Attached', '43.977651', '210000', '-124.113629', '7043242', NULL, 9583, 1523, 2.00, 'https://www.rmlsweb.com/webphotos/07000000/40000/3000/7043242-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'LIKE NEW 3 BEDROOM HOME ON A LARGE LOT IN PHASE 1.  GARAGE HAS BEEN WIDENED BY 2 FT.  ACRES OF PARKS, CLOSE TO HOSPITAL, LOCATED IN THE HEART OF FLORENCE.  UNDERGROUND SPRINKLERS & FENCED BACKYARD.', 'PARK VILLAGE', '5', 5, 2005, '97439', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(65, 1, 0, 693.00, 'Realty Trust Group, Inc.', '503-294-1101', 'Portland', '2012-06-13', 297500, NULL, NULL, 'US', 297500, 'NW 10th and Northrup', 1.00, 'Attached', '45.532551', '301500', '-122.680784', '7046031', NULL, 0, 693, 1.00, 'https://www.rmlsweb.com/webphotos/07000000/40000/6000/7046031-1-a.jpg', 'Residential', 'Condominium', 'Great Floor Plan. Studio with Constructavision custom wall for private sleeping area. Feels like a true bedroom! This well appointed loft includes an 18x 5.5 ft balcony, a Bosch appliance package and designer fixtures and private sleeping area.One deeded parking and storage space included. (Virtual tour of similar unit)', 'Overton', '949', 949, 2009, '97209', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(66, NULL, NULL, NULL, 'Toby Lewis Real Estate', '503-682-3380', 'Sandy', '2012-03-02', 551000, NULL, NULL, 'US', 551000, 'Hwy. 26 to Firwood Rd (Shortys corner),rt to Music Camp Rd, 1 mi.', NULL, NULL, '45.365474', '650000', '-122.204041', '7047631', NULL, 3484800, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/40000/7000/7047631-1-a.jpg', 'Land', 'FarmForest', 'Outstanding view of Mt. Hood & Cascade Range,   much timber,fixer house, barn & large (90x27) storage shed.', 'MUSIC CAMP', '44225', 44225, NULL, '97055', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(67, 1, 0, 725.00, 'Hoyt Realty Group', '503-227-2000', 'Portland', '2012-09-10', 312000, NULL, NULL, 'US', 312000, 'NW 10th Ave & Overton', 1.00, 'Attached', '45.532398', '312000', '-122.680871', '7048113', NULL, 0, 725, 1.00, 'https://www.rmlsweb.com/webphotos/07000000/40000/8000/7048113-1-a.jpg', 'Residential', 'Condominium', 'Spacious Loft with 725 sq.ft. Cherry hardwood floors,Silestone Countertops,Bosch Appliances, Balcony with Mt. Hood, City & River views! 1 Parking & 1 storage space inc. Encore is located on the future \"Fields\" Park in the Pearl, Encore is LEED Silver Building, Fitness Room & Community Room onsite (Virtual tour of similar unit)', 'Overton', '949', 949, 2009, '97209', '2023-05-12 11:36:56', '2023-05-12 11:36:56');
INSERT INTO `resoapi_properties` (`id`, `BathroomsTotalInteger`, `BedroomsTotal`, `BuildingAreaTotal`, `BuyerOfficeName`, `BuyerOfficePhone`, `City`, `CloseDate`, `ClosePrice`, `CondominiumElevatorYN`, `CondominiumGarageType`, `Country`, `CurrentPriceForStatus`, `Directions`, `GarageSpaces`, `GarageType`, `Latitude`, `ListPrice`, `Longitude`, `ListingId`, `LotSizeDimensions`, `LotSizeSquareFeet`, `MainLevelAreaTotal`, `ParkingTotal`, `Photo1URL`, `PropertyType`, `PropertySubType`, `PublicRemarks`, `StreetName`, `StreetNumber`, `StreetNumberNumeric`, `YearBuilt`, `PostalCode`, `created_at`, `updated_at`) VALUES
(68, 1, 1, 890.00, 'Windermere/C&C P. Heights', '503-227-5500', 'Portland', '2013-02-27', 381000, NULL, NULL, 'US', 381000, 'Nw 10th & Overton', 1.00, 'Attached', '45.532725', '381000', '-122.680985', '7048114', NULL, 0, 890, 1.00, 'https://www.rmlsweb.com/webphotos/07000000/40000/8000/7048114-1-a.jpg', 'Residential', 'Condominium', 'VIEWS of PARK.1 Bedroom + Den w/890sq.ft. The Encore has its front door on 3 blocks that will be a beautiful new PARK. Hardwood floors, solid counter tops, refrigerator & dishwasher have wood panel trims. Parking space and storage unit included in sale. Work out & Conference Room.', 'Overton', '949', 949, 2009, '97209', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(69, 3, 5, 3186.00, 'Pacific Coastal Real Estate', '541-247-7925', 'Bandon', '2014-04-16', 535000, NULL, NULL, 'US', 535000, 'From 101 go W on 11th, S on Beach Loop, R on Caryll Court', 2.00, 'ExtraDeep', '43.101406', '549000', '-124.430657', '7051551', 'Irregular', 12632, 1471, 2.00, 'https://www.rmlsweb.com/webphotos/07000000/50000/1000/7051551-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'TREMENDOUS VIEWS! Mostly Unobstructible Ocean & Rock Views from Bandon Custom Home now managed as a successful Vacation Rental. Seller Carry Possible. Sensual Natural Wood, Stone, Fossils, Slate, Saltillo Tile, Mosaics, 3200 sq. ft., 5 Bed, 3 Bath, Decks, Spas, Fire Pit, RV garage, Large creekside lot. Entertain grandly or relax comfortably surrounded by beauty!', 'CARYLL', '2688', 2688, 1997, '97411', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(70, 3, 3, 2342.00, 'Coldwell Banker Coast Real Est', '541-997-7777', 'Florence', '2013-10-31', 444000, NULL, NULL, 'US', 444000, 'Mercer Lk Rd - Collard Lake Rd near end - Collard Lake Way, home on R', 2.00, 'Detached', '44.038802', '449000', '-124.077062', '7053410', NULL, 33541, 1511, 2.00, 'https://www.rmlsweb.com/webphotos/07000000/50000/3000/7053410-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'Lovely lakefront home with dock and views of Collard Lake, dunes and over 200 species of Rhododendrons! Gourmet kitchen with island, pantry, glass-top stove, stainless fridge and Bosch d/w. Hardwood floors, wood stove, double masters + guest BR. 2-car garage with shop space and 384 sqft guest quarters with 3/4 bath. Additional buildable lot with septic approval, protects views.', 'COLLARD LAKE', '6029', 6029, 2003, '97439', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(71, 3, 3, 1780.00, 'Gold Coast Properties, Inc.', '541-347-4533', 'Bandon', '2012-12-28', 248000, NULL, NULL, 'US', 248000, 'Go to Beach Loop Drive and 13th Street. Turn east on Shore Pine Drive', 2.00, 'Attached', '43.111114', '259000', '-124.430116', '7056369', 'zero lot line', 0, 880, 2.00, 'https://www.rmlsweb.com/webphotos/07000000/50000/6000/7056369-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'This unit has superior views. Steps away from beautiful sandy beaches; close to downtown; intimate neighborhood with lighted walkways and courtyards; village-like community with narrow streets and slow traffic speeds; exterior maintenance provided; 2, 3 & 4 BR homes, see mls #\'s 7056378, 7055660, 7055802, 7055688, 7055118, 7055138, 7055728,', 'Alder', '1415', 1415, 2007, '97411', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(72, NULL, NULL, NULL, 'Parker Brennan Real Estate', '360-831-5718', 'Washougal', '2012-10-09', 60000, NULL, NULL, 'US', 60000, 'Washougal River Rd; RIGHT on 25th; LEFT on N \"P\" Cir', NULL, NULL, '45.588457', '63000', '-122.344161', '7059671', '7,973 SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/50000/9000/7059671-1-a.jpg', 'Land', 'SingleFamilyResidence', 'RIVER WALK ESTATES - New 17 LOT subdivision on Washougal River. In-town location, bring your own builder. All lots have river access, some have river frontage & others a Mt Hood view.  This rare offering includes river access to great salmon & steelhead fishing or just enjoy the wildlife show. Nice quality lots up to over 10,000 SF.', 'P', '2541', 2541, NULL, '98671', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(73, NULL, NULL, NULL, 'Coldwell Banker Seal', '360-892-7325', 'Washougal', '2012-08-08', 115000, NULL, NULL, 'US', 115000, 'Washougal River Rd; RIGHT on 25th; LEFT on N \"P\" Cir', NULL, NULL, '45.588548', '120000', '-122.343495', '7059696', '11,115 SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/50000/9000/7059696-1-a.jpg', 'Land', 'SingleFamilyResidence', 'RIVER WALK ESTATES - New 17 LOT subdivision on Washougal River. In-town location, bring your own builder. All lots have river access, some have river frontage & others a Mt Hood view.  This rare offering includes river access to great salmon & steelhead fishing or just enjoy the wildlife show. Nice quality lots up to over 10,000 SF. Seller Financing?', 'P', '2572', 2572, NULL, '98671', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(74, NULL, NULL, NULL, 'Windermere/Stellar Group, Inc.', '360-253-3600', 'Washougal', '2012-07-20', 100000, NULL, NULL, 'US', 100000, 'Washougal River Rd; RIGHT on 25th; LEFT on N \"P\" Cir', NULL, NULL, '45.588689', '120000', '-122.343659', '7060174', '9,054 SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/60000/0000/7060174-1-a.jpg', 'Land', 'SingleFamilyResidence', 'RIVER WALK ESTATES - New 17 LOT subdivision on Washougal River. In-town location, bring your own builder. All lots have river access, some have river frontage & others a Mt Hood view.  This rare offering includes river access to great salmon & steelhead fishing or just enjoy the wildlife show. Nice quality lots up to over 10,000 SF.  Seller Financing!', 'P', '2582', 2582, NULL, '98671', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(75, NULL, NULL, NULL, 'Windermere GTRE Bingen', '509-493-4666', 'Husum', '2015-03-24', 170000, NULL, NULL, 'US', 170000, 'N on Hwy 141 Past Husum.  Right  On Black Tail Dr.', NULL, NULL, '45.828666', '179000', '-121.490309', '7061672', NULL, 135036, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/60000/1000/7061672-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Come build your dream home on these beautiful rolling lots in N Husum Valley. Nice Mt. Hood Views. All lots will need re-perked and will need to have well installed. Paved road,CC&Râ€™s to protect investment.Two lots to choose from starting $129,000.', 'Black Tail Dr', '1', 1, NULL, '98623', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(76, NULL, NULL, NULL, 'Parkwood Properties PDX, LLC', '503-709-4321', 'Sherwood', '2016-02-25', 340000, NULL, NULL, 'US', 340000, 'PDX, 99W to Sherwood, L Sunset, R Ladd Hill, R Parrett Mtn, R Labrousse', NULL, NULL, '45.326983', '340000', '-122.861316', '7062147', NULL, 61419, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/60000/2000/7062147-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Spectacular view in Prestigious The Ests Parrett Mtn. Located on Private Gated Rd, surrounded by 215 acres of forest reserve, water included. Seller requires following: Price $450,000 EM $10,000 released after 14 day due diligence. close on/before 60 days from mutual acceptance.', 'SNOWBERRY', '17973', 17973, NULL, '97140', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(77, NULL, NULL, NULL, 'RE/MAX River City', '541-436-4400', 'Husum', '2016-09-30', 129000, NULL, NULL, 'US', 129000, 'N on Hwy 141 Past Husum.  Right  On Black Tail Dr.', NULL, NULL, '45.827268', '129000', '-121.488914', '7062503', NULL, 112384, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/60000/2000/7062503-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Come build your dream home on these beautiful rolling lots in N Husum Valley. Nice Mt. Hood Views. All lots will need re-perked and will need to have well installed. Paved road,CC&Rs to protect investment.', 'Black Tail Dr', '3', 3, NULL, '98623', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(78, NULL, NULL, NULL, 'Gold Coast Properties, Inc.', '541-347-4533', 'Bandon', '2013-12-02', 310000, NULL, NULL, 'US', 310000, 'From Bandon go east onHwy 42S, 3 miles to R on Bear Creek, 4 miles up', NULL, NULL, '43.085513', '399000', '-124.325223', '7063748', NULL, 8598744, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/60000/3000/7063748-1-a.jpg', 'Land', 'FarmForest', 'Bandon Oceanview 197 Acres! Rolling Meadows of flowers between mighty trees, Wildlife Abounds, roads throughout, springs, old mobile, electric, phone, old orchard. Located in Elite Golf coastal recreation corridor.   View Bandon\'s Famous Rock Islands from multiple homesites!', 'BEAR CREEK', '53673', 53673, NULL, '97411', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(79, NULL, NULL, NULL, 'Century 21 Eagle Cap Realty', '541-963-0511', 'Union', '2013-08-12', 23500, NULL, NULL, 'US', 23500, 'west on beakman to corner of third', NULL, NULL, '45.208314', '26500', '-117.868298', '7064078', '100x105', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/60000/4000/7064078-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Nice lot in union.  Storage shed will stay with the property.  Nice lot to build your new home.', 'Beakman', '0', 0, NULL, '97883', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(80, 2, 3, 1782.00, 'Prudential Seaboard Properties', '541-396-5532', 'CoosBay', '2012-01-05', 150000, NULL, NULL, 'US', 150000, 'Hwy 42, to Coaledo, turn on Beaver Ck, to address.', 1.00, 'Detached', '43.237883', '215000', '-124.224029', '7065255', NULL, 283140, 1782, 1.00, 'https://www.rmlsweb.com/webphotos/07000000/60000/5000/7065255-1-a.jpg', 'Residential', 'ManufacturedHomeonRealProperty', 'Totally Private!  3bed 2bath 1 700 sq ft manufactured home with shop and detatched garage sits on 6.5 acres between coos Bay and Coquille. Completely secluded no neighbors in sight.', 'BEAVER CREEK', '92945', 92945, 1989, '97420', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(81, NULL, NULL, NULL, 'Blue Pacific Realty', '541-412-8424', 'GoldBeach', '2012-06-15', 140000, NULL, NULL, 'US', 140000, 'North Bank Rogue To Indian Hills to Spirit Ridege at the cul de sac', NULL, NULL, '42.477318', '199500', '-124.375255', '7067154', NULL, 230868, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/60000/7000/7067154-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Top of Indian Hills Estates, dramatic Rogue River and some Pacific Ocean Views. Abundant wildlife, great solar potential, and micro climate of its own. Paved roads mostly underground utilities, a wonderful area to build a home. Owner carry possibility', 'SPIRIT RIDGE', '95645', 95645, NULL, '97444', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(82, NULL, NULL, NULL, 'Pacific 101 Realty LLC', '541-997-8485', 'Florence', '2012-09-05', 180000, NULL, NULL, 'US', 180000, 'North on 101 between mile markers 172 & 173. Prop. on E side of Hwy 101', NULL, NULL, '44.207823', '195000', '-124.111073', '7070092', NULL, 204732, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/70000/0000/7070092-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Experience Pacific Ocean views from this one of a kind homesite. Lane County has approved this F2 property for 1 dwelling. The well is in, septic site evaluation is done as well as the homesite plot plan and survey. Electrical conduit has been installed, location map on file. Build your custom home on the Oregon Coast!', 'HWY 101', NULL, NULL, NULL, '97439', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(83, NULL, NULL, NULL, 'TR Hunter Real Estate', '541-997-1200', 'Florence', '2013-06-28', 15100, NULL, NULL, 'US', 15100, 'SEE REMARKS', NULL, NULL, '43.990406', '20000', '-124.094886', '7071253', '55 x 88', 4356, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/70000/1000/7071253-1-a.jpg', 'Land', 'RecreationOnly', 'GREAT RV LOT w/STURDY, WELL-BUILT RAMADA & UPGRADED ELECTRICAL, NESTLED IN A LOT SURROUNDED BY NATURAL VEGETATION. SELLER IS VERY MOTIVATED. GATED COMMUNITY WITH CLUBHOUSE, LAUNDRY, MAIL ROOM, PLAY AREA.  DUES $145./MO INCLUDES WATER, GARBAGE, SEWER.', 'SAILOR', '118', 118, NULL, '97439', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(84, NULL, NULL, 14400.00, 'Windermere/North Point, Inc.', '541-269-1601', 'CoosBay', '2013-03-06', 325000, NULL, NULL, 'US', 325000, 'Corner of S. Broadway and Kruse.', 30.00, NULL, '43.356874', '395000', '-124.213571', '7073730', '250 x 145', 36154, NULL, 30.00, 'https://www.rmlsweb.com/webphotos/07000000/70000/3000/7073730-1-a.jpg', 'CommercialSale', 'Commercial', 'Large open space complex with large office showroom. Numerous large overhead doors. Paved parking with at least 30+ spaces. 1/2 blockf from HWY101. 6 Floor vehicle lift.', 'BROADWAY', '1075', 1075, 1951, '97420', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(85, 4, 3, 3110.00, 'Bell Real Estate', '541-687-1663', 'Vida', '2013-11-06', 425000, NULL, NULL, 'US', 425000, 'McKenzie Hwy to the 4th driveway beyond MP 31', 3.00, 'Detached', '44.132626', '475000', '-122.486906', '7075441', NULL, 37026, 1759, 3.00, 'https://www.rmlsweb.com/webphotos/07000000/70000/5000/7075441-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'Breathtaking River Views!  Magnificent custom two story home with decks to enjoy the unbelievable landscaping with waterfalls, ponds, artful plantings, meandering paths and easy river access.  100+ ft of river frontage.', 'MCKENZIE', '47834', 47834, 1994, '97488', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(86, NULL, NULL, 3043.00, 'Prudential NW Properties', '503-652-1235', 'Portland', '2012-03-05', 210000, NULL, NULL, 'US', 210000, 'DUKE TO 73RD S TO CLAYBOURNE W TO 72ND', NULL, NULL, '45.474396', '249900', '-122.587379', '7076583', NULL, 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/70000/6000/7076583-1-a.jpg', 'MultiFamily', NULL, '2 DUPLEX UNITS - 6719-6721 3BR/1BA - 6725-6727 2BR4/1BA - 1 UNIT IN EACH BLDG READY TO RENT - 1 UNIT IN EACH BLDG NEED WORK - ZONED R2A SO GREAT POTENTIAL FOR BUILDER - SOLD \"AS IS\" - NO WARRANTEES ON THE PART OF THE SELLER OR AGENT.', '74TH', '6719', 6719, 1942, '97206', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(87, NULL, NULL, NULL, 'Coldwell Banker United Brokers', '509-773-7799', 'Goldendale', '2012-05-02', 26500, NULL, NULL, 'US', 26500, 'Bickleton Hwy, left on Old Mountain, Rt. on Holter, prop. on right', NULL, NULL, '45.852599', '29900', '-120.74554', '7078647', NULL, 862052, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/70000/8000/7078647-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Bring your horses! Outstanding Mt. Hood views on this private parcel.  Power is available just down the road. Spectacular views of Simcoe Mountains or down the draw. Adjoining parcel also available would make a nice mini-ranch. Possible owner contract. No show Fri. pm- Sat pm. Some alfalfa planted. Prop taxes are estimates.', 'HOLTER', NULL, NULL, NULL, '98620', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(88, NULL, NULL, NULL, 'Cascade Home Sales, Inc.', '360-254-0909', 'Ariel', '2012-08-01', 97500, NULL, NULL, 'US', 97500, '25 miles E of Woodlnd R on Shetler, L on Beaver Pond, L Bristlecone', NULL, NULL, '45.994368', '99900', '-122.339761', '7080549', NULL, 219542, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/80000/0000/7080549-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Peaceful living. Just 25 minutes to Woodland and BG. Power and water to property; perc approved. Walk to Yale Lake through public utility land with trails and easy access. Great hunting, fishing, horseback riding and boating area. Fenced,gated,  private, mostly paved road/culdesac. Great building site or rec area. Possible terms available: 30% dn, 6.5% int. rate, 20 yr cashout.', 'BRISTLECONE', '232', 232, NULL, '98603', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(89, 2, 2, 2140.00, 'Rustic Realty LLC', '541-894-0116', 'Granite', '2012-01-11', 370000, NULL, NULL, 'US', 370000, 'Granite Hwy', 1.00, 'Detached', '44.725717', '350000', '-118.334689', '7082969', NULL, 827640, 1605, 1.00, 'https://www.rmlsweb.com/webphotos/07000000/80000/2000/7082969-1-a.jpg', 'Residential', 'SingleFamilyResidence', '(H-2045)“Quality Log Chalet, 19+/- Acres” Main Floor, Open floor plan. Kitchen/Dining/Formal Dining/Living/1 bed, 1 bath/large laundry. Large Deck. Vaulted ceilings, large thermo windows. Loft, Very large Master bed/w veranda, walk in closet, large bath. Largegarage/shop w/cool room fit 3 veh. 36’X36’ attached lean-to utility, separate storage. Other out bldgs.', 'Granite Hwy', NULL, NULL, 1997, '97877', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(90, NULL, NULL, NULL, 'TR Hunter Real Estate', '541-997-1200', 'Mapleton', '2013-06-17', 75000, NULL, NULL, 'US', 75000, 'Hwy 126 E, Left on Richardson Road, Right on Old Stagecoach 1/2 mile up.', NULL, NULL, '44.000755', '100000', '-123.697024', '7087712', NULL, 348480, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/80000/7000/7087712-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Fisherman\'s paradise! 8 acres on the Siuslaw with 1425 feet of river frontage. Easy access to Salmon, Steelhead, and Trout.  Flat topography with privacy and room for a garden and horses. Home is in state of disrepair. Owner financing available.', 'OLD STAGECOACH', '15980', 15980, NULL, '97490', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(91, 2, 2, 1525.00, 'West Coast Real Estate Service', '541-997-7653', 'Florence', '2012-07-27', 230000, NULL, NULL, 'US', 230000, 'In Old Town Florence; SW corner of 1st and Harbor Streets', 1.00, 'Attached', '43.96837', '249000', '-124.102354', '7088714', NULL, 0, 1525, 1.00, 'https://www.rmlsweb.com/webphotos/07000000/80000/8000/7088714-1-a.jpg', 'Residential', 'Condominium', 'Elegant riverfront condo with eastward views. Quality features & amenities include oak hardwood, granite countertops, S/S appliances, custom closet organizers, window seats, gas fireplace, pantry, maple cabinetry, master bath w/heated Travertine tile floor, covered balcony w/slate floor.', 'Harbor', '75', 75, 2006, '97439', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(92, NULL, NULL, NULL, 'Premiere Property Group, LLC', '360-693-6139', 'Amboy', '2015-10-27', 65000, NULL, NULL, 'US', 65000, 'N on hwy 503,thru amboy,221st, E.  on cedar crk 419th, L on 244th av', NULL, NULL, '45.927931', '69900', '-122.418981', '7089675', '662 x 662', 439084, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/80000/9000/7089675-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Gorgeous view property.Military transfer forces sale.Minutes to amboy.New and proposed schools.Year round crk on property,Views to tum tum mountain w/outstanding territorial views.Pasture area for your animals.Seller in the process of wetland predetermination for crk buffer. County predeterm of easement to be on south property line. Buyer\'s responsibility to verify feasibility.', '244 th', NULL, NULL, NULL, '98601', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(93, NULL, NULL, NULL, 'Pacific Rim Brokers, Inc', '509-493-1783', 'WhiteSalmon', '2017-05-10', 60000, NULL, NULL, 'US', 60000, 'Jewett Blvd. north and look for sign on right.', NULL, NULL, '45.721447', '65000', '-121.471413', '7092172', '47x110', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/90000/2000/7092172-1-a.jpg', 'Land', 'MultiFamily', 'River view town house lot with all utilities in place, graded and ready to build. Water meter included.HOA with CCR\'s. Seller is a licensed real estate agent in the state of Washington. 2 lots must be purchased together.', 'Ingram', NULL, NULL, NULL, '98672', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(94, NULL, NULL, NULL, 'Pacific Rim Brokers, Inc', '509-493-1783', 'WhiteSalmon', '2017-05-10', 60000, NULL, NULL, 'US', 60000, 'Jewett Blvd. north and look for sign on right.', NULL, NULL, '45.721447', '65000', '-121.471413', '7092175', '25x107', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/90000/2000/7092175-1-a.jpg', 'Land', 'MultiFamily', 'River view town house lot with all utilities in place, graded and ready to build. Water meter included.HOA with CCR\'s. Seller is a licensed real estate agent in the state of Washington. 2 lots must be purchased together.', 'Ingram', NULL, NULL, NULL, '98672', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(95, NULL, NULL, NULL, 'Pacific Rim Brokers, Inc', '509-493-1783', 'WhiteSalmon', '2016-04-16', 72500, NULL, NULL, 'US', 72500, 'Jewett Blvd. north and look for sign on right.', NULL, NULL, '45.721447', '80000', '-121.471413', '7092186', '29x95', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/90000/2000/7092186-1-a.jpg', 'Land', 'MultiFamily', 'River view town house lot with all utilities in place, graded and ready to build. Water meter included.HOA with CCR\'s. Seller is a licensed real estate agent in the state of Washington. 2 lots must be purchased together.', 'Ingram', NULL, NULL, NULL, '98672', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(96, NULL, NULL, NULL, 'Pacific Rim Brokers, Inc', '509-493-1783', 'WhiteSalmon', '2016-04-16', 72500, NULL, NULL, 'US', 72500, 'Jewett Blvd. north and look for sign on right.', NULL, NULL, '45.721447', '80000', '-121.471413', '7092188', '29x93', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/90000/2000/7092188-1-a.jpg', 'Land', 'MultiFamily', 'River view town house lot with all utilities in place, graded and ready to build. Water meter included.HOA with CCR\'s. Seller is a licensed real estate agent in the state of Washington. 2 lots must be purchased together.', 'Ingram', NULL, NULL, NULL, '98672', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(97, NULL, NULL, NULL, 'Lighthouse Realty/Ocean Park', '360-665-4141', 'OceanPark', '2012-08-23', 29900, NULL, NULL, 'US', 29900, 'In Surfside North on I Street, on corner of I and 335th.', NULL, NULL, '43.832359', '29900', '-123.045208', '7092894', '65 x 134', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/90000/2000/7092894-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Septic installed July 2007, water installed on lot. House plans have been approved by Surfside and Pacific County, plans and permits are included with price. Build to 28ft for partial ocean view.', 'I', '33412', 33412, NULL, '98640', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(98, NULL, NULL, NULL, 'John J Howard & Associates', '541-663-9000', 'Centerville', '2014-09-12', 686000, NULL, NULL, 'US', 686000, 'West of Goldendale @ corner of Simcoe Mtn & Horseshoe Bend Rds.', NULL, NULL, '45.788461', '750000', '-120.916292', '7093852', NULL, 27878400, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/90000/3000/7093852-1-a.jpg', 'Land', 'FarmForest', 'An entire section of land for sale!  Has been farmed in wheat,hay & pasture. Beautiful mountain views. Rolling/level acreage, electric at property line. Roads on three sides. Property is in ag classification. Tenant has crop lease thru summer of 2014. Approx 480 tillable,160 rangeland.', 'HorseshoeBnd/SimcoMT', NULL, NULL, NULL, '98613', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(99, NULL, NULL, NULL, 'Keller Williams Realty Portland Premiere', '503-597-2444', 'Gresham', '2016-04-15', 117500, NULL, NULL, 'US', 117500, 'From Powell: Highland Drive South, Right on Nancy, Left on Equestrian', NULL, NULL, '44.086247', '117500', '-120.70857', '7093912', '87 x 95 Irreg', 8276, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/90000/3000/7093912-1-a.jpg', 'Land', 'SingleFamilyResidence', 'A rare chance for outright purchase of a lot in the desirable Hunter\'s Highland!  You can even bring your own Builder.  This lot backs up to Metro/Gresham owned open space, and is on a quiet dead-end street. Seller is Licensed Real Estate Agent in Oregon.', 'Equestrian', '4672', 4672, NULL, '97080', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(100, NULL, NULL, NULL, 'Ruben J. Menashe, Inc.', '503-255-9680', 'Gresham', '2015-06-22', 119750, NULL, NULL, 'US', 119750, 'From Powell: Highland Drive South, Right on Nancy, Left on Equestrian', NULL, NULL, '44.086247', '119750', '-120.70857', '7093914', '88 x 113 Irreg', 10018, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/90000/3000/7093914-1-a.jpg', 'Land', 'SingleFamilyResidence', 'A rare chance for outright purchase of a lot in the desirable Hunter\'s Highland subdivision.  You can even bring your own Builder.  This lot backs up to Metro/Gresham owned open space, and is on a quiet dead-end street. Seller is Licensed Real Estate Agent in Oregon.', 'Equestrian', '4640', 4640, NULL, '97080', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(101, NULL, NULL, NULL, 'Hasson Company Realtors', '503-228-9801', 'Portland', '2012-03-20', 850000, NULL, NULL, 'US', 850000, 'At intersection of Fairmount and Mitchell', NULL, NULL, '45.48758', '987250', '-122.694241', '7093916', 'IRREG', 39204, NULL, NULL, NULL, 'Land', 'SingleFamilyResidence', 'Impossible to find, almost 1 acre lot with view corridors of Downtown, Mt. Hood and Willamette River. Fantastic location in exquisite neighborhood with private tennis court. Available for build-order or sale. Seller is licensed real estate broker in Oregon.', 'FAIRMOUNT', '3125', 3125, NULL, '97239', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(102, NULL, NULL, NULL, 'Ranch-N-Home Realty, Inc', '541-963-5450', 'Imbler', '2015-10-14', 100000, NULL, NULL, 'US', 100000, 'Summerville Rd & Cresent Lane, turn South', NULL, NULL, '45.457214', '105000', '-117.967289', '7094067', NULL, 87120, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/90000/4000/7094067-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Measure 37 parcels. Subject to certain transferability rules. Nice area on the edge of Imbler. New street, DEQ approved for pressurized sandfilter systems. Well depths between 60\' - 150\'.  Price includes DEQ approval, completed foundation, blueprints, well and fencing. Seller has installed continuous fencing around the property. Garn Subdivision.', 'Lot 1 Cresent', NULL, NULL, NULL, '97841', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(103, NULL, NULL, NULL, 'Coldwell Banker Gesik Realty', '541-994-7760', 'LincolnCity', '2013-08-13', 37500, NULL, NULL, 'US', 37500, 'Hwy 229 to 12 mile marker, turn in direction of river to sign.', NULL, NULL, '44.832863', '39900', '-123.967514', '7094503', 'IRR', 20908, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07000000/90000/4000/7094503-1-a.jpg', 'Land', 'FarmForest', 'RIVER FRONT lot with additional lot for your recreational enjoyment. Both lots (#300 & 1200) approximately .48 acres. County records show septic system on tax lot# 300. OWNER WILL CARRY TO QUALIFIED BUYER.', 'Siletz', '12020', 12020, NULL, '97367', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(104, 2, 5, 1948.00, 'John J Howard & Associates', '541-663-9000', 'Union', '2013-08-20', 108000, NULL, NULL, 'US', 108000, 'turn west on arch, is on the corner of arch and second', 2.00, 'Attached', '45.209215', '115900', '-117.86772', '7095829', '100x105', 0, 1133, 2.00, 'https://www.rmlsweb.com/webphotos/07000000/90000/5000/7095829-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'Charming older home with an abundance of room and storage galore! Fenced yard with an attached double car garage as well as an attached, heated craft room or work shop! You can now enjoy all these great features at a reduced price!', 'Second', '108', 108, 1874, '97883', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(105, NULL, NULL, NULL, 'TR Hunter Real Estate', '541-997-1200', 'Florence', '2015-11-06', 29000, NULL, NULL, 'US', 29000, 'From 101, west on 35th, left on Wecoma to lot on right.', NULL, NULL, '43.996815', '32500', '-124.113758', '7100321', NULL, 11325, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07100000/00000/0000/7100321-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Back on the market, big price reduction!  Sunny, level, cleared lot with trees at the front and rear, in established neighborhood.  All city utilities available; golfing, tennis, parks & beach are all conveniently nearby.  Build a stick-built home, or place a manufactured home on this cul-de-sac.', 'WECOMA', '767', 767, NULL, '97439', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(106, NULL, NULL, NULL, 'RE/MAX Cornerstone', '541-289-5454', 'Boardman', '2019-06-20', 125000, NULL, NULL, 'US', 125000, 'WILSON', NULL, NULL, '45.83236', '200000', '-119.68844', '7101832', NULL, 871200, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07100000/00000/1000/7101832-1-a.jpg', 'Land', 'SingleFamilyResidence', 'THE PROPERTY IS RELATIVITY FLAT. INSIDE CITY LIMIT WITH CITY SERVICES AVAILABLE. WITH THE COMMUNITY GROWTH POTENTIAL THIS IS A GOLDEN OPPORTUNITY FOR INVESTMENT', 'OFF OLSEN', '0', 0, NULL, '97818', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(107, 4, 4, 2389.00, 'Friends & Neighbors Rlty Group', '541-743-0760', 'CottageGrove', '2016-11-29', 250000, NULL, NULL, 'US', 250000, 'Hwy 99 to Woodson, left on River Rd., Right on Holly', 3.00, 'Attached', '43.804523', '249000', '-123.064703', '7102821', NULL, 10454, 782, 3.00, 'https://www.rmlsweb.com/webphotos/07100000/00000/2000/7102821-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'Price Reduced from $299,999!  Golf course, trees and mountain views! Custom home on Hidden Valley Golf Course. Spacious floor plan, with large family room & home theater room. Large gourmet kitchen with beautiful cabinetry, granite counter tops with backsplash and island. Three decks, stamped concrete patio & 3 car garage.  Must see to believe! PRICED TO SELL, AS IS-NO ALLOWANCES.', 'HOLLY', '670', 670, 2003, '97424', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(108, 2, 2, 1666.00, 'Hoyt Realty Group', '503-227-2000', 'Portland', '2012-08-17', 589000, NULL, NULL, 'US', 589000, 'Sales office on the corner of NW 10th and Northrup', 2.00, 'Tandem', '45.53052', '549000', '-122.681531', '7103739', NULL, 0, 833, 2.00, 'https://www.rmlsweb.com/webphotos/07100000/00000/3000/7103739-1-a.jpg', 'Residential', 'Condominium', 'Metropolitan town home, ground level entrance on NW 10th Ave.  833 sq. Ft. \"flex space\" zoned for a non retail by appointment business. The second floor offers a comfortable 1 bedroom condo, featuring a fireplace, well appointed kitchen.  this condo offers 2 parking spaces.  The Met offers 24 hr. concierge, guest suites, fitness facility, wine storage and conference room.', 'Lovejoy 103', '1001', 1001, 2007, '97209', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(109, 3, 4, 2019.00, 'Keller Williams Realty Profes.', '503-546-9955', 'Beaverton', '2012-10-31', 269900, NULL, NULL, 'US', 269900, 'Fieldstone', 2.00, 'Attached', '45.529975', '279000', '-122.864308', '7104267', NULL, 7840, 1344, 2.00, 'https://www.rmlsweb.com/webphotos/07100000/00000/4000/7104267-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'Great Price on this Four Bedroom - Three Bath Home. Hardwood entry, throughout kitchen and nook area. Excellent location on culdesac, minutes to Streets of Tanasbourne, Restaurants and other Shops.', 'DERRINGTON', '1450', 1450, 1976, '97006', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(110, 2, 4, 1480.00, 'Hoff\'s Frontier Real Estate', '541-839-4232', 'Glendale', '2013-02-15', 42500, NULL, NULL, 'US', 42500, 'I-5, Exit 80 to Glendale, L on Molly past grocery store to property on L', 1.00, 'Detached', '42.734736', '49900', '-123.423355', '7106002', NULL, 87555, 816, 1.00, 'https://www.rmlsweb.com/webphotos/07100000/00000/6000/7106002-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'Rare Find!! This 2 acre parcel is zoned commercial and affords many opportunities for building  such as duplex, or a business. Currently there is a historic home on property that is in need of a lot of work or tear down and build. This property is in  town but has a country feel with creek at back of property.   Schools and shopping within one block.  Sold \"AS IS\".', 'Molly', '216', 216, 1905, '97442', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(111, NULL, NULL, NULL, 'Berkshire Hathaway HomeServices Real Estate Profes', '541-673-1890', 'Roseburg', '2015-07-31', 60000, NULL, NULL, 'US', 60000, 'I5 Exit 119, Left at 2nd light, Right on Brittney to Highlands, to top', NULL, NULL, '43.13461', '72000', '-123.384025', '7108598', NULL, 8276, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07100000/00000/8000/7108598-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Excellent view lot in an adult (55+) community.  Clubhouse with pool, exercise area, sauna, meeting rooms, kitchen, TV area and more.  Gated entry, nature trails, manufactured homes or stick built allowed.  CC&R\'s for your protection.', 'Erin', '132', 132, NULL, '97470', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(112, 3, 4, 2146.00, 'ZipRealty, Inc.', '503-828-1325', 'Gresham', '2013-09-10', 270000, NULL, NULL, 'US', 270000, 'division to  Birdsdale  (202nd Ave) and S to 16th Avenue to Bella Vista', 2.00, 'Attached', '45.509905', '275000', '-122.450888', '7108728', NULL, 8712, 1022, 2.00, 'https://www.rmlsweb.com/webphotos/07100000/00000/8000/7108728-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'Good floor pan 4BR and 2 and half Bath. Excelllent conditin and nice backyard.  Fruit tree.', 'Bella Vista', '1767', 1767, 1995, '97030', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(113, 1, 2, 871.00, 'Wasco Realty', '541-993-4111', 'Maupin', '2012-08-02', 99000, NULL, NULL, 'US', 99000, 'Hwy 197 to maupin', 1.00, NULL, '45.174604', '99000', '-121.082814', '7110026', NULL, 5227, 871, 1.00, 'https://www.rmlsweb.com/webphotos/07100000/10000/0000/7110026-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'Get Ready for Winter with SUMMER SUNSHINE 300 DAYS/YEAR!!! Retreat to the PEACE&QUIET of the Lower Deschutes River. Sweet 2bd/1bth Bungalow in Heart of Maupin, 1 mi.to river. Lots of New Touches. Covered Patio & Garage has room for boat. New Street & Sidewalk (not shown) 120 miles East of Portland 55 miles East of Mt. Hood & Columbia Gorge. Exceptional recreation & fishing.', 'DESCHUTES', '610', 610, 1943, '97037', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(114, NULL, NULL, NULL, 'Oregon Coast Realty', '541-469-7755', 'Brookings', '2012-01-11', 17000, NULL, NULL, 'US', 17000, 'Eggers road to Dotson. N on Dotson the second lot from end on right hand', NULL, NULL, '42.132246', '25000', '-124.342291', '7110833', NULL, 97138, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07100000/10000/0000/7110833-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Property runs to center of Pop Eggers creek to the north side. A septic system has been designed by Wert Engineering in Bandon. Those docs available in listing office. Great country lot, quiet and away from traffic. Best use Yurt. Seller is a licensed Real Estate Broker.OWNER WILL CARRY.', 'Dotson', NULL, NULL, NULL, '97415', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(115, NULL, NULL, NULL, 'Windermere/North Point, Inc.', '541-269-1601', 'CoosBay', '2014-08-21', 21000, NULL, NULL, 'US', 21000, 'Flanagan to sign', NULL, NULL, '43.350736', '29000', '-124.207331', '7113901', '90 x 250', 23086, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07100000/10000/3000/7113901-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Large 90 x 250 lot in Coos Bay with beautiful view of the city. Seller states that water and sewer is available. Buyer\'s agent to verify. Seller will carry with down.', 'Flanagan', NULL, NULL, NULL, '97420', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(116, NULL, NULL, 15000.00, 'Century 21 Best Realty, Inc.', '541-267-2221', 'CoosBay', '2017-08-10', 900000, NULL, NULL, 'US', 900000, 'Cozy kitchen, auto shops and offices between 101 south and north in CB', NULL, NULL, '43.370789', '999999', '-124.212351', '7114251', NULL, 42253, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07100000/10000/4000/7114251-1-a.jpg', 'CommercialSale', 'Commercial', 'Great investment opportunity.  A great piece of property bordered by highway 101 north and south.  Currently on property 4 buildings currently rented m/to/m  to a busy restaurant, an auto shop and two office buildings with tenants.  Great parking, great exposure and right on the highway.  Next to a Best Western hotel, gas stations and downtown.', 'hwy 101', '562', 562, 1951, '97420', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(117, NULL, NULL, NULL, 'Keller Williams Realty Portland Premiere', '503-597-2444', 'McMinnville', '2013-06-14', 59900, NULL, NULL, 'US', 59900, '99W to W 2nd St,Lt on Hill,Rt on Redmond Hill,Rt on Mazama,Rt on MtBaker', NULL, NULL, '45.208521', '59900', '-123.238619', '7115637', '7500 sq. ft.', 7405, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07100000/10000/5000/7115637-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Buildable lot in area of new homes, view of West Hills.', 'Mt. Baker', '2654', 2654, NULL, '97128', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(118, NULL, NULL, NULL, 'Keller Williams Realty Portland Premiere', '503-597-2444', 'McMinnville', '2013-06-14', 59900, NULL, NULL, 'US', 59900, '99W to W 2nd St,Lt on Hill,Rt on Redmond Hill,Rt on Mazama,Rt on MtBaker', NULL, NULL, '45.20852', '59900', '-123.238326', '7115668', '7500 sq. ft.', 7405, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07100000/10000/5000/7115668-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Buildable lot in area of new homes.', 'Mt. Baker', '2638', 2638, NULL, '97128', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(119, NULL, NULL, NULL, 'Nelson Real Estate Inc.', '541-523-6485', 'NorthPowder', '2012-07-05', 6300, NULL, NULL, 'US', 6300, 'North Powder', NULL, NULL, '45.029675', '7500', '-117.915713', '7116048', '100 x 150', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07100000/10000/6000/7116048-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Water and sewer quote:  $1,500 to City of North Powder.  Buyer responsibility to dig lines to the house and install lines.  Purchase both lots (C & 1st and B & 1st) for $15,000.', 'C and First', '0', 0, NULL, '97867', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(120, NULL, NULL, NULL, 'Nelson Real Estate Inc.', '541-523-6485', 'NorthPowder', '2012-07-05', 8700, NULL, NULL, 'US', 8700, 'North Powder', NULL, NULL, '45.029899', '9900', '-117.915309', '7116050', '150 X 150', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07100000/10000/6000/7116050-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Water and sewer quote:  $1,500 to City of North Powder.  Buyer responsibility to dig lines to the house and install lines.  Buy both lots (C & 1st and B & 1st) for $15,000.', 'B and First', '0', 0, NULL, '97814', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(121, NULL, NULL, NULL, 'RE/MAX Integrity', '541-345-8100', 'Creswell', '2016-10-18', 52000, NULL, NULL, 'US', 52000, 'Camas Swale Road next to 32929 Camas Swale, Across from Florance Road', NULL, NULL, '43.92493', '60000', '-123.05122', '7116774', NULL, 1089000, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07100000/10000/6000/7116774-1-a.jpg', 'Land', 'FarmForest', 'Remarkable property with conservation easement on approximately 19 acres in the heart of the Camas Swale.  Property is not buildable.', 'Camas Swale', NULL, NULL, NULL, '97426', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(122, 2, 2, 1540.00, 'TR Hunter Real Estate', '541-997-1200', 'Florence', '2013-06-17', 124000, NULL, NULL, 'US', 124000, 'FLORENTINE ENTRANCE OFF MUNSEL LAKE RD TO FLORENTINE AVENUE', 2.00, 'Carport', '44.005252', '128900', '-124.092319', '7117200', '90 x 110', 6969, 1540, 2.00, 'https://www.rmlsweb.com/webphotos/07100000/10000/7000/7117200-1-a.jpg', 'Residential', 'ManufacturedHomeonRealProperty', 'SILVERCREST CHARMER, 2 BEDROOMS PLUS DEN, 2 BATHS.  OPEN LIVING/DINING AREA w/VAULTED CEILINGS.  BREAKFAST NOOK & KITCHEN FACES EAST FOR MORNING LIGHT.  NEW APPLIANCES IN 2003, WALK-IN PANTRY, LOTS OF COUNTER & CABINET SPACE.  18 x 26 GARAGE PLUS ADDITIONAL CARPORT.  BEAUTIFULLY LANDSCAPED FRONT YARD & FENCED BACKYARD.  ACROSS FROM CLUBHOUSE.', 'FLORENTINE', '181', 181, 1990, '97439', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(123, NULL, NULL, NULL, 'Windermere CRG The Dalles', '541-298-4451', 'TheDalles', '2021-02-25', 10000, NULL, NULL, 'US', 10000, 'Dry Hollow to Est 18th', NULL, NULL, '45.589696', '20000', '-121.168945', '7117727', NULL, 7405, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07100000/10000/7000/7117727-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Private buildable lot in nice neighborhood.  Paved road with all utilities at road.  Bordered by city land on 2 sides of property.  Close to schools, and hospital.  Owner is related to listing agent.', '18th', NULL, NULL, NULL, '97058', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(124, NULL, NULL, NULL, 'Town & Country, REALTORS, Inc', '541-782-5775', 'Oakridge', '2013-09-20', 34900, NULL, NULL, 'US', 34900, 'Oakridge,L at light, R on 1st, L on Oak, L on High Leah, R on Meadow Way', NULL, NULL, '43.751264', '45000', '-122.455103', '7117873', NULL, 10890, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07100000/10000/7000/7117873-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Motivated Sellers! Lovely city lot in nice neighborhood just waiting for your new custom built home or manufactured.  All city services are in- water, sewer, power.  There is even a 24\' X 18\' garage/shop on the property.  Won\'t last at this price.', 'MEADOW', '76566', 76566, NULL, '97463', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(125, 1, 0, 1283.00, 'Non Rmls Broker', '503-236-7657', 'Portland', '2012-03-23', 425000, NULL, NULL, 'US', 425000, 'Sales Office on the corner of NW 10th and Lovejoy', 1.00, 'Attached', '45.530556', '449500', '-122.682131', '7118527', NULL, 0, 1283, 1.00, 'https://www.rmlsweb.com/webphotos/07100000/10000/8000/7118527-1-a.jpg', 'Residential', 'Condominium', 'Dual zoned live/work space offers a \"Business Occupancy\" rating which means units have been designed to meet ADA and other code requirements for business use, however this does not prevent the loft from being utilized strictly as a residence.', 'Lovejoy s370', '1001', 1001, 2007, '97209', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(126, NULL, NULL, 1000.00, 'Oregon First', '503-543-5221', 'StHelens', '2013-04-23', 320000, NULL, NULL, 'US', 320000, 'Hwy 30 to 275 S. Col Riv Hwy, next block from Walgreens', NULL, NULL, '45.8573', '396000', '-122.823329', '7118691', NULL, 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07100000/10000/8000/7118691-1-a.jpg', 'CommercialSale', 'Commercial', 'COMMERCIAL PROPERTY, Excellent Hwy 30 exposure by new Walgreens, Property has small M. H. 0ffice and Garage/Shop.   Commercial zoning with manyuses (check with City of St. Helens)  All Utilities available.  Sellers are Brokers.Presently rented, call for appointment.', 'columbia River', '275', 275, 1990, '97051', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(127, NULL, NULL, 1362.00, 'Berkshire Hathaway HomeServices NW Real Estate', '541-997-6000', 'Florence', '2015-11-04', 90000, NULL, NULL, 'US', 90000, 'HWY 101 TO 9TH STREET TURN LEFT TO CORNER OF 9TH AND HWY 101', NULL, NULL, '43.974939', '270000', '-124.105989', '7119563', '120 X 120', 15681, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07100000/10000/9000/7119563-1-a.jpg', 'CommercialSale', 'Commercial', 'INVESTOR SPECIAL - LARGE CORNER LOT - COMMERCIAL RESIDENTIAL ZONING.  GREAT INVESTMENT PROPERTY. HOME/GARAGE ARE VACANT.  STORAGE BUILDING RENTED FOR $395.  SELLER WILL CONSIDER ALL OFFERS.', 'MAPLE', '920', 920, 1940, '97439', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(128, NULL, NULL, NULL, 'Coldwell Banker Whitney & Asso', '541-276-0021', 'PilotRock', '2015-06-15', 16000, NULL, NULL, 'US', 16000, 'Second left as you leave Pilot Rock out Stewart Creek Road.', NULL, NULL, '45.488069', '25000', '-118.822132', '7606059', '100x100', 10018, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07600000/00000/6000/7606059-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Only two lots left!  Place your perfect home in the country just outside Pilot Rock.  Adjoining lot available if you want to build a huge shop!', 'Hawthorne', NULL, NULL, NULL, '97886', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(129, NULL, NULL, 4552.00, 'Coldwell Banker Whitney & Asso', '541-276-0021', 'Pendleton', '2012-02-24', 145000, NULL, NULL, 'US', 145000, 'A Avenue/Airport', NULL, NULL, '45.687864', '149900', '-118.841631', '7607098', '.37 acre', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07600000/00000/7000/7607098-1-a.jpg', 'CommercialSale', 'Industrial', 'For sale or lease. Office $1/sq.ft./mo, warehouse $.45/sq.ft./mo. Leased land from the city, subject to city approval. Very nice quality-very functional. (1) 8X14, (2) 20x14 overhead doors. Loading dock-fenced- secure. Floor heat in warehouse.', '46TH', '1816', 1816, 2001, '97801', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(130, NULL, NULL, NULL, 'American West Properties', '541-481-2888', 'Boardman', '2017-05-22', 75000, NULL, NULL, 'US', 75000, 'Take Wilson toEastregaard Right side, past OstvestOstvest', NULL, NULL, '45.82221', '75000', '-119.663234', '7714522', 'Irregular', 131986, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07700000/10000/4000/7714522-1-a.jpg', 'Land', 'SingleFamilyResidence', 'BEST VIEW LOT IN BOARDMAN! BEST CCR\'S, Property can not be subdivided. Electric is all the way across the property east to west to hook up to irrigation. The seller is a licensed real estate agent in the state of Oregon.', 'Eastregaard', NULL, NULL, NULL, '97818', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(131, NULL, NULL, NULL, 'Mountain Valley Land Company', '541-481-6251', 'Boardman', '2013-03-13', 12500, NULL, NULL, 'US', 12500, 'West on Wilson turn right Mt. Hood Ave. on leftWilson Rd', NULL, NULL, '45.828452', '19900', '-119.717909', '7715486', 'irregular', 7840, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07700000/10000/5000/7715486-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Level lot, ready for that new home.  MFH are welcome, per City of Boardman regulations.  Located in established neighborhood.  Seller open to trades.', 'Mt Hood', NULL, NULL, NULL, '97818', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(132, NULL, NULL, NULL, 'Miller Realty, Inc.', '541-667-2000', 'Stanfield', '2013-06-07', 18000, NULL, NULL, 'US', 18000, 'Off of HardingHarding Ave.', NULL, NULL, '45.979946', '22000', '-118.380757', '7717828', '.37 A.', 16117, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07700000/10000/7000/7717828-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Parcel #2 is .37 of an acre. City to put in street. Seller restricts to stick built house with double car garage. Check with city of Stanfield for water, sewer & road. Property is zoned R-UH. Lot is marked with asterisk on map. Partion is not yet completed', 'Howard', NULL, NULL, NULL, '97838', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(133, NULL, NULL, NULL, 'Century 21 Realty Specialist', '541-567-2121', 'Umatilla', '2013-05-07', 99950, NULL, NULL, 'US', 99950, 'On  Hwy 395 & Hwy 730 just one property west of the Light', NULL, NULL, '45.91502', '99950', '-119.284073', '7718100', '.96 of an acre', 41817, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07700000/10000/8000/7718100-1-a.jpg', 'Land', 'Industrial', 'Building is not represented and neither is the well or septic. In city limits, water/sewer services available. LAND IS $3.67 per square foot.  Located on Hwy 730, Hwy 395 and less than a mile and visible from I-84.  COMMERCIAL ACRE', 'Hwy 730', '30310', 30310, NULL, '97882', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(134, NULL, NULL, NULL, 'American West Prop. Hermiston', '541-564-0888', 'Irrigon', '2014-07-15', 17000, NULL, NULL, 'US', 17000, 'TAKE S MAIN WEST TO NW JEWELL DR, LEFT JEWELL CTColumbia Lane', NULL, NULL, '45.896383', '19500', '-119.506693', '7718143', 'IRREGULAR', 18295, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07700000/10000/8000/7718143-1-a.jpg', 'Land', 'SingleFamilyResidence', 'RHONDA SUBDIVISION IN IRRIGON. 8 GREAT LOTS TO CHOOSE FROM!', 'Jewell', NULL, NULL, NULL, '97844', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(135, NULL, NULL, NULL, 'American West Prop. Hermiston', '541-564-0888', 'Irrigon', '2014-08-12', 8000, NULL, NULL, 'US', 8000, 'TAKE S MAIN WEST TO NW JEWELL DR, LEFT JEWELL CTColumbia Lane', NULL, NULL, '45.896615', '17500', '-119.506895', '7718144', 'IRREGULAR', 10018, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07700000/10000/8000/7718144-1-a.jpg', 'Land', 'SingleFamilyResidence', 'RHONDA SUBDIVISION IN IRRIGON. ONE OF 8 GREAT LOTS TO CHOOSE FROM!', 'Jewell', NULL, NULL, NULL, '97844', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(136, NULL, NULL, NULL, 'Miller Realty, Inc.', '541-667-2000', 'Irrigon', '2017-05-18', 10000, NULL, NULL, 'US', 10000, 'TAKE S MAIN WEST TO NW JEWELL DR, LEFT JEWELL CTColumbia Lane', NULL, NULL, '45.896552', '17500', '-119.507486', '7718145', 'IRREGULAR', 9583, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07700000/10000/8000/7718145-1-a.jpg', 'Land', 'SingleFamilyResidence', 'RHONDA SUBDIVISION IN IRRIGON. ONE OF 8 GREAT LOTS TO CHOOSE FROM!', 'Jewell', NULL, NULL, NULL, '97844', '2023-05-12 11:36:56', '2023-05-12 11:36:56');
INSERT INTO `resoapi_properties` (`id`, `BathroomsTotalInteger`, `BedroomsTotal`, `BuildingAreaTotal`, `BuyerOfficeName`, `BuyerOfficePhone`, `City`, `CloseDate`, `ClosePrice`, `CondominiumElevatorYN`, `CondominiumGarageType`, `Country`, `CurrentPriceForStatus`, `Directions`, `GarageSpaces`, `GarageType`, `Latitude`, `ListPrice`, `Longitude`, `ListingId`, `LotSizeDimensions`, `LotSizeSquareFeet`, `MainLevelAreaTotal`, `ParkingTotal`, `Photo1URL`, `PropertyType`, `PropertySubType`, `PublicRemarks`, `StreetName`, `StreetNumber`, `StreetNumberNumeric`, `YearBuilt`, `PostalCode`, `created_at`, `updated_at`) VALUES
(137, NULL, NULL, NULL, 'Miller Realty, Inc.', '541-667-2000', 'Irrigon', '2017-05-18', 10000, NULL, NULL, 'US', 10000, 'TAKE S MAIN WEST TO NW JEWELL DR, LEFT JEWELL CTColumbia Lane', NULL, NULL, '45.896428', '17500', '-119.507835', '7718146', 'IRREGULAR', 9147, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07700000/10000/8000/7718146-1-a.jpg', 'Land', 'SingleFamilyResidence', 'RHONDA SUBDIVISION IN IRRIGON. ONE OF 8 GREAT LOTS TO CHOOSE FROM!', 'Jewell', NULL, NULL, NULL, '97844', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(138, NULL, NULL, NULL, 'American West Properties', '541-481-2888', 'Irrigon', '2013-05-24', 11000, NULL, NULL, 'US', 11000, 'TAKE S MAIN WEST TO NW JEWELL DR, LEFT JEWELL CTColumbia Lane', NULL, NULL, '45.073495', '18500', '-119.512406', '7718147', 'IRREGULAR', 11761, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07700000/10000/8000/7718147-1-a.jpg', 'Land', 'SingleFamilyResidence', 'RHONDA SUBDIVISION IN IRRIGON. ONE OF 8 GREAT LOTS TO CHOOSE FROM!', 'Jewell', NULL, NULL, NULL, '97844', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(139, NULL, NULL, NULL, 'American West Properties', '541-481-2888', 'Irrigon', '2014-07-23', 10000, NULL, NULL, 'US', 10000, 'TAKE S MAIN WEST TO NW JEWELL DR, LEFT JEWELL CTColumbia Lane', NULL, NULL, '45.896074', '18500', '-119.508066', '7718148', 'IRREGULAR', 9147, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07700000/10000/8000/7718148-1-a.jpg', 'Land', 'SingleFamilyResidence', 'RHONDA SUBDIVISION IN IRRIGON. ONE OF 8 GREAT LOTS TO CHOOSE FROM! THIS LOT HAS A WELL.', 'Jewell', NULL, NULL, NULL, '97844', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(140, NULL, NULL, NULL, 'Hermiston Realty', '541-567-2121', 'Irrigon', '2018-03-02', 15000, NULL, NULL, 'US', 15000, 'TAKE S MAIN WEST TO NW JEWELL DR, LEFT JEWELL CTColumbia Lane', NULL, NULL, '45.896176', '18500', '-119.508306', '7718149', 'IRREGULAR', 11761, NULL, NULL, 'https://www.rmlsweb.com/webphotos/07700000/10000/8000/7718149-1-a.jpg', 'Land', 'SingleFamilyResidence', 'RHONDA SUBDIVISION IN IRRIGON. ONE OF 8 GREAT LOTS TO CHOOSE FROM!', 'Jewell', NULL, NULL, NULL, '97844', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(141, NULL, NULL, NULL, 'Ranch-N-Home Realty, Inc', '541-963-5450', 'Union', '2013-02-08', 15000, NULL, NULL, 'US', 15000, 'End of Fulton just before the Golf Course', NULL, NULL, '45.204795', '15000', '-117.857583', '7803632', NULL, 71002, NULL, NULL, NULL, 'Land', 'SingleFamilyResidence', 'Lot 9 ( 1.83 AC)  Buffalo Peak Subdivision.  lots above  & near Union.  Golf course, stick built homes only. Protective covenants & restrictions', 'Fulton', NULL, NULL, NULL, '97883', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(142, NULL, NULL, NULL, 'Berkshire Hathaway HomeServices NW Real Estate', '541-997-6000', 'Florence', '2014-02-21', 39500, NULL, NULL, 'US', 39500, 'N. on Rhodo Dr., Rt. on Saltaire, Lot on Rt.', NULL, NULL, '44.016064', '42500', '-124.121211', '8000159', NULL, 16988, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/00000/0000/8000159-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Build the home of your dreams with the builder of your choice in this quiet neighborhood. CC&Rs, Utilities at lot line, septic approved. Inside City of Florence urban growth boundary.', '206 SALTAIRE', NULL, NULL, NULL, '97439', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(143, NULL, NULL, NULL, 'Coldwell Banker Coast Real Est', '541-997-7777', 'Florence', '2014-01-24', 39500, NULL, NULL, 'US', 39500, 'N. on Rhodo Dr, Rt on Saltaire, lot is 2nd on Rt.', NULL, NULL, '44.016309', '42500', '-124.122043', '8000162', NULL, 13939, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/00000/0000/8000162-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Build the home of your dreams with the builder of your choice in this quiet neighborhood. CC&Rs, Utilities at lot line, septic approved. Inside City of Florence urban growth boundary.', '203 SALTAIRE', NULL, NULL, NULL, '97439', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(144, 1, 2, 780.00, 'TR Hunter Real Estate', '541-997-1200', 'Florence', '2012-04-17', 182500, NULL, NULL, 'US', 182500, '7 miles up NF Siuslaw Rd., Home is on the left.', 0.00, NULL, '44.040758', '215000', '-124.020302', '8000414', NULL, 363726, 780, 0.00, 'https://www.rmlsweb.com/webphotos/08000000/00000/0000/8000414-1-a.jpg', 'Residential', 'SingleFamilyResidence', '8+ acres of peace & quiet on the North Fork of the Siuslaw River. 2 tax lots with 2 septic systems, one with a cabin. Southern exposure with a stream on the property, lots of privacy.', 'NORTH FORK SIUSLAW', '7575', 7575, 1945, '97439', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(145, NULL, NULL, NULL, 'Lighthouse Realty/Surfside', '360-665-4114', 'OceanPark', '2016-10-27', 21900, NULL, NULL, 'US', 21900, 'From 295th west on M Pl, N to 306, east to O Pl, N to property.', NULL, NULL, '46.528146', '22900', '-124.049152', '8002298', NULL, 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/00000/2000/8002298-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Rare Golf Front Lot! Whether an avid golfer looking or you just enjoy a quality lifestyle, this is your ultimate destination. Lg lot on 2nd green in well maintained community.Great place to build vacation home or permanent residence.Build to 35\'.Septic will need to be brought up to code. Water&electric at the street.Close to beach.Don\'t delay. This rare opportunity won\'t last!', 'O', '31208', 31208, NULL, '98640', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(146, 3, 3, 1871.00, 'Non Rmls Broker', '503-236-7657', 'Florence', '2013-11-19', 570000, NULL, NULL, 'US', 570000, 'Hwy 101 S 6.5 miles, L on Pacific Ave to Westlake, straight to boat ramp', 1.00, 'Attached', '43.864274', '574000', '-124.104587', '8007306', NULL, 266587, 1871, 1.00, 'https://www.rmlsweb.com/webphotos/08000000/00000/7000/8007306-1-a.jpg', 'Residential', 'SingleFamilyResidence', '\"Jewel of the Oregon Coast\"!  This dramatic custom Island Home & Guest House is placed on 6+ pristine acres on Booth Island.  A spectacular location, with approx. 1,000 Ft of Siltcoos Lake frontage. Natural tranquility for a unique lifestyle. Minutes to ocean, dunes, rivers & Florence. - PRICE REDUCED !! - Features PV electric power & passive solar design. Green & Solar!', '82150 Booth Island', NULL, NULL, 2003, '97439', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(147, 2, 3, 2236.00, 'Non Rmls Broker', '503-236-7657', 'Kelso', '2012-07-20', 320000, NULL, NULL, 'US', 320000, 'Old Pacific Hwy(Old99) to Mt. Pleasant, left and left thru gate.', 2.00, 'Attached', '46.068628', '335000', '-122.866506', '8007426', NULL, 51836, 2124, 2.00, 'https://www.rmlsweb.com/webphotos/08000000/00000/7000/8007426-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'Impeccable views of the Columbia River!Exceptional quality and craftsmanship throughout this stunning home. Luxurious granite, beautiful hardwoods, Hayes cabinetry, top of the line appliances & so much more. Owner will carry contract.', 'LASALLE', '266', 266, 2007, '98626', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(148, NULL, NULL, NULL, 'Don Nunamaker Realtors', '541-386-4400', 'HoodRiver', '2013-02-14', 95000, NULL, NULL, 'US', 95000, 'Belmont to Avalon DR., west on Lois', NULL, NULL, '45.563149', '99000', '-121.656846', '8007709', '70 x 75 +/-', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/00000/7000/8007709-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Get a great deal on any of these ready to build lots. Must drive through the neighborhood to really appreciate the location.', 'Kendal Lane(lot 14)', NULL, NULL, NULL, '97031', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(149, NULL, NULL, NULL, 'Don Nunamaker Realtors', '541-386-4400', 'HoodRiver', '2012-05-17', 95000, NULL, NULL, 'US', 95000, 'Belmont to Avalon DR., west on Lois', NULL, NULL, '45.563149', '99000', '-121.656846', '8007711', '70 x 75 +/-', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/00000/7000/8007711-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Get a great deal on any of these ready to build lots. Must drive through the neighborhood to really appreciate the location.', 'Kendal Lane (lot 15)', NULL, NULL, NULL, '97031', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(150, 2, 3, 1630.00, 'John L. Scott', '503-645-7433', 'Aloha', '2012-08-10', 285000, NULL, NULL, 'US', 285000, 'TV Hwy, N on 198th to Rock. Trn right to 197th N. to Stacey', 2.00, 'Attached', '45.510371', '330000', '-122.878172', '8009587', '200x225', 40075, 1630, 2.00, 'https://www.rmlsweb.com/webphotos/08000000/00000/9000/8009587-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'Bring your developers. Enjoy this nearly 1 acre parcel for future investment.Call occupant first. Will sell home separate from land.', 'STACEY', '19555', 19555, 1970, '97006', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(151, NULL, NULL, NULL, 'John L. Scott', '503-645-7433', 'Aloha', '2012-08-10', 285000, NULL, NULL, 'US', 285000, 'TV Hwy, N on 198th to ROck. Trn right to 197th to Stacey', NULL, NULL, '45.510371', '330000', '-122.878172', '8011250', '200x225', 40075, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/10000/1000/8011250-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Nearly 1 level acre of developable land that includes a 1630s\' ranch home. Call occupant, large dog. Will separate house & lot from remaining land.', 'STACEY', '19555', 19555, NULL, '97006', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(152, 3, 4, 3417.00, 'Pacific Coastal Real Estate', '541-247-7925', 'GoldBeach', '2014-09-15', 365000, NULL, NULL, 'US', 365000, 'NESKIA LP RD/TURN WEST ON \"B\"ST @ END', 3.00, 'Attached', '42.49988', '359000', '-124.418427', '8012745', NULL, 52707, 1403, 3.00, 'https://www.rmlsweb.com/webphotos/08000000/10000/2000/8012745-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'NEWER OCEAN FRONT HOME/3 CAR ATTACHED GARAGE/PLUS A 49X37 SHOP THAT HAS A BATHROOM. SEMI PRIVATE. LISTEN TO THE SOUND OF THE THE WILD SEA DURING WINTER STORMS AND ENJOY LOOKING AT THE EVER CHANGING PACIFIC OCEAN.GEOLOGICAL REPORT AVAILABLE.', 'B', '94423', 94423, 2002, '97444', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(153, 1, 3, 1150.00, 'Century 21 Seaquist R.E.', '541-938-3331', 'MiltonFreewater', '2012-10-22', 99500, NULL, NULL, 'US', 99500, 'College & 13th', 1.00, 'Carport', '45.92298', '99500', '-118.383346', '8014583', '70\' X 100\'', 9147, 1150, 1.00, 'https://www.rmlsweb.com/webphotos/08000000/10000/4000/8014583-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'New carpeting and new interior paint make this home ready to move into.  A view of the mountains can be enjoyed from the living room.  The back yard is fenced and is semi private.  This home has a very spacious comfortable feel.', 'COLLEGE', '1306', 1306, 1957, '97862', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(154, 1, 1, 700.00, 'Non Rmls Broker', '503-236-7657', 'LincolnCity', '2013-01-24', 145000, NULL, NULL, 'US', 145000, 'Hwy 101 to NW 15th to NW Harbor, corner lot', 0.00, NULL, '44.976006', '175000', '-124.015231', '8014603', NULL, 4791, 516, 0.00, 'https://www.rmlsweb.com/webphotos/08000000/10000/4000/8014603-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'Ocean view home in NW Lincoln City across the street from beach access! This newly remodeled cottage is in the new Ocean Lake Planned District I-M Zone where vacation rentals are an outright use! Property is subject to short sale and 3rd party approval', 'Harbor', '1534', 1534, 1930, '97367', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(155, NULL, NULL, NULL, 'RE/MAX Equity Group', '360-882-6000', 'BattleGround', '2012-06-15', 141500, NULL, NULL, 'US', 141500, 'N on NE 117 Ave, R  244 St, L 132 Ave, R  249 St, L on 134 Ave', NULL, NULL, '45.81168', '149900', '-122.534694', '8017117', NULL, 77536, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/10000/7000/8017117-1-a.jpg', 'Land', 'SingleFamilyResidence', '$600K - 1 Million dollar plus homes leading to amazingly secluded gated acreage. Lots are Greenbelted by Lewisville Park (250+ Acres). Greenbelt includes a 26 acre open space tract and walking trails owned by the lot owners of Lewisville Park Estates. Lots feature picturesque views, level acreage with private quiet setting and no wetlands.', '134 Lot 1', '0', 0, NULL, '98604', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(156, 3, 3, 2476.00, 'Windermere RE Lane County', '541-484-2022', 'Eugene', '2012-05-31', 330000, NULL, NULL, 'US', 330000, 'S. on Fox Hollow, left on W. Amazon (across from Owl Road), to Pine Fore', 2.00, 'Attached', '43.994208', '326900', '-123.084426', '8017900', '60', 12632, 1366, 2.00, 'https://www.rmlsweb.com/webphotos/08000000/10000/7000/8017900-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'Beautiful home in private neighborhood of newer houses. Large, flat backyard-fully fenced. Excellent condition throughout, MBR suite w/large walk-in close, many extras. Great-room, large kitchen and dining room, FA gas/AC.  Excellent condition.', 'PINE FOREST', '830', 830, 1999, '97405', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(157, NULL, NULL, NULL, 'RE/MAX Equity Group', '503-635-2660', 'Sherwood', '2013-07-15', 239900, NULL, NULL, 'US', 239900, 'North on Hwy 99W, Rt on Middleton, Rt on Labrousse, Rt on Huckleberry Ct', NULL, NULL, '45.328138', '249900', '-122.864742', '8018319', NULL, 57063, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/10000/8000/8018319-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Gated culdesac lot with unobstructed views of vineyards, valley and Portland. Gentle slope will accommodate almost any home, includes community ownership of 215 ac. forest/wildlife preserve.', 'HUCKLEBERRY', '18226', 18226, NULL, '97140', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(158, NULL, NULL, NULL, 'Handris Realty Co.', '503-657-1094', 'Woodburn', '2014-01-21', 1320000, NULL, NULL, 'US', 1320000, 'East on Newberg Hwy, Right on Lawson, Rt on Stacey Allison to South end', NULL, NULL, '45.140564', '1320000', '-122.886225', '8018519', NULL, 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/10000/8000/8018519-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Paradise Pointe, a 33 lot subdivision available for sale, recorded and ready for construction of homes with minimum sq. ft. of 1200. CCR\'s and HOA.', 'Paradise', NULL, NULL, NULL, '97071', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(159, NULL, NULL, NULL, 'Ultimate Coastal Properties', '541-425-7494', 'GoldBeach', '2013-12-23', 250000, NULL, NULL, 'US', 250000, 'Approx. 6 mile N of GB. West on N. Chantrelle', NULL, NULL, '42.481638', '295000', '-124.422187', '8019574', NULL, 94960, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/10000/9000/8019574-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Diamond in the Rough. Highly sought after oceanfront ACREAGE with dramatic ocean views in exclusive Hubbard Mound. Gently sloped, usable acreage, forested w/ ferns, rhododendrons & old growth Sitka Spruce.  The high bank frontage faces publicly inaccessible beach & tide pools. Discreet location. Power, municipal water and telephone at line. Septic approval and geology report on file Was 775K, Now reduced to move fast at only 295K..Hurry', 'North Chantrelle', NULL, NULL, NULL, '97444', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(160, NULL, NULL, NULL, 'Neath The Wind Realty, Inc.', '541-332-9463', 'Langlois', '2017-07-19', 90000, NULL, NULL, 'US', 90000, 'South of Langlois go E on Cope Lane, R on Pacific View to sign.', NULL, NULL, '42.904684', '97000', '-124.448002', '8020168', NULL, 252648, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/20000/0000/8020168-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Gorgeous 5.8 acre Oceanview Parcel in \"Old Sheep Ranch\" Community 20 minutes south of Bandon. Especially nice protected homesite in enchanting fir & fern forest. Has community water paid for, septic approval, electric and phone on parcel, surveyed. Awaits your dream home!', 'Pacific View', NULL, NULL, NULL, '97450', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(161, NULL, NULL, NULL, 'Century 21 Agate Realty/Gold', '541-247-6612', 'GoldBeach', '2014-03-21', 58000, NULL, NULL, 'US', 58000, 'right over Hunter Creek Bridge onto Hunter Creek Road to sign on left', NULL, NULL, '42.370431', '79000', '-124.403511', '8021764', NULL, 26136, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/20000/1000/8021764-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Meander up Hunter Creek Road to this lovely.6-+ acre parcel zoned R2 for a stick built or manufactured home.  Located just minutes from town yet feels like you are out in the country. Hunter Creek just across the street, city water connection included,septic test site approval.Owner may carry with half down for qualified buyer!', 'HUNTER CREEK', '28097', 28097, NULL, '97444', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(162, NULL, NULL, NULL, 'Hearthstone Real Estate', '541-344-5958', 'Eugene', '2013-11-12', 125000, NULL, NULL, 'US', 125000, 'Amazon to Dillard Rd.', NULL, NULL, '43.968435', '149500', '-123.054354', '8022313', NULL, 418176, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/20000/2000/8022313-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Approx. 10 acres with views of the Cascades, also southern and nothern views, well in -septic and building approval driveway mostly in- only 2 miles from Eugene city limits, $10,000 credit to buyers for site prep  Owners are motivated!!!', 'Dillard', NULL, NULL, NULL, '97405', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(163, NULL, NULL, NULL, 'Berkshire Hathaway HomeServices NW Real Estate', '541-997-6000', 'Westlake', '2014-01-10', 49500, NULL, NULL, 'US', 49500, 'HWY 101 S, LEFT ON CLEAR LAKE TO BOY SCOUT, LOOK FOR SIGN ON LEFT', NULL, NULL, '43.896696', '54500', '-124.097279', '8024453', NULL, 45302, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/20000/4000/8024453-1-a.jpg', 'Land', 'SingleFamilyResidence', 'BEAUTIFUL SETTING & LOCATION FOR YOUR CUSTOM HOME. DEEDED ACCESS TO SILTCOOS LAKE, PROTECTIVE CC&Rs, FLAT. STANDARD SEPTIC APPROVAL. WOODED SETTING. GRAVEL DRIVEWAY WAS INSTALLED COVERED WITH OVERGROWTH. NO MANUFACTURED HOMES.', 'WALKABOUT COVE', NULL, NULL, NULL, '97493', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(164, NULL, NULL, NULL, 'Central Coast Realty', '541-271-5916', 'Reedsport', '2019-01-23', 44500, NULL, NULL, 'US', 44500, 'Hwy 101 N, left on 20th to Masters Way to Masters Lane', NULL, NULL, '43.699768', '59950', '-124.121532', '8024850', NULL, 7840, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/20000/4000/8024850-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Excellent building site in new CC&R protected subdivision adjacent to golf course.', 'Masters', '19', 19, NULL, '97467', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(165, NULL, NULL, NULL, 'Coldwell Banker Pro West', '541-773-6868', 'Brookings', '2013-04-30', 169000, NULL, NULL, 'US', 169000, 'Hwy 101 S, L on Pelican Bay Dr, Rt on Napa Ln, L side of road', NULL, NULL, '42.031849', '169000', '-124.233358', '8025070', 'IRR', 22215, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/20000/5000/8025070-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Design and build your dream home that takes advantage of the panoramic ocean views where you can see Pt George to the south all the way to the Port of Brookings-Harbor to the north.  Sand filter septic installed and water is connected. Power is available at the lot line. Site built home only.', 'Napa', NULL, NULL, NULL, '97415', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(166, 3, 4, 1868.00, 'Coldwell Banker Whitney & Asso', '541-276-0021', 'Pendleton', '2012-10-05', 179000, NULL, NULL, 'US', 179000, 'Take right at Les Schwab, right on Perkins av. left on Perkins Ct.', 2.00, 'Attached', '45.646573', '174000', '-118.822677', '8026669', NULL, 0, 1868, 2.00, 'https://www.rmlsweb.com/webphotos/08000000/20000/6000/8026669-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'Reduced to sell-Bring Offers-Very nicebrick ranch style home in one of Pendletons finest neighborhoods.Quiet Cul de sac -on oversized lot-large newer master bedroom-high ceilings, fireplace, deck-double garage-  Close to School and community park.Remodeled in 2002.', 'PERKINS', '4126', 4126, 1955, '97801', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(167, NULL, NULL, 0.00, 'American West Properties', '541-481-2888', 'Boardman', '2019-12-23', 265000, NULL, NULL, 'US', 265000, 'TURN RIGHT ON N FRONT', NULL, NULL, '45.839885', '395000', '-119.697402', '8027290', NULL, 294030, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/20000/7000/8027290-1-a.jpg', 'CommercialSale', 'Other', 'HUGE PRICE REDUCTION! PROPERTY CAN BE DIVIDED FOR A SMALLER ACREAGE TO BE PURCHASED. BEST FREEWAY VISIBILITY IN THE CITY. ACROSS THE STREET FROM THE HIGH SCHOOL. EXCELLENT COMMERCIAL OPPORTUNITIES. AGENT IS RELATED TO SELLERS.', 'FRONT', NULL, NULL, 1750, '97818', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(168, NULL, NULL, NULL, 'Windermere/Crest Realty Co', '360-834-3344', 'Washougal', '2015-02-27', 119000, NULL, NULL, 'US', 119000, 'HWY 14 East/Camas/Crown Rd to North Lookout Ridge', NULL, NULL, '45.597465', '119000', '-122.381566', '8028306', NULL, 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/20000/8000/8028306-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Come see things from our point of view! Build your dream home in this quality neighborhood of luxury homes. This exceptional development features view lots and low traffic counts. The developer has in place excellent CCR\'s to protect the home owners values,views & quality of life. Located 15 minutes form PDX Airport, close to freeways. Bring your own builder.Camas Schools.', '8TH', '3019', 3019, NULL, '98671', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(169, NULL, NULL, NULL, 'RE/MAX Equity Group', '360-882-6000', 'Washougal', '2014-10-29', 157000, NULL, NULL, 'US', 157000, 'HWY 14 TO CAMAS/CROWN RD TO NORTH LOOKOUT RIDGE', NULL, NULL, '45.595894', '169000', '-122.380814', '8028336', NULL, 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/20000/8000/8028336-1-a.jpg', 'Land', 'SingleFamilyResidence', 'COME SEE THINGS FROM OUR POINT OF VIEW! Build your dream home in this quality neighborhood of luxury homes. This exceptional development features view lots and low traffic counts. The developer has in place excellent CCR\"S to protect home owner values,views & quality of life. Located within 15 minutes of PDX Airport and freeways. You can bring your own builder,Camas Schools!', '8TH', '2809', 2809, NULL, '98671', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(170, NULL, NULL, NULL, 'RE/MAX Equity Group', '360-882-6000', 'Washougal', '2013-08-02', 165000, NULL, NULL, 'US', 165000, 'HWY 14 EAST TO CAMAS/CROWN RD TO NORTH LOOKOUT RIDGE', NULL, NULL, '45.595956', '199000', '-122.380265', '8028340', NULL, 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/20000/8000/8028340-1-a.jpg', 'Land', 'SingleFamilyResidence', 'VIEWS!“ SEE THINGS FROM OUR POINT OF VIEW!”Build your dream home in this quality neighborhood of luxury homes. This exceptional development features view lots and low traffic counts. The developer has in place excellent CCR’S, views & quality of life await. Located within 15 minutes of PDX Airport and freeways. You can bring your own builder,Camas Schools.', '8TH', '2822', 2822, NULL, '98671', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(171, NULL, NULL, NULL, 'Hearth & Home Realty', '360-721-1650', 'Washougal', '2013-06-14', 119000, NULL, NULL, 'US', 119000, 'HWY 14 EAST TO CAMAS TO CROWN RD TO NORTH LOOKOUT RIDGE', NULL, NULL, '45.596295', '119000', '-122.380261', '8028344', NULL, 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/20000/8000/8028344-1-a.jpg', 'Land', 'SingleFamilyResidence', '“ SEE THINGS FROM OUR POINT OF VIEW!” Build your dream home in this quality neighborhood of luxury homes. This exceptional development features view lots and low traffic counts. The developer has in place excellent CCR’S, views & quality of life. Located within 15 minutes of PDX Airport and freeways. You can bring your own builder,Camas Schools.', 'CHESTNUT', '780', 780, NULL, '98671', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(172, NULL, NULL, NULL, 'RE/MAX Equity Group', '360-882-6000', 'Washougal', '2012-07-27', 80000, NULL, NULL, 'US', 80000, 'HWY 14 EAST TO CAMAS TO CROWN RD TO NORTH LOOKOUT RIDGE', NULL, NULL, '45.596701', '185000', '-122.380452', '8028348', NULL, 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/20000/8000/8028348-1-a.jpg', 'Land', 'SingleFamilyResidence', '“ SEE THINGS FROM OUR POINT OF VIEW!” Build your dream home in this quality neighborhood of luxury homes. This exceptional development features view lots and low traffic counts. The developer has in place excellent CCR’S, views & quality of life. Located within 15 minutes of PDX Airport and freeways. You can bring your own builder,Camas Schools.', 'CHESTNUT', '789', 789, NULL, '98671', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(173, NULL, NULL, NULL, 'Stalder Realty Group', '360-362-0085', 'Washougal', '2015-01-12', 96000, NULL, NULL, 'US', 96000, 'HWY 14 EAST TO CAMAS TO CROWN RD TO NORHT LOOKOUT RIDGE', NULL, NULL, '45.596672', '99000', '-122.380995', '8028351', NULL, 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/20000/8000/8028351-1-a.jpg', 'Land', 'SingleFamilyResidence', 'COME SEE THINGS FROM OUR POINT OF VIEW!Build your dream home in this quality neighborhood of luxury homes. This exceptional development features view lots and low traffic counts. The developer has in place excellent CCR\'S, views & quality of life. Located within 15 minutes of PDX Airport and freeways. You can bring your own builder,Camas Schools.', '8TH', '2922', 2922, NULL, '98671', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(174, NULL, NULL, NULL, 'Stalder Realty Group Corporation', '360-362-0085', 'Washougal', '2015-04-06', 96000, NULL, NULL, 'US', 96000, 'HWY 14 EAST TO CAMAS TO CROWN RD TO NORTH LOOKOUT RIDGE', NULL, NULL, '45.597011', '99000', '-122.381023', '8028354', NULL, 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/20000/8000/8028354-1-a.jpg', 'Land', 'SingleFamilyResidence', 'COME SEE THINGS FROM OUR POINT OF VIEW! Build your dream home in this quality neighborhood of luxury homes. This exceptional development features view lots and low traffic counts. The developer has in place excellent CCR\'S, views & quality of life. Located within 15 minutes of PDX Airport and freeways. You can bring your own builder, Camas Schools.', '8TH', '2972', 2972, NULL, '98671', '2023-05-12 11:36:56', '2023-05-12 11:36:56'),
(175, NULL, NULL, NULL, 'Coldwell Banker Seal', '360-574-5060', 'Washougal', '2014-04-17', 79000, NULL, NULL, 'US', 79000, 'HWY 14 EAST TO CAMAS TO CROWN RD TO NORTH LOOKOUT RIDGE', NULL, NULL, '45.597191', '79000', '-122.380278', '8028360', NULL, 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/20000/8000/8028360-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Exceptional building lots and low traffic counts. The developer has in place excellent CCR\'S, views & quality of life. Located within 15 minutes of PDX Airport and freeways. You can bring your own builder, Camas Schools.', 'DOGWOOD', '716', 716, NULL, '98671', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(176, NULL, NULL, NULL, 'Equity Northwest Properties', '360-253-1212', 'Washougal', '2014-11-14', 91000, NULL, NULL, 'US', 91000, 'HWY 14 TO CAMAS TO CROWN RD TO NORTH LOOKOUT RIDGE', NULL, NULL, '45.597311', '95000', '-122.380997', '8028383', NULL, 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/20000/8000/8028383-1-a.jpg', 'Land', 'SingleFamilyResidence', 'COME SEE THINGS FROM OUR POINT OF VIEW! Build your dream home in this quality neighborhood of luxury homes. This exceptional development features view lots and low traffic counts. The developer has in place excellent CCR\'S, views & quality of life. Located within 15 minutes of PDX Airport and freeways. You can bring your own builder,Camas Schools.', 'DOGWOOD', '798', 798, NULL, '98671', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(177, NULL, NULL, NULL, 'Neath The Wind Realty, Inc.', '541-332-9463', 'PortOrford', '2014-03-27', 300000, NULL, NULL, 'US', 300000, 'north end of Port Orford, next to Madrona R.V.  Park', NULL, NULL, '42.755487', '299000', '-124.495888', '8028899', NULL, 179031, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/20000/8000/8028899-1-a.jpg', 'Land', 'MultiFamily', 'Large Commercially zoned parcel, in the city limits.  This property is level and wooded; suited for all kinds of projects.', 'Hwy 101', NULL, NULL, NULL, '97465', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(178, NULL, NULL, NULL, 'Pacific Rim Brokers, Inc', '509-493-1783', 'WhiteSalmon', '2012-12-03', 65000, NULL, NULL, 'US', 65000, 'SR 141 to NW Holli Ln., first lot on the left off of  Holli Ln.', NULL, NULL, '45.73761', '69000', '-121.511306', '8030211', NULL, 45302, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/30000/0000/8030211-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Wonderful view of Mt Hood from this level, easy to build on lot. In an area of nice homes. CC&R\'s to protect your investement.Water meters are available for this property if you\'re ready to build!! Possible owner terms.', 'SR 141', NULL, NULL, NULL, '98672', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(179, 1, 4, 1300.00, 'Gold Coast Properties, Inc.', '541-347-4533', 'PortOrford', '2012-03-30', 170000, NULL, NULL, 'US', 170000, 'call office for directions - 46968 Hwy. 101 - driveway s. of Denmark Ln.', 0.00, NULL, '42.888736', '210000', '-124.465467', '8031035', NULL, 1237104, 1300, 0.00, 'https://www.rmlsweb.com/webphotos/08000000/30000/1000/8031035-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'DRASTIC PRICE REDUCTION!! Fenced with pastureland, this older ranch home has great hill views and is tucked into the forest.  This is a true fixer on a gorgeous property.', 'Hwy 101', NULL, NULL, 1950, '97465', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(180, NULL, NULL, NULL, 'Berkshire Hathaway HomeServices NW Real Estate', '503-624-9660', 'Culver', '2014-09-19', 65000, NULL, NULL, 'US', 65000, 'Lakeview to Meadow to Prospect View', NULL, NULL, '44.541041', '69900', '-121.379162', '8033768', NULL, 211266, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/30000/3000/8033768-1-a.jpg', 'Land', 'SingleFamilyResidence', 'HUGE price reduction! Excellent 5 ac, campsite or build your dream cabin. Come play on Lake Billy Chinook from our private marina access on the Metolius River arm. Fish, ski, coast along on your boat & just enjoy. ATV & dirtbike riding, private gun range, no hunting on the property. True peace & quiet. Don\'t pass this this up.', 'Prospect View', '6521', 6521, NULL, '97734', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(181, NULL, NULL, NULL, 'Handris Realty Company', '360-695-9292', 'Camas', '2013-09-03', 190000, NULL, NULL, 'US', 190000, 'SR-14 to exit 12 left on 6th left on frontage rd right on Sierra', NULL, NULL, '45.584194', '249000', '-122.433675', '8034374', NULL, 11325, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/30000/4000/8034374-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Bring your Builder or Use ours. Homes selling in this subdivision for over 1,300.000.00.  The views are sectacular, Columbia River, Gorge, City Lights, Troutdale, Mt. Hood and more. easy commute to Portland and Airport.', 'Valley', NULL, NULL, NULL, '98607', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(182, 1, 2, 592.00, 'Windermere GTRE Bingen', '509-493-4666', 'Lyle', '2012-06-27', 90000, NULL, NULL, 'US', 90000, 'Hwy 14 to Lyle. L on 5th. R on Klickitat St. Second Property on R', 0.00, NULL, '45.693969', '95000', '-121.284191', '8035242', '75 x 100', 0, 592, 0.00, 'https://www.rmlsweb.com/webphotos/08000000/30000/5000/8035242-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'Charming cottage with an excellent location in Lyle.  Home has been well cared for and newer appliances are included.  This cute cottage is move-in ready with new windows, paint, and doors.  Partial river view and only minutes away from windsurfing at Doug\'s Beach or hiking on the Klickitat Rails-to-Trails.  An affordable home in the Gorge!', 'Klickitat', '314', 314, 1935, '98635', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(183, NULL, NULL, NULL, 'M Realty LLC.', '503-459-4474', 'Newberg', '2012-04-09', 600000, NULL, NULL, 'US', 600000, 'From Newberg west on Hwy 240, south on Williamson to Dudley Rd.', NULL, NULL, '45.309807', '649000', '-123.045727', '8035417', 'Irregular', 1089000, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/30000/5000/8035417-1-a.jpg', 'Land', 'FarmForest', 'Stunning homesite with spectacular views. 25 acres in the Dundee Hills. Jory soils & elevations of 300-400 Ft. Suitable for vineyards & great location for a winery aprox 22 acres plantable.Or bring your horses would make a great equestrian facility.Minutes from Newberg in upscale area.', 'Dudley', '0', 0, NULL, '97132', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(184, NULL, NULL, NULL, 'Ruben J. Menashe, Inc.', '503-255-9680', 'Gresham', '2015-07-03', 117500, NULL, NULL, 'US', 117500, 'From Powell: Highland Drive South, Right on Nancy, Left on Equestrian', NULL, NULL, '44.086247', '119750', '-120.70857', '8036389', '95 x 98', 9147, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/30000/6000/8036389-1-a.jpg', 'Land', 'SingleFamilyResidence', 'A rare chance for outright purchase of a lot in the desirable Hunter\'s Highland subdivision.  You can even bring your own Builder.  This lot backs up to Metro/Gresham owned open space, and is on a quiet dead-end street. Seller is Licensed Real Estate Agent in Oregon.', 'Equestrian', '4524', 4524, NULL, '97030', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(185, 1, 1, 752.00, 'Windermere Real Estate', '541-938-3155', 'MiltonFreewater', '2012-05-08', 123000, NULL, NULL, 'US', 123000, '25 minute drive east of Walla Walla on Mill Creek Road', 0.00, NULL, '45.985772', '143500', '-118.074379', '8036758', '100\'x1306\'', 130680, 376, 0.00, 'https://www.rmlsweb.com/webphotos/08000000/30000/6000/8036758-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'Mountain hideway in the Walla Walla Wine Region.  25 min. drive from Walla Walla.  This is an Oregon property with a Washington address.  Fresh spring water, electricity and telephone, all the comforts of home in the mountains.A diamond in the rough...........this home needs your TLC and remodel to be all it can be.  Stream access and mountain hiking all around.', 'CHINA CANYON', '84586', 84586, 1920, '97862', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(186, 3, 5, 3991.00, 'RE/MAX Equity Group', '360-256-5733', 'Washougal', '2012-07-03', 360000, NULL, NULL, 'US', 360000, 'HWY 14 ,exit 12, R/ Adams ,L / 3rd,L /Crown R /lookout Ridge.L /10 to Y', 3.00, 'Attached', '45.59566', '360000', '-122.37709', '8036771', NULL, 8712, 1985, 3.00, 'https://www.rmlsweb.com/webphotos/08000000/30000/6000/8036771-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'CLOUMBIA RIVER VIEWS&MT HOOD,LOACATED ACROSS FROM TRAIL PARK, CUSTOM BUILT, 18FT CEILING IN THE LIVING ROOM, CHERRY HARD WOOD FLOORS, ALDER CABINETS, SS KITCHEN AID APPL, 3 FIRE PLACES, BUILT IN THE OFFICE WITH WITH A SLIDING DOOR TO THE DECK, HUGE BONUS ROOM.short sale approved for $360000 need offer', 'Y', '523', 523, 2006, '98671', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(187, NULL, NULL, NULL, 'Coldwell Banker Whitney & Asso', '541-276-0021', 'Pendleton', '2013-03-05', 45000, NULL, NULL, 'US', 45000, 'Holdman Rd. & SW 23rd & SW Ingram', NULL, NULL, '45.679507', '48000', '-118.812193', '8037669', NULL, 8712, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/30000/7000/8037669-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Lots 6,7,9,11,16,17, 19 &20 great for daylight basement. Plans stick-built housing only.Lots 8,9,10,ll,16,17,18 great lots for level homes. Lots 7,9,17,19,20 great for basement garage options. Lots 10 & 11 great for 1/4 to 1/2 basement storage. We offer free fill to original purchasers for garage & front yard when material is available.', '23RD', '749', 749, NULL, '97801', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(188, 3, 3, 2180.00, 'Copper West Properties-Hood River', '541-386-2330', 'HoodRiver', '2012-06-01', 498000, NULL, NULL, 'US', 498000, 'Country Club to Cannon Drive, follow to the end.', 2.00, 'Detached', '45.689059', '549000', '-121.567338', '8039318', '329.69\' x 332.26', 109335, 1140, 2.00, 'https://www.rmlsweb.com/webphotos/08000000/30000/9000/8039318-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'Custom Craftsman style home situated on 2.51 acres on the Westside, with both Mt. Hood & Mt. Adams views. Amenities include: radiant heated concrete floors, wood windows, clear fir trim, irrigated acreage, and a detached two car garage/shop with office/art studio above.', 'Cannon', '1020', 1020, 2004, '97031', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(189, NULL, NULL, NULL, 'Non Rmls Broker', '503-236-7657', 'Cougar', '2018-12-17', 15000, NULL, NULL, 'US', 15000, 'from Cougar;follow 90 RDto25RD, left at Nymark Dr, first right', NULL, NULL, '46.100174', '19998', '-122.292053', '8040480', NULL, 28749, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/0000/8040480-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Great location for your mountain vacation home. There is a nice level building spot although at first glance the lot appears somewhat sloped.  Trail access to Pine Creek. 2 miles from Swift Boat Launch. Water sports, fishing, boating. Shared well so water is available. Across the private road from Pine Creek. Listen to the water! Hunt, snowmobile, cross country ski, water ski - a wonderful Pacific Northwest Playground!', 'Lot 1 John Niemer SP', NULL, NULL, NULL, '98616', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(190, NULL, NULL, NULL, 'Non Rmls Broker', '503-236-7657', 'McMinnville', '2013-06-28', 52500, NULL, NULL, 'US', 52500, 'West on 2nd to Left on Blue Heron Ct.', NULL, NULL, '45.208881', '64900', '-123.241277', '8041840', '6873 SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/1000/8041840-1-a.jpg', 'Land', 'SingleFamilyResidence', NULL, 'Blue Heron', '110', 110, NULL, '97128', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(191, NULL, NULL, NULL, 'Non Rmls Broker', '503-236-7657', 'McMinnville', '2013-06-28', 52500, NULL, NULL, 'US', 52500, 'West on 2nd to Left on Blue Heron Ct.', NULL, NULL, '45.208682', '64900', '-123.241215', '8041855', '6804 SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/1000/8041855-1-a.jpg', 'Land', 'SingleFamilyResidence', NULL, 'Blue Heron', '128', 128, NULL, '97128', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(192, NULL, NULL, NULL, 'Non Rmls Broker', '503-236-7657', 'McMinnville', '2013-06-28', 52500, NULL, NULL, 'US', 52500, 'West on 2nd to Left on Blue Heron Ct.', NULL, NULL, '45.208484', '64900', '-123.241172', '8041860', '6877 SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/1000/8041860-1-a.jpg', 'Land', 'SingleFamilyResidence', NULL, 'Blue Heron', '152', 152, NULL, '97128', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(193, NULL, NULL, NULL, 'Willamette West REALTORS', '503-472-8444', 'McMinnville', '2012-08-31', 60000, NULL, NULL, 'US', 60000, 'West on 2nd to Left on Blue Heron Ct.', NULL, NULL, '45.207878', '64900', '-123.241146', '8041869', '6836 SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/1000/8041869-1-a.jpg', 'Land', 'SingleFamilyResidence', NULL, 'Blue Heron', '218', 218, NULL, '97128', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(194, NULL, NULL, NULL, 'Prudential NW Properties', '503-472-8411', 'McMinnville', '2012-07-31', 65000, NULL, NULL, 'US', 65000, 'West on 2nd to Left on Blue Heron Ct.', NULL, NULL, '45.207011', '79900', '-123.241195', '8041873', '9275 SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/1000/8041873-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Nice size lot at end of cul-de-sac. Borders new 7.7 acre City Park.', 'Blue Heron', '356', 356, NULL, '97128', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(195, NULL, NULL, NULL, 'Aster Realty', '503-472-0473', 'McMinnville', '2012-05-31', 65000, NULL, NULL, 'US', 65000, 'West on 2nd to Left on Blue Heron Ct.', NULL, NULL, '45.207018', '79900', '-123.241659', '8041877', '9052 SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/1000/8041877-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Nice size lot at end of cul-de-sac. Borders new 7.7 acre City Park.', 'Blue Heron', '395', 395, NULL, '97128', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(196, NULL, NULL, NULL, 'Non Rmls Broker', '503-236-7657', 'McMinnville', '2013-06-28', 52500, NULL, NULL, 'US', 52500, 'West on 2nd to Left on Blue Heron Ct.', NULL, NULL, '45.20726', '59900', '-123.241703', '8041882', '7559 SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/1000/8041882-1-a.jpg', 'Land', 'SingleFamilyResidence', NULL, 'Blue Heron', '377', 377, NULL, '97128', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(197, NULL, NULL, NULL, 'Non Rmls Broker', '503-236-7657', 'McMinnville', '2013-06-28', 52500, NULL, NULL, 'US', 52500, 'West on 2nd to Left on Blue Heron Ct.', NULL, NULL, '45.207484', '59900', '-123.241702', '8041887', '7055 SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/1000/8041887-1-a.jpg', 'Land', 'SingleFamilyResidence', NULL, 'Blue Heron', '267', 267, NULL, '97128', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(198, NULL, NULL, NULL, 'Non Rmls Broker', '503-236-7657', 'McMinnville', '2013-06-28', 52500, NULL, NULL, 'US', 52500, 'West on 2nd to Left on Blue Heron Ct.', NULL, NULL, '45.207896', '59900', '-123.241702', '8041892', '7165 SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/1000/8041892-1-a.jpg', 'Land', 'SingleFamilyResidence', NULL, 'Blue Heron', '213', 213, NULL, '97128', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(199, NULL, NULL, NULL, 'Non Rmls Broker', '503-236-7657', 'McMinnville', '2013-06-28', 52500, NULL, NULL, 'US', 52500, 'West on 2nd to Left on Blue Heron Ct.', NULL, NULL, '45.208197', '59900', '-123.241718', '8041899', '6487 SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/1000/8041899-1-a.jpg', 'Land', 'SingleFamilyResidence', NULL, 'Blue Heron', '193', 193, NULL, '97128', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(200, NULL, NULL, NULL, 'Non Rmls Broker', '503-236-7657', 'McMinnville', '2013-06-28', 52500, NULL, NULL, 'US', 52500, 'West on 2nd to Left on Blue Heron Ct.', NULL, NULL, '45.208372', '59900', '-123.241737', '8041904', '5999 SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/1000/8041904-1-a.jpg', 'Land', 'SingleFamilyResidence', NULL, 'Blue Heron', '167', 167, NULL, '97128', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(201, NULL, NULL, NULL, 'Non Rmls Broker', '503-236-7657', 'McMinnville', '2013-06-28', 52500, NULL, NULL, 'US', 52500, 'West on 2nd to Left on Blue Heron Ct.', NULL, NULL, '45.208545', '59900', '-123.241758', '8041909', '6289 SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/1000/8041909-1-a.jpg', 'Land', 'SingleFamilyResidence', NULL, 'Blue Heron', '131', 131, NULL, '97128', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(202, NULL, NULL, NULL, 'Non Rmls Broker', '503-236-7657', 'McMinnville', '2013-06-28', 52500, NULL, NULL, 'US', 52500, 'West on 2nd to Left on Blue Heron Ct.', NULL, NULL, '45.208742', '59900', '-123.241779', '8041914', '8289 SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/1000/8041914-1-a.jpg', 'Land', 'SingleFamilyResidence', NULL, 'Blue Heron', '115', 115, NULL, '97128', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(203, NULL, NULL, NULL, 'Non Rmls Broker', '503-236-7657', 'McMinnville', '2013-06-28', 52500, NULL, NULL, 'US', 52500, 'West on 2nd St.', NULL, NULL, '45.209308', '64900', '-123.241452', '8041919', '7126SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/1000/8041919-1-a.jpg', 'Land', 'SingleFamilyResidence', NULL, '2nd', '2807', 2807, NULL, '97128', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(204, NULL, NULL, NULL, 'Non Rmls Broker', '503-236-7657', 'McMinnville', '2013-06-28', 52500, NULL, NULL, 'US', 52500, 'West on 2nd St.', NULL, NULL, '45.209275', '64900', '-123.241692', '8041924', '6996 SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/1000/8041924-1-a.jpg', 'Land', 'SingleFamilyResidence', NULL, '2nd', '2819', 2819, NULL, '97128', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(205, NULL, NULL, NULL, 'Non Rmls Broker', '503-236-7657', 'McMinnville', '2013-06-28', 52500, NULL, NULL, 'US', 52500, 'West on 2nd St.', NULL, NULL, '45.20924', '64900', '-123.241912', '8041928', '6862 SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/1000/8041928-1-a.jpg', 'Land', 'SingleFamilyResidence', NULL, '2nd', '2823', 2823, NULL, '97128', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(206, NULL, NULL, NULL, 'Non Rmls Broker', '503-236-7657', 'McMinnville', '2013-06-28', 52500, NULL, NULL, 'US', 52500, 'West on 2nd St.', NULL, NULL, '45.20911', '64900', '-123.242141', '8041933', '6732 SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/1000/8041933-1-a.jpg', 'Land', 'SingleFamilyResidence', NULL, '2nd', '2831', 2831, NULL, '97128', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(207, NULL, NULL, NULL, 'Non Rmls Broker', '503-236-7657', 'McMinnville', '2013-06-28', 52500, NULL, NULL, 'US', 52500, 'West on 2nd St.', NULL, NULL, '45.209038', '59900', '-123.242349', '8041936', '6609 SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/1000/8041936-1-a.jpg', 'Land', 'SingleFamilyResidence', NULL, '2nd', '2839', 2839, NULL, '97128', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(208, NULL, NULL, NULL, 'Non Rmls Broker', '503-236-7657', 'McMinnville', '2013-06-28', 52500, NULL, NULL, 'US', 52500, 'West on 2nd St.', NULL, NULL, '45.208989', '59900', '-123.242569', '8041939', '6299 SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/1000/8041939-1-a.jpg', 'Land', 'SingleFamilyResidence', NULL, '2nd', '2843', 2843, NULL, '97128', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(209, NULL, NULL, NULL, 'Non Rmls Broker', '503-236-7657', 'McMinnville', '2013-06-28', 52500, NULL, NULL, 'US', 52500, 'West on 2nd St.', NULL, NULL, '45.208896', '59900', '-123.24281', '8041945', '6195 SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/1000/8041945-1-a.jpg', 'Land', 'SingleFamilyResidence', NULL, '2nd', '2857', 2857, NULL, '97128', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(210, NULL, NULL, NULL, 'Non Rmls Broker', '503-236-7657', 'McMinnville', '2013-06-28', 52500, NULL, NULL, 'US', 52500, 'West on 2nd St.', NULL, NULL, '45.208788', '59900', '-123.243022', '8041949', '6150 SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/1000/8041949-1-a.jpg', 'Land', 'SingleFamilyResidence', NULL, '2nd', '2861', 2861, NULL, '97128', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(211, NULL, NULL, NULL, 'Non Rmls Broker', '503-236-7657', 'McMinnville', '2013-06-28', 52500, NULL, NULL, 'US', 52500, 'West on 2nd St.', NULL, NULL, '45.208668', '59900', '-123.243204', '8041956', '6336 SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/1000/8041956-1-a.jpg', 'Land', 'SingleFamilyResidence', NULL, '2nd', '2875', 2875, NULL, '97128', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(212, NULL, NULL, NULL, 'Non Rmls Broker', '503-236-7657', 'McMinnville', '2013-06-28', 52500, NULL, NULL, 'US', 52500, 'West on 2nd St.', NULL, NULL, '45.208571', '59900', '-123.243409', '8041960', '6425 SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/1000/8041960-1-a.jpg', 'Land', 'SingleFamilyResidence', NULL, '2nd', '2883', 2883, NULL, '97128', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(213, NULL, NULL, NULL, 'Non Rmls Broker', '503-236-7657', 'McMinnville', '2013-06-28', 52500, NULL, NULL, 'US', 52500, 'West on 2nd St.', NULL, NULL, '45.20842', '69900', '-123.243589', '8041963', '6564 SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/1000/8041963-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Located across from new 7.7 acre City Park.', '2nd', '2895', 2895, NULL, '97128', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(214, NULL, NULL, NULL, 'Non Rmls Broker', '503-236-7657', 'McMinnville', '2013-06-28', 52500, NULL, NULL, 'US', 52500, 'West on 2nd St.', NULL, NULL, '45.208299', '69900', '-123.243757', '8041966', '6856 SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/1000/8041966-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Located across from new 7.7 acre City Park.', '2nd', '2907', 2907, NULL, '97128', '2023-05-12 11:36:57', '2023-05-12 11:36:57');
INSERT INTO `resoapi_properties` (`id`, `BathroomsTotalInteger`, `BedroomsTotal`, `BuildingAreaTotal`, `BuyerOfficeName`, `BuyerOfficePhone`, `City`, `CloseDate`, `ClosePrice`, `CondominiumElevatorYN`, `CondominiumGarageType`, `Country`, `CurrentPriceForStatus`, `Directions`, `GarageSpaces`, `GarageType`, `Latitude`, `ListPrice`, `Longitude`, `ListingId`, `LotSizeDimensions`, `LotSizeSquareFeet`, `MainLevelAreaTotal`, `ParkingTotal`, `Photo1URL`, `PropertyType`, `PropertySubType`, `PublicRemarks`, `StreetName`, `StreetNumber`, `StreetNumberNumeric`, `YearBuilt`, `PostalCode`, `created_at`, `updated_at`) VALUES
(215, NULL, NULL, NULL, 'Non Rmls Broker', '503-236-7657', 'McMinnville', '2013-06-28', 52500, NULL, NULL, 'US', 52500, 'West on 2nd St.', NULL, NULL, '45.20819', '69900', '-123.243929', '8041972', '6818 SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/1000/8041972-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Located across from new 7.7 acre City Park.', '2nd', '2915', 2915, NULL, '97128', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(216, NULL, NULL, NULL, 'Non Rmls Broker', '503-236-7657', 'McMinnville', '2013-06-28', 52500, NULL, NULL, 'US', 52500, 'West on 2nd St. Corner of 2nd and Canyon Creek Dr.', NULL, NULL, '45.207988', '69900', '-123.244092', '8041977', '7970 SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/1000/8041977-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Great Location across from new 7.7 acre City Park.', '2nd', '2921', 2921, NULL, '97128', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(217, NULL, NULL, NULL, 'Aster Realty', '503-472-0473', 'McMinnville', '2013-01-23', 65000, NULL, NULL, 'US', 65000, 'West on 2nd St. Corner of 2nd and Canyon Creek Dr.', NULL, NULL, '45.20781', '79900', '-123.244585', '8041983', '7921 SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/1000/8041983-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Corner Lot. Great Location across from new 7.7 acre City Park.', '2nd', '2927', 2927, NULL, '97128', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(218, NULL, NULL, NULL, 'Non Rmls Broker', '503-236-7657', 'McMinnville', '2013-06-28', 52500, NULL, NULL, 'US', 52500, 'West on 2nd St.', NULL, NULL, '45.207661', '69900', '-123.24475', '8041991', '6983 SF', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/1000/8041991-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Great Location across from new 7.7 acre City Park.', '2nd', '2933', 2933, NULL, '97128', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(219, NULL, NULL, NULL, 'American West Prop. Hermiston', '541-564-0888', 'Hermiston', '2012-04-17', 184000, NULL, NULL, 'US', 184000, 'South on hwy 395 - Port Dr. Exit', NULL, NULL, '45.827481', '199000', '-119.27495', '8043626', '3.09 Acres', 134600, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/3000/8043626-1-a.jpg', 'Land', 'Industrial', 'Utilities on Port Dr. Site Visible from 395. Access from Port Dr. Great building potential.', 'Hwy 395', NULL, NULL, NULL, '97838', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(220, 2, 4, 3065.00, 'Park Place Real Estate, Inc', '503-537-4925', 'ColumbiaCity', '2015-07-30', 169000, NULL, NULL, 'US', 169000, 'Hwy 30, W on I st, straight up paved driveway.', 3.00, 'Carport', '45.888569', '185000', '-122.812174', '8043629', NULL, 0, 1509, 3.00, 'https://www.rmlsweb.com/webphotos/08000000/40000/3000/8043629-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'Historic Spacious home w/big kitchen on main level & kitchenette on lower level.  High-ceilings, orig. woodworking & built-ins. All rooms are large and in EXCELLENT condition for age of home. 3rd floor is unfinished but has lots of possibilities. Home is solid! Double Lot. . Agent related to sellers.', '5th', '1835', 1835, 1920, '97018', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(221, NULL, NULL, 1872.00, 'Ark Real Estate', '503-728-0161', 'ColumbiaCity', '2016-01-20', 145000, NULL, NULL, 'US', 145000, 'Hwy 30, W on I St., Straight up Paved Driveway.', 2.00, NULL, '45.888598', '166000', '-122.812048', '8043658', NULL, 0, NULL, 2.00, 'https://www.rmlsweb.com/webphotos/08000000/40000/3000/8043658-1-a.jpg', 'MultiFamily', NULL, 'QUALITY BUILT & MAINTAINED Duplex with solid rental history. Covered deck and patio with views of Columbia River & mountains. Gas fireplaces, formal dining room, large common utility room for each tenant to have personal W&D. Separate utility meters & forced air furnaces for each tenant. Agent related to sellers.', '5th', '1855', 1855, 1968, '97018', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(222, NULL, NULL, NULL, 'Windermere/C & C RGI', '503-738-8522', 'Warrenton', '2013-04-19', 160000, NULL, NULL, 'US', 160000, 'Hwy. 101 to Surfpines, North on Manion Drive, W on Malarkey to Ocean Ave', NULL, NULL, '46.058544', '175000', '-123.92718', '8044709', NULL, 266587, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/4000/8044709-1-a.jpg', 'Land', 'SingleFamilyResidence', 'PRICE REDUCED! Ocean front lot with 203 feet of ocean frontage in the gated community of Surf Pines. Located just north of Gearhart, Oregon on the Pacific Ocean. Building Ready. Additional parcel available. By all beach area activities.', 'Ocean', NULL, NULL, NULL, '97146', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(223, 2, 3, 1122.00, 'R. A. S. Realty', '503-640-7800', 'Eugene', '2015-07-27', 167500, NULL, NULL, 'US', 167500, 'HWY 99N, WEST ON JESSEN, LEFT ON BEAN, LEFT ON N. CLAREY', 2.00, 'Oversized', '44.090147', '173950', '-123.161447', '8044819', 'culdesac/irregular', 0, 1122, 2.00, 'https://www.rmlsweb.com/webphotos/08000000/40000/4000/8044819-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'UPDATES THROUGHOUT! New siding,greaat new wood & tile floors, new windows & doors,Vaulted ceilings in livingroom. French doors in MBR & Dining area direct to deck. LIGHT-BRIGHT-IMMACULATE! style shows inside & out. This one will go quickly.All appliances in perfect condition. Look then BUY!', 'CLAREY', '3985', 3985, 1978, '97402', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(224, NULL, NULL, NULL, 'Seaboard Properties', '541-269-0355', 'PortOrford', '2018-10-22', 85000, NULL, NULL, 'US', 85000, 'east on Hensley Hill Rd to top of hill', NULL, NULL, '42.767108', '94000', '-124.486185', '8044998', NULL, 37897, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/4000/8044998-1-a.jpg', 'Land', 'SingleFamilyResidence', 'An ocean view from this landscaped lot:  old structure may be torn down or rebuilt.', 'HENSLEY HILL', '42626', 42626, NULL, '97465', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(225, NULL, NULL, NULL, 'Premiere Property Group, LLC', '503-670-9000', 'Welches', '2019-10-24', 165000, NULL, NULL, 'US', 165000, 'WELCHES RD TO ELK PARK CROSS BRIDGE TURN LEFT PROPERTY ON RIGHT', NULL, NULL, '45.325665', '189000', '-121.964437', '8046532', NULL, 593287, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/6000/8046532-1-a.jpg', 'Land', 'SingleFamilyResidence', '13+ACRES OF TIMBER.  NICE LEVEL ACRE FOR BUILDING WITH SMALL POLE BARN AND CITY WATER, SURVEYED.  THE BALANCE OF THE PROPERTY IS WOODED PRIVACY SEE NEWER TIMBER CRUISE. LISTING AGENT IS OWNER  CROSS THE  ROAD TO SALMON RIVER!!  Logging was restricted because of load limit on old bridge.  New one being installed!!!', 'ELK PARK', '0', 0, NULL, '97067', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(226, NULL, NULL, NULL, 'Jo Hiatt Real Estate', '541-822-3509', 'McKenzieBridge', '2014-08-28', 69000, NULL, NULL, 'US', 69000, 'East on Hwy. 126 to McKenzie Bridge, left on North Bank rd to sign', NULL, NULL, '44.197082', '69000', '-122.610427', '8047770', NULL, 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/40000/7000/8047770-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Great building site, seller has obtained LEGAL LOT VERIFICATION AND SEPTIC APPROVAL FOR STANDARD SYSTEM, POWER, DRIVEWAY,  walk to McKenzie River, in area of National Forest, golf, skiing, locate on quiet rd. away from traffic noise on 126. OWNER FINANCING  . Listing agent is an owner.', 'North Bank', NULL, NULL, NULL, '97413', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(227, NULL, NULL, NULL, NULL, NULL, 'Brookings', NULL, 0, NULL, NULL, 'US', 2900000, 'Hwy 101 south side of the Chetco bridge', NULL, NULL, '42.05364', '2900000', '-124.266206', '8050046', NULL, 349786, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/50000/0000/8050046-1-a.jpg', 'Land', 'Industrial', 'This 8.02 acre property is perched overlooking Port of Brookings/Harbor, Chetco River & Pacific Ocean. Zoned commercial, it offers developer/business a first class location for multi-family, motel, restaurant or recreational trailer park. Property has 3 accesses, one being HWY 101.  Also 3 bay shop on lot 800. One Seller is active OR RE Broker. Buyer to perform due diligence with county & utility companies  regarding fees, requirements.', 'GROOTENDORST', '16362', 16362, NULL, '97415', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(228, 3, 4, 2460.00, 'Grami Properties', '541-290-7808', 'NorthBend', '2013-02-26', 230000, NULL, NULL, 'US', 230000, 'Broadway to State to NE corner of State and Myrtle', 2.00, 'Attached', '43.393311', '209000', '-124.240568', '8050188', NULL, 0, 2100, 2.00, 'https://www.rmlsweb.com/webphotos/08000000/50000/0000/8050188-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'Custom built brand new home. Great room design. Granite counters in kitchen, baths and laundry. Hardwood, slate tile, stainless appliances, RV parking with hookup and dump. Custom stamped concrete driveway. Cash Only', 'Myrtle', '3159', 3159, 2008, '97459', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(229, 1, 3, 816.00, 'HomeStead Realty Inc', '541-894-2531', 'Sumpter', '2012-02-29', 103000, NULL, NULL, 'US', 103000, 'Off Sumpter Valley Highway to Market Rd.  Turn Left onto Market Rd.', 0.00, NULL, '44.732601', '103000', '-118.193146', '8050223', '116x148 +/-', 0, 816, 0.00, 'https://www.rmlsweb.com/webphotos/08000000/50000/0000/8050223-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'BRAND NEW COUNTRY CABIN--MUST SEE!! Priced to Sell!  3 Bedrooms, 1 Bath, Custom Appliances, Vaulted Knotty Pine Ceilings, View, Deck, Porch, Multi-Level Lot, RV Parking, Treed!!  Great Get-a-way in Sumpter!! Creative Owner Options Available. Oregon Licensed Broker Owned', 'Lot 25 Mt. View esta', NULL, NULL, 2008, '97877', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(230, 2, 3, 1337.00, 'Non Rmls Broker', '503-236-7657', 'PortOrford', '2015-03-11', 155000, NULL, NULL, 'US', 155000, 'east on 9th Street, right side', 1.00, 'Attached', '42.745684', '169000', '-124.495027', '8050285', '90x100', 0, 1337, 1.00, 'https://www.rmlsweb.com/webphotos/08000000/50000/0000/8050285-1-a.jpg', 'Residential', 'SingleFamilyResidence', NULL, 'NINTH', '325', 325, 1994, '97465', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(231, 1, 2, 1485.00, 'CB Dick Dodson Realty', '541-475-6137', 'Culver', '2013-04-11', 225000, NULL, NULL, 'US', 225000, 'Lakeview Dr to Bald Eagle Ln', 4.00, 'Detached', '44.578352', '265000', '-121.379118', '8050571', NULL, 218671, 1000, 4.00, 'https://www.rmlsweb.com/webphotos/08000000/50000/0000/8050571-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'Gorgeous 1500SF home on 5 ac w/awesome views! 2BR 1Ba, furnished, granite counters, loft & wrap around deck. 2 shared wells, one not connected & state of the art solar system. Vacation or full time living. 36X40 shop, 28X24 pole barn. Gated comm w/private marina to Metolius arm/Lake Billy Chinook.', 'Bald Eagle', '12453', 12453, 1994, '97734', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(232, 1, 3, 1216.00, 'Clark Jennings & Asso. LLC, OR', '541-278-9275', 'MiltonFreewater', '2012-06-15', 85000, NULL, NULL, 'US', 85000, 'S.E. 12th', 1.00, 'Detached', '45.924142', '85000', '-118.381156', '8050702', '60\' x 120\'', 7405, 1216, 1.00, 'https://www.rmlsweb.com/webphotos/08000000/50000/0000/8050702-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'Step back in time and enjoy this turn of the century Victorian home.  This clean home is ready for your furniture and comes with character everywhere.  Nice corner location.  Storage/garage.  AHS Home Warranty.', 'MILL', '1222', 1222, 1902, '97862', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(233, 1, 2, 912.00, 'Coldwell Banker Coast Real Est', '541-997-7777', 'Florence', '2012-03-20', 135000, NULL, NULL, 'US', 135000, 'Hwy 101 North, go west on 17th Street almost to end, home on right.', 0.00, NULL, '43.981904', '149900', '-124.103152', '8051782', 'Aprox 120 x 57', 6098, 912, 0.00, 'https://www.rmlsweb.com/webphotos/08000000/50000/1000/8051782-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'This amazing 2 bedroom home is just beautiful inside & out.  Clean & newly remodeled home features wood laminate flooring throughout, updated kitchen with light wood cabinetry and Maytag stacking washer & dryer.  Located by Miller Park and with a large back yard complete with deck and landscaped front yard. Newly paved parking area in back of house.  List #370', '17TH', '1657', 1657, 1962, '97439', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(234, 1, 3, 1168.00, 'Prudential R.E. Professionals', '541-673-1890', 'Elkton', '2012-07-31', 160000, NULL, NULL, 'US', 160000, 'Hwy 38 to MP 24.5 drive way on the right heading east.', 1.00, 'Detached', '43.662368', '179000', '-123.70431', '8052971', NULL, 89733, 1168, 1.00, 'https://www.rmlsweb.com/webphotos/08000000/50000/2000/8052971-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'HUGE PRICE REDUCTION!Outstanding opportunity to live in the quiet Umpqua Valley along the river and surrounding hills just east of Scottsburg. Enjoy the warmer in-land air for barbecuing in the summer and evenings, and take advantage of the 2.06 acres to plant your favorite garden or fish along the Umpqua River.', 'STATE HIGHWAY 38', '27200', 27200, 1940, '97436', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(235, NULL, NULL, NULL, 'Re/Max South Coast', '541-290-1850', 'CoosBay', '2016-05-09', 140000, NULL, NULL, 'US', 140000, 'Green acres, keep right on  upper loop past grange to luscombe loop, on corner', NULL, NULL, '43.254365', '150000', '-124.206687', '8053360', NULL, 80586, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/50000/3000/8053360-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Beautiful parcel of land, completely fenced with power, hand dug wells, one drilled well with filtration system, a brand new septic system, shop building, deck.  Fruit trees and room for the kids, the dogs or the horse.  It\'s just lovely', 'LUSCOMBE', '93380', 93380, NULL, '97420', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(236, NULL, NULL, NULL, 'American West Prop. Hermiston', '541-564-0888', 'Umatilla', '2014-07-14', 28000, NULL, NULL, 'US', 28000, '1231\' east of corner of Dark Canyon & Powerline Rd.', NULL, NULL, '45.896993', '30000', '-119.337308', '8053866', '1600 X 1089', 871200, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/50000/3000/8053866-1-a.jpg', 'Land', 'SingleFamilyResidence', 'VIEW!!!  Columbia River,  Umatilla River,  City of Umatilla,  Washingtons Horse Heaven Hills.  Zoned for residential development!property is located just off Powerline Rd.', 'Powerline', NULL, NULL, NULL, '97882', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(237, NULL, NULL, NULL, 'Klickitat Valley Realty Inc', '509-773-3755', 'Goldendale', '2012-12-04', 22500, NULL, NULL, 'US', 22500, 'Hwy 97, Woodland Rd, Old Stage Left, 1st dirt rd to Right, see sign', NULL, NULL, '45.880001', '27500', '-120.696517', '8053935', NULL, 217800, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/50000/3000/8053935-1-a.jpg', 'Land', 'SingleFamilyResidence', '5 acres w/Beautiful country setting 8 miles from town off paved road 1/2 mile gravel. Pine,Oak and grasslands. Owner terms. Options with the bus. Some corners are marked others are marked w/orange flag approx. No cc&r\'s so bring the 4 wheelers and animals.', 'Off Old Stage', NULL, NULL, NULL, '98620', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(238, 3, 4, 1832.00, 'RE/MAX Equity Group', '503-645-0638', 'Lafayette', '2012-09-14', 165000, NULL, NULL, 'US', 165000, 'Hwy 99W to Lafayette, Left on Bridge Street, Right on 12th Street', 2.00, 'Attached', '45.249989', '164900', '-123.112958', '8055393', '5008 sq. ft.', 4791, 702, 2.00, 'https://www.rmlsweb.com/webphotos/08000000/50000/5000/8055393-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'Large home for a great price. Spacious floor plan offering living spaces for everyone. Located a short distance from the elementary school. This home has a heat pump. Home has a sprinkler system and yard with fence.', '12TH', '228', 228, 2007, '97127', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(239, NULL, NULL, 1000.00, 'Leslie & Leslie Realtors', '541-998-8909', 'JunctionCity', '2014-12-08', 325000, NULL, NULL, 'US', 325000, 'Ivy street across from Safeway', NULL, NULL, '44.229322', '369000', '-123.2046', '8055484', NULL, 43560, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/50000/5000/8055484-1-a.jpg', 'CommercialSale', 'Commercial', 'Great 1 acre Commercial  corner lot  across from Safeway perfect for developement now or in the future, has existing house on the property that can be rented', 'IVY', '1790', 1790, 1927, '97448', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(240, NULL, NULL, 55000.00, 'G. Stiles Realty', '541-672-1616', 'Sutherlin', '2016-03-14', 900000, NULL, NULL, 'US', 900000, 'I-5 exit 136, right on Central, right on Taylor, left on Hastings', NULL, NULL, '43.380566', '1140000', '-123.323064', '8057293', NULL, 978357, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/50000/7000/8057293-1-a.jpg', 'CommercialSale', 'Industrial', 'Price Reduced !! Fantastic location, M-2  zoned, level, Industrial property: 55,000 SqFt of improvements. 45,000 SqFt mfg facility w/ sprinklers, new 70 Ft scale, new fire hydrant, 2 ac of pavement. Office has heat pump & high speed internet,remodeled.  Total of 5 bldgs. Separate restrm & lunchrm & truck shop. Former rail access w/ 1/4 mile spur.Appraisal, Wetlands report & Phase 1 on file', 'HASTINGS', '800', 800, 1940, '97479', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(241, NULL, NULL, NULL, 'Willamette West REALTORS', '503-472-8444', 'McMinnville', '2012-08-31', 60000, NULL, NULL, 'US', 60000, 'West on 2nd St., past Hill Rd., left on Blue Heron Ct', NULL, NULL, '45.207681', '64900', '-123.241146', '8058057', '6480 square feet', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/50000/8000/8058057-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Bring your builder!  Nice lot in Valleys Edge Phase II.  Quiet cul-de-sac location.', 'Blue Heron', '246', 246, NULL, '97128', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(242, NULL, NULL, NULL, 'Lighthouse Realty/Long Beach', '360-642-4461', 'OceanPark', '2013-01-14', 24000, NULL, NULL, 'US', 24000, 'S on U St from Bay Ave, E on 242nd to end of road, sign on S side.', NULL, NULL, '46.47706', '29900', '-124.042516', '8058725', 'See Agent', 0, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/50000/8000/8058725-1-a.jpg', 'Land', 'SingleFamilyResidence', '8 - 50x100 Wooded Lots undeveloped and ready for you to make your own...or separate and develop.  Six lots all adjoin w/possible 2-3 building sites on ridge, 2 lots across road. Close to town, but not in the midst of the hustle and bustle. Let nature surround you and don\'t wait as these lots are priced to sell!', 'W', NULL, NULL, NULL, '98640', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(243, 3, 3, 2002.00, 'John L. Scott', '503-543-3751', 'ColumbiaCity', '2014-10-30', 220260, NULL, NULL, 'US', 220260, 'HWY 30 NORTH, LT ON E, RT ON 6TH, PROPERTY ON RIGHT PAST C ST.', 2.00, 'Attached', '45.894564', '229900', '-122.815792', '8062344', '50X100', 0, 844, 2.00, 'https://www.rmlsweb.com/webphotos/08000000/60000/2000/8062344-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'POSSIBLE LEASE OPTION.  Incredibly well designed making use of every inch.Built as an \"Energy Star\" Rated home w/ amenities to include real cedar siding, custom cabinetry, gas fp w/mantel, vaulted master suite w/walk-in closet and much more. SQFT includes easy to finish bonus rm.', '6th', '2510', 2510, 2008, '97018', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(244, 4, 5, 4268.00, 'Windermere Pacific Crest Realt', '503-474-1234', 'McMinnville', '2012-08-17', 515000, NULL, NULL, 'US', 515000, 'Baker to Westside Rd.,2 Blocks out of town-1st driveway on R.past bridge', 2.00, 'Oversized', '45.233765', '539900', '-123.195497', '8062482', '3.81 ACRES', 165963, 1445, 2.00, 'https://www.rmlsweb.com/webphotos/08000000/60000/2000/8062482-1-a.jpg', 'Residential', 'SingleFamilyResidence', 'Just 2 blocks from McMinnville! Gorgeous, Victorian home with Baker Creek frontage! Home has many features including media room, excercise room, large party room with wet bar & in ground pool. Also barn with lean-to. Water rights to the creek. Shared driveway - second home on the lane.', 'WESTSIDE', '3260', 3260, 1995, '97128', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(245, 2, 3, 1600.00, 'Ultimate Coastal Properties', '541-425-7494', 'GoldBeach', '2012-12-28', 332500, NULL, NULL, 'US', 332500, 'Hwy 101, 12 mi. S of Gold Beach/Turn onto Pistol River/Carpenterville Rd', 0.00, 'Carport', '42.259747', '399900', '-124.39414', '8062965', NULL, 659934, 1600, 0.00, 'https://www.rmlsweb.com/webphotos/08000000/60000/2000/8062965-1-a.jpg', 'Residential', 'ManufacturedHomeonRealProperty', 'Gold Beach - living room view of the ocean! Pistol river frontage. 15 acres pasture. Ideal for horses or livestock. New large shop & hay barn with stalls & tack room. Large view decks, new MH with nice features. Owner contract terms to qualified purchase.', 'CARPENTERVILLE', '24201', 24201, 2007, '97444', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(246, NULL, NULL, NULL, 'Windermere/Western View Proper', '503-623-2333', 'Sheridan', '2015-06-12', 107500, NULL, NULL, 'US', 107500, 'Hwy 18 W to  Hwy 22W to Sawtell Rd to Doane Creek Rd.', NULL, NULL, NULL, '125000', NULL, '8063930', '267023', 267022, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/60000/3000/8063930-1-a.jpg', 'Land', 'SingleFamilyResidence', 'Well, Septic and Graveled Driveway are in. Power is at the property.  Septic is standard approved and installed. Very private and serene parcel. Gently sloped southwest view.  Near BLM land.  Stream located near but not on property. Well when drilled produced 20 gpm. Property near Willamina off Hwy 22.  Beautiful area, lots of wildlife!!', 'Doane Creek', NULL, NULL, NULL, '97378', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(247, 0, 0, NULL, 'Century 21 Agate Realty/Gold', '541-247-6612', 'GoldBeach', '2014-08-20', 465000, NULL, NULL, 'US', 465000, 'east from GB on Third Street turns into Grizzly Mountain Rd', NULL, NULL, '42.415621', '595000', '-124.406152', '8064460', NULL, 3485235, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/60000/4000/8064460-1-a.jpg', 'Land', 'FarmForest', 'Part of PACIFIC ROGUE RANCH. The views from this property are just plain gorgeous and incredible. No matter the direction. The beach is a half mile distant; the Pacific Ocean stretches before you with vistas of the rocky Southern Oregon Coast stretching north and south. There are forested vistas in abundance as you gaze around the property. Parcel 1A', 'Grizzly Mountain', NULL, NULL, NULL, '97444', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(248, NULL, NULL, NULL, 'Century 21 Agate Realty/Gold', '541-247-6612', 'GoldBeach', '2013-04-25', 339000, NULL, NULL, 'US', 339000, 'Third Street to Grizzly Mountain Road', NULL, NULL, '42.418243', '400000', '-124.398063', '8065681', NULL, 3605461, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/60000/5000/8065681-1-a.jpg', 'Land', 'FarmForest', 'YOUR OWN PRIVATE ESTATE just minutes from Gold Beach. Over 80 acres in size. Part of the Pacific Rogue Ranch. The views from this property are just plain gorgeous and incredible. No matter the direction. Both ocean and river views are yours from this elevated private homesite. Septic feasibility on file. Parcel 2B', 'Grizzly Mountain', NULL, NULL, NULL, '97444', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(249, NULL, NULL, NULL, 'Century 21 Agate Realty/Gold', '541-247-6612', 'GoldBeach', '2014-10-31', 325000, NULL, NULL, 'US', 325000, 'Pacific Rogue Ranch', NULL, NULL, '42.423202', '550000', '-124.399064', '8065712', NULL, 3804966, NULL, NULL, 'https://www.rmlsweb.com/webphotos/08000000/60000/5000/8065712-1-a.jpg', 'Land', 'FarmForest', 'YOUR OWN PRIVATE ESTATE just minutes from Gold Beach. Over 80 acres in size. Part of the Pacific Rogue Ranch. The views from this property are just plain gorgeous and incredible. No matter the direction. Both ocean and river views are yours from this elevated private homesite. Septic feasibility on file. Parcel 1C', 'Grizzly Mountain', NULL, NULL, NULL, '97444', '2023-05-12 11:36:57', '2023-05-12 11:36:57'),
(250, 1, 2, 672.00, 'Yoss Team RE Professionals', '541-942-4040', 'Drain', '2012-11-21', 129000, NULL, NULL, 'US', 129000, 'Approx. 1 mile south of Drain on Hwy 38', 0.00, NULL, '43.660631', '129000', '-123.333725', '8066784', NULL, 67518, 672, 0.00, 'https://www.rmlsweb.com/webphotos/08000000/60000/6000/8066784-1-a.jpg', 'Residential', 'ManufacturedHomeonRealProperty', 'The possibilities are endless!  1.55 AC. zoned Rural Commercial just south of Drain with huge 44\'x100\' shop, 46\'x62\' building formerly used as a gift shop, a 16x28 building & an older mobile home of little value.', 'STATE HIGHWAY 38', '896', 896, 1968, '97435', '2023-05-12 11:36:57', '2023-05-12 11:36:57');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=Active,2=Inactive,0=Deleted',
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `status`, `guard_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 1, 'admin', '2023-05-12 09:24:08', '2023-05-12 09:24:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `save_property`
--

CREATE TABLE `save_property` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `license` varchar(255) DEFAULT NULL,
  `about` text,
  `skype` varchar(255) DEFAULT NULL,
  `address` varchar(2000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `videoUrl` varchar(255) DEFAULT NULL,
  `referUrl` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1=Active,2=Inactive,0=Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1=Active,2=Inactive,0=Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `system_errors`
--

CREATE TABLE `system_errors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `controller` varchar(255) DEFAULT NULL,
  `function` varchar(255) DEFAULT NULL,
  `log` varchar(2000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_errors`
--

INSERT INTO `system_errors` (`id`, `controller`, `function`, `log`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'NeighbourController', 'store', 'PDOException: SQLSTATE[HY000]: General error: 1364 Field \'categoryId\' doesn\'t have a default value in C:\\xampp\\htdocs\\property\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Connection.php:501\nStack trace:\n#0 C:\\xampp\\htdocs\\property\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Connection.php(501): PDOStatement->execute()\n#1 C:\\xampp\\htdocs\\property\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Connection.php(705): Illuminate\\Database\\Connection->Illuminate\\Database\\{closure}(\'insert into `ne...\', Array)\n#2 C:\\xampp\\htdocs\\property\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Connection.php(672): Illuminate\\Database\\Connection->runQueryCallback(\'insert into `ne...\', Array, Object(Closure))\n#3 C:\\xampp\\htdocs\\property\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Connection.php(502): Illuminate\\Database\\Connection->run(\'insert into `ne...\', Array, Object(Closure))\n#4 C:\\xampp\\htdocs\\property\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Connection.php(454): Illuminate', '2023-05-12 09:30:10', '2023-05-12 09:30:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_logs`
--

CREATE TABLE `system_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dataId` bigint(20) DEFAULT NULL COMMENT 'no of id of table',
  `staffId` bigint(20) DEFAULT NULL COMMENT 'done by who',
  `referenceTable` varchar(255) DEFAULT NULL COMMENT 'data table name',
  `note` varchar(1000) DEFAULT NULL COMMENT 'data transaction details',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_logs`
--

INSERT INTO `system_logs` (`id`, `dataId`, `staffId`, `referenceTable`, `note`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'cities', '1=> Category created by ', '2023-05-12 09:24:32', '2023-05-12 09:24:32', NULL),
(2, 1, 1, 'neighbours', '1=>  Neighbour created by ', '2023-05-12 09:31:49', '2023-05-12 09:31:49', NULL),
(3, 1, 1, 'countries', '1=> Country created by ', '2023-05-18 01:25:56', '2023-05-18 01:25:56', NULL),
(4, 2, 1, 'countries', '2=> Country created by ', '2023-05-18 01:26:09', '2023-05-18 01:26:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transections`
--

CREATE TABLE `transections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `property_id` bigint(20) UNSIGNED DEFAULT NULL,
  `agent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transection_type` tinyint(4) NOT NULL COMMENT '1=Sale Transection, 2=Listing Transection, 3=others',
  `listing_price` int(11) DEFAULT NULL,
  `sold_price` int(11) DEFAULT NULL,
  `listing_date` date DEFAULT NULL,
  `sold_date` date DEFAULT NULL,
  `property_address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `state` tinyint(4) DEFAULT NULL COMMENT '1=Arizona, 2=Oregon, 3=Washington',
  `buyer_one_name` varchar(255) DEFAULT NULL,
  `buyer_two_name` varchar(255) DEFAULT NULL,
  `buyer_address` varchar(255) DEFAULT NULL,
  `buyer_phone` varchar(255) DEFAULT NULL,
  `buyer_agent` varchar(255) DEFAULT NULL,
  `buyer_agent_email` varchar(255) DEFAULT NULL,
  `buyer_agent_phone` varchar(255) DEFAULT NULL,
  `seller_one_name` varchar(255) DEFAULT NULL,
  `seller_two_name` varchar(255) DEFAULT NULL,
  `seller_address` varchar(255) DEFAULT NULL,
  `seller_phone` varchar(255) DEFAULT NULL,
  `seller_agent` varchar(255) DEFAULT NULL,
  `seller_agent_email` varchar(255) DEFAULT NULL,
  `seller_agent_phone` varchar(255) DEFAULT NULL,
  `closing_title` varchar(255) DEFAULT NULL,
  `escrow_transection` varchar(255) DEFAULT NULL,
  `title_address` varchar(255) DEFAULT NULL,
  `title_phone` varchar(255) DEFAULT NULL,
  `title_agent` varchar(255) DEFAULT NULL,
  `title_email` varchar(255) DEFAULT NULL,
  `commission_amount` double(10,2) DEFAULT NULL,
  `commission_type` varchar(255) DEFAULT NULL,
  `earnest_money` double(10,2) DEFAULT NULL,
  `earnest_money_holder` varchar(255) DEFAULT NULL,
  `home_warrenty` varchar(255) DEFAULT NULL,
  `broker_note` varchar(255) DEFAULT NULL,
  `agent_note` varchar(255) DEFAULT NULL,
  `office_note` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `send_mail` varchar(255) DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=Not approved, 1=Approved',
  `is_paid` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=Not paid, 1=Paid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `user_type` tinyint(4) NOT NULL COMMENT '1=Admin,2=Agent,3=Seller,4=Buyer',
  `status` tinyint(4) DEFAULT '1' COMMENT '1=Active,2=Inactive,0=Deleted',
  `is_approved` tinyint(4) NOT NULL DEFAULT '0',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_online` tinyint(1) NOT NULL DEFAULT '0',
  `last_activity` timestamp NOT NULL DEFAULT '2023-05-12 09:22:37',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `email_verified_at`, `password`, `phone`, `avatar`, `user_type`, `status`, `is_approved`, `is_admin`, `is_online`, `last_activity`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', NULL, '$2y$10$43JZNkZ8DbS52vdSh3blb.wmdc.5GO2y9mTYVT3k0d8kUo4t6ZXTq', NULL, 'default.png', 1, 1, 1, 1, 0, '2023-05-12 09:22:37', NULL, '2023-05-12 09:24:08', '2023-05-12 09:24:08');

-- --------------------------------------------------------

--
-- Table structure for table `website_infos`
--

CREATE TABLE `website_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `websitename` varchar(255) DEFAULT NULL,
  `logo` varchar(255) NOT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `copyright` varchar(255) DEFAULT NULL,
  `disclaimer` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admins_roleid_foreign` (`roleId`),
  ADD KEY `admins_user_id_foreign` (`user_id`);

--
-- Indexes for table `admin_contacts`
--
ALTER TABLE `admin_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `agents_username_unique` (`username`),
  ADD KEY `agents_user_id_foreign` (`user_id`);

--
-- Indexes for table `agent_contacts`
--
ALTER TABLE `agent_contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agent_contacts_agentid_foreign` (`agentId`);

--
-- Indexes for table `amenity_types`
--
ALTER TABLE `amenity_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buyers`
--
ALTER TABLE `buyers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buyers_user_id_foreign` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_commenter_id_commenter_type_index` (`commenter_id`,`commenter_type`),
  ADD KEY `comments_commentable_type_commentable_id_index` (`commentable_type`,`commentable_id`),
  ADD KEY `comments_child_id_foreign` (`child_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `garage_types`
--
ALTER TABLE `garage_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `help_desks`
--
ALTER TABLE `help_desks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `help_desk_details`
--
ALTER TABLE `help_desk_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `help_desk_details_helpdeskid_foreign` (`helpDeskId`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `market_activities`
--
ALTER TABLE `market_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_user_id_foreign` (`user_id`),
  ADD KEY `messages_receiver_foreign` (`receiver`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `neighbors`
--
ALTER TABLE `neighbors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `neighbors_categoryid_foreign` (`categoryId`);

--
-- Indexes for table `neighbour_categories`
--
ALTER TABLE `neighbour_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `neighbour_messages`
--
ALTER TABLE `neighbour_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ore_gons`
--
ALTER TABLE `ore_gons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `properties_agentid_foreign` (`agentId`),
  ADD KEY `properties_adminid_foreign` (`adminId`),
  ADD KEY `properties_buyerid_foreign` (`buyerId`),
  ADD KEY `properties_sellerid_foreign` (`sellerId`),
  ADD KEY `properties_typeid_foreign` (`typeId`),
  ADD KEY `properties_garagetypeid_foreign` (`garageTypeId`);

--
-- Indexes for table `property_addresses`
--
ALTER TABLE `property_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_addresses_propertyid_foreign` (`propertyId`),
  ADD KEY `property_addresses_countryid_foreign` (`countryId`),
  ADD KEY `property_addresses_cityid_foreign` (`cityId`),
  ADD KEY `property_addresses_stateid_foreign` (`stateId`);

--
-- Indexes for table `property_amenities`
--
ALTER TABLE `property_amenities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_amenities_propertyid_foreign` (`propertyId`),
  ADD KEY `property_amenities_amenityid_foreign` (`amenityId`);

--
-- Indexes for table `property_categories`
--
ALTER TABLE `property_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_categories_propertyid_foreign` (`propertyId`),
  ADD KEY `property_categories_categoryid_foreign` (`categoryId`);

--
-- Indexes for table `property_details`
--
ALTER TABLE `property_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_details_propertyid_foreign` (`propertyId`);

--
-- Indexes for table `property_images`
--
ALTER TABLE `property_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_images_propertyid_foreign` (`propertyId`);

--
-- Indexes for table `property_messages`
--
ALTER TABLE `property_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_messages_user_id_foreign` (`user_id`),
  ADD KEY `property_messages_property_id_foreign` (`property_id`);

--
-- Indexes for table `property_types`
--
ALTER TABLE `property_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resoapi_properties`
--
ALTER TABLE `resoapi_properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sellers_user_id_foreign` (`user_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_errors`
--
ALTER TABLE `system_errors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_logs`
--
ALTER TABLE `system_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transections`
--
ALTER TABLE `transections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transections_transaction_id_unique` (`transaction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `website_infos`
--
ALTER TABLE `website_infos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_contacts`
--
ALTER TABLE `admin_contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agent_contacts`
--
ALTER TABLE `agent_contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `amenity_types`
--
ALTER TABLE `amenity_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buyers`
--
ALTER TABLE `buyers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `downloads`
--
ALTER TABLE `downloads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `garage_types`
--
ALTER TABLE `garage_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `help_desks`
--
ALTER TABLE `help_desks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `help_desk_details`
--
ALTER TABLE `help_desk_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `market_activities`
--
ALTER TABLE `market_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `neighbors`
--
ALTER TABLE `neighbors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `neighbour_categories`
--
ALTER TABLE `neighbour_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `neighbour_messages`
--
ALTER TABLE `neighbour_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ore_gons`
--
ALTER TABLE `ore_gons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_addresses`
--
ALTER TABLE `property_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_amenities`
--
ALTER TABLE `property_amenities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_categories`
--
ALTER TABLE `property_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_details`
--
ALTER TABLE `property_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_images`
--
ALTER TABLE `property_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_messages`
--
ALTER TABLE `property_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_types`
--
ALTER TABLE `property_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resoapi_properties`
--
ALTER TABLE `resoapi_properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_errors`
--
ALTER TABLE `system_errors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `system_logs`
--
ALTER TABLE `system_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transections`
--
ALTER TABLE `transections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `website_infos`
--
ALTER TABLE `website_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_roleid_foreign` FOREIGN KEY (`roleId`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `agents`
--
ALTER TABLE `agents`
  ADD CONSTRAINT `agents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `agent_contacts`
--
ALTER TABLE `agent_contacts`
  ADD CONSTRAINT `agent_contacts_agentid_foreign` FOREIGN KEY (`agentId`) REFERENCES `agents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `buyers`
--
ALTER TABLE `buyers`
  ADD CONSTRAINT `buyers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_child_id_foreign` FOREIGN KEY (`child_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `help_desk_details`
--
ALTER TABLE `help_desk_details`
  ADD CONSTRAINT `help_desk_details_helpdeskid_foreign` FOREIGN KEY (`helpDeskId`) REFERENCES `help_desks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_receiver_foreign` FOREIGN KEY (`receiver`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `neighbors`
--
ALTER TABLE `neighbors`
  ADD CONSTRAINT `neighbors_categoryid_foreign` FOREIGN KEY (`categoryId`) REFERENCES `neighbour_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_adminid_foreign` FOREIGN KEY (`adminId`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `properties_agentid_foreign` FOREIGN KEY (`agentId`) REFERENCES `agents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `properties_buyerid_foreign` FOREIGN KEY (`buyerId`) REFERENCES `buyers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `properties_garagetypeid_foreign` FOREIGN KEY (`garageTypeId`) REFERENCES `garage_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `properties_sellerid_foreign` FOREIGN KEY (`sellerId`) REFERENCES `sellers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `properties_typeid_foreign` FOREIGN KEY (`typeId`) REFERENCES `property_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `property_addresses`
--
ALTER TABLE `property_addresses`
  ADD CONSTRAINT `property_addresses_cityid_foreign` FOREIGN KEY (`cityId`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `property_addresses_countryid_foreign` FOREIGN KEY (`countryId`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `property_addresses_propertyid_foreign` FOREIGN KEY (`propertyId`) REFERENCES `properties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `property_addresses_stateid_foreign` FOREIGN KEY (`stateId`) REFERENCES `states` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `property_amenities`
--
ALTER TABLE `property_amenities`
  ADD CONSTRAINT `property_amenities_amenityid_foreign` FOREIGN KEY (`amenityId`) REFERENCES `amenity_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `property_amenities_propertyid_foreign` FOREIGN KEY (`propertyId`) REFERENCES `properties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `property_categories`
--
ALTER TABLE `property_categories`
  ADD CONSTRAINT `property_categories_categoryid_foreign` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `property_categories_propertyid_foreign` FOREIGN KEY (`propertyId`) REFERENCES `properties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `property_details`
--
ALTER TABLE `property_details`
  ADD CONSTRAINT `property_details_propertyid_foreign` FOREIGN KEY (`propertyId`) REFERENCES `properties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `property_images`
--
ALTER TABLE `property_images`
  ADD CONSTRAINT `property_images_propertyid_foreign` FOREIGN KEY (`propertyId`) REFERENCES `properties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `property_messages`
--
ALTER TABLE `property_messages`
  ADD CONSTRAINT `property_messages_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `property_messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sellers`
--
ALTER TABLE `sellers`
  ADD CONSTRAINT `sellers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
