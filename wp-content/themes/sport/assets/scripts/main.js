(function ($) {
    $(window).load(function() {
        $(document).ready(function () {

            /* ************************************************************************ */
            /* Header                                                                   */
            /* ************************************************************************ */

            $('.no-text a').html('&#160;');
            
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