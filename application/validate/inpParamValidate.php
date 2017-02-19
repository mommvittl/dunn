<?php

class inpParamValidate {

    public function __construct() {

    }
    public function pageValidate(&$param) {
        $val = filter_var($param, FILTER_VALIDATE_INT);
        if ($val !== false && $val > 0) {
            $param = $val;
            return TRUE;
        }
        return FALSE;
    }
    public function departamentValidate(&$param) {
        $val = filter_var($param, FILTER_SANITIZE_STRING);
        $departamentRepository = new departamentRepository();
        $dep = new departamentModel(array('title' => $val));
        if (is_object($dep)) {
            $departament = $departamentRepository->findElement($dep);
            if (is_object($departament[0])) {
                $param = $departament[0];
                return TRUE;
            }
        }
        $param = $val;
        return FALSE;

    }
}
