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

use AndyDune\HtmlTable\Element\Head;
use AndyDune\HtmlTable\Element\Row;
use AndyDune\HtmlTable\Part\AttributesAwareInterface;
use AndyDune\HtmlTable\Part\AttributesAwareTrait;

class Table implements AttributesAwareInterface
{
    use AttributesAwareTrait;

    protected $maxCellsInRow = 0;

    /**
     * @var Row[]
     */
    protected $rows = [];

    /**
     * @var null|Head
     */
    protected $head = null;


    /**
     * @return Row
     */
    public function row()
    {
        $row = new Row($this);
        $this->rows[] = $row;
        return $row;
    }

    /**
     * @return Head|null
     */
    public function head()
    {
        if (!$this->head) {
            $this->head = new Head($this);
        }
        return $this->head;
    }

    /**
     * @return bool
     */
    public function isHasHead()
    {
        return (bool)$this->head;
    }

    /**
     * @return Row[]
     */
    public function getRows()
    {
        return $this->rows;
    }



}