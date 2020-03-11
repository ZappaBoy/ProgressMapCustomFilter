<?php
/**
 * Plugin Name: Better Event Calendar
 * Plugin URI: https://molise-italia.it
 * Description: Show custom calendar with Event Manager
 * Version: 1.0
 * Author: Molise Italia
 * Author URI: https://molise-italia.it
 */

function enq_script_for_calendar() {
    //load script to handle calendar
    wp_enqueue_script('calendar_script', "https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.js", array('jquery'), null, true);
    wp_enqueue_script('calendar_daygrid_script', "https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.min.js", array('jquery'), null, true);
    wp_enqueue_style('calendar_style', "https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.css");
    wp_enqueue_style('calendar_daygrid_style', "https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.min.css");

    if( get_the_permalink() == get_site_url(). "/eventi/") {
        wp_enqueue_script( 'event-custom-date', plugin_dir_url(__FILE__) . "/script/custom-date.js", array('jquery'), null, true);
    }
}
// Add the functions to WP loading list.
add_action( 'wp_enqueue_scripts', 'enq_script_for_calendar' );




add_shortcode("better-calendar", "show_better_calendar" );
function show_better_calendar() {
    $events = EM_Events::get( array('orderby'=>'name'));

    $cos = array();
    if(count($events) > 0) {
        foreach ($events as $event) {
            array_push($cos, array(
                'title'   => get_the_title($event->post_id),
                'start' => $event->event_start_date,
                'end' => $event->event_end_date,
                'url' => get_permalink($event->post_id)
            ));
        }
    }

    $output = "<div id='calendar'></div>";

    wp_enqueue_script('better_calendar_jquery_script', plugin_dir_url(__FILE__) . "/script/better_calendar.js", array('jquery'), null, true);

    wp_enqueue_style( 'better_calendar_style', plugin_dir_url(__FILE__) . "/css/better_calendar.css" );

    wp_localize_script( 'better_calendar_jquery_script', 'event_json', $cos );
    return $output;
}

add_shortcode("better-count-down", "show_count_down" );
function show_count_down() {
    $events = EM_Events::get( array('orderby'=>'event_start_date', 'limit' => 4));

    $output = '';
    if(count($events) > 0) {
        foreach ($events as $event) {
            $output.= do_shortcode('[fusion_countdown countdown_end="'.$event->event_start_date . ' '.$event->event_start_time.'" timezone="" show_weeks="" border_radius="" heading_text="'.$event->event_name.'" subheading_text="" link_url="'.get_permalink($event->post_id).'" link_text="Vai all\'evento" link_target="_blank" hide_on_mobile="small-visibility,medium-visibility,large-visibility" class="" id="" background_color="" background_image="'.get_the_post_thumbnail_url($event->post_id, 'full').'" background_position="" background_repeat="" counter_box_color="" counter_text_color="" heading_text_color="" subheading_text_color="" link_text_color="" /]');
        }
    }
    return $output;
}
