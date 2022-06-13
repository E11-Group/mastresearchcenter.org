// $(window).on('load', function(){
//     $('.field-checkbox label').click(function(e){
//         e.preventDefault();
//         if($(this).find('input').prop() == true){
//             $(this).addClass('active')
//             $(this).find('input').attr('checked');
//         } else {
//             $(this).removeClass('active');
//             $(this).find('input').attr('checked');
//         }
//     })
// });

$(function () {

    var $accordion__item = $('[data-class="accordion__item"]');

    if ($accordion__item.length > 0) {

        $accordion__item.each(function () {
            var $this = $(this),
                activeClass = 'accordion__item-active',
                $link = $this.find('[data-class="accordion__link"]');

            $link.on('click', function (e) {
                e.preventDefault();

                $this.toggleClass(activeClass);
            });
        });
    }
});
