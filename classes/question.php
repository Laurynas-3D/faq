<?php

class LfaqQuestion extends ObjectModel
{
    public $id_lfaq;

    public $active;

    public $question;

    public $answer;

    public $date_add;

    public $date_upd;

    public static $definition = array(
        'table' => 'lfaq',
        'primary' => 'id_lfaq',
        'multilang' => true,
        'multilang_shop' => true,
        'fields' => array(
            'active' => array('type' => self::TYPE_INT, 'validate' => 'isBool', 'size' => 1),
            'question' => array('type' => self::TYPE_STRING, 'validate' => 'isString', 'lang' => true),
            'answer' => array('type' => self::TYPE_HTML, 'lang' => true, 'validate' => 'isCleanHtml'),
            'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
            'date_upd' => array('type' => self::TYPE_DATE, 'validate' => 'isDate')
        ),
    );

    public static function getFaq()
    {
        $context = Context::getContext();
        $idShop = $context->shop->id;
        $idLang = $context->language->id;

        return Db::getInstance()->executeS('
            SELECT lfl.`question`, lfl.`answer`
            FROM `' . _DB_PREFIX_ . 'lfaq_lang` AS lfl
            LEFT JOIN `' . _DB_PREFIX_ . 'lfaq` AS lf ON (lfl.`id_lfaq` = lf.`id_lfaq`) 
            WHERE lfl.id_shop = ' . (int)$idShop . ' 
            AND lfl.id_lang = ' . (int)$idLang . '
            AND lf.active = 1
            AND lfl.`answer` != ""
            AND lfl.`question` != "";
         ');
    }

}