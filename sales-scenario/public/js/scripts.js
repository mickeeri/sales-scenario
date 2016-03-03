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
    setTimeout(function(){
        if(typeof threeSixtyPlayer != 'undefined'){
            var formatTime = function(seconds){
                var minutes = Math.floor(seconds/60) > 0 ? Math.floor(seconds/60) + 'm ' : '';
                return minutes + Math.floor(seconds%60) + 's';
            };
            $('.sm2-timing').bind("DOMSubtreeModified",function(){
                var element = $(this);
                var seconds = parseInt(element.html());
                var duration = 0;
                if(typeof threeSixtyPlayer.sounds[0] != 'undefined'){
                    duration = threeSixtyPlayer.sounds[0]._get_html5_duration()/1000;
                }
                var time = formatTime(seconds) + ' / ' + formatTime(duration);
                $('.podcast-time-text').html(time);
                console.log();
            });
        }
    },200);
});

