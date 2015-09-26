$(function() {
    $("#selectable").selectable({
        stop: function() {
            $(".ui-selected").each(function() {
                var index = $("#selectable li").index(this);
                getQuestion(index + 1);
            });
        }});

    $("#selectable").on("selectableselected", function( event, ui ) {
        $(ui.selected).addClass("ui-selected").siblings().removeClass("ui-selected");
    });

    // Initial call to getQuestion when page is ready
    $(getQuestion(-1));
});

function showAnswer() {
    var answer = document.getElementById("answer");
    answer.style.visibility = "visible";
}

function getQuestion(index) {
    answer.style.visibility = "hidden";
    $('#question').html('<span style="font-family: Arial">Loading question...</span>');
    data = {
        'id': index,
        'min': $('#min').val(),
        'max': $('#max').val()
    };
    $.ajax({
        url: "get-question.php",
        type: "POST",
        data: data,
        success: function(data) {
            data = $.parseJSON(data);

            var container = $('#selectable');
            var scrollTo = $("#selectable li").eq(data._id);
            scrollTo.addClass('ui-selected').siblings().removeClass('ui-selected');
            container.animate({
                scrollTop: scrollTo.offset().top - container.offset().top + container.scrollTop()
            });

            $('#question').html(data._id + ". " + data.question);
            $('#answer').html(data.answer);
        }
    });
}
