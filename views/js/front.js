$(document).ready(function () {
    $("div.lfaq-container").click(arrows);
});

function arrows() {

    $('div.lfaq-container div').each(function () {

        var expanded = $(this).attr('aria-expanded');
        var arrowUp = $(this).find('.lfaq-q-line i.arrow-up');
        var arrowDown = $(this).find('.lfaq-q-line i.arrow-down');

        if (expanded === 'true') {
            arrowUp.removeClass('arrow-up').addClass('arrow-down');
            arrowUp.html("keyboard_arrow_down");
        } else if (expanded === 'false') {
            arrowDown.removeClass('arrow-down').addClass('arrow-up');
            arrowDown.html("keyboard_arrow_up");
        }
    });
}
