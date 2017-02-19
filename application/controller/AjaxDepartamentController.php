<?php

class AjaxDepartamentController extends BaseAjaxController {

    protected $arrDepartament;
    protected $departamentRepository;

    public function indexAction() {

    }

    public function getAllElementAction() {
        $this->arrDepartament = array();
        $this->departamentRepository = new departamentRepository();
        $this->arrDepartament = $this->departamentRepository->getAllElement();
         $arr = array();
        if (is_array($this->arrDepartament)) {
            foreach ($this->arrDepartament as $value) {
                $arr[] = $value->getArrForXMLDocument();
            }
        }
        $response = array("status" => "ok", "departament" => $arr );
        $this->sendRequest($response);
    }

}
