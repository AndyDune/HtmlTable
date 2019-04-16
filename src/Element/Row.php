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
use AndyDune\HtmlTable\Table;

class Row
{
    use AttributesAwareTrait;

    protected $head = false;

    /**
     * @var Table
     */
    protected $table;

    public function __construct(Table $table)
    {
        $this->table = $table;
    }

}