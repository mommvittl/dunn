<?php

class staffRepository extends baseRepository {

    protected function sendQuery() {
        $this->arrResult = array();
        if ($this->result !== false) {
            $this->row = $this->result->fetchAll();
            if ($this->row) {
                foreach ($this->row as $value) {
                    $arr = array(
                        'id_s' => $value['id_s'],
                        'id_staff' => $value['id_staff'],
                        'id_departament' => $value['id_departament'],
                        'position' => $value['position'],
                        'rate_type' => $value['rate_type']
                    );
                    $this->arrResult[] = ( $value['rate_type'] == 'hour' ) ? staffHourModel::fromState($arr) : staffMonthModel::fromState($arr);
                }
                return $this->arrResult;
            }
        }
        return false;
    }

    public function getAllElement($colData = 0, $startData = 0) {
        $start = abs((int) $startData);
        $col = abs((int) $colData);
        $this->strQuery = " SELECT s.*, p.*,d.* FROM `stafflist` as s, `people` as p, `departament` as d "
                . "WHERE s.`id_staff` = p.`id_p` and s.`id_departament` = d.`id_d` ";
        if ($col) {
            $this->strQuery .= "  LIMIT $start , $col";
        }
        $this->result = $this->db->prepare($this->strQuery);
        $this->result->execute(array());
        return $this->sendQuery();
    }

    public function countAllElement() {
        $this->strQuery = " SELECT count(*) FROM `stafflist`  ";
        $this->result = $this->db->prepare($this->strQuery);
        $this->result->execute(array());
        if ($this->result !== false) {
            list($col) = $this->result->fetch();
            return $col;
        }
        return false;
    }

    public function getElementById($id) {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        if ($id !== FALSE) {
            $this->strQuery = " SELECT s.*, p.*,d.* FROM `stafflist` as s, `people` as p, `departament` as d "
                    . "WHERE s.`id_staff` = p.`id_p` and s.`id_departament` = d.`id_d` and s.`id_s` = ? ";
            $this->result = $this->db->prepare($this->strQuery);
            $this->result->execute(array($id));
            if ($this->result !== false) {
                $this->row = $this->result->fetch();
                if ($this->row) {
                    $arr = array(
                        'id_s' => $this->row['id_s'],
                        'id_staff' => $this->row['id_staff'],
                        'id_departament' => $this->row['id_departament'],
                        'position' => $this->row['position'],
                        'rate_type' => $this->row['rate_type']
                    );
                    return ( $this->row['rate_type'] == 'hour' ) ? staffHourModel::fromState($arr) : staffMonthModel::fromState($arr);
                }
            }
            return false;
        }
    }

    public function findElementByArrParameter($arrParamData, $colData = 0, $startData = 0) {
        $start = abs((int) $startData);
        $col = abs((int) $colData);
	
        $arrValue = array();
        $this->strQuery = " SELECT s.*, p.*,d.* FROM `stafflist` as s, `people` as p, `departament` as d "
                . "WHERE s.`id_staff` = p.`id_p` and s.`id_departament` = d.`id_d` ";
        if (is_array($arrParamData)) {
            foreach ($arrParamData as $key => $value) {
                if (in_array(trim($key), array('id_staff', 'id_departament', 'position', 'rate_type'))) {
                    $this->strQuery .= " AND  s.`" . trim($key) . "` = ? ";
                    $arrValue[] = trim($value);
                }
            }
            if ($col) {
                $this->strQuery .= " LIMIT $start , $col";
            }
            $this->result = $this->db->prepare($this->strQuery);
            $this->result->execute($arrValue);

            return $this->sendQuery();
        }
    }

    public function countForFindByArrParameter($arrParamData) {
        $this->strQuery = " SELECT count(*) FROM `stafflist` as s WHERE 1  ";
        $arrValue = array();
        if (is_array($arrParamData)) {
            foreach ($arrParamData as $key => $value) {
                if (in_array(trim($key), array('id_staff', 'id_departament', 'position', 'rate_type'))) {
                    $this->strQuery .= " AND  s.`" . trim($key) . "` = ? ";
                    $arrValue[] = $value;
                }
            }
            $this->result = $this->db->prepare($this->strQuery);
            $this->result->execute($arrValue);
            if ($this->result !== false) {
                list($col) = $this->result->fetch();
                return $col;
            }
        }
        return false;
    }

}
