jQuery.noConflict()(function($){
    "use strict";

    $(document).ready(function() {
        let answerObj = [];


        for (let questionIndex = 1; questionIndex <= 8; questionIndex++) {
            $('.question-' + questionIndex).hide();
            for (let answerIndex = 1; answerIndex <= 3; ++answerIndex) {
                $('.question-' + questionIndex + ' .answer' + answerIndex).click(function () {
                    if(questionIndex === 8) {
                        console.log(answerObj);
                    } else if (questionIndex === 7 && answerIndex === 2) {
                        console.log(answerObj);
                        //TODO handle form
                    } else {
                        //hide this question container and show the next one
                        $('.question-' + questionIndex).hide('slow');

                        $('.question-' + (questionIndex +1)).show();

                        answerObj[questionIndex] = answerIndex;
                    }
                });

                $('.question-' + questionIndex + ' .previews-question').click(function () {
                    //hide this question container and show the previous one
                    $('.question-' + questionIndex).hide('slow');

                    $('.question-' + (questionIndex -1)).show();
                });
            }
        }

        $(".question-1").show();

        $('.date-range-picker').flatpickr({
            mode: "range"
        });




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
