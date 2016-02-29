/**
 * Sales Scenarios audio player
 */

$(document).ready(function(){
    /*
     * Instance CirclePlayer inside jQuery doc ready
     *
     * CirclePlayer(jPlayerSelector, media, options)
     *   jPlayerSelector: String - The css selector of the jPlayer div.
     *   media: Object - The media object used in jPlayer("setMedia",media).
     *   options: Object - The jPlayer options.
     *
     * Multiple instances must set the cssSelectorAncestor in the jPlayer options. Defaults to "#cp_container_1" in CirclePlayer.
     */
    var type = $("#cp_container_1").data('type');
    var path = $("#cp_container_1").data('path');
    var media = {};
    media[type]= path;

    var myCirclePlayer = new CirclePlayer("#jquery_jplayer_1",

            media,
         {
            cssSelectorAncestor: "#cp_container_1"
        });


    /**
     * Toggle expert info
     */
    $('.podcast-author' ).click(function() {
        $('#expert_info').show();


    });

    if(!$('#expert_info').css('display') == 'none')
    {
        $(body).click(function() {
            $('#expert_info').hide();
        });
    }


    /*$(document).click(function(e) {
        var inside = $('#expert_info');

        if(!inside.is(e.target) && inside.has(e.target).length === 0)
        {
            $('#expert_info').hide();
            inside.unbind('click', document);
        }


    });*/

});
