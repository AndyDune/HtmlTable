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

use AndyDune\HtmlTable\BuilderElement\Attributes;
use AndyDune\HtmlTable\BuilderElement\ElementInterface;
use AndyDune\HtmlTable\BuilderElement\TableBody;
use AndyDune\HtmlTable\BuilderElement\TableHead;
use AndyDune\StringReplace\PowerReplace;

class Builder implements ElementInterface
{
    /**
     * @var Table
     */
    protected $table;

    const TABLE_TEMPLATE = '<table#attributes:prefix(" ")#>#head##foot##body#</table>';
    const TABLE_TEMPLATE_GROUPING_SECTIONS = '<table#attributes:prefix(" ")#>#head:prefix(<thead>):postfix(</thead>)##foot:prefix(<tfoot>):postfix(</tfoot>)##body:prefix(<tbody>):postfix(</tbody>)#</table>';

    /**
     *
     * Allow using grouping sections
     * @var bool
     */
    protected $groupingSections = false;


    public function __construct(Table $table)
    {
        $this->table = $table;
    }

    public function getHtml()
    {
        $replace = new PowerReplace();

        $tableBodyBuilder = new TableBody($this->table);
        $maxColumnCount = $tableBodyBuilder->getMaxRowCount();

        if ($this->table->isHasHead()) {
            $tableHeadBuilder = new TableHead($this->table);
            $tableBodyBuilder->setCellsOrderMap($this->table->head()->getCellsOrderMap());
            if ($tableHeadBuilder->getMaxRowCount() > $maxColumnCount) {
                $maxColumnCount = $tableHeadBuilder->getMaxRowCount();
            }

            $tableHeadBuilder->setActualMaxColumnCount($maxColumnCount);
            $replace->head = $tableHeadBuilder->getHtml();
        }

        $tableBodyBuilder->setActualMaxColumnCount($maxColumnCount);

        $replace->body = $tableBodyBuilder->getHtml();
        $replace->attributes = (new Attributes($this->table))->getHtml();

        if ($this->isGroupingSections()) {
            return $replace->replace(self::TABLE_TEMPLATE_GROUPING_SECTIONS);
        }
        return $replace->replace(self::TABLE_TEMPLATE);
    }

    /**
     * @return bool
     */
    public function isGroupingSections()
    {
        return $this->groupingSections;
    }

    /**
     * @param bool $groupingSections
     * @return $this
     */
    public function setGroupingSections($groupingSections)
    {
        $this->groupingSections = $groupingSections;
        return $this;
    }

}