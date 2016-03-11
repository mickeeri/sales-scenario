$(document).ready(function() {

    //Hyperlinks in explore view for experts-list
    $('.a-letter').click(function(){
        $('html, body').animate({
            scrollTop: $( $.attr(this, 'href') ).offset().top - 130
        }, 500);
        return false;
    });

    //User is on mobile and views/hides the menu
    $('#menu_open').click(function(e){
        $('body').toggleClass('active');
    });

    //Close flash messages
    $('.flash-message').click(function (e) {
        e.preventDefault();
        $(this).remove();
    });


    //Toggle expert info
    $('.podcast-author').click(function () {
        $('#expert_info').toggle();
        $(this).toggleClass('active');
    });

    //Update timer on player view
    setTimeout(function(){
        if(typeof threeSixtyPlayer != 'undefined'){
            var formatTime = function(totalSeconds){
                var minutes = Math.floor(totalSeconds/60) > 0 ? Math.floor(totalSeconds/60) : "0";
                var seconds = Math.floor(totalSeconds%60);

                return formatNumbers(minutes) + ':' + formatNumbers(seconds);
            };

            var formatNumbers = function(number){
                if(number < 10) {
                    number = "0" + number;}
                return number;
            };

            $('.sm2-timing').bind("DOMSubtreeModified",function(){
                var element = $(this);
                var totalSeconds = parseInt(element.html());
                var duration = 0;
                if(typeof threeSixtyPlayer.sounds[0] != 'undefined'){
                    duration = threeSixtyPlayer.sounds[0]._get_html5_duration()/1000;
                }
                var time = formatTime(totalSeconds) + ' / ' + formatTime(duration);
                $('.podcast-time-text').html(time);
                console.log();
            });
        }
    },200);

    var allExperts = $('#expert_list').find('.expert');

    // Checkbox toggle expert tags in explorer page
    $('#filter_tags input[type="checkbox"]').click(function () {
        allExperts.show();
        if ($('#filter_tags :checked').length >= 0) {
            contain = $('#filter_tags :checked').map(function () {
                return ':contains("' + this.value + '")';
            }).get().join(',');
            $('#expert_list .expert:not(' + contain + ')').hide();
        }
    });

    // Check/uncheck all checkboxes // Toggle doesn't work as expected, that's why if/else

    $('#check_all').click(function () {
        $('input:checkbox').prop('checked', this.checked);
        if ($('#check_all').prop('checked')) {
            allExperts.show();
        } else {
            allExperts.hide();
        }
    });

    // Remove check from show all when click on another checkbox
    $("input[name!=show-all]").click(function () {
        $("#check_all").prop("checked", false);
    });

    // Toogle popup sort list
    var filterPopup = $('.filter-popup');
    $('#hideshow').click(function (e) {
        e.preventDefault();
        filterPopup.toggle();
        $(this).toggleClass("active");
    });

    var preSelectedTag = filterPopup.data('selected');

    if (preSelectedTag) {
        preSelectedTag = preSelectedTag -1;  // Get the tag id.
        // Get the value from input
        var value = $("ul#filter_tags input:nth(" + preSelectedTag + ")").val();
        // Remove all tags except the one with present id
        contain = $('#filter_tags').map(function () {
            return ':contains("' + value + '")';
        }).get();
        $('#expert_list .expert:not(' + contain + ')').hide();
        // Uncheck checkboxes except the present one
        $(':checkbox').attr('checked', false)[preSelectedTag].checked = true;
    }
});

