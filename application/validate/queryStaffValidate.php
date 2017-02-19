<?php

class queryStaffValidate {

    public function validate($param) {
        if (!is_object($param) || !isset($param->page) || !isset($param->size) || !isset($param->departament)) {
            return FALSE;
        }
        $param->page = filter_var($param->page, FILTER_VALIDATE_INT);
        $param->size = filter_var($param->size, FILTER_VALIDATE_INT);
        $param->departament = filter_var($param->departament, FILTER_VALIDATE_INT);
        if ($param->page === false || $param->size === FALSE || $param->departament === FALSE) {
            return FALSE;
        }
        return TRUE;
    }

}
