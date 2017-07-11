-- DD GMAPS LOCATIONS table SQL script
-- This will update all the the tables to run DD GMAPS LOCATIONS

--
-- Table structure for table `#__dd_gmaps_locations`
--

ALTER TABLE `hl2sx_dd_gmaps_locations` CHANGE `latitude` `latitude` decimal(10, 8) NOT NULL DEFAULT '00.00000000';
ALTER TABLE `hl2sx_dd_gmaps_locations` CHANGE `longitude` `longitude` decimal(11, 8) NOT NULL DEFAULT '00.00000000';