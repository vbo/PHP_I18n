<?php

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
        return self::_expandPlaceholders($origin, $args);
    }

    private static function _expandPlaceholders($str, $args)
    {
        $result = $str;
        self::$_args = $args;
        if ($args) {
            $result = preg_replace_callback('/\%([a-zA-Z]*)(\[[a-zA-Z0-9]+?\])+/',
                array(__CLASS__, '_expandPlaceholder'), $result);
        }
        return $result;
    }

    private static function _expandPlaceholder($ms)
    {
        $fname = $ms[1] ? $ms[1] : 'print';
        $paramPath = explode('][',
            substr(self::_cutProcessorName($ms[0]), 1, -1)
        );
        
        $curParam = self::$_args;
        foreach ($paramPath as $pathKey) {
            $curParam = $curParam[$pathKey];
        }
        return call_user_func_array(
            array(__CLASS__, '_process' . ucfirst($fname)),
            array($curParam));
    }

    private static function _processPrint($param)
    {
        return $param;
    }

    private static function _processDecl($param)
    {
        return 'TODO';
    }

    private static function _cutProcessorName($str)
    {
        return preg_replace('/%([a-zA-Z]*)/', '', $str);
    }

    private function __construct() {}
    private function __clone() {}
}
