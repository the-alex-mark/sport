(function ($) {
    $(window).load(function() {
        $(document).ready(function () {

            /* ************************************************************************ */
            /* HEADER                                                                   */
            /* ************************************************************************ */

            // ↓ Работа с меню
            $('li.option-menu a').on('click', function (e) {
                e.preventDefault();
                $('.header-wrapper.navigation').toggleClass('visible');
            });

            // ↓ Работа с поиском
            $('li.search').on('click', function (e) {
                e.preventDefault();
                $('.header-wrapper.search').toggleClass('visible');
            });

            $('li.option-search a').on('click', function (e) {
                e.preventDefault();
                $('.header-wrapper.search').toggleClass('visible');
            });
            
            elem_search = $('.header-search_text');
            $('.header-search_button').on('click', function (e) {
                if (elem_search.val() == "" || elem_search.val().length == 0) {
                    e.preventDefault();
                    elem_search.addClass('failed');
                    elem_search.focus();
                }
            });

            elem_search.on('focusout', function() {
                $(this).removeClass('failed');
            });

            elem_search.on('keydown', function() {
                $(this).removeClass('failed');
            });


            /* ************************************************************************ */
            /* SIDEBAR                                                                  */
            /* ************************************************************************ */

            $('.filter-title').on('click', function (e) {
                e.preventDefault();

                let elements = Array.from($(this).parent().children()).slice(1);
                $(elements).toggleClass('v-none');
            });


            /* ************************************************************************ */
            /* CONTENT                                                                  */
            /* ************************************************************************ */

            $('.tab-button').on('click', function (e) {
                e.preventDefault();

                $('.tab-item').each(function(i) {
                    $(this).removeClass('open');
                });

                $(this).parent().toggleClass('open');
            });


            /* ************************************************************************ */
            /* CART                                                                     */
            /* ************************************************************************ */

            // ↓ Работа с контроллом количества товара в корзине
            $('<button class="quantity-button quantity-down">&#8722;</button>')
                .insertBefore('.quantity input');
                
            $('<button class="quantity-button quantity-up">+</button>')
                .insertAfter('.quantity input');
            
            $('.quantity').each(function () {
                let control = $(this);
                let elem_inputNumber = control.find('input[type="number"]');
                let elem_buttonUp    = control.find('.quantity-up');
                let elem_buttonDown  = control.find('.quantity-down');
                
                let minimum          = parseFloat(elem_inputNumber.attr('min'));
                let maximun          = parseFloat(elem_inputNumber.attr('max'));
            
                elem_buttonUp.click(function (e) {
                    e.preventDefault();
                    
                    let value = parseFloat(elem_inputNumber.val());
                    control.find("input").val((value >= maximun) ? value : value + 1);
                    control.find("input").trigger("change");
                });
            
                elem_buttonDown.click(function (e) {
                    e.preventDefault();

                    let value = parseFloat(elem_inputNumber.val());
                    control.find("input").val((value <= minimum) ? value : value - 1);
                    control.find("input").trigger("change");
                });
            });







            // ↓ Зум изображения товара
            $('.product-image-large').zoom();
            $('.product-image-small').on('click', function (e) {
                e.preventDefault();

                $('.product-image-large').find('img').attr(
                    'src',
                    $(this).find('img').attr('src'));

                $('.product-image-large').trigger('zoom.destroy');
                $('.product-image-large').zoom();
            });

        });
    });
})(jQuery);