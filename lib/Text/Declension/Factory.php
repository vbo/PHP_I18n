<?php

abstract class Text_Declension_Factory
{
    /**
     * @return Text_Declension_Interface
     */
    public static function get($langId)
    {
        $className = 'Text_Declension_' . ucfirst($langId);
        $path = dirname(__FILE__) . '/' . ucfirst($langId) . '.php';
        if (!file_exists($path)) {
            throw new Text_Declension_FactoryException('No such lang file ' . $path);
        }
        require_once $path;
        if (!class_exists($className)) {
            throw new Text_Declension_FactoryException('No such lang class ' . $className . ' in file ' . $path);
        }        
        return new $className;
    }
}

class Text_Declension_FactoryException extends Exception {}
