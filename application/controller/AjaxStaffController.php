<?php

class AjaxStaffController extends BaseAjaxController {

    public function getElementAction() {
	$valid = new queryStaffValidate();
	$resval = $valid->validate($this->queryPar);
	
        if (!$resval ) {
            $this->sendRequest(array("status" => "error", "message" => "incorect query"));
        }
        $page = $this->queryPar->page;
        $size = $this->queryPar->size;
        $departament = $this->queryPar->departament;
        $staffRepository = new staffRepository;
	
        if ($departament) {
            $arrParam = array('id_departament' => $departament);
            $len = $staffRepository->countForFindByArrParameter($arrParam);
            $pager = new pagerModel($len, $size);
            list( $newPage, $pageStr ) = $pager->getArrPage($page);
            $arrStaff = $staffRepository->findElementByArrParameter($arrParam, $size, $size * ( $newPage - 1));

        } else {

            $len = $staffRepository->countAllElement();
            $pager = new pagerModel($len, $size);
            list( $newPage, $pageStr ) = $pager->getArrPage($page);
            $arrStaff = $staffRepository->getAllElement( $size, $size * ( $newPage - 1));

        }
        $arr = array() ;

        foreach( $arrStaff as $value  ){
         $arr[] = $value->getArrForXMLDocument();
        }


        $response = array("status" => "ok", "departament" => $departament, "size" => $size, "page" => $newPage, "len" => $len, "pager" => $pageStr , 'arrStaff' => $arr);
        $this->sendRequest($response);
    }

}
