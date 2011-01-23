<?php

class PHP_I18n_Formatter
{
    private $_str;
    private $_args;
    private $_dic;
    
    public function __construct($str, $args, PHP_I18n_Dic_Abstract $dic)
    {
        $this->_str = $str;
        $this->_args = $args;
        $this->_dic = $dic;
    }

    public function format()
    {
        $result = $this->_str;
        if ($this->_args) {
            $result = preg_replace_callback('/\%([a-zA-Z]*)(\[[a-zA-Z0-9]+?\])+/',
                array($this, '_expandPlaceholder'), $result);
        }
        return $result;
    }

    private function _expandPlaceholder($ms)
    {
        $fname = $ms[1] ? $ms[1] : 'print';
        $paramPath = explode('][',
            substr(self::_cutProcessorName($ms[0]), 1, -1)
        );

        $curParam = $this->_args;
        foreach ($paramPath as $pathKey) {
            $curParam = $curParam[$pathKey];
        }
        return call_user_func_array(
            array($this, '_process' . ucfirst($fname)),
            array($curParam));
    }

    private function _processPrint($param)
    {
        return $param;
    }

    private function _processDecl($param)
    {
        $forms = explode('|', $this->_dic->get($param[1]));
        require_once 'Text/Declension/Factory.php';
        $declension = Text_Declension_Factory::get($this->_dic->getLangId());
        return $declension->process($param[0], $forms);
    }

    private function _cutProcessorName($str)
    {
        return preg_replace('/%([a-zA-Z]*)/', '', $str);
    }
}
