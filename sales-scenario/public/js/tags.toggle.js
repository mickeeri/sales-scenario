// Checkbox toggle expert tags in explorer page
$(function () {
    $('#filter_tags input[type="checkbox"]').click(function () {
        $('#expert_list .expert').show();
        if ($('#filter_tags :checked').length > 0) {
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
            $('#expert_list .expert').show();
        } else {
            $('#expert_list .expert').hide();
        }
    });

    // Remove check from show all when click on another checkbox
    $("input[name!=show-all]").click(function () {
        $("#check_all").prop("checked", false);
    });

});

// Toogle popup sort list
$(function () {
    $('#hideshow').click(function () {
        if ($('.filter-popup').css('display') == 'none') {
            $('.filter-popup').show();
        } else {
            $('.filter-popup').hide();
        }
    });
});

// Close when click outside the popup
$(document).mouseup(function (e) {
    var container = $(".filter-popup");

    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        container.hide();
    }
});