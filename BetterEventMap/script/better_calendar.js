jQuery.noConflict()(function($){
    "use strict";

    $(document).ready(() => {
        let calendarEl = document.getElementById('calendar');

        let calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'dayGrid' ],
            events: event_json
        });

        calendar.render();
    });
});
