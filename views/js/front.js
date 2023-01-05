$(document).ready(function () {
    $('.lfaq-qa').click(toggleContent);
});

function toggleContent() {
    var arrow = $(this).find('.lfaq-q-line i.material-icons');
    arrow.html("keyboard_arrow_up");
    if (!$(this).hasClass("collapsed")) {
        arrow.html("keyboard_arrow_down");
    }
}