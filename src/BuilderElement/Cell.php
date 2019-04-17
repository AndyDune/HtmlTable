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
use AndyDune\HtmlTable\Element\Cell as CellElement;

class Cell implements ElementInterface
{
    /**
     * @var CellElement
     */
    protected $cell;

    public function __construct(CellElement $cell)
    {
        $this->cell = $cell;
    }
}