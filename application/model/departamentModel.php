<?php

class departamentModel extends baseModel {

    protected $arrColumnName = array('id_d', 'title');
    protected $id_d = false;
    protected $title = false;

    public static function fromState($state) {
        return new self($state);
    }

    public function getArrForXMLDocument() {
        return array('id_d' => $this->id_d, 'title' => $this->title);
    }


}
