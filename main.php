<?php
/**
 * Plugin Name: Progress Map Custom Filter
 * Plugin URI: https://molise-italia.it
 * Description: Show custom posts with Progress Map
 * Version: 1.0
 * Author: Molise Italia
 * Author URI: https://molise-italia.it
 */

add_shortcode("found_itineraries", "main" );
function main($attr) {
echo '<!DOCTYPE html>
<html>
  <head>
    <title>Restaurant Feedback Form</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <style>
      html, body {
      min-height: 100%;
      }
      body, div, form, input, select { 
      padding: 0;
      margin: 0;
      outline: none;
      font-family: Roboto, Arial, sans-serif;
      font-size: 14px;
      color: #666;
      line-height: 22px;
      }
      h1, h4 {
 margin: 15px 0 4px;
      font-weight: 400;
      }
      span {
      color: red;
      }
      .testbox {
      display: flex;
      justify-content: center;
      align-items: center;
      height: inherit;
      padding: 3px;
      }
      form {
      width: 100%;
      padding: 20px;
      background: #fff;
      box-shadow: 0 2px 5px #ccc; 
      }
      input {
      width: calc(100% - 10px);
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 3px;
      vertical-align: middle;
      }
      input:hover, textarea:hover, select:hover {
      outline: none;
      border: 1px solid #095484;
      }
      .name input {
      margin-bottom: 10px;
      }
      select {
      padding: 7px 0;
      border-radius: 3px;
      border: 1px solid #ccc;
      background: #e6eef7;
      }
      option {
      background: #fff;
      }
      select, table {
      width: 100%;
      }
      .day-visited, .time-visited {
      position: relative;
      }
      .day-visited input, .time-visited input {
      width: calc(100% - 12px);
      background: #e6eef7;
      }
      input[type="date"]::-webkit-inner-spin-button {
      display: none;
 }
      input[type="time"]::-webkit-inner-spin-button {
      margin: 2px 22px 0 0;
      }
      .day-visited i, .time-visited i, input[type="date"]::-webkit-calendar-picker-indicator {
      position: absolute;
      top: 8px;
      font-size: 20px;
      }
      .day-visited i, .time-visited i {
      right: 5px;
      z-index: 1;
      color: #a9a9a9;
      }
      [type="date"]::-webkit-calendar-picker-indicator {
      right: 0;
      z-index: 2;
      opacity: 0;
      }
      .question-answer label {
      display: block;
      padding: 0 20px 10px 0;
      }
      .question-answer input {
      width: auto;
      margin-top: -2px;
      }
      th, td {
      width: 18%;
      padding: 15px 0;
      border-bottom: 1px solid #ccc;
      text-align: center;
      vertical-align: unset;
      line-height: 18px;
      font-weight: 400;
      word-break: break-all;
      }
      .first-col {
      width: 25%;
      text-align: left;
      }
      textarea {
      width: calc(100% - 6px);
      }
      .btn-block {
      margin-top: 20px;
      text-align: center;
      }
      button {
      width: 150px;
      padding: 10px;
      border: none;
      -webkit-border-radius: 5px; 
-moz-border-radius: 5px; 
      border-radius: 5px; 
      background-color: #095484;
      font-size: 16px;
      color: #fff;
      cursor: pointer;
      }
      button:hover {
      background-color: #0666a3;
      }
      @media (min-width: 568px) {
      .name {
      display: flex;
      justify-content: space-between;
      }
      .name input {
      width: 47%;
      margin-bottom: 0;
      }
      th, td {
      word-break: keep-all;
      }
      }
    </style>
  </head>
  <body>
    <div class="testbox">
      <form action="/">
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
        <div class="btn-block">
          <button type="submit" href="/">Send Feedback</button>
        </div>
      </form>
    </div>
  </body>
</html>';

}




