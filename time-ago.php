<?php
/*
Plugin Name:  Time Ago
Plugin URI:   https://4thwall.io
Description:  Simple WordPress Plugin changes the date format on posts and pages.
Version:      1.0
Author:       4th Wall Websites
Author URI:   https://4thwall.io
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  wporg
Domain Path:  /languages

Time Ago is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Time Ago is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Time Ago. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/
if ( !defined('ABSPATH') ) exit;

require_once plugin_dir_path(__FILE__) . 'admin/time-ago-settings.php';
require_once plugin_dir_path(__FILE__) . 'includes/time-ago-class.php';


$Time_Ago = new Time_Ago(); // run it!
$Time_Ago->settings = new Time_Ago_Settings(); // add settings
