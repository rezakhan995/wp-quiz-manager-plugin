jQuery(document).ready(function ($) {
    'use strict';

    $(".qm-quiz-form").on('submit', function (event) {
        event.preventDefault();

        var __this          = $(this);
        var postData        = __this.serialize();
        var unserialized    = unserialize(postData)
        var totalQuestions  = parseInt(Object.keys(unserialized).length);
        var rightAnswered   = 0;
        var wrongAnswered   = 0;
        var finalResult     = '';

        $.each(unserialized, function (index, value) {
            console.log(value)
            if ('right' === value) {
                rightAnswered++;
            }
        })

        wrongAnswered = totalQuestions - rightAnswered;
        var result = parseFloat(rightAnswered * 100) / totalQuestions;
        __this.find('.qm-quiz-result-wrapper').html( 
            `<div>Number Of Questions: ${totalQuestions}</div>
            <div>Correct Answers: ${rightAnswered}</div>
            <div>Wrong Answers: ${wrongAnswered}</div>
            <div>Percentage: ${result}%</div>
            `
        );
    });
});

function unserialize(data) {
    data = data.split('&');
    var response = {};
    for (var k in data) {
        var newData = data[k].split('=');
        response[newData[0]] = newData[1];
    }
    return response;
}