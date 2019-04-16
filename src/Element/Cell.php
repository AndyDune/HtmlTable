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

use AndyDune\HtmlTable\Part\AttributesAwareTrait;

class Cell
{
    use AttributesAwareTrait;

    /**
     * @var Row
     */
    protected $row;

    public function __construct(Row $row)
    {
        $this->row = $row;
    }

    /**
     * @return Row
     */
    public function getRow()
    {
        return $this->row;
    }

}