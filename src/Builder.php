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
use AndyDune\HtmlTable\BuilderElement\TableBody;
use AndyDune\StringReplace\PowerReplace;

class Builder
{
    /**
     * @var Table
     */
    protected $table;

    const TABLE_TEMPLATE = '<table#attributes#>#head##foot##body#</table>';

    public function __construct(Table $table)
    {
        $this->table = $table;
    }

    public function getHtml()
    {
        $tableBodyBuilder = new TableBody($this->table);
        $maxColumnCount = $tableBodyBuilder->getMaxRowCount();

        $replace = new PowerReplace();
        $replace->body = $tableBodyBuilder->getHtml($maxColumnCount);
        $replace->attributes = (new Attributes($this->table))->getHtml();

        return $replace->replace(self::TABLE_TEMPLATE);

    }
}