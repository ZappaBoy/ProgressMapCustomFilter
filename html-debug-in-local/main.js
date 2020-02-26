jQuery.noConflict()(function($){
    "use strict";
    $(document).ready(function() {
        $(".locations").hide();
        $(".other-questions").hide();

        $('#yes').click(function () {
            $(".locations").show();
        });

        $('#no').click(function () {
            $(".locations").hide();
            $(".other-questions").show();
        });

        $("input[name='locations']").change(function() {
            console.log("c");
            if( $("input[name='locations']:checked").length > 0) {
                $(".other-questions").show();
            } else {
                $(".other-questions").hide();
            }
        });
    });
});
