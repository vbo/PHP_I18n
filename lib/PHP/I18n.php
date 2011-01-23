<?php

class PHP_I18n
{
    private static $_backend;

    public static function init(PHP_I18n_Backend $backend)
    {
        self::$_backend = $backend;
    }

    public static function get($literalId)
    {
        return self::$_backend->get($literalId);
    }

    private function __construct() {}
    private function __clone() {}
}
