jQuery.noConflict()(function($){
    "use strict";
    $(document).ready(function() {
        let answerObj = [];

        $(".question-1").show();
        $(".question-2").hide();
        $(".question-3").hide();
        $(".question-4").hide();

        //Question 1
        $('.question-1 .answer1').click(function () {
            $(".question-1").hide("slow");
            $(".question-2").show();
            answerObj[0] = 1;
        });
        $('.question-1 .answer2').click(function () {
            $(".question-1").hide();
            $(".question-2").show();
            answerObj[0] = 2;
        });
        $('.question-1 .answer3').click(function () {
            $(".question-1").hide();
            $(".question-1").show();
            answerObj[0] = 3;
        });

        //Question 2
        $('.question-2 .answer1').click(function () {
            $(".question-1").hide();
            $(".question-2").hide();
            $(".question-3").show();
        });
        $('.question-2 .answer2').click(function () {
            $(".question-1").hide();
            $(".question-2").hide();
            $(".question-3").show();
        });
        $('.question-2 .answer3').click(function () {
            $(".question-1").hide();
            $(".question-2").hide();
            $(".question-3").show();
        });
        $('.question-2 .previews-question').click(function () {
            $(".question-1").show();
            $(".question-2").hide();
            $(".question-3").hide();
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
