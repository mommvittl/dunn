<?php

class EmployesController extends BaseController {

    protected $arrParam = null;
    protected $page = 1;
    protected $departament = null;
    protected $departamentId = 0;


    public function indexAction() {
        if (func_num_args()) {
            $this->getInputParameterAction(func_get_args());
        }
        require_once APP . 'view/employes/index.php';
    }

    public function getInputParameterAction($param) {
	
        $validator = new inpParamValidate();
       
        if (is_numeric($param[0]) && $validator->pageValidate($param[0])) {
            $this->page = $param[0];
        } elseif (is_string($param[0]) && $validator->departamentValidate($param[0])) {
            $this->departament = $param[0];
            $this->departamentId = $this->departament->id_d;
        }

        if (isset($param[1]) && $validator->pageValidate($param[1])) {
            $this->page = $param[1];
        }
        return;
    }

}
