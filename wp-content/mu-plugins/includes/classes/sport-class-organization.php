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
                'title' => 'ИНН',
                'desc'  => 'Идентификационный номер налогоплательщика',
                'value' => $inn
            ];
        }

        if ($okopf = esc_html(get_option('org_requisites__okopf'))) {
            $result['okopf'] = [
                'title' => 'ОКОПФ',
                'desc'  => 'Общероссийский классификатор организационно-правовых форм',
                'value' => $okopf
            ];
        }

        if ($kpp = esc_html(get_option('org_requisites__kpp'))) {
            $result['kpp'] = [
                'title' => 'КПП',
                'desc'  => 'Код причины постановки',
                'value' => $kpp
            ];
        }

        if ($okfs = esc_html(get_option('org_requisites__okfs'))) {
            $result['okfs'] = [
                'title' => 'ОКФС',
                'desc'  => 'Общероссийского классификатора форм собственности',
                'value' => $okfs
            ];
        }
        
        if ($okpo = esc_html(get_option('org_requisites__okpo'))) {
            $result['okpo'] = [
                'title' => 'ОКПО',
                'desc'  => 'Общероссийский классификатор предприятий и организаций',
                'value' => $okpo
            ];
        }
        
        if ($okdp = esc_html(get_option('org_requisites__okdp'))) {
            $result['okdp'] = [
                'title' => 'ОКДП',
                'desc'  => 'Общероссийский классификатор видов экономической деятельности, продукции и услуг',
                'value' => $okdp
            ];
        }
        
        if ($ogrn = esc_html(get_option('org_requisites__ogrn'))) {
            $result['ogrn'] = [
                'title' => 'ОГРН',
                'desc'  => 'Основной государственный регистрационный номер',
                'value' => $ogrn
            ];
        }
        
        if ($okato = esc_html(get_option('org_requisites__okato'))) {
            $result['okato'] = [
                'title' => 'ОКАТО',
                'desc'  => 'Общероссийский классификатор объектов административно-территориального деления',
                'value' => $okato
            ];
        }
        
        if ($okved = esc_html(get_option('org_requisites__okved'))) {
            $result['okved'] = [
                'title' => 'ОКВЕД',
                'desc'  => 'Общероссийский классификатор видов экономической деятельности',
                'value' => $okved
            ];
        }
        
        if ($rs = esc_html(get_option('org_requisites__rs'))) {
            $result['rs'] = [
                'title' => 'Р/с',
                'desc'  => 'Расчётный счёт',
                'value' => $rs
            ];
        }
        
        if ($bank = esc_html(get_option('org_requisites__bank'))) {
            $result['bank'] = [
                'title' => 'Банк',
                'desc'  => 'Банк',
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
                'title' => 'ВКонтакте',
                'url'   => $vk
            ];
        }

        if ($ok = esc_html(get_option('org_requisites__ok'))) {
            $result['ok'] = [
                'title' => 'Однокласники',
                'url'   => $ok
            ];
        }

        if ($facebook = esc_html(get_option('org_requisites__facebook'))) {
            $result['facebook'] = [
                'title' => 'Facebook',
                'url'   => $facebook
            ];
        }

        if ($instagram = esc_html(get_option('org_requisites__instagram'))) {
            $result['instagram'] = [
                'title' => 'Instagram',
                'url'   => $instagram
            ];
        }

        if ($skype = esc_html(get_option('org_requisites__skype'))) {
            $result['skype'] = [
                'title' => 'Skype',
                'url'   => $skype
            ];
        }

        return $result;
    }
}

$organization = new sport_organization();
return $organization;