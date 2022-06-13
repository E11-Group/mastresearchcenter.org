$(window).on('load', function(){
    $('.accordion__item__title').click(function(){
        $(this).next('.accordion__item__content').slideToggle();
        $(this).toggleClass('accordion__item__title--open');  
    })
})