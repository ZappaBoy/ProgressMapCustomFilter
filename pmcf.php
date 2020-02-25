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

        echo '
    <div class="testbox">
      <form action="https://www.molise-italia.it/mostra-itinerario/" method="get">
        <h1>Restaurant Feedback Form</h1>
        <p>Please help us improve our restaurant services by filling in our feedback form. Thank you!</p>
        <h4>Name</h4>
        <div class="name">
          <input type="text" name="name" placeholder="First" />
          <input type="text" name="name" placeholder="Last" />
        </div>
        <h4>Email</h4>
        <input type="text" name="name" />
        <h4>Location You Visited<span>*</span></h4>
        <select>
          <option class="disabled" value="location" disabled selected>*Please Select*</option>
          <option value="1">Location 1</option>
          <option value="2">Location 2</option>
          <option value="3">Location 3</option>
          <option value="4">Location 4</option>
          <option value="5">Location 5</option>
        </select>
        <h4>Day Visited<span>*</span></h4>
        <div class="day-visited">
          <input type="date" name="dayvisited" required/>
          <i class="fas fa-calendar-alt"></i>
        </div>
        <h4>Time Visited<span>*</span></h4>
 <div class="time-visited">
          <input type="time" name="timevisited" required/>
          <i class="fas fa-clock"></i>
        </div>
        <h4>Dine In / Take Out</h4>
        <div class="question-answer">
          <label><input type="radio" value="none" name="Dine" /> Dine In</label>
          <label><input type="radio" value="none" name="Dine" /> Take Out</label>
        </div>
        <h4>Age<span>*</span></h4>
        <select>
          <option class="disabled" value="location" disabled selected>*Please Select*</option>
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
            <td><input type="radio" value="none" name="Food" /></td>
            <td><input type="radio" value="none" name="Food" /></td>
            <td><input type="radio" value="none" name="Food" /></td>
            <td><input type="radio" value="none" name="Food" /></td>
          </tr>
          <tr>
            <td class="first-col">Overall Service Quality</td>
            <td><input type="radio" value="none" name="Service" /></td>
            <td><input type="radio" value="none" name="Service" /></td>
            <td><input type="radio" value="none" name="Service" /></td>
            <td><input type="radio" value="none" name="Service" /></td>
          </tr>
          <tr>
            <td class="first-col">Speed of Service</td>
            <td><input type="radio" value="none" name="Speed" /></td>
            <td><input type="radio" value="none" name="Speed" /></td>
            <td><input type="radio" value="none" name="Speed" /></td>
            <td><input type="radio" value="none" name="Speed" /></td>
          </tr>
          <tr>
            <td class="first-col">Price</td>
            <td><input type="radio" value="none" name="Price" /></td>
            <td><input type="radio" value="none" name="Price" /></td>
            <td><input type="radio" value="none" name="Price" /></td>
            <td><input type="radio" value="none" name="Price" /></td>
          </tr>
          <tr>
            <td class="first-col">Overall Experience</td>
            <td><input type="radio" value="none" name="Experience" /></td>
            <td><input type="radio" value="none" name="Experience" /></td>
            <td><input type="radio" value="none" name="Experience" /></td>
            <td><input type="radio" value="none" name="Experience" /></td>
          </tr>
        </table>
        <h4>Any comments, questions or suggestions?</h4>
        <textarea rows="5"></textarea>
		
		<!-- To Remove: For developing use -->
		<h4>Post ids<span>*</span></h4>
        <select name="selected_post_ids">
          <option class="disabled" value="selected_post_ids" disabled selected>*Please Select*</option>
          <option value="9008-8221">9008-8221</option>
          <option value="9008-8221-8908">9008-8221-8908</option>
        </select>
		<!-- To Remove: For developing use -->
		
        <div class="btn-block">
          <button type="submit" href="/">Send Feedback</button>
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
