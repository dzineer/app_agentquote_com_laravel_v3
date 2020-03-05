--
    -- Table structure for table `categories_insurance`
    --
        -- REFERENCES categories(cat_id)
CREATE TABLE `categories_insurance` (
    `category_id` int(10) UNSIGNED NOT NULL,
    FOREIGN KEY fk_carrier_id(carrier_id),
    REFERENCES carriers(carrier_id),
    `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ON UPDATE CASCADE
ON DELETE RESTRICT


ALTER TABLE `carrier_guides`
ADD KEY `fk_category` (`category_id`);


ALTER TABLE `carrier_guides` ADD FOREIGN KEY (`category_id`) REFERENCES `categories_insurance` (`category_id`)



←
 phpMyAdmin
HomeLog outphpMyAdmin documentationDocumentationNavigation panel settingsReload navigation panel
RecentFavorites
Collapse allUnlink from main panel
New
Expand/CollapseDatabase operationsapp_subscriptions
Expand/Collapse
 aq2e
Database operationsaqdb1
Type to filter these, Enter to search all
X
NewNew
Expand/CollapseStructureaccount_quote
Expand/CollapseStructureaffiliates
Expand/CollapseStructureaffiliate_coupon
Expand/CollapseStructureaffiliate_types
Expand/CollapseStructureaffiliate_type_users
Expand/CollapseStructureaffiliate_user
Expand/CollapseStructurebilling_coupons
Expand/CollapseStructurecard_subscriptions
Structurecarriers

Columns Columns
NewNew
Columnactive
Columncompany_id
Columnid
Columnlink1
Columnlink2
Columnname
Expand/Collapse
Indexes Indexes
Expand/CollapseStructurecarriers_categories
Expand/CollapseStructurecarriers_category_users
Expand/CollapseStructurecarriers_sit
Expand/CollapseStructurecarriers_siwl
Expand/CollapseStructurecarrier_guides
Structurecarrier_guides_2

Columns Columns
NewNew
Columncategory
Columncompany_id
Columncreated_at
Columnid
Columnname
Columnpreferred
Columnproduct
Columnthumbnail
Columnupdated_at
Columnurl
Expand/Collapse
Indexes Indexes
Structurecategories_insurance

Columns Columns
NewNew
Columncategory_id
Columncreated_at
Columnname
Columnupdated_at
Expand/Collapse
Indexes Indexes
Expand/CollapseStructurecolors_user
Expand/CollapseStructurecontacts_user
Expand/CollapseStructurecustomer_user
Expand/CollapseStructurefeatures_users
Expand/CollapseStructuregroups
Expand/CollapseStructuregroup_user
Expand/CollapseStructureinvoice_item_user
Expand/CollapseStructureinvoice_user
Expand/CollapseStructureleads_user
Expand/CollapseStructuremessages_user
Expand/CollapseStructuremicrosites
Expand/CollapseStructuremigrations
Expand/CollapseStructureotp_users
Expand/CollapseStructurepassword_resets
Expand/CollapseStructureplan_subscriptions
Expand/CollapseStructureprofile_user
Expand/CollapseStructurequotes_user
Expand/CollapseStructureroles
Expand/CollapseStructurerole_user
Expand/CollapseStructuresessions
Expand/CollapseStructuresubdomains
Expand/CollapseStructuresubscription_user
Expand/CollapseStructuresupport_videos
Expand/CollapseStructuretheme_user
Expand/CollapseStructureusers
Expand/CollapseDatabase operationscrud_1
Expand/CollapseDatabase operationsdzineer_notes
Expand/Collapse
 fd3marketing
Expand/CollapseDatabase operationsfd3_marketing_platform
Expand/CollapseDatabase operationshomestead
Expand/CollapseDatabase operationsinformation_schema
Expand/Collapse
 ins
Expand/CollapseDatabase operationsjoomla
Expand/CollapseDatabase operationslaravel-rest-api
Expand/CollapseDatabase operationslaravel1
Expand/CollapseDatabase operationslaravel_react_v1
Expand/CollapseDatabase operationsmlq_f
Expand/CollapseDatabase operationsmysql
Expand/CollapseDatabase operationsmy_name
Expand/CollapseDatabase operationsn
Expand/CollapseDatabase operationsnn
Expand/CollapseDatabase operationsperformance_schema
Expand/CollapseDatabase operationspmanager
Expand/CollapseDatabase operationsprototype
Expand/CollapseDatabase operationsprototyping
Expand/CollapseDatabase operationsreactjs
Expand/CollapseDatabase operationssys
Expand/CollapseDatabase operationswordpress
Expand/CollapseDatabase operationswpdp
Server: 127.0.0.1 »Database: aqdb1 »Table: carrier_guides
Browse Browse
Structure Structure
SQL SQL
Search Search
Insert Insert
Export Export
Import Import
Privileges Privileges
Operations Operations
Triggers Triggers
Click on the bar to scroll to top of page
SQL Query Console Console
ascending descending Order: Debug SQL Execution order Time taken Order by: Group queries
Some error occurred while getting SQL debug info.
Options Set default
 Always expand query messages
 Show query history at start
 Show current browsing query
  Execute queries on Enter and insert new line with Shift + Enter. To make this permanent, view settings.
 Switch to dark theme

[ Back ][ Refresh ]
-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2019 at 07:55 AM
-- Server version: 5.7.23
-- PHP Version: 7.1.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `aqdb1`
--

-- --------------------------------------------------------

--
-- Table structure for table `carrier_guides`
--

CREATE TABLE `carrier_guides` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `product` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preferred` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carrier_guides`
--

INSERT INTO `carrier_guides` (`id`, `company_id`, `name`, `url`, `thumbnail`, `category_id`, `product`, `preferred`, `created_at`, `updated_at`) VALUES
(3, 1, 'Guide1', 'https://underwritten1', NULL, 1, 'Term Simple', 0, '2019-02-24 17:00:00', '2019-02-24 17:00:00'),
(4, 1, 'Guide2', 'https://underwritten2', NULL, 1, 'Term Simple', 0, '2019-02-24 17:00:00', '2019-02-24 17:00:00'),
(5, 1, 'Guide3', 'https://sit_1', NULL, 2, 'SI Term Simple', 0, '2019-02-24 17:00:00', '2019-02-24 17:00:00'),
(6, 1, 'Guide4', 'https://sit_2', NULL, 2, 'SI Term Simple', 0, '2019-02-24 17:00:00', '2019-02-24 17:00:00'),
(7, 4, 'Guide1a', 'https://underwritten1', NULL, 1, 'AG Term Simple', 0, '2019-02-24 17:00:00', '2019-02-24 17:00:00'),
(8, 4, 'Guide2a', 'https://underwritten2', NULL, 1, 'AG Term Simple', 0, '2019-02-24 17:00:00', '2019-02-24 17:00:00'),
(9, 4, 'Guide3a', 'https://sit_1', NULL, 2, 'AG SI Term Simple', 0, '2019-02-24 17:00:00', '2019-02-24 17:00:00'),
(10, 4, 'Guide4a', 'https://sit_2', NULL, 2, 'AG SI Term Simple', 0, '2019-02-24 17:00:00', '2019-02-24 17:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carrier_guides`
--
ALTER TABLE `carrier_guides`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_carrier` (`company_id`),
  ADD KEY `fk_category` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carrier_guides`
--
ALTER TABLE `carrier_guides`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carrier_guides`
--
ALTER TABLE `carrier_guides`
  ADD CONSTRAINT `carrier_guides_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `carriers` (`company_id`);
COMMIT;


[ Back ][ Refresh ]
Open new phpMyAdmin window







ALTER TABLE `carrier_guides`
  ADD KEY `fk_category` (`category_id`)

  ALTER TABLE `carrier_guides`
  ADD FOREIGN KEY (`company_id`) REFERENCES `categories_insurance` (`category_id`);\




CREATE TABLE `carrier_guides` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `product` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preferred` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carrier_guides`
--
ALTER TABLE `carrier_guides`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_carrier` (`company_id`),
  ADD KEY `fk_category` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carrier_guides`
--
ALTER TABLE `carrier_guides`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carrier_guides`
--
ALTER TABLE `carrier_guides`
  ADD FOREIGN KEY (`company_id`) REFERENCES `carriers` (`company_id`),
  ADD FOREIGN KEY (`category_id`) REFERENCES `categories_insurance` (`category_id`);
