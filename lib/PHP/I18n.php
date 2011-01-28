<?php

require_once 'Text/Formatter.php';

class PHP_I18n
{
    private $_dic;

    public function __construct(Struct_Dic_Abstract $dic)
    {
        $this->_dic = $dic;
    }

    public function translate($literalId, $args=null)
    {
        $origin = $this->_dic->get($literalId);
        $processor = new Text_Formatter($origin, $args, $this->_dic);
        return $processor->format();
    }
}
