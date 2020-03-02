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

        //load script to handle datepicker
        wp_enqueue_script('flatpickr_script', "https://cdn.jsdelivr.net/npm/flatpickr", array('jquery'), null, true);
        //load style of datepicker
        wp_enqueue_style('flatpickr_style', "https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css");

        //load current language from polylang plugin if installed
        $lang = function_exists("pll_current_language")? pll_current_language() : "it"; //it, en, fr

        echo '<div class="testbox">
    <form class="bot-question-form" action="/mostra-itinerario/" method="get">
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
                <input class="date-range-picker" type="text" placeholder="Select Date.." readonly="readonly"/>
                <button class="answer1" type="button">Si</button>
                <button class="answer2" type="button">No</button>
                <button class="previews-question" type="button"><i class="fas fa-long-arrow-alt-left"></i>Torna alla domanda precedente</button>
            </div>
        </div>
    </form>
    </div>';

    }
}

add_shortcode("pmcf_show_itinerary", "pmcf_show_result" );
if( !function_exists("pmcf_show_result")) {
    function pmcf_show_result($attr) {
		$ids = htmlspecialchars($_GET['selected_post_ids']);
		$post_to_show = str_replace("-",",", $ids);
			
		//return do_shortcode('[cspm_main_map id="11431" post_ids=' . '"' . $post_to_show . '"' . ']');
		return do_shortcode('[cspm_route_map id="11431" post_ids=' . '"' . $post_to_show . '"' . ' travel_mode="DRIVING" height="700px" width="1200px"]');
	}
}
