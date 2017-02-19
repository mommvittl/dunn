<?php

class staffMonthModel extends staffModel {

    protected $costOfMonth = 3300;

    public static function fromState($state) {
        return new self($state);
    }

    public function getSalary() {
        $salary = $this->costOfMonth;
        return $salary;
    }

}
