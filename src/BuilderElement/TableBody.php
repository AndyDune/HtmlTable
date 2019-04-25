<?php
/**
 *
 * PHP version >= 5.6
 *
 * @package andydune/html-table
 * @link  https://github.com/AndyDune/HtmlTable for the canonical source repository
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Andrey Ryzhov  <info@rznw.ru>
 * @copyright 2019 Andrey Ryzhov
 */

namespace AndyDune\HtmlTable\BuilderElement;

class TableBody extends TableHead
{

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
            $rowBuilder->setCellsOrderMap($this->cellOrderMap);
            $content .= $rowBuilder->getHtml();
        }
        return $content;
    }

}