<?php
/**
 * ----------------------------------------------
 * | Author: Andrey Ryzhov (Dune) <info@rznw.ru> |
 * | Site: www.rznw.ru                           |
 * | Phone: +7 (4912) 51-10-23                   |
 * | Date: 19.04.2019                            |
 * -----------------------------------------------
 *
 */


namespace AndyDune\HtmlTable\BuilderElement;

use AndyDune\HtmlTable\Table;

class TableHead implements ElementInterface
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
        if (!$this->table->isHasHead()) {
            return 0;
        }

        return $this->table->head()->getColumnCount();
    }

    public function getHtml()
    {
        if (!$this->table->isHasHead()) {
            return '';
        }

        $rowBuilder = new Head($this->table->head(), $this->getActualMaxColumnCount());
        return $rowBuilder->getHtml();

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