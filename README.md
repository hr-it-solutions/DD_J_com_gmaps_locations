# DD_J_com_gmaps_locations
An extendable Joomla! component for integrating Google Maps Locations.
Location entries, location profile pages, location search, geolocation distance search, Google Maps module, customization options, etc… More than just maps: A reliable extension for building your own plattform or community based on Google Maps.

[![GPL Licence](https://badges.frapsoft.com/os/gpl/gpl.png?v=102)](https://opensource.org/licenses/GPL-2.0/)  

### Main Features / Backend Features:
- Simple location management by filterable backend tables
- Different field types for various locations
- Integration of the Joomla Media Manager, linking locations with images
- Validate addresses via the backend (geocoding of the address)
- Address validation for more than 250 countries
- Multilingual (actual en-GB and de-DE, more languages can be easily implemented via language files or language overrides)
- Categories for locations (integrated Joomla Category component)
- Google Maps v3 integration (API key connection possible) Integrated Google JavaScript API, Geolocation API, Geocoding API and Distance Matrix API
- Custom CSS, mobile ready and responsive
- Support all major web browsers

### Frontend Features:
- Location directory with detailed information and profile pages
- Profile pages linked to the map (markers and info boxes)
- Search and filter locations
- Distance display (miles or kilometers)
- AJAX „load more“

##### Profile pages for individual map locations
- Profile details
- Highlight options and custom category labels
- DD Improved Hits Counter (one view per IP-address per day)
- Customize URL alias
- Linked to the map

**and much more...**

### Addon Modules:
Build your plattform which meets to your needs. The component can be extended by various modules. (e.g. place locations on a map separate from the location register or place a search field on your website that is directly linked to the component.)

##### [GMaps Loctaions Search Filter](https://github.com/hr-it-solutions/DD_J_mod_gmaps_locations_searchfilter)
- Geolocalisation function
- Google search suggestions
- Location category filter

##### [GMaps Module](https://github.com/hr-it-solutions/DD_J_mod_gmaps_module)
- Map in Popup (full size PopUp)
- Customizable markers, cluster markers and info box (PopUp by click on map)
- Adjustable map size, position and zoom level

*Further modules on request!*

### Addon Plugins:
The function of the component can be also extended by various plugins, which can provide huge functions. (e.g. connect Joomla user profiles to the map or place a activity stream at that pages to build your own maps community.)

##### [Features for 3rd Party extensions - Ect C Connector](https://github.com/hr-it-solutions/DD_J_com_gmaps_locations#addon-plugins)
- Connect any extension like (com_content, com_k2, com_seblod etc..) or any custom extensin which follows the Joomla routing system.

**Note:** This requires the DD GMaps Locations Component and a DD_GMaps_Locations_ext_c System Plugin for the extension to connect. Ext C Plugins can be available at our github account for some 3rd party extensions we have already connected or if not available, a plugin for your extension can be mostly provided on paid request. <br>
**Note:** 3rd Party connect is BETA and experimental, we can just provide the plugins (Suggested for developers), support on paid request via https://www.hr-it-solutions.com/en/contact

*Further plugins on request!*

Errors and technical modification subject to change.

> It has been developed with :green_heart: for Joomla Extension-/ Templatedevelopers. So it is just based on the nativ Joomla MVC Pattern.
> And it comes just with a minimal bootstrap design (but not required) to make it easy to extend, customizeable and itegrateable for your projects.
> The Software is licensenced under the GPLv2 only Permissions, so feel free for Commercial Use, Modification, Distribution as well as Private Use.

---
**Note: This is just the component repository (com_gmaps_locations).**

**To get the component package, including required system plugins and required modules, you need the component package installer compilation. [https://github.com/hr-it-solutions/DD_J_pkg_gmaps_locations_package](https://github.com/hr-it-solutions/DD_J_pkg_gmaps_locations_package)**

**The [Component package](https://github.com/hr-it-solutions/DD_J_pkg_gmaps_locations_package) installer compilation contains:**

- com_gmaps_locations [GMaps Loctaions](https://github.com/hr-it-solutions/DD_J_com_gmaps_locations)
- mod_gmaps_locations_searchfilter [GMaps Loctaions Search Filter](https://github.com/hr-it-solutions/DD_J_mod_gmaps_locations_searchfilter)
- mod_gmaps_module [GMaps Module](https://github.com/hr-it-solutions/DD_J_mod_gmaps_module)
- plg_system_gmaps_locations_geocode [GMaps Locations GeoCode](https://github.com/hr-it-solutions/DD_J_plg_system_gmaps_locations_geocode)

# System requirements
Joomla 3.6 +                                                                                <br>
PHP 5.6.13 or newer is recommended.

# DD_ Namespace
DD_ stands for  **D**idl**d**u e.K. | HR IT-Solutions (Brand recognition)                   <br>
It is a namespace prefix, provided to avoid element name conflicts.

<br>
Author: HR IT-Solutions Florian Häusler https://www.hr-it-solution.com                      <br>
Copyright: (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions                                    <br>
http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
