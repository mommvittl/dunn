<?php

class departamentRepository extends baseRepository {

    protected function sendQuery() {
        $this->arrResult = array();
        if ($this->result !== false) {
            $this->row = $this->result->fetchAll();
            if ($this->row) {
                foreach ($this->row as $value) {
                    $arr = array('id_d' => (int) $value['id_d'], 'title' => $value['title']);
                    $this->arrResult[] = departamentModel::fromState($arr);
                }
                return $this->arrResult;
            }
        }
        return false;
    }

    public function getElementById($id = 0) {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        if ($id !== FALSE) {
            $this->strQuery = "SELECT * FROM `departament`   where `id_d`=?  ";
            $this->result = $this->db->prepare($this->strQuery);
            $this->result->execute(array($id));
            if ($this->result !== false) {
                $this->row = $this->result->fetch();
                if ($this->row) {
                    $arr = array('id_d' => $this->row['id_d'], 'title' => $this->row['title']);
                    return departamentModel::fromState($arr);
                }
            }
            return false;
        }
    }

    public function findElement($elementData) {
        $this->strQuery = "SELECT * FROM `departament` where `title`=?  ";
        $this->result = $this->db->prepare($this->strQuery);
        $this->result->execute(array($elementData->title));
        return $this->sendQuery();
    }

    public function getAllElement() {
        $this->strQuery = "SELECT * FROM `departament`  ";
        $this->result = $this->db->prepare($this->strQuery);
        $this->result->execute(array());
        return $this->sendQuery();
    }

}
