/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

/*require('./wow.min.js');*/
$('.wol-gradient').click(function() {
    $('.list-word').animate({
        'height': '50rem'
    }, 1500);
    $(this).css('opacity', '0')
})
var myInterval;
var count = 1;
var myFunc = function() {
    var cur = $('.is-showing');
    if (cur.index() == $('.is-bold').length - 1) {
        cur.removeClass('is-showing');
        $('.is-bold:first').addClass('is-showing');
    } else {
        cur.removeClass('is-showing').next().addClass('is-showing');
    }
    if ($(window).width() < 1200) {
        if (count == 4) {
            count = 1
        } else {

            count++
        }
        console.log(count)
        $('.tab' + count).trigger('click')
    }
};
if ($(window).width() < 769) {
    $('.list-word').css('height', '23rem')
}

$('.tab1').click(function () {
    $('.tab5').removeClass('active');
    $('.tab4').removeClass('active');
    $('.tab2').removeClass('active');
    $('.tab3').removeClass('active');
    $('.tabs').css('transform', ' translateX(0%)');
    $('.tabCont2').fadeOut("slow");
    $('.tabCont4').fadeOut("slow");
    $('.tabCont3').fadeOut("slow");
    $('.tabCont1').fadeIn(2000);
    $(this).addClass('active');
  });
  $('.tab2').click(function () {
    $('.tab1').removeClass('active');
    $('.tab4').removeClass('active');
    $('.tab3').removeClass('active');
    $('.tab5').removeClass('active');
    $('.tabs').css('transform', ' translateX(-20%)');
    $('.tabCont1').fadeOut("slow");
    $('.tabCont4').fadeOut("slow");
    $('.tabCont3').fadeOut("slow");
    $('.tabCont2').fadeIn(2000);
    $(this).addClass('active');
  });
  $('.tab3').click(function () {
    $('.tab5').removeClass('active');
    $('.tab1').removeClass('active');
    $('.tab2').removeClass('active');
    $('.tab4').removeClass('active');
    $('.tabs').css('transform', ' translateX(-40%)');
    $('.tabCont2').fadeOut("slow");
    $('.tabCont4').fadeOut("slow");
    $('.tabCont1').fadeOut("slow");
    $('.tabCont3').fadeIn(2000);
    $(this).addClass('active');
  });
  $('.tab5').click(function () {
    $('.tab3').removeClass('active');
    $('.tab1').removeClass('active');
    $('.tab2').removeClass('active');
    $('.tab4').removeClass('active');
    $('.tabs').css('transform', ' translateX(-80%)');
    $('.tabCont2').fadeOut("slow");
    $('.tabCont4').fadeOut("slow");
    $('.tabCont1').fadeOut("slow");
    $('.tabCont3').fadeIn(2000);
    $(this).addClass('active');
  });
  $('.tab4').click(function () {
    $('.tab5').removeClass('active');
    $('.tab1').removeClass('active');
    $('.tab2').removeClass('active');
    $('.tab3').removeClass('active');
    $('.tabs').css('transform', ' translateX(-60%)');
    $('.tabCont2').fadeOut("slow");
    $('.tabCont1').fadeOut("slow");
    $('.tabCont3').fadeOut("slow");
    $('.tabCont4').fadeIn(2000);
    $(this).addClass('active');
  });
myInterval = setInterval(myFunc, 5000);
if( typeof Swiper != 'undefined'){
    var swiper = new Swiper('.blog-slider', {
        spaceBetween: 30,
        effect: 'fade',
        loop: true,
        mousewheel: {
            invert: false,
        },
        pagination: {
            el: '.blog-slider__pagination',
            clickable: true,
        }
    });
}
if( typeof WOW != 'undefined'){
    new WOW().init();
    wow = new WOW({
        boxClass: 'wow', // default
        animateClass: 'animated', // default
        offset: 0, // default
        mobile: false, // default
        live: true // default
    })
    wow.init();
}

