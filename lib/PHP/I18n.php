<?php

require_once 'PHP/I18n/Processor.php';
require_once 'PHP/I18n/Dic/Abstract.php';

class PHP_I18n
{
    private $_dic;

    public function __construct(PHP_I18n_Dic_Abstract $dic)
    {
        $this->_dic = $dic;
    }

    public function translate($literalId, $args=null)
    {
        $origin = $this->_dic->get($literalId);
        $processor = new PHP_I18n_Formatter($origin, $args, $this->_dic);
        return $processor->format();
    }
}
