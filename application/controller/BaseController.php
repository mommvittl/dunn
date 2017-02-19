<?php

abstract class BaseController {

    protected $db = null;
    protected $strQuery;
    protected $result;
    protected $row;

    public function __construct() {
        $this->db = PDOLib::getInstance()->getPdo();
    }

}
