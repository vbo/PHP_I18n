<?php
ini_set('display_errors', true);
ini_set('errors_reporting', E_ALL);
require_once 'lib/config.php';
require_once 'PHP/I18n.php';
require_once 'PHP/I18n/Dic/IniFile.php';

echo tr('hello'), "\n";
echo tr('dectest', array(
    'item' => array(2, 'banan'),
    'sum' => array(30, 'rub')
));
echo "\n";

function tr($id, $args=null)
{
    static $dic;
    if ($dic === null) {
        $lang = 'russian';
        if (@$_GET['lang']) $lang = $_GET['lang'];
        $storage = new PHP_I18n_Dic_IniFile($lang, dirname(__FILE__) . '/misc');
        $dic = new PHP_I18n($storage);
    }
    return $dic->translate($id, $args);
}