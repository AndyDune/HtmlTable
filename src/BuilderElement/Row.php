<?php
/**
 *
 * @package andydune/html-table
 * @link  https://github.com/AndyDune/HtmlTable for the canonical source repository
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Andrey Ryzhov  <info@rznw.ru>
 * @copyright 2019 Andrey Ryzhov
 */


namespace AndyDune\HtmlTable\BuilderElement;

use AndyDune\HtmlTable\Element\Row as RowElement;
use AndyDune\HtmlTable\Element\Cell as CellElement;
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

    protected $cellOrderMap = [];

    const TEMPLATE =
        '<tr#attributes:prefix(" ")#>#content#</tr>';

    protected $buildCellClass = Cell::class;

    public function __construct(RowElement $row, $maxColumnCount = null)
    {
        $this->row = $row;
        $this->maxColumnCount = $maxColumnCount;
    }

    /**
     * Array of cells codes to show in order.
     *
     * @param array $mapArray
     * @return $this
     */
    public function setCellsOrderMap($mapArray = [])
    {
        $this->cellOrderMap = $mapArray;
        return $this;
    }


    public function getHtml()
    {
        $content = $this->row->getContent();

        $cells = $this->row->getCells();
        if ($this->cellOrderMap) {
            foreach ($this->cellOrderMap as $cellCode) {
                if (array_key_exists($cellCode, $cells)) {
                    $content .= (new $this->buildCellClass($cells[$cellCode]))->getHtml();
                } else {
                    $content .= (new $this->buildCellClass(new CellElement($this->row)))->getHtml();
                }
            }
        } else {
            foreach ($cells as $cellCode => $cell) {
                $content .= (new $this->buildCellClass($cell))->getHtml();
            }
        }

        $replace = new PowerReplace();
        $replace->attributes = (new Attributes($this->row))->getHtml();
        $replace->content = $content;

        return $replace->replace(self::TEMPLATE);
    }
}