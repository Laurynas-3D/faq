<?php

$sql = array();

$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'lfaq` (
    `id_lfaq` int(11) NOT NULL AUTO_INCREMENT,
    `active` TINYINT(1) NOT NULL,
    `date_add` DATETIME NOT NULL,
    `date_upd` DATETIME NOT NULL,
    PRIMARY KEY  (`id_lfaq`)
) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';

$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'lfaq_lang` (
    `id_lfaq` int(11) NOT NULL,
    `id_shop` INT(11) NOT NULL,
    `id_lang` INT(11) NOT NULL,
    `question` TEXT NOT NULL,
    `answer` TEXT NOT NULL,
    PRIMARY KEY  (`id_lfaq`, `id_shop`, `id_lang`)
) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';


foreach ($sql as $query) {
    if (Db::getInstance()->execute($query) == false) {
        return false;
    }
}
