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

namespace AndyDuneTest\HtmlTable;

use AndyDune\HtmlTable\Element\Cell;
use AndyDune\HtmlTable\Element\Head;
use AndyDune\HtmlTable\Element\Row;
use AndyDune\HtmlTable\Table;
use PHPUnit\Framework\TestCase;

class TableBuildTest extends TestCase
{
    public function testSetAttributes()
    {
        $table = new Table();

        $table->addClass('very  ');
        $table->addClass('active');
        $table->addClass(' ');
        $this->assertEquals('very active', $table->getAttributeClassValue());

        $table->addStyle('color: red');
        $table->addStyle('font', 'italy');
        $this->assertEquals('color: red; font: italy', $table->getAttributeStyleValue());

        $row = new Row($table);

        $row->addClass('very  ');
        $row->addClass('active');
        $row->addClass(' ');
        $this->assertEquals('very active', $table->getAttributeClassValue());

        $row->addStyle('color: red');
        $row->addStyle('font', 'italy');
        $this->assertEquals('color: red; font: italy', $table->getAttributeStyleValue());

        $head = new Head($table);

        $head->addClass('very  ');
        $head->addClass('active');
        $head->addClass(' ');
        $this->assertEquals('very active', $table->getAttributeClassValue());

        $head->addStyle('color: red');
        $head->addStyle('font', 'italy');
        $this->assertEquals('color: red; font: italy', $table->getAttributeStyleValue());

        $cell = new Cell($row);

        $cell->addClass('very  ');
        $cell->addClass('active');
        $cell->addClass(' ');
        $this->assertEquals('very active', $table->getAttributeClassValue());

        $cell->addStyle('color: red');
        $cell->addStyle('font', 'italy');
        $this->assertEquals('color: red; font: italy', $table->getAttributeStyleValue());
    }

    public function testClassStructure()
    {
        $table = new Table();
        $row = $table->row();
        $cell = $row->cell();

        $this->assertEquals($cell->getRow()->getTable(), $table);
    }

}