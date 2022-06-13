// Scroll to results
if (window.location.href.indexOf("/?") > -1 && $('body').hasClass('post-type-archive-research')) {

    // Does a scroll target exist?
    var target = $('.resourcesSearch');
    if (target.length) {
        // target[0].scrollIntoView({ behavior: 'smooth' });

        var offset = 0; //85; //100;

        var scroll_to = target[0].getBoundingClientRect().top - offset;

        window.scrollBy({
            top: scroll_to,
            left: 0,
            behavior: 'smooth'
        });

    }

}

if($('body').hasClass('post-type-archive-research') || $('body').hasClass('date')) {

    // Label click
    $('.archive__filter__label').click(function(){
        $('.archive__filter__buttonWrap').addClass('shown');
    })

    // Date selected
    $('.archive__filter__itemGroup select').on('change', function(){
        $('.archive__filter__buttonWrap').addClass('shown');
    })


    // Search submit button
    $('#resourcesSearchSubmit').click(function(e){
        e.preventDefault();
        researchSearchSubmit();
    })

    // Search input enter
    $('#searchSearchFacade').bind("enterKey",function(e){
        e.preventDefault();
        researchSearchSubmit();
    });

    $('#searchSearchFacade').keyup(function(e){
        if(e.keyCode == 13)
        {
            $(this).trigger("enterKey");
        }
    });

    // Search order select
    $('#archive__list__results__sort__select').on('change', function(){

        searchSelectAction();

        $('#resourcesFilterForm').submit();

    })

    $(window).on('load', function(){
        searchSelectAction();
    })


    // search filter accordions
    $('.archive__filter h3').click(function(){
        $(this).next('.archive__filter__itemGroupWrap').slideToggle(300);

        if($(this).find('span').text() == '+') {
            $(this).find('span').text('-');
        } else {
            $(this).find('span').text('+');
        }
    })



    function searchSelectAction() {
        var option = document.getElementById("archive__list__results__sort__select");

        if(option){
          option = option.options[option.selectedIndex].value;
        }

        // clear out
        $('#resourceSearchOrderBy').val('');

        if(option == 'ASC' || option == 'title-z-to-a') {
            $('#resourceSearchOrder').val('ASC');
        } else {
            $('#resourceSearchOrder').val('DESC');
        }

        if(option == 'title-a-to-z' || option == 'title-z-to-a') {
            $('#resourceSearchOrderBy').val('title')
        }
    }

    function researchSearchSubmit() {
        $('input[name="research-s"]').val($('#searchSearchFacade').val());
        $('#resourcesFilterForm').submit();
    }



}

$(window).on('load', function(){
  $('.archive__filter__buttonWrap input[type="reset"]').click(function(){
    setTimeout(function(){
      $('form.archive__filters input').prop("checked", false);
      $('form.archive__filters').submit();
    }, 300)

  })
})
