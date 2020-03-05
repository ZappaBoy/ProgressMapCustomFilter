jQuery.noConflict()(function($){
    "use strict";

    $(document).ready(function() {
        let answers = [];

        const redirectPageUrl = "/mostra-itinerario/";
        const ANSWERS_MAP = new Map();
        ANSWERS_MAP.set(1, ["Archeologia, arte e storia", "Il mare", "La montagna"]);
        ANSWERS_MAP.set(2, ["Vacanze nella natura", "Paesi e culture", "Benessere"]);
        ANSWERS_MAP.set(3, ["Il mare", "Paesi e culture", "I sapori"]);
        ANSWERS_MAP.set(4, ["Archeologia, arte e storia", "Vacanze nella natura",  "Le tradizioni"]);
        ANSWERS_MAP.set(5, ["La montagna", "Benessere", "Le tradizioni | I sapori"]);
        ANSWERS_MAP.set(6, ["Il mare", "La montagna", "Archeologia, arte e storia", "Vacanze nella natura", "Paesi e culture | Le tradizioni | I sapori"]);

        for (let questionIndex = 1; questionIndex <= 8; questionIndex++) {
            $('.question-' + questionIndex).hide();
            for (let answerIndex = 1; answerIndex <= 5; ++answerIndex) {
                $('.question-' + questionIndex + ' .answer' + answerIndex).click(function () {
                    if(questionIndex === 8) {
                        const startDate = new Date($('.date-range-picker').val().split(" to ")[0]);
                        const endDate = new Date($('.date-range-picker').val().split(" to ")[1]);

                        const diffTime = Math.abs(endDate - startDate);
                        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                        console.log(diffDays);
                        if(diffDays > 20) {
                            $('.date-error').show();
                        } else {
                            let postParams = {
                                categories : buildCategoriesString(answers),
                                startDate:  $('.date-range-picker').val().split(" to ")[0],
                                endDate: $('.date-range-picker').val().split(" to ")[1]
                            };

                            $.redirect(redirectPageUrl, postParams, 'post');
                        }
                    } else if (questionIndex === 7 && answerIndex === 2) {
                        let postParams = {
                            categories : buildCategoriesString(answers)
                        };

                        $.redirect(redirectPageUrl, postParams, 'post');
                    } else {
                        //hide this question container and show the next one
                        $('.question-' + questionIndex).hide('slow');
                        $('.question-' + (questionIndex + 1)).show();

                        //memorize category of answer
                        if(questionIndex !== 7 && questionIndex !== 8) {
                            answers[questionIndex] = ANSWERS_MAP.get(questionIndex)[answerIndex-1];
                        }
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
            mode: "range",
            inline: true,
            dateFormat: "Y-m-d",
            minDate: "today"
        });
    });

    function buildCategoriesString(answers) {
        let string = '';
        answers.forEach((answer) => {
            string += answer + " | ";
        });

        return string.substring(0, string.length-3);
    }
});
