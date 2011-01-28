<?php

require_once 'Struct/Dic/Abstract.php';

class Struct_Dic_IniFile extends Struct_Dic_Abstract
{
    private $_dicId;
    private $_dic;
    private $_workDir;

    public function __construct($dicId, $workDir)
    {
        $this->_dicId = $dicId;
        $this->_workDir = $workDir[strlen($workDir) - 1] == '/' ? $workDir : $workDir . '/';

        $dicFname = $this->_workDir . $this->_dicId . '.ini';
        if (!file_exists($dicFname)) {
            throw new PHP_I18n_Backend_IniFileException('No such file ' . $dicFname);
        }
        $this->_dic = parse_ini_file($dicFname);
    }

    public function get($key)
    {
        if (!array_key_exists($key, $this->_dic) && error_reporting()) {
            throw new PHP_I18n_Backend_IniFileException('No such key ' . $key);
        }
        return @$this->_dic[$key];
    }

    public function getDicId()
    {
        return $this->_dicId;
    }

    public function getDicLang()
    {
        return $this->_dicId;
    }
}

class PHP_I18n_Backend_IniFileException extends Exception {};