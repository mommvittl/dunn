<?php

class staffModel extends baseModel {

    protected $arrColumnName = array('id_s', 'id_staff', 'people', 'id_departament', 'departament', 'position', 'rate_type', 'salary');
    protected $id_s = false;
    protected $id_staff = false;
    protected $people = false;
    protected $id_departament = false;
    protected $departament = false;
    protected $position = false;
    protected $rate_type = false;
    protected $salary = false;

    public function __construct($arrParameter = array()) {
        parent::__construct($arrParameter);
        if (!is_object($this->people) && $this->id_staff) {
            $peopleRepository = new peopleRepository;
            $this->people = $peopleRepository->getElementById($this->id_staff);
        }
        if (!is_object($this->departament) && $this->id_departament) {
            $departamentRepository = new departamentRepository;
            $this->departament = $departamentRepository->getElementById($this->id_departament);
        }
        $this->salary = $this->getSalary();
    }

    public static function fromState($state) {
        return new self($state);
    }

    public function getArrForXMLDocument() {
        $arr = array(
            'id_s' => $this->id_s,
            'id_staff' => $this->id_staff,
            'id_departament' => $this->id_departament,
            'position' => $this->position,
            'rate_type' => $this->rate_type,
            'salary' => $this->salary
        );
        if (is_object($this->people)) {
            $arr['name'] = $this->people->name;
            $arr['surname'] = $this->people->surname;
            $arr['birchday'] = $this->people->birchday;
        }
        if (is_object($this->departament)) {
            $arr['title'] = $this->departament->title;
        }
        return $arr;
    }

    public function getSalary() {
        return false;
    }

    public function __get($parametrName) {
        if (isset($this->$parametrName)) {
            return $this->$parametrName;
        } elseif (is_object($this->people) && isset($this->people->$parametrName)) {
            return $this->people->$parametrName;
        } elseif (is_object($this->departament) && isset($this->departament->$parametrName)) {
            return $this->departament->$parametrName;
        }
    }

    public function __set($parametrName, $valueName) {
        if (in_array($parametrName, $this->arrColumnName)) {
            $this->$parametrName = $valueName;
        } elseif (is_object($this->people) && in_array($parametrName, $this->people->arrColumnName)) {
            $this->people->$parametrName = $valueName;
        } elseif (is_object($this->departament) && in_array($parametrName, $this->departament->arrColumnName)) {
            $this->departament->$parametrName = $valueName;
        }
    }

}
