<?php

if (!defined('ABSPATH'))
    exit;

/**
 * 
 */
class sport_organization {

    /**
     * 
     */
    public function __construct() {
        $this->name        = self::get_name();
        $this->description = self::get_description();
        $this->phones      = self::get_phones();
        $this->address     = self::get_address();
        $this->email       = self::get_email();
        $this->forum       = self::get_forum();
        $this->requisites  = self::get_requisites();
        $this->social      = self::get_social();
    }

    /**
     * Возвращает наименование.
     */
    static function get_name() {
        return esc_html(get_option('org_info__name'));
    }

    /**
     * Возвращает описание.
     */
    static function get_description() {
        return esc_html(get_option('org_info__desc'));
    }

    /**
     * Возвращает список телефонов.
     */
    static function get_phones() {
        $result = [];

        if ($phone_1 = esc_html(get_option('org_info__phone1')))
            $result[] = $phone_1;

        if ($phone_2 = esc_html(get_option('org_info__phone2')))
            $result[] = $phone_2;

        if ($phone_3 = esc_html(get_option('org_info__phone3')))
            $result[] = $phone_3;
        
        return $result;
    }

    /**
     * Возвращает адрес.
     */
    static function get_address() {
        return esc_html(get_option('org_info__address'));
    }

    /**
     * Возвращает электронную почту.
     */
    static function get_email() {
        return esc_html(get_option('org_info__email'));
    }

    /**
     * Возвращает ссылку на веб-форум.
     */
    static function get_forum() {
        return esc_html(get_option('org_info__forum'));
    }

    /**
     * Возвращает реквизиты.
     */
    static function get_requisites() {
        $result = [];

        if ($inn = esc_html(get_option('org_requisites__inn'))) {
            $result['inn'] = [
                'title' => __('ИНН', 'sport'),
                'desc'  => __('Идентификационный номер налогоплательщика', 'sport'),
                'value' => $inn
            ];
        }

        if ($okopf = esc_html(get_option('org_requisites__okopf'))) {
            $result['okopf'] = [
                'title' => __('ОКОПФ', 'sport'),
                'desc'  => __('Общероссийский классификатор организационно-правовых форм', 'sport'),
                'value' => $okopf
            ];
        }

        if ($kpp = esc_html(get_option('org_requisites__kpp'))) {
            $result['kpp'] = [
                'title' => __('КПП', 'sport'),
                'desc'  => __('Код причины постановки', 'sport'),
                'value' => $kpp
            ];
        }

        if ($okfs = esc_html(get_option('org_requisites__okfs'))) {
            $result['okfs'] = [
                'title' => __('ОКФС', 'sport'),
                'desc'  => __('Общероссийского классификатора форм собственности', 'sport'),
                'value' => $okfs
            ];
        }
        
        if ($okpo = esc_html(get_option('org_requisites__okpo'))) {
            $result['okpo'] = [
                'title' => __('ОКПО', 'sport'),
                'desc'  => __('Общероссийский классификатор предприятий и организаций', 'sport'),
                'value' => $okpo
            ];
        }
        
        if ($okdp = esc_html(get_option('org_requisites__okdp'))) {
            $result['okdp'] = [
                'title' => __('ОКДП', 'sport'),
                'desc'  => __('Общероссийский классификатор видов экономической деятельности, продукции и услуг', 'sport'),
                'value' => $okdp
            ];
        }
        
        if ($ogrn = esc_html(get_option('org_requisites__ogrn'))) {
            $result['ogrn'] = [
                'title' => __('ОГРН', 'sport'),
                'desc'  => __('Основной государственный регистрационный номер', 'sport'),
                'value' => $ogrn
            ];
        }
        
        if ($okato = esc_html(get_option('org_requisites__okato'))) {
            $result['okato'] = [
                'title' => __('ОКАТО', 'sport'),
                'desc'  => __('Общероссийский классификатор объектов административно-территориального деления', 'sport'),
                'value' => $okato
            ];
        }
        
        if ($okved = esc_html(get_option('org_requisites__okved'))) {
            $result['okved'] = [
                'title' => __('ОКВЕД', 'sport'),
                'desc'  => __('Общероссийский классификатор видов экономической деятельности', 'sport'),
                'value' => $okved
            ];
        }
        
        if ($rs = esc_html(get_option('org_requisites__rs'))) {
            $result['rs'] = [
                'title' => __('Р/с', 'sport'),
                'desc'  => __('Расчётный счёт', 'sport'),
                'value' => $rs
            ];
        }
        
        if ($bank = esc_html(get_option('org_requisites__bank'))) {
            $result['bank'] = [
                'title' => __('Банк', 'sport'),
                'desc'  => __('Банк', 'sport'),
                'value' => $bank
            ];
        }
        
        return $result;
    }

    /**
     * Возвращает список социальных сетей.
     */
    static function get_social() {
        $result = [];

        if ($vk = esc_html(get_option('org_requisites__vk'))) {
            $result['vk'] = [
                'title' => __('ВКонтакте', 'sport'),
                'url'   => $vk
            ];
        }

        if ($ok = esc_html(get_option('org_requisites__ok'))) {
            $result['ok'] = [
                'title' => __('Однокласники', 'sport'),
                'url'   => $ok
            ];
        }

        if ($facebook = esc_html(get_option('org_requisites__facebook'))) {
            $result['facebook'] = [
                'title' => __('Facebook', 'sport'),
                'url'   => $facebook
            ];
        }

        if ($instagram = esc_html(get_option('org_requisites__instagram'))) {
            $result['instagram'] = [
                'title' => __('Instagram', 'sport'),
                'url'   => $instagram
            ];
        }

        if ($skype = esc_html(get_option('org_requisites__skype'))) {
            $result['skype'] = [
                'title' => __('Skype', 'sport'),
                'url'   => $skype
            ];
        }

        return $result;
    }
}

$organization = new sport_organization();
return $organization;