jQuery(document).ready(function ($) {
    'use strict';

    $(".qm-add-more-text-field").on('click', function (event) {
        event.preventDefault();

        var __this = $(this)
        
        __this.parents('.add-wrong-ans').prepend( 
            `<div class="qm-question-wrong-ans">
                <div class="qm-question-label">
                    <label for="wrong-ans"> wrong Answer: </label>
                    <div class="qm-question-desc"> Enter wrong Answer Here. </div>
                </div>
                <div class="qm-question-meta">
                    <input placeholder="Enter wrong Answer Here." autocomplete="off" class="qm-question-form-control" type="text" name="qm_question_wrong_ans[]" />
                </div>
            </div>
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