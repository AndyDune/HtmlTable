<?php
/**
 * ----------------------------------------------
 * | Author: Andrey Ryzhov (Dune) <info@rznw.ru> |
 * | Site: www.rznw.ru                           |
 * | Phone: +7 (4912) 51-10-23                   |
 * | Date: 12.04.2019                            |
 * -----------------------------------------------
 *
 */


namespace AndyDune\HtmlTable\Element;

use AndyDune\HtmlTable\Table;

class Row
{
    protected $head = false;

    /**
     * @var Table
     */
    protected $table;

    public function __construct($table)
    {
        $this->table = $table;
    }

    /**
     * @return bool
     */
    public function isHead()
    {
        return $this->head;
    }

    /**
     * @param $header
     * @return $this
     */
    public function setHead($head)
    {
        $this->head = $head;
        return $this;
    }


}