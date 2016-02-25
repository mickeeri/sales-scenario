//User is on mobile and views/hides the menu
$('#menu_open').click(function(e){
    $('body').toggleClass('active');
});

// Toggle expert tags in explorer page
$(function () {
    $('#filter-tags input[type="checkbox"]').click(function () {
        $('#expert-list .expert-tags').show();
        if ($('#filter-tags :checked').length > 0) {
            contain = $('#filter-tags :checked').map(function () {
                return ':contains("' + this.value + '")';
            }).get().join(',');
            $('#expert-list .expert-tags:not(' + contain + ')').hide();
        }
    });
});

