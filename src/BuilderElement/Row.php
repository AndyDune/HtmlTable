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

use AndyDune\HtmlTable\Element\Row as RowElement;
use AndyDune\StringReplace\PowerReplace;

class Row implements ElementInterface
{
    /**
     * @var RowElement
     */
    protected $row;

    /**
     * @var int
     */
    protected $maxColumnCount;

    const TEMPLATE =
        '<tr#attributes:prefix(" ")#>#content#</tr>';


    public function __construct(RowElement $row, $maxColumnCount = null)
    {
        $this->row = $row;
        $this->maxColumnCount = $maxColumnCount;
    }

    public function getHtml()
    {
        $content = $this->row->getContent();

        $cells = $this->row->getCells();
        foreach ($cells as $cell) {
            $content .= (new Cell($cell))->getHtml();
        }

        $replace = new PowerReplace();
        $replace->attributes = (new Attributes($this->row))->getHtml();
        $replace->content = $content;

        return $replace->replace(self::TEMPLATE);
    }
}