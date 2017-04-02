-- DD GMAPS LOCATIONS table SQL script
-- This will install all the the tables to run DD GMAPS LOCATIONS

--
-- Table structure for table `#__dd_gmaps_locations`
--

CREATE TABLE IF NOT EXISTS `#__dd_gmaps_locations` (
  `id` int(11) unsigned NOT NULL,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `catid` int(11) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '0',

  `profileimage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `contact_person` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `fax` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,

  `street` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `federalstate` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,

  `latitude` float(10,6) NOT NULL DEFAULT '255.000000',
  `longitude` float(10,6) NOT NULL DEFAULT '255.000000',

  `description` text COLLATE utf8mb4_unicode_ci,
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,

  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',

  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access` int(11) NOT NULL DEFAULT '1',
  `language` char(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  `metakey` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `metadesc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `params` text COLLATE utf8mb4_unicode_ci NOT NULL,

  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for table `#__dd_gmaps_locations`
--
ALTER TABLE `#__dd_gmaps_locations`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `#__dd_gmaps_locations`
--
ALTER TABLE `#__dd_gmaps_locations`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;


--
-- Sample data for table `#__dd_gmaps_locations`
--
INSERT INTO `#__dd_gmaps_locations` (`title`, `alias`, `catid`, `state`, `profileimage`, `image`, `company`, `contact_person`, `phone`, `mobile`, `fax`, `email`, `url`, `street`, `location`, `zip`, `country`, `federalstate`, `latitude`, `longitude`, `description`, `short_description`, `publish_up`, `publish_down`, `checked_out`, `checked_out_time`, `access`, `language`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `metakey`, `metadesc`, `params`, `featured`) VALUES
('Champ de Mars', 'toureiffel-paris', 0, 1, '', '/media/com_dd_gmaps_locations/img/dummy_img.png', 'Champ de Mars', '', '0033 00 00 00 00', '0033 00 00 00 00', '', '', '', 'Avenue Anatole 5', 'Paris', '75007 ', 'COM_DD_GMAPS_LOCATIONS_COUNTRY_NAME_FRANCE', '', 48.858887, 2.294486, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, '', '0000-00-00 00:00:00', 0, '', '0000-00-00 00:00:00', 0, '', '', '', 1),
('Brandenburger Tor', 'brandenburger-tor', 0, 1, '', '/media/com_dd_gmaps_locations/img/dummy_img.png', '', '', '0049 00 00 00', '0049 00 00 00', '', '', '', 'Pariser Platz', 'Berlin', '10117', 'COM_DD_GMAPS_LOCATIONS_COUNTRY_NAME_GERMANY', 'Berlin', 52.515858, 13.378428, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, '', '0000-00-00 00:00:00', 0, '', '0000-00-00 00:00:00', 0, '', '', '', 1),
('Tower of London', 'tower-of-london', 0, 1, '', '/media/com_dd_gmaps_locations/img/dummy_img.png', '', '', '0044 000 000 000', '', '', '', '', 'St Katharine''s & Wapping', 'London', 'EC3N', 'COM_DD_GMAPS_LOCATIONS_COUNTRY_NAME_UNITEDKINGDOM', '', 51.510384, -0.077027, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. ', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, '', '0000-00-00 00:00:00', 0, '', '0000-00-00 00:00:00', 0, '', '', '', 1),
('Vasa Museum', 'vasa-museum', 0, 1, '', '/media/com_dd_gmaps_locations/img/dummy_img.png', '', '', '0046 000 000 000', '', '', '', '', 'Galärvarvsvägen 14', 'Stockholm', '11521', 'COM_DD_GMAPS_LOCATIONS_COUNTRY_NAME_SWEDEN', '', 59.328262, 18.091682, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, '', '0000-00-00 00:00:00', 0, '', '0000-00-00 00:00:00', 0, '', '', '', 1);


--
-- Table structure for table `#__dd_gmaps_locations_iptables`
--

CREATE TABLE IF NOT EXISTS `#__dd_gmaps_locations_iptables` (
  `profile_id` int(11) NOT NULL,
  `visitor_ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;