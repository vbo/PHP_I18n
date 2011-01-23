<?php

require_once 'Text/Declension/Interface.php';

class Text_Declension_English implements Text_Declension_Interface
{
    public function process($count, array $forms)
    {
        if ($count > 1) {
            return $forms[1];
        }
        return $forms[0];
    }
}
