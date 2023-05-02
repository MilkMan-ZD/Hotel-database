$(document).ready(function () {
    $('.menu-burgerheader').click(function () {
        $('.menu-burgerheader').toggleClass('open-menu');
        $('.headernav').toggleClass('open-menu');
        $('body').toggleClass('fixed-page');
    });
});