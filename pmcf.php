<?php
/**
 * Plugin Name: Progress Map Custom Filter
 * Plugin URI: https://molise-italia.it
 * Description: Show custom posts with Progress Map
 * Version: 1.0
 * Author: Molise Italia
 * Author URI: https://molise-italia.it
 */

//require_once plugin_dir_path( __FILE__ ) . "Phpml/Clustering/KMeans.php";
//require_once plugin_dir_path( __FILE__ ) . "Phpml/Clustering/Clusterer.php";
//require_once plugin_dir_path( __FILE__ ) . "Phpml\Exception\InvalidArgumentException.php";

use Clustering\KMeans;
require_once plugin_dir_path( __FILE__ ) . "Clustering/KMeans.php";

function enq_scripts() {
    //load script to handle form
    wp_enqueue_script('pmcf_jquery_script', plugin_dir_url(__FILE__) . "/script/main.js", array('jquery'), null, false);

    //load script and style to handle datepicker
    wp_enqueue_script('flatpickr_script', "https://cdn.jsdelivr.net/npm/flatpickr", array('jquery'), null, false);

    //load script to handle redirect
    wp_enqueue_script('redirect_script', "https://cdn.jsdelivr.net/npm/jquery.redirect@1.1.4/jquery.redirect.min.js", array('jquery'), null, true);

    //load style to customize form
    wp_enqueue_style( 'pmcf_style', plugin_dir_url(__FILE__) . "/css/style.css" );
    wp_enqueue_style('flatpickr_style', "https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css");
}

function enq_script_for_itinerario() {
    wp_enqueue_script('pmcf__itinerario_jquery_script', plugin_dir_url(__FILE__) . "/script/itinerario.js", array('jquery'), null, false);
    wp_enqueue_style( 'pmcf_itinerario_style', plugin_dir_url(__FILE__) . "/css/itinerario.css" );
}

// Add the functions to WP loading list.
add_action( 'wp_enqueue_scripts', 'enq_scripts' );

// Add the functions to WP loading list.
add_action( 'wp_enqueue_scripts', 'enq_script_for_itinerario' );

add_shortcode("pmcf_search_itineraries", "pmcf_show_form" );
if( !function_exists("pmcf_show_form")) {
    function pmcf_show_form($attr) {

        //load current language from polylang plugin if installed
        $lang = function_exists("pll_current_language")? pll_current_language() : "it"; //it, en, fr

        switch($lang) {
            case "it":
                echo '
                <div class="testbox">
                    <form class="bot-question-form">
                        <div class="question-1">
                            <h4>Qual è il tuo viaggio ideale?</h4>
                            <div class="question-answer">
                                <button class="answer1" type="button">Immerso tra archeologia, arte e storia(archeologia, arte e storia)</button>
                                <button class="answer2" type="button">Tra sole, spiagge e coste mozzafiato (il mare)</button>
                                <button class="answer3" type="button">In una baita in montagna (la montagna)</button>
                            </div>
                        </div>
                        <div class="question-2">
                            <h4>Cosa porti sempre con te?</h4>
                            <div class="question-answer">
                                <button class="answer1" type="button">Scarpe da trekking, zaino e macchina fotografica (vacanze nella natura)</button>
                                <button class="answer2" type="button">Guida storica dei posti, penna e taccuino (paesi e culture)</button>
                                <button class="answer3" type="button">Accappatoio, olio per massaggi e Sali da bagno (benessere)</button>
                
                                <button class="previews-question" type="button"><i class="fas fa-long-arrow-alt-left"></i>Torna alla domanda precedente</button>
                            </div>
                        </div>
                        <div class="question-3">
                            <h4>In un break cosa ti piacerebbe?</h4>
                            <div class="question-answer">
                                <button class="answer1" type="button">Un cocktail su una spiaggia mozzafiato (il mare)</button>
                                <button class="answer2" type="button">Un calice di vino in un borgo caratteristico(paesi e culture)</button>
                                <button class="answer3" type="button">Degustazione di prodotti locali e unici (i sapori)</button>
                
                                <button class="previews-question" type="button"><i class="fas fa-long-arrow-alt-left"></i>Torna alla domanda precedente</button>
                            </div>
                        </div>
                        <div class="question-4">
                            <h4>Cosa ti farebbe più emozionare?</h4>
                            <div class="question-answer">
                                <button class="answer1" type="button">La storia di un luogo (archeologia...)</button>
                                <button class="answer2" type="button">La natura che ti circonda(vacanze nella natura)</button>
                                <button class="answer3" type="button">La scoperta delle tradizioni(le tradizioni)</button>
                
                                <button class="previews-question" type="button"><i class="fas fa-long-arrow-alt-left"></i>Torna alla domanda precedente</button>
                            </div>
                        </div>
                        <div class="question-5">
                            <h4>Che attività ti piacerebbe fare?</h4>
                            <div class="question-answer">
                                <button class="answer1" type="button">Sci, passeggiate in montagna e all\'aria aperta (la montagna)</button>
                                <button class="answer2" type="button">Rilassarti in una spa da sogno(benessere)</button>
                                <button class="answer3" type="button">Assaporare prodotti unici e scoprirne la storia(le tradizioni , i sapori)</button>
                
                                <button class="previews-question" type="button"><i class="fas fa-long-arrow-alt-left"></i>Torna alla domanda precedente</button>
                            </div>
                        </div>
                        <div class="question-6">
                            <h4>Quale di queste immagini rappresenta più ciò che vuoi da una vacanza?</h4>
                            <div class="question-answer">
                                <button class="answer1" type="button">immagine mare</button>
                                <button class="answer2" type="button">immagine montagna</button>
                                <button class="answer3" type="button">immagine archeologia, arte e storia</button>
                                <button class="answer4" type="button">immagine vacanze nella natura</button>
                                <button class="answer5" type="button">immagine paesi e culture, tradizioni, i sapori (l\'immagine è una ma comprende tutte e 3 le categorie perché sono molto simili)</button>
                
                                <button class="previews-question" type="button"><i class="fas fa-long-arrow-alt-left"></i>Torna alla domanda precedente</button>
                            </div>
                        </div>
                        <div class="question-7">
                            <h4>Sai che giorni verrai qui?</h4>
                            <div class="question-answer">
                                <button class="answer1" type="button">Si</button>
                                <button class="answer2" type="button">No</button>
                
                                <button class="previews-question" type="button"><i class="fas fa-long-arrow-alt-left"></i>Torna alla domanda precedente</button>
                            </div>
                        </div>
                
                        <div class="question-8">
                            <div class="question-answer">
                                <input class="date-range-picker" type="text" placeholder="Select Date.." readonly="readonly"/>
                
                                <button class="answer1" type="button">Conferma</button>
                                <p class="date-error">Hai selezionato un intervallo temporale troppo ampio</p>
                                
                                <button class="previews-question" type="button"><i class="fas fa-long-arrow-alt-left"></i>Torna alla domanda precedente</button>
                            </div>
                        </div>
                    </form>
                </div>';
                break;

            case 'en':
                //@TODO translate in english
                break;
            case 'fr':
                //@TODO translate in french
                break;
        }
    }
}

add_shortcode("pmcf_show_itinerary", "pmcf_show_result" );
if( !function_exists("pmcf_show_result")) {
    function pmcf_show_result($attr) {
        /*$ids = htmlspecialchars($_GET['selected_post_ids']);
        $post_to_show = str_replace("-",",", $ids);*/

        $categories_string = htmlspecialchars($_POST['categories']);
        $categories = explode(" | ", $categories_string);

        $days = 0;
        if(isset($_POST['startDate']) && isset($_POST['endDate'])) {
            $start_date = htmlspecialchars($_POST['startDate']);
            $end_date = htmlspecialchars($_POST['endDate']);
            $diff = abs(strtotime($start_date) - strtotime($end_date));
            $days = floor(($diff)/ (60*60*24));
            $days += 1; //the plugin need full days
        }

        $post_to_show = pmcf_process_the_answer($categories, $days);

        $output = '';
        if($days == 0) {
            $output .= '<div class="result"><div class="map-div full">' . do_shortcode('[cspm_route_map post_ids=' . '"' . implode(',', $post_to_show) . '"' . ' travel_mode="DRIVING"]'). '</div></div>';
        } else {
            $output .= '<div class="result">' . get_maps_using_clustering($post_to_show, $days, strtotime($_POST['startDate']), strtotime($_POST['endDate'])) . '</div>';
            //return get_maps_for_days($post_to_show, $days);
        }

        return $output;

        //return do_shortcode('[cspm_main_map id="11431" post_ids=' . '"' . $post_to_show . '"' . ']');
    }
}

function get_maps_using_clustering($post_to_show, $days, $start_date, $end_date){
    //count number of post to get coords
    $num_of_poi = count($post_to_show);

    $coord = array();

    //build dataset of coords
    for($i = 0; $i < $num_of_poi; ++$i) {
        $lat = get_post_meta( $post_to_show[$i], 'codespacing_progress_map_lat');
        $long = get_post_meta( $post_to_show[$i], 'codespacing_progress_map_lng');

        if(!empty($lat) && !empty($long)){
            $coord[$post_to_show[$i]] = array($lat[0], $long[0]);
        }
    }

    // $events = array();
    // if (class_exists('EM_Events')) {
    //     $start_date_formatted_for_event = date("Y-m-d", $start_date);
    //     $end_date_formatted_for_event = date("Y-m-d", $end_date);
    //     $events = EM_Events::get(array('limit' => 20, 'orderby' => 'name', 'scope' => $start_date_formatted_for_event . ',' . $end_date_formatted_for_event));
    // }

    // $events_id = array();
    // foreach ($events as $index => $event){
    //     $events_id[$index] = $event->post_id;

    //     $lat = get_post_meta( $events_id[$index], 'codespacing_progress_map_lat');
    //     $long = get_post_meta( $events_id[$index], 'codespacing_progress_map_lng');

    //     if(!empty($lat) && !empty($long)){
    //         $coord[$events_id[$index]] = array($lat[0], $long[0]);
    //     }
    // }

    // now $coord is an array with labeled with id of post
    try {
        $kmeans = new KMeans($days); //Number of cluster cannot be the same of the days because there are clusters with only once post
        $clusters = $kmeans->cluster($coord); //every cluster contains the ids of post

        // Events not need in clusters
        $events = array();
        if (class_exists('EM_Events')) {
            $start_date_formatted_for_event = date("Y-m-d", $start_date);
            $end_date_formatted_for_event = date("Y-m-d", $end_date);
            $events = EM_Events::get(array('limit' => 20, 'orderby' => 'name', 'scope' => $start_date_formatted_for_event . ',' . $end_date_formatted_for_event));
        }
        ///////

        $output = '';

        $output .= '<div class="days-buttons">';
        for($i = 1; $i<=$days; $i++) {
            $output .= '<button class="button-day-' . $i . '" type="button">' . get_date_transalted($start_date + ($i - 1)*+ (60*60*24)) . '</button>';
        }
        $output .= '</div>';


        $day_counter = 1;
        $output .= '<div class="maps-container">';
        foreach ($clusters as $cluster => $post_ids) {
            $output .= '<div class="item-day">';

            $post_to_show = array();

            $i = 0;
            $output .= '<ol class="info info-day-' . $day_counter . '">';

            /// Added fot events
            if (count($events > 0)){
                $ev_date = $start_date + ($day_counter)*+ (60*60*24);

                $event_coord = array();
                foreach ($events as $index => $event){

                    $lat = get_post_meta( $event->post_id, 'codespacing_progress_map_lat');
                    $long = get_post_meta( $event->post_id, 'codespacing_progress_map_lng');
                    $ev_start_date = strtotime($event->event_start_date);
                    $ev_end_date = strtotime($event->event_end_date);

                    if(!empty($lat) && !empty($long) ){
                        if ($ev_start_date + (60*60*24) <= $ev_date && $ev_end_date + (60*60*24) >= $ev_date ) {
                            $post_ids[$event->post_id] = array($lat[0], $long[0]);
                        }
                    }
                }
            }
            ///////////////////

            foreach ($post_ids as $post_id => $coord) {
                $post_to_show[$i] = $post_id;
                //TODO REMOVE
                $output .= $post_to_show[$i];


                $output .= '<li><a href="' . get_permalink($post_id).'">' . get_the_title($post_id) . ' - ' . htmlspecialchars(get_field('COMUNE', $post_id)) . '</a></li>';
                //$output .= '<li><a href="' . get_permalink($post_id).'">' .  . ' - ' . htmlspecialchars(get_field('COMUNE'), $post_id) . '</a></li>';
                $i++;
            }
            $output .= '</ol>';

            $output .= '<div class="map-div map-day-' . $day_counter . '">';

            $output .= do_shortcode('[cspm_route_map post_ids=' . '"' . implode(',', $post_to_show ). '"' . ' travel_mode="DRIVING"]');
            $output .= '</div>';

            $output .= '</div>';
            $day_counter++;
        }
        $output .= '</div>';

        if(count($events) > 0) {
            $output .= "'<h4>Eventi in questi giorni</h4>";

            foreach ($events as $event) {
                $output.= do_shortcode('[fusion_countdown countdown_end="'.$event->event_start_date . ' '.$event->event_start_time.'" timezone="" show_weeks="" border_radius="" heading_text="'.$event->event_name.'" subheading_text="" link_url="'.get_permalink($event->post_id).'" link_text="Vai all\'evento" link_target="_blank" hide_on_mobile="small-visibility,medium-visibility,large-visibility" class="" id="" background_color="" background_image="'.get_the_post_thumbnail_url($event->post_id, 'full').'" background_position="" background_repeat="" counter_box_color="" counter_text_color="" heading_text_color="" subheading_text_color="" link_text_color="" /]');
            }
        }


        return $output;


    } catch (Clustering\InvalidArgumentException $e) {
        //ignored
        return "Error";
    }
}

function get_maps_for_days($post_to_show, $days) {

    //count number of post to shuffle
    $num_of_poi = count($post_to_show);

    //array of number of post to show every day
    $poi_per_day = array();

    //shuffle the array of posts
    shuffle($post_to_show);

    //pick n random numbers that sum up to m
    $num_of_poi_left = $num_of_poi;
    for($i = 0; $i <$days; ++$i) {
        $random_number = rand(1,(int)(($num_of_poi_left) / ($days - $i)));
        array_push($poi_per_day, $random_number);
        $num_of_poi_left -= $random_number;
    }
    $poi_per_day[$days-1] +=  $num_of_poi_left;


    $post_counter = 0;
    $output = '<div class="maps-container">';
    for($i = 1; $i <=$days; ++$i) {
        $output .= '<div class="day-' . $i . '">';
        $output .= do_shortcode('[cspm_route_map post_ids=' . '"' . implode(',', array_slice($post_to_show, $post_counter, $poi_per_day[$i-1]) ). '"' . ' travel_mode="DRIVING" height="700px" width="1200px"]');
        $output .= '</div>';
        $post_counter += $poi_per_day[$i-1];
    }
    $output .= '</div>';

    return $output;
}

if( !function_exists("pmcf_process_the_answer")) {
    function pmcf_process_the_answer($answers, $days) {

        /**
         * Categories:
         *   Archeologia, arte e storia
         *   Vacanze nella natura
         *   Paesi e culture
         *   Le tradizioni
         *   I sapori
         *   Il mare
         *   La montagna
         *   Benessere
         */

        /**
         * Define categories
         */
        $categories = ["Archeologia, arte e storia", "Vacanze nella natura", "Paesi e culture", "Le tradizioni", "I sapori", "Il mare", "La montagna", "Benessere"];
        //$answers = ["Archeologia, arte e storia", "Vacanze nella natura", "Paesi e culture", "Vacanze nella natura", "Benessere", "Vacanze nella natura"];
        //$days = 4;
        $poi_per_day = 3;

        /**
         * 7 static poi if no day provided
         */
        $poi_to_find = 7;
        $days = intval($days);
        if ($days > 0){
            $poi_to_find = $days * $poi_per_day;
        }
        $poi = new SplFixedArray($poi_to_find);

        /**
         * Init balances
         */
        $balance = new SplFixedArray(sizeof($categories));
        $pos = 0;
        foreach ($categories as $category) {
            $obj = (object) [
                'category' => $category,
                'balance' => 0
            ];
            $balance[$pos] = json_encode($obj);
            $pos++;
        }
        unset($category);

        /**
         * Calculate balances
         */
        foreach ($answers as $value) {
            $pos = array_search($value, (array)$categories);
            $obj = json_decode($balance[$pos]);
            $obj->balance++;
            $balance[$pos] = json_encode($obj);
        }
        unset($value);

        /**
         * Sorting balances: crescent order //TODO: Insertion sort too fast
         */
        $moved = 0;
        while ($moved < sizeof($balance) - 1) {
            $i = 0;
            while ($i < sizeof($balance) - 1 - $moved) {
                $first_obj = json_decode($balance[$i]);
                $second_obj = json_decode($balance[$i + 1]);
                if ($first_obj->balance < $second_obj->balance) {
                    $tmp = $balance[$i + 1];
                    $balance[$i + 1] = $balance[$i];
                    $balance[$i] = $tmp;
                }
                $i++;
            }
            $moved++;
        }

        $i = 0;
        $poi_finded = 0;
        while ($i < sizeof((array)$balance) && ($poi_to_find != 0) && ($poi_finded < sizeof((array) $poi))){
            $obj = json_decode($balance[$i]);
            $obj_category = $obj->category;
            $obj_balance = $obj->balance;

            $proportion = ( (($obj_balance)*(1.00) / (6.00) )* $poi_to_find) + 1;
            $query_args = array(
                'category_name' => categories_slug($obj_category),
                'fields' => 'ids',
                'orderby' => 'rand',
                'post__not_in' => (array)$poi,
                'posts_per_page' => $proportion,
                'post_type' => 'risorsa' ,
                'post_status' => 'publish'
            );
            $query = new WP_Query($query_args);

            while ( ($query->have_posts()) && ($poi_to_find != 0) && ($poi_finded < sizeof((array) $poi))) {
                $query->the_post();
                $id = get_the_ID();
                $poi[$poi_finded] = $id;
                $poi_finded++;
                $poi_to_find--;
            }
            wp_reset_postdata();
            $i++;
        }
        return (array)$poi;
    }
}

function categories_slug($cat) {
    return str_replace(' ', "-", strtolower($cat)) . "-risorse";
}

function get_date_transalted($date_timestamp) {
    $lang = function_exists("pll_current_language")? pll_current_language() : "it"; //it, en, fr

    switch($lang) {
        case "it":
            $fmt = new IntlDateFormatter('it_IT',
                IntlDateFormatter::LONG,
                IntlDateFormatter::NONE ,
                'Europe/Berlin',
                IntlDateFormatter::GREGORIAN);

            return $fmt->format($date_timestamp);

        case 'en':
            $fmt = new IntlDateFormatter('en_US',
                IntlDateFormatter::LONG,
                IntlDateFormatter::NONE ,
                'Europe/Berlin',
                IntlDateFormatter::GREGORIAN);

            return $fmt->format($date_timestamp);

        case 'fr':
            $fmt = new IntlDateFormatter('fr_FR',
                IntlDateFormatter::LONG,
                IntlDateFormatter::NONE ,
                'Europe/Berlin',
                IntlDateFormatter::GREGORIAN);

            return $fmt->format($date_timestamp);
    }
}
