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
            $large_src = $('.product-image-large').find('img').attr('src');
            if (!$large_src.includes('woocommerce-placeholder'))
                $('.product-image-large').zoom();

            $('.product-image-small').on('click', function (e) {
                e.preventDefault();

                $('.product-image-large').find('img').attr(
                    'src',
                    $(this).find('img').attr('src'));
                
                $('.product-image-large').trigger('zoom.destroy');
                if (!$large_src.includes('woocommerce-placeholder')) {
                    $('.product-image-large').zoom();
                }
            });


            // rating_1 = '<div class="star-rating"><div class="star star-full" aria-hidden="true"></div><div class="star star-empty" aria-hidden="true"></div><div class="star star-empty" aria-hidden="true"></div><div class="star star-empty" aria-hidden="true"></div><div class="star star-empty" aria-hidden="true"></div></div>';
            // rating_2 = '<div class="star-rating"><div class="star star-full" aria-hidden="true"></div><div class="star star-full" aria-hidden="true"></div><div class="star star-empty" aria-hidden="true"></div><div class="star star-empty" aria-hidden="true"></div><div class="star star-empty" aria-hidden="true"></div></div>';
            // rating_3 = '<div class="star-rating"><div class="star star-full" aria-hidden="true"></div><div class="star star-full" aria-hidden="true"></div><div class="star star-full" aria-hidden="true"></div><div class="star star-empty" aria-hidden="true"></div><div class="star star-empty" aria-hidden="true"></div></div>';
            // rating_4 = '<div class="star-rating"><div class="star star-full" aria-hidden="true"></div><div class="star star-full" aria-hidden="true"></div><div class="star star-full" aria-hidden="true"></div><div class="star star-full" aria-hidden="true"></div><div class="star star-empty" aria-hidden="true"></div></div>';
            // rating_5 = '<div class="star-rating"><div class="star star-full" aria-hidden="true"></div><div class="star star-full" aria-hidden="true"></div><div class="star star-full" aria-hidden="true"></div><div class="star star-full" aria-hidden="true"></div><div class="star star-full" aria-hidden="true"></div></div>';

            // $('#email-notes, p.stars, label[for="rating"]').hide();
            // $('#rating')
            //     .hide()
            //     .before(
            //         `<table class="table-star">
            //             <thead>
            //                 <tr>
            //                     <th></th>
            //                     <td>${ rating_1 }</td>
            //                     <td>${ rating_2 }</td>
            //                     <td>${ rating_3 }</td>
            //                     <td>${ rating_4 }</td>
            //                     <td>${ rating_5 }</td>
            //                 </tr>
            //             </thead>
            //             <tbody>
            //                 <tr>
            //                     <th>Качество</th>
            //                     <td><label for="rating-1" class="raling-label"><input id="rating-1" type="radio" name="rating-input" value="1"></label></td>
            //                     <td><label for="rating-2" class="raling-label"><input id="rating-2" type="radio" name="rating-input" value="2"></label></td>
            //                     <td><label for="rating-3" class="raling-label"><input id="rating-3" type="radio" name="rating-input" value="3"></label></td>
            //                     <td><label for="rating-4" class="raling-label"><input id="rating-4" type="radio" name="rating-input" value="4"></label></td>
            //                     <td><label for="rating-5" class="raling-label"><input id="rating-5" type="radio" name="rating-input" value="5"></label></td>
            //                 </tr>
            //             </tbody>
            //         </table>`
            //     );

            //     $('.raling-label').on('click', function (e) {
            //         $value = $('input[type="rating-input"]').val();
            //         $('#rating option[value="' + $value + '"]').prop('selected', true);
            //     });

                
                // })
                // .on( 'click', '#respond p.stars a', function() {
                //     var $star   	= $( this ),
                //         $rating 	= $( this ).closest( '#respond' ).find( '#rating' ),
                //         $container 	= $( this ).closest( '.stars' );
        
                //     $rating.val( $star.text() );
                //     $star.siblings( 'a' ).removeClass( 'active' );
                //     $star.addClass( 'active' );
                //     $container.addClass( 'selected' );
        
                //     return false;
                // });

        });
    });
})(jQuery);