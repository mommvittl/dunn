<?php

class errorController {

    public function getException( $ex = ' ' ) {
        $errCode = $ex->getCode();
        $errMessage = $ex->getMessage();
        switch ($errCode){
           case 404 :
               require_once APP . 'view/error/fnferr.php';
               break;
           case 500 :
               require_once APP . 'view/error/serverr.php';
               break;
           default :
                require_once APP . 'view/error/index.php';
               break;
        }

    }

}
