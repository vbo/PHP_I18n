<?php
ini_set('display_errors', true);
require_once 'lib/config.php';
require_once 'PHP/I18n.php';
require_once 'PHP/I18n/Backend/IniFile.php';

PHP_I18n::init(new PHP_I18n_Backend_IniFile('ru', dirname(__FILE__) . '/misc'));

echo @PHP_I18n::get('hello1');
echo PHP_I18n::get('dectest', array(
    'item' => array(5, 'banan'),
    'sum' => array(30, 'rub')
));