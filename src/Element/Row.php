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


namespace AndyDune\HtmlTable\Element;

use AndyDune\HtmlTable\Part\AttributesAwareInterface;
use AndyDune\HtmlTable\Part\AttributesAwareTrait;
use AndyDune\HtmlTable\Part\ContentAwareTrait;
use AndyDune\HtmlTable\Table;

class Row implements AttributesAwareInterface
{
    use AttributesAwareTrait;
    use ContentAwareTrait;

    /**
     * @var Cell[]
     */
    protected $cells = [];

    /**
     * @var Table
     */
    protected $table;

    protected $columnCount = 0;

    public function __construct(Table $table)
    {
        $this->table = $table;
    }

    /**
     * @return Cell
     */
    public function cell()
    {
        $cell = new Cell($this);
        $this->addColumnCount();
        $this->cells[] = $cell;
        return $cell;
    }

    /**
     * @return Table
     */
    public function getTable()
    {
        return $this->table;
    }


    /**
     * @return int
     */
    public function getColumnCount()
    {
        return $this->columnCount;
    }

    /**
     * @param int $columnCount
     */
    public function addColumnCount($columnCount = 1)
    {
        $this->columnCount += $columnCount;
        return $this;
    }

    /**
     * @param int $columnCount
     */
    public function deductColumnCount($columnCount = 1)
    {
        $this->columnCount -= $columnCount;
        return $this;
    }

}