//User is on mobile and views/hides the menu
$('#menu_open').click(function(e){
    $('body').toggleClass('active');
});
$(document).ready(function(){
    $('.slider').slick({
        accessibility:true,
        autoplay: false,
        autoplaySpeed: 2000,
        dots: true,
        mobileFirst: true

});
});
