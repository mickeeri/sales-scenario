//User is on mobile and views/hides the menu
$('#menu_open').click(function(e){
    $('body').toggleClass('active');
});
$(document).ready(function(){
    $('.slider').slick({
        accessibility:true,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: true,
        dots: true,
        mobileFirst: true

});
});
