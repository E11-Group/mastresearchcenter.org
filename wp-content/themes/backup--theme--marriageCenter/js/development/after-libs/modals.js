$currrentScroll = 0;

// If there is a current hash, scroll to the id and open the modal
$(window).on('load', function(){
    if(window.location.hash) {
        $currentHash = window.location.hash;
        $modalID = window.location.hash.substring(1);
        
        $('html, body').animate({
            scrollTop: $('[data-modal-id="'+ $modalID + '"]').offset().top
        }, 400);

        $currrentScroll = $(window).scrollTop();

        setTimeout(function(){
            $('body').addClass('modal--open');
            $('body').scrollTop($currrentScroll);
            setTimeout(function(){
                $('#'+$modalID).addClass('active');
            }, 500)
        }, 1000)
        
    }
})

$('[data-modal-id], #menu-item-55').click(function(){
    $currrentScroll = $(window).scrollTop();
    $modalID = $(this).attr('data-modal-id');

    if($(this).attr('id') == 'menu-item-55') {
        $modalID = 'signUpForm';
    }

    window.location.hash = $modalID;

    $('body').addClass('modal--open');
    $('body').scrollTop($currrentScroll);
    setTimeout(function(){
        $('#'+$modalID).addClass('active');
    }, 500)
})

$('.modal .close').click(function(){
    $currentSrc = $('.modal__content.active iframe').attr('src');
    $currentID = $('.modal__content.active').attr('id');
    $('.modal__content').removeClass('active');
    $('body').removeClass('modal--open');
    $('html').scrollTop($currrentScroll);
    $('#'+$currentID).find('iframe').attr('src', '');
    $('#'+$currentID).find('iframe').attr('src', $currentSrc);

   removeHash();
})


function removeHash() { 
    var scrollV, scrollH, loc = window.location;
    if ("pushState" in history)
        history.pushState("", document.title, loc.pathname + loc.search);
    else {
        // Prevent scrolling by storing the page's current scroll offset
        scrollV = document.body.scrollTop;
        scrollH = document.body.scrollLeft;

        loc.hash = "";

        // Restore the scroll offset, should be flicker free
        document.body.scrollTop = scrollV;
        document.body.scrollLeft = scrollH;
    }
}