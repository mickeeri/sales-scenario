// Checkbox toggle expert tags in explorer page
$(function () {
    $('#filter-tags input[type="checkbox"]').click(function () {
        $('#expert-list .expert').show();
        if ($('#filter-tags :checked').length > 0) {
            contain = $('#filter-tags :checked').map(function () {
                return ':contains("' + this.value + '")';
            }).get().join(',');
            $('#expert-list .expert:not(' + contain + ')').hide();
        }
    });

    // Check/uncheck all checkboxes // Toggle doesn't work as expected, that's why if/else
    $('#check_all').click(function () {
        $('input:checkbox').prop('checked', this.checked);
        if($('#check_all').prop('checked')){
            $('#expert-list .expert').show();
        } else {
            $('#expert-list .expert').hide();
        }
    });

    // Remove check from show all when click on another checkbox
    $("input[name!=show-all]").click(function() {
        $("#check_all").prop("checked", false);
    });

});

// Toogle popup sort list
$('.filter-popup').toggle();
$(function(){
    $('#hideshow').on('click', function(event) {
        $('.filter-popup').toggle('show');
    });
});