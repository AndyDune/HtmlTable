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


namespace AndyDune\HtmlTable;

use AndyDune\HtmlTable\Element\Row;
use AndyDune\HtmlTable\Part\AttributesAwareTrait;

class Table
{
    use AttributesAwareTrait;

    protected $maxCellsInRow = 0;

    /**
     * @var Row[]
     */
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