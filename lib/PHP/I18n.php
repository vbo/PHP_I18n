<?php

require_once 'PHP/I18n/Processor.php';

class PHP_I18n
{
    private static $_backend;
    private static $_args;

    public static function init(PHP_I18n_Backend $backend)
    {
        self::$_backend = $backend;
    }

    public static function get($literalId, $args=null)
    {
        $origin = self::$_backend->get($literalId);
        $processor = new PHP_I18n_Processor($origin, $args);
        return $processor->expandPlaceholders();
    }   

    private function __construct() {}
    private function __clone() {}
}
