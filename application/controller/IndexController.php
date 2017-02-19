<?php

class IndexController extends BaseController {

    public function indexAction() {
/*
        $this->strQuery = "INSERT INTO `departament` SET `title` = ? ";
        $this->result = $this->db->prepare($this->strQuery);
        $this->result->execute(array('stock'));
        $this->result->execute(array('managemen'));
        $this->result->execute(array('marketing'));

        $this->strQuery = " INSERT INTO `people` VALUES( NULL, ?, ?, ?)  ";
        $this->result = $this->db->prepare($this->strQuery);
        for ($i = 1; $i < 500; $i++) {
            $name = "nameStaff-" . $i;
            $surname = "surnameStaff-" . $i;
            $birchday = "1990-03-03";
            $this->result->execute(array($name, $surname, $birchday));
        }


        $this->strQuery = " INSERT INTO `stafflist` VALUES( NULL, ?, ?, ?, ?)  ";
        $this->result = $this->db->prepare($this->strQuery);
        for ($i = 1; $i < 500; $i++) {
            $id_staff = $i;
            $id_departament = (  mt_rand(1, 3)  ) ;
            $position = "position" . ( $i % 10 );
            $rate_type = ( mt_rand(0, 1) ) ? "hour" : "month";
            //     echo $rate_type . "<br>";
            $this->result->execute(array($id_staff, $id_departament, $position, $rate_type));
        }
*/


        require_once APP . 'view/index/index.php';
    }

}
