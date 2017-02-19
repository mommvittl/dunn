<?php

class baseModel {

    protected $arrColumnName = array();

    public function __construct($arrParameter = array()) {
        if (!empty($arrParameter) && (is_array($arrParameter))) {
            foreach ($arrParameter as $key => $value) {
                if (in_array($key, $this->arrColumnName)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function __get($parametrName) {
        return (isset($this->$parametrName) ) ? $this->$parametrName : false;
    }

    public function __set($parametrName, $valueName) {
        if (in_array($parametrName, $this->arrColumnName)) {
            $this->$parametrName = $valueName;
        }
    }

    public function __isset($parametrName) {
        return (isset($this->$parametrName)) ? true : false;
    }

}
