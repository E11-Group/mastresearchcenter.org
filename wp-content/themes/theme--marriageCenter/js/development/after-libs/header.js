// Header Search
$('[href="#search"]').click(function(e){
    e.preventDefault();
    $('#searchBar').toggleClass('active');
})

$(document).click(function(e){

    // Check if click was triggered on or within #menu_content
    if( $(e.target).closest("#searchBar").length > 0 ) {
        return false;
    }

    if( $(e.target).attr('href') == '#search') {
        return false;
    }

    // Otherwise
    // trigger your click function
    $('#searchBar').removeClass('active');
});

$('#searchBar .button').click(function(){
    $('#searchBar form').submit();
})

// hamburger
$('button.hamburger').click(function(){
    $(this).toggleClass('is-active');

    $('.header__container').toggleClass('open');
})