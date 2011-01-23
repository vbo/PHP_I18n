<?php
ini_set('display_errors', true);
require_once 'lib/config.php';
require_once 'PHP/I18n.php';
require_once 'PHP/I18n/Backend/IniFile.php';

$dic = new PHP_I18n(new PHP_I18n_Backend_IniFile('russian', dirname(__FILE__) . '/misc'));

echo $dic->get('hello');
echo @$dic->get('hello1');
echo $dic->get('dectest', array(
    'item' => array(1, 'banan'),
    'sum' => array(30, 'rub')
));