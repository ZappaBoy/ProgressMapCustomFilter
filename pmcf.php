<?php
/**
 * Plugin Name: Progress Map Custom Filter
 * Plugin URI: https://molise-italia.it
 * Description: Show custom posts with Progress Map
 * Version: 1.0
 * Author: Molise Italia
 * Author URI: https://molise-italia.it
 */

add_shortcode("pmcf_search_itineraries", "pmcf_show_form" );
if( !function_exists("pmcf_show_form")) {
    function pmcf_show_form($attr) {
        //load style to customize form
        wp_enqueue_style( 'pmcf_style', plugin_dir_url(__FILE__) . "/css/style.css" );

        //load script to handle form
        wp_enqueue_script('pmcf_jquery_script', plugin_dir_url(__FILE__) . "/script/main.js", array('jquery'), null, true);

        //load script and style to handle datepicker
        wp_enqueue_script('flatpickr_script', "https://cdn.jsdelivr.net/npm/flatpickr", array('jquery'), null, true);
        wp_enqueue_style('flatpickr_style', "https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css");

        //load script to handle redirect
        wp_enqueue_script('redirect_script', "https://cdn.jsdelivr.net/npm/jquery.redirect@1.1.4/jquery.redirect.min.js", array('jquery'), null, true);

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
        $categories = htmlspecialchars($_POST[]);

        $post_to_show = pmcf_process_the_answer(); //@TODO pass agrument to function: dates and array of answers

        //print_r($post_to_show);
        //return do_shortcode('[cspm_main_map id="11431" post_ids=' . '"' . $post_to_show . '"' . ']');
        return do_shortcode('[cspm_route_map id="11431" post_ids=' . '"' . $post_to_show . '"' . ' travel_mode="DRIVING" height="700px" width="1200px"]');
    }
}

if( !function_exists("pmcf_process_the_answer")) {
    function pmcf_process_the_answer() {

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

        $answers = ["Archeologia, arte e storia", "Vacanze nella natura", "Paesi e culture", "Vacanze nella natura", "Benessere", "Vacanze nella natura"];
        $days = 4;
        $poi_per_day = 3;

        /**
         * 7 static poi if no day provided
         */
        $poi_to_find = 7;
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

        // TODO: Filter based on category balance

        $i = 0;
        $poi_finded = 0;
        while ($i < sizeof((array)$balance) && $poi_finded < $poi_to_find) {
            $obj = json_decode($balance[$i]);
            $category = $obj->category;
            $balance = $obj->balance;

            $query_args = array(
                'category_name' => $category,
                'fields' => 'ids',
                'orderby' => 'rand',
                'post__not_in' => (array)$poi,
                'posts_per_page' => $poi_to_find + 1
            );

            $query = new WP_Query($query_args);
            while($query->have_posts()) {
                $id = get_the_ID();
                if (!in_array($id, (array)$poi)) {
                    if ($poi_finded < $poi_to_find) {
                        $poi[$poi_finded] = $id;
                        $poi_finded++;
                        $poi_to_find--;
                        print_r("$id");
                    } else {
                        $poi_to_find = 0;
                    }
                }
            }
            wp_reset_postdata();
            $i++;
            // TODO: Check proportionally number of posts
            /**
             * Dividing by 6: probability of encounter 2 as balance
             * Adding 1: Roundup
             */
            /*if ($days > 0) {
                $query = array_slice((array)$query, 0, ($balance / 6 * $poi_to_find) + 1 );
            }else {
                $query = array_slice((array)$query, 0, $balance / 6);
            }*/

            /*foreach ( $query as $id ) {
                print_r($id);
                /*if ($poi_finded < $poi_to_find && !in_array($id, (array)$poi)) {
                    $poi[$poi_finded] = $id;

                    $poi_finded++;
                    $poi_to_find--;
                } else {
                    $poi_to_find = 0;
                    break;
                }*/
            //}
        }

        //return implode( ", ", (array) $poi);
        return ($poi);
    }
}
