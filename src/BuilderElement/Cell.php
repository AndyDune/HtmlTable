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
use AndyDune\StringReplace\FunctionsHolder;
use AndyDune\StringReplace\PowerReplace;

class Cell implements ElementInterface
{
    /**
     * @var CellElement
     */
    protected $cell;

    const TEMPLATE =
        '<td#colspan:more:printf(\' colspan="%s"\')##rowspan:more:printf(\' rowspan="%s"\')##attributes:prefix(" ")#>#content#</td>';

    public function __construct(CellElement $cell)
    {
        $this->cell = $cell;
    }

    public function getHtml()
    {

        $functionHolder = new FunctionsHolder();
        $functionHolder->addFunction('more', function ($string) {
            if ($string > 1) {
                return $string;
            }
            return '';
        });
        $replace = new PowerReplace($functionHolder);

        $replace->attributes = (new Attributes($this->cell))->getHtml();
        $replace->content = $this->cell->getContent();
        $replace->colspan = $this->cell->getColspan();
        $replace->rowspan = $this->cell->getRowspan();

        return $replace->replace(self::TEMPLATE);
    }

}