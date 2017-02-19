<?php

class peopleModel extends baseModel {

    protected $arrColumnName = array('id_p', 'name' , 'surname' , 'birchday');
    protected $id_p = false;
    protected $name = false;
    protected $surname = false;
    protected $birchday = false;

    public static function fromState($state) {
        return new self($state);
    }

    public function getArrForXMLDocument() {
        return array('id_p' => $this->id_p, 'name' => $this->name, 'surname' => $this->surname, 'birchday' => $this->birchday );
    }
}
