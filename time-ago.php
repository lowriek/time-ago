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

General Admission is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

General Admission is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with General Admission. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/
if ( !defined('ABSPATH') ) exit;

// make sure we're not conflicting with another Plugin
if ( ! class_exists('Time_Ago') ) {

  class Time_Ago {
    public function __construct() {
      add_action( 'get_the_date', 'time_ago_format_date', 10, 3 );
    }

    public function time_ago_format_date($the_date, $d, $post) {
      // Get the post id
      if ( is_int( $post) ) {
        $post_id = $post;
      } else {
        $post_id = $post->ID;
      }

      // subtract the post date from the current time
      $date_string = human_time_diff( strtotime($the_date) ) . ' ago';
      // make the string prettier
      $datestring = str_replace('min', 'minute', $date_string);

      return $date_string;
    } // end of time_ago_date_format
  } // end of class
} // end of if ( ! class_exists('Time_Ago') )
$Time_Ago = new Time_Ago();
