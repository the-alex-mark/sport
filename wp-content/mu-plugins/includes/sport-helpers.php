<?php

if (!defined('ABSPATH'))
	exit;

if (!function_exists('assets')) {

	/**
	 * Возвращает путь до каталога "assets".
	 * 
	 * @param string $path Расположение файла

	* @return string
	*/
	function assets($path) {
		echo get_template_directory_uri() . "/assets/$path";
	}
}

if (!function_exists('print_o')) {

    /**
     * Выводит объект в виде дерева.
     *
     * @param mixed $data Массив или объект.
     * @param boolean $opened Значение, указывающее следует ли раскрыть все узлы объекта.
     *
     * @return string
     */
    function print_o($data, $open = true) {
        function print_node_o($in, $opened, $margin = 10) {
            if (!is_object($in) && !is_array($in)) return;

            foreach ($in as $key => $value) {
                if (is_object($value) or is_array($value)) {
                    echo '<details style="margin-left: ' . $margin . 'px;" ' . $opened . '>';
                    echo '<summary>';
                    echo (is_object($value)) ? $key . ' {' . count((array)$value) . '}' : $key . ' [' . count($value) . ']';
                    echo '</summary>';
                    print_node_o($value, $opened, $margin + 10);
                    echo '</details>';
                }
                else {
                    switch (gettype($value)) {
                        case 'string': $bgc = 'red'; break;
                        case 'integer': $bgc = 'green'; break;
                    }

                    // echo '<div style="margin-left: ' . $margin . 'px">' . $key . ': <span style="color: ' . $bgc . '">' . $value . '</span> (' . gettype($value) . ')</div>';
                    echo '<div style="margin-left: ' . $margin . 'px">' . $key . ': <span style="color: ' . $bgc . '">' . $value . '</span></div>';
                }
            }
        }

        if ($open) $open = ' open';
        if (is_object($data) or is_array($data)) {
            echo '<div style="font-family: Consolas; background-color: #FFFFFF;">';
            echo '<details' . $open . '>';
            echo '<summary>';
            echo (is_object($data)) ? 'Object {' . count((array)$data) . '}' : 'Array [' . count($data) . ']';
            echo '</summary>';
            print_node_o($data, $open);
            echo '</details>';
            echo '</div>';
        }
        else { print_r($data . '<br>'); }
    }
}

if (!function_exists('get_pr')) {

	/**
	 * Отладочная функция `print_r`
	 *
	 * @param mixed $var
	 * @param boolean $die
	 */
	function get_pr($var, $die = true) {
		echo '<pre>';
		print_r($var);
        echo '</pre>';
        
        if ($die)
            die();
	}
}

if (!function_exists('get_vd')) {

	/**
	 * Отладочная функция `var_dump`
	 *
	 * @param mixed $var
	 * @param boolean $die
	 */
	function get_vd($var, $die = true) {
		echo '<pre>';
		var_dump($var);
        echo '</pre>';
        
		if ($die)
			die();
	}
}

if (!function_exists('get_num_ending')) {

	/**
	 * Склонения числительных
	 *
	 * @param $number
	 * @param $ending_array
	 *
	 * @return mixed
	 */
	function get_num_ending($number, $ending_array) {
		$number = $number % 100;
		if ($number >= 11 && $number <= 19) {
			$ending = $ending_array[2];
		} else {
			$i = $number % 10;
			switch ($i) {
				case 1:
					$ending = $ending_array[0];
                    break;
                    
				case 2:
				case 3:
				case 4:
					$ending = $ending_array[1];
                    break;
                    
				default:
					$ending = $ending_array[2];
			}
		}
		
		return $ending;
	}
}
if (!function_exists('add_admin_menu_separator')) {

	/**
	 * 
	 */
	function add_admin_menu_separator($position) {
		global $menu;
    	array_splice($menu, $position, 0, [ [ '', 'read', "separator", '', 'wp-menu-separator' ] ]);
	}
}