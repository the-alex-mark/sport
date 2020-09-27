(function ($) {
    $(window).load(function() {
        $(document).ready(function () {

            $('.slider-for').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                asNavFor: '.slider-nav'
            });

            $('.slider-nav').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                asNavFor: '.slider-for',
                dots: false,
                focusOnSelect: true
            });
            
            $('a[data-slide]').click(function (e) {
                e.preventDefault();
                var slideno = $(this).data('slide');
                $('.slider-nav').slick('slickGoTo', slideno - 1);
            });

            /* ************************************************************************ */
            /* Header                                                                   */
            /* ************************************************************************ */

            $('.no-text a').html('&#160;');
            // $('.woocommerce-product-gallery__trigger').html('&#160;');
            
            // ↓ Работа с поиском
            $('.icon-search').on('click', function () {
                $('.header-search').toggle('visible');
            });
            
            elem_search = $('.header-search input[name="query"]');
            $('.button-search').on('click', function (e) {
                if (elem_search.val() == "" || elem_search.val().length == 0) {
                    e.preventDefault();
                    elem_search.addClass('failed');
                    elem_search.focus();
                }
            });

            elem_search.on('focusout', function() {
                $(this).removeClass('failed');
            });


            /* ************************************************************************ */
            /* Content                                                                  */
            /* ************************************************************************ */

            $('.tab-button').on('click', function (e) {
                e.preventDefault();

                $('.tab-item').each(function(i) {
                    $(this).removeClass('open');
                });

                $(this).parent().toggleClass('open');
            });
        });
    });
})(jQuery);