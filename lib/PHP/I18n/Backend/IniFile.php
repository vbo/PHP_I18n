<?php

require_once 'PHP/I18n/Backend.php';

class PHP_I18n_Backend_IniFile extends PHP_I18n_Backend
{
    private $_langId;
    private $_dic;
    private $_workDir;

    public function __construct($langName, $workDir)
    {
        $this->_langId = $langName;
        $this->_workDir = $workDir[strlen($workDir) - 1] == '/' ? $workDir : $workDir . '/';

        $dicFname = $this->_workDir . $this->_langId . '.ini';
        if (!file_exists($dicFname)) {
            throw new PHP_I18n_Backend_IniFileException('No such file ' . $dicFname);
        }
        $this->_dic = parse_ini_file($dicFname);
    }

    public function get($literalId)
    {
        if (!array_key_exists($literalId, $this->_dic) && error_reporting()) {
            throw new PHP_I18n_Backend_IniFileException('No such literal ' . $literalId);
        }
        return $this->_dic[$literalId];
    }

    public function getLangId()
    {
        return $this->_langId;
    }
}

class PHP_I18n_Backend_IniFileException extends Exception {};