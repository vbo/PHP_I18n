<?php
ini_set('display_errors', true);
require_once 'lib/config.php';
require_once 'PHP/I18n.php';
require_once 'PHP/I18n/Backend/IniFile.php';

$dicRu = new PHP_I18n(new PHP_I18n_Backend_IniFile('russian', dirname(__FILE__) . '/misc'));
$dicEng = new PHP_I18n(new PHP_I18n_Backend_IniFile('english', dirname(__FILE__) . '/misc'));

echo $dicRu->get('hello');
echo @$dicRu->get('hello1');
echo $dicRu->get('dectest', array(
    'item' => array(1, 'banan'),
    'sum' => array(30, 'rub')
));

echo $dicEng->get('dectest', array(
    'item' => array(1, 'banan'),
    'sum' => array(30, 'rub')
));