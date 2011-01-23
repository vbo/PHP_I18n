<?php

require_once 'PHP/I18n/Processor.php';

class PHP_I18n
{
    private $_backend;

    public function __construct(PHP_I18n_Backend $backend)
    {
        $this->_backend = $backend;
    }

    public function get($literalId, $args=null)
    {
        $origin = $this->_backend->get($literalId);
        $processor = new PHP_I18n_Processor($origin, $args, $this->_backend);
        return $processor->expandPlaceholders();
    }
}
