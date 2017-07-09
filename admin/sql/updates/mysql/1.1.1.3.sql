-- DD GMAPS LOCATIONS table SQL script
-- This will update all the the tables to run DD GMAPS LOCATIONS

--
-- Table structure for table `#__dd_gmaps_locations`
--

ALTER TABLE `#__dd_gmaps_locations` ADD `ll_c` tinyint(1) unsigned NOT NULL DEFAULT '1' AFTER `longitude`;