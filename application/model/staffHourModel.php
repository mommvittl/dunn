<?php

class staffHourModel extends staffModel {

    protected $hour = 30;
    protected $costOfHour = 100;
			
    public static function fromState($state) {
        return new self($state);
    }

    public function getSalary() {
        $salary = $this->costOfHour * $this->hour;
        return $salary;
    }

}
