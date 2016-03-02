//User is on mobile and views/hides the menu
$('#menu_open').click(function(e){
    $('body').toggleClass('active');
});

/**
 * Toggle expert info
 */

$(document).ready(function() {
    $('.podcast-author').click(function () {
        $('#expert_info').toggle();
        $(this).toggleClass('active');
    });
});