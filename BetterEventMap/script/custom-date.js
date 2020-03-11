jQuery.noConflict()(function($){
    "use strict";

    $(document).ready(() => {
        updateAllDates();

        setObserber();
    });

    function setObserber() {
        let target = document.querySelector('.cspml_listings_area_map11169.cspm-row');
        // create an observer instance
        let observer = new MutationObserver(function(mutations) {
            $('.cspml_details_content.grid.cspm-col-lg-12.cspm-col-xs-12.cspm-col-sm-12.cspm-col-md-12').each(
                (index) => {
                    let text = $('.cspml_details_content.grid.cspm-col-lg-12.cspm-col-xs-12.cspm-col-sm-12.cspm-col-md-12:nth-child(' + index + ')').text();
                    let first_date = text.substr(16, 10);
                    let first_date_arr = first_date.split("-");

                    let second_date = text.substr(42, 10);
                    let second_date_arr = first_date.split("-");

                    $('.cspml_details_content.grid.cspm-col-lg-12.cspm-col-xs-12.cspm-col-sm-12.cspm-col-md-12:nth-child(' + index + ')').html(
                        "Data di inizio: " + first_date_arr[2] + "-" + first_date_arr[1] + "-" + first_date_arr[0] + "<br>" +
                        "Data di fine: " + second_date_arr[2] + "-" + second_date_arr[1] + "-" + second_date_arr[0]
                    );
                }
            );

            setObserber();
        });

        // configuration of the observer:
        let config = { attributes: true, childList: true, characterData: true };
        // pass in the target node, as well as the observer options
        observer.observe(target, config);
    }

    function updateAllDates() {
        $('.cspml_details_content.grid.cspm-col-lg-12.cspm-col-xs-12.cspm-col-sm-12.cspm-col-md-12').each(
            (index) => {
                let text = $('.cspml_details_content.grid.cspm-col-lg-12.cspm-col-xs-12.cspm-col-sm-12.cspm-col-md-12:nth-child(' + index + ')').text();
                let first_date = text.substr(16, 10);
                let first_date_arr = first_date.split("-");

                let second_date = text.substr(42, 10);
                let second_date_arr = first_date.split("-");

                $('.cspml_details_content.grid.cspm-col-lg-12.cspm-col-xs-12.cspm-col-sm-12.cspm-col-md-12:nth-child(' + index + ')').html(
                    "Data di inizio: " + first_date_arr[2] + "-" + first_date_arr[1] + "-" + first_date_arr[0] + "<br>" +
                    "Data di fine: " + second_date_arr[2] + "-" + second_date_arr[1] + "-" + second_date_arr[0]
                );
            }
        );
    }
});
