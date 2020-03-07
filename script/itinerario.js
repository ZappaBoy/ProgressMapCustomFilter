jQuery.noConflict()(function($){
    "use strict";

    $(document).ready(function() {
        hideAllMaps();
        $('.map-day-1').show();
        $('.info-day-1').show();
        $('.button-day-1').attr('id', 'active');

        //listners for all buttons
        for (let i = 1; i <= 30; i++) {
            $('.button-day-' + i).click( () => {
                hideAllMaps();
                $('.map-day-' + i).show();
                $('.info-day-' + i).show();
                $('.button-day-' + i).attr('id', 'active');
            });
        }
    });

    function hideAllMaps() {
        for (let i = 1; i <= 30; i++) {
            $('.map-day-' + i).hide();
            $('.info-day-' + i).hide();
            $('.button-day-' + i).attr('id', '');
        }
    }
});
