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


class TableHead extends TableBody
{

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
}