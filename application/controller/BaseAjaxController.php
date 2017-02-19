<?php


class BaseAjaxController {

     protected $queryPar = false;

     public function __construct() {
        $this->queryPar = $this->getQueryParam();
        if ($this->queryPar === FALSE) {
            $this->sendRequest( array('status' => 'error', 'message' => 'mast be input parameter') );
        }
    }

     protected function sendRequest($ajaxRequest) {
        header('Content-Type: text/json');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');
        header('Cache-Control: no-cache, must-revalidate');
        header('Pragma: no-cache');
        echo( json_encode($ajaxRequest) );
        exit;
    }

    protected function getQueryParam() {
        $strParameter = file_get_contents('php://input');
        $queryParam = json_decode($strParameter);
        return $queryParam;
    }

}
