<?php


if ( !defined('ABSPATH') ) exit;


class Time_Ago {
  public $settings;

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
