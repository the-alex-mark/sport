<?php
/**
 * Template Name: Тестирование
 */

if (!defined('ABSPATH'))
    exit;
    
// Проверяет страницу поста на защищённость паролем
if (post_password_required()) {
	echo get_the_password_form();
	return;
}

$attributes = [
    [
        'name' => 'Accessories Size',
        'slug' => 'accessories_size'
    ],
    [
        'name' => 'Accessories Type',
        'slug' => 'accessories_type'
    ],
    [
        'name' => 'Регулировка вида вращения',
        'slug' => 'adjust_rotation'
    ],
    [
        'name' => 'Author/Artist',
        'slug' => 'author_artist'
    ],
    [
        'name' => 'Смена вращения на ходу',
        'slug' => 'avto_smena_vraweni9'
    ],
    [
        'name' => 'Bag & Luggage Type',
        'slug' => 'bag_luggage_type'
    ],
    [
        'name' => 'Bedding Pattern',
        'slug' => 'bedding_pattern'
    ],
    [
        'name' => 'Bed & Bath Type',
        'slug' => 'bed_bath_type'
    ],
    [
        'name' => 'Books & Music Type',
        'slug' => 'books_music_type'
    ],
    [
        'name' => 'Бренд',
        'slug' => 'brand'
    ],
    [
        'name' => 'Camera Megapixels',
        'slug' => 'camera_megapixels'
    ],
    [
        'name' => 'Camera Type',
        'slug' => 'camera_type'
    ],
    [
        'name' => 'Емкость',
        'slug' => 'capacity'
    ],
    [
        'name' => 'Программа автоматической смены точки попадания по длине (ближе-дальше) при сохранении скорости вращения мяча',
        'slug' => 'change_point'
    ],
    [
        'name' => 'Cost',
        'slug' => 'cost'
    ],
    [
        'name' => 'Страна производителя',
        'slug' => 'country'
    ],
    [
        'name' => 'Country of Manufacture',
        'slug' => 'country_of_manufacture'
    ],
    [
        'name' => 'Количество метательных головок',
        'slug' => 'count_bits'
    ],
    [
        'name' => 'Количество двигателей метательной головки(число роликов)',
        'slug' => 'count_engines'
    ],
    [
        'name' => 'created_at', //
        'slug' => 'created_at'
    ],
    [
        'name' => 'Custom Design',
        'slug' => 'custom_design'
    ],
    [
        'name' => 'Active From',
        'slug' => 'custom_design_from'
    ],
    [
        'name' => 'Active To',
        'slug' => 'custom_design_to'
    ],
    [
        'name' => 'Custom Layout Update',
        'slug' => 'custom_layout_update'
    ],
    [
        'name' => 'Цвет',
        'slug' => 'cvet'
    ],
    [
        'name' => 'Decor Type',
        'slug' => 'decor_type'
    ],
    [
        'name' => 'Описание',
        'slug' => 'description'
    ],
    [
        'name' => 'Video (embed)',
        'slug' => 'dexxtz_video'
    ],
    [
        'name' => 'Документация',
        'slug' => 'documentation'
    ],
    [
        'name' => 'Electronic Type',
        'slug' => 'electronic_type'
    ],
    [
        'name' => 'Цикл подачи',
        'slug' => 'feeding_cycle'
    ],
    [
        'name' => 'Fit',
        'slug' => 'fit'
    ],
    [
        'name' => 'format',
        'slug' => 'format'
    ],
    [
        'name' => 'Frame Style',
        'slug' => 'frame_style'
    ],
    [
        'name' => 'Image Gallery',
        'slug' => 'gallery'
    ],
    [
        'name' => 'Genre',
        'slug' => 'genre'
    ],
    [
        'name' => 'Allow Gift Message',
        'slug' => 'gift_message_available'
    ],
    [
        'name' => 'Allow Gift Wrapping',
        'slug' => 'gift_wrapping_available'
    ],
    [
        'name' => 'Price for Gift Wrapping',
        'slug' => 'gift_wrapping_price'
    ],
    [
        'name' => 'has_options', //
        'slug' => 'has_options'
    ],
    [
        'name' => 'Регулировка точки вылета по высоте',
        'slug' => 'height_departure'
    ],
    [
        'name' => 'Homeware style',
        'slug' => 'homeware_style'
    ],
    [
        'name' => 'Home & Decor Type',
        'slug' => 'home_decor_type'
    ],
    [
        'name' => 'Base Image',
        'slug' => 'image'
    ],
    [
        'name' => 'Image Label',
        'slug' => 'image_label'
    ],
    [
        'name' => 'Jewelry Type',
        'slug' => 'jewelry_type'
    ],
    [
        'name' => 'Количество',
        'slug' => 'kolichestvo'
    ],
    [
        'name' => 'Крепление сетки',
        'slug' => 'kreplenie_setki'
    ],
    [
        'name' => 'Боковое вращение: число механических ступеней или 360 градусов',
        'slug' => 'lateral_rotation'
    ],
    [
        'name' => 'Length',
        'slug' => 'length'
    ],
    [
        'name' => 'Lens Type',
        'slug' => 'lens_type'
    ],
    [
        'name' => 'Расположение робота',
        'slug' => 'location'
    ],
    [
        'name' => 'Место расположения относительно стола',
        'slug' => 'location_about_table'
    ],
    [
        'name' => 'Luggage Size',
        'slug' => 'luggage_size'
    ],
    [
        'name' => 'Luggage Style',
        'slug' => 'luggage_style'
    ],
    [
        'name' => 'Luggage travel Style',
        'slug' => 'luggage_travel_style'
    ],
    [
        'name' => 'Manufacturer',
        'slug' => 'manufacturer'
    ],
    [
        'name' => 'Материал',
        'slug' => 'material'
    ],
    [
        'name' => 'Примерная (максимальная по интернету) стоимость в руб.',
        'slug' => 'max_price'
    ],
    [
        'name' => 'Максимальная скорострельность',
        'slug' => 'max_rate'
    ],
    [
        'name' => 'Максимальная скорость мяча',
        'slug' => 'max_speed'
    ],
    [
        'name' => 'Media Gallery',
        'slug' => 'media_gallery'
    ],
    [
        'name' => 'Meta Description',
        'slug' => 'meta_description'
    ],
    [
        'name' => 'Meta Keywords',
        'slug' => 'meta_keyword'
    ],
    [
        'name' => 'Meta Title',
        'slug' => 'meta_title'
    ],
    [
        'name' => 'Minimal Price',
        'slug' => 'minimal_price'
    ],
    [
        'name' => 'Примерная (минимальная по интернету) стоимость в руб.',
        'slug' => 'min_price'
    ],
    [
        'name' => 'Минимальная скорострельность',
        'slug' => 'min_rate'
    ],
    [
        'name' => 'Manufacturer\'s Suggested Retail Price',
        'slug' => 'msrp'
    ],
    [
        'name' => 'Display Actual Price',
        'slug' => 'msrp_display_actual_price_type'
    ],
    [
        'name' => 'Apply MAP',
        'slug' => 'msrp_enabled'
    ],
    [
        'name' => 'Разброс мячей по вертикали',
        'slug' => 'my4'
    ],
    [
        'name' => 'Название',
        'slug' => 'name'
    ],
    [
        'name' => 'Necklace Length',
        'slug' => 'necklace_length'
    ],
    [
        'name' => 'Set Product as New from Date',
        'slug' => 'news_from_date'
    ],
    [
        'name' => 'Set Product as New to Date',
        'slug' => 'news_to_date'
    ],
    [
        'name' => 'Occasion',
        'slug' => 'occasion'
    ],
    [
        'name' => 'Display Product Options In',
        'slug' => 'options_container'
    ],
    [
        'name' => 'Page Layout',
        'slug' => 'page_layout'
    ],
    [
        'name' => 'Array',
        'slug' => 'position_on_table'
    ],
    [
        'name' => 'Цена',
        'slug' => 'price'
    ],
    [
        'name' => 'Производитель',
        'slug' => 'proizvoditel'
    ],
    [
        'name' => 'Программа случайного разброса мяча и скорости подачи мячей (рандом)',
        'slug' => 'rand_var_balls'
    ],
    [
        'name' => 'Разброс мячей по-горизонтали',
        'slug' => 'razbros_po_gorizontali'
    ],
    [
        'name' => 'razbros_verical',
        'slug' => 'razbros_verical'
    ],
    [
        'name' => 'Размер',
        'slug' => 'razmer'
    ],
    [
        'name' => 'Регулировка бокового вращения',
        'slug' => 'regulirovka_bokovogo_vraweni9'
    ],
    [
        'name' => 'Регулировка бокового вращения',
        'slug' => 'regylirovka_bok_vraweni9'
    ],
    [
        'name' => 'Remove Compare Link',
        'slug' => 'remove_compare_link'
    ],
    [
        'name' => 'required_options', //
        'slug' => 'required_options'
    ],
    [
        'name' => 'Возможные вращения',
        'slug' => 'rotation'
    ],
    [
        'name' => 'Раздельная регулировка верхнего/нижнего вращения',
        'slug' => 'sep_adjustment_rotation'
    ],
    [
        'name' => 'Shoe size',
        'slug' => 'shoe_size'
    ],
    [
        'name' => 'Shoe type',
        'slug' => 'shoe_type'
    ],
    [
        'name' => 'Краткое описание',
        'slug' => 'short_description'
    ],
    [
        'name' => 'SKU',
        'slug' => 'sku'
    ],
    [
        'name' => 'Small Image',
        'slug' => 'small_image'
    ],
    [
        'name' => 'Small Image Label',
        'slug' => 'small_image_label'
    ],
    [
        'name' => 'Special Price From Date',
        'slug' => 'special_from_date'
    ],
    [
        'name' => 'Special Price',
        'slug' => 'special_price'
    ],
    [
        'name' => 'Special Price To Date',
        'slug' => 'special_to_date'
    ],
    [
        'name' => 'Status',
        'slug' => 'status'
    ],
    [
        'name' => 'Tax Class',
        'slug' => 'tax_class_id'
    ],
    [
        'name' => 'Thumbnail',
        'slug' => 'thumbnail'
    ],
    [
        'name' => 'Thumbnail Label',
        'slug' => 'thumbnail_label'
    ],
    [
        'name' => 'updated_at', //
        'slug' => 'updated_at'
    ],
    [
        'name' => 'URL Key',
        'slug' => 'url_key'
    ],
    [
        'name' => 'url_path', //
        'slug' => 'url_path'
    ],
    [
        'name' => 'Видео о продукте (каждая ссылка на видео должна быть на новой строке)',
        'slug' => 'videos'
    ],
    [
        'name' => 'Visibility',
        'slug' => 'visibility'
    ],
    [
        'name' => 'Выполнение подач',
        'slug' => 'vypolnenie_poda4'
    ],
    [
        'name' => 'Высота',
        'slug' => 'vysota'
    ],
    [
        'name' => 'Weight',
        'slug' => 'weight'
    ],
    [
        'name' => 'Вес',
        'slug' => 'weightt'
    ],
    [
        'name' => 'Ширина',
        'slug' => 'wirina'
    ]
];

// foreach ($attributes as $item) {
//     wc_create_attribute([
// 		'name'         => $item['name'],
// 		'slug'         => $item["slug"],
//         'order_by'     => "name",
// 		'has_archives' => true
// 	]);
// }

echo 'ok';

?>