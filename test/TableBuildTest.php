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

use AndyDune\HtmlTable\Builder;
use AndyDune\HtmlTable\BuilderElement\Attributes;
use AndyDune\HtmlTable\Element\Cell;
use AndyDune\HtmlTable\Element\Head;
use AndyDune\HtmlTable\Element\Row;
use AndyDune\HtmlTable\Table;
use PHPUnit\Framework\TestCase;

class TableBuildTest extends TestCase
{

    public function testClassStructure()
    {
        $table = new Table();
        $row = $table->row();
        $cell = $row->cell();

        $this->assertEquals($cell->getRow()->getTable(), $table);
    }

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

    public function testBuildAttributesHtml()
    {
        $table = new Table();
        $attributes = (new Attributes($table))->getHtml();
        $this->assertEquals('', $attributes);

        $table->addClass('good');
        $attributes = (new Attributes($table))->getHtml();
        $this->assertEquals('class="good"', $attributes);
        $table->addClass('no');
        $attributes = (new Attributes($table))->getHtml();
        $this->assertEquals('class="good no"', $attributes);

        $table = new Table();
        $table->setId('great');
        $attributes = (new Attributes($table))->getHtml();
        $this->assertEquals('id="great"', $attributes);

        $table = new Table();
        $table->addClass('good');
        $table->setId('great');
        $attributes = (new Attributes($table))->getHtml();
        $this->assertEquals('id="great" class="good"', $attributes);

        $table = new Table();
        $table->addStyle('color: red');
        $attributes = (new Attributes($table))->getHtml();
        $this->assertEquals('style="color: red"', $attributes);

        $table->addStyle('display', 'block');
        $attributes = (new Attributes($table))->getHtml();
        $this->assertEquals('style="color: red; display: block"', $attributes);
        $table->addClass('good');
        $table->setId('great');
        $attributes = (new Attributes($table))->getHtml();
        $this->assertEquals('id="great" class="good" style="color: red; display: block"', $attributes);

        $table = new Table();
        $row = new Row($table);
        $row->addStyle('color', 'white');
        $row->addClass('good');
        $row->setId('great');
        $attributes = (new Attributes($row))->getHtml();
        $this->assertEquals('id="great" class="good" style="color: white"', $attributes);

        $table = new Table();
        $row = new Row($table);
        $cell = new Cell($row);
        $cell->addStyle('color', 'black');
        $cell->addClass('good');
        $cell->setId('great');
        $attributes = (new Attributes($cell))->getHtml();
        $this->assertEquals('id="great" class="good" style="color: black"', $attributes);
    }

    public function testBuildCell()
    {
        $table = new Table();
        $cell = $table->row()->cell();
        $cell->addStyle('color', 'black');
        $cell->addClass('good');
        $cell->setId('great');
        $cell->setContent('Number 1');
        $html = (new \AndyDune\HtmlTable\BuilderElement\Cell($cell))->getHtml();
        $this->assertEquals('<td id="great" class="good" style="color: black">Number 1</td>',
            $html);

        $table = new Table();
        $cell = $table->row()->cell();
        $cell->addStyle('color', 'black');
        $cell->addClass('good');
        $cell->setColspan(2)->setRowspan(3);
        $cell->setContent('Number 1');
        $html = (new \AndyDune\HtmlTable\BuilderElement\Cell($cell))->getHtml();
        $this->assertEquals('<td colspan="2" rowspan="3" class="good" style="color: black">Number 1</td>',
            $html);
    }

    public function testBuildRow()
    {
        $table = new Table();
        $row = $table->row();
        $row->addStyle('color', 'black');
        $row->addClass('good');
        $row->setId('great');
        $row->setContent('<td>Number 2</td>');
        $html = (new \AndyDune\HtmlTable\BuilderElement\Row($row))->getHtml();
        $this->assertEquals('<tr id="great" class="good" style="color: black"><td>Number 2</td></tr>',
            $html);

        $table = new Table();
        $row = $table->row();
        $row->addStyle('color', 'black');

        $row->cell()->setContent('one');
        $row->cell()->setContent('two')->addClass('second');
        $row->cell()->setContent('3');

        $html = (new \AndyDune\HtmlTable\BuilderElement\Row($row))->getHtml();
        $this->assertEquals('<tr style="color: black">'
            . '<td>one</td><td class="second">two</td><td>3</td></tr>',
            $html);

    }

    public function testBuildTable()
    {
        $table = new Table();
        $table->addClass('good');
        $row = $table->row();
        $row->cell()->setContent(1);
        $row->cell()->setContent(2);
        $row = $table->row();
        $row->cell()->setContent(11);
        $row->cell()->setContent(12);

        $builder = new Builder($table);
        $html = $builder->getHtml();
        $this->assertEquals('<table class="good"><tr><td>1</td><td>2</td></tr>'
            . '<tr><td>11</td><td>12</td></tr></table>', $html);

        $row = $table->head();
        $row->cell()->setContent('h1');
        $row->cell()->setContent('h2');

        $builder = new Builder($table);
        $html = $builder->getHtml();
        $this->assertEquals('<table class="good"><tr><th>h1</th><th>h2</th></tr><tr><td>1</td><td>2</td></tr>'
            . '<tr><td>11</td><td>12</td></tr></table>', $html);


        $table = new Table();
        $row = $table->row();
        $row->cell()->setContent(1);
        $row->cell()->setContent(2);
        $row = $table->row();
        $row->cell()->setContent(11);
        $row->cell()->setContent(12);

        $builder = new Builder($table);
        $builder->setGroupingSections(true);
        $html = $builder->getHtml();
        $this->assertEquals('<table><tbody><tr><td>1</td><td>2</td></tr>'
            . '<tr><td>11</td><td>12</td></tr></tbody></table>', $html);

        $row = $table->head();
        $row->cell()->setContent('h1');
        $row->cell()->setContent('h2');

        $html = $builder->getHtml();
        $this->assertEquals('<table><thead><tr><th>h1</th><th>h2</th></tr></thead>'
            . '<tbody><tr><td>1</td><td>2</td></tr><tr><td>11</td><td>12</td></tr></tbody></table>', $html);
    }

    public function testBuildTableSelectOrder()
    {
        $table = new Table();
        $head = $table->head();
        $head->cell('one');
        $head->cell('two');
        $row = $table->row();
        $row->cell('two')->setContent(2);
        $row->cell('one')->setContent(1);

        $builder = new Builder($table);
        $html = $builder->getHtml();
        $this->assertEquals('<table><tr><th>one</th><th>two</th></tr>'
            . '<tr><td>1</td><td>2</td></tr></table>', $html);

        $head->cell('three');

        $builder = new Builder($table);
        $html = $builder->getHtml();
        $this->assertEquals('<table><tr><th>one</th><th>two</th><th>three</th></tr>'
            . '<tr><td>1</td><td>2</td><td></td></tr></table>', $html);


        $row->cell('two')->setContent(22);
        $row->cell('three')->setContent(3);

        $builder = new Builder($table);
        $html = $builder->getHtml();
        $this->assertEquals('<table><tr><th>one</th><th>two</th><th>three</th></tr>'
            . '<tr><td>1</td><td>22</td><td>3</td></tr></table>', $html);

        $row = $table->row();


        $builder = new Builder($table);
        $html = $builder->getHtml();
        $this->assertEquals('<table><tr><th>one</th><th>two</th><th>three</th></tr>'
            . '<tr><td>1</td><td>22</td><td>3</td></tr>'
            . '<tr><td></td><td></td><td></td></tr>'
            . '</table>', $html);

    }

}