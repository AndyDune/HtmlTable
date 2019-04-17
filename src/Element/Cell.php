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

class Cell implements AttributesAwareInterface
{
    use AttributesAwareTrait;
    use ContentAwareTrait;

    /**
     * @var Row
     */
    protected $row;

    protected $colspan = 1;
    protected $rowspan = 1;

    public function __construct(Row $row)
    {
        $this->row = $row;
    }

    /**
     * @return null
     */
    public function getColspan()
    {
        return $this->colspan;
    }

    /**
     * @param int $colspan
     * @return $this
     */
    public function setColspan($colspan)
    {
        $this->getRow()->deductColumnCount($this->colspan);
        $this->colspan = $colspan;
        $this->getRow()->addColumnCount($this->colspan);
        return $this;
    }

    /**
     * @return null
     */
    public function getRowspan()
    {
        return $this->rowspan;
    }

    /**
     * @param null|int $rowspan
     * @return $this
     */
    public function setRowspan($rowspan)
    {
        $this->rowspan = $rowspan;
        return $this;
    }


    /**
     * @return Row
     */
    public function getRow()
    {
        return $this->row;
    }

}