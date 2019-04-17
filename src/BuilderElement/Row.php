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

    public function __construct(RowElement $row, $maxColumnCount)
    {
        $this->row = $row;
        $this->maxColumnCount = $maxColumnCount;
    }

    public function getHtml()
    {
        $content = '';

        $cells = $this->row->getCe;

        $maxColumnCount = 0;
        foreach ($rows as $row) {
            if ($row->getColumnCount() > $maxColumnCount) {
                $maxColumnCount = $row->getColumnCount();
            }
        }

        foreach ($rows as $row) {
            $rowBuilder = new Row($row, $maxColumnCount);
            $content .= $rowBuilder->getHtml();
        }
        if ($this->table->isHasHead()) {
            return sprintf(self::TEMPLATE_BODY_TAG, $content);
        } else {
            return $content;
        }

    }
}