<?php


namespace AndyDune\HtmlTable;

use AndyDune\HtmlTable\Element\Row;

class Table
{
    protected $maxCellsInRow = 0;

    protected $rows = [];

    /**
     * @return Row
     */
    public function row()
    {
        $row = new Row($this);
        $this->rows[] = $row;
        return $row;
    }
}