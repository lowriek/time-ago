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

// make sure we're not conflicting with another Plugin
if ( ! class_exists('Time_Ago') ) {

  class Time_Ago {
    public function __construct() {
      // add 'format date' action
      add_action( 'get_the_date', array ($this, 'time_ago_format_date'), 10, 3 );
    }


    // the meat of the plugin. Reformat the post date
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

$Time_Ago = new Time_Ago(); // run it!

class Time_Ago_Settings {
  public function __construct(){
    // add Time Ago Settings submenu
    add_action( 'admin_menu', array( $this , 'time_ago_settings_menu' ) );
    add_action( 'admin_init', array( $this , 'time_ago_register_settings' ) );

  }



  public function time_ago_register_settings() {
    register_setting(
      'time_ago_options',
      'time_ago_options',
      array( $this , 'time_ago_validate_options' )
    );

    add_settings_field(
      'time_ago_default',
      'Time Ago Original Display',
      array( $this , 'time_ago_settings_callback' ),
      'time_ago',
      'default',
      array('id' => 'time_ago_default', 'label' => 'Choose the default Time Ago format')
    );
  }

  public function time_ago_settings_callback($args) {
    echo "checkboxes go here";
  }

  public function time_ago_validate_options($input) {
    return $input;
  }

  // this makes the submenu page in the dashboard
  public function time_ago_settings_menu() {
    add_submenu_page(
        'options-general.php',
        'Time Ago Options',
        'Time Ago',
        'manage_options',
        'time_ago',
        array($this, 'time_ago_settings_page_html')
    );
  }

  // the form on the submenu page in the dashboard (which time_ago_settings_menu created)
  public function time_ago_settings_page_html() {
    // check user capabilities
    if ( ! current_user_can('manage_options') ) return 'insufficient privileges';
    ?>
    <div class="wrap">
        <h1><?= esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            // output security fields for the registered setting "wporg_options"
            settings_fields('time_ago_options');
            // output setting sections and their fields
            // (sections are registered for "wporg", each field is registered to a specific section)
            do_settings_sections('time_ago');
            // output save settings button
            submit_button('Save Settings');
            ?>
        </form>
    </div>
    <?php
  }
}
$Time_Ago_settings = new Time_Ago_Settings();
