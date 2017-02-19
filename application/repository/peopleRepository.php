<?php

class peopleRepository extends baseRepository {

    protected function sendQuery() {
        $this->arrResult = array();
        if ($this->result !== false) {
            $this->row = $this->result->fetchAll();
            if ($this->row) {
                foreach ($this->row as $value) {
                    $arr = array('id_p' => (int) $value['id_p'], 'name' => $value['name'], 'surname' => $value['surname'], 'birchday' => $value['birchday']);
                    $this->arrResult[] = peopleModel::fromState($arr);
                }
                return $this->arrResult;
            }
        }
        return false;
    }

    public function getElementById($id = 0) {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        if ($id !== FALSE) {
            $this->strQuery = "SELECT * FROM `people`   where `id_p`=?  ";
            $this->result = $this->db->prepare($this->strQuery);
            $this->result->execute(array($id));
            if ($this->result !== false) {
                $this->row = $this->result->fetch();
                if ($this->row) {
                    $arr = array('id_p' => $this->row['id_p'], 'name' => $this->row['name'], 'surname' => $this->row['surname'], 'birchday' => $this->row['birchday']);
                    return peopleModel::fromState($arr);
                }
            }
            return false;
        }
    }

}
