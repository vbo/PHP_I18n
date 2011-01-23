<?php

require_once 'Text/Declension/Interface.php';

class Text_Declension_Russian implements Text_Declension_Interface
{
    public function process($count, array $forms)
    {
        $count = floor($count) % 100;
        if ($count >= 5 && $count <= 20) return $forms[2];
        
        $count = $count % 10;
        if ($count == 1) return $forms[0];
        if ($count >= 2 && $count <= 4) return $forms[1];
        return $forms[2];
    }
}
