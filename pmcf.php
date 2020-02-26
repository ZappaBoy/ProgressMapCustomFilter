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

        //load current language from polylang plugin if installed
        $lang = function_exists("pll_current_language")? pll_current_language() : "it"; //it, en, fr

        echo '<div class="testbox">
    <form action="/mostra-itinerario/" method="get">
        <h1>Trova il tuo itinerario ideale</h1>
        <p>Trova il tuo itinerario ideale</p>

        <div class="first-question">
            <h4>Sai gia cosa visitare?</h4>
            <div class="name">
                <button id="yes" type="button">Si</button>
                <button id="no" type="button">No</button>
            </div>
        </div>

        <div class="locations">
            <input id="campobasso" name="locations" type="checkbox" value="Campobasso">
            <label for="campobasso"> Campobasso</label><br>
            <input id="isernia" name="locations" type="checkbox" value="Isernia">
            <label for="isernia"> Isernia</label><br>
            <input id="termoli" name="locations" type="checkbox" value="Termoli">
            <label for="termoli"> Termoli</label><br>
        </div>
        <div class="other-questions">
            <h4>Email</h4>
            <input name="name" type="text"/>
            <h4>Location You Visited</h4>
            <select>
                <option class="disabled" disabled selected value="location">*Please Select*</option>
                <option value="1">Location 1</option>
                <option value="2">Location 2</option>
                <option value="3">Location 3</option>
                <option value="4">Location 4</option>
                <option value="5">Location 5</option>
            </select>
            <h4>Day Visited</h4>
            <div class="day-visited">
                <input name="dayvisited" type="date"/>
                <i class="fas fa-calendar-alt"></i>
            </div>
            <h4>Time Visited</h4>
            <div class="time-visited">
                <input name="timevisited" type="time"/>
                <i class="fas fa-clock"></i>
            </div>
            <h4>Dine In / Take Out</h4>
            <div class="question-answer">
                <label><input name="Dine" type="radio" value="none"/> Dine In</label>
                <label><input name="Dine" type="radio" value="none"/> Take Out</label>
            </div>
            <h4>Age</h4>
            <select>
                <option class="disabled" disabled selected value="location">*Please Select*</option>
                <option value="under 13">Under 13</option>
                <option value="13-17">13-17</option>
                <option value="18-24">18-24</option>
                <option value="25-34">25-34</option>
                <option value="35-44">35-44</option>
                <option value="45-54">45-54</option>
                <option value="55 or older">55 or older</option>
            </select>
            <h4>Untitled</h4>
            <table>
                <tr>
                    <th class="first-col"></th>
                    <th>Amazing</th>
                    <th>Good</th>
                    <th>Decent</th>
                    <th>Disappointing</th>
                </tr>
                <tr>
                    <td class="first-col">Food Quality</td>
                    <td><input name="Food" type="radio" value="none"/></td>
                    <td><input name="Food" type="radio" value="none"/></td>
                    <td><input name="Food" type="radio" value="none"/></td>
                    <td><input name="Food" type="radio" value="none"/></td>
                </tr>
                <tr>
                    <td class="first-col">Overall Service Quality</td>
                    <td><input name="Service" type="radio" value="none"/></td>
                    <td><input name="Service" type="radio" value="none"/></td>
                    <td><input name="Service" type="radio" value="none"/></td>
                    <td><input name="Service" type="radio" value="none"/></td>
                </tr>
                <tr>
                    <td class="first-col">Speed of Service</td>
                    <td><input name="Speed" type="radio" value="none"/></td>
                    <td><input name="Speed" type="radio" value="none"/></td>
                    <td><input name="Speed" type="radio" value="none"/></td>
                    <td><input name="Speed" type="radio" value="none"/></td>
                </tr>
                <tr>
                    <td class="first-col">Price</td>
                    <td><input name="Price" type="radio" value="none"/></td>
                    <td><input name="Price" type="radio" value="none"/></td>
                    <td><input name="Price" type="radio" value="none"/></td>
                    <td><input name="Price" type="radio" value="none"/></td>
                </tr>
                <tr>
                    <td class="first-col">Overall Experience</td>
                    <td><input name="Experience" type="radio" value="none"/></td>
                    <td><input name="Experience" type="radio" value="none"/></td>
                    <td><input name="Experience" type="radio" value="none"/></td>
                    <td><input name="Experience" type="radio" value="none"/></td>
                </tr>
            </table>
            <h4>Any comments, questions or suggestions?</h4>
            <textarea rows="5"></textarea>

            <!-- To Remove: For developing use -->
            <h4>Post ids<span>*</span></h4>
            <select name="selected_post_ids">
                <option class="disabled" disabled selected value="selected_post_ids">*Please Select*</option>
                <option value="9008-8221">9008-8221</option>
                <option value="9008-8221-8908">9008-8221-8908</option>
            </select>
            <!-- To Remove: For developing use -->

            <div class="btn-block">
                <button href="/" type="submit">Send Feedback</button>
            </div>
        </div>
    </form>
</div> ';

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