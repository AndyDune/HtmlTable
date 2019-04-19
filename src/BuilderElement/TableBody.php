<?php
/**
 * ----------------------------------------------
 * | Author: Andrey Ryzhov (Dune) <info@rznw.ru> |
 * | Site: www.rznw.ru                           |
 * | Phone: +7 (4912) 51-10-23                   |
 * | Date: 17.04.2019                            |
 * -----------------------------------------------
 *
 */


namespace AndyDune\HtmlTable\BuilderElement;

use AndyDune\HtmlTable\Table;

class TableBody implements ElementInterface
{
    /**
     * @var Table
     */
    protected $table;

    protected $actualMaxColumnCount = null;

    public function __construct(Table $table)
    {
        $this->table = $table;
    }

    public function getMaxRowCount()
    {
        $rows = $this->table->getRows();

        $maxColumnCount = 0;
        foreach ($rows as $row) {
            if ($row->getColumnCount() > $maxColumnCount) {
                $maxColumnCount = $row->getColumnCount();
            }
        }
        return $maxColumnCount;
    }

    public function getHtml()
    {
        $content = '';
        $rows = $this->table->getRows();

        foreach ($rows as $row) {
            $rowBuilder = new Row($row, $this->getActualMaxColumnCount());
            $content .= $rowBuilder->getHtml();
        }
        return $content;
    }

    /**
     * @return null
     */
    public function getActualMaxColumnCount()
    {
        return $this->actualMaxColumnCount;
    }

    /**
     * @param int $actualMaxColumnCount
     * @return $this
     */
    public function setActualMaxColumnCount($actualMaxColumnCount)
    {
        $this->actualMaxColumnCount = $actualMaxColumnCount;
        return $this;
    }

}