<?php

class pagerModel {

    protected $page;
    protected $maxPage;
    protected $lenghtRow = 7;
    protected $countElement;
    protected $sizeArrStaff;
    protected $sizeResultTable;
    protected $arrPage = array();
    protected $arrResult = array();

    public function __construct($countElementData, $sizeResultTableData) {
        $this->sizeResultTable = (int) $sizeResultTableData;
        $this->countElement = (int) $countElementData;
        if ($this->countElement < 1) {
            $this->countElement = 1;
        }
        if ($this->sizeResultTable < 1) {
            $this->sizeResultTable = 1;
        }
        $this->maxPage = (int) ceil($this->countElement / $this->sizeResultTable);
    }

    public function getArrPage($pageData) {
        $this->page = (int) $pageData;
        if ($this->page < 1) {
            $this->page = 1;
        }
        if ($this->page > $this->maxPage) {
            $this->page = $this->maxPage;
        }
        if ($this->maxPage <= 1) {
            return array(1, array());
        }
        $this->arrResult = array();
        $this->arrPage = $this->myf_row_links();
        ksort($this->arrPage);
        return array($this->page, $this->arrPage);
    }

    protected function myf_row_links() {
        if ($this->maxPage <= $this->lenghtRow) {
            for ($i = 0; $i < $this->maxPage; $i++) {
                $this->arrResult[$i] = (int) ($i + 1);
            }
            return $this->arrResult;
        }
        $this->arrResult[0] = 1;
        $this->arrResult[$this->lenghtRow - 1] = $this->maxPage;

        if ($this->page < ceil($this->lenghtRow / 2)) {
            for ($i = 1; $i < ($this->lenghtRow - 2); $i++)
                $this->arrResult[$i] = (int) ($i + 1);
            $this->arrResult[$this->lenghtRow - 2] = -1;
            return $this->arrResult;
        }
        if ($this->page > ($this->maxPage - ceil($this->lenghtRow / 2))) {
            $this->arrResult[1] = -1;
            for ($i = 2; $i < ($this->lenghtRow - 1); $i++)
                $this->arrResult[$i] = (int) ( $this->maxPage + $i - $this->lenghtRow + 1);
            return $this->arrResult;
        }
        $this->arrResult[1] = -1;
        $this->arrResult[$this->lenghtRow - 2] = -1;
        for ($i = 2; $i < ($this->lenghtRow - 2); $i++)
            $this->arrResult[$i] = (int) ($this->page - floor($this->lenghtRow / 2) + $i);
        return $this->arrResult;
    }

}
